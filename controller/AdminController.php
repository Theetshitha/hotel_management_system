<?php
require __DIR__ . '/../config/config.php'; 
require __DIR__ . '/../model/AdminModel.php';
session_start(); 

class AdminController {
    private $adminModel;

    public function __construct() {
        
        $this->adminModel = new AdminModel();
    }

    // Handle admin signup
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $admin_name = $_POST['admin_name'];
            $admin_email = $_POST['admin_email'];
            $admin_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);
            $profile_image = '';

            // Handle file upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $fileName = basename($_FILES["profile_image"]["name"]);
                $targetDir = __DIR__ . "/../uploads/";
                $targetFilePath = $targetDir . $fileName;

                // Ensure the upload directory exists and has the correct permissions
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true); // Create the uploads directory if it doesn't exist
                }

                if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {
                    $profile_image = $fileName;
                }
            }

            // Insert admin into the database
            try {
                if ($this->adminModel->insertAdmin($admin_name, $admin_email, $admin_password, $profile_image)) {
                    // Redirect to login page on successful signup
                    header("Location: ../view/admin/adminLogin.php");
                    exit();
                } else {
                    echo "Failed to signup admin.";
                }
            } catch (Exception $e) {
                // Handle any errors (duplicate mail)
                echo $e->getMessage();
            }
        }
    }

    // Handle admin login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $admin_email = $_POST['admin_email'];
            $admin_password = $_POST['admin_password'];

            // Fetch the admin from the database by email
            $admin = $this->adminModel->getAdminByEmail($admin_email);

            if ($admin && password_verify($admin_password, $admin['admin_password'])) {
                // Set session variables for logged-in admin
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_name'] = $admin['admin_name'];

                // Redirect to the dashboard
                header("Location: /admin-dashboard");
                exit();
            } else {
                echo "Invalid login credentials.";
            }
        }
    }

    // Handle admin logout
    public function logout() {
        session_start(); 
        session_destroy(); 
        // Redirect to home page after logout
        header("Location: /");
        exit();
    }
}

// Route based on the request type (signup, login, or logout)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $controller = new AdminController();
    $controller->login();
} elseif (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $controller = new AdminController();
    $controller->logout();
} else {
    $controller = new AdminController();
    $controller->signup();
}
?>
