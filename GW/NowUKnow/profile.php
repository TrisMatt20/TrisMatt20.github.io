<?php
session_start();

if (isset($_GET['userID']) && $_GET['userID'] != $_SESSION['userID']) {
    header("Location: login.php");
    exit();
}

include("assets/shared/connect.php");
include("assets/shared/classes.php");
include("assets/shared/userPosts.php");

$error = "";

// Ensure the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}
$userID = $_SESSION['userID'];
include("assets/shared/process.php");

// Fetch current user data
$selectQuery = "SELECT * FROM users WHERE userID = '$userID'";
$userResult = mysqli_query($conn, $selectQuery);
$user = mysqli_fetch_assoc($userResult);

//create post query
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
}

//update profile

if (isset($_POST['btnUpdateProfile'])) {
    $updates = []; // Array to store updates
    $userID = (int) $_SESSION['userID'];

    // Process text fields
    if (!empty($_POST['username'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $updates[] = "userName = '$username'";
    }
    if (!empty($_POST['firstname'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $updates[] = "firstName = '$firstname'";
    }
    if (!empty($_POST['lastname'])) {
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $updates[] = "lastName = '$lastname'";
    }
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $updates[] = "email = '$email'";
    }
    if (!empty($_POST['phoneNumber'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $updates[] = "phoneNumber = '$phone'";
    }
    if (!empty($_POST['birthday'])) {
        $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
        $updates[] = "birthday = '$birthday'";
    }
    if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            die("Passwords do not match. Please try again.");
        }
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $updates[] = "password = '$password'";
    }

    // Process file uploads
    $uploadDir = "uploadProfile/";
    if (!empty($_FILES['profilePicture']['name'])) {
        $profilePicture = mysqli_real_escape_string($conn, $_FILES['profilePicture']['name']);
        $profilePictureTmp = $_FILES['profilePicture']['tmp_name'];
        move_uploaded_file($profilePictureTmp, $uploadDir . $profilePicture);
        $updates[] = "profilePicture = '$profilePicture'";
    }
    if (!empty($_FILES['coverPhoto']['name'])) {
        $coverPhoto = mysqli_real_escape_string($conn, $_FILES['coverPhoto']['name']);
        $coverPhotoTmp = $_FILES['coverPhoto']['tmp_name'];
        move_uploaded_file($coverPhotoTmp, $uploadDir . $coverPhoto);
        $updates[] = "coverPhoto = '$coverPhoto'";
    }

    // Execute update query if there are updates
    if (!empty($updates)) {
        $updateQuery = "UPDATE users SET " . implode(', ', $updates) . " WHERE userID = $userID";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Update session data with new values
            $updatedUserQuery = "SELECT * FROM users WHERE userID = $userID";
            $updatedUserResult = mysqli_query($conn, $updatedUserQuery);
            if ($updatedUserResult && mysqli_num_rows($updatedUserResult) > 0) {
                $updatedUser = mysqli_fetch_assoc($updatedUserResult);
                $_SESSION['userName'] = $updatedUser['userName'];
                $_SESSION['firstName'] = $updatedUser['firstName'];
                $_SESSION['lastName'] = $updatedUser['lastName'];
                $_SESSION['email'] = $updatedUser['email'];
                $_SESSION['phoneNumber'] = $updatedUser['phoneNumber'];
                $_SESSION['birthday'] = $updatedUser['birthday'];
                $_SESSION['profilePicture'] = $updatedUser['profilePicture'];
                $_SESSION['coverPhoto'] = $updatedUser['coverPhoto'];
            }
            echo "Profile updated successfully!";
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    } else {
        // No updates made, redirect to profile page
        header("Location: profile.php");
        exit();
    }
}

// Follower count functionality
if (isset($_GET['followedID'])) {
    $followedID = mysqli_real_escape_string($conn, $_GET['followedID']);
} else {
    $followedID = $_SESSION['userID'];
}

$followersQuery = "SELECT COUNT(*) as totalFollowers FROM follows WHERE followedID = '$followedID'";
$followersResult = mysqli_query($conn, $followersQuery);

if ($followersResult) {
    $followersData = mysqli_fetch_assoc($followersResult);
    $totalFollowers = $followersData['totalFollowers'];
} else {
    $totalFollowers = 0;
    echo "Error fetching followers: " . mysqli_error($conn) . "<br>";
}

$followerText = ($totalFollowers === 1) ? "follower" : "followers";

$query = "SELECT * FROM posts WHERE isAnnouncement = 'YES' ORDER BY dateUploaded DESC";
$result = mysqli_query($conn, $query);

// working
if (isset($_POST['btnDelete'])) {
    $postID = $_POST['postID'];
    $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
    executeQuery($deleteQuery);
    header("Location: profile.php?userID=$userID#postID$postID");
    exit();
}

// working
if (isset($_POST['btnEdit'])) {
    $postID = $_POST['postID'];
    $editedTitle = $_POST['editedTitle'];
    $editedDescription = $_POST['editedDescription'];
    $editQuery = "UPDATE posts SET title = '$editedTitle', description = '$editedDescription' WHERE postID = '$postID'";
    executeQuery($editQuery);
    header("Location: profile.php?userID=$userID#postID$postID");
    exit();
}

// INPUT COMMENT
if (isset($_POST['comment'])) {
    $commentContent = $_POST['comment'];
    $postValue = $_POST['insertPost'];
    $commentQuery = "INSERT INTO `comments`(`content`, `postID`, `userID`) VALUES ('$commentContent','$postValue','$userID')";
    executeQuery($commentQuery);
    header("Location: profile.php?userID=$userID#postID$postValue");
    exit();
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

// Query for rating post // 

if (isset($_POST['btnRatePost'])) {
    $userID = $_POST['userID'];
    $postID = $_POST['postID'];
    $ratingValue = $_POST['btnRatePost'];

    $checkQuery = "SELECT ratingValue FROM ratings WHERE postID = $postID AND userID = $userID";
    $ratingResult = mysqli_num_rows(executeQuery($checkQuery)) > 0;

    $ratingQuery = $ratingResult
        ? "UPDATE ratings SET ratingValue = '$ratingValue' WHERE postID = '$postID' AND userID = '$userID'"
        : "INSERT INTO ratings (ratingValue, postID, userID) VALUES ('$ratingValue', '$postID', '$userID')";
    executeQuery($ratingQuery);
    header("Location: profile.php?userID=$userID#postID$postID");
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
        header("Location: profile.php?userID=$userID#postID$postID");
        exit();
    }
}

if (isset($_POST['btnUnFollow'])) {
    $followerID = $_POST['followerID'];
    $followedID = $_POST['followedID'];
    $postID = $_POST['postID'];

    $unfollowQuery = "DELETE FROM follows WHERE followerID = '$followerID' AND followedID = '$followedID'";
    executeQuery($unfollowQuery);
    header("Location: profile.php?userID=$userID#postID$postID");
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

    <title>NowUKnow | Profile</title>
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

    .create-post-button {
        position: absolute;
        bottom: 50px;
        right: 50px;
    }

    @media (max-width: 768px) {
        .profile-dropdown {
            top: 10px;
            right: 20px;
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
            <!-- User Profile -->
            <div class="col-md-6 middle-column">
                <div class="middle-search-bar" style="margin-bottom: 15px;">
                    <form action="search.php" method="GET">
                        <input type="hidden" name="userID" value="<?php echo $_GET['userID'] ?>">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Search..."
                            value="<?php echo isset($_GET['searchTerm']) ? htmlspecialchars($_GET['searchTerm']) : ''; ?>">
                    </form>
                </div>
                <div class="profile-container col-md-12">
                    <div class="profile-section position-relative">
                        <div class="background">
                            <?php
                            $coverPhotoPath = "uploadProfile/" . $user['coverPhoto'];
                            if (file_exists($coverPhotoPath) && !empty($user['coverPhoto'])) {
                                echo '<img src="' . $coverPhotoPath . '" alt="Cover Photo">';
                            } else {
                                echo "<!-- Cover photo not found or missing in database -->";
                                echo "CoverPhoto not found!";
                            }
                            ?>
                        </div>
                        <div class="profile-pic1" style="margin-top: -85px;">
                            <?php
                            $profilePicturePath = "uploadProfile/" . $user['profilePicture'];
                            if (file_exists($profilePicturePath) && !empty($user['profilePicture'])) {
                                echo '<img src="' . $profilePicturePath . '" alt="Profile Picture" style="width: 150px; border-radius: 50%;">';
                            } else {
                                echo "<!-- Profile picture not found or missing in database -->";
                                echo "ProfilePicture not found!";
                            }
                            ?>
                        </div>


                        <div class="prof-edit-delete pt-8 text-end">
                            <div class="dropdown" style="width: 100%;">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="border-radius: 20px; font-family: 'Helvetica Rounded'; border-color: #FFFF; background-color: #FFFF; color: #808080;">
                                    <span class="ellipsis">...</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#editProfileModal">Edit Profile</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteProfileModal">Delete Account</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="profile-info">
                            <div class="profile-data">
                                <!-- Dynamically display user information -->
                                <h1 class="fullname mt-3"><?php echo $user['firstName'] . ' ' . $user['lastName']; ?>
                                </h1>
                                <h2 class="username">@<?php echo $user['userName']; ?></h2>
                                <p><?php echo $totalFollowers; ?> followers</p>
                            </div>
                        </div>
                    </div>
                </div>



                <!--Posts-->
                <div class="posts-section">
                    <h3>User Posts</h3>
                </div>

                <div class="container">

                    <?php
                    // Assuming $postsList is populated correctly earlier in the code
                    if (count($postsList) > 0) {
                        // Loop through the posts list only if there are posts
                        foreach ($postsList as $postItem) {
                            // Display dynamic posts if they exist
                            echo $postItem->createPost();
                            echo $postItem->showModal();
                            echo $postItem->editModal();
                            // function to delete the post
                            echo $postItem->deleteModal();
                            echo $postItem->userDeleteShowModal();
                            echo $postItem->adminDeletePostModal();
                        }
                    } else {
                        // Optionally, you can add a message if no posts exist
                        echo "<p style='    font-family: Helvetica-Rounded; font-size: 16px; color: #333;'>No posts available for this user.</p>";
                    }
                    ?>

                </div>


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
            </div>

            <!-- Right Column -->
            <?php include("assets/components/rightcolumn.php"); ?>

            <!-- Create post modal -->
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


    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #D5E8F9;">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #E7F0F9;">
                    <form id="editProfileForm" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username2">Username</label>
                            <input type="text" class="form-control" id="username2" name="username">
                        </div>
                        <div class="form-group">
                            <label for="firstname2">First Name</label>
                            <input type="text" class="form-control" id="firstname2" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname2">Last Name</label>
                            <input type="text" class="form-control" id="lastname2" name="lastname">
                        </div>
                        <div class="form-group">
                            <label for="email2">Email</label>
                            <input type="email" class="form-control" id="email2" name="email">
                        </div>
                        <div class="form-group">
                            <label for="phone2">Phone Number</label>
                            <input type="text" class="form-control" id="phone2" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="birthday2">Birthday</label>
                            <input type="date" class="form-control" id="birthday2" name="birthday"
                                placeholder="DD/MM/YYYY">
                        </div>
                        <div class="form-group">
                            <label for="password2">New Password</label>
                            <input type="password" class="form-control" id="password2" name="password"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$"
                                title="Password must be at least 8 characters long, contain at least one letter, one number, and one special character (!@#$%^&*).">

                        </div>
                        <div class="form-group">
                            <label for="confirm_password2">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password2" name="confirm_password">
                        </div>
                        <div class="form-group">
                            <label for="profilePicture2">Profile Picture</label>
                            <input type="file" class="form-control" id="profilePicture2" name="profilePicture">
                        </div>
                        <div class="form-group">
                            <label for="coverPhoto2">Cover Photo</label>
                            <input type="file" class="form-control" id="coverPhoto2" name="coverPhoto">
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="background-color: #D5E8F9;">
                    <button type="submit" name="btnUpdateProfile" class="btn btn-primary" form="editProfileForm">Save
                        Changes</button>
                    <button type="button" class="btn btn-primary btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteProfileModal" tabindex="-1" aria-labelledby="deleteProfileModalLabel"
        aria-hidden="true" style="font-family: Helvetica;">
        <div class="modal-dialog">
            <div class="modal-content"
                style="background-color: #C9F6FF; border-radius: 20px; border: none; padding: 20px;">
                <div class="modal-header" style="background-color: transparent; border-bottom: none;">
                    <h5 class="modal-title" id="deleteProfileModalLabel"
                        style="font-family: Helvetica-Rounded; font-size: 1.5rem; color: #333;">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background: none; border: none; font-size: 1.5rem; color: #555; cursor: pointer;">
                    </button>
                </div>
                <div class="modal-body"
                    style="padding: 15px; background-color: #e8faff; border-radius: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; font-family: Helvetica;">
                    <p style="font-size: 1rem; color: #555;">Are you sure you want to delete your account? This action
                        cannot be undone.</p>
                </div>
                <div class="modal-footer"
                    style="padding-top: 15px; border-top: none; display: flex; justify-content: center; gap: 10px;">
                    <button type="button" class="btnCancel" data-bs-dismiss="modal"
                        style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #808080; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        No
                    </button>
                    <!-- Form to handle deletion -->
                    <form action="deleteProfile.php" method="GET" style="display: inline;">
                        <input type="hidden" name="delete_user" value="<?php echo $_SESSION['userID']; ?>">
                        <input type="hidden" name="confirm_delete" value="yes">
                        <button type="submit" class="btnDelete"
                            style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #b23b3b; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                            Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- modal create post -->





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