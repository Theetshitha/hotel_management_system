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
// Fetch specific hotel data by ID
function getHotelById($hotel_id) {
    global $pdo;
    $sql = "SELECT * FROM tbl_hms_hotel WHERE hotel_id = :hotel_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':hotel_id' => $hotel_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fetch services by hotel ID
function getServicesByHotelId($hotel_id) {
    global $pdo;
    $sql = "SELECT * FROM tbl_hms_service WHERE hotel_id = :hotel_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':hotel_id' => $hotel_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Update hotel data in the database
function updateHotel($hotel_id, $hotel_name, $location, $no_of_rooms, $price_per_room, $availability, $verified, $description, $hotel_images) {
    global $pdo;
    
    // Calculate the total price
    $total_price = $price_per_room * $no_of_rooms;

    try {
        // Update hotel details
        $sql = "UPDATE tbl_hms_hotel 
                SET hotel_name = :hotel_name, location = :location, no_of_rooms = :no_of_rooms, price = :price, 
                    price_per_room = :price_per_room, availability = :availability, verified = :verified, description = :description
                WHERE hotel_id = :hotel_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':hotel_name' => $hotel_name,
            ':location' => $location,
            ':no_of_rooms' => $no_of_rooms,
            ':price' => $total_price,
            ':price_per_room' => $price_per_room,
            ':availability' => $availability,
            ':verified' => $verified,
            ':description' => $description,
            ':hotel_id' => $hotel_id
        ]);

        // Update hotel images (similar to addHotel function)
        // You can add logic to remove old images or overwrite them if necessary

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Update service data
function updateService($hotel_id, $service_name, $service_price, $service_availability, $service_description, $service_images) {
    global $pdo;

    try {
        // Update service details
        $sql = "UPDATE tbl_hms_service 
                SET service_name = :service_name, price = :price, availability = :availability, description = :description
                WHERE hotel_id = :hotel_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':service_name' => $service_name,
            ':price' => $service_price,
            ':availability' => $service_availability,
            ':description' => $service_description,
            ':hotel_id' => $hotel_id
        ]);

        // Update service images (similar to addService function)

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

?>
