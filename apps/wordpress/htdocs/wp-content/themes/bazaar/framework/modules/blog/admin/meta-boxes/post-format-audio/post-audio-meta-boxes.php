<?php

if ( ! function_exists( 'bazaar_qodef_map_post_audio_meta' ) ) {
	function bazaar_qodef_map_post_audio_meta() {
		$audio_post_format_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'bazaar' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'bazaar' ),
				'description'   => esc_html__( 'Choose audio type', 'bazaar' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'bazaar' ),
					'self'            => esc_html__( 'Self Hosted', 'bazaar' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#qodef_qodef_audio_self_hosted_container',
						'self'            => '#qodef_qodef_audio_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#qodef_qodef_audio_embedded_container',
						'self'            => '#qodef_qodef_audio_self_hosted_container'
					)
				)
			)
		);
		
		$qodef_audio_embedded_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'qodef_audio_embedded_container',
				'hidden_property' => 'qodef_audio_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$qodef_audio_self_hosted_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'qodef_audio_self_hosted_container',
				'hidden_property' => 'qodef_audio_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'bazaar' ),
				'description' => esc_html__( 'Enter audio URL', 'bazaar' ),
				'parent'      => $qodef_audio_embedded_container,
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'bazaar' ),
				'description' => esc_html__( 'Enter audio link', 'bazaar' ),
				'parent'      => $qodef_audio_self_hosted_container,
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_post_audio_meta', 23 );
}