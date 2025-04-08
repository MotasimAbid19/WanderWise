<?php
// Include database connection
include('../config/db.php');

// Start the session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Get the package ID from the URL
if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Fetch the package details from the database
    $sql = "SELECT * FROM packages WHERE id = $package_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
    } else {
        echo "Package not found.";
        exit;
    }
} else {
    echo "No package ID provided.";
    exit;
}

// Handle package update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['package_name'];
    $description = $_POST['package_description'];
    $price = $_POST['package_price'];
    $duration = $_POST['package_duration'];
    $location = $_POST['package_location'];
    $image = $_POST['package_image'];

    $update_sql = "UPDATE packages SET name = '$name', description = '$description', price = '$price', 
                   duration = '$duration', location = '$location', image = '$image' WHERE id = $package_id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: admin_dashboard.php"); // Redirect to the admin dashboard
        exit();
    } else {
        echo "Error updating package: " . $conn->error;
    }
}
?>

<!-- Admin Package Update Form -->
<div class="container">
    <h2>Update Package</h2>
    <form method="POST" action="admin_update_package.php?id=<?php echo $package['id']; ?>">
        <label for="package_name">Package Name:</label>
        <input type="text" name="package_name" value="<?php echo $package['name']; ?>" required>

        <label for="package_description">Description:</label>
        <textarea name="package_description" required><?php echo $package['description']; ?></textarea>

        <label for="package_price">Price:</label>
        <input type="number" name="package_price" value="<?php echo $package['price']; ?>" required>

        <label for="package_duration">Duration (days):</label>
        <input type="number" name="package_duration" value="<?php echo $package['duration']; ?>" required>

        <label for="package_location">Location:</label>
        <input type="text" name="package_location" value="<?php echo $package['location']; ?>" required>

        <label for="package_image">Image Filename:</label>
        <input type="text" name="package_image" value="<?php echo $package['image']; ?>" required>

        <button type="submit">Update Package</button>
    </form>
</div>
<link rel="stylesheet" href="../assets/css/admin_update_package.css">