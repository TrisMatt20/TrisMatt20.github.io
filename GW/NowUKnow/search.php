<?php
session_start();

if (isset($_GET['userID']) && $_GET['userID'] != $_SESSION['userID']) {
    header("Location: login.php");
    exit();
}

include 'assets/shared/connect.php';
include 'assets/shared/classes.php';

$userID = $_GET['userID'];
$usersList = array();
$postsList = array();
include("assets/shared/process.php");


$searchTerm = isset($_GET['searchTerm']) ? mysqli_real_escape_string($conn, $_GET['searchTerm']) : '';

if (!empty($searchTerm)) {
    $userQuery = "
        SELECT 
            userID, 
            userName, 
            firstName, 
            lastName, 
            profilePicture
        FROM users
        WHERE 
            userName LIKE '%$searchTerm%' OR
            firstName LIKE '%$searchTerm%' OR
            lastName LIKE '%$searchTerm%'
        ORDER BY userName ASC;
    ";

    $userResults = executeQuery($userQuery);

    if ($userResults && mysqli_num_rows($userResults) > 0) {
        while ($userRow = mysqli_fetch_assoc($userResults)) {
            $usersList[] = $userRow;
        }
    }

    $postQuery = "SELECT 
            posts.userID AS postUserID,
            posts.postID, 
            users.userName, 
            users.profilePicture, 
            posts.title, 
            posts.description, 
            posts.attachment, 
            tags.tags AS tags, 
            ratings.ratingValue AS rating
        FROM users
        LEFT JOIN posts ON users.userID = posts.userID
        LEFT JOIN tags ON posts.tagID = tags.tagID
        LEFT JOIN ratings ON posts.postID = ratings.postID
        WHERE 
            posts.title LIKE '%$searchTerm%' OR
            posts.description LIKE '%$searchTerm%' OR
            tags.tags LIKE '%$searchTerm%' OR
            users.userName LIKE '%$searchTerm%'
        GROUP BY posts.postID 
        ORDER BY posts.postID DESC;
    ";

    $postResults = executeQuery($postQuery);

    if ($postResults && mysqli_num_rows($postResults) > 0) {
        while ($postRow = mysqli_fetch_assoc($postResults)) {

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

            $postsList[] = $post;
        }
    }

    if (isset($_POST['btnDelete'])) {
        $postID = $_POST['postID'];
        $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
        executeQuery($deleteQuery);
        header("Location: search.php?userID=$userID&searchTerm=$searchTerm#postID$postID");
        exit();
    }

    // working
    if (isset($_POST['btnEdit'])) {
        $postID = $_POST['postID'];
        $editedTitle = $_POST['editedTitle'];
        $editedDescription = $_POST['editedDescription'];
        $editQuery = "UPDATE posts SET title = '$editedTitle', description = '$editedDescription' WHERE postID = '$postID'";
        executeQuery($editQuery);
        header("Location: search.php?userID=$userID&searchTerm=$searchTerm#postID$postID");
        exit();

    }
    // INPUT COMMENT
    if (isset($_POST['comment'])) {
        $commentContent = $_POST['comment'];
        $postValue = $_POST['insertPost'];
        $commentQuery = "INSERT INTO `comments`(`content`, `postID`, `userID`) VALUES ('$commentContent','$postValue','$userID')";
        executeQuery($commentQuery);
        header("Location: search.php?userID=$userID&searchTerm=$searchTerm#postID$postValue");
        exit();
    }
}

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
    header("Location: search.php?userID=$userID&searchTerm=$searchTerm#postID$postID");
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
        header("Location: search.php?userID=$userID&searchTerm=$searchTerm#postID$postID");
        exit();
    }
}

if (isset($_POST['btnUnFollow'])) {
    $followerID = $_POST['followerID'];
    $followedID = $_POST['followedID'];
    $postID = $_POST['postID'];

    $unfollowQuery = "DELETE FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
    executeQuery($unfollowQuery);
    header("Location: search.php?userID=$userID&searchTerm=$searchTerm#postID$postID");
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
    <title>NowUKnow | Search</title>

    <style>
        body {
            overflow-x: hidden !important;
        }

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

        .header-title {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Helvetica Rounded', Helvetica, sans-serif;

        }

        .users-section h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #555;
            font-family: 'Helvetica Rounded', Helvetica, sans-serif;
            text-align: center;
        }

        .user-card {
            display: flex;
            align-items: center;
            background: #C9F6FF;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .user-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .user-info {
            flex-grow: 1;
        }

        .user-info h6 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            font-family: 'Helvetica Rounded', Helvetica, sans-serif;

        }

        .user-info p {
            margin: 0;
            font-size: 14px;
            color: #666;
            font-family: 'Helvetica Rounded', Helvetica, sans-serif;

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
</head>

<body>
    <!-- JS Post -->
    <script src="assets/js/post.js"></script>
    <!-- JS Left column -->
    <script src="assets/js/leftcolumn.js"></script>
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
            <div class="col-md-6 middle-column">
                <div class="middle-search-bar" style="margin-bottom: 15px;">
                    <form action="search.php" method="GET">
                        <input type="hidden" name="userID" value="<?php echo $_GET['userID'] ?>">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Search..."
                            value="<?php echo isset($_GET['searchTerm']) ? htmlspecialchars($_GET['searchTerm']) : ''; ?>">
                    </form>
                </div>
                <div class="container">
                    <div class="header-title mt-3">"<?php echo htmlspecialchars($searchTerm); ?>"</div>
                    <!-- Users Section -->
                    <div class="users-section">
                        <h3 class="header-title text-start">Users</h3>
                        <?php if (!empty($usersList)) { ?>
                            <?php foreach ($usersList as $user) { ?>
                                <div class="user-card">
                                    <img src="uploadProfile/<?php echo htmlspecialchars($user['profilePicture'] ?? 'default.jpg'); ?>"
                                        alt="Profile Picture">
                                    <div class="user-info">
                                        <h6>
                                            <?php echo htmlspecialchars($user['firstName']) . ' ' . htmlspecialchars($user['lastName']); ?>
                                        </h6>
                                        <p>@<?php echo htmlspecialchars($user['userName']); ?></p>
                                    </div>
                                    <?php
                                    $followerID = $_SESSION['userID'];
                                    $followedID = $user['userID'];
                                    $checkFollowQuery = "SELECT * FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
                                    $followResult = executeQuery($checkFollowQuery);
                                    ?>
                                    <?php if ($followerID != $followedID) { // Ensure the logged-in user is not the searched user ?>
                                            <?php if (mysqli_num_rows($followResult) == 0) { ?>
                                                <form method="post">
                                                    <input type="hidden" name="followerID" value="<?php echo $followerID; ?>">
                                                    <input type="hidden" name="followedID" value="<?php echo $followedID; ?>">
                                                    <button type="submit" name="btnFollow"
                                                        class="btn btn-primary follow-btn">Follow</button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post">
                                                    <input type="hidden" name="followerID" value="<?php echo $followerID; ?>">
                                                    <input type="hidden" name="followedID" value="<?php echo $followedID; ?>">
                                                    <button type="submit" name="btnUnFollow"
                                                        class="btn btn-primary follow-btn">Unfollow</button>
                                                </form>
                                            <?php } ?>
                                        <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p>No users found matching "<?php echo htmlspecialchars($searchTerm); ?>"</p>
                        <?php } ?>
                    </div>
                    <!-- Posts Section -->
                    <h3 class="header-title text-start mt-5">Posts</h3>
                    <?php if (!empty($postsList)) { ?>
                        <?php foreach ($postsList as $postItem) { ?>
                            <?php
                            echo $postItem->createPost();
                            echo $postItem->showModal();
                            // Function to edit the post
                            echo $postItem->editModal();
                            // Function to delete the post
                            echo $postItem->deleteModal();

                            ?>
                        <?php } ?>
                    <?php } else { ?>
                        <p>No posts found matching "<?php echo htmlspecialchars($searchTerm); ?>"</p>
                    <?php } ?>
                </div>
            </div>

            <!-- Right Column -->
            <?php include("assets/components/rightcolumn.php"); ?>

        </div>
    </div>

</body>

</html>