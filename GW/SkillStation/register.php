<?php
include("backend/shared/connect.php");
include ("backend/auth/signup.php")
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up to SkillStation</title>
    <link rel="icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/loginSign.css">

</head>

<body>
    <div class="row p-0 m-0" style="height: 100dvh;">
        <div class="col-12 col-sm-12 col-md-6 col-xl-6 loginPanel">
            <div class="container-fluid">
                <img class="img-fluid logo" src="assets/img/logoN_w.png">
            </div>

            <div class="row mb-3" style="margin-top: 70px;">
                <div class="col-12 px-5" style="margin-top: 30px;">
                    <h1 class="greetings">Welcome Back!</h1>
                </div>

                <div class="col-12 px-5" style="margin-top: 50px;">
                    <p class="tagline">To keep finding people to join your workshop and train them please login</p>
                </div>

                <div class="col-12 px-5 d-flex justify-content-center align-items-center" style="margin-top: 50px; ">
                    <a href="login.php"> <button type="submit" class="btn btn-outline-light">Login</button> </a>
                </div>
            </div>
        </div>


        <div class="col-12 col-sm-12 col-md-6 col-xl-6 signup">

            <div class="container-fluid words">
                <h1 class="title">Create an Account</h1>

                <form method="post">
                    <div class="row mb-3">
                        <div class="col-6 px-5" style="margin-top: 30px;">
                            <h5 class="label">First Name</h5>
                            <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                        </div>

                        <div class="col-6 px-5" style="margin-top: 30px;">
                            <h5 class="label">Last Name</h5>
                            <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                        </div>

                        <div class="col-6 px-5" style="margin-top: 30px;">
                            <h5 class="label">Username</h5>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="col-6 px-5" style="margin-top: 30px;">
                            <h5 class="label">Email</h5>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="col-6 px-5" style="margin-top: 50px;">
                            <h5 class="label">Password</h5>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="col-6 px-5" style="margin-top: 50px;">
                            <h5 class="label">Contact No.</h5>
                            <input type="text" name="contact" class="form-control" placeholder="No." required>
                        </div>

                        <div class="col-12 px-5 d-flex justify-content-center align-items-center"
                            style="margin-top: 50px; ">
                            <button type="submit" name="signupButton" class="btn btn-primary">Sign Up</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>