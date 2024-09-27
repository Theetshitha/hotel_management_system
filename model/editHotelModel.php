<?php
class HotelModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getHotelById($hotel_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_hms_hotel WHERE hotel_id = :hotel_id");
        $stmt->execute(['hotel_id' => $hotel_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getServicesByHotelId($hotel_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_hms_service WHERE hotel_id = :hotel_id");
        $stmt->execute(['hotel_id' => $hotel_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateHotel($data) {
        $stmt = $this->pdo->prepare("UPDATE tbl_hms_hotel SET hotel_name = :hotel_name, location = :location, no_of_rooms = :no_of_rooms, price = :price, availability = :availability, verified = :verified, description = :description WHERE hotel_id = :hotel_id");
        $stmt->execute([
            'hotel_name' => $data['hotel_name'],
            'location' => $data['location'],
            'no_of_rooms' => $data['no_of_rooms'],
            'price' => $data['price'],
            'availability' => $data['availability'],
            'verified' => $data['verified'],
            'description' => $data['description'],
            'hotel_id' => $data['hotel_id']
        ]);

        // Update services
        $stmt = $this->pdo->prepare("UPDATE tbl_hms_service SET service_name = :service_name, price = :service_price, availability = :service_availability, description = :service_description WHERE hotel_id = :hotel_id");
        $stmt->execute([
            'service_name' => $data['service_name'],
            'service_price' => $data['service_price'],
            'service_availability' => $data['service_availability'],
            'service_description' => $data['service_description'],
            'hotel_id' => $data['hotel_id']
        ]);
    }
}
?>
