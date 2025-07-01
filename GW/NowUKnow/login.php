<?php
include("assets/shared/connect.php");

session_start();
session_destroy();
session_start();

$error = "";

if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = str_replace('\'', '', $username);
    $password = str_replace('\'', '', $password);

    // Check if the username exists
    $userCheckQuery = "SELECT * FROM users WHERE userName = '$username'";
    $userCheckResult = executeQuery($userCheckQuery);

    $_SESSION['userID'] = "";
    $_SESSION['firstName'] = "";
    $_SESSION['lastName'] = "";
    $_SESSION['userName'] = "";
    $_SESSION['email'] = "";
    $_SESSION['birthday'] = "";
    $_SESSION['userType'] = "";
    $_SESSION['phoneNumber'] = "";

    if (mysqli_num_rows($userCheckResult) > 0) {
        // Username exists, check the password
        $loginQuery = "SELECT * FROM users WHERE userName = '$username' AND password = '$password'";
        $loginResult = executeQuery($loginQuery);

        if (mysqli_num_rows($loginResult) > 0) {
            // Successful login
            while ($user = mysqli_fetch_assoc($loginResult)) {
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['lastName'] = $user['lastName'];
                $_SESSION['userName'] = $user['userName'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['birthday'] = $user['birthday'];
                $_SESSION['userType'] = $user['userType'];
                $_SESSION['phoneNumber'] = $user['phoneNumber'];

                if ($_SESSION['userType'] == 'admin') {
                    header("Location: Admin/index.php");
                } else {
                    header("Location: index.php?userID=" . $_SESSION['userID']);
                }
                exit();
            }
        } else {
            // Incorrect password
            $error = "INCORRECT PASSWORD";
        }
    } else {
        // No user found
        $error = "NO USER";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <title>NowUKnow | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="">

    <style>
        body {
            background: url('assets/icons/landing bg3.svg') no-repeat center center;
            font-family: Helvetica, sans-serif;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-position: center center;
            background-attachment: fixed;
        }

        .card {
            background-color: #3D68A2;
            color: white;
            border-radius: 20px;
            padding: 20px;
            width: 100%;
            max-width: 430px;
            height: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .btnLogin {
            background-color: #06080f;
            color: white;
            border-radius: 200px;
            width: 100%;
            max-width: 206px;
            height: 60px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;
            display: block;
        }

        .loginTitle {
            font-family: "Helvetica Rounded";
            font-size: 35px;
        }

        .btnSignUp {
            background-color: #000F24;
            color: white;
            border-radius: 200px;
            width: 100%;
            max-width: 206px;
            height: 60px;
            margin-left: auto;
            margin-right: auto;
            display: block;

        }

        .customButtonText {
            font-family: "Helvetica Rounded";
            font-size: 18px;
        }

        .btnLogin:hover {
            background-color: #06080f;
            color: white;
        }

        .btnSignUp:hover {
            background-color: #000F24;
            color: white;
        }

        .form-control {
            border-radius: 200px;
            width: 80%;
            max-width: 320px;
            height: 45px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label {
            padding-left: 50px;
            margin-top: 20px;
            color: white;
            font-family: Helvetica, sans-serif;
            text-align: start;
        }

        .btnModal {
            background-color: #06080f;
            color: white;
        }

        .btnModal:hover {
            background-color: #06080f;
            color: white;
        }

        .modal-dialog {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 100%;
            margin: 0;
        }

        .modal-content {
            background-color: #3D68A2;
            color: white;
            width: 600px;
            height: 400px;
            margin: 0 auto;
        }

        .alert {
            border-radius: 200px;
            width: 100%;
            max-width: 300px;
            height: 20px;
            margin-left: auto;
            margin-right: auto;
            /* margin-top: 40px; */
            display: block;
            background-color: transparent;
            border: none;
            color: #ff6b6b;
            /* Keeps the text color as red */
            text-align: center;
            font-weight: bold;
            font-size: 14px;

        }
    </style>
</head>

<body>
    <div class="container-fluid" id="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-12 col-sm-0 p-0 mt-5 d-flex align-items-bottom justify-content-center">
                <div class="leftSection">
                    <div class="headerSection p-0 d-flex flex-column text-start align-items-center">
                        <img src="assets/icons/Icon white.svg" alt="Logo" class="img-fluid logo">
                    </div>
                    <div class="NowUKnow">
                        <img src="assets/icons/wordMark white small.svg" alt="WordMark Logo" class="img-fluid mb-4">
                    </div>

                    <div class="col-lg-12 col-12 text-center">
                        <div class="info">
                            <div class="line" style="border-top: 2px solid white; width: 34%; margin: 10px 0;"></div>
                            <p>NowUKnow: Learn, Share, Connect, and Grow</p>
                            <!-- button in learn more modal -->
                            <button type="button" class="btnLearnMore mt-3 customButtonText" data-bs-toggle="modal"
                                data-bs-target="#learnMore">Learn More?</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 p-0 d-flex align-items-center justify-content-center">
                <div class="card">
                    <div class="h3 my-4 text-center loginTitle">Login</div>
                    <form method="POST" id="loginForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password" required>
                        </div>
                        <?php if (isset($error)) { ?>

                            <?php if ($error == "NO USER") { ?>
                                <div class="alert alert-danger text-center rounded-5" role="alert">
                                    No user found.
                                </div>
                            <?php } elseif ($error == "INCORRECT PASSWORD") { ?>
                                <div class="alert alert-danger text-center rounded-5" role="alert">
                                    Incorrect password! Please try again.
                                </div>
                            <?php } ?>

                        <?php } ?>

                        <div class="d-flex justify-content-between">
                            <a href="forgotPw.php" class="text ms-auto" style="color: aliceblue;">Forgot Password?</a>
                        </div>
                        <div class="mt-1">
                            <button class="btn btnLogin mb-3 customButtonText" name="btnLogin"
                                type="submit">Login</button>
                            <button type="button" class="btn btnSignUp customButtonText"
                                onclick="window.location.href='signup.php';">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-lg-6 col-12 text-center">
                <div class="info2">
                    <p class="infoContent py-4 px-5">NowUKnow: Learn, Share, Connect, and Grow</p>
                    <!-- button in learn more modal (small screen)-->
                    <button type="button" class="btnLearnMore my-4 mx-5" data-bs-toggle="modal"
                        data-bs-target="#learnMore">Learn More?</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal in learn more -->
    <div class="modal fade" id="learnMore" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="learnMoreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="learnMoreLabel">NowUKnow</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    NowUKnow, is an online platform designed for users to create, share, and browse tutorial-based
                    content. The website provides a space for users to post step-by-step guides on various projects or
                    tutorials on how to solve problems across a wide range of topics, such as cooking, technical skills,
                    education, and lifestyle tips. The platform aims to foster a centralized community where users are
                    encouraged to share content that is both helpful and allows them to learn from others. By focusing
                    on tutorial-based content, the website creates an environment that prioritizes self-improvement and
                    knowledge sharing.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnModal" data-bs-dismiss="modal">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>