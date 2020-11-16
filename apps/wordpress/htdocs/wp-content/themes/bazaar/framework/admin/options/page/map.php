<?php

if ( ! function_exists( 'bazaar_qodef_page_options_map' ) ) {
	function bazaar_qodef_page_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_page_page',
				'title' => esc_html__( 'Page', 'bazaar' ),
				'icon'  => 'fa fa-file-text-o'
			)
		);
		
		/***************** Page Layout - begin **********************/
		
		$panel_sidebar = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_sidebar',
				'title' => esc_html__( 'Page Style', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'page_show_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'bazaar' ),
				'default_value' => 'yes',
				'parent'        => $panel_sidebar
			)
		);
		
		/***************** Page Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		$panel_content = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content',
				'title' => esc_html__( 'Content Style', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding',
				'default_value' => '',
				'label'         => esc_html__( 'Content Top Padding for Template in Full Width', 'bazaar' ),
				'description'   => esc_html__( 'Enter top padding for content area for templates in full width. If you set this value then it\'s important to set also Content top padding for mobile header value', 'bazaar' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding_in_grid',
				'default_value' => '',
				'label'         => esc_html__( 'Content Top Padding for Templates in Grid', 'bazaar' ),
				'description'   => esc_html__( 'Enter top padding for content area for Templates in grid. If you set this value then it\'s important to set also Content top padding for mobile header value', 'bazaar' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding_mobile',
				'default_value' => '',
				'label'         => esc_html__( 'Content Top Padding for Mobile Header', 'bazaar' ),
				'description'   => esc_html__( 'Enter top padding for content area for Mobile Header', 'bazaar' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Additional Page Layout - start *****************/
		
		do_action( 'bazaar_qodef_additional_page_options_map' );
		
		/***************** Additional Page Layout - end *****************/
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_page_options_map', 8 );
}