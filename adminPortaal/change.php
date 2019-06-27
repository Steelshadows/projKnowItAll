<?php
/**
 * Created by PhpStorm.
 * User: itsam
 * Date: 6/12/2019
 * Time: 2:34 PM
 */
 session_start();
include '../conection.php';
include "admincheck.php";

if (isset($_POST['submit_delete'])) {
    $editPost = $_POST['postID'];
    $sql = "DELETE FROM `knowitall_posts` WHERE `ID` = ? ;";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $editPost);
    if (!$statement->execute()) {
        echo "er ging iets mis";
    }
}
if (isset($_POST['submit_change'])) {
    $title = $_POST['Title'];
    $Post = $_POST['Post'];
    $Status = $_POST['Status'];
    $editPost = $_POST['postID'];
    if (isset($Status)) {
        $editsql = "UPDATE `knowitall_posts` SET `Title` = ? , `Post` = ? , `Status` = ? WHERE `knowitall_posts`.`ID` = ?";
        $statement = $conn->prepare($editsql);
        $statement->bind_param('ssss', $title, $Post, $Status, $editPost);
        if (!$statement->execute()) {
            echo "er ging iets mis";
        }
    } else {
        echo "status niet correct";
    }
}
$usernameSQL='
SELECT `ID`,`Title`,`Post`,`Status`,DATE_FORMAT(`Date`, \'%m-%d\') AS \'Date\',`knowitall_gebruikers`.`USERID`,`knowitall_gebruikers`.`username` AS \'username\'
FROM `knowitall_posts`
LEFT JOIN `knowitall_gebruikers`
ON `knowitall_posts`.`USERID` = `knowitall_gebruikers`.`USERID`
ORDER BY
    `Status` = \'Denied\',
    `Status` = \'Approved\',
    `Status` = \'Pending\'
    ASC
';
$results = '';

$result = $conn->query($usernameSQL);
$modalsscript = '<script>';
if ($result->num_rows > 0) {
    $results = "<div class='flexing'>";
    $modals = '';
    $PostList = '<div>';
    while ($row = $result->fetch_assoc()) {
        if ($row['username']!=null) {
            $usname = $row['username'];
        } else {
            $usname = 'ANONYMOUS';
        }

        $results .= "
    <div class='flexitem itembackground' id='".$row['ID']."'>
        <p>Titel: " . $row["Title"]. "</p>
        <p>Author: " . $usname. "</p>
        <p>Post: " . $row["Post"]. "</p>
        <p>Status: " . $row["Status"]. "</p>
    </div>";



        if ($row['Status'] == 'Pending') {
            $status = '
    <select name="Status">
        <option value="Approved">Approved</option>
        <option value="Pending" disabled selected>Pending</option>
        <option value="Denied">Denied</option>
    </select>';
        } elseif ($row['Status'] == 'Denied') {
            $status = '
    <select name="Status">
        <option value="Approved">Approved</option>
        <option disabled value="Pending">Pending</option>
        <option value="Denied" selected>Denied</option>
    </select>';
        } elseif ($row['Status'] == 'Approved') {
            $status = '
    <select name="Status">
        <option value="Approved" selected>Approved</option>
        <option disabled value="Pending">Pending</option>
        <option value="Denied">Denied</option>
    </select>';
        } else {
            $status = '

    <select name="Status" required>
        <option disabled selected>ERROR_'.$row['Status'].'</option>
        <option value="Approved">Approved</option>
        <option disabled value="Pending">Pending</option>
        <option value="Denied">Denied</option>
    </select>';
        }



        $PostList .= '
        <div id="modal'.$row['ID'].'" class="modal">
            <div class="modal-content">
                <span class="close" id="close'.$row['ID'].'">&times;</span>
                <div>
                <form method="post" action="">';

        $PostList .= '<div>User id: ';
        $PostList .= $row['USERID'];
        $PostList .= '</div>';

        $PostList .= '<div>Post id: ';
        $PostList .= $row['ID'];
        $PostList .= '</div>';

        $PostList .= '<div>User: ';
        $PostList .= $usname;
        $PostList .= '</div>';
        $PostList .= '<div>Date: ';
        $PostList .= $row['Date'];
        $PostList .= '</div>';

        $PostList .= '<div>Titel: <br><textarea name="Title">';
        $PostList .= $row['Title'];
        $PostList .= '</textarea></div>';

        $PostList .= '<div>Post:<br><textarea name="Post">';
        $PostList .= $row['Post'];
        $PostList .= '</textarea></div>';

        $PostList .= '<div>Status:<br>';
        $PostList .= $status;
        $PostList .= '</div>';

        $PostList .= '<div>';
        $PostList .= '<input id="aanpassen" type="submit" name="submit_change" value="aanpassen" >';
        $PostList .= '<input id="verweideren" type="submit" name="submit_delete" value="verwijderen" onclick="return confirm(\'weet u zeker dat u dit wil verwijderen?\')">';
        $PostList .= '<input type="hidden" value="'.$row['ID'].'" name="postID"></div>';

        $PostList .= '
                </form>
                </div>
            </div>
        </div>
';
        $modalsscript .= '
        // Get the modal
var modal'.$row['ID'].' = document.getElementById("modal'.$row['ID'].'");

// Get the button that opens the modal
var btn'.$row['ID'].' = document.getElementById("'.$row['ID'].'");

// Get the <span> element that closes the modal
var span'.$row['ID'].' = document.getElementById("close'.$row['ID'].'");

// When the user clicks on the button, open the modal
btn'.$row['ID'].'.onclick = function() {
  modal'.$row['ID'].'.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span'.$row['ID'].'.onclick = function() {
  modal'.$row['ID'].'.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal'.$row['ID'].') {
    modal'.$row['ID'].'.style.display = "none";
  }
}






        ';
    }
    $results .= "</div>";
} else {
    $results = "0 results";
}
$modalsscript .= '</script>';







$result = $conn->query($usernameSQL);
$PostList .= '</div>';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/sticky-footer.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .flexing{
            display: inline-flex;
            flex-wrap: wrap;
        }
        .weetje-results{
            padding: 0 10%;
        }




        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            /*position: relative;*/
            /*top:30%;*/
            /*right:10%;*/

        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }





    </style>
</head>
<body>
<?php include "adminheader.php"; ?>
<div class="headerspace">

</div>

<div class="weetje-results">
    <p>Weetjes van gebruikers</p>
    <?=$results?>
    <?=$PostList?>
    <?=$modalsscript?>
</div>
<?php include "adminfooter.php"; ?>
</body>
</html>
