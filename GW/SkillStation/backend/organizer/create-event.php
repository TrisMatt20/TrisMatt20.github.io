<?php
include("../backend/shared/connect.php");

date_default_timezone_set('Asia/Manila');

if (isset($_POST['btnCreate'])) {
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
    $eventBanner = $_FILES['eventBanner']['name'];
	$eventBannerTMP = $_FILES['eventBanner']['tmp_name'];

    // Rename and store event banner
    $eventBannerExt = substr($eventBanner, strripos($eventBanner, '.'));
	$eventBannerName = date("YmdHisu") . $eventBannerExt;

	move_uploaded_file($eventBannerTMP, "../assets/img/events/" . $eventBannerName);

    // Create event
    $eventDescription = mysqli_real_escape_string($conn, $eventDescription);
	$createEvent = "INSERT INTO events (organizerId, name, category, description, image, date, time, latitude, longitude, address, venue) VALUES ('$organizerId', '$eventName', '$eventCategory', '$eventDescription', '$eventBannerName', '$eventDate', '$eventTime', '$lat', '$lng', '$eventAddress', '$eventVenue')";
	executeQuery($createEvent);

    // Get the last inserted event ID
    $lastInsertedId = mysqli_insert_id($conn);

    // Save each question
    $questionCount = 1;
    while (isset($_POST["question$questionCount"]) && !empty($_POST["question$questionCount"])) {
        $questionText = mysqli_real_escape_string($conn, $_POST["question$questionCount"]);
        $isRequired = isset($_POST["question{$questionCount}Required"]) ? 'yes' : 'no';

        $insertQuestion = "INSERT INTO eventquestions (eventId, question, isRequired)
                           VALUES ('$lastInsertedId', '$questionText', '$isRequired')";
        executeQuery($insertQuestion);
        
        $questionCount++;
    }

    // Redirect to event info page
    header("Location: events-info.php?eventId="  . $lastInsertedId);
    exit();
}

?>