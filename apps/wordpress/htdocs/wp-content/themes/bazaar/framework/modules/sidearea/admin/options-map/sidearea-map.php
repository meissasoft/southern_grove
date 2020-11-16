<?php

if ( ! function_exists( 'bazaar_qodef_sidearea_options_map' ) ) {
	function bazaar_qodef_sidearea_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_side_area_page',
				'title' => esc_html__( 'Side Area', 'bazaar' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$side_area_panel = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Side Area', 'bazaar' ),
				'name'  => 'side_area',
				'page'  => '_side_area_page'
			)
		);
		
		$side_area_icon_style_group = bazaar_qodef_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'side_area_icon_style_group',
				'title'       => esc_html__( 'Side Area Icon Style', 'bazaar' ),
				'description' => esc_html__( 'Define styles for Side Area icon', 'bazaar' )
			)
		);
		
		$side_area_icon_style_row1 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row1'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_color',
				'label'  => esc_html__( 'Color', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'bazaar' )
			)
		);
		
		$side_area_icon_style_row2 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row2',
				'next'   => true
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_color',
				'label'  => esc_html__( 'Close Icon Color', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_hover_color',
				'label'  => esc_html__( 'Close Icon Hover Color', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'text',
				'name'          => 'side_area_width',
				'default_value' => '',
				'label'         => esc_html__( 'Side Area Width', 'bazaar' ),
				'description'   => esc_html__( 'Enter a width for Side Area', 'bazaar' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'color',
				'name'        => 'side_area_background_color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Choose a background color for Side Area', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'text',
				'name'        => 'side_area_padding',
				'label'       => esc_html__( 'Padding', 'bazaar' ),
				'description' => esc_html__( 'Define padding for Side Area in format top right bottom left', 'bazaar' ),
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'selectblank',
				'name'          => 'side_area_aligment',
				'default_value' => '',
				'label'         => esc_html__( 'Text Alignment', 'bazaar' ),
				'description'   => esc_html__( 'Choose text alignment for side area', 'bazaar' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'bazaar' ),
					'left'   => esc_html__( 'Left', 'bazaar' ),
					'center' => esc_html__( 'Center', 'bazaar' ),
					'right'  => esc_html__( 'Right', 'bazaar' )
				)
			)
		);
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_sidearea_options_map', 16 );
}