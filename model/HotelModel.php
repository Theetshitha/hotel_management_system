<?php
class HotelModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch all hotels with their respective images
    public function getAllHotelsWithImages() {
        $sql = "
            SELECT h.hotel_name, h.location, h.description, i.image
            FROM tbl_hms_hotel h
            LEFT JOIN tbl_hms_hotel_images i ON h.hotel_id = i.hotel_id
            GROUP BY h.hotel_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construct full image path
        foreach ($hotels as &$hotel) {
            if ($hotel['image']) {
                $hotel['image'] = '/uploads/hotel_images/' . $hotel['image']; // Add the path to the image name
            } else {
                $hotel['image'] = '/uploads/hotel_images/default.jpg'; // Fallback if no image is found
            }
        }

        return $hotels;
    }
}
?>
