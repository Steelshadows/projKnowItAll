<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 6/6/2019
 * Time: 09:17 AM
 */
include 'conection.php';

$searchDate = date("Y-m-d");
if(isset($_GET['date'])){
    $searchDate = date("Y-m-d", strtotime($_GET['date']));
}
$usernameSQL='
SELECT `Title`,`Post`,`Date`,`knowitall_gebruikers`.`username` AS \'username\' 
FROM `knowitall_posts` 
LEFT JOIN `knowitall_gebruikers` 
ON `knowitall_posts`.`USERID` = `knowitall_gebruikers`.`USERID`
WHERE `Status` = \'Approved\' AND `Date` = ?
';
$stmt = $conn->prepare($usernameSQL);
$stmt->bind_param('s',$searchDate);
if($stmt->execute()) {
    $result = $stmt->get_result();
    $PostList = '<div class="weetjecontainer">';
    while ($row = $result->fetch_assoc()) {
        if ($row['username'] != NULL) {
            $usname = $row['username'];
        } else {
            $usname = 'ANONYMOUS';
        }
        $PostList .= '<div class="weetje-item">';

        $PostList .= '<div>User: ';
        $PostList .= $usname;
        $PostList .= '</div>';

        $PostList .= '<div class="lead title-weetje">Titel: ';
        $PostList .= $row['Title'];
        $PostList .= '</div>';

        $PostList .= '<div class="content-weetje">Datum: ';
        $PostList .= $row['Date'];
        $PostList .= '<br>';
        $PostList .= $row['Post'];
        $PostList .= '</div>';

        $PostList .= '</div>';
    }
}
$PostList .= '</div>';
$cal = '
<input class="inputdate" type="date" value="'.$searchDate.'" onchange="
    window.location = \'weetjes.php?date=\'+this.value
" format="Y-m-d">
';
if($PostList == '<div></div>'){
    $PostList = '<div>er zijn geen weetjes gevonden voor '.date("m-d-Y", strtotime($_GET['date'])).'</div>';
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
    <title>Document</title>
</head>
<body>

<?php include "header.php";?>
<?=$cal?>
<?=$PostList?>
<?php include "footer.php";?>
</body>
</html>
