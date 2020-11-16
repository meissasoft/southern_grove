<?php

if ( ! function_exists( 'bazaar_qodef_load_search' ) ) {
	function bazaar_qodef_load_search() {
		$search_type      = 'fullscreen';
		
		if ( bazaar_qodef_active_widget( false, false, 'qodef_search_opener' ) ) {
			include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
		}
	}
	
	add_action( 'init', 'bazaar_qodef_load_search' );
}

if ( ! function_exists( 'bazaar_qodef_search_styles' ) ) {
	/**
	 * Sets per page styles for header top bar
	 *
	 * @param $styles
	 *
	 * @return array
	 */
	function bazaar_qodef_search_styles( $styles ) {
		$search_style = array();

		$background_image = bazaar_qodef_options()->getOptionValue('search_background_image');
		if (!empty($background_image)) {
			$search_style['background-image'] = 'url('.$background_image.')';
			$search_style['background-position'] = 'center 0';
			$search_style['background-size'] = 'cover';
			$search_style['background-repeat'] = 'no-repeat';
		} else {
			$search_style['background-color'] = '#fff';
		}

		$selector = array(
				'.qodef-search-fade .qodef-fullscreen-search-holder .qodef-fullscreen-search-table'
		);

		$search_style = bazaar_qodef_dynamic_css($selector, $search_style);

		$current_style = $search_style . $styles;

		return $current_style;
	}

	add_filter( 'bazaar_qodef_add_page_custom_style', 'bazaar_qodef_search_styles' );
}

if ( ! function_exists( 'bazaar_qodef_get_holder_params_search' ) ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 */
	function bazaar_qodef_get_holder_params_search() {
		$params_list = array();
		
		$layout = bazaar_qodef_options()->getOptionValue( 'search_page_layout' );
		if ( $layout == 'in-grid' ) {
			$params_list['holder'] = 'qodef-container';
			$params_list['inner']  = 'qodef-container-inner clearfix';
		} else {
			$params_list['holder'] = 'qodef-full-width';
			$params_list['inner']  = 'qodef-full-width-inner';
		}
		
		/**
		 * Available parameters for holder params
		 * -holder
		 * -inner
		 */
		return apply_filters( 'bazaar_qodef_search_holder_params', $params_list );
	}
}

if ( ! function_exists( 'bazaar_qodef_get_search_page' ) ) {
	function bazaar_qodef_get_search_page() {
		$sidebar_layout = bazaar_qodef_sidebar_layout();
		
		$params = array(
			'sidebar_layout' => $sidebar_layout
		);
		
		bazaar_qodef_get_module_template_part( 'templates/holder', 'search', '', $params );
	}
}

if ( ! function_exists( 'bazaar_qodef_get_search_page_layout' ) ) {
	/**
	 * Function which create query for blog lists
	 */
	function bazaar_qodef_get_search_page_layout() {
		global $wp_query;
		$path   = apply_filters( 'bazaar_qodef_search_page_path', 'templates/page' );
		$type   = apply_filters( 'bazaar_qodef_search_page_layout', 'default' );
		$module = apply_filters( 'bazaar_qodef_search_page_module', 'search' );
		$plugin = apply_filters( 'bazaar_qodef_search_page_plugin_override', false );
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$params = array(
			'type'          => $type,
			'query'         => $wp_query,
			'paged'         => $paged,
			'max_num_pages' => bazaar_qodef_get_max_number_of_pages(),
		);
		
		$params = apply_filters( 'bazaar_qodef_search_page_params', $params );
		
		bazaar_qodef_get_module_template_part( $path . '/' . $type, $module, '', $params, $plugin );
	}
}