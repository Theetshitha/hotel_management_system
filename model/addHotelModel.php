<?php
require_once __DIR__ . '/../config/config.php';

function addHotel($hotel_name, $location, $no_of_rooms, $price_per_room, $availability, $verified, $description, $hotel_images) {
    global $pdo;

    $total_price = $price_per_room * $no_of_rooms;

    try {
        $sql = "INSERT INTO tbl_hms_hotel (hotel_name, location, no_of_rooms, price, price_per_room, availability, verified, description)
                VALUES (:hotel_name, :location, :no_of_rooms, :price, :price_per_room, :availability, :verified, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':hotel_name' => $hotel_name,
            ':location' => $location,
            ':no_of_rooms' => $no_of_rooms,
            ':price' => $total_price,
            ':price_per_room' => $price_per_room,
            ':availability' => $availability,
            ':verified' => $verified,
            ':description' => $description
        ]);

        $hotel_id = $pdo->lastInsertId();

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

function addService($hotel_id, $service_name, $service_price, $service_availability, $service_description) {
    global $pdo;

    try {
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

        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function addServiceImage($service_id, $image) {
    global $pdo;

    try {
        $sql_img = "INSERT INTO tbl_hms_service_images (service_id, image) VALUES (:service_id, :image)";
        $stmt_img = $pdo->prepare($sql_img);
        $stmt_img->execute([
            ':service_id' => $service_id,
            ':image' => $image
        ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
