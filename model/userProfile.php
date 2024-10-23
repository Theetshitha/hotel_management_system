<?php
require_once __DIR__ . '/UserModel.php';

class UserModel1 {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserById($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_hms_users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserProfile($user_id, $username, $email, $phone, $bio, $profile_image = null) {
        $sql = "UPDATE tbl_hms_users SET username = :username, email = :email, phone_number = :phone, bio = :bio";
        if ($profile_image) {
            $sql .= ", profile_image = :profile_image";
        }
        $sql .= " WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':bio', $bio);
        if ($profile_image) {
            $stmt->bindParam(':profile_image', $profile_image);
        }
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
