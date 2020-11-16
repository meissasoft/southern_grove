<?php

class BazaarQodefSeparatorWidget extends BazaarQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_separator_widget',
			esc_html__( 'Select Separator Widget', 'bazaar' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'bazaar' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'bazaar' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'bazaar' ),
					'full-width' => esc_html__( 'Full Width', 'bazaar' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'bazaar' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'bazaar' ),
					'left'   => esc_html__( 'Left', 'bazaar' ),
					'right'  => esc_html__( 'Right', 'bazaar' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'bazaar' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'bazaar' ),
					'dashed' => esc_html__( 'Dashed', 'bazaar' ),
					'dotted' => esc_html__( 'Dotted', 'bazaar' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'bazaar' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget qodef-separator-widget">';
			echo do_shortcode( "[qodef_separator $params]" ); // XSS OK
		echo '</div>';
	}
}