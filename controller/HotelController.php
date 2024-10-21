<?php
require __DIR__. '/../model/HotelModel.php';

class HotelController {
    private $hotelModel;

    public function __construct($pdo) {
        $this->hotelModel = new HotelModel($pdo);
    }

    public function displayHotels() {
        $hotels = $this->hotelModel->getAllHotelsWithImages();
        return $hotels;
    }
// Fetch all countries
public function getCountries() {
    return $this->hotelModel->getAllCountries();
}

// Fetch states by country ID
public function getStates($country_id) {
    return $this->hotelModel->getStatesByCountry($country_id);
}

// Fetch cities by state ID
public function getCities($state_id) {
    return $this->hotelModel->getCitiesByState($state_id);
}

public function applyFilter($filters) {
    return $this->hotelModel->getAllFilteredHotels($filters);
}

}
?>
