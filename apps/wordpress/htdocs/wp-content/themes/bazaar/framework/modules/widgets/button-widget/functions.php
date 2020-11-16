<?php

if ( ! function_exists( 'bazaar_qodef_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function bazaar_qodef_register_button_widget( $widgets ) {
		$widgets[] = 'BazaarQodefButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_button_widget' );
}