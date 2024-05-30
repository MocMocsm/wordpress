<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
function add_logged_in_body_class( $classes ) {
    if ( is_user_logged_in() ) {
        $classes[] = 'logged-in';
    } else {
        $classes[] = 'logged-out';
    }
    return $classes;
}
add_filter( 'body_class', 'add_logged_in_body_class' );

</script>
<!-- end Simple Custom CSS and JS -->
