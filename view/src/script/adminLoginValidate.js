document.getElementById('loginForm').addEventListener('submit', function (event) {
    const email = document.getElementById('admin_email').value.trim();
    const password = document.getElementById('admin_password').value.trim();
    let valid = true;

    // Validate email
    const emailValidation = validateEmail(email);
    if (!emailValidation.isValid) {
        valid = false;
        showTooltip('emailTooltip', 'Invalid email. Please enter a valid email.');
    } else {
        hideTooltip('emailTooltip');
    }

    // Validate password
    const passwordValidation = validatePassword(password);
    if (!passwordValidation.isValid) {
        valid = false;
        showTooltip('passwordTooltip', 'Wrong password. Please enter a valid password.');
    } else {
        hideTooltip('passwordTooltip');
    }

    // Prevent form submission if any validation fails
    if (!valid) {
        event.preventDefault();
    }
});

// Email validation: checks for a valid email format
function validateEmail(email) {
    return {
        isValid: /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) // Basic email regex
    };
}

// Password validation: checks for minimum length of 8 characters
function validatePassword(password) {
    return {
        isValid: password.length >= 8 // Minimum password length is 8 characters
    };
}

// Function to show the tooltip with a custom message
function showTooltip(id, message) {
    const tooltip = document.getElementById(id);
    if (tooltip) {
        tooltip.style.display = 'block';
        tooltip.innerText = message;
    }
}

// Function to hide the tooltip
function hideTooltip(id) {
    const tooltip = document.getElementById(id);
    if (tooltip) {
        tooltip.style.display = 'none';
    }
}
