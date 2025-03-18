<?php
// Include database connection
include('../config/db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if (isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password if it's provided

    // Update the user details in the database
    $query = "UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE id = '$user_id'";

    if ($conn->query($query) === TRUE) {
        // Redirect to profile page after successful update
        header('Location: profile.php');
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>
