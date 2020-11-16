<?php

if ( ! function_exists( 'bazaar_qodef_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function bazaar_qodef_reset_options_map() {
		
		bazaar_qodef_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'bazaar' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = bazaar_qodef_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'bazaar' )
			)
		);
		
		bazaar_qodef_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'bazaar' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'bazaar' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'bazaar_qodef_options_map', 'bazaar_qodef_reset_options_map', 100 );
}