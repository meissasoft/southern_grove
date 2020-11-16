<?php

if ( ! function_exists( 'bazaar_qodef_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function bazaar_qodef_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'BazaarQodef\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'bazaar_qodef_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function bazaar_qodef_init_register_header_minimal_type() {
		add_filter( 'bazaar_qodef_register_header_type_class', 'bazaar_qodef_register_header_minimal_type' );
	}
	
	add_action( 'bazaar_qodef_before_header_function_init', 'bazaar_qodef_init_register_header_minimal_type' );
}

if ( ! function_exists( 'bazaar_qodef_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function bazaar_qodef_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'bazaar' );
		
		return $menus;
	}
	
	if ( bazaar_qodef_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'bazaar_qodef_register_headers_menu', 'bazaar_qodef_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'bazaar_qodef_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function bazaar_qodef_register_header_minimal_full_screen_menu_widgets() {
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_above',
				'name'          => esc_html__( 'Fullscreen Menu Top', 'bazaar' ),
				'description'   => esc_html__( 'This widget area is rendered above full screen menu', 'bazaar' ),
				'before_widget' => '<div class="%2$s qodef-fullscreen-menu-above-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="qodef-widget-title">',
				'after_title'   => '</h5>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_below',
				'name'          => esc_html__( 'Fullscreen Menu Bottom', 'bazaar' ),
				'description'   => esc_html__( 'This widget area is rendered below full screen menu', 'bazaar' ),
				'before_widget' => '<div class="%2$s qodef-fullscreen-menu-below-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="qodef-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}
	
	if ( bazaar_qodef_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_action( 'widgets_init', 'bazaar_qodef_register_header_minimal_full_screen_menu_widgets' );
	}
}