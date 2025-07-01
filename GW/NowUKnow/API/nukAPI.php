<?php
header("Content-Type: application/json");
include("connectAPI.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($pdo)
{
    try {
        $sql = "SELECT * FROM users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'No users found']);
        } else {
            echo json_encode($result);
        }
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
    }
}

function handlePost($pdo, $input)
{
    // Validate input data
    $requiredFields = ['firstName', 'lastName', 'userName', 'email', 'password', 'birthday', 'userType', 'phoneNumber'];
    $missingFields = array_diff($requiredFields, array_keys($input));

    if (!empty($missingFields)) {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Missing required fields: ' . implode(', ', $missingFields)]);
        return;
    }

    try {
        $sql = "INSERT INTO users (firstName, lastName, userName, email, password, birthday, profilePicture, coverPhoto, userType, phoneNumber) 
                VALUES (:firstName, :lastName, :userName, :email, :password, :birthday, :profilePicture, :coverPhoto, :userType, :phoneNumber)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'firstName' => $input['firstName'],
            'lastName' => $input['lastName'],
            'userName' => $input['userName'],
            'email' => $input['email'],
            'password' => $input['password'],
            'birthday' => $input['birthday'],
            'profilePicture' => $input['profilePicture'] ?? null, // Optional field
            'coverPhoto' => $input['coverPhoto'] ?? null, // Optional field
            'userType' => $input['userType'],
            'phoneNumber' => $input['phoneNumber']
        ]);

        http_response_code(201); // Created
        echo json_encode(['message' => 'User created successfully']);
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
    }
}

function handlePut($pdo, $input)
{
    // Validate input data
    if (!isset($input['id'])) {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'User ID is required']);
        return;
    }

    $requiredFields = ['firstName', 'lastName', 'userName', 'email', 'password', 'birthday', 'userType', 'phoneNumber'];
    $missingFields = array_diff($requiredFields, array_keys($input));

    if (!empty($missingFields)) {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Missing required fields: ' . implode(', ', $missingFields)]);
        return;
    }

    try {
        $sql = "UPDATE users SET
                firstName = :firstName,
                lastName = :lastName,
                userName = :userName,
                email = :email,
                password = :password,
                birthday = :birthday,
                profilePicture = :profilePicture,
                coverPhoto = :coverPhoto,
                userType = :userType,
                phoneNumber = :phoneNumber
                WHERE userID = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'firstName' => $input['firstName'],
            'lastName' => $input['lastName'],
            'userName' => $input['userName'],
            'email' => $input['email'],
            'password' => $input['password'],
            'birthday' => $input['birthday'],
            'profilePicture' => $input['profilePicture'] ?? null, // Optional field
            'coverPhoto' => $input['coverPhoto'] ?? null, // Optional field
            'userType' => $input['userType'],
            'phoneNumber' => $input['phoneNumber'],
            'id' => $input['id']
        ]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'User not found']);
        } else {
            echo json_encode(['message' => 'User updated successfully']);
        }
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
    }
}

function handleDelete($pdo, $input)
{
    // Validate input data
    if (!isset($input['id'])) {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'User ID is required']);
        return;
    }

    try {
        $sql = "DELETE FROM users WHERE userID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $input['id']]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'User not found']);
        } else {
            echo json_encode(['message' => 'User deleted successfully']);
        }
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>