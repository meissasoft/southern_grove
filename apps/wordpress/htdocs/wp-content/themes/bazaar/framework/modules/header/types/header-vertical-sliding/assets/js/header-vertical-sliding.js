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