<?php
/**
 * Created by PhpStorm.
 * User: itsam
 * Date: 6/12/2019
 * Time: 3:27 PM
 */
$adminpriv = 0;
if (isset($_SESSION['user_ID'])) {
    $usernameSQL='SELECT `admin` FROM `knowitall_gebruikers` WHERE `USERID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
    $result = $conn->query($usernameSQL);
    while ($row = $result->fetch_assoc()) {
        $adminpriv = (int) $row['admin'];
    }
}
if($adminpriv < 1){
    echo '
    <script>
        window.location = "../index.php"
    </script>
    ';
}