<?php
include('../config/db.php');

session_start();

// Initialize error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Get the password from the form
        $password = $_POST['password'];

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute the prepared statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, verify the password
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, start the session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                
                header('Location: home.php');  
                exit();
            } else {
                $error_message = "Password is wrong. Please try again.";
            }
        } else {
            $error_message = "No user found with that email.";
        }

        // Close the prepared statement
        $stmt->close();
    }
}
?>

<?php include('../includes/header.php'); ?>
<link rel="stylesheet" href="../assets/css/login.css">

<!-- Section for Login Page -->
<section class="login-section">
    <div class="container">
        <div class="login-container">
            <div class="login-box">
                <h2>Sign In</h2>
                <form method="POST" action="login.php">
                    <!-- Email -->
                    <div class="input-box">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </div>

                    <!-- Password -->
                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>

                    <!-- Error Messages-->
                    <?php if ($error_message != '') { ?>
                        <div class="error-message">
                            <p style="color: red;"><?php echo $error_message; ?></p>
                        </div>
                    <?php } ?>

                    <!-- Submit Button -->
                    <div class="form-action">
                        <button type="submit" class="btn">Sign In</button>
                    </div>

                    <!-- Forgot Password & Sign Up Links -->
                    <div class="form-links">
                        <a href="#">Forgot Password?</a>
                        <p>Don't have an Account? <a href="register.php">Sign Up</a></p>
                    </div>
                </form>

                <!-- Admin Button -->
                <div class="admin-action">
                    <a href="admin_login.php" class="btn-admin">Admin</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include the footer -->
<?php include('../includes/footer.php'); ?>
