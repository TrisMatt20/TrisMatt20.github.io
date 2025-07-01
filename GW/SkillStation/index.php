<?php
include("backend/auth/logout.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkillStation</title>
    <link rel="icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>
    <?php include 'assets/php/navbar-guest.php'; ?>

    <div class="container-fluid px-0 overflow-hidden">
        <div class="row">
            <div class="col">
                <img src="assets/img/events/image.png" class="img-fluid w-100 d-block">
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-3" style="font-family: var(--heading); color: var(--primaryColor);">Upcoming Events</h2>
            </div>
            <div class="col-md-6 text-md-end d-flex flex-wrap justify-content-md-end gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dateDropdownButton"
                        data-bs-toggle="dropdown">
                        Date
                    </button>
                    <ul class="dropdown-menu" id="dateContainer"></ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="locationDropdownButton"
                        data-bs-toggle="dropdown">
                        Location
                    </button>
                    <ul class="dropdown-menu" id="locationContainer"></ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryDropdownButton"
                        data-bs-toggle="dropdown">
                        Category
                    </button>
                    <ul class="dropdown-menu" id="categoryContainer"></ul>
                </div>
                <input type="text" id="searchInput" class="form-control custom-search"
                    placeholder="Search title or organizer" oninput="searchEvents()" style="max-width: 250px;">
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-3 g-4" id="eventContainer">
        </div>
    </div>

    <?php include 'assets/php/footer-guest.php'; ?>

    <script>
        var eventListPath = 'backend/shared/event-list.php';
        var imagePath = 'assets/img/events/';
        var organizerId = null;
        var showMyEventsOnly = false;
    </script>

    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>