<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/home.css">

<!-- Home Video Section -->
<section class="home-video">
    <video autoplay muted loop class="banner-video">
        <source src="../assets/images/home-banner.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<!-- Home Banner Section (Moved Below Video) -->
<section class="home-banner">
    <div class="banner">
        <h1>Explore The World with <span>WanderWise</span></h1>
        <p>Your one-stop travel companion for seamless journeys.</p>
        <a href="../views/packages.php" class="btn">Explore Packages</a>
    </div>
</section>

<!-- Packages Section -->
<section class="packages">
    <div class="container">
        <h2>Our Packages</h2>
        <p>Discover exciting travel destinations with our exclusive offers.</p>
        <div class="package-list">
            <!-- Thailand -->
            <div class="package">
                <img src="../assets/images/thailand.jpg" alt="Thailand">
                <h3>Thailand (Bangkok, Pattaya, Phuket)</h3>
                <p><strong>Approx Cost:</strong> BDT 70,000 – 1,20,000</p>
            </div>

            <!-- Malaysia -->
            <div class="package">
                <img src="../assets/images/malaysia.jpg" alt="Malaysia">
                <h3>Malaysia (Kuala Lumpur, Langkawi, Penang)</h3>
                <p><strong>Approx Cost:</strong> BDT 60,000 – 1,00,000</p>
            </div>

            <!-- Indonesia -->
            <div class="package">
                <img src="../assets/images/indonesia.jpg" alt="Indonesia">
                <h3>Indonesia (Bali, Jakarta)</h3>
                <p><strong>Approx Cost:</strong> BDT 1,00,000 – 1,50,000</p>
            </div>
        </div>
        <a href="../views/packages.php" class="btn">See More Packages</a>
    </div>
</section>

<!-- Nearby Facilities Section -->
<section class="facilities">
    <div class="container">
        <h2>Nearby Facilities</h2>
        <p>Find the best services near your destination.</p>
        <ul>
            <li><a href="../views/rental.php">Rental Booking</a></li>
            <li><a href="../views/hotels.php">Hotel Booking</a></li>
            <li><a href="../views/restaurants.php">Restaurants</a></li>
        </ul>
    </div>
</section>

<!-- FAQs Section (Only 3 FAQs) -->
<section class="faqs-home">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <p>Find answers to common travel questions or submit your own.</p>
        <div class="faq-cards">
            <div class="faq-card">
                <h3>What is WanderWise?</h3>
                <p>WanderWise is a travel platform that connects travelers with third-party service providers, offering flight bookings, hotel bookings, tour packages, and more.</p>
            </div>

            <div class="faq-card">
                <h3>How do I book a tour with WanderWise?</h3>
                <p>To book a tour, simply visit our packages section, choose a tour that suits your preferences, and follow the instructions to book your trip.</p>
            </div>

            <div class="faq-card">
                <h3>Do you offer travel insurance?</h3>
                <p>Yes, we offer travel insurance options in partnership with licensed insurance providers. Please refer to our insurance section for more details.</p>
            </div>
        </div>
        <a href="../views/faqs.php" class="btn">Read FAQs</a>
    </div>
</section>
<?php include '../includes/footer.php'; ?>
