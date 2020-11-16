<?php

if ( ! function_exists( 'bazaar_qodef_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function bazaar_qodef_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'bazaar' );
		
		return $type;
	}
	
	add_filter( 'bazaar_qodef_title_type_global_option', 'bazaar_qodef_set_title_centered_type_for_options' );
	add_filter( 'bazaar_qodef_title_type_meta_boxes', 'bazaar_qodef_set_title_centered_type_for_options' );
}

if ( ! function_exists( 'bazaar_qodef_set_title_centered_type_as_default_options' ) ) {
	/**
	 * This function set default title type value for global title option map
	 */
	function bazaar_qodef_set_title_centered_type_as_default_options( $type ) {
		$type = 'centered';

		return $type;
	}

	add_filter( 'bazaar_qodef_default_title_type_global_option', 'bazaar_qodef_set_title_centered_type_as_default_options' );
}