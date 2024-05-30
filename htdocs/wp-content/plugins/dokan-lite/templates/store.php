<?php
/**
 * The Template for displaying vendor store.
 *
 * @package dokan
 */

get_header();

$store_user = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info = $store_user->get_shop_info();
$social_info = $store_user->get_social_profiles();
$store_tabs = dokan_get_store_tabs( $store_user->get_id() );
$store_address = dokan_get_seller_short_address( $store_user->get_id(), false );
$map_location = $store_user->get_location();
?>

<div class="dokan-store-container">
    <div id="dokan-primary" class="dokan-single-store">
        <div id="dokan-content" class="store-page-wrap woocommerce" role="main">
            <div class="store-header-wrap">
                <?php dokan_get_template_part( 'store-header' ); ?>
            </div>

            <div class="store-content-wrap">
                <div id="dokan-content-sidebar" class="dokan-content-sidebar col-md-3 col-sm-12 col-xs-12">
                    <?php do_action( 'dokan_sidebar_store_before', $store_user->data, $store_info ); ?>
                    <div class="dokan-store-widget-wrap">
                        <?php do_action( 'dokan_store_profile_frame_after', $store_user->data, $store_info ); ?>
                    </div>
                    <?php do_action( 'dokan_sidebar_store_after', $store_user->data, $store_info ); ?>
                </div>

                <div id="dokan-primary" class="dokan-single-store col-md-9 col-sm-12 col-xs-12">
                    <?php if ( $store_tabs ) : ?>
            
