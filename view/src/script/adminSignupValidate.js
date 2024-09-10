// document.getElementById('signupForm').addEventListener('submit', function(e) {
//     let isValid = true;

//     // Validate Name
//     const nameField = document.getElementById('admin_name');
//     const nameError = nameField.nextElementSibling;
//     if (nameField.value.trim() === '') {
//         nameError.textContent = 'Name is required';
//         nameField.classList.add('input-error');
//         isValid = false;
//     } else {
//         nameError.textContent = '';
//         nameField.classList.remove('input-error');
//     }

//     // Validate Email
//     const emailField = document.getElementById('admin_email');
//     const emailError = emailField.nextElementSibling;
//     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     if (!emailRegex.test(emailField.value)) {
//         emailError.textContent = 'Please enter a valid email address';
//         emailField.classList.add('input-error');
//         isValid = false;
//     } else {
//         emailError.textContent = '';
//         emailField.classList.remove('input-error');
//     }

//     // Validate Password
//     const passwordField = document.getElementById('admin_password');
//     const passwordError = passwordField.nextElementSibling;
//     if (passwordField.value.length < 6) {
//         passwordError.textContent = 'Password must be at least 6 characters';
//         passwordField.classList.add('input-error');
//         isValid = false;
//     } else {
//         passwordError.textContent = '';
//         passwordField.classList.remove('input-error');
//     }

//     if (!isValid) {
//         e.preventDefault();
//     }
// });
