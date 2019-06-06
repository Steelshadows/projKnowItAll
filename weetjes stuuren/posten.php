<?php
include '../conection.php';
if(isset($_SESSION['user_ID'])){
    $usernameSQL='SELECT `username` FROM `knowitall_gebruikers` WHERE `USERID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
    $result = $conn->query($usernameSQL);
    while($row = $result->fetch_assoc()) {
        $username = $row['username'];
    }
}

$anonypostSQL='SELECT `value` FROM `knowitall_adminsettings` WHERE `type` = \'allowAnonymousPosting\'';
$anonypost = '';
$welcome = "<p><a href='../login/login.php'>log in</a> om te posten</p>";
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
<button onclick="document.getElementById(\'posting\').style = \'display:block;\';this.style = \'display:none;\'">post</button>
<div id=\'posting\' style="display: none">
    <form method="post">
        <div><input type="text" name="Titel" placeholder="Titel" required></div>
        <div><textarea id="message" name="message" placeholder="weetje"></textarea></div>
        <div><input type="date" name="date" id="password" placeholder="Wachtwoord" required></div>
        <div><input type="submit" name="submitPost" id="submitPost" style="display: none;"></div>
    </form>
    <button onclick="
        if(document.getElementById(\'message\').value != \'\'){
            document.getElementById(\'submitPost\').click()}
        else{alert(\'weetje is leeg\')}">submit
    </button>
</div>

    ';
}

if(isset($_POST['submitPost'])){
    $titel = htmlspecialchars($_POST['Titel']);
    $message = htmlspecialchars($_POST['message']);
    $Date = htmlspecialchars($_POST['date']);
    $status = 'Pending';
    if ($anonypost == 'True'||isset($username)){
        if (isset($username)){
            $UID = $_SESSION['user_ID'];
        }
        else{
            $UID = 00;
        }
    }
    else{die('anonymous posting disabled, <a href="../login/login.php">login</a> to try again');}

    $sql = '
    INSERT INTO `knowitall_posts` (`ID`, `Title`, `Post`, `Date`, `Status`, `USERID`) VALUES (NULL, ? , ? , ? , ? , ?)
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
    <title>Document</title>
</head>
<body>
<?=$welcome?>
</body>
</html>
