<?php

// Connexion à la base de données
$dsn = "mysql:host=localhost;port=3306;dbname=colibris;charset=utf8";
$dbUser = "root";
$dbPassword = "root";
$lienDB = new PDO($dsn, $dbUser, $dbPassword);

?>