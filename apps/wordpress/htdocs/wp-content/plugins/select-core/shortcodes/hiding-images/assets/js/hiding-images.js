(function($) {
    'use strict';
	
	var hidingImages = {};
	qodef.modules.hidingImages = hidingImages;

    hidingImages.qodefInitHidingImages = qodefInitHidingImages;


    hidingImages.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 ** All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
        qodefInitHidingImages();
	}

    function qodefInitHidingImages() {
        var containers = $('.qodef-hiding-images');

        if (containers.length && !qodef.htmlEl.hasClass('touch')) {
            containers.appear(function(){
                var container  = $(this);

                container.waitForImages(function(){
                    container.addClass('qodef-appeared');
                });
            },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
        }
    }

})(jQuery);

