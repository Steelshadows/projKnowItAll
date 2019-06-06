<?php
include '../conection.php';

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
                echo 'deze email bestaat al, kies een andere';
            }
            else{
                echo "Failed to add user error: (" . $conn->errno . ") " . $conn->error;
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
            echo 'login successfull';
            $_SESSION['user_ID'] = $row['USERID'];
        };
    };
    if(!isset($_SESSION['user_ID'])){
//        if(isset($_SESSION['user_ID'])){session_destroy();}
        echo 'login mislukt';
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
//    echo '<br>welkom, '.$username.'<br><a href=\'../weetjes%20stuuren/posten.php\'>post hier</a>';
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
<button onclick="document.getElementById('signup').style = 'display:block;';this.style = 'display:none;'">signup</button>
<div id='signup' style="display: none">
    <form method="post">
        <input type="text" name="email" placeholder="E-Mail" required>
        <input type="text" name="username" placeholder="gebruikers naam" required>
        <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
        <input type="password" name="passwordCheck" placeholder="Herhaling wachtwoord" id="passwordCheck" required>
        <input type="submit" name="submitsignup" id="submitsignup" style="display: none;">
    </form>
    <button onclick="
    console.log(document.getElementById('password').value);
    console.log(document.getElementById('passwordCheck').value);
    if(document.getElementById('password').value == document.getElementById('passwordCheck').value){
        document.getElementById('submitsignup').click()
    }
    else{alert('passwords are not the same')}">submit</button>
</div>



<button onclick="document.getElementById('login').style = 'display:block;';this.style = 'display:none;'">login</button>
<div id='login' style="display: none">
    <form method="post">
        <input type="text" name="email" placeholder="E-Mail" required>
        <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
        <br>
        <input type="submit" name="submitlogin" id="submitlogin">
    </form>
</div>
</body>
</html>
