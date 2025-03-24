<?php
// Include header
include '../includes/header.php';

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'wanderwise_db';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch packages from the database
$sql = "SELECT * FROM packages";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../assets/css/packages.css">

<section class="packages">
    <div class="container">
        <h2>Our Travel Packages</h2>
        <p>Choose from our best destinations and start your adventure.</p>
        
        <div class="package-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="package">';
                    echo '<img src="../assets/images/' . $row['image'] . '" alt="' . $row['name'] . '" class="package-image">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p><strong>Price:</strong> BDT ' . number_format($row['price'], 0, '.', ',') . '</p>';
                    echo '<p><strong>Duration:</strong> ' . $row['duration'] . ' days</p>';
                    echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                    echo '<a href="../views/booking.php?package_id=' . $row['id'] . '" class="btn">Book Now</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No packages available.</p>';
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</section>

<?php
// Include footer
include '../includes/footer.php';
?>
