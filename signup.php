<?php
include 'conection.php';
$message = '<div class="loginmessage">';
$form = null;

if (isset($_POST['submitsignup'])) {
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    $username =     htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    if ($password == $passwordCheck) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = '
        INSERT INTO `knowitall_gebruikers` (`username`, `email`, `password`, `admin`) VALUES (? , ? , ? , 0)
        ';
        $statement = $conn->prepare($sql);
        $statement->bind_param('sss', $username, $email, $password);
        if (!$statement->execute()) {
            if ($conn->errno == 1062) {
                $message = $message . 'deze email bestaat al, kies een andere';
            } else {
                $message = $message . "Failed to add user error: (" . $conn->errno . ") " . $conn->error;
            }
        }
        $UIDcheckSQL='SELECT `USERID`, `username` FROM `knowitall_gebruikers` WHERE `email` = \''.$conn->real_escape_string($email).'\';';
        $result = $conn->query($UIDcheckSQL);
        $id = false;
        while ($row = $result->fetch_assoc()) {
            $UID = (int) $row['USERID'];
            $user = $row['username'];
        }
        $_SESSION['user_ID'] = $UID;
        $_SESSION['username'] = $user;

        $account = '<?php
        session_start();
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="../css/main.css">
            <link rel="stylesheet" type="text/css" href="../css/sticky-footer.css">
            <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
            <link rel="manifest" href="../favicon/site.webmanifest">
            <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#5bbad5">
            <meta name="msapplication-TileColor" content="#da532c">
            <meta name="theme-color" content="#ffffff">
            <title>Know It All</title>
        </head>
        <?php include "account_header.php"; ?>
        <body>
          <div class="accountcontainer">
            <img class="accountimg" src="../img/default-avatar.png">
            <p class="accountuser">' . $user . '</p>
            <p class="accountbio">U kunt hier iets over uw zelf typen.</p>
          </div>
          <div class="accountweetjes">
            <p class="accountweetjestatus">Weetjes status:</p>
            <div class="accountstatcont">
              <p class="accountstatus">Test</p>
            </div>
          </div>
        <?php include "../footer.php"; ?>
        </body>
        </html>';

        file_put_contents('users/' . $user . '.php', $account);

        header("location: index.php");
    }
}

if (isset($_SESSION['user_ID'])) {
    $message = $message . 'U bent al ingelogd';
} else {
    $form = '<div class="logincontainer">
    <div class="loginrow">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<img src="img/kia_logo.png" width="28" alt="logo"><h3 class="panel-title">Registreren</h3>
			 	</div>
			 	<br/>
			  	<div class="panel-body">
			    	<form method="post" onsubmit="return validatePassword()">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" type="text" name="email" placeholder="E-Mail" required>
			    		</div>
			    		<div class="form-group">
			    		    <input class="form-control" type="text" name="username" placeholder="Gebruikersnaam" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" type="password" name="password" id="passwordsignup" placeholder="Wachtwoord" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" type="password" name="passwordCheck" placeholder="Herhaling wachtwoord" id="passwordCheck" required>
			    		</div>
			    		<input class="btn btn-dark btn-success btn-block" type="submit" name="submitsignup" id="submitsignup" value="Registreren">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>';
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
    <title>Know It All</title>
</head>
<body>
<?php include "header.php"; ?>
<?=$form?>
<?php echo $message . '</div>'?>
<?php include "footer.php"; ?>
<script src="script/script.js"></script>
</body>
</html>
