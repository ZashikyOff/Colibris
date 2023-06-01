<?php

require "Assets/core/Entity/Article.php";

require "Assets/core/config/config.php";

use Core\Entity\Article;

session_name("colibris");
session_start();

$title = "Panel";


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

var_dump($_POST);
if (isset($_POST["id"]) && strlen($_POST["nom_article"]) >= 1) {
    Article::UpdateArticle($_POST["id"], $_POST["nom_article"], $_POST["desc"]);
} else {
    Article::UpdateArticle($_POST["id"], $_POST["nom"], $_POST["desc"]);
}

if (isset($_POST["new_article"]) && $_POST["new_article"] = "1") {

    $_POST["nom_article"] = $nom;
    $_POST["desc"] = $desc;
    $_POST["category"] = $categorie;

    //On écrit la requete
    $sql = "INSERT INTO article (nom_article, description, categorie, date_created) VALUES(:nom, :desc, :categorie, :date);";

    try {

        //On prépare la requete
        $query = $lienDB->prepare($sql);


        //On injecte les valeurs
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-y h:i:s');
        $query->bindParam(":date", $date);
        $query->bindValue(":nom", $nom, PDO::PARAM_STR);
        $query->bindValue(":desc", $desc, PDO::PARAM_STR);
        $query->bindValue(":categorie", $categorie, PDO::PARAM_INT);


        //On exécute la requete
        if ($query->execute()) {
            $last_id = $lienDB->lastInsertId();

            $target_dir = "Assets/core/imgbd/";

            $target_file = $target_dir . basename($last_id) . ".png";

            move_uploaded_file($_FILES["image_article"]["tmp_name"], $target_file);

            $sql = "UPDATE article SET image=:chemin WHERE id=:last_id";

            // Préparer la requête
            $query = $lienDB->prepare($sql);

            $query->bindParam(":chemin", $target_file, PDO::PARAM_STR);
            $query->bindParam(":last_id", $last_id, PDO::PARAM_INT);

            if ($query->execute()) {
                // traitement des résultats
                $results = $query->fetch();
            }

            echo "Aucune erreur";
            // header('Location: new_article.php');
        } else {
            echo " Erreur !!!!!";
        }
    } catch (PDOException | Exception | Error $execption) {
        echo "<br><br>" . $execption->getMessage();
    }


    //On récupére l'id de l'article
    // $id = $lienDB->lastInsertId();

    // echo "Article ajouté sous le numéro $id";

} else {
    echo "Le formulaire est incompet";
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
            <a href="panel.php">All Categorie</a>
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
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="img">
                        <h2>Nouvel Article</h2>
                        <input type="file" name="image_article">
                        <select name="category">
                            <option value="">-- Categorie --</option>
                            <?php
                            $resultscategories = Article::AllCategories();
                            foreach ($resultscategories as $resultcategorie) {
                            ?>
                                <option value="<?= $resultcategorie["id"] ?>"><?= $resultcategorie["nom"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <hr>
                    <input type="hidden" name="newarticle" value="1">
                    <input type="text" name="nom_article" placeholder="Nom de l'article">
                    <textarea name="desc" cols="30" rows="10" placeholder="" class="desc" maxlength="200"></textarea>
                    <button type="submit">Ajouter</button>
                </form>
            </div>
            <?php
            if (isset($_GET["categorie"])) {
                $results = Article::ArticleByCategory($_GET["categorie"]);
            } else {
                $results = Article::AllArticle();
            }
            foreach ($results as $result) {
            ?>
                <div class="card">
                    <img src="<?= $result["img_path"] ?>">
                    <hr>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $result["id_article"] ?>">
                        <input type="hidden" name="nom" value="<?= $result["nom_article"] ?>">
                        <input type="text" name="nom_article" placeholder="<?= $result["nom_article"] ?>">
                        <textarea name="desc" cols="30" rows="10" placeholder="<?= $result["description"] ?>" class="desc" maxlength="200"><?= $result["description"] ?></textarea>
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </main>
</body>

</html>