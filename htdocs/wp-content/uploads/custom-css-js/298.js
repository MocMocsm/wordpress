<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
add_action('wp_enqueue_scripts', 'my_remove_um_styles', 20);
function my_remove_um_styles() {
    if (class_exists('UM')) {
        wp_dequeue_style('um_default_css');
        wp_deregister_style('um_default_css');
    }
}
</script>
<!-- end Simple Custom CSS and JS -->
