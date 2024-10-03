<?php
require_once __DIR__ . '/../model/hotelDetailModel.php';

class HotelDetailController {
    private $hotelDetailModel;

    public function __construct($pdo) {
        $this->hotelDetailModel = new HotelDetailModel($pdo);
    }

    // Fetch the hotel details based on hotel_id
    public function getHotelDetails($hotel_id) {
        return $this->hotelDetailModel->fetchHotelDetails($hotel_id);
    }

    // Fetch services for the given hotel_id
    public function getHotelServices($hotel_id) {
        $services = $this->hotelDetailModel->fetchHotelServices($hotel_id);
        
        // Fetch images for each service
        foreach ($services as &$service) {
            $service['images'] = $this->hotelDetailModel->fetchServiceImages($service['service_id']);
        }
        
        return $services;
    }

    // Fetch hotel images
    public function getHotelImages($hotel_id) {
        return $this->hotelDetailModel->fetchHotelImages($hotel_id);
    }
}
?>
