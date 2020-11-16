<?php
namespace QodeCore\CPT\Shortcodes\SectionTitle;

use QodeCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'qodef_section_title';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Select Section Title', 'select-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by Select', 'select-core' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'select-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'select-core' ),
							'value'       => array(
									esc_html__( 'Default', 'select-core' ) => '',
									esc_html__( 'Left', 'select-core' )    => 'left',
									esc_html__( 'Center', 'select-core' )  => 'center',
									esc_html__( 'Right', 'select-core' )   => 'right'
							),
							'save_always' => true,
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'select-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'select-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'select-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'select-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_bottom_margin',
							'heading'    => esc_html__( 'Title Bottom Margin', 'select-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'select-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_bold_words',
							'heading'     => esc_html__( 'Words with Bold Font Weight', 'select-core' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display in a "bold" font weight. Separate the positions with commas (e.g. if you would like the first, second, and third word to have a light font weight, you would enter "1,2,3")', 'select-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'select-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_light_words',
							'heading'     => esc_html__( 'Words with Light Font Weight', 'select-core' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display in a "light" font weight. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a light font weight, you would enter "1,3,4")', 'select-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'select-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'select-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'select-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle', 'select-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_color',
							'heading'    => esc_html__( 'Subtitle Color', 'select-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_font_size',
							'heading'    => esc_html__( 'Subtitle Font Size', 'select-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_bottom_margin',
							'heading'    => esc_html__( 'Subtitle Bottom Margin', 'select-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'select-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_separator',
							'heading'    => esc_html__( 'Enable Separator', 'select-core' ),
							'value'      => array_flip(bazaar_qodef_get_yes_no_select_array(false, true))
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'separator_width',
							'heading'    => esc_html__( 'Separator Width', 'select-core' ),
							'description' => esc_html__( 'Enter the separator width in % or px', 'select-core' ),
							'dependency' => array( 'element' => 'enable_separator', 'value' => 'yes'),
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'separator_color',
                            'heading'    => esc_html__( 'Separator Color', 'select-core' ),
                            'dependency' => array( 'element' => 'enable_separator', 'value' => 'yes')
                        ),
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'position'            => '',
			'holder_padding'      => '',
			'title'               => '',
			'title_tag'           => 'h2',
			'title_color'         => '',
			'title_bottom_margin' => '',
			'title_bold_words'    => '',
			'title_light_words'   => '',
			'title_break_words'   => '',
			'disable_break_words' => '',
			'subtitle' 			  => '',
			'subtitle_color'	  => '',
			'subtitle_font_size'  => '40',
			'subtitle_bottom_margin' => '',
			'enable_separator'    => 'yes',
			'separator_width'	  => '',
			'separator_color'	  => ''
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		$params['title']          = $this->getModifiedTitle( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['subtitle_styles']    = $this->getSubtitleStyles( $params );
		$params['separator_styles']    = $this->getSeparatorStyles( $params );

		$html = qodef_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = 'qodef-st-standard';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'qodef-st-disable-title-break' : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}

		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}

		return implode( ';', $styles );
	}

	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_bold_words  = str_replace( ' ', '', $params['title_bold_words'] );
		$title_light_words = str_replace( ' ', '', $params['title_light_words'] );
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );

		if ( ! empty( $title ) ) {
			$bold_words  = explode( ',', $title_bold_words );
			$light_words = explode( ',', $title_light_words );
			$split_title = explode( ' ', $title );

			if ( ! empty( $title_bold_words ) ) {
				foreach ( $bold_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="qodef-st-title-bold">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}

			if ( ! empty( $title_light_words ) ) {
				foreach ( $light_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="qodef-st-title-light">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}

			if ( ! empty( $title_break_words ) ) {
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
				}
			}

			$title = implode( ' ', $split_title );
		}

		return $title;
	}

	private function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if ( ! empty( $params['title_bottom_margin'] ) ) {

			if ( bazaar_qodef_string_ends_with( $params['title_bottom_margin'], '%' ) || bazaar_qodef_string_ends_with( $params['title_bottom_margin'], 'px' ) ) {
				$styles[] = 'margin-bottom:' . $params['title_bottom_margin'];
			} else {
				$styles[] = 'margin-bottom:' . $params['title_bottom_margin'] . 'px';
			}
		}

		return implode( ';', $styles );
	}

	private function getSubtitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}

		if ( ! empty( $params['subtitle_font_size'] ) ) {

			if ( bazaar_qodef_string_ends_with( $params['subtitle_font_size'], 'em' ) || bazaar_qodef_string_ends_with( $params['subtitle_font_size'], 'px' ) ) {
				$styles[] = 'font-size:' .$params['subtitle_font_size'];
			} else {
				$styles[] = 'font-size:' .$params['subtitle_font_size'] . 'px';
			}
		}

		if ( ! empty( $params['subtitle_bottom_margin'] ) ) {

			if ( bazaar_qodef_string_ends_with( $params['subtitle_bottom_margin'], '%' ) || bazaar_qodef_string_ends_with( $params['subtitle_bottom_margin'], 'px' ) ) {
				$styles[] = 'margin-bottom:' .$params['subtitle_bottom_margin'];
			} else {
				$styles[] = 'margin-bottom:' .$params['subtitle_bottom_margin'] . 'px';
			}
		}

		return implode( ';', $styles );
	}

	private function getSeparatorStyles($params){
		$styles = array();

		if(!empty($params['separator_width'])){
			$styles[] = 'width:' . $params['separator_width'];
		}

        if(!empty($params['separator_color'])){
            $styles[] = 'border-bottom-color:' . $params['separator_color'];
        }

		return implode( ';', $styles );
	}
}