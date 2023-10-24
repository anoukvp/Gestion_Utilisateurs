<?php
session_start();
require('config.php');
// Vérifier si le JWT est valide
// require('jwt_validation.php');

// if (!$jwt_valid) {
//     header('Location: login.php');
//     exit();
// }


$req = "SELECT id, email FROM User";
$result = $bdd->query("SELECT id, email, Pseudo FROM User");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>Tableau de bord</h1>

    <div class="container">
        <div class="user-list">
            <h2>Liste des utilisateurs :</h2>
            <ul id="userList">
                <?php
                while ($res = $result->fetch()) { ?>
                    <li>
                     Pseudo : <?php echo $res["Pseudo"]; ?> |    
                    <?php echo $res["email"]; ?> <button class="editBtn" data-id="<?php echo $res["id"]; ?>"><a href="updateUser.php?id=<?php echo $res["id"]; ?>">Modifier</a></button>
                        <button class="deleteBtn" data-id="<?php echo $res["id"]; ?>"><a href="deleteUser.php?id=<?php echo $res["id"]; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a></button>

                    <?php }
                    ?>
            </ul>
        </div>

        <div class="user-actions">
            <h2>Actions</h2>
            <h3>Créer un nouvel utilisateur :</h3>
            <form id="createUserForm" action="createUser.php" method="post">
                <label for="newPseudo">Pseudo :</label>
                <input type="text" id="newPseudo" name="pseudo" required><br>

                <label for="newEmail">Email :</label>
                <input type="email" id="newEmail" name="email" required><br>

                <label for="newPassword">Mot de passe :</label>
                <input type="password" id="newPassword" name="password" required><br>

                <input type="submit" value="Créer">
            </form>

        </div>
    </div>

    <script src="dashboard.js"></script>
</body>

</html>