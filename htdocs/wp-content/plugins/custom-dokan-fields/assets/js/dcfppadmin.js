jQuery(document).ready(function($) {
 'use strict';
var dcfppcheckoutfield = $(".checkoutfield");

$("#add-billing-field").on("click", function () {
   var dcfppnewPanel = dcfppcheckoutfield.clone();
    hash++;
    dcfppnewPanel.find(".collapse").removeClass("in");
    dcfppnewPanel.find(".accordion-toggle").attr("href", "#dcfpp" + (hash));
    dcfppnewPanel.find(".new-field-label").append(dcfppadmin.checkoutfieldtext4 + hash);
		
	dcfppnewPanel.find(".checkoutfield").attr("id", "dcfpp_list_items_" + (hash));
	dcfppnewPanel.find(".panel-collapse").attr("id", "dcfpp" + (hash));
	 
         var randomnumber=Math.floor(Math.random()*1000);


    
	dcfppnewPanel.find(".checkout_field_type_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][type]");
	dcfppnewPanel.find(".checkout_field_label").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][label]");
	dcfppnewPanel.find(".checkout_field_label").attr("value", "" + dcfppadmin.checkoutfieldtext4 + hash + "");     
	dcfppnewPanel.find(".checkout_field_width_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][width]");
	dcfppnewPanel.find(".checkout_field_required").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][required]");
	
	dcfppnewPanel.find(".checkout_field_clear").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][clear]");
	dcfppnewPanel.find(".checkout_field_placeholder").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][placeholder]");
	dcfppnewPanel.find(".dcfpp_checkout_field_extraclass_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][extraclass]");
	dcfppnewPanel.find(".dcfpp_checkout_field_option_values_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][options]");
	dcfppnewPanel.find(".checkout_field_visibility_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][visibility]");
	dcfppnewPanel.find(".checkout_field_products_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][products][]");
	
    dcfppnewPanel.find(".checkout_field_total_quantity_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][total-quantity]");
    dcfppnewPanel.find(".checkout_field_quantity_specific_product_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][specific-product]");
    dcfppnewPanel.find(".checkout_field_cart_quantity_specific_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][specific-quantity]");

	dcfppnewPanel.find(".add-condition-button").attr("keyno", "" + dcfppadmin.checkoutfieldtext + randomnumber+ "");
	dcfppnewPanel.find(".conditional_fields_div_wrapper").addClass("conditional_fields_div_wrapper_" + dcfppadmin.checkoutfieldtext + randomnumber+ "");
	dcfppnewPanel.find(".checkout_field_category_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][category][]");
	dcfppnewPanel.find(".checkout_field_role_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][role][]");
	
	dcfppnewPanel.find(".checkout_field_shipping_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][shipping][method]");
    dcfppnewPanel.find(".checkout_field_shipping_showhide_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][shipping][showhide]");

    dcfppnewPanel.find(".checkout_field_payment_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][payment][gateway]");
    dcfppnewPanel.find(".checkout_field_payment_showhide_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][payment][showhide]");

    dcfppnewPanel.find(".checkout_field_validate_new").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber+ "][validate][]");
	dcfppnewPanel.find(".checkout_field_orderedition").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][orderedition]");
	dcfppnewPanel.find(".checkout_field_emailfields").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][emailfields]");
	dcfppnewPanel.find(".checkout_field_pdfinvoice").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][pdfinvoice]");
	dcfppnewPanel.find(".checkout_field_disable_past_dates").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][disable_past]");
	dcfppnewPanel.find(".checkout_field_editaddress").attr("name", "dcfpp_billing_settings[" + dcfppadmin.checkoutfieldtext + randomnumber + "][editaddress]");

	dcfppnewPanel.find(".checkout_field_width_new").select2({width: "250px",minimumResultsForSearch: -1});
	dcfppnewPanel.find(".checkout_field_visibility_new").select2({width: "450px",minimumResultsForSearch: -1});
	dcfppnewPanel.find(".checkout_field_conditional_showhide_new").select2({width: "70px",minimumResultsForSearch: -1});
	dcfppnewPanel.find(".checkout_field_conditional_parentfield_new").select2({width: "170px"});
	dcfppnewPanel.find(".checkout_field_type_new").select2({width: "250px",minimumResultsForSearch: -1});
	dcfppnewPanel.find(".checkout_field_validate_new").select2({width: "250px"});
	
    dcfppnewPanel.find(".checkout_field_category_new").select2({width: "400px" }); 
    dcfppnewPanel.find(".checkout_field_role_new").select2({width: "400px" });
    dcfppnewPanel.find(".checkout_field_shipping_new").select2({
    	width: "400px",
    	minimumResultsForSearch: -1

    });
    dcfppnewPanel.find(".checkout_field_payment_new").select2({
    	width: "400px",
    	minimumResultsForSearch: -1

    });

	
	dcfppnewPanel.find(".checkout_field_products_new,.checkout_field_quantity_specific_product_new").select2({
  		   ajax: {
    			url: ajaxurl, // AJAX URL is predefined in WordPress admin
    			dataType: 'json',
    			delay: 250, // delay in ms while typing when to perform a AJAX search
    			data: function (params) {
      				return {
        				q: params.term, // search query
        				action: 'pdfmegetajaxproductslist' // AJAX action for admin-ajax.php
      				};
    			},
    			processResults: function( data ) {
				var options = [];
				if ( data ) {
 
					// data is the array of arrays, and each of them contains ID and the Label of the option
					$.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
						options.push( { id: text[0], text: text[1]  } );
					});
 
				}
				return {
					results: options
				};
			},
			cache: true
		   },
		     minimumInputLength: 3 ,
			 width: "400px"// the minimum of symbols to input before perform a search
	}); 
	

	
	dcfppnewPanel.find('.dcfpp_checkout_field_option_values_new').tagEditor({
     delimiter: ',|', /* pipe and comma */
	 forceLowercase: false,
     placeholder: dcfppadmin.optionplaceholder,
     maxLength:200
    });
	
	dcfppnewPanel.find('.dcfpp_checkout_field_extraclass_new').tagEditor({
      delimiter: ', ', /* space and comma */
      placeholder: dcfppadmin.classplaceholder
    });


    var mgindex               = 1;


    dcfppnewPanel.find('.add-condition-button').on('click',function(){

    	


    	var fieldkey               = "" + dcfppadmin.checkoutfieldtext + randomnumber + "";

    	var conditionalhtml        = '';

    	var mntype                 = "custom";

    	var selecthtml             = dcfppadmin.billing_select;
  

        var showtext               = dcfppadmin.showtext;
        var hidetext               = dcfppadmin.hidetext;
        var valuetext              = dcfppadmin.valuetext
        var equaltext              = dcfppadmin.equaltext;

        var select1                = '<select class="checkout_field_conditional_showhide" name="dcfpp_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][showhide]"><option value="open" selected="">'+showtext+'</option><option value="hide">'+hidetext+'</option></select>';
        var span1                  = '<span class="dcfppformfield"><strong>&emsp;'+valuetext+'&emsp;&nbsp;&nbsp;</strong></span>';
        var span2                  = '<span class="dcfppformfield"><strong>&emsp;'+equaltext+'&emsp;</strong></span>';

        var input1                 = '&nbsp;&nbsp;<input type="text" class="checkout_field_conditional_equalto" name="dcfpp_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][equalto]" value="">';
        
        var deletei                = '&emsp;<span class="glyphicon glyphicon-trash dcfpp-remove-condition"></span>';
        
        conditionalhtml           += '<div class="conditional-row">'+select1+''+span1+''+selecthtml+''+span2+''+input1+''+deletei+'</div>';

				 
				 
				 
 

    	$(this).parents('.checkout_field_conditional_tr').find('.conditional_fields_div_wrapper').append(conditionalhtml);

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_showhide').select2({
    		width: "100px",
    		minimumResultsForSearch: -1
    	});

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').attr('name','dcfpp_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][parentfield]');

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').select2({width: "250px" });
        
        
        mgindex++;


        $('.dcfpp-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

        });

    	dcfppnewPanel.find('.conditional_fields_div_wrapper').append(html);

    
    });


    dcfppnewPanel.find('.checkout_field_visibility_new').on('change',function(){
         visibilityvalue2 = $(this).val();
	    if (visibilityvalue2 == "field-specific") {
		    $(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_role_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_total_quantity_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_cart_quantity_specific_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').show();
		    $(this).parents('table:eq(0)').find('.checkout_field_shipping_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_payment_tr').hide();
	
	    } else if (visibilityvalue2 == "role-specific") {
		    $(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_total_quantity_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_cart_quantity_specific_tr').hide();
	        $(this).parents('table:eq(0)').find('.checkout_field_role_tr').show();
	        $(this).parents('table:eq(0)').find('.checkout_field_shipping_tr').hide();
	        $(this).parents('table:eq(0)').find('.checkout_field_payment_tr').hide();
	    
	    } else  {
		    $(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_role_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_total_quantity_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_cart_quantity_specific_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_shipping_tr').hide();
		    $(this).parents('table:eq(0)').find('.checkout_field_payment_tr').hide();
	    }
    });




	
	
    $("#accordion").append(dcfppnewPanel.fadeIn());


    $('.checkout_field_type_new').on('change',function(){
    	var typevalue2 = $(this).val();
    	if ((typevalue2 == "datepicker") || (typevalue2 == "datetimepicker") || (typevalue2 == "daterangepicker") || (typevalue2 == "datetimerangepicker")) {
    		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').show();
    	} else {
    		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').hide();
    	}
    });


});







$("div.dcfpp-sortable-list").sortable({
    opacity : 0.7

});

$(function() {
$('.checkout_field_type').on('change',function(){
    var typevalue1 = $(this).val();
	if ((typevalue1 == "datepicker") || (typevalue1 == "datetimepicker") || (typevalue1 == "daterangepicker") || (typevalue1 == "datetimerangepicker")) {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').show();
	} else {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').hide();
	}
});



$('.checkout_field_visibility').on('change',function(){
    var visibilityvalue2 = $(this).val();
	 
	 if (visibilityvalue2 == "field-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_role_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_total_quantity_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_cart_quantity_specific_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').show();
		$(this).parents('table:eq(0)').find('.checkout_field_shipping_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_payment_tr').hide();
	
	} else if (visibilityvalue2 == "role-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_total_quantity_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_cart_quantity_specific_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_role_tr').show();
		$(this).parents('table:eq(0)').find('.checkout_field_shipping_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_payment_tr').hide();
	
	} else  {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_role_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_total_quantity_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_cart_quantity_specific_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_shipping_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_payment_tr').hide();
	}
});




$('.dcfpp_checkout_field_option_values').tagEditor({
    delimiter: ',|', /* pipe and comma */
	forceLowercase: false,
    placeholder: dcfppadmin.optionplaceholder,
    maxLength:200
});

$('.dcfpp_checkout_field_extraclass').tagEditor({
    delimiter: ', ', /* space and comma */
    placeholder: dcfppadmin.classplaceholder
});

});



$(document).on('click', '.dcfpp_trash_icon', function () {

   var result = confirm(dcfppadmin.removealert);
   if (result==true) {
     $(this).parents('.panel').get(0).remove();
   }
});













$('.dcfpp_change_key_input').keyup(function () {
	var clkey      = $(this).attr("clkey");
	var enteredval = $(this).val();

	$('.dcfpp_field_key_'+ clkey +'').text(enteredval);
	$('.dcfpp_copy_key_icon_'+ clkey +'').attr("cpkey",enteredval);
	
});


    

    $('.add-condition-button').on('click',function(event){
        
        event.preventDefault();

        event.mnindex       = $(this).attr("mnindex");

    	var fieldkey        = $(this).attr("keyno");

    	var html            = '';

    	event.mntype        = $(this).attr("mntype");

    	

    	if (event.mntype) {

    	    switch(event.mntype) {

                case "custom":
                    var selecthtml = dcfppadmin.billing_select;
                break;

               
            }
        }

        var showtext   = dcfppadmin.showtext;
        var hidetext   = dcfppadmin.hidetext;
        var valuetext  = dcfppadmin.valuetext
        var equaltext  = dcfppadmin.equaltext;

        var select1  = '<select class="checkout_field_conditional_showhide" name="dcfpp_'+event.mntype+'_settings['+fieldkey+'][conditional]['+event.mnindex+'][showhide]"><option value="open" selected="">'+showtext+'</option><option value="hide">'+hidetext+'</option></select>';
        var span1    = '<span class="dcfppformfield"><strong>&emsp;'+valuetext+'&emsp;&nbsp;&nbsp;</strong></span>';
        var span2    = '<span class="dcfppformfield"><strong>&emsp;'+equaltext+'&emsp;</strong></span>';

        var input1   = '&nbsp;&nbsp;<input type="text" class="checkout_field_conditional_equalto" name="dcfpp_'+event.mntype+'_settings['+fieldkey+'][conditional]['+event.mnindex+'][equalto]" value="">';
        
        var deletei  = '&emsp;&nbsp;<span class="glyphicon glyphicon-trash dcfpp-remove-condition"></span>';
        
        html        += '<div class="conditional-row">'+select1+''+span1+''+selecthtml+''+span2+''+input1+''+deletei+'</div>';

				 
				 
				 
 

    	$(this).parents('.checkout_field_conditional_tr').find('.conditional_fields_div_wrapper').append(html);

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_showhide').select2({
    		width: "100px",
    		minimumResultsForSearch: -1
    	});

    	

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield option[value='+fieldkey+']').remove();

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').attr('name','dcfpp_'+event.mntype+'_settings['+fieldkey+'][conditional]['+event.mnindex+'][parentfield]');

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').select2({width: "250px" });
        
        
        event.mnindex++;

        $(this).attr("mnindex",event.mnindex);


        $('.dcfpp-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

        });
    });



    $('.dcfpp-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

    });
    

   $('.thankyou_fields_location,.datepicker_disable_days,.datepicker_format').select2({ 
    	minimumResultsForSearch: -1,
    	width:"420px" 
   });

   $('.timepicker_interval,.week_starts_on_class,.dt_week_starts_on_class').select2({ 
    	minimumResultsForSearch: -1,
    	width:"250px" 
   });

   $('.datetimepicker_lang_class').select2({
    	width:"250px" 
   });
   

   $('.dcfpp_default_option_select').select2({
    	width:"250px" 
   });


   $('.checkout_field_rule_showhide').select2({
    	width:"100px" ,
    	minimumResultsForSearch: -1
   });

   $('.checkout_field_rule_parentfield').select2({
    	width:"200px" 
   });

   $('.dcfpp-remove-rule').on('click',function(){

   	var result = confirm(dcfppadmin.removealert);
   	if (result==true) {

   		$(this).parents('.conditional-row').remove();
   		fieldkey--;
   		$('.add-fees-button').attr("mnindex",fieldkey);

   	}  
   });


   $(".checkout_field_conditional_equalto").on('change', function() {
   	var value = $(this).val();
   	$(this).val(value.replace(/ /g, '_'));
   });

});  

function dcfpp_copyToClipboard(element) {
	var $temp = jQuery("<input>");
	jQuery("body").append($temp);
	var clipboard_text = jQuery(element).attr("cpkey");

	$temp.val(clipboard_text).select();
	document.execCommand("copy");
	$temp.remove();

	alert(dcfppadmin.copiedalert);
}