<?php

if ( ! function_exists( 'bazaar_qodef_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function bazaar_qodef_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'bazaar' );
		
		return $templates;
	}
	
	add_filter( 'bazaar_qodef_register_blog_templates', 'bazaar_qodef_register_blog_standard_template_file' );
}

if ( ! function_exists( 'bazaar_qodef_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function bazaar_qodef_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'bazaar' );
		
		return $options;
	}
	
	add_filter( 'bazaar_qodef_blog_list_type_global_option', 'bazaar_qodef_set_blog_standard_type_global_option' );
}