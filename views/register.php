<?php
// Include the database connection
include('../config/db.php');

// Start the session
session_start();

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
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!-- Include the header -->
<?php include('../includes/header.php'); ?>
<link rel="stylesheet" href="../assets/css/register.css">

<!-- Section for Register Page -->
<section class="register-section">
    <div class="container">
        <div class="register-container">
            <div class="register-box">
                <h2>Sign Up</h2>
                <form method="POST" action="register.php" id="register-form">
                    <!-- Error Messages -->
                    <div id="error-messages"></div>

                    <!-- Username -->
                    <div class="input-box">
                        <input type="text" name="username" id="username" placeholder="Username" required>
                    </div>

                    <!-- Email -->
                    <div class="input-box">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </div>

                    <!-- Password -->
                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>

                    <!-- First Name -->
                    <div class="input-box">
                        <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                    </div>

                    <!-- Last Name -->
                    <div class="input-box">
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                    </div>

                    <!-- Phone -->
                    <div class="input-box">
                        <input type="text" name="phone" id="phone" placeholder="Phone Number: +8801XXXXXXXXX" required>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="terms-box">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">By creating an account, you agree to our <a href="terms_and_condition.php">Terms & Conditions</a></label>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-action">
                        <button type="submit" class="btn">Sign Up</button>
                    </div>

                    <!-- Already have an Account? Sign In Link -->
                    <div class="form-links">
                        <p>Already have an account? <a href="login.php">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Include the footer -->
<?php include('../includes/footer.php'); ?>

<script src="../assets/js/validate_register.js" defer></script>
