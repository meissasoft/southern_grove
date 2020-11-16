<?php

if ( ! function_exists( 'bazaar_qodef_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function bazaar_qodef_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'bazaar' ),
				'description'   => esc_html__( 'Default Sidebar', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'bazaar_qodef_register_sidebars', 1 );
}

if ( ! function_exists( 'bazaar_qodef_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates BazaarQodefSidebar object
	 */
	function bazaar_qodef_add_support_custom_sidebar() {
		add_theme_support( 'BazaarQodefSidebar' );
		
		if ( get_theme_support( 'BazaarQodefSidebar' ) ) {
			new BazaarQodefSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'bazaar_qodef_add_support_custom_sidebar' );
}