<?php

if ( ! function_exists( 'bazaar_qodef_map_post_gallery_meta' ) ) {
	
	function bazaar_qodef_map_post_gallery_meta() {
		$gallery_post_format_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'bazaar' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		bazaar_qodef_add_multiple_images_field(
			array(
				'name'        => 'qodef_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'bazaar' ),
				'description' => esc_html__( 'Choose your gallery images', 'bazaar' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_post_gallery_meta', 21 );
}
