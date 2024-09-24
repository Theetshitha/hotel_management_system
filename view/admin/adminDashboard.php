<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelHub Admin Dashboard</title>
    <link rel="stylesheet" href="/view/src/styles/adminDashboard.css">
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <main class="dashboard-container">
        <h1>Welcome to the Admin Dashboard</h1>
        <section class="dashboard-section">
            <h2>Manage Hotels</h2>
            <p>View and manage all the hotels listed in the system. Add new hotels or edit the details of existing ones.</p>
            <button class="btn-primary" onclick="addHotel()">Add Hotel</button>
            <div id="hotel-list">
                <!-- List of hotels will be displayed here -->
            </div>
        </section>

        <section class="dashboard-section">
            <h2>Manage Rooms & Services</h2>
            <p>Assign rooms and services to the hotels. Add new rooms, edit services, or remove listings as necessary.</p>
            <button class="btn-primary" onclick="viewHotels()" >View Hotels</button>
        </section>

        <section class="dashboard-section">
            <h2>Manage Users</h2>
            <p>View and manage user accounts. Check their bookings, edit their profiles, or remove users from the system.</p>
            <button class="btn-primary">View Users</button>
        </section>

        <section class="dashboard-section">
            <h2>Manage Bookings</h2>
            <p>Track and manage hotel bookings. View booking details, confirm or cancel bookings as required.</p>
            <button class="btn-primary">View Bookings</button>
        </section>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>

    <script>
        function addHotel() {
            window.location.href = '/admin-add-hotel';
        }
        function viewHotels() {
            window.location.href = '/admin-manage-hotels';
        }

        // function viewUsers() {
        //     window.location.href = '/admin-view-users';
        // }

        // function viewBookings() {
        //     window.location.href = '/admin-view-bookings';
        // }
    </script>
</body>
</html>
