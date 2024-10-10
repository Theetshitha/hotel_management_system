<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/BookingModel.php';
require_once __DIR__ . '/../model/HotelroomUpdateModel.php'; 

class BookingController {
    private $bookingModel;
    private $hotelModel;

    public function __construct($pdo) {
        $this->bookingModel = new BookingModel($pdo);
        $this->hotelModel = new HotelModel($pdo); // Add HotelModel to handle room updates
    }

    public function bookRoom($bookingData) {
        // Attempt to create the booking
        if ($this->bookingModel->createBooking($bookingData)) {
            // If booking is successful, reduce the number of available rooms
            return $this->hotelModel->updateNoOfRooms($bookingData['hotel_id'], $bookingData['no_of_rooms']);
        }
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
        header("Location: /user-login");
        exit();
    }

    // Fetch user ID from the session
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        header("Location: /view/hotelDetailPage.php?hotel_id=" . $_POST['hotel_id'] . "&error=invalid_user");
        exit();
    }

    $hotel_id = intval($_POST['hotel_id']);
    $no_of_rooms = intval($_POST['no_of_rooms']);
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $price_per_room = floatval($_POST['price_per_room']);
    $total_price = floatval($_POST['total_price_input']);

    $bookingData = [
        'user_id' => $user_id,
        'hotel_id' => $hotel_id,
        'no_of_rooms' => $no_of_rooms,
        'check_in_date' => $check_in_date,
        'check_out_date' => $check_out_date,
        'price_per_room' => $price_per_room,
        'total_price' => $total_price
    ];

    $controller = new BookingController($pdo);

    if ($controller->bookRoom($bookingData)) {
        // Success
        header('Location:/hotel-detailed-page?hotel_id=' . $hotel_id . '&message=successfully_room_booked');
    } else {
        // Failure
        header('Location: /view/hotelDetailPage.php?hotel_id=' . $hotel_id . '&error=booking_failed');
    }
}
