<?php
// Start session
session_start();
include('../config/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($query);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password']; // Update password if provided

    // Update user data in the database
    $update_query = "UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE id = '$user_id'";

    if ($conn->query($update_query) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- Profile Update Form -->
<form method="POST" action="profile.php">
    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

    <label for="password">Password:</label>
    <input type="password" name="password" placeholder="Leave blank to keep current password">

    <button type="submit" name="update">Update Profile</button>
</form>
