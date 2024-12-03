<?php
// Paramètres de connexion à la base de données
$host = 'localhost'; // ou l'adresse de votre serveur
$username = 'root'; // votre nom d'utilisateur MySQL
$password = ''; // votre mot de passe MySQL
$dbname = 'gestionproduit'; // nom de la base de données

try {
    // Création d'une connexion PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);

    // Configuration des attributs PDO pour gérer les erreurs
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Gestion des erreurs
    die("Connexion échouée: " . $e->getMessage());
}
?>
