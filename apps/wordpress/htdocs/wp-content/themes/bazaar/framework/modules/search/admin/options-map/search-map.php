<?php

if ( ! function_exists( 'bazaar_qodef_search_options_map' ) ) {
	function bazaar_qodef_search_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'bazaar' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'bazaar' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		bazaar_qodef_add_admin_field( array(
			'name'          => 'search_page_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Layout', 'bazaar' ),
			'default_value' => 'in-grid',
			'description'   => esc_html__( 'Set layout. Default is in grid.', 'bazaar' ),
			'parent'        => $search_page_panel,
			'options'       => array(
				'in-grid'    => esc_html__( 'In Grid', 'bazaar' ),
				'full-width' => esc_html__( 'Full Width', 'bazaar' )
			)
		) );
		
		bazaar_qodef_add_admin_field( array(
			'name'          => 'search_page_sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'bazaar' ),
			'description'   => esc_html__( "Choose a sidebar layout for search page", 'bazaar' ),
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'       => esc_html__( 'No Sidebar', 'bazaar' ),
				'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'bazaar' ),
				'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'bazaar' ),
				'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'bazaar' ),
				'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'bazaar' )
			),
			'parent'        => $search_page_panel
		) );
		
		$bazaar_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		if ( count( $bazaar_custom_sidebars ) > 0 ) {
			bazaar_qodef_add_admin_field( array(
				'name'        => 'search_custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'bazaar' ),
				'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'bazaar' ),
				'parent'      => $search_page_panel,
				'options'     => $bazaar_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
		
		$search_panel = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'bazaar' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);

		bazaar_qodef_add_admin_field(
				array(
						'parent'      => $search_panel,
						'name'        => 'search_background_image',
						'type'        => 'image',
						'label'       => esc_html__('Background Image', 'bazaar'),
						'description' => esc_html__('Choose an Image for Full Screen Search', 'bazaar')
				)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_awesome',
				'label'         => esc_html__( 'Search Icon Pack', 'bazaar' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'bazaar' ),
				'options'       => bazaar_qodef_icon_collections()->getIconCollectionsExclude( array( 'linea_icons' ) )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'bazaar' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'bazaar' ),
			)
		);
		
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'bazaar' ),
				'description'   => esc_html__( 'Set size for icon', 'bazaar' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = bazaar_qodef_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'bazaar' ),
				'description' => esc_html__( 'Define color style for icon', 'bazaar' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = bazaar_qodef_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'bazaar' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'hidden_property' => 'enable_search_icon_text',
				'hidden_value'    => 'no'
			)
		);
		
		$enable_search_icon_text_group = bazaar_qodef_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'bazaar' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'bazaar' )
			)
		);
		
		$enable_search_icon_text_row = bazaar_qodef_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'bazaar' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'bazaar' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'bazaar' ),
				'default_value' => '',
				'options'       => bazaar_qodef_get_text_transform_array()
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'bazaar' ),
				'default_value' => '-1',
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'bazaar' ),
				'default_value' => '',
				'options'       => bazaar_qodef_get_font_style_array(),
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'bazaar' ),
				'default_value' => '',
				'options'       => bazaar_qodef_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = bazaar_qodef_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'bazaar' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_search_options_map', 15 );
}