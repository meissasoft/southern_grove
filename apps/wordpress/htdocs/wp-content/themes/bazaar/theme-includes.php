<?php

//define constants
define( 'QODE_ROOT', get_template_directory_uri() );
define( 'QODE_ROOT_DIR', get_template_directory() );
define( 'QODE_ASSETS_ROOT', get_template_directory_uri() . '/assets' );
define( 'QODE_ASSETS_ROOT_DIR', get_template_directory() . '/assets' );
define( 'QODE_FRAMEWORK_ROOT', get_template_directory_uri() . '/framework' );
define( 'QODE_FRAMEWORK_ROOT_DIR', get_template_directory() . '/framework' );
define( 'QODE_FRAMEWORK_ADMIN_ASSETS_ROOT', get_template_directory_uri() . '/framework/admin/assets' );
define( 'QODE_FRAMEWORK_MODULES_ROOT', get_template_directory_uri() . '/framework/modules' );
define( 'QODE_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory() . '/framework/modules' );
define( 'QODE_FRAMEWORK_HEADER_ROOT', get_template_directory_uri() . '/framework/modules/header' );
define( 'QODE_FRAMEWORK_HEADER_ROOT_DIR', get_template_directory() . '/framework/modules/header' );
define( 'QODE_FRAMEWORK_HEADER_TYPES_ROOT', get_template_directory_uri() . '/framework/modules/header/types' );
define( 'QODE_FRAMEWORK_HEADER_TYPES_ROOT_DIR', get_template_directory() . '/framework/modules/header/types' );
define( 'QODE_THEME_ENV', 'dev' );
define( 'QODE_PROFILE_SLUG', 'select' );

//include necessary files
include_once QODE_ROOT_DIR . '/framework/qodef-framework.php';
include_once QODE_ROOT_DIR . '/includes/nav-menu/qodef-menu.php';
require_once QODE_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once QODE_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once QODE_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once QODE_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( ! is_admin() ) {
	include_once QODE_ROOT_DIR . '/includes/qodef-body-class-functions.php';
	include_once QODE_ROOT_DIR . '/includes/qodef-loading-spinners.php';
}