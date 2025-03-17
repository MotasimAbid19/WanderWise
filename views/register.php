<?php
// Include the database connection
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];

    // Insert data into the users table
    $query = "INSERT INTO users (username, email, password, first_name, last_name, phone) 
              VALUES ('$username', '$email', '$password', '$first_name', '$last_name', '$phone')";

    // Check if the query was successful
    if ($conn->query($query) === TRUE) {
        // Redirect to login page after successful registration
        header('Location: login.php');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!-- Registration Form -->
<form method="POST" action="register.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" required>

    <button type="submit" name="register">Register</button>
</form>
