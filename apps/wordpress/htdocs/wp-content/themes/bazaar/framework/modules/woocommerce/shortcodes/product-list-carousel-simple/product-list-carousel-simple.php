<?php

namespace QodeCore\CPT\Shortcodes\ProductListCarouselSimple;

use QodeCore\Lib;

class ProductListCarouselSimple implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'qodef_product_list_carousel_simple';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
						'name'                      => esc_html__( 'Select Product List - Simple Carousel', 'bazaar' ),
						'base'                      => $this->base,
						'icon'                      => 'icon-wpb-product-list-carousel-simple extended-custom-icon',
						'category'                  => esc_html__( 'by Select', 'bazaar' ),
						'allowed_container_element' => 'vc_row',
						'params'                    => array(
							array(
									'type'       => 'textfield',
									'param_name' => 'number_of_posts',
									'heading'    => esc_html__( 'Number of Products', 'bazaar' )
							),
							array(
									'type'        => 'dropdown',
									'param_name'  => 'order_by',
									'heading'     => esc_html__( 'Order By', 'bazaar' ),
									'value'       => array_flip( bazaar_qodef_get_query_order_by_array() ),
									'save_always' => true
							),
							array(
									'type'        => 'dropdown',
									'param_name'  => 'order',
									'heading'     => esc_html__( 'Order', 'bazaar' ),
									'value'       => array_flip( bazaar_qodef_get_query_order_array() ),
									'save_always' => true
							),
							array(
									'type'        => 'dropdown',
									'param_name'  => 'taxonomy_to_display',
									'heading'     => esc_html__( 'Choose Sorting Taxonomy', 'bazaar' ),
									'value'       => array(
											esc_html__( 'Category', 'bazaar' ) => 'category',
											esc_html__( 'Tag', 'bazaar' )      => 'tag',
											esc_html__( 'Id', 'bazaar' )       => 'id'
									),
									'save_always' => true,
									'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'bazaar' )
							),
							array(
									'type'        => 'textfield',
									'param_name'  => 'taxonomy_values',
									'heading'     => esc_html__( 'Enter Taxonomy Values', 'bazaar' ),
									'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'bazaar' )
							),
							array(
									'type'        => 'dropdown',
									'heading'     => esc_html__( 'Image Proportions', 'bazaar' ),
									'param_name'  => 'image_size',
									'value'       => array(
											esc_html__( 'Original', 'bazaar' )       => 'full',
											esc_html__( 'Square', 'bazaar' )         => 'square',
											esc_html__( 'Landscape', 'bazaar' )      => 'landscape',
											esc_html__( 'Portrait', 'bazaar' )       => 'portrait',
											esc_html__( 'Medium', 'bazaar' )         => 'medium',
											esc_html__( 'Large', 'bazaar' )          => 'large',
											esc_html__( 'Shop Catalog', 'bazaar' )   => 'shop_catalog',
											esc_html__( 'Shop Single', 'bazaar' )    => 'shop_single',
											esc_html__( 'Shop Thumbnail', 'bazaar' ) => 'shop_thumbnail'
									),
									'save_always' => true
							),
							array(
									'type'        => 'dropdown',
									'param_name'  => 'slider_loop',
									'heading'     => esc_html__( 'Enable Slider Loop', 'bazaar' ),
									'value'       => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
									'save_always' => true,
									'group'       => esc_html__( 'Slider Settings', 'bazaar' )
							),
							array(
									'type'        => 'dropdown',
									'param_name'  => 'slider_autoplay',
									'heading'     => esc_html__( 'Enable Slider Autoplay', 'bazaar' ),
									'value'       => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
									'save_always' => true,
									'group'       => esc_html__( 'Slider Settings', 'bazaar' )
							),
							array(
									'type'        => 'textfield',
									'param_name'  => 'slider_speed',
									'heading'     => esc_html__( 'Slide Duration', 'bazaar' ),
									'description' => esc_html__( 'Default value is 5000 (ms)', 'bazaar' ),
									'group'       => esc_html__( 'Slider Settings', 'bazaar' )
							),
							array(
									'type'        => 'textfield',
									'param_name'  => 'slider_speed_animation',
									'heading'     => esc_html__( 'Slide Animation Duration', 'bazaar' ),
									'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'bazaar' ),
									'group'       => esc_html__( 'Slider Settings', 'bazaar' )
							),
							array(
									'type'        => 'dropdown',
									'param_name'  => 'slider_navigation',
									'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'bazaar' ),
									'value'       => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
									'save_always' => true,
									'group'       => esc_html__( 'Slider Settings', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'display_title',
									'heading'    => esc_html__( 'Display Title', 'bazaar' ),
									'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
									'group'      => esc_html__( 'Product Info', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'product_info_position',
									'heading'    => esc_html__( 'Product Info Vertical Alignment', 'bazaar' ),
									'value'      => array(
											esc_html__( 'Top', 'bazaar' ) => 'info-position-top',
											esc_html__( 'Middle', 'bazaar' )   => 'info-position-middle',
									),
									'description' => esc_html__( 'Is\'t applied for the info below image type', 'bazaar' ),
									'group'      => esc_html__( 'Product Info Style', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'title_tag',
									'heading'    => esc_html__( 'Title Tag', 'bazaar' ),
									'value'      => array_flip( bazaar_qodef_get_title_tag( true ) ),
									'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
									'group'      => esc_html__( 'Product Info Style', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'title_transform',
									'heading'    => esc_html__( 'Title Text Transform', 'bazaar' ),
									'value'      => array_flip( bazaar_qodef_get_text_transform_array( true ) ),
									'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
									'group'      => esc_html__( 'Product Info Style', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'display_category',
									'heading'    => esc_html__( 'Display Category', 'bazaar' ),
									'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
									'group'      => esc_html__( 'Product Info', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'display_excerpt',
									'heading'    => esc_html__( 'Display Excerpt', 'bazaar' ),
									'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
									'group'      => esc_html__( 'Product Info', 'bazaar' )
							),
							array(
									'type'        => 'textfield',
									'param_name'  => 'excerpt_length',
									'heading'     => esc_html__( 'Excerpt Length', 'bazaar' ),
									'description' => esc_html__( 'Number of characters', 'bazaar' ),
									'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( 'yes' ) ),
									'group'       => esc_html__( 'Product Info Style', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'product_info_skin',
									'heading'    => esc_html__( 'Product Info Skin', 'bazaar' ),
									'value'      => array(
											esc_html__( 'Default', 'bazaar' ) => '',
											esc_html__( 'Light', 'bazaar' )   => 'light',
									),
									'group'      => esc_html__( 'Product Info Style', 'bazaar' )
							),
							array(
									'type'       => 'colorpicker',
									'param_name' => 'shader_background_color',
									'heading'    => esc_html__( 'Shader Background Color', 'bazaar' ),
									'group'      => esc_html__( 'Product Info Style', 'bazaar' ),
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'display_rating',
									'heading'    => esc_html__( 'Display Rating', 'bazaar' ),
									'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
									'group'      => esc_html__( 'Product Info', 'bazaar' )
							),
							array(
									'type'       => 'dropdown',
									'param_name' => 'display_price',
									'heading'    => esc_html__( 'Display Price', 'bazaar' ),
									'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
									'group'      => esc_html__( 'Product Info', 'bazaar' )
							),
							)
					)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$default_atts = array(
				'number_of_posts'         => '8',
				'order_by'                => 'date',
				'order'                   => 'ASC',
				'taxonomy_to_display'     => 'category',
				'taxonomy_values'         => '',
				'image_size'              => 'full',
				'slider_loop'             => 'yes',
				'slider_autoplay'         => 'yes',
				'slider_speed'            => '5000',
				'slider_speed_animation'  => '600',
				'slider_navigation'       => 'yes',
				'info_position'			  => 'info-on-image',
				'product_info_position'   => 'info-position-top',
				'display_title'           => 'yes',
				'title_tag'               => 'h4',
				'title_transform'         => '',
				'display_category'        => 'yes',
				'display_excerpt'         => 'no',
				'product_info_skin'		  => '',
				'shader_background_color' => '',
				'excerpt_length'          => '20',
				'display_rating'          => 'no',
				'display_price'           => 'yes',
				'product_slider_on'       => 'yes',
				'number_of_columns'       => '1',
                'space_between_items'     => 'no'
		);

		$params = shortcode_atts( $default_atts, $atts );

		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getProductListCarouselDataAttributes( $params );
		$params['class_name']     = 'plc';

		$params['title_tag']    = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles( $params );

		$queryArray             = $this->generateProductQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;

		$html = '';
		$html.= '<div class="qodef-plcs-holder '. esc_attr($params['holder_classes']). ' ">';
		$html.=  bazaar_qodef_execute_shortcode('qodef_product_list', $params);
		$html.= '</div>';

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = '';

		return $holderClasses;
	}

	private function getProductListCarouselDataAttributes( $params ) {
		$slider_data = array();

		$slider_data['data-number-of-items']        = '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = false;

		return $slider_data;
	}

	public function generateProductQueryArray( $params ) {
		$queryArray = array(
				'post_status'         => 'publish',
				'post_type'           => 'product',
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => $params['number_of_posts'],
				'orderby'             => $params['order_by'],
				'order'               => $params['order']
		);

		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category' ) {
			$queryArray['product_cat'] = $params['taxonomy_values'];
		}

		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag' ) {
			$queryArray['product_tag'] = $params['taxonomy_values'];
		}

		if ( $params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id' ) {
			$idArray                = $params['taxonomy_values'];
			$ids                    = explode( ',', $idArray );
			$queryArray['post__in'] = $ids;
		}

		return $queryArray;
	}

	public function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}

		return implode( ';', $styles );
	}
}