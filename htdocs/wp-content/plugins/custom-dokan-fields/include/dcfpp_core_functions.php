<?php

if ( ! function_exists( 'dcfpp_check_if_field_is_hidden' ) ) {

    /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */


    function dcfpp_check_if_field_is_hidden($hiddenvalue,$allowedproduts ,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty ) {
    	global $woocommerce;
    	$cart_items = $woocommerce->cart->get_cart();
    	$extra_options = (array) get_option( 'dcfpp_extra_settings' );

    	switch($hiddenvalue) {
    		case "product-specific" :
    		$allowedproductindex =0;

    		if (( ! empty( $allowedproduts ) ) && (is_array($allowedproduts)))  {

    			foreach ($allowedproduts as $allowedproductkey=>$allowedproductid) {

    				foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    					if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    						$product_id=$cartitemvalue['variation_id'];
    					} else {
    						$product_id=$cartitemvalue['product_id'];
    					}



    					if ($product_id == $allowedproductid) {
    						$allowedproductindex++;
    					}
    				}
    			}
    		}

    		if ($allowedproductindex == 0)  {

    			return 0;
    		} else {

    			return 1;
    		}

    		break;

    		case "category-specific" :
    		$categoryproductindex = 0;

    		if (( ! empty( $allowedcats ) ) && (is_array($allowedcats)))  {

    			foreach ($allowedcats as $allowedcatvalue) {

    				foreach ($cart_items as $cartitem_key=>$cartitemvalue) {

    					$product_id=$cartitemvalue['product_id'];

    					$catterms = get_the_terms( $product_id, 'product_cat' );

    					if (( ! empty( $catterms ) ) && (is_array($catterms)))  {

    						foreach ($catterms as $catterm) {
    							if ($catterm->term_id == $allowedcatvalue) {
    								$categoryproductindex++;
    							}
    						}
    					}


    				}
    			}
    		}

    		if ($categoryproductindex == 0)  {

    			return 0;

    		} else {

    			return 1;
    		}

    		break;

    		case "role-specific" :
    		$role_status       = 0;



    		if (isset($allowedroles) && is_array($allowedroles) && (!empty($allowedroles))) {
    			if ( ! is_user_logged_in() ) {
    				$role_status       = 0;
    				return $role_status; 
    			}

    			$allowedauthors = '';

    			foreach ($allowedroles as $role) {
    				$allowedauthors.=''.$role.',';
    			}

    			$allowedauthors=substr_replace($allowedauthors, "", -1);

    			global $current_user;
    			$user_roles = $current_user->roles;
    			$user_role = array_shift($user_roles);



    			if (preg_match('/\b'.$user_role.'\b/', $allowedauthors )) {
    				$role_status       = 1;
    				return $role_status;
    			}

    		}

    		if (empty($allowedroles) && ( ! is_user_logged_in() )) {
    			$role_status       = 1;
    			return $role_status;
    		}



    		return $role_status; 

    		break;

    		case "total-quantity" :
    		$quantity_index       = 0;

    		if (!isset($total_quantity) || ($total_quantity == 0)) {
    			return 0;
    		} 

    		$cart_count = $woocommerce->cart->cart_contents_count;

    		if ($cart_count == $total_quantity) {

    			return 1;

    		}

    		return $quantity_index;

    		break;



    		case "cart-quantity-specific" :

    		$product_quantity_index       = 0;

    		if (!isset($prd) || ($prd == 0)) {
    			return 0;
    		} 

    		if (!isset($prd_qnty) || ($prd_qnty == 0)) {
    			return 0;
    		} 


    		foreach ($cart_items as $cartitem_key=>$cartitemvalue) {


    			if (isset($cartitemvalue['variation_id']) &&  ($cartitemvalue['variation_id'] != 0)) {
    				$product_id=$cartitemvalue['variation_id'];
    			} else {
    				$product_id=$cartitemvalue['product_id'];
    			}





    			if (($product_id == $prd) && ($cartitemvalue['quantity'] == $prd_qnty)) {
    				$product_quantity_index++;

    			} 
    		}

    		if ($product_quantity_index > 1) {
    			return 1;
    		}

    		return $product_quantity_index;

    		break;

    		case "always-visible" :
    		return 1;
    		break;

    		default:
    		return 1;
    	}
    }
}



if ( ! function_exists( 'dcfpp_get_woo_version_number' ) ) {

    /**
	 * Outputs a installed woocommerce version
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_woo_version_number() {
        // If get_plugins() isn't available, require it
	   
	   if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
        // Create the plugins folder and file variables
	   $plugin_folder = get_plugins( '/' . 'woocommerce' );
	   $plugin_file = 'woocommerce.php';
	
	   // If the plugin version number is set, return it 
	   if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
		 return $plugin_folder[$plugin_file]['Version'];

	   } else {
	// Otherwise return null
		return NULL;
	  }
   }
   
}


if ( ! function_exists( 'pfcme_parent_visibility_check' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function pfcme_parent_visibility_check($parentfield) {

        $default = 'visible';

        if (strpos($parentfield, 'billing') !== false) {
            
            $field_type = 'billing';

        } elseif (strpos($parentfield, 'shipping') !== false) {
        	
        	$field_type = 'shipping';
        
        } elseif (strpos($parentfield, 'shipping') !== false) {
            
            $field_type = 'additional';

        }


        if (isset($field_type)) {

        	switch($field_type) {
        		case "billing":
        		    $fields_data = get_option('dcfpp_billing_settings');
        		break;

        		case "shipping":
        		    $fields_data = get_option('dcfpp_shipping_settings');
        		break;

        		case "additional":
        		    $fields_data = get_option('dcfpp_additional_settings');
        		break;

        	}
        }

        if (isset($fields_data) && isset($fields_data[$parentfield])) {
        	
        	$value = $fields_data[$parentfield];

        	if (isset($value['visibility'])) {
				
				$visibilityarray = $value['visibility'];
				 
				if (isset($value['products'])) { 
				    $allowedproducts = $value['products'];
				} else {
					$allowedproducts = array(); 
				}
				 
				if (isset($value['category'])) {
					$allowedcats = $value['category'];
				} else {
					$allowedcats = array();
				}

				if (isset($value['role'])) {
					$allowedroles = $value['role'];
				} else {
					$allowedroles = array();
				}

				if (isset($value['total-quantity'])) {
					$total_quantity = $value['total-quantity'];
				} else {
					$total_quantity = 0;
				}

				if (isset($value['specific-product'])) {
					$prd = $value['specific-product'];
				} else {
					$prd = 0;
				}

				if (isset($value['specific-quantity'])) {
					$prd_qnty = $value['specific-quantity'];
				} else {
					$prd_qnty = 0;
				}

                
				 
				$is_field_hidden=dcfpp_check_if_field_is_hidden($visibilityarray,$allowedproducts,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty);

				if ((isset($is_field_hidden)) && ($is_field_hidden == 0)) {

					return 'hidden';

				}
            }

        }

        return $default;

    }

}


if ( ! function_exists( 'dcfpp_get_fees_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_fees_class($key) {

    	$class              = '';

        $additional_fees    = get_option('dcfpp_additional_fees');
        
        
        

        $matchindex         = 0;

        if (is_array($additional_fees)) {
        	$additional_fees    = array_filter($additional_fees);
        }


        if (isset($additional_fees) && is_array($additional_fees) && (sizeof($additional_fees) >= 1)) { 
        	$additional_fees = $additional_fees;
        } else {
        	$additional_fees = array();
        }


        foreach ($additional_fees as $fkey=>$fvalue) {
            //if (strstr($string, $url)) { // mine version
            if ((strpos($key, $fvalue['parentfield']) !== FALSE) && (isset($fvalue['amount'])) ) { // Yoshi version
    	        $matchindex++; 
    	        
            }
        }

        

        if ($matchindex > 0) {
        	
        	$class = 'dcfpp-price-changer';


        }
    

		return $class;
    }
   
}


if ( ! function_exists( 'dcfpp_get_action_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_action_class($key) {

    	$class              = '';

        $additional_fees    = get_option('dcfpp_additional_fees');
        
        
        

        $matchindex         = 0;

        if (is_array($additional_fees)) {
        	$additional_fees    = array_filter($additional_fees);
        }


        if (isset($additional_fees) && is_array($additional_fees) && (sizeof($additional_fees) >= 1)) { 
        	$additional_fees = $additional_fees;
        } else {
        	$additional_fees = array();
        }


        foreach ($additional_fees as $fkey=>$fvalue) {
            //if (strstr($string, $url)) { // mine version
            if ((strpos($key, $fvalue['parentfield']) !== FALSE) && (isset($fvalue['actionfield'])) ) { // Yoshi version
    	        $matchindex++; 
    	        
            }
        }

        

        if ($matchindex > 0) {
        	
        	$class = 'dcfpp-action-changer';


        }
    

		return $class;
    }
   
}



if ( ! function_exists( 'dcfpp_get_field_data' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_field_data($key) {

    	$field_data = array();

        $billing_fields    = (array) get_option('dcfpp_billing_settings');
        $shipping_fields   = (array) get_option('dcfpp_shipping_settings');
        $additional_fields = (array) get_option('dcfpp_additional_settings');

        

       

        foreach ($billing_fields as $bkey=>$bvalue) {
            //if (strstr($string, $url)) { // mine version
            if ($bkey == $key) { // Yoshi version
    	        $field_data['label'] = $bvalue['label']; 
    	        $field_data['type']  = $bvalue['type']; 
    	        
    	        return $field_data;
    	        
            }
        }

        foreach ($shipping_fields as $bkey=>$bvalue) {
            //if (strstr($string, $url)) { // mine version
            if ($bkey == $key) { // Yoshi version
    	        $field_data['label'] = $bvalue['label']; 
    	        $field_data['type']  = $bvalue['type']; 
    	        
    	        return $field_data;
    	        
            }
        }


        foreach ($additional_fields as $bkey=>$bvalue) {
            //if (strstr($string, $url)) { // mine version
            if ($bkey == $key) { // Yoshi version
    	        $field_data['label'] = $bvalue['label']; 
    	        $field_data['type']  = $bvalue['type']; 
    	        
    	        return $field_data;
    	        
            }
        }

        


        return $field_data;

        
    }
   
}

if ( ! function_exists( 'get_order_array' ) ) {

	function get_order_array($plugin_fields) {

		$order=array();

		foreach ($plugin_fields as $key=>$value) {
			array_push($order, $key);
		}


		return $order;
	}

}



if ( ! function_exists( 'dcfpp_update_fields_combined' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_update_fields_combined($fields,$plugin_fields,$slug) {

    	if (isset($plugin_fields) && ($plugin_fields != '')) {

    		$keyorder = 1;


		    //loops through plugin generated array of billing fields  
    		foreach ($plugin_fields as $key2=>$value) {

    			if (isset($value['options']) && ($value['options'] != '')) {

    				$tempoptions = explode(',',$value['options']);


    				$options = array();

    				foreach($tempoptions as $val){

    					$options[$val]  = $val;

    				}

    			}





    			if (isset($fields[$slug]) && (sizeof($fields[$slug]) >1)) {

		    	    //loops through default woocommerce fields array

    				foreach ($fields[$slug] as $key=>$billing)  {

		                //if key matches
    					if ($key == $key2) {


    						if (isset($value['type'])) { 

    							$fields[$slug][$key]['type'] = $value['type']; 

    						}





    						if (isset($value['label'])) { 

    							$fields[$slug][$key]['label'] = $value['label']; 
    						}


    						if (isset($value['width'])) { 

    							if (isset( $fields[$slug][$key]['class'])) {

    								foreach ($fields[$slug][$key]['class'] as $classkey=>$classvalue) {

    									if ($classvalue == 'form-row-wide' || $classvalue == "form-row-first"  || $classvalue == "form-row-last") {
    										unset($fields[$slug][$key]['class'][$classkey]);
    									}

    								}
    							}

    							$fields[$slug][$key]['class'][]=$value['width'];
    						}

    						if (isset($value['required']) && ($value['required'] == 1) && ($key != "billing_state")) { 

    							$fields[$slug][$key]['required'] = $value['required']; 

    						} else {

    							$fields[$slug][$key]['required'] = false;
    						} 


    						if (isset($value['clear']) && ($value['clear'] == 1)) { 

    							$fields[$slug][$key]['clear'] = $value['clear']; 

    						} else {

    							$fields[$slug][$key]['clear'] = false;

    						}	

    						if (isset($value['placeholder'])) { 

    							$fields[$slug][$key]['placeholder'] = $value['placeholder']; 

    						}

    						if (isset($keyorder)) { 


    							$fields[$slug][$key]['priority'] = $keyorder * 10; 

    						}


    						if (isset($value['options'])) { 

    							if (isset($value['options']) && ($value['options'] != '')) {
    								$fields[$slug][$key]['options'] =$options;
    							}
    						}

                            $extraclass = array();
    						//builds extraclass array
		                    if (isset($value['extraclass']) && ($value['extraclass'] != '')) {
		      
		                        $tempclasses = explode(',',$value['extraclass']);
		      
		      
		                        
                      
                                foreach($tempclasses as $classval3){
    
                                    $extraclass[$classval3]  = $classval3;
      
                                }
			 
		                    }


    						$dcfpp_conditional_class = '';


    						if (isset($value['visibility'])) {
    							$dcfpp_conditional_class = dcfpp_get_visibility_class_combined($value);
    						}


                            

    						if (isset($dcfpp_conditional_class) && ($dcfpp_conditional_class != '')) {
    							$extraclass[] = $dcfpp_conditional_class;
    						}


    						if (isset($extraclass) && ($extraclass != '')) {

    							foreach ($extraclass as $billingclassval) {
    								$fields[$slug][$key]['class'][] = $billingclassval;
    							}
    						}



    						if (isset($value['validate'])) { 

    							$fields[$slug][$key]['validate'] =$value['validate'];

    						}

    						if (isset($value['disable_past'])) { 

    							$fields[$slug][$key]['disable_past'] =$value['disable_past'];

    						}
			            } //end of if key matches

			            //if key does not match

			            if (isset($plugin_fields[$key2]) && (!isset($fields[$slug][$key2]))) {



			        	    if (isset($plugin_fields[$key2])) {
			        		    $fields[$slug][$key2] = $value;
			        	    }

			        	    if (isset($value['width']) && ($value['width'] != '')) {
			        		    $fields[$slug][$key2]['class'][] =$value['width'];
			        	    }

                            $extraclass = array();
			        	    //builds extraclass array
		                    if (isset($value['extraclass']) && ($value['extraclass'] != '')) {
		      
		                        $tempclasses = explode(',',$value['extraclass']);
		      
		      
		                        
                      
                                foreach($tempclasses as $classval3){
    
                                    $extraclass[$classval3]  = $classval3;
      
                                }
			 
		                    }


			        	    $dcfpp_conditional_class = '';


			        	    if (isset($value['visibility'])) {
			        		    $dcfpp_conditional_class = dcfpp_get_visibility_class_combined($value);
			        	    }




			        	    if (isset($dcfpp_conditional_class) && ($dcfpp_conditional_class != '')) {
			        		    $extraclass[] = $dcfpp_conditional_class;
			        	    }


			        	    if (isset($extraclass) && ($extraclass != '')) {

			        		    foreach ($extraclass as $billingclassval2) {

			        			    $fields[$slug][$key2]['class'][] = $billingclassval2;

			        		    }

			        	    }

                            if (isset($value['options']) && ($value['options'] != '')) {

			        		    $fields[$slug][$key2]['options'] =$options;
			        	    }

			        	    if (isset($keyorder)) { 


			        		    $fields[$slug][$key2]['priority'] = ($keyorder * 10) + 10; 

			        	    }
			            }
			            //end of if key does not match
			        }
			    }



			$keyorder++;
		}
	}


	if ( is_checkout() ) {

		if (isset($plugin_fields) && (sizeof($plugin_fields) >1)) {



			$order = get_order_array($plugin_fields);

			foreach($order as $field) {
				$ordered_fields[$field] = $fields[$slug][$field];
			}

			$fields[$slug] = $ordered_fields;

		} 

	}




	if (isset($plugin_fields) && ($plugin_fields != '')) {

		foreach ($plugin_fields as $hidekey=>$hidevalue) {

			if (isset($hidevalue['hide']) && ($hidevalue['hide'] == 1)) {
				unset($fields[$slug][$hidekey]);
			}

			if (isset($hidevalue['visibility'])) {

				$visibilityarray = $hidevalue['visibility'];

				if (isset($hidevalue['products'])) { 
					$allowedproducts = $hidevalue['products'];
				} else {
					$allowedproducts = array(); 
				}

				if (isset($hidevalue['category'])) {
					$allowedcats = $hidevalue['category'];
				} else {
					$allowedcats = array();
				}

				if (isset($value['role'])) {
					$allowedroles = $value['role'];
				} else {
					$allowedroles = array();
				}

				if (isset($value['total-quantity'])) {
					$total_quantity = $value['total-quantity'];
				} else {
					$total_quantity = 0;
				}


				if (isset($value['specific-product'])) {
					$prd = $value['specific-product'];
				} else {
					$prd = 0;
				}

				if (isset($value['specific-quantity'])) {
					$prd_qnty = $value['specific-quantity'];
				} else {
					$prd_qnty = 0;
				}


				$is_field_hidden = dcfpp_check_if_field_is_hidden($visibilityarray,$allowedproducts,$allowedcats,$allowedroles,$total_quantity,$prd,$prd_qnty);



				if (isset($is_field_hidden) && ($is_field_hidden != 1)) {
					unset($fields[$slug][$hidekey]);
				}


				
			}
		}
	}



	return $fields;


}

}



if ( ! function_exists( 'dcfpp_get_conditional_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_conditional_class($conditional) {



    	$class = '';

    	$parent_visibility_class = '';

        

    	foreach ($conditional as $key=>$value) {

            if (isset($value['showhide'])) {
            	$showhide                 = $value['showhide'];
            }

            if (isset($value['parentfield'])) {
            	$parentfield               = $value['parentfield'];
            }

            

            if (isset($showhide) && ($showhide == "open") && isset($parentfield)) {

            	$parent_visibility   = pfcme_parent_visibility_check($parentfield);

            	if (isset($parent_visibility) && ($parent_visibility == 'hidden')) {
            	    $parent_visibility_class = 'parent_hidden';
                } 
            }



            if (isset($value['equalto'])) {
            	$equalto               = $value['equalto'];
            	$equalto = str_replace(' ', '_', $equalto);
            }
    		
	        
	        if ((isset($showhide)) && (isset($parentfield))) {

	        	if (isset($equalto) && ($equalto != '')) {
			        $class  .= '' . $showhide . '_by_' . $parentfield . '_' . $equalto .' '.$parent_visibility_class.''; 
	            } else {
			        $class  .= '' . $showhide . '_by_' . $parentfield . ' '.$parent_visibility_class.''; 
		        }
	        }

	        

    	}
    

		return $class;
    }
   
}



if ( ! function_exists( 'dcfpp_get_conditional_shipping_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_conditional_shipping_class($shipping) {

    	$shipping_method = $shipping['method'];
    	$showhide        = $shipping['showhide'];

    	switch ($showhide) {
    		case "show":
    		    $showhide_class2 ="hide_on_load";
    		break;

    		case "hide":
    		     $showhide_class2 ="show_on_load";
    		break;
    		
    	}


    	$class = ''.$showhide_class2.' '.$showhide.'_by_shipping_method_'. $shipping_method .'';


    	return $class;
    }

}



if ( ! function_exists( 'dcfpp_get_conditional_payment_class' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_conditional_payment_class($payment) {

    	$payment_geteway = $payment['gateway'];
    	$showhide        = $payment['showhide'];

    	switch ($showhide) {
    		case "show":
    		    $showhide_class3 ="hide_on_load2";
    		break;

    		case "hide":
    		     $showhide_class3 ="show_on_load2";
    		break;
    		
    	}

    	$class = ''.$showhide_class3.' '.$showhide.'_by_payment_gateway_'.$payment_geteway.'';
    

		return $class;
    }
   
}



if ( ! function_exists( 'dcfpp_get_visibility_class_combined' ) ) {

    /**
	 * returns conditional classes
	 *
	 * @access public
	 * @subpackage	Forms
	 */



    function dcfpp_get_visibility_class_combined($value) {

    	$dcfpp_conditional_class = '';

    	switch($value['visibility']) {

    		case "field-specific":
    		    $dcfpp_conditional_class = dcfpp_get_conditional_class($value['conditional']);
    		break;

    		case "shipping-specific":
    		    $dcfpp_conditional_class = dcfpp_get_conditional_shipping_class($value['shipping']);
    		break;

    		case "payment-specific":
    		    $dcfpp_conditional_class = dcfpp_get_conditional_payment_class($value['payment']);
    		break;

    	}


    	return $dcfpp_conditional_class;
    }

}







if ( ! function_exists( 'dcfppinput_conditional_class' ) ) {
	
	function dcfppinput_conditional_class($fieldkey) {

		$billing_settings_key      = 'dcfpp_billing_settings';
	    $shipping_settings_key     = 'dcfpp_shipping_settings';
	    $dcfpp_additional_settings = 'dcfpp_additional_settings';
		$dcfpp_class_text          = '';
		 
		 
		$billing_fields                = (array) get_option( $billing_settings_key );
		$shipping_fields               = (array) get_option( $shipping_settings_key );
		$additional_fields             = (array) get_option( $dcfpp_additional_settings );
		 
		$hiderlist  = array();
		$openerlist = array();
		 
		foreach ($billing_fields as $billingkey=>$billingvalue) {

			if (isset($billingvalue['visibility']) && ($billingvalue['visibility'] == 'field-specific')) {
			 
			    $conditional                = $billingvalue['conditional'];

			    foreach ($conditional as $key1=>$value1) {

                    if (isset($value1['parentfield'])) {
                    	$parentfield1               = $value1['parentfield'];
                    }

                    if (isset($value1['showhide'])) {
                    	$cxshowhide1               = $value1['showhide'];
                    }
			 	    
			        
			        

			        if (isset($parentfield1) && ($parentfield1 != '')) {
				
				        if (isset($cxshowhide1) && ($cxshowhide1 != '')) {
					        switch ($cxshowhide1) {
						        case "open":
						            if (!in_array($parentfield1, $openerlist)) array_push($openerlist, $parentfield1);
						        break;
						
						        case "hide":
						            if (!in_array($parentfield1, $hiderlist)) array_push($hiderlist, $parentfield1);
						        break;
						    }
				        }
			        }
			    }
            }   
		}
		 
		foreach ($shipping_fields as $shippingkey=>$shippingvalue) {

			if (isset($shippingvalue['visibility']) && ($shippingvalue['visibility'] == 'field-specific')) {
			 
			    $conditional2                = $shippingvalue['conditional'];

			    foreach ($conditional2 as $key2=>$value2) {

			 	    if (isset($value2['parentfield'])) {
                    	$parentfield2               = $value2['parentfield'];
                    }

                    if (isset($value2['showhide'])) {
                    	$cxshowhide2                = $value2['showhide'];
                    }

			        if (isset($parentfield2) && ($parentfield2 != '')) {
				
				        if (isset($cxshowhide2) && ($cxshowhide2 != '')) {
					        switch ($cxshowhide2) {
						        case "open":
						            if (!in_array($parentfield2, $openerlist)) array_push($openerlist, $parentfield2);
						        break;
						
						        case "hide":
						            if (!in_array($parentfield2, $hiderlist)) array_push($hiderlist, $parentfield2);
						        break;
						    }
				        }
			        }
			    }
			}   
		}
		 
		 
        
        foreach ($additional_fields as $additionalkey=>$additionalvalue) {

			if (isset($additionalvalue['visibility']) && ($additionalvalue['visibility'] == 'field-specific')) {
			 
			    if (isset($additionalvalue['conditional'])) {
			    	$conditional3                = $additionalvalue['conditional'];
			    }
			    
                if (isset($conditional3)) {

			        foreach ($conditional3 as $key3=>$value3) {

			 	        if (isset($value3['parentfield'])) {
                    	    $parentfield3               = $value3['parentfield'];
                        }

                        if (isset($value3['showhide'])) {
                    	    $cxshowhide3                = $value3['showhide'];
                        }

			            if (isset($parentfield3) && ($parentfield3 != '')) {
				
				            if (isset($cxshowhide3) && ($cxshowhide3 != '')) {
					            switch ($cxshowhide3) {
						            case "open":
						                if (!in_array($parentfield3, $openerlist)) array_push($openerlist, $parentfield3);
						            break;
						
						            case "hide":
						                if (!in_array($parentfield3, $hiderlist)) array_push($hiderlist, $parentfield3);
						            break;
						        }
				            }
			            }
			        }
			    }
			}   
		}
		 
		   
		if (in_array($fieldkey, $openerlist)) {

			$dcfppopernertext                = 'dcfpp-opener';

		} else {

			$dcfppopernertext                = '';
		}
		   
		if (in_array($fieldkey, $hiderlist)) {

			$dcfpphidertext                 = 'dcfpp-hider';

		} else {

			$dcfpphidertext                 = '';
		}
			
			
		$dcfpp_class_text  = ''.$dcfppopernertext.' '.$dcfpphidertext.'';
			
		    
			
	    return $dcfpp_class_text;
	}
	        
}
?>