jQuery(document).ready(function($) {
    $('#direccion').on('input', function() {
        var query = $(this).val();
        if (query.length > 2) {
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
                    var suggestions = [];
                    $.each(data, function(index, value) {
                        suggestions.push({
                            label: value.display_name,
                            value: value.display_name,
                            lat: value.lat,
                            lon: value.lon
                        });
                    });

                    $('#direccion').autocomplete({
                        source: suggestions,
                        select: function(event, ui) {
                            $('#direccion').val(ui.item.value);
                            $('#latitud').val(ui.item.lat);
                            $('#longitud').val(ui.item.lon);
                            return false;
                        }
                    });
                }
            });
        }
    });
});
