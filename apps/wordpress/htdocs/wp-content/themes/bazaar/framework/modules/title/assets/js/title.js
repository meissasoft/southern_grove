(function($) {
    "use strict";

    var title = {};
    qodef.modules.title = title;

    title.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
	function qodefParallaxTitle() {
		var parallaxBackground = $('.qodef-title-holder.qodef-bg-parallax');
		
		if (parallaxBackground.length > 0 && qodef.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = $('.qodef-title-holder.qodef-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(qodef.scroll * parallaxRate),
                adminBarHeight = qodefGlobalVars.vars.qodefAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - qodef.scroll + 'px auto'});
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(qodef.scroll * parallaxYPos);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - qodef.scroll + 'px auto'});
			});
		}
	}

})(jQuery);
