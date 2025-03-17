let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

// Custom Slider for Package Section
let currentIndex = 0;
const packageSlides = document.querySelectorAll('.package'); // All the package cards
const totalSlides = packageSlides.length;

function showSlide(index) {
    // Hide all packages
    packageSlides.forEach(slide => {
        slide.style.display = 'none';
    });

    // Show the current package
    packageSlides[index].style.display = 'block';
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
}

// Initialize the first slide
showSlide(currentIndex);

// Automatic slider change
setInterval(nextSlide, 5000); // Change slide every 5 seconds



