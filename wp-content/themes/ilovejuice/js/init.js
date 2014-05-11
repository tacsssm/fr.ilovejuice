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
});
