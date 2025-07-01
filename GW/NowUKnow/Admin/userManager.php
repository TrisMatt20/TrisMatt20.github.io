<?php
session_start();

if (isset($_GET['userID']) && $_GET['userID'] != $_SESSION['userID']) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_SESSION['userID'])) {
    header("Location: ../login.php");
    exit();
}


if (isset($_GET['userID']) && !isset($_SESSION['userID'])) {
    $_SESSION['userID'] = $_GET['userID'];
}


if ($_SESSION['userID'] == "") {
    header("Location: ../login.php");
}

include("../assets/shared/connect.php");
include("../assets/shared/classes.php");

$usersList = array();
$postsList = array();

$searchTerm = isset($_GET['searchTerm']) ? trim(mysqli_real_escape_string($conn, $_GET['searchTerm'])) : '';

if (!empty($searchTerm)) {
    $userQuery = "SELECT 
            userID, 
            userName, 
            firstName, 
            lastName, 
            profilePicture
        FROM users
        WHERE 
            userName LIKE ? OR
            firstName LIKE ? OR
            lastName LIKE ?
        ORDER BY userName ASC";

    if ($stmt = mysqli_prepare($conn, $userQuery)) {
        $searchPattern = "%" . $searchTerm . "%";
        mysqli_stmt_bind_param($stmt, "sss", $searchPattern, $searchPattern, $searchPattern);
        mysqli_stmt_execute($stmt);
        $userResults = mysqli_stmt_get_result($stmt);

        while ($userRow = mysqli_fetch_assoc($userResults)) {
            $usersList[] = $userRow;
        }

        mysqli_stmt_close($stmt);
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
            posts.title LIKE ? OR
            posts.description LIKE ? OR
            tags.tags LIKE ? OR
            users.userName LIKE ?
        ORDER BY posts.postID DESC";

    if ($stmt = mysqli_prepare($conn, $postQuery)) {
        $searchPattern = "%" . $searchTerm . "%";
        mysqli_stmt_bind_param($stmt, "ssss", $searchPattern, $searchPattern, $searchPattern, $searchPattern);
        mysqli_stmt_execute($stmt);
        $postResults = mysqli_stmt_get_result($stmt);

        while ($allRow = mysqli_fetch_assoc($postResults)) {
            $post = new Post(
                $allRow['postID'],
                $allRow['title'],
                $allRow['description'],
                $allRow['tags'],
                $allRow['attachment'],
                $allRow['userName'],
                $allRow['rating'],
                null,
                $allRow['profilePicture'],
                null,
                null,
                null,
                $allRow['postUserID']

            );
            $postsList[] = $post;
        }

        mysqli_stmt_close($stmt);
    }
}

if (isset($_GET['delete_user']) && isset($_GET['confirm_delete'])) {
    $user_id = $_GET['delete_user'];
    $confirm_delete = $_GET['confirm_delete'];

    if ($confirm_delete == 'yes') {
        $delete_query = "DELETE FROM users WHERE userID = ?";
        if ($stmt = mysqli_prepare($conn, $delete_query)) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('User deleted successfully'); window.location.href='userManager.php';</script>";
            } else {
                echo "<script>alert('Error deleting user');</script>";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

if (isset($_POST['btnDelete'])) {
    $postID = $_POST['postID'];
    $deleteQuery = "DELETE FROM posts WHERE postID = '$postID'";
    executeQuery($deleteQuery);
    header("Location: userManager.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/icons/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <title>NowUKnow | User Manager</title>
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

        .logo {
            margin-left: 30px;
        }

        .nav-title {
            margin-left: 35px;
        }
    }

    .hamburger-btn {
        display: block;
        font-size: 25px;
        width: 25px;
        cursor: pointer;
        position: absolute;
        top: 15px;
        left: 15px;
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
            <div class="hamburger-btn" onclick="document.querySelector('.left-column').classList.toggle('show')">&#9776;
            </div>

            <!-- Left Column (Sidebar) -->
            <div class="col-md-3 left-column">
                <div class="logo">
                    <img src="../assets/icons/wordMark big.svg" alt="NowUKnow Logo" width="100" height="100" />
                </div>
                <div class="sidebar">
                    <ul>
                        <li><a href="index.php"><span class="nav-title">Dashboard</span></a></li>
                        <li><a href="userManager.php"><span class="nav-title">User Manager</span></a></li>
                        <li><a href="userList.php"><span class="nav-title">User List</span></a></li>
                    </ul>
                </div>
                <div class="logout-container">
                    <form action="../login.php" method="POST">
                        <button type="submit" class="btn-logout">Log Out</button>
                    </form>
                </div>
            </div>

            <!-- Right -->
            <div class="col-md-9 right-column">
                <nav class="custom-navbar">
                    <div class="container-fluid d-flex align-items-center justify-content-between">
                        <span class="nav-title">User Manager</span>
                        <form method="GET" class="search-form">
                            <div class="input-group rounded-search">
                                <span class="input-group-text search-icon">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="searchTerm" class="form-control search-input"
                                    placeholder="Search users or posts..."
                                    value="<?= htmlspecialchars($searchTerm) ?>" />
                            </div>
                        </form>
                    </div>
                </nav>

                <!-- Users Section -->
                <div class="users-section">
                    <h2>Users</h2>
                    <?php if (count($usersList) > 0): ?>
                        <?php foreach ($usersList as $user): ?>
                            <div class="user-card">
                                <img src="../uploadProfile/<?= htmlspecialchars($user['profilePicture']) ?>"
                                    alt="Profile Picture">
                                <div class="user-info">
                                    <h6><?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?></h6>
                                    <p>@<?= htmlspecialchars($user['userName']) ?></p>
                                </div>
                                <!-- Delete Button triggers the modal -->
                                <button class="btn btn-danger follow-btn" data-bs-toggle="modal"
                                    data-bs-target="#deleteProfileModal<?= $user['userID'] ?>">Delete</button>
                            </div>

                            <!-- Modal for deleting user -->
                            <div class="modal fade" id="deleteProfileModal<?= $user['userID'] ?>" tabindex="-1"
                                aria-labelledby="deleteProfileModalLabel<?= $user['userID'] ?>" aria-hidden="true"
                                style="font-family: Helvetica;">
                                <div class="modal-dialog">
                                    <div class="modal-content"
                                        style="background-color: #C9F6FF; border-radius: 20px; border: none; padding: 20px;">
                                        <div class="modal-header" style="background-color: transparent; border-bottom: none;">
                                            <h5 class="modal-title" id="deleteProfileModalLabel<?= $user['userID'] ?>"
                                                style="font-family: Helvetica Rounded; font-size: 1.5rem; color: #333;">Delete
                                                Account</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                style="background: none; border: none; font-size: 1.5rem; color: #555; cursor: pointer;">
                                            </button>
                                        </div>
                                        <div class="modal-body"
                                            style="padding: 15px; background-color: #e8faff; border-radius: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; font-family: Helvetica;">
                                            <p style="font-size: 1rem; color: #555;font-family: Helvetica">Are you sure you want to delete the account
                                                of
                                                <?= htmlspecialchars($user['firstName']) . ' ' . htmlspecialchars($user['lastName']) ?>?
                                                This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer"
                                            style="padding-top: 15px; border-top: none; display: flex; justify-content: center; gap: 10px;">
                                            <button type="button" class="btnCancel" data-bs-dismiss="modal"
                                                style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #808080; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                Cancel
                                            </button>
                                            <form method="GET" action="" style="display:inline;">
                                                <input type="hidden" name="delete_user" value="<?= $user['userID'] ?>">
                                                <input type="hidden" name="confirm_delete" value="yes">
                                                <button type="submit" class="btnDelete"
                                                    style="border-radius: 25px; font-size: 1rem; padding: 10px; width: 150px; text-align: center; border: none; background-color: #b23b3b; color: #fff; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No users found.</p>
                    <?php endif; ?>
                </div>


                <!-- Posts Section -->
                <div class="posts-section">
                    <h3>Posts</h3>
                    <?php if (!empty($postsList)) { ?>
                        <?php foreach ($postsList as $postItem) { ?>
                            <?php
                            echo $postItem->userDeletePost();
                            echo $postItem->userDeleteShowModal();
                            echo $postItem->adminDeletePostModal();
                            ?>
                        <?php } ?>
                    <?php } else { ?>
                        <p>No posts found matching "<?php echo htmlspecialchars($searchTerm); ?>"</p>
                    <?php } ?>
                </div>

                <!-- JS Post -->
                <script src="../assets/js/post.js"></script>
                <!-- Bootstrap Script -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                    crossorigin="anonymous"></script>
</body>

</html>