<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/HotelController.php';
require_once __DIR__ . '/../controller/addHotelController.php';


$hotelController = new HotelController($pdo);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getStates':
            if (isset($_GET['country_id'])) {
                $country_id = intval($_GET['country_id']);
                $states = $hotelController->getStates($country_id);
                echo json_encode($states);
            }
            break;
        case 'getCities':
            if (isset($_GET['state_id'])) {
                $state_id = intval($_GET['state_id']);
                $cities = $hotelController->getCities($state_id);
                echo json_encode($cities);
            }
            break;
    }
}
?>
