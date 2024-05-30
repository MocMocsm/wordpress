<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
// Añadir una pestaña personalizada al perfil de usuario
function my_custom_profile_tab( $tabs ) {
    $tabs['custom_tab'] = array(
        'name'       => 'Mi Pestaña Personalizada',
        'icon'       => 'um-faicon-info',
        'custom'     => true
    );
    return $tabs;
}
add_filter( 'um_profile_tabs', 'my_custom_profile_tab', 1000 );

// Contenido de la pestaña personalizada
function my_custom_profile_content() {
    echo '<h3>Este es el contenido de mi pestaña personalizada.</h3>';
    // Aquí puedes agregar cualquier contenido que desees, como un formulario, texto, etc.
}
add_action('um_profile_content_custom_tab_default', 'my_custom_profile_content');
</script>
<!-- end Simple Custom CSS and JS -->
