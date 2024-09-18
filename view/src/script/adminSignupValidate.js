document.getElementById('signupForm').addEventListener('submit', function (event) {
    const name = document.getElementById('admin_name').value;
    const email = document.getElementById('admin_email').value;
    const password = document.getElementById('admin_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const profileImage = document.getElementById('profile_image').files[0]; 

    let valid = true;

    // Validate name
    const nameValidation = validateName(name);
    if (!nameValidation.isValid) {
        valid = false;
        updateNameTooltip(nameValidation);
    } else {
        hideTooltip('nameTooltip');
    }

    // Validate email
    const emailValidation = validateEmailDetails(email);
    if (!emailValidation.isValid) {
        valid = false;
        updateEmailTooltip(emailValidation);
    } else {
        hideTooltip('emailTooltip');
    }

    // Validate password
    const passwordValidation = validatePassword(password);
    if (!passwordValidation.isValid) {
        valid = false;
        updatePasswordTooltip(passwordValidation);
    } else {
        hideTooltip('passwordTooltip');
    }

    // Confirm password match
    if (password !== confirmPassword) {
        valid = false;
        showTooltip('confirmPasswordTooltip', 'Passwords do not match.');
    } else {
        hideTooltip('confirmPasswordTooltip');
    }

    // Validate profile image (if present)
    if (profileImage) {
        const imageValidation = validateProfileImage(profileImage);
        if (!imageValidation.isValid) {
            valid = false;
            showTooltip('profileImageTooltip', imageValidation.message);
        } else {
            hideTooltip('profileImageTooltip');
        }
    } else {
        valid = false;
        showTooltip('profileImageTooltip', 'Profile image is required.');
    }

    if (!valid) {
        event.preventDefault(); // Prevent form submission if any validation fails
    }
});

// Name validation: checks for length, no numbers, and no special characters
function validateName(name) {
    const validation = {
        minLength: name.length >= 3,
        noNumbers: /^[^0-9]+$/.test(name),
        noSpecialCharacters: /^[A-Za-z\s]+$/.test(name),
        isValid: false
    };
    validation.isValid = validation.minLength && validation.noNumbers && validation.noSpecialCharacters;
    return validation;
}

// Function to update the name tooltip based on validation results
function updateNameTooltip(validation) {
    const nameTooltip = document.getElementById('nameTooltip');
    nameTooltip.style.display = 'block';
    updateValidationStatus('minLength', validation.minLength);
    updateValidationStatus('noNumbers', validation.noNumbers);
    updateValidationStatus('noSpecialCharacters', validation.noSpecialCharacters);
}

// Email validation function that checks multiple criteria
function validateEmailDetails(email) {
    const validation = {
        atSymbol: email.includes('@'),
        domain: /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email),
        noSpaces: !/\s/.test(email),
        validCharacters: /^[A-Za-z0-9._]+$/.test(email.replace(/@.*$/, '')),
        length: email.length >= 5 && email.length <= 50,
        isValid: false
    };
    validation.isValid = validation.atSymbol && validation.domain && validation.noSpaces && validation.validCharacters && validation.length;
    return validation;
}

// Function to update the email tooltip based on validation results
function updateEmailTooltip(validation) {
    const emailTooltip = document.getElementById('emailTooltip');
    emailTooltip.style.display = 'block';
    updateValidationStatus('atSymbol', validation.atSymbol);
    updateValidationStatus('domain', validation.domain);
    updateValidationStatus('noSpaces', validation.noSpaces);
    updateValidationStatus('validCharacters', validation.validCharacters);
    updateValidationStatus('length', validation.length);
}

// Password validation function: checks for length, lowercase, uppercase, number, and special character
function validatePassword(password) {
    const validation = {
        length: password.length >= 8,
        lowercase: /[a-z]/.test(password),
        uppercase: /[A-Z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[@$!%*?&]/.test(password),
        isValid: false
    };
    validation.isValid = validation.length && validation.lowercase && validation.uppercase && validation.number && validation.special;
    return validation;
}

// Function to update the password tooltip based on validation results
function updatePasswordTooltip(validation) {
    const passwordTooltip = document.getElementById('passwordTooltip');
    passwordTooltip.style.display = 'block';
    updateValidationStatus('length', validation.length);
    updateValidationStatus('lowercase', validation.lowercase);
    updateValidationStatus('uppercase', validation.uppercase);
    updateValidationStatus('number', validation.number);
    updateValidationStatus('special', validation.special);
}

// Function to validate the profile image file
function validateProfileImage(file) {
    const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB
    const validation = {
        type: validTypes.includes(file.type),
        size: file.size <= maxSize,
        isValid: false,
        message: ''
    };
    if (!validation.type) {
        validation.message = 'Invalid file type. Only JPG, PNG, and GIF are allowed.';
    } else if (!validation.size) {
        validation.message = 'File size exceeds 2MB.';
    }
    validation.isValid = validation.type && validation.size;
    return validation;
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

// Function to update the validation status of each list item
function updateValidationStatus(id, isValid) {
    const item = document.getElementById(id);
    if (item) {
        if (isValid) {
            item.classList.remove('invalid');
            item.classList.add('valid');
        } else {
            item.classList.remove('valid');
            item.classList.add('invalid');
        }
    }
}
