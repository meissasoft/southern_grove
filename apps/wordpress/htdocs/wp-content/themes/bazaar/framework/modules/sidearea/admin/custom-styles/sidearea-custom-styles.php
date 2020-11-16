<?php

if ( ! function_exists( 'bazaar_qodef_side_area_slide_from_right_type_style' ) ) {
	function bazaar_qodef_side_area_slide_from_right_type_style() {
		$width = bazaar_qodef_options()->getOptionValue( 'side_area_width' );
		
		if ( $width !== '' ) {
			echo bazaar_qodef_dynamic_css( '.qodef-side-menu-slide-from-right .qodef-side-menu', array(
				'right' => '-' . bazaar_qodef_filter_px( $width ) . 'px',
				'width' => bazaar_qodef_filter_px( $width ) . 'px'
			) );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_side_area_slide_from_right_type_style' );
}

if ( ! function_exists( 'bazaar_qodef_side_area_icon_color_styles' ) ) {
	function bazaar_qodef_side_area_icon_color_styles() {
		$icon_color             = bazaar_qodef_options()->getOptionValue( 'side_area_icon_color' );
		$icon_hover_color       = bazaar_qodef_options()->getOptionValue( 'side_area_icon_hover_color' );
		$close_icon_color       = bazaar_qodef_options()->getOptionValue( 'side_area_close_icon_color' );
		$close_icon_hover_color = bazaar_qodef_options()->getOptionValue( 'side_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.qodef-side-menu-button-opener:hover',
			'.qodef-side-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-side-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo bazaar_qodef_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-side-menu a.qodef-close-side-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-side-menu a.qodef-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_side_area_icon_color_styles' );
}

if ( ! function_exists( 'bazaar_qodef_side_area_styles' ) ) {
	function bazaar_qodef_side_area_styles() {
		$side_area_styles = array();
		$background_color = bazaar_qodef_options()->getOptionValue( 'side_area_background_color' );
		$padding          = bazaar_qodef_options()->getOptionValue( 'side_area_padding' );
		$text_alignment   = bazaar_qodef_options()->getOptionValue( 'side_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$side_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$side_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$side_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $side_area_styles ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-side-menu', $side_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo bazaar_qodef_dynamic_css( '.qodef-side-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_side_area_styles' );
}