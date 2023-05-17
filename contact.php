<?php

$title = "Contact";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'composer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'composer/vendor/phpmailer/phpmailer/src/SMTP.php';

if(isset($_POST['email']) && isset($_POST['message'])){

    $_POST['email'] = htmlspecialchars($_POST['email']);
    $_POST['message'] = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer();
    $email = $_POST['email'];
    $message = $_POST['message'];
    if (isset($_FILES['image'])){
        $image = $_FILES['image'];
    }

    $mailFrom = $email;
    $subject = "Nouveau message de $email";
    $body = "<h1>Nouveau message de $email</h1><br><p>$message</p>";

    $mail = new PHPMailer();

    try {

        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "";
        $mail->Password = "";
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        if ($mail->Username == "" || $mail->Password == "") {
            echo "Veuillez renseigner votre adresse mail et votre mot de passe dans le fichier contact.php";
            // Exit the try and catch block
            exit();
        }

        //Recipients
        $mail->setFrom($email);
        $mail->addAddress("");

        //Attachments
        if (isset($_FILES['image'])){
            $mail->addAttachment($image['tmp_name'], $image['name']);
        }

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Le mail n'a pas pu être envoyer. Erreur Mail: {$mail->ErrorInfo}";
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
    <title>L'atelier des Colibris - <?= $title ?></title>
</head>

<body class="contact">
    <nav>
        <img src="Assets/img/logo.png" class="logo">
        <h1>L'atelier des Colibris</h1>
        <ul>
            <li><a href="articles.php">Articles</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <h1>Pour nous Contacter</h1>
    <h4>Cette page sert a nous contacter par mail pour nous prevenir si vous voulez faire des dons a notre association</h4>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="name">Adresse Mail</label>
            <input type="email" name="email" placeholder="Votre adresse mail" required>
            <label for="email">Mail</label>
            <textarea name="message" cols="30" rows="10" placeholder="Votre message ici..." required></textarea>
            <label for="image">Image</label>
            <input type="file" name="image">
            <input type="submit" value="Envoyer">
        </form>
    </div>
    <a href="./index.php">Index</a>
    <a href="./articles.php">Articles</a>
</body>

</html>