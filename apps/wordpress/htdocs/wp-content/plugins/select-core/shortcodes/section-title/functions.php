<?php

if ( ! function_exists( 'qodef_core_add_section_title_shortcodes' ) ) {
	function qodef_core_add_section_title_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'QodeCore\CPT\Shortcodes\SectionTitle\SectionTitle'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcode', 'qodef_core_add_section_title_shortcodes' );
}

if ( ! function_exists( 'qodef_core_set_section_title_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for section title shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function qodef_core_set_section_title_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-section-title';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcodes_custom_icon_class', 'qodef_core_set_section_title_icon_class_name_for_vc_shortcodes' );
}