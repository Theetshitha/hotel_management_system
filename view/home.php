<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/HotelController.php';

// Initialize the controller
$hotelController = new HotelController($pdo);
$hotels = $hotelController->displayHotels();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelHub Home Page</title>
    <link rel="stylesheet" href="/view/src/styles/index.css">
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../view/partials/header.php'; ?>
    </div>

    <header class="banner">
        <div class="banner-content">
            <h1>Welcome to Hotel Hub</h1>
            <p>Discover the best hotels and book your rooms and services with us for your location.</p>
        </div>
    </header>

    <main class="main-content">
        <section class="introduction">
            <p>Explore our wide range of hotels and book your stay today!</p>
            <p>Book your stay with us and enjoy a comfortable and memorable experience.</p>
            <p>Thank you for choosing Hotel Hub for your travel needs. We look forward to serving you!</p>
        </section>

        <section class="hotel-cards">
    <h2>Famous Hotels</h2>
    <div class="card-container">
        <?php foreach ($hotels as $hotel): ?>
            <div class="hotel-card">
                <img src="<?php echo $hotel['image']; ?>" alt="<?php echo $hotel['hotel_name']; ?>">
                <h3><?php echo $hotel['hotel_name']; ?></h3>
                <p><?php echo $hotel['description']; ?></p>
                <p>Location: <?php echo $hotel['location']; ?></p>
                <!-- View Details button -->
                <a href="/view/hotelDetailPage.php?hotel_id=<?php echo intval($hotel['hotel_id']); ?>" class="view-details-btn">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../view/partials/footer.php'; ?>
    </div>
</body>
</html>
