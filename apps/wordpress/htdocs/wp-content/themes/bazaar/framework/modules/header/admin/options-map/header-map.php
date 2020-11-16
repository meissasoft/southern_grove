<?php

if ( ! function_exists( 'bazaar_qodef_header_options_map' ) ) {
	function bazaar_qodef_get_header_types_options() {
		$header_type_options = apply_filters( 'bazaar_qodef_header_type_global_option', $header_type_options = array() );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_get_header_type_default_options' ) ) {
	function bazaar_qodef_get_header_type_default_options() {
		$header_type_option = apply_filters( 'bazaar_qodef_default_header_type_global_option', $header_type_option = '' );
		
		return $header_type_option;
	}
}

if ( ! function_exists( 'bazaar_qodef_get_show_dep_for_header_types_options' ) ) {
	function bazaar_qodef_get_show_dep_for_header_types_options() {
		$show_dep_options = apply_filters( 'bazaar_qodef_header_type_show_global_option', $show_dep_options = array() );
		
		return $show_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_header_types_options' ) ) {
	function bazaar_qodef_get_hide_dep_for_header_types_options() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_header_type_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'bazaar_qodef_get_hide_dep_for_header_behavior_options' ) ) {
	function bazaar_qodef_get_hide_dep_for_header_behavior_options() {
		$hide_dep_options = apply_filters( 'bazaar_qodef_header_behavior_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( QODE_FRAMEWORK_HEADER_ROOT_DIR . '/admin/options-map/*/*.php' ) as $options_load ) {
	include_once $options_load;
}

foreach ( glob( QODE_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/options-map/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'bazaar_qodef_header_options_map' ) ) {
	function bazaar_qodef_header_options_map() {
		$header_type_options              = bazaar_qodef_get_header_types_options();
		$header_type_default_option       = bazaar_qodef_get_header_type_default_options();
		$header_type_options_show_dep     = bazaar_qodef_get_show_dep_for_header_types_options();
		$header_type_options_hide_dep     = bazaar_qodef_get_hide_dep_for_header_types_options();
		$header_behavior_options_hide_dep = bazaar_qodef_get_hide_dep_for_header_behavior_options();
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_header_page',
				'title' => esc_html__( 'Header', 'bazaar' ),
				'icon'  => 'fa fa-header'
			)
		);
		
		$panel_header = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_header_page',
				'name'  => 'panel_header',
				'title' => esc_html__( 'Header', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'radiogroup',
				'name'          => 'header_type',
				'default_value' => $header_type_default_option,
				'label'         => esc_html__( 'Choose Header Type', 'bazaar' ),
				'description'   => esc_html__( 'Select the type of header you would like to use', 'bazaar' ),
				'options'       => $header_type_options,
				'args'          => array(
					'use_images'  => true,
					'hide_labels' => true,
					'dependence'  => true,
					'show'        => $header_type_options_show_dep,
					'hide'        => $header_type_options_hide_dep
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'          => $panel_header,
				'type'            => 'select',
				'name'            => 'header_behaviour',
				'default_value'   => 'fixed-on-scroll',
				'label'           => esc_html__( 'Choose Header Behaviour', 'bazaar' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'bazaar' ),
				'options'         => array(
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'bazaar' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'bazaar' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'bazaar' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'bazaar' )
				),
				'hidden_property' => 'header_type',
				'hidden_values'   => $header_behavior_options_hide_dep,
				'args'            => array(
					'dependence'   => true,
					'show'         => array(
						'fixed-on-scroll'                 => '#qodef_panel_fixed_header',
						'no-behavior'                     => '',
						'sticky-header-on-scroll-up'      => '#qodef_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#qodef_panel_sticky_header'
					),
					'hide'         => array(
						'fixed-on-scroll'                 => '#qodef_panel_sticky_header',
						'no-behavior'                     => '#qodef_panel_sticky_header, #qodef_panel_fixed_header',
						'sticky-header-on-scroll-up'      => '#qodef_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#qodef_panel_fixed_header'
					)
				)
			)
		);
		
		/***************** Header Skin Options -start ********************/
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'select',
				'name'          => 'header_style',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'bazaar' ),
				'description'   => esc_html__( 'Choose a predefined header style for header elements (logo, main menu, side menu opener...)', 'bazaar' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'bazaar' ),
					'light-header' => esc_html__( 'Light', 'bazaar' ),
					'dark-header'  => esc_html__( 'Dark', 'bazaar' )
				)
			)
		);
		
		/***************** Header Skin Options - end ********************/
		
		/***************** Top Header Layout - start **********************/
		
		do_action( 'bazaar_qodef_header_top_options_map', $panel_header );
		
		/***************** Top Header Layout - end **********************/
		
		/***************** Logo Area Layout - start **********************/
		
		do_action( 'bazaar_qodef_header_logo_area_options_map', $panel_header );
		
		/***************** Logo Area Layout - end **********************/
		
		/***************** Menu Area Layout - start **********************/
		
		do_action( 'bazaar_qodef_header_menu_area_options_map', $panel_header );
		
		/***************** Menu Area Layout - end **********************/
		
		/***************** Additional Header Menu Area Layout - start *****************/
		
		do_action( 'bazaar_qodef_additional_header_menu_area_options_map', $panel_header );
		
		/***************** Additional Header Menu Area Layout - end *****************/
		
		/***************** Sticky Header Layout - start *******************/
		
		do_action( 'bazaar_qodef_header_sticky_options_map', $panel_header );
		
		/***************** Sticky Header Layout - end *******************/
		
		/***************** Fixed Header Layout - start ********************/
		
		do_action( 'bazaar_qodef_header_fixed_options_map', $panel_header );
		
		/***************** Fixed Header Layout - end ********************/
		
		/******************* Main Menu Layout - start *********************/
		
		do_action( 'bazaar_qodef_header_main_navigation_options_map' );
		
		/******************* Main Menu Layout - end *********************/
		
		/***************** Additional Main Menu Area Layout - start *****************/
		
		do_action( 'bazaar_qodef_additional_header_main_navigation_options_map' );
		
		/***************** Additional Main Menu Area Layout - end *****************/
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_header_options_map', 3 );
}