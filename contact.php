<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 6/5/2019
 * Time: 12:44 PM
 */
 include 'header.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/sticky-footer.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Contact</title>
</head>
<body>
<?=$header?>

<div class="parallax"></div>

<div class="ctc-container">
    <div class="map">
        <iframe src="https://maps.google.com/maps?width=100%&height=600&hl=nl&q=disketteweg%202-4+(Voltiac)&ie=UTF8&t=&z=17&iwloc=B&output=embed" width="100%" height="650px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

    <div class="contact-form">
        <h1 class="title">Contact Opnemen</h1>
        <h2 class="subtitle">We zijn hier om je te helpen</h2>
        <form name="contactform" action="includes/send_form_email.php" method="post">
            <input type="text" name="name" placeholder="Je naam" />
            <input type="email" name="email" placeholder="Je e-mail adres" />
            <input type="tel" name="telephone" placeholder="Je telefoonnummer"/>
            <textarea name="message" id="" rows="8" placeholder="Jouw bericht"></textarea>
            <button name="submit" class="btn-send">Versturen</button>
        </form>
    </div>
</div>

<?php include "footer.php" ?>


</body>
</html>
