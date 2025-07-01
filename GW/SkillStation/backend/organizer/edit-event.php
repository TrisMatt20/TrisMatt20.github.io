<?php
include("../backend/shared/connect.php");

date_default_timezone_set('Asia/Manila');

if (isset($_GET['eventId'])) {
    $eventId = $_GET['eventId'];

    $eventQuery = "SELECT * FROM events WHERE eventId = '$eventId'";
    $eventResults = executeQuery($eventQuery);

    if (isset($_POST['btnSave'])) {
        // Get submitted values
        $eventName = $_POST['eventName'];
        $eventCategory = $_POST['eventCategory'];
        $eventDescription = $_POST['eventDescription'];
        $eventDate = $_POST['eventDate'];
        $eventTime = $_POST['eventTime'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $eventAddress = $_POST['eventAddress'];
        $eventVenue = $_POST['eventVenue'];

        // Edit event
        $editEvent = "UPDATE events SET name = '$eventName', category = '$eventCategory', description = '$eventDescription', date = '$eventDate', time = '$eventTime', latitude = '$lat', longitude = '$lng', address = '$eventAddress', venue = '$eventVenue'";

        // Check if user uploaded banner
        if ($_FILES['eventBanner']['name']) {
            $eventBanner = $_FILES['eventBanner']['name'];
            $eventBannerTMP = $_FILES['eventBanner']['tmp_name'];
            $eventBannerExt = substr($eventBanner, strripos($eventBanner, '.'));
            $eventBannerName = date("YmdHisu") . $eventBannerExt;

            move_uploaded_file($eventBannerTMP, "../assets/img/events/" . $eventBannerName);

            // Add banner update to query
            $editEvent .= ", image = '$eventBannerName'";
        }

        $editEvent .= " WHERE eventId = '$eventId' AND organizerId = '$organizerId'";
        executeQuery($editEvent);

        header("Location: events-info.php?eventId="  . $eventId);
        exit();
    }
} else {
    header("Location: ./");
    exit();
}

?>