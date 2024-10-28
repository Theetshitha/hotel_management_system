<?php
require_once __DIR__ . '/../config/config.php';

class BookingListingModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function fetchBookings() {
        $sql = "
            SELECT 
                b.booking_id, b.no_of_rooms, b.price_per_room, b.check_in_date, b.check_out_date, b.total_price, b.booking_status,
                h.hotel_name, h.location, h.no_of_rooms AS hotel_rooms, h.availability,
                u.username, u.phone_number
            FROM tbl_hms_booking b
            JOIN tbl_hms_hotel h ON b.hotel_id = h.hotel_id
            JOIN tbl_hms_user u ON b.user_id = u.user_id
            ORDER BY b.created_at DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBooking($booking_id) {
        try {
            $this->pdo->beginTransaction();

            // Fetch the number of rooms booked and hotel ID
            $sqlFetch = "SELECT no_of_rooms, hotel_id FROM tbl_hms_booking WHERE booking_id = :booking_id";
            $stmtFetch = $this->pdo->prepare($sqlFetch);
            $stmtFetch->execute(['booking_id' => $booking_id]);
            $bookingData = $stmtFetch->fetch(PDO::FETCH_ASSOC);

            if (!$bookingData) {
                $this->pdo->rollBack();
                return false;
            }

            $no_of_rooms = $bookingData['no_of_rooms'];
            $hotel_id = $bookingData['hotel_id'];

            // Update the no_of_rooms in tbl_hms_hotel
            $sqlUpdateRooms = "UPDATE tbl_hms_hotel SET no_of_rooms = no_of_rooms + :no_of_rooms WHERE hotel_id = :hotel_id";
            $stmtUpdate = $this->pdo->prepare($sqlUpdateRooms);
            $stmtUpdate->execute(['no_of_rooms' => $no_of_rooms, 'hotel_id' => $hotel_id]);

            // Delete booking
            $sqlDelete = "DELETE FROM tbl_hms_booking WHERE booking_id = :booking_id";
            $stmtDelete = $this->pdo->prepare($sqlDelete);
            $stmtDelete->execute(['booking_id' => $booking_id]);

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
?>
