<?php 
include '../includes/header.php'; 
// Fetching user information after checking if user is logged in(from database)
include('../config/db.php');

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Fetch user data
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();
} else {
    header('Location: login.php'); 
    exit();
}
?>

<link rel="stylesheet" href="../assets/css/profile.css">

<section class="profile">
    <div class="container">
        <h2>Your Profile</h2>
        <p>View and manage your profile information below.</p>

        <!-- User Profile -->
        <div class="profile-details">
            <div class="profile-picture">
                <img src="../assets/images/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" loacding="lazy">
            </div>

            <div class="profile-info">
                <table class="profile-table">
                    <tr>
                        <th>Username</th>
                        <td><?php echo $user['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $user['email']; ?></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td><?php echo $user['first_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?php echo $user['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $user['phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>************</td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="update_profile.php" class="btn">Update Profile</a>

        <!-- User's Bookings -->
        <div class="user-bookings">
            <h3>Your Bookings</h3>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Package ID</th>
                        <th>Destination Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch bookings of the user
                    $booking_query = "SELECT * FROM bookings WHERE user_id = '$user_id'";
                    $booking_result = $conn->query($booking_query);

                    if ($booking_result->num_rows > 0) {
                        while ($booking = $booking_result->fetch_assoc()) {
                            $package_query = "SELECT * FROM packages WHERE id = '" . $booking['package_id'] . "'";
                            $package_result = $conn->query($package_query);
                            $package = $package_result->fetch_assoc();

                            echo "<tr>";
                            echo "<td>" . $booking['id'] . "</td>";
                            echo "<td>" . $booking['package_id'] . "</td>";
                            echo "<td>" . $package['name'] . "</td>";
                            echo "<td>BDT " . number_format($booking['total_cost'], 0, '.', ',') . "</td>";
                            echo "<td>" . $booking['status'] . "</td>";
                            echo "<td>" . $booking['payment_status'] . "</td>";
                            
                            // If payment status is pending, show the "Pay Now" button
                            if ($booking['payment_status'] == 'pending') {
                                echo "<td><a href='payment.php?booking_id=" . $booking['id'] . "' class='btn'>Pay Now</a></td>";
                            } else {
                                echo "<td>Paid</td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No bookings found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
