<?php

if ( ! function_exists( 'bazaar_qodef_register_image_widget' ) ) {
	/**
	 * Function that register image widget
	 */
	function bazaar_qodef_register_image_widget( $widgets ) {
		$widgets[] = 'BazaarQodefImageWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_image_widget' );
}