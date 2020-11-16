<?php

if ( ! function_exists( 'bazaar_qodef_map_post_video_meta' ) ) {
	function bazaar_qodef_map_post_video_meta() {
		$video_post_format_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'bazaar' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'bazaar' ),
				'description'   => esc_html__( 'Choose video type', 'bazaar' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'bazaar' ),
					'self'            => esc_html__( 'Self Hosted', 'bazaar' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#qodef_qodef_video_self_hosted_container',
						'self'            => '#qodef_qodef_video_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#qodef_qodef_video_embedded_container',
						'self'            => '#qodef_qodef_video_self_hosted_container'
					)
				)
			)
		);
		
		$qodef_video_embedded_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'qodef_video_embedded_container',
				'hidden_property' => 'qodef_video_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$qodef_video_self_hosted_container = bazaar_qodef_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'qodef_video_self_hosted_container',
				'hidden_property' => 'qodef_video_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'bazaar' ),
				'description' => esc_html__( 'Enter Video URL', 'bazaar' ),
				'parent'      => $qodef_video_embedded_container,
			)
		);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'bazaar' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'bazaar' ),
				'parent'      => $qodef_video_self_hosted_container,
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_post_video_meta', 22 );
}