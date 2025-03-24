<?php include '../includes/header.php'; ?>

<link rel="stylesheet" href="../assets/css/faqs.css">

<section class="faqs-section">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <p>Here are some frequently asked questions by our customers. If you have a question that is not listed below, feel free to contact us!</p>

        <div class="faq-list">
            <div class="faq-item">
                <div class="question">
                    <img src="../assets/images/user-logo.jpg" alt="User Logo" class="faq-logo">
                    <p>What is WanderWise?</p>
                </div>
                <div class="answer">
                    <img src="../assets/images/ww_logo.png" alt="WanderWise Logo" class="faq-logo">
                    <p>WanderWise is a travel platform that connects travelers with third-party service providers, offering flight bookings, hotel bookings, tour packages, and more.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <img src="../assets/images/user-logo.jpg" alt="User Logo" class="faq-logo">
                    <p>How do I book a tour with WanderWise?</p>
                </div>
                <div class="answer">
                    <img src="../assets/images/ww_logo.png" alt="WanderWise Logo" class="faq-logo">
                    <p>To book a tour, simply visit our packages section, choose a tour that suits your preferences, and follow the instructions to book your trip.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <img src="../assets/images/user-logo.jpg" alt="User Logo" class="faq-logo">
                    <p>Can I cancel my booking?</p>
                </div>
                <div class="answer">
                    <img src="../assets/images/ww_logo.png" alt="WanderWise Logo" class="faq-logo">
                    <p>Booking cancellations depend on the provider's policy. Please refer to the cancellation terms of the specific travel product for more details.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <img src="../assets/images/user-logo.jpg" alt="User Logo" class="faq-logo">
                    <p>Is my personal data safe on WanderWise?</p>
                </div>
                <div class="answer">
                    <img src="../assets/images/ww_logo.png" alt="WanderWise Logo" class="faq-logo">
                    <p>Yes, we take your privacy seriously. Please review our <a href="privacy_policy.php">Privacy Policy</a> for details on how we protect your data.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <img src="../assets/images/user-logo.jpg" alt="User Logo" class="faq-logo">
                    <p>What payment methods are accepted?</p>
                </div>
                <div class="answer">
                    <img src="../assets/images/ww_logo.png" alt="WanderWise Logo" class="faq-logo">
                    <p>We accept various payment methods, including credit/debit cards, bank transfers, and EMI (Equated Monthly Installments) for eligible credit cardholders.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <img src="../assets/images/user-logo.jpg" alt="User Logo" class="faq-logo">
                    <p>Do you offer travel insurance?</p>
                </div>
                <div class="answer">
                    <img src="../assets/images/ww_logo.png" alt="WanderWise Logo" class="faq-logo">
                    <p>Yes, we offer travel insurance options in partnership with licensed insurance providers. Please refer to our insurance section for more details.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            item.querySelector('.question').addEventListener('click', function () {
                item.classList.toggle('active');
            });
        });
    });
</script>
</body>
</html>
