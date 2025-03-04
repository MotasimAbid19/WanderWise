<?php include '../includes/header.php'; ?>

<section class="search-section">
    <div class="container">
        <h2>Search for Destinations</h2>
        <form action="results.php" method="GET">
            <label for="from">From:</label>
            <input type="text" id="from" name="from" required>

            <label for="to">To:</label>
            <input type="text" id="to" name="to" required>

            <button type="submit">Search</button>
        </form>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
