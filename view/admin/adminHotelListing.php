<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controller/HotelController.php';
require_once __DIR__ . '/../../controller/deleteHotelController.php';

// Initialize hotel and delete controllers
$hotelController = new HotelController($pdo);
$hotels = $hotelController->displayHotels();

$deleteController = new DeleteHotelController($pdo);

// Handle deletion if a delete request is made
if (isset($_GET['delete']) && isset($_GET['hotel_id'])) {
    $hotel_id = intval($_GET['hotel_id']); // Ensure it's an integer
    $deleteController->deleteHotel($hotel_id);
}
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
        </section>

        <section class="hotel-cards">
            <h2>Manage Hotels</h2>
            <div class="card-container">
                <?php foreach ($hotels as $hotel): ?>
                    <div class="hotel-card">
                        <img src="<?php echo htmlspecialchars($hotel['image']); ?>" alt="<?php echo htmlspecialchars($hotel['hotel_name']); ?>">
                        <h3><?php echo htmlspecialchars($hotel['hotel_name']); ?></h3>
                        <p><?php echo htmlspecialchars($hotel['description']); ?></p>
                        <p>Location: <?php echo htmlspecialchars($hotel['location']); ?></p>
                        <!-- Admin Edit and Delete buttons -->
                        <a href="/admin-edit-hotel?hotel_id=<?php echo intval($hotel['hotel_id']); ?>" class="edit-btn">Edit</a>

                        <!-- Corrected delete button passing the correct hotel_id -->
                        <a href="?delete=true&hotel_id=<?php echo intval($hotel['hotel_id']); ?>" class="delete-btn" 
                           onclick="return confirm('Are you sure you want to delete hotel ID: <?php echo intval($hotel['hotel_id']); ?> - <?php echo htmlspecialchars($hotel['hotel_name']); ?>?');">
                           Delete
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php if (isset($_GET['success'])): ?>
            <p class="success-msg">Hotel deleted successfully!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="error-msg">Failed to delete the hotel. Please try again.</p>
        <?php endif; ?>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>
</body>
</html>
