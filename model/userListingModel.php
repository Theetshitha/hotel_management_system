<?php
require_once __DIR__ . '/../config/config.php';

class UserListingModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUsers() {
        $sql = "SELECT user_id, profile_image, username, email, bio, address, phone_number, hobbies FROM tbl_hms_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUserAndBookings($userId) {
        try {
            $this->pdo->beginTransaction();

            $sql = "DELETE FROM tbl_hms_booking WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $sql = "DELETE FROM tbl_hms_user WHERE user_id = :user_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
