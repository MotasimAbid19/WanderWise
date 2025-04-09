<?php 
include '../includes/header.php'; 
include('../config/db.php');

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch user data
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Error: User not found.";
        exit();
    }

    // If the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get updated data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $image_path = null; 

        // Validate Username for uniqueness (except for the current user)
        $username_query = "SELECT * FROM users WHERE username = '$username' AND id != '$user_id'";
        $username_result = $conn->query($username_query);

        if ($username_result->num_rows > 0) {
            echo "<script>alert('Username already exists. Please choose a different username.');</script>";
        } else {
            // Password hashing
            if (!empty($password)) {
                $password = password_hash($password, PASSWORD_BCRYPT);
            } else {
                $password = $user['password']; // Retain existing password if no change
            }

            // Profile Picture upload
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $image_name = $_FILES['profile_picture']['name'];
                $image_tmp = $_FILES['profile_picture']['tmp_name'];
                $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $image_new_name = uniqid('profile_', true) . '.' . $image_ext;
                $image_path = "../assets/images/" . $image_new_name;

                if (move_uploaded_file($image_tmp, $image_path)) {
                    // Profile picture upload successful
                } else {
                    echo "Error uploading image.";
                    exit();
                }
            } 

            // Construct the update query based on whether image was uploaded or not
            if ($image_path) {
                $update_query = "UPDATE users SET username='$username', email='$email', first_name='$first_name', last_name='$last_name', profile_picture='$image_new_name', password='$password' WHERE id='$user_id'";
            } else {
                // Update without changing the profile picture
                $update_query = "UPDATE users SET username='$username', email='$email', first_name='$first_name', last_name='$last_name', password='$password' WHERE id='$user_id'";
            }

            // Execute the update query
            if ($conn->query($update_query) === TRUE) {
                echo "<script>window.location.href = 'profile.php';</script>"; // Redirect to profile page after successful update
                exit();
            } else {
                // Output error message if update fails
                echo "Error updating profile: " . $conn->error;
            }
        }
    }
} else {
    header('Location: login.php');
    exit();
}
?>

<link rel="stylesheet" href="../assets/css/update_profile.css">

<section class="update-profile">
    <div class="container">
        <h2>Update Your Profile</h2>
        <p>Update your information below.</p>

        <form id="update-profile-form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password (Leave empty to keep the same):</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>

            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
