<?php

if ( ! function_exists( 'bazaar_qodef_woocommerce_body_class' ) ) {
	function bazaar_qodef_woocommerce_body_class( $classes ) {
		if ( bazaar_qodef_is_woocommerce_page() ) {
			$classes[] = 'qodef-woocommerce-page';

			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$classes[] = 'qodef-woo-main-page';
			}

			if ( is_singular( 'product' ) ) {
				$classes[] = 'qodef-woo-single-page';
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_woocommerce_body_class' );
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_columns_class' ) ) {
	function bazaar_qodef_woocommerce_columns_class( $classes ) {
		$classes[] = bazaar_qodef_options()->getOptionValue( 'qodef_woo_product_list_columns' );

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_woocommerce_columns_class' );
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_columns_space_class' ) ) {
	function bazaar_qodef_woocommerce_columns_space_class( $classes ) {
		$classes[] = bazaar_qodef_options()->getOptionValue( 'qodef_woo_product_list_columns_space' );

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_woocommerce_columns_space_class' );
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_pl_info_position_class' ) ) {
	function bazaar_qodef_woocommerce_pl_info_position_class( $classes ) {
		$info_position       = bazaar_qodef_options()->getOptionValue( 'qodef_woo_product_list_info_position' );
		$info_position_class = '';

		if ( $info_position === 'info_below_image' ) {
			$info_position_class = 'qodef-woo-pl-info-below-image';
		} else if ( $info_position === 'info_on_image_hover' ) {
			$info_position_class = 'qodef-woo-pl-info-on-image-hover';
		}

		$classes[] = $info_position_class;

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_woocommerce_pl_info_position_class' );
}

if ( ! function_exists( 'bazaar_qodef_add_woocommerce_shortcode_class' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function bazaar_qodef_add_woocommerce_shortcode_class( $classes ) {
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking'
		);

		foreach ( $woocommerce_shortcodes as $woocommerce_shortcode ) {
			$has_shortcode = bazaar_qodef_has_shortcode( $woocommerce_shortcode );

			if ( $has_shortcode ) {
				$classes[] = 'qodef-woocommerce-page woocommerce-account qodef-' . str_replace( '_', '-', $woocommerce_shortcode );
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_add_woocommerce_shortcode_class' );
}

if ( ! function_exists( 'bazaar_qodef_woo_single_product_thumb_position_class' ) ) {
	function bazaar_qodef_woo_single_product_thumb_position_class( $classes ) {
		$product_thumbnail_position = bazaar_qodef_get_meta_field_intersect( 'woo_set_thumb_images_position' );

		if ( ! empty( $product_thumbnail_position ) ) {
			$classes[] = 'qodef-woo-single-thumb-' . $product_thumbnail_position;
		}

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_woo_single_product_thumb_position_class' );
}

if ( ! function_exists( 'bazaar_qodef_woo_single_product_has_zoom_class' ) ) {
	function bazaar_qodef_woo_single_product_has_zoom_class( $classes ) {
		$zoom_maginifier = bazaar_qodef_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );

		if ( $zoom_maginifier === 'yes' ) {
			$classes[] = 'qodef-woo-single-has-zoom';
		}

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_woo_single_product_has_zoom_class' );
}

if ( ! function_exists( 'bazaar_qodef_woo_single_product_has_zoom_support' ) ) {
	function bazaar_qodef_woo_single_product_has_zoom_support() {
		$zoom_maginifier = bazaar_qodef_get_meta_field_intersect( 'woo_enable_single_product_zoom_image' );

		if ( $zoom_maginifier === 'yes' ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
	}

	add_action( 'init', 'bazaar_qodef_woo_single_product_has_zoom_support' );
}

if ( ! function_exists( 'bazaar_qodef_woo_single_product_image_behavior_class' ) ) {
	function bazaar_qodef_woo_single_product_image_behavior_class( $classes ) {
		$image_behavior = bazaar_qodef_get_meta_field_intersect( 'woo_set_single_images_behavior' );

		if ( ! empty( $image_behavior ) ) {
			$classes[] = 'qodef-woo-single-has-' . $image_behavior;
		}

		return $classes;
	}

	add_filter( 'body_class', 'bazaar_qodef_woo_single_product_image_behavior_class' );
}

if ( ! function_exists( 'bazaar_qodef_woo_single_product_photo_swipe_support' ) ) {
	function bazaar_qodef_woo_single_product_photo_swipe_support() {
		$image_behavior = bazaar_qodef_get_meta_field_intersect( 'woo_set_single_images_behavior' );

		if ( $image_behavior === 'photo-swipe' ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}

	add_action( 'init', 'bazaar_qodef_woo_single_product_photo_swipe_support' );
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_products_per_page' ) ) {
	/**
	 * Function that sets number of products per page. Default is 9
	 * @return int number of products to be shown per page
	 */
	function bazaar_qodef_woocommerce_products_per_page() {
		$products_per_page_meta = bazaar_qodef_options()->getOptionValue( 'qodef_woo_products_per_page' );
		$products_per_page      = ! empty( $products_per_page_meta ) ? intval( $products_per_page_meta ) : 12;

		if ( isset( $_GET['woo-products-count'] ) && $_GET['woo-products-count'] === 'view-all' ) {
			$products_per_page = 9999;
		}

		return $products_per_page;
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_related_products_args' ) ) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 *
	 * @param $args array array of args for the query
	 *
	 * @return mixed array of changed args
	 */
	function bazaar_qodef_woocommerce_related_products_args( $args ) {
		$related = bazaar_qodef_options()->getOptionValue( 'qodef_woo_product_list_columns' );

		if ( ! empty( $related ) ) {
			switch ( $related ) {
				case 'qodef-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'qodef-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}
		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_product_thumbnail_column_size' ) ) {
	/**
	 * Function that sets number of thumbnails on single product page per row. Default is 4
	 * @return int number of thumbnails to be shown on single product page per row
	 */
	function bazaar_qodef_woocommerce_product_thumbnail_column_size() {
		return apply_filters( 'bazaar_qodef_number_of_thumbnails_per_row_single_product', 4 );
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_template_loop_product_title' ) ) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function bazaar_qodef_woocommerce_template_loop_product_title() {
		$tag = bazaar_qodef_options()->getOptionValue( 'qodef_products_list_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h5';
		}

		the_title( '<' . $tag . ' class="qodef-product-list-title"><a href="' . get_the_permalink() . '">', '</a></' . $tag . '>' );
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_template_single_title' ) ) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function bazaar_qodef_woocommerce_template_single_title() {
		$tag = bazaar_qodef_options()->getOptionValue( 'qodef_single_product_title_tag' );
		if ( $tag === '' ) {
			$tag = 'h1';
		}

		the_title( '<' . $tag . '  itemprop="name" class="qodef-single-product-title">', '</' . $tag . '>' );
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_sale_flash' ) ) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function bazaar_qodef_woocommerce_sale_flash() {
		return '<span class="qodef-onsale">' . esc_html__( 'SALE', 'bazaar' ) . '</span>';
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_product_out_of_stock' ) ) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function bazaar_qodef_woocommerce_product_out_of_stock() {
		global $product;

		if ( ! $product->is_in_stock() ) {
			print '<span class="qodef-out-of-stock">' . esc_html__( 'OUT OF STOCK', 'bazaar' ) . '</span>';
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_new_product_mark' ) ) {
	/**
	 * Function for adding New Product Template
	 *
	 * @return string
	 */
	function bazaar_qodef_woocommerce_new_product_mark() {
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id = $product->get_id();
		} else {
			$product_id = $product->id;
		}

		if ( get_post_meta( $product_id, 'qodef_single_product_new_meta', true ) === 'yes' ) {
			print '<span class="qodef-new-product">' . esc_html__( 'NEW', 'bazaar' ) . '</span>';
		}

	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_shop_loop_categories' ) ) {
	/**
	 * Function that prints html with product categories
	 */
	function bazaar_qodef_woocommerce_shop_loop_categories() {

		global $product;

		$html = '<div class="qodef-pl-categories">';
		$html .= wc_get_product_category_list( $product->get_id(), ', ' );
		$html .= '</div>';

		print bazaar_qodef_get_module_part( $html );
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_template_loop_add_to_cart' ) ) {
	/**
	 * Function for adding woo button to list
	 *
	 * @return string
	 */
	function bazaar_qodef_woocommerce_template_loop_add_to_cart() {
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id   = $product->get_id();
			$product_type = $product->get_type();
		} else {
			$product_id   = $product->id;
			$product_type = $product->product_type;
		}

		if ( ! $product->is_in_stock() ) {
			$button_classes = 'ajax_add_to_cart qodef-button';
		} else if ( $product_type === 'variable' ) {
			$button_classes = 'product_type_variable add_to_cart_button qodef-button';
		} else if ( $product_type === 'external' ) {
			$button_classes = 'product_type_external qodef-button';
		} else {
			$button_classes = 'add_to_cart_button ajax_add_to_cart qodef-button';
		}

		echo '<div class="qodef-pl-add-to-cart">';
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product_id ),
				esc_attr( $product->get_sku() ),
				esc_attr( $button_classes ),
				esc_html( $product->add_to_cart_text() )
			),
			$product );
		echo '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_single_product_show_product_thumbnails' ) ) {
	function bazaar_qodef_single_product_show_product_thumbnails() {
		global $product;

		$attachment_ids = $product->get_gallery_image_ids();

		if ( $attachment_ids && has_post_thumbnail() ) {
			foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$attributes      = array(
					'title'                   => get_post_field( 'post_title', $attachment_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				$html = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
				$html .= '</a></div>';

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_view_all_pagination' ) ) {
	/**
	 * Function for adding New WooCommerce Pagination Template
	 *
	 * @return string
	 */
	function bazaar_qodef_woocommerce_view_all_pagination() {
		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$html    = '';
		$shop_id = bazaar_qodef_get_woo_shop_page_id();

		if ( ! empty( $shop_id ) && $shop_id !== - 1 ) {
			$html .= '<div class="qodef-woo-view-all-pagination">';
			$html .= '<a href="' . get_permalink( $shop_id ) . '?woo-products-count=view-all">' . esc_html__( 'View All', 'bazaar' ) . '</a>';
			$html .= '</div>';
		}

		echo wp_kses_post( $html );
	}
}

if ( ! function_exists( 'bazaar_qodef_woo_view_all_pagination_additional_tag_before' ) ) {
	function bazaar_qodef_woo_view_all_pagination_additional_tag_before() {

		print '<div class="qodef-woo-pagination-holder"><div class="qodef-woo-pagination-inner">';
	}
}

if ( ! function_exists( 'bazaar_qodef_woo_view_all_pagination_additional_tag_after' ) ) {
	function bazaar_qodef_woo_view_all_pagination_additional_tag_after() {

		print '</div></div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_single_product_content_additional_tag_before' ) ) {
	function bazaar_qodef_single_product_content_additional_tag_before() {

		print '<div class="qodef-single-product-content">';
	}
}

if ( ! function_exists( 'bazaar_qodef_single_product_content_additional_tag_after' ) ) {
	function bazaar_qodef_single_product_content_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_single_product_summary_additional_tag_before' ) ) {
	function bazaar_qodef_single_product_summary_additional_tag_before() {

		print '<div class="qodef-single-product-summary">';
	}
}

if ( ! function_exists( 'bazaar_qodef_single_product_summary_additional_tag_after' ) ) {
	function bazaar_qodef_single_product_summary_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_holder_additional_tag_before' ) ) {
	function bazaar_qodef_pl_holder_additional_tag_before() {

		print '<div class="qodef-pl-main-holder">';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_holder_additional_tag_after' ) ) {
	function bazaar_qodef_pl_holder_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_inner_additional_tag_before' ) ) {
	function bazaar_qodef_pl_inner_additional_tag_before() {

		print '<div class="qodef-pl-inner">';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_inner_additional_tag_after' ) ) {
	function bazaar_qodef_pl_inner_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_image_additional_tag_before' ) ) {
	function bazaar_qodef_pl_image_additional_tag_before() {

		print '<div class="qodef-pl-image">';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_image_additional_tag_after' ) ) {
	function bazaar_qodef_pl_image_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_inner_text_additional_tag_before' ) ) {
	function bazaar_qodef_pl_inner_text_additional_tag_before() {

		print '<div class="qodef-pl-text"><div class="qodef-pl-text-outer"><div class="qodef-pl-text-inner">';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_inner_text_additional_tag_after' ) ) {
	function bazaar_qodef_pl_inner_text_additional_tag_after() {

		print '</div></div></div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_text_wrapper_additional_tag_before' ) ) {
	function bazaar_qodef_pl_text_wrapper_additional_tag_before() {

		print '<div class="qodef-pl-text-wrapper">';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_text_wrapper_additional_tag_after' ) ) {
	function bazaar_qodef_pl_text_wrapper_additional_tag_after() {

		print '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_rating_additional_tag_before' ) ) {
	function bazaar_qodef_pl_rating_additional_tag_before() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );

			if ( $rating_html !== '' ) {
				print '<div class="qodef-pl-rating-holder">';
			}
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_empty_cart_title' ) ) {
	function bazaar_qodef_woocommerce_empty_cart_title() {
		$section_title_params = array(
			'position'               => 'center',
			'title'                  => esc_html__( 'your cart is empty', 'bazaar' ),
			'title_tag'              => 'h2',
			'subtitle'               => esc_html__( 'don\'t wait', 'bazaar' ),
			'subtitle_bottom_margin' => '17px',
			'separator_width'        => '108px',
			'separator_color'        => '#b2b2b2'
		);
		print '<div class="qodef-empty-cart-title">' . bazaar_qodef_execute_shortcode( 'qodef_section_title', $section_title_params ) . '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_cart_title' ) ) {
	function bazaar_qodef_woocommerce_cart_title() {
		print '<h3>' . esc_html__( 'Shopping Cart', 'bazaar' ) . '</h3>';
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_cart_back_to_home' ) ) {
	function bazaar_qodef_woocommerce_cart_back_to_home() {
		print '<a class="qodef-cart-go-back" itemprop="url" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'go shopping', 'bazaar' ) . '</a>';
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_empty_cart_text' ) ) {
	function bazaar_qodef_woocommerce_empty_cart_text() {
		print '<p class="qodef-empty-cart">' . esc_html__( 'Alienum phaedrum torquatos nec eu, vis detraxit ertssa periculiser ex, nihil expetendis in meinerst gers frust bura erbu ders', 'bazaar' ) . '</p>';
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_div_before_account_navigation' ) ) {
	function bazaar_qodef_woocommerce_div_before_account_navigation() {
		print '<div class="qodef-woocommerce-account-navigation">';
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_div_after_account_navigation' ) ) {
	function bazaar_qodef_woocommerce_div_after_account_navigation() {
		print '</div>';
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_account_profile_image' ) ) {
	function bazaar_qodef_woocommerce_account_profile_image() {
		$current_user    = wp_get_current_user();
		$name            = $current_user->display_name;
		$current_user_id = $current_user->ID;

		$html = '';

		$profile_image = get_user_meta( $current_user_id, 'social_profile_image', true );
		if ( $profile_image == '' ) {
			$profile_image = get_avatar( $current_user_id );
		} else {
			$profile_image = '<img src="' . esc_url( $profile_image ) . '" />';
		}
		$html .= '<div class="qodef-user-info">';
		$html .= bazaar_qodef_kses_img( $profile_image, 96 );
		$html .= '<h3>' . esc_html__( 'Hello.', 'bazaar' ) . '</h3>';
		$html .= '<span class="qodef-username">@' . esc_html( $name ) . '</span>';
		$html .= '</div>';


		print bazaar_qodef_get_module_part( $html );
	}
}

if ( ! function_exists( 'bazaar_qodef_pl_rating_additional_tag_after' ) ) {
	function bazaar_qodef_pl_rating_additional_tag_after() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );

			if ( $rating_html !== '' ) {
				print '</div>';
			}
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_share' ) ) {
	/**
	 * Function that social share for product page
	 * Return array array of WooCommerce pages
	 */
	function bazaar_qodef_woocommerce_share() {
		if ( bazaar_qodef_core_plugin_installed() && bazaar_qodef_options()->getOptionValue( 'enable_social_share' ) == 'yes' && bazaar_qodef_options()->getOptionValue( 'enable_social_share_on_product' ) == 'yes' ) :
			print '<div class="qodef-woo-social-share-holder">';
			print '<span>' . esc_html__( 'Share:', 'bazaar' ) . '</span>';
			echo bazaar_qodef_get_social_share_html();
			print '</div>';
		endif;
	}
}

if ( ! function_exists( 'bazaar_qodef_woocommerce_single_product_title' ) ) {
	/**
	 * Function that checks option for single product title and overrides it with filter
	 */
	function bazaar_qodef_woocommerce_single_product_title( $show_title_area ) {
		if ( is_singular( 'product' ) ) {
			$woo_title_meta = get_post_meta( get_the_ID(), 'qodef_show_title_area_woo_meta', true );

			if ( empty( $woo_title_meta ) ) {
				$woo_title_main = bazaar_qodef_options()->getOptionValue( 'show_title_area_woo' );

				if ( ! empty( $woo_title_main ) ) {
					$show_title_area = $woo_title_main == 'yes' ? true : false;
				}
			} else {
				$show_title_area = $woo_title_meta == 'yes' ? true : false;
			}
		}

		return $show_title_area;
	}

	add_filter( 'bazaar_qodef_show_title_area', 'bazaar_qodef_woocommerce_single_product_title' );
}

if ( ! function_exists( 'bazaar_qodef_set_title_text_output_for_woocommerce' ) ) {
	function bazaar_qodef_set_title_text_output_for_woocommerce( $title ) {

		if ( is_product_category() || is_product_tag() ) {
			global $wp_query;

			$tax            = $wp_query->get_queried_object();
			$category_title = $tax->name;
			$title          = $category_title;
		} elseif ( bazaar_qodef_is_woocommerce_shop() || is_singular( 'product' ) ) {
			$shop_id = bazaar_qodef_get_woo_shop_page_id();
			$title   = $shop_id !== - 1 ? get_the_title( $shop_id ) : esc_html__( 'Shop', 'bazaar' );
		}

		return $title;
	}

	add_filter( 'bazaar_qodef_title_text', 'bazaar_qodef_set_title_text_output_for_woocommerce' );
}

if ( ! function_exists( 'bazaar_qodef_set_breadcrumbs_output_for_woocommerce' ) ) {
	function bazaar_qodef_set_breadcrumbs_output_for_woocommerce( $childContent, $delimiter, $before, $after ) {
		$shop_id = bazaar_qodef_get_woo_shop_page_id();

		if ( bazaar_qodef_is_product_category() ) {
			$childContent = '';

			if ( ! empty( $shop_id ) && $shop_id !== - 1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}

			$thisCat = get_category( get_query_var( 'cat' ), false );
			if ( isset( $thisCat->parent ) && $thisCat->parent != 0 ) {
				$childContent .= get_category_parents( $thisCat->parent, true, ' ' . $delimiter );
			}

			$childContent .= $before . single_cat_title( '', false ) . $after;

		} elseif ( is_singular( 'product' ) ) {
			$childContent = '';
			$product      = wc_get_product( get_the_ID() );
			$categories   = ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), ', ' ) : '';

			if ( ! empty( $shop_id ) && $shop_id !== - 1 ) {
				$childContent .= '<a itemprop="url" href="' . get_permalink( $shop_id ) . '">' . get_the_title( $shop_id ) . '</a>' . $delimiter;
			}

			if ( ! empty( $categories ) ) {
				$childContent .= $categories . $delimiter;
			}

			$childContent .= $before . get_the_title() . $after;

		} elseif ( bazaar_qodef_is_woocommerce_shop() ) {
			$childContent = $before . get_the_title( $shop_id ) . $after;
		}

		return $childContent;
	}

	add_filter( 'bazaar_qodef_breadcrumbs_title_child_output', 'bazaar_qodef_set_breadcrumbs_output_for_woocommerce', 10, 4 );
}

if ( ! function_exists( 'bazaar_qodef_set_sidebar_layout_for_woocommerce' ) ) {
	function bazaar_qodef_set_sidebar_layout_for_woocommerce( $sidebar_layout ) {

		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_layout = bazaar_qodef_get_meta_field_intersect( 'sidebar_layout', bazaar_qodef_get_woo_shop_page_id() );
		}

		return $sidebar_layout;
	}

	add_filter( 'bazaar_qodef_sidebar_layout', 'bazaar_qodef_set_sidebar_layout_for_woocommerce' );
}

if ( ! function_exists( 'bazaar_qodef_set_sidebar_name_for_woocommerce' ) ) {
	function bazaar_qodef_set_sidebar_name_for_woocommerce( $sidebar_name ) {

		if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
			$sidebar_name = bazaar_qodef_get_meta_field_intersect( 'custom_sidebar_area', bazaar_qodef_get_woo_shop_page_id() );
		}

		return $sidebar_name;
	}

	add_filter( 'bazaar_qodef_sidebar_name', 'bazaar_qodef_set_sidebar_name_for_woocommerce' );
}

if ( ! function_exists( 'bazaar_qodef_login_form_additional_tag_before' ) ) {
	function bazaar_qodef_login_form_additional_tag_before() {
		print '<div class="qodef-woocommerce-account-login-form">';
	}
}

if ( ! function_exists( 'bazaar_qodef_login_form_additional_tag_after' ) ) {
	function bazaar_qodef_login_form_additional_tag_after() {
		print '</div>';
	}
}