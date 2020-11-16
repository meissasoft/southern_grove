<?php

if ( ! function_exists( 'bazaar_qodef_sidebar_options_map' ) ) {
	function bazaar_qodef_sidebar_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'bazaar' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'bazaar' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		bazaar_qodef_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'bazaar' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'bazaar' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'       => esc_html__( 'No Sidebar', 'bazaar' ),
				'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'bazaar' ),
				'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'bazaar' ),
				'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'bazaar' ),
				'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'bazaar' )
			)
		) );
		
		$bazaar_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		if ( count( $bazaar_custom_sidebars ) > 0 ) {
			bazaar_qodef_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'bazaar' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'bazaar' ),
				'parent'      => $sidebar_panel,
				'options'     => $bazaar_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_sidebar_options_map', 9 );
}