<?php
// Include Redis connection
include('../predis/redis_connection.php');

// Include database connection
include('../config/db.php');

// Start the session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch users from the database or from Redis cache
$cache_key_users = 'users_list';
$cached_users = $redis->get($cache_key_users);

if ($cached_users) {
    // Data is found in Redis, use the cached data
    $users = json_decode($cached_users, true);
    echo " User Data fetched from Redis cache! ";
} else {
    // Data not found in cache, fetch from the database
    $sql_users = "SELECT * FROM users";
    $result_users = $conn->query($sql_users);
    
    if ($result_users->num_rows > 0) {
        $users = [];
        while ($row = $result_users->fetch_assoc()) {
            $users[] = $row;
        }

        // Store the result in Redis for 1 hour (3600 seconds)
        $redis->setex($cache_key_users, 3600, json_encode($users));
        echo "User Data fetched from the database! ";
    } else {
        echo "<p>No users available. </p>";
    }
}

// Fetch bookings from the database or from Redis cache
$cache_key_bookings = 'bookings_list';
$cached_bookings = $redis->get($cache_key_bookings);

if ($cached_bookings) {
    // Data is found in Redis, use the cached data
    $bookings = json_decode($cached_bookings, true);
    echo "Bookings Data fetched from Redis cache! ";
} else {
    // Data not found in cache, fetch from the database
    $sql_bookings = "SELECT * FROM bookings";
    $result_bookings = $conn->query($sql_bookings);

    if ($result_bookings->num_rows > 0) {
        $bookings = [];
        while ($row = $result_bookings->fetch_assoc()) {
            $bookings[] = $row;
        }

        // Store the result in Redis for 1 hour (3600 seconds)
        $redis->setex($cache_key_bookings, 3600, json_encode($bookings));
        echo "BookingsData fetched from the database! ";
    } else {
        echo "<p>No bookings available. </p>";
    }
}

// Fetch packages from the database or from Redis cache
$cache_key_packages = 'packages_list';
$cached_packages = $redis->get($cache_key_packages);

if ($cached_packages) {
    // Data is found in Redis, use the cached data
    $packages = json_decode($cached_packages, true);
    echo "Packages Data fetched from Redis cache! ";
} else {
    // Data not found in cache, fetch from the database
    $sql_packages = "SELECT * FROM packages";
    $result_packages = $conn->query($sql_packages);

    if ($result_packages->num_rows > 0) {
        $packages = [];
        while ($row = $result_packages->fetch_assoc()) {
            $packages[] = $row;
        }

        // Store the result in Redis for 1 hour (3600 seconds)
        $redis->setex($cache_key_packages, 3600, json_encode($packages));
        echo "Packages Data fetched from the database! ";
    } else {
        echo "<p>No packages available. </p>";
    }
}

// Handle package insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_package'])) {
    $name = $_POST['package_name'];
    $description = $_POST['package_description'];
    $price = $_POST['package_price'];
    $duration = $_POST['package_duration'];
    $location = $_POST['package_location'];
    $image = $_POST['package_image']; 

    $insert_package = "INSERT INTO packages (name, description, price, duration, location, image) 
                       VALUES ('$name', '$description', '$price', '$duration', '$location', '$image')";

    if ($conn->query($insert_package) === TRUE) {
        // Invalidate the packages cache
        $redis->del($cache_key_packages);
        $success_message = "Package added successfully!";
    } else {
        $error_message = "Error adding package: " . $conn->error;
    }
}

// Handle package update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_package'])) {
    $package_id = $_POST['package_id'];
    $name = $_POST['package_name'];
    $description = $_POST['package_description'];
    $price = $_POST['package_price'];
    $duration = $_POST['package_duration'];
    $location = $_POST['package_location'];
    $image = $_POST['package_image'];

    $update_package = "UPDATE packages SET name='$name', description='$description', price='$price', 
                       duration='$duration', location='$location', image='$image' WHERE id='$package_id'";

    if ($conn->query($update_package) === TRUE) {
        // Invalidate the packages cache
        $redis->del($cache_key_packages);
        $success_message = "Package updated successfully!";
    } else {
        $error_message = "Error updating package: " . $conn->error;
    }
}

// Handle package deletion
if (isset($_GET['delete_package'])) {
    $package_id = $_GET['delete_package'];
    $delete_package = "DELETE FROM packages WHERE id='$package_id'";

    if ($conn->query($delete_package) === TRUE) {
        // Invalidate the packages cache
        $redis->del($cache_key_packages);
        $success_message = "Package deleted successfully!";
    } else {
        $error_message = "Error deleting package: " . $conn->error;
    }
}
?>

<!-- Admin Dashboard Content -->
<div class="dashboard-container">

    <!-- Return to Home -->
    <button onclick="window.location.href='../views/home.php'" class="btn-return">Return to Home</button>

    <h2>Admin Dashboard</h2>

    <!-- Display success/error messages -->
    <?php if (isset($success_message)) { echo "<p class='success'>$success_message</p>"; } ?>
    <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>

    <!-- User List -->
    <div class="section">
        <h3>User List</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Booking List -->
    <div class="section">
        <h3>Booking List</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User ID</th>
                    <th>Package ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['package_id']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Package Management -->
    <div class="section">
        <h3>Package Management</h3>

        <!-- Add Package -->
        <h4>Add Package</h4>
        <form method="POST" action="admin_dashboard.php">
            <label for="package_name">Package Name:</label>
            <input type="text" name="package_name" required>

            <label for="package_description">Description:</label>
            <textarea name="package_description" required></textarea>

            <label for="package_price">Price:</label>
            <input type="number" name="package_price" required>

            <label for="package_duration">Duration (days):</label>
            <input type="number" name="package_duration" required>

            <label for="package_location">Location:</label>
            <input type="text" name="package_location" required>

            <label for="package_image">Image Filename:</label>
            <input type="text" name="package_image" required>

            <button type="submit" name="add_package">Add Package</button>
        </form>

        <!-- Update or Delete Existing Packages -->
        <h4>Existing Packages</h4>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Package ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="admin_update_package.php?id=<?php echo $row['id']; ?>">Update</a> |
                            <a href="admin_dashboard.php?delete_package=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Styling for the Dashboard -->
<link rel="stylesheet" href="../assets/css/admin_dashboard.css">
