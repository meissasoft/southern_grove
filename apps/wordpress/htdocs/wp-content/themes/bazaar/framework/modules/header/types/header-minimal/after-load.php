<?php

if ( ! function_exists( 'bazaar_qodef_header_minimal_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function bazaar_qodef_header_minimal_full_screen_menu_body_class( $classes ) {
		$classes[] = 'qodef-' . bazaar_qodef_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		
		return $classes;
	}
	
	if ( bazaar_qodef_check_is_header_type_enabled( 'header-minimal', bazaar_qodef_get_page_id() ) ) {
		add_filter( 'body_class', 'bazaar_qodef_header_minimal_full_screen_menu_body_class' );
	}
}

if ( ! function_exists( 'bazaar_qodef_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function bazaar_qodef_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => bazaar_qodef_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
		);
		
		bazaar_qodef_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( bazaar_qodef_check_is_header_type_enabled( 'header-minimal', bazaar_qodef_get_page_id() ) ) {
		add_action( 'bazaar_qodef_after_header_area', 'bazaar_qodef_get_header_minimal_full_screen_menu', 10 );
	}
}

if ( ! function_exists( 'bazaar_qodef_header_minimal_mobile_menu_module' ) ) {
    /**
     * Function that edits module for mobile menu
     *
     * @param $module - default module value
     *
     * @return string name of module
     */
    function bazaar_qodef_header_minimal_mobile_menu_module( $module ) {
        return 'header/types/header-minimal';
    }

    if ( bazaar_qodef_check_is_header_type_enabled( 'header-minimal', bazaar_qodef_get_page_id() ) ) {
        add_filter('bazar_qodef_mobile_menu_module', 'bazaar_qodef_header_minimal_mobile_menu_module');
    }
}

if ( ! function_exists( 'bazaar_qodef_header_minimal_mobile_menu_slug' ) ) {
    /**
     * Function that edits slug for mobile menu
     *
     * @param $slug - default slug value
     *
     * @return string name of slug
     */
    function bazaar_qodef_header_minimal_mobile_menu_slug( $slug ) {
        return 'minimal';
    }

    if ( bazaar_qodef_check_is_header_type_enabled( 'header-minimal', bazaar_qodef_get_page_id() ) ) {
        add_filter('bazar_qodef_mobile_menu_slug', 'bazaar_qodef_header_minimal_mobile_menu_slug');
    }
}