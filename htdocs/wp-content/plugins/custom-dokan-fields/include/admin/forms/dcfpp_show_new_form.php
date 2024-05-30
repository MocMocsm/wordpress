<?php 
global $wp_roles;

if ( ! isset( $wp_roles ) ) { 
	$wp_roles = new WP_Roles();  
}

$roles = $wp_roles->roles;

$shipping_methods = WC()->shipping->get_shipping_methods();

$payment_gateways = WC()->payment_gateways->get_available_payment_gateways();



?>
<div class="panel-group panel panel-default checkoutfield dcfpp_list_item" style="display:none;">
	<div class="panel-heading">

		<table class="heading-table">
			<tr>
				<td width="40%">
					<span class="glyphicon glyphicon-trash dcfpp_trash_icon"></span>
					<a class="accordion-toggle dcfpp_edit_icon_a" data-toggle="collapse" data-parent="#accordion" href="">
						<span class="glyphicon glyphicon-edit dcfpp_edit_icon"></span>
					</a>
				</td>

				<td width="30%">
					<label  class="new-field-label"></label>
					
				</td>
				<td width="30%">
					
				</td>
				
				
			</tr>
		</table>

	</div>
	<div id="" class="panel-collapse collapse">
		<table class="table"> 
			
			
			
			<tr>
				<td width="25%"><label><?php echo esc_html__('Field Type','custom-dokan-fields'); ?></label></td>
				<td width="75%">
					<select class="checkout_field_type_new" name="" >
						<option value="text"  ><?php echo esc_html__('Text','custom-dokan-fields'); ?></option>
						<option value="heading"  ><?php echo esc_html__('Heading','custom-dokan-fields'); ?></option>
						<option value="paragraph"  ><?php echo esc_html__('Paragraph','custom-dokan-fields'); ?></option>
						<option value="email"  ><?php echo esc_html__('Email','custom-dokan-fields'); ?></option>
						<option value="number"  ><?php echo esc_html__('Number','custom-dokan-fields'); ?></option>
						<option value="password" ><?php echo esc_html__('Password','custom-dokan-fields'); ?></option>
						<option value="textarea" ><?php echo esc_html__('Textarea','custom-dokan-fields'); ?></option>
						<option value="checkbox" ><?php echo esc_html__('Checkbox','custom-dokan-fields'); ?></option>
						<option value="dcfppselect" ><?php echo esc_html__('Select','custom-dokan-fields'); ?></option>
						<option value="multiselect"><?php echo esc_html__('Multi Select','custom-dokan-fields'); ?></option>
						<option value="radio" ><?php echo esc_html__('Radio Select','custom-dokan-fields'); ?></option>
						<option value="datepicker" ><?php echo esc_html__('Date Picker','custom-dokan-fields'); ?></option>
						<option value="datetimepicker" ><?php echo esc_html__('Date Time Picker','custom-dokan-fields'); ?></option>
						<option value="timepicker" ><?php echo esc_html__('Time Picker','custom-dokan-fields'); ?></option>
						<option value="daterangepicker" ><?php echo esc_html__('Date Range Picker','custom-dokan-fields'); ?></option>
						<option value="datetimerangepicker" ><?php echo esc_html__('Date Time Range Picker','custom-dokan-fields'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="25%"><label><?php  echo esc_html__('Label','custom-dokan-fields'); ?></label></td>
				<td width="75%"><input type="text" class="checkout_field_label" name="" value="" size="100"></td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
				<td width="25%"><label><?php  echo esc_html__('Placeholder ','custom-dokan-fields'); ?></label></td>
				<td width="75%"><input type="text" class="checkout_field_placeholder" name="" value="" size="35"></td>
			</tr>
			
			
			<tr class="add-field-extraclass" style="">
				<td width="25%">
					<label><?php echo esc_html__('Extra Class','custom-dokan-fields'); ?></label>
				</td>
				<td width="75%">
					<input type="text" class="dcfpp_checkout_field_extraclass_new" name="" value="" size="35">
					<?php echo esc_html__('Use space key or comma to separate class','custom-dokan-fields'); ?>
				</td>
			</tr>
			
			<tr class="add-field-options" style="">
				<td width="25%">
					<label><?php echo esc_html__('Options','custom-dokan-fields'); ?></label>
				</td>
				<td width="75%">
					<input type="text" class="dcfpp_checkout_field_option_values_new" name="" value="" size="35">
					<ul>
						<li>
							<?php echo esc_html__('Use pipe key or comma to separate option.If you are using it for field specific conditional visibility replace space with underscore ( _ ) . For Example value for "Option 2" will be Option_2','custom-dokan-fields','custom-dokan-fields'); ?>
						</li>
					</ul>
				</td>
			</tr>
			
			
			
			<tr>
				<td width="25%"><label><?php  echo esc_html__('Visibility','custom-dokan-fields'); ?></label></td>
				<td width="75%">
					<select class="checkout_field_visibility_new" name="" >
						<option value="always-visible"><?php echo esc_html__('Always Visibile','custom-dokan-fields'); ?></option>
						
						<option value="field-specific"><?php echo esc_html__('Conditional - Field Specific','custom-dokan-fields'); ?></option>
						<option value="role-specific"><?php echo esc_html__('Conditional - Role Specific','custom-dokan-fields'); ?></option>
						
					
				</select>
			</td>
		</tr>
		
		
		<tr class="checkout_field_role_tr" style="display:none;" >
			<td width="25%">
				<label><?php echo esc_html__('Select Roles','custom-dokan-fields'); ?></label>
			</td>
			<td width="75%">
				<select class="checkout_field_role_new" data-placeholder="<?php echo esc_html__('Choose Roles','custom-dokan-fields'); ?>" name=""  multiple style="width:600px">
					<?php foreach ($roles as $key => $role) { ?>
						<option value="<?php echo esc_attr($key); ?>"><?php echo esc_attr($role['name']); ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>

		

		
		<tr class="checkout_field_conditional_tr" style="display:none;" >
			<td width="25%">
				<label for="notice_category"><?php echo esc_html__('Set Rule','custom-dokan-fields'); ?></label>
			</td>
			<td width="75%">
				
				<div class="conditional_fields_div_wrapper">
					
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
				<input type="button" keyno="" mnindex="1" class="btn button-primary add-condition-button" value="<?php echo esc_html__('Add Condition','custom-dokan-fields'); ?>">
				
			</td>
		</tr>
		
		<tr style="display:none;" class="disable_datepicker_tr">
			<td width="25%"><label for="<?php echo esc_attr($key); ?>_clear"><?php  echo esc_html__('Chose Options','custom-dokan-fields'); ?></label></td>
			<td  width="75%">
				<table>
					
					
					<tr  >
						<td><input class="checkout_field_disable_past_dates" type="checkbox" name=""  value="1"></td>
						<td><label ><?php  echo esc_html__('Disable Past Date Selection In Datepicker','custom-dokan-fields'); ?></label></td>
					</tr>
					
					
					
				</table>
			</td>
		</tr>
		
		
	</table>
</div>
</div>