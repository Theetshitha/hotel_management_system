
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="../src/styles/adminSignup.css">
</head>
<body>
    <div id="navbarHeader">
    <?php include __DIR__ . '/../partials/header.php'; ?>

    </div>
    <h1>Admin Signup</h1>

    <form id="signupForm" action="../../controller/AdminController.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="admin_name">Name:</label>
            <input type="text" id="admin_name" name="admin_name" required>
        </div>
        <div class="form-group">
            <label for="admin_email">Email:</label>
            <input type="email" id="admin_email" name="admin_email" required>
        </div>
        <div class="form-group">
            <label for="admin_password">Password:</label>
            <input type="password" id="admin_password" name="admin_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" required>
            <div class="error-message" id="passwordError"></div>
        </div>
        <div class="form-group">
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">
        </div>
        <div class="form-group">
            <button type="submit">Signup</button>
        </div>
    <span>Already having a account? <a href="./adminLogin.php">Admin Login</a></span>
    

    </form>


    <script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            const password = document.getElementById('admin_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            if (password !== confirmPassword) {
                event.preventDefault();
                document.getElementById('passwordError').textContent = 'Passwords do not match';
            }
        });
    </script>
    <div class="footer_div">
    <?php include __DIR__ . '/../partials/footer.php'; ?>

    </div>
</body>
</html>

