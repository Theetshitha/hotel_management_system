<?php
$host = 'localhost';
$dbname = 'db_hotel_management_system';
$username = 'dckap';
$password = 'Dckap2023Ecommerce';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection failure
    die("Connection failed: " . $e->getMessage());
}
?>
