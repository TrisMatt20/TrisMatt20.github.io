<?php
include("../backend/auth/auth.php");
include("../backend/organizer/edit-event.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Event | SkillStation</title>
    <link rel="icon" href="../assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <style>
        h5 {
            font-weight: bold;
            color: var(--primaryColor);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include("../assets/php/navbar-organizer.php") ?>

    <main class="container">
        <div class="row">
            <div class="col my-5">
                <h2 class="text-center">EDIT EVENT</h2>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-lg-9">
                <div class="card shadow-sm p-3 p-md-4 p-lg-5">
                    <?php
                    if (mysqli_num_rows($eventResults)) {
                        while ($event = mysqli_fetch_assoc($eventResults)) { ?>
                            <form method="POST" enctype="multipart/form-data">
                                <!-- EVENT INFORMATION -->
                                <div class="row">
                                    <h5 class="mt-2">Event Information</h5>

                                    <!-- Event Name -->
                                    <div class="col-12 col-md-7 my-1">
                                        <label for="eventName" class="form-label m-0">Event Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Event Name" id="eventName" name="eventName" value="<?php echo $event['name']?>" required>
                                    </div>

                                    <!-- Event Category -->
                                    <div class="col-12 col-md-5 my-1">
                                        <label for="eventCategory" class="form-label m-0">Event Category</label>
                                        <select class="form-select" id="eventCategory" name="eventCategory" required>
                                            <option <?php echo ($event['category'] == 'Creative & Arts') ? 'selected' : ''; ?> value="Creative & Arts">
                                                Creative & Arts
                                            </option>
                                            <option <?php echo ($event['category'] == 'Tech & Digital Skills') ? 'selected' : ''; ?> value="Tech & Digital Skills">
                                                Tech & Digital Skills
                                            </option>
                                            <option <?php echo ($event['category'] == 'Business & Career Development') ? 'selected' : ''; ?> value="Business & Career Development">
                                                Business & Career Development
                                            </option>
                                            <option <?php echo ($event['category'] == 'Lifestyle & Hobbies') ? 'selected' : ''; ?> value="Lifestyle & Hobbies">
                                                Lifestyle & Hobbies
                                            </option>
                                            <option <?php echo ($event['category'] == 'Academic & Skills Boosters') ? 'selected' : ''; ?> value="Academic & Skills Boosters">
                                                Academic & Skills Boosters
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Event Description -->
                                    <div class="col-12 my-1">
                                        <label for="eventDescription" class="form-label m-0">Event Description</label>
                                        <textarea class="form-control" placeholder="Enter Event Description" id="eventDescription" name="eventDescription" style="height: 150px" required><?php echo $event['description']?></textarea>
                                    </div>

                                    <!-- Event Banner -->
                                    <div class="col-12 my-1">
                                        <label for="eventBanner" class="form-label">Event Banner</label>
                                        <p class="mb-0" style="color: var(--primaryColor)">Choose a new banner:</p>
                                        <input class="form-control" type="file" accept="image/*" id="eventBanner" name="eventBanner" onchange="previewImage()">
                                    </div>

                                    <!-- Image Preview -->
                                    <div class="col-12 my-1" id="previewContainer" style="display: <?php echo ($event['image']) ? 'block' : 'none'; ?>;">
                                        <p class="mb-0" style="color: var(--primaryColor)">Banner Currently in Use:</p>
                                        <div class="card d-flex flex-row justify-content-between align-items-center p-2">
                                            <div class="d-flex flex-row align-items-center">
                                                <img src="../assets/img/events/<?php echo $event['image']?>" class="rounded-3" alt="Image Preview" id="imagePreview" name="imagePreview" style="width: 75px; height: 75px">
                                                <p class="ms-2 mb-0" id="imageName">img.png</p>
                                            </div>
                                            <button class="btn text-danger" type="button" onclick="removeImage()">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- EVENT SCHEDULE -->
                                <div class="row">
                                    <h5 class="mt-2">Event Schedule</h5>

                                    <!-- Event Date -->
                                    <div class="col-12 col-md-6 my-1">
                                        <label for="eventDate" class="form-label m-0">Event Date</label>
                                        <input class="form-control" type="text" onfocus="(this.type='date')" placeholder="Enter Event Date" id="eventDate" name="eventDate" value="<?php echo $event['date']?>" required>
                                    </div>

                                    <!-- Event Time -->
                                    <div class="col-12 col-md-6 my-1">
                                        <label for="eventTime" class="form-label m-0">Event Time</label>
                                        <input class="form-control" type="text" onfocus="(this.type='time')" placeholder="Enter Event Time" id="eventTime" name="eventTime" value="<?php echo $event['time']?>" required>
                                    </div>
                                </div>

                                <!-- EVENT LOCATION -->
                                <div class="row">
                                    <h5 class="mt-2">Event Location</h5>

                                    <!-- Pin Location -->
                                    <div class="col-12 my-1">
                                        <div class="form-label m-0">Click on the map to pin location</div>
                                        <div id="leafletMap" style="height: 300px; border-radius: 15px; margin-bottom: 10px;"></div>
                                        <input type="hidden" id="lat" name="lat" required>
                                        <input type="hidden" id="lng" name="lng" required>
                                    </div>

                                    <!-- Event Address -->
                                    <div class="col-12 my-1">
                                        <label for="eventAddress" class="form-label m-0">Event Address</label>
                                        <input class="form-control" type="text" placeholder="Pin a Location" id="eventAddress" name="eventAddress" readonly required>
                                    </div>

                                    <!-- Event Venue -->
                                    <div class="col-12 my-1">
                                        <label for="eventVenue" class="form-label m-0">Event Venue</label>
                                        <input class="form-control" type="text" placeholder="Enter Venue" id="eventVenue" name="eventVenue" value="<?php echo $event['venue']?>" required>
                                    </div>
                                </div>

                                <!-- SAVE/CANCEL -->
                                <div class="row text-center mt-2">
                                    <div class="col">
                                        <hr>
                                        <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#cancelCreate">Cancel</button>
                                        <button class="btn btn-primary" type="submit" id="btnSave" name="btnSave">Save Event</button>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                    } else { ?>
                        <div class="row">
                            <div class="col-12 text-center p-3">
                                <h3>Event Not Found</h3>
                                <p>The event you're looking for doesn't exist or has been removed.</p>
                                <a href="./" class="btn btn-primary">Back to Home</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <?php include("../assets/php/modals/cancel-create.php") ?>

    <?php include("../assets/php/footer-organizer.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../assets/js/preview.js"></script>
    <script src="../assets/js/location-form.js"></script>
    <script>
        <?php
        mysqli_data_seek($eventResults, 0);

        if (mysqli_num_rows($eventResults)) {
            while ($event = mysqli_fetch_assoc($eventResults)) {
        ?>
                var latitude = <?php echo $event['latitude']; ?>;
                var longitude = <?php echo $event['longitude']; ?>;
                var eventName = "<?php echo addslashes($event['name']); ?>";
                var eventAddress = "<?php echo addslashes($event['address']); ?>";

                renderEventMap(latitude, longitude, eventName, eventAddress, true);
                setCoordinates(latitude, longitude);
                setEventAddress(eventAddress);
            <?php
            }
        }
        ?>
    </script>
</body>

</html>