<?php
 try{
    $bdd = new PDO('mysql:host=mysql-usermanagement.alwaysdata.net;dbname=usermanagement_bdd','325371','anouk2023');
} catch (PDOException $e){
    echo 'Erreur : ' . $e->getMessage();
    die();
}

$length = 64;
$randomBytes = random_bytes($length);
$base64Key = base64_encode($randomBytes);

$jwt_secret = $base64Key;


   ?>
