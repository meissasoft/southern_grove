<?php

if ( ! function_exists( 'bazaar_qodef_register_raw_html_widget' ) ) {
	/**
	 * Function that register raw html widget
	 */
	function bazaar_qodef_register_raw_html_widget( $widgets ) {
		$widgets[] = 'BazaarQodefRawHTMLWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_raw_html_widget' );
}