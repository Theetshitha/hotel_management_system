<?php
class BookingModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createBooking($data) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO tbl_hms_booking 
                (user_id, hotel_id, no_of_rooms, check_in_date, check_out_date, price_per_room, total_price, booking_status) 
                VALUES 
                (:user_id, :hotel_id, :no_of_rooms, :check_in_date, :check_out_date, :price_per_room, :total_price, 'booked')
            ");

            $stmt->execute([
                ':user_id' => $data['user_id'],
                ':hotel_id' => $data['hotel_id'],
                ':no_of_rooms' => $data['no_of_rooms'],
                ':check_in_date' => $data['check_in_date'],
                ':check_out_date' => $data['check_out_date'],
                ':price_per_room' => $data['price_per_room'],
                ':total_price' => $data['total_price']
            ]);

            return true;
        } catch (PDOException $e) {
            // Log the error message
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
