<?php
session_name("colibris");
session_start();

$title = "Articles";

require "Assets/core/config/config.php";
require "Assets/core/Entity/Article.php";

use Core\Entity\Article;


// var_dump($_POST);

if(!isset($_POST["search"]) && !isset($_POST["category"])){
    $results = Article::AllArticle();
}
if(isset($_POST["search"]) && strlen($_POST["search"]) <= 1){
    $results = Article::AllArticle();
}
if (isset($_POST["search"]) && !empty($_POST["search"])) {
    $results = Article::ArticleByName($_POST["search"]);
    if (isset($_POST["category"]) && !empty($_POST["category"])) {
        $results = Article::ArticleByNameAndCategorie($_POST["search"], $_POST["category"]);
    }
} else {
    if (isset($_POST["category"]) && !empty($_POST["category"])) {
        $results = Article::ArticleByCategory($_POST["category"]);
    }
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
    <title>L'atelier des Colibris - <?= $title ?></title>
</head>

<body class="articles">
    <nav>
        <img src="Assets/img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="index.php">Acceuil</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <main>
        <h1>Articles a Disposition</h1>
        <form action="" method="post">
            <div class="searchbar">
                <input type="search" name="search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="filter">
                <div class="categoriefilter">
                    <label for="category">Category :</label>
                    <select name="category">
                        <option value="">-- Choose --</option>
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
                <div class="timefilter">
                    <label for="time">Date :</label>
                    <select name="time">
                        <option value="">-- Choose --</option>
                        <option value="recent">Plus Récent</option>
                        <option value="ancien">Plus Ancient</option>
                    </select>
                </div>
                <button type="submit">Appliquer</button>
            </div>
        </form>
        <div class="all-cards">
            <?php
            if(count($results) == 0){
                
                ?>
                <h3>Aucun Resultat</h3>
                <?php
            }

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