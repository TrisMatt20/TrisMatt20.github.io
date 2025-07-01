<?php
header('Content-Type: application/json');

include('connect.php');

$eventQuery = "SELECT 
    e.eventId,
    e.name AS title,  
    CONCAT(e.venue, ', ', e.address) AS location, 
    e.address,
    e.category, 
    DATE_FORMAT(e.date, '%M %d, %Y') AS date, 
    e.image,
    e.organizerId,
    o.username AS organizer
FROM events e
JOIN organizers o ON e.organizerId = o.organizerId
WHERE e.date >= CURDATE()";

$eventResult = executeQuery($eventQuery);

$events = [];

if ($eventResult) {
    while ($row = mysqli_fetch_assoc($eventResult)) {
        $events[] = $row;
    }
}
echo json_encode($events);
?>