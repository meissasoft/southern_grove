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