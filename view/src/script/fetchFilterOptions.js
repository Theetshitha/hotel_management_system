// Function to dynamically load states and cities based on country selection
document.getElementById('country-select').addEventListener('change', function() {
    const countryId = this.value;
    fetch(`/controller/HotelController.php?action=getStates&country_id=${countryId}`)
        .then(response => response.json())
        .then(data => {
            const stateSelect = document.getElementById('state-select');
            stateSelect.innerHTML = '<option value="">Select State</option>';
            data.forEach(state => {
                stateSelect.innerHTML += `<option value="${state.state_name}">${state.state_name}</option>`;
            });
            stateSelect.disabled = false;
        });
});

// Function to dynamically load cities based on state selection
document.getElementById('state-select').addEventListener('change', function() {
    const stateId = this.value;
    fetch(`/controller/HotelController.php?action=getCities&state_id=${stateId}`)
        .then(response => response.json())
        .then(data => {
            const citySelect = document.getElementById('city-select');
            citySelect.innerHTML = '<option value="">Select City</option>';
            data.forEach(city => {
                citySelect.innerHTML += `<option value="${city.city_name}">${city.city_name}</option>`;
            });
            citySelect.disabled = false;
        });
});

// AJAX form submission to apply filters without refreshing the page
document.getElementById('hotel-filter-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const filters = {
        country: formData.get('country'),
        state: formData.get('state'),
        city: formData.get('city'),
        price_range: formData.get('price_range')
    };

    fetch('/controller/HotelController.php?action=applyFilter', {
        method: 'POST',
        body: JSON.stringify(filters),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const hotelList = document.getElementById('hotel-list');
        hotelList.innerHTML = '';  // Clear the list before appending new filtered data
        data.forEach(hotel => {
            hotelList.innerHTML += `
                <div class="hotel-card">
                    <img src="${hotel.image}" alt="${hotel.hotel_name}">
                    <h3>${hotel.hotel_name}</h3>
                    <p>${hotel.location}</p>
                    <p>${hotel.description}</p>
                    <div class="hotel-buttons">
                        <button class="book-btn">Book</button>
                    </div>
                </div>
            `;
        });
    });
});
