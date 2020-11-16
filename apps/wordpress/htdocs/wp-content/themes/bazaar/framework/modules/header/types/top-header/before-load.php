<?php

if ( ! function_exists( 'bazaar_qodef_set_show_dep_options_for_top_header' ) ) {
	/**
	 * This function is used to show this header type specific containers/panels for admin options when another header type is selected
	 */
	function bazaar_qodef_set_show_dep_options_for_top_header( $show_dep_options ) {
		$show_dep_options[] = '#qodef_top_header_container';
		
		return $show_dep_options;
	}
	
	// show top header container for global options
	add_filter( 'bazaar_qodef_show_dep_options_for_header_centered', 'bazaar_qodef_set_show_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_show_dep_options_for_header_minimal', 'bazaar_qodef_set_show_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_show_dep_options_for_header_standard', 'bazaar_qodef_set_show_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_show_dep_options_for_header_standard_extended', 'bazaar_qodef_set_show_dep_options_for_top_header' );
	
	// show top header container for meta boxes
	add_filter( 'bazaar_qodef_show_dep_options_for_header_centered_meta_boxes', 'bazaar_qodef_set_show_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_show_dep_options_for_header_minimal_meta_boxes', 'bazaar_qodef_set_show_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_show_dep_options_for_header_standard_meta_boxes', 'bazaar_qodef_set_show_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_show_dep_options_for_header_standard_extended_meta_boxes', 'bazaar_qodef_set_show_dep_options_for_top_header' );
}

if ( ! function_exists( 'bazaar_qodef_set_hide_dep_options_for_top_header' ) ) {
	/**
	 * This function is used to hide this header type specific containers/panels for admin options when another header type is selected
	 */
	function bazaar_qodef_set_hide_dep_options_for_top_header( $hide_dep_options ) {
		$hide_dep_options[] = '#qodef_top_header_container';
		
		return $hide_dep_options;
	}
	
	// hide top header container for global options
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_top_menu', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_sliding', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_compact', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
	
	// hide top header container for meta boxes
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_top_menu_meta_boxes', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_meta_boxes', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_sliding_meta_boxes', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_compact_meta_boxes', 'bazaar_qodef_set_hide_dep_options_for_top_header' );
}