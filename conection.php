<?php
session_start();
$servername = "localhost";
$usernamesqllogin = "student4a8_462577";
$passwordsqllogin = "VgC1NIok3C";
$dbname = "student4a8_462577";
$conn = new mysqli($servername, $usernamesqllogin, $passwordsqllogin, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}