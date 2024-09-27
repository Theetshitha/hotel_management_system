<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../model/editHotelModel.php';

class EditHotelController {
    private $hotelModel;

    public function __construct($pdo) {
        $this->hotelModel = new HotelModel($pdo);
    }

    public function fetchHotelData($hotel_id) {
        return $this->hotelModel->getHotelById($hotel_id);
    }

    public function fetchServicesData($hotel_id) {
        return $this->hotelModel->getServicesByHotelId($hotel_id);
    }

    public function updateHotelData($data) {
        return $this->hotelModel->updateHotel($data);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hotel_id = $_GET['hotel_id'];
    $data = [
        'hotel_id' => $hotel_id,
        'hotel_name' => $_POST['hotel_name'],
        'location' => $_POST['location'],
        'no_of_rooms' => $_POST['no_of_rooms'],
        'price' => $_POST['price'],
        'availability' => $_POST['availability'],
        'verified' => $_POST['verified'],
        'description' => $_POST['description'],
        'service_name' => $_POST['service_name'],
        'service_price' => $_POST['service_price'],
        'service_availability' => $_POST['service_availability'],
        'service_description' => $_POST['service_description'],
    ];

    $editController = new EditHotelController($pdo);
    $editController->updateHotelData($data);
    header("Location: /admin-manage-hotels?success=1");
    exit;
}
?>