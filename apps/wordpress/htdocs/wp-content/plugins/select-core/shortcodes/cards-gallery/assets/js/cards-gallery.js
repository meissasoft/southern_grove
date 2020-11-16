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