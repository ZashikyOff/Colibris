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

if (isset($_POST["id_article"])) {
    Article::DeleteReservation($_POST["id_article"]);
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <p class="nom_article"> Nom de l 'article : <?= $resultarticle["nom_article"] ?></p>
                        <p> SLUG Article: <?= $resultarticle["slug"] ?> </p>
                        <div class="article_reserved">
                            <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= $result["code"] ?>&choe=UTF-8" title="Link to Google.com" class="qrcode" />
                            <p> Code: <?= $result["code"] ?> </p>
                            <p> Email: <?= $result["email"] ?> </p>
                            <p> Date de reservation: <?= $result["reservation_date"] ?> </p>
                            <form method="post">
                                <input type="hidden" name="id_article" value="<?= $result["id_article"] ?>">
                                <button type="submit" class="removereservation">
                                    <i class="fa-regular fa-circle-xmark">
                                    </i></button>
                            </form>
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