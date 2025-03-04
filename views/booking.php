<?php include '../includes/header.php'; ?>

<section class="booking-section">
    <div class="container">
        <h2>Book Your Ticket</h2>
        <form action="confirm_booking.php" method="POST">
            <label for="departure">Departure Date:</label>
            <input type="date" id="departure" name="departure" required>

            <label for="passengers">Passengers:</label>
            <input type="number" id="passengers" name="passengers" required>

            <button type="submit">Book Now</button>
        </form>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
