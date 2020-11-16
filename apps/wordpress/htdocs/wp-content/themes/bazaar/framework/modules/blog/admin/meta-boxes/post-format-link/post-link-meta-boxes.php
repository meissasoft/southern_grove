<?php

if ( ! function_exists( 'bazaar_qodef_map_post_link_meta' ) ) {
	function bazaar_qodef_map_post_link_meta() {
		$link_post_format_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'bazaar' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'bazaar' ),
				'description' => esc_html__( 'Enter link', 'bazaar' ),
				'parent'      => $link_post_format_meta_box,
			
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_post_link_meta', 24 );
}