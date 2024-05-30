<?php 


class dcfpp_update_checkout_fields {

     
	
     
	public function __construct() {
	    
	    
	     add_action('dokan_product_edit_after_main', array( $this, 'load_fields' ));

	     add_action('dokan_product_updated',array( $this, 'save_add_product_meta' ), 10, 2 );

	    
	 }




	public function save_add_product_meta($product_id, $postdata) {

	 	if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
	 		return;
	 	}


	 	$fields = (array) get_option('dcfpp_billing_settings');


	 	foreach ($fields as $billingkey=>$billing_field) {

	 		if ( ! empty( $postdata[$billingkey] ) ) {
	 			update_post_meta( $product_id, $billingkey, sanitize_text_field($postdata[$billingkey]) );
	 		}
	 	}
	 	
	 }


	public function load_fields() {
        global $post;


	 	$fields = (array) get_option('dcfpp_billing_settings');



	 	$dcfpp_woo_version    = dcfpp_get_woo_version_number();
	    $dcfpp_extra_settings = get_option('dcfpp_extra_settings');

	    if (isset($dcfpp_extra_settings['datepicker_format'])) {
	    	$datepicker_format = $dcfpp_extra_settings['datepicker_format'];
	    } else {
	    	$datepicker_format = 01;
	    }


	    if (isset($dcfpp_extra_settings['timepicker_interval']) && ($dcfpp_extra_settings['timepicker_interval'] == 02)) {
	    	$timepicker_interval = 30;
	    } else {
	    	$timepicker_interval = 60;
	    }

	    if (isset($dcfpp_extra_settings['timepicker_format'])) {
	    	$timepicker_format = $dcfpp_extra_settings['timepicker_format'];
	    }

	    if (isset($dcfpp_extra_settings['allowed_times']) && ($dcfpp_extra_settings['allowed_times'] != '')) {
	    	$allowed_times = $dcfpp_extra_settings['allowed_times'];
	 
	    } else {

	        $allowed_times = '';
	    }


	    if (!empty($dcfpp_extra_settings['datepicker_disable_days'])) {
		    $days_to_exclude = implode(',', $dcfpp_extra_settings['datepicker_disable_days']); 
	    } else { 
	        $days_to_exclude=''; 
	    }


	    $datetimepicker_lang = isset($dcfpp_extra_settings['datetimepicker_lang']) ? $dcfpp_extra_settings['datetimepicker_lang'] : "en";

	    $week_starts_on = isset($dcfpp_extra_settings['week_starts_on']) ? $dcfpp_extra_settings['week_starts_on'] : "sunday";

	    $dt_week_starts_on = isset($dcfpp_extra_settings['dt_week_starts_on']) ? $dcfpp_extra_settings['dt_week_starts_on'] : 0;
	    


	     
		 
		 wp_enqueue_style( 'jquery-ui', ''.dcfpp_PLUGIN_URL.'assets/css/jquery-ui.css' );

		 wp_enqueue_script( 'jquery.datetimepicker', ''.dcfpp_PLUGIN_URL.'assets/js/jquery.datetimepicker.js',array('jquery') );
         
         wp_enqueue_script( 'moment', ''.dcfpp_PLUGIN_URL.'assets/js/moment.js');
		 wp_enqueue_script( 'daterangepicker', ''.dcfpp_PLUGIN_URL.'assets/js/daterangepicker.js',array('moment'));
		 
		 if ($dcfpp_woo_version < 2.3) {
		 	wp_enqueue_script( 'dcfpp-frontend1', ''.dcfpp_PLUGIN_URL.'assets/js/frontend1.js' );
		 } else {
            wp_enqueue_script( 'dcfpp-frontend2', ''.dcfpp_PLUGIN_URL.'assets/js/frontend2.js' );
		 }
         
        $dcfppfrontend_array = array( 
		    'datepicker_format'               => $datepicker_format,
		    'timepicker_interval'             => $timepicker_interval,
		    'allowed_times'                   => $allowed_times,
		    'days_to_exclude'                 => $days_to_exclude,
		    'datetimepicker_lang'             => $datetimepicker_lang,
		    'week_starts_on'                  => $week_starts_on,
		    'dt_week_starts_on'               => $dt_week_starts_on
		   
		);
         
         wp_localize_script( 'dcfpp-frontend2', 'dcfppfrontend', $dcfppfrontend_array );




		 wp_enqueue_style( 'dcfpp-frontend', ''.dcfpp_PLUGIN_URL.'assets/css/frontend.css' );

		 wp_enqueue_style( 'jquery.datetimepicker', ''.dcfpp_PLUGIN_URL.'assets/css/jquery.datetimepicker.css' );

		 wp_enqueue_style( 'daterangepicker', ''.dcfpp_PLUGIN_URL.'assets/css/daterangepicker.css' );
		

	 	foreach ($fields as $billingkey=>$billing_field) {
                


	 		
                

	 			$billing_field_value   = get_post_meta($post->ID,$billingkey,true);



	 			if (isset($billing_field['options']) && ($billing_field['options'] != '')) {
	 				$tempoptions = explode(',',$billing_field['options']);


	 				$billingoptions = array();

	 				foreach($tempoptions as $billingval){

	 					$billingoptions[$billingval]  = $billingval;

	 				}

	 			}


	 			if (isset($billing_field['options'])) { 

	 				if (isset($billing_field['options']) && ($billing_field['options'] != '')) {
	 					$billing_field['options'] = $billingoptions;
	 				}

	 			}

                
	 			woocommerce_form_field( $billingkey, $billing_field, ! empty( sanitize_text_field($_POST[ $billingkey ] )) ? wc_clean( sanitize_text_field($_POST[ $billingkey ] ) ) : $billing_field_value ); 

	 		
	 	}

	 	
	 }



	
}

new dcfpp_update_checkout_fields();
?>