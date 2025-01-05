<!DOCTYPE html>
<html lang="pl">

<head>
    <?php
    require "db.php";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerwacja biletu</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1><a href="index.php" text-decoration: none;>Wróć do index.php</a></h1>
    </header>
    <main>
        <h2>Rezerwacja biletu</h2>
        <?php
        $seans_id = filter_input(INPUT_GET, 'seans_id', FILTER_VALIDATE_INT);

        if ($seans_id) {
            $sql = "SELECT filmy.tytul, seanse.data, sale.nazwa, sale.ilosc_miejsc 
                FROM seanse 
                INNER JOIN filmy ON seanse.film_id = filmy.id 
                INNER JOIN sale ON filmy.sala_id = sale.id 
                WHERE seanse.id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                echo "<p class='error'>Błąd zapytania do bazy danych: " . htmlspecialchars($conn->error) . "</p>";
                exit;
            }
            $stmt->bind_param("i", $seans_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<div class='rezerwacja'>";
                echo "<h3>" . htmlspecialchars($row["tytul"]) . "</h3>";
                echo "<p>" . htmlspecialchars($row["data"]) . "</p>";
                echo "<p>" . htmlspecialchars($row["nazwa"]) . "</p>";

                echo "<form method='post'>";
                echo "<input type='hidden' name='seans_id' value='" . htmlspecialchars($seans_id) . "'>";
                echo "<label for='imie'>Imię:</label>";
                echo "<input type='text' name='imie' id='imie' required maxlength='25'><br><br>";
                echo "<label for='nazwisko'>Nazwisko:</label>";
                echo "<input type='text' name='nazwisko' id='nazwisko' required maxlength='50'><br><br>";
                echo "<label for='miejsce'>Miejsce:</label>";
                echo "<select name='miejsce' id='miejsce'>";
                for ($i = 1; $i <= (int) $row["ilosc_miejsc"]; $i++) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                echo "</select><br><br>";
                echo "<button type='submit'>Rezerwuj</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<p class='error'>Nie znaleziono seansu o podanym ID.</p>";
            }
            $stmt->close();
        } else {
            echo "<p class='error'>Nieprawidłowy identyfikator seansu.</p>";
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $seans_id = filter_input(INPUT_POST, 'seans_id', FILTER_VALIDATE_INT);
            $imie = filter_input(INPUT_POST, 'imie', FILTER_SANITIZE_STRING);
            $nazwisko = filter_input(INPUT_POST, 'nazwisko', FILTER_SANITIZE_STRING);
            $miejsce = filter_input(INPUT_POST, 'miejsce', FILTER_VALIDATE_INT);

            if ($seans_id && $imie && $nazwisko && $miejsce) {
                $sql_check = "SELECT COUNT(*) FROM rezerwacje WHERE seans_id = ? AND miejsce = ?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->bind_param("ii", $seans_id, $miejsce);
                $stmt_check->execute();
                $stmt_check->bind_result($count);
                $stmt_check->fetch();
                $stmt_check->close();

                if ($count > 0) {
                    echo "<p class='error'>Miejsce $miejsce jest już zajęte.</p>";
                } else {
                    $sql_insert = "INSERT INTO rezerwacje (seans_id, imie, nazwisko, miejsce) 
                               VALUES (?, ?, ?, ?)";
                    $stmt_insert = $conn->prepare($sql_insert);
                    $stmt_insert->bind_param("issi", $seans_id, $imie, $nazwisko, $miejsce);

                    if ($stmt_insert->execute()) {
                        echo "<p class='success'>Rezerwacja została pomyślnie dodana!</p>";
                    } else {
                        echo "<p class='error'>Wystąpił błąd podczas zapisu rezerwacji: " . htmlspecialchars($stmt_insert->error) . "</p>";
                    }
                    $stmt_insert->close();
                }
            } else {
                echo "<p class='error'>Proszę wypełnić wszystkie pola formularza.</p>";
            }
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>Autor: <b></b></p>
    </footer>
</body>

</html>