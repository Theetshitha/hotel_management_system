<?php
require_once __DIR__ . '/../config/config.php';

function addHotel($hotel_name, $location, $country_name, $state_name, $address, $no_of_rooms, $price_per_room, $availability, $verified, $description, $hotel_images) {
    global $pdo;

    // Calculate the total price for all rooms
    $total_price = $price_per_room * $no_of_rooms;

    try {
        // Start a transaction to ensure atomicity
        $pdo->beginTransaction();

        // Insert hotel details into the hotel table
        $sql = "INSERT INTO tbl_hms_hotel (hotel_name, location, country, state, address, no_of_rooms, price, price_per_room, availability, verified, description)
                VALUES (:hotel_name, :location, :country, :state, :address, :no_of_rooms, :price, :price_per_room, :availability, :verified, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':hotel_name' => $hotel_name,
            ':location' => $location,        // Storing city name as location
            ':country' => $country_name,     // Storing country name
            ':state' => $state_name,         // Storing state name
            ':address' => $address,
            ':no_of_rooms' => $no_of_rooms,
            ':price' => $total_price,
            ':price_per_room' => $price_per_room,
            ':availability' => $availability,
            ':verified' => $verified,
            ':description' => $description
        ]);

        // Retrieve the last inserted hotel ID
        $hotel_id = $pdo->lastInsertId();

        // Insert hotel images into the hotel images table
        foreach ($hotel_images as $image) {
            $sql_img = "INSERT INTO tbl_hms_hotel_images (hotel_id, image) VALUES (:hotel_id, :image)";
            $stmt_img = $pdo->prepare($sql_img);
            $stmt_img->execute([
                ':hotel_id' => $hotel_id,
                ':image' => $image
            ]);
        }

        // Commit the transaction if everything is successful
        $pdo->commit();

        return $hotel_id;
    } catch (PDOException $e) {
        // Roll back the transaction if there is an error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getCountries() {
    global $pdo;
    $stmt = $pdo->query("SELECT country_id, country_name FROM tbl_hms_country");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStates($country_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT state_id, state_name FROM tbl_hms_state WHERE country_id = :country_id");
    $stmt->execute([':country_id' => $country_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCities($state_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT city_id, city_name FROM tbl_hms_city WHERE state_id = :state_id");
    $stmt->execute([':state_id' => $state_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCountryNameById($country_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT country_name FROM tbl_hms_country WHERE country_id = :country_id");
    $stmt->execute([':country_id' => $country_id]);
    return $stmt->fetchColumn();  // Fetches the single value (country name)
}

function getStateNameById($state_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT state_name FROM tbl_hms_state WHERE state_id = :state_id");
    $stmt->execute([':state_id' => $state_id]);
    return $stmt->fetchColumn();  // Fetches the single value (state name)
}

function getCityNameById($city_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT city_name FROM tbl_hms_city WHERE city_id = :city_id");
    $stmt->execute([':city_id' => $city_id]);
    return $stmt->fetchColumn();  // Fetches the single value (city name)
}

function addService($hotel_id, $service_name, $service_price, $service_availability, $service_description) {
    global $pdo;

    try {
        // Insert service details into the service table
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
        // Insert service images into the service images table
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
?>
