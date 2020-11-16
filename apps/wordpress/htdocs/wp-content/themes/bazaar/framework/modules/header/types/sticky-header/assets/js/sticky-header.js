(function($) {
    "use strict";

    var stickyHeader = {};
    qodef.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    if(qodef.windowWidth > 1024) {
		    qodefHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function qodefHeaderBehaviour() {
        var header = $('.qodef-page-header'),
	        stickyHeader = $('.qodef-sticky-header'),
            fixedHeaderWrapper = $('.qodef-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.qodef-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.qodef-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;
        
        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - qodefGlobalVars.vars.qodefAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-up'):
                qodef.modules.stickyHeader.behaviour = 'qodef-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(qodefGlobalVars.vars.qodefTopBarHeight) + parseInt(qodefGlobalVars.vars.qodefLogoAreaHeight) + parseInt(qodefGlobalVars.vars.qodefMenuAreaHeight) + parseInt(qodefGlobalVars.vars.qodefStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        qodef.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .second').removeClass('qodef-drop-down-start');
                        qodef.body.removeClass('qodef-sticky-header-appear');
                    } else {
                        qodef.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    qodef.body.addClass('qodef-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-down-up'):
                qodef.modules.stickyHeader.behaviour = 'qodef-sticky-header-on-scroll-down-up';

                if(qodefPerPageVars.vars.qodefStickyScrollAmount !== 0){
                    qodef.modules.stickyHeader.stickyAppearAmount = parseInt(qodefPerPageVars.vars.qodefStickyScrollAmount);
                } else {
                    qodef.modules.stickyHeader.stickyAppearAmount = parseInt(qodefGlobalVars.vars.qodefTopBarHeight) + parseInt(qodefGlobalVars.vars.qodefLogoAreaHeight) + parseInt(qodefGlobalVars.vars.qodefMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(qodef.scroll < qodef.modules.stickyHeader.stickyAppearAmount) {
                        qodef.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .second').removeClass('qodef-drop-down-start');
	                    qodef.body.removeClass('qodef-sticky-header-appear');
                    }else{
                        qodef.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    qodef.body.addClass('qodef-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case qodef.body.hasClass('qodef-fixed-on-scroll'):
                qodef.modules.stickyHeader.behaviour = 'qodef-fixed-on-scroll';
                var headerFixed = function(){
	
	                if(qodef.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                qodef.body.removeClass('qodef-fixed-header-appear');
		                fixedMenuArea.css({'height': fixedMenuAreaHeight + 'px'});
		                header.css('margin-bottom', '0');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                qodef.body.addClass('qodef-fixed-header-appear');
		                fixedMenuArea.css({'height': (fixedMenuAreaHeight - 30) + 'px'});
		                header.css('margin-bottom', (fixedMenuAreaHeight - 30) + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);