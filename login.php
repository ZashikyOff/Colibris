<?php
session_name("colibris");
session_start();

$title = "Login";

require "Assets/core/config/config.php";

if (isset($_POST["email"]) && isset($_POST["password"])) {
    // requête SQL
    $sql = "SELECT * FROM utilisateur WHERE email=:email";
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Préparer la requête
    $query = $lienDB->prepare($sql);

    // Liaison des paramètres de la requête préparée
    $query->bindParam(":email", $email, PDO::PARAM_STR);

    // Exécution de la requête
    if ($query->execute()) {
        // traitement des résultats
        $results = $query->fetch();

        // débogage des résultats
        if ($results) {
            if (password_verify($password, $results['hash_pwd']) && $results["role"] == "admin") {
                // Connexion réussie
                header('Location: panel.php');
                echo 'Connexion réussie <br/>';
                echo 'Votre email :  ';
                echo  $_POST["email"];

                $_SESSION["email"] = $_POST["email"];
            } else {
                echo 'Mot de passe incorrect';
            }
        } else {
            echo 'Email non trouvé';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/core/css/main.css">
    <title>L'atelier des Colibris - <?= $title ?></title>
</head>

<body class="login">
    <nav>
        <img src="Assets/img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="index.php">Acceuil</a></li>
            <li><a href="articles.php">Articles</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <main>
        <form action="" method="post">
            <input type="email" name="email" required>
            <input type="password" name="password" required>
            <button type="submit">Connexion</button>
        </form>
    </main>
</body>

</html>