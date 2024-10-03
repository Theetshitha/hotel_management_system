<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/hotelDetailController.php';

$hotel_id = intval($_GET['hotel_id']);
$hotelController = new HotelDetailController($pdo);

// Fetch hotel, services, and images
$hotelDetails = $hotelController->getHotelDetails($hotel_id);
$hotelServices = $hotelController->getHotelServices($hotel_id);
$hotelImages = $hotelController->getHotelImages($hotel_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($hotelDetails['hotel_name']); ?> - Hotel Details</title>
    <link rel="stylesheet" href="/view/src/styles/hotelDetailPage.css">
</head>
<body>

    <div id="navbarHeader">
        <?php include __DIR__ . '/../view/partials/header.php'; ?>
    </div>
    <main class="hotel-details-container">
        <h1><?php echo htmlspecialchars($hotelDetails['hotel_name']); ?></h1>
        <p class="location">Location: <?php echo htmlspecialchars($hotelDetails['location']); ?></p>
        <!-- Add price_per_room and no_of_rooms display -->
        <p>Price per Room: ₹<?php echo number_format($hotelDetails['price_per_room'], 2); ?></p>
        <p>Number of Rooms: <?php echo htmlspecialchars($hotelDetails['no_of_rooms']); ?></p>

        <p class="description"><?php echo htmlspecialchars($hotelDetails['description']); ?></p>

        <!-- Hotel Images -->
        <section class="hotel-images">
            <h2>Hotel Images</h2>
            <div class="image-gallery">
                <?php foreach ($hotelImages as $image): ?>
                    <img src="/uploads/hotel_images/<?php echo htmlspecialchars($image['image']); ?>" alt="Hotel Image">
                <?php endforeach; ?>
            </div>
        </section>

        <section class="hotel-services">
    <h2>Available Services</h2>
    <div class="services-list">
        <?php foreach ($hotelServices as $service): ?>
            <div class="service-item">
                <h3><?php echo htmlspecialchars($service['service_name']); ?></h3>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
                <p>Price: ₹<?php echo number_format($service['price'], 2); ?></p>
                <p>Availability: <?php echo $service['availability'] ? 'Available' : 'Not Available'; ?></p>

                <!-- Display Service Images -->
                <div class="service-images">
                    <?php foreach ($service['images'] as $image): ?>
                        <img src="/uploads/service_images/<?php echo htmlspecialchars($image['image']); ?>" alt="Service Image">
                    <?php endforeach; ?>
                </div>
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
