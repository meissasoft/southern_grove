<?php

class BazaarQodefButtonWidget extends BazaarQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_button_widget',
			esc_html__( 'Select Button Widget', 'bazaar' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'bazaar' ) )
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
					'solid'   => esc_html__( 'Solid', 'bazaar' ),
					'outline' => esc_html__( 'Outline', 'bazaar' ),
					'simple'  => esc_html__( 'Simple', 'bazaar' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'bazaar' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'bazaar' ),
					'medium' => esc_html__( 'Medium', 'bazaar' ),
					'large'  => esc_html__( 'Large', 'bazaar' ),
					'huge'   => esc_html__( 'Huge', 'bazaar' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'bazaar' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'bazaar' ),
				'default' => esc_html__( 'Button Text', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'bazaar' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'bazaar' ),
				'options' => bazaar_qodef_get_link_target_array()
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'bazaar' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'bazaar' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'bazaar' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'bazaar' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'bazaar' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'bazaar' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget qodef-button-widget">';
			echo do_shortcode( "[qodef_button $params]" ); // XSS OK
		echo '</div>';
	}
}