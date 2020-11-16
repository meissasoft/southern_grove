<?php

class BazaarQodefImageGalleryWidget extends BazaarQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_image_gallery_widget',
			esc_html__( 'Select Image Gallery Widget', 'bazaar' ),
			array( 'description' => esc_html__( 'Add image gallery element to widget areas', 'bazaar' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Custom CSS Class', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'bazaar' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Gallery Type', 'bazaar' ),
				'options' => array(
					'grid'   => esc_html__( 'Image Grid', 'bazaar' ),
					'slider' => esc_html__( 'Slider', 'bazaar' )
				)
			),
			array(
				'type'        => 'textfield',
				'name'        => 'images',
				'title'       => esc_html__( 'Image ID\'s', 'bazaar' ),
				'description' => esc_html__( 'Add images id for your image gallery widget, separate id\'s with comma', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'image_size',
				'title'       => esc_html__( 'Image Size', 'bazaar' ),
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'bazaar' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'enable_image_shadow',
				'title'   => esc_html__( 'Enable Image Shadow', 'bazaar' ),
				'options' => bazaar_qodef_get_yes_no_select_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'image_behavior',
				'title'   => esc_html__( 'Image Behavior', 'bazaar' ),
				'options' => array(
					''            => esc_html__( 'None', 'bazaar' ),
					'lightbox'    => esc_html__( 'Open Lightbox', 'bazaar' ),
					'custom-link' => esc_html__( 'Open Custom Link', 'bazaar' ),
					'zoom'        => esc_html__( 'Zoom', 'bazaar' ),
					'grayscale'   => esc_html__( 'Grayscale', 'bazaar' )
				)
			),
			array(
				'type'        => 'textarea',
				'name'        => 'custom_links',
				'title'       => esc_html__( 'Custom Links', 'bazaar' ),
				'description' => esc_html__( 'Delimit links by comma', 'bazaar' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'custom_link_target',
				'title'   => esc_html__( 'Custom Link Target', 'bazaar' ),
				'options' => bazaar_qodef_get_link_target_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'number_of_columns',
				'title'   => esc_html__( 'Number of Columns', 'bazaar' ),
				'options' => array(
					'two'   => esc_html__( 'Two', 'bazaar' ),
					'three' => esc_html__( 'Three', 'bazaar' ),
					'four'  => esc_html__( 'Four', 'bazaar' ),
					'five'  => esc_html__( 'Five', 'bazaar' ),
					'six'   => esc_html__( 'Six', 'bazaar' )
				)
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
				'name'    => 'slider_navigation',
				'title'   => esc_html__( 'Enable Slider Navigation Arrows', 'bazaar' ),
				'options' => bazaar_qodef_get_yes_no_select_array( false )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'slider_pagination',
				'title'   => esc_html__( 'Enable Slider Pagination', 'bazaar' ),
				'options' => bazaar_qodef_get_yes_no_select_array( false )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$extra_class      = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
		$instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'grid';
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		?>
		
		<div class="widget qodef-image-gallery-widget <?php echo esc_html( $extra_class ); ?>">
			<?php
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			echo do_shortcode( "[qodef_image_gallery $params]" ); // XSS OK
			?>
		</div>
		<?php
	}
}