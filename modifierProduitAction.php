<?php
include('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference = $_POST['reference'];
    $libelle = $_POST['libelle'];
    $prixUnitaire = $_POST['prixUnitaire'];
    $dateAchat = $_POST['dateAchat'];
    $idCategorie = $_POST['idCategorie'];

    $photoProduit = $_POST['photoProduitExistante'];
    if (!empty($_FILES['photoProduit']['name'])) {
        $targetDir = "images/";
        $photoProduit = basename($_FILES['photoProduit']['name']);
        $targetFilePath = $targetDir . $photoProduit;

        if (!move_uploaded_file($_FILES['photoProduit']['tmp_name'], $targetFilePath)) {
            die("Erreur lors du transfert de l'image.");
        }
    }

    $sql = "UPDATE Produit 
            SET libelle = ?, prixUnitaire = ?, dateAchat = ?, photoProduit = ?, idCategorie = ? 
            WHERE reference = ?";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([$libelle, $prixUnitaire, $dateAchat, $photoProduit, $idCategorie, $reference]);
        header("Location: dashboard.php");
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
