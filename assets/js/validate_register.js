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
    let errorMessages = [];

    // Validate Username (must contain letters only)
    const usernameRegex = /^[A-Za-z]+$/;
    if (!usernameRegex.test(username.value)) {
        isValid = false;
        errorMessages.push('Username must contain only letters.');
    }

    // Validate Email (must be a valid email format)
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(email.value)) {
        isValid = false;
        errorMessages.push('Please enter a valid email address.');
    }

    // Validate Password (must be between 8 to 32 characters)
    const passwordRegex = /^.{8,32}$/;  // Password length should be between 8 and 32 characters
    if (!passwordRegex.test(password.value)) {
        isValid = false;
        errorMessages.push('Password must be between 8 and 32 characters.');
    }

    // Validate First Name and Last Name (must contain letters only)
    const nameRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(firstName.value)) {
        isValid = false;
        errorMessages.push('First Name must contain only letters.');
    }
    if (!nameRegex.test(lastName.value)) {
        isValid = false;
        errorMessages.push('Last Name must contain only letters.');
    }

    // Validate Phone Number (must start with +8801 and contain 9 digits after)
    const phoneRegex = /^\+8801[0-9]{9}$/;
    if (!phoneRegex.test(phone.value)) {
        isValid = false;
        errorMessages.push('Phone number must start with +8801 and contain 9 digits after.');
    }

    // Validate Terms and Conditions checkbox
    if (!terms.checked) {
        isValid = false;
        errorMessages.push('You must agree to the terms and conditions.');
    }

    // Display errors if validation fails
    const errorDiv = document.getElementById('error-messages');
    errorDiv.innerHTML = ''; // Clear previous error messages
    if (!isValid) {
        errorMessages.forEach((message) => {
            const errorMessage = document.createElement('p');
            errorMessage.style.color = 'red';
            errorMessage.textContent = message;
            errorDiv.appendChild(errorMessage);
        });
    }

    // If the form is valid, submit the form
    if (isValid) {
        document.getElementById('register-form').submit();
    }
}

// Attach the validateForm function to the form submit event
document.getElementById('register-form').addEventListener('submit', validateForm);
