<?php

if ( ! function_exists( 'bazaar_qodef_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function bazaar_qodef_register_search_opener_widget( $widgets ) {
		$widgets[] = 'BazaarQodefSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_search_opener_widget' );
}