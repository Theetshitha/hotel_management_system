
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../src/styles/adminSignup.css">
    <style>
        .footer_div{
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="navbarHeader">
    <?php include __DIR__ . '/../partials/header.php'; ?>

    </div>
    <h1>Admin Login</h1>

    <form id="loginForm" action="../../controller/AdminController.php" method="POST">
        <div class="form-group">
            <label for="admin_email">Email:</label>
            <input type="email" id="admin_email" name="admin_email" required>
        </div>
        <div class="form-group">
            <label for="admin_password">Password:</label>
            <input type="password" id="admin_password" name="admin_password" required>
        </div>
        <div class="form-group">
            <button type="submit" name="admin_login">Login</button>
        </div>
        <span>Don't have a account? <a href="./adminSignup.php">Admin Signup</a></span>
    </form>
    <div class="footer_div">
    <?php include __DIR__ . '/../partials/footer.php'; ?>

    </div>
</body>
</html>

