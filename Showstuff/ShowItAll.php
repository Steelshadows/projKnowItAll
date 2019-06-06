<?php
/**
 * Created by PhpStorm.
 * User: itsam
 * Date: 6/6/2019
 * Time: 8:56 AM
 */
include '../conection.php';


$usernameSQL='SELECT `gebruikersnaam` FROM `knowitall_gebruikers` WHERE `Status` = \'Approved\'';
//    echo $usernameSQL;
$result = $conn->query($usernameSQL);
while($row = $result->fetch_assoc()) {
    $username = $row['gebruikersnaam'];

//        var_dump($row);
}