<?php
include("../backend/auth/auth.php");
include('../backend/shared/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Archived Events</title>
  <link rel="icon" href="../assets/img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
</head>

<body>
  <!-- Navbar -->
  <?php include '../assets/php/navbar-organizer.php'; ?>

  <!-- Banner -->
  <div class="mb-4">
    <img src="../assets/img/events/archievedBanner.png" class="img-fluid w-100" alt="Archived Events Banner"
      style="max-height: 400px; object-fit: cover;">
  </div>

  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="section-title" style="color: var(--primaryColor);">Archived Events</h2>
      <?php include("../assets/php/archived-sort.php"); ?>
    </div>

    <!-- Cards -->
    <div class="row g-4">
      <?php include("../backend/organizer/archived-list.php"); ?>
    </div>
  </div>

  <!-- Footer -->
  <?php include("../assets/php/footer-organizer.php"); ?>

  <script src="../assets/js/overlay.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
