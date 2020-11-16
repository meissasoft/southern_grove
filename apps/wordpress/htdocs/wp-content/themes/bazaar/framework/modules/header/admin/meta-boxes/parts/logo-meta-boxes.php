<?php

if ( ! function_exists( 'bazaar_qodef_logo_meta_box_map' ) ) {
	function bazaar_qodef_logo_meta_box_map() {
		
		$logo_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => apply_filters( 'bazaar_qodef_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Logo', 'bazaar' ),
				'name'  => 'logo_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'bazaar' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'bazaar' ),
				'parent'      => $logo_meta_box
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'bazaar' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'bazaar' ),
				'parent'      => $logo_meta_box
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'bazaar' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'bazaar' ),
				'parent'      => $logo_meta_box
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'bazaar' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'bazaar' ),
				'parent'      => $logo_meta_box
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'bazaar' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'bazaar' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_logo_meta_box_map', 47 );
}