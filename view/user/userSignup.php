<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <link rel="stylesheet" href="/view/src/styles/userSignup.css">
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <h1>User Signup</h1>

    <form id="signupForm" action="../../controller/UserController.php" method="POST" enctype="multipart/form-data">
        <!-- Username field -->
        <div class="form-group">
            <label for="username">Name:</label>
            <div class="input-wrapper">
                <input type="text" id="username" name="username" placeholder="Enter your Name">
                <div class="tooltip" id="nameTooltip">
                    <ul>
                        <li id="minLength" class="invalid">At least 3 characters</li>
                        <li id="noNumbers" class="invalid">No numbers allowed</li>
                        <li id="noSpecialCharacters" class="invalid">No special characters allowed</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Email field -->
        <div class="form-group">
            <label for="email">Email:</label>
            <div class="input-wrapper">
                <input type="text" id="email" name="email" placeholder="Enter your Email">
                <div class="tooltip" id="emailTooltip">
                    <ul>
                        <li id="atSymbol" class="invalid">Must contain "@" symbol</li>
                        <li id="noSpaces" class="invalid">Must not contain spaces</li>
                        <li id="validCharacters" class="invalid">Only letters, numbers, periods, and underscores are allowed</li>
                        <li id="length" class="invalid">Email should be between 5 and 50 characters long</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Password field -->
        <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-wrapper">
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <div class="tooltip" id="passwordTooltip">
                    <ul>
                        <li id="length" class="invalid">At least 8 characters</li>
                        <li id="lowercase" class="invalid">One lowercase letter</li>
                        <li id="uppercase" class="invalid">One uppercase letter</li>
                        <li id="number" class="invalid">One number</li>
                        <li id="special" class="invalid">One special character (@$!%*?&)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Confirm password field -->
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-Enter your password">
            <div class="tooltip" id="confirmPasswordTooltip"></div>
        </div>

        <!-- Profile image upload -->
        <div class="form-group">
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*" placeholder="Upload your Profile Image">
            <div class="tooltip" id="profileImageTooltip"></div>
        </div>

        <!-- Signup button -->
        <div class="form-group">
            <button type="submit" name="user_signup">Sign Up</button>
        </div>

        <!-- Link to login -->
        <span>Already have an account? <a href="/user-login">User Login</a></span>
    </form>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <script src="/view/src/script/userSignupValidate.js"></script>
</body>
</html>
