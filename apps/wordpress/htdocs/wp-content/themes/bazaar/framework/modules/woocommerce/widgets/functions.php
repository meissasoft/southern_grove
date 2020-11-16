<?php

if ( ! function_exists( 'bazaar_qodef_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function bazaar_qodef_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'BazaarQodefWoocommerceDropdownCart';

		return $widgets;
	}

	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_woocommerce_dropdown_cart_widget' );
}