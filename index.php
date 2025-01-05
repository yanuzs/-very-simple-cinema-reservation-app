<!DOCTYPE html>
<html>

<head>
    <?php
    require "db.php";
    ?>
    <title>Simple Cinema</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<header>
    <h1>Simple Cinema App</h1>
</header>

<body>
    <div class="slider-container">
        <div class="slider">
            <?php
            $images = glob("images/*.jpg");

            foreach ($images as $image) {
                echo "<img src='$image' alt='Plakat filmu'>";
            }
            ?>
        </div>
    </div>

    <h1>Repertuar</h1>

    <?php
    $sql = "SELECT filmy.tytul, filmy.opis, seanse.data, sale.nazwa, seanse.id 
    FROM filmy 
    INNER JOIN seanse ON filmy.id = seanse.film_id 
    INNER JOIN sale ON filmy.sala_id = sale.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='film'>";
            echo "<h2>" . $row["tytul"] . "</h2>";
            echo "<p>" . $row["opis"] . "</p>";
            echo "<p>Data: " . $row["data"] . "</p>";
            echo "<p>" . $row["nazwa"] . "</p>";
            echo "<a href='rezerwacja.php?seans_id=" . $row["id"] . "' class='rezerwuj-przycisk'>Rezerwuj</a>";
            echo "</div>";
        }
    } else {
        echo "Brak seansów w repertuarze.";
    }

    $conn->close();
    ?>
    <script src="js/script.js"></script>
    <footer>
        <p>Autor: <b>146034</b></p>
    </footer>
</body>

</html>