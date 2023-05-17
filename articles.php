<?php

$title = "Articles";

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
                <label for="category">Category :</label>
                <select name="category">
                    <option value="">-- Choose --</option>
                    <option value="">Vetement</option>
                    <option value="">Tech</option>
                    <option value="">Meuble</option>
                    <option value="">Outils</option>
                </select>
                <label for="time">Date :</label>
                <select name="time">
                    <option value="">-- Choose --</option>
                    <option value="recent">Plus Récent</option>
                    <option value="ancien">Plus Ancient</option>
                </select>
                <button type="submit">Appliquer</button>
            </div>
        </form>
        <div class="card">

        </div>
    </main>
</body>

</html>