<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 5/22/2019
 * Time: 02:24 PM
 */
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
    <title>Document</title>
</head>
<body>

<?php include "header.php"; ?>

    <main>
        <div class="homecontainertop">
          <div class="relative">
              <img class="homeimg1" alt="img1" src="img/europeslostf.jpg">
              <div class="homeimg1tekst">Kaas</div>
          </div>
          <div class="relative2">
              <img class="homeimg2" alt="img2" src="img/placeholder.png">
              <div class="homeimg2tekst">Kaasssssssssss</div>
          </div>
        </div>
        <div class="homecontainer">
            <div class="div1">
                <h1>Welkom op de beste weetjes site van Nederland!</h1>
            </div>
            <div class="topweetjes">
                <p>Top 10 Weetjes</p>
            </div>
        </div>
        <div class="homeline"></div>
        <p class="homep">Recente weetjes</p>
        <div class="homecontainer homecontcolumn">
            <div class="homecontrow">
                <img class="homeimgbot" alt="img" src="img/placeholder.png">
                <p>Titel</p>
                <p class="homeweetje">Content</p>
            </div>
            <div class="homeline2"></div>
            <div class="homecontrow">
                <img class="homeimgbot" alt="img" src="img/placeholder.png">
                <p>Titel</p>
                <p class="homeweetje">Content</p>
            </div>
            <div class="homeline2"></div>
            <div class="homecontrow">
                <img class="homeimgbot" alt="img" src="img/placeholder.png">
                <p>Titel</p>
                <p class="homeweetje">Content</p>
            </div>
            <div class="homeline2"></div>
        </div>
    </main>

<?php include "footer.php"; ?>

</body>
</html>
