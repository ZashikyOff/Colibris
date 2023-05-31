<?php

use Core\Entity\Article;

session_name("colibris");
session_start();

$title = "Panel";

require "Assets/core/config/config.php";

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
        } else {
            header('Location: index.php');
        }
    }
}

try {
    $sql = "SELECT * FROM article";
    $results = $lienDB->query($sql);
} catch (Exception $e) {
    print_r($e);
}
$results = $results->fetchAll();

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

<body class="panel">
    <nav>
        <img src="Assets/img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="Assets/core/logout.php">Acceuil</a></li>
        </ul>
    </nav>
    <main>
        <div class="list-categorie">
            <?php
            $results = Article::AllCategories();
        foreach ($results as $result) {
            ?>
            <a href="panel.php?categorie=<?= $result["id"] ?>"><?= $result["nom"] ?></a>
            <?php
            }
            ?>
        </div>
        <div class="all-cards">
            <?php
            $results = Article::ArticleByCategory($_GET["categorie"]);
            foreach ($results as $result) {
            ?>
                <div class="card">
                    <img src="<?= $result["img_path"] ?>">
                    <hr>
                    <h3 class="name_article"><?= $result["nom_article"] ?></h3>
                    <p class="desc"><?= $result["description"] ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </main>
</body>

</html>