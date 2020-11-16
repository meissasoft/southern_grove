<?php

if ( ! function_exists( 'bazaar_qodef_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function bazaar_qodef_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'bazaar' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'bazaar' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'bazaar_qodef_additional_title_area_meta_boxes', 'bazaar_qodef_breadcrumbs_title_type_options_meta_boxes' );
}