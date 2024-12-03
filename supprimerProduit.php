<?php
include('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    $sql = "DELETE FROM Produit WHERE reference = ?";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([$reference]);
        header("Location: accueil.php");
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
