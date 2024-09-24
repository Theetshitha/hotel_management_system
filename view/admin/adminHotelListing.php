<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controller/HotelController.php';

// Initialize the controller
$hotelController = new HotelController($pdo);
$hotels = $hotelController->displayHotels();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hotel Listing</title>
    <link rel="stylesheet" href="/view/src/styles/adminManageHotels.css">
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <header class="banner">
        <div class="banner-content">
            <h1>Admin Dashboard - Hotel Management</h1>
            <p>Manage and update hotel listings.</p>
        </div>
    </header>

    <main class="main-content">
        <section class="admin-intro">
            <p>Welcome, Admin! Use the tools below to edit, update, or delete hotels.</p>
            <p>Ensure all hotel information is accurate and up-to-date.</p>
        </section>

        <section class="hotel-cards">
            <h2>Manage Hotels</h2>
            <div class="card-container">
                <?php foreach ($hotels as $hotel): ?>
                    <div class="hotel-card">
                        <img src="<?php echo $hotel['image']; ?>" alt="<?php echo $hotel['hotel_name']; ?>">
                        <h3><?php echo $hotel['hotel_name']; ?></h3>
                        <p><?php echo $hotel['description']; ?></p>
                        <p>Location: <?php echo $hotel['location']; ?></p>
                        <!-- Admin Edit and Delete buttons -->
                        <a href="edit-hotel.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete-hotel.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this hotel?');">Delete</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>
</body>
</html>
