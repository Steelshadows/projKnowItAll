<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = 'knowitall';
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submitsignup'])){
    $password = base64_encode(htmlspecialchars($_POST['password']));
    $passwordCheck = base64_encode(htmlspecialchars($_POST['passwordCheck']));
    $username =     htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
//    $emaildupecheck = $conn->query();
    $emaildupechecksql = 'SELECT `email` FROM `knowitall_gebruikers` WHERE `email` = ?';
    $emaildupecheck = $conn->prepare($emaildupechecksql);
    $emaildupecheck->bind_param('s',$email);
    $emaildupecheck->execute();

    if($password == $passwordCheck) {
//        $sql = "
//        INSERT INTO `knowitall_gebruikers` (`gebruikersnaam`, `password`, `email`)
//        VALUES (?,?,?)
//        ";
        $sql = '
        INSERT INTO `knowitall_gebruikers` (`gebruikersnaam`, `email`, `wachtwoord`) VALUES (?, ?, ?)
        ';
        echo $sql;
        $res = mysqli_query($conn, $sql);
        $statement = $conn->prepare($sql);
        $statement->bind_param('sss',$username, $email,$password);
        $statement->execute();
//    if (!$res) {
//        echo "Failed to run query: (" . $conn->errno . ") " . $conn->error;
//    }
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
</body>
</html>
