<?php
include 'header.php';
include 'includes/sqlfuncties.php';
if (isset($_SESSION['picture']) && $_SESSION['sessionid'] == session_id()) {
    var_dump($_SESSION);
    $sql = "UPDATE knowitall_account A JOIN knowitall_gebruikers G on A.USERID = G.USERID SET A.avatar= ? WHERE G.username = ?";
    $param = 'ss';
    $arr = array($_SESSION['picture'], $_SESSION['username']);
    singleQuery($sql, $arr, $param, $conn);
    $_SESSION['picture'] = null;
}
if (isset($_POST['submit'])) {
    $content = htmlspecialchars($_POST['content']);
    $sql = "UPDATE knowitall_account A JOIN knowitall_gebruikers G on A.USERID = G.USERID SET A.bio= ? WHERE G.username = ?";
    $param = 'ss';
    $arr = array($content, $_SESSION['username']);
    singleQuery($sql, $arr, $param, $conn);
}
header("location: account.php");
