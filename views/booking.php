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
    $hotel = $_POST['hotel'];  // Hotel selection
    $car_rental = $_POST['car_rental'];  // Car rental selection

    // Get the package details to calculate total cost
    $package_query = "SELECT price, name FROM packages WHERE id = $package_id";
    $package_result = $conn->query($package_query);
    $package = $package_result->fetch_assoc();

    // Calculate the hotel and car rental prices
    $hotel_price = 0;
    switch ($hotel) {
        case '3-star':
            $hotel_price = 8000;
            break;
        case '4-star':
            $hotel_price = 12000;
            break;
        case '5-star':
            $hotel_price = 20000;
            break;
    }

    $car_rental_price = 0;
    switch ($car_rental) {
        case 'Economy':
            $car_rental_price = 10000;
            break;
        case 'Sedan':
            $car_rental_price = 17000;
            break;
        case 'SUV':
            $car_rental_price = 25000;
            break;
    }

    // Calculate total cost: package price + hotel price + car rental price
    $total_cost = ($package['price'] * $number_of_people) + $hotel_price + $car_rental_price;

    // If booking_id is set, update the existing booking
    if (isset($booking_id)) {
        $update_booking = "UPDATE bookings 
                           SET package_id = '$package_id', number_of_people = '$number_of_people', 
                               booking_date = '$travel_date', total_cost = '$total_cost', hotel = '$hotel', car_rental = '$car_rental' 
                           WHERE id = $booking_id";

        if ($conn->query($update_booking) === TRUE) {
            // Redirect to total cost page with booking_id
            header("Location: total_cost.php?booking_id=$booking_id");
            exit();
        } else {
            echo "Error updating booking: " . $conn->error;
        }
    } else {
        // If booking_id is not set, insert a new booking
        $insert_booking = "INSERT INTO bookings (user_id, package_id, number_of_people, booking_date, total_cost, hotel, car_rental)
                           VALUES ('$user_id', '$package_id', '$number_of_people', '$travel_date', '$total_cost', '$hotel', '$car_rental')";
        
        if ($conn->query($insert_booking) === TRUE) {
            $booking_id = $conn->insert_id; // Get the inserted booking ID
            // Redirect to total cost page with booking_id
            header("Location: total_cost.php?booking_id=$booking_id");
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

        <!-- Hotel Selection (Card View) -->
        <h3>Select Your Hotel:</h3>
        <div class="hotel-cards">
            <div class="card">
                <img src="../assets/images/3_star_hotel.png" alt="Hotel 1" loading="lazy">
                <h4>3-Star Hotel</h4>
                <p>Comfortable stay at an affordable price.</p>
                <p>Price: ৳8000</p>
                <input type="radio" name="hotel" value="3-star" <?php echo isset($booking) && $booking['hotel'] == '3-star' ? 'checked' : ''; ?>>
            </div>
            <div class="card">
                <img src="../assets/images/4_star_hotel.png" alt="Hotel 2" loading="lazy">
                <h4>4-Star Hotel</h4>
                <p>Relax in a modern and luxurious setting.</p>
                <p>Price: ৳12000</p>
                <input type="radio" name="hotel" value="4-star" <?php echo isset($booking) && $booking['hotel'] == '4-star' ? 'checked' : ''; ?>>
            </div>
            <div class="card">
                <img src="../assets/images/5_star_hotel.png" alt="Hotel 3" loading="lazy"> 
                <h4>5-Star Hotel</h4>
                <p>Experience premium luxury with top-notch facilities.</p>
                <p>Price: ৳20000</p>
                <input type="radio" name="hotel" value="5-star" <?php echo isset($booking) && $booking['hotel'] == '5-star' ? 'checked' : ''; ?>>
            </div>
        </div>

        <br><br>

        <!-- Car Rental Selection (Card View) -->
        <h3>Select Your Car Rental:</h3>
        <div class="car-cards">
            <div class="card">
                <img src="../assets/images/economic_car.png" alt="Economy Car" loading="lazy">
                <h4>Economy Car</h4>
                <p>Perfect for a quick city trip.</p>
                <p>Price: ৳10000</p>
                <input type="radio" name="car_rental" value="Economy" <?php echo isset($booking) && $booking['car_rental'] == 'Economy' ? 'checked' : ''; ?>>
            </div>
            <div class="card">
                <img src="../assets/images/sedan_car.png" alt="Sedan Car" loading="lazy">
                <h4>Sedan</h4>
                <p>Comfortable for small groups or families.</p>
                <p>Price: ৳17000</p>
                <input type="radio" name="car_rental" value="Sedan" <?php echo isset($booking) && $booking['car_rental'] == 'Sedan' ? 'checked' : ''; ?>>
            </div>
            <div class="card">
                <img src="../assets/images/suv_car.png" alt="SUV Car" loading="lazy">
                <h4>SUV</h4>
                <p>Perfect for large groups or family vacations.</p>
                <p>Price: ৳25000</p>
                <input type="radio" name="car_rental" value="SUV" <?php echo isset($booking) && $booking['car_rental'] == 'SUV' ? 'checked' : ''; ?>>
            </div>
        </div>

        <br><br>

        <!-- Submit Button -->
        <button type="submit"><?php echo isset($booking_id) ? 'Update Booking' : 'View Total Cost'; ?></button>
    </form>

    <br><br>

</div>

<?php
// Include footer
include('../includes/footer.php');
