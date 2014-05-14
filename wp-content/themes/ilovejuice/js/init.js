$(document).ready(function() {
	//hide all the images except the first one   
    $("#index-photos img:gt(0)").hide();

    setInterval(function() {
        //get the current image - it is the visible one
        var current = $('#index-photos img:visible');

        //get immediate next image after the current if exists, otherwise find the first one)
        var next = current.next().length ? current.next() : $('#index-photos img:eq(0)');
        //hide the current image
        current.fadeOut(2000);
        //show the next one
        next.fadeIn(2000);
    }, 7500);
    
	$(".fancybox").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'inside',
	            position: 'bottom'
			},
			thumbs	: {
				width	: 64,
				height	: 64
			}
		},
		beforeLoad: function() {
            var el, id = $(this.element).data('title-id');

            if (id) {
                el = $('#' + id);
            
                if (el.length) {
                    this.title = el.html();
                }
            }
        }
	});
	
	
	var iframe = $('.single-post .entry-content iframe').first();
	
	if (iframe.length > 0) {
		$('.single-post .entry-thumbnail').empty();
//		iframe.attr('width', '100%');
//		iframe.attr('height', '160');
		$('.single-post .entry-thumbnail').append(iframe);
	}

	$(window).scroll(function() {
		if ($(this).scrollTop() > 300) {
			$('.page-scroller.scrollup').fadeIn('slow');
		} else {
			$('.page-scroller.scrollup').fadeOut('slow');
		}
	});

	$('.scrollup').click(function() {
		$("html, body").animate({
			scrollTop : 0
		}, 600);
		return false;
	});
	
	
	$("#popup-contact-form").click(function(e){
		
		var form = $(this).parents('form');
		var parsley = form.parsley();
		
		parsley.asyncValidate()
	      .done(function () { 
	    	  if (parsley.isValid()) {
	    		  e.preventDefault();
	    		  form.hide();
	    		  $('#form-sent-info').show('slow');
	    	  }
	      })
	      .fail(function () { })
	      .always(function () { });
	});

	$("#modal-captcha-refresh").click(function(event){
		event.preventDefault();
		d = new Date();
		$("#modal-captcha-image").attr("src", "/captcha.php?"+d.getTime());
	});
	
	
	var request;
	$("#modal-contact-form").submit(function(event){

		// abort any pending request
	    if (request) {
	        request.abort();
	    }
	    // setup some local variables
	    var $form = $(this);
	    // let's select and cache all the fields
	    var $inputs = $form.find("input, select, button, textarea");
	    // serialize the data in the form
	    var serializedData = $form.serialize();

	    // let's disable the inputs for the duration of the ajax request
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    $inputs.prop("disabled", true);

	    // fire off the request to /form.php
	    request = $.ajax({
	        url: "/form.php",
	        type: "post",
	        data: serializedData
	    });

	    // callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // log a message to the console
	        console.log("Hooray, it worked!");
	    });

	    // callback handler that will be called on failure
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        // log the error to the console
	        console.error(
	            "The following error occured: "+
	            textStatus, errorThrown
	        );
	    });

	    // callback handler that will be called regardless
	    // if the request failed or succeeded
	    request.always(function () {
	        // reenable the inputs
	        $inputs.prop("disabled", false);
	    });

	    // prevent default posting of form
	    event.preventDefault();
	});
	
});
