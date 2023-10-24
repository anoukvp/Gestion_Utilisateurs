<?php
require('config.php');
use Firebase\JWT\JWT;
require __DIR__ . '\vendor\autoload.php';

//var_dump($_POST);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM User WHERE Email = :email AND Password = :password";
    $req = $bdd->prepare($sql);
    $req->execute(array(':email' => $email, ':password' => $password));
    var_dump($req);
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $token = array(
            "email" => $email,
            "exp" => time() + (60 * 60) // Le token expirera dans 1 heure
        );

        $jwt = JWT::encode($token, $jwt_secret,'HS256');

        // Envoyer le token JWT en réponse
        echo json_encode(array("token" => $jwt));
        header("Location: dashboard.php");

        exit();
    } else {
        echo json_encode(array("message" => "Identifiants invalides"));
    }
} else {
    echo json_encode(array("message" => "Veuillez fournir une adresse e-mail et un mot de passe."));
}
?>
