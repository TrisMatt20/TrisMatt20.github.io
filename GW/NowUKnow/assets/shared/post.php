<?php

if (isset($_GET['userID']) && !isset($_SESSION['userID'])) {
    $_SESSION['userID'] = $_GET['userID'];
}

$userID = $_SESSION['userID'];


// array for population of posts
$postsList = array();

// Query for Post
$postQuery = "SELECT 
                posts.userID AS postUserID,
                posts.postID, 
                users.userName, 
                users.profilePicture, 
                posts.title, 
                posts.description, 
                posts.attachment,
                tags.tagID, 
                tags.tags AS tags, 
                ratings.ratingValue AS rating
        FROM users
        LEFT JOIN posts ON users.userID = posts.userID
        LEFT JOIN tags ON posts.tagID = tags.tagID
        LEFT JOIN ratings ON posts.postID = ratings.postID
        WHERE users.userID = posts.userID
        GROUP BY posts.postID 
        ORDER BY posts.postID DESC";

$postResults = executeQuery($postQuery);

while ($postRow = mysqli_fetch_assoc($postResults)) {
    // created class object to fetch data from the database and pass it to the object attributes
    $post = new Post(
        $postRow['postID'],
        $postRow['title'],
        $postRow['description'],
        $postRow['tags'],
        $postRow['attachment'],
        $postRow['userName'],
        $postRow['rating'],
        null,
        $postRow['profilePicture'],
        null,
        null,
        null,
        $postRow['postUserID']

    );

    array_push($postsList, $post);
}

$tagQuery = "SELECT tagID, tags FROM tags";
$tagResult = executeQuery($tagQuery);


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


    header("Location: index.php?userID=$userID");
}
array_push($postsList, $post);


// working
if (isset($_POST['btnDelete'])) {
    $postID = $_POST['postID'];
    $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
    executeQuery($deleteQuery);
    header("Location: index.php?userID=" . $_SESSION['userID']);
    exit();
}

// working
if (isset($_POST['btnEdit'])) {
    $postID = $_POST['postID'];
    $editedTitle = $_POST['editedTitle'];
    $editedDescription = $_POST['editedDescription'];
    $editQuery = "UPDATE posts SET title = '$editedTitle', description = '$editedDescription' WHERE postID = '$postID'";
    executeQuery($editQuery);
    header("Location: index.php?userID=" . $_SESSION['userID'] . "#postID$postID");
    exit();
}

// INPUT COMMENT
if (isset($_POST['comment'])) {
    $commentContent = $_POST['comment'];
    $postValue = $_POST['insertPost'];
    $commentQuery = "INSERT INTO `comments`(`content`, `postID`, `userID`) VALUES ('$commentContent','$postValue','$userID')";
    executeQuery($commentQuery);
    header("Location: index.php?userID= " . $userID . "#postID$postValue");
    exit();
}


// Query for rating post // 

$userID = isset($_POST['userID']) ? $_POST['userID'] : null;
$postID = isset($_POST['postID']) ? $_POST['postID'] : null;
$ratingValue = 0;


$queryCheckRating = "SELECT ratingValue FROM ratings WHERE postID = '$postID' AND userID = '$userID'";
$resultCheck = executeQuery($queryCheckRating);


if ($resultCheck && mysqli_num_rows($resultCheck) > 0) {
    while ($row = mysqli_fetch_assoc($resultCheck)) {
        $ratingValue = $row['ratingValue'];
    }
}
if (isset($_POST['btnRatePost'])) {
    $ratingValue = $_POST['btnRatePost'];

    if (mysqli_num_rows($resultCheck) > 0) {
        $queryRatePost = "UPDATE ratings SET ratingValue = '$ratingValue' WHERE postID = '$postID' AND userID = '$userID'";
        executeQuery($queryRatePost);
    } else {
        $queryRatePost = "INSERT INTO ratings (ratingValue, postID, userID) VALUES ('$ratingValue', '$postID', '$userID')";
        executeQuery($queryRatePost);
    }
    header("Location: index.php?userID=" . $_SESSION['userID'] . "#postID$postID");
    exit();
}
        $queryAvgRating = "SELECT AVG(ratingValue) AS avgRating FROM ratings WHERE postID = '$postID' AND userID = '$userID'";
        $resultAvg = executeQuery($queryAvgRating);
        
    
$avgRating = 0;
if ($resultAvg && mysqli_num_rows($resultAvg) > 0) {
    while ($rowAvg = mysqli_fetch_assoc($resultAvg)) {
        $avgRating = round($rowAvg['avgRating'], 1);
    }
    
}
// Query for follow user ///

if (isset($_POST['btnFollow'])) {
    $followerID = $_POST['followerID'];
    $followedID = $_POST['followedID'];

    $checkFollowQuery = "SELECT * FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
    $followResult = executeQuery($checkFollowQuery);

    if (mysqli_num_rows($followResult) == 0) {
        $followQuery = "INSERT INTO follows (followerID, followedID) VALUES ('$followerID', '$followedID')";
        executeQuery($followQuery);
        header("Location: index.php?userID=" . $_SESSION['userID'] . "#postID$postID");
    exit();
    }
}

if (isset($_POST['btnUnFollow'])) {
    $followerID = $_POST['followerID'];
    $followedID = $_POST['followedID'];

    $unfollowQuery = "DELETE FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
    executeQuery($unfollowQuery);
    header("Location: index.php?userID=" . $_SESSION['userID'] . "#postID$postID");
    exit();
}

?>