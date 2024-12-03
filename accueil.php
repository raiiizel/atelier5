<?php
include('connexion.php');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: loginForm.php");
    exit();
}

// Récupérer les informations du propriétaire
$login = $_SESSION['login'];
$sql = "SELECT nom, prenom FROM CompteProprietaire WHERE loginProp = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$login]);
$proprietaire = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$proprietaire) {
    echo "Erreur: Propriétaire non trouvé.";
    exit();
}

// Afficher Bonjour ou Bonsoir en fonction de l'heure
$currentHour = date("H");
$greeting = ($currentHour < 18) ? "Bonjour" : "Bonsoir";
$nomComplet = $proprietaire['prenom'] . " " . $proprietaire['nom'];

// Récupérer les produits triés par libelle
$sqlProduits = "SELECT * FROM Produit ORDER BY libelle ASC";
$stmtProduits = $conn->prepare($sqlProduits);
$stmtProduits->execute();
$produits = $stmtProduits->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        main {
            padding: 20px;
        }

        h1 {
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #4CAF50;
            color: white;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #e0f7e9;
        }

        img.icon {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .action-icon {
            margin: 0 5px;
            text-decoration: none;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .action-links {
            text-align: center;
            margin-top: 20px;
        }

        .action-links a {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px;
            color: white;
            background-color: #4CAF50;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .action-links a:hover {
            background-color: #45a049;
        }

        .action-links a:active {
            transform: scale(0.98);
        }

        @media (max-width: 600px) {
            form {
                padding: 15px;
            }

            button {
                font-size: 14px;
            }

            .action-links a {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <h1><?php echo "$greeting, $nomComplet !"; ?></h1>
    
    <h2>Liste des Produits</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Libellé</th>
                <th>Prix Unitaire</th>
                <th>Date d'Achat</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produit['reference']); ?></td>
                    <td><?php echo htmlspecialchars($produit['libelle']); ?></td>
                    <td><?php echo number_format($produit['prixUnitaire'], 2); ?> dh</td>
                    <td><?php echo htmlspecialchars($produit['dateAchat']); ?></td>
                    <td>
                        <?php if (!empty($produit['photoProduit'])): ?>
                            <img src="uploads/<?php echo htmlspecialchars($produit['photoProduit']); ?>" alt="Photo" width="50">
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Lien pour modifier -->
                        <a class="action-icon" href="modifierProduit.php?reference=<?php echo urlencode($produit['reference']); ?>">
                            <img class="icon" src="icons/edit.png" alt="Modifier">
                        </a>
                        <!-- Lien pour supprimer -->
                        <a class="action-icon" href="supprimerProduit.php?reference=<?php echo urlencode($produit['reference']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                            <img class="icon" src="icons/delete.png" alt="Supprimer">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <div class="action-links">
    <a href="ajouterProduit.php">Ajouter Produit</a>
    <a href="logout.php">logout</a>
                        </div>
</body>
</html>
