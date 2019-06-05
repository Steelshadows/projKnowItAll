<?php
session_start();
$servername = "127.0.0.1";
$usernamesqllogin = "root";
$passwordsqllogin = "";
$dbname = 'knowitall';
$conn = new mysqli($servername, $usernamesqllogin, $passwordsqllogin, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_SESSION['user_ID'])){
//    echo $_SESSION['user_ID'];

    $usernameSQL='SELECT `gebruikersnaam` FROM `knowitall_gebruikers` WHERE `gebruiker_ID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
//    echo $usernameSQL;
    $result = $conn->query($usernameSQL);
    while($row = $result->fetch_assoc()) {
        $username = $row['gebruikersnaam'];

//        var_dump($row);
    }
//    echo '<br>welkom, '.$username;
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
        <div><input type="date" name="password" id="password" placeholder="Wachtwoord" required></div>
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
    $Date =     htmlspecialchars($_POST['username']);
//    $email = htmlspecialchars($_POST['email']);
        $sql = '
        INSERT INTO `knowitall_posts` (`gebruikersnaam`, `email`, `wachtwoord`) VALUES (?, ?, ?)
        ';
//        $res = mysqli_query($conn, $sql);
        $statement = $conn->prepare($sql);
        $statement->bind_param('sss',$username, $email,$password);
        if (!$statement->execute()){
            if ($conn->errno == 1062){
                echo 'deze email bestaat al, kies een andere';
            }
            else{
                echo "Failed to add user error: (" . $conn->errno . ") " . $conn->error;
            }
        }
        $UIDcheckSQL='SELECT `gebruiker_ID` FROM `knowitall_gebruikers` WHERE `email` = \''.$conn->real_escape_string($email).'\'';
//        echo $UIDcheckSQL;
        $result = $conn->query($UIDcheckSQL);
        $id = false;
        while($row = $result->fetch_assoc()) {
            $UID = (int) $row['gebruiker_ID'];
        }
        $_SESSION['user_ID'] = $UID;
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
