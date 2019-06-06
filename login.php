<?php
session_start();
$servername = "127.0.0.1";
$usernamesqllogin = "root";
$passwordsqllogin = "";
$dbname = 'knowitall';
$message = '<div class="loginmessage">';
$conn = new mysqli($servername, $usernamesqllogin, $passwordsqllogin, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submitlogin'])) {
//    $password = password_hash($_POST['password'], PASSWORD_BCRYPT );
    $password = $_POST['password'];
//    $username =     htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $loginCheckSQL='SELECT `email`, `wachtwoord`, `gebruiker_ID` FROM `knowitall_gebruikers` WHERE `email` = \''.$conn->real_escape_string($email).'\'';
//        echo $UIDcheckSQL;
    $result = $conn->query($loginCheckSQL);
    while ($row = $result->fetch_assoc()) {
        $check['EM'] = $row['email'];
        $check['PW'] = $row['wachtwoord'];
//        var_dump($check['PW'], $password, password_verify($password,$check['PW']));
        if ($check['EM'] == $email&&password_verify($password, $check['PW'])) {
            $message = $message . 'login successfull';
            $_SESSION['user_ID'] = $row['gebruiker_ID'];
        };
    };
    if (!isset($_SESSION['user_ID'])) {
//        if(isset($_SESSION['user_ID'])){session_destroy();}
        $message = $message . 'login mislukt';
    }
}
if (isset($_SESSION['user_ID'])) {
//    echo $_SESSION['user_ID'];

    $usernameSQL='SELECT `gebruikersnaam` FROM `knowitall_gebruikers` WHERE `gebruiker_ID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
//    echo $usernameSQL;
    $result = $conn->query($usernameSQL);
    while ($row = $result->fetch_assoc()) {
        $username = $row['gebruikersnaam'];

//        var_dump($row);
    }
    $message = $message . '<br>welkom, '.$username;
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
<?php echo $message . '</div>'?>
<?php include "footer.php"; ?>
</body>
</html>
