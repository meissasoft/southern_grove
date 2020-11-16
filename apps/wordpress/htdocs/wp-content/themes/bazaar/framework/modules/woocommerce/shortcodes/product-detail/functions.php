<?php

if ( ! function_exists( 'bazaar_qodef_add_product_detail_shortcode' ) ) {
	function bazaar_qodef_add_product_detail_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'QodeCore\CPT\Shortcodes\ProductDetail\ProductDetail',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	if ( bazaar_qodef_core_plugin_installed() ) {
		add_filter( 'qodef_core_filter_add_vc_shortcode', 'bazaar_qodef_add_product_detail_shortcode' );
	}
}

if ( ! function_exists( 'bazaar_qodef_add_product_detail_into_shortcodes_list' ) ) {
	function bazaar_qodef_add_product_detail_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'qodef_product_detail';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'bazaar_qodef_woocommerce_shortcodes_list', 'bazaar_qodef_add_product_detail_into_shortcodes_list' );
}