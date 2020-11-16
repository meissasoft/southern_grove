<?php

if ( ! function_exists('bazaar_qodef_blog_options_map') ) {
	function bazaar_qodef_blog_options_map() {

		bazaar_qodef_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__('Blog', 'bazaar'),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = bazaar_qodef_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'bazaar')
			)
		);

		bazaar_qodef_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout for Archive Pages', 'bazaar'),
			'description' => esc_html__('Choose a sidebar layout for archived blog post lists', 'bazaar'),
			'default_value' => '',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				''		            => esc_html__('Default', 'bazaar'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'bazaar'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'bazaar'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'bazaar'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'bazaar'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'bazaar')
			)
		));
		
		$bazaar_custom_sidebars = bazaar_qodef_get_custom_sidebars();
		if(count($bazaar_custom_sidebars) > 0) {
			bazaar_qodef_add_admin_field(array(
				'name' => 'archive_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display for Archive Pages', 'bazaar'),
				'description' => esc_html__('Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'bazaar'),
				'parent' => $panel_blog_lists,
				'options' => bazaar_qodef_get_custom_sidebars(),
				'args'        => array(
					'select2'	=> true
				)
			));
		}

		bazaar_qodef_add_admin_field(array(
			'name'        => 'blog_pagination_type',
			'type'        => 'select',
			'label'       => esc_html__('Pagination Type', 'bazaar'),
			'description' => esc_html__('Choose a pagination layout for Blog List', 'bazaar'),
			'parent'      => $panel_blog_lists,
			'default_value' => 'standard',
			'options'     => array(
				'standard'		  => esc_html__('Standard', 'bazaar'),
				'load-more'		  => esc_html__('Load More', 'bazaar'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'bazaar'),
				'no-pagination'   => esc_html__('No Pagination', 'bazaar')
			)
		));
	
		bazaar_qodef_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '40',
				'label' => esc_html__('Number of Words in Excerpt', 'bazaar'),
				'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'bazaar'),
				'parent' => $panel_blog_lists,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = bazaar_qodef_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'bazaar')
			)
		);

		bazaar_qodef_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'bazaar'),
			'description' => esc_html__('Choose a sidebar layout for Blog Single pages', 'bazaar'),
			'default_value'	=> '',
			'parent'      => $panel_blog_single,
			'options'     => array(
				''		            => esc_html__('Default', 'bazaar'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'bazaar'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'bazaar'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'bazaar'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'bazaar'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'bazaar')
			)
		));

		if(count($bazaar_custom_sidebars) > 0) {
			bazaar_qodef_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'bazaar'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'bazaar'),
				'parent' => $panel_blog_single,
				'options' => bazaar_qodef_get_custom_sidebars(),
				'args'        => array(
					'select2'	=> true
				)
			));
		}
		
		bazaar_qodef_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_blog',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'bazaar'),
				'description' => esc_html__('Enabling this option will show title area on single post pages', 'bazaar'),
				'parent'      => $panel_blog_single,
				'options'     => bazaar_qodef_get_yes_no_select_array(),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		bazaar_qodef_add_admin_field(array(
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Post Title in Title Area', 'bazaar'),
			'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'bazaar'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		bazaar_qodef_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> esc_html__('Show Related Posts', 'bazaar'),
			'description'   => esc_html__('Enabling this option will show related posts on single post pages', 'bazaar'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		bazaar_qodef_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments Form', 'bazaar'),
			'description'   => esc_html__('Enabling this option will show comments form on single post pages', 'bazaar'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		bazaar_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__('Enable Prev/Next Single Post Navigation Links', 'bazaar'),
				'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'bazaar'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qodef_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = bazaar_qodef_add_admin_container(
			array(
				'name' => 'qodef_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		bazaar_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Navigation Only in Current Category', 'bazaar'),
				'description' => esc_html__('Limit your navigation only through current category', 'bazaar'),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		bazaar_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => esc_html__('Show Author Info Box', 'bazaar'),
				'description' => esc_html__('Enabling this option will display author name and descriptions on single post pages', 'bazaar'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qodef_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = bazaar_qodef_add_admin_container(
			array(
				'name' => 'qodef_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		bazaar_qodef_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => esc_html__('Show Author Email', 'bazaar'),
				'description' => esc_html__('Enabling this option will show author email', 'bazaar'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		bazaar_qodef_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => esc_html__('Show Author Social Icons', 'bazaar'),
				'description' => esc_html__('Enabling this option will show author social icons on single post pages', 'bazaar'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		do_action('bazaar_qodef_blog_single_options_map', $panel_blog_single);
	}

	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_blog_options_map', 13);
}