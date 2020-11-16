<?php

if ( ! function_exists( 'bazaar_qodef_portfolio_options_map' ) ) {
	function bazaar_qodef_portfolio_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'select-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'select-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'select-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'select-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'select-core' ),
				'default_value' => '4',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'select-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'2' => esc_html__( '2 Columns', 'select-core' ),
					'3' => esc_html__( '3 Columns', 'select-core' ),
					'4' => esc_html__( '4 Columns', 'select-core' ),
					'5' => esc_html__( '5 Columns', 'select-core' )
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'select-core' ),
				'default_value' => 'normal',
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'select-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'normal' => esc_html__( 'Normal', 'select-core' ),
					'small'  => esc_html__( 'Small', 'select-core' ),
					'tiny'   => esc_html__( 'Tiny', 'select-core' ),
					'no'     => esc_html__( 'No Space', 'select-core' )
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'select-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'select-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'select-core' ),
					'landscape' => esc_html__( 'Landscape', 'select-core' ),
					'portrait'  => esc_html__( 'Portrait', 'select-core' ),
					'square'    => esc_html__( 'Square', 'select-core' )
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'select-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'select-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'select-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'select-core' )
				)
			)
		);
		
		$panel = bazaar_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'select-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'select-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'select-core' ),
				'parent'        => $panel,
				'options'       => array(
					'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'select-core' ),
					'images'            => esc_html__( 'Portfolio Images', 'select-core' ),
					'small-images'      => esc_html__( 'Portfolio Small Images', 'select-core' ),
					'slider'            => esc_html__( 'Portfolio Slider', 'select-core' ),
					'small-slider'      => esc_html__( 'Portfolio Small Slider', 'select-core' ),
					'gallery'           => esc_html__( 'Portfolio Gallery', 'select-core' ),
					'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'select-core' ),
					'masonry'           => esc_html__( 'Portfolio Masonry', 'select-core' ),
					'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'select-core' ),
					'custom'            => esc_html__( 'Portfolio Custom', 'select-core' ),
					'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'select-core' )
				),
				'args'          => array(
					'dependence' => true,
					'show'       => array(
						'huge-images'       => '',
						'images'            => '',
						'small-images'      => '',
						'slider'            => '',
						'small-slider'      => '',
						'gallery'           => '#qodef_portfolio_gallery_container',
						'small-gallery'     => '#qodef_portfolio_gallery_container',
						'masonry'           => '#qodef_portfolio_masonry_container',
						'small-masonry'     => '#qodef_portfolio_masonry_container',
						'custom'            => '',
						'full-width-custom' => ''
					),
					'hide'       => array(
						'huge-images'       => '#qodef_portfolio_gallery_container, #qodef_portfolio_masonry_container',
						'images'            => '#qodef_portfolio_gallery_container, #qodef_portfolio_masonry_container',
						'small-images'      => '#qodef_portfolio_gallery_container, #qodef_portfolio_masonry_container',
						'slider'            => '#qodef_portfolio_gallery_container, #qodef_portfolio_masonry_container',
						'small-slider'      => '#qodef_portfolio_gallery_container, #qodef_portfolio_masonry_container',
						'gallery'           => '#qodef_portfolio_masonry_container',
						'small-gallery'     => '#qodef_portfolio_masonry_container',
						'masonry'           => '#qodef_portfolio_gallery_container',
						'small-masonry'     => '#qodef_portfolio_gallery_container',
						'custom'            => '#qodef_portfolio_gallery_container, #qodef_portfolio_masonry_container',
						'full-width-custom' => '#qodef_portfolio_gallery_container, #qodef_portfolio_masonry_container'
					)
				)
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'hidden_property' => 'portfolio_single_template',
				'hidden_values'   => array(
					'huge-images',
					'images',
					'small-images',
					'slider',
					'small-slider',
					'masonry',
					'small-masonry',
					'custom',
					'full-width-custom'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'select-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'select-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'select-core' ),
					'three' => esc_html__( '3 Columns', 'select-core' ),
					'four'  => esc_html__( '4 Columns', 'select-core' )
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'select-core' ),
				'default_value' => 'normal',
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'select-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => array(
					'normal' => esc_html__( 'Normal', 'select-core' ),
					'small'  => esc_html__( 'Small', 'select-core' ),
					'tiny'   => esc_html__( 'Tiny', 'select-core' ),
					'no'     => esc_html__( 'No Space', 'select-core' )
				)
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'hidden_property' => 'portfolio_single_template',
				'hidden_values'   => array(
					'huge-images',
					'images',
					'small-images',
					'slider',
					'small-slider',
					'gallery',
					'small-gallery',
					'custom',
					'full-width-custom'
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'select-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'select-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'select-core' ),
					'three' => esc_html__( '3 Columns', 'select-core' ),
					'four'  => esc_html__( '4 Columns', 'select-core' )
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'select-core' ),
				'default_value' => 'normal',
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'select-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => array(
					'normal' => esc_html__( 'Normal', 'select-core' ),
					'small'  => esc_html__( 'Small', 'select-core' ),
					'tiny'   => esc_html__( 'Tiny', 'select-core' ),
					'no'     => esc_html__( 'No Space', 'select-core' )
				)
			)
		);
		
		/***************** Masonry Layout *****************/
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'select-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'select-core' ),
					'yes' => esc_html__( 'Yes', 'select-core' ),
					'no'  => esc_html__( 'No', 'select-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'select-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'select-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'select-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'select-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'select-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'select-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'select-core' ),
				'parent'        => $panel,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '#qodef_navigate_same_category_container'
				)
			)
		);
		
		$container_navigate_category = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'hidden_property' => 'portfolio_single_hide_pagination',
				'hidden_value'    => 'yes'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'select-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'select-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'select-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'select-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_portfolio_options_map', 14 );
}