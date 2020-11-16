<?php
namespace QodeCore\CPT\Shortcodes\UncoveringSections;

use QodeCore\Lib;

class UncoveringSectionsItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_uncovering_sections_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Select Uncovering Sections Item', 'select-core' ),
					'base'            => $this->base,
					'as_child'        => array( 'only' => 'qodef_uncovering_sections' ),
					'as_parent'       => array( 'except' => 'vc_row, vc_accordion' ),
					'category'        => esc_html__( 'by Select', 'select-core' ),
					'icon'            => 'icon-wpb-uncovering-sections-item extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'content_element' => true,
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'select-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'select-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'select-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__('Background Image', 'select-core')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'background_position',
							'heading'     => esc_html__( 'Background Image Position', 'select-core' ),
							'description' => esc_html__( 'Please insert position in format horizontal vertical position, example - center center', 'select-core' ),
							'dependency'  => array('item' => 'background_image', 'not_empty' => true)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'background_size',
							'heading'     => esc_html__( 'Background Image Size', 'select-core' ),
							'value'       => array(
								esc_html__( 'Cover', 'select-core' )   => 'cover',
								esc_html__( 'Contain', 'select-core' ) => 'contain',
								esc_html__( 'Inherit', 'select-core' ) => 'inherit'
							),
							'save_always' => true,
							'dependency'  => array('item' => 'background_image', 'not_empty' => true)
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'padding',
							'heading'     => esc_html__( 'Content Padding', 'select-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. You can use px or %', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'vertical_alignment',
							'heading'     => esc_html__( 'Content Vertical Alignment', 'select-core' ),
							'value'       => array(
								esc_html__( 'Default', 'select-core' ) => '',
								esc_html__( 'Top', 'select-core' )     => 'top',
								esc_html__( 'Middle', 'select-core' )  => 'middle',
								esc_html__( 'Bottom', 'select-core' )  => 'bottom'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'horizontal_alignment',
							'heading'     => esc_html__( 'Content Horizontal Alignment', 'select-core' ),
							'value'       => array(
								esc_html__( 'Default', 'select-core' ) => '',
								esc_html__( 'Left', 'select-core' )    => 'left',
								esc_html__( 'Center', 'select-core' )  => 'center',
								esc_html__( 'Right', 'select-core' )   => 'right'
							),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'link',
							'heading'     => esc_html__( 'Link', 'select-core' ),
							'description' => esc_html__( 'Set custom link around item', 'select-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'select-core' ),
							'value'      => array_flip( bazaar_qodef_get_link_target_array() ),
							'dependency' => Array( 'element' => 'link', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'header_skin',
							'heading'     => esc_html__( 'Header Skin', 'select-core' ),
							'value'       => array(
								esc_html__( 'Default', 'select-core' ) => '',
								esc_html__( 'Light', 'select-core' )   => 'light',
								esc_html__( 'Dark', 'select-core' )    => 'dark'
							),
							'save_always' => true,
							'description' => esc_html__( 'Choose a predefined header style for header elements', 'select-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_laptop',
							'heading'     => esc_html__('Background Image for Laptops', 'select-core'),
							'group'       => esc_html__('Responsiveness', 'select-core')
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_tablet',
							'heading'     => esc_html__('Background Image for Tablets - Landscape', 'select-core'),
							'group'       => esc_html__('Responsiveness', 'select-core')
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_tablet_portrait',
							'heading'     => esc_html__('Background Image for Tablets - Portrait', 'select-core'),
							'group'       => esc_html__('Responsiveness', 'select-core')
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image_mobile',
							'heading'     => esc_html__('Background Image for Mobiles', 'select-core'),
							'group'       => esc_html__('Responsiveness', 'select-core')
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'          => '',
			'background_color'      => '',
			'background_image'      => '',
			'background_position'   => '',
			'background_size'       => '',
			'padding'               => '',
			'vertical_alignment'    => '',
			'horizontal_alignment'  => '',
			'link'                  => '',
			'link_target'           => '_self',
			'header_skin'           => '',
			'image_laptop'          => '',
			'image_tablet'          => '',
			'image_tablet_portrait' => '',
			'image_mobile'          => ''
		);
		$params = shortcode_atts( $args, $atts );
		$rand_class = 'qodef-uss-custom-' . mt_rand(100000,1000000);
		
		$params['holder_unique_class'] = $rand_class;
		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['holder_data']         = $this->getHolderData( $params );
		$params['image_data']          = $this->getImageData( $params );
		$params['holder_styles']       = $this->getHolderStyles( $params );
		$params['item_inner_styles']   = $this->getItemInnerStyles( $params );
		$params['link_target']         = !empty($params['link_target']) ? $params['link_target'] : $args['link_target'];
		
		$params['content'] = $content;
		
		$html = qodef_core_get_shortcode_module_template_part( 'templates/uncovering-sections-item', 'uncovering-sections', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['holder_unique_class'] ) ? $params['holder_unique_class'] : '';
		$holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'qodef-uss-item-va-' . $params['vertical_alignment'] : '';
		$holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'qodef-uss-item-ha-' . $params['horizontal_alignment'] : '';
		$holderClasses[] = ! empty( $params['link'] ) ? 'qodef-uss-item-has-link' : '';
		$holderClasses[] = ! empty( $params['header_skin'] ) ? 'qodef-uss-item-has-style' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_unique_class'];
		
		if ( ! empty( $params['header_skin'] ) ) {
			$data['data-header-style'] = $params['header_skin'];
		}
		
		return $data;
	}

    private function getImageData( $params ) {
        $data                    = array();

        if ( ! empty( $params['image_laptop'] ) ) {
            $image                     = wp_get_attachment_image_src( $params['image_laptop'], 'full' );
            $data['data-laptop-image'] = $image[0];
        }

        if ( ! empty( $params['image_tablet'] ) ) {
            $image                     = wp_get_attachment_image_src( $params['image_tablet'], 'full' );
            $data['data-tablet-image'] = $image[0];
        }

        if ( ! empty( $params['image_tablet_portrait'] ) ) {
            $image                              = wp_get_attachment_image_src( $params['image_tablet_portrait'], 'full' );
            $data['data-tablet-portrait-image'] = $image[0];
        }

        if ( ! empty( $params['image_mobile'] ) ) {
            $image                     = wp_get_attachment_image_src( $params['image_mobile'], 'full' );
            $data['data-mobile-image'] = $image[0];
        }

        return $data;
    }
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['background_image'] ) ) {
			$styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';
			
			if ( ! empty( $params['background_position'] ) ) {
				$styles[] = 'background-position:' . $params['background_position'];
			}
			
			if ( ! empty( $params['background_size'] ) ) {
				$styles[] = 'background-size:' . $params['background_size'];
			}
		}
		
		return implode( ';', $styles );
	}
	
	private function getItemInnerStyles( $params ) {
		$styles = array();
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return implode( ';', $styles );
	}
}