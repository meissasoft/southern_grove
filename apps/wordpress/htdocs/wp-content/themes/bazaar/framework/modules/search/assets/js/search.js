(function($) {
    "use strict";

    var search = {};
    qodef.modules.search = search;

    search.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSearch();
    }
	
	/**
	 * Init Search Types
	 */
	function qodefSearch() {
		var searchOpener = $('a.qodef-search-opener'),
			searchForm,
			searchClose;
		
		if ( searchOpener.length > 0 ) {
			//Check for type of search
			if ( qodef.body.hasClass( 'qodef-fullscreen-search' ) ) {
				searchClose = $( '.qodef-fullscreen-search-close' );
				qodefFullscreenSearch();
				
			} else if ( qodef.body.hasClass( 'qodef-slide-from-header-bottom' ) ) {
				qodefSearchSlideFromHeaderBottom();
				
			} else if ( qodef.body.hasClass( 'qodef-search-covers-header' ) ) {
				qodefSearchCoversHeader();
				
			} else if ( qodef.body.hasClass( 'qodef-search-slides-from-window-top' ) ) {
				searchForm = $('.qodef-search-slide-window-top');
				searchClose = $('.qodef-swt-search-close');
				qodefSearchWindowTop();
			}
		}
		
		/**
		 * Fullscreen search fade
		 */
		function qodefFullscreenSearch() {
			var searchHolder = $('.qodef-fullscreen-search-holder');
			
			searchOpener.on('click',function (e) {
				e.preventDefault();
				
				if (searchHolder.hasClass('qodef-animate')) {
					qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-out');
					qodef.body.removeClass('qodef-search-fade-in');
					searchHolder.removeClass('qodef-animate');
					
					setTimeout(function () {
						searchHolder.find('.qodef-search-field').val('');
						searchHolder.find('.qodef-search-field').blur();
					}, 300);
					
					qodef.modules.common.qodefEnableScroll();
				} else {
					qodef.body.addClass('qodef-fullscreen-search-opened qodef-search-fade-in');
					qodef.body.removeClass('qodef-search-fade-out');
					searchHolder.addClass('qodef-animate');
					
					setTimeout(function () {
						searchHolder.find('.qodef-search-field').focus();
					}, 900);
					
					qodef.modules.common.qodefDisableScroll();
				}
				
				searchClose.on('click',function (e) {
					e.preventDefault();
					qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
					qodef.body.addClass('qodef-search-fade-out');
					searchHolder.removeClass('qodef-animate');
					
					setTimeout(function () {
						searchHolder.find('.qodef-search-field').val('');
						searchHolder.find('.qodef-search-field').blur();
					}, 300);
					
					qodef.modules.common.qodefEnableScroll();
				});
				
				//Close on click away
				$(document).mouseup(function (e) {
					var container = $(".qodef-form-holder-inner");
					
					if (!container.is(e.target) && container.has(e.target).length === 0) {
						e.preventDefault();
						qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
						qodef.body.addClass('qodef-search-fade-out');
						searchHolder.removeClass('qodef-animate');
						
						setTimeout(function () {
							searchHolder.find('.qodef-search-field').val('');
							searchHolder.find('.qodef-search-field').blur();
						}, 300);
						
						qodef.modules.common.qodefEnableScroll();
					}
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode == 27) { //KeyCode for ESC button is 27
						qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
						qodef.body.addClass('qodef-search-fade-out');
						searchHolder.removeClass('qodef-animate');
						
						setTimeout(function () {
							searchHolder.find('.qodef-search-field').val('');
							searchHolder.find('.qodef-search-field').blur();
						}, 300);
						
						qodef.modules.common.qodefEnableScroll();
					}
				});
			});
			
			//Text input focus change
			var inputSearchField = $('.qodef-fullscreen-search-holder .qodef-search-field'),
				inputSearchLine = $('.qodef-fullscreen-search-holder .qodef-field-holder .qodef-line');
			
			inputSearchField.focus(function () {
				inputSearchLine.css('width', '100%');
			});
			
			inputSearchField.blur(function () {
				inputSearchLine.css('width', '0');
			});
		}
		
		/**
		 * Search covers header type of search
		 */
		function qodefSearchCoversHeader() {
			searchOpener.on('click',function (e) {
				e.preventDefault();
				
				var thisSearchOpener = $(this),
					searchFormHeight,
					searchFormHeaderHolder = $('.qodef-page-header'),
					searchFormTopHeaderHolder = $('.qodef-top-bar'),
					searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.qodef-fixed-wrapper.fixed'),
					searchFormMobileHeaderHolder = $('.qodef-mobile-header'),
					searchForm = $('.qodef-search-cover'),
					searchFormIsInTopHeader = !!thisSearchOpener.parents('.qodef-top-bar').length,
					searchFormIsInFixedHeader = !!thisSearchOpener.parents('.qodef-fixed-wrapper.fixed').length,
					searchFormIsInStickyHeader = !!thisSearchOpener.parents('.qodef-sticky-header').length,
					searchFormIsInMobileHeader = !!thisSearchOpener.parents('.qodef-mobile-header').length;
				
				searchForm.removeClass('qodef-is-active');
				
				//Find search form position in header and height
				if (searchFormIsInTopHeader) {
					searchFormHeight = qodefGlobalVars.vars.qodefTopBarHeight;
					searchFormTopHeaderHolder.find('.qodef-search-cover').addClass('qodef-is-active');
					
				} else if (searchFormIsInFixedHeader) {
					searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
					searchFormHeaderHolder.children('.qodef-search-cover').addClass('qodef-is-active');
					
				} else if (searchFormIsInStickyHeader) {
					searchFormHeight = qodefGlobalVars.vars.qodefStickyHeaderHeight;
					searchFormHeaderHolder.children('.qodef-search-cover').addClass('qodef-is-active');
					
				} else if (searchFormIsInMobileHeader) {
					if(searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
						searchFormHeight = searchFormMobileHeaderHolder.children('.qodef-mobile-header-inner').outerHeight();
					} else {
						searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
					}
					
					searchFormMobileHeaderHolder.find('.qodef-search-cover').addClass('qodef-is-active');
					
				} else {
					searchFormHeight = searchFormHeaderHolder.outerHeight();
					searchFormHeaderHolder.children('.qodef-search-cover').addClass('qodef-is-active');
				}
				
				if(searchForm.hasClass('qodef-is-active')) {
					searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
				}
				
				searchForm.find('.qodef-search-close').on('click',function (e) {
					e.preventDefault();
					searchForm.stop(true).fadeOut(450);
				});
				
				searchForm.blur(function () {
					searchForm.stop(true).fadeOut(450);
				});
				
				$(window).scroll(function(){
					searchForm.stop(true).fadeOut(450);
				});
			});
		}
		
		/**
		 * Search slides from window top type of search
		 */
		function qodefSearchWindowTop() {
			searchOpener.on('click', function(e) {
				e.preventDefault();
				
				if ( searchForm.height() == "0") {
					$('.qodef-search-slide-window-top input[type="text"]').focus();
					//Push header bottom
					qodef.body.addClass('qodef-search-open');
				} else {
					qodef.body.removeClass('qodef-search-open');
				}
				
				$(window).scroll(function() {
					if ( searchForm.height() != '0' && qodef.scroll > 50 ) {
						qodef.body.removeClass('qodef-search-open');
					}
				});
				
				searchClose.on('click',function(e){
					e.preventDefault();
					qodef.body.removeClass('qodef-search-open');
				});
			});
		}
		
		/**
		 * Search slide from header bottom type of search
		 */
		function qodefSearchSlideFromHeaderBottom() {
			searchOpener.on('click', function(e) {
				e.preventDefault();
				
				var thisSearchOpener = $(this),
					searchIconPosition = parseInt(qodef.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());
				
				if(qodef.body.hasClass('qodef-boxed') && qodef.windowWidth > 1024) {
					searchIconPosition -= parseInt((qodef.windowWidth - $('.qodef-boxed .qodef-wrapper .qodef-wrapper-inner').outerWidth()) / 2);
				}
				
				var searchFormHeaderHolder = $('.qodef-page-header'),
					searchFormTopOffset = '100%',
					searchFormTopHeaderHolder = $('.qodef-top-bar'),
					searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.qodef-fixed-wrapper.fixed'),
					searchFormMobileHeaderHolder = $('.qodef-mobile-header'),
					searchForm = $('.qodef-slide-from-header-bottom-holder'),
					searchFormIsInTopHeader = !!thisSearchOpener.parents('.qodef-top-bar').length,
					searchFormIsInFixedHeader = !!thisSearchOpener.parents('.qodef-fixed-wrapper.fixed').length,
					searchFormIsInStickyHeader = !!thisSearchOpener.parents('.qodef-sticky-header').length,
					searchFormIsInMobileHeader = !!thisSearchOpener.parents('.qodef-mobile-header').length;
				
				searchForm.removeClass('qodef-is-active');
				
				//Find search form position in header and height
				if (searchFormIsInTopHeader) {
					searchFormTopHeaderHolder.find('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');
					
				} else if (searchFormIsInFixedHeader) {
					searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + qodefGlobalVars.vars.qodefAddForAdminBar;
					searchFormHeaderHolder.children('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');
					
				} else if (searchFormIsInStickyHeader) {
					searchFormTopOffset = qodefGlobalVars.vars.qodefStickyHeaderHeight + qodefGlobalVars.vars.qodefAddForAdminBar;
					searchFormHeaderHolder.children('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');
					
				} else if (searchFormIsInMobileHeader) {
					if(searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
						searchFormTopOffset = searchFormMobileHeaderHolder.children('.qodef-mobile-header-inner').outerHeight() + qodefGlobalVars.vars.qodefAddForAdminBar;
					}
					searchFormMobileHeaderHolder.find('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');
					
				} else {
					searchFormHeaderHolder.children('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');
				}
				
				if(searchForm.hasClass('qodef-is-active')) {
					searchForm.css({'right': searchIconPosition, 'top': searchFormTopOffset}).stop(true).slideToggle(300, 'easeOutBack');
				}
				
				//Close on escape
				$(document).keyup(function(e){
					if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
						searchForm.stop(true).fadeOut(0);
					}
				});
				
				$(window).scroll(function(){
					searchForm.stop(true).fadeOut(0);
				});
			});
		}
	}

})(jQuery);
