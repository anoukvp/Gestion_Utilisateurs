<?php
session_start();
require('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $sql = "DELETE FROM User WHERE id = :id";

    $reqd = $bdd->prepare($sql);
    $reqd->bindParam(':id', $id, PDO::PARAM_INT);

    if ($reqd->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Erreur : " . $reqd->errorInfo()[2];
    }
}
?>
