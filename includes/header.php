<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="header">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <script src="../assets/js/script.js" defer></script>
    <script src="../assets/js/service_worker.js" defer></script>

    <div class="logo">
        <a href="../views/home.php">
            <img src="../assets/images/ww_logo.png" alt="WanderWise Logo">
        </a>
    </div>

    <nav class="navbar">
        <a href="../views/home.php">Home</a>
        <a href="../views/about.php">About</a>
        <a href="../views/packages.php">Packages</a>
        <a href="../views/booking.php">Booking</a>
        <a href="../views/faqs.php">FAQs</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="../views/profile.php">Profile</a>
            <a href="../views/logout.php">Logout</a>
        <?php else: ?>
            <a href="../views/login.php">Login</a>
        <?php endif; ?>
    </nav>

</header>