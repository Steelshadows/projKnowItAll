<?php

/**
 * Created by PhpStorm.
 * User: itsam
 * Date: 6/6/2019
 * Time: 8:56 AM
 */
include '../conection.php';
include 'admincheck.php';
$usernameSQL='
SELECT `ID`,`Title`,`Post`,`Date`,`knowitall_gebruikers`.`USERID`,`knowitall_gebruikers`.`username` AS \'username\' 
FROM `knowitall_posts` 
LEFT JOIN `knowitall_gebruikers` 
ON `knowitall_posts`.`USERID` = `knowitall_gebruikers`.`USERID`
WHERE `Status` = \'Pending\' 
';
//    echo $usernameSQL;
$result = $conn->query($usernameSQL);
$PostList = '<div>';
while($row = $result->fetch_assoc()) {
//    var_dump($row);
    if($row['username']!=NULL){
        $usname = $row['username'];
    }
    else {
        $usname = 'ANONYMOUS';
    }
    $PostList .= '<div>';

    $PostList .= '<div>User id: ';
    $PostList .= $row['USERID'];
    $PostList .= '</div>';

    $PostList .= '<div>Post id: ';
    $PostList .= $row['ID'];
    $PostList .= '</div>';

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

    $PostList .= '<div>';
    $PostList .= '<button onclick="window.location=\'change.php?PID='.$row['ID'].'\'">change</button>';
    $PostList .= '</div>';



    $PostList .= '</div>';
}
$PostList .= '</div>';
?>
<?=$PostList?>