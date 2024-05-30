<?php
/*
	Plugin Name: Custom Dokan Fields
	Plugin URI: https://sysbasics.com
	Description: lets you Add/edit new fields on dokan add product and edit product page. 
    Version: 1.0.0
	Author: sysbasics
	Text Domain: dcfpp
	Domain Path: /languages
	Requires at least: 3.3
    Tested up to: 6.1.1
    WC requires at least: 3.0.0
    WC tested up to: 7.2.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


 if( !defined( 'dcfpp_PLUGIN_URL' ) )
define( 'dcfpp_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



load_plugin_textdomain( 'custom-dokan-fields', false, basename( dirname(__FILE__) ).'/languages' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	
  include dirname( __FILE__ ) . '/include/dcfpp_core_functions.php';
  include dirname( __FILE__ ) . '/include/update_checkout_fields_class.php';
  include dirname( __FILE__ ) . '/include/manage_extrafield_class.php';
  include dirname( __FILE__ ) . '/include/admin/dcfpp_admin_settings.php';

}






 
function dcfpp_plugin_row_meta( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'docs'    => '<a href="' . esc_url( 'https://www.sysbasics.com/knowledge-base/category/woocommerce-easy-checkout-field-editor/' ) . '" target="_blank" aria-label="' . esc_html__( 'Docs', 'custom-dokan-fields' ) . '" style="color:green;">' . esc_html__( 'Docs', 'custom-dokan-fields' ) . '</a>',
          'support'    => '<a href="' . esc_url( 'https://www.sysbasics.com/support/' ) . '" target="_blank" aria-label="' . esc_html__( 'Support', 'custom-dokan-fields' ) . '" style="color:green;">' . esc_html__( 'Support', 'custom-dokan-fields' ) . '</a>'
        );

 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}

add_filter( 'plugin_row_meta', 'dcfpp_plugin_row_meta', 10, 2 );




?>