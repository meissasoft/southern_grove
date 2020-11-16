<?php
include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-functions.php';

if ( bazaar_qodef_is_woocommerce_installed() ) {
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/admin/options-map/woocommerce-map.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/admin/meta-boxes/woocommerce-meta-boxes.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-template-hooks.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/woocommerce-config.php';

	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/shortcodes/shortcodes-functions.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/widgets/load.php';

	foreach ( glob( QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/*/load.php' ) as $plugin_load ) {
		include_once $plugin_load;
	}
}