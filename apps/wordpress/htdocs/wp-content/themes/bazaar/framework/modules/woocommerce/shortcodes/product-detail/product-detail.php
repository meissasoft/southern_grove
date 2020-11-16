<?php
namespace QodeCore\CPT\Shortcodes\ProductDetail;

use QodeCore\Lib;

class ProductDetail implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_product_detail';
		
		add_action('vc_before_init', array($this,'vcMap'));
		
		//Product id filter
		add_filter( 'vc_autocomplete_qodef_product_detail_product_id_callback', array( &$this, 'productIdAutocompleteSuggester', ), 10, 1 );
		
		//Product id render
		add_filter( 'vc_autocomplete_qodef_product_detail_product_id_render', array( &$this, 'productIdAutocompleteRender', ), 10, 1 );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Select Product Detail', 'bazaar' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by Select', 'bazaar' ),
					'icon'                      => 'icon-wpb-product-detail extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'product_id',
							'heading'     => esc_html__( 'Selected Product', 'bazaar' ),
							'settings'    => array(
								'sortable'      => true,
								'unique_values' => true
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => esc_html__( 'If you left this field empty then product ID will be of the current page', 'bazaar' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_detail_skin',
							'heading'    => esc_html__( 'Product Detail Skin', 'bazaar' ),
							'value'      => array(
								esc_html__( 'Default', 'bazaar' ) => '',
								esc_html__( 'Light', 'bazaar' )   => 'qodef-pd-light-skin',
							),
							'group'      => esc_html__( 'Product Detail Style', 'bazaar' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'bazaar' ),
							'value'       => array_flip( bazaar_qodef_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'description' => esc_html__( 'Set title tag for product title element', 'bazaar' ),
							'group'       => esc_html__( 'Product Detail Style', 'bazaar' )
						),
					)
				)
			);
		}
    }
	
    public function render($atts, $content = null) {
        $args = array(
	        'product_id'          => '',
	        'product_detail_skin'  => '',
	        'title_tag'           => 'h5',
	        'featured_image_size' => 'full',
        );
		$params = shortcode_atts($args, $atts);
		extract($params);

	    $params['product_id'] = !empty($params['product_id']) ? $params['product_id'] : get_the_ID();
	    $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];

	    $params['holder_classes'] = $this->getHolderClasses($params);
		    
		$html = '';
		$html .= '<div class="qodef-product-detail '.$params['holder_classes'].'">';
			$html .= '<div class="qodef-pd-text-holder clearfix">';
				$html .= '<div class="qodef-pd-text-left">';
					$html .= $this->getItemPriceHtml($params);
				$html .= '</div>';
				$html .= '<div class="qodef-pd-text-right">';
					$html .= $this->getItemTitleHtml($params);
					$html .= $this->getItemExcerptHtml($params);
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';

        return $html;
	}
	
	/**
	 * Return product detail styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		if ( ! empty( $params['product_detail_skin'] ) ) {
			$holderClasses[] = $params['product_detail_skin'];
		}
		
		return implode( ' ', $holderClasses );
	}
	
	/**
	 * Generates product title html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemTitleHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$title              = get_the_title( $product_id );
		$title_tag          = $params['title_tag'];

		if ( ! empty( $title ) ) {
			$html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="qodef-pd-title entry-title">';
				$html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $product_id ) ) . '">' . esc_html( $title ) . '</a>';
			$html .= '</' . esc_attr( $title_tag ) . '>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product price html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemPriceHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$product            = wc_get_product( $product_id );
		$currency = '<div class="qodef-currency">' . get_woocommerce_currency_symbol() . '</div>';
		
		if ($product->is_in_stock() ) {

			if( $product->is_on_sale() ) {
				$price_html = $currency . $product->get_sale_price($context = 'view');
			}
			else $price_html = $currency . $product->get_regular_price();

			$html = '<div class="qodef-pd-price">' . $price_html . '</div>';
		}
		
		return $html;
	}
	
	/**
	 * Generates product add to cart html based on id
	 *
	 * @param $params
	 *
	 * @return html
	 */
	public function getItemExcerptHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];

		if ( $product_excerpt = get_the_excerpt($product_id) ) {
			$html = '<div class="qodef-pd-excerpt">' . $product_excerpt . '</div>';
		}

		return $html;
	}

	/**
	 * Filter product by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function productIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$product_id = (int) $query;
		$post_meta_details = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'product' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_details ) && ! empty( $post_meta_details ) ) {
			foreach ( $post_meta_details as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'bazaar' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'bazaar' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;

	}

	/**
	 * Find product by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function productIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			
			$product = get_post( (int) $query );
			if ( ! is_wp_error( $product ) ) {
				
				$product_id = $product->ID;
				$product_title = $product->post_title;
				
				$product_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$product_title_display = ' - ' . esc_html__( 'Title', 'bazaar' ) . ': ' . $product_title;
				}
				
				$product_id_display = esc_html__( 'Id', 'bazaar' ) . ': ' . $product_id;

				$data          = array();
				$data['value'] = $product_id;
				$data['label'] = $product_id_display . $product_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}