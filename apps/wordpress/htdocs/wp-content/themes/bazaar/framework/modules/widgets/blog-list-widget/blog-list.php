<?php

class BazaarQodefBlogListWidget extends BazaarQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_blog_list_widget',
			esc_html__( 'Select Blog List Widget', 'bazaar' ),
			array( 'description' => esc_html__( 'Display a list of your blog posts', 'bazaar' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'bazaar' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'bazaar' ),
				'options' => array(
					'simple'  => esc_html__( 'Simple', 'bazaar' ),
					'minimal' => esc_html__( 'Minimal', 'bazaar' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'number_of_posts',
				'title' => esc_html__( 'Number of Posts', 'bazaar' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_columns',
				'title'   => esc_html__( 'Space Between items', 'bazaar' ),
				'options' => array(
					'normal' => esc_html__( 'Normal', 'bazaar' ),
					'small'  => esc_html__( 'Small', 'bazaar' ),
					'tiny'   => esc_html__( 'Tiny', 'bazaar' ),
					'no'     => esc_html__( 'No Space', 'bazaar' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order_by',
				'title'   => esc_html__( 'Order By', 'bazaar' ),
				'options' => bazaar_qodef_get_query_order_by_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order',
				'title'   => esc_html__( 'Order', 'bazaar' ),
				'options' => bazaar_qodef_get_query_order_array()
			),
			array(
				'type'        => 'textfield',
				'name'        => 'category',
				'title'       => esc_html__( 'Category Slug', 'bazaar' ),
				'description' => esc_html__( 'Leave empty for all or use comma for list', 'bazaar' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'bazaar' ),
				'options' => bazaar_qodef_get_title_tag( true, array('p' => 'p') )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_transform',
				'title'   => esc_html__( 'Title Text Transform', 'bazaar' ),
				'options' => bazaar_qodef_get_text_transform_array( true )
			),
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$instance['image_size']        = 'thumbnail';
		$instance['post_info_section'] = 'yes';
		$instance['number_of_columns'] = '1';
		
		// Filter out all empty params
		$instance         = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		$instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'simple';
		
		$params = '';
		//generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget qodef-blog-list-widget">';
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			
			echo do_shortcode( "[qodef_blog_list $params]" ); // XSS OK
		echo '</div>';
	}
}