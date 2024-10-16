<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="/view/src/styles/adminSignup.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>
    
    <h1>Admin Signup</h1>

    <form id="signupForm" action="../../controller/AdminController.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="admin_name">Name:</label>
            <div class="input-wrapper">
                <input type="text" id="admin_name" name="admin_name" placeholder="Enter your Name">
                <div class="tooltip" id="nameTooltip">
                    <ul>
                        <li id="minLength" class="invalid">At least 3 characters</li>
                        <li id="noNumbers" class="invalid">No numbers allowed</li>
                        <li id="noSpecialCharacters" class="invalid">No special characters allowed</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="form-group">
    <label for="admin_email">Email:</label>
    <div class="input-wrapper">
        <input type="text" id="admin_email" name="admin_email" placeholder="Enter your Bussines E-Mail">
        <div class="tooltip" id="emailTooltip">
            <ul>
                <li id="atSymbol">Must contain "@" symbol</li>
                <li id="noSpaces">Must not contain spaces</li>
                <li id="validCharacters">Only letters, numbers, periods, and underscores are allowed</li>
                <li id="length">Email should be between 5 and 50 characters long</li>
                <li id="businessDomain">Please enter your Bussines E-Mail</li>
            </ul>
           </div>
        </div>
    </div>

        <div class="form-group">
            <label for="admin_password">Password:</label>
            <div class="input-wrapper">
                <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password">
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

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-Enter your password">
            <div class="tooltip" id="confirmPasswordTooltip"> Password doesn't matched</div>
        </div>

        <div class="form-group">
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*" placeholder="Upload your Profile Image">
            <!-- <div class="tooltip" id="profileImageTooltip"></div> -->
        </div>

        <div class="form-group">
            <button type="submit">Signup</button>
        </div>

        <span>Already have an account? <a href="/admin-login">Admin Login</a></span>
    </form>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <script src="/view/src/script/adminSignupValidate.js"></script>
</body>
</html>
