<!DOCTYPE html>
<html lang="en">
<?php
include('connexion.php');

$reference = $_GET['reference']; // La référence du produit passé dans l'URL

$sql = "SELECT * FROM Produit WHERE reference = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$reference]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    die("Produit non trouvé !");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-top: 20px;
        }

        form {
            background-color: #fff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], 
        input[type="number"], 
        input[type="date"], 
        input[type="file"], 
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        button:active {
            transform: scale(0.98);
        }

        select {
            cursor: pointer;
        }

        @media (max-width: 600px) {
            form {
                padding: 15px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    
    <form action="modifierProduitAction.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="reference" value="<?php echo htmlspecialchars($produit['reference']); ?>">
        
    <label for="libelle">Libellé:</label>
    <input type="text" id="libelle" name="libelle" value="<?php echo htmlspecialchars($produit['libelle']); ?>" required><br><br>

    <label for="prixUnitaire">Prix Unitaire:</label>
    <input type="number" id="prixUnitaire" name="prixUnitaire" step="0.01" value="<?php echo htmlspecialchars($produit['prixUnitaire']); ?>" required><br><br>

    <label for="dateAchat">Date d'Achat:</label>
    <input type="date" id="dateAchat" name="dateAchat" value="<?php echo htmlspecialchars($produit['dateAchat']); ?>" required><br><br>

    <label for="photoProduit">Photo du Produit:</label>
    <input type="file" id="photoProduit" name="photoProduit"><br><br>

    <label for="idCategorie">Catégorie:</label>
    <select id="idCategorie" name="idCategorie" required>
        <?php
        $sql = "SELECT idCategorie, denomination FROM Categorie";
        foreach ($conn->query($sql) as $categorie) {
            $selected = ($categorie['idCategorie'] == $produit['idCategorie']) ? "selected" : "";
            echo "<option value='{$categorie['idCategorie']}' $selected>{$categorie['denomination']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Modifier</button>
</form>
</body>
</html>
