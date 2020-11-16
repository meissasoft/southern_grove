<?php

if ( ! function_exists( 'bazaar_qodef_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function bazaar_qodef_register_blog_list_widget( $widgets ) {
		$widgets[] = 'BazaarQodefBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'bazaar_qodef_register_widgets', 'bazaar_qodef_register_blog_list_widget' );
}