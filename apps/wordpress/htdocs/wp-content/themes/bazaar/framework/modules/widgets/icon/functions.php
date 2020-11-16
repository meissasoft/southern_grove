<?php

if ( ! function_exists( 'bazaar_qodef_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function bazaar_qodef_register_icon_widget( $widgets ) {
		$widgets[] = 'BazaarQodefIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_icon_widget' );
}