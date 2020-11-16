<?php
namespace QodeCore\CPT\Shortcodes\BlogList;

use QodeCore\Lib;

class BlogList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_blog_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
		
		//Category filter
		add_filter( 'vc_autocomplete_qodef_blog_list_category_callback', array( &$this, 'blogCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Category render
		add_filter( 'vc_autocomplete_qodef_blog_list_category_render', array( &$this, 'blogCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name'                      => esc_html__( 'Select Blog List', 'bazaar' ),
				'base'                      => $this->base,
				'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
				'category'                  => esc_html__( 'by Select', 'bazaar' ),
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'type',
						'heading'     => esc_html__( 'Type', 'bazaar' ),
						'value'       => array(
							esc_html__( 'Standard', 'bazaar' ) => 'standard',
							esc_html__( 'Minimal', 'bazaar' )  => 'minimal'
						),
						'save_always' => true
					),
					array(
						'type'       => 'textfield',
						'param_name' => 'number_of_posts',
						'heading'    => esc_html__( 'Number of Posts', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'number_of_columns',
						'heading'    => esc_html__( 'Number of Columns', 'bazaar' ),
						'value'      => array(
							esc_html__( 'One', 'bazaar' )   => '1',
							esc_html__( 'Two', 'bazaar' )   => '2',
							esc_html__( 'Three', 'bazaar' ) => '3',
							esc_html__( 'Four', 'bazaar' )  => '4',
							esc_html__( 'Five', 'bazaar' )  => '5'
						),
						'dependency' => Array( 'element' => 'type', 'value' => array( 'standard' ) )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'space_between_columns',
						'heading'    => esc_html__( 'Space Between Columns', 'bazaar' ),
						'value'      => array(
							esc_html__( 'Normal', 'bazaar' )   => 'normal',
                            esc_html__( 'Large', 'bazaar' )    => 'large',
							esc_html__( 'Small', 'bazaar' )    => 'small',
							esc_html__( 'Tiny', 'bazaar' )     => 'tiny',
							esc_html__( 'No Space', 'bazaar' ) => 'no'
						),
						'dependency' => Array( 'element' => 'type', 'value' => array( 'standard') )
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
						'type'        => 'autocomplete',
						'param_name'  => 'category',
						'heading'     => esc_html__( 'Category', 'bazaar' ),
						'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'image_size',
						'heading'    => esc_html__( 'Image Size', 'bazaar' ),
						'value'      => array(
							esc_html__( 'Original', 'bazaar' )  => 'full',
							esc_html__( 'Square', 'bazaar' )    => 'bazaar_qodef_square',
							esc_html__( 'Landscape', 'bazaar' ) => 'bazaar_qodef_landscape',
							esc_html__( 'Portrait', 'bazaar' )  => 'bazaar_qodef_portrait',
							esc_html__( 'Thumbnail', 'bazaar' ) => 'thumbnail',
							esc_html__( 'Medium', 'bazaar' )    => 'medium',
							esc_html__( 'Large', 'bazaar' )     => 'large'
						),
						'save_always' => true,
						'dependency'  => Array( 'element' => 'type', 'value' => array( 'standard') )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_tag',
						'heading'    => esc_html__( 'Title Tag', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_title_tag( true ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'title_transform',
						'heading'    => esc_html__( 'Title Text Transform', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_text_transform_array( true ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'excerpt_length',
						'heading'     => esc_html__( 'Text Length', 'bazaar' ),
						'description' => esc_html__( 'Number of characters', 'bazaar' ),
						'dependency'  => Array( 'element' => 'type', 'value'   => array( 'standard' ) ),
						'group'       => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_image',
						'heading'    => esc_html__( 'Enable Post Info Image', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard',) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_section',
						'heading'    => esc_html__( 'Enable Post Info Section', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'type', 'value'   => array( 'standard' ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_author',
						'heading'    => esc_html__( 'Enable Post Info Author', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_date',
						'heading'    => esc_html__( 'Enable Post Info Date', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_category',
						'heading'    => esc_html__( 'Enable Post Info Category', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false, true ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_comments',
						'heading'    => esc_html__( 'Enable Post Info Comments', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_like',
						'heading'    => esc_html__( 'Enable Post Info Like', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'post_info_share',
						'heading'    => esc_html__( 'Enable Post Info Share', 'bazaar' ),
						'value'      => array_flip( bazaar_qodef_get_yes_no_select_array( false ) ),
						'dependency' => Array( 'element' => 'post_info_section', 'value' => array( 'yes' ) ),
						'group'      => esc_html__( 'Post Info', 'bazaar' )
					),
					array(
						'type'       => 'dropdown',
						'param_name' => 'pagination_type',
						'heading'    => esc_html__( 'Pagination Type', 'bazaar' ),
						'value'      => array(
							esc_html__( 'None', 'bazaar' )            => 'no-pagination',
							esc_html__( 'Standard', 'bazaar' )        => 'standard-blog-list',
							esc_html__( 'Load More', 'bazaar' )       => 'load-more',
							esc_html__( 'Infinite Scroll', 'bazaar' ) => 'infinite-scroll'
						),
						'group'      => esc_html__( 'Additional Features', 'bazaar' )
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'type'                  => 'standard',
            'number_of_posts'       => '-1',
            'number_of_columns'     => '3',
            'space_between_columns' => 'normal',
			'category'              => '',
			'order_by'              => 'title',
			'order'                 => 'ASC',
			'image_size'            => 'full',
            'title_tag'             => 'h4',
			'title_transform'       => '',
			'excerpt_length'        => '40',
            'post_info_section'     => 'yes',
			'post_info_image'       => 'yes',
			'post_info_author'      => 'no',
			'post_info_date'        => 'yes',
			'post_info_category'    => 'no',
			'post_info_comments'    => 'no',
			'post_info_like'        => 'no',
			'post_info_share'       => 'no',
            'pagination_type'       => 'no-pagination'
        );
		$params = shortcode_atts($default_atts, $atts);
		
		$queryArray = $this->generateQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$params['holder_data'] = $this->getHolderData($params);
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['module'] = 'list';
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged'] = isset($query_result->query['paged']) ? $query_result->query['paged'] : 1;

		$params['this_object'] = $this;
		
		ob_start();
		
		bazaar_qodef_get_module_template_part('shortcodes/blog-list/holder', 'blog', $params['type'], $params);
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		return $html;	
	}
	
	public function generateQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['order_by'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $queryArray;
	}
	
	public function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'qodef-bl-' . $params['type'] : 'qodef-bl-standard';
		$holderClasses[] = $this->getColumnNumberClass( $params['number_of_columns'] );
		$holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'qodef-bl-' . $params['space_between_columns'] . '-space' : 'qodef-bl-normal-space';
		$holderClasses[] = ! empty( $params['pagination_type'] ) ? 'qodef-bl-pag-' . $params['pagination_type'] : 'qodef-bl-pag-no-pagination';
		
		return implode( ' ', $holderClasses );
	}
	
	public function getColumnNumberClass( $params ) {
		switch ( $params ) {
			case 1:
				$classes = 'qodef-bl-one-column';
				break;
			case 2:
				$classes = 'qodef-bl-two-columns';
				break;
			case 3:
				$classes = 'qodef-bl-three-columns';
				break;
			case 4:
				$classes = 'qodef-bl-four-columns';
				break;
			case 5:
				$classes = 'qodef-bl-five-columns';
				break;
			default:
				$classes = 'qodef-bl-three-columns';
				break;
		}
		
		return $classes;
	}
	
	public function getHolderData( $params ) {
		$dataString = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_result = $params['query_result'];
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		
		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}
		
		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-' . $new_key . '=' . esc_attr( $value );
			}
		}
		
		return $dataString;
	}
	
	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}

	/**
	 * Filter blog categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function blogCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'bazaar' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find blog category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function blogCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {
				
				$category_slug = $category->slug;
				$category_title = $category->name;
				
				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'bazaar' ) . ': ' . $category_title;
				}
				
				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}