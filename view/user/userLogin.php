<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="/view/src/styles/userSignup.css">
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
        #emailTooltip1{
            top: 40px;
            right: -300px;
            width: 280px;
        }
        #passwordTooltip1{
            margin-top: 15px;
            margin-left: 0px;
            width: 195px;
         } 
    </style>
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <h1>User Login</h1>

    <form id="loginForm" action="/controller/UserController.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter your email">
            <div id="emailTooltip1" class="tooltip emailTooltip" style="margin-top: -12px; margin-left: 0px; width: 280px;">Invalid email. Please enter a valid email.</div>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <div id="passwordTooltip1" class="tooltip passwordTooltip">Wrong password. Please enter a valid password.</div>
        </div>
        <div class="form-group">
            <button type="submit" name="user_login">Login</button>
        </div>
        <span>Don't have an account? <a href="/user-signup">User Signup</a></span>
    </form>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <script src="/view/src/script/userLoginValidate.js"></script>
</body>
</html>
