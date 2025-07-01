<?php
include("assets/shared/connect.php");

session_start();

$_SESSION['userName'] = "";
$_SESSION['phoneNumber'] = "";

$error = "";

if (isset($_POST['btnResetPass'])) {
    $userName = $_POST['userName'];
    $phoneNumber = $_POST['phoneNumber'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    if ($newPassword == $confirmNewPassword) {
        $changePassQuery = "UPDATE `users` SET `password`='$newPassword' WHERE userName = '$userName' AND phoneNumber = '$phoneNumber'";
        executeQuery($changePassQuery);

        $_SESSION['userName'] = $userName;
        $_SESSION['phoneNumber'] = $phoneNumber;
        $_SESSION['password'] = $password;

        header("Location: index.php");
    } else {
        $error = "PASSWORD UNMATCHED";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/forgotPw.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <title>NowUKnow | Forgot Password</title>
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
            padding: 30px;
            width: 100%;
            max-width: 400px;
            height: auto;
        }

        .btnLogin {
            background-color: #06080f;
            color: white;
            border-radius: 200px;
            width: 100%;
            max-width: 200px;
            height: 54px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .customButtonText {
            font-family: "Helvetica Rounded";
        }

        .form-control {
            border-radius: 200px;
            width: 90%;
            max-width: 320px;
            height: 35px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label {
            padding-left: 40px;
            color: white;
            margin-left: -20px;
            font-family: Helvetica, sans-serif;
        }

        .btnLogin:hover {
            background-color: #06080f;
            color: white;
        }

        .btnModal {
            background-color: #06080f;
            color: white;
        }

        .btnModal:hover {
            background-color: #06080f;
            color: white;
        }

        .modal-content {
            background-color: #3D68A2;
            color: white;
        }
    </style>

</head>

<body>
    <div class="container-fluid" id="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-12 col-sm-0 p-0 mt-5 d-flex align-items-bottom justify-content-center">
                <div class="leftSection">
                    <div class="logoWordmark">
                        <img src="assets/icons/logowordmark.svg" alt="logowordmark">
                    </div>
                    <div class="headerSection p-0 d-flex flex-column text-start">
                        <h1 class="h1 fs-1 fs-md-2 fs-sm-3 m-0">Forgot Password?</h1>
                        <h6 class="fs-6 fs-md-5 m-0 p-2">Change new password</h6>
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
                    <?php if ($error == "PASSWORD UNMATCHED") { ?>
                        <div class="alert alert-danger mb-3" role="alert">
                            Passwords does not match
                        </div>
                    <?php } ?>
                    <div class="h3 my-4 mt-0 text-center signUpTittle">Reset your Password</div>
                    <form id="ForgotPwForm" method="POST">
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" name="userName" required>
                        </div>
                        <div class="mb-2">
                            <label for="phone number" class="form-label">Phone Number</label>
                            <input type="text" id="phoneNumber" class="form-control" name="phoneNumber" required>

                        </div>
                        <div class="mb-2">
                            <label for="new password" class="form-label">New Password</label>
                            <input type="password" id="newPassword" class="form-control" name="newPassword" required>
                        </div>
                        <div class="mb-2">
                            <label for="confirm password" class="form-label">Confirm Password</label>
                            <input type="password" id="confirmPassword" class="form-control" name="confirmNewPassword"
                                required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" name="btnResetPass"
                                class="btn btnLogin mb-3 customButtonText">Login</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal for learn more (small version)-->
            <div class="col-lg-6 col-12 text-center">
                <div class="info2">
                    <p class="infoContent py-4 px-5">NowUKnow: Learn, Share, Connect, and Grow</p>
                    <button type="button" class="btnLearnMore my-4 mx-5" data-bs-toggle="modal"
                        data-bs-target="#learnMore">Learn More?</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal in learn More -->
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