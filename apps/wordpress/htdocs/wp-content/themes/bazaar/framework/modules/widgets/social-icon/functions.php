<?php

if ( ! function_exists( 'bazaar_qodef_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function bazaar_qodef_register_social_icon_widget( $widgets ) {
		$widgets[] = 'BazaarQodefSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_social_icon_widget' );
}