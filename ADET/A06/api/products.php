<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include("connect.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
  case 'POST':
    handlePost($pdo, $input);
    break;
  default:
    echo json_encode(['message' => 'Invalid request method']);
    break;
}

function handlePost($pdo, $input)
{
  $sql = "SELECT * FROM merchandises
          JOIN players
          ON players.playerID = merchandises.playerID
          WHERE type = :type";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['type' => $input['type']]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($result);
}
?>