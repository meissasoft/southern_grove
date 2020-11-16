<?php

if ( ! function_exists( 'bazaar_qodef_set_title_standard_with_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set standard with breadcrumbs title type value for title options map and meta boxes
	 */
	function bazaar_qodef_set_title_standard_with_breadcrumbs_type_for_options( $type ) {
		$type['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrumbs', 'bazaar' );
		
		return $type;
	}
	
	add_filter( 'bazaar_qodef_title_type_global_option', 'bazaar_qodef_set_title_standard_with_breadcrumbs_type_for_options' );
	add_filter( 'bazaar_qodef_title_type_meta_boxes', 'bazaar_qodef_set_title_standard_with_breadcrumbs_type_for_options' );
}