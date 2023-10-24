<?php
session_start();

// // Vérifier si le JWT est valide
// require('jwt_validation.php'); // Le script qui valide le JWT

// if (!$jwt_valid) {
//     // Rediriger vers la page de connexion s'il n'est pas connecté
//     header('Location: login.php');
//     exit();
// }

require('config.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Récupérer les informations de l'utilisateur
    $sql = "SELECT * FROM User WHERE Id=:id"; // Utilisation de "Id" au lieu de "id"
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($user); // Ajout pour déboguer
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; 

     $newEmail = $_POST['email'];
     $newPseudo = $_POST['pseudo'];
     $newPassword = $_POST['password'];

    $sql = "UPDATE User SET ";
    $params = array();

    if (!empty($_POST['email'])) {
        $sql .= "Email = :email, ";
        $params[':email'] = $_POST['email'];
    }
    
    if (!empty($_POST['pseudo'])) {
        $sql .= "Pseudo = :pseudo, ";
        $params[':pseudo'] = $_POST['pseudo'];
    }
    
    if (!empty($_POST['password'])) {
        $sql .= "Password = :password, ";
        $params[':password'] = $_POST['password'];
    }
    

    // Retirer la dernière virgule et l'espace supplémentaire
    $sql = rtrim($sql, ', ');

    $sql .= " WHERE Id = :id";
    var_dump($sql); 

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Binder les paramètres supplémentaires si existent
    foreach ($params as $key => $value) {
        $stmt->bindParam($key, $value);
    }

    if ($stmt->execute()) {
        echo "Utilisateur mis à jour avec succès";
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Erreur : " . $stmt->errorInfo()[2];
    }
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <script src="dashboard.js"></script>
</head>
<!-- Le formulaire de modification -->

<form action="updateUser.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="newPseudo">Nouveau pseudo :</label>
    <input type="text" id="newPseudo" name="pseudo" value="<?php echo isset($user['Pseudo']) ? $user['Pseudo'] : ''; ?>"><br>

    <label for="newEmail">Nouvel email :</label>
    <input type="email" id="newEmail" name="email" value="<?php echo $user['Email']; ?>"><br>

    <label for="newPassword">Nouveau mot de passe :</label>
    <input type="password" id="newPassword" name="password"><br>

    <input type="submit" value="Mettre à jour">
</form>
