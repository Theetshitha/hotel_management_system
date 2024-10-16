<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/HotelController.php';

// Initialize the controller
$hotelController = new HotelController($pdo);
$hotels = $hotelController->displayHotels();
$countries = $hotelController->getCountries(); // Fetch countries for dropdown
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

        <!-- Filter Section -->
        <section class="filter-section">
            <form id="hotel-filter-form">
                <div class="filter-container">
                    <select id="country-select" class="filter-select" name="country">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $country): ?>
                            <option value="<?php echo $country['country_id']; ?>">
                                <?php echo $country['country_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select id="state-select" class="filter-select" name="state" disabled>
                        <option value="">Select State</option>
                    </select>

                    <select id="city-select" class="filter-select" name="city" disabled>
                        <option value="">Select City</option>
                    </select>

                    <select id="price-range-select" class="filter-select" name="price_range">
                        <option value="">Select Price Range</option>
                        <option value="0-5000">0 - 5000</option>
                        <option value="5000-10000">5000 - 10,000</option>
                        <option value="10000-20000">10,000 - 20,000</option>
                        <option value="20000-50000">20,000 - 50,000</option>
                        <option value="50000+">50,000+</option>
                    </select>

                    <button type="submit" class="filter-btn">Filter</button>
                </div>
            </form>
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
                        <a href="/hotel-detailed-page?hotel_id=<?php echo intval($hotel['hotel_id']); ?>" class="view-details-btn">View Details</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../view/partials/footer.php'; ?>
    </div>

    
    <script src="/view/src/script/filter.js"></script>
</body>
</html>
