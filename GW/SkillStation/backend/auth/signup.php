<?php

session_start();    


if (isset($_POST['signupButton'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];


    $insertQuery = "INSERT INTO `organizers`(`username`, `email`, `password`) VALUES ('$userName','$email','$password');";
    executeQuery($insertQuery);
    $incrementuserIDQuery = "SELECT IFNULL(MAX(organizerInfoId), 0) + 1 AS neworganizerId FROM organizerinfo;";
    $result = executeQuery($incrementuserIDQuery);


    $neworganizerId = "";

    if (mysqli_num_rows($result) > 0) {
        while ($organizer = mysqli_fetch_assoc($result)) {
            $neworganizerId = $organizer['neworganizerId'];
            $_SESSION['organizerId'] = $organizer['neworganizerId'];
            $_SESSION['username'] = $userName;
        }
    }

    $insertinfoQuery = "INSERT INTO `organizerinfo`(`organizerId`, `firstName`, `lastName`,`contact`) VALUES ('$neworganizerId', '$firstName', '$lastName', '$contact');";
    executeQuery($insertinfoQuery);

    header("Location: organizer/");
}

?>