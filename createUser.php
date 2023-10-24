<?php
require('config.php');
session_start();

// Vérifier si le JWT est valide
// require('jwt_validation.php'); 

// if (!$jwt_valid) {
//     header('Location: login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hasher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO User (Pseudo, Email, Password) VALUES (:pseudo, :email, :password)";

    $reqc = $bdd->prepare($sql);
    $reqc->bindParam(':pseudo', $email, PDO::PARAM_STR);
    $reqc->bindParam(':email', $email, PDO::PARAM_STR);
    $reqc->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    if ($reqc->execute()) {
        echo "Utilisateur créé avec succès";
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Erreur : ";
    }
}
?>
