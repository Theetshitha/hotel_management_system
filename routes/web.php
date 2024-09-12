<?php
require __DIR__ . '/../middleware/AuthMiddleware.php';
require __DIR__ . '/../controller/AdminController.php';

// Parse the URL
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route based on the URL path
switch ($requestUri) {
    case '/':
        include __DIR__ . '/../view/home.php';
        break;
    case '/HotelHub':
        include __DIR__ . '/../view/home.php';
        break;
        
    case '/admin-login':
        include __DIR__ . '/../view/admin/adminLogin.php';
        break;

    case '/admin-dashboard':
        AuthMiddleware::checkAdmin();
        include __DIR__ . '/../view/admin/adminDashboard.php';
        break;

    case '/admin-signup':
        include __DIR__ . '/../view/admin/adminSignup.php';
        break;
    // case '/logout':
    //     require __DIR__ . '/../controller/logout.php';
    //     break;
    case '/logout':
        // Directly call the logout method from AdminController without any extra include
        $adminController = new AdminController();
        $adminController->logout();
        break;
    default:
        http_response_code(404);
        echo "Page not found.";
        break;
}
?>
