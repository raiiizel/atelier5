<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], 
        input[type="password"], 
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="submit"]:active {
            transform: scale(0.98);
        }

        p {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        @media (max-width: 600px) {
            form {
                padding: 15px;
            }

            input[type="text"], 
            input[type="password"], 
            input[type="submit"] {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<form action="login.php" method="POST">
        <h2>Connexion</h2>
        
        <!-- Display error messages -->
        <?php if (isset($_GET['error'])): ?>
            <?php if ($_GET['error'] == 'empty'): ?>
                <p>Veuillez remplir tous les champs.</p>
            <?php elseif ($_GET['error'] == 'incorrect'): ?>
                <p>Login ou mot de passe incorrect.</p>
            <?php endif; ?>
        <?php endif; ?>

        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
