<?php
include('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference = $_POST['reference'];
    $libelle = $_POST['libelle'];
    $prixUnitaire = $_POST['prixUnitaire'];
    $dateAchat = $_POST['dateAchat'];
    $idCategorie = $_POST['idCategorie'];

    // Gestion du fichier photo
    $photoProduit = null;
    if (isset($_FILES['photoProduit']) && $_FILES['photoProduit']['error'] == UPLOAD_ERR_OK) {
        $photoProduit = basename($_FILES['photoProduit']['name']);
        move_uploaded_file($_FILES['photoProduit']['tmp_name'], "uploads/" . $photoProduit);
    }

    // Insertion du produit dans la base de données
    $sql = "INSERT INTO Produit (reference, libelle, prixUnitaire, dateAchat, photoProduit, idCategorie) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([$reference, $libelle, $prixUnitaire, $dateAchat, $photoProduit, $idCategorie]);
        header("Location: accueil.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
