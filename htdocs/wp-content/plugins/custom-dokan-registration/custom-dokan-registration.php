<?php
/**
 * Plugin Name: Custom Dokan Registration
 * Description: Plugin para personalizar el formulario de registro de vendedores de Dokan.
 * Version: 4.20
 * Author: Marcel
 */

// Evitar el acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directamente
}

// Hook para añadir el CSS personalizado
add_action('wp_enqueue_scripts', 'custom_dokan_registration_styles');
function custom_dokan_registration_styles() {
    wp_enqueue_style('custom-dokan-registration-css', plugin_dir_url(__FILE__) . 'style.css');
}

// Hook para modificar el formulario de registro de vendedores
add_action('dokan_seller_registration_form_fields', 'custom_dokan_registration_form');

function custom_dokan_registration_form() {
    ?>
    <div class="custom-form-group">
        <div class="split-row name-field form-row-wide">
            <p class="form-row form-group">
                <label for="first-name">Nombre <span class="required">*</span></label>
                <input type="text" class="input-text form-control" name="fname" id="first-name" value="" required="required">
            </p>
            <p class="form-row form-group">
                <label for="last-name">Apellidos <span class="required">*</span></label>
                <input type="text" class="input-text form-control" name="lname" id="last-name" value="" required="required">
            </p>
        </div>
        <p class="form-row form-group form-row-wide">
            <label for="reg_email">Dirección de correo electrónico <span class="required">*</span></label>
            <input type="email" class="input-text form-control" name="email" id="reg_email" value="" required="required">
            <label class="reg_email_error"></label>
            <small>Se enviará un enlace a tu dirección de correo electrónico para establecer una nueva contraseña.</small>
        </p>
        <p class="form-row form-group form-row-wide">
            <label for="shop-phone">Número de teléfono<span class="required">*</span></label>
            <input type="text" class="input-text form-control" name="phone" id="shop-phone" value="" required="required">
            <input type="hidden" name="role" value="seller">
        </p>
        <p class="form-row form-group form-row-wide">
            <label for="company-name">Nombre de la tienda <span class="required">*</span></label>
            <input type="text" class="input-text form-control" name="shopname" id="company-name" value="" required="required">
        </p>
        <p class="form-row form-group form-row-wide">
            <label for="seller-url" class="pull-left">URL de la tienda <span class="required">*</span></label>
            <strong id="url-alart-mgs" class="pull-right"></strong>
            <input type="text" class="input-text form-control" name="shopurl" id="seller-url" value="" required="required">
            <small><a href="https://totaqui.com/store/">https://totaqui.com/store/</a><strong id="url-alart"></strong></small>
        </p>
    </div>
    <?php
}

// Hook para el contenedor grande del formulario de dirección
add_action('dokan_seller_registration_required_fields_after', 'custom_dokan_address_container');

function custom_dokan_address_container() {
    ?>
    <div class="dokan-form-group-container">
        <label class="dokan-hide dokan-control-label" for="setting_address">Dirección</label>
        <div class="dokan-text-left dokan-address-fields">
            <div class="dokan-form-group">
                <label class="control-label" for="dokan_address[street_1]">Calle <span class="required"> *</span></label>
                <input required="" id="dokan_address[street_1]" value="" name="dokan_address[street_1]" placeholder="Dirección" class="dokan-form-control input-md" type="text">
            </div>
            <div class="dokan-form-group">
                <label class="control-label" for="dokan_address[street_2]">Calle 2</label>
                <input id="dokan_address[street_2]" value="" name="dokan_address[street_2]" placeholder="Apartamento, habitación, unidad, etc (opcional)" class="dokan-form-control input-md" type="text">
            </div>
            <div class="dokan-from-group">
                <div class="dokan-form-group dokan-w6 dokan-left dokan-right-margin-30">
                    <label class="control-label" for="dokan_address[city]">Ciudad <span class="required"> *</span></label>
                    <input required="" id="dokan_address[city]" value="" name="dokan_address[city]" placeholder="Población" class="dokan-form-control input-md" type="text">
                </div>
                <div class="dokan-form-group dokan-w5 dokan-left">
                    <label class="control-label" for="dokan_address[zip]">Código Postal <span class="required"> *</span></label>
                    <input required="" id="dokan_address[zip]" value="" name="dokan_address[zip]" placeholder="Código postal" class="dokan-form-control input-md" type="text">
                </div>
                <div class="dokan-clearfix"></div>
            </div>
            <div class="dokan-form-group">
                <label class="control-label" for="dokan_address[country]">País <span class="required"> *</span></label>
                <select required="" name="dokan_address[country]" class="country_to_state dokan-form-control" id="dokan_address_country">
                    <option value="">– Selecciona una ubicación –</option>
                    <!-- Opciones de país -->
                </select>
            </div>
        </div>
    </div>
    <?php
}
?>
