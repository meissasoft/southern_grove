(function($) {
	"use strict";

    var footer = {};
    qodef.modules.footer = footer;

    footer.qodefOnWindowLoad = qodefOnWindowLoad;

    $(window).on('load', qodefOnWindowLoad);

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
    	uncoveringFooter();
    }

    function uncoveringFooter() {
        var uncoverFooter = $('body:not(.error404) .qodef-footer-uncover');

        if (uncoverFooter.length && !qodef.htmlEl.hasClass('touch')) {
            var footer = $('footer'),
                footerHeight = footer.find('.qodef-footer-inner').outerHeight(),
                content = $('.qodef-content');

            var uncoveringCalcs = function() {
                content.css('margin-bottom', footerHeight);
                footer.css('height', footerHeight);
            };
            
            //set
            uncoveringCalcs();

            $(window).resize(function(){
                //recalc
                footerHeight = footer.find('.qodef-footer-inner').outerHeight();
                uncoveringCalcs();
            });
        }
    }

})(jQuery);