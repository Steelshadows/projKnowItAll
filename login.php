<?php
include 'conection.php';
$message = '<div class="loginmessage">';
$form = null;

if (isset($_POST['submitlogin'])) {
//    $password = password_hash($_POST['password'], PASSWORD_BCRYPT );
    $password = $_POST['password'];
//    $username =     htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $loginCheckSQL='SELECT `email`, `password`,  `username`, `USERID` FROM `knowitall_gebruikers` WHERE `email` = \''.$conn->real_escape_string($email).'\'';
//        echo $UIDcheckSQL;
    $result = $conn->query($loginCheckSQL);
    while ($row = $result->fetch_assoc()) {
        $check['EM'] = $row['email'];
        $check['PW'] = $row['password'];
//        var_dump($check['PW'], $password, password_verify($password,$check['PW']));
        if ($check['EM'] == $email&&password_verify($password, $check['PW'])) {
            $message .= 'login successfull';
            $_SESSION['user_ID'] = $row['USERID'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['sessionid'] = session_id();
            header("location: index.php");
        };
    };
    if (!isset($_SESSION['user_ID'])) {
//        if(isset($_SESSION['user_ID'])){session_destroy();}
        $message .= 'login mislukt';
    }
}
if (isset($_SESSION['user_ID'])) {
//     $usernameSQL='SELECT `username` FROM `knowitall_gebruikers` WHERE `USERID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
    // //    echo $usernameSQL;
//     $result = $conn->query($usernameSQL);
//     while ($row = $result->fetch_assoc()) {
//         $username = $row['username'];
//
    // //        var_dump($row);
//     }
    $message .= 'U bent al ingelogd';
} else {
//    $form =
//        '<div class="logincontainer">
//    <p class="logintitle">Login</p>
//    <div id="login">
//        <form class="loginform" method="post">
//            <input type="text" name="email" placeholder="E-Mail" required>
//            <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
//            <input type="submit" name="submitlogin" id="submitlogin" class="myButton" value="Login">
//            <a class="myButton signbut" href="signup.php">Sign up instead</a>
//        </form>
//    </div>
    //  </div>
    $form = '<div class="logincontainer">
    <div class="loginrow">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<img src="img/kia_logo.png" width="28" alt="logo"><h3 class="panel-title">Inloggen</h3>
			 	</div>
			 	<br/>
			  	<div class="panel-body">
			    	<form method="post">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" type="text" name="email" placeholder="E-Mail" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" type="password" name="password" id="password" placeholder="Wachtwoord" required>
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-dark btn-success btn-block" type="submit" name="submitlogin" id="submitlogin" value="Inloggen">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>';
}

$message .= '</div>';
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
    <title>Know It All</title>
</head>
<body>
<?php include "header.php"; ?>
<?=$form?>
<?=$message?>
<?php include "footer.php"; ?>
</body>
</html>
