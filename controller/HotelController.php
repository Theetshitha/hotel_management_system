<?php
require_once __DIR__ . '/../model/HotelModel.php';

class HotelController {
    private $hotelModel;

    public function __construct($pdo) {
        $this->hotelModel = new HotelModel($pdo);
    }

    // Fetch hotels and pass them to the view
    public function displayHotels() {
        $hotels = $this->hotelModel->getAllHotelsWithImages();
        return $hotels;
    }
}
?>
