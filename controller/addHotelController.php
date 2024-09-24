<?php
// Include the hotel model
require_once __DIR__ . '/../model/addHotelModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $hotel_name = $_POST['hotel_name'];
    $location = $_POST['location'];
    $no_of_rooms = $_POST['no_of_rooms'];
    $price_per_room = $_POST['price'];
    $availability = $_POST['availability'];
    $verified = $_POST['verified'];
    $description = $_POST['description'];
    
    $service_name = $_POST['service_name'];
    $service_price = $_POST['service_price'];
    $service_availability = $_POST['service_availability'];
    $service_description = $_POST['service_description'];

    // Handle hotel images upload
    $hotel_images = [];
    if (isset($_FILES['hotel_image']) && count($_FILES['hotel_image']['name']) > 0) {
        $targetDir = __DIR__ . "/../uploads/hotel_images/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true); // Create the uploads directory if it doesn't exist
        }

        foreach ($_FILES['hotel_image']['name'] as $index => $imageName) {
            $fileTmpName = $_FILES['hotel_image']['tmp_name'][$index];
            $targetFilePath = $targetDir . basename($imageName);

            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                $hotel_images[] = $imageName; // Store the image name for database entry
            }
        }
    }

    // Handle service images upload
    $service_images = [];
    if (isset($_FILES['service_image']) && count($_FILES['service_image']['name']) > 0) {
        $targetDir = __DIR__ . "/../uploads/service_images/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true); // Create the uploads directory if it doesn't exist
        }

        foreach ($_FILES['service_image']['name'] as $index => $imageName) {
            $fileTmpName = $_FILES['service_image']['tmp_name'][$index];
            $targetFilePath = $targetDir . basename($imageName);

            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                $service_images[] = $imageName; // Store the image name for database entry
            }
        }
    }

    // Insert data into database using the model
    $hotel_id = addHotel($hotel_name, $location, $no_of_rooms, $price_per_room, $availability, $verified, $description, $hotel_images);

    if ($hotel_id) {
        addService($hotel_id, $service_name, $service_price, $service_availability, $service_description, $service_images);
        header("Location:/admin-dashboard?success=true");
    } else {
        echo "Failed to add hotel. Please try again.";
    }
}
?>
