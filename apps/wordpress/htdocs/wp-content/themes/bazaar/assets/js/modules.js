(function($) {
    "use strict";

    window.qodef = {};
    qodef.modules = {};

    qodef.scroll = 0;
    qodef.window = $(window);
    qodef.document = $(document);
    qodef.windowWidth = $(window).width();
    qodef.windowHeight = $(window).height();
    qodef.body = $('body');
    qodef.html = $('html, body');
    qodef.htmlEl = $('html');
    qodef.menuDropdownHeightSet = false;
    qodef.defaultHeaderStyle = '';
    qodef.minVideoWidth = 1500;
    qodef.videoWidthOriginal = 1280;
    qodef.videoHeightOriginal = 720;
    qodef.videoRatio = 1.61;

    qodef.qodefOnDocumentReady = qodefOnDocumentReady;
    qodef.qodefOnWindowLoad = qodefOnWindowLoad;
    qodef.qodefOnWindowResize = qodefOnWindowResize;
    qodef.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodef.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(qodef.body.hasClass('qodef-dark-header')){ qodef.defaultHeaderStyle = 'qodef-dark-header';}
        if(qodef.body.hasClass('qodef-light-header')){ qodef.defaultHeaderStyle = 'qodef-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodef.windowWidth = $(window).width();
        qodef.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
        qodef.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case qodef.body.hasClass('qodef-grid-1300'):
            qodef.boxedLayoutWidth = 1350;
            break;
        case qodef.body.hasClass('qodef-grid-1200'):
            qodef.boxedLayoutWidth = 1250;
            break;
        case qodef.body.hasClass('qodef-grid-1000'):
            qodef.boxedLayoutWidth = 1050;
            break;
        case qodef.body.hasClass('qodef-grid-800'):
            qodef.boxedLayoutWidth = 850;
            break;
        default :
            qodef.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function ($) {
    "use strict";

    var common = {};
    qodef.modules.common = common;

    common.qodefFluidVideo = qodefFluidVideo;
    common.qodefEnableScroll = qodefEnableScroll;
    common.qodefDisableScroll = qodefDisableScroll;
    common.qodefOwlSlider = qodefOwlSlider;
    common.qodefInitParallax = qodefInitParallax;
    common.qodefInitSelfHostedVideoPlayer = qodefInitSelfHostedVideoPlayer;
    common.qodefSelfHostedVideoSize = qodefSelfHostedVideoSize;
    common.qodefPrettyPhoto = qodefPrettyPhoto;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;

    common.qodefOnDocumentReady = qodefOnDocumentReady;
    common.qodefOnWindowLoad = qodefOnWindowLoad;
    common.qodefOnWindowResize = qodefOnWindowResize;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefIconWithHover().init();
        qodefIEversion();
        qodefDisableSmoothScrollForMac();
        qodefInitAnchor().init();
        qodefInitBackToTop();
        qodefBackButtonShowHide();
        qodefInitSelfHostedVideoPlayer();
        qodefSelfHostedVideoSize();
        qodefFluidVideo();
        qodefOwlSlider();
        qodefPreloadBackgrounds();
        qodefPrettyPhoto();
        qodefSearchPostTypeWidget();
        qodeBackToTopSkin();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitParallax();
        qodefParallaxElements();
        qodefSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefSelfHostedVideoSize();
    }

    /*
     * IE version
     */
    function qodefIEversion() {
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0) {
            var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            qodef.body.addClass('qodef-ms-ie' + version);
        }
        return false;
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function qodefDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && qodef.body.hasClass('qodef-smooth-scroll')) {
            qodef.body.removeClass('qodef-smooth-scroll');
        }
    }

    function qodefDisableScroll() {
        if (window.addEventListener) {
            window.addEventListener('wheel', qodefWheel, {passive: false});
        }

        window.onmousewheel = document.onmousewheel = qodefWheel;
        document.onkeydown = qodefKeydown;
    }

    function qodefEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('wheel', qodefWheel, {passive: false});
        }

        window.onmousewheel = document.onmousewheel = document.onkeydown = null;
    }

    function qodefWheel(e) {
        qodefPreventDefaultValue(e);
    }

    function qodefKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                qodefPreventDefaultValue(e);
                return;
            }
        }
    }

    function qodefPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    /*
     **	Anchor functionality
     */
    var qodefInitAnchor = function () {
        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function (anchor) {

            var headers = $('.qodef-main-menu, .qodef-mobile-nav, .qodef-fullscreen-menu');

            headers.each(function () {
                var currentHeader = $(this);

                if (anchor.parents(currentHeader).length) {
                    currentHeader.find('.qodef-active-item').removeClass('qodef-active-item');
                    anchor.parent().addClass('qodef-active-item');

                    currentHeader.find('a').removeClass('current');
                    anchor.addClass('current');
                }
            });
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function () {

            $('[data-qodef-anchor]').waypoint(function (direction) {
                if (direction === 'down') {
                    setActiveState($("a[href='" + window.location.href.split('#')[0] + "#" + $(this.element).data("qodef-anchor") + "']"));
                }
            }, {offset: '50%'});

            $('[data-qodef-anchor]').waypoint(function (direction) {
                if (direction === 'up') {
                    setActiveState($("a[href='" + window.location.href.split('#')[0] + "#" + $(this.element).data("qodef-anchor") + "']"));
                }
            }, {
                offset: function () {
                    return -($(this.element).outerHeight() - 150);
                }
            });

        };

        /**
         * Check anchor active state on load
         */
        var checkActiveStateOnLoad = function () {
            var hash = window.location.hash.split('#')[1];

            if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0) {
                anchorClickOnLoad(hash);
            }
        };

        /**
         * Handle anchor on load
         */
        var anchorClickOnLoad = function ($this) {
            var scrollAmount;
            var anchor = $('a');
            var hash = $this;
            if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0) {
                var anchoredElementOffset = $('[data-qodef-anchor="' + hash + '"]').offset().top;
                scrollAmount = $('[data-qodef-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - qodefGlobalVars.vars.qodefAddForAdminBar;

                setActiveState(anchor);

                qodef.html.stop().animate({
                    scrollTop: Math.round(scrollAmount)
                }, 800, 'easeInOutQuad', function () {
                    //change hash tag in url
                    if (history.pushState) {
                        history.pushState(null, null, '#' + hash);
                    }
                });
                return false;
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function (anchoredElementOffset) {

            if (qodef.modules.stickyHeader.behaviour === 'qodef-sticky-header-on-scroll-down-up') {
                qodef.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > qodef.modules.header.stickyAppearAmount);
            }

            if (qodef.modules.stickyHeader.behaviour === 'qodef-sticky-header-on-scroll-up') {
                if ((anchoredElementOffset > qodef.scroll)) {
                    qodef.modules.stickyHeader.isStickyVisible = false;
                }
            }

            var headerHeight = qodef.modules.stickyHeader.isStickyVisible ? qodefGlobalVars.vars.qodefStickyHeaderTransparencyHeight : qodefPerPageVars.vars.qodefHeaderTransparencyHeight;

            if (qodef.windowWidth < 1025) {
                headerHeight = 0;
            }

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function () {
            qodef.document.on("click", ".qodef-main-menu a, .qodef-fullscreen-menu a, .qodef-btn, .qodef-anchor, .qodef-mobile-nav a", function () {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0) {

                    var anchoredElementOffset = $('[data-qodef-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-qodef-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - qodefGlobalVars.vars.qodefAddForAdminBar;

                    setActiveState(anchor);

                    qodef.html.stop().animate({
                        scrollTop: Math.round(scrollAmount)
                    }, 1000, function () {
                        //change hash tag in url
                        if (history.pushState) {
                            history.pushState(null, null, '#' + hash);
                        }
                    });
                    return false;
                }
            });
        };

        return {
            init: function () {
                if ($('[data-qodef-anchor]').length) {
                    anchorClick();
                    checkActiveStateOnScroll();
                    $(window).on('load', function () {
                        checkActiveStateOnLoad();
                    });
                }
            }
        };
    };

    function qodefInitBackToTop() {
        var backToTopButton = $('#qodef-back-to-top');
        backToTopButton.on('click', function (e) {
            e.preventDefault();
            qodef.html.animate({scrollTop: 0}, qodef.window.scrollTop() / 4, 'easeInOutCubic');
        });
    }

    function qodefBackButtonShowHide() {
        qodef.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) {
                d = b + c / 2;
            } else {
                d = 1;
            }
            if (d < 1e3) {
                qodefToTopButton('off');
            } else {
                qodefToTopButton('on');
            }
        });
    }

    function qodefToTopButton(a) {
        var b = $("#qodef-back-to-top");
        b.removeClass('off on');
        if (a === 'on') {
            b.addClass('on');
        } else {
            b.addClass('off');
        }
    }

    function qodeBackToTopSkin() {
        var btt = $('#qodef-back-to-top'),
            footer = $('footer'),
            contentInner = $('.qodef-content-inner'),
            skinSet = false;

        var bttSetSkin = function () {
            if (!skinSet) {
                btt.addClass('qodef-btt-light');
                skinSet = true;
            }
        }

        var bttUnsetSkin = function () {
            if (skinSet) {
                btt.removeClass('qodef-btt-light');
                skinSet = false;
            }
        }

        var changeBttSkinDefault = function () {
            if (btt.offset().top + btt.height() >= footer.offset().top) {
                bttSetSkin();
            } else {
                bttUnsetSkin();
            }
        }

        var changeBttSkinUncover = function () {
            if (btt.offset().top + btt.height() >= contentInner.offset().top + contentInner.height()) {
                bttSetSkin();
            } else {
                bttUnsetSkin();
            }
        }

        if (btt.length && footer.length && !qodef.htmlEl.hasClass('touch')) {
            if (!footer.hasClass('qodef-footer-uncover')) {
                $(window).scroll(function () {
                    changeBttSkinDefault();
                });
            } else {
                $(window).scroll(function () {
                    changeBttSkinUncover();
                });
            }
        }
    }

    function qodefInitSelfHostedVideoPlayer() {
        var players = $('.qodef-self-hosted-video');

        if (players.length) {
            players.mediaelementplayer({
                audioWidth: '100%'
            });
        }
    }

    function qodefSelfHostedVideoSize() {
        var selfVideoHolder = $('.qodef-self-hosted-video-holder .qodef-video-wrap');

        if (selfVideoHolder.length) {
            selfVideoHolder.each(function () {
                var thisVideo = $(this),
                    videoWidth = thisVideo.closest('.qodef-self-hosted-video-holder').outerWidth(),
                    videoHeight = videoWidth / qodef.videoRatio;

                if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
                    thisVideo.parent().width(videoWidth);
                    thisVideo.parent().height(videoHeight);
                }

                thisVideo.width(videoWidth);
                thisVideo.height(videoHeight);

                thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
                thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
            });
        }
    }

    function qodefFluidVideo() {
        fluidvids.init({
            selector: ['iframe'],
            players: ['www.youtube.com', 'player.vimeo.com']
        });
    }

    function qodefSmoothTransition() {

        if (qodef.body.hasClass('qodef-smooth-page-transitions')) {

            //check for preload animation
            if (qodef.body.hasClass('qodef-smooth-page-transitions-preloader')) {
                var loader = $('body > .qodef-smooth-transition-loader.qodef-mimic-ajax');
                loader.fadeOut(300, 'easeInOutQuad');

                $(window).on('pageshow', function (event) {
                    if (event.originalEvent.persisted) {
                        loader.fadeOut(300, 'easeInOutQuad');
                    }
                });
            }
	
	        // if back button is pressed, than reload page to avoid state where content is on display:none
         
	        window.addEventListener( "pageshow", function ( event ) {
		        var historyPath = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
		        if ( historyPath ) {
			        window.location.reload();
		        }
	        });
	
	
	        //check for fade out animation
            if (qodef.body.hasClass('qodef-smooth-page-transitions-fadeout')) {
                var linkItem = $('a');

                linkItem.on('click', function (e) {
                    var a = $(this);

                    if ((a.parents('.qodef-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
                        return;
                    }

                    if (
                        e.which === 1 && // check if the left mouse button has been pressed
                        a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
                        (typeof a.data('rel') === 'undefined') && //Not pretty photo link
                        (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (!a.hasClass('lightbox-active')) && //Not lightbox plugin active
                        (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                        (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                    ) {
                        e.preventDefault();
                        $('.qodef-wrapper-inner').fadeOut(1000, function () {
                            window.location = a.attr('href');
                        });
                    }
                });
            }
        }
    }

    /*
     *	Preload background images for elements that have 'qodef-preload-background' class
     */
    function qodefPreloadBackgrounds() {
        var preloadBackHolder = $('.qodef-preload-background');

        if (preloadBackHolder.length) {
            preloadBackHolder.each(function () {
                var preloadBackground = $(this);

                if (preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
                    var bgUrl = preloadBackground.attr('style');

                    bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                    bgUrl = bgUrl ? bgUrl[1] : "";

                    if (bgUrl) {
                        var backImg = new Image();
                        backImg.src = bgUrl;
                        $(backImg).load(function () {
                            preloadBackground.removeClass('qodef-preload-background');
                        });
                    }
                } else {
                    $(window).on('load', function () {
                        preloadBackground.removeClass('qodef-preload-background');
                    }); //make sure that qodef-preload-background class is removed from elements with forced background none in css
                }
            });
        }
    }

    function qodefPrettyPhoto() {
        /*jshint multistr: true */
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    function qodefSearchPostTypeWidget() {
        var searchPostTypeHolder = $('.qodef-search-post-type');

        if (searchPostTypeHolder.length) {
            searchPostTypeHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.qodef-post-type-search-field'),
                    resultsHolder = thisSearch.siblings('.qodef-post-type-search-results'),
                    searchLoading = thisSearch.find('.qodef-search-loading'),
                    searchIcon = thisSearch.find('.qodef-search-icon');

                searchLoading.addClass('qodef-hidden');

                var postType = thisSearch.data('post-type'),
                    keyPressTimeout;

                searchField.on('keyup paste', function (e) {
                    var field = $(this);
                    field.attr('autocomplete', 'off');
                    searchLoading.removeClass('qodef-hidden');
                    searchIcon.addClass('qodef-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout(function () {
                        var searchTerm = field.val();
                        if (searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('qodef-hidden');
                            searchIcon.removeClass('qodef-hidden');
                        } else {
                            var ajaxData = {
                                action: 'bazaar_qodef_search_post_types',
                                term: searchTerm,
                                postType: postType,
	                            search_post_types_nonce: $('input[name="qodef_search_post_types_nonce"]').val()
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: qodefGlobalVars.vars.qodefAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status === 'success') {
                                        searchLoading.addClass('qodef-hidden');
                                        searchIcon.removeClass('qodef-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('qodef-hidden');
                                    searchIcon.removeClass('qodef-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('qodef-hidden');
                    searchIcon.removeClass('qodef-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }
    }

    /**
     * Initializes load more data params
     * @param container with defined data params
     * return array
     */
    function getLoadMoreData(container) {
        var dataList = container.data(),
            returnValue = {};

        for (var property in dataList) {
            if (dataList.hasOwnProperty(property)) {
                if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
                    returnValue[property] = dataList[property];
                }
            }
        }

        return returnValue;
    }

    /**
     * Sets load more data params for ajax function
     * @param container with defined data params
     * return array
     */
    function setLoadMoreAjaxData(container, action) {
        var returnValue = {
            action: action
        };

        for (var property in container) {
            if (container.hasOwnProperty(property)) {

                if (typeof container[property] !== 'undefined' && container[property] !== false) {
                    returnValue[property] = container[property];
                }
            }
        }

        return returnValue;
    }

    /**
     * Object that represents icon with hover data
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var qodefIconWithHover = function () {
        //get all icons on page
        var icons = $('.qodef-icon-has-hover');

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var hoverColor = icon.data('hover-color'),
                    originalColor = icon.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        iconHoverColor($(this));
                    });
                }
            }
        };
    };

    /*
     ** Init parallax
     */
    function qodefInitParallax() {
        var parallaxHolder = $('.qodef-parallax-row-holder');

        if (parallaxHolder.length) {
            parallaxHolder.each(function () {
                var parallaxElement = $(this),
                    image = parallaxElement.data('parallax-bg-image'),
                    speed = parallaxElement.data('parallax-bg-speed') * 0.4,
                    height = 0;

                if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
                    height = parseInt(parallaxElement.data('parallax-bg-height'));
                }

                parallaxElement.css({'background-image': 'url(' + image + ')'});

                if (height > 0) {
                    parallaxElement.css({'min-height': height + 'px', 'height': height + 'px'});
                }

                parallaxElement.parallax('50%', speed);
            });
        }
    }

    /**
     * Init Owl Carousel
     */
    function qodefOwlSlider() {
        var sliders = $('.qodef-owl-slider');

        if (sliders.length) {
            sliders.each(function () {
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    numberOfItems = 1,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = true,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 600,
                    margin = 0,
                    responsiveMargin = 0,
                    stagePadding = 0,
                    stagePaddingEnabled = false,
                    center = false,
                    autoWidth = false,
                    animateInClass = false, // keyframe css animation
                    animateOut = false, // keyframe css animation
                    navigation = true,
                    pagination = false,
                    sliderIsPortfolio = !!slider.hasClass('qodef-pl-is-slider'),
                    sliderDataHolder = sliderIsPortfolio ? slider.parent() : slider;  // this is condition for portfolio slider

                if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && !sliderIsPortfolio) {
                    numberOfItems = slider.data('number-of-items');
                }
                if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsPortfolio) {
                    numberOfItems = sliderDataHolder.data('number-of-columns');
                }
                if (sliderDataHolder.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (sliderDataHolder.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
                    autoplayHoverPause = false;
                }
                if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
                    sliderSpeed = sliderDataHolder.data('slider-speed');
                }
                if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
                }
                if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
                    margin = sliderDataHolder.data('slider-margin');
                }
                if (slider.parent().hasClass('qodef-normal-space')) {
                    margin = 30;
                } else if (slider.parent().hasClass('qodef-small-space')) {
                    margin = 20;
                } else if (slider.parent().hasClass('qodef-tiny-space')) {
                    margin = 10;
                }
                if (sliderDataHolder.data('slider-padding') === 'yes') {
                    stagePaddingEnabled = true;
                    stagePadding = parseInt(slider.outerWidth() * 0.28);
                    margin = 50;
                }
                if (sliderDataHolder.data('enable-center') === 'yes') {
                    center = true;
                }
                if (sliderDataHolder.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
                    animateInClass = sliderDataHolder.data('slider-animate-in');
                }
                if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOut = sliderDataHolder.data('slider-animate-out');
                }
                if (sliderDataHolder.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (sliderDataHolder.data('enable-pagination') === 'yes') {
                    pagination = true;
                }

                if (navigation && pagination) {
                    slider.addClass('qodef-slider-has-both-nav');
                }

                if (slideItemsNumber <= 1) {
                    loop = false;
                    autoplay = false;
                    navigation = false;
                    pagination = false;
                }

                var responsiveNumberOfItems1 = 1,
                    responsiveNumberOfItems2 = 2,
                    responsiveNumberOfItems3 = 3,
                    responsiveNumberOfItems4 = numberOfItems;

                if (numberOfItems < 3) {
                    responsiveNumberOfItems2 = numberOfItems;
                    responsiveNumberOfItems3 = numberOfItems;
                }

                if (numberOfItems > 4) {
                    responsiveNumberOfItems4 = 4;
                }

                if (stagePaddingEnabled || margin > 0) {
                    responsiveMargin = 20;
                }

                slider.owlCarousel({
                    items: numberOfItems,
                    loop: loop,
                    autoplay: autoplay,
                    autoplayHoverPause: autoplayHoverPause,
                    autoplayTimeout: sliderSpeed,
                    autoplaySpeed: 650,
                    margin: margin,
                    stagePadding: stagePadding,
                    center: center,
                    autoWidth: autoWidth,
                    animateInClass: animateInClass,
                    animateOut: animateOut,
                    dots: pagination,
                    nav: navigation,
                    navText: [
                        '<span class="qodef-prev-icon ion-ios-arrow-left"></span>',
                        '<span class="qodef-next-icon ion-ios-arrow-right"></span>'
                    ],
                    responsive: {
                        0: {
                            items: responsiveNumberOfItems1,
                            margin: responsiveMargin,
                            stagePadding: 0,
                            center: false,
                            autoWidth: false
                        },
                        681: {
                            items: responsiveNumberOfItems2
                        },
                        769: {
                            items: responsiveNumberOfItems3
                        },
                        1025: {
                            items: responsiveNumberOfItems4
                        },
                        1281: {
                            items: numberOfItems
                        }
                    },
                    onInitialize: function () {
                        slider.css('visibility', 'visible');
                        qodefInitParallax();
                    },
                    onDrag: function (e) {
                        if (qodef.body.hasClass('qodef-smooth-page-transitions-fadeout')) {
                            var sliderIsMoving = e.isTrigger > 0;

                            if (sliderIsMoving) {
                                slider.addClass('qodef-slider-is-moving');
                            }
                        }
                    },
                    onDragged: function () {
                        if (qodef.body.hasClass('qodef-smooth-page-transitions-fadeout') && slider.hasClass('qodef-slider-is-moving')) {

                            setTimeout(function () {
                                slider.removeClass('qodef-slider-is-moving');
                            }, 500);
                        }
                    }
                });
            });
        }
    }

    /**
     * Parallax Elements Instances
     */
    function qodefParallaxElements() {
        var parallaxElements = $('.qodef-ppi-inner');

        if (parallaxElements.length && !qodef.htmlEl.hasClass('touch')) {
            parallaxElements.each(function () {
                var parallaxElement = $(this),
                    randCoeff = (Math.floor(Math.random() * 2) + 1) * 0.1,
                    delta = -Math.round(parallaxElement.height() * randCoeff),
                    dataParallax = '{"y":' + delta + ', "smoothness":20}';

                parallaxElement.attr('data-parallax', dataParallax);
            });

            setTimeout(function () {
                ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
            }, 100); //wait for calcs
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var like = {};
    
    like.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function qodefOnDocumentReady() {
        qodefLikes();
    }

    function qodefLikes() {
        $(document).on('click','.qodef-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
	            postID = likeLink.data('post-id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'bazaar_qodef_like',
                likes_id: id,
                type: type,
	            like_nonce: $('#qodef_like_nonce_'+postID).val()
            };

            var like = $.post(qodefGlobalVars.vars.qodefAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    qodef.modules.blog = blog;

    blog.qodefOnDocumentReady = qodefOnDocumentReady;
    blog.qodefOnWindowLoad = qodefOnWindowLoad;
    blog.qodefOnWindowResize = qodefOnWindowResize;
    blog.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitAudioPlayer();
        qodefInitBlogMasonry();
        qodefInitBlogListMasonry();
	    qodefInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
	    qodefInitBlogPagination().init();
	    qodefInitBlogListShortcodePagination().init();
        qodefInitBlogChequered();
        qodefInitBlogMasonryGalleryAppear();
        qodefInitBlogNarrowAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitBlogMasonry();
	    qodefInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
	    qodefInitBlogPagination().scroll();
	    qodefInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function qodefInitAudioPlayer() {
        var players = $('audio.qodef-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function qodefResizeBlogItems(size,container){

        if(container.hasClass('qodef-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-post-size-default'),
                largeWidthMasonryItem = container.find('.qodef-post-size-large-width'),
                largeHeightMasonryItem = container.find('.qodef-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-post-size-large-width-height');

			if (qodef.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function qodefInitBlogMasonry() {
	    var holder = $('.qodef-blog-holder.qodef-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.qodef-blog-holder-inner'),
                    size = thisHolder.find('.qodef-blog-masonry-grid-sizer').width();
			    
                qodefResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.qodef-blog-masonry-grid-gutter',
						    columnWidth: '.qodef-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
				
				    setTimeout(function() {
					    masonry.isotope('layout');
				    }, 800);
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function qodefInitBlogChequered(){
        var container = $('.qodef-blog-holder.qodef-blog-chequered');
        var masonry = container.children('.qodef-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.qodef-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }
	
    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function qodefInitBlogMasonryGallery() {
        var blogList = $('.qodef-blog-holder.qodef-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.qodef-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.qodef-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                qodefInitBlogMasonryGalleryAppear();
            });
        }
    }

    /**
     *  Animate blog masonry gallery type
     */
    function qodefInitBlogMasonryGalleryAppear() {
        var blogList = $('.qodef-blog-holder.qodef-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.qodef-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter === animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('qodef-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function qodefInitBlogNarrowAppear() {
        var blogList = $('.qodef-blog-holder.qodef-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.qodef-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('qodef-appeared');
                    },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function qodefInitBlogPagination(){
		var holder = $('.qodef-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.qodef-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('qodef-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.qodef-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();

			if(nextPage <= maxNumPages){
				loadingItem.addClass('qodef-showing');
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'bazaar_qodef_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('qodef-blog-type-masonry')){
								qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                qodefResizeBlogItems(thisHolderInner.find('.qodef-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								qodefInitAudioPlayer();
								qodef.modules.common.qodefOwlSlider();
								qodef.modules.common.qodefFluidVideo();
                                qodef.modules.common.qodefInitSelfHostedVideoPlayer();
                                qodef.modules.common.qodefSelfHostedVideoSize();
                                qodefInitBlogNarrowAppear();
                                qodefInitBlogMasonryGalleryAppear();
                                qodefInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('qodef-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.qodef-blog-pag-load-more').hide();
			}
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function qodefInitBlogListMasonry() {
		var holder = $('.qodef-blog-list-holder.qodef-bl-masonry');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.qodef-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.qodef-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.qodef-bl-grid-gutter',
							columnWidth: '.qodef-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function qodefInitBlogListShortcodePagination(){
		var holder = $('.qodef-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.qodef-bl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.qodef-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
				thisHolder.addClass('qodef-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.qodef-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();

			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
					loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
					thisHolder.addClass('qodef-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('qodef-showing');
				}
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'bazaar_qodef_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
							qodefInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('qodef-bl-masonry')){
									qodefInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									qodefInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('qodef-bl-masonry')){
									qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('qodef-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.qodef-blog-pag-load-more').hide();
			}
		};
		
		var qodefInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.qodef-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.qodef-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.qodef-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.qodef-bl-pag-next a');
			
			standardPagNumericItem.removeClass('qodef-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('qodef-bl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var qodefInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisHolder.removeClass('qodef-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var qodefInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisHolder.removeClass('qodef-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('qodef-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
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
(function($) {
    "use strict";

    var headerBottom = {};
    qodef.modules.headerBottom = headerBottom;

    headerBottom.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefBottomMenu().init();
        qodefBottomMenuPosition();
    }

    /**
     * Init Bottom Menu
     */
    var qodefBottomMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.qodef-header-bottom .qodef-vertical-menu-area');


        var initNavigation = function() {
            var verticalMenuOpener = $('.qodef-header-bottom .qodef-header-bottom-menu-opener'),
                headerObject = $('.qodef-header-bottom .qodef-page-header'),
                verticalMenuNavHolder = verticalMenuObject.find('.qodef-vertical-menu-nav-holder-outer'),
                menuItemWithChild =  verticalMenuObject.find('.qodef-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = verticalMenuObject.find('.qodef-fullscreen-menu ul li:not(.has_sub) a');

            //set height of vertical menu holder and initialize nicescroll
            verticalMenuNavHolder.height(qodef.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of vertical menu holder on resize
            $(window).resize(function() {
                verticalMenuNavHolder.height(qodef.windowHeight);
            });

            verticalMenuOpener.on('click',function(e){
                e.preventDefault();
                if(!verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.addClass('active');
                    verticalMenuObject.addClass('opened');
                    verticalMenuOpener.addClass('active');
                    qodef.body.addClass('qodef-header-bottom-opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefDisableScroll();
                    }
                }else{
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    verticalMenuOpener.removeClass('active');
                    qodef.body.removeClass('qodef-header-bottom-opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }
                }
            });

            headerObject.next().on('click', function(){
                if(verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    verticalMenuOpener.removeClass('active');
                    qodef.body.removeClass('qodef-header-bottom-opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }
                }
            });

            $('.qodef-slider, .qodef-title-holder').on('click', function(){
                if(verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    verticalMenuOpener.removeClass('active');
                    qodef.body.removeClass('qodef-header-bottom-opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            verticalMenuNavHolder.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        if($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().each(function() {
                                var sibling = $(this);
                                if(sibling.hasClass('open_sub')) {
                                    var openedUl = sibling.find('> ul.sub_menu');
                                    openedUl.slideUp(200, function () {
                                        verticalMenuNavHolder.getNiceScroll().resize();
                                    });
                                    sibling.removeClass('open_sub');
                                }
                                if(sibling.find('.open_sub')) {
                                    var openedUlUl = sibling.find('.open_sub').find('> ul.sub_menu');
                                    openedUlUl.slideUp(200, function () {
                                        verticalMenuNavHolder.getNiceScroll().resize();
                                    });
                                    sibling.find('.open_sub').removeClass('open_sub');
                                }
                            });
                        }

                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200, function() {
                            verticalMenuNavHolder.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();

                }
            }
        };
    };

    function qodefBottomMenuPosition() {
        var bottomHeader = $('.qodef-header-bottom');
        if(bottomHeader.length && qodef.windowWidth > 1024) {
            var slider = $('.qodef-slider'),
                sliderHeightUsed = slider.length && slider.outerHeight() + qodefGlobalVars.vars.qodefMenuAreaHeight < qodef.windowHeight,
                initialHeight = sliderHeightUsed ? slider.outerHeight() : qodef.windowHeight - qodefGlobalVars.vars.qodefMenuAreaHeight,
                contentHolder = $('.qodef-content'),
                footer = $('footer'),
                footerHeight = footer.outerHeight(),
                uncoveringFooter = footer.hasClass('qodef-footer-uncover');
            if(slider.length > 0) {
                slider.addClass('qodef-slider-fixed');
                contentHolder.css("padding-top", initialHeight);
            }
            $(window).scroll(function() {
                if(qodef.windowWidth > 1024) {
                    calculatePosition(initialHeight, uncoveringFooter, footerHeight);
                }
            });
        }

        function calculatePosition(initialHeight, uncoveringFooter, footerHeight) {
            if(uncoveringFooter) {
                if(qodef.window.scrollTop() > initialHeight) {
                    slider.css('margin-top', '-' + footerHeight + 'px');
                } else {
                    slider.css('margin-top', 0);
                }
            }
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerMinimal = {};
    qodef.modules.headerMinimal = headerMinimal;
	
	headerMinimal.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function qodefFullscreenMenu() {
        var popupMenuOpener = $( 'a.qodef-fullscreen-menu-opener');

        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".qodef-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.qodef-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.qodef-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.qodef-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.qodef-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.qodef-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            popupMenuHolderOuter.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });


            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(qodef.windowHeight);
            });

            if (qodef.body.hasClass('qodef-fade-push-text-right')) {
                cssClass = 'qodef-push-nav-right';
                fadeRight = true;
            } else if (qodef.body.hasClass('qodef-fade-push-text-top')) {
                cssClass = 'qodef-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }


            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('qodef-fm-opened')) {
                    popupMenuOpener.addClass('qodef-fm-opened');
                    qodef.body.addClass('qodef-fullscreen-menu-opened');
                    qodef.body.removeClass('qodef-fullscreen-fade-out').addClass('qodef-fullscreen-fade-in');
                    qodef.body.removeClass(cssClass);
                    qodef.modules.common.qodefDisableScroll();
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('qodef-fm-opened');
                            qodef.body.removeClass('qodef-fullscreen-menu-opened');
                            qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                            qodef.body.addClass(cssClass);
                            if(!qodef.body.hasClass('page-template-full_screen-php')){
                                qodef.modules.common.qodefEnableScroll();
                            }
                            $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('qodef-fm-opened');
                    qodef.body.removeClass('qodef-fullscreen-menu-opened');
                    qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                    qodef.body.addClass(cssClass);
                    qodef.modules.common.qodefEnableScroll();
                    $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function (e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(450, 'easeInOutCubic', function () {
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        $(this).parent().addClass('open_sub');
                        if($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().removeClass('open_sub').find('.sub_menu').slideUp(450, 'easeInOutCubic', function () {
                                submenu.slideDown(450, 'easeInOutCubic', function () {
                                });
                            });
                        }
                        else{
                            submenu.slideDown(450, 'easeInOutCubic', function (){});
                        }
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click',function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which == 1) {
                        popupMenuOpener.removeClass('qodef-fm-opened');
                        qodef.body.removeClass('qodef-fullscreen-menu-opened');
                        qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                        qodef.body.addClass(cssClass);
                        $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        });
                        qodef.modules.common.qodefEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerVertical = {};
    qodef.modules.headerVertical = headerVertical;
	
	headerVertical.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefVerticalMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.qodef-header-vertical .qodef-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        var resizeVerticalArea = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.getNiceScroll().resize();
            }
        };

        /**
         * Checks if vertical area is scrollable (if it has qodef-with-scroll class)
         *
         * @returns {bool}
         */
        var verticalAreaScrollable = function() {
            return verticalMenuObject.hasClass('.qodef-with-scroll');
        };

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.qodef-vertical-menu');

            dropdownClickToggle();

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            function dropdownClickToggle() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');

                menuItems.each(function() {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;
                    var dropdownOpener = $(this).find('> a');
                    var slideUpSpeed = 'fast';
                    var slideDownSpeed = 'slow';

                    dropdownOpener.on('click tap', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if(elementToExpand.is(':visible')) {
                            $(menuItem).removeClass('open');
                            elementToExpand.slideUp(slideUpSpeed, function() {
                                resizeVerticalArea();
                            });
                        } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
                            $(this).parent().parent().children().removeClass('open');
                            $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);

                            $(menuItem).addClass('open');
                            elementToExpand.slideDown(slideDownSpeed, function() {
                                resizeVerticalArea();
                            });
                        } else {

                            if(!$(this).parents('li').hasClass('open')) {
                                menuItems.removeClass('open');
                                menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
                            }

                            if($(this).parent().parent().children().hasClass('open')) {
                                $(this).parent().parent().children().removeClass('open');
                                $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
                            }

                            $(menuItem).addClass('open');
                            elementToExpand.slideDown(slideDownSpeed, function() {
                                resizeVerticalArea();
                            });
                        }
                    });
                });
            }
        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 40,
                    cursorwidth: 0,
                    cursorborder: 0,
                    cursorborderradius: 0,
                    cursorcolor: "transparent",
                    autohidemode: false,
                    horizrailenabled: false
                });
            }
        };

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.qodef-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.qodef-vertical-area-opener');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();

                    if(qodef.body.hasClass('qodef-header-vertical-sliding')) {
                        initHiddenVerticalArea();
                    }
                }
            }
        };
    };

})(jQuery);
(function($) {
    "use strict";

    var headerVertical = {};
    qodef.modules.headerVertical = headerVertical;
	
	headerVertical.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefVerticalMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.qodef-header-vertical-sliding .qodef-vertical-menu-area');


        var initNavigation = function() {
            var varticalMenuOpener = verticalMenuObject.find('.qodef-vertical-menu-opener a'),
                verticalMenuNavHolder = verticalMenuObject.find('.qodef-vertical-menu-nav-holder-outer'),
                menuItemWithChild =  verticalMenuObject.find('.qodef-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = verticalMenuObject.find('.qodef-fullscreen-menu ul li:not(.has_sub) a');

            //set height of vertical menu holder and initialize nicescroll
            verticalMenuNavHolder.height(qodef.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of vertical menu holder on resize
            $(window).resize(function() {
                verticalMenuNavHolder.height(qodef.windowHeight);
            });

            varticalMenuOpener.on('click',function(e){
                e.preventDefault();

                if(!verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.addClass('active');
                    verticalMenuObject.addClass('opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefDisableScroll();
                    }
                    $('.qodef-content-inner').css('pointer-events','none');
                }else{
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }

                    $('.qodef-content-inner').css('pointer-events','auto');
                }
            });

            $('.qodef-content').on('click', function(e){
                if(verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }

                    $('.qodef-content-inner').css('pointer-events','auto');
                    return false;
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            verticalMenuNavHolder.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        if($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().each(function() {
                                var sibling = $(this);
                                if(sibling.hasClass('open_sub')) {
                                    var openedUl = sibling.find('> ul.sub_menu');
                                    openedUl.slideUp(200, function () {
                                        verticalMenuNavHolder.getNiceScroll().resize();
                                    });
                                    sibling.removeClass('open_sub');
                                }
                                if(sibling.find('.open_sub')) {
                                    var openedUlUl = sibling.find('.open_sub').find('> ul.sub_menu');
                                    openedUlUl.slideUp(200, function () {
                                        verticalMenuNavHolder.getNiceScroll().resize();
                                    });
                                    sibling.find('.open_sub').removeClass('open_sub');
                                }
                            });
                        }

                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200, function() {
                            verticalMenuNavHolder.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                }
            }
        };
    };

})(jQuery);
(function($) {
    "use strict";

    var mobileHeader = {};
    qodef.modules.mobileHeader = mobileHeader;
	
	mobileHeader.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitMobileNavigation();
        qodefMobileHeaderBehavior();
    }

    function qodefInitMobileNavigation() {
        var navigationOpener = $('.qodef-mobile-header .qodef-mobile-menu-opener');
        var navigationHolder = $('.qodef-mobile-header .qodef-mobile-nav');
        var dropdownOpener = $('.qodef-mobile-nav .mobile_arrow, .qodef-mobile-nav h6, .qodef-mobile-nav a.qodef-mobile-no-link');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                    navigationOpener.removeClass("qodef-mobile-menu-opened");
                } else {
                    navigationHolder.slideDown(animationSpeed);
                    navigationOpener.addClass("qodef-mobile-menu-opened");
                }
            });
        }


        //init scrollable menu
        var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
        var scrollHeight = navigationHolder.outerHeight() - mobileHeaderHeight > qodef.windowHeight ?  qodef.windowHeight - mobileHeaderHeight - 100 : navigationHolder.height();
        navigationHolder.height(scrollHeight);
        navigationHolder.perfectScrollbar({
            wheelSpeed: 0.6,
            suppressScrollX: true
        });
	
	    //dropdown opening / closing
	    if (dropdownOpener.length) {
		    dropdownOpener.each(function () {
			    var thisItem = $(this);
			
			    thisItem.on('tap click', function (e) {
				    var thisItemParent = thisItem.parent('li'),
					    thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');
				
				    if (thisItemParent.hasClass('has_sub')) {
					    var submenu = thisItemParent.find('> ul.sub_menu');
					
					    if (submenu.is(':visible')) {
						    submenu.slideUp(450, 'easeInOutQuint');
						    thisItemParent.removeClass('qodef-opened');
					    } else {
						    thisItemParent.addClass('qodef-opened');
						
						    if (thisItemParentSiblingsWithDrop.length === 0) {
							    thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
								    submenu.slideDown(400, 'easeInOutQuint');
							    });
						    } else {
							    thisItemParent.siblings().removeClass('qodef-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
								    submenu.slideDown(400, 'easeInOutQuint');
							    });
						    }
					    }
				    }
			    });
		    });
	    }
	
	
	    $('.qodef-mobile-nav a, .qodef-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
                navigationOpener.removeClass("qodef-mobile-menu-opened");
            }
        });
    }

    function qodefMobileHeaderBehavior() {
	    var mobileHeader = $('.qodef-mobile-header'),
		    mobileMenuOpener = mobileHeader.find('.qodef-mobile-menu-opener'),
		    mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
	    
	    if(qodef.body.hasClass('qodef-content-is-behind-header') && mobileHeaderHeight > 0 && qodef.windowWidth <= 1024) {
		    $('.qodef-content').css('marginTop', -mobileHeaderHeight);
            $('.qodef-title-wrapper').css('paddingTop', mobileHeaderHeight);
	    }
	    
        if(qodef.body.hasClass('qodef-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                adminBar     = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + qodefGlobalVars.vars.qodefAddForAdminBar;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('qodef-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('qodef-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('qodef-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.qodef-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

})(jQuery);
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
(function($) {
	"use strict";
	
	var header = {};
	qodef.modules.header = header;
	
	header.qodefSetDropDownMenuPosition     = qodefSetDropDownMenuPosition;
	header.qodefSetDropDownWideMenuPosition = qodefSetDropDownWideMenuPosition;
	
	header.qodefOnDocumentReady = qodefOnDocumentReady;
	header.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).on('load', qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefSetDropDownMenuPosition();
		qodefDropDownMenu();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function qodefSetDropDownMenuPosition() {
		var menuItems = $('.qodef-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = qodef.windowWidth - menuItemPosition;
				
				if (qodef.body.hasClass('qodef-boxed')) {
					menuItemFromLeft = qodef.boxedLayoutWidth - (menuItemPosition - (qodef.windowWidth - qodef.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function qodefSetDropDownWideMenuPosition(){
		var menuItems = $(".qodef-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
				var menuItemSubMenu = $(menuItems[i]).find('.second');
				
				if(menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
					menuItemSubMenu.css('left', 0);
					
					var left_position = menuItemSubMenu.offset().left;
					
					if(qodef.body.hasClass('qodef-boxed')) {
						var boxedWidth = $('.qodef-boxed .qodef-wrapper .qodef-wrapper-inner').outerWidth();
						left_position = left_position - (qodef.windowWidth - boxedWidth) / 2;
						
						menuItemSubMenu.css('left', -left_position);
						menuItemSubMenu.css('width', boxedWidth);
					} else {
						menuItemSubMenu.css('left', -left_position);
						menuItemSubMenu.css('width', qodef.windowWidth);
					}
				}
			});
		}
	}
	
	function qodefDropDownMenu() {
		var menu_items = $('.qodef-drop-down > ul > li');
		
		menu_items.each(function(i) {
			if($(menu_items[i]).find('.second').length > 0) {
				var thisItem = $(menu_items[i]),
					dropDownSecondDiv = thisItem.find('.second');
				
				if(thisItem.hasClass('wide')) {
					//set columns to be same height - start
					var tallest = 0,
						dropDownSecondItem = $(this).find('.second > .inner > ul > li');
					
					dropDownSecondItem.each(function() {
						var thisHeight = $(this).height();
						if(thisHeight > tallest) {
							tallest = thisHeight;
						}
					});
					
					dropDownSecondItem.css('height', ''); // delete old inline css - via resize
					dropDownSecondItem.height(tallest);
					//set columns to be same height - end
				}
				
				if(!qodef.menuDropdownHeightSet) {
					thisItem.data('original_height', dropDownSecondDiv.height() + 'px');
					dropDownSecondDiv.height(0);
				}
				
				if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					thisItem.on("touchstart mouseenter", function() {
						dropDownSecondDiv.css({
							'height': thisItem.data('original_height'),
							'overflow': 'visible',
							'visibility': 'visible',
							'opacity': '1'
						});
					}).on("mouseleave", function() {
						dropDownSecondDiv.css({
							'height': '0px',
							'overflow': 'hidden',
							'visibility': 'hidden',
							'opacity': '0'
						});
					});
				} else {
					if(qodef.body.hasClass('qodef-dropdown-animate-height')) {
						var config = {
						    interval: 0,
						    over: function() {
					            dropDownSecondDiv.addClass('qodef-drop-down-start');
					            dropDownSecondDiv.css({
					                'visibility': 'visible',
					                'height': '0px',
					            });
					            dropDownSecondDiv.css('opacity', '1');
					            dropDownSecondDiv.stop().animate({
					                'height': $(menu_items[i]).data('original_height')
					            }, 500, 'easeInOutQuint', function() {
					                dropDownSecondDiv.css('overflow', 'visible');
					            });
						    },
						    timeout: 150,
						    out: function() {
						        dropDownSecondDiv.stop().animate({
						            'height': '0px',
						            'opacity': 0,
						        }, 0, function() {
						            dropDownSecondDiv.css({
						                'overflow': 'hidden',
						                'visibility': 'hidden'
						            });
						        });
						        dropDownSecondDiv.removeClass('qodef-drop-down-start');
						    }
						};
						thisItem.hoverIntent(config);
					} else {
						var config = {
							interval: 0,
							over: function() {
								dropDownSecondDiv.addClass('qodef-drop-down-start');
								dropDownSecondDiv.stop().css({'height': thisItem.data('original_height')});
							},
							timeout: 150,
							out: function() {
								dropDownSecondDiv.stop().css({'height': '0px'});
								dropDownSecondDiv.removeClass('qodef-drop-down-start');
							}
						};
						thisItem.hoverIntent(config);
					}
				}
			}
		});
		
		$('.qodef-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which === 1){
				var $this = $(this);
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		qodef.menuDropdownHeightSet = true;
	}
	
})(jQuery);
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

(function($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;
    woocommerce.qodefOnWindowLoad = qodefOnWindowLoad;
    woocommerce.qodefOnWindowResize = qodefOnWindowResize;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
	    qodefInitSingleProductLightbox();
        qodefInitProductListFilter().init();
        qodefAddingToCart();
        qodefAddingToWishlist();
	    qodefWishlistRefresh().init();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitProductListMasonryShortcode();
        qodefInitProductListAnimatedShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitProductListMasonryShortcode();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function qodefInitQuantityButtons() {
		$(document).on('click', '.qodef-quantity-minus, .qodef-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.qodef-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('qodef-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue > 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(1);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function qodefInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.qodef-woocommerce-page .qodef-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}

        if($('#shipping_method').length > 0) {
            $( document.body ).on('updated_shipping_method updated_wc_div', function() {
                console.log("OPA");
                var select = $('.woocommerce-shipping-calculator').find('select#calc_shipping_country');
                console.log(select.length);
                if(select.length) {
                    select.select2({});
                }
                var selectState = $('.woocommerce-shipping-calculator').find('select#calc_shipping_state');
                console.log(selectState.length);
                if(selectState.length) {
                    selectState.select2({});
                }
            });
        }
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function qodefInitSingleProductLightbox() {
		var item = $('.qodef-woo-single-page .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof qodef.modules.common.qodefPrettyPhoto === "function") {
				qodef.modules.common.qodefPrettyPhoto();
			}
		}
	}

    /**
     * Init Resize Product Items
     */
    function qodefResizeProductItems(size,container){
        if(container.hasClass('qodef-pl-images-fixed')) {
            var padding = parseInt(container.find('.qodef-pli').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-default'),
                largeWidthMasonryItem = container.find('.qodef-large-width'),
                largeHeightMasonryItem = container.find('.qodef-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-large-width-height');

            if (qodef.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', 2 * size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    function qodefInitProductListFilter(){
        var productList = $('.qodef-pl-holder');
        var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.qodef-pl-categories a, .qodef-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
        }

        //used for replacing content after ajax call
        var qodefReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
        };

        //used for replacing content after ajax call
        var qodefReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.qodef-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
	        var size = thisProductListInner.find('.qodef-pl-sizer').width();
	        qodefResizeProductItems(size, thisProductListInner);
            
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
        var qodefReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            switch(queryParams.ordering) {
                case 'menu_order':
                    queryParams.metaKey = '';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'menu_order title';
                    break;
                case 'popularity':
                    queryParams.metaKey = 'total_sales';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'rating':
                    queryParams.metaKey = '_wc_average_rating';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'newness':
                    queryParams.metaKey = '';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'date';
                    break;
                case 'price':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'price-desc':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
            }

            return queryParams;
        }

        var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.qodef-pl-outer');

            var loadData = qodef.modules.common.getLoadMoreData(thisProductList),
                loader = thisProductList.find('.qodef-prl-loading');

            //store parameters in global object
            qodefReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
            loadData.order = queryParams.order !== undefined ? queryParams.order : '';
            loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
            loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
            loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

	        var nonceHolder = thisProductList.find('input[name*="qodef_product_load_more_nonce_"]');

	        loadData.product_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
	        loadData.product_load_more_nonce = nonceHolder.val();

            loader.fadeIn();

            var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadData, 'qodef_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: QodefAjaxUrl,
                success: function (data) {

                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

                    thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('qodef-masonry-layout')) {
                            qodefReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            qodefReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                        qodefAddingToCart();
                        qodefAddingToWishlist();
                    });

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(qodef.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }

        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.qodef-pl-ordering-outer h6'), thisProductList.find('.qodef-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.qodef-pl-categories-label'),thisProductList.find('.qodef-pl-categories-label').next('ul'));
                    });
                }
            },

        }
    }
	
	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function qodefInitProductListMasonryShortcode() {
		var container = $('.qodef-pl-holder.qodef-masonry-layout .qodef-pl-outer');
		
		if (container.length) {
			container.each(function () {
				var thisContainer = $(this);
                var size = thisContainer.find('.qodef-pl-sizer').width();
                var thisContainerParent = $(this).parent();

                qodefResizeProductItems(size, thisContainerParent);
				
				thisContainer.waitForImages(function () {
					thisContainer.isotope({
                        layoutMode: 'packery',
						itemSelector: '.qodef-pli',
						resizable: false,
                        packery: {
							columnWidth: '.qodef-pl-sizer',
							gutter: '.qodef-pl-gutter'
						}
					});
					
					setTimeout(function () {
						if (typeof qodef.modules.common.qodefInitParallax === "function") {
							qodef.modules.common.qodefInitParallax();
						}
					}, 1000);
					
					thisContainer.isotope('layout').css('opacity', 1);
				});
			});
		}
	}

	/*
	 ** Init Product List Animated Shortcode Layout
	 */
	function qodefInitProductListAnimatedShortcode() {

		var productListAnimatedHolder = $('.qodef-pla-holder:not(.qodef-pla-animation-disabled)');

		if(productListAnimatedHolder.length) {
			productListAnimatedHolder.each(function(){
                var productList = $(this),
				    productListItem = productList.children('.qodef-pla-item');

                productList.animate({opacity: 1}, 1000, 'easeInOutQuad');

				productListItem.appear(function(){
                    $(this).addClass('qodef-pla-animated');
                });
			});
		}
	}

    function qodefAddingToCart() {
        var addToCartButtons = $('.add_to_cart_button, .single_add_to_cart_button');

        if (addToCartButtons.length) {
            addToCartButtons.on('click',function(){
                $(this).text(qodefGlobalVars.vars.qodefAddingToCartLabel);
            });
        }
    }

    function qodefAddingToWishlist() {
        var wishlistButtons = $('.add_to_wishlist');

        if (wishlistButtons.length) {
            wishlistButtons.on('click',function(){
                var wishlistButton = $(this),
                    wishlistItem,
                    wishlistItemOffset,
                    heightAdj,
                    widthAdj;

                //absolute centering over added item
                if (wishlistButton.closest('.qodef-pli').length) {
                    wishlistItem = wishlistButton.closest('.qodef-pli');            // product list shortcode
                } else if (wishlistButton.closest('.qodef-plc-item').length) {
                    wishlistItem = wishlistButton.closest('.qodef-plc-item');       // product carousel shortcode
                } else if (wishlistButton.closest('.product').length) {
                    wishlistItem = wishlistButton.closest('.product');              // WooCommerce template
                }

                wishlistItemOffset = wishlistItem.find('img').offset();
                heightAdj = wishlistItem.find('img').height()/2;
                widthAdj = wishlistItem.find('img').width()/2;

                $('#yith-wcwl-popup-message').css({
                    'top': wishlistItemOffset.top + heightAdj,
                    'left': wishlistItemOffset.left + widthAdj,
                });

                wishlistButton.addClass('qodef-adding-to-wishlist');

                $(document).on('added_to_wishlist', function(){
                    wishlistButton.removeClass('qodef-adding-to-wishlist');

                    setTimeout(function(){
                        var wishlistMsg = $('#yith-wcwl-popup-message');

                        wishlistMsg.stop().addClass('qodef-wishlist-vanish-out');
                        wishlistMsg.one('webkitAnimationEnd oanimationend msAnimationEnd animationend' ,function(){
                            wishlistMsg.removeClass('qodef-wishlist-vanish-out');
                        });
                    }, 1000);
                });
            });
        }
    }

	function qodefWishlistRefresh() {

		var initRefreshWishlist = function(){
			var nonceHolder = $('.qodef-wishlist-widget-holder').find('input[name*="bazaar_select_product_wishlist_nonce_"]');

			var data = {
				action: 'qodef_product_ajax_wishlist',
				product_wishlist_id: nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length),
				product_wishlist_nonce: nonceHolder.val()
			};

			$.ajax({
				url: qodefGlobalVars.vars.qodefAjaxUrl,
				type: "POST",
				data: data,
				success:function(data) {
					$('.qodef-wishlist-widget-holder .qodef-wishlist-items-number span').html(data['wishlist_count_products']);
				}
			});
		};

		return {
			init: function () {
				//trigger defined in jquery.yith-wcwl.js, after product is added to wishlist
				$('body').on('added_to_wishlist',function(){
					initRefreshWishlist();
				});

				//after product is removed from wishlist list
				$('#yith-wcwl-form').on('click', '.product-remove a, .product-add-to-cart a', function() {
					setTimeout(function() {
						initRefreshWishlist();
					}, 2000);
				});
			}

		}

	}

})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	qodef.modules.accordions = accordions;
	
	accordions.qodefInitAccordions = qodefInitAccordions;
	
	
	accordions.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function qodefInitAccordions(){
		var accordion = $('.qodef-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('qodef-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('qodef-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.qodef-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('mouseenter mouseleave',function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	qodef.modules.animationHolder = animationHolder;
	
	animationHolder.qodefInitAnimationHolder = qodefInitAnimationHolder;
	
	
	animationHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function qodefInitAnimationHolder(){
		var elements = $('.qodef-grow-in, .qodef-fade-in-down, .qodef-element-from-fade, .qodef-element-from-left, .qodef-element-from-right, .qodef-element-from-top, .qodef-element-from-bottom, .qodef-flip-in, .qodef-x-rotate, .qodef-z-rotate, .qodef-y-translate, .qodef-fade-in, .qodef-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	qodef.modules.button = button;
	
	button.qodefButton = qodefButton;
	
	
	button.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var qodefButton = function() {
		//all buttons on the page
		var buttons = $('.qodef-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
/**
 * Cards Gallery shortcode
 */
(function($) {
    'use strict';

    $(window).on('load', function(){
        qodefCardsGallery();
    });


/**
 * Cards Gallery shortcode
 */


function qodefCardsGallery() {
    if ($('.qodef-cards-gallery-holder').length) {
        $('.qodef-cards-gallery-holder').each(function () {
            var gallery = $(this);
            var cards = gallery.find('.card');
            cards.each(function () {
                var card = $(this);
                card.on('click',function () {
                    if (!cards.last().is(card)) {
                        card.addClass('out animating').siblings().addClass('animating-siblings');
                        card.detach();
                        card.insertAfter(cards.last());
                        setTimeout(function () {
                            card.removeClass('out');
                        }, 200);
                        setTimeout(function () {
                            card.removeClass('animating').siblings().removeClass('animating-siblings');
                        }, 1200);
                        cards = gallery.find('.card');
                        return false;
                    }
                });
            });

            if (gallery.hasClass('qodef-bundle-animation') && !qodef.htmlEl.hasClass('touch')) {
                gallery.appear(function () {
                    gallery.addClass('qodef-appeared');
                    gallery.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
                        $(this).addClass('qodef-animation-done');
                    });
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            }
        });
    }
}

})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	qodef.modules.countdown = countdown;
	
	countdown.qodefInitCountdown = qodefInitCountdown;
	
	
	countdown.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function qodefInitCountdown() {
		var countdowns = $('.qodef-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    labels1: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	qodef.modules.counter = counter;
	
	counter.qodefInitCounter = qodefInitCounter;
	
	
	counter.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function qodefInitCounter() {
		var counterHolder = $('.qodef-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.qodef-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('qodef-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var customFont = {};
	qodef.modules.customFont = customFont;
	
	customFont.qodefCustomFontResize = qodefCustomFontResize;
	
	
	customFont.qodefOnDocumentReady = qodefOnDocumentReady;
	customFont.qodefOnWindowResize = qodefOnWindowResize;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).resize(qodefOnWindowResize);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefCustomFontResize();
	}
	
	/* 
	 All functions to be called on $(window).resize() should be in this function
	 */
	function qodefOnWindowResize() {
		qodefCustomFontResize();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function qodefCustomFontResize(){
		var holder = $('.qodef-custom-font-holder');
		
		if(holder.length){
			holder.each(function() {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
					
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1280') !== 'undefined' && thisItem.data('font-size-1280') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1280') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1280') !== 'undefined' && thisItem.data('line-height-1280') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1280') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if(smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if(smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1280px) {.qodef-custom-font-holder."+itemClass+" { " + smallLaptopStyle + " } }";
					}
					if(ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-custom-font-holder."+itemClass+" { " + ipadLandscapeStyle + " } }";
					}
					if(ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.qodef-custom-font-holder."+itemClass+" { " + ipadPortraitStyle + " } }";
					}
					if(mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-custom-font-holder."+itemClass+" { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	qodef.modules.elementsHolder = elementsHolder;
	
	elementsHolder.qodefInitElementsHolderResponsiveStyle = qodefInitElementsHolderResponsiveStyle;
	
	
	elementsHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitElementsHolderResponsiveStyle();
	}
	
	/*
	 **	Elements Holder responsive style
	 */
	function qodefInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.qodef-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.qodef-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('680-768') !== 'undefined' && thisItem.data('680-768') !== false) {
						ipadPortrait = thisItem.data('680-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1281px) and (max-width: 1600px) {.qodef-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1280px) {.qodef-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
				
				if (typeof qodef.modules.common.qodefOwlSlider === "function") {
					qodef.modules.common.qodefOwlSlider();
				}

			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var fullScreenSections = {};
	qodef.modules.fullScreenSections = fullScreenSections;
	
	fullScreenSections.qodefInitFullScreenSections = qodefInitFullScreenSections;
	
	
	fullScreenSections.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitFullScreenSections();
	}
	
	/*
	 **	Init full screen sections shortcode
	 */
	function qodefInitFullScreenSections(){
		var fullScreenSections = $('.qodef-full-screen-sections');
		
		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this),
					fullScreenSectionsWrapper = thisFullScreenSections.children('.qodef-fss-wrapper'),
					fullScreenSectionsItems = fullScreenSectionsWrapper.children('.qodef-fss-item'),
					fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
					fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('qodef-fss-item-has-style'),
					enableContinuousVertical = false,
					enableNavigationData = '',
					enablePaginationData = '';
				
				var defaultHeaderStyle = '';
				if (qodef.body.hasClass('qodef-light-header')) {
					defaultHeaderStyle = 'light';
				} else if (qodef.body.hasClass('qodef-dark-header')) {
					defaultHeaderStyle = 'dark';
				}
				
				if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
					enableContinuousVertical = true;
				}
				if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
					enableNavigationData = thisFullScreenSections.data('enable-navigation');
				}
				if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
					enablePaginationData = thisFullScreenSections.data('enable-pagination');
				}
				
				var enableNavigation = enableNavigationData !== 'no',
					enablePagination = enablePaginationData !== 'no';
				
				fullScreenSectionsWrapper.fullpage({
					sectionSelector: '.qodef-fss-item',
					scrollingSpeed: 1200,
					verticalCentered: false,
					continuousVertical: enableContinuousVertical,
					navigation: enablePagination,
					onLeave: function(index, nextIndex, direction){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
						}
					},
					afterRender: function(){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
							thisFullScreenSections.children('.qodef-fss-nav-holder').css('visibility','visible');
						}
						
						fullScreenSectionsWrapper.css('visibility','visible');
					}
				});
				
				setResposniveData(thisFullScreenSections);
				
				if(enableNavigation) {
					thisFullScreenSections.find('#qodef-fss-nav-up').on('click', function() {
						$.fn.fullpage.moveSectionUp();
						return false;
					});
					
					thisFullScreenSections.find('#qodef-fss-nav-down').on('click', function() {
						$.fn.fullpage.moveSectionDown();
						return false;
					});
				}
			});
		}
	}
	
	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + default_header_style + '-header');
		} else {
			qodef.body.removeClass('qodef-light-header qodef-dark-header');
		}
	}
	
	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#qodef-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#qodef-fss-nav-down'),
			enableContinuousVertical = false;
		
		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}
		
		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}
	
	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.qodef-fss-item'),
			responsiveStyle = '',
			style = '';
		
		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';
			
			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}
			
			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {
				
				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1280px) {.qodef-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});
		
		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}
		
		if (style.length) {
			$('head').append(style);
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	qodef.modules.googleMap = googleMap;
	
	googleMap.qodefShowGoogleMap = qodefShowGoogleMap;
	
	
	googleMap.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function qodefShowGoogleMap(){
		var googleMap = $('.qodef-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var predefinedStyle = false;
				if(typeof element.data('predefined-style') !== 'undefined' && element.data('predefined-style') === 'yes') {
					predefinedStyle = true;
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "qodef-map-"+ uniqueId;
				
				qodefInitializeGoogleMap(predefinedStyle, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function qodefInitializeGoogleMap(predefinedStyle, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(predefinedStyle) {
			mapStyles = [
                {
                    "featureType": "all",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "weight": "2.00"
                        }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#9c9c9c"
                        }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#7b7b7b"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#46bcec"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#c8d7d4"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#070707"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                }
            ];
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(predefinedStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'qodef-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Qode Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('qodef-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function qodefInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
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


(function($) {
	'use strict';
	
	var icon = {};
	qodef.modules.icon = icon;
	
	icon.qodefIcon = qodefIcon;
	
	
	icon.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var qodefIcon = function() {
		var icons = $('.qodef-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('qodef-icon-animation')) {
				icon.appear(function() {
					icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.qodef-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	qodef.modules.iconListItem = iconListItem;
	
	iconListItem.qodefInitIconList = qodefInitIconList;
	
	
	iconListItem.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var qodefInitIconList = function() {
		var iconList = $('.qodef-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    'use strict';
	
	var imageGallery = {};
	qodef.modules.imageGallery = imageGallery;
	
	imageGallery.qodefInitImageGalleryMasonry = qodefInitImageGalleryMasonry;
	
	
	imageGallery.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).on('load', qodefOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefInitImageGalleryMasonry();
	}
	
	/*
	 ** Init Image Gallery shortcode - Masonry layout
	 */
	function qodefInitImageGalleryMasonry(){
		var holder = $('.qodef-image-gallery.qodef-ig-masonry-type');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.qodef-ig-masonry');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.qodef-ig-image',
						percentPosition: true,
						packery: {
							gutter: '.qodef-ig-grid-gutter',
							columnWidth: '.qodef-ig-grid-sizer'
						}
					});
					
					setTimeout(function() {
						masonry.isotope('layout');
					}, 800);
					
					masonry.css('opacity', '1');
				});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';
    
    var imageMarquee = {};
    qodef.modules.imageMarquee = imageMarquee;
    
    imageMarquee.qodefInitImageMarquee = qodefInitImageMarquee;
    
    imageMarquee.qodefOnDocumentReady = qodefOnDocumentReady;
    
    $(document).ready(qodefOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitImageMarquee();
    }
    
    /**
     * Init Text Marquee effect
     */
    function qodefInitImageMarquee() {
        var imageMarqueeShortcodes = $('.qodef-image-marquee');

        if (imageMarqueeShortcodes.length) {
            imageMarqueeShortcodes.each(function(){
                var imageMarqueeShortcode = $(this),
                    marqueeElements = imageMarqueeShortcode.find('.qodef-image'),
                    originalItem = marqueeElements.filter('.qodef-original'),
                    auxItem = marqueeElements.filter('.qodef-aux');

                var marqueeEffect = function () {
	                qodefRequestAnimationFrame();
	                
                    var delta = 1, //pixel movement
                        speedCoeff = 0.8, // below 1 to slow down, above 1 to speed up
                        marqueeWidth = originalItem.width();

                    auxItem.css('width', marqueeWidth); //same width as the initial marquee element
                    auxItem.css('left', marqueeWidth); //set to the right of the initial marquee element

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this),
                            currentPos = 0;

                        var qodefInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            //move marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            marqueeElement.css('transform','translate3d('+speedCoeff*currentPos+'px,0,0)');
	
	                        requestNextAnimationFrame(qodefInfiniteScrollEffect);

                            $(window).resize(function(){
                                marqueeWidth = originalItem.width();
                                currentPos = 0;
                                originalItem.css('left',0); // reset
                    			auxItem.css('width', marqueeWidth); //same width as the initial marquee element
                                auxItem.css('left', marqueeWidth); //set to the right of the inital marquee element
                            });
                        }; 
                            
                        qodefInfiniteScrollEffect();
                    });
                };

                imageMarqueeShortcode.waitForImages(function(){
	                marqueeEffect();
	            });
            });
        }
    }
    
    /*
     * Request Animation Frame shim
     */
	function qodefRequestAnimationFrame() {
		window.requestNextAnimationFrame =
			(function () {
				var originalWebkitRequestAnimationFrame = undefined,
					wrapper = undefined,
					callback = undefined,
					geckoVersion = 0,
					userAgent = navigator.userAgent,
					index = 0,
					self = this;
				
				// Workaround for Chrome 10 bug where Chrome
				// does not pass the time to the animation function
				
				if (window.webkitRequestAnimationFrame) {
					// Define the wrapper
					
					wrapper = function (time) {
						if (time === undefined) {
							time = +new Date();
						}
						
						self.callback(time);
					};
					
					// Make the switch
					
					originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;
					
					window.webkitRequestAnimationFrame = function (callback, element) {
						self.callback = callback;
						
						// Browser calls the wrapper and wrapper calls the callback
						
						originalWebkitRequestAnimationFrame(wrapper, element);
					};
				}
				
				// Workaround for Gecko 2.0, which has a bug in
				// mozRequestAnimationFrame() that restricts animations
				// to 30-40 fps.
				
				if (window.mozRequestAnimationFrame) {
					// Check the Gecko version. Gecko is used by browsers
					// other than Firefox. Gecko 2.0 corresponds to
					// Firefox 4.0.
					
					index = userAgent.indexOf('rv:');
					
					if (userAgent.indexOf('Gecko') !== -1) {
						geckoVersion = userAgent.substr(index + 3, 3);
						
						if (geckoVersion === '2.0') {
							// Forces the return statement to fall through
							// to the setTimeout() function.
							
							window.mozRequestAnimationFrame = undefined;
						}
					}
				}
				
				return window.requestAnimationFrame   ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame    ||
					window.oRequestAnimationFrame      ||
					window.msRequestAnimationFrame     ||
					
					function (callback, element) {
						var start,
							finish;
						
						window.setTimeout( function () {
							start = +new Date();
							callback(start);
							finish = +new Date();
							
							self.timeout = 1000 / 60 - (finish - start);
							
						}, self.timeout);
					};
				}
			)();
	}

})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	qodef.modules.pieChart = pieChart;
	
	pieChart.qodefInitPieChart = qodefInitPieChart;
	
	
	pieChart.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function qodefInitPieChart() {
		var pieChartHolder = $('.qodef-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.qodef-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.qodef-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	qodef.modules.progressBar = progressBar;
	
	progressBar.qodefInitProgressBars = qodefInitProgressBars;
	
	
	progressBar.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function qodefInitProgressBars(){
		var progressBar = $('.qodef-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.qodef-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					qodefInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function qodefInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.qodef-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	qodef.modules.tabs = tabs;
	
	tabs.qodefInitTabs = qodefInitTabs;
	
	
	tabs.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function qodefInitTabs(){
		var tabs = $('.qodef-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.qodef-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.qodef-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.qodef-tabs a.qodef-external-link').off('click');
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var uncoveringSections = {};
    qodef.modules.uncoveringSections = uncoveringSections;

    uncoveringSections.qodefInitUncoveringSections = qodefInitUncoveringSections;


    uncoveringSections.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitUncoveringSections();
    }

    /*
     **	Init full screen sections shortcode
     */
    function qodefInitUncoveringSections(){
        var uncoveringSections = $('.qodef-uncovering-sections');

        if(uncoveringSections.length){
            uncoveringSections.each(function() {
                var thisUS = $(this),
                    thisCurtain = uncoveringSections.find('.curtains'),
                    curtainItems = thisCurtain.find('.qodef-uss-item'),
                    curtainShadow = uncoveringSections.find('.qodef-fss-shadow');
                var body = qodef.body;
                var defaultHeaderStyle = '';
                if (body.hasClass('qodef-light-header')) {
                    defaultHeaderStyle = 'light';
                } else if (body.hasClass('qodef-dark-header')) {
                    defaultHeaderStyle = 'dark';
                }

                body.addClass('qodef-uncovering-section-on-page');
                if(qodef.windowWidth > 1024) {
                    if (qodefPerPageVars.vars.qodefHeaderVerticalWidth > 0 && qodef.windowWidth > 1024) {
                        curtainItems.css({
                            left: qodefPerPageVars.vars.qodefHeaderVerticalWidth,
                            width: 'calc(100% - ' + qodefPerPageVars.vars.qodefHeaderVerticalWidth + 'px)'
                        });

                        curtainShadow.css({
                            left: qodefPerPageVars.vars.qodefHeaderVerticalWidth,
                            width: 'calc(100% - ' + qodefPerPageVars.vars.qodefHeaderVerticalWidth + 'px)'
                        });
                    }

                    thisCurtain.curtain({
                        scrollSpeed: 400,
                        nextSlide: function () {
                            checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);
                        },
                        prevSlide: function () {
                            checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);
                        }
                    });
                } else {
                    curtainItems.each(function() {
                        $(this).css('height',  qodef.windowHeight);
                    })
                }

                checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);
                setResposniveData(thisCurtain);

                thisUS.addClass('qodef-loaded');
            });
        }
    }

    function checkFullScreenSectionsItemForHeaderStyle(thisUncoveringSections, default_header_style) {
        var section_header_style = thisUncoveringSections.find('.current').data('header-style');
        if (section_header_style !== undefined && section_header_style !== '') {
            qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + default_header_style + '-header');
        } else {
            qodef.body.removeClass('qodef-light-header qodef-dark-header');
        }
    }

    function setResposniveData(thisUncoveringSections) {
        var uncoveringSections = thisUncoveringSections.find('.qodef-uss-item'),
            responsiveStyle = '',
            style = '';

        uncoveringSections.each(function(){
            var thisSection = $(this),
                thisSectionImage = thisSection.find('.qodef-uss-image-holder'),
                itemClass = '',
                imageLaptop = '',
                imageTablet = '',
                imagePortraitTablet = '',
                imageMobile = '';

            if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
                itemClass = thisSection.data('item-class');
            }

            if (typeof thisSectionImage.data('laptop-image') !== 'undefined' && thisSectionImage.data('laptop-image') !== false) {
                imageLaptop = thisSectionImage.data('laptop-image');
            }
            if (typeof thisSectionImage.data('tablet-image') !== 'undefined' && thisSectionImage.data('tablet-image') !== false) {
                imageTablet = thisSectionImage.data('tablet-image');
            }
            if (typeof thisSectionImage.data('tablet-portrait-image') !== 'undefined' && thisSectionImage.data('tablet-portrait-image') !== false) {
                imagePortraitTablet = thisSectionImage.data('tablet-portrait-image');
            }
            if (typeof thisSectionImage.data('mobile-image') !== 'undefined' && thisSectionImage.data('mobile-image') !== false) {
                imageMobile = thisSectionImage.data('mobile-image');
            }


            if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {

                if (imageLaptop.length) {
                    responsiveStyle += "@media only screen and (max-width: 1280px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url(" + imageLaptop + ") !important; } }";
                }
                if (imageTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url( " + imageTablet + ") !important; } }";
                }
                if (imagePortraitTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 800px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url( " + imagePortraitTablet + ") !important; } }";
                }
                if (imageMobile.length) {
                    responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-uss-item." + itemClass + " .qodef-uss-image-holder { background-image: url( " + imageMobile + ") !important; } }";
                }
            }
        });

        if (responsiveStyle.length) {
            style = '<style type="text/css">' + responsiveStyle + '</style>';
        }

        if (style.length) {
            $('head').append(style);
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    qodef.modules.portfolio = portfolio;

    portfolio.qodefOnDocumentReady = qodefOnDocumentReady;
    portfolio.qodefOnWindowLoad = qodefOnWindowLoad;
    portfolio.qodefOnWindowResize = qodefOnWindowResize;
    portfolio.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitPortfolioMasonry();
        qodefInitPortfolioFilter();
        initPortfolioSingleMasonry();
        qodefInitPortfolioListAnimation();
	    qodefInitPortfolioPagination().init();
        qodefPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function qodefOnWindowResize() {
        qodefInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
	    qodefInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function qodefInitPortfolioListAnimation(){
        var portList = $('.qodef-portfolio-list-holder.qodef-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.qodef-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('qodef-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('qodef-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function qodefInitPortfolioMasonry(){
        var portList = $('.qodef-portfolio-list-holder.qodef-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.qodef-pl-inner'),
                    size = thisPortList.find('.qodef-pl-grid-sizer').width();
                
                qodefResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.qodef-pl-grid-gutter',
                        columnWidth: '.qodef-pl-grid-sizer'
                    }
                });
                
                setTimeout(function () {
	                qodef.modules.common.qodefInitParallax();
                }, 600);

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Portfolio Items
     */
    function qodefResizePortfolioItems(size,container){
        if(container.hasClass('qodef-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.qodef-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.qodef-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-pl-masonry-large-width-height');

            if (qodef.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function qodefInitPortfolioFilter(){
        var filterHolder = $('.qodef-portfolio-list-holder .qodef-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.qodef-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.qodef-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('qodef-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.qodef-pl-filter:first').addClass('qodef-pl-current');
	            
	            if(thisPortListHolder.hasClass('qodef-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.qodef-pl-filter').on('click',function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.qodef-pl-filter').removeClass('qodef-pl-current');
                    thisFilter.addClass('qodef-pl-current');

                    if(portListHasLoadMore && !portListHasArtciles) {
                        qodefInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.qodef-pl-inner').isotope({ filter: filterValue });
	                    qodef.modules.common.qodefInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function qodefInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.qodef-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'qodef_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.qodef-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('qodef-showing qodef-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: qodefGlobalVars.vars.qodefAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                qodefResizePortfolioItems(thisPortListInner.find('.qodef-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('qodef-showing qodef-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    qodefInitPortfolioListAnimation();
	                                qodef.modules.common.qodefInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('qodef-showing qodef-filter-trigger');
                            qodefInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function qodefInitPortfolioPagination(){
		var portList = $('.qodef-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.qodef-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.qodef-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisPortList.hasClass('qodef-pl-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.qodef-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
				thisPortList.addClass('qodef-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.qodef-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('qodef-pl-pag-standard')) {
					loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
					thisPortList.addClass('qodef-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('qodef-showing');
				}
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'qodef_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('qodef-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							qodefInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter')) {
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
									qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter')) {
									qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									qodefInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('qodef-pl-infinite-scroll-started')) {
							thisPortList.removeClass('qodef-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.qodef-pl-load-more-holder').hide();
			}
		};
		
		var qodefInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.qodef-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.qodef-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.qodef-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.qodef-pl-pag-next a');
			
			standardPagNumericItem.removeClass('qodef-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('qodef-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var qodefInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
            qodefResizePortfolioItems(thisPortListInner.find('.qodef-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
				qodef.modules.common.qodefInitParallax();
			}, 600);
		};
		
		var qodefInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			qodefInitPortfolioListAnimation();
			qodef.modules.common.qodefInitParallax();
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
            qodefResizePortfolioItems(thisPortListInner.find('.qodef-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
				qodef.modules.common.qodefInitParallax();
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisPortListInner.append(responseHtml);
			qodefInitPortfolioListAnimation();
			qodef.modules.common.qodefInitParallax();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}
	
	var qodefPortfolioSingleFollow = function() {
		var info = $('.qodef-follow-portfolio-info .qodef-portfolio-single-holder .qodef-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.qodef-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .qodef-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0;
		}
		
		var infoHolderPosition = function() {
			if(info.length) {
				if (mediaHolderHeight > infoHolderHeight) {
					if(qodef.scroll > infoHolderOffset) {
						var marginTop = qodef.scroll - infoHolderOffset + qodefGlobalVars.vars.qodefAddForAdminBar + headerHeight;
						// if scroll is initially positioned below mediaHolderHeight
						if(marginTop + infoHolderHeight > mediaHolderHeight){
							marginTop = mediaHolderHeight - infoHolderHeight;
						}
						info.stop().animate({
							marginTop: marginTop
						});
					}
				}
			}
		};
		
		var recalculateInfoHolderPosition = function() {
			if (info.length) {
				if(mediaHolderHeight > infoHolderHeight) {
					if(qodef.scroll > infoHolderOffset) {
						
						if(qodef.scroll + headerHeight + qodefGlobalVars.vars.qodefAddForAdminBar + infoHolderHeight + 50 < infoHolderOffset + mediaHolderHeight) { //50 to prevent mispositioning
							
							//Calculate header height if header appears
							if ($('.header-appear, .qodef-fixed-wrapper').length) {
								headerHeight = $('.header-appear, .qodef-fixed-wrapper').height();
							}
							info.stop().animate({
								marginTop: (qodef.scroll - infoHolderOffset + qodefGlobalVars.vars.qodefAddForAdminBar + headerHeight)
							});
							//Reset header height
							headerHeight = 0;
						}
						else{
							info.stop().animate({
								marginTop: mediaHolderHeight - infoHolderHeight
							});
						}
					} else {
						info.stop().animate({
							marginTop: 0
						});
					}
				}
			}
		};
		
		return {
			init : function() {
				infoHolderPosition();
				$(window).scroll(function(){
					recalculateInfoHolderPosition();
				});
			}
		};
	};
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.qodef-portfolio-single-holder .qodef-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.qodef-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.qodef-ps-grid-gutter',
                    columnWidth: '.qodef-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

})(jQuery);