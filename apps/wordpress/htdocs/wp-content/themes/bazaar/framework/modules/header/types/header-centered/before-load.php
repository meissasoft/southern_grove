<?php

if ( ! function_exists( 'bazaar_qodef_set_header_centered_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function bazaar_qodef_set_header_centered_type_global_option( $header_types ) {
		$header_types['header-centered'] = array(
			'image' => QODE_FRAMEWORK_HEADER_TYPES_ROOT . '/header-centered/assets/img/header-centered.png',
			'label' => esc_html__( 'Centered', 'bazaar' )
		);
		
		return $header_types;
	}
	
	add_filter( 'bazaar_qodef_header_type_global_option', 'bazaar_qodef_set_header_centered_type_global_option' );
}

if ( ! function_exists( 'bazaar_qodef_set_header_centered_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function bazaar_qodef_set_header_centered_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-centered'] = esc_html__( 'Centered', 'bazaar' );
		
		return $header_type_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_meta_boxes', 'bazaar_qodef_set_header_centered_type_meta_boxes_option' );
}

if ( ! function_exists( 'bazaar_qodef_set_show_dep_options_for_header_centered' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type global option
	 */
	function bazaar_qodef_set_show_dep_options_for_header_centered( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#qodef_header_behaviour';
		$show_containers[] = '#qodef_menu_area_container';
		$show_containers[] = '#qodef_logo_area_container';
		$show_containers[] = '#qodef_logo_wrapper_padding_header_centered';
		$show_containers[] = '#qodef_panel_main_menu';
		$show_containers[] = '#qodef_panel_sticky_header';
		$show_containers[] = '#qodef_panel_fixed_header';
		
		$show_containers = apply_filters( 'bazaar_qodef_show_dep_options_for_header_centered', $show_containers );
		
		$show_dep_options['header-centered'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_show_global_option', 'bazaar_qodef_set_show_dep_options_for_header_centered' );
}

if ( ! function_exists( 'bazaar_qodef_set_hide_dep_options_for_header_centered' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type global option
	 */
	function bazaar_qodef_set_hide_dep_options_for_header_centered( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#qodef_panel_fullscreen_menu';
		
		$hide_containers = apply_filters( 'bazaar_qodef_hide_dep_options_for_header_centered', $hide_containers );
		
		$hide_dep_options['header-centered'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_hide_global_option', 'bazaar_qodef_set_hide_dep_options_for_header_centered' );
}

if ( ! function_exists( 'bazaar_qodef_set_show_dep_options_for_header_centered_meta_boxes' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type meta boxes map
	 */
	function bazaar_qodef_set_show_dep_options_for_header_centered_meta_boxes( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#qodef_logo_area_container';
		$show_containers[] = '#qodef_menu_area_container';
		$show_containers[] = '#qodef_logo_wrapper_padding_header_centered';
		
		$show_containers = apply_filters( 'bazaar_qodef_show_dep_options_for_header_centered_meta_boxes', $show_containers );
		
		$show_dep_options['header-centered'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_show_meta_boxes', 'bazaar_qodef_set_show_dep_options_for_header_centered_meta_boxes' );
}

if ( ! function_exists( 'bazaar_qodef_set_hide_dep_options_for_header_centered_meta_boxes' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type meta boxes map
	 */
	function bazaar_qodef_set_hide_dep_options_for_header_centered_meta_boxes( $hide_dep_options ) {
		$hide_containers = apply_filters( 'bazaar_qodef_hide_dep_options_for_header_centered_meta_boxes', $hide_containers = array() );
		
		$hide_dep_options['header-centered'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_for_header_centered_meta_boxes' );
}

if ( ! function_exists( 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' ) ) {
	/**
	 * This function is used to disable this header type specific containers/panels for admin options when another header type is selected
	 */
	function bazaar_qodef_set_centered_hide_dep_options_for_header_types( $hide_containers_dep_options ) {
		$hide_containers_dep_options[] = '#qodef_logo_wrapper_padding_header_centered';
		
		return $hide_containers_dep_options;
	}
	
	// hide header centered container for global options
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_minimal', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_standard', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_sliding', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
	
	// hide header centered container for meta boxes
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_minimal_meta_boxes', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_standard_meta_boxes', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_meta_boxes', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
	add_filter( 'bazaar_qodef_hide_dep_options_for_header_vertical_sliding_meta_boxes', 'bazaar_qodef_set_centered_hide_dep_options_for_header_types' );
}

if ( ! function_exists( 'bazaar_qodef_set_hide_dep_options_header_centered' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function bazaar_qodef_set_hide_dep_options_header_centered( $hide_dep_options ) {
		$hide_dep_options[] = 'header-centered';
		
		return $hide_dep_options;
	}
	
	// header types panel options
	add_filter( 'bazaar_qodef_full_screen_menu_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'bazaar_qodef_header_standard_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'bazaar_qodef_header_vertical_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'bazaar_qodef_header_vertical_menu_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_centered' );
	
	// header types panel meta boxes
	add_filter( 'bazaar_qodef_header_standard_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'bazaar_qodef_header_vertical_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_centered' );
}