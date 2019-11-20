// Form Elements JavaScripts

(function ($) {
	'use strict';
    
	$('#selectize-dropdown').selectize({
		create: false,
		sortField: {
			field: 'text',
			direction: 'asc'
		},
		dropdownParent: 'body'
	});

	$('#selectize-dropdown-job-status,#selectize-dropdown-job-date-range,#selectize-dropdown-contractor-title, #selectize-dropdown-city, #selectize-dropdown-state, #selectize-dropdown-job-type, #slctz-customers, #slctz-jobname, #slctz-jobstatus, #slctz-jobtype, #slctz-language-requested, #Con_Avail_Monday, #Con_Avail_Tuesday, #Con_Avail_Wednesday, #Con_Avail_Thursday, #Con_Avail_Friday, #Con_Avail_Saturday, #Con_Avail_Sunday').selectize({
		create: true,
		sortField: {
			field: 'text',
			direction: 'asc'
		},
		dropdownParent: 'body'
	});

	$('#selectize-dropdown-expertise').selectize({
		create: true,
		
		dropdownParent: 'body'
	});

	$('#selectize-tags-1').selectize({
	    delimiter: ',',
	    persist: false,
	    create: function(input) {
	        return {
	            value: input,
	            text: input
	        }
	    }
	});

	$('#selectize-tags-2').selectize({
	    delimiter: ',',
	    persist: false,
	    create: function(input) {
	        return {
	            value: input,
	            text: input
	        }
	    }
	});

	$('#selectize-group').selectize({
	    sortField: 'text'
	});

	$('.datepicker-1').datepicker();
	$('.datepicker-2').datepicker();

	$('#date-range-picker').daterangepicker();
	$('#date-range-picker-1').daterangepicker();
	$('#date-range-picker-2').daterangepicker();

	$("#summernote-usage").summernote({
	    height: 200,
	});

	
	
	

})(jQuery);
