<?php

if ( ! function_exists( 'bazaar_qodef_map_content_bottom_meta' ) ) {
	function bazaar_qodef_map_content_bottom_meta() {
		
		$content_bottom_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => apply_filters( 'bazaar_qodef_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Content Bottom', 'bazaar' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'bazaar' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'bazaar' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''   => '#qodef_qodef_show_content_bottom_meta_container',
						'no' => '#qodef_qodef_show_content_bottom_meta_container'
					),
					'show'       => array(
						'yes' => '#qodef_qodef_show_content_bottom_meta_container'
					)
				)
			)
		);
		
		$show_content_bottom_meta_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'qodef_show_content_bottom_meta_container',
				'hidden_property' => 'qodef_enable_content_bottom_area_meta',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'bazaar' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'bazaar' ),
				'options'       => bazaar_qodef_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'qodef_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'bazaar' ),
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'qodef_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'bazaar' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_content_bottom_meta', 71 );
}