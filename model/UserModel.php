<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Insert a new user into the database
    public function insertUser($username, $email, $password, $profile_image, $bio, $address, $phone_number, $hobbies) {
        if ($this->userExists($email)) {
            throw new Exception('User with this email already exists.');
        }

        $sql = "INSERT INTO tbl_hms_user (username, email, password, profile_image, bio, address, phone_number, hobbies)
                VALUES (:username, :email, :password, :profile_image, :bio, :address, :phone_number, :hobbies)";
        $stmt = $this->pdo->prepare($sql);

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

    // Check if a user exists by email
    public function userExists($email) {
        $sql = "SELECT COUNT(*) FROM tbl_hms_user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Fetch user by email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM tbl_hms_user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch user by ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM tbl_hms_user WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user profile (with profile image)
    public function updateUserProfile($user_id, $name, $email, $phone_number, $bio, $profile_image) {
        $sql = "UPDATE tbl_hms_user 
                SET username = :name, email = :email, phone_number = :phone_number, bio = :bio, profile_image = :profile_image, updated_at = CURRENT_TIMESTAMP 
                WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':profile_image', $profile_image);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Update user (without profile image)
    public function updateUser($user_id, $name, $email, $phone_number, $bio) {
        $sql = "UPDATE tbl_hms_user 
                SET username = :name, email = :email, phone_number = :phone_number, bio = :bio, updated_at = CURRENT_TIMESTAMP 
                WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
?>
