<?php

namespace QodeCore\CPT\Shortcodes\ProductListAnimated;

use QodeCore\Lib;

class ProductListAnimated implements Lib\ShortcodeInterface {
	/**
	* @var string
	*/
	private $base;
	
	function __construct() {
		$this->base = 'qodef_product_list_animated';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Select Product List - Animated', 'bazaar'),
			'base' => $this->base,
			'icon' => 'icon-wpb-product-list-animated extended-custom-icon',
			'category' => esc_html__('by Select', 'bazaar'),
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
							'type'   	  => 'dropdown',
							'heading' 	  => esc_html__('Enable Animation', 'bazaar'),
							'param_name'  => 'enable_animation',
							'value'       => array_flip(bazaar_qodef_get_yes_no_select_array(false, true))
					),
					array(
						'type'   	  => 'textfield',
						'holder' 	  => 'div',
						'class'  	  => '',
						'heading' 	  => esc_html__('Number of Products', 'bazaar'),
						'param_name'  => 'number_of_posts',
						'description' => ''
					),
                    array(
                        'type' 		  => 'dropdown',
                        'holder' 	  => 'div',
                        'class' 	  => '',
                        'heading'	  => esc_html__('Number of Columns', 'bazaar'),
                        'param_name'  => 'number_of_columns',
                        'value' => array(
							esc_html__('One', 'bazaar')   => '1',
							esc_html__('Two', 'bazaar')   => '2',
							esc_html__('Three', 'bazaar') => '3',
							esc_html__('Four', 'bazaar')  => '4',
							esc_html__('Five', 'bazaar')  => '5',
							esc_html__('Six', 'bazaar')   => '6'
                        ),
                        'description' => '',
                        'save_always' => true
                    ),
					array(
						'type' 	 	 => 'dropdown',
						'holder'  	 => 'div',
						'class'   	 => '',
						'heading'	 => esc_html__('Order By', 'bazaar'),
						'param_name' => 'order_by',
						'value' 	 => array(
							esc_html__('Title', 'bazaar') 		=> 'title',
							esc_html__('Date', 'bazaar') 		=> 'date',
							esc_html__('Random', 'bazaar')     => 'rand',
							esc_html__('Post Name', 'bazaar')  => 'name',
							esc_html__('ID', 'bazaar') 		=> 'id',
                            esc_html__('Menu Order', 'bazaar') => 'menu_order'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' 		  => 'dropdown',
						'holder' 	  => 'div',
						'class' 	  => '',
						'heading' 	  => esc_html__('Order', 'bazaar'),
						'param_name'  => 'order',
						'value' 	  => array(
							esc_html__('ASC', 'bazaar')  => 'ASC',
							esc_html__('DESC', 'bazaar') => 'DESC'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
	                    'type' 		   => 'dropdown',
	                    'heading'	   => esc_html__('Choose Sorting Taxonomy', 'bazaar'),
	                    'param_name'   => 'taxonomy_to_display',
	                    'value' 	   => array(
	                        esc_html__('Category', 'bazaar') => 'category',
	                        esc_html__('Tag', 'bazaar') => 'tag',
	                        esc_html__('Id', 'bazaar') => 'id'
	                    ),
	                    'save_always'  => true,
	                    'admin_label'  => true,
	                    'description'  => esc_html__('If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display.', 'bazaar')
	                ),
	                array(
	                    'type' 	 	  => 'textfield',
	                    'heading' 	  => esc_html__('Enter Taxonomy Values', 'bazaar'),
	                    'param_name'  => 'taxonomy_values',
	                    'value' 	  => '',
	                    'admin_label' => true,
	                    'description' => esc_html__('Separate values (category slugs, tags, or post IDs) with a comma', 'bazaar')
	                ),
	                array(
						'type'		  => 'dropdown',
						'heading' 	  => esc_html__('Image Proportions', 'bazaar'),
						'param_name'  => 'image_size',
						'value' => array(
							esc_html__('Default', 'bazaar') => '',
							esc_html__('Original', 'bazaar') => 'original',
							esc_html__('Square', 'bazaar') => 'square',
							esc_html__('Landscape', 'bazaar') => 'landscape',
						),
						'save_always' => true
					),
	                array(
						'type' 		  => 'colorpicker',
						'holder'      => 'div',
						'heading'     => esc_html__('Shader Background Color', 'bazaar'),
						'param_name'  => 'shader_background_color',
						'description' => '',
						'group'		  => esc_html__('Product Info', 'bazaar')
					),
					array(
						'type'		  => 'dropdown',
						'admin_label' => true,
						'heading'	  => esc_html__('Title Tag', 'bazaar'),
						'param_name'  => 'title_tag',
						'value'		  => array_flip(bazaar_qodef_get_title_tag(true)),
						'save_always' => true,
						'description' => '',
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'		  => esc_html__('Product Info', 'bazaar')
					),
					array(
						'type'        => 'dropdown',
						'holder'      => 'div',
						'class'       => '',
						'heading'     => esc_html__('Title Text Transform', 'bazaar'),
						'param_name'  => 'title_transform',
						'value'       => array(
							esc_html__('Default', 'bazaar') 	 => '',
							esc_html__('None', 'bazaar') 		 => 'none',
							esc_html__('Capitalize', 'bazaar')  => 'capitalize',
							esc_html__('Lowercase', 'bazaar')   => 'lowercase',
							esc_html__('Uppercase', 'bazaar')   => 'uppercase'
						),
						'save_always' => true,
						'description' => '',
						'dependency'  => array('element' => 'display_title', 'value' => array('yes')),
						'group'		  => esc_html__('Product Info', 'bazaar')
					),
					array(
						'type' 		  => 'dropdown',
						'holder' 	  => 'div',
						'class' 	  => '',
						'heading' 	  => esc_html__('Display Rating', 'bazaar'),
						'param_name'  => 'display_rating',
						'value' 	  => array_flip(bazaar_qodef_get_yes_no_select_array(false)),
						'save_always' => true,
						'description' => '',
						'group'		  => esc_html__('Product Info', 'bazaar')
					),
				)
		) );
	}

	public function render($atts, $content = null) {
		
		$default_atts = array(
			'enable_animation'		  => 'yes',
            'number_of_posts' 		  => '8',
            'number_of_columns' 	  => '4',
            'order_by' 				  => '',
            'order' 				  => '',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => '',
            'shader_background_color' => '',
            'title_tag'				  => 'h5',
            'title_transform'		  => 'lowercase',
            'display_rating' 		  => 'no',
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['holder_classes'] = $this->getHolderClasses($params);

        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);

		$params['shader_styles'] = $this->getShaderStyles($params);

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;	

		$html = bazaar_qodef_get_woo_shortcode_module_template_part('templates/product-list-animated', 'product-list-animated', '', $params);

		return $html;	
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getHolderClasses($params){
		$holderClasses = '';
		$enable_animation = '';

        $columnNumber = $this->getColumnNumberClass($params);

		if($params['enable_animation'] == 'no'){
			$enable_animation = 'qodef-pla-animation-disabled';
		}

        $holderClasses .= $columnNumber . ' ' . $enable_animation;
		
		return $holderClasses;
	}

    /**
     * Generates columns number classes for product list holder
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params){

        $columnsNumber = '';
        $columns = $params['number_of_columns'];

        switch ($columns) {
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

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateProductQueryArray($params){
		
		$queryArray = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $params['number_of_posts'],
			'orderby' => $params['order_by'],
			'order' => $params['order'],
			'meta_query' => WC()->query->get_meta_query()
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }

        return $queryArray;
	}

	/**
     * Return Style for Title
     *
     * @param $params
     * @return string
     */
    private function getTitleStyles($params) {
        $item_styles = array();
		
        if ($params['title_transform'] !== '') {
            $item_styles[] = 'text-transform: '.$params['title_transform'];
        }

		return implode(';', $item_styles);
    }

    /**
     * Return Style for Shader
     *
     * @param $params
     * @return string
     */
    private function getShaderStyles($params) {
        $item_styles = array();
		
        if ($params['shader_background_color'] !== '') {
            $item_styles[] = 'background-color: '.$params['shader_background_color'];
        }

		return implode(';', $item_styles);
    }
}