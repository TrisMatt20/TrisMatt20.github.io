<?php
include("backend/shared/connect.php");

if (!isset($_GET['eventId']) || empty($_GET['eventId'])) {
    header("Location: index.php?error=notfound");
    exit();
}

$eventId = $_GET['eventId'];
$successModal = false;
$eventName;
$eventDate;
$eventTime;
$eventLocation;
$eventBanner;

$eventFormQuery = "SELECT * FROM eventquestions WHERE eventId = '$eventId'";
$eventFormResult = executeQuery($eventFormQuery);

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $name = $firstName . ' ' . $lastName;

    $submitQuery = "INSERT INTO guests (eventId, firstName, lastName, email) VALUES ('$eventId', '$firstName', '$lastName', '$email')";
    $submitResult = executeQuery($submitQuery);

    if ($submitResult) {
        $guestId = $conn->insert_id;
        $eventFormQuery = "SELECT * FROM eventquestions WHERE eventId = '$eventId'";
        $eventFormResult = executeQuery($eventFormQuery);

        while ($eventFormRow = mysqli_fetch_assoc($eventFormResult)) {
            $eventQuestionId = $eventFormRow['eventQuestionId'];
            if (isset($_POST['question_' . $eventQuestionId])) {
                $answer = $_POST['question_' . $eventQuestionId];
                $insertAnswerQuery = "INSERT INTO guestanswers (guestId, eventQuestionId, answerText) VALUES ('$guestId', '$eventQuestionId', '$answer')";
                executeQuery($insertAnswerQuery);
            }
        }

        // SEND EMAIL
        $eventQuery = "SELECT * FROM events WHERE eventId = '$eventId'";
        $eventResult = executeQuery($eventQuery);

        if (mysqli_num_rows($eventResult)) {
            while ($event = mysqli_fetch_assoc($eventResult)) {
                $name = $firstName . ' ' . $lastName;
                $eventName = $event['name'];
                $eventDate = date("F j, Y", strtotime($event['date']));
                $eventTime = date("g:i A", strtotime($event['time']));;
                $eventLocation = $event['venue'] . ', ' . $event['address'];
                $eventBanner = $event['image'];
            }
        }

        include ("mailer.php");
    } else {
        header("Location: ./");
        exit();
    }
}
?>