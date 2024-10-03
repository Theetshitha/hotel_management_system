<?php
session_start();

class AuthMiddleware {
    // Admin session check
    public static function checkAdmin() {
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            header("Location: /admin-login");
            exit();
        }
    }

    // User session check
    public static function checkUser() {
        if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
            header("Location: /user-login");
            exit();
        }
    }
}
?>
