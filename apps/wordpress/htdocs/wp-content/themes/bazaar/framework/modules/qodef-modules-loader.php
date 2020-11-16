<?php

if ( ! function_exists( 'bazaar_qodef_load_modules' ) ) {
	/**
	 * Loades all modules by going through all folders that are placed directly in modules folder
	 * and loads load.php file in each. Hooks to bazaar_qodef_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function bazaar_qodef_load_modules() {
		foreach ( glob( QODE_FRAMEWORK_ROOT_DIR . '/modules/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'bazaar_qodef_before_options_map', 'bazaar_qodef_load_modules' );
}