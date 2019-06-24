<?php
$servername = "localhost";
$usernamesqllogin = "root";
$passwordsqllogin = "";
$dbname = "knowitall";
$conn = new mysqli($servername, $usernamesqllogin, $passwordsqllogin, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
