<?php

if ( ! function_exists( 'qodef_core_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 */
	function qodef_core_load_widget_class() {
		include_once 'widget-class.php';
	}

	add_action( 'bazaar_qodef_before_options_map', 'qodef_core_load_widget_class' );
}

if ( ! function_exists( 'qodef_core_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to bazaar_qodef_after_options_map action
	 */
	function qodef_core_load_widgets() {
		if ( qodef_core_theme_installed() ) {
			foreach ( glob( QODE_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php' ) as $widget_load ) {
				include_once $widget_load;
			}
		}

		include_once 'widget-loader.php';
	}

	add_action( 'bazaar_qodef_before_options_map', 'qodef_core_load_widgets' );
}