<?php

require "Assets/core/Entity/Article.php";

require "Assets/core/config/config.php";

use Core\Entity\Article;

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

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/core/css/main.css">
    <title>Panel Reservation</title>
</head>

<body class="panelreservation">
    <nav>
        <img src="Assets/img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="panel.php">Panel Article</a></li>
            <li><a href="Assets/core/logout.php">Acceuil</a></li>
        </ul>
    </nav>
    <main>
        <div class="all-cards">
        <?php
        $results = Article::AllReservation();
        foreach ($results as $result) {
            $resultarticles = Article::ArticleById($result["id_article"]);
            foreach ($resultarticles as $resultarticle) {
        ?>
                <div class="article">
                    <img src="<?= $resultarticle["img_path"] ?>">
                <p class="nom_article"><?= $resultarticle["nom_article"] ?></p>
                    <div class="article_reserved">
                        <p><?= $result["code"] ?></p>
                        <p><?= $result["email"] ?></p>
                        <p><?= $result["reservation_date"] ?></p>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        </div>
    </main>
</body>

</html>