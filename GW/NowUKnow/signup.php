<?php
include("assets/shared/connect.php");

session_start();
session_destroy();
session_start();


$_SESSION['userID'] = "";
$_SESSION['firstName'] = "";
$_SESSION['lastName'] = "";
$_SESSION['birthday'] = "";
$_SESSION['userName'] = "";
$_SESSION['phoneNumber'] = "";
$_SESSION['userType'] = "";

$error = "";

if (isset($_POST['signUpBtn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $userName = $_POST['userName'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password == $confirmPassword) {
        $userQuery = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `birthday`, `userName`, `phoneNumber`, `password`) VALUES ('$firstName', '$lastName', '$email', '$birthday', '$userName', '$phoneNumber', '$password')";
        executeQuery($userQuery);

        $lastInsertedId = mysqli_insert_id($conn);

        $_SESSION['userID'] = $lastInsertedId;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['birthday'] = $birthday;
        $_SESSION['userName'] = $userName;
        $_SESSION['phoneNumber'] = $phoneNumber;

        header("Location: index.php?userID=" . $_SESSION['userID']);
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
    <link rel="stylesheet" href="assets/css/signup.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <title>NowUKnow | Signup</title>
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
            max-width: 470px;
            height: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .btnSignUp {
            background-color: #000F24;
            color: white;
            border-radius: 200px;
            width: 100%;
            max-width: 200px;
            height: 60px;
            margin-left: auto;
            margin-right: auto;
            display: block;

        }

        .customButtonText {
            font-family: "Helvetica Rounded";
            font-size: 18px;
        }

        .signUpTittle {
            font-family: "Helvetica Rounded";
            font-size: 33px;
        }

        .btnSignUp:hover {
            background-color: #000F24;
            color: white;
        }

        .form-control {
            border-radius: 200px;
            width: 100%;
            max-width: 400px;
            height: 40px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label {
            padding-left: 35px;
            color: white;
            margin: -20px;
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
    </style>
</head>

<body>
    <div class="container-fluid" id="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-12 col-sm-0 px-5 mt-5 d-flex align-items-bottom justify-content-center">
                <div class="leftSection ">
                    <div class="logoWordmark">
                        <img src="assets/icons/logowordmark.svg" alt="logowordmark">
                    </div>
                    <div class="headerSection p-0 d-flex flex-column text-start">
                        <h1 class="h1 fs-1 fs-md-2 fs-sm-3 m-0">Create New Account</h1>
                        <h6 class="fs-6 fs-md-5 m-0 p-2">Already have an account? <a href="login.php"
                                class="loginLink">Log in</a></h6>
                    </div>


                    <div class="col-lg-12 col-12 text-center">
                        <div class="info">
                            <div class="line" style="border-top: 2px solid white; width: 30%; margin: 10px 0;"></div>
                            <p>NowUKnow: Learn, Share, Connect, and Grow</p>
                            <!-- button in learn more modal -->
                            <button type="button" class="btnLearnMore mt-3 customButtonText" data-bs-toggle="modal"
                                data-bs-target="#learnMore">Learn More?</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center">
                <div class="card mt-3">
                    <?php if ($error == "PASSWORD UNMATCHED") { ?>
                        <div class="alert alert-danger mb-3" role="alert">
                            Passwords does not match
                        </div>
                    <?php } ?>
                    <div class="h3 my-4 mt-0 text-center signUpTittle">Create Account</div>
                    <form id="SignUpForm" method="POST">
                        <div class="d-flex gap-3 mb-2">
                            <div class="flex-grow-1">
                                <label for="firstname" class="form-label moveLeft my-1">First Name</label>
                                <input type="text" id="firstname" class="form-control" name="firstName" required>
                            </div>

                            <div class="flex-grow-1">
                                <label for="lastname" class="form-label moveLeft my-1">Last Name</label>
                                <input type="text" id="lastname" class="form-control" name="lastName" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="date of birth" class="form-label">Date of Birth</label>
                            <input type="date" id="birth" class="form-control" name="birthday" required
                                pattern="\d{2}/\d{2}/\d{4}">
                        </div>
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" name="userName" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-2">
                            <label for="phone number" class="form-label">Phone Number</label>
                            <input type="text" id="phoneNumber" class="form-control" name="phoneNumber" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password" required
                                pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$"
                                title="Password must be at least 8 characters long, contain at least one letter, one number, and one special character (!@#$%^&*).">
                        </div>
                        <div class="mb-2">
                            <label for="confirm password" class="form-label">Confirm Password</label>
                            <input type="password" id="confirmPassword" class="form-control" name="confirmPassword"
                                required>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-check moveRight">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Yes, I Agree to the <a href="#" class="termsLink" data-bs-toggle="modal"
                                        data-bs-target="#termsCondition">Terms and Condition</a>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" name="signUpBtn" class="btn btnSignUp mb-3 customButtonText">Sign
                                Up</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal for learn more (small version) -->
            <div class="col-lg-6 col-12 text-center">
                <div class="info2">
                    <p class="info2Content py-4 px-5">NowUKnow: Learn, Share, Connect, and Grow</p>
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

    <!-- Modal in Terms & Conditions -->
    <div class="modal fade" id="termsCondition" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="termsConditionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="termsConditionLabel">Terms & Conditions</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Welcome to NowUKnow! These Terms and Conditions govern your access to and use of the NowUKnow
                        website,
                        an online space for creating, sharing, and browsing tutorial-based content. By registering and
                        creating
                        an account with NowUKnow, you agree to comply with these Terms. Please read them carefully
                        before proceeding.</p>

                    <hr>

                    <p><b>1. Acceptance of Terms</b></p>
                    <p>By accessing or using the NowUKnow platform, you agree to comply with and be bound by these
                        Terms. If you
                        do not agree to these Terms, you should not use the Platform or create an account.</p>

                    <p><b>2. Description of the Platform</b></p>
                    <p>NowUKnow is an online platform designed to provide users with a centralized space to create,
                        share, and browse
                        tutorial-based content. The platform aims to foster a collaborative community where users can
                        contribute and learn
                        from step-by-step guides on a variety of topics including, but not limited to, cooking,
                        technical skills, education,
                        and lifestyle tips.</p>

                    <p><b>3. Eligibility</b></p>
                    <p>To create an account on NowUKnow, you must be at least 13 years old. By creating an account, you
                        represent and
                        warrant that you meet this eligibility requirement.</p>
                    <p><b>4. Account Creation and Security</b></p>
                    <ul>
                        <li>You are responsible for maintaining the confidentiality of your account information,
                            including your username and password, and for all activities that occur under your account.
                        </li>
                        <li>You agree to immediately notify NowUKnow of any unauthorized use of your account or any
                            other breach of security.</li>
                        <li>You are solely responsible for all content you post, share, or otherwise upload to the
                            Platform.</li>
                    </ul>

                    <p><b>5. Use of the Platform</b></p>
                    <ul>
                        <li>You agree to use the Platform solely for lawful purposes, and you will not post or share
                            content that is harmful, offensive, or otherwise violates the rights of others.</li>
                        <li>You must not attempt to interfere with the proper functioning of the Platform, including the
                            manipulation of other users' content or accounts.</li>
                        <li>You are encouraged to contribute tutorials, share helpful feedback, and engage with other
                            users in a respectful and constructive manner.</li>
                    </ul>

                    <p><b>6. Content Ownership</b></p>
                    <ul>
                        <li>You retain ownership of any content (e.g., tutorials, guides, posts) that you create and
                            upload to the Platform.</li>
                        <li>However, by submitting content to NowUKnow, you grant NowUKnow a worldwide, royalty-free,
                            non-exclusive license to use, distribute, display, and share the content on the Platform and
                            through its services.</li>
                        <li>You agree that you will only upload content that you have the rights to, and you will not
                            infringe on any intellectual property rights of others.</li>
                    </ul>

                    <p><b>7. User Conduct</b></p>
                    <ul>
                        <li>Upload, share, or distribute content that is obscene, defamatory, harassing, discriminatory,
                            or otherwise inappropriate.</li>
                        <li>Use the Platform to engage in illegal activities or promote such activities.</li>
                        <li>Impersonate any person or entity, or falsely represent your affiliation with any person or
                            entity.</li>
                    </ul>

                    <p><b>8. Community Engagement</b></p>
                    <ul>
                        <li>NowUKnow encourages collaboration and interaction through feedback, comments, and ratings on
                            tutorials.</li>
                        <li>You agree to provide constructive, respectful feedback and to engage with other users in a
                            positive manner.</li>
                        <li>You may be subject to moderation or suspension if your engagement with the community
                            violates the Platform's guidelines or disrupts other users' experiences.</li>
                    </ul>

                    <p><b>9. Privacy</b></p>
                    <ul>
                        <li>Your use of NowUKnow is governed by our Privacy Policy.</li>
                        <li>The Privacy Policy explains how we collect, use, and protect your personal information.</li>
                    </ul>

                    <p><b>10. Content Moderation</b></p>
                    <ul>
                        <p>NowUKnow reserves the right to review, monitor, or remove user-posted content. The Platform
                            may suspend or terminate accounts for violating these Terms.
                        <p>
                    </ul>

                    <p><b>11. Termination</b></p>
                    <ul>
                        <p>NowUKnow may suspend or terminate your account at its discretion if these Terms are
                            violated. Upon termination, you lose access to your account and its associated content.
                        <p>
                    </ul>

                    <p><b>12. Disclaimers and Limitation of Liability</b></p>
                    <ul>
                        <li>The Platform is provided "as is" without warranties regarding content quality or
                            availability.</li>
                        <li>NowUKnow is not liable for any damages arising from Platform use, including loss of data or
                            content.</li>
                        <li>Use of the Platform is at your own risk, and it is your responsibility to ensure content
                            meets your needs.</li>
                    </ul>

                    <p><b>13. Amendments</b></p>
                    <ul>
                        <p>NowUKnow reserves the right to modify these Terms at any time. Changes will be effective upon
                            posting the updated Terms on the Platform. Your continued use of the Platform after changes
                            indicates acceptance of the revised Terms.
                        <p>
                    </ul>

                    <p><b>14. Governing Law</b></p>
                    <ul>
                        <p>These Terms are governed by the laws of the jurisdiction where NowUKnow operates. Disputes
                            will be resolved in the courts of that jurisdiction.
                        <p>
                    </ul>

                    <p><b>15. Contact Information</b></p>
                    <ul>
                        <p>For questions or concerns about these Terms, contact NowUKnow at [support@nowuknow.com].
                        <p>
                    </ul>
                    <hr>

                    <p>By registering for an account with NowUKnow, you acknowledge that you have read, understood, and
                        agree to abide by these Terms and Conditions.
                    </p>

                    <p>At NowUKnow, our goal is to create a supportive, respectful, and collaborative environment where
                        users can share and learn from tutorial-based content. To maintain a positive and engaging space
                        for everyone, we ask all members of the NowUKnow community to adhere to the following
                        guidelines. These guidelines are designed to ensure that the platform remains a safe, inclusive,
                        and productive space for learning and knowledge sharing.
                    </p>

                    <p>By participating in the NowUKnow community, you agree to follow these guidelines and to help keep
                        the platform a welcoming space for all.
                    </p>
                    <hr>

                    <p><b>1. Respect and Kindness</b></p>
                    <ul>
                        <li>Treat all members of the community with respect, kindness, and courtesy. Disagreements and
                            differing opinions are natural, but always engage in a civil manner.</li>
                        <li>Harassment, threats, bullying, and any form of discriminatory behavior based on race,
                            gender, sexual orientation, religion, nationality, or any other status will not be
                            tolerated.</li>
                        <li>Ensure that the content and comments you post do not contribute to a harmful or unsafe
                            environment. Support the creation of a space where people feel comfortable asking questions,
                            sharing experiences, and learning.</li>
                    </ul>
                    <hr>

                    <p><b>2. Content Guidelines</b></p>
                    <ul>
                        <li>Originality and Ownership: Only upload tutorials, guides, or other content that you have
                            created yourself or have explicit permission to share. If you are sharing content created by
                            others, always provide proper attribution.</li>
                        <li>Accuracy and Quality: Ensure that your tutorials and guides are clear, accurate, and
                            helpful. Misinformation or misleading instructions undermine the purpose of the platform and
                            may lead to the removal of your content.</li>
                        <li>Non-Commercial Content: Unless you have explicit permission from NowUKnow, do not use the
                            platform to promote products, services, or businesses. Content should be educational,
                            informative, and helpful to the community.</li>
                    </ul>
                    <hr>

                    <p><b>3. Prohibited Content</b></p>
                    <ul>
                        <p>The following types of content are strictly prohibited on NowUKnow:
                        </p>
                        <li>Illegal Activities: Content that promotes illegal activities, including but not limited to
                            hacking, violence, drug use, and unlawful behavior, will not be allowed.</li>
                        <li>Offensive or Harmful Content: Content that is obscene, explicit, discriminatory, hateful,
                            violent, or otherwise harmful or offensive will not be tolerated.</li>
                        <li>Spam and Irrelevant Content: Avoid posting spam, irrelevant content, or unsolicited
                            promotions. Tutorials, comments, and posts should be focused on providing value to the
                            community.</li>
                        <li>Plagiarism: Do not post content that infringes on the intellectual property rights of
                            others. Always ensure that you have the right to share the content you post, and provide
                            proper attribution when necessary.</li>
                    </ul>
                    <hr>

                    <p><b>4. Engagement and Interaction</b></p>
                    <ul>
                        <li>Constructive Feedback: If you offer feedback or comments on others' tutorials, aim to be
                            constructive and respectful. If you have suggestions for improvement, offer them in a
                            positive, helpful manner.</li>
                        <li>Encouraging Collaboration: Engage with others by asking questions, providing feedback, and
                            offering suggestions in a friendly and supportive way. Your interactions should contribute
                            to a learning experience that benefits the community as a whole.</li>
                        <li>No Trolling or Flaming: Deliberately posting inflammatory, offensive, or provocative content
                            to provoke reactions from others (commonly referred to as "trolling") is not allowed.</li>
                    </ul>
                    <hr>

                    <p><b>5. Privacy and Safety</b></p>
                    <ul>
                        <li>Personal Information: Do not share personal or sensitive information about yourself or
                            others unless explicitly necessary for your tutorial. This includes addresses, phone
                            numbers, email addresses, or other private data.</li>
                        <li>Respect Privacy: Do not post content that violates the privacy of others. This includes
                            photos, videos, or any information shared without the consent of the individuals involved.
                        </li>
                    </ul>
                    <hr>

                    <p><b>6. Intellectual Property</b></p>
                    <ul>
                        <li>Respect Intellectual Property: Do not upload or share content that infringes upon the
                            copyrights, trademarks, or patents of others. If you use materials created by someone else
                            in your tutorials, ensure that you have permission to do so and provide appropriate credit.
                        </li>
                        <li>Attribution and Licensing: When sharing content that requires attribution (e.g., images or
                            open-source code), make sure to provide proper credit and adhere to any licensing terms
                            associated with the material.</li>
                    </ul>
                    <hr>

                    <p><b>7. Reporting Violations</b></p>
                    <ul>
                        <li>Report Inappropriate Content: If you encounter content that violates these Community
                            Guidelines, please report it to NowUKnow's moderation team. Reports can be submitted through
                            the website interface, and all reports will be reviewed promptly.</li>
                        <li>Respectful Reporting: When reporting content, provide as much context as possible to help
                            the moderation team understand the issue. Avoid abusive or hostile behavior in your
                            communications with the moderation team.</li>
                    </ul>
                    <hr>

                    <p><b>8. Consequences for Violations</b></p>
                    <ul>
                        <p>NowUKnow takes these Community Guidelines seriously. Failure to comply with the guidelines
                            may result in actions including, but not limited to:</p>
                        <li>Removal of content that violates the guidelines.</li>
                        <li>Temporary or permanent suspension of user accounts.</li>
                        <li>Banning of users who repeatedly violate the guidelines or engage in harmful behavior.</li>
                    </ul>
                    <p>NowUKnow reserves the right to take appropriate action based on the severity of the violation,
                        including legal action if necessary.</p>
                    <hr>

                    <p><b>9. Moderation and Enforcement</b></p>
                    <p>The NowUKnow team may moderate content and interactions on the platform to ensure these Community
                        Guidelines are upheld. While we aim to foster an open and collaborative environment, we also
                        recognize the importance of maintaining a safe and positive space for all users. Moderation may
                        include removing content, issuing warnings, and, in severe cases, banning users who consistently
                        violate the guidelines.</p>
                    <hr>

                    <p><b>10. Your Responsibility</b></p>
                    <p>As a member of the NowUKnow community, you are responsible for your own actions and behavior on
                        the platform. Be mindful of how your words and actions affect others and contribute to the
                        overall community experience. We encourage you to be a positive influence, share valuable
                        knowledge, and support others in their learning journey.</p>
                    <hr>

                    <p><b>11. Changes to the Guidelines</b></p>
                    <p>NowUKnow may revise these Community Guidelines from time to time. We will notify users of any
                        major changes, and the updated guidelines will be posted on this page with a new effective date.
                        By continuing to use the platform after changes are made, you agree to abide by the revised
                        guidelines.</p>
                    <hr>

                    <p><b>12. Contact Us</b></p>
                    <p>If you have any questions about these Community Guidelines or need assistance, please contact
                        NowUKnow support at:</p>
                    <p><b>Email:</b> support@nowuknow.com</p>
                    <hr>

                    <p>By participating in the NowUKnow community, you acknowledge that you have read, understood, and
                        agree to these Community Guidelines. Together, we can create a welcoming, supportive space for
                        learning and growth.
                    </p>

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