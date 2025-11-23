<?php
require_once "connection.php";
require_once "auth_session.php";

header('Content-Type: application/json');

// Check if user is logged in
if (!isUserLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login to manage favorites']);
    exit;
}

$user = getCurrentUser();
$accountID = $user['id'];

// Handle different actions
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch($action) {
    case 'toggle':
        $dishID = $_POST['dishID'] ?? '';
        
        if (empty($dishID)) {
            echo json_encode(['success' => false, 'message' => 'Dish ID required']);
            exit;
        }
        
        // Check if already favorited
        $checkStmt = $conn->prepare("SELECT * FROM favorites WHERE id = ? AND dishID = ?");
        
        if (!$checkStmt) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
            exit;
        }
        
        $checkStmt->bind_param("ii", $accountID, $dishID);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if ($result->num_rows > 0) {
            // Remove from favorites
            $deleteStmt = $conn->prepare("DELETE FROM favorites WHERE id = ? AND dishID = ?");
            
            if (!$deleteStmt) {
                echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
                exit;
            }
            
            $deleteStmt->bind_param("ii", $accountID, $dishID);
            
            if ($deleteStmt->execute()) {
                echo json_encode(['success' => true, 'action' => 'removed', 'isFavorite' => false]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove favorite: ' . $deleteStmt->error]);
            }
        } else {
            // Add to favorites - FIXED: Removed dateAdded
            $insertStmt = $conn->prepare("INSERT INTO favorites (id, dishID) VALUES (?, ?)");
            
            if (!$insertStmt) {
                echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
                exit;
            }
            
            $insertStmt->bind_param("ii", $accountID, $dishID);
            
            if ($insertStmt->execute()) {
                echo json_encode(['success' => true, 'action' => 'added', 'isFavorite' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add favorite: ' . $insertStmt->error]);
            }
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>