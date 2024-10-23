<?php
class AdminModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Insert a new admin into the database
    public function insertAdmin($admin_name, $admin_email, $admin_password, $profile_image) {
        if ($this->adminExists($admin_email)) {
            throw new Exception('Admin with this email already exists.');
        }

        $sql = "INSERT INTO tbl_hms_admin (admin_name, admin_email, admin_password, profile_image) 
                VALUES (:admin_name, :admin_email, :admin_password, :profile_image)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':admin_name', $admin_name);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->bindParam(':admin_password', $admin_password);
        $stmt->bindParam(':profile_image', $profile_image);

        return $stmt->execute();
    }

    // Check if an admin exists by email
    public function adminExists($admin_email) {
        $sql = "SELECT COUNT(*) FROM tbl_hms_admin WHERE admin_email = :admin_email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Fetch admin by email (used for login)
    public function getAdminByEmail($admin_email) {
        $sql = "SELECT * FROM tbl_hms_admin WHERE admin_email = :admin_email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch admin by ID
    public function getAdminById($admin_id) {
        $sql = "SELECT * FROM tbl_hms_admin WHERE admin_id = :admin_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':admin_id', $admin_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update admin profile
    public function updateAdminProfile($admin_id, $name, $email, $phone_number, $bio, $profile_image) {
        $sql = "UPDATE tbl_hms_admin 
                SET admin_name = :name, admin_email = :email, phone_number = :phone_number, bio = :bio, profile_image = :profile_image, updated_at = CURRENT_TIMESTAMP 
                WHERE admin_id = :admin_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':profile_image', $profile_image);
        $stmt->bindParam(':admin_id', $admin_id);
        return $stmt->execute();
    }

    // Update admin (without profile image)
    public function updateAdmin($admin_id, $name, $email, $phone_number, $bio) {
        $sql = "UPDATE tbl_hms_admin 
                SET admin_name = :name, admin_email = :email, phone_number = :phone_number, bio = :bio, updated_at = CURRENT_TIMESTAMP 
                WHERE admin_id = :admin_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':admin_id', $admin_id);
        return $stmt->execute();
    }
}
?>
