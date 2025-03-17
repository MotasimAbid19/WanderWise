<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="header">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">

    <div class="logo">
        <a href="../views/home.php">
            <img src="../assets/images/logo.png" alt="WanderWise Logo">
        </a>
    </div>

    <nav class="navbar">
        <a href="../views/home.php">Home</a>
        <a href="../views/about.php">About</a>
        <a href="../views/packages.php">Packages</a>
        <a href="../views/booking.php">Booking</a>
        <a href="../views/nearby.php">Nearby Facilities</a>
        <a href="../views/faqs.php">FAQs</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Profile and Logout Links if User is Logged In -->
            <a href="../views/profile.php">Profile</a>
            <a href="../views/logout.php">Logout</a>
        <?php else: ?>
            <!-- Login Link if User is Not Logged In -->
            <a href="../views/login.php">Login</a>
        <?php endif; ?>
    </nav>

    <!-- Mobile menu toggle button -->
    <div id="menu-btn" class="fas fa-bars"></div>
</header>
