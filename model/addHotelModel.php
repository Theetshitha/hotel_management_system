<?php
// Include the database connection file
require_once __DIR__ . '/../config/config.php';

// Function to add hotel data to the database
function addHotel($hotel_name, $location, $no_of_rooms, $price_per_room, $availability, $verified, $description, $hotel_images) {
    global $pdo;

    // Calculate the total price
    $total_price = $price_per_room * $no_of_rooms;

    try {
        // Insert into tbl_hms_hotel
        $sql = "INSERT INTO tbl_hms_hotel (hotel_name, location, no_of_rooms, price, price_per_room, availability, verified, description)
                VALUES (:hotel_name, :location, :no_of_rooms, :price, :price_per_room, :availability, :verified, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':hotel_name' => $hotel_name,
            ':location' => $location,
            ':no_of_rooms' => $no_of_rooms,
            ':price' => $total_price,  // Insert total price (price_per_room * no_of_rooms)
            ':price_per_room' => $price_per_room,
            ':availability' => $availability,
            ':verified' => $verified,
            ':description' => $description
        ]);

        // Get the last inserted hotel ID
        $hotel_id = $pdo->lastInsertId();

        // Insert hotel images
        foreach ($hotel_images as $image) {
            $sql_img = "INSERT INTO tbl_hms_hotel_images (hotel_id, image) VALUES (:hotel_id, :image)";
            $stmt_img = $pdo->prepare($sql_img);
            $stmt_img->execute([
                ':hotel_id' => $hotel_id,
                ':image' => $image
            ]);
        }

        return $hotel_id;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Function to add service data to the database
function addService($hotel_id, $service_name, $service_price, $service_availability, $service_description, $service_images) {
    global $pdo;

    try {
        // Insert into tbl_hms_service
        $sql = "INSERT INTO tbl_hms_service (hotel_id, service_name, price, availability, description)
                VALUES (:hotel_id, :service_name, :price, :availability, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':hotel_id' => $hotel_id,
            ':service_name' => $service_name,
            ':price' => $service_price,
            ':availability' => $service_availability,
            ':description' => $service_description
        ]);

        // Get the last inserted service ID
        $service_id = $pdo->lastInsertId();

        // Insert service images
        foreach ($service_images as $image) {
            $sql_img = "INSERT INTO tbl_hms_service_images (service_id, image) VALUES (:service_id, :image)";
            $stmt_img = $pdo->prepare($sql_img);
            $stmt_img->execute([
                ':service_id' => $service_id,
                ':image' => $image
            ]);
        }

        return $service_id;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>
