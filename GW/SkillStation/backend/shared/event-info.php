<?php
// Process

include('connect.php');

$eventId = '';
$pageTitle = 'Event Details | SkillStation';

if (isset($_GET['eventId'])) {
    $eventId = $_GET['eventId'];
}
$eventsQuery = "SELECT * FROM events WHERE eventId = $eventId";
$eventResult = executeQuery($eventsQuery);

$suggestedEventsQuery = "SELECT * FROM events ORDER BY eventId DESC LIMIT 4";
$suggestedEventsResult = executeQuery($suggestedEventsQuery);

if ($eventResult && mysqli_num_rows($eventResult) > 0) {
    $eventRow = mysqli_fetch_assoc($eventResult);
    $pageTitle = $eventRow['name'] . ' | SkillStation';

    // Reset the result pointer so we can use it again in the while loop
    mysqli_data_seek($eventResult, 0);
}

// Delete event function
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteEvent'])) {
    $deleteId = $_POST['deleteEventId'];

    // Check if the logged-in organizer owns the event
    $checkQuery = "SELECT organizerId FROM events WHERE eventId = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param("i", $deleteId);
    $stmtCheck->execute();
    $stmtCheck->bind_result($eventOwnerId);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($eventOwnerId != $_SESSION['organizerId']) {
        echo "<script>alert('You are not authorized to delete this event.'); window.location.href='index.php';</script>";
        exit;
    }

    // Use prepared statement for security
    $stmt = $conn->prepare("DELETE FROM events WHERE eventId = ?");
    $stmt->bind_param("i", $deleteId);

    if ($stmt->execute()) {
        echo "<script>alert('Event deleted successfully.'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to delete the event.');</script>";
    }

    $stmt->close();
}

// Get the organizer information
$organizerID = isset($eventRow['organizerId']) ? $eventRow['organizerId'] : null;

$organizerQuery = "SELECT organizerinfo.organizerId, organizerinfo.firstName, organizerinfo.lastName, organizerinfo.contact, organizers.email from organizerinfo INNER JOIN organizers on organizerinfo.organizerId = organizers.organizerId WHERE organizerinfo.organizerId = $organizerID";
$organizerResult = executeQuery($organizerQuery);

?>