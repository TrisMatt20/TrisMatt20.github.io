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



// No. of Users
$userCountQuery = "SELECT COUNT(userID) AS userCount FROM users";
$userCountResult = executeQuery($userCountQuery);
$userCount = 0;
while ($userCountRow = mysqli_fetch_assoc($userCountResult)) {
  $userCount = $userCountRow['userCount'];
}

// No. of Posts
$postCountQuery = "SELECT COUNT(postID) AS postCount FROM posts";
$postCountResult = executeQuery($postCountQuery);
$postCount = 0;
while ($postCountRow = mysqli_fetch_assoc($postCountResult)) {
  $postCount = $postCountRow['postCount'];
}

// No. of Visits
$pagesQuery = "SELECT page, COUNT(visitID) AS visitCount FROM visits GROUP BY page";
$pagesResult = executeQuery($pagesQuery);
$pagesCount = 0;
while ($pagesCountRow = mysqli_fetch_assoc($pagesResult)) {
  $pagesCount = $pagesCountRow['visitCount'];
}

// Daily Active User
$weeklyClicksQuery = "SELECT COUNT(visitID), YEAR(dateTime), MONTH(dateTime), DAY(dateTime) FROM visits GROUP BY YEAR(dateTime), MONTH(dateTime), DAY(dateTime) ORDER BY dateTime DESC LIMIT 7";
$weeklyClicksResult = executeQuery($weeklyClicksQuery);

$clicksCount = array();
$clicksDate = array();

while ($clicksRow = mysqli_fetch_assoc($weeklyClicksResult)) {
  array_push($clicksCount, $clicksRow['COUNT(visitID)']);
  array_push($clicksDate, $clicksRow['YEAR(dateTime)'] . "/" . $clicksRow['MONTH(dateTime)'] . "/" . $clicksRow['DAY(dateTime)']);
}

// Ranking of Tags
$rankingTagsQuery = "SELECT tags.tags AS tagName, COUNT(posts.postID) AS postCount FROM tags LEFT JOIN posts ON tags.tagID = posts.tagID GROUP BY tags.tagID ORDER BY postCount DESC";
$rankingTagsResult = executeQuery($rankingTagsQuery);

$chartLabels = array();
$chartData = array();

while ($rankingTagsRow = mysqli_fetch_assoc($rankingTagsResult)) {
  array_push($chartLabels, $rankingTagsRow['tagName']);
  array_push($chartData, $rankingTagsRow['postCount']);
}

// Ranking of Users
$rankingUserQuery = "SELECT AVG(ratingValue) AS averageRating, userName FROM ratings JOIN posts ON posts.postID = ratings.postID JOIN users on posts.userID = users.userID GROUP BY userName ORDER BY AVG(ratingValue) DESC LIMIT 5";
$rankingUserResult = executeQuery($rankingUserQuery);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_post'])) {
  $title = mysqli_real_escape_string($conn, $_POST['post_title']);
  $description = mysqli_real_escape_string($conn, $_POST['post_body']);
  
  // Set isAnnouncement to 'YES' because only admins can access this page
  $isAnnouncement = 'YES';

  // Insert the announcement into the database
  $query = "INSERT INTO posts (title, description, dateUploaded, userID, isAnnouncement) 
            VALUES ('$title', '$description', NOW(), '$userID', '$isAnnouncement')";

  if (mysqli_query($conn, $query)) {
      // Redirect to the announcements page or index.php
      header("Location: index.php");
      exit();
  } else {
      echo "Error: " . mysqli_error($conn);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../assets/icons/favicon.svg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/admin.css">
  <title>NowUKnow | Dashboard</title>
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
    }
  }

  .btnPost {
    color: white;
    width: 100px;
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
</head>

<body>
  <div class="container">
    <div class="row">
      <!-- Hamburger Button -->
      <div class="hamburger-btn" onclick="document.querySelector('.left-column').classList.toggle('show')">&#9776;</div>

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
            <span class="nav-title">Dashboard</span>
          </div>
        </nav>

        <div class="container py-4">
          <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="cardTop redCard">
                <h3 class="cardTitle">No. of Users</h3>
                <div class="cardDivider"></div>
                <h1 class="cardNumber"> <?php echo $userCount ?></h1>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="cardTop goldCard">
                <h3 class="cardTitle">No. of Posts</h3>
                <div class="cardDivider"></div>
                <h1 class="cardNumber"> <?php echo $postCount ?> </h1>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="cardTop greenCard">
                <h3 class="cardTitle">No. of Total Visits</h3>
                <div class="cardDivider"></div>
                <h1 class="cardNumber"> <?php echo $pagesCount; ?></h1>
              </div>
            </div>
          </div>
        </div>


        <!-- Daily Active Users -->
        <div class="dailyActiveUserContainer pt-0">
          <div class="dailyRow">
            <div class="col-12">
              <div class="dailyCard">
                <div class="card-body" style="height:320px;">
                  <div class="dailyCardTitle">
                    <h3>Daily Active Visits</h3>
                  </div>
                  <div class="divider"></div>
                  <div class="dailyCardText">
                    <canvas id="dailyActiveUsers" style="width: 100%; height: auto; margin-left: 10px;"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ranking of Tags and Users -->
        <div class="rankingContainer">
          <div class="row">

            <!-- Ranking of Tags -->
            <div class="col-lg-6 col-md-6 col-12 mt-lg-0 mb-2">
              <div class="rtCard">
                <div class="rtCardBody">
                  <div class="rtCardTitle">
                    <h3>Ranking of Tags</h3>
                  </div>
                  <div class="divider"></div>
                  <div class="rtCardText">
                    <canvas id="rankingTags"
                      style="display: block; box-sizing: border-box; height: auto; width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Ranking of Users -->
            <div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-2">
              <div class="rtCard">
                <div class="rtCardBody">
                  <div class="rtCardTitle">
                    <h3>Ranking of Users</h3>
                  </div>
                  <div class="divider"></div>
                  <div class="table-container">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Rank</th>
                          <th>UserName</th>
                          <th>Average Rating</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (mysqli_num_rows($rankingUserResult) > 0) {
                          $count = 0;
                          while ($rankingUserRow = mysqli_fetch_assoc($rankingUserResult)) {
                            $count += 1;
                            ?>
                            <tr>
                              <td><?php echo $count ?></td>
                              <td><?php echo ($rankingUserRow['userName']); ?></td>
                              <td><?php echo ($rankingUserRow['averageRating']); ?></td>
                            </tr>
                            <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Create button for responsiveness -->
        <div class=" responsiveBtn text-center">
          <div class="btnCreate create-post-button">
            <button class="btn-create-post d-flex align-items-center justify-content-center" data-bs-toggle="modal"
              data-bs-target="#exampleModal">
              <img src="../assets/icons/edit.svg" alt="Icon" class="button-icon">
              <span class="button-text">Create Post</span>
            </button>
          </div>
        </div>
      </div>

      
<!-- Modal for Create Post -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #C9F6FF;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="POST">
                    <!-- Title Input -->

                    <div class="mb-3" style="margin-bottom: 20px;">
                      <label for="floatingInput" class="form-label" style="font-weight: bold; color: #555;">Title</label>
                      <input type="text" name="post_title" class="form-control" required
                          style="width: 100%; border-radius: 15px; border: 1px solid #ddd; padding: 12px; font-size: 1rem; background-color: #fff;">
                  </div>

                    <!-- Body Textarea -->
                    <div class="mb-3" style="margin-bottom: 20px;">
                        <label for="floatingInput" class="form-label" style="font-weight: bold; color: #555;">Write Something...</label>
                        <textarea name="post_body" class="form-control" id="floatingInput" required
                            style="width: 100%; height: 150px; text-align: start; background-color: white; border-radius: 15px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer d-flex justify-content-end">
                      <button type="submit" name="submit_post" class="btnPost btn-primary">Post</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


      <!-- Bootstrap and Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        var chartLabels = <?php echo json_encode($chartLabels); ?>;
        var chartData = <?php echo json_encode($chartData); ?>;
      </script>
      <script src="../assets/js/chart.js"></script>

      <!-- JS Left column -->
      <script src="../assets/js/leftcolumn.js"></script>

      <script>
        const barDailyActiveUsers = document.getElementById('dailyActiveUsers');
        const ctxrankingTags = document.getElementById('rankingTags');

        const clicksLabels = [<?php echo '"' . implode('","', $clicksDate) . '"' ?>];
        const tagsLabels = [<?php echo '"' . implode('","', $chartLabels) . '"' ?>];

        new Chart(barDailyActiveUsers, {
          type: 'bar',
          data: {
            labels: clicksLabels,
            datasets: [{
              label: 'NowUKnow User Logins',
              data: [<?php echo implode(',', $clicksCount) ?>],
              backgroundColor: 'rgba(75, 113, 165, 1)',
              borderColor: 'rgb(114, 145, 184)',
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        new Chart(ctxrankingTags, {
          type: 'bar',
          data: {
            labels: tagsLabels,
            datasets: [{
              data: [<?php echo implode(',', $chartData) ?>],
              backgroundColor: ['#FDB45C', '#46BFBD', '#949FB1', '#4D5360', '#FFC870'],
              hoverBackgroundColor: ['#FFC870', '#5AD3D1', '#A8B3C5', '#616774', '#FFD980']
            }]
          },
          options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: { display: false }
            },
            scales: {
              x: { beginAtZero: true }
            }
          }
        });

      </script>
</body>

</html>