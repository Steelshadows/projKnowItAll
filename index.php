<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 5/22/2019
 * Time: 02:24 PM
 */

$endresulttop = null;
$endresulttop2 = null;
$endresult = null;
$topweetjes = null;

 include 'header.php';
 $message = null;
 if (isset($_SESSION['user_ID'])) {
     $message = '<p class="homemessage">Welkom, ' . $_SESSION['username'] . '</p>';
 }





$sql = "SELECT ID, Title, Post, Date, Status, USERID, Post_Date, Image FROM knowitall_posts WHERE `Approval_Date` = '2019-06-27' LIMIT 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
 $endresulttop = '
<div class="relative">
    <img class="homeimg" alt="img1" src="'.$row["Image"].'">
    <div class="homeimg1tekst">'.$row["Title"].' - '. $row["Post"].'</div>
</div>
';
}
}

$sql2 = "SELECT ID, Title, Post, Date, Status, USERID, Post_Date, Image FROM knowitall_posts WHERE `Approval_Date` IS null AND `Status` = 'Approved' ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql2);

if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        $endresulttop .= '
<div class="relative2">
    <img class="homeimg" alt="img2" src="'.$row["Image"].'">
    <div class="homeimg2tekst">'.$row["Title"].'</div>
</div>
';
    }
}


$sql3 = 'SELECT `Title`,`Post`,`Date`, `Image`, `knowitall_gebruikers`.`username` AS \'username\'
FROM `knowitall_posts`
LEFT JOIN `knowitall_gebruikers`
ON `knowitall_posts`.`USERID` = `knowitall_gebruikers`.`USERID`
WHERE `Status` = \'Approved\' ORDER BY RAND() LIMIT 3';
$result = $conn->query($sql3);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $endresult .= '
<div class="homecontrow">
    <div class="top1">
        <img class="homeimgbot" alt="img" src="'.$row["Image"].'">
    </div>
    <div class="top2">
        <h4>'.$row["Title"]. '</h4>
        <div>'.$row["Post"]. '</div>
        <div class="seperator"><small>Ingestuurd door: '.$row["username"].' </small></div>
    </div>
</div>
<div class="homeline2"></div>
';

    }
}

$sql4 = "SELECT ID, Title, Post, Date, Status, USERID, Post_Date, Image FROM knowitall_posts WHERE `Status` = 'Approved' LIMIT 10";
$result = $conn->query($sql4);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $topweetjes .= '
                    <div class="space">'.$row["Title"]. ' </div>
';

    }
}




$conn->close();
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
    <title>KnowItAll</title>
</head>
<body>

<?=$header?>
<?=$message?>
    <main>
        <div class="homecontainertop">
            <?=$endresulttop?>
            <?=$endresulttop2?>
        </div>
        <div class="homecontainer">
            <div class="div1">
                <h1 class="introtekst">Welkom op de beste weetjes site van Nederland!</h1>
                <div>Alle game weetjes op een rij!</div>
                <div>Je kunt natuurlijk ook alle weetjes sorteren op een bepaalde datum.</div>
                <div>Heb jij zelf een weetje? Maak dan een account aan en stuur een weetje in!</div>
            </div>
            <div class="topweetjes">
                <p>Top 10 Weetjes</p>
                <div class="topweetjecontainer">
                <?=$topweetjes?>
                </div>
            </div>
            <div class="resp">
                <div class="row">
                    <div class="column">
                        <div class="columntext1">
                            <p>Top 10 Weetjes</p>
                            <div class="space">#1: </div>
                            <div class="space">#2: </div>
                            <div class="space">#3: </div>
                            <div class="space">#4: </div>
                            <div class="space">#5: </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="columntext2">
                            <br>
                            <div class="space">#6: </div>
                            <div class="space">#7: </div>
                            <div class="space">#8: </div>
                            <div class="space">#9: </div>
                            <div class="space">#10: Halo naar pc. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="homeline"></div>
            <p class="homep">Recente weetjes</p>
            <div class="recentweetjes">
                <div class="homecontcolumn">
                        <?=$endresult?>
                </div>
            </div>

        </div>

    </main>

<?php include "footer.php"; ?>

</body>
</html>
