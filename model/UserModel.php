<?php
class UserModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Insert a new user into the database
    public function insertUser($username, $email, $password, $profile_image, $bio, $address, $phone_number, $hobbies) {
        // Check if user email already exists
        if ($this->userExists($email)) {
            throw new Exception('User with this email already exists.');
        }

        // Insert query
        $sql = "INSERT INTO tbl_hms_user (username, email, password, profile_image, bio, address, phone_number, hobbies)
                VALUES (:username, :email, :password, :profile_image, :bio, :address, :phone_number, :hobbies)";
        $stmt = $this->pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':profile_image', $profile_image);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':hobbies', $hobbies);

        return $stmt->execute();
    }

    // Check if a user with the given email exists
    public function userExists($email) {
        $sql = "SELECT COUNT(*) FROM tbl_hms_user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Fetch a user by email (for login)
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM tbl_hms_user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
