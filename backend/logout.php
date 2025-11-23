<?php
// logout.php - Place in frontend folder
require_once "../backend/auth_session.php";

// Destroy the user session
destroyUserSession();

// Redirect to home page or login page
header("Location: ../frontend/index.php");
exit;
?>