<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Hotel Hub - Non-Logged-in Navbar</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <style>  
        /* Root Colors */  
        :root {  
            --primary-color: #2c3e50;  
            --secondary-color: #3498db;  
            --accent-color: #e74c3c;  
            --text-color: #ffffff;  
            --background-color: #ecf0f1;  
        }  

        body {  
            margin: 0;  
            font-family: Arial, sans-serif;  
        }  

        .header {  
            background-color: var(--primary-color);  
            color: var(--text-color);  
        }  

        .navbar {  
            display: flex;  
            justify-content: space-between;  
            align-items: center;  
            padding: 10px 20px;  
            background-color: var(--primary-color);  
        }  

        .navbar-left {  
            display: flex;  
            align-items: center;  
            margin-right: 20px; /* Margin for spacing between the logo and search bar */  
        }  

        .navbar-left .logo {  
            color: var(--text-color);  
            text-decoration: none;  
            font-size: 24px;  
            font-weight: bold;  
        }  

        .navbar-center {  
            flex-grow: 1;  
            display: flex;  
            justify-content: center;  
            align-items: center;  
            margin: 0 20px; /* Margin for spacing on both sides of the search bar */  
        }  

        .search-bar {  
            padding: 8px;  
            border: none;  
            border-radius: 8px 0px 0px 8px;  
            width: 100%;  
        }  

        .search-icon {  
            background-color: var(--secondary-color);  
            border: none;  
            color: var(--text-color);  
            padding: 8px 10px;  
            border-radius: 0px 8px 8px 0px;  
            cursor: pointer;  
        }  

        .navbar-right {  
            display: flex;  
            align-items: center;  
            gap: 20px; /* Gap between menu items and login button */  
        }  

        .navbar-right ul {  
            list-style-type: none;  
            margin: 0;  
            padding: 0;  
            display: flex;  
            gap: 15px; /* Space between each menu item */  
        }  

        .navbar-right li {  
            position: relative;  
        }  

        .navbar-right a {  
            color: var(--text-color);  
            text-decoration: none;  
            padding: 10px;  
            display: block;  
        }  

        .navbar-right .dropdown .dropdown-menu {  
            display: none;  
            position: absolute;  
            background-color: var(--background-color);  
            min-width: 135px;  
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);  
            z-index: 1;  
            padding: 0;  
            margin: 0;  
            list-style-type: none;  
        }  

        .navbar-right .dropdown:hover .dropdown-menu {  
            display: block;  
        }  

        .dropdown-menu li {  
            margin: 0;  
        }  

        .dropdown-menu a {  
            color: black;  
            padding: 12px 16px;  
            text-decoration: none;  
            display: block;  
            text-align: center;  
        }  

        .dropdown-menu a:hover {  
            background-color: #ddd;  
            color: black;  
        }  

        .login-btn {  
            background-color: var(--secondary-color);  
            color: var(--text-color);  
            border: none;  
            padding: 10px 20px;  
            border-radius: 5px;  
            text-decoration: none;  
            font-size: 16px;  
            cursor: pointer;  
        }  

        .login-btn:hover {  
            background-color: #2980b9;  
        }  
    </style>  
</head>  

<body>  
    <header>  
        <nav class="navbar">  
            <div class="navbar-left">  
                <a href="/" class="logo">Hotel Hub</a>  
            </div>  
            <div class="navbar-center">  
                <input type="text" placeholder="Search rooms, locations..." class="search-bar">  
                <button class="search-icon"><i class="fa fa-search"></i></button>  
            </div>  
            <div class="navbar-right">  
                <ul>  
                    <li class="dropdown">  
                        <a href="#">Destination Guide</a>  
                        <ul class="dropdown-menu">  
                            <li><a href="#">Attractions Nearby</a></li>  
                            <li><a href="#">Local Activities</a></li>  
                            <li><a href="#">Travel Tips</a></li>  
                        </ul>  
                    </li>  
                    <li class="dropdown">  
                        <a href="#">Reviews & Testimonials</a>  
                        <ul class="dropdown-menu">  
                            <li><a href="#">Customer Experiences</a></li>  
                            <li><a href="#">Ratings</a></li>  
                        </ul>  
                    </li>  
                    <li class="dropdown">  
                        <a href="#">Special Offers</a>  
                        <ul class="dropdown-menu">  
                            <li><a href="#">Last Minute Deals</a></li>  
                            <li><a href="#">Seasonal Promotions</a></li>  
                        </ul>  
                    </li>  
                    <li class="dropdown">  
                        <a href="#">Services</a>  
                        <ul class="dropdown-menu">  
                            <li><a href="#">Room Service</a></li>  
                            <li><a href="#">Transportation</a></li>  
                            <li><a href="#">Amenities</a></li>  
                        </ul>  
                    </li>  
                </ul>  
                <a href="#" class="login-btn">Login</a>  
            </div>  
        </nav>  
    </header>  
</body>  

</html>