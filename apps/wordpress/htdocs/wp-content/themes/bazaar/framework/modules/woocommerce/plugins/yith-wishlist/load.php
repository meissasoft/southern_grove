<?php

if ( bazaar_qodef_is_yith_wcwl_install() ) {
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-conf.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-functions.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-hooks.php';
	include_once QODE_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/widgets/load.php';
}