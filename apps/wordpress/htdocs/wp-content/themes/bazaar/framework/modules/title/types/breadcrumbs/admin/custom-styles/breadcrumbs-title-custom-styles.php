<?php

if ( ! function_exists( 'bazaar_qodef_breadcrumbs_title_area_typography_style' ) ) {
	function bazaar_qodef_breadcrumbs_title_area_typography_style() {
		
		$item_styles = bazaar_qodef_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-breadcrumbs'
		);
		
		echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = bazaar_qodef_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-breadcrumbs a:hover'
		);
		
		echo bazaar_qodef_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_breadcrumbs_title_area_typography_style' );
}