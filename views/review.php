<?php include '../includes/header.php'; ?>

<section class="review-section">
    <div class="container">
        <h2>Leave a Review</h2>
        <form action="submit_review.php" method="POST">
            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" required>

            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>

            <label for="review">Review:</label>
            <textarea id="review" name="review" required></textarea>

            <button type="submit">Submit Review</button>
        </form>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
