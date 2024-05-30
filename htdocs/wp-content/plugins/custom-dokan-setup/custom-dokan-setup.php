<?php
/**
 * Plugin Name: Custom Dokan Setup
 * Description: Plugin para personalizar el formulario de configuración de vendedores de Dokan.
 * Version: 1.0
 * Author: Tu Nombre
 */

// Evitar el acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directamente
}

// Hook para añadir el CSS personalizado
add_action('wp_enqueue_scripts', 'custom_dokan_setup_styles');
function custom_dokan_setup_styles() {
    wp_enqueue_style('custom-dokan-setup-css', plugin_dir_url(__FILE__) . 'style.css');
}

// Hook para modificar el formulario de configuración del vendedor
add_action('dokan_seller_setup_wizard_after_store_form', 'custom_dokan_setup_form');

function custom_dokan_setup_form() {
    ?>
    <style>
        /* Añadir aquí estilos CSS personalizados */
        .custom-form-group {
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #0073aa;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .dokan-form-group-container {
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .dokan-form-group label, .form-row label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .dokan-form-group input, .form-row input, 
        .dokan-form-group select, .form-row select, 
        .dokan-form-group textarea, .form-row textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            transition: border-color 0.3s;
        }

        .dokan-form-group input:focus, .form-row input:focus, 
        .dokan-form-group select:focus, .form-row select:focus, 
        .dokan-form-group textarea:focus, .form-row textarea:focus {
            border-color: #0073aa;
            outline: none;
        }

        .dokan-form-group input[type="submit"], .form-row input[type="submit"] {
            background-color: #0073aa;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .dokan-form-group input[type="submit"]:hover, .form-row input[type="submit"]:hover {
            background-color: #005a87;
        }
    </style>
    <div class="custom-form-group">
        <!-- Aquí puedes añadir campos adicionales o modificar los existentes -->
        <p class="form-row form-group form-row-wide">
            <label for="additional-field">Campo Adicional <span class="required">*</span></label>
            <input type="text" class="input-text form-control" name="additional_field" id="additional-field" value="" required="required">
        </p>
    </div>
    <?php
}

// Hook para guardar los datos adicionales
add_action('dokan_store_profile_saved', 'custom_save_dokan_setup_form');

function custom_save_dokan_setup_form($store_id) {
    if (isset($_POST['additional_field'])) {
        update_user_meta($store_id, 'additional_field', sanitize_text_field($_POST['additional_field']));
    }
}
?>
