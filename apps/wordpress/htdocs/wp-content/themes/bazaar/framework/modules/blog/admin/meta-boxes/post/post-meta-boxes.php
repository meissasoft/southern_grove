<?php

/*** Post Settings ***/

if ( ! function_exists( 'bazaar_qodef_map_post_meta' ) ) {
	function bazaar_qodef_map_post_meta() {
		
		$post_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'bazaar' ),
				'name'  => 'post-meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'bazaar' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'bazaar' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
				'options'       => array(
					''                 => esc_html__( 'Default', 'bazaar' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'bazaar' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'bazaar' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'bazaar' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'bazaar' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'bazaar' )
				)
			)
		);
		
		$bazaar_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		if ( count( $bazaar_custom_sidebars ) > 0 ) {
			bazaar_qodef_create_meta_box_field( array(
				'name'        => 'qodef_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'bazaar' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'bazaar' ),
				'parent'      => $post_meta_box,
				'options'     => bazaar_qodef_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'bazaar' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'bazaar' ),
				'parent'      => $post_meta_box
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Fixed Proportion', 'bazaar' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'bazaar' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'bazaar' ),
					'large-width'        => esc_html__( 'Large Width', 'bazaar' ),
					'large-height'       => esc_html__( 'Large Height', 'bazaar' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'bazaar' )
				)
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Original Proportion', 'bazaar' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'bazaar' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'bazaar' ),
					'large-width' => esc_html__( 'Large Width', 'bazaar' )
				)
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'bazaar' ),
				'parent'        => $post_meta_box,
				'options'       => bazaar_qodef_get_yes_no_select_array()
			)
		);

		do_action('bazaar_qodef_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_post_meta', 20 );
}
