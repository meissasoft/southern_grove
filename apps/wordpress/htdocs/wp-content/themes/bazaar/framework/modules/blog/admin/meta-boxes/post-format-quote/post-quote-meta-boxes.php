<?php

if ( ! function_exists( 'bazaar_qodef_map_post_quote_meta' ) ) {
	function bazaar_qodef_map_post_quote_meta() {
		$quote_post_format_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'bazaar' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'bazaar' ),
				'description' => esc_html__( 'Enter Quote text', 'bazaar' ),
				'parent'      => $quote_post_format_meta_box,
			
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'bazaar' ),
				'description' => esc_html__( 'Enter Quote author', 'bazaar' ),
				'parent'      => $quote_post_format_meta_box,
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_post_quote_meta', 25 );
}