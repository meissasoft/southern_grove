<?php

if ( ! function_exists( 'bazaar_qodef_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function bazaar_qodef_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'BazaarQodefSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_sidearea_opener_widget' );
}