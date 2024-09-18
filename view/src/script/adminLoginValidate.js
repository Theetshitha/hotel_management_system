// document.getElementById('loginForm').addEventListener('submit', function (event) {
//     event.preventDefault(); // Prevent default form submission

//     let email = document.getElementById('admin_email');
//     let password = document.getElementById('admin_password');
//     let isValid = true;

//     // Email validation regex
//     let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

//     // Clear previous tooltips
//     removeTooltips();

//     // Email validation
//     if (!email.value || !emailRegex.test(email.value)) {
//         showTooltip(email, 'Invalid email format. Please enter a valid email.', 'red');
//         isValid = false;
//     } else {
//         showTooltip(email, 'Valid email.', 'green');
//     }

//     // Password validation
//     if (!password.value || !passwordRegex.test(password.value)) {
//         showTooltip(password, 'Password must be at least 8 characters long and contain one uppercase, one lowercase, one number, and one special character.', 'red');
//         isValid = false;
//     } else {
//         showTooltip(password, 'Valid password.', 'green');
//     }

//     if (isValid) {
//         this.submit(); // Only submit the form if all validations pass
//     }
// });

// // Helper functions
// function showTooltip(element, message, color) {
//     let tooltip = document.createElement('span');
//     tooltip.className = 'tooltip';
//     tooltip.textContent = message;
//     tooltip.style.color = color;
//     element.parentNode.appendChild(tooltip);
// }

// function removeTooltips() {
//     let tooltips = document.querySelectorAll('.tooltip');
//     tooltips.forEach(tooltip => tooltip.remove());
// }
