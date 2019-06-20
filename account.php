<?php
session_start();

if (isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id()) {
    function singleQuery($query, $arr, $param)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($param, ... $arr);
        $stmt->execute();
        $stmt->close();
    }

    function resultQuery($query, $arr, $param)
    {
        if (isset($arr) && isset($param)) {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param($param, ... $arr);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $stmt = $this->conn->query($query);
            $result = $stmt;
        }
        if ($result->num_rows == 0) {
            session_destroy();
        }
        $row = [];

        while ($rows = $result->fetch_assoc()) {
            array_push($row, $rows);
        }
        $stmt->close();
        return $row;
    }
} else {
    header("location: login.php");
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
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Know It All</title>
</head>
<?php include "header.php"; ?>
<body>
  <div class="accountcontainer">
    <img class="accountimg" src="img/default-avatar.png">
    <p class="accountuser">User</p>
    <p class="accountbio">Lorem ipsum dolor sit amet.</p>
  </div>
  <div class="accountweetjes">
    <p class="accountweetjestatus">Weetjes status:</p>
    <div class="accountstatcont">
      <p class="accountstatus">Test</p>
    </div>
  </div>
<?php include "footer.php"; ?>
</body>
</html>
