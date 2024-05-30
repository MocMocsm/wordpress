function enqueue_custom_scripts(){wp_enqueue_script('toggle-profile',get_template_directory_uri().'/js/toggle-profile.js',array(),null,!0)}
add_action('wp_enqueue_scripts','enqueue_custom_scripts')