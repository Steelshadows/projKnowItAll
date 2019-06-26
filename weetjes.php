<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 6/6/2019
 * Time: 09:17 AM
 */
include 'header.php';


$searchDate = date("Y-m-d");
if (isset($_GET['date'])) {
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
$stmt->bind_param('s', $searchDate);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $PostList = "<div class='container weetje-container'>Geen weetjes gevonden voor " . $searchDate . "</div>";
    while ($row = $result->fetch_assoc()) {
        $PostList = null;

        if ($row['username'] != null) {
            $username = $row['username'];
        } else {
            $username = 'ANONYMOUS';
        }
        $title = $row["Title"];
        $date = $row["Date"];
        $content = $row["Post"];
        $image = $row["Image"];

        $PostList .= <<< WEETJE
                    <div class="container weetje-container">
                        <div class="weetje-item">
                            <div class="">
                                    <h4>Titel: $title </h4>
                                    <div class="float-right"><img id="myImg" src="$image" alt="X" style="width:100px;max-width:300px"></div>
                                    <div class="seperator"><small>Ingestuurd door: $username</small></div>
                            </div>

                            <div class="content-weetje">
                                <div class="post">$content</div>

                            </div>
                        </div>
                    </div>
                    <!-- The Modal -->
                    <div id="myModal" class="modal">

                      <!-- The Close Button -->
                      <span class="close">&times;</span>

                      <!-- Modal Content (The Image) -->
                      <img class="modal-content" id="img01">

                      <!-- Modal Caption (Image Text) -->
                      <div id="caption"></div>
                    </div>

WEETJE;
    }




    $cal = '
<input class="inputdate" type="date" value="'.$searchDate.'" onchange="
    window.location = \'weetjes.php?date=\'+this.value
" format="Y-m-d">
';


    //if ($PostList == '<div class="weetjecontainer"></div>') {
//    $PostList = '<div class="weetjecontainer">er zijn geen weetjes gevonden voor '.date("m-d-Y", strtotime($searchDate)).'</div>';
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
    <style>
        /* Style the Image Used to Trigger the Modal */
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 65px;
            right: 65px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<?=$header?>
<?=$cal?>
<?=$PostList?>
<?php include "footer.php";?>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>
</body>
</html>
