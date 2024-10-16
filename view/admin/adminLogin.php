<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/view/src/styles/adminSignup.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .footer_div{
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .tooltip {
            display: none;
            color: red;
            font-size: 0.9em;
        }
        #emailTooltip{
            margin-top: -38px;
            margin-left: 0px;
            width: 300px;
        }
        #passwordTooltip{
            margin-top: -37px;
            margin-left: 0px;
            width: 320px;
         } 
    </style>
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <h1>Admin Login</h1>

    <form id="loginForm" action="/controller/AdminController.php" method="POST">
        <div class="form-group">
            <label for="admin_email">Email:</label>
            <input type="text" id="admin_email" name="admin_email" placeholder="Enter your email">
            <div id="emailTooltip" class="tooltip">Invalid email. Please enter a valid email.</div>
        </div>
        <div class="form-group">
            <label for="admin_password">Password:</label>
            <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password">
            <div id="passwordTooltip" class="tooltip">Wrong password. Please enter a valid password.</div>
        </div>
        <div class="form-group">
            <button type="submit" name="admin_login">Login</button>
        </div>
        <span>Don't have a account? <a href="/admin-signup">Admin Signup</a></span>
    </form>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <script src="/view/src/script/adminLoginValidate.js"></script>
</body>
</html>
