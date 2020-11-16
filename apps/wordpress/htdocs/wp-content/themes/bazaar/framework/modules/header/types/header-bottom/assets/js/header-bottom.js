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