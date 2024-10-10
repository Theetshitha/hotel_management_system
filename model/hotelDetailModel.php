<?php
class HotelDetailModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch hotel details
    public function fetchHotelDetails($hotel_id) {
        $sql = "
            SELECT hotel_id, hotel_name, location, description, price_per_room, no_of_rooms
            FROM tbl_hms_hotel
            WHERE hotel_id = :hotel_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch services for the hotel
    public function fetchHotelServices($hotel_id) {
        $sql = "
            SELECT service_id, service_name, description, price, availability
            FROM tbl_hms_service
            WHERE hotel_id = :hotel_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch images for the hotel services
    public function fetchServiceImages($service_id) {
        $sql = "
            SELECT image
            FROM tbl_hms_service_images
            WHERE service_id = :service_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch hotel and service images
    public function fetchHotelImages($hotel_id) {
        $sql = "
            SELECT i.image 
            FROM tbl_hms_hotel_images i
            WHERE i.hotel_id = :hotel_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>