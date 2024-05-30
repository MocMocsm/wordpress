<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
function initAutocomplete() {
    // Create the autocomplete object, restricting the search predictions to geographical location types.
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('dokan-map-location'), { types: ['geocode'] });

    // When the user selects an address from the drop-down, populate the address fields in the form.
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        var addressComponents = place.address_components;

        // Helper function to get address component
        function getAddressComponent(type) {
            for (var i = 0; i < addressComponents.length; i++) {
                if (addressComponents[i].types.indexOf(type) !== -1) {
                    return addressComponents[i].long_name;
                }
            }
            return '';
        }

        // Fill the corresponding fields
        document.getElementById('dokan_address[street_1]').value = getAddressComponent('street_number') + ' ' + getAddressComponent('route');
        document.getElementById('dokan_address[city]').value = getAddressComponent('locality');
        document.getElementById('dokan_address[zip]').value = getAddressComponent('postal_code');
        document.getElementById('dokan_address[country]').value = getAddressComponent('country');
        document.getElementById('dokan_address[state]').value = getAddressComponent('administrative_area_level_1');
    });
}

// Load the API and initialize the autocomplete
function loadGoogleMapsApi() {
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA_rR7mOKFnZ3xQJZiyZyL4DwtZhziYC1g&libraries=places&callback=initAutocomplete';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
}

document.addEventListener('DOMContentLoaded', loadGoogleMapsApi);


</script>
<!-- end Simple Custom CSS and JS -->
