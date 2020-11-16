<?php

if ( ! function_exists( 'bazaar_qodef_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function bazaar_qodef_register_separator_widget( $widgets ) {
		$widgets[] = 'BazaarQodefSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_separator_widget' );
}