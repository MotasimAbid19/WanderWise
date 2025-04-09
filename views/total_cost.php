<?php
// Include header
include('../includes/header.php');
include('../config/db.php');

// Get booking_id from the URL
if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Fetch the booking details
    $sql = "SELECT b.*, p.name AS package_name, p.price, b.hotel, b.car_rental 
            FROM bookings b 
            JOIN packages p ON b.package_id = p.id 
            WHERE b.id = $booking_id";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();

        // Calculate total cost
        $total_cost = $booking['price'] * $booking['number_of_people'];

        // Add hotel price to total cost
        switch ($booking['hotel']) {
            case '3-star':
                $hotel_price = 8000;
                break;
            case '4-star':
                $hotel_price = 12000;
                break;
            case '5-star':
                $hotel_price = 20000;
                break;
            default:
                $hotel_price = 0;
                break;
        }

        // Add car rental price to total cost
        switch ($booking['car_rental']) {
            case 'Economy':
                $car_rental_price = 10000;
                break;
            case 'Sedan':
                $car_rental_price = 17000;
                break;
            case 'SUV':
                $car_rental_price = 25000;
                break;
            default:
                $car_rental_price = 0;
                break;
        }

        // Add hotel and car rental prices to total cost
        $total_cost += $hotel_price + $car_rental_price;

    } else {
        echo "Booking not found.";
        exit;
    }
} else {
    echo "No booking ID provided.";
    exit;
}

// Handle booking confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_booking'])) {
    // Update the booking status to 'confirmed'
    $update_sql = "UPDATE bookings SET status = 'confirmed' WHERE id = $booking_id";

    if ($conn->query($update_sql) === TRUE) {
        // After confirming, redirect the user to the profile page
        header("Location: profile.php"); // Redirect to profile page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<link rel="stylesheet" href="../assets/css/total_cost.css">

<div class="container">
    <h2>Confirm Your Booking</h2>

    <!-- Display Booking Details -->
    <div class="booking-details">
        <h3>Package: <?php echo $booking['package_name']; ?></h3>
        <p><strong>Number of People:</strong> <?php echo $booking['number_of_people']; ?></p>
        <p><strong>Travel Date:</strong> <?php echo $booking['booking_date']; ?></p>

        <p><strong>Hotel:</strong> <?php echo ucfirst($booking['hotel']); ?> (Price: ৳<?php echo number_format($hotel_price, 2); ?>)</p>

        <p><strong>Car Rental:</strong> <?php echo ucfirst($booking['car_rental']); ?> (Price: ৳<?php echo number_format($car_rental_price, 2); ?>)</p>

        <p><strong>Total Cost:</strong> ৳<?php echo number_format($total_cost, 2); ?></p>
    </div>

    <!-- Confirm Purchase Button -->
    <form method="POST" action="total_cost.php?booking_id=<?php echo $booking['id']; ?>">
        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
        <button type="submit" name="confirm_booking" class="btn">Confirm Purchase</button>
    </form>
</div>

<?php
// Include footer
include('../includes/footer.php');
?>
