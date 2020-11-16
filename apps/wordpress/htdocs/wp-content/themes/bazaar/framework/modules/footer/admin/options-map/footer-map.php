<?php

if ( ! function_exists( 'bazaar_qodef_footer_options_map' ) ) {
	function bazaar_qodef_footer_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'bazaar' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);
		
		$footer_panel = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'bazaar' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'bazaar' ),
				'parent'        => $footer_panel,
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_show_footer_top_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '4',
				'label'         => esc_html__( 'Footer Top Columns', 'bazaar' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'bazaar' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'bazaar' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'bazaar' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'bazaar' ),
					'left'   => esc_html__( 'Left', 'bazaar' ),
					'center' => esc_html__( 'Center', 'bazaar' ),
					'right'  => esc_html__( 'Right', 'bazaar' )
				),
				'parent'        => $show_footer_top_container,
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Set background color for top footer area', 'bazaar' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_show_footer_bottom_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_bottom_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '4',
				'label'         => esc_html__( 'Footer Bottom Columns', 'bazaar' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'bazaar' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'bazaar' ),
				'parent'      => $show_footer_bottom_container
			)
		);

        bazaar_qodef_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'uncovering_footer',
                'default_value' => 'no',
                'label' => esc_html__('Uncovering Footer', 'bazaar'),
                'description' => esc_html__('Enabling this option will make Footer gradually appear on scroll', 'bazaar'),
                'parent' => $footer_panel,
            )
        );
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_footer_options_map', 5 );
}