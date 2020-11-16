<?php

if ( ! function_exists( 'bazaar_qodef_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function bazaar_qodef_header_top_bar_styles() {
		$top_header_height = bazaar_qodef_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo bazaar_qodef_dynamic_css( '.qodef-top-bar', array( 'height' => bazaar_qodef_filter_px( $top_header_height ) . 'px' ) );
			echo bazaar_qodef_dynamic_css( '.qodef-top-bar .qodef-logo-wrapper a', array( 'max-height' => bazaar_qodef_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo bazaar_qodef_dynamic_css( '.qodef-top-bar-background', array( 'height' => bazaar_qodef_get_top_bar_background_height() . 'px' ) );
		
		if ( bazaar_qodef_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.qodef-top-bar .qodef-grid .qodef-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = bazaar_qodef_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = bazaar_qodef_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = bazaar_qodef_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo bazaar_qodef_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = bazaar_qodef_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = bazaar_qodef_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( bazaar_qodef_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = bazaar_qodef_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = bazaar_qodef_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo bazaar_qodef_dynamic_css( '.qodef-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( bazaar_qodef_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo bazaar_qodef_dynamic_css( '.qodef-top-bar', $top_bar_styles );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_header_top_bar_styles' );
}