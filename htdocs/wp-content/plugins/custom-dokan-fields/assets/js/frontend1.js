var $vaz = jQuery.noConflict();
(function( $vaz ) {
    'use strict';

	$vaz(function() {

        if ($vaz('.dcfpp-datepicker').length) {

		    $vaz('.dcfpp-datepicker').datepicker({
                dateFormat : 'dd-mm-yy'
            });
	    }
	              
	    var dateToday = new Date(); 
	             
		if ($vaz('.dcfpp-datepicker-disable-past').length) {
		    $vaz('.dcfpp-datepicker-disable-past').datepicker({
                dateFormat : 'dd-mm-yy',
		        minDate: dateToday
            });
	    }
	   
    });
   	
    $vaz(function() {
	 
	    if ($vaz('.dcfpp-multiselect').length) {
		    $vaz('.dcfpp-multiselect').select2();
	    }
	 
	    if ($vaz('.dcfpp-singleselect').length) {
		    $vaz('.dcfpp-singleselect').select2();
	    }
      
    });
	
	
	$vaz('.dcfpp-opener').change(function(e){ 
                    
        var this_obj=$vaz(this);
        var id= this_obj.attr('id');
        var name= this_obj.attr('name');
                      
        if (this_obj.attr('type')=='checkbox' ) { 
                          
            if (this_obj.is(':checked'))                
                $vaz('.open_by_'+id ).parentsUntil('tbody').hide();  
            else
                $vaz('.open_by_'+id ).parentsUntil('tbody').show();
   
        }else if ( this_obj.attr('type')=='radio'){
                         
            $vaz('.open_by_'+ $vaz('input[name="'+name+'"]:checked').attr('id') ).parentsUntil('tbody').hide();
                        //hide other   
            $vaz('.open_by_'+ $vaz('input[name="'+name+'"]:not(:checked)').attr('id') ) .parentsUntil('tbody').show();
        
        } else if (this_obj.hasClass('selectbox')){
                        
            $vaz('.open_by_'+ id+'_'+this_obj.val() ).parentsUntil('tbody').hide();
                        //hide other   
            $vaz("[class^='open_by_"+ id+"_'],[class*=' open_by_"+ id+"_']").not('.open_by_'+ id +'_'+this_obj.val()).parentsUntil('tbody').show();
                         
        }    
                            
    });
                
                 
                
    $vaz('.dcfpp-opener').trigger('change');
				
	$vaz('.dcfpp-hider').change(function(e){ 
                    
        var this_obj=$vaz(this);
        var id= this_obj.attr('id');
        var name= this_obj.attr('name');
                      
        if (this_obj.attr('type')=='checkbox' ) { 
                          
            if (this_obj.is(':checked'))                
                $vaz('.hide_by_'+id ).parentsUntil('tbody').show();  
            else
                $vaz('.hide_by_'+id ).parentsUntil('tbody').hide();
   
        } else if ( this_obj.attr('type')=='radio'){
                         
            $vaz('.hide_by_'+ $vaz('input[name="'+name+'"]:checked').attr('id') ).parentsUntil('tbody').show();
            //hide other   
            $vaz('.hide_by_'+ $vaz('input[name="'+name+'"]:not(:checked)').attr('id') ) .parentsUntil('tbody').hide();
        
        } else if (this_obj.hasClass('selectbox')){
                        
            $vaz('.hide_by_'+ id+'_'+this_obj.val() ).parentsUntil('tbody').show();
            //hide other   
            $vaz("[class^='hide_by_"+ id+"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).parentsUntil('tbody').hide();
                         
        }    
                            
    });
                
                 
                
    $vaz('.dcfpp-hider').trigger('change');
})(jQuery);