<?php
$host = 'localhost'; // Adresse de votre serveur MySQL
$username = 'root';  // Nom d'utilisateur MySQL
$password = '';      // Mot de passe MySQL

try {
    // Connexion au serveur MySQL
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion au serveur réussie. <br>";

    // Script SQL pour créer la base de données et les tables
    $sql = "
    CREATE DATABASE IF NOT EXISTS gestionproduit;
    USE gestionproduit;

    -- Table Categorie
    CREATE TABLE IF NOT EXISTS Categorie (
        idCategorie INT AUTO_INCREMENT PRIMARY KEY,
        denomination VARCHAR(255) NOT NULL,
        description TEXT
    );

    -- Table Produit
    CREATE TABLE IF NOT EXISTS Produit (
        reference VARCHAR(50) PRIMARY KEY,
        libelle VARCHAR(255) NOT NULL,
        prixUnitaire DECIMAL(10, 2),
        dateAchat DATE,
        photoProduit VARCHAR(255),
        idCategorie INT,
        FOREIGN KEY (idCategorie) REFERENCES Categorie(idCategorie)
    );

    -- Table CompteProprietaire
    CREATE TABLE IF NOT EXISTS CompteProprietaire (
        loginProp VARCHAR(50) PRIMARY KEY,
        motPasse VARCHAR(255) NOT NULL,
        nom VARCHAR(255),
        prenom VARCHAR(255)
    );
    ";

    // Exécution du script SQL
    $conn->exec($sql);
    echo "Base de données et tables créées avec succès.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
