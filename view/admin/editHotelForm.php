<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controller/editHotelController.php';

$hotel_id = $_GET['hotel_id'];
$editController = new EditHotelController($pdo);
$hotelData = $editController->fetchHotelData($hotel_id);
$servicesData = $editController->fetchServicesData($hotel_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hotel</title>
    <link rel="stylesheet" href="/view/src/styles/addHotelForm.css">
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <main class="form-container">
        <div class="form-header">
            <h2>Edit Hotel</h2>
            <a href="/admin-manage-hotels"><button class="btn-primary">Back</button></a>
        </div>

        <form action="../../controller/editHotelController.php?hotel_id=<?php echo $hotel_id; ?>" method="POST" enctype="multipart/form-data" class="add-hotel-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="hotel_name">Hotel Name</label>
                    <input type="text" id="hotel_name" name="hotel_name" value="<?php echo htmlspecialchars($hotelData['hotel_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($hotelData['location']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_of_rooms">Number of Rooms</label>
                    <input type="number" id="no_of_rooms" name="no_of_rooms" value="<?php echo htmlspecialchars($hotelData['no_of_rooms']); ?>" min="1" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($hotelData['price']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="availability">Availability</label>
                    <select id="availability" name="availability" required>
                        <option value="1" <?php echo $hotelData['availability'] ? 'selected' : ''; ?>>Available</option>
                        <option value="0" <?php echo !$hotelData['availability'] ? 'selected' : ''; ?>>Not Available</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="verified">Verified</label>
                    <select id="verified" name="verified" required>
                        <option value="1" <?php echo $hotelData['verified'] ? 'selected' : ''; ?>>Yes</option>
                        <option value="0" <?php echo !$hotelData['verified'] ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="description">Hotel Description</label>
                    <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($hotelData['description']); ?></textarea>
                </div>
            </div>
            <h3>Add Services</h3>
            <?php foreach ($servicesData as $service): ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="service_name">Service Name</label>
                    <input type="text" id="service_name" name="service_name" value="<?php echo htmlspecialchars($service['service_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="service_price">Service Price</label>
                    <input type="number" step="0.01" id="service_price" name="service_price" value="<?php echo htmlspecialchars($service['price']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="service_availability">Service Availability</label>
                    <select id="service_availability" name="service_availability" required>
                        <option value="1" <?php echo $service['availability'] ? 'selected' : ''; ?>>Available</option>
                        <option value="0" <?php echo !$service['availability'] ? 'selected' : ''; ?>>Not Available</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="service_description">Service Description</label>
                    <textarea id="service_description" name="service_description" rows="4" required><?php echo htmlspecialchars($service['description']); ?></textarea>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="form-group">
                <button type="submit" class="btn-primary">Update Hotel</button>
            </div>
        </form>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>
</body>
</html>