<?php
require 'vendor/autoload.php'; 
require('config.php');

use Firebase\JWT\JWT;

// Clé secrète pour signer et vérifier le JWT
$secret_key = $jwt_secret; 

// Fonction pour vérifier la validité du JWT
function validateJWT($jwt) {
    global $secret_key;

    try {
        // Vérifier la signature du JWT
        $options = new stdClass();
        $options->algorithms = ['HS256'];
        $decoded = JWT::decode($jwt, $secret_key, $options);
        return true;
    } catch (Exception $e) {
        return false;
    }
}
