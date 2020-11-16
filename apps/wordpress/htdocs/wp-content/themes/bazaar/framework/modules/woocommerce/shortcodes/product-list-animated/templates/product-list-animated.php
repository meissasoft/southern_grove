<div class="qodef-pla-holder <?php echo esc_attr( $holder_classes ) ?>">
	<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) :
	$query_result->the_post(); ?>
	<?php
	$product = bazaar_qodef_return_woocommerce_global_variable();

	$rating_enabled = false;
	if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
		$rating_enabled = true;
		$average        = $product->get_average_rating();
	}
	$new_layout = bazaar_qodef_get_meta_field_intersect( 'single_product_new' );
	?>
    <div class="qodef-pla-item">
        <div class="qodef-pla-inner">
            <div class="qodef-pla-image">
				<?php if ( $product->is_on_sale() ) : ?>
                    <span class="qodef-pla-onsale"><?php esc_html_e( 'SALE', 'bazaar' ); ?></span>
				<?php endif; ?>
				<?php if ( ! $product->is_in_stock() ) : ?>
                    <span class="qodef-pla-out-of-stock"><?php esc_html_e( 'OUT OF STOCK', 'bazaar' ); ?></span>
				<?php endif; ?>
				<?php if ( $new_layout === 'yes' ) : ?>
                    <span class="qodef-pla-new-product"><?php esc_html_e( 'NEW', 'bazaar' ); ?></span>
				<?php endif; ?>
				<?php
				$product_image_size = 'shop_single';
				if ( $image_size === 'original' ) {
					$product_image_size = 'full';
				} else if ( $image_size === 'square' ) {
					$product_image_size = 'bazaar_qodef_square';
				} else if ( $image_size === 'landscape' ) {
					$product_image_size = 'bazaar_qodef_landscape';
				}
				echo get_the_post_thumbnail( get_the_ID(), apply_filters( 'bazaar_qodef_product_list_standard_image_size', $product_image_size ) );
				?>
            </div>
            <div class="qodef-pla-text" <?php echo bazaar_qodef_get_inline_style( $shader_styles ); ?>>
            </div>
            <a class="qodef-pla-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
        </div>
        <div class="qodef-pla-text-wrapper">
            <<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="entry-title qodef-pla-title" <?php echo bazaar_qodef_get_inline_style( $title_styles ); ?>><?php the_title(); ?></<?php echo esc_attr( $title_tag ); ?>>
        <div class="qodef-pla-price-holder">
            <div class="qodef-pla-price"><?php print bazaar_qodef_get_module_part( $product->get_price_html() ); ?></div>
            <div class="qodef-pla-add-to-cart">
				<?php
				if ( ! $product->is_in_stock() ) {
					$button_classes = 'button ajax_add_to_cart qodef-button';
				} else if ( $product->get_type() === 'variable' ) {
					$button_classes = 'button product_type_variable add_to_cart_button qodef-button';
				} else if ( $product->get_type() === 'external' ) {
					$button_classes = 'button product_type_external qodef-button';
				} else {
					$button_classes = 'button add_to_cart_button ajax_add_to_cart qodef-button';
				}

				echo apply_filters( 'bazaar_qodef_product_list_animated_add_to_cart_link',
					sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" data-title="%s">%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $quantity ) ? $quantity : 1 ),
						esc_attr( $product->get_id() ),
						esc_attr( $product->get_sku() ),
						esc_attr( $button_classes ),
						esc_html( $product->add_to_cart_text() ),
						esc_html( $product->add_to_cart_text() )
					),
					$product );
				?>
            </div>
        </div>
		<?php if ( $rating_enabled && $display_rating === 'yes' ) { ?>
            <div class="qodef-pla-rating-holder">
                <div class="qodef-pla-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bazaar' ), $average ); ?>">
                    <span style="width:<?php echo( ( $average / 5 ) * 100 ); ?>%"></span>
                </div>
            </div>
		<?php } ?>
    </div>
</div>
<?php endwhile; else: ?>
    <div class="qodef-pla-messsage">
        <p><?php esc_html_e( 'No posts were found.', 'bazaar' ); ?></p>
    </div>
<?php endif;
wp_reset_postdata();
?>
</div>