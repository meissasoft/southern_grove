<?php

if ( ! function_exists( 'bazaar_qodef_map_footer_meta' ) ) {
	function bazaar_qodef_map_footer_meta() {
		
		$footer_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => apply_filters( 'bazaar_qodef_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Footer', 'bazaar' ),
				'name'  => 'footer_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Footer for this Page', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'bazaar' ),
				'parent'        => $footer_meta_box
			)
		);

        bazaar_qodef_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'qodef_footer_in_grid_meta',
                'default_value' => '',
                'options'       => bazaar_qodef_get_yes_no_select_array(),
                'label'         => esc_html__( 'Set Footer in Grid on this Page', 'bazaar' ),
                'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'bazaar' ),
                'parent'        => $footer_meta_box,
            )
        );
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_show_footer_top_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Top', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'bazaar' ),
				'parent'        => $footer_meta_box,
				'options'       => bazaar_qodef_get_yes_no_select_array()
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_show_footer_bottom_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Bottom', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'bazaar' ),
				'parent'        => $footer_meta_box,
				'options'       => bazaar_qodef_get_yes_no_select_array()
			)
		);

        bazaar_qodef_create_meta_box_field(
            array(
                'name'          => 'qodef_uncovering_footer_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Uncovering Footer', 'bazaar'),
                'description'   => esc_html__('Enabling this option will make Footer gradually appear on scroll', 'bazaar'),
                'parent'        => $footer_meta_box,
                'options'       => bazaar_qodef_get_yes_no_select_array()
            )
        );
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_footer_meta', 70 );
}