<?php

include 'header.php';
function singleQuery($query, $arr, $param, $conn)
{
    $stmt = $conn->prepare($query);
    $stmt->bind_param($param, ... $arr);
    $stmt->execute();
    $stmt->close();
}

function resultQuery($query, $arr, $param, $conn)
{
    if (isset($arr) && isset($param)) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param($param, ... $arr);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $stmt = $conn->query($query);
        $result = $stmt;
    }
    if ($result->num_rows == 0) {
        session_destroy();
    }
    $row = [];

    while ($rows = $result->fetch_assoc()) {
        array_push($row, $rows);
    }
    $stmt->close();
    return $row;
}

if (isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id()) {
    $user = $_SESSION['username'];
    var_dump($user);
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
        <p class="accountuser">' . $account[0]['username'] . '</p>
        <p class="accountbio">' . $account[0]['bio'] .'</p>
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
echo $html;
echo $header;
echo $html2;
echo $stats;
echo $html3;
include "footer.php";
echo $html4;
