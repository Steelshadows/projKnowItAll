<?php
include '../conection.php';

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
    $PostList = '<div>';
    while ($row = $result->fetch_assoc()) {
        if ($row['username'] != NULL) {
            $usname = $row['username'];
        } else {
            $usname = 'ANONYMOUS';
        }
        $PostList .= '<div>';

        $PostList .= '<div>User: ';
        $PostList .= $usname;
        $PostList .= '</div>';

        $PostList .= '<div>Titel: ';
        $PostList .= $row['Title'];
        $PostList .= '</div>';

        $PostList .= '<div>Date: ';
        $PostList .= $row['Date'];
        $PostList .= '</div>';

        $PostList .= '<div>Post:<br>';
        $PostList .= $row['Post'];
        $PostList .= '</div>';

        $PostList .= '</div>';
    }
}
$PostList .= '</div>';
$cal = '
<input type="date" value="'.$searchDate.'" onchange="
    window.location = \'calender.php?date=\'+this.value
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
    <title>Document</title>
</head>
<body>
<?=$PostList?>
<?=$cal?>
</body>
</html>

