<?php include '../includes/header.php'; ?>

<section class="contact-section">
    <div class="container">
        <h2>Contact Us</h2>
        <form action="submit_contact.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
