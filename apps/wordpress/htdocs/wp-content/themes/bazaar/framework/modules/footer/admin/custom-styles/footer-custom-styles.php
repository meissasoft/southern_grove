<?php

if ( ! function_exists( 'bazaar_qodef_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function bazaar_qodef_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = bazaar_qodef_options()->getOptionValue( 'footer_top_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo bazaar_qodef_dynamic_css( '.qodef-page-footer .qodef-footer-top-holder', $item_styles );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_footer_top_general_styles' );
}

if ( ! function_exists( 'bazaar_qodef_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function bazaar_qodef_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = bazaar_qodef_options()->getOptionValue( 'footer_bottom_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo bazaar_qodef_dynamic_css( '.qodef-page-footer .qodef-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_footer_bottom_general_styles' );
}