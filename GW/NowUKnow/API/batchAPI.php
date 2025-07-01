<?php
header("Content-Type: application/json");
include("connectAPI.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handleUpdate($pdo, $input); // Add PUT case for bulk update
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handlePost($pdo, $inputs)
{
    $sql = "INSERT INTO users (firstName, lastName, userName, email, password, birthday, profilePicture, coverPhoto, userType, phoneNumber) 
    VALUES (:firstName, :lastName, :userName, :email, :password, :birthday, :profilePicture, :coverPhoto, :userType, :phoneNumber)";
    foreach ($inputs as $input) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'firstName' => $input['firstName'],
            'lastName' => $input['lastName'],
            'userName' => $input['userName'],
            'email' => $input['email'],
            'password' => $input['password'],
            'birthday' => $input['birthday'],
            'profilePicture' => $input['profilePicture'],
            'coverPhoto' => $input['coverPhoto'],
            'userType' => $input['userType'],
            'phoneNumber' => $input['phoneNumber']
        ]);
    }

    echo json_encode(['message' => 'Users created successfully']);
}

function handleUpdate($pdo, $inputs)
{
    // Debugging: Log the input data
    error_log("Received input data: " . print_r($inputs, true));

    // Start a transaction
    $pdo->beginTransaction();

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

        // Prepare the statement once
        $stmt = $pdo->prepare($sql);

        foreach ($inputs as $input) {
            // Validate input
            $requiredFields = ['id', 'firstName', 'lastName', 'userName', 'email', 'password', 'birthday', 'profilePicture', 'coverPhoto', 'userType', 'phoneNumber'];
            foreach ($requiredFields as $field) {
                if (!array_key_exists($field, $input)) {
                    error_log("Missing field: $field in input: " . print_r($input, true));
                    throw new Exception("Missing required field: $field");
                }
                if (is_string($input[$field]) && trim($input[$field]) === '') {
                    error_log("Empty field: $field in input: " . print_r($input, true));
                    throw new Exception("Empty required field: $field");
                }
            }

            // Execute the statement with the current input
            $stmt->execute([
                'firstName' => $input['firstName'],
                'lastName' => $input['lastName'],
                'userName' => $input['userName'],
                'email' => $input['email'],
                'password' => $input['password'],
                'birthday' => $input['birthday'],
                'profilePicture' => $input['profilePicture'],
                'coverPhoto' => $input['coverPhoto'],
                'userType' => $input['userType'],
                'phoneNumber' => $input['phoneNumber'],
                'id' => $input['id']
            ]);
        }

        // Commit the transaction
        $pdo->commit();

        echo json_encode(['message' => 'Users updated successfully']);
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $pdo->rollBack();
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Update failed: ' . $e->getMessage()]);
    }
}

function handleDelete($pdo, $inputs)
{
    // Debugging: Log the input data
    error_log("Received input data for deletion: " . print_r($inputs, true));

    // Start a transaction
    $pdo->beginTransaction();

    try {
        $sql = "DELETE FROM users WHERE userID = :id";
        $stmt = $pdo->prepare($sql);

        foreach ($inputs as $input) {
            // Ensure the input is an array and contains the 'id' key
            if (!is_array($input) || !isset($input['id'])) {
                error_log("Invalid input format: " . print_r($input, true));
                throw new Exception("Invalid input format: 'id' is missing.");
            }

            // Execute the statement with the current input
            $stmt->execute(['id' => $input['id']]);
        }

        // Commit the transaction
        $pdo->commit();

        echo json_encode(['message' => 'Users deleted successfully']);
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $pdo->rollBack();
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Deletion failed: ' . $e->getMessage()]);
    }
}
?>