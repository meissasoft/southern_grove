<?php

if ( ! function_exists( 'bazaar_qodef_centered_title_type_options_meta_boxes' ) ) {
	function bazaar_qodef_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'bazaar' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'bazaar' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'bazaar_qodef_additional_title_area_meta_boxes', 'bazaar_qodef_centered_title_type_options_meta_boxes', 5 );
}