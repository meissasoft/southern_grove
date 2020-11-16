<?php
namespace QodeCore\CPT\Shortcodes\CustomFont;

use QodeCore\Lib;

class CustomFont implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_custom_font';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Select Custom Font', 'select-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by Select', 'select-core' ),
					'icon'                      => 'icon-wpb-custom-font extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'select-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title Text', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_family',
							'heading'    => esc_html__( 'Font Family', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'font_weight',
							'heading'     => esc_html__( 'Font Weight', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_font_weight_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'font_style',
							'heading'     => esc_html__( 'Font Style', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_font_style_array( true ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'letter_spacing',
							'heading'    => esc_html__( 'Letter Spacing (px or em)', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_transform',
							'heading'     => esc_html__( 'Text Transform', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_text_transform_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_decoration',
							'heading'     => esc_html__( 'Text Decoration', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_text_decorations( true ) ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_align',
							'heading'     => esc_html__( 'Text Align', 'select-core' ),
							'value'       => array(
								esc_html__( 'Default', 'select-core' ) => '',
								esc_html__( 'Left', 'select-core' )    => 'left',
								esc_html__( 'Center', 'select-core' )  => 'center',
								esc_html__( 'Right', 'select-core' )   => 'right',
								esc_html__( 'Justify', 'select-core' ) => 'justify'
							),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'margin',
							'heading'     => esc_html__( 'Margin (px or %)', 'select-core' ),
							'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_1280',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Small Laptops', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_1280',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Small Laptops', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_1024',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Landscape', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_1024',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Landscape', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_768',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Portrait', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_768',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Portrait', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_680',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Mobiles', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_680',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Mobiles', 'select-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'     => '',
			'title'            => '',
			'title_tag'        => 'h2',
			'font_family'      => '',
			'font_size'        => '',
			'line_height'      => '',
			'font_weight'      => '',
			'font_style'       => '',
			'letter_spacing'   => '',
			'text_transform'   => '',
			'text_decoration'  => '',
			'color'            => '',
			'text_align'       => '',
			'margin'           => '',
			'font_size_1280'   => '',
			'line_height_1280' => '',
			'font_size_1024'   => '',
			'line_height_1024' => '',
			'font_size_768'    => '',
			'line_height_768'  => '',
			'font_size_680'    => '',
			'line_height_680'  => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_rand_class'] = 'qodef-cf-' . mt_rand( 1000, 10000 );
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		$html = qodef_core_get_shortcode_module_template_part( 'templates/custom-font', 'custom-font', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['holder_rand_class'] ) ? esc_attr( $params['holder_rand_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( $params['font_family'] !== '' ) {
			$styles[] = 'font-family: ' . $params['font_family'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			if ( bazaar_qodef_string_ends_with( $params['font_size'], 'px' ) || bazaar_qodef_string_ends_with( $params['font_size'], 'em' ) ) {
				$styles[] = 'font-size: ' . $params['font_size'];
			} else {
				$styles[] = 'font-size: ' . $params['font_size'] . 'px';
			}
		}
		
		if ( ! empty( $params['line_height'] ) ) {
			if ( bazaar_qodef_string_ends_with( $params['line_height'], 'px' ) || bazaar_qodef_string_ends_with( $params['line_height'], 'em' ) ) {
				$styles[] = 'line-height: ' . $params['line_height'];
			} else {
				$styles[] = 'line-height: ' . $params['line_height'] . 'px';
			}
		}
		
		if ( ! empty( $params['font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['font_style'] ) ) {
			$styles[] = 'font-style: ' . $params['font_style'];
		}
		
		if ( ! empty( $params['letter_spacing'] ) ) {
			if ( bazaar_qodef_string_ends_with( $params['letter_spacing'], 'px' ) || bazaar_qodef_string_ends_with( $params['letter_spacing'], 'em' ) ) {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'];
			} else {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'] . 'px';
			}
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( ! empty( $params['text_decoration'] ) ) {
			$styles[] = 'text-decoration: ' . $params['text_decoration'];
		}
		
		if ( ! empty( $params['text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['text_align'];
		}
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( $params['font_size_1280'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['font_size_1280'], 'px' ) || bazaar_qodef_string_ends_with( $params['font_size_1280'], 'em' ) ) {
				$data['data-font-size-1280'] = $params['font_size_1280'];
			} else {
				$data['data-font-size-1280'] = $params['font_size_1280'] . 'px';
			}
		}
		
		if ( $params['font_size_1024'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['font_size_1024'], 'px' ) || bazaar_qodef_string_ends_with( $params['font_size_1024'], 'em' ) ) {
				$data['data-font-size-1024'] = $params['font_size_1024'];
			} else {
				$data['data-font-size-1024'] = $params['font_size_1024'] . 'px';
			}
		}
		
		if ( $params['font_size_768'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['font_size_768'], 'px' ) || bazaar_qodef_string_ends_with( $params['font_size_768'], 'em' ) ) {
				$data['data-font-size-768'] = $params['font_size_768'];
			} else {
				$data['data-font-size-768'] = $params['font_size_768'] . 'px';
			}
		}
		
		if ( $params['font_size_680'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['font_size_680'], 'px' ) || bazaar_qodef_string_ends_with( $params['font_size_680'], 'em' ) ) {
				$data['data-font-size-680'] = $params['font_size_680'];
			} else {
				$data['data-font-size-680'] = $params['font_size_680'] . 'px';
			}
		}
		
		if ( $params['line_height_1280'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['line_height_1280'], 'px' ) || bazaar_qodef_string_ends_with( $params['line_height_1280'], 'em' ) ) {
				$data['data-line-height-1280'] = $params['line_height_1280'];
			} else {
				$data['data-line-height-1280'] = $params['line_height_1280'] . 'px';
			}
		}
		
		if ( $params['line_height_1024'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['line_height_1024'], 'px' ) || bazaar_qodef_string_ends_with( $params['line_height_1024'], 'em' ) ) {
				$data['data-line-height-1024'] = $params['line_height_1024'];
			} else {
				$data['data-line-height-1024'] = $params['line_height_1024'] . 'px';
			}
		}
		
		if ( $params['line_height_768'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['line_height_768'], 'px' ) || bazaar_qodef_string_ends_with( $params['line_height_768'], 'em' ) ) {
				$data['data-line-height-768'] = $params['line_height_768'];
			} else {
				$data['data-line-height-768'] = $params['line_height_768'] . 'px';
			}
		}
		
		if ( $params['line_height_680'] !== '' ) {
			if ( bazaar_qodef_string_ends_with( $params['line_height_680'], 'px' ) || bazaar_qodef_string_ends_with( $params['line_height_680'], 'em' ) ) {
				$data['data-line-height-680'] = $params['line_height_680'];
			} else {
				$data['data-line-height-680'] = $params['line_height_680'] . 'px';
			}
		}
		
		return $data;
	}
}