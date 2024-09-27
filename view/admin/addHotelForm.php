<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hotel</title>
    <link rel="stylesheet" href="/view/src/styles/addHotelForm.css">
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../partials/header.php'; ?>
    </div>

    <main class="form-container">
        <div class="form-header">
            <h2>Add Hotel</h2>
            <a href="/admin-dashboard"><button class="btn-primary">Back</button></a>
        </div>

        <form action="../../controller/addHotelController.php" method="POST" enctype="multipart/form-data" class="add-hotel-form">
            <!-- Hotel Information -->
            <div class="form-row">
                <div class="form-group">
                    <label for="hotel_name">Hotel Name</label>
                    <input type="text" id="hotel_name" name="hotel_name" required>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="no_of_rooms">Number of Rooms</label>
                    <input type="number" id="no_of_rooms" name="no_of_rooms" min="1" required>
                </div>
            </div>

            <!-- Pricing and Status -->
            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="availability">Availability</label>
                    <select id="availability" name="availability" required>
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="verified">Verified</label>
                    <select id="verified" name="verified" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <!-- Hotel Description -->
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="description">Hotel Description</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
            </div>

            <!-- Hotel Images -->
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="hotel_image">Upload Hotel Images</label>
                    <input type="file" id="hotel_image" name="hotel_image[]" accept="image/*" multiple>
                </div>
            </div>

            <h3>Add Services</h3>

            <!-- Service Information -->
            <div class="form-row">
                <div class="form-group">
                    <label for="service_name">Service Name</label>
                    <input type="text" id="service_name" name="service_name" required>
                </div>

                <div class="form-group">
                    <label for="service_price">Service Price</label>
                    <input type="number" step="0.01" id="service_price" name="service_price" required>
                </div>

                <div class="form-group">
                    <label for="service_availability">Service Availability</label>
                    <select id="service_availability" name="service_availability" required>
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>
            </div>

            <!-- Service Description -->
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="service_description">Service Description</label>
                    <textarea id="service_description" name="service_description" rows="4" required></textarea>
                </div>
            </div>

            <!-- Service Images -->
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="service_image">Upload Service Images</label>
                    <input type="file" id="service_image" name="service_image[]" accept="image/*" multiple>
                </div>
            </div>

            <!-- Submit and Reset Buttons -->
            <div class="form-group">
                <button type="submit" class="btn-primary">Add Hotel</button>
                <button type="reset" class="btn-primary">Reset</button>
            </div>
        </form>
    </main>

    <div class="footer_div">
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>
    
</body>
</html>
