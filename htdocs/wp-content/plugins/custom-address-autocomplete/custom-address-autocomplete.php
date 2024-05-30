<?php
/*
Plugin Name: Custom Address Autocomplete
Description: Adds address autocomplete functionality and maps for user profiles.
Version: 1.0
Author: Marcel
*/

// Incluir jQuery, jQuery UI y Script Personalizado
function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-autocomplete');
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    wp_enqueue_script('custom-autocomplete', plugin_dir_url(__FILE__) . 'custom-autocomplete.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Incluir Leaflet.js
function enqueue_leaflet_scripts() {
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_leaflet_scripts');

// Shortcode para mostrar el mapa con las ubicaciones de los usuarios
function display_user_locations_on_leaflet_map() {
    $users = get_users(array(
        'meta_key' => 'latitud',
        'meta_compare' => 'EXISTS',
    ));

    $markers = array();
    foreach ($users as $user) {
        $latitude = get_user_meta($user->ID, 'latitud', true);
        $longitude = get_user_meta($user->ID, 'longitud', true);
        if ($latitude && $longitude) {
            $markers[] = array(
                'lat' => $latitude,
                'lon' => $longitude,
                'title' => $user->display_name,
            );
        }
    }

    ob_start();
    ?>
    <div id="map" style="width: 100%; height: 500px;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([0, 0], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var markers = <?php echo json_encode($markers); ?>;
            markers.forEach(function (marker) {
                L.marker([marker.lat, marker.lon])
                    .addTo(map)
                    .bindPopup(marker.title);
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('user_locations_map', 'display_user_locations_on_leaflet_map');
