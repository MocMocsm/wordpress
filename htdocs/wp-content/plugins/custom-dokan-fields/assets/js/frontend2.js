var $iaz = jQuery.noConflict();
(function( $iaz ) {
    'use strict';

    $iaz.datetimepicker.setLocale(dcfppfrontend.datetimepicker_lang);


	var datepicker_format = dcfppfrontend.datepicker_format;

    switch(datepicker_format) {
          case "01":
            var dtformat = 'd/m/Y';
          break;
          case "02":
            var dtformat = 'd-m-Y';
          break;
          case "03":
            var dtformat = 'd F Y';
          break;
          case "04":
            var dtformat = 'm/d/Y';
          break;
          case "05":
            var dtformat = 'm-d-Y';
          break;

          case "06":
            var dtformat = 'F d Y';
          break;


          default:
           var dtformat = 'd/m/Y';
    }

    var gdays ='';
    
    if ((dcfppfrontend.days_to_exclude) && (dcfppfrontend.days_to_exclude != '')) {

    	gdays = dcfppfrontend.days_to_exclude.split(',');
    	
    }

    gdays = '['+ gdays +']';
    

	$iaz(function() {


		if (jQuery('.dcfpp-datepicker').length) {
			jQuery('.dcfpp-datepicker').datetimepicker({
				format:dtformat,
				timepicker:false,
				disabledWeekDays: gdays,
				dayOfWeekStart: dcfppfrontend.dt_week_starts_on
			});
		}

	    var dateToday = new Date(); 
	    if (jQuery('.dcfpp-datepicker-disable-past').length) {
	   	    jQuery('.dcfpp-datepicker-disable-past').datetimepicker({
	   		    format:dtformat,
	            minDate: dateToday,
	   		    timepicker:false,
	   		    disabledWeekDays: gdays,
				dayOfWeekStart: dcfppfrontend.dt_week_starts_on
	   	    });
	    }



	   if (jQuery('.dcfpp-daterangepicker').length) {
		  jQuery('.dcfpp-daterangepicker').dateRangePicker({
            format: 'DD/MM/YYYY',
            language: dcfppfrontend.datetimepicker_lang,
            startOfWeek:dcfppfrontend.week_starts_on
            
          });
	   }

	   var dateToday = new Date(); 
	   if (jQuery('.dcfpp-daterangepicker-disable-past').length) {
		  jQuery('.dcfpp-daterangepicker-disable-past').dateRangePicker({
            format: 'DD/MM/YYYY',
		    startDate: dateToday,
		    language: dcfppfrontend.datetimepicker_lang,
		    startOfWeek:dcfppfrontend.week_starts_on
		    
          });
	   }



	    if (jQuery('.dcfpp-datetimerangepicker').length) {
		  jQuery('.dcfpp-datetimerangepicker').dateRangePicker({
                separator : ' - ',
                format: 'DD/MM/YYYY HH:mm',
                language: dcfppfrontend.datetimepicker_lang,
                startOfWeek:dcfppfrontend.week_starts_on,
                time: {
		          enabled: true
	            }
            
          });
	    }

	    var dateToday = new Date(); 
	    if (jQuery('.dcfpp-datetimerangepicker-disable-past').length) {

		    jQuery('.dcfpp-datetimerangepicker-disable-past').dateRangePicker({
                separator : ' - ',
                format: 'DD/MM/YYYY HH:mm',
		        startDate: dateToday,
		        language: dcfppfrontend.datetimepicker_lang,
		        startOfWeek:dcfppfrontend.week_starts_on,
		        time: {
		         enabled: true
	            }
		    
            });
	    }
              
	   
    });


	$iaz(function() {
		if (jQuery('.dcfpp-datetimepicker').length) {
			jQuery('.dcfpp-datetimepicker').datetimepicker({
				format:''+ dtformat + ' H:i',
				dayOfWeekStart: dcfppfrontend.dt_week_starts_on
			});
		}

		var dateToday = new Date(); 
		if (jQuery('.dcfpp-datetimepicker-disable-past').length) {
			jQuery('.dcfpp-datetimepicker-disable-past').datetimepicker({
				minDate: dateToday,
				format:''+ dtformat + ' H:i',
				dayOfWeekStart: dcfppfrontend.dt_week_starts_on
			});
		}

	});


	$iaz(function() {
		if (jQuery('.dcfpp-timepicker').length) {

			jQuery('.dcfpp-timepicker').datetimepicker({
				format:'H:i',
				datepicker:false,
				dayOfWeekStart: dcfppfrontend.dt_week_starts_on,
				step:dcfppfrontend.timepicker_interval,
				allowTimes: function getArr() {

					if ((dcfppfrontend.allowed_times) && (dcfppfrontend.allowed_times != '')) {

						var gTimes = dcfppfrontend.allowed_times.split(',');
						return gTimes;


					}

				}()

			});


		}
	   
	});


	
   	
	$iaz(function() {

		if ($iaz('.dcfpp-multiselect').length) {
			$iaz('.dcfpp-multiselect').select2({});
		}

		if ($iaz('.dcfpp-singleselect').length) {
			$iaz('.dcfpp-singleselect').select2({});
		}

		if ($iaz('.parent_hidden').length) {
			$iaz('.parent_hidden').hide();
		}

    });
	
	
	$iaz(function() {
       $iaz('.dcfpp-opener').on('change',function(){
		 var this_obj=$iaz(this);
		 var id= this_obj.attr('id');
         var name= this_obj.attr('name');
         var uval = this_obj.val();
		 

		 if (this_obj.hasClass('dcfpp-singleselect')){
			
			
			$iaz('.open_by_'+ id +'_'+ uval).closest('.form-row').show();
			$iaz('.open_by_'+ id +'_'+ uval).closest('.form-row').val('');

                        //hide other   
            $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
            $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');
			
		 } else if (this_obj.hasClass('dcfpp-multiselect')){
			
			
			$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
			$iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').val('');
                        //hide other   
            $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
            $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');
			
			
		 } else if (this_obj.attr('type')=='checkbox') {
			
			if (this_obj.is(':checked')) {
				$iaz('.open_by_'+id ).closest('.form-row').show();
				$iaz('.open_by_'+ id +' input' ).val('');
			} else {
				$iaz('.open_by_'+id ).closest('.form-row').hide();
                $iaz('.open_by_'+ id +' input' ).val('empty');
			}
			
		 } else if ( this_obj.attr('type')=='radio'){
                
                $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
                $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').val('');
                        //hide other   
                $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();	
                $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');			
                       
      } else if ( this_obj.attr('type')=='text'){
			          $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
			          $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').val('');
                        //hide other   
                $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
                $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');
		  
		  } else if ( this_obj.attr('type')=='tel'){
			     
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').val('');
                        //hide other   
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');
		  } else if ( this_obj.attr('type')=='number'){
			     
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').val('');
                        //hide other   
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');
		  } else if ( this_obj.attr('type')=='password'){
			     
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').val('');
                        //hide other   
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');
		  } else if (this_obj.is("textarea")){
			     
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').show();
			     $iaz('.open_by_'+ id +'_'+uval ).closest('.form-row').val('');
                        //hide other   
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').hide();
                 $iaz("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+uval).closest('.form-row').val('empty');
		  }
	    
		
      });
	  
	  $iaz('.dcfpp-opener').trigger('change');

    $iaz('.dcfpp-price-changer').trigger('change');

    $iaz('.dcfpp-price-changer').on('change',function(){

            
      	jQuery('body').trigger('update_checkout');


    });


    $iaz('.dcfpp-action-changer').trigger('change');

    $iaz('.dcfpp-action-changer').on('change',function(){

    	  var thiskey = $iaz(this).attr('id');

    	  var thisval = $iaz(this).val();

    	 

    	  var payment_methods = $iaz('ul.payment_methods li');
        payment_methods.show();

    	  var shipping_methods = $iaz('.woocommerce-shipping-methods li');
    	  shipping_methods.show();

        $iaz.ajax({
            type : "POST",
            dataType : "json",
            url : wc_checkout_params.ajax_url,
            data : { action: "dcfpp_get_action_data" ,
                     key : thiskey,
                     thisval : thisval
                   },
            success: function(response) {
                var data = response.data;
                if (data) {

                	$iaz.each(data,function( index, value ) {

                      if (value['target'].includes("shipping_method")) {

                      	



                      	if (value['action'] == "hide") {

                      		  var somevalue = value['target'].substring(16);

                      		  $iaz(".shipping_method").each(function () {

                      		  	  var eachvalue = $iaz(this).val();

                      		  	  if (eachvalue.includes(somevalue)) {
                      		  	  	  $iaz(this).parents('li').hide();
                      		  	  	  $iaz(this).prop('checked', false);
                      		  	  } 

                      		  });
                		  	  
                		    } else if (value['action'] == "show") {

                		    	var somevalue = value['target'].substring(16);

                      		  $iaz(".shipping_method").each(function () {

                      		  	  var eachvalue = $iaz(this).val();

                      		  	  if (eachvalue.includes(somevalue)) {
                      		  	  	  $iaz(this).parents('li').show();
                      		  	  } 

                      		  });
                		  	   
                		    }

                      	  
                      } else {

                      	if (value['action'] == "hide") {
                		  	  $iaz("."+value['target']+"").hide();
                		  	  $iaz("."+value['target']+"").prop('checked', false);
                		    } else {
                		  	  $iaz("."+value['target']+"").show();
                		    }

                      }
                		  
                	});
                }
                
            }
        }); 


    });





    $iaz(window).load(function() {
      	if ($iaz('.shipping_method').length > 0) {


      		$iaz.each($iaz('.shipping_method'),function(){
      			var xvalue = $iaz(this).val();

      			xvalue = xvalue.slice(0,-2);





      			if ($iaz(this).is(":checked")) {





      				$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').show();
      				$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').val('');
      				$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').hide();
      				$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').val('empty');

      			} else {



      				$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').hide();
      				$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').val('empty');
      				$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').show();
      				$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').val('');
      			}

      		});
      	}
    });

    $iaz(window).load(function() {
      	if ($iaz('input[name="payment_method"]').length > 0) {


      		$iaz.each($iaz('input[name="payment_method"]'),function(){
      			var xvalue = $iaz(this).val();
                

    

      			if ($iaz(this).is(":checked")) {


                    


      				$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').show();
      				$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('');
      				$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').hide();
      				$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('empty');

      			} else {



      				$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').hide();
      				$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('empty');
      				$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').show();
      				$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('');
      			}

      		});
      	}
    });


        


    $iaz(document).ready(function(){
    	$iaz(document).on("click", ".shipping_method" ,function(e) {   
    		var xvalue = $iaz(this).val();

    		xvalue = xvalue.slice(0,-2);

                

    		if ($iaz(this).is(":checked")) {

    			$iaz('.hide_on_load').hide();

    			$iaz('.show_on_load').show();

    			$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').show();
    			$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').val('');
    			$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').hide();
    			$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').val('empty');
    		} else {

    			$iaz('.hide_on_load').hide();

    			$iaz('.show_on_load').show();

    			$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').hide();
    			$iaz("[class^='show_by_shipping_method_"+ xvalue +"'],[class*='show_by_shipping_method_"+ xvalue +"']").not('.hide_by_shipping_method_'+ xvalue +'').closest('.form-row').val('empty');
    			$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').show();
    			$iaz("[class^='hide_by_shipping_method_"+ xvalue +"'],[class*='hide_by_shipping_method_"+ xvalue +"']").not('.show_by_shipping_method_'+ xvalue +'').closest('.form-row').val('');
    		}
    	}); 


    });


    $iaz(document).ready(function(){
    	$iaz(document).on("change", 'input[name="payment_method"]' ,function(e) {   
    		var xvalue = $iaz(this).val();

    		

            

    		if ($iaz(this).is(":checked")) {

    			$iaz('.hide_on_load2').hide();

    			$iaz('.show_on_load2').show();

    			$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').show();
    			$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('');
    			$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').hide();
    			$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('empty');
    		} else {

    			$iaz('.hide_on_load2').hide();

    			$iaz('.show_on_load2').show();

    			$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').hide();
    			$iaz("[class^='show_by_payment_gateway_"+ xvalue +"'],[class*='show_by_payment_gateway_"+ xvalue +"']").not('.hide_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('empty');
    			$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').show();
    			$iaz("[class^='hide_by_payment_gateway_"+ xvalue +"'],[class*='hide_by_payment_gateway_"+ xvalue +"']").not('.show_by_payment_gateway_'+ xvalue +'').closest('.form-row').val('');
    		}
    	}); 


    });


    $iaz('.hide_on_load').hide();

    $iaz('.show_on_load').show();  

    $iaz('.hide_on_load2').hide();

    $iaz('.show_on_load2').show();  
	  
	  
	  $iaz('.dcfpp-hider').on('change',function(){
		   var this_obj=$iaz(this);
           var id= this_obj.attr('id');
           var name= this_obj.attr('name');
           var hval = this_obj.val();
		   
		   if (this_obj.hasClass('dcfpp-singleselect')){
                        
                        $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                        $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                        $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
                        $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');
                         
            } else if (this_obj.hasClass('dcfpp-multiselect')){
                        
                        $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                        $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                        $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
                        $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');
                         
            } else if (this_obj.attr('type')=='checkbox') {
			
			  if (this_obj.is(':checked')) {
				
				$iaz('.hide_by_'+id ).closest('.form-row').hide();
				$iaz('.hide_by_'+id ).closest('.form-row').val('empty');
			  } else {
				    
				$iaz('.hide_by_'+id ).closest('.form-row').show();
				$iaz('.hide_by_'+id ).closest('.form-row').val('');
			  }
		    
			} else if ( this_obj.attr('type')=='radio'){


                         
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();  
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');     
            
      } else if ( this_obj.attr('type')=='text'){
                         
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show(); 
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');
            
			} else if ( this_obj.attr('type')=='tel'){
                         
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');       
            }  else if ( this_obj.attr('type')=='number'){
                         
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');        
            }  else if ( this_obj.attr('type')=='password'){
                         
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');     
            }   else if (this_obj.is("textarea")) {
                         
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').hide();
                $iaz('.hide_by_'+ id +'_'+hval ).closest('.form-row').val('empty');
                        //hide other   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').show();   
                $iaz("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+hval).closest('.form-row').val('');    
            }
	  });
	  
	   $iaz('.dcfpp-hider').trigger('change');
	});
})(jQuery);