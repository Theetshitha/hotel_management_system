<?php
class HotelModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch all hotels with their respective images and ID
    public function getAllHotelsWithImages() {
        $sql = "
            SELECT h.hotel_id, h.hotel_name, h.location, h.description, i.image
            FROM tbl_hms_hotel h
            LEFT JOIN tbl_hms_hotel_images i ON h.hotel_id = i.hotel_id
            GROUP BY h.hotel_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construct full image path and limit description length
        foreach ($hotels as &$hotel) {
            // Limit description to 10-12 words
            if (!empty($hotel['description'])) {
                $words = explode(' ', $hotel['description']); 
                $limitedDescription = array_slice($words, 0, 9); 
                $hotel['description'] = implode(' ', $limitedDescription) . '...'; 
            }

            // Set image path or default image
            if ($hotel['image']) {
                $hotel['image'] = '/uploads/hotel_images/' . $hotel['image'];
            } else {
                $hotel['image'] = '/uploads/hotel_images/default.jpg'; 
            }
        }

        return $hotels;
    }
}
?>
