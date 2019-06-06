<?php
/**
 * Created by PhpStorm.
 * User: itsam
 * Date: 6/6/2019
 * Time: 8:56 AM
 */
include '../conection.php';


$usernameSQL='
SELECT `Title`,`Post`,`Date`,`knowitall_gebruikers`.`username` AS \'username\' 
FROM `knowitall_posts` 
INNER JOIN `knowitall_gebruikers` 
ON `knowitall_posts`.`USERID` = `knowitall_gebruikers`.`USERID`
WHERE `Status` = \'Approved\' 
';
//    echo $usernameSQL;
$result = $conn->query($usernameSQL);
$PostList = '<div>';
while($row = $result->fetch_assoc()) {
    var_dump($row);
    $PostList .= '<div>';

    $PostList .= '<div>User: ';
    $PostList .= $row['username'];
    $PostList .= '</div>';

    $PostList .= '<div>Titel: ';
    $PostList .= $row['Title'];
    $PostList .= '</div>';

    $PostList .= '<div>Date: ';
    $PostList .= $row['Date'];
    $PostList .= '</div>';

    $PostList .= '<div>';
    $PostList .= $row['Post'];
    $PostList .= '</div>';

    $PostList .= '</div>';
//        var_dump($row);
}
$PostList .= '</div>';
echo $PostList;


