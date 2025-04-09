<?php
include('../includes/header.php');


// Check if the admin is already logged in
//if (isset($_SESSION['admin_logged_in'])) {
//    header("Location: admin_dashboard.php");
//    exit();
// Initialize variables to avoid warnings

$username = '';
$password = '';
$error_message = '';

// Handle form submission for admin login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use isset() to check if 'username' and 'password' are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hardcoded admin credentials
        $correct_username = 'admin';
        $correct_password = 'adminpassword';

        // Check if the entered username and password match the hardcoded ones
        if ($username === $correct_username && $password === $correct_password) {
            // Set session variable to indicate admin is logged in
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}
?>

<link rel="stylesheet" href="../assets/css/admin_login.css">

<div class="container">
    <h2>Admin Login</h2>
    <form method="POST" action="admin_login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <?php if (!empty($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>

        <button type="submit">Login</button>
    </form>
</div>

<?php
include('../includes/footer.php');
?>
