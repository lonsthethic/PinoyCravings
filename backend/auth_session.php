<?php
// auth_session.php - Place this in your backend folder

// Prevent multiple declarations
if (!function_exists('createUserSession')) {

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to create user session after successful login
function createUserSession($userData) {
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_id'] = $userData['id'];
    $_SESSION['user_email'] = $userData['Email'];
    $_SESSION['user_username'] = $userData['Passwords'];
    $_SESSION['login_time'] = time();
}

// Function to check if user is logged in
function isUserLoggedIn() {
    return isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
}

// Function to get current user data
function getCurrentUser() {
    if (!isUserLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'email' => $_SESSION['user_email'] ?? null,
        'username' => $_SESSION['user_username'] ?? null,
        'login_time' => $_SESSION['login_time'] ?? null
    ];
}

// Function to destroy user session (logout)
function destroyUserSession() {
    session_unset();
    session_destroy();
}

// Function to require login (redirect if not logged in)
function requireLogin($redirectUrl = '../frontend/login.php') {
    if (!isUserLoggedIn()) {
        header("Location: $redirectUrl");
        exit;
    }
}

} // End of function_exists check
?>