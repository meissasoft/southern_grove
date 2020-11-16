<?php

if ( ! function_exists( 'bazaar_qodef_sticky_header_styles' ) ) {
	/**
	 * Generates styles for sticky haeder
	 */
	function bazaar_qodef_sticky_header_styles() {
		$background_color        = bazaar_qodef_options()->getOptionValue( 'sticky_header_background_color' );
		$background_transparency = bazaar_qodef_options()->getOptionValue( 'sticky_header_transparency' );
		$border_color            = bazaar_qodef_options()->getOptionValue( 'sticky_header_border_color' );
		$header_height           = bazaar_qodef_options()->getOptionValue( 'sticky_header_height' );
		
		if ( ! empty( $background_color ) ) {
			$header_background_color              = $background_color;
			$header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$header_background_color_transparency = $background_transparency;
			}
			
			echo bazaar_qodef_dynamic_css( '.qodef-page-header .qodef-sticky-header .qodef-sticky-holder', array( 'background-color' => bazaar_qodef_rgba_color( $header_background_color, $header_background_color_transparency ) ) );
		}
		
		if ( ! empty( $border_color ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-page-header .qodef-sticky-header .qodef-sticky-holder', array( 'border-color' => $border_color ) );
		}
		
		if ( ! empty( $header_height ) ) {
			$height = bazaar_qodef_filter_px( $header_height ) . 'px';
			
			echo bazaar_qodef_dynamic_css( '.qodef-page-header .qodef-sticky-header', array( 'height' => $height ) );
			echo bazaar_qodef_dynamic_css( '.qodef-page-header .qodef-sticky-header .qodef-logo-wrapper a', array( 'max-height' => $height ) );
		}
		
		// sticky menu style
		
		$menu_item_styles = bazaar_qodef_get_typography_styles( 'sticky' );
		
		$menu_item_selector = array(
			'.qodef-main-menu.qodef-sticky-nav > ul > li > a'
		);
		
		echo bazaar_qodef_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = bazaar_qodef_options()->getOptionValue( 'sticky_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.qodef-main-menu.qodef-sticky-nav > ul > li:hover > a',
			'.qodef-main-menu.qodef-sticky-nav > ul > li.qodef-active-item > a'
		);
		
		echo bazaar_qodef_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_sticky_header_styles' );
}