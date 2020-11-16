<?php

if ( ! function_exists( 'bazaar_qodef_set_header_vertical_sliding_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function bazaar_qodef_set_header_vertical_sliding_type_global_option( $header_types ) {
		$header_types['header-vertical-sliding'] = array(
			'image' => QODE_FRAMEWORK_HEADER_TYPES_ROOT . '/header-vertical-sliding/assets/img/header-vertical-sliding.png',
			'label' => esc_html__( 'Vertical - Sliding', 'bazaar' )
		);
		
		return $header_types;
	}
	
	add_filter( 'bazaar_qodef_header_type_global_option', 'bazaar_qodef_set_header_vertical_sliding_type_global_option' );
}

if ( ! function_exists( 'bazaar_qodef_set_header_vertical_sliding_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function bazaar_qodef_set_header_vertical_sliding_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-vertical-sliding'] = esc_html__( 'Vertical - Sliding', 'bazaar' );
		
		return $header_type_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_meta_boxes', 'bazaar_qodef_set_header_vertical_sliding_type_meta_boxes_option' );
}

if ( ! function_exists( 'bazaar_qodef_set_show_dep_options_for_header_vertical_sliding' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type global option
	 */
	function bazaar_qodef_set_show_dep_options_for_header_vertical_sliding( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#qodef_header_vertical_area_container';
		$show_containers[] = '#qodef_panel_vertical_main_menu';
		
		$show_containers = apply_filters( 'bazaar_qodef_show_dep_options_for_header_vertical_sliding', $show_containers );
		
		$show_dep_options['header-vertical-sliding'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_show_global_option', 'bazaar_qodef_set_show_dep_options_for_header_vertical_sliding' );
}

if ( ! function_exists( 'bazaar_qodef_set_hide_dep_options_for_header_vertical_sliding' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type global option
	 */
	function bazaar_qodef_set_hide_dep_options_for_header_vertical_sliding( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#qodef_header_behaviour';
		$hide_containers[] = '#qodef_menu_area_container';
		$hide_containers[] = '#qodef_logo_area_container';
		$hide_containers[] = '#qodef_panel_fullscreen_menu';
		$hide_containers[] = '#qodef_panel_main_menu';
		$hide_containers[] = '#qodef_panel_sticky_header';
		$hide_containers[] = '#qodef_panel_fixed_header';
		
		$hide_containers = apply_filters( 'bazaar_qodef_hide_dep_options_for_header_vertical_sliding', $hide_containers );
		
		$hide_dep_options['header-vertical-sliding'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_hide_global_option', 'bazaar_qodef_set_hide_dep_options_for_header_vertical_sliding' );
}

if ( ! function_exists( 'bazaar_qodef_set_show_dep_options_for_header_vertical_sliding_meta_boxes' ) ) {
	/**
	 * This function set show container values when this header type is selected for header type meta boxes map
	 */
	function bazaar_qodef_set_show_dep_options_for_header_vertical_sliding_meta_boxes( $show_dep_options ) {
		$show_containers   = array();
		$show_containers[] = '#qodef_header_vertical_area_container';
		
		$show_containers = apply_filters( 'bazaar_qodef_show_dep_options_for_header_vertical_sliding_meta_boxes', $show_containers );
		
		$show_dep_options['header-vertical-sliding'] = implode( ',', $show_containers );
		
		return $show_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_show_meta_boxes', 'bazaar_qodef_set_show_dep_options_for_header_vertical_sliding_meta_boxes' );
}

if ( ! function_exists( 'bazaar_qodef_set_hide_dep_options_for_header_vertical_sliding_meta_boxes' ) ) {
	/**
	 * This function set hide container values when this header type is selected for header type meta boxes map
	 */
	function bazaar_qodef_set_hide_dep_options_for_header_vertical_sliding_meta_boxes( $hide_dep_options ) {
		$hide_containers   = array();
		$hide_containers[] = '#qodef_logo_area_container';
		$hide_containers[] = '#qodef_menu_area_container';
		
		$hide_containers = apply_filters( 'bazaar_qodef_hide_dep_options_for_header_vertical_sliding_meta_boxes', $hide_containers );
		
		$hide_dep_options['header-vertical-sliding'] = implode( ',', $hide_containers );
		
		return $hide_dep_options;
	}
	
	add_filter( 'bazaar_qodef_header_type_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_for_header_vertical_sliding_meta_boxes' );
}

if ( ! function_exists( 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function bazaar_qodef_set_hide_dep_options_header_vertical_sliding( $hide_dep_options ) {
		$hide_dep_options[] = 'header-vertical-sliding';
		
		return $hide_dep_options;
	}
	
	// header global panel options
	add_filter( 'bazaar_qodef_header_logo_area_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_header_menu_area_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_header_main_menu_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_top_header_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	
	// header global panel meta boxes
	add_filter( 'bazaar_qodef_header_logo_area_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_header_menu_area_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_top_header_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	
	// header behavior panel options
	add_filter( 'bazaar_qodef_header_behavior_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_fixed_header_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_sticky_header_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	
	// header behavior panel meta boxes
	add_filter( 'bazaar_qodef_header_behavior_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	
	// header types panel options
	add_filter( 'bazaar_qodef_full_screen_menu_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_header_centered_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_header_standard_hide_global_option', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	
	// header types panel meta boxes
	add_filter( 'bazaar_qodef_header_centered_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
	add_filter( 'bazaar_qodef_header_standard_hide_meta_boxes', 'bazaar_qodef_set_hide_dep_options_header_vertical_sliding' );
}