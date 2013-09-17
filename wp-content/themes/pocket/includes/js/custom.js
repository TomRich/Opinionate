jQuery(document).ready(function( $ ) { 
	
		//Add JS class to html
		$("html").addClass("js");

		//Search Toggle
		$(".search-toggle").click(function () {
			$(".header-search-form,.nav-toggle").toggle();
			$(".search-toggle .icon-remove,.search-toggle .icon-search").toggle();
			$(".header-search-form input").focus();
			return false;
		});
		
		//FitVids
		$(".fitvid").fitVids();	
	
		//Comment Toggle
		if ((custom_js_vars.toggle_comments) == 'toggle') { 
			$(".comments-wrap").hide();
			
			$("#comments-title").addClass("comment-toggle");

			//Scroll to Comment Reply
			if ( document.location.href.indexOf('#comment') > -1 ) {
		        $(".comments-wrap").show();

		        var $root = $('html, body');
			    var ancloc = window.location.hash;
			    event.preventDefault();
			        $root.animate({
			            scrollTop: $(ancloc).offset().top
			        }, 500, function () {
			            window.location.hash = href;
			        });
			        return false;
			}

			//Toggle Comments
			$("#comments-title").click(function () {
				$(".comments-wrap").slideToggle();
				
				$('html, body').animate({
	                scrollTop: $(".comments-wrap").offset().top
	            }, 500);
				
				return false;
			});
		}
		
		//Responsive Menu
		$('.nav').mobileMenu();
				
        $('select.select-menu').each(function(){
            var title = $(this).attr('title');
            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
            $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="select">' + title + '</span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                    })
        });

        /* Run Fitvid on Infinite Scroll */
        $( document.body ).on( 'post-load', function () {
			$(".fitvid").fitVids();
		});
});