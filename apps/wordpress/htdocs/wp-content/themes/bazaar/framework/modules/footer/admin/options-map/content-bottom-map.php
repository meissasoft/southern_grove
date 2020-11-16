<?php

if ( ! function_exists( 'bazaar_qodef_content_bottom_options_map' ) ) {
	function bazaar_qodef_content_bottom_options_map() {
		
		$panel_content_bottom = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'bazaar' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_content_bottom_area_container'
				),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'hidden_property' => 'enable_content_bottom_area',
				'hidden_value'    => 'no'
			)
		);
		
		$bazaar_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'bazaar' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'bazaar' ),
				'options'       => $bazaar_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'bazaar' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'bazaar' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'bazaar_qodef_additional_page_options_map', 'bazaar_qodef_content_bottom_options_map' );
}