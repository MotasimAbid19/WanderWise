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
            <a href="../views/profile.php">Profile</a>
            <a href="../views/logout.php">Logout</a>
        <?php else: ?>
            <a href="../views/login.php">Login</a>
        <?php endif; ?>
    </nav>

    <!-- Mobile menu toggle button -->
    <div id="menu-btn" class="fas fa-bars"></div>
</header>


<!-- Mobile Menu JavaScript -->
<script>
    // Get the mobile menu button and the navbar
    const menuBtn = document.getElementById('menu-btn');
    const navbar = document.querySelector('.header .navbar');

    // Toggle the navbar when the menu button is clicked
    menuBtn.onclick = () => {
        menuBtn.classList.toggle('fa-times');  // Change icon to "X" on click
        navbar.classList.toggle('active');  // Show the navbar
    };

    // Close navbar when scrolling (for mobile view)
    window.onscroll = () => {
        menuBtn.classList.remove('fa-times'); // Reset icon
        navbar.classList.remove('active'); // Hide navbar
    };
</script>
