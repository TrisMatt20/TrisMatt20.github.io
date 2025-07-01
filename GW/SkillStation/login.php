<?php

include("backend/shared/connect.php");
include ("backend/auth/login.php");
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login to SkillStation</title>
    <link rel="icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/loginSign.css">

</head>

<body>
    <div class="row p-0 m-0" style="height: 100dvh;">
        <div class="col-12 col-sm-12 col-md-6 col-xl-6 login">

            <div class="container-fluid">
                <img class="img-fluid logo" src="assets/img/logoN.png">
            </div>

            <div class="container-fluid words">
                <h1 class="title">Login to SkillStation</h1>

                <form method="post">
                <div class="row mb-3">
                    <div class="col-12 px-5" style="margin-top: 30px;">
                        <h5 class="label">Email/Username</h5>
                        <input type="text" name="emailUsername" class="form-control" placeholder="Email/Username" required>
                    </div>

                    <div class="col-12 px-5" style="margin-top: 50px;">
                        <h5 class="label">Password</h5>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="col-12 px-5 d-flex justify-content-center align-items-center"
                        style="margin-top: 50px; ">
                        <button type="submit" name="loginButton" class="btn btn-primary">Login</button>
                    </div>
                </div>
                </form>

            </div>

        </div>

        <div class="col-12 col-sm-12 col-md-6 col-xl-6 signupPanel d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12 px-5" style="margin-top: 30px;">
                        <h1 class="greetings">Hi, Trainer!</h1>
                    </div>

                    <div class="col-12 px-5" style="margin-top: 50px;">
                        <p class="tagline">Want to start training people? Start creating your workshop with us</p>
                    </div>

                    <div class="col-12 px-5 d-flex justify-content-center align-items-center"
                        style="margin-top: 50px; ">
                        <a href="register.php"> <button type="submit" class="btn btn-outline-light">Sign Up</button> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>