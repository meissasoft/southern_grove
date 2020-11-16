<?php

class BazaarQodefYithWishlist extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'qodef_woocommerce_yith_wishlist',
			esc_html__( 'Select Woocommerce Wishlist', 'bazaar' ),
			array( 'description' => esc_html__( 'Display a wishlist icon with number of products that are in the wishlist', 'bazaar' ), )
		);
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->params as $param ) {
			$param_name = $param['name'];

			$instance[ $param_name ] = sanitize_text_field( $new_instance[ $param_name ] );
		}

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );

		global $yith_wcwl;
		$unique_id = rand( 1000, 9999 );
		?>
        <div class="qodef-wishlist-widget-holder">
            <a href="<?php echo esc_url( $yith_wcwl->get_wishlist_url() ); ?>" class="qodef-wishlist-widget-link">
                <span class="qodef-wishlist-widget-icon"><i class="icon_heart_alt"></i></span>
                <span class="qodef-wishlist-items-number">(<span><?php echo yith_wcwl_count_products(); ?></span>)</span>
            </a>
	        <?php wp_nonce_field( 'bazaar_select_product_wishlist_nonce_' . $unique_id, 'bazaar_select_product_wishlist_nonce_' . $unique_id ); ?>
        </div>
		<?php
	}
}