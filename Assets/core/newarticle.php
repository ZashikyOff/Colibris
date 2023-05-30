<?php
session_name("colibris");
session_start();

$title = "New Article";

require "config/config.php";

if (isset($_SESSION["email"])) {
    // requête SQL
    $sql = "SELECT * FROM utilisateur WHERE email=:email";
    $email = $_SESSION["email"];

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
            // Connexion réussie
            // header('Location: panel.php');
        }else {
            header('Location: index.php');
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
    <link rel="stylesheet" href="css/main.css">
    <title>L'atelier des Colibris - <?= $title ?></title>
</head>

<body>
    <nav>
        <img src="../img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="../../panel.php">Panel Admin</a></li>
        </ul>
    </nav>
</body>

</html>