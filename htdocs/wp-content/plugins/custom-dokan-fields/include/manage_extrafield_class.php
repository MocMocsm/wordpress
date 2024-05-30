<?php
class dcfpp_manage_extrafield_class {

     public function __construct() {
		add_filter( 'woocommerce_form_field_text', array( $this, 'dcfpptext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_heading', array( $this, 'dcfppheading_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_password', array( $this, 'dcfpptext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_email', array( $this, 'dcfpptext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_number', array( $this, 'dcfpptext_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_textarea', array( $this, 'dcfpptextarea_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_checkbox', array( $this, 'dcfppcheckbox_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_radio', array( $this, 'radio_form_field' ), 10, 4 );
     	add_filter( 'woocommerce_form_field_dcfppselect', array( $this, 'dcfppselect_form_field' ), 10, 4 );
	    add_filter( 'woocommerce_form_field_datepicker', array( $this, 'datepicker_form_field' ), 10, 4 );
	    add_filter( 'woocommerce_form_field_datetimepicker', array( $this, 'datetimepicker_form_field' ), 10, 4 );
	    add_filter( 'woocommerce_form_field_timepicker', array( $this, 'timepicker_form_field' ), 10, 4 );
	    add_filter( 'woocommerce_form_field_daterangepicker', array( $this, 'daterangepicker_form_field' ), 10, 4 );
	    add_filter( 'woocommerce_form_field_datetimerangepicker', array( $this, 'datetimerangepicker_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_multiselect', array( $this, 'multiselect_form_field' ), 10, 4 );
		add_filter( 'woocommerce_form_field_paragraph', array( $this, 'paragraph_form_field' ), 10, 4 );
		
		

		


	 }
	 
	 

      
	  public function dcfpptext_form_field( $field, $key, $args, $value ) {

	  	 $key = isset($args['field_key']) ? $args['field_key'] : $key;

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		     


		$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);

		
		if ($value == "empty") {
			$value = "";
		}

		

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            <input type="' . esc_attr( $args['type'] ) . '" class="'.$fees_class.' input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'  '. dcfppinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' value="' . esc_attr( $value ) . '" />
        </p>' . $after;
         

        return $field;
      }
	  
	  
	  public function dcfppheading_form_field($field, $key, $args, $value) {

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		 
		 
		 
		 
	     

        $field = '<h3 class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field">
		
            <span for="' . $key . '" class="dcfpp_heading ' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</span>
			
        </h3>' . $after;
         

        return $field;
      }


    /**
     * Paragraph Field
     * params $field - 
     * params $key- unique key
     * $args- required,placeholder,label etc
     * $value- default value
     */


    public function paragraph_form_field( $field, $key, $args, $value) {

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		 
		 
		if ($value == "empty") {
			$value = "";
		}
		 
	     

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field">
		
            <span for="' . $key . '" class="dcfpp_heading ' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</span>
			
        </p>' . $after;
         

        return $field;
    }
	  

	  
    public function dcfpptextarea_form_field($field,$key, $args, $value ) {

    	$key = isset($args['field_key']) ? $args['field_key'] : $key;

    	if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
    	
    	if ( $args['required'] ) {
    		$args['class'][] = 'validate-required';
    		$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
    	} else {
    		$required = '';
    	}
    	
    	
        if ($value == "empty") {
			$value = "";
		}

    	$fees_class       = '';

    	$fees_class       = dcfpp_get_fees_class($key);
    	$charlimit = isset($args['charlimit']) ? $args['charlimit'] : 200;

    	
    	

    	$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field">
    	<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
    	<textarea maxlength="'.$charlimit.'" name="' . esc_attr( $key ) . '" class="'.$fees_class.' input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'  '. dcfppinput_conditional_class($key) .'" id="' . $key . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . '>'. esc_textarea( $value  ) .'</textarea>
    	</p>' . $after;
    	

    	return $field;
    }
	  
	 public function dcfppcheckbox_form_field($field,$key, $args, $value) {




	 	 $key = isset($args['field_key']) ? $args['field_key'] : $key;

         if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	     if ( $args['required'] ) {
			  $args['class'][] = 'validate-required';
			  $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		  } else {
			$required = '';
		  }
		
		 
         if ($value == "empty") {
			$value = "";
		 }

		 $fees_class       = '';

		 $fees_class       = dcfpp_get_fees_class($key);
	   

         $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field"><label class="checkbox ' . implode( ' ', $args['label_class'] ) .' ' . implode( ' ', $args['class'] ) .' ' . $dcfpp_conditional_class .'" ><input type="' . esc_attr( $args['type'] ) . '" class="'.$fees_class.' input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) .' ' . $dcfpp_conditional_class .' '. dcfppinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . $key . '" value="yes" '.checked( $value, 'yes' , false ) .' /> '
						 . $args['label'] . $required . '</label></p>' . $after;
         

        return $field;
      }
     
      public function radio_form_field($field, $key, $args, $value ) {
      
	    $key = isset($args['field_key']) ? $args['field_key'] : $key;
	  
        if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
        
		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		} else {
			$required = '';
		}


		$fees_class       = '';

		$fees_class         = dcfpp_get_fees_class($key);


		$action_class       = '';

		$action_class       = dcfpp_get_action_class($key);
		
        
		if ($value == "empty") {
			$value = "";
		}
		

		 $options = '';

		if (! empty ($args['placeholder'])) {
		
		    $value    = $args['placeholder'];
	    }

	    if (! empty ($args['default_option'])) {
     		
     		$value    = $args['default_option'];
     	}

        if ( !empty( $args[ 'options' ] ) ) {
		  
	        foreach ( $args[ 'options' ] as $option_key => $option_text ) {
	       	
	       	  $option_key  = preg_replace('/\s+/', '_', $option_key);
	       	  $default_val = preg_replace('/\s+/', '_', $value);

	       	  if (isset($value) && ($default_val == $option_key)) {
	       	  	  $checked_text = 'checked';
	       	  } else {
	       	  	  $checked_text = $default_val;
	       	  }

			  $options .= '<input type="radio" name="' . $key . '" id="' . $key . '" value="' . $option_key . '" ' . checked( $value, $option_key, false ) . 'class="'.$fees_class.' '.$action_class.' select  '. dcfppinput_conditional_class($key) .'" '.$checked_text.' '.$checked_text.'>  ' . $option_text . '<br>';
		    }
            
            
			$field = '<p class="dcfpp-radio-select form-row ' . implode( ' ', $args[ 'class' ] ) . ' " id="' . $key . '_field">
			          <label for="' . $key . '" class="' . implode( ' ', $args[ 'label_class' ] ) . '">' . $args[ 'label' ] . $required . '</label>' . $options . '</p>' . $after;
        }



        return $field;
       
     }
      

     public function dcfppselect_form_field( $field, $key, $args, $value) {

     	$key = isset($args['field_key']) ? $args['field_key'] : $key;

     	if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

     	if ( $args['required'] ) {
     		$args['class'][] = 'validate-required';
     		$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
     	} else {
     		$required = '';
     	}

     		  
     	$options = '';

     	
     	$options .= '<option>'.esc_html__('Choose an Option','custom-dokan-fields').'</option>';
     		

     	if (! empty ($args['default_option'])) {
     		
     		$value    = $args['default_option'];
     	}

     	if ($value == "empty") {
			$value = "";
		}


     	$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);


     	if ( ! empty( $args['options'] ) ) {
     		foreach ( $args['options'] as $option_key => $option_text ) {

     			$option_key = preg_replace('/\s+/', '_', $option_key);

     			$options .= '<option value="' . $option_key . '" '. selected( $value, $option_key, false ) . '>' . $option_text .'</option>';
     		}

     		$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field">
     		<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
     		<select data-placeholder="'.$args['placeholder'].'" name="' . $key . '" id="' . $key . '" class="select '.$fees_class.' dcfpp-singleselect  '. dcfppinput_conditional_class($key) .'" >
     		' . $options . '
     		</select>
     		</p>' . $after;
     	}

     	return $field;
     }


	 
	 public function multiselect_form_field( $field, $key, $args, $value) {
	 	$key = isset($args['field_key']) ? $args['field_key'] : $key;

	  if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';
	  
	    if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		} else {
			$required = '';
		}


        if ($value == "empty") {
			$value = "";
		}
	
     
       
	    $optionsarray='';
	    
		if (isset($value) && is_array($value)) {
			   
			 foreach ($value as $optionvalue) {
			       $optionsarray.=''.$optionvalue.',';
			    } 
			  
			$optionsarray=substr_replace($optionsarray, "", -1);
			
	    }
		
		
	    

		$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);
		
	    $options = '';

    if ( ! empty( $args['options'] ) ) {
        foreach ( $args['options'] as $option_key => $option_text ) {

        	$option_key = preg_replace('/\s+/', '_', $option_key);

			if (preg_match('/\b'.$option_key.'\b/', $optionsarray )) {
				$selectstatus = 'selected';
			} else {
				$selectstatus = '';
			}

            $options .= '<option value="' . $option_key . '" '. $selectstatus . '>' . $option_text .'</option>';
        }

        $field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' " id="' . $key . '_field">
            <label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
            <select name="' . $key . '[]" id="' . $key . '" class="'.$fees_class.' select dcfpp-multiselect  '. dcfppinput_conditional_class($key) .'" multiple="multiple">
                ' . $options . '
            </select>
        </p>' . $after;
      }

       return $field;
	 }
	 
	 
	public function datepicker_form_field(  $field, $key, $args, $value) {
		$key = isset($args['field_key']) ? $args['field_key'] : $key;

	    if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		} else {
			$required = '';
		}
		
		 
		
		if (isset($args['disable_past'])) {
			$datepicker_class='dcfpp-datepicker-disable-past';
		} else {
			$datepicker_class='dcfpp-datepicker';
		}

		if ($value == "empty") {
			$value = "";
		}


		$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( ! empty( $args['validate'] ) )
			foreach( $args['validate'] as $validate )
				$args['class'][] = 'validate-' . $validate;

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .' " id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

		$field .= '<input type="text" class="'.$fees_class.' '. $datepicker_class .' input-text  '. dcfppinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" />
			</p>' . $after;

		return $field;
	 }



	public function datetimepicker_form_field( $field, $key, $args, $value) {
		$key = isset($args['field_key']) ? $args['field_key'] : $key;

	    if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		} else {
			$required = '';
		}
		
		 
		
		if (isset($args['disable_past'])) {
			$datepicker_class='dcfpp-datetimepicker-disable-past';
		} else {
			$datepicker_class='dcfpp-datetimepicker';
		}

		if ($value == "empty") {
			$value = "";
		}


		$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( ! empty( $args['validate'] ) )
			foreach( $args['validate'] as $validate )
				$args['class'][] = 'validate-' . $validate;

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .' " id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

		$field .= '<input type="text" class="'.$fees_class.' '. $datepicker_class .' input-text  '. dcfppinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" />
			</p>' . $after;

		return $field;
	 }


	public function daterangepicker_form_field(  $field, $key, $args, $value ) {

		$key = isset($args['field_key']) ? $args['field_key'] : $key;

	    if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		if ($value == "empty") {
			$value = "";
		}
		
		 
		
		if (isset($args['disable_past'])) {
			$datepicker_class='dcfpp-daterangepicker-disable-past';
		} else {
			$datepicker_class='dcfpp-daterangepicker';
		}


		$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( ! empty( $args['validate'] ) )
			foreach( $args['validate'] as $validate )
				$args['class'][] = 'validate-' . $validate;

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .' " id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

		$field .= '<input type="text" class="'.$fees_class.' '. $datepicker_class .' input-text  '. dcfppinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" />
			</p>' . $after;

		return $field;
	}



	public function datetimerangepicker_form_field(  $field, $key, $args, $value ) {

		$key = isset($args['field_key']) ? $args['field_key'] : $key;

	    if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		if ($value == "empty") {
			$value = "";
		}
		
		

		$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);
		
		if (isset($args['disable_past'])) {
			$datepicker_class='dcfpp-datetimerangepicker-disable-past';
		} else {
			$datepicker_class='dcfpp-datetimerangepicker';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( ! empty( $args['validate'] ) )
			foreach( $args['validate'] as $validate )
				$args['class'][] = 'validate-' . $validate;

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .' " id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

		$field .= '<input type="text" class="'.$fees_class.' '. $datepicker_class .' input-text  '. dcfppinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" />
			</p>' . $after;

		return $field;
	}


	public function timepicker_form_field(  $field,$key, $args, $value) {
		$key = isset($args['field_key']) ? $args['field_key'] : $key;
		
	    if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'custom-dokan-fields'  ) . '">*</abbr>';
		} else {
			$required = '';
		}


		if ($value == "empty") {
			$value = "";
		}
		
		 

		$fees_class       = '';

		$fees_class       = dcfpp_get_fees_class($key);
		
		
		$datepicker_class='dcfpp-timepicker';
		

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( ! empty( $args['validate'] ) )
			foreach( $args['validate'] as $validate )
				$args['class'][] = 'validate-' . $validate;

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .' " id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

		$field .= '<input type="text" class="'. $fees_class.' '. $datepicker_class .' input-text  '. dcfppinput_conditional_class($key) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . $args['placeholder'] . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" />
			</p>' . $after;

		return $field;
	}
}

new dcfpp_manage_extrafield_class();
?>