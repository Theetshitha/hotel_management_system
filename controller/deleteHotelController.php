<?php
require_once __DIR__ . '/../model/deleteHotelModel.php';

class DeleteHotelController {
    private $deleteHotelModel;

    public function __construct($pdo) {
        $this->deleteHotelModel = new DeleteHotelModel($pdo);
    }

    public function deleteHotel($hotel_id) {
        if (!$hotel_id) {
            echo "No hotel ID provided!";
            return;
        }

        echo "Attempting to delete hotel with ID: " . htmlspecialchars($hotel_id); // Sanitize output
        echo "Hotel ID: " . htmlspecialchars($hotel_id); // Sanitize output

        if ($this->deleteHotelModel->deleteHotel($hotel_id)) {
            header('Location: /admin-manage-hotels?success=1');
            exit();
        } else {
            header('Location: /admin-manage-hotels?error=1');
            exit();
        }
    }
}
?>
