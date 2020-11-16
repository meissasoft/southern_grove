<?php

if (!function_exists('bazaar_qodef_woocommerce_yith_template_single_title')) {
	/**
	 * Function for overriding product title template in YITH Quick View plugin template
	 */
	function bazaar_qodef_woocommerce_yith_template_single_title() {

		the_title('<h3  itemprop="name" class="qodef-yith-product-title entry-title">', '</h3>');
	}
}