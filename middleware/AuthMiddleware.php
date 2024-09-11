<?php
session_start();

class AuthMiddleware {
    public static function checkAdmin() {
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            header("Location: /admin-login");
            exit();
        }
    }
}
?>
