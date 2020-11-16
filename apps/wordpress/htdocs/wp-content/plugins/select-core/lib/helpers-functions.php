<?php

if ( ! function_exists( 'qodef_core_get_cpt_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param array $additional_params array of additional parameters to pass to template
	 *
	 * @return html
	 */
	function qodef_core_get_cpt_shortcode_module_template_part( $shortcode, $template, $slug = '', $params = array(), $additional_params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_CPT_PATH . '/' . $shortcode . '/shortcodes/templates';

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( is_array( $additional_params ) && count( $additional_params ) ) {
			extract( $additional_params );
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'qodef_core_get_cpt_single_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $cpt_name name of the cpt folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qodef_core_get_cpt_single_module_template_part( $template, $cpt_name, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_CPT_PATH . '/' . $cpt_name;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( ! empty( $template ) ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		print $html;
	}
}

if ( ! function_exists( 'qodef_core_return_cpt_single_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $cpt_name name of the cpt folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qodef_core_return_cpt_single_module_template_part( $template, $cpt_name, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_CPT_PATH . '/' . $cpt_name;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( ! empty( $template ) ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'qodef_core_get_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qodef_core_get_shortcode_module_template_part( $template, $shortcode, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_CORE_SHORTCODES_PATH . '/' . $shortcode;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'qodef_core_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function qodef_core_ajax_status( $status, $message, $data = null ) {
		$response = array(
			'status'  => $status,
			'message' => $message,
			'data'    => $data
		);

		$output = json_encode( $response );

		exit( $output );
	}
}

if ( ! function_exists( 'bazaar_qodef_add_user_custom_fields' ) ) {
	/**
	 * Function creates custom social fields for users
	 *
	 * return $user_contact
	 */
	function bazaar_qodef_add_user_custom_fields( $user_contact ) {
		/**
		 * Function that add custom user fields
		 **/
		$user_contact['facebook']   = esc_html__( 'Facebook', 'select-core' );
		$user_contact['twitter']    = esc_html__( 'Twitter', 'select-core' );
		$user_contact['linkedin']   = esc_html__( 'Linkedin', 'select-core' );
		$user_contact['instagram']  = esc_html__( 'Instagram', 'select-core' );
		$user_contact['pinterest']  = esc_html__( 'Pinterest', 'select-core' );
		$user_contact['tumblr']     = esc_html__( 'Tumbrl', 'select-core' );
		$user_contact['googleplus'] = esc_html__( 'Google Plus', 'select-core' );

		return $user_contact;
	}

	add_filter( 'user_contactmethods', 'bazaar_qodef_add_user_custom_fields' );
}

if ( ! function_exists( 'qodef_core_set_open_graph_meta' ) ) {
	/*
	 * Function that echoes open graph meta tags if enabled
	 */
	function qodef_core_set_open_graph_meta() {

		if ( bazaar_qodef_option_get_value( 'enable_open_graph' ) === 'yes' ) {

			// get the id
			$id = get_queried_object_id();

			// default type is article, override it with product if page is woo single product
			$type        = 'article';
			$description = '';

			// check if page is generic wp page w/o page id
			if ( bazaar_qodef_is_default_wp_template() ) {
				$id = 0;
			}

			// check if page is woocommerce shop page
			if ( bazaar_qodef_is_woocommerce_installed() && ( function_exists( 'is_shop' ) && is_shop() ) ) {
				$shop_page_id = get_option( 'woocommerce_shop_page_id' );

				if ( ! empty( $shop_page_id ) ) {
					$id = $shop_page_id;
					// set flag
					$description = 'woocommerce-shop';
				}
			}

			if ( function_exists( 'is_product' ) && is_product() ) {
				$type = 'product';
			}

			// if id exist use wp template tags
			if ( ! empty( $id ) ) {
				$url   = get_permalink( $id );
				$title = get_the_title( $id );

				// apply bloginfo description to woocommerce shop page instead of first product item description
				if ( $description === 'woocommerce-shop' ) {
					$description = get_bloginfo( 'description' );
				} else {
					$description = strip_tags( apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $id ) ) );
				}

				// has featured image
				if ( get_post_thumbnail_id( $id ) !== '' ) {
					$image = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
				} else {
					$image = bazaar_qodef_option_get_value( 'open_graph_image' );
				}
			} else {
				global $wp;
				$url         = esc_url( home_url( add_query_arg( array(), $wp->request ) ) );
				$title       = get_bloginfo( 'name' );
				$description = get_bloginfo( 'description' );
				$image       = bazaar_qodef_option_get_value( 'open_graph_image' );
			}
			?>

            <meta property="og:url" content="<?php echo esc_url( $url ); ?>"/>
            <meta property="og:type" content="<?php echo esc_html( $type ); ?>"/>
            <meta property="og:title" content="<?php echo esc_html( $title ); ?>"/>
            <meta property="og:description" content="<?php echo esc_html( $description ); ?>"/>
            <meta property="og:image" content="<?php echo esc_url( $image ); ?>"/>

		<?php }
	}

	add_action( 'bazaar_qodef_header_meta', 'qodef_core_set_open_graph_meta' );
}


/* Function for adding custom meta boxes hooked to default action */
if ( class_exists( 'WP_Block_Type' ) && defined( 'QODE_ROOT' ) ) {
	add_action( 'admin_head', 'bazaar_qodef_meta_box_add' );
} else {
	add_action( 'add_meta_boxes', 'bazaar_qodef_meta_box_add' );
}

if ( ! function_exists( 'qodef_core_create_meta_box_handler' ) ) {
	function qodef_core_create_meta_box_handler( $box, $key, $screen ) {
		add_meta_box(
			'qodef-meta-box-' . $key,
			$box->title,
			'bazaar_qodef_render_meta_box',
			$screen,
			'advanced',
			'high',
			array( 'box' => $box )
		);
	}
}