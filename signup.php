<?php
include 'conection.php';
$message = '<div name="Message">';
if(isset($_POST['submitsignup'])){
    $password = $_POST['password'];
    $passwordCheck = $_POST['password'];
    $username =     htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    if($password == $passwordCheck) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT );
        $sql = '
        INSERT INTO `knowitall_gebruikers` (`username`, `email`, `password`) VALUES (?, ?, ?)
        ';
//        $res = mysqli_query($conn, $sql);
        $statement = $conn->prepare($sql);
        $statement->bind_param('sss',$username, $email,$password);
        if (!$statement->execute()){
            if ($conn->errno == 1062){
                $message .= 'deze email bestaat al, kies een andere';
            }
            else{
                $message .= "Failed to add user error: (" . $conn->errno . ") " . $conn->error;
            }
        }
        $UIDcheckSQL='SELECT `USERID` FROM `knowitall_gebruikers` WHERE `email` = \''.$conn->real_escape_string($email).'\'';
//        echo $UIDcheckSQL;
        $result = $conn->query($UIDcheckSQL);
        $id = false;
        while($row = $result->fetch_assoc()) {
            $UID = (int) $row['USERID'];
        }
        $_SESSION['user_ID'] = $UID;
    }
}

if(isset($_SESSION['user_ID'])){
//    echo $_SESSION['user_ID'];

    $usernameSQL='SELECT `username` FROM `knowitall_gebruikers` WHERE `USERID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
//    echo $usernameSQL;
    $result = $conn->query($usernameSQL);
    while($row = $result->fetch_assoc()) {
        $username = $row['username'];

//        var_dump($row);
    }
    $message .= '<br>welkom, '.$username;
}

$message .= '</div>';
var_dump( $message);
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
<div class="logincontainer">
  <p class="logintitle">Signup</p>
  <div id='signup'>
      <form class="signupform" method="post" onsubmit="return validatePassword()">
          <input type="text" name="email" placeholder="E-Mail" required>
          <input type="text" name="username" placeholder="Gebruikersnaam" required>
          <input type="password" name="password" id="passwordsignup" placeholder="Wachtwoord" required>
          <input type="password" name="passwordCheck" placeholder="Herhaling wachtwoord" id="passwordCheck" required>
          <input type="submit" name="submitsignup" id="submitsignup" class="myButton" value="Sign up">
          <a class="myButton signbut" href="login.php">Login instead</a>
      </form>
  </div>
</div>
<?=$message?>
<?php include "footer.php"; ?>
<script src="script/script.js"></script>
</body>
</html>