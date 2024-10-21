<?php
class AdminModel {
    private $pdo;

    public function __construct() {
        
        global $pdo;
        $this->pdo = $pdo;
    }

    
    public function insertAdmin($admin_name, $admin_email, $admin_password, $profile_image) {
        
        if ($this->adminExists( $admin_email)) {
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

    
    public function adminExists( $admin_email) {
        $sql = "SELECT COUNT(*) FROM tbl_hms_admin WHERE admin_email = :admin_email";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    
    public function getAdminByEmail($admin_email) {
        $sql = "SELECT * FROM tbl_hms_admin WHERE admin_email = :admin_email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
