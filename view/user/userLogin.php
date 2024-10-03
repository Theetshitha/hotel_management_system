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

    <h1>User Login</h1>

    <form id="loginForm" action="/controller/UserController.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter your email">
            <div id="emailTooltip" class="tooltip">Invalid email. Please enter a valid email.</div>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <div id="passwordTooltip" class="tooltip">Wrong password. Please enter a valid password.</div>
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
