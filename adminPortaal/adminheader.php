<?php
/**
 * Created by PhpStorm.
 * User: wsbos
 * Date: 5/22/2019
 * Time: 02:24 PM
 */

$adminpriv = 0;
if (isset($_SESSION['user_ID'])) {
    $usernameSQL='SELECT `admin` FROM `knowitall_gebruikers` WHERE `USERID` = \''.$conn->real_escape_string($_SESSION['user_ID']).'\'';
    $result = $conn->query($usernameSQL);
    while ($row = $result->fetch_assoc()) {
        $adminpriv = (int) $row['admin'];
    }
}
$adminpage = null;
$uitloggen = null;
$inloggen = '<a class="dropdown-item" href="../login.php">Login</a>
             <a class="dropdown-item" href="../signup.php">Registreren</a>';
if ($adminpriv == 1){
    $adminpage = '<a class="dropdown-item" href="../adminPortaal/change.php">Admin Portaal</a>';
}
if (isset($_SESSION['user_ID'])) {
    $uitloggen = '<div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../uitloggen.php">Uitloggen</a>';
    $inloggen = null;
}

function account()
{
    $link = null;
    if (isset($_SESSION['sessionid'])) {
        $link = "account.php";
    } else {
        $link = "login.php";
    }
    return $link;
}
?>


<header>
    <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
        <img src="../img/kia_logo.png" width="28 px" alt="logo">&nbsp;<a class="navbar-brand" href="../index.php">KnowItAll - Dagelijkse weetjes!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">☰</button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item"> <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="../weetjes.php">Weetjes</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="../posten.php">Zelf Insturen</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="../contact.php">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?=$inloggen?>
                        <?=$adminpage?>

                        <a class="dropdown-item" href="../<?php echo account()?>">Mijn account</a>
                        <?=$uitloggen?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
