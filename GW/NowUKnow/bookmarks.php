<?php
session_start();

if (isset($_GET['userID']) && $_GET['userID'] != $_SESSION['userID']) {
    header("Location: login.php");
    exit();
}

include("assets/shared/connect.php");
include("assets/shared/classes.php");

$userID = $_SESSION['userID'];


include("assets/shared/process.php");

$bookmarkList = array();

//getting query for users
$selectQuery = "SELECT * FROM users WHERE userID = '$userID'";
$userResult = executeQuery($selectQuery);

$tagQuery = "SELECT tagID, tags FROM tags";
$tagResult = executeQuery($tagQuery);

//query for create post modal
if (isset($_POST['btnSubmitPost'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tagID = $_POST['tags'];
    $userID = $_GET['userID'];

    $htmlfileupload = $_FILES['fileUpload']['name'];
    $htmlfileuploadTMP = $_FILES['fileUpload']['tmp_name'];

    // SET THE LOCATION
    $htmlfolder = "uploads/";

    // MOVE THE FILE WITHOUT RENAMING
    move_uploaded_file($htmlfileuploadTMP, $htmlfolder . $htmlfileupload);

    $postQuery = "INSERT INTO posts(title, description, tagID, dateUploaded, attachment, userID) VALUES ('$title', '$description', '$tagID', NOW(), '$htmlfileupload', '$userID')";
    $postResult = executeQuery($postQuery);
}

$bookmarkQuery = "SELECT *, posts.userID AS postUserID,
       (SELECT userName FROM users WHERE users.userID = posts.userID) AS postUserName,
       (SELECT profilePicture FROM users WHERE users.userID = posts.userID) AS postPfp
FROM savedbookmarks 
JOIN posts ON savedbookmarks.postID = posts.postID
JOIN users ON savedbookmarks.userID = users.userID
JOIN tags ON posts.tagID = tags.tagID
WHERE savedbookmarks.userID = $userID
GROUP BY posts.postID 
";



$bookmarkQueryResult = executeQuery($bookmarkQuery);

while ($bookmark = mysqli_fetch_assoc($bookmarkQueryResult)) {
    // created class object to fetch data from the database and pass it to the object attributes
    $bm = new Post(
        $bookmark['postID'],
        $bookmark['title'],
        $bookmark['description'],
        $bookmark['tags'],
        $bookmark['attachment'],
        $bookmark['postUserName'],
        $bookmark['ratingID'],
        null,
        $bookmark['postPfp'],
        null,
        null,
        null,
        $bookmark['postUserID']

    );

    array_push($bookmarkList, $bm);

    $_SESSION['postID'] = $bookmark['postID'];

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

// INPUT COMMENT
if (isset($_POST['comment'])) {
    $commentContent = $_POST['comment'];
    $postValue = $_POST['insertPost'];
    $commentQuery = "INSERT INTO `comments`(`content`, `postID`, `userID`) VALUES ('$commentContent','$postValue','$userID')";
    executeQuery($commentQuery);
    header("Location: bookmarks.php?userID= " . $userID . "#postID$postValue");
    exit();
}

if (isset($_POST['btnDelete'])) {
    $postID = $_POST['postID'];
    $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
    executeQuery($deleteQuery);
    header("Location: bookmarks.php?userID= " . $userID . "#postID$postID");
    exit();
}

// working
if (isset($_POST['btnEdit'])) {
    $postID = $_POST['postID'];
    $editedTitle = $_POST['editedTitle'];
    $editedDescription = $_POST['editedDescription'];
    $editQuery = "UPDATE posts SET title = '$editedTitle', description = '$editedDescription' WHERE postID = '$postID'";
    executeQuery($editQuery);
    header("Location: bookmarks.php?userID= " . $userID . "#postID$postID");
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
    header("Location: bookmarks.php?userID= " . $userID . "#postID$postID");
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
    }
    header("Location: bookmarks.php?userID= " . $userID . "#postID$postID");
    exit();
}

if (isset($_POST['btnUnFollow'])) {
    $followerID = $_POST['followerID'];
    $followedID = $_POST['followedID'];
    $postID = $_POST['postID'];

    $unfollowQuery = "DELETE FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
    executeQuery($unfollowQuery);
    header("Location: bookmarks.php?userID= " . $userID . "#postID$postID");
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
    <title>NowUKnow | Bookmark</title>
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
        <input type="hidden" name="postID" value="<?php echo $bookmark['postID']; ?>">
        <input type="hidden" name="btnRatePost" value="<?php echo $ratingValue; ?>">
    </form>

    <!-- JS Left column -->
    <script src="assets/js/leftcolumn.js"></script>
    <script src="assets/js/post.js"></script>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <div class="container">
        <div class="row">

            <!-- Hamburger Button -->
            <div class="hamburger-btn" onclick="toggleLeftColumn()">&#9776;</div>

            <!-- Left Column -->
            <?php include("assets/components/leftcolumn.php"); ?>

            <!-- Middle Column -->
            <div class="col-12 col-md-6 middle-column p-0">
                <div class="middle-search-bar" style="margin-bottom: 15px;">
                    <form action="search.php" method="GET">
                        <input type="hidden" name="userID" value="<?php echo $_GET['userID'] ?>">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Search..."
                            value="<?php echo isset($_GET['searchTerm']) ? htmlspecialchars($_GET['searchTerm']) : ''; ?>">
                    </form>
                </div>
                <div class="content p-0">
                    <!-- notification title -->
                    <div class="container-fluid p-0">
                        <div class="container-fluid notif-card d-flex justify-content-center align-items-center"
                            style="height: 65px;">
                            <h5 class="m-0 title-text" style="font-family:Helvetica-Rounded; letter-spacing:normal">
                                Bookmarks</h5>
                        </div>

                        <div class="container">
                            <?php
                            foreach ($bookmarkList as $bookmarkItem) {
                                // function to display dynamic posts of users from the database
                                echo $bookmarkItem->createPost();
                                // function to display dynamic modal of each post of users from the database; can add or view of comments
                                echo $bookmarkItem->showModal();

                                echo $bookmarkItem->editModal();
                                // function to delete the post
                                echo $bookmarkItem->deleteModal();
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <?php include("assets/components/rightcolumn.php"); ?>
        </div>
    </div>

</body>


</html>