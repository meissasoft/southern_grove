<?php

foreach ( glob( QODE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'bazaar_qodef_map_blog_meta' ) ) {
	function bazaar_qodef_map_blog_meta() {
		$qode_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$qode_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'bazaar' ),
				'name'  => 'blog_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'bazaar' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'bazaar' ),
				'parent'      => $blog_meta_box,
				'options'     => $qode_blog_categories
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'bazaar' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'bazaar' ),
				'parent'      => $blog_meta_box,
				'options'     => $qode_blog_categories,
				'args'        => array( "col_width" => 3 )
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'bazaar' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'bazaar' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'bazaar' ),
					'standard'        => esc_html__( 'Standard', 'bazaar' ),
					'load-more'       => esc_html__( 'Load More', 'bazaar' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'bazaar' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'bazaar' )
				)
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'qodef_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'bazaar' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'bazaar' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_blog_meta', 30 );
}