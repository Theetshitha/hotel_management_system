<?php
require_once __DIR__ . '/../model/AdminModel.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../config/config.php';

class ProfileController {
    private $pdo;
    public $is_admin;
    private $model;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        session_start();
        $this->checkSession();
    }

    private function checkSession() {
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
            $this->is_admin = true;
            $this->model = new AdminModel($this->pdo);
        } elseif (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
            $this->is_admin = false;
            $this->model = new UserModel($this->pdo);
        } else {
            header("Location: /user-login");
            exit();
        }
    }

    public function showProfile() {
        if ($this->is_admin) {
            return $this->model->getAdminById($_SESSION['admin_id']);
        } else {
            return $this->model->getUserById($_SESSION['user_id']);
        }
    }

    public function updateProfile() {
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $bio = $_POST['bio'];
        


        if ($this->is_admin) {
            $this->model->updateAdminProfile($user_id, $name, $email, $phone, $bio);
        } else {
            $this->model->updateUserProfile($user_id, $name, $email, $phone, $bio);
        }

        header("Location:/profile-page");
        exit();
    }
}
