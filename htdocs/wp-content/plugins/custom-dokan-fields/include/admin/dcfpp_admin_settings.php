<?php

	
class dcfpp_add_settings_page_class {
	
	
	
	private $billing_settings_key       = 'dcfpp_billing_settings';
	private $extra_settings_key         = 'dcfpp_extra_settings';
	
    private $dcfpp_dcfpp_plugin_settings_tabs = array();	
	
	
	public function __construct() {
	    
		
		
	    add_action( 'init', array( $this, 'load_settings' ) );
		add_action( 'admin_init', array( $this, 'register_billing_settings' ) );
		add_action( 'admin_init', array( $this, 'register_extra_settings' ) );
		
		add_action( 'admin_menu', array( $this, 'add_admin_menus' ) ,100);
		add_action( 'admin_enqueue_scripts', array($this, 'dcfpp_register_admin_scripts'));
		add_action( 'admin_enqueue_scripts', array($this, 'dcfpp_load_admin_default_css'));
        add_action( 'wp_ajax_restore_billing_fields', array( $this, 'restore_billing_fields' ) );
		
		
	}
	
	public function dcfpp_get_posts_ajax_callback(){
 
	
	  $return = array();
      $post_type_array = array('product', 'product_variation');
	  // you can use WP_Query, query_posts() or get_posts() here - it doesn't matter
	  $search_results = new WP_Query( array( 
		's'=> sanitize_text_field($_GET['q']), // the search query
		'post_status' => 'publish', // if you don't want drafts to be returned
		'ignore_sticky_posts' => 1,
		'post_type'           => $post_type_array,
		'posts_per_page' => 50 // how much to show at once
	  ) );
	  
	
	  if( $search_results->have_posts() ) :
		while( $search_results->have_posts() ) : $search_results->the_post();	
			// shorten the title a little
			$title = ( mb_strlen( $search_results->post->post_title ) > 50 ) ? mb_substr( $search_results->post->post_title, 0, 49 ) . '...' : $search_results->post->post_title;
			$finaltitle='#'. $search_results->post->ID.'- '.$title.'';
			$return[] = array( $search_results->post->ID, $finaltitle ); // array( Post ID, Post Title )
		endwhile;
	  endif;
	   echo json_encode( $return );
	  die;
    }
	
	
	public function restore_billing_fields() {
	    if( current_user_can('manage_woocommerce') ) {
           delete_option( $this->billing_settings_key );
	    }
	   
	   die();
	}
	


	
	
	
	
	
	public function load_settings() {
		$this->billing_settings = (array) get_option( $this->billing_settings_key );
		
		$this->billing_settings = array_merge( array(
		), $this->billing_settings );

		$this->extra_settings = (array) get_option( $this->extra_settings_key );
		
		$this->extra_settings = array_merge( array(
		), $this->extra_settings );
		
		
			
		
	}



	public function dcfpp_load_admin_default_css() {

	    wp_enqueue_style( 'woomatrix_admin_menu_css', ''.dcfpp_PLUGIN_URL.'assets/css/admin_menu.css' );
	    wp_enqueue_script( 'woomatrix_admin_menu_js', ''.dcfpp_PLUGIN_URL.'assets/js/admin_menu.js' );

	}
	
	

	
	/*
	 * registers admin scripts via admin enqueue scripts
	 */
	public function dcfpp_register_admin_scripts($hook) {
	    global $billing_dcfppsettings_page;
			
		if ( $hook == $billing_dcfppsettings_page ) {
		     
 
		 
		 
		 
		    wp_enqueue_style( 'select2', ''.dcfpp_PLUGIN_URL.'assets/css/select2.css' );
		    wp_enqueue_script( 'select2', ''.dcfpp_PLUGIN_URL.'assets/js/select2.js' ,array('jquery') );
		 
		 
		    wp_enqueue_script( 'dcfppadmin-custom', ''.dcfpp_PLUGIN_URL.'assets/js/custom.js' );
		    wp_enqueue_script( 'jquery-ui-sortable');
		 
		 
		    wp_enqueue_script( 'jquery.tag-editor', ''.dcfpp_PLUGIN_URL.'assets/js/jquery.tag-editor.js' );
		    wp_enqueue_style( 'jquery.tag-editor', ''.dcfpp_PLUGIN_URL.'assets/css/jquery.tag-editor.css' );
		    wp_enqueue_script( 'dcfppadmin', ''.dcfpp_PLUGIN_URL.'assets/js/dcfppadmin.js' );
		 
         
		    wp_enqueue_style( 'dcfppadmin', ''.dcfpp_PLUGIN_URL.'assets/css/dcfppadmin.css' );
		    wp_enqueue_style ( 'dcfppadmin-custom',''.dcfpp_PLUGIN_URL.'assets/css/custom.css');
		 

		 
		    wp_enqueue_script( 'dcfpp-frontend1', ''.dcfpp_PLUGIN_URL.'assets/js/frontend1.js' );
		    wp_enqueue_style( 'jquery-ui', ''.dcfpp_PLUGIN_URL.'assets/css/jquery-ui.css' );
		    wp_enqueue_style( 'dcfpp-frontend', ''.dcfpp_PLUGIN_URL.'assets/css/frontend.css' );
		 


        

            $billing_select = '';
            
            

            $country_fields = '';

		    $billing_select .= '<select class="checkout_field_rule_parentfield" name="">';
		    
		    
				     
	        foreach ($this->billing_settings as $optionkey=>$optionvalue) { 
				   
		        if ( (isset ($optionvalue['type']) && ($optionvalue['type'] == 'email')) || (preg_match('/\b'.$optionkey.'\b/', $country_fields ))) { 
					 
			    } else { 

				    if (isset($optionvalue['label']))  { 

					    $optionlabel = $optionvalue['label']; 

				    } else { 

					    $optionlabel = $optionkey; 
				    }  
					    	
				    $billing_select .='<option value="'.$optionkey.'">'.$optionlabel.'</option>';
				    $fees_select    .='<option value="'.$optionkey.'">'.$optionlabel.'</option>';
			    } 
		    } 

		    $fees_select    .= '</optgroup>';
				 
		    $billing_select .= '</select>';
		    


		    if( current_user_can('manage_woocommerce') ) {

		        $restore_warning_text = esc_html__( 'Restoring Default fields will undo all your Changes. Are you sure you want to do this ?' ,'custom-dokan-fields');

		    } else {

		    	$restore_warning_text = esc_html__( 'You can not restore fields in plugin demo.Of course this will work on your site.' ,'custom-dokan-fields');

		    }


        
		
		 
		    $translation_array = array( 
		        'removealert'               => esc_html__( 'Are you sure you want to delete?' ,'custom-dokan-fields'),
		        'checkoutfieldtext'         => esc_html__( 'billing_field_' ,'custom-dokan-fields'),
		        'checkoutfieldtext4'        => esc_html__( 'Custom field ' ,'custom-dokan-fields'),
		        'placeholder'               => esc_html__( 'Search and Select ' ,'custom-dokan-fields'),
		        'restorealert'              => $restore_warning_text,
		        'billing_select'            => $billing_select,
			    'optionplaceholder'         => esc_html__( 'Enter Option' ,'custom-dokan-fields'),
			    'classplaceholder'          => esc_html__( 'Enter Class' ,'custom-dokan-fields'),
			    'amountplaceholder'         => esc_html__( 'Amount' ,'custom-dokan-fields'),
			    'showtext'                  => esc_html__( 'Show' ,'custom-dokan-fields'),
			    'addtext'                   => esc_html__( 'Add' ,'custom-dokan-fields'),
			    'deducttext'                => esc_html__( 'Deduct' ,'custom-dokan-fields'),
			    'hidetext'                  => esc_html__( 'Hide' ,'custom-dokan-fields'),
			    'valuetext'                 => esc_html__( 'If value of' ,'custom-dokan-fields'),
			    'equaltext'                 => esc_html__( 'is equal to' ,'custom-dokan-fields'),
			    'fixedtext'                 => esc_html__( 'Fixed Amount' ,'custom-dokan-fields'),
			    'percentagetext'            => esc_html__( 'Percentage' ,'custom-dokan-fields'),
			    'copiedalert'               => esc_html__( 'Field key successfully copied to clipboard.' ,'custom-dokan-fields'),
			    'input_label_text'          => esc_html__( 'Custom Label' ,'custom-dokan-fields')
		    );
         
            wp_localize_script( 'dcfppadmin', 'dcfppadmin', $translation_array );
        }
	

	}


	
	
	public function register_billing_settings() {
		$this->dcfpp_plugin_settings_tabs[$this->billing_settings_key] = esc_html__( 'Dokan Fields' ,'custom-dokan-fields');
		
		register_setting( $this->billing_settings_key, $this->billing_settings_key );
		add_settings_section( 'dcfpp_section_billing', '', '', $this->billing_settings_key );
		add_settings_field( 'dcfpp_billing_option', '', array( $this, 'dcfpp_field_billing_option' ), $this->billing_settings_key, 'dcfpp_section_billing' );
	}
	
	


    public function register_extra_settings() {
		$this->dcfpp_plugin_settings_tabs[$this->extra_settings_key] = esc_html__( 'Settings' ,'custom-dokan-fields');;
		
		register_setting( $this->extra_settings_key, $this->extra_settings_key );
		add_settings_section( 'dcfpp_section_extra', '', '', $this->extra_settings_key );
		add_settings_field( 'dcfpp_extra_option', '', array( $this, 'dcfpp_field_extra_option' ), $this->extra_settings_key, 'dcfpp_section_extra' );
	}
	
	

	

	
	
	public function dcfpp_field_billing_option() {
	    
		include ('forms/dcfpp_admin_billing_fields_form.php');
  
		
	}
	

    public function dcfpp_field_extra_option() { 
	     
       include ('forms/dcfpp_admin_extra_fields_form.php');
		 
		 
	}

	
	
	

	public function add_admin_menus() {
	   global $billing_dcfppsettings_page;

	    add_menu_page(
          esc_html__( 'sysbasics', 'plps' ),
         'SysBasics',
         'manage_woocommerce',
         'sysbasics',
         array($this,'plugin_options_page'),
         ''.dcfpp_PLUGIN_URL.'assets/images/icon.png',
         70
        );
	    

        
	   
	    $billing_dcfppsettings_page = add_submenu_page( 'sysbasics', esc_html__('Dokan Custom Fields'), esc_html__('Dokan Custom Fields'), 'manage_woocommerce', $this->dcfpp_plugin_options, array($this, 'plugin_options_page'));
	}
	
	
	public function plugin_options_page() {
	    global $woocommerce;
	    $gotten_tab  = sanitize_text_field($_GET['tab']);
		$tab = isset($gotten_tab ) ? $gotten_tab : esc_attr($this->billing_settings_key);
		global $billing_fields;
		$billing_fields = '';
		?>
		<div class="wrap">
		    <?php $this->plugin_options_tabs(); ?>
		
			<form method="post" class="<?php echo esc_attr($tab); ?>" action="options.php">
				<?php wp_nonce_field( 'update-options' ); ?>
				<?php settings_fields( $tab ); ?>
				<?php do_settings_sections( $tab ); ?>
				
				
				
				<center><input type="submit" name="submit" id="submit" class="btn btn-success" value="<?php echo esc_html__('Save Changes','custom-dokan-fields'); ?>"></center>
				
				
				<?php 

				



				?> 
			</form>
			<br />
			
		</div>
		<div id="responsediv">
		</div>
		<?php
	}

    public function display_field_label($key,$field) {
		    if (isset($field['label'])) { 
			         $label = $field['label']; 
			    }  else {
					switch ($key) {
                        case "billing_address_1":
						case "shipping_address_1":
                          $label = esc_html__('Address','custom-dokan-fields');
                        break;
                        case "billing_address_2":
						case "shipping_address_2":
                          $label = "";
                        break;
                        
						case "billing_city":
						case "shipping_city":
                          $label = esc_html__('Town / City','custom-dokan-fields');
                        break;
						
						case "billing_state":
						case "shipping_state":
                          $label = esc_html__('State / County','custom-dokan-fields');
                        break;
						
						case "billing_postcode":
						case "shipping_postcode":
                          $label = esc_html__('Postcode / Zip','custom-dokan-fields');
                        break;
						
						
						
                        default:
                          $label = esc_attr($key);
                        }
				}
			if (isset($field['type']) && ($field['type'] == "heading")) {
				$label ="";
			}
			return $label;
	}

	public function display_visual_preview($key,$field) { 
     global $woocommerce;
     
		?>
	 
	  <td width="30%">
	    <label class="">
		  <?php 
		  echo esc_html($this->display_field_label($key,$field));
		  
		  ?>
	    </label>
        
      </td>
	  <td width="30%">
	  	
	  </td>
	 
	<?php }
	
	
	public function show_fields_form($fields,$key,$field,$noticerowno,$slug,$required_slugs,$core_fields,$country_fields,$address2_field) { ?>
	      <?php
		    
            if (isset($field['width'])) {
                 
                $fieldwidth= $field['width'];
               	 
            } elseif (isset($field['class'])) {
                  
                foreach($field['class'] as $class) {
               	  	if (isset($class)) {
                        switch($class) {
                    	    case "form-row-first":
                                $fieldwidth='form-row-first';
						    break;

                    	    case "form-row-last":
                                $fieldwidth='form-row-last';
						    break;

                    	    default:
                    	        $fieldwidth='form-row-wide';
                    	}
                    }
               	} 
            }
	    
	    global $wp_roles;

        if ( ! isset( $wp_roles ) ) { 
    	    $wp_roles = new WP_Roles();  
        }
	
	    $roles = $wp_roles->roles;
        $shipping_methods = WC()->shipping->get_shipping_methods();

	    $payment_gateways = WC()->payment_gateways->get_available_payment_gateways();

	
		$catargs = array(
	      'orderby'                  => 'name',
	      'taxonomy'                 => 'product_cat',
	      'hide_empty'               => 0
	    );
		 
	  
		$categories           = get_categories( $catargs );  

      
		if (!empty($field['category'])) {
		       $chosencategories = implode(',', $field['category']); 
		} else { 
			   $chosencategories=''; 
		}

		if (!empty($field['role'])) {
		       $chosenroles = implode(',', $field['role']); 
		} else { 
			   $chosenroles=''; 
		}
			 
        switch($slug) {
		
		  case "dcfpp_billing_settings":
		    $headlingtext  =''.esc_html__('billing_field_','custom-dokan-fields').''.esc_attr($noticerowno).'';
		    $mntext        ='custom';
		   break;
	
         
		
		
	       } ?>   

       
	   <div class="panel-group panel panel-default dcfpp_list_item" id="dcfpp_list_items_<?php echo esc_attr($noticerowno); ?>" style="display:block;">
           <div class="panel-heading"> 
		
	     <table class="heading-table <?php echo esc_attr($key); ?>_panel <?php if (isset($field['hide']) && ($field['hide'] == 1)) { echo "dcfpp_disabled";} ?>">
	     	<tr>
	     		<td>
	     			<?php if (preg_match('/\b'.$key.'\b/', $core_fields )) { ?>
	     				<input type="checkbox" class="dcfpp_accordion_onoff" parentkey="<?php echo esc_attr($key); ?>" <?php if (!isset($field['hide']) || ($field['hide'] == 0)) { echo "checked";} ?>>
	     				<input type="hidden" class="<?php echo esc_attr($key); ?>_hidden_checkbox" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][hide]" value="<?php if (isset($field['hide'])) { echo esc_attr($field['hide']); } else { echo 0; } ?>" checked>
	     			<?php } else { ?>
                        <span class="glyphicon glyphicon-trash dcfpp_trash_icon"></span>
	     			<?php } ?>


	     			<a class="accordion-toggle dcfpp_edit_icon_a" data-toggle="collapse" data-parent="#accordion" href="#dcfpp<?php echo esc_attr($noticerowno); ?>">
	     				<span class="glyphicon glyphicon-edit dcfpp_edit_icon"></span>
	     			</a>
	     		</td>

	     		<?php $this->display_visual_preview($key,$field); ?>

	     		
	     	</tr>
		  </table>
           </div>
           <div id="dcfpp<?php echo esc_attr($noticerowno); ?>" class="panel-collapse collapse">

		     <table class="table"> 
			 
			 

		     <tr class="dcfpp_field_key_tr">
			    <td width="25%"><label for="<?php echo esc_attr($key); ?>_type"><?php echo esc_html__('Field Key','custom-dokan-fields'); ?></label></td>
			    <td width="75%" class="dcfpp_field_key_tr">
			    	<?php 
                        if (isset($field['field_key']) && ($field['field_key'] != "")) { 
                         	$field_key = $field['field_key'];
                        } else { 
                        	$field_key = $key;
                        }
			    	?>
			    	<?php if (!preg_match('/\b'.$key.'\b/', $core_fields )) { ?>   
			    	    <input type="text" class="dcfpp_change_key_input" clkey="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][field_key]" value="<?php echo esc_attr($field_key); ?>">
			    	<?php } ?>

			   	    <span class="dcfpp_field_key dcfpp_field_key_<?php echo esc_attr($key); ?>"><?php echo esc_attr($field_key); ?></span>
			   	    <span onclick="dcfpp_copyToClipboard('.dcfpp_copy_key_icon_<?php echo esc_attr($key); ?>')" cpkey="<?php echo esc_attr($field_key); ?>" title="<?php echo esc_html__('Copy to clipboard','custom-dokan-fields'); ?>" class="glyphicon glyphicon-book dcfpp_copy_key_icon dcfpp_copy_key_icon_<?php echo esc_attr($key); ?> "></span>

			   	</td>
		     </tr> 

			 <?php if (!preg_match('/\b'.$key.'\b/', $country_fields )) { ?>   
		       <tr>
	           <td width="25%"><label for="<?php echo esc_attr($key); ?>_type"><?php echo esc_html__('Field Type','custom-dokan-fields'); ?></label></td>
		       <td width="75%">
		          <select class="checkout_field_type" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][type]" >
			        <option value="text" <?php if (isset($field['type']) && ($field['type'] == "text")) { echo "selected";} ?> ><?php echo esc_html__('Text','custom-dokan-fields'); ?></option>
					<option value="heading" <?php if (isset($field['type']) && ($field['type'] == "heading")) { echo "selected";} ?> ><?php echo esc_html__('Heading','custom-dokan-fields'); ?></option>
					<option value="paragraph" <?php if (isset($field['type']) && ($field['type'] == "paragraph")) { echo "selected";} ?> ><?php echo esc_html__('Paragraph','custom-dokan-fields'); ?></option>
					<option value="email" <?php if (isset($field['type']) && ($field['type'] == "email")) { echo "selected";} ?> ><?php echo esc_html__('Email','custom-dokan-fields'); ?></option>
					<option value="number" <?php if (isset($field['type']) && ($field['type'] == "number")) { echo "selected";} ?> ><?php echo esc_html__('Number','custom-dokan-fields'); ?></option>
			        <option value="password" <?php if (isset($field['type']) && ($field['type'] == "password")) { echo "selected";} ?>><?php echo esc_html__('Password','custom-dokan-fields'); ?></option>
			        <option value="textarea" <?php if (isset($field['type']) && ($field['type'] == "textarea")) { echo "selected";} ?>><?php echo esc_html__('Textarea','custom-dokan-fields'); ?></option>
					<option value="checkbox" <?php if (isset($field['type']) && ($field['type'] == "checkbox")) { echo "selected";} ?>><?php echo esc_html__('Checkbox','custom-dokan-fields'); ?></option>
			        <option value="dcfppselect" <?php if (isset($field['type']) && ($field['type'] == "dcfppselect")) { echo "selected";} ?>><?php echo esc_html__('Select','custom-dokan-fields'); ?></option>
					<option value="multiselect" <?php if (isset($field['type']) && ($field['type'] == "multiselect")) { echo "selected";} ?>><?php echo esc_html__('multiselect','custom-dokan-fields'); ?></option>
			        <option value="radio" <?php if (isset($field['type']) && ($field['type'] == "radio")) { echo "selected";} ?>><?php echo esc_html__('Radio Select','custom-dokan-fields'); ?></option>
			        <option value="datepicker" <?php if (isset($field['type']) && ($field['type'] == "datepicker")) { echo "selected";} ?>><?php echo esc_html__('Date Picker','custom-dokan-fields'); ?></option>
			        <option value="datetimepicker" <?php if (isset($field['type']) && ($field['type'] == "datetimepicker")) { echo "selected";} ?>><?php echo esc_html__('Date Time Picker','custom-dokan-fields'); ?></option>
			        <option value="timepicker" <?php if (isset($field['type']) && ($field['type'] == "timepicker")) { echo "selected";} ?>><?php echo esc_html__('Time Picker','custom-dokan-fields'); ?></option>
			        <option value="daterangepicker" <?php if (isset($field['type']) && ($field['type'] == "daterangepicker")) { echo "selected";} ?>><?php echo esc_html__('Date Range Picker','custom-dokan-fields'); ?></option>
			        <option value="datetimerangepicker" <?php if (isset($field['type']) && ($field['type'] == "datetimerangepicker")) { echo "selected";} ?>><?php echo esc_html__('Date Time Range Picker','custom-dokan-fields'); ?></option>
			       </select>
		       </td>
	           </tr>
               <?php }  ?>
               
               <?php if (!preg_match('/\b'.$key.'\b/', $address2_field )) { ?>
			   <tr>
                <td width="25%"><label for="<?php echo esc_attr($key); ?>_label"><?php  echo esc_html__('Label','custom-dokan-fields'); ?></label></td>
	            <td width="75%"><input type="text" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][label]" value="<?php 
	                if (isset($field['label']) && ($field['label'] != '')) { 
	            	    echo esc_attr($field['label']); 
	            	} elseif ($key == "order_comments") {
                        echo esc_html__('Order notes','custom-dokan-fields');
	            	} else { 
	            		echo esc_attr($headlingtext); 

	            	} ?>" size="100"></td>
               </tr>
			   <?php }  ?>
			
			   
			   
			



			<?php if (isset($field['type']) && ($field['type'] == "textarea")) {  ?>

				<tr>
					<td width="25%">
						<label for="<?php echo esc_attr($key); ?>_charlimit"><?php echo esc_html__('Max Characters Allowed','custom-dokan-fields'); ?></label>
					</td>
					<td width="75%">
						<?php $charlimit = isset($field['charlimit']) ? $field['charlimit'] : 200; ?>
						<input type="number" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][charlimit]" value="<?php echo esc_attr($charlimit); ?>">
					</td>
				</tr>	

			<?php } ?>
			   
			   
			   
			   
			   
			   
			   <tr>
                <td width="25%"><label for="<?php echo esc_attr($key); ?>_label"><?php  echo esc_html__('Placeholder ','custom-dokan-fields'); ?></label></td>
	            <td width="75%"><input type="text" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][placeholder]" value="<?php if (isset($field['placeholder'])) { echo esc_attr($field['placeholder']); } ?>" size="35"></td>
               </tr>
			   
                <tr class="add-field-extraclass" style="">
               	    <td width="25%">
               		    <label for="<?php echo esc_attr($key); ?>_extraclass"><?php echo esc_html__('Extra Class','custom-dokan-fields'); ?></label>
               	    </td>
               	    <td width="75%">
               		    <input type="text" class="dcfpp_checkout_field_extraclass" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][extraclass]" value="<?php if (isset($field['extraclass'])) { echo esc_attr($field['extraclass']); } ?>" size="35">
               		    <?php echo esc_html__('Use space key or comma to separate class','custom-dokan-fields'); ?>
               	    </td>
                </tr>

                <?php if ($key != 'order_comments') { ?>

               	<tr class="add-field-options" style="">
               		<td width="25%">
               			<label for="<?php echo esc_attr($key); ?>_options"><?php echo esc_html__('Options','custom-dokan-fields'); ?></label>
               		</td>
               		<td width="75%">
               			<input type="text" class="dcfpp_checkout_field_option_values" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][options]" value="<?php if (isset($field['options'])) { echo esc_attr($field['options']); } ?>" size="35">
               			<ul>
               				<li>
               					<?php echo esc_html__('Use pipe key or comma to separate option.If you are using it for field specific conditional visibility replace space with underscore ( _ ) . For Example value for "Option 2" will be Option_2','custom-dokan-fields','custom-dokan-fields'); ?>
               				</li>
               			</ul>

               		</td>
               	</tr>
               <?php } ?>

               <?php if (isset($field['type']) && (($field['type'] == "dcfppselect") || ($field['type'] == "radio"))) {  ?>

               	    <?php if (isset($field['options'])) {  ?>

               	    	<tr>
               	    		<td width="25%">
               	    			<label for="<?php echo esc_attr($key); ?>_default_option"><?php echo esc_html__('Default Option','custom-dokan-fields'); ?></label>
               	    		</td>
               	    		<td width="75%">
               	    			<?php 
               	    			    $options_arr = preg_split ("/\,/", $field['options']); 

               	    			    ?>

               	    			    <select class="dcfpp_default_option_select" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][default_option]">
               	    			    	    <option  selected="true">
               	    			    	    	<?php echo esc_html__('Choose Default Option','custom-dokan-fields'); ?>
               	    			    	    		
               	    			    	    </option>
                                            <?php
                                                foreach($options_arr as $skey=>$svalue) { 
                                                    $option_key  = preg_replace('/\s+/', '_', $svalue);
                                                	?>

                                                    <option value="<?php echo esc_attr($option_key); ?>"<?php if (isset($field['default_option']) &&  ($field['default_option'] == $svalue)) { echo 'selected';} ?>>
                                                   	    <?php echo esc_attr($svalue); ?>
                                                   	    	
                                                   	</option>

                                                <?php } ?>
                       
               	    			    </select>
               	    	        
               	           </td>
               	        </tr>

               	   <?php } ?>

               <?php  } ?>
			   
		
			   <?php 
			   $validatearray='';
			   
			    if (isset($field['validate'])) {
			        foreach ($field['validate'] as $z=>$value) {
			          $validatearray.=''.$value.',';
			        } 
			       
				   $validatearray=substr_replace($validatearray, "", -1);
			    }
			  
			   
			   ?>
			   <tr>
                <td width="25%"><label><?php  echo esc_html__('Visibility','custom-dokan-fields'); ?></label></td>
	            <td width="75%">
		            <select class="checkout_field_visibility" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][visibility]" >
		                <option value="always-visible" <?php if (isset($field['visibility']) && ($field['visibility'] == "always-visible" )) { echo 'selected'; } ?>><?php echo esc_html__('Always Visibile','custom-dokan-fields'); ?></option>
					   
					    <option value="field-specific" <?php if (isset($field['visibility']) && ($field['visibility'] == "field-specific" )) { echo 'selected'; } ?>><?php echo esc_html__('Conditional - Field Specific','custom-dokan-fields'); ?></option>
					    <option value="role-specific" <?php if (isset($field['visibility']) && ($field['visibility'] == "role-specific" )) { echo 'selected'; } ?>><?php echo esc_html__('Conditional - Role Specific','custom-dokan-fields'); ?></option>
					    
                        

			       </select>
		        </td>
	           </tr>
			   



			    <tr class="checkout_field_role_tr" style="<?php if (isset($field['visibility']) && ($field['visibility'] == "role-specific" )) { echo "display:;"; } else { echo 'display:none;'; } ?>" >
			        <td width="25%">
                        <label><span class="dcfppformfield"><?php echo esc_html__('Select Roles','custom-dokan-fields'); ?></span></label>
	                </td>
			        <td width="75%">
			            <select class="checkout_field_role" data-placeholder="<?php echo esc_html__('Choose Roles','custom-dokan-fields'); ?>" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][role][]"  multiple style="width:600px">
                            <?php foreach ($roles as $rkey=>$rvalue) { ?>
				                <option value="<?php echo esc_attr($rkey); ?>" <?php if (preg_match('/\b'.$rkey.'\b/', $chosenroles )) { echo 'selected';}?>><?php echo esc_attr($rvalue['name']); ?></option>
				            <?php } ?>
                        </select>
                    </td>
			    </tr>






				<?php if (isset($field['conditional'])) $conditional_field = $field['conditional']; ?>

				<tr class="checkout_field_conditional_tr" style="<?php if (isset($field['visibility']) && ($field['visibility'] == "field-specific" )) { echo "display:;"; } else { echo 'display:none;'; } ?>" >
			        <td width="25%">
                        <label for="notice_category"><span class="dcfppformfield">
                        	<?php echo esc_html__('Set Rule','custom-dokan-fields'); ?></span>
                        </label>
	                </td>
			        <td width="75%">
			            <div class="conditional_fields_div_wrapper conditional_fields_div_wrapper_<?php echo esc_attr($key); ?>">
                            
                            <?php $mnindex = 1; ?>

                            <?php if (isset($field['conditional'])) { ?>
                            
                            <?php $mnindex = max(array_keys($field['conditional'])) ; ?>

                                <?php $mnindex++; ?>

			            	    <?php foreach ($field['conditional'] as $conditionalkey=>$conditionalvalue) { ?>

                                    

			            	        <div class="conditional-row">
			            		        <select class="checkout_field_conditional_showhide" name="dcfpp_<?php echo esc_attr($mntext); ?>_settings[<?php echo esc_attr($key); ?>][conditional][<?php echo esc_attr($conditionalkey); ?>][showhide]" >
			            			        <option value="open" <?php if (isset($conditionalvalue['showhide']) && ($conditionalvalue['showhide']) == "open") { echo 'selected';} ?> ><?php echo esc_html__('Show','custom-dokan-fields'); ?></option>
			            			        <option value="hide" <?php if (isset($conditionalvalue['showhide']) && ($conditionalvalue['showhide']) == "hide") { echo 'selected';} ?>><?php echo esc_html__('Hide','custom-dokan-fields'); ?></option>
			            		        </select>
			            		        <span class="dcfppformfield">
			            		        	<strong>&emsp;<?php echo esc_html__('If value of','custom-dokan-fields'); ?>&emsp;</strong>
			            		        </span>

			            		        <select class="checkout_field_conditional_parentfield" name="dcfpp_<?php echo esc_attr($mntext); ?>_settings[<?php echo esc_attr($key); ?>][conditional][<?php echo esc_attr($conditionalkey); ?>][parentfield]" >
                                            <?php foreach ($fields as $fkey=>$ffield) { ?>
                                            	<?php 
                                                    $nkey = isset($ffield['field_key']) ? $ffield['field_key'] : $fkey;
                                            	?>
                                            	<?php if ($key != $fkey) { ?>
                                                <option value="<?php echo esc_attr($nkey); ?>" <?php if (isset($conditionalvalue['parentfield']) && ($conditionalvalue['parentfield']) == $nkey) { echo 'selected';} ?>>
                                        	        <?php if (isset($ffield['label'])) {
                                                        echo esc_attr($ffield['label']); 
                                        	        } else { 
                                                        echo esc_attr($nkey);
                                        	        }
                                        	    ?>

                                                </option>
                                            <?php } ?>
                                            <?php } ?>
			            			
			            		        </select>

			            		        <span class="dcfppformfield">
			            			        <strong>&emsp;<?php echo esc_html__('is equal to','custom-dokan-fields'); ?> </strong>
			            		        </span>

			            		        <input type="text" class="checkout_field_conditional_equalto" name="dcfpp_<?php echo esc_attr($mntext); ?>_settings[<?php echo esc_attr($key); ?>][conditional][<?php echo esc_attr($conditionalkey); ?>][equalto]" value="<?php if (isset($conditionalvalue['equalto'])) { echo esc_attr($conditionalvalue['equalto']); } ?>">
			            		        <span class="glyphicon glyphicon-trash dcfpp-remove-condition"></span>

			            	        </div>

			                    <?php  } ?>
			                
			                <?php } ?>
			            
			                </div>

			                <ul>
			                    <li>
			             	        <?php echo esc_html__('If parent field is checkbox leave blank for equal to field.','custom-dokan-fields'); ?>
			             		</li>
			                    <li>
			        	            <?php echo esc_html__('If parent field is radio/select and its value has space, replace space with underscore ( _ ) and all text should be lowercase for example equal to field for "Option 3" will be option_3.','custom-dokan-fields'); ?>
			        		    </li>
			        		    <li>
			             	        <?php echo esc_html__('You can also use text/textarea field as parent field.','custom-dokan-fields'); ?>
			             		</li>
			                </ul>

			            <input type="button" mnindex="<?php echo esc_attr($mnindex); ?>" mntype="<?php if (isset($mntext)) { echo esc_attr($mntext); } ?>" keyno="<?php echo esc_attr($key); ?>" class="btn button-primary add-condition-button" value="<?php echo esc_html__('Add Condition','custom-dokan-fields'); ?>">
                    </td>
			    </tr>


			   
			   <tr class="disable_datepicker_tr"  style="<?php if (isset($field['type']) && (($field['type'] == "datepicker") || ($field['type'] == "datetimepicker") || ($field['type'] == "daterangepicker")|| ($field['type'] == "datetimerangepicker"))) { echo "display:;";} else { echo "display:none;"; } ?>">
			     <td width="25%"><label for="<?php echo esc_attr($key); ?>_clear"><?php  echo esc_html__('Chose Options','custom-dokan-fields'); ?></label></td>
			     <td  width="75%">
			      <table>
			       
			   
			        <tr >
                     <td><input class="checkout_field_disable_past_dates" type="checkbox" name="<?php echo esc_attr($slug); ?>[<?php echo esc_attr($key); ?>][disable_past]" <?php if (isset($field['disable_past']) && ($field['disable_past'] == 1)) { echo "checked";} ?> value="1"></td>
			         <td><label ><?php  echo esc_html__('Disable Past Date Selection In Datepicker','custom-dokan-fields'); ?></label></td>
					</tr>
					

			        </table>
				   </td>
				 </tr>
			   </table>

             </div>
			
          </div>
	<?php }
	
	
	

	

	public function plugin_options_tabs() {

		$gotten_tab  = sanitize_text_field($_GET['tab']);

		$current_tab = isset( $gotten_tab ) ? $gotten_tab : $this->billing_settings_key;
        echo '<h2 class="nav-tab-wrapper">';
		foreach ( $this->dcfpp_plugin_settings_tabs as $tab_key => $tab_caption ) {
			$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
			echo '<a class="nav-tab ' . $active . '" href="?page=' . esc_attr($this->dcfpp_plugin_options) . '&tab=' . esc_attr($tab_key) . '">' . esc_attr($tab_caption) . '</a>';	
		}
		echo '</h2>';
	}
	
	public function show_new_form($fields,$slug,$country_fields) {
		
       
		

     	 
        $catargs = array(
	      'orderby'                  => 'name',
	      'taxonomy'                 => 'product_cat',
	      'hide_empty'               => 0
	     );
		 
	  
		$categories           = get_categories( $catargs ); 
		
	    include ('forms/dcfpp_show_new_form.php');
    }
	

}




new dcfpp_add_settings_page_class();

?>