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
              <img class="homeimg" alt="img1" src="img/frontpage.png">
              <div class="homeimg1tekst">Het grootste gaming event van de wereld. E3 alle nieuwste games en game gerelateerde nieuws op een rijtje.</div>
          </div>
          <div class="relative2">
              <img class="homeimg" alt="img2" src="img/frontpage2.png">
              <div class="homeimg2tekst">Halo voor het eerst naar de pc na 18 jaar.</div>
          </div>
        </div>
        <div class="homecontainer">
            <div class="div1">
                <h1>Welkom op de beste weetjes site van Nederland!</h1>
            </div>
            <div class="topweetjes">
                <p>Top 10 Weetjes</p>
                <div class="topweetjecontainer">
                    <div class="space">#1: </div>
                    <div class="space">#2: </div>
                    <div class="space">#3: </div>
                    <div class="space">#4: </div>
                    <div class="space">#5: </div>
                    <div class="space">#6: </div>
                    <div class="space">#7: </div>
                    <div class="space">#8: </div>
                    <div class="space">#9: </div>
                    <div class="space">#10: Halo naar pc. </div>
                </div>
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
