<?php
class AdminModel {
    private $pdo;

    public function __construct() {
        // Access global PDO object (assuming it's in config.php)
        global $pdo;
        $this->pdo = $pdo;
    }

    // Insert a new admin into the database
    public function insertAdmin($admin_name, $admin_email, $admin_password, $profile_image) {
        // Check if admin name or email already exists
        if ($this->adminExists($admin_name, $admin_email)) {
            throw new Exception('Admin with this name or email already exists.');
        }

        // Insert query
        $sql = "INSERT INTO tbl_hms_admin (admin_name, admin_email, admin_password, profile_image) 
                VALUES (:admin_name, :admin_email, :admin_password, :profile_image)";
        $stmt = $this->pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':admin_name', $admin_name);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->bindParam(':admin_password', $admin_password);
        $stmt->bindParam(':profile_image', $profile_image);

        // Execute and return the result
        return $stmt->execute();
    }

    // Check if an admin with the given name or email exists
    public function adminExists($admin_name, $admin_email) {
        $sql = "SELECT COUNT(*) FROM tbl_hms_admin WHERE admin_name = :admin_name OR admin_email = :admin_email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':admin_name', $admin_name);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Fetch an admin by email (for login)
    public function getAdminByEmail($admin_email) {
        $sql = "SELECT * FROM tbl_hms_admin WHERE admin_email = :admin_email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
