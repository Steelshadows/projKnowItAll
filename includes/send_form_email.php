<?php

$msg = "Uw e-mail is ontvangen, wij zullen zo snel mogelijk contact met je opnemen!";

if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['telephone'];
    $mailFrom = $_POST['email'];
    $message = $_POST['message'];

    $mailTo = "info.voltiac@gmail.com";

    $headers .= "Reply-To: ". $mailFrom . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $txt = "U heeft een nieuw bericht ontvangen van ".$name.".<br><br>".$message."\n\n"."<br><br>". "<b>Gegevens van inzender :</b>"."<br><br>"."<b>Naam :</b>"." " .$name.".<br>"."<b>Telefoonnr :</b>"." ".$phone."<br>"."<b>E-mail :</b>"." ".$mailFrom;


    mail($mailTo, $message, $txt, $headers);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="5; url=../index.php" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/sticky-footer.css">
    <title>Document</title>
</head>
<body>

    <div class="contact-msg"><?=$msg?></div>

    <div id="countdown"></div>

    <script>
        var timeleft = 5;
        var downloadTimer = setInterval(function(){
            document.getElementById("countdown").innerHTML = "Redirecting in " + timeleft;
            timeleft -= 1;
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "Redirecting!"
            }
        }, 1000);
    </script>
</body>
</html>
