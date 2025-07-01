<?php

session_start();
session_destroy();
session_start();



if (isset($_POST['loginButton'])) {
    $email = $_POST['emailUsername'];
    $password = $_POST['password'];
    $userName = $_POST['emailUsername'];

    $email = str_replace('\'', '', $email);
    $password = str_replace('\'', '', $password);

    $query = "SELECT * from `organizers` WHERE (email = '$email' OR username = '$userName')AND password = '$password'";
    $result = executeQuery($query);

    if (mysqli_num_rows($result) > 0) {
        while ($organizer = mysqli_fetch_assoc($result)) {
            $_SESSION['email'] = $organizer['email'];
            $_SESSION['username'] = $organizer['username'];
            $_SESSION['password'] = $organizer['password'];
            $_SESSION['organizerId'] = $organizer['organizerId'];

            header("Location: organizer/");
            exit();
        }
    }
}

?>