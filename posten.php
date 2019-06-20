<?php

include 'conection.php';
if(isset($_SESSION['user_ID'])){
    $usernameSQL='SELECT `username` FROM `knowitall_gebruikers` WHERE `USERID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
    $result = $conn->query($usernameSQL);
    while($row = $result->fetch_assoc()) {
        $username = $row['username'];
    }
}

$anonypostSQL='SELECT `value` FROM `knowitall_adminsettings` WHERE `type` = \'allowAnonymousPosting\'';
$anonypost = '';
$welcome = "<p><a href='login/login.php'>log in</a> om te posten</p>";
$result = $conn->query($anonypostSQL);
while($row = $result->fetch_assoc()) {
    $anonypost = $row['value'];
}
if ($anonypost == 'True'||isset($username)){
    if(isset($username)){
        $welcome = '<p>hallo '. $username. '</p>';
    }else{
        $welcome = '<p>hallo ANONYMOUS</p>';
    }
    $welcome .= '
<div class="post-section">
    <button class="btn btn-dark" onclick="document.getElementById(\'posting\').style = \'display:block;\';this.style = \'display:none;\'">Post een weetje</button>

</div>
<div id=\'posting\' style="display: none;" class="post-section">
    <form method="post">
        <h2>Post je eigen weetje!</h2>
        <div><input class="form-control" type="text" name="Titel" placeholder="Titel" required></div>
        <div><textarea class="md-textarea form-control" id="message" name="message" placeholder="weetje"></textarea></div>
        <div><input class="form-control" type="date" name="date" required></div>
        <div><input class="form-control" type="submit" name="submitPost" id="submitPost" style="display: none;"></div>
        <div><input type="file" name="image" required /></div>
    </form>
    
    <button class="btn btn-dark" style="margin-top: 20px " onclick="
        if(document.getElementById(\'message\').value != \'\'){
            document.getElementById(\'submitPost\').click()}
        else{alert(\'weetje is leeg\')}">insturen
    </button>
</div>

    ';
}

if(isset($_POST['submitPost'])){
    $titel = htmlspecialchars($_POST['Titel']);
    $message = htmlspecialchars($_POST['message']);
    $Date = htmlspecialchars($_POST['date']);

//    $file = file_put_contents("images.json", ' " ' . base64_encode($_POST["image"]) . ' " ' . ' , ');

    $status = 'Pending';
    if ($anonypost == 'True'||isset($username)){
        if (isset($username)){
            $UID = $_SESSION['user_ID'];
        }
        else{
            $UID = 00;
        }
    }
    else{die('anonymous posting disabled, <a href="login/login.php">login</a> to try again');}



    $sql = '
    INSERT INTO `knowitall_posts` (`ID`, `Title`, `Post`, `Date`, `Status`, `USERID`) VALUES (NULL, ?, ? , ? , ? , ?)
    ';
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssss',$titel, $message,$Date,$status,$UID);
    if (!$statement->execute()){
        $welcome.= "<div>Failed to add user error: (" . $conn->errno . ") " . $conn->error."</div>";
    }
    else{
        $welcome .= "uw weetje word spoedig door ons team gereviewd";
    }
}










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
</head>
<body>

<?php include 'header.php'; ?>
<?=$welcome?>
<?php include 'footer.php' ?>
</body>
</html>
