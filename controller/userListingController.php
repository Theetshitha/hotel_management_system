<?php
require_once __DIR__ . '/../model/userListingModel.php';

class UserListingController {
    private $model;

    public function __construct($pdo) {
        $this->model = new UserListingModel($pdo);
    }

    public function listUsers() {
        return $this->model->getUsers();
    }

    public function deleteUser($userId) {
        return $this->model->deleteUserAndBookings($userId);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $controller = new UserListingController($pdo);
    $userId = $_POST['user_id'];
    $result = $controller->deleteUser($userId);

    echo $result ? 'success' : 'error';
}
