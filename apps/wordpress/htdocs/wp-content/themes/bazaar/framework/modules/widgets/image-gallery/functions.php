<?php

if ( ! function_exists( 'bazaar_qodef_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function bazaar_qodef_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'BazaarQodefImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_image_gallery_widget' );
}