<?php

$title = "Contact";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'atelier des Colibris - <?= $title ?></title>
</head>
<body class="contact">
    <h1>Pour nous Contacter</h1>
    <h4>Cette page sert a nous contacter par mail pour nous prevenir si vous voulez faire des dons a notre association</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="email" name="email">
        <textarea name="message" cols="30" rows="10"></textarea>
        <input type="file" name="image">
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>