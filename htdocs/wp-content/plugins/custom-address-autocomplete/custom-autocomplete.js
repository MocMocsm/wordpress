jQuery(document).ready(function($) {
    console.log("Autocomplete script loaded");

    // Campos de la dirección
    var addressInput = $('#direccion');
    var latInput = $('#latitud');
    var lonInput = $('#longitud');
    var cityInput = $('#ciudad');
    var stateInput = $('#estado');
    var countryInput = $('#pais');

    addressInput.on('input', function() {
        var query = $(this).val();
        if (query.length > 2) {
            console.log("Query:", query);
            $.ajax({
                url: "https://nominatim.openstreetmap.org/search",
                data: {
                    q: query,
                    format: 'json',
                    addressdetails: 1,
                    limit: 5
                },
                dataType: 'json',
                success: function(data) {
                    console.log("Nominatim response:", data);
                    var suggestions = [];
                    $.each(data, function(index, value) {
                        suggestions.push({
                            label: value.display_name,
                            value: value.display_name,
                            lat: value.lat,
                            lon: value.lon,
                            address: value.address
                        });
                    });

                    addressInput.autocomplete({
                        source: suggestions,
                        select: function(event, ui) {
                            console.log("Selected:", ui.item);
                            addressInput.val(ui.item.value);
                            latInput.val(ui.item.lat);
                            lonInput.val(ui.item.lon);

                            if (ui.item.address) {
                                cityInput.val(ui.item.address.city || '');
                                stateInput.val(ui.item.address.state || '');
                                countryInput.val(ui.item.address.country || '');
                            }

                            return false;
                        }
                    });
                }
            });
        }
    });
});
