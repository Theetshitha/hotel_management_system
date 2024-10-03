<?php
require __DIR__ . '/../middleware/AuthMiddleware.php';
require __DIR__ . '/../controller/AdminController.php';

$controller = new AdminController();
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
    case '/admin-add-hotel':
        AuthMiddleware::checkAdmin();
        include __DIR__ . '/../view/admin/addHotelForm.php';
        break;

    case '/admin-edit-hotel':
        AuthMiddleware::checkAdmin();
        include __DIR__ . '/../view/admin/editHotelForm.php';
        break;
    
    case '/admin-manage-hotels':
        AuthMiddleware::checkAdmin();
        include __DIR__ . '/../view/admin/adminHotelListing.php';
        break;

    case '/admin-signup':
        include __DIR__ . '/../view/admin/adminSignup.php';
        break;
    
    case '/logout':
        $controller->logout(); 
        break;

    // User routes
    case '/user-login':
        include __DIR__ . '/../view/user/userLogin.php';
        break;

    case '/user-signup':
        include __DIR__ . '/../view/user/userSignup.php';
        break;


    default:
        http_response_code(404);
        echo "Page not found.";
        break;
}
?>