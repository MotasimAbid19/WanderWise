<?php
// Include header
include '../includes/header.php';
include('../config/db.php');

// Check if a search query is submitted
$search_query = '';
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

// Fetch packages from the database with the search filter
$sql = "SELECT * FROM packages WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%' OR location LIKE '%$search_query%'";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../assets/css/packages.css">

<section class="packages">
    <div class="container">
        <h2>Our Travel Packages</h2>
        <p>Choose from our best destinations and start your adventure.</p>

        <!-- Search Form -->
        <form method="POST" action="packages.php">
            <input type="text" name="search" value="<?php echo $search_query; ?>" placeholder="Search packages..." class="search-input">
            <button type="submit" class="search-btn">Search</button>
        </form>

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
                echo '<p>No packages found.</p>';
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
