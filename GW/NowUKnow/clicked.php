<?php
session_start();


if (isset($_GET['userID']) && $_GET['userID'] != $_SESSION['userID']) {
    header("Location: login.php");
    exit();
}

include("assets/shared/connect.php");
include("assets/shared/classes.php");


$tagID = $_GET['tagID'];
$userID = $_SESSION['userID'];



$tagsList = array();

include("assets/shared/process.php");

$tagSelectQuery = "SELECT *, posts.userID AS postUserID, posts.postID AS id FROM users LEFT JOIN posts ON users.userID = posts.userID 
                    LEFT JOIN tags ON posts.tagID = tags.tagID 
                    LEFT JOIN ratings ON posts.postID = ratings.postID 
                    LEFT JOIN comments ON posts.postID = comments.postID 
                    WHERE tags.tagID = $tagID 
                    GROUP BY posts.postID 
                    ORDER BY posts.postID DESC";

$tagSelectQueryResult = executeQuery($tagSelectQuery);


while ($tagRow = mysqli_fetch_assoc($tagSelectQueryResult)) {
    // created class object to fetch data from the database and pass it to the object attributes
    $tagName = $tagRow['tags'];
    $tag = new Post(
        $tagRow['id'],
        $tagRow['title'],
        $tagRow['description'],
        $tagRow['tags'],
        $tagRow['attachment'],
        $tagRow['userName'],
        $tagRow['ratingID'],
        null,
        $tagRow['profilePicture'],
        $tagRow['tagImg'],
        null,
        null,
        $tagRow['postUserID'],
    );

    array_push($tagsList, $tag);

    $_SESSION['postID'] = $tagRow['id'];

}

// working
if (isset($_POST['btnDelete'])) {
    $postID = $_POST['postID'];
    $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
    executeQuery($deleteQuery);
    header("Location: clicked.php?userID=$userID&tagID=$tagID#postID$postID");
    exit();
}

// working
if (isset($_POST['btnEdit'])) {
    $postID = $_POST['postID'];
    $editedTitle = $_POST['editedTitle'];
    $editedDescription = $_POST['editedDescription'];
    $editQuery = "UPDATE posts SET title = '$editedTitle', description = '$editedDescription' WHERE postID = '$postID'";
    executeQuery($editQuery);
    header("Location: clicked.php?userID=$userID&tagID=$tagID#postID$postID");
    exit();
}

// INPUT COMMENT
if (isset($_POST['comment'])) {
    $commentContent = $_POST['comment'];
    $postValue = $_POST['insertPost'];
    $commentQuery = "INSERT INTO `comments`(`content`, `postID`, `userID`) VALUES ('$commentContent','$postValue','$userID')";
    executeQuery($commentQuery);
    header("Location: clicked.php?userID=$userID&tagID=$tagID#postID$postValue");
    exit();
}

// Query for rating post // 

if (isset($_POST['btnRatePost'])) {
    $userID = $_SESSION['userID']; // Get the user ID from the session
    $postID = $_POST['postID'];
    $ratingValue = $_POST['btnRatePost'];

    $checkQuery = "SELECT ratingValue FROM ratings WHERE postID = '$postID' AND userID = '$userID'";
    $ratingResult = mysqli_num_rows(executeQuery($checkQuery)) > 0;

    $ratingQuery = $ratingResult
        ? "UPDATE ratings SET ratingValue = '$ratingValue' WHERE postID = '$postID' AND userID = '$userID'"
        : "INSERT INTO ratings (ratingValue, postID, userID) VALUES ('$ratingValue', '$postID', '$userID')";
    executeQuery($ratingQuery);
    header("Location: clicked.php?userID=$userID&tagID=$tagID#postID$postID");
    exit();

}

// Query for follow user ///

if (isset($_POST['btnFollow'])) {
    $followerID = $_POST['followerID'];
    $followedID = $_POST['followedID'];
    $postID = $_POST['postID'];

    $checkFollowQuery = "SELECT * FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
    $followResult = executeQuery($checkFollowQuery);

    if (mysqli_num_rows($followResult) == 0) {
        $followQuery = "INSERT INTO follows (followerID, followedID) VALUES ('$followerID', '$followedID')";
        executeQuery($followQuery);
        header("Location: clicked.php?userID=$userID&tagID=$tagID#postID$postID");
        exit();
    }
}

if (isset($_POST['btnUnFollow'])) {
    $followerID = $_POST['followerID'];
    $followedID = $_POST['followedID'];
    $postID = $_POST['postID'];

    $unfollowQuery = "DELETE FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
    executeQuery($unfollowQuery);
    header("Location: clicked.php?userID=$userID&tagID=$tagID#postID$postID");
    exit();
    
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

    <title>NowUKnow | <?php echo $tagName ?></title>
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
    }

    .middle-column {
        height: 100vh;
        flex: 2;
        background-color: #ffffff;
        overflow-y: auto;
        overflow-x: hidden;
        padding-top: 0;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
    }

    .middle-column .nav-link {
        font-family: 'Helvetica Rounded', sans-serif;
        font-size: 1.5rem;
        color: #333;
    }

    .navbar {
        border-bottom: 1px solid #35D6ED;
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
    <form action="" method="post">
        <!-- Other form fields -->
        <input type="hidden" name="postID" value="<?php echo $tagRow['id']; ?>">
    </form>

    <div class="container">
        <div class="row">

            <!-- Hamburger Button -->
            <div class="hamburger-btn" onclick="toggleLeftColumn()">&#9776;</div>

            <!-- Left Column -->
            <?php include("assets/components/leftcolumn.php"); ?>


            <!-- Middle Column -->
            <div class="col-md-6 middle-column px-0">

                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <div class="container" style="height:65px">
                        <h5 class="m-0 title-text ms-3" style="font-family:Helvetica-Rounded; letter-spacing:normal">
                            Explore Tags</h5>
                    </div>
                </nav>

                <div class="content">
                    <div class="container">
                        <?php
                        foreach ($tagsList as $tagItem) {
                            // function to display dynamic posts of users from the database
                            echo $tagItem->createPost();
                            echo $tagItem->showModal();

                            echo $tagItem->editModal();
                            // function to delete the post
                            echo $tagItem->deleteModal();

                        }
                        ?>
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