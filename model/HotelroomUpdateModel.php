<?php
class HotelModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Function to update the number of available rooms in the hotel
    public function updateNoOfRooms($hotel_id, $booked_rooms) {
        try {
            // Prepare the update query
            $sql = "UPDATE tbl_hms_hotel
                    SET no_of_rooms = no_of_rooms - :booked_rooms
                    WHERE hotel_id = :hotel_id AND no_of_rooms >= :booked_rooms";
            
            $stmt = $this->pdo->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
            $stmt->bindParam(':booked_rooms', $booked_rooms, PDO::PARAM_INT);

            // Execute the query
            if ($stmt->execute()) {
                return true; // Rooms updated successfully
            } else {
                return false; // Failed to update rooms
            }
        } catch (Exception $e) {
            // Handle exceptions
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
