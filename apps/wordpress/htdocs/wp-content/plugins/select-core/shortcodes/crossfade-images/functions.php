<?php

if ( ! function_exists( 'qodef_core_add_crossfade_images' ) ) {
	function qodef_core_add_crossfade_images( $shortcodes_class_name ) {
		$shortcodes = array(
			'QodeCore\CPT\Shortcodes\CrossfadeImages\CrossfadeImages'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcode', 'qodef_core_add_crossfade_images' );
}

if ( ! function_exists( 'qodef_core_set_crossfade_images_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for counter shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function qodef_core_set_crossfade_images_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-crossfade-images';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcodes_custom_icon_class', 'qodef_core_set_crossfade_images_icon_class_name_for_vc_shortcodes' );
}