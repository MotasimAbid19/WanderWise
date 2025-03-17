<?php
// Include the database connection
include('../config/db.php');

// Start the session
session_start();

// Initialize error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch the user from the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, start the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the home page (or another page)
            header('Location: home.php');  // Ensure redirection is to the home page or wherever you want
            exit();
        } else {
            // Incorrect password message
            $error_message = "Password is wrong. Please try again.";
        }
    } else {
        // No user found with that email
        $error_message = "No user found with that email.";
    }
}
?>

<!-- Include the header (without session_start here) -->
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

                    <!-- Error Messages (if any) -->
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
            </div>
        </div>
    </div>
</section>

<!-- Include the footer -->
<?php include('../includes/footer.php'); ?>
