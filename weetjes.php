<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 6/6/2019
 * Time: 09:17 AM
 */

include 'conection.php';
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
    <title>Document</title>
</head>
<body>

<?php include "header.php";?>

<?php


    $query = "SELECT Title, Post, Date FROM knowitall_posts";

    $stmt = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_assoc($stmt)) {

        $title = $row["Title"];
        $post = $row["Post"];
        $date = $row["Date"];
        $img = $row["image"];

        echo <<< MARKER
            <div class="weetjecontainer">
                <div class="weetje-item">
                    <img src="$img" alt="x" width="145" />
                     <span>
                        <span class="lead title-weetje">$title</span>
                        <span class="content-weetje">$post</span>
                        <span style="float:right;" class="date-weetje">$date</span>
                    </span>
                </div>
            </div>
MARKER;

    }

?>


<?php include "footer.php";?>
</body>
</html>
