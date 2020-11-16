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