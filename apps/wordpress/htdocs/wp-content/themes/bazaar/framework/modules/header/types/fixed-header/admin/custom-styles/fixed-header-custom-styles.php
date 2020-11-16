<?php

if ( ! function_exists( 'bazaar_qodef_fixed_header_styles' ) ) {
	/**
	 * Generates styles for fixed haeder
	 */
	function bazaar_qodef_fixed_header_styles() {
		$background_color        = bazaar_qodef_options()->getOptionValue( 'fixed_header_background_color' );
		$background_transparency = bazaar_qodef_options()->getOptionValue( 'fixed_header_transparency' );
		$border_color            = bazaar_qodef_options()->getOptionValue( 'fixed_header_border_bottom_color' );
		
		$fixed_area_styles = array();
		if ( ! empty( $background_color ) ) {
			$fixed_header_background_color              = $background_color;
			$fixed_header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$fixed_header_background_color_transparency = $background_transparency;
			}
			
			$fixed_area_styles['background-color'] = bazaar_qodef_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		if ( empty( $background_color ) && $background_transparency !== '' ) {
			$fixed_header_background_color              = '#fff';
			$fixed_header_background_color_transparency = $background_transparency;
			
			$fixed_area_styles['background-color'] = bazaar_qodef_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		$selector = array(
			'.qodef-page-header .qodef-fixed-wrapper.fixed .qodef-menu-area'
		);
		
		echo bazaar_qodef_dynamic_css( $selector, $fixed_area_styles );
		
		$fixed_area_holder_styles = array();
		
		if ( ! empty( $border_color ) ) {
			$fixed_area_holder_styles['border-bottom-color'] = $border_color;
		}
		
		$selector_holder = array(
			'.qodef-page-header .qodef-fixed-wrapper.fixed'
		);
		
		echo bazaar_qodef_dynamic_css( $selector_holder, $fixed_area_holder_styles );
		
		// fixed menu style
		
		$menu_item_styles = bazaar_qodef_get_typography_styles( 'fixed' );
		
		$menu_item_selector = array(
			'.qodef-fixed-wrapper.fixed .qodef-main-menu > ul > li > a'
		);
		
		echo bazaar_qodef_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = bazaar_qodef_options()->getOptionValue( 'fixed_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.qodef-fixed-wrapper.fixed .qodef-main-menu > ul > li:hover > a',
			'.qodef-fixed-wrapper.fixed .qodef-main-menu > ul > li.qodef-active-item > a'
		);
		
		echo bazaar_qodef_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_fixed_header_styles' );
}