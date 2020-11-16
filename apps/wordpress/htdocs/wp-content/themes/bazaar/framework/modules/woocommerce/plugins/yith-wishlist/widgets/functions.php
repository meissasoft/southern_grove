<?php

if ( ! function_exists( 'bazaar_qodef_register_yith_wishlist_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function bazaar_qodef_register_yith_wishlist_widget( $widgets ) {
		$widgets[] = 'BazaarQodefYithWishlist';

		return $widgets;
	}

	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_yith_wishlist_widget' );
}