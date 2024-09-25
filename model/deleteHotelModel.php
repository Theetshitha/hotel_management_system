<?php
class DeleteHotelModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function deleteHotel($hotel_id) {
        try {
            // Start transaction
            $this->pdo->beginTransaction();

            // Delete service images related to the hotel's services
            $sql = "DELETE si FROM tbl_hms_service_images si
                    INNER JOIN tbl_hms_service s ON si.service_id = s.service_id
                    WHERE s.hotel_id = :hotel_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['hotel_id' => $hotel_id]);

            // Delete services of the hotel
            $sql = "DELETE FROM tbl_hms_service WHERE hotel_id = :hotel_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['hotel_id' => $hotel_id]);

            // Delete hotel images
            $sql = "DELETE FROM tbl_hms_hotel_images WHERE hotel_id = :hotel_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['hotel_id' => $hotel_id]);

            // Delete the hotel itself
            $sql = "DELETE FROM tbl_hms_hotel WHERE hotel_id = :hotel_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['hotel_id' => $hotel_id]);

            // Commit transaction
            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            // Rollback transaction on error
            $this->pdo->rollBack();

            // Log the error and output a message
            error_log($e->getMessage());  // Logs error for debugging
            echo "Error occurred: " . htmlspecialchars($e->getMessage());

            return false;
        }
    }
}
?>
