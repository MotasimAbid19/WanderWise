<?php
// Include header
include('../includes/header.php');
include('../config/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in first.";
    exit();
}

$user_id = $_SESSION['user_id']; // Fetch the logged-in user's ID

// Fetch all packages from the database
$sql = "SELECT * FROM packages";
$result = $conn->query($sql);

// Check if a booking_id is passed (for updating)
if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Fetch the existing booking details
    $sql_booking = "SELECT * FROM bookings WHERE id = $booking_id";
    $booking_result = $conn->query($sql_booking);

    if ($booking_result->num_rows > 0) {
        $booking = $booking_result->fetch_assoc();
    } else {
        echo "Booking not found.";
        exit;
    }
}

// Handle form submission to update or create booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_id = $_POST['package_id'];
    $number_of_people = $_POST['number_of_people'];
    $travel_date = $_POST['travel_date'];

    // Get the package details to calculate total cost
    $package_query = "SELECT price, name FROM packages WHERE id = $package_id";
    $package_result = $conn->query($package_query);
    $package = $package_result->fetch_assoc();
    $total_cost = $package['price'] * $number_of_people;

    if (isset($booking_id)) {
        // If booking_id is set, update the existing booking
        $update_booking = "UPDATE bookings 
                           SET package_id = '$package_id', number_of_people = '$number_of_people', 
                               booking_date = '$travel_date', total_cost = '$total_cost' 
                           WHERE id = $booking_id";
        if ($conn->query($update_booking) === TRUE) {
            header("Location: total_cost.php?booking_id=$booking_id"); // Redirect to total cost page
            exit();
        } else {
            echo "Error updating booking: " . $conn->error;
        }
    } else {
        // If booking_id is not set, insert a new booking
        $insert_booking = "INSERT INTO bookings (user_id, package_id, number_of_people, booking_date, total_cost)
                           VALUES ('$user_id', '$package_id', '$number_of_people', '$travel_date', '$total_cost')";
        if ($conn->query($insert_booking) === TRUE) {
            $booking_id = $conn->insert_id; // Get the inserted booking ID
            header("Location: total_cost.php?booking_id=$booking_id"); // Redirect to total cost page
            exit();
        } else {
            echo "Error inserting booking: " . $conn->error;
        }
    }
}
?>

<link rel="stylesheet" href="../assets/css/booking.css">

<div class="container">
    <h2><?php echo isset($booking_id) ? 'Update Your Booking' : 'Book Your Travel'; ?></h2>

    <!-- Package list -->
    <form method="POST" action="booking.php<?php echo isset($booking_id) ? '?booking_id=' . $booking_id : ''; ?>">
        <label for="package_id">Select Package:</label>
        <select name="package_id" id="package_id" required>
            <?php while ($package = $result->fetch_assoc()) { ?>
                <option value="<?php echo $package['id']; ?>" 
                        <?php echo isset($booking) && $booking['package_id'] == $package['id'] ? 'selected' : ''; ?>>
                    <?php echo $package['name']; ?>
                </option>
            <?php } ?>
        </select>

        <br><br>

        <!-- Number of people -->
        <label for="number_of_people">Number of People:</label>
        <input type="number" name="number_of_people" id="number_of_people" value="<?php echo isset($booking) ? $booking['number_of_people'] : 1; ?>" min="1" required>

        <br><br>

        <!-- Travel Date -->
        <label for="travel_date">Travel Date:</label>
        <input type="date" name="travel_date" id="travel_date" value="<?php echo isset($booking) ? $booking['booking_date'] : ''; ?>" required>

        <br><br>
            <!-- Nearby Facilities Button -->
        <a href="nearby_facilities.php" class="btn">Add Nearby Facilities</a>

        <!-- Submit Button -->
        <button type="submit"><?php echo isset($booking_id) ? 'Update Booking' : 'View Total Cost'; ?></button>
    </form>

    <br><br>



</div>

<?php
// Include footer
include('../includes/footer.php');
?>
