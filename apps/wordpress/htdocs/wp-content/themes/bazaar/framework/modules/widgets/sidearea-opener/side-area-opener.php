<?php

class BazaarQodefSideAreaOpener extends BazaarQodefWidget {
	public function __construct() {
		parent::__construct(
			'qodef_side_area_opener',
			esc_html__( 'Select Side Area Opener', 'bazaar' ),
			array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'bazaar' ) )
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__( 'Side Area Opener Color', 'bazaar' ),
				'description' => esc_html__( 'Define color for side area opener', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__( 'Side Area Opener Hover Color', 'bazaar' ),
				'description' => esc_html__( 'Define hover color for side area opener', 'bazaar' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__( 'Side Area Opener Margin', 'bazaar' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'bazaar' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Side Area Opener Title', 'bazaar' )
			)
		);
	}

	public function widget( $args, $instance ) {

		$sidearea_image       = QODE_ASSETS_ROOT . "/img/sidearea-opener.png";
		$sidearea_image_light = QODE_ASSETS_ROOT . "/img/sidearea-opener-light.png";
		?>

        <a class="qodef-side-menu-button-opener" href="javascript:void(0)">
			<?php if ( ! empty( $instance['widget_title'] ) ) { ?>
                <h5 class="qodef-side-menu-title"><?php echo esc_html( $instance['widget_title'] ); ?></h5>
			<?php } ?>
            <span class="qodef-sidearea-image">
                <img class="qodef-sidearea-image-dark" src="<?php echo esc_url( $sidearea_image ); ?> " alt="<?php esc_attr_e( 'Sidearea image', 'bazaar' ); ?>"/>
                <img class="qodef-sidearea-image-light" src="<?php echo esc_url( $sidearea_image_light ); ?> " alt="<?php esc_attr_e( 'Sidearea image', 'bazaar' ); ?>"/>
            </span>
        </a>
	<?php }
}