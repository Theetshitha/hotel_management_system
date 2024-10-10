<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/hotelDetailController.php';

$hotel_id = intval($_GET['hotel_id']);
$hotelController = new HotelDetailController($pdo);

// Fetch hotel, services, and images
$hotelDetails = $hotelController->getHotelDetails($hotel_id);
$hotelServices = $hotelController->getHotelServices($hotel_id);
$hotelImages = $hotelController->getHotelImages($hotel_id);


$user_id = $_SESSION['user_id']; 

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
        <p>Number of Rooms Available: <?php echo htmlspecialchars($hotelDetails['no_of_rooms']); ?></p>

        <p class="description"><?php echo htmlspecialchars($hotelDetails['description']); ?></p>

        <!-- Book Room Button -->
        <button id="bookRoomBtn" class="book-room-btn">Book Room</button>

        <!-- Popup Form for Booking Room -->
        <div id="bookingPopup" class="popup" style="display: none;">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h2 id="form_title">Book a Room</h2>
                <form id="bookingForm" action="/controller/BookingController.php" method="POST">
                    <input type="hidden" name="hotel_id" value="<?php echo htmlspecialchars($hotel_id); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>"> 

                    <div class="form-group">
                        <label for="no_of_rooms">Number of Rooms</label>
                        <input type="number" id="no_of_rooms" name="no_of_rooms" value="1" required min="1" max="<?php echo htmlspecialchars($hotelDetails['no_of_rooms']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="check_in_date">Check-in Date</label>
                        <input type="date" id="check_in_date" name="check_in_date" required>
                    </div>

                    <div class="form-group">
                        <label for="check_out_date">Check-out Date</label>
                        <input type="date" id="check_out_date" name="check_out_date" required>
                    </div>

                    <div class="form-group">
                        <label for="price_per_room">Price per Room (₹)</label>
                        <input type="number" id="price_per_room" name="price_per_room" value="<?php echo htmlspecialchars($hotelDetails['price_per_room']); ?>" readonly>
                    </div>

                    <!-- Services Section -->
                    <div class="form-group">
                        <h4>Available Services</h4>
                        <ul id="servicesList">
                            <?php foreach ($hotelServices as $service): ?>
                                <li>
                                    <span><?php echo htmlspecialchars($service['service_name']); ?></span>
                                    <span class="service-price">₹<?php echo number_format($service['price'], 2); ?></span>
                                    <button type="button" class="toggle-service" data-price="<?php echo $service['price']; ?>">+</button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Display Total Price -->
                    <p>Room Price: ₹<span id="room_price">0</span></p>
                    <p>Service Price: ₹<span id="service_price">0</span></p>
                    <p>Total Price: ₹<span id="total_price">0</span></p>
                    <input type="hidden" name="total_price_input" id="total_price_input" value="">

                    <button type="submit" class="submit-btn">Confirm Booking</button>
                </form>
            </div>
        </div>

        <!-- Hotel Images Section -->
        <section class="hotel-images">
            <h2>Hotel Images</h2>
            <div class="image-gallery">
                <?php foreach ($hotelImages as $image): ?>
                    <img src="/uploads/hotel_images/<?php echo htmlspecialchars($image['image']); ?>" alt="Hotel Image">
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Hotel Services Section -->
        <section class="hotel-services">
            <h2>Available Services</h2>
            <div class="services-list">
                <?php foreach ($hotelServices as $service): ?>
                    <div class="service-item">
                        <h3><?php echo htmlspecialchars($service['service_name']); ?></h3>
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                        <p>Price: ₹<?php echo number_format($service['price'], 2); ?></p>
                        <p>Availability: <?php echo $service['availability'] ? 'Available' : 'Not Available'; ?></p>
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookRoomBtn = document.getElementById('bookRoomBtn');
        const bookingPopup = document.getElementById('bookingPopup');
        const closeBtn = document.querySelector('.popup .close');
        const roomInput = document.getElementById('no_of_rooms');
        const checkInInput = document.getElementById('check_in_date');
        const checkOutInput = document.getElementById('check_out_date');
        const roomPriceElement = document.getElementById('room_price');
        const servicePriceElement = document.getElementById('service_price');
        const totalPriceElement = document.getElementById('total_price');
        const totalPriceInput = document.getElementById('total_price_input');
        const maxRooms = parseInt(roomInput.getAttribute('max'));
        let roomPrice = parseFloat(document.getElementById('price_per_room').value);
        let serviceTotal = 0;
        let totalPrice = 0;

        // Disable past dates for check-in
        const today = new Date().toISOString().split('T')[0];
        checkInInput.setAttribute('min', today);

        // Handle change for check-in and restrict checkout to be after check-in
        checkInInput.addEventListener('change', function() {
            const checkInDateValue = checkInInput.value;
            checkOutInput.setAttribute('min', checkInDateValue);
            if (checkOutInput.value < checkInDateValue) {
                checkOutInput.value = checkInDateValue;
            }
            updateTotalPrice();
        });

        // Open popup form when "Book Room" button is clicked
        bookRoomBtn.addEventListener('click', function() {
            bookingPopup.style.display = 'block';
        });

        // Close popup form when close button is clicked
        closeBtn.addEventListener('click', function() {
            bookingPopup.style.display = 'none';
        });

        // Set default room price
        updateTotalPrice();

        // Calculate total price for rooms and services
        roomInput.addEventListener('input', function () {
            let noOfRooms = parseInt(roomInput.value);

            if (noOfRooms < 1) {
                noOfRooms = 1;
                roomInput.value = 1;
            }

            if (noOfRooms > maxRooms) {
                noOfRooms = maxRooms;
                roomInput.value = maxRooms;
            }

            updateTotalPrice();
        });

        // Handle adding/removing services
        document.querySelectorAll('.toggle-service').forEach(button => {
            button.addEventListener('click', function () {
                const servicePrice = parseFloat(button.getAttribute('data-price'));
                if (button.textContent === '+') {
                    button.textContent = '−'; // Select service
                } else {
                    button.textContent = '+'; // Deselect service
                }
                updateTotalPrice();
            });
        });

        // Calculate number of days between check-in and check-out
        checkOutInput.addEventListener('change', updateTotalPrice);

        function updateTotalPrice() {
            const noOfRooms = parseInt(roomInput.value);
            const checkInDate = new Date(checkInInput.value);
            const checkOutDate = new Date(checkOutInput.value);
            const days = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24)) || 1;

            // Recalculate service total based on the current number of rooms
            serviceTotal = 0;
            document.querySelectorAll('.toggle-service').forEach(button => {
                if (button.textContent === '−') { // Check if service is selected
                    const servicePrice = parseFloat(button.getAttribute('data-price'));
                    serviceTotal += servicePrice * noOfRooms;
                }
            });

            const roomTotal = noOfRooms * roomPrice * days;
            const serviceTotalForDays = serviceTotal * days;
            totalPrice = roomTotal + serviceTotalForDays;

            roomPriceElement.textContent = roomTotal.toFixed(2);
            servicePriceElement.textContent = serviceTotalForDays.toFixed(2);
            totalPriceElement.textContent = totalPrice.toFixed(2);
            totalPriceInput.value = totalPrice.toFixed(2);
        }

    });
    </script>
</body>
</html>
