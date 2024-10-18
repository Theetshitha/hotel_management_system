<?php
require_once __DIR__ . '/../model/addHotelModel.php';

// Handle AJAX requests for fetching states and cities
if (isset($_GET['action']) && $_GET['action'] == 'getStates') {
    $country_id = $_GET['country_id'];
    $states = getStates($country_id);
    echo json_encode($states);
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'getCities') {
    $state_id = $_GET['state_id'];
    $cities = getCities($state_id);
    echo json_encode($cities);
    exit();
}

// Handle form submission for adding a hotel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel_name = $_POST['hotel_name'];
    $country_id = $_POST['country'];
    $state_id = $_POST['state'];
    $city_id = $_POST['city'];
    $address = $_POST['address'];
    $no_of_rooms = $_POST['no_of_rooms'];
    $price_per_room = $_POST['price'];
    $availability = $_POST['availability'];
    $verified = $_POST['verified'];
    $description = $_POST['description'];

    $service_name = $_POST['service_name'];
    $service_price = $_POST['service_price'];
    $service_availability = $_POST['service_availability'];
    $service_description = $_POST['service_description'];

    // Fetch country, state, and city names
    $country_name = getCountryNameById($country_id);
    $state_name = getStateNameById($state_id);
    $city_name = getCityNameById($city_id);

    // Handle hotel images upload
    $hotel_images = [];
    if (isset($_FILES['hotel_image']['name']) && count($_FILES['hotel_image']['name']) > 0) {
        $targetDir = __DIR__ . "/../uploads/hotel_images/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true); 
        }

        foreach ($_FILES['hotel_image']['name'] as $index => $imageName) {
            $fileTmpName = $_FILES['hotel_image']['tmp_name'][$index];
            $targetFilePath = $targetDir . basename($imageName);

            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                $hotel_images[] = $imageName; 
            }
        }
    }

    // Insert hotel data into the database with country, state, and city names
    $hotel_id = addHotel($hotel_name, $city_name, $country_name, $state_name, $address, $no_of_rooms, $price_per_room, $availability, $verified, $description, $hotel_images);

    if ($hotel_id) {
        // Handle service images upload
        $service_images = [];
        if (isset($_FILES['service_image']['name']) && count($_FILES['service_image']['name']) > 0) {
            $targetDir = __DIR__ . "/../uploads/service_images/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            foreach ($_FILES['service_image']['name'] as $index => $imageName) {
                $fileTmpName = $_FILES['service_image']['tmp_name'][$index];
                $targetFilePath = $targetDir . basename($imageName);

                if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                    $service_images[$index][] = $imageName; // Collecting images by service index
                }
            }
        }

        // Loop through each service and insert into the database
        foreach ($service_name as $index => $name) {
            $service_id = addService($hotel_id, $name, $service_price[$index], $service_availability[$index], $service_description[$index]);

            if ($service_id && isset($service_images[$index])) {
                foreach ($service_images[$index] as $image) {
                    addServiceImage($service_id, $image); // Store each service's images in DB
                }
            }
        }

        header("Location:/admin-dashboard?success=true");
    } else {
        echo "Failed to add hotel. Please try again.";
    }
}
?>
