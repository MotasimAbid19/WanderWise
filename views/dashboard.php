<?php
// Start the session to access user data
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Display user info
echo "Welcome, " . $_SESSION['username'] . "!";
?>

<!-- User Dashboard Content -->
<a href="logout.php">Logout</a>
