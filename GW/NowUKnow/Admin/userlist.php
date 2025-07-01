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


$searchTerm = isset($_GET['searchTerm']) ? mysqli_real_escape_string($conn, $_GET['searchTerm']) : '';
$listQuery = "SELECT * FROM users WHERE userType = 'user'";

if (!empty($searchTerm)) {
    $listQuery .= " AND (firstName LIKE '%$searchTerm%' OR lastName LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR userName LIKE '%$searchTerm%')";
}

$listQueryResult = executeQuery($listQuery);
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
    <title>NowUKnow | User List</title>
</head>
<style>
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
            font-weight: bold;
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
                        <li><a href="userlist.php"><span class="nav-title">User List</span></a></li>
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
                        <span class="nav-title">User List</span>
                        <form class="search-form" role="search" method="GET">
                            <div class="input-group rounded-search">
                                <span class="input-group-text search-icon">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control search-input" name="searchTerm" placeholder="Search"
                                    aria-label="Search" value="<?php echo isset($_GET['searchTerm']) ? htmlspecialchars($_GET['searchTerm']) : ''; ?>" />
                            </div>
                        </form>
                    </div>
                </nav>

                <div class="content">
                    <div class="row">
                        <div class="col">
                            <div class="card px-3">
                                <div class="table-responsive">
                                    <table class="table table-hover mt-2">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Birth Date</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone No.</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-light">
                                            <?php if (mysqli_num_rows($listQueryResult) > 0) {
                                                while ($listRow = mysqli_fetch_assoc($listQueryResult)) { ?>
                                                    <tr>
                                                        <td><?php echo $listRow['firstName'] . ' ' . $listRow['lastName']; ?></td>
                                                        <td><?php echo $listRow['userName']; ?></td>
                                                        <td><?php echo $listRow['birthday']; ?></td>
                                                        <td><?php echo $listRow['email']; ?></td>
                                                        <td><?php echo $listRow['phoneNumber']; ?></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No users found.</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>