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
                <div class="hotel-card">
                    <img src="https://picsum.photos/200/150?random=1" alt="Hotel 1">
                    <h3>Hotel Sunshine</h3>
                    <p>A luxurious stay with stunning views and top-notch services.</p>
                </div>
                <div class="card-container">
                <div class="hotel-card">
                    <img src="https://picsum.photos/200/150?random=4" alt="Hotel 1">
                    <h3>Hotel Bliss Stay</h3>
                    <p>Here you enjoy our best services and rooms with heaven feel tasty foods. </p>
                </div>
                <div class="hotel-card">
                    <img src="https://picsum.photos/200/150?random=2" alt="Hotel 2">
                    <h3>Hotel Ocean Breeze</h3>
                    <p>Enjoy a peaceful retreat by the beach with excellent amenities.</p>
                </div>
                <div class="hotel-card">
                    <img src="https://picsum.photos/200/150?random=3" alt="Hotel 3">
                    <h3>Hotel Mountain Escape</h3>
                    <p>Experience nature's beauty and relaxation in the mountains.</p>
                </div>
            </div>
        </section>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../view/partials/footer.php'; ?>
    </div>
</body>
</html>
