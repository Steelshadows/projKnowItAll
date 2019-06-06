<?php
include 'conection.php';
$message = '<div name="Message">';
if(isset($_POST['submitlogin'])){
//    $password = password_hash($_POST['password'], PASSWORD_BCRYPT );
    $password = $_POST['password'];
//    $username =     htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $loginCheckSQL='SELECT `email`, `password`, `USERID` FROM `knowitall_gebruikers` WHERE `email` = \''.$conn->real_escape_string($email).'\'';
//        echo $UIDcheckSQL;
    $result = $conn->query($loginCheckSQL);
    while($row = $result->fetch_assoc()) {
        $check['EM'] = $row['email'];
        $check['PW'] = $row['password'];
//        var_dump($check['PW'], $password, password_verify($password,$check['PW']));
        if ($check['EM'] == $email&&password_verify($password,$check['PW'])){
            $message .= 'login successfull';
            $_SESSION['user_ID'] = $row['USERID'];
        };
    };
    if(!isset($_SESSION['user_ID'])){
//        if(isset($_SESSION['user_ID'])){session_destroy();}
        $message .= 'login mislukt';
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
  <p class="logintitle">Login</p>
  <div id='login'>
      <form class="loginform" method="post">
          <input type="text" name="email" placeholder="E-Mail" required>
          <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
          <input type="submit" name="submitlogin" id="submitlogin" class="myButton" value="Login">
          <a class="myButton signbut" href="signup.php">Sign up instead</a>
      </form>
  </div>
</div>
<?=$message?>
<?php include "footer.php"; ?>
</body>
</html>
