<?php

if ( ! function_exists('bazaar_qodef_breadcrumbs_title_type_options_map') ) {
	function bazaar_qodef_breadcrumbs_title_type_options_map($panel_typography) {
		
		bazaar_qodef_add_admin_section_title(
			array(
				'name'   => 'type_section_breadcrumbs',
				'title'  => esc_html__( 'Breadcrumbs', 'bazaar' ),
				'parent' => $panel_typography
			)
		);
	
		$group_page_breadcrumbs_styles = bazaar_qodef_add_admin_group(
			array(
				'name'        => 'group_page_breadcrumbs_styles',
				'title'       => esc_html__( 'Breadcrumbs', 'bazaar' ),
				'description' => esc_html__( 'Define styles for page breadcrumbs', 'bazaar' ),
				'parent'      => $panel_typography
			)
		);
	
			$row_page_breadcrumbs_styles_1 = bazaar_qodef_add_admin_row(
				array(
					'name'   => 'row_page_breadcrumbs_styles_1',
					'parent' => $group_page_breadcrumbs_styles
				)
			);
	
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'colorsimple',
						'name'          => 'page_breadcrumb_color',
						'default_value' => '',
						'label'         => esc_html__( 'Text Color', 'bazaar' ),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
				
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'textsimple',
						'name'          => 'page_breadcrumb_font_size',
						'default_value' => '',
						'label'         => esc_html__( 'Font Size', 'bazaar' ),
						'args'          => array(
							'suffix' => 'px'
						),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
				
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'textsimple',
						'name'          => 'page_breadcrumb_line_height',
						'default_value' => '',
						'label'         => esc_html__( 'Line Height', 'bazaar' ),
						'args'          => array(
							'suffix' => 'px'
						),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
				
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'selectblanksimple',
						'name'          => 'page_breadcrumb_text_transform',
						'default_value' => '',
						'label'         => esc_html__( 'Text Transform', 'bazaar' ),
						'options'       => bazaar_qodef_get_text_transform_array(),
						'parent'        => $row_page_breadcrumbs_styles_1
					)
				);
	
			$row_page_breadcrumbs_styles_2 = bazaar_qodef_add_admin_row(
				array(
					'name'   => 'row_page_breadcrumbs_styles_2',
					'parent' => $group_page_breadcrumbs_styles,
					'next'   => true
				)
			);
	
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'fontsimple',
						'name'          => 'page_breadcrumb_google_fonts',
						'default_value' => '-1',
						'label'         => esc_html__( 'Font Family', 'bazaar' ),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
				
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'selectblanksimple',
						'name'          => 'page_breadcrumb_font_style',
						'default_value' => '',
						'label'         => esc_html__( 'Font Style', 'bazaar' ),
						'options'       => bazaar_qodef_get_font_style_array(),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
				
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'selectblanksimple',
						'name'          => 'page_breadcrumb_font_weight',
						'default_value' => '',
						'label'         => esc_html__( 'Font Weight', 'bazaar' ),
						'options'       => bazaar_qodef_get_font_weight_array(),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
				
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'textsimple',
						'name'          => 'page_breadcrumb_letter_spacing',
						'default_value' => '',
						'label'         => esc_html__( 'Letter Spacing', 'bazaar' ),
						'args'          => array(
							'suffix' => 'px'
						),
						'parent'        => $row_page_breadcrumbs_styles_2
					)
				);
	
			$row_page_breadcrumbs_styles_3 = bazaar_qodef_add_admin_row(
				array(
					'name'   => 'row_page_breadcrumbs_styles_3',
					'parent' => $group_page_breadcrumbs_styles,
					'next'   => true
				)
			);
	
				bazaar_qodef_add_admin_field(
					array(
						'type'          => 'colorsimple',
						'name'          => 'page_breadcrumb_hovercolor',
						'default_value' => '',
						'label'         => esc_html__( 'Hover/Active Text Color', 'bazaar' ),
						'parent'        => $row_page_breadcrumbs_styles_3
					)
				);
    }

	add_action( 'bazaar_qodef_additional_title_typography_options_map', 'bazaar_qodef_breadcrumbs_title_type_options_map');
}