<?php
session_name("colibris");
session_start();

$title = "Panel";


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

<body>
    <nav>
        <img src="Assets/img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="Assets/core/logout.php">Acceuil</a></li>
        </ul>
    </nav>
</body>

</html>