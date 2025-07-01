<?php
include("../backend/auth/auth.php");
include('../backend/shared/event-info.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle ?></title>
    <link rel="icon" href="../assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>
    <?php include '../assets/php/navbar-organizer.php'; ?>


    <?php if (mysqli_num_rows($eventResult) > 0) {

        $eventData = null;
        while ($eventRow = mysqli_fetch_assoc($eventResult)) {
            $eventData = $eventRow;
            ?>

            <div class="banner position-relative" style="height: 300px">
                <img src="../assets/img/events/<?php echo $eventRow['image'] ?>" alt="banner"
                    class="h-100 position-absolute object-fit-cover" style="width:100%">
                <div class="position-absolute w-100 h-100 banner-overlay">
                </div>
                <div class="container pt-5">
                    <div class="text-overlay text-white position-absolute">
                        <h1 class="title"><?php echo $eventRow['name'] ?></h1>
                        <i><?php echo $eventRow['category'] ?></i>
                        <p class="mt-2"><i class="bi bi-geo-alt-fill"></i><?php echo $eventRow['address'] ?></p>
                        <?php if ($eventRow['organizerId'] == $organizerId) { ?>
                            <a class="btn btn-primary-w px-5" href="edit-event.php?eventId=<?php echo $eventRow['eventId'] ?>"><i
                                    class="bi bi-pencil-square me-2"></i>Edit Event</a>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');"
                                style="display:inline;">
                                <input type="hidden" name="deleteEventId" value="<?php echo $eventRow['eventId']; ?>">
                                <button type="submit" name="deleteEvent" class="btn btn-danger px-5">
                                    <i class="bi bi-trash me-2"></i>Delete Event
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="events-info-h3">Description</h3>
                                <p class="pe-5"><?php echo $eventRow['description'] ?></p>
                            </div>
                            <div class="col-12">
                                <div class="col-8">
                                    <?php

                                    $time24 = $eventRow['time'];
                                    if ($time24) {
                                        $time12 = date('g:i A', strtotime($time24));
                                    } else {
                                        $time12 = 'TBD';
                                    }
                                    ?>
                                    <h3 class="events-info-h3">Event time</h3>
                                    <p class="pe-5">Event Date:
                                        <strong><?php echo date('F j, Y', strtotime($eventRow['date'])) ?></strong><br>Event
                                        Start:
                                        <strong><?php echo $time12; ?></strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-8">
                                    <div class="text-start">
                                        <h3 class="events-info-h3 text-start">Event category</h3>
                                        <h6 class="rounded-5 py-2 px-4 mt-2" style="background: #E8E9EF; display: inline-block">
                                            <?php echo $eventRow['category'] ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-6">
                        <h3 class="events-info-h3"></i>Event Location</h3>
                        <div id="leafletMap" class="mb-3 rounded-4 overflow-hidden"
                            style="height: 400px; border: 1px solid #D5D5D5;"></div>
                        <h5><?php echo $eventRow['address'] ?></h5>
                        <p><?php echo $eventRow['venue'] ?></p>
                    </div>
                </div>

                <hr style="margin-block: 40px">

                <div class="row" style="margin-bottom:40px">
                    <div class="col-12 col-md-6 mt-4 mt-md-0">
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                            <div class="col-8 text-center">
                                <h3 class="events-info-h3 text-center">Share with friends</h3>
                                <div class="card p-0 overflow-hidden">
                                    <img
                                        src="http://api.qrserver.com/v1/create-qr-code/?data=https://localhost/adet-grp-4/events-info.php?eventId=<?php echo $eventRow['eventId'] ?>&size=200x200&margin=40&color=3F51B5&bgcolor=FFFFFF">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h3 class="events-info-h3">Got questions? Contact Organizer</h3>
                        <p>Have questions about this event? We're here to help! Feel free to reach out to our event organizer
                            for any inquiries about registration, event details, special accommodations, or general information.
                            Our team is committed to ensuring you have all the information you need to make the most of your
                            experience. Don't hesitate to contact us - we're excited to hear from you!</p>
                        <?php
                        if (!$organizerResult || mysqli_num_rows($organizerResult) == 0) {
                            echo "<p class='text-danger'>Organizer information not found for ID: $organizerID</p>";
                        } ?>
                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column justify-content-start p-3">
                                <?php if ($organizerResult && mysqli_num_rows($organizerResult) > 0) { ?>
                                    <?php while ($organizerRow = mysqli_fetch_assoc($organizerResult)) { ?>
                                        <h5>Name: <?php echo $organizerRow['firstName'] . ' ' . $organizerRow['lastName']; ?></h5>
                                        <h6 class="mt-3">Email: <?php echo $organizerRow['email']; ?></h6>
                                        <h6 class="mt-3">Contact: <?php echo $organizerRow['contact']; ?></h6>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {

        ?>
        <div class="container my-5">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Event Not Found</h2>
                    <p>The event you're looking for doesn't exist or has been removed.</p>
                    <a href="index.php" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
        <?php
    } ?>

    <div class="recommendations pb-5" style="background:#EDEDED">
        <div class="container py-5">
            <h3 class="events-info-h3 mb-4">Other events you may like</h3>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">

                <?php if (mysqli_num_rows($suggestedEventsResult) > 0) {
                    while ($eventRow = mysqli_fetch_assoc($suggestedEventsResult)) {

                        ?>
                        <div class="col">
                            <div class="card h-100 overflow-hidden">
                                <img src="./../assets/img/events/<?php echo $eventRow['image'] ?>"
                                    class="card-img-top object-fit-cover" style="height: 200px" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title text-truncate"><?php echo $eventRow['name'] ?></h6>
                                    <p class="text-truncate"><?php echo $eventRow['address'] ?></p>
                                    <p style="color:#3F51B5"><?php echo date('F j, Y', strtotime($eventRow['date'])) ?></p>
                                    <a href="events-info.php?eventId=<?php echo $eventRow['eventId'] ?>"
                                        class="btn btn-primary">View details</a>
                                </div>
                            </div>
                        </div>

                    <?php }
                } ?>


            </div>
        </div>
    </div>

    <?php include '../assets/php/footer-organizer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="../assets/js/location-form.js"></script>

    <?php if ($eventData) { ?>
        <script>

            var latitude = <?php echo $eventData['latitude']; ?>;
            var longitude = <?php echo $eventData['longitude']; ?>;
            var eventName = "<?php echo addslashes($eventData['name']); ?>";
            var eventAddress = "<?php echo addslashes($eventData['address']); ?>";

            renderEventMap(latitude, longitude, eventName, eventAddress);
        </script>
    <?php } ?>

</body>

</html>