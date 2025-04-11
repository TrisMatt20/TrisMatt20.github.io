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
        case "gallery":
            $page = "gallery";
            break;
        case "videos":
            $page = "videos";
            break;
        default:
            header("Location: ?page=home");
            exit;
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
        <title>BINI | Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body data-bs-theme="light">
        <div class="container-fluid">
            <div class="row">
                <div class="sidebar col-2">
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
                            </hr>

                            <ul class="list-unstyled ps-0">
                                <li class="mb-1">
                                    <a href="?page=home">
                                        <button
                                            class="home btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#home-collapse"
                                            aria-expanded="true">
                                            Home
                                        </button>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="?page=members">
                                        <button
                                            class="members btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#home-collapse"
                                            aria-expanded="true">
                                            Members
                                        </button>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="?page=discography">
                                        <button
                                            class="discography btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#home-collapse"
                                            aria-expanded="true">
                                            Discogprahy
                                        </button>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="?page=gallery">
                                        <button
                                            class="gallery btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#home-collapse"
                                            aria-expanded="true">
                                            Gallery
                                        </button>
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a href="?page=videos">
                                        <button
                                            class="video btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#home-collapse"
                                            aria-expanded="true">
                                            Videos
                                        </button>
                                    </a>
                                </li>
                        </div>
                    </div>
                </div>

                <!-- MAIN CONTENT -->
                <div class="col-md-10">
                    <div class="mainContainer card shadow rounded-3 mt-3">
                        Hello World!
                    </div>
                </div>
            </div>
        </div>


        <script src="assets/js/theme.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
            crossorigin="anonymous"></script>
    </body>

    </html>