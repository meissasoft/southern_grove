(function($) {
    "use strict";

    var sidearea = {};
    qodef.modules.sidearea = sidearea;

    sidearea.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSideArea();
	    qodefSideAreaScroll();
    }
	
	/**
	 * Show/hide side area
	 */
	function qodefSideArea() {
		var wrapper = $('.qodef-wrapper'),
			sideMenuButtonOpen = $('a.qodef-side-menu-button-opener'),
			cssClass = 'qodef-right-side-menu-opened';
		
		wrapper.prepend('<div class="qodef-cover"/>');
		
		$('a.qodef-side-menu-button-opener, a.qodef-close-side-menu').on('click', function(e) {
			e.preventDefault();
			
			if(!sideMenuButtonOpen.hasClass('opened')) {
				sideMenuButtonOpen.addClass('opened');
				qodef.body.addClass(cssClass);
				
				$('.qodef-wrapper .qodef-cover').on('click',function() {
					qodef.body.removeClass('qodef-right-side-menu-opened');
					sideMenuButtonOpen.removeClass('opened');
				});
				
				var currentScroll = $(window).scrollTop();
				$(window).scroll(function() {
					if(Math.abs(qodef.scroll - currentScroll) > 400){
						qodef.body.removeClass(cssClass);
						sideMenuButtonOpen.removeClass('opened');
					}
				});
			} else {
				sideMenuButtonOpen.removeClass('opened');
				qodef.body.removeClass(cssClass);
			}
		});
	}
	
	/*
	 **  Smooth scroll functionality for Side Area
	 */
	function qodefSideAreaScroll(){
		var sideMenu = $('.qodef-side-menu');
		
		if(sideMenu.length){
            sideMenu.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
		}
	}

})(jQuery);
