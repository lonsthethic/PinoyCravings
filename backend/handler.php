<?php
// favorites_handler.php - Place this in your backend folder
include "connection.php";
include "auth_session.php";

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
        $checkStmt = $conn->prepare("SELECT * FROM favorites WHERE accountID = ? AND dishID = ?");
        $checkStmt->bind_param("is", $accountID, $dishID);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if ($result->num_rows > 0) {
            // Remove from favorites
            $deleteStmt = $conn->prepare("DELETE FROM favorites WHERE accountID = ? AND dishID = ?");
            $deleteStmt->bind_param("is", $accountID, $dishID);
            
            if ($deleteStmt->execute()) {
                echo json_encode(['success' => true, 'action' => 'removed', 'isFavorite' => false]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove favorite']);
            }
        } else {
            // Add to favorites
            $insertStmt = $conn->prepare("INSERT INTO favorites (accountID, dishID, dateAdded) VALUES (?, ?, NOW())");
            $insertStmt->bind_param("is", $accountID, $dishID);
            
            if ($insertStmt->execute()) {
                echo json_encode(['success' => true, 'action' => 'added', 'isFavorite' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add favorite']);
            }
        }
        break;
        
    case 'check':
        $dishID = $_GET['dishID'] ?? '';
        
        if (empty($dishID)) {
            echo json_encode(['success' => false, 'message' => 'Dish ID required']);
            exit;
        }
        
        $checkStmt = $conn->prepare("SELECT * FROM favorites WHERE accountID = ? AND dishID = ?");
        $checkStmt->bind_param("is", $accountID, $dishID);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        echo json_encode(['success' => true, 'isFavorite' => $result->num_rows > 0]);
        break;
        
    case 'list':
        $stmt = $conn->prepare("
            SELECT d.dishID, d.title, d.img, d.description, f.dateAdded
            FROM favorites f
            INNER JOIN dish d ON f.dishID = d.dishID
            WHERE f.id = ?
            ORDER BY f.dateAdded DESC
        ");
        $stmt->bind_param("i", $accountID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $favorites = [];
        while ($row = $result->fetch_assoc()) {
            $favorites[] = $row;
        }
        
        echo json_encode(['success' => true, 'favorites' => $favorites]);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>