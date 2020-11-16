<?php

if ( ! function_exists( 'bazaar_qodef_map_general_meta' ) ) {
	function bazaar_qodef_map_general_meta() {
		
		$general_meta_box = bazaar_qodef_create_meta_box(
			array(
				'scope' => apply_filters( 'bazaar_qodef_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'General', 'bazaar' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'bazaar' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'bazaar' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'bazaar' ),
				'parent'        => $general_meta_box,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$qodef_content_padding_group = bazaar_qodef_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'bazaar' ),
				'description' => esc_html__( 'Define styles for Content area', 'bazaar' ),
				'parent'      => $general_meta_box
			)
		);
		
			$qodef_content_padding_row = bazaar_qodef_add_admin_row(
				array(
					'name'   => 'qodef_content_padding_row',
					'next'   => true,
					'parent' => $qodef_content_padding_group
				)
			);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'   => 'qodef_page_content_top_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Top Padding', 'bazaar' ),
						'parent' => $qodef_content_padding_row,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'    => 'qodef_page_content_top_padding_mobile',
						'type'    => 'selectsimple',
						'label'   => esc_html__( 'Set this top padding for mobile header', 'bazaar' ),
						'parent'  => $qodef_content_padding_row,
						'options' => bazaar_qodef_get_yes_no_select_array( false )
					)
				);
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'bazaar' ),
				'description' => esc_html__( 'Choose background color for page content', 'bazaar' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'    => 'qodef_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'bazaar' ),
				'parent'  => $general_meta_box,
				'options' => bazaar_qodef_get_yes_no_select_array(),
				'args'    => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#qodef_boxed_container_meta',
						'no'  => '#qodef_boxed_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#qodef_boxed_container_meta'
					)
				)
			)
		);
		
			$boxed_container_meta = bazaar_qodef_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'hidden_property' => 'qodef_boxed_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'bazaar' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'bazaar' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'bazaar' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'bazaar' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'bazaar' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'bazaar' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'          => 'qodef_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => 'fixed',
						'label'         => esc_html__( 'Background Image Attachment', 'bazaar' ),
						'description'   => esc_html__( 'Choose background image attachment', 'bazaar' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'bazaar' ),
							'fixed'  => esc_html__( 'Fixed', 'bazaar' ),
							'scroll' => esc_html__( 'Scroll', 'bazaar' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'bazaar' ),
				'parent'        => $general_meta_box,
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'    => array(
					'dependence'    => true,
					'hide'          => array(
						''    => '#qodef_qodef_paspartu_container_meta',
						'no'  => '#qodef_qodef_paspartu_container_meta',
						'yes' => ''
					),
					'show'          => array(
						''    => '',
						'no'  => '',
						'yes' => '#qodef_qodef_paspartu_container_meta'
					)
				)
			)
		);
		
			$paspartu_container_meta = bazaar_qodef_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'qodef_paspartu_container_meta',
					'hidden_property' => 'qodef_paspartu_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'bazaar' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'bazaar' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'bazaar' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'bazaar' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				bazaar_qodef_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'qodef_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'bazaar' ),
						'options'       => bazaar_qodef_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'bazaar' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'bazaar' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'bazaar' ),
					'qodef-grid-1100' => esc_html__( '1100px', 'bazaar' ),
					'qodef-grid-1300' => esc_html__( '1300px', 'bazaar' ),
					'qodef-grid-1200' => esc_html__( '1200px', 'bazaar' ),
					'qodef-grid-1000' => esc_html__( '1000px', 'bazaar' ),
					'qodef-grid-800'  => esc_html__( '800px', 'bazaar' )
				)
			)
		);
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'          => 'qodef_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'bazaar' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'bazaar' ),
				'parent'        => $general_meta_box,
				'options'       => bazaar_qodef_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#qodef_page_transitions_container_meta',
						'no'  => '#qodef_page_transitions_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#qodef_page_transitions_container_meta'
					)
				)
			)
		);
		
			$page_transitions_container_meta = bazaar_qodef_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'page_transitions_container_meta',
					'hidden_property' => 'qodef_smooth_page_transitions_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				bazaar_qodef_create_meta_box_field(
					array(
						'name'        => 'qodef_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'bazaar' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'bazaar' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => bazaar_qodef_get_yes_no_select_array(),
						'args'        => array(
							'dependence' => true,
							'hide'       => array(
								''    => '#qodef_page_transition_preloader_container_meta',
								'no'  => '#qodef_page_transition_preloader_container_meta',
								'yes' => ''
							),
							'show'       => array(
								''    => '',
								'no'  => '',
								'yes' => '#qodef_page_transition_preloader_container_meta'
							)
						)
					)
				);
				
				$page_transition_preloader_container_meta = bazaar_qodef_add_admin_container(
					array(
						'parent'          => $page_transitions_container_meta,
						'name'            => 'page_transition_preloader_container_meta',
						'hidden_property' => 'qodef_page_transition_preloader_meta',
						'hidden_values'   => array(
							'',
							'no'
						)
					)
				);
				
					bazaar_qodef_create_meta_box_field(
						array(
							'name'   => 'qodef_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'bazaar' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = bazaar_qodef_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'bazaar' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'bazaar' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = bazaar_qodef_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					bazaar_qodef_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'qodef_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'bazaar' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'bazaar' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'bazaar' ),
								'pulse'                 => esc_html__( 'Pulse', 'bazaar' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'bazaar' ),
								'cube'                  => esc_html__( 'Cube', 'bazaar' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'bazaar' ),
								'stripes'               => esc_html__( 'Stripes', 'bazaar' ),
								'wave'                  => esc_html__( 'Wave', 'bazaar' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'bazaar' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'bazaar' ),
								'atom'                  => esc_html__( 'Atom', 'bazaar' ),
								'clock'                 => esc_html__( 'Clock', 'bazaar' ),
								'mitosis'               => esc_html__( 'Mitosis', 'bazaar' ),
								'lines'                 => esc_html__( 'Lines', 'bazaar' ),
								'fussion'               => esc_html__( 'Fussion', 'bazaar' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'bazaar' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'bazaar' )
							)
						)
					);
					
					bazaar_qodef_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'qodef_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'bazaar' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					bazaar_qodef_create_meta_box_field(
						array(
							'name'        => 'qodef_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'bazaar' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'bazaar' ),
							'options'     => bazaar_qodef_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		bazaar_qodef_create_meta_box_field(
			array(
				'name'        => 'qodef_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'bazaar' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'bazaar' ),
				'parent'      => $general_meta_box,
				'options'     => bazaar_qodef_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'bazaar_qodef_map_general_meta', 10 );
}