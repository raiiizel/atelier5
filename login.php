<?php
include_once('connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    // Check for empty fields
    if (empty($login) || empty($password)) {
        header("Location: loginForm.php?error=empty"); // Redirect to the login page with an error message
        exit();
    }

    // Prepare SQL statement
    $sql = "SELECT * FROM CompteProprietaire WHERE loginProp = ? AND motPasse = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$login, $password]); // Execute query with parameters

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        session_start();
        $_SESSION['login'] = $login;
        header("Location: accueil.php"); // Redirect to the dashboard if login is successful
        exit();
    } else {
        header("Location: loginForm.php?error=incorrect"); // Redirect with an error message for incorrect credentials
        exit();
    }
}
?>
