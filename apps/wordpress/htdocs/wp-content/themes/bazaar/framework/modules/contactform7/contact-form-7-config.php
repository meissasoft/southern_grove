<?php

if ( ! function_exists('bazaar_qodef_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function bazaar_qodef_contact_form_map() {
		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'bazaar'),
			'param_name' => 'html_class',
			'value' => array(
				esc_html__('Default', 'bazaar') => 'default',
				esc_html__('Custom Style 1', 'bazaar') => 'cf7_custom_style_1',
				esc_html__('Custom Style 2', 'bazaar') => 'cf7_custom_style_2',
				esc_html__('Custom Style 3', 'bazaar') => 'cf7_custom_style_3'
			),
			'description' => esc_html__('You can style each form element individually in Qode Options > Contact Form 7', 'bazaar')
		));
	}
	
	add_action('vc_after_init', 'bazaar_qodef_contact_form_map');
}