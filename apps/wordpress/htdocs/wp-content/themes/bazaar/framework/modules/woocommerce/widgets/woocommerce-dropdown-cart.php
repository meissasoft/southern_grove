<?php

class BazaarQodefWoocommerceDropdownCart extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'qodef_woocommerce_dropdown_cart',
			esc_html__( 'Select Woocommerce Dropdown Cart', 'bazaar' ),
			array( 'description' => esc_html__( 'Display a shop cart icon with a dropdown that shows products that are in the cart', 'bazaar' ), )
		);

		$this->setParams();
	}

	protected function setParams() {

		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'woocommerce_dropdown_cart_margin',
				'title'       => esc_html__( 'Icon Margin', 'bazaar' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'bazaar' )
			)
		);
	}

	/**
	 * Generate widget form based on $params attribute
	 *
	 * @param array $instance
	 *
	 * @return null
	 */
	public function form( $instance ) {
		if ( is_array( $this->params ) && count( $this->params ) ) {
			foreach ( $this->params as $param_array ) {
				$param_name    = $param_array['name'];
				${$param_name} = isset( $instance[ $param_name ] ) ? esc_attr( $instance[ $param_name ] ) : '';
			}

			foreach ( $this->params as $param ) {
				switch ( $param['type'] ) {
					case 'textfield':
						?>
                        <p>
                            <label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo
								esc_html( $param['title'] ); ?>:</label>
                            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
							<?php if ( ! empty( $param['description'] ) ) : ?>
                                <span class="qodef-field-description"><?php echo esc_html( $param['description'] ); ?></span>
							<?php endif; ?>
                        </p>
						<?php
						break;
					case 'dropdown':
						?>
                        <p>
                            <label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo
								esc_html( $param['title'] ); ?>:</label>
							<?php if ( isset( $param['options'] ) && is_array( $param['options'] ) && count( $param['options'] ) ) { ?>
                                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>">
									<?php foreach ( $param['options'] as $param_option_key => $param_option_val ) {
										$option_selected = '';
										if ( ${$param['name']} == $param_option_key ) {
											$option_selected = 'selected';
										}
										?>
                                        <option <?php echo esc_attr( $option_selected ); ?> value="<?php echo esc_attr( $param_option_key ); ?>"><?php echo esc_attr( $param_option_val ); ?></option>
									<?php } ?>
                                </select>
							<?php } ?>
							<?php if ( ! empty( $param['description'] ) ) : ?>
                                <span class="qodef-field-description"><?php echo esc_html( $param['description'] ); ?></span>
							<?php endif; ?>
                        </p>

						<?php
						break;
				}
			}
		} else { ?>
            <p><?php esc_html_e( 'There are no options for this widget.', 'bazaar' ); ?></p>
		<?php }
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

		global $woocommerce;

		$icon_styles = array();

		if ( $instance['woocommerce_dropdown_cart_margin'] !== '' ) {
			$icon_styles[] = 'padding: ' . $instance['woocommerce_dropdown_cart_margin'];
		}

		$cart_image       = QODE_ASSETS_ROOT . "/img/cart.png";
		$cart_image_light = QODE_ASSETS_ROOT . "/img/cart-light.png";

		$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
		?>
        <div class="qodef-shopping-cart-holder" <?php bazaar_qodef_inline_style( $icon_styles ) ?>>
            <div class="qodef-shopping-cart-inner">
                <a itemprop="url" class="qodef-header-cart" href="<?php echo wc_get_cart_url(); ?>">
					<span class="qodef-cart-image">
                        <img class="qodef-cart-image-dark" src="<?php echo esc_url( $cart_image ); ?> " alt="<?php echo esc_attr__( 'cart-image', 'bazaar' ); ?>"/>
                        <img class="qodef-cart-image-light" src="<?php echo esc_url( $cart_image_light ); ?> " alt="<?php echo esc_attr__( 'cart-image', 'bazaar' ); ?>"/>
                        <span class="qodef-cart-info">
                            <span class="qodef-cart-info-number"><?php echo sprintf( _n( '%d', '%d', WC()->cart->cart_contents_count, 'bazaar' ), WC()->cart->cart_contents_count ); ?></span>
                        </span>
                    </span>
                </a>
                <div class="qodef-shopping-cart-dropdown">
                    <ul>
						<?php if ( ! $cart_is_empty ) : ?>
							<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
								$_product = $cart_item['data'];
								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}
								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
								?>
                                <li>
                                    <div class="qodef-item-image-holder">
                                        <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
											<?php echo wp_kses( $_product->get_image(), array(
												'img' => array(
													'src'    => true,
													'width'  => true,
													'height' => true,
													'class'  => true,
													'alt'    => true,
													'title'  => true,
													'id'     => true
												)
											) ); ?>
                                        </a>
                                    </div>
                                    <div class="qodef-item-info-holder">
                                        <p itemprop="name" class="qodef-product-title">
                                            <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>"><?php echo apply_filters( 'bazaar_qodef_woo_widget_cart_product_title', $_product->get_name(), $_product ); ?></a>
                                        </p>
                                        <span class="qodef-quantity"><?php echo esc_html( $cart_item['quantity'] ) . ' x'; ?></span>
										<?php echo apply_filters( 'bazaar_qodef_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
										<?php echo apply_filters( 'bazaar_qodef_woo_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'bazaar' ) ), $cart_item_key ); ?>
                                    </div>
                                </li>
							<?php endforeach; ?>
                            <li class="qodef-cart-bottom">
                                <div class="qodef-subtotal-holder clearfix">
                                    <span class="qodef-total"><?php esc_html_e( 'total:', 'bazaar' ); ?></span>
                                    <span class="qodef-total-amount">
										<?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
											'span' => array(
												'class' => true,
												'id'    => true
											)
										) ); ?>
									</span>
                                </div>
                                <div class="qodef-btn-holder clearfix">
                                    <a itemprop="url" href="<?php echo wc_get_cart_url(); ?>" class="qodef-view-cart" data-title="<?php esc_html_e( 'VIEW CART', 'bazaar' ); ?>"><span><?php esc_html_e( 'VIEW CART', 'bazaar' ); ?></span></a>
                                </div>
                                <div class="qodef-btn-holder clearfix">
                                    <a itemprop="url" href="<?php echo wc_get_checkout_url(); ?>" class="qodef-view-checkout" data-title="<?php esc_html_e( 'CHECKOUT', 'bazaar' ); ?>"><span><?php esc_html_e( 'CHECKOUT', 'bazaar' ); ?></span></a>
                                </div>
                            </li>
						<?php else : ?>
                            <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'bazaar' ); ?></li>
						<?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
		<?php
	}
}

add_filter( 'woocommerce_add_to_cart_fragments', 'bazaar_qodef_woocommerce_header_add_to_cart_fragment' );

function bazaar_qodef_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	$cart_image       = QODE_ASSETS_ROOT . "/img/cart.png";
	$cart_image_light = QODE_ASSETS_ROOT . "/img/cart-light.png";

	ob_start();

	$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
	?>
    <div class="qodef-shopping-cart-inner">
        <a itemprop="url" class="qodef-header-cart" href="<?php echo wc_get_cart_url(); ?>">
			<span class="qodef-cart-image">
                <img class="qodef-cart-image-dark" src="<?php echo esc_url( $cart_image ); ?> " alt="<?php esc_attr_e( 'cart-image', 'bazaar' ); ?>"/>
                <img class="qodef-cart-image-light" src="<?php echo esc_url( $cart_image_light ); ?> " alt="<?php esc_attr_e( 'cart-image', 'bazaar' ); ?>"/>
                <span class="qodef-cart-info">
                    <span class="qodef-cart-info-number"><?php echo sprintf( _n( '%d', '%d', WC()->cart->cart_contents_count, 'bazaar' ), WC()->cart->cart_contents_count ); ?></span>
                </span>
            </span>
        </a>
        <div class="qodef-shopping-cart-dropdown">
            <ul>
				<?php if ( ! $cart_is_empty ) : ?>
					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
						$_product = $cart_item['data'];
						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}
						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
						?>
                        <li>
                            <div class="qodef-item-image-holder">
                                <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
									<?php echo wp_kses( $_product->get_image(), array(
										'img' => array(
											'src'    => true,
											'width'  => true,
											'height' => true,
											'class'  => true,
											'alt'    => true,
											'title'  => true,
											'id'     => true
										)
									) ); ?>
                                </a>
                            </div>
                            <div class="qodef-item-info-holder">
                                <p itemprop="name" class="qodef-product-title">
                                    <a itemprop="url" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>"><?php echo apply_filters( 'bazaar_qodef_woo_widget_cart_product_title', $_product->get_name(), $_product ); ?></a>
                                </p>
                                <span class="qodef-quantity"><?php echo esc_html( $cart_item['quantity'] ) . ' x'; ?></span>
								<?php echo apply_filters( 'bazaar_qodef_woo_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
								<?php echo apply_filters( 'bazaar_qodef_woo_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><span class="icon-arrows-remove"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'bazaar' ) ), $cart_item_key ); ?>
                            </div>
                        </li>
					<?php endforeach; ?>
                    <li class="qodef-cart-bottom">
                        <div class="qodef-subtotal-holder clearfix">
                            <span class="qodef-total"><?php esc_html_e( 'total:', 'bazaar' ); ?></span>
                            <span class="qodef-total-amount">
								<?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
									'span' => array(
										'class' => true,
										'id'    => true
									)
								) ); ?>
							</span>
                        </div>
                        <div class="qodef-btn-holder clearfix">
                            <a itemprop="url" href="<?php echo wc_get_cart_url(); ?>" class="qodef-view-cart" data-title="<?php esc_html_e( 'VIEW CART', 'bazaar' ); ?>"><span><?php esc_html_e( 'VIEW CART', 'bazaar' ); ?></span></a>
                        </div>
                        <div class="qodef-btn-holder clearfix">
                            <a itemprop="url" href="<?php echo wc_get_checkout_url(); ?>" class="qodef-view-checkout" data-title="<?php esc_html_e( 'CHECKOUT', 'bazaar' ); ?>"><span><?php esc_html_e( 'CHECKOUT', 'bazaar' ); ?></span></a>
                        </div>
                    </li>
				<?php else : ?>
                    <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'bazaar' ); ?></li>
				<?php endif; ?>
            </ul>
        </div>
    </div>

	<?php
	$fragments['div.qodef-shopping-cart-inner'] = ob_get_clean();

	return $fragments;
}

?>