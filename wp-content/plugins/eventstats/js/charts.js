
var rawData;

jQuery(function() {
	
	/*********************************** DATE PICKER ********************************/
	  var curr = new Date; // get current date
      var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
      var last = first - 6; // last day is the first day + 6

      var t = curr.getDate()+1;
      
      var today = jQuery.datepicker.formatDate('yy-mm-dd', new Date(curr.setDate(t)));
      var lastweek = jQuery.datepicker.formatDate('yy-mm-dd', new Date(curr.setDate(last)));
      
	
	jQuery( "#mindatepicker" ).datepicker({
		dateFormat: 'yy-mm-dd', 
		defaultDate: "-1w",
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			jQuery( "#maxdatepicker" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	jQuery( "#maxdatepicker" ).datepicker({
		dateFormat: 'yy-mm-dd', 
	/*	defaultDate: "+1w",*/
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			jQuery( "#mindatepicker" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
    jQuery("#mindatepicker").val(lastweek);
    jQuery("#maxdatepicker").val(today);
    
    
    
    jQuery( "#mindatepicker2" ).datepicker({
		dateFormat: 'yy-mm-dd', 
		defaultDate: "-1w",
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			jQuery( "#maxdatepicker2" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	jQuery( "#maxdatepicker2" ).datepicker({
		dateFormat: 'yy-mm-dd', 
	/*	defaultDate: "+1w",*/
		changeMonth: true,
		numberOfMonths: 1,
		onSelect: function( selectedDate ) {
			jQuery( "#mindatepicker2" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
      jQuery("#mindatepicker2").val(lastweek);
      jQuery("#maxdatepicker2").val(today);
      
    
	/*********************************** DATE PICKER ********************************/
	
	
	
	/*********************************** CHARTS ********************************/
	jQuery( "#tabs" ).tabs();

	
	var chart;

	var options = {
			'width':900,
			'height':500,
			'pointSize':10,
			'tooltip':{textStyle: {color: 'blue'}, showColorCode: true},
			'legend':{position: 'right', textStyle: {color: 'blue', fontSize: 16}},
			'vAxis': {minValue: 0}};
	
	
	
	/** FIRST EMAIL **/
	
	/* ask for all the ranks we have in store */
	var data = {
		action: 'get_by_date',
		date_start:lastweek,
		date_end:today,
		event_type: 'register'
	};
	
	jQuery.getJSON(ajaxurl, data, function(response) {
	
		draw_chart_event(options,response,'#Registos','register');

	});

	
	jQuery('#drawg').click( function(){
		
		startDate = jQuery( "#mindatepicker" ).datepicker( "getDate" );
		endDate = jQuery( "#maxdatepicker" ).datepicker( "getDate" );
		
		
		if(startDate != null && endDate != null )
		{
			// redraw graph
			/* ask for all the ranks we have in store */
			var data = {
				action: 'get_by_date',
				date_start:jQuery( "#mindatepicker" ).val(),
				date_end:jQuery( "#maxdatepicker" ).val(),
				event_type: 'first_email'
			};
			
			jQuery.getJSON(ajaxurl, data, function(response) {
			
				draw_chart_event(options,response,'#Registos','register');

			});
		}
			
	});

	
	/** SECOND EMAIL **/
	

	jQuery('#drawg2').trigger('click');
	
	jQuery('#drawg2').click( function(){
		
		startDate = jQuery( "#mindatepicker2" ).datepicker( "getDate" );
		endDate = jQuery( "#maxdatepicker2" ).datepicker( "getDate" );
		
		
		if(startDate != null && endDate != null )
		{
			// redraw graph
			/* ask for all the ranks we have in store */
			var data = {
				action: 'get_by_date',
				date_start:jQuery( "#mindatepicker2" ).val(),
				date_end:jQuery( "#maxdatepicker2" ).val(),
				event_type: 'subscription'
			};
			
			jQuery.getJSON(ajaxurl, data, function(response) {
			
				draw_chart_event(options,response,'#Subscrições Newsletter','subscription');

			});
		}
			
	});
	
	
	
	/*********************************** CHARTS ********************************/
	
	/*********************************** EXPORT ********************************/
	
	//export CSV
	jQuery('.export_csv').click(function(){
		
		var obj = rawData;
		
		console.log(rawData);
		
		var csv = {	
				header:new Array("Data", "Registos"),
				body:rawData
		};
		
		var t= JSON.stringify(csv);
		jQuery('#export_data').val(t);
		jQuery('#export_form').submit();
		
	});
	/*********************************** EXPORT ********************************/

	jQuery('#tb2').click(function(){
		jQuery('#drawg2').trigger('click');	
	});

	
});


function draw_chart_event(options,response,label,id){
	rawData = response;
	
	var data = new google.visualization.DataTable();

	if(response !=0){
		
		if(typeof response[0] != 'undefined') {
			data.addColumn('string', 'Data');
			data.addColumn('number', label);	
		}
		
		var data = google.visualization.arrayToDataTable(response);
		
		chart = new google.visualization.ColumnChart(document.getElementById(id));
		chart.draw(data, options);
	}
	
	else
	{
		jQuery('#'+id).text('Nenhum resultado encontrado!');
	}
}


