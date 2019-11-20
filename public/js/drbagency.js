jQuery(document).ready(function(){

	var back_to_top_offset = 250;
	var back_to_top_duration = 2000;
	$(window).scroll(function(){
		if ( $(this).scrollTop() > back_to_top_offset ) {
			$('.back-to-top').fadeIn(back_to_top_duration);
		} else {
			$('.back-to-top').fadeOut(back_to_top_duration);
		}
	});
	$('.back-to-top').click(function(e){
		e.preventDefault();
		$('html, body').animate({scrollTop: 0}, back_to_top_duration);
		return false;
	})

	// job model edit create section start
	$('#edit_job_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.job_page_url_a_cl').attr('href');
	   	$.ajax({
	        type:"POST",
	        contentType: 'multipart/form-data',
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.job_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            var reload_to_url = document.getElementsByClassName("all_jobs_page_url")[0].href;
	            window.location.href = reload_to_url;
	        },
	        error: function(data){
	        	$('.job_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	var reload_to_url = document.getElementsByClassName("all_jobs_page_url")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#create_job_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var cr8t_job_page_url_to_use = $('.create_job_page_url_a_cl').attr('href');
	    
	    var formData1 = $('#create_job_form_id')[0];
	    var data = new FormData(formData1);
	    // var get_the_files = $('#Input_Attachments_id').files[];
	    // var filesFormData = FormData();
	    // // var filesFormData = FormData( $('#Input_Attachments_id') );
	    // filesFormData.append('file', get_the_files);

	   	$.ajax({
	        type:"POST",
	        // contentType: 'multipart/form-data',
	        // data:$(this).serialize(),

	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: cr8t_job_page_url_to_use,
	        data:data,
	        dataType: 'json',
	        success: function(data){
	            $('.job_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            console.log(data);
	            var reload_to_url = document.getElementsByClassName("all_jobs_page_url")[0].href;
	            window.location.href = reload_to_url;
	        },
	        error: function(data){
	        	$('.job_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            console.log(data);
	        	var reload_to_url = document.getElementsByClassName("all_jobs_page_url")[0].href;
	        	window.location.href = reload_to_url;
	        }
    	})
	})
	$('#delete_job_form_id').on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    var page_url_to_use = $('#delete_job_form_id').attr('action');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            alert(data);
	            setTimeout(function () { location.reload(1); }, 2000);
	        },
	        error: function(data){
	        	alert(data);
	        	setTimeout(function () { location.reload(1); }, 2000 );
	        }
    	})
	})
	// job model edit create section end


	// -------------------------------------------------------------------------



	// services model edit create section start
	$('#create_services_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.create_services_page_url_a_cl').attr('href');

	    var formData1 = $('#create_services_form_id')[0];
	    var data = new FormData(formData1);


	   	$.ajax({
	        type:"POST",
	        // url: page_url_to_use,
	        // data:$(this).serialize(),

	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,


	        dataType: 'json',
	        success: function(data){
	            $('.services_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { .reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_services_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	            
	        },
	        error: function(data){
	        	$('.services_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	var reload_to_url = document.getElementsByClassName("all_services_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#edit_services_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    // alert($('.edit_contractors_page_url_a_cl').attr('href'))
	    var page_url_to_use = $('.edit_services_page_url_a_cl').attr('href');

	    var formData1 = $('#edit_services_form_id')[0];
	    var data = new FormData(formData1);
	    
	   	$.ajax({
	        type:"POST",
	        // url: page_url_to_use,
	        // data:$(this).serialize(),

	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,

	        dataType: 'json',
	        success: function(data){
	            $('.services_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { location.reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_services_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        },
	        error: function(data){
	        	$('.services_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	// setTimeout(function () { location.reload(1); }, 5000 );
	        	 //location.reload();
	        	 var reload_to_url = document.getElementsByClassName("all_services_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#delete_services_form_id').on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    var page_url_to_use = $('#delete_services_form_id').attr('action');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            alert(data);
	            setTimeout(function () { location.reload(1); }, 2000);
	        },
	        error: function(data){
	        	$('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	alert(data);
	        	setTimeout(function () { location.reload(1); }, 2000 );
	        	 //location.reload();
	        }
    	})
	})
	
	// services model edit create section end


	// -------------------------------------------------------------------------



	// customer model edit create section start
	$('#create_customers_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.create_customers_page_url_a_cl').attr('href');

	    var formData1 = $('#create_customers_form_id')[0];
	    var data = new FormData(formData1);

	   	$.ajax({
	        type:"POST",
	        // url: page_url_to_use,
	        // data:$(this).serialize(),
	        
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,

	        dataType: 'json',
	        success: function(data){
	            $('.customers_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { .reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_customers_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	            
	        },
	        error: function(data){
	        	$('.customers_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	var reload_to_url = document.getElementsByClassName("all_customers_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#edit_customers_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.edit_customers_page_url_a_cl').attr('href');

	    var formData1 = $('#edit_customers_form_id')[0];
	    var data = new FormData(formData1);
	    
	   	$.ajax({
	        type:"POST",
	        // url: page_url_to_use,
	        // data:$(this).serialize(),
	        
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,

	        dataType: 'json',
	        success: function(data){
	            $('.customers_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            var reload_to_url = document.getElementsByClassName("all_customers_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        },
	        error: function(data){
	        	$('.customers_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	 var reload_to_url = document.getElementsByClassName("all_customers_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#delete_customers_form_id').on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    var page_url_to_use = $('#delete_customers_form_id').attr('action');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            alert(data);
	            setTimeout(function () { location.reload(1); }, 2000);
	        },
	        error: function(data){
	        	alert(data);
	        	setTimeout(function () { location.reload(1); }, 2000 );
	        }
    	})
	})
	// customer model edit create section end


	// -------------------------------------------------------------------------


	// contractors model edit create section start
	$('#create_contractors_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.create_contractors_page_url_a_cl').attr('href');

	    var formData1 = $('#create_contractors_form_id')[0];
	    var data = new FormData(formData1);

	   	$.ajax({
	        type:"POST",
	        // contentType: 'multipart/form-data',
	        // url: page_url_to_use,
	        // data:$(this).serialize(),
	        
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,

	        dataType: 'json',
	        success: function(data){
	            $('.contractors_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { .reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_contractors_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	            
	        },
	        error: function(data){
	        	$('.contractors_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	var reload_to_url = document.getElementsByClassName("all_contractors_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#edit_contractors_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    // alert($('.edit_contractors_page_url_a_cl').attr('href'))
	    var page_url_to_use = $('.edit_contractors_page_url_a_cl').attr('href');

	    var formData1 = $('#edit_contractors_form_id')[0];
	    var data = new FormData(formData1);

	   	$.ajax({
	        type:"POST",
	        // contentType: 'multipart/form-data',
	        // url: page_url_to_use,
	        // data:$(this).serialize(),

	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,

	        dataType: 'json',
	        success: function(data){
	            $('.contractors_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { location.reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("reload_to_url_contractors")[0].href;
	            location.href = reload_to_url;
	            console.log(reload_to_url);
	        },
	        error: function(data){
	        	$('.contractors_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	// setTimeout(function () { location.reload(1); }, 5000 );
	        	// var reload_to_url = document.getElementsByClassName("reload_to_url_contractors")[0].href;
	            // window.location.href = reload_to_url;
	        }

    	})
	})

	$('#delete_contractors_form_id').on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    //var page_url_to_use = $('#delete_single_contractor').attr('href');
	    var page_url_to_use = $('#delete_contractors_form_id').attr('action');
	    
	    
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.contractors_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            alert(data);
	            setTimeout(function () { location.reload(1); }, 2000);
	        },
	        error: function(data){
	        	$('.contractors_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	alert(data);
	        	setTimeout(function () { location.reload(1); }, 2000 );
	        	 //location.reload();
	        }
    	})
	})

	// -------------------------------------------------------------------------


	// invoices model edit create section start
	$('#create_invoices_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.create_invoices_page_url_a_cl').attr('href');
	    var formData1 = $('#create_invoices_form_id')[0];
	    var data = new FormData(formData1);
	   	$.ajax({
	        type:"POST",
	        // url: page_url_to_use,
	        // data:$(this).serialize(),
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,
	        dataType: 'json',
	        success: function(data){
	            $('.invoices_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { .reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_invoices_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	            
	        },
	        error: function(data){
	        	$('.invoices_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	var reload_to_url = document.getElementsByClassName("all_invoices_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#edit_invoices_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    // alert($('.edit_contractors_page_url_a_cl').attr('href'))
	    var page_url_to_use = $('.edit_invoices_page_url_a_cl').attr('href');
	    var formData1 = $('#edit_invoices_form_id')[0];
	    var data = new FormData(formData1);
	   	$.ajax({
	        type:"POST",
	        // url: page_url_to_use,
	        // data:$(this).serialize(),
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: page_url_to_use,
	        data:data,
	        dataType: 'json',
	        success: function(data){
	            $('.services_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { location.reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_invoices_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        },
	        error: function(data){
	        	$('.services_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	// setTimeout(function () { location.reload(1); }, 5000 );
	        	 //location.reload();
	        	 var reload_to_url = document.getElementsByClassName("all_invoices_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#delete_invoices_form_id').on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    //var page_url_to_use = $('#delete_single_contractor').attr('href');
	    var page_url_to_use = $('#delete_invoices_form_id').attr('action');
	    
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            // $('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            alert(data);
	            setTimeout(function () { location.reload(1); }, 2000);
	        },
	        error: function(data){
	        	// $('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	alert(data);
	        	setTimeout(function () { location.reload(1); }, 2000 );
	        	 //location.reload();
	        }
    	})
	})
	// invoices model edit create section end


	// -------------------------------------------------------------------------


	// contractor_billing model edit create section start
	$('#create_contractor_billings_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.create_contractor_billings_page_url_a_cl').attr('href');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.contractor_billing_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { .reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_contractor_billings_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	            
	        },
	        error: function(data){
	        	$('.contractor_billing_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	var reload_to_url = document.getElementsByClassName("all_contractor_billings_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#edit_contractor_billings_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    // alert($('.edit_contractors_page_url_a_cl').attr('href'))
	    var page_url_to_use = $('.edit_contractor_billings_page_url_a_cl').attr('href');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.contractor_billings_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { location.reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_contractor_billings_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        },
	        error: function(data){
	        	$('.contractor_billings_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	// setTimeout(function () { location.reload(1); }, 5000 );
	        	 //location.reload();
	        	 var reload_to_url = document.getElementsByClassName("all_contractor_billings_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#delete_contractor_billing_form_id').on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    //var page_url_to_use = $('#delete_single_contractor').attr('href');
	    var page_url_to_use = $('#delete_contractor_billing_form_id').attr('action');
	    
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            // $('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            alert(data);
	            setTimeout(function () { location.reload(1); }, 2000);
	        },
	        error: function(data){
	        	// $('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	alert(data);
	        	setTimeout(function () { location.reload(1); }, 2000 );
	        	 //location.reload();
	        }
    	})
	})
	// contractor_billing model edit create section end

	
	// -------------------------------------------------------------------------


	// users model edit create section start
	$('#create_users_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.create_users_page_url_a_cl').attr('href');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.users_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            // setTimeout(function () { .reload(1); }, 5000);
	            var reload_to_url = document.getElementsByClassName("all_users_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	            
	        },
	        error: function(data){
	        	$('.users_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	var reload_to_url = document.getElementsByClassName("all_users_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#edit_users_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    //e.preventDefault();
	    
	    var page_url_to_use = $('.all_users_page_url_a_cl').attr('href');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.users_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            var reload_to_url = document.getElementsByClassName("all_users_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        },
	        error: function(data){
	        	$('.users_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	 var reload_to_url = document.getElementsByClassName("all_users_page_url_a_cl")[0].href;
	            window.location.href = reload_to_url;
	        }
    	})
	})
	$('#delete_users_form_id').on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    
	    var page_url_to_use = $('#delete_users_form_id').attr('action');
	    
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            // $('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	            alert(data);
	            setTimeout(function () { location.reload(1); }, 2000);
	        },
	        error: function(data){
	        	// $('.services_delete_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        	alert(data);
	        	setTimeout(function () { location.reload(1); }, 2000 );
	        	 //location.reload();
	        }
    	})
	})
	// users model edit create section end


	// -------------------------------------------------------------------------


	// reports model edit create section start
	$('#create_reports_orm_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.create_reports_page_url_a_cl').attr('href');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.reports_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        },
	        error: function(data){
	        	$('.reports_create_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        }
    	})
	})

	$('#edit_reports_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var page_url_to_use = $('.edit_reports_page_url_a_cl').attr('href');
	   	$.ajax({
	        type:"POST",
	        url: page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            $('.reports_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        },
	        error: function(data){
	        	$('.reports_edit_result_text').html("<div class='alert alert-dismissible alert-info'>"+ data +"</div>");
	        }
    	})
	})

	$('.select-cutmn .selectize-control.single .selectize-input').focusout(function(){
		var company_name = $('.select-cutmn .selectize-control.single .selectize-input .item').text();
		var id = $('.select-cutmn .selectize-control.single .selectize-input .item').data("value");
		var page_url_to_use_2_to_use = $('.url2').attr('href');
		var page_url_to_use_2 = page_url_to_use_2_to_use + "/jobs/getservicesforcustomer/";
		var page_url_to_use_3 = page_url_to_use_2_to_use + "/jobs/customerdetails/";
		var page_url_to_use_customer_mileage_code = page_url_to_use_2_to_use + "/jobs/getmileageforcustomer/";

		// console.log(page_url_to_use_customer_mileage_code + company_name);
		// console.log(page_url_to_use_2  + company_name);

		$.ajax({
	        type:"GET",
	        url: page_url_to_use_2 + company_name,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            var $el = $("#Service_Requested_id");
				$el.empty(); // remove old options
	            for (var i = 0; i < data.length; i++) {
	        		
	            	$el.append($("<option></option>").attr("value", data[i]).text(data[i]));
	            }
	            $('#Service_Requested_id').trigger('change');
	        },
	        error: function(data){
	        }
    	})
    	$.ajax({
	        type:"GET",
	        url: page_url_to_use_customer_mileage_code + company_name,

	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            var $jv = $("#Mileage_Code_id");
	            $jv.empty();
	        	for (var i = 0; i < data.length; i++) {
	            	$jv.append($("<option></option>").attr("value", data[i]).text(data[i]));
	            }
	            $('#Mileage_Code_id').trigger('change');
	        },
	        error: function(data){
	        	console.log(data);
	        }
    	})
    	$.ajax({
	        type:"GET",
	        url: page_url_to_use_3 + company_name,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	        	$('#Customer_Number_id').val(data[0]);
	        	$('#Customer_First_Name_id').val(data[1]);
	        	$('#Customer_Last_Name_id').val(data[2]); //Customer_Last_Name and LL Rep
	        	$('#Customer_Email_id').val(data[3]); //email add
	        },
	        error: function(data){
	        }
    	})
	})

	$( "#Mileage_Code_id" ).on("click mouseenter mouseleave focusout change", function( event ) {
		var g_mileage_name = $('#Mileage_Code_id').find(":selected").text();
		var g_company_name = $('.select-cutmn .selectize-control.single .selectize-input .item').text();
		var page_url_to_use_4_to_use = $('.url2').attr('href');
		var page_url_to_use_4 = page_url_to_use_4_to_use + "/jobs/mileagerates/s/";
		console.log(page_url_to_use_4 + g_mileage_name + "/c/" + g_company_name);
		$.ajax({
	        type:"GET",
	        url: page_url_to_use_4 + g_mileage_name + "/c/" + g_company_name,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	        	$('#Mileage_Rate_id').val(data[3]);
	        	//$('#Service_Code_id').val(data[2]); //Customer_Last_Name and LL Rep
	        	//$('#Customer_Email_id').val(data[2]); //email add
	        	$('#Estimated_Miles_id').val('1');
	        	var mileage_cost = parseFloat(parseFloat($('#Mileage_Rate_id').val()) * parseFloat($('#Estimated_Miles_id').val())).toFixed(2);
	        	$('#Estimated_Mileage_Cost_id').val(mileage_cost);
	        },
	        error: function(data){
	        }
    	})
	});


	$( "#Service_Requested_id" ).on("click mouseenter mouseleave focusout change", function( event ) {
		var g_service_name = $('#Service_Requested_id').find(":selected").text();
		var g_company_name = $('.select-cutmn .selectize-control.single .selectize-input .item').text();
		var page_url_to_use_4_to_use = $('.url2').attr('href');
		var page_url_to_use_4 = page_url_to_use_4_to_use + "/jobs/srvrates/s/";
		// console.log(page_url_to_use_4 + g_service_name + "/c/" + g_company_name);
		$.ajax({
	        type:"GET",
	        url: page_url_to_use_4 + g_service_name + "/c/" + g_company_name,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	        	$('#Service_Name_Rate_id').val(data[3]);
	        	$('#Service_Code_id').val(data[2]); //Customer_Last_Name and LL Rep
	        	//$('#Customer_Email_id').val(data[2]); //email add
	        	$('#Estimated_Service_Hours_id').val('1');
	        	var srv_cost = parseFloat(parseFloat($('#Service_Name_Rate_id').val()) * parseFloat($('#Estimated_Service_Hours_id').val())).toFixed(2);
	        	$('#Estimated_Service_Cost_id').val(srv_cost);
	        },
	        error: function(data){
	        }
    	})
	});

	$( "#Service_Name_Rate_id, #Estimated_Service_Hours_id" ).on("click mouseenter mouseleave focusout change", function( event ) {
		if($('#Service_Name_Rate_id').val().length > 0 && $('#Service_Name_Rate_id').val() != ''){
			var srv_cost = parseFloat(parseFloat($('#Service_Name_Rate_id').val()) * parseFloat($('#Estimated_Service_Hours_id').val())).toFixed(2);
		        	$('#Estimated_Service_Cost_id').val(srv_cost);
		}
	});
	$( "#Mileage_Rate_id, #Estimated_Miles_id" ).on("click mouseenter mouseleave focusout change", function( event ) {
		if($('#Mileage_Rate_id').val().length > 0 && $('#Mileage_Rate_id').val() != ''){
			var mileage_cost = parseFloat(parseFloat($('#Mileage_Rate_id').val()) * parseFloat($('#Estimated_Miles_id').val())).toFixed(2);
	        	$('#Estimated_Mileage_Cost_id').val(mileage_cost);	
		}
		
	});

	// contractor-rate
	$(".contractor-rate-tab").hide();
	$(".hide-contractor-rate-tab-btn").hide();

	$(".show-contractor-rate-tab-btn").click(function(){
		$(".contractor-rate-tab").show();
		$(".hide-contractor-rate-tab-btn").show();
		$(".show-contractor-rate-tab-btn").hide();
	})
	$(".hide-contractor-rate-tab-btn").click(function(){
		$(".contractor-rate-tab").hide();
		$(".show-contractor-rate-tab-btn").show();
		$(".hide-contractor-rate-tab-btn").hide();
	})

	// contractor-availability
	$(".contractor-availability-tab-btn").hide();
	$(".hide-contractor-availability-tab-btn").hide();

	$(".show-contractor-availability-tab-btn").click(function(){
		$(".contractor-availability-tab-btn").show();
		$(".hide-contractor-availability-tab-btn").show();
		$(".show-contractor-availability-tab-btn").hide();
	})
	$(".hide-contractor-availability-tab-btn").click(function(){
		$(".contractor-availability-tab-btn").hide();
		$(".show-contractor-availability-tab-btn").show();
		$(".hide-contractor-availability-tab-btn").hide();
	})


	// show contractor jobs. Jobs done by a specific contractor - start
	var get_contractor_page_url = $('#contractor_page_url').attr('href');
	var get_jobs_page_url = $('.job_page_url').attr('href');
	//var jobs_page_url_to_link_to = get_jobs_page_url + 

	var first_name = $('.contractor_first_name').text();
	var last_name = $('.contractor_last_name').text();
	contractor_page_url = get_contractor_page_url + '/showjobsbycontractor/f/' + first_name + '/l/' + last_name + '';
	
   	$.ajax({
        type:"GET",
        url: contractor_page_url,
        data:$(this).serialize(),
        dataType: 'json',
        success: function(data){
            $('.contractor_jobs_list').text(data)
            
            var result_array = [];
            if ( data === 'empty'){
            	$('.contractor_jobs_list').html("No Job To Display");
            } else {
            	for (var i = 0; i < data.length; i++) {
            		result_array.push( i +1 + " - <a href="+ get_jobs_page_url + "/" + data[i]["ID"] +">Name: "+ data[i]["Jobs_Job_Name"] +" | Date Requested: "+ data[i]["Job_Request_Date"] +" </a> <br/><br/>" );
	            }
	            $('.contractor_jobs_list').html(result_array);
            }
        },
        error: function(data){
            // $('.contractor_jobs_list').text(data)
            
            $('.contractor_jobs_list').html("No Job To Display");
        }
	})
    // show contractor jobs. Jobs done by a specific contractor - end



    $('#showJobByIDFormID').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var job_id_value = $('.job_id').val();
	    if(Math.floor(job_id_value) == job_id_value && $.isNumeric(job_id_value)){
	    	var get_job_id_value = job_id_value;
	    }  else {
	    	var get_job_id_value = 1;
	    }
	    var page_url_to_use = $('.showJobByIDFormclURL').attr('href');
	    var show_job_page_url_to_use = page_url_to_use + '/' + $.trim(get_job_id_value);
	   	$.ajax({
	        type:"GET",
	        contentType: 'multipart/form-data',
	        url: show_job_page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            window.location.href = show_job_page_url_to_use;
	        },
	        error: function(data){
	        window.location.href = show_job_page_url_to_use;
	        }
    	})
	})

	$('.send-contractor-email').on('click', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var send_contractor_email_page_url_to_use = $('.send-contractor-email').attr('href');
	   	$.ajax({
	        type:"GET",
	        contentType: 'multipart/form-data',
	        url: send_contractor_email_page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            alert(data);
	            // console.log(data);
	        },
	        error: function(data){
	            alert(data);
	            // console.log(data);
	        }
    	})
	})

	$('.send-customer-email').on('click', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var send_customer_email_page_url_to_use = $('.send-customer-email').attr('href');
	   	$.ajax({
	        type:"GET",
	        contentType: 'multipart/form-data',
	        url: send_customer_email_page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            alert(data);
	            // console.log(data);

	        },
	        error: function(data){
	            alert(data);
	            // console.log(data);
	        }
    	})
	})

	$('#job-create-find-contractor-btn-id').on('click', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var get_find_contractor_page_url_to_use = $('.all_jobs_page_url').attr('href');
	    var contractor_id = $('#Contractor_ID_id').val();
	    var find_contractor_page_url_to_use = get_find_contractor_page_url_to_use + '/getsinglecontractordetailswithid/' + $.trim(contractor_id);
	   	$.ajax({
	        type:"GET",
	        contentType: 'multipart/form-data',
	        url: find_contractor_page_url_to_use,
	        data:$(this).serialize(),
	        dataType: 'json',
	        success: function(data){
	            // alert(data);

	            var Con_E_mail_Address = data['Con_E_mail_Address'].replace("'", "");
	            var Con_Home_Phone = data['Con_Home_Phone'].replace("'", "");
	            var Con_Fax_Phone = data['Con_Fax_Phone'].replace("'", "");
	            var Con_Cell_Phone = data['Con_Cell_Phone'].replace("'", "");
	            var Con_First_Name = data['Con_First_Name'].replace("'", "");
	            var Con_Last_Name = data['Con_Last_Name'].replace("'", "");

	            $('#Contractor_Email_id').val(Con_E_mail_Address.replace("'", ""));
	            $('#Contractor_Home_Phone_Number_id').val(Con_Home_Phone.replace("'", ""));
	            $('#Contractor_Cell_Phone_Number_id').val(Con_Cell_Phone.replace("'", ""));
	            $('#Contractor_First_Name_id').val(Con_First_Name.replace("'", ""));
	            $('#Contractor_Last_Name_id').val(Con_Last_Name.replace("'", ""));

	   //          var text = "this is some sample text that i want to replace";
				// var new_text = text.replace("want", "dont want");

	            // console.log(data);

	            // console.log(data['Con_E_mail_Address']);
	            // console.log(data['Con_Home_Phone']);
	            // console.log(data['Con_Fax_Phone']);
	            // console.log(data['Con_Cell_Phone']);
	            // console.log(data['Con_First_Name']);
	            // console.log(data['Con_Last_Name']);

	        },
	        error: function(data){
	            // alert(data);
	            console.log(data);
	        }
    	})
	})

	// single_job_view_img_cl

	$('div[class="testimonial"]').each(function(index,item){
	    if(parseInt($(item).data('index'))>2){
	        $(item).html('Testimonial '+(index+1)+' by each loop');
	    }
	});


	function deleteImageFileWhenClicked(old_edit_file_name){
		// $('.single_job_view_img_cl').each(function(i, obj){
		$('.delete-img-cl-1').each(function(i, obj){
			$(obj).click(function(){
				var value_clicked = $(obj).attr('data-filename');
				var original_vals = $.trim(old_edit_file_name.val());
				original_vals.replace(/ /g, "");
				console.log(original_vals);
				var original_vals_array = original_vals.split(",");
				// var new_vals_array = original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				old_edit_file_name.val(original_vals_array.toString());
				console.log(old_edit_file_name.val());
				$(obj).parent().css("display", "none");
				// console.log( $(obj).parent() );
			})
		})
	}

	function deleteImageFileWhenClickedDeposit(edit_deposit_con_old){
		// $('.single_job_view_img_cl').each(function(i, obj){
		$('.delete-img-cl-3').each(function(i, obj){
			$(obj).click(function(){
				var value_clicked = $(obj).attr('data-filename');
				var original_vals = $.trim(edit_deposit_con_old.val());
				original_vals.replace(/ /g, "");
				console.log(original_vals);
				var original_vals_array = original_vals.split(",");
				// var new_vals_array = original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				edit_deposit_con_old.val(original_vals_array.toString());
				console.log(edit_deposit_con_old.val());
				$(obj).parent().css("display", "none");
				// console.log( $(obj).parent() );
			})
		})
	}

function deleteImageFileWhenClickedCertification(edit_certification_con_old){
		// $('.single_job_view_img_cl').each(function(i, obj){
		$('.delete-img-cl-4').each(function(i, obj){
			$(obj).click(function(){
				var value_clicked = $(obj).attr('data-filename');
				var original_vals = $.trim(edit_certification_con_old.val());
				original_vals.replace(/ /g, "");
				console.log(original_vals);
				var original_vals_array = original_vals.split(",");
				// var new_vals_array = original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				edit_certification_con_old.val(original_vals_array.toString());
				console.log(edit_certification_con_old.val());
				$(obj).parent().css("display", "none");
				// console.log( $(obj).parent() );
			})
		})
	}



	/*function deleteImageFileWhenClickedJobs(old_edit_file_name){
		// $('.single_job_view_img_cl').each(function(i, obj){

		

		$('.delete-img-cl-1').each(function(i, obj){
			$(obj).click(function(){
				//console.log(old_edit_file_name);
				var value_clicked = $(obj).attr('data-filename');
				//console.log(value_clicked);
				var original_vals = $.trim(old_edit_file_name);
				//console.log(original_vals);
				var original_vals_array = original_vals.split(",");
				//console.log(original_vals_array);
				// /var new_vals_array = original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				//original_vals_array.splice( $.inArray(value_clicked, original_vals_array), 1);
				//old_edit_file_name.val(original_vals_array.toString());
				//console.log(original_vals_array);

				for(var i in original_vals_array){
			        if(original_vals_array[i]==value_clicked){
			           original_vals_array.splice(i,1);
			            break;
			        }
    			}

    			//console.log(original_vals_array);

				newArray = original_vals_array.toString();
				//console.log(old_edit_file_name);
				$('edit_job_old_val').val(newArray);

				$(obj).parent().css("display", "none");
				// /console.log( $(obj).parent() );
			})
		})
	}*/


	

	deleteImageFileWhenClicked($('#edit_invoice_old_val_id')); //invoices
	deleteImageFileWhenClicked($('#edit_job_old_val_id')); //jobs
	deleteImageFileWhenClicked($('#edit_con_old_val_id')); //contractor
	deleteImageFileWhenClicked($('#edit_serv_old_vals_id')); //services
	deleteImageFileWhenClicked($('#edit_custmr_old_val_id')); //customers
	
	
	deleteImageFileWhenClicked(); //customers
	deleteImageFileWhenClicked(); //contractor_billing

	deleteImageFileWhenClickedDeposit($('#edit_deposit_con_old_val_id')); //contractors
	deleteImageFileWhenClickedCertification($('#edit_certification_old_val_id')); //contractors


	$('#bulk_email_box_id').hide();
	$('#send-bulk-email-id-hide').hide();

	$('#send-bulk-email-id-hide').click(function(e){
		$('#bulk_email_box_id').hide();
		$('#send-bulk-email-id-hide').hide();
		$('#send-bulk-email-id-show').show();
	})
	$('#send-bulk-email-id-show').click(function(e){
		$('#bulk_email_box_id').show();
		$('#send-bulk-email-id-hide').show();
		$('#send-bulk-email-id-show').hide();
	})
	

	function isValidEmailAddress(emailAddress) {
    	var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    	return pattern.test(emailAddress);
	};

	$('#add-selected-emails-id').click(function(e){
		var all_emails_array = [];
		$("input:checkbox[id=contractor_check_box_id]").each(function(i, obj){
			console.log(isValidEmailAddress($(this).attr("data-email")));
			if ( ($(this).is(":checked") ) && ( $(this).attr("data-email") !== 'unknown' ) && (  isValidEmailAddress($(this).attr("data-email")) ) ) {
				all_emails_array.push($(this).attr("data-email"));
			}
		})
		$('#bulk_email_emails_id').val(all_emails_array.toString());
	})
	$('#bulk_email_contractor_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var get_form_page_url = $('#bulk_email_contractor_form_id_url').val();
	    var url_to_use = get_form_page_url;
	    var formData1 = $('#bulk_email_contractor_form_id')[0];
	    var data = new FormData(formData1);
	   	$.ajax({
	        type:"POST",
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: url_to_use,
	        data:data,
	        dataType: 'json',
	        success: function(data){
	            $('.response_msg_0').html("<div class='response_msg'>" + data + "</div>");
	        },
	        error: function(data){
	            $('.response_msg_0').html("<div class='response_msg'>" + data + "</div>");
	        }

    	})
	})

	$('#email_contractor_manual_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var get_form_page_url = $('#email_contractor_manual_form_id_url').val();
	    var get_the_email_add = $('#contractor_email_add_id').val();
	    var the_msg = $('#message_val_id').val();
	    if ( the_msg.length < 1 ) {
	    	var get_the_msg = " ";
	    } else {
	    	var get_the_msg = the_msg;
	    }
	    var url_to_use = get_form_page_url + "/" + get_the_email_add + "/" + get_the_msg;
	    console.log(url_to_use);
	    console.log(get_the_email_add);
	    // console.log(url_to_use);
	    var formData1 = $('#email_contractor_manual_form_id')[0];
	    var data = new FormData(formData1);
	   	$.ajax({
	        type:"GET",
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: url_to_use,
	        data:data,
	        dataType: 'json',
	        success: function(data){
	            // console.log(data);
	            $('.contractor_response_msg').html("<div class='response_msg'>" + data + "</div>");
	        },
	        error: function(data){
	            // console.log(data);
	            $('.contractor_response_msg').html("<div class='response_msg'>" + data + "</div>");
	        }
    	})
	})

	$('#email_customer_manual_form_id').on('submit', function(e){
		$.ajaxSetup({
        	header:$('meta[name="_token"]').attr('content')
    	})
	    e.preventDefault();
	    var get_form_page_url = $('#email_customer_manual_form_id_url').val();
	    var get_the_email_add = $('#customer_email_add_id').val();
	    var get_the_msg = $('#customer_message_val_id').val();
	    var url_to_use = get_form_page_url + "/" + get_the_email_add + "/" + get_the_msg;
	    console.log(url_to_use);
	    var formData1 = $('#email_customer_manual_form_id')[0];
	    var data = new FormData(formData1);
	   	$.ajax({
	        type:"GET",
	        enctype: 'multipart/form-data',
	        processData: false,
            contentType: false,
            cache: false,
	        url: url_to_use,
	        data:data,
	        dataType: 'json',
	        success: function(data){
	            // console.log(data);
	            $('.customer_response_msg').html("<div class='response_msg'>" + data + "</div>");
	        },
	        error: function(data){
	            // console.log(data);
	            $('.customer_response_msg').html("<div class='response_msg'>" + data + "</div>");
	        }
    	})
	})

	$('#export-selected-invoice-id').click(function(e){
		var all_invoices_number_array = [];
		$("input:checkbox[id=invoice_check_box_id]").each(function(i, obj){
			if ( ($(this).is(":checked") ) && ( $(this).attr("data-number") !== 'unknown') ) {
				all_invoices_number_array.push($(this).attr("data-number"));
			}
		})
		// $.ajaxSetup({
  //       	header:$('meta[name="_token"]').attr('content')
  //   	})
	    e.preventDefault();
	    var all_invoices = all_invoices_number_array.toString();
	    var get_form_page_url = $('#invoice_export_to_excel_url_id').val();
	    var form_page_url = get_form_page_url + all_invoices;
	    window.location.href = form_page_url;
	    console.log(form_page_url);

	    // console.log(get_form_page_url);
		// console.log(all_invoices_number_array.toString());

	    
	    // var formData1 = $('#email_contractor_manual_form_id')[0];
	    // var data = new FormData(formData1);
	   	// $.ajax({
	    //     type:"GET",
	    //     enctype: 'multipart/form-data',
	    //     processData: false,
     //        contentType: false,
     //        cache: false,
	    //     url: form_page_url,
	    //     // data:data,
	    //     data:$(this).serialize(),
	    //     dataType: 'json',
	    //     success: function(data){
	    //         // console.log(data);
	    //         window.location.href = form_page_url;
	    //     },
	    //     error: function(data){
	    //         console.log(data);
	    //     }
    	// })
		// $('#bulk_email_emails_id').val(all_emails_array.toString());
	})

	$('.jvectormap-container path').click(function(){
		var state = $(this).data('code').substring(3, 5);
		var page_url = $('.homepage_contractors_url').attr("href");
		var page_url_to_use = page_url + "/filter_all?lang=&city=&state=" + state + "&zip=";
		// var reload_to_url = document.getElementsByClassName("all_jobs_page_url")[0].href;
		window.location.href = page_url_to_use;

		// console.log(page_url_to_use);
		
		// http://languagelinkllc.net/hermes/contractors/filter_all?lang=&city=&state=AZ&zip=

		// console.log( $('.homepage_contractors_url').attr("href")  );
		// http://languagelinkllc.net/hermes/contractors/filter_all?lang=&city=&state=AZ&zip=

		// var reload_to_url = document.getElementsByClassName("all_jobs_page_url")[0].href;
	 //            window.location.href = reload_to_url;
	})

})




