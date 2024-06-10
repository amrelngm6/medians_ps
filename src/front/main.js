"user strict";

/**
 * Handle the process for Sign up
 * based on the response
 * 
 * @param response
 */ 
function signupFormResponse(response)
{

	if (response.success)
		return (Swal.fire(response.title,response.result,  'success'), form.reset())

	if (response.reload)
		return window.location.reload()
}


/**
 * Handle the process for Login
 * based on the response
 * 
 * @param response
 */
function loginFormResponse(response)
{

	if (response.success)
		return window.location.href = './dashboard'
	
	if (response.reload)
		return window.location.reload()
}


/**
 * Handle the process for submitting 
 * any form at the frontend
 * based on the response
 * 
 * @param response
 */
jQuery(document).on('submit', 'form', function(){

	var formId = jQuery(this).attr('id') ;

	// Get the form and submit button elements
	const form = document.getElementById(jQuery(this).attr('id'));

	if (!form)
		return null;

	// Prevent the default form submission behavior
	event.preventDefault();

	// Get the form data as a FormData object
	const formData = new FormData(form);

	// Send the form data via AJAX
	const xhr = new XMLHttpRequest();
	xhr.open('POST', form.action, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = function() {
	    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
	      // Handle the successful response
	    	let res = JSON.parse(xhr.responseText);

			// Show sweetAlert if there is any errors 
			if (res.error){
				return Swal.fire('Error!',res.error, 'error');
			}

			// in case submitting login form 
	    	if (formId == 'login-form'){
	    		return loginFormResponse(res)
	    	}

			// in case submitting Sign-up form 
	    	if (formId == 'signup-form'){
	    		return signupFormResponse(res)
	    	}
	    	
	    	// Swal.fire(res.title,res.result,  'success')

	    	return form.reset();

	    } else {
	  		// Swal.fire('Error!','Connection error','error')
	    }
	};
	xhr.send(new URLSearchParams(formData).toString());
})




/** 
 * Some helpful libraries
 */ 
$(document).ready(function () {

	//menu top fixed bar
	$(".scrollToTop").on("click", function () {
		$("html, body").animate(
			{
				scrollTop: 0,
			},
			700
		);
		return false;
	});
	//--Header Menu--//
	
	// password hide//
	$(".toggle-password, .toggle-password2, .toggle-password3, .toggle-password4, .toggle-password5").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("id"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});
	// password hide//

	//Serach Popup
	$('#search, #search2').click(function() {
		$('.search-form, .search-form2').animate({right: 0}, 50);
		$('.search-popup, .search-popup2').show();
		$('.search-bg, .search-bg2').click(function() {
			$('.search-popup, .search-popup2').hide();
			$('.search-form, .search-form2').animate({right: '-100%'}, 50);
		});
		});
	//--Search Popup--//

	//--Magnifiqpopup--//
	$('.video-btn').magnificPopup({
		type: 'iframe',
		callbacks: {
			
	  	}
	});
	//--Magnifiqpopup--//

	//--Odometer--//
	$(".odometer-item").each(function () {
		$(this).isInViewport(function (status) {
			if (status === "entered") {
				for (
					var i = 0;
					i < document.querySelectorAll(".odometer").length;
					i++
				) {
					var el = document.querySelectorAll(".odometer")[i];
					el.innerHTML = el.getAttribute("data-odometer-final");
				}
			}
		});
	});
	//--Odometer--//

	//--Wow Animation--//
	new WOW().init();
	//--Wow Animation--//

	//--On hover img change--//
	$(document).ready(function () {
  
		//save big images
		  var $bigItem = $('.image-big-list-item');
		//save small images
		  var $smallItem = $('.image-small-list-item');
		//click and moseenter function on small image
		//you could delete one eventlistener
		  $smallItem.on('click mouseenter', function () {
			//remove active class from all items
			  $bigItem.removeClass('active');
			  $smallItem.removeClass('active');
			//add active class to item as small item's index
			  $bigItem.eq($(this).index()).addClass('active');
			  $smallItem.eq($(this).index()).addClass('active');
		  });
		
	   });
	//--On hover img change--//

	//--Preloader--//
	setTimeout(function(){
		$('.preloader__wrap').fadeToggle();
	}, 1000);
	//--Preloader--//


	

});

