<?php

if ( ! function_exists( 'bazaar_qodef_sticky_header_meta_boxes_options_map' ) ) {
	function bazaar_qodef_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'hidden_property' => 'qodef_header_behaviour_meta',
				'hidden_values'   => array(
					'',
					'no-behavior',
					'fixed-on-scroll',
					'sticky-header-on-scroll-up'
				)
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll amount for sticky header appearance', 'bazaar' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'bazaar' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
	}
	
	add_action( 'bazaar_qodef_additional_header_area_meta_boxes_map', 'bazaar_qodef_sticky_header_meta_boxes_options_map', 10, 1 );
}