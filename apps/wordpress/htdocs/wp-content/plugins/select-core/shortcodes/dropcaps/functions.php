<?php

if ( ! function_exists( 'qodef_core_add_dropcaps_shortcodes' ) ) {
	function qodef_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'QodeCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcode', 'qodef_core_add_dropcaps_shortcodes' );
}