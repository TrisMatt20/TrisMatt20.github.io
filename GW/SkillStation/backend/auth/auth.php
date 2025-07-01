<?php

session_start();

$organizerId;
$username;

if (isset($_SESSION['organizerId'])) {

    $organizerId = $_SESSION['organizerId'];
    $username = ($_SESSION['username']);

}else {

    header(header: "Location: ../login.php");
}

?>