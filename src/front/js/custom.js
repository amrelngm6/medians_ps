
function shuffleArray(array) 
{
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}



jQuery(document).ready(function (e) {

	jQuery(document).on('click', '.navbar-item', function(){
		jQuery('.navbar-item').removeClass('active')
		jQuery(this).addClass('active')
	})

	jQuery(document).on('click', '.arrow', function(e)
	{
		var box = $(".box-inner"), x;
		if ($(this).hasClass("arrow-r")) {
			x = ((box.width() / 2)) + box.scrollLeft();
			box.animate({ scrollLeft: x })
		} else {
			x = ((box.width() / 2)) - box.scrollLeft();
			box.animate({ scrollLeft: -x })
		}
	});

	jQuery(document).on('click', '#show-menu', function(e){
		jQuery('#mobile-menu').addClass('show');
		
		window.scrollY > 490
		? jQuery('.fixed-on-scroll').addClass('fixed').removeClass('absolute')
		: jQuery('.fixed-on-scroll').addClass('absolute').removeClass('fixed')
	});
	jQuery(document).on('click', '#close-menu', function(e){
		jQuery('#mobile-menu').removeClass('show');
	});

	jQuery(document).on('click', '.switch-accordion', function(e){
		jQuery(this).find('ul').toggleClass('hidden');
	});

	jQuery(document).on('click', '.switch-icons-border', function(e){
		// jQuery(this).find('img').removeClass('border-purple-400');
		// jQuery(this).parent('div').find('label').find('img').removeClass('border-purple-400');
		jQuery(this).parent().find('img').removeClass('border-purple-400');
		jQuery(this).find('img').addClass('border-purple-400');
		console.log(jQuery(this).find('img').attr('class'))
	});

	jQuery(document).on('change', '.switch-view', function(e){
		jQuery('#'+jQuery(this).data('target')).toggleClass('hidden');
	});

	jQuery(document).on('click', '#switch-cat>div', function(e){
		var html = '';
		var arr = JSON.parse(jQuery(this).attr('data-childs'));
		
		for (var i = arr.length - 1; i >= 0; i--) {
			if (arr[i])
			{
				let title = arr[i].content ? arr[i].content.title : arr[i];
				let link = arr[i].content ? arr[i].content.prefix : 'javascript:;';
				html += '<a class="lg:inline-block block lg:mx-2 my-2 py-2 px-4 lightcyan-bg font-semibold purple-color border border-purple-400 rounded-lg" href="'+link+'">'+title+'</a>';
			}
		}

		jQuery('#cat-content').html(html)
	});

	jQuery(document).on('click', '.switch-child-ul', function(e){
		jQuery(this).find('ul').toggleClass('hidden');
	});

	jQuery(document).on('submit', 'form', function(){

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
		    	(res.error ) 
		    		? Swal.fire('Error!',res.result, 'error')
		    		: (Swal.fire(res.title,res.result,  'success'), form.reset());

				setTimeout(function(){
					if (res.redirect)
					{
						window.location.href = res.redirect;
					}
				}, 1000);	

		    } else {
		  		Swal.fire('Error!','Connection error','error')
		    }
		};
		xhr.send(new URLSearchParams(formData).toString());
	})



	
	jQuery(document).on('click', '#modal-bg', function(e) {
		jQuery('#modal-wrapper').addClass('hidden')
		jQuery('#modal-content').html(' ')
	})
	jQuery(document).on('click', '.show-modal-iframe', function(e) {
		jQuery('#modal-wrapper').removeClass('hidden')
		var link = "https://www.youtube.com/embed/"+jQuery(this).data('youtube-link');
		var iframe = document.createElement('iframe');
		iframe.frameBorder=0;
		iframe.width="100%";
		iframe.height="100%";
		iframe.id="v-"+jQuery(this).data('youtube-link');
		iframe.setAttribute("src", link);
		document.getElementById("modal-content").appendChild(iframe);
	})
	jQuery(document).on('click', '.show-modal-picture', function(e) {
		jQuery('#modal-wrapper').removeClass('hidden')
		var link = jQuery(this).data('picture-link');
		var iframe = document.createElement('img');
		iframe.setAttribute("src", link);
		document.getElementById("modal-content").appendChild(iframe);
	})
	// body...
	$('.owl-carousel').owlCarousel({
		loop:true,
		margin:10,
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:3,
				nav:false
			},
			1000:{
				items:4,
				nav:true,
				loop:true
			}
		}
	});

	jQuery.get( "/src/assets/countries.json", function( data ) {
		
		// data.sort((a, b) => a.dial_code.localeCompare(b.dial_code));
		var newdata = '';

		/* Remove all options from the select list */
		$('#countrieslist').empty();
		
		let selected;
		for (let i = 0; i < data.length; i++) {
			selected = data[i].code == 'EG' ? 'selected' : '';
			newdata += '<option value="'+data[i].dial_code+'" '+selected+' >'+data[i].name +" "+ data[i].dial_code   +'</option>' ;
		}

		$('#countrieslist').html(newdata);
	});

	jQuery('body').on('change', '#countrieslist', function(e){
		jQuery('#countrieslist-code').val(e.target.value);
	});
		
	jQuery('body').on('scroll', function(){
		alert(1)
	});


});

document.addEventListener("DOMContentLoaded", function() {
	// Function to lazy load iframes when they come into view
	function lazyLoadIframes() {
		var lazyIframes = document.querySelectorAll(".lazy-iframe");
		lazyIframes.forEach(function(iframe) {
			if (isInViewport(iframe)) {
				iframe.setAttribute("src", iframe.getAttribute("data-src"));
				iframe.classList.remove("lazy-iframe");
			}
		});
	}

	// Function to check if an element is in the viewport
	function isInViewport(element) {
		var rect = element.getBoundingClientRect();
		return (
			rect.top >= 0 &&
			rect.left >= 0 &&
			rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
			rect.right <= (window.innerWidth || document.documentElement.clientWidth)
		);
	}

	// Lazy load iframes when the page is scrolled
	window.addEventListener("scroll", lazyLoadIframes);
	window.addEventListener("resize", lazyLoadIframes);
	window.addEventListener("orientationchange", lazyLoadIframes);
	window.onload = lazyLoadIframes; // Load iframes when the page finishes loading
});