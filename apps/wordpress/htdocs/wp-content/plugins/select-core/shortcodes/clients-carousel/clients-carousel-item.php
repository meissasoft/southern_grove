<?php
namespace QodeCore\CPT\Shortcodes\ClientsCarouselItem;

use QodeCore\Lib;

class ClientsCarouselItem implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_clients_carousel_item';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Select Clients Carousel Item', 'select-core' ),
					'base'                    => $this->getBase(),
					'category'                => esc_html__( 'by Select', 'select-core' ),
					'icon'                    => 'icon-wpb-clients-carousel-item extended-custom-icon',
					'as_child'                => array( 'only' => 'qodef_clients_carousel' ),
					'as_parent'               => array( 'except' => 'vc_row' ),
					'show_settings_on_create' => true,
					'params'                  => array(
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'select-core' ),
							'description' => esc_html__( 'Select image from media library', 'select-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'hover_image',
							'heading'     => esc_html__( 'Hover Image', 'select-core' ),
							'description' => esc_html__( 'Select image from media library', 'select-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'select-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Custom Link', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'target',
							'heading'     => esc_html__( 'Custom Link Target', 'select-core' ),
							'value'       => array_flip( bazaar_qodef_get_link_target_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image'       => '',
			'hover_image' => '',
			'image_size'  => 'full',
			'link'        => '',
			'target'      => '_self'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['image']       = $this->getCarouselImage( $params );
		$params['hover_image'] = $this->getCarouselHoverImage( $params );
		$params['image_size']  = $this->getCarouselImageSize( $params['image_size'] );
		$params['target']      = ! empty( $params['target'] ) ? $params['target'] : $args['target'];
		
		$html = qodef_core_get_shortcode_module_template_part( 'templates/clients-carousel-item', 'clients-carousel', '', $params );
		
		return $html;
	}
	
	private function getCarouselImage( $params ) {
		$image_meta = array();
		
		if ( ! empty( $params['image'] ) ) {
			$image_id       = $params['image'];
			$image_original = wp_get_attachment_image_src( $image_id, 'full' );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			$image_meta = $image;
		}
		
		return $image_meta;
	}
	
	private function getCarouselHoverImage( $params ) {
		$image_meta = array();
		
		if ( ! empty( $params['hover_image'] ) ) {
			$image_id       = $params['hover_image'];
			$image_original = wp_get_attachment_image_src( $image_id, 'full' );
			$image['url']   = $image_original[0];
			$image['alt']   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			
			$image_meta = $image;
		}
		
		return $image_meta;
	}
	
	private function getCarouselImageSize( $image_size ) {
		$image_size = trim( $image_size );
		
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'full';
		}
	}
}