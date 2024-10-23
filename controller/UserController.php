<?php
require __DIR__ . '/../config/config.php'; 
require __DIR__ . '/../model/UserModel.php'; 
session_start(); // Start the session

class UserController {
    private $userModel;

    // Update the constructor to accept $pdo
    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    // user signup
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $profile_image = '';
            $bio = $_POST['bio'] ?? null;
            $address = $_POST['address'] ?? null;
            $phone_number = $_POST['phone_number'] ?? null;
            $hobbies = $_POST['hobbies'] ?? null;

            // file upload for profile image
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $fileName = basename($_FILES["profile_image"]["name"]);
                $targetDir = __DIR__ . "/../uploads/";
                $targetFilePath = $targetDir . $fileName;

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {
                    $profile_image = $fileName;
                }
            }

            // Insert user into the database
            try {
                if ($this->userModel->insertUser($username, $email, $password, $profile_image, $bio, $address, $phone_number, $hobbies)) {
                    header("Location: ../view/user/userLogin.php");
                    exit();
                } else {
                    echo "Failed to sign up user.";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    // user login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Fetch the user from the database by email
            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Set session variables for logged-in user
                $_SESSION['user_logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['user_id']; // Store user_id in session

                echo json_encode([
                    'status' => 'success',
                    'user_id' => $user['user_id']
                ]);

                // Redirect to the user dashboard
                header("Location: /");
                exit();
            } else {
                echo "Invalid login credentials.";
            }
        }
    }

    // user logout
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /");
        exit();
    }
}

// Handle POST requests for signup and login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_login'])) {
    // Pass $pdo to UserController
    $controller = new UserController($pdo);
    $controller->login();
} elseif (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Pass $pdo to UserController
    $controller = new UserController($pdo);
    $controller->logout();
} else {
    // Pass $pdo to UserController
    $controller = new UserController($pdo);
    $controller->signup();
}
?>
