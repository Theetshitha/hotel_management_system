<?php
require_once __DIR__ . '/AdminModel.php';

class AdminModel1 {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAdminById($admin_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_hms_admin WHERE admin_id = :admin_id");
        $stmt->execute([':admin_id' => $admin_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAdminProfile($admin_id, $admin_name, $admin_email, $phone, $bio, $profile_image = null) {
        $sql = "UPDATE tbl_hms_admin SET admin_name = :admin_name, admin_email = :admin_email, phone_number = :phone, bio = :bio";
        if ($profile_image) {
            $sql .= ", profile_image = :profile_image";
        }
        $sql .= " WHERE admin_id = :admin_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':admin_name', $admin_name);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':bio', $bio);
        if ($profile_image) {
            $stmt->bindParam(':profile_image', $profile_image);
        }
        $stmt->bindParam(':admin_id', $admin_id);
        return $stmt->execute();
    }
}
