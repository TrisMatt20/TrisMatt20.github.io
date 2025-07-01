<?php

session_start();

if (isset($_GET['userID']) && $_GET['userID'] != $_SESSION['userID']) {
    header("Location: login.php");
    exit();
}

include("assets/shared/connect.php");
include("assets/shared/classes.php");
include("assets/shared/post.php");
include("assets/shared/process.php");
$page = "HOME";
include("assets/shared/counter.php");
include("assets/shared/following.php");



if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}


if (isset($_GET['userID']) && !isset($_SESSION['userID'])) {
    $_SESSION['userID'] = $_GET['userID'];
}

$userID = $_SESSION['userID'];

if ($_SESSION['userID'] == "") {
    header("Location: login.php");
}




// Query to get the profile picture
$profileQuery = "SELECT profilePicture FROM users WHERE userID = '$userID'";
$profileResults = mysqli_query($conn, $profileQuery);

if ($profileResults && mysqli_num_rows($profileResults) > 0) {
    $row = mysqli_fetch_assoc($profileResults);

    // Check if the file exists in the directory
    if (!empty($row['profilePicture']) && file_exists("uploadProfile/" . $row['profilePicture'])) {
        $_SESSION['profilePicture'] = $row['profilePicture']; // Use the existing profile picture
    } else {
        $_SESSION['profilePicture'] = 'defaultProfile.png'; // Use the fallback default profile picture
    }
} else {
    $_SESSION['profilePicture'] = 'defaultProfile.png'; // Use the fallback default profile picture
}



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
    <title>NowUKnow | Home</title>
</head>

<style>
    .custom-card {
        width: 100%;
        max-width: auto;
        margin: auto;
        background-color: #C9F6FF;
        border-color: white;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        border-radius: 50px;
        border-color: transparent;
        height: 30px;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: "Helvetica Rounded";
        background-color: #7091E6;
        border-color: transparent;
    }


    .create-post-button {
        position: absolute;
        bottom: 50px;
        right: 50px;
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

    @media (max-width: 1000px) {
        .btn-create {
            position: absolute;
            bottom: 50px;
            right: 25px;
        }

        .btn-create-post {
            width: 50px;
            height: 50px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
            overflow: hidden;
            transition: width 0.3s ease, padding 0.3s ease;
            white-space: nowrap;
            color: white;
        }

        .btn-create-post .button-icon {
            width: 20px;
            height: 20px;
            margin-block-end: 0;
            object-fit: contain;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-create-post .button-text {
            display: none;
            font-size: 14px;
            color: white;
        }

        /* Hover Effect */
        .btn-create-post:hover {
            width: 150px;
            padding: 10px 20px;
            border-radius: 25px;
        }

        .btn-create-post:hover .button-text {
            display: inline;
            margin-left: 8px;
            color: white;
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
            <div class="col-md-6 middle-column p-0">
                <div class="middle-search-bar" style="margin-bottom: 15px;">
                    <form action="search.php" method="GET">
                        <input type="hidden" name="userID" value="<?php echo $_GET['userID'] ?>">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Search..."
                            value="<?php echo isset($_GET['searchTerm']) ? htmlspecialchars($_GET['searchTerm']) : ''; ?>">
                    </form>
                </div>


                <nav class="navbar navbar-expand-md navbar-light bg-light mb-3">
                    <div class="container">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a href="?userID=<?php echo $userID; ?>&tab=foryou"
                                    class="nav-link fw-bold tab <?php echo $activeTab === 'foryou' ? 'active' : ''; ?>">For
                                    You</a>
                            </li>
                            <li class="nav-item">
                                <a href="?userID=<?php echo $userID; ?>&tab=following"
                                    class="nav-link fw-bold tab <?php echo $activeTab === 'following' ? 'active' : ''; ?>">Following</a>
                            </li>
                        </ul>
                    </div>
                </nav>




                <!-- Card for Post -->
                <div class="content">
                    <div class="container">
                        <?php
                        // to determine which tab is clicked
                        $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'foryou'; 

                        if ($activeTab === 'foryou') {
                            // Show posts for "For You" tab (possibly all posts)
                            foreach ($postsList as $postItem) {
                                // Display dynamic posts of users from the database
                                echo $postItem->createPost();
                                // Function to display dynamic modal of each post
                                echo $postItem->showModal();
                                // Function to edit the post
                                echo $postItem->editModal();
                                // Function to delete the post
                                echo $postItem->deleteModal();
                                echo $postItem->userDeleteShowModal();
                                echo $postItem->adminDeletePostModal();
                            }
                        }  else if ($activeTab === 'following') {
                                // Show posts for "Following" tab
                                echo showFollowing();
                                foreach ($postsList as $postItem) {
                                    // Function to display dynamic modal of each post
                                    echo $postItem->showModal();
                                    // Function to edit the post
                                    echo $postItem->editModal();
                                    // Function to delete the post
                                    echo $postItem->deleteModal();
                    }
                }
                        ?>
                    </div>
                </div>
            </div>


            <?php include("assets/components/rightcolumn.php"); ?>


            <!-- Create button for responsiveness -->
            <div class=" responsiveBtn text-center">
                <div class="btn-create create-post-button">
                    <button class="btn-create-post d-flex align-items-center justify-content-center"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="assets/icons/edit.svg" alt="Icon" class="button-icon">
                        <span class="button-text">Create Post</span>
                    </button>
                </div>
            </div>

            <!-- modal create post -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #c9f6ff;">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <div class="card-header d-flex align-items-center p-1" style="border-color: gray;">
                                    <img src="uploadProfile/<?php echo isset($_SESSION['profilePicture']) ? $_SESSION['profilePicture'] : 'default.jpg'; ?>"
                                        class="profile-pic me-1" alt="Profile Picture">

                                    <div>
                                        <h6 class="mb-0 profile-text"><?php echo $_SESSION['userName'] ?></h6>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="title-text form-floating mb-3 p-0">
                                    <input type="text" class="form-control text-wrap"
                                        style="height: 90px; background-color: #ffffff; border-color: #ffffff; border-radius: 15px; "
                                        id="floatingInput" placeholder="Title" name="title">
                                    <label for="floatingInput">Title</label>
                                </div>
                                <div class="body-text form-floating mb-4 p-0" style="height: auto; max-height: 500px;">
                                    <textarea class="form-control"
                                        style="height: 150px; text-align: start; background-color: #ffffff; resize: none; border-radius: 15px;"
                                        id="floatingInput" placeholder="Write something..."
                                        name="description"></textarea>
                                    <label for="floatingInput">Write something...</label>
                                </div>

                                <!-- Attachment -->
                                <div class="card d-flex flex-row justify-content-start align-items-center mx-auto p-3 mb-3"
                                    style="background-color: #e8faff; font-family: 'Helvetica'; border: none; border-radius: 15px;">
                                    <div class="col-12 d-flex flex-row justify-content-start align-items-center ps-1">
                                        <input type="file" id="fileInput" name="fileUpload" class="form-control"
                                            accept=".png, .jpg, .svg" required>
                                    </div>
                                </div>

                                <!-- Submit Button and Dropdown in Footer -->
                                <div class="modal-footer"
                                    style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                    <!-- Dropdown Tags -->
                                    <div class="addTags">
                                        <select name="tags" id="tagsID" required
                                            style="border-radius: 20px; font-family: 'Helvetica'; background-color: #808080; color: white; height: 40px; width: 100%; border: none; text-align: center;">
                                            <option value="" disabled selected>add tag</option>
                                            <?php while ($tagRow = mysqli_fetch_assoc($tagResult)) { ?>
                                                <option value="<?php echo $tagRow['tagID'] ?>"><?php echo $tagRow['tags'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary" name="btnSubmitPost"
                                        style="background-color: #7091e6; padding: 12px 24px; font-size: 20px; border-radius: 25px; height: 42px; width: 150px;">Post</button>
                                </div>
                            </div>
                        </form>
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