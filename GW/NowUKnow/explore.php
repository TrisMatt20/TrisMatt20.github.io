<?php
session_start();

if (isset($_GET['userID']) && $_GET['userID'] != $_SESSION['userID']) {
    header("Location: login.php");
    exit();
}

include("assets/shared/connect.php");
include("assets/shared/classes.php");



$userID = $_SESSION['userID'];

$tagsQuery = "SELECT *, tags.tagID FROM tags 
              LEFT JOIN posts ON tags.tagID = posts.postID 
              LEFT JOIN users ON posts.userID = users.userID";
$tagsQueryResult = executeQuery($tagsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>NowUKnow | Explore Tag</title>
</head>

<style>
    .navbar {
        border-bottom: 1px solid #35D6ED;
    }

    .card {
        border-radius: 15px !important;
        overflow: hidden;
    }

    .card-img-top {
        border-radius: 15px 15px 0 0 !important;
    }

    .card-body {
        background-color: #81c9ed;
    }

    .card-text {
        font-family: 'Helvetica Rounded', sans-serif;
        font-size: 1rem;
        color: rgb(64, 59, 59);
        text-decoration: none !important;
    }

    @media (max-width: 768px) {
        .card-text {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 1000px) {
        .left-column {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100vh;
            background-color: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            transition: left 0.3s ease;
            z-index: 1;
        }

        .middle-column {
            width: 100%;
        }

        .left-column.show {
            left: 0;
        }
    }

    .hamburger-btn {
        display: block;
        font-size: 18px;
        width: 20px;
        cursor: pointer;
        position: absolute;
        top: 17px;
        left: 1px;
        z-index: 999;
    }

    @media (min-width: 1000px) {
        .hamburger-btn {
            display: none;
        }
    }
</style>

<body>
    <div class="container">
        <div class="row">

            <!-- Hamburger Button -->
            <div class="hamburger-btn" onclick="toggleLeftColumn()">&#9776;</div>

            <!-- Left Column -->
            <?php include("assets/components/leftcolumn.php"); ?>

            <!-- Middle Column -->
            <div class="col-md-9 middle-column px-0">


                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <div class="container" style="height:65px">
                        <h5 class="m-0 title-text ms-3" style="font-family:Helvetica-Rounded; letter-spacing:normal">
                            Explore Tag</h5>
                    </div>
                </nav>


                <div class="content px-3">
                    <div class="container">
                        <!-- Cards for Tags -->
                        <div class="row" id="card-container">
                            <div class="container-fluid">
                                <!-- Cards for Tags -->
                                <div class="row d-flex justify-content-center align-items-center" style=" height: auto;"
                                    id="card-container">
                                    <?php
                                    if (mysqli_num_rows($tagsQueryResult) > 0) {
                                        while ($tagsRow = mysqli_fetch_assoc($tagsQueryResult)) {
                                            ?>
                                            <div class="col-12 col-sm-6 col-lg-4 my-2 d-flex align-items-center">
                                                <a href="clicked.php?userID=<?php echo $userID ?>&tagID=<?php echo $tagsRow['tagID'] ?>"
                                                    class="text-decoration-none">
                                                    <div class="card" style="border: none;">
                                                        <img src="<?php echo $tagsRow['tagImg'] ?>" class="card-img-top"
                                                            alt="<?php echo $tagsRow['tags'] ?>">
                                                        <div class="card-body">
                                                            <p class="card-text text-center"><?php echo $tagsRow['tags'] ?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JS Post -->
        <script src="assets/js/post.js"></script>
        <!-- JS Left column -->
        <script src="assets/js/leftcolumn.js"></script>
        <!-- Bootstrap Script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>