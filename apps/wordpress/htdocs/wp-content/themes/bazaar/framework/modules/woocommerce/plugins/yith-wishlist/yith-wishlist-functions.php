<?php

if(!function_exists('bazaar_qodef_is_yith_wishlist_installed')) {
	function bazaar_qodef_is_yith_wishlist_installed() {
		return defined('YITH_WCWL');
	}
}

if(!function_exists('bazaar_qodef_woocommerce_wishlist_shortcode')) {
	function bazaar_qodef_woocommerce_wishlist_shortcode() {

		if(bazaar_qodef_is_yith_wishlist_installed()) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}
	}
}

if(!function_exists('qodef_product_ajax_wishlist')) {
	function qodef_product_ajax_wishlist(){
		check_ajax_referer( 'bazaar_select_product_wishlist_nonce_' . sanitize_text_field( $_POST['product_wishlist_id'] ), 'product_wishlist_nonce' );
		$data = array(
			'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0
		);
		wp_send_json($data); exit;
	}

	add_action('wp_ajax_qodef_product_ajax_wishlist', 'qodef_product_ajax_wishlist');
	add_action('wp_ajax_nopriv_qodef_product_ajax_wishlist', 'qodef_product_ajax_wishlist');
}

