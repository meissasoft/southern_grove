<?php

if ( ! function_exists( 'bazaar_qodef_search_opener_icon_size' ) ) {
	function bazaar_qodef_search_opener_icon_size() {
		$icon_size = bazaar_qodef_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-search-opener', array(
				'font-size' => bazaar_qodef_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_search_opener_icon_size' );
}

if ( ! function_exists( 'bazaar_qodef_search_opener_icon_colors' ) ) {
	function bazaar_qodef_search_opener_icon_colors() {
		$icon_color       = bazaar_qodef_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = bazaar_qodef_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_search_opener_icon_colors' );
}

if ( ! function_exists( 'bazaar_qodef_search_opener_text_styles' ) ) {
	function bazaar_qodef_search_opener_text_styles() {
		$item_styles = bazaar_qodef_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.qodef-search-icon-text'
		);
		
		echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = bazaar_qodef_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-search-opener:hover .qodef-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_search_opener_text_styles' );
}