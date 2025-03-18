// Mobile Menu Toggle
let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

// Toggle the navbar when the menu button is clicked
menu.onclick = () => {
    menu.classList.toggle('fa-times'); // Change icon to "X" on click
    navbar.classList.toggle('active');  // Show the navbar
};

// Close navbar when scrolling (for mobile view)
window.onscroll = () => {
    menu.classList.remove('fa-times'); // Reset icon
    navbar.classList.remove('active'); // Hide navbar
};

// Custom Slider for Package Section (if needed for another section)
let currentIndex = 0;
const packageSlides = document.querySelectorAll('.package'); // All the package cards
const totalSlides = packageSlides.length;

// Function to show the current slide (package)
function showSlide(index) {
    // Hide all packages
    packageSlides.forEach(slide => {
        slide.style.display = 'none';
    });

    // Show the current package
    packageSlides[index].style.display = 'block';
}

// Function to go to the next slide (package)
function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
}

// Function to go to the previous slide (package)
function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
}

// Initialize the first slide
showSlide(currentIndex);

// Automatic slider change (every 5 seconds)
setInterval(nextSlide, 5000); // Change slide every 5 seconds
