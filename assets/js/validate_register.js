// Function to validate the registration form
function validateForm(event) {
    event.preventDefault(); // Prevent form submission

    // Get form elements
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const phone = document.getElementById('phone');
    const terms = document.getElementById('terms');

    let isValid = true;

    // Clear previous error messages
    clearErrorMessages();

    // Validate Username (can contain letters and numbers)
    const usernameRegex = /^[A-Za-z0-9]+$/;
    if (!usernameRegex.test(username.value)) {
        isValid = false;
        displayError(username, 'Username must contain only letters and numbers.');
    }

    // Validate Email (must be a valid email format)
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(email.value)) {
        isValid = false;
        displayError(email, 'Please enter a valid email address.');
    }

    // Validate Password (must be between 8 to 32 characters)
    const passwordRegex = /^.{8,32}$/;
    if (!passwordRegex.test(password.value)) {
        isValid = false;
        displayError(password, 'Password must be between 8 and 32 characters.');
    }

    // Validate First Name and Last Name (must contain letters only)
    const nameRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(firstName.value)) {
        isValid = false;
        displayError(firstName, 'First Name must contain only letters.');
    }
    if (!nameRegex.test(lastName.value)) {
        isValid = false;
        displayError(lastName, 'Last Name must contain only letters.');
    }

    // Validate Phone Number (must start with +8801 and contain 9 digits after)
    const phoneRegex = /^\+8801[0-9]{9}$/;
    if (!phoneRegex.test(phone.value)) {
        isValid = false;
        displayError(phone, 'Phone number must start with +8801 and contain 9 digits after.');
    }

    // Validate Terms and Conditions checkbox
    if (!terms.checked) {
        isValid = false;
        displayError(terms, 'You must agree to the terms and conditions.');
    }

    // If the form is valid, submit the form
    if (isValid) {
        document.getElementById('register-form').submit();
    }
}

// Function to display the error message next to the form field
function displayError(inputField, message) {
    // Check if the error message already exists, if yes, skip adding a new one
    if (!inputField.nextElementSibling || inputField.nextElementSibling.className !== 'error-message') {
        const errorElement = document.createElement('p');
        errorElement.className = 'error-message';
        errorElement.style.color = 'red';
        errorElement.textContent = message;
        inputField.parentElement.appendChild(errorElement);
    }
}

// Function to clear previous error messages
function clearErrorMessages() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(errorMessage => {
        errorMessage.remove();
    });
}

// Attach the validateForm function to the form submit event
document.getElementById('register-form').addEventListener('submit', validateForm);
