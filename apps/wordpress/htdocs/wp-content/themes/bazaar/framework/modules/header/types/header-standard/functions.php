<?php

if ( ! function_exists( 'bazaar_qodef_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function bazaar_qodef_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'BazaarQodef\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'bazaar_qodef_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function bazaar_qodef_init_register_header_standard_type() {
		add_filter( 'bazaar_qodef_register_header_type_class', 'bazaar_qodef_register_header_standard_type' );
	}
	
	add_action( 'bazaar_qodef_before_header_function_init', 'bazaar_qodef_init_register_header_standard_type' );
}