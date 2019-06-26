<?php

include 'header.php';
include 'includes/sqlfuncties.php';
$error = '<p>';
if (isset($_POST["submit"])) {
    $target_dir = "img/userpics/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $error .= "Uw file is niet een image. ";
        $uploadOk = 0;
    }

    if ($_FILES["picture"]["size"] > 500000) {
        $error .= "Sorry, uw file is te groot. ";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        $error .= "Sorry, alleen JPG, JPEG, PNG & GIF files mogen geupload worden. ";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error .= "Sorry, uw file is niet upgeload.";
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $_SESSION['picture'] = $target_file;
            header("location: accedit.php");
        } else {
            $error .= "Sorry, er is een fout opgetreden tijdens het uploaden.";
        }
    }
}
if (isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id()) {
    $user = $_SESSION['username'];
    $sql = "SELECT bio, avatar, username FROM `knowitall_account` INNER JOIN `knowitall_gebruikers` ON knowitall_account.USERID = knowitall_gebruikers.USERID WHERE `username` = '$user'";
    $account = resultQuery($sql, null, null, $conn);
    $sql = "SELECT Title, Post, Post_Date, Status, Approval_Date FROM `knowitall_posts` INNER JOIN `knowitall_gebruikers` ON knowitall_posts.USERID = knowitall_gebruikers.USERID WHERE `username` = '$user'";
    $posts = resultQuery($sql, null, null, $conn);

    $html = <<<HTML
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
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
        <link rel="manifest" href="../favicon/site.webmanifest">
        <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <title>Know It All</title>
    </head>
HTML;

    $html2 = '
    <body>
      <div class="accountcontainer">
        <img class="accountimg" src="' . $account[0]['avatar'] . '

        ">
        <form method="post" enctype="multipart/form-data" action="">
          <input class="accbutton" required type="file" name="picture">
          <input class="myButton accbutton" type="submit" name="submit" value="Verander foto">
        </form>
        ' . $error . '</p>' . '
        <p class="accountuser">' . $account[0]['username'] . '</p>
        <p class="accountbio" id="accbio">' . $account[0]['bio'] .'</p>
        <button type="button" class="myButton accedit" onclick="createModal(accbio)">Verander bio</button>
      </div>
      <div class="accountweetjes">
        <p class="accountweetjestatus">Weetjes status:</p>
      ';

    $stats = null;
    foreach ($posts as $key=>$value) {
        $stats = $stats . '<div class="accountstatcont">
          <p class="accountstatus">•' . $value['Title'] . ' ' .  $value['Post_Date'] . ' ' . $value['Status'] . ' ' . $value['Approval_Date'] . '</p>
        </div>';
    }

    $html3 = <<<HTML
    </div>
HTML;

    $html4 = <<<HTML
    </body>
    </html>
HTML;
} else {
    header("location: login.php");
}
$js = '<script src="script/script.js"></script>';
echo $html;
echo $header;
echo $html2;
echo $stats;
echo $html3;
echo $js;
include "footer.php";
echo $html4;
