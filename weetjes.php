<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 6/6/2019
 * Time: 09:17 AM
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

<?php include "header.php";?>

<!--Dit gedeelte wordt in een while loop elke keer gepusht wanneer hij een weetje vind-->
<div class="weetjecontainer">
    <div class="weetje-item">
        <img src="img/placeholder.png" alt="x" width="145" />
        <span>
            <span class="lead title-weetje">Title van het weetje <!-- $titel --></span>
            <span class="content-weetje">Dit is een Div uit een whileloop uit de weetjes db <!-- $weetje --></span>
        </span>
    </div>
</div>

<?php include "footer.php";?>
</body>
</html>
