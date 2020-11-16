<?php

if ( ! function_exists( 'bazaar_qodef_map_sidebar_meta' ) ) {
	function bazaar_qodef_map_sidebar_meta() {
		$qodef_sidebar_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => apply_filters( 'bazaar_qodef_set_scope_for_meta_boxes', array( 'page' ) ),
				'title' => esc_html__( 'Sidebar', 'bazaar' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Layout', 'bazaar' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'bazaar' ),
				'parent'      => $qodef_sidebar_meta_box,
				'options'     => array(
					''                 => esc_html__( 'Default', 'bazaar' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'bazaar' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'bazaar' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'bazaar' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'bazaar' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'bazaar' )
				)
			)
		);
		
		$qodef_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		if ( count( $qodef_custom_sidebars ) > 0 ) {
			bazaar_qodef_create_meta_box_field(
				array(
					'name'        => 'qodef_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'bazaar' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'bazaar' ),
					'parent'      => $qodef_sidebar_meta_box,
					'options'     => $qodef_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_sidebar_meta', 31 );
}