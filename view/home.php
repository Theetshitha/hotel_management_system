<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/HotelController.php';

$hotelController = new HotelController($pdo);

$filters = [
    'country' => isset($_GET['country']) ? $_GET['country'] : '',
    'state' => isset($_GET['state']) ? $_GET['state'] : '',
    'city' => isset($_GET['city']) ? $_GET['city'] : '',
    'price_range' => isset($_GET['price_range']) ? $_GET['price_range'] : ''
];

$hotels = $hotelController->applyFilter($filters);
$countries = $hotelController->getCountries(); 
$states = $hotelController->getStates($filters['country']); 
$cities = $hotelController->getCities($filters['state']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelHub Home Page</title>
    <link rel="stylesheet" href="/view/src/styles/index.css">
</head>
<body>
    <div id="navbarHeader">
        <?php include __DIR__ . '/../view/partials/header.php'; ?>
    </div>

    <header class="banner">
        <div class="banner-content">
            <h1>Welcome to Hotel Hub</h1>
            <p>Discover the best hotels and book your rooms and services with us for your location.</p>
        </div>
    </header>

    <main class="main-content">
        <section class="introduction">
            <p>Explore our wide range of hotels and book your stay today!</p>
            <p>Book your stay with us and enjoy a comfortable and memorable experience.</p>
            <p>Thank you for choosing Hotel Hub for your travel needs. We look forward to serving you!</p>
        </section>

        <section class="filter-section">
            <form id="hotel-filter-form" method="GET" action="">
                <div class="filter-container">
                    <!-- Country Select -->
                    <select id="country-select" class="filter-select" name="country" data-country-name="">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $country): ?>
                            <option value="<?php echo $country['country_id']; ?>" 
                                data-country-name="<?php echo $country['country_name']; ?>" 
                                <?php echo $filters['country'] == $country['country_id'] ? 'selected' : ''; ?>>
                                <?php echo $country['country_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- State Select -->
                    <select id="state-select" class="filter-select" name="state" disabled data-state-name="">
                        <option value="">Select State</option>
                        <?php foreach ($states as $state): ?>
                            <option value="<?php echo $state['state_id']; ?>" 
                                data-state-name="<?php echo $state['state_name']; ?>" 
                                <?php echo $filters['state'] == $state['state_id'] ? 'selected' : ''; ?>>
                                <?php echo $state['state_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- City Select -->
                    <select id="city-select" class="filter-select" name="city" disabled data-city-name="">
                        <option value="">Select City</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?php echo $city['city_id']; ?>" 
                                data-city-name="<?php echo $city['city_name']; ?>" 
                                <?php echo $filters['city'] == $city['city_id'] ? 'selected' : ''; ?>>
                                <?php echo $city['city_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Price Range Select -->
                    <select id="price-range" class="filter-select" name="price_range">
                        <option value="">Select Price Range</option>
                        <option value="0-5000" <?php echo $filters['price_range'] == '0-5000' ? 'selected' : ''; ?>>0 - 5000</option>
                        <option value="5000-10000" <?php echo $filters['price_range'] == '5000-10000' ? 'selected' : ''; ?>>5000 - 10,000</option>
                        <option value="10000-20000" <?php echo $filters['price_range'] == '10000-20000' ? 'selected' : ''; ?>>10,000 - 20,000</option>
                        <option value="20000-50000" <?php echo $filters['price_range'] == '20000-50000' ? 'selected' : ''; ?>>20,000 - 50,000</option>
                        <option value="50000+" <?php echo $filters['price_range'] == '50000+' ? 'selected' : ''; ?>>50,000+</option>
                    </select>

                    <button type="submit" class="filter-btn">Filter</button>
                </div>
            </form>
        </section>

        <section class="hotel-cards">
            <h2>Famous Hotels</h2>
            <div class="card-container" id="hotel-list">
                <?php if (count($hotels) > 0): ?>
                    <?php foreach ($hotels as $hotel): ?>
                        <div class="hotel-card">
                            <img src="/uploads/hotel_images/<?php echo $hotel['image']; ?>" alt="<?php echo $hotel['hotel_name']; ?>">
                            <h3><?php echo $hotel['hotel_name']; ?></h3>
                            <p><?php echo $hotel['location']; ?></p>
                            <p><?php echo $hotel['description']; ?></p>
                            <div class="hotel-buttons">
                                <a href="/hotel-detailed-page?hotel_id=<?php echo intval($hotel['hotel_id']); ?>" class="view-details-btn">View Details</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hotels found for the selected filters.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <div id="footer">
        <?php include __DIR__ . '/../view/partials/footer.php'; ?>
    </div>

    <script>
    document.getElementById('hotel-filter-form').addEventListener('submit', function(e) {
    e.preventDefault(); 
    var countrySelect = document.getElementById('country-select');
    var stateSelect = document.getElementById('state-select');
    var citySelect = document.getElementById('city-select');

    var selectedCountryName = countrySelect.options[countrySelect.selectedIndex].getAttribute('data-country-name');
    var selectedStateName = stateSelect.disabled ? '' : stateSelect.options[stateSelect.selectedIndex].getAttribute('data-state-name');
    var selectedCityName = citySelect.disabled ? '' : citySelect.options[citySelect.selectedIndex].getAttribute('data-city-name');

    var priceRange = document.getElementById('price-range').value;

    
    selectedCountryName = selectedCountryName ? selectedCountryName : '';
    selectedStateName = selectedStateName ? selectedStateName : '';
    selectedCityName = selectedCityName ? selectedCityName : '';

    var newUrl = `http://localhost:8000/?country=${encodeURIComponent(selectedCountryName)}&state=${encodeURIComponent(selectedStateName)}&city=${encodeURIComponent(selectedCityName)}&price_range=${encodeURIComponent(priceRange)}`;
    window.location.href = newUrl;

});


document.getElementById('country-select').addEventListener('change', function() {
    var countryId = this.value;

    if (countryId) {
        fetch(`/controller/ajaxHandler.php?action=getStates&country_id=${countryId}`)
            .then(response => response.json())
            .then(data => {
                const stateSelect = document.getElementById('state-select');
                stateSelect.innerHTML = '<option value="">Select State</option>';
                data.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.state_id;
                    option.setAttribute('data-state-name', state.state_name);
                    option.textContent = state.state_name;
                    stateSelect.appendChild(option);
                });
                stateSelect.disabled = false; 
            })
            .catch(error => console.error('Error fetching states:', error));
    } else {
        document.getElementById('state-select').disabled = true;
        document.getElementById('state-select').innerHTML = '<option value="">Select State</option>';
        document.getElementById('city-select').disabled = true;
        document.getElementById('city-select').innerHTML = '<option value="">Select City</option>';
    }
});


document.getElementById('state-select').addEventListener('change', function() {
    var stateId = this.value;

    if (stateId) {
        fetch(`/controller/ajaxHandler.php?action=getCities&state_id=${stateId}`)
            .then(response => response.json())
            .then(data => {
                const citySelect = document.getElementById('city-select');
                citySelect.innerHTML = '<option value="">Select City</option>';
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.city_id;
                    option.setAttribute('data-city-name', city.city_name);
                    option.textContent = city.city_name;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false; 
            })
            .catch(error => console.error('Error fetching cities:', error));
    } else {
        document.getElementById('city-select').disabled = true;
        document.getElementById('city-select').innerHTML = '<option value="">Select City</option>';
    }
});


</script>
</body>
</html>
