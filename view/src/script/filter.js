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
                    option.textContent = state.state_name;
                    stateSelect.appendChild(option);
                });
                stateSelect.disabled = false;
            });
    } else {
        document.getElementById('state-select').disabled = true;
        document.getElementById('city-select').disabled = true;
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
                    option.textContent = city.city_name;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
            });
    } else {
        document.getElementById('city-select').disabled = true;
    }
});
