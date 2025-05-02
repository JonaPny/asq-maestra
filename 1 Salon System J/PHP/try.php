<?php
// At the top of your index.php file
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get user data from database
$userId = $_SESSION['user_id'];
// Connect to database and fetch user data
// ...

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    // Update user data in database
    // ...
    
    // Redirect to prevent form resubmission
    header('Location: index.php?success=profile_updated');
    exit;
}
?>