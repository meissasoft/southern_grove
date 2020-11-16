<?php

foreach ( glob( QODE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/custom-styles/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'bazaar_qodef_title_area_typography_style' ) ) {
	function bazaar_qodef_title_area_typography_style() {
		
		// title default/small style
		
		$item_styles = bazaar_qodef_get_typography_styles( 'page_title' );
		
		$item_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-page-title'
		);
		
		echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		
		// subtitle style
		
		$item_styles = bazaar_qodef_get_typography_styles( 'page_subtitle' );
		
		$item_selector = array(
			'.qodef-title-holder .qodef-title-wrapper .qodef-page-subtitle'
		);
		
		echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_title_area_typography_style' );
}