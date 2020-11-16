<?php

if ( ! function_exists( 'bazaar_qodef_social_options_map' ) ) {
	function bazaar_qodef_social_options_map() {

	    $page = '_social_page';
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social Networks', 'bazaar' ),
				'icon'  => 'fa fa-share-alt'
			)
		);
		
		/**
		 * Enable Social Share
		 */
		$panel_social_share = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_social_share',
				'title' => esc_html__( 'Enable Social Share', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Social Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_panel_social_networks, #qodef_panel_show_social_share_on'
				),
				'parent'        => $panel_social_share
			)
		);
		
		$panel_show_social_share_on = bazaar_qodef_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_show_social_share_on',
				'title'           => esc_html__( 'Show Social Share On', 'bazaar' ),
				'hidden_property' => 'enable_social_share',
				'hidden_value'    => 'no'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_post',
				'default_value' => 'no',
				'label'         => esc_html__( 'Posts', 'bazaar' ),
				'description'   => esc_html__( 'Show Social Share on Blog Posts', 'bazaar' ),
				'parent'        => $panel_show_social_share_on
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_page',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pages', 'bazaar' ),
				'description'   => esc_html__( 'Show Social Share on Pages', 'bazaar' ),
				'parent'        => $panel_show_social_share_on
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
		do_action('bazaar_qodef_post_types_social_share', $panel_show_social_share_on);
		
		/**
		 * Social Share Networks
		 */
		$panel_social_networks = bazaar_qodef_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_social_networks',
				'title'           => esc_html__( 'Social Networks', 'bazaar' ),
				'hidden_property' => 'enable_social_share',
				'hidden_value'    => 'no'
			)
		);
		
		/**
		 * Facebook
		 */
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'facebook_title',
				'title'  => esc_html__( 'Share on Facebook', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Facebook', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_facebook_share_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_facebook_share_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_facebook_share_container',
				'hidden_property' => 'enable_facebook_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'facebook_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'bazaar' ),
				'parent'        => $enable_facebook_share_container
			)
		);
		
		/**
		 * Twitter
		 */
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'twitter_title',
				'title'  => esc_html__( 'Share on Twitter', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_twitter_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Twitter', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_twitter_share_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_twitter_share_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_twitter_share_container',
				'hidden_property' => 'enable_twitter_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'twitter_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'bazaar' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'twitter_via',
				'default_value' => '',
				'label'         => esc_html__( 'Via', 'bazaar' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		/**
		 * Google Plus
		 */
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'google_plus_title',
				'title'  => esc_html__( 'Share on Google Plus', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_google_plus_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Google Plus', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_google_plus_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_google_plus_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_google_plus_container',
				'hidden_property' => 'enable_google_plus_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'google_plus_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'bazaar' ),
				'parent'        => $enable_google_plus_container
			)
		);
		
		/**
		 * Linked In
		 */
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'linkedin_title',
				'title'  => esc_html__( 'Share on LinkedIn', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_linkedin_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_linkedin_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_linkedin_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_linkedin_container',
				'hidden_property' => 'enable_linkedin_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'linkedin_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'bazaar' ),
				'parent'        => $enable_linkedin_container
			)
		);
		
		/**
		 * Tumblr
		 */
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'tumblr_title',
				'title'  => esc_html__( 'Share on Tumblr', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_tumblr_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_tumblr_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_tumblr_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_tumblr_container',
				'hidden_property' => 'enable_tumblr_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'tumblr_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'bazaar' ),
				'parent'        => $enable_tumblr_container
			)
		);
		
		/**
		 * Pinterest
		 */
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'pinterest_title',
				'title'  => esc_html__( 'Share on Pinterest', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_pinterest_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_pinterest_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_pinterest_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_pinterest_container',
				'hidden_property' => 'enable_pinterest_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'pinterest_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'bazaar' ),
				'parent'        => $enable_pinterest_container
			)
		);
		
		/**
		 * VK
		 */
		bazaar_qodef_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'vk_title',
				'title'  => esc_html__( 'Share on VK', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_vk_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via VK', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_vk_container'
				),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_vk_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_vk_container',
				'hidden_property' => 'enable_vk_share',
				'hidden_value'    => 'no',
				'parent'          => $panel_social_networks
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'vk_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'bazaar' ),
				'parent'        => $enable_vk_container
			)
		);
		
		if ( defined( 'QODEF_TWITTER_FEED_VERSION' ) ) {
			$twitter_panel = bazaar_qodef_add_admin_panel(
				array(
					'title' => esc_html__( 'Twitter', 'bazaar' ),
					'name'  => 'panel_twitter',
					'page'  => '_social_page'
				)
			);
			
			bazaar_qodef_add_admin_twitter_button(
				array(
					'name'   => 'twitter_button',
					'parent' => $twitter_panel
				)
			);
		}
		
		if ( defined( 'QODEF_INSTAGRAM_FEED_VERSION' ) ) {
			$instagram_panel = bazaar_qodef_add_admin_panel(
				array(
					'title' => esc_html__( 'Instagram', 'bazaar' ),
					'name'  => 'panel_instagram',
					'page'  => '_social_page'
				)
			);
			
			bazaar_qodef_add_admin_instagram_button(
				array(
					'name'   => 'instagram_button',
					'parent' => $instagram_panel
				)
			);
		}
		
		/**
		 * Open Graph
		 */
		$panel_open_graph = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_open_graph',
				'title' => esc_html__( 'Open Graph', 'bazaar' ),
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_open_graph',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Open Graph', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will allow usage of Open Graph protocol on your site', 'bazaar' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_enable_open_graph_container'
				),
				'parent'        => $panel_open_graph
			)
		);
		
		$enable_open_graph_container = bazaar_qodef_add_admin_container(
			array(
				'name'            => 'enable_open_graph_container',
				'hidden_property' => 'enable_open_graph',
				'hidden_value'    => 'no',
				'parent'          => $panel_open_graph
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'open_graph_image',
				'default_value' => QODE_ASSETS_ROOT . '/img/open_graph.jpg',
				'label'         => esc_html__( 'Default Share Image', 'bazaar' ),
				'parent'        => $enable_open_graph_container,
				'description'   => esc_html__( 'Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'bazaar' ),
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
        do_action('bazaar_qodef_social_options', $page);
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_social_options_map', 18 );
}