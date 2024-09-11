<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hub - Responsive Header</title>
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
            gap: 20px;
        }

        .navbar-left .logo {
            color: var(--text-color);
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            margin-right: 20px; /* Adjust spacing as needed */
        }

        .navbar-center {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-bar {
            padding: 8px;
            border: none;
            border-radius: 8px 0px 0 8px;
            width: 60%; /* Adjust width as needed */
            margin-right:0;
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
        }

        .navbar-right ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-right li {
            position: relative;
            margin: 0 10px;
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
            min-width: 140px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            padding: 0;
            margin: 0;
            list-style-type: none;
        }
        #profileDropdown{
            min-width: 60px;
        }
        #roomBookingDropdown{
            min-width: 100px;
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
            text-align: left;
        }

        .dropdown-menu a:hover {
            background-color: #ddd;
            color: black;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            width: 200px;
            background-color: var(--primary-color);
            color: var(--text-color);
            transition: left 0.3s;
            padding: 15px;
            overflow: auto;
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar-header .logo {
            color: var(--text-color);
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            display: block;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 37px;
        }

        .sidebar-links a {
            color: var(--text-color);
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-left: -12px;
        }

        .sidebar-links a:hover {
            background-color: #555;
        }

        .sidebar-icon {
            background: var(--secondary-color);
            color: var(--text-color);
            border: none;
            font-size: 24px;
            cursor: pointer;
            padding: 2px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-icon:hover {
            background-color: #2980b9; /* Darker shade of secondary color */
        }

        @media screen and (max-width: 600px) {
            .navbar-left, .navbar-right {
                display: none;
            }

            .sidebar {
                left: 0;
                width: 100%;
            }

            .navbar-left .sidebar-icon {
                display: block;
            }

            .navbar-center {
                justify-content: center; /* Ensure centering on mobile */
            }
        }

        .active {
            background-color: var(--secondary-color);
            color: var(--text-color);
        }

        .navbar-right a:hover {
            background-color: #555;
            color: var(--text-color);
        }

        li {
            list-style-type: none;
        }
    </style>
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="navbar-left">
                <button id="sidebarToggle" class="sidebar-icon">&#9776;</button>
                <a href="/" class="logo">Hotel Hub</a>
            </div>
            <div class="navbar-center">
                <input type="text" placeholder="Search rooms, locations..." class="search-bar">
                <button class="search-icon"><i class="fa fa-search"></i></button>
            </div>
            <div class="navbar-right">
                <ul>
                    <li class="dropdown">
                        <a href="#" class="active">Room Booking</a>
                        <ul class="dropdown-menu" id="roomBookingDropdown">
                            <li><a href="/view/admin/adminSignup.php">Single Bed</a></li>
                            <li><a href="#">AC Rooms</a></li>
                            <li><a href="#">Double Bed Rooms</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">Service Booking</a>
                        <ul class="dropdown-menu" id="serviceBookingDropdown">
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Laundry</a></li>
                            <li><a href="#">Cleaning</a></li>
                        </ul>
                    </li>
                    <li class="profile dropdown">
                        <a href="#">Profile &#9662;</a>
                        <ul class="dropdown-menu" id="profileDropdown">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <a href="index.php" class="logo">Hotel Hub</a>
        </div>
        <ul class="sidebar-links">
            <li><a href="#">Services</a></li>
            <li><a href="#">Famous Hotels</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Feedback</a></li>
            <li><a href="/admin-login">Admin Login</a></li>
            <li><a href="/admin-signup">Admin signup</a></li>
            <li><a href="/admin-dashboard">Admin Dashboard</a></li>
        </ul>
    </aside>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('mouseover', function () {
            sidebar.classList.add('open');
        });

        sidebar.addEventListener('mouseleave', function () {
            sidebar.classList.remove('open');
        });
    </script>
</body>

</html>
