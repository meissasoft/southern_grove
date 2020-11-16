<?php

namespace QodeCore\CPT\Shortcodes\ProductList;

use QodeCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_product_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Select Product List', 'bazaar' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list extended-custom-icon',
					'category'                  => esc_html__( 'by Select', 'bazaar' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'bazaar' ),
							'value'       => array(
								esc_html__( 'Standard', 'bazaar' ) => 'standard',
								esc_html__( 'Masonry', 'bazaar' )  => 'masonry'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'info_position',
							'heading'     => esc_html__( 'Product Info Position', 'bazaar' ),
							'value'       => array(
								esc_html__( 'Info On Image Hover', 'bazaar' ) => 'info-on-image',
								esc_html__( 'Info Below Image', 'bazaar' )    => 'info-below-image'
							),
							'admin_label' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'standard' ) ),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'bazaar' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'bazaar' ),
							'value'       => array(
								esc_html__( 'One', 'bazaar' )   => '1',
								esc_html__( 'Two', 'bazaar' )   => '2',
								esc_html__( 'Three', 'bazaar' ) => '3',
								esc_html__( 'Four', 'bazaar' )  => '4',
								esc_html__( 'Five', 'bazaar' )  => '5',
								esc_html__( 'Six', 'bazaar' )   => '6'
							),
							'save_always' => true
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'show_ordering_filter',
                            'heading'     => esc_html__('Show Ordering Filter', 'bazaar'),
                            'value'       => array_flip(bazaar_qodef_get_yes_no_select_array(false, false)),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'price_range',
                            'heading'    => esc_html__('Price range for pricing filter', 'bazaar'),
                            'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('yes')),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'orderby',
                            'heading'     => esc_html__('Order By', 'bazaar'),
                            'value'       => array_flip(bazaar_qodef_get_query_order_by_array()),
                            'save_always' => true,
                            'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'order',
                            'heading'     => esc_html__('Order', 'bazaar'),
                            'value'       => array_flip(bazaar_qodef_get_query_order_array()),
                            'save_always' => true,
                            'dependency'  => array('element' => 'show_ordering_filter', 'value' => array('no')),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'show_category_filter',
                            'heading'     => esc_html__('Show Category Filter', 'bazaar'),
                            'value'       => array_flip(bazaar_qodef_get_yes_no_select_array(false, false)),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'category_values',
                            'heading'     => esc_html__('Enter Category Values', 'bazaar'),
                            'description' => esc_html__('Separate values (category slugs) with a comma', 'bazaar'),
                            'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'show_all_item_in_filter',
                            'heading'     => esc_html__('Show "All" Item in Filter', 'bazaar'),
                            'value'       => array_flip(bazaar_qodef_get_yes_no_select_array(false, true)),
                            'dependency'  => array('element' => 'show_category_filter', 'value' => array('yes')),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'taxonomy_to_display',
                            'heading'    => esc_html__('Choose Sorting Taxonomy', 'bazaar'),
                            'value' => array(
                                esc_html__('Category', 'bazaar') => 'category',
                                esc_html__('Tag', 'bazaar')      => 'tag',
                                esc_html__('Id', 'bazaar')       => 'id'
                            ),
                            'description' => esc_html__('If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'bazaar'),
                            'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'taxonomy_values',
                            'heading'     => esc_html__('Enter Taxonomy Values', 'bazaar'),
                            'description' => esc_html__('Separate values (category slugs, tags, or post IDs) with a comma', 'bazaar'),
                            'dependency'  => array('element' => 'show_category_filter', 'value' => array('no')),
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'space_between_items',
							'heading'    => esc_html__( 'Space Between Items', 'bazaar' ),
							'value'      => array(
								esc_html__( 'Normal', 'bazaar' )   => 'normal',
								esc_html__( 'Small', 'bazaar' )    => 'small',
								esc_html__( 'Tiny', 'bazaar' )     => 'tiny',
								esc_html__( 'No Space', 'bazaar' ) => 'no'
							),
							'save_always' => true
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
							'type'       => 'dropdown',
							'param_name' => 'image_size',
							'heading'    => esc_html__( 'Image Proportions', 'bazaar' ),
							'value'      => array(
								esc_html__( 'Default', 'bazaar' )        => '',
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
							'dependency'  => array('element' => 'type', 'value' => 'standard'),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_fixed_proportions',
							'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'bazaar' ),
							'value'       => array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Set predefined image proportions for your masonry product list. This option will apply image proportions you set in Product Single page - dimensions for masonry option.', 'bazaar' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
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
							'param_name' => 'product_info_skin',
							'heading'    => esc_html__( 'Product Info Skin', 'bazaar' ),
							'value'      => array(
								esc_html__( 'Default', 'bazaar' ) => '',
								esc_html__( 'Light', 'bazaar' )   => 'light',
							),
							'group'      => esc_html__( 'Product Info Style', 'bazaar' )
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
							'type'       	=> 'dropdown',
							'param_name' 	=> 'display_rating',
							'heading'    	=> esc_html__( 'Display Rating', 'bazaar' ),
							'value'      	=> array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
							'group'      	=> esc_html__( 'Product Info', 'bazaar' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_price',
							'heading'    => esc_html__( 'Display Price', 'bazaar' ),
							'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'bazaar' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'shader_background_color',
							'heading'    => esc_html__( 'Shader Background Color', 'bazaar' ),
							'group'      => esc_html__( 'Product Info Style', 'bazaar' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'info_bottom_text_align',
							'heading'    => esc_html__( 'Product Info Text Alignment', 'bazaar' ),
							'value'      => array(
								esc_html__( 'Default', 'bazaar' ) => '',
								esc_html__( 'Left', 'bazaar' )    => 'left',
								esc_html__( 'Center', 'bazaar' )  => 'center',
								esc_html__( 'Right', 'bazaar' )   => 'right'
							),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'bazaar' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_bottom_margin',
							'heading'    => esc_html__( 'Product Info Bottom Margin (px)', 'bazaar' ),
							'dependency' => array( 'element' => 'info_position', 'value'   => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'bazaar' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'                    	=> 'standard',
			'info_position'           	=> 'info-on-image',
			'number_of_posts'         	=> '8',
			'number_of_columns'       	=> '4',
			'space_between_items'     	=> 'normal',
			'order_by'                	=> 'date',
			'order'                   	=> 'ASC',
            'show_category_filter' 	    => 'no',
            'price_range'	  		    => '',
            'show_ordering_filter'      => 'no',
            'category_values' 	  	    => '',
            'show_all_item_in_filter'   => 'yes',
			'taxonomy_to_display'     	=> 'category',
			'taxonomy_values'         	=> '',
			'image_size'                => 'full',
			'enable_fixed_proportions' 	=> 'no',
			'display_title'           	=> 'yes',
			'product_info_skin'       	=> '',
			'product_info_position'		=> 'info-position-top',
			'title_tag'               	=> 'h5',
			'title_transform'         	=> '',
			'display_category'        	=> 'no',
			'display_excerpt'         	=> 'no',
			'excerpt_length'          	=> '20',
			'display_rating'          	=> 'no',
			'display_price'           	=> 'yes',
			'shader_background_color' 	=> '',
			'info_bottom_text_align'  	=> '',
			'info_bottom_margin'      	=> '',
			'product_slider_on'			=> 'no',
			'holder_data'				=> ''
		);

		$params       = shortcode_atts( $default_atts, $atts );

		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		if ( $params['type'] == 'masonry' ) {
			$params['info_position'] = 'info-on-image';
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_inner_classes'] = $this-> getHolderInnerClasses($params);
		$params['class_name']     = 'pli';

		$params['title_tag']    = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles( $params );

        $params['categories_filter_list'] = $this->getProductCategoriesList($params);
        $params['ordering_filter_list'] = $this->getProductOrderingList($params);
        $params['pricing_filter_list'] = $this->getProductPricingList($params);
        $params['outer_data'] = $this->getHolderData($params);

		$params['shader_styles'] = $this->getShaderStyles( $params );

		$params['text_wrapper_styles'] = $this->getTextWrapperStyles( $params );

        $params['category'] = ''; //used for ajax calling in category filter
        $params['meta_key'] = ''; //used for ajax calling in category filter
        $params['min_price'] = ''; //used for ajax calling in ordering filter
        $params['max_price'] = ''; //used for ajax calling in ordering filter

		$queryArray             = $this->generateProductQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;


		$html = bazaar_qodef_get_woo_shortcode_module_template_part( 'templates/product-list-' . $params['type'], 'product-list', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = '';
		
		$productListType = ! empty( $params['type'] ) ? 'qodef-' . $params['type'] . '-layout' : 'qodef-standard-layout';
		
		$columnsSpace = ! empty( $params['space_between_items'] ) ? 'qodef-' . $params['space_between_items'] . '-space' : 'qodef-normal-space';
		
		$columnNumber = $this->getColumnNumberClass( $params );

		$image_proportions= $params['enable_fixed_proportions'] === 'yes' ? 'qodef-pl-images-fixed' : '';
		
		$infoPosition = ! empty( $params['info_position'] ) ? 'qodef-' . $params['info_position'] : 'qodef-info-on-image';

		$infoTextPosition = $params['product_info_position'];
		
		$productInfoClasses = ! empty( $params['product_info_skin'] ) ? 'qodef-product-info-' . $params['product_info_skin'] : '';
		
		$holderClasses .= $productListType . ' ' . $columnsSpace . ' ' . $columnNumber . ' ' . $image_proportions . ' ' . $infoPosition . ' ' . $infoTextPosition . ' ' . $productInfoClasses;
		
		return $holderClasses;
	}

	public function getHolderInnerClasses( $params ) {
		$classes = array();

		$classes[] = $params['product_slider_on'] === 'yes' ? 'qodef-owl-slider' : '';

		return implode( ' ', $classes );
	}
	
	private function getColumnNumberClass( $params ) {
		$columnsNumber = '';
		$columns       = $params['number_of_columns'];
		
		switch ( $columns ) {
			case 1:
				$columnsNumber = 'qodef-one-column';
				break;
			case 2:
				$columnsNumber = 'qodef-two-columns';
				break;
			case 3:
				$columnsNumber = 'qodef-three-columns';
				break;
			case 4:
				$columnsNumber = 'qodef-four-columns';
				break;
			case 5:
				$columnsNumber = 'qodef-five-columns';
				break;
			case 6:
				$columnsNumber = 'qodef-six-columns';
				break;
			default:
				$columnsNumber = 'qodef-four-columns';
				break;
		}
		
		return $columnsNumber;
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

        //used for ajax calling in ordering filter
        if($params['show_ordering_filter'] == 'yes') {
            unset($queryArray['orderby'], $queryArray['order']);

            if ($params['meta_key'] !== ''){
                $queryArray['orderby'] = $params['orderby'];
                $queryArray['order'] = $params['order'];
                $queryArray['meta_key'] = $params['meta_key'];
            }

            if($params['min_price'] !== '' || $params['max_price'] !== ''){
                $queryArray['meta_query'] = array(
                    array(
                        'key' => '_price',
                        'value' => array($params['min_price'], $params['max_price']),
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC'
                    ),
                );
            }
        }

        //used for ajax calling in category filter
        if($params['show_category_filter'] == 'yes'){
            if($params['category_values'] !== '' && $params['category'] == '') {
                $queryArray['product_cat'] = $params['category_values'];
            }else {
                $queryArray['product_cat'] = $params['category'];
            }
        }

		return $queryArray;
	}

		/**
		 * Return product categories
		 *
		 * * @param $params
		 * @return string
		 */
		public function getProductCategoriesList($params) {
			$category_html = '';

			if($params['show_category_filter'] == 'yes') {
				$taxonomy = 'product_cat';
				$orderby = 'name';
				$show_count = 0;      // 1 for yes, 0 for no
				$pad_counts = 0;      // 1 for yes, 0 for no
				$hierarchical = 1;      // 1 for yes, 0 for no
				$title = '';
				$empty = 0;
				$parent = 0;

				$args = array(
					'taxonomy' => $taxonomy,
					'orderby' => $orderby,
					'show_count' => $show_count,
					'pad_counts' => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li' => $title,
					'hide_empty' => $empty,
					'parent' => $parent
				);

				$all_categories_string = '';
				if($params['category_values'] == ''){

					$all_categories = get_categories($args);

				}else{
					$all_categories = array();
					$categories = explode(',',$params['category_values']);
					foreach ($categories as $cat){
						$all_categories[] = get_term_by( 'slug', $cat, 'product_cat' );
						$all_categories_string .= $cat.',';
					}
				}

				if($params['show_all_item_in_filter'] == 'yes') {
					$category_html .= '<li><a class="qodef-no-smooth-transitions active" data-category="' . $all_categories_string . '" href="#">' . esc_html__('All', 'bazaar') . '</a></li>';
				}
				foreach ($all_categories as $cat) {
					$category_html .= '<li><a class="qodef-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($cat->slug, 'product_cat') . '">' . $cat->name . '</a></li>';

					$termchildren = get_term_children( $cat->term_id, 'product_cat' );

					if(!empty($termchildren)){
						foreach ( $termchildren as $child ) {
							$cat = get_term_by( 'id', $child, 'product_cat' );
							$category_html .= '<li><a class="qodef-no-smooth-transitions" data-category="'.$cat->slug.'" href="' . get_term_link($child, 'product_cat') . '">' . $cat->name . '</a></li>';
						}
					}
				}
			}

			return $category_html;
		}

    /**
     * Return products sort by
     *
     * * @param $params
     * @return string
     */
    public function getProductOrderingList($params) {
        $sorting_list_html = '';

        if($params['show_ordering_filter'] == 'yes') {
            $orderby_options = apply_filters('woocommerce_catalog_orderby', array(
                'menu_order' => esc_html__('Default', 'bazaar'),
                'popularity' => esc_html__('Popularity', 'bazaar'),
                'rating' => esc_html__('Average rating', 'bazaar'),
                'newness' => esc_html__('Newness', 'bazaar'),
                'price' => esc_html__('Price: Low to High', 'bazaar'),
                'price-desc' => esc_html__('Price: High to Low', 'bazaar')
            ));

            if (get_option('woocommerce_enable_review_rating') === 'no') {
                unset($orderby_options['rating']);
            }

            foreach ($orderby_options as $key => $value) {
                $sorting_list_html .= '<li><a class="qodef-no-smooth-transitions" data-ordering="'. $key .'" href="#">'. $value .'</a></li>';
            }
        }

        return $sorting_list_html;
    }

    /**
     * Return products sort by
     *
     * * @param $params
     * @return string
     */
    public function getProductPricingList($params) {
        $pricing_list_html = '';

        if($params['show_ordering_filter'] == 'yes') {
            $range = $params['price_range'] !== '' ? $params['price_range'] : 10;
            $value = 0;

            $pricing_list_html .= '<li><a data-minPrice="" data-maxPrice="" href="#">' . esc_html__('All', 'bazaar') . '</a></li>';
            for ($i = 1; $i <= 5; $i++){
                if($i !== 5){
                    $pricing_list_html .= '<li><a data-minPrice="'. $value .'" data-maxPrice="'. ($value+$range) .'" href="#">'. get_woocommerce_currency_symbol().$value .'-'.get_woocommerce_currency_symbol().($value+$range). '</a></li>';

                }else{
                    $pricing_list_html .= '<li><a data-minPrice="'. ($value) .'" data-maxPrice="'.(100000000000).'" href="#">'. ($value).get_woocommerce_currency_symbol(). '+</a></li>';
                }

                $value += $range;
            }

        }

        return $pricing_list_html;
    }
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}

	public function getShaderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['shader_background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['shader_background_color'];
		}

		return implode( ';', $styles );
	}
	
	public function getTextWrapperStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['info_bottom_text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['info_bottom_text_align'];
		}
		
		if ( $params['info_bottom_margin'] !== '' ) {
			$styles[] = 'margin-bottom: ' . bazaar_qodef_filter_px( $params['info_bottom_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

    /**
     * Generates data attributes array
     *
     * @param $params
     *
     * @return string
     */
    public function getHolderData($params){
        $dataString = '';
        if($params['product_slider_on'] == 'no') {
            unset($params['categories_filter_list'], $params['ordering_filter_list'], $params['pricing_filter_list']);
            foreach ($params as $key => $value) {
                if ($value !== '') {
                    $new_key = str_replace('_', '-', $key);

                    $dataString .= ' data-' . $new_key . '="' . esc_attr($value) . '"';
                }
            }
        }

        return $dataString;
    }
}