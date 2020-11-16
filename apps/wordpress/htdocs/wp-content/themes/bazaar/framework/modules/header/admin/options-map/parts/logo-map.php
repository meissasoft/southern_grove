<?php

if ( ! function_exists( 'bazaar_qodef_logo_options_map' ) ) {
	function bazaar_qodef_logo_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'bazaar' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'bazaar' ),
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#qodef_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);
		
		$hide_logo_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value'    => 'yes'
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => QODE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'bazaar' ),
				'parent'        => $hide_logo_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => QODE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'bazaar' ),
				'parent'        => $hide_logo_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => QODE_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'bazaar' ),
				'parent'        => $hide_logo_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => QODE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'bazaar' ),
				'parent'        => $hide_logo_container
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => QODE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'bazaar' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_logo_options_map', 2 );
}