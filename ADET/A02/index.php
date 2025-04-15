<?php
$page = "home";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case "home":
            $page = "home";
            break;
        case "members":
            $page = "members";
            break;
        case "discography":
            $page = "discography";
            break;
        case "about":
            $page = "about";
            break;
        default:
            header("Location: ?page=home");
    }
} else {
    header("Location: ?page=home");
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BINI | <?php echo $page ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="shortcut icon" href="assets/img/icons/flower-logo.png" type="image/x-icon">
</head>

<body data-bs-theme="light">
    <div class="container-fluid">
        <div class="row">
            <!-- NAVBAR FOR MOBILE -->
            <nav class="navbar bg-body-tertiary d-md-none shadow-sm fixed-top"
                style="background-color: #7ACAD2 !important;">
                <div class="container-fluid px-3 d-flex justify-content-between align-items-center">

                    <!-- Hamburger -->
                    <button class="flower btn p-0 order-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas"
                        onclick="rotateFlower(this)">
                        <img src="assets/img/icons/flower-logo.png" alt="menu" class="flower-img"
                            style="width: 30px; height: 30px;">
                    </button>

                    <!-- Logo -->
                    <a class="logo navbar-brand mx-auto mb-2 order-1 position-absolute start-50 translate-middle-x"
                        href="?page=home">
                        <img src="assets/img/logo.png" alt="logo" style="width: auto; height: 30px;">
                    </a>

                    <!-- Theme Icon-->
                    <button type="button" class="themeMode btn border-0 bg-transparent p-0 order-2"
                        onclick="toggleTheme(this)">
                        <img src="assets/img/icons/darkMode.png" alt="darkmode" class="theme-icon"
                            style="width: 25px; height: 25px;">
                    </button>

                </div>
            </nav>



            <!-- SIDEBAR OFFCANVAS -->
            <div class="offcanvas offcanvas-start d-md-none sidebarCard card shadow rounded-3 mt-3" tabindex="-1"
                id="sidebarOffcanvas" aria-labelledby="sidebarLabel">
                <div class="offcanvas-header justify-content-between align-items-center">
                    <div class="offcanvas-title" id="sidebarLabel" style="margin-left: 10px;">
                        <img src="assets/img/logo.png" alt="logo" style="height: auto; width: 120px;">
                    </div>
                    <button type="button" class="btn p-0" data-bs-dismiss="offcanvas" aria-label="Close"
                        onclick="rotateFlower(this)">
                        <img src="assets/img/icons/flower-logo.png" alt="close menu" class="flower-img"
                            style="width: 40px; height: 40px; cursor: pointer;">
                    </button>
                </div>
                <div class="offcanvas-body p-3">
                    <hr class="line shadow">
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <a href="?page=home">
                                <button
                                    class="home btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">
                                    Home
                                </button>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="?page=members">
                                <button
                                    class="members btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">
                                    Members
                                </button>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="?page=discography">
                                <button
                                    class="discography btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">
                                    Discography
                                </button>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="?page=about">
                                <button
                                    class="about btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">
                                    About
                                </button>
                            </a>
                        </li>
                        <hr class="line shadow">
                        <li class="mb-1">
                                <footer class="footer text-start py-4 mt-auto">
                                    <p class="name mb-1">© 2025 Tristan Matthew Matencio <br> All rights reserved.</p>
                                    <p class="disclaimer mb-0">
                                        Images used are owned by their respective creator and owners.
                                    </p>
                                </footer>
                            </li>
                    </ul>
                </div>
            </div>

            <div class="sidebar col-2 d-none d-md-block" id="desktopSidebar">
                <div class="sidebarCard card shadow rounded-3 mt-3">
                    <div class="flex-shrink-0 p-3">
                        <div class="header d-flex justify-content-between align-items-center">
                            <a href="?page=home">
                                <div class="logo mb-3 text-start mx-2">
                                    <img src="assets/img/logo.png" alt="logo" style="width: 70%; height: 50%;">
                                </div>
                            </a>
                            <div class="theme me-3">
                                <button type="button" class="themeMode btn border-0 bg-transparent p-0"
                                    onclick="toggleTheme(this)">
                                    <img src="assets/img/icons/darkMode.png" alt="darkmode" class="theme-icon"
                                        style="width: 25px; height: 25px;">
                                </button>
                            </div>
                        </div>

                        <hr class="line shadow">
                        <ul class="list-unstyled ps-0">
                            <li class="mb-1">
                                <a href="?page=home">
                                    <button
                                        class="home btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">Home</button>
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="?page=members">
                                    <button
                                        class="members btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">Members</button>
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="?page=discography">
                                    <button
                                        class="discography btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">Discography</button>
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="?page=about">
                                    <button
                                        class="about btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">About</button>
                                </a>
                            </li>
                            <hr class="line shadow">
                            <li class="mb-1">
                                <footer class="footer text-start mt-auto ">
                                    <p class="name mb-1">© 2025 Tristan Matthew Matencio <br> All rights reserved.</p>
                                    <p class="disclaimer mb-0">
                                        Images used are owned by their respective creator and owners.
                                    </p>
                                </footer>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- MAIN CONTENT -->
            <div class="col-md-10">
                <div class="mainContainer card mt-3">
                  <?php include("assets/shared/". $page . ".php"); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/animate-up.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/discography.js"></script>
    <script src="assets/js/icon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>

</body>

</html>