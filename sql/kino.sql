CREATE DATABASE IF NOT EXISTS kino;
USE kino;

CREATE TABLE sale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazwa VARCHAR(255) NOT NULL,
    ilosc_miejsc INT NOT NULL
);

CREATE TABLE filmy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tytul VARCHAR(255) NOT NULL,
    opis TEXT,
    sala_id INT,
    FOREIGN KEY (sala_id) REFERENCES sale(id)
);

CREATE TABLE seanse (
    id INT AUTO_INCREMENT PRIMARY KEY,
    film_id INT,
    data DATETIME NOT NULL,
    FOREIGN KEY (film_id) REFERENCES filmy(id)
);

CREATE TABLE rezerwacje (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seans_id INT,
    imie VARCHAR(255) NOT NULL,
    nazwisko VARCHAR(255) NOT NULL,
    miejsce INT NOT NULL,
    FOREIGN KEY (seans_id) REFERENCES seanse(id)
);

INSERT INTO sale (nazwa, ilosc_miejsc) VALUES
('Sala A', 50),
('Sala B', 30);

INSERT INTO filmy (tytul, opis, sala_id) VALUES
('Film 1', 'Opis filmu 1', 1),
('Film 2', 'Opis filmu 2', 2);

INSERT INTO seanse (film_id, data) VALUES
(1, '2024-01-06 18:00:00'),
(2, '2024-01-06 20:00:00');