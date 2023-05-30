<?php

session_name("colibris");
session_start();

$title = "Accueil";

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

<body class="index">
    <div class="background">
        <img src="Assets/img/background.jpg">
    </div>
    <nav>
        <img src="Assets/img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="articles.php">Articles</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    <main>
        <div class="left">
            <img src="Assets/img/backgroundgreen.png">
        </div>
        <div class="middle">
            <div class="apropos">
                <h2>A propos de Nous</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nihil vitae explicabo necessitatibus fuga in facere reiciendis? Error tempora praesentium blanditiis omnis, repudiandae facilis itaque, libero et ab eius nulla.
                    Voluptatem dolorum accusantium rem vel deleniti officiis iusto tempora velit sit ipsa hic aperiam inventore temporibus expedita, itaque consequuntur obcaecati nostrum saepe, eius debitis atque ex, ut ratione. Provident, voluptate.
                    Itaque dolore vel voluptatem perferendis dolorum expedita dolores beatae. Voluptates explicabo beatae nobis sequi deserunt, assumenda quos, similique eveniet impedit minima molestiae blanditiis debitis. Eos molestiae libero voluptatem porro est.</p>
            </div>
            <div class="us">
                <h2>Notre Equipe</h2>
                <div class="equipe">
                    <img src="Assets/img/profile.jpg" draggable="false">
                    <img src="Assets/img/profile.jpg" draggable="false">
                    <img src="Assets/img/profile.jpg" draggable="false">
                </div>
            </div>
            <div class="where">
                <h2>Ou sommes Nous</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d222159.9921889033!2d5.231439609870787!3d43.41726139194625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9bf4344da5333%3A0x40819a5fd970220!2sMarseille!5e0!3m2!1sfr!2sfr!4v1684221811614!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="right">
            <img src="Assets/img/backgroundgreen.png">
        </div>
    </main>
    <footer>
        Credit - &copy; Xenatil - 2023
    </footer>
</body>

</html>