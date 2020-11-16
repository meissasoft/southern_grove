<?php

require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.kses.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.layout1.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.layout2.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.layout3.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.layout.tax.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.optionsapi.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.framework.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.functions.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/lib/qodef.icons/qodef.icons.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/admin/options/qodef-options-setup.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/admin/meta-boxes/qodef-meta-boxes-setup.php";
require_once QODE_FRAMEWORK_ROOT_DIR . "/modules/qodef-modules-loader.php";

if ( ! function_exists( 'bazaar_qodef_admin_scripts_init' ) ) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function bazaar_qodef_admin_scripts_init() {
		/**
		 * @see BazaarQodefSkinAbstract::registerScripts - hooked with 10
		 * @see BazaarQodefSkinAbstract::registerStyles - hooked with 10
		 */
		do_action( 'bazaar_qodef_admin_scripts_init' );
	}

	add_action( 'admin_init', 'bazaar_qodef_admin_scripts_init' );
}

if ( ! function_exists( 'bazaar_qodef_enqueue_admin_styles' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function bazaar_qodef_enqueue_admin_styles() {
		wp_enqueue_style( 'wp-color-picker' );

		/**
		 * @see BazaarQodefSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'bazaar_qodef_enqueue_admin_styles' );
	}
}

if ( ! function_exists( 'bazaar_qodef_enqueue_admin_scripts' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function bazaar_qodef_enqueue_admin_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'qodef-dependence', get_template_directory_uri() . '/framework/admin/assets/js/qodef-ui/qodef-dependence.js', array(), false, true );
		wp_enqueue_script( 'qodef-twitter-connect', get_template_directory_uri() . '/framework/admin/assets/js/qodef-twitter-connect.js', array(), false, true );

		/**
		 * @see BazaarQodefSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'bazaar_qodef_enqueue_admin_scripts' );
	}
}

if ( ! function_exists( 'bazaar_qodef_enqueue_meta_box_styles' ) ) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function bazaar_qodef_enqueue_meta_box_styles() {
		wp_enqueue_style( 'wp-color-picker' );

		/**
		 * @see BazaarQodefSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'bazaar_qodef_enqueue_meta_box_styles' );
	}
}

if ( ! function_exists( 'bazaar_qodef_enqueue_meta_box_scripts' ) ) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function bazaar_qodef_enqueue_meta_box_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'qodef-dependence' );

		/**
		 * @see BazaarQodefSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'bazaar_qodef_enqueue_meta_box_scripts' );
	}
}

if ( ! function_exists( 'bazaar_qodef_enqueue_nav_menu_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function bazaar_qodef_enqueue_nav_menu_script( $hook ) {
		if ( $hook == 'nav-menus.php' ) {
			wp_enqueue_script( 'qodef-nav-menu', get_template_directory_uri() . '/framework/admin/assets/js/qodef-nav-menu.js' );
			wp_enqueue_style( 'qodef-nav-menu', get_template_directory_uri() . '/framework/admin/assets/css/qodef-nav-menu.css' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'bazaar_qodef_enqueue_nav_menu_script' );
}

if ( ! function_exists( 'bazaar_qodef_enqueue_widgets_admin_script' ) ) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 *
	 * @param $hook string current page hook to check
	 */
	function bazaar_qodef_enqueue_widgets_admin_script( $hook ) {
		if ( $hook == 'widgets.php' ) {
			wp_enqueue_script( 'qodef-dependence' );
			wp_enqueue_script( 'qodef-widgets-dependence', get_template_directory_uri() . '/framework/admin/assets/js/qodef-ui/qodef-widget-dependence.js', array(), false, true );
		}
	}

	add_action( 'admin_enqueue_scripts', 'bazaar_qodef_enqueue_widgets_admin_script' );
}

if ( ! function_exists( 'bazaar_qodef_init_theme_options_array' ) ) {
	/**
	 * Function that merges $bazaar_qodef_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function bazaar_qodef_init_theme_options_array() {
		global $bazaar_qodef_options, $bazaar_qodef_Framework;

		$db_options = get_option( 'qodef_options_bazaar' );

		//does qode_options exists in db?
		if ( is_array( $db_options ) ) {
			//merge with default options
			$bazaar_qodef_options = array_merge( $bazaar_qodef_Framework->qodeOptions->options, get_option( 'qodef_options_bazaar' ) );
		} else {
			//options don't exists in db, take default ones
			$bazaar_qodef_options = $bazaar_qodef_Framework->qodeOptions->options;
		}
	}

	add_action( 'bazaar_qodef_after_options_map', 'bazaar_qodef_init_theme_options_array', 0 );
}

if ( ! function_exists( 'bazaar_qodef_init_theme_options' ) ) {
	/**
	 * Function that sets $bazaar_qodef_options variable if it does'nt exists
	 */
	function bazaar_qodef_init_theme_options() {
		global $bazaar_qodef_options;
		global $bazaar_qodef_Framework;
		if ( isset( $bazaar_qodef_options['reset_to_defaults'] ) ) {
			if ( $bazaar_qodef_options['reset_to_defaults'] == 'yes' ) {
				delete_option( "qodef_options_bazaar" );
			}
		}

		if ( ! get_option( "qodef_options_bazaar" ) ) {
			add_option( "qodef_options_bazaar",
				$bazaar_qodef_Framework->qodeOptions->options
			);

			$bazaar_qodef_options = $bazaar_qodef_Framework->qodeOptions->options;
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_register_theme_settings' ) ) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function bazaar_qodef_register_theme_settings() {
		register_setting( 'bazaar_qodef_theme_menu', 'qode_options' );
	}

	add_action( 'admin_init', 'bazaar_qodef_register_theme_settings' );
}

if ( ! function_exists( 'bazaar_qodef_get_admin_tab' ) ) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function bazaar_qodef_get_admin_tab() {
		return isset( $_GET['page'] ) ? bazaar_qodef_strafter( $_GET['page'], 'tab' ) : null;
	}
}

if ( ! function_exists( 'bazaar_qodef_strafter' ) ) {
	/**
	 * Function that returns string that comes after found string
	 *
	 * @param $string string where to search
	 * @param $substring string what to search for
	 *
	 * @return null|string string that comes after found string
	 */
	function bazaar_qodef_strafter( $string, $substring ) {
		$pos = strpos( $string, $substring );
		if ( $pos === false ) {
			return null;
		}

		return ( substr( $string, $pos + strlen( $substring ) ) );
	}
}

if ( ! function_exists( 'bazaar_qodef_save_options' ) ) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_qodef_save_options action.
	 */
	function bazaar_qodef_save_options() {
		global $bazaar_qodef_options;

		if ( current_user_can( 'administrator' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );

			unset( $_REQUEST['action'] );

			check_ajax_referer( 'qodef_ajax_save_nonce', 'qodef_ajax_save_nonce' );

			$bazaar_qodef_options = array_merge( $bazaar_qodef_options, $_REQUEST );

			update_option( 'qodef_options_bazaar', $bazaar_qodef_options );

			do_action( 'bazaar_qodef_after_theme_option_save' );
			echo esc_html__( 'Saved', 'bazaar' );

			die();
		}
	}

	add_action( 'wp_ajax_bazaar_qodef_save_options', 'bazaar_qodef_save_options' );
}

if ( ! function_exists( 'bazaar_qodef_meta_box_add' ) ) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function bazaar_qodef_meta_box_add() {
		global $bazaar_qodef_Framework;

		foreach ( $bazaar_qodef_Framework->qodeMetaBoxes->metaBoxes as $key => $box ) {
			$hidden = false;
			if ( ! empty( $box->hidden_property ) ) {
				foreach ( $box->hidden_values as $value ) {
					if ( bazaar_qodef_option_get_value( $box->hidden_property ) == $value ) {
						$hidden = true;
					}
				}
			}

			if ( is_string( $box->scope ) ) {
				$box->scope = array( $box->scope );
			}

			if ( is_array( $box->scope ) && count( $box->scope ) ) {
				foreach ( $box->scope as $screen ) {
					qodef_core_create_meta_box_handler( $box, $key, $screen );

					if ( $hidden ) {
						add_filter( 'postbox_classes_' . $screen . '_qodef-meta-box-' . $key, 'bazaar_qodef_meta_box_add_hidden_class' );
					}
				}
			}
		}
		if ( bazaar_qodef_is_gutenberg_installed() || bazaar_qodef_is_gutenberg_editor() ) {
			bazaar_qodef_enqueue_meta_box_styles();
			bazaar_qodef_enqueue_meta_box_scripts();
		} else {
			add_action( 'admin_enqueue_scripts', 'bazaar_qodef_enqueue_meta_box_styles' );
			add_action( 'admin_enqueue_scripts', 'bazaar_qodef_enqueue_meta_box_scripts' );
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_meta_box_save' ) ) {
	/**
	 * Function that saves meta box to postmeta table
	 *
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function bazaar_qodef_meta_box_save( $post_id, $post ) {
		global $bazaar_qodef_Framework;

		$nonces_array = array();
		$meta_boxes   = bazaar_qodef_framework()->qodeMetaBoxes->getMetaBoxesByScope( $post->post_type );

		if ( is_array( $meta_boxes ) && count( $meta_boxes ) ) {
			foreach ( $meta_boxes as $meta_box ) {
				$nonces_array[] = 'bazaar_qodef_meta_box_' . $meta_box->name . '_save';
			}
		}

		if ( is_array( $nonces_array ) && count( $nonces_array ) ) {
			foreach ( $nonces_array as $nonce ) {
				if ( ! isset( $_POST[ $nonce ] ) || ! wp_verify_nonce( $_POST[ $nonce ], $nonce ) ) {
					return;
				}
			}
		}

		$postTypes = apply_filters( 'bazaar_qodef_meta_box_post_types_save', array( 'post', 'page' ) );

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['_wpnonce'] ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! in_array( $post->post_type, $postTypes ) ) {
			return;
		}

		foreach ( $bazaar_qodef_Framework->qodeMetaBoxes->options as $key => $box ) {

			if ( isset( $_POST[ $key ] ) && trim( $_POST[ $key ] !== '' ) ) {

				$value = $_POST[ $key ];

				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}

		$portfolios = false;
		if ( isset( $_POST['optionLabel'] ) ) {
			foreach ( $_POST['optionLabel'] as $key => $value ) {
				$portfolios_val[ $key ] = array(
					'optionLabel'            => $value,
					'optionValue'            => $_POST['optionValue'][ $key ],
					'optionUrl'              => $_POST['optionUrl'][ $key ],
					'optionlabelordernumber' => $_POST['optionlabelordernumber'][ $key ]
				);
				$portfolios             = true;

			}
		}

		if ( $portfolios ) {
			update_post_meta( $post_id, 'qode_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'qode_portfolios' );
		}

		$portfolio_images = false;
		if ( isset( $_POST['portfolioimg'] ) ) {
			foreach ( $_POST['portfolioimg'] as $key => $value ) {
				$portfolio_images_val[ $key ] = array(
					'portfolioimg'            => $_POST['portfolioimg'][ $key ],
					'portfoliotitle'          => $_POST['portfoliotitle'][ $key ],
					'portfolioimgordernumber' => $_POST['portfolioimgordernumber'][ $key ],
					'portfoliovideotype'      => $_POST['portfoliovideotype'][ $key ],
					'portfoliovideoid'        => $_POST['portfoliovideoid'][ $key ],
					'portfoliovideoimage'     => $_POST['portfoliovideoimage'][ $key ],
					'portfoliovideowebm'      => $_POST['portfoliovideowebm'][ $key ],
					'portfoliovideomp4'       => $_POST['portfoliovideomp4'][ $key ],
					'portfoliovideoogv'       => $_POST['portfoliovideoogv'][ $key ],
					'portfolioimgtype'        => $_POST['portfolioimgtype'][ $key ]
				);
				$portfolio_images             = true;
			}
		}

		if ( $portfolio_images ) {
			update_post_meta( $post_id, 'qode_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id, 'qode_portfolio_images' );
		}
	}

	add_action( 'save_post', 'bazaar_qodef_meta_box_save', 1, 2 );
}

if ( ! function_exists( 'bazaar_qodef_render_meta_box' ) ) {
	/**
	 * Function that renders meta box
	 *
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function bazaar_qodef_render_meta_box( $post, $metabox ) { ?>
        <div class="qodef-meta-box qodef-page">
            <div class="qodef-meta-box-holder">
				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field( 'bazaar_qodef_meta_box_' . $metabox['args']['box']->name . '_save', 'bazaar_qodef_meta_box_' . $metabox['args']['box']->name . '_save' ); ?>
            </div>
        </div>
		<?php
	}
}

if ( ! function_exists( 'bazaar_qodef_meta_box_add_hidden_class' ) ) {
	/**
	 * Function that adds class that will initially hide meta box
	 *
	 * @param array $classes array of classes
	 *
	 * @return array modified array of classes
	 */
	function bazaar_qodef_meta_box_add_hidden_class( $classes = array() ) {
		if ( ! in_array( 'qodef-meta-box-hidden', $classes ) ) {
			$classes[] = 'qodef-meta-box-hidden';
		}

		return $classes;
	}
}

if ( ! function_exists( 'bazaar_qodef_remove_default_custom_fields' ) ) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function bazaar_qodef_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach (
				apply_filters( 'bazaar_qodef_meta_box_post_types_remove', array(
					'post',
					'page'
				) ) as $postType
			) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action( 'do_meta_boxes', 'bazaar_qodef_remove_default_custom_fields' );
}

if ( ! function_exists( 'bazaar_qodef_generate_icon_pack_options' ) ) {
	/**
	 * Generates options HTML for each icon in given icon pack
	 * Hooked to wp_ajax_update_admin_nav_icon_options action
	 */
	function bazaar_qodef_generate_icon_pack_options() {
		global $bazaar_qodef_IconCollections;

		check_ajax_referer( 'update-nav_menu', 'update_nav_menu_nonce' );

		$html               = '';
		$icon_pack          = isset( $_POST['icon_pack'] ) ? $_POST['icon_pack'] : '';
		$collections_object = $bazaar_qodef_IconCollections->getIconCollection( $icon_pack );

		if ( $collections_object ) {
			$icons = $collections_object->getIconsArray();
			if ( is_array( $icons ) && count( $icons ) ) {
				foreach ( $icons as $key => $icon ) {
					$html .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $key ) . '</option>';
				}
			}
		}

		echo wp_kses( $html, array( 'option' => array( 'value' => true ) ) );
	}

	add_action( 'wp_ajax_update_admin_nav_icon_options', 'bazaar_qodef_generate_icon_pack_options' );
}

if ( ! function_exists( 'bazaar_qodef_save_dismisable_notice' ) ) {
	/**
	 * Updates user meta with dismisable notice. Hooks to admin_init action
	 * in order to check this on every page request in admin
	 */
	function bazaar_qodef_save_dismisable_notice() {
		if ( is_admin() && ! empty( $_GET['qode_dismis_notice'] ) ) {
			$notice_id       = sanitize_key( $_GET['qode_dismis_notice'] );
			$current_user_id = get_current_user_id();

			update_user_meta( $current_user_id, 'dismis_' . $notice_id, 1 );
		}
	}

	add_action( 'admin_init', 'bazaar_qodef_save_dismisable_notice' );
}

if ( ! function_exists( 'bazaar_qodef_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function bazaar_qodef_ajax_status( $status, $message, $data = null ) {
		$response = array(
			'status'  => $status,
			'message' => $message,
			'data'    => $data
		);

		$output = json_encode( $response );

		exit( $output );
	}
}

if ( ! function_exists( 'bazaar_qodef_hook_twitter_request_ajax' ) ) {
	/**
	 * Wrapper function for obtaining twitter request token.
	 * Hooks to wp_ajax_qode_twitter_obtain_request_token ajax action
	 *
	 * @see QodeTwitterApi::obtainRequestToken()
	 */
	function bazaar_qodef_hook_twitter_request_ajax() {

		check_ajax_referer( 'qodef_twitter_connect_nonce', 'twitter_connect_nonce' );

		QodefTwitterApi::getInstance()->obtainRequestToken();
	}

	add_action( 'wp_ajax_qode_twitter_obtain_request_token', 'bazaar_qodef_hook_twitter_request_ajax' );
}

if ( ! function_exists( 'bazaar_qodef_comment' ) ) {
	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */
	function bazaar_qodef_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment   = $post->post_author == $comment->user_id;

		$comment_class = 'qodef-comment clearfix';

		if ( $is_author_comment ) {
			$comment_class .= ' qodef-post-author-comment';
		}

		if ( $is_pingback_comment ) {
			$comment_class .= ' qodef-pingback-comment';
		}
		?>

        <li>
        <div class="<?php echo esc_attr( $comment_class ); ?>">
			<?php if ( ! $is_pingback_comment ) { ?>
                <div class="qodef-comment-image"> <?php echo bazaar_qodef_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
			<?php } ?>
            <div class="qodef-comment-text clearfix">
                <div class="qodef-comment-info">
                    <h5 class="qodef-comment-name vcard">
						<?php if ( $is_pingback_comment ) {
							esc_html_e( 'Pingback:', 'bazaar' );
						} ?>
						<?php echo wp_kses_post( get_comment_author_link() ); ?>
                    </h5>
                </div>
                <div class="qodef-comment-date"><?php comment_time( get_option( 'date_format' ) ); ?></div>
				<?php if ( ! $is_pingback_comment ) { ?>
                    <div class="qodef-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
                    </div>
				<?php } ?>
				<?php
				comment_reply_link( array_merge( $args, array(
					'reply_text' => esc_html__( 'reply', 'bazaar' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ) );
				edit_comment_link( esc_html__( 'edit', 'bazaar' ) );
				?>
            </div>
        </div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

/* Taxonomy custom fields functions - START */

if ( ! function_exists( 'bazaar_qodef_init_custom_taxonomy_fields' ) ) {
	function bazaar_qodef_init_custom_taxonomy_fields() {
		do_action( 'bazaar_qodef_custom_taxonomy_fields' );
	}

	add_action( 'after_setup_theme', 'bazaar_qodef_init_custom_taxonomy_fields' );
}

if ( ! function_exists( 'bazaar_qodef_taxonomy_fields_add' ) ) {
	function bazaar_qodef_taxonomy_fields_add() {
		global $bazaar_qodef_Framework;

		foreach ( $bazaar_qodef_Framework->qodeTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_add_form_fields', 'bazaar_qodef_taxonomy_fields_display_add', 10, 2 );
		}
	}

	add_action( 'after_setup_theme', 'bazaar_qodef_taxonomy_fields_add', 11 );
}

if ( ! function_exists( 'bazaar_qodef_taxonomy_fields_edit' ) ) {
	function bazaar_qodef_taxonomy_fields_edit() {
		global $bazaar_qodef_Framework;

		foreach ( $bazaar_qodef_Framework->qodeTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_edit_form_fields', 'bazaar_qodef_taxonomy_fields_display_edit', 10, 2 );
		}
	}

	add_action( 'after_setup_theme', 'bazaar_qodef_taxonomy_fields_edit', 11 );
}

if ( ! function_exists( 'bazaar_qodef_taxonomy_fields_display_add' ) ) {
	function bazaar_qodef_taxonomy_fields_display_add( $taxonomy ) {
		global $bazaar_qodef_Framework;

		foreach ( $bazaar_qodef_Framework->qodeTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_taxonomy_fields_display_edit' ) ) {
	function bazaar_qodef_taxonomy_fields_display_edit( $term, $taxonomy ) {
		global $bazaar_qodef_Framework;

		foreach ( $bazaar_qodef_Framework->qodeTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_save_taxonomy_custom_fields' ) ) {
	function bazaar_qodef_save_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'bazaar_qodef_taxonomy_fields', array() );

		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				add_term_meta( $term_id, $value, $_POST[ $value ] );
			}
		}
	}

	add_action( 'created_term', 'bazaar_qodef_save_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'bazaar_qodef_update_taxonomy_custom_fields' ) ) {
	function bazaar_qodef_update_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'bazaar_qodef_taxonomy_fields', array() );

		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				update_term_meta( $term_id, $value, $_POST[ $value ] );
			} else {
				update_term_meta( $term_id, $value, '' );
			}
		}
	}

	add_action( 'edited_term', 'bazaar_qodef_update_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'bazaar_qodef_tax_add_script' ) ) {
	function bazaar_qodef_tax_add_script() {
		wp_enqueue_media();
		wp_enqueue_script( 'qodef-media-js', QODE_FRAMEWORK_ROOT . '/admin/assets/js/qodef-tax-media-upload.js' );
	}

	add_action( 'admin_enqueue_scripts', 'bazaar_qodef_tax_add_script' );
}

/** Taxonomy Delete Image **/
if ( ! function_exists( 'bazaar_qodef_tax_del_image' ) ) {
	function bazaar_qodef_tax_del_image() {

		check_ajax_referer( 'qodef_tax_del_image_nonce', 'tax_del_image_nonce' );
		/** If we don't have a term_id, bail out **/
		if ( ! isset( $_GET['term_id'] ) ) {
			esc_html_e( 'Not Set or Empty', 'bazaar' );
			exit;
		}

		$field_name = $_GET['field_name'];
		$term_id    = $_GET['term_id'];
		$imageID    = get_term_meta( $term_id, $field_name, true );  // Get our attachment ID

		if ( is_numeric( $imageID ) ) {                              // Verify that the attachment ID is indeed a number
			wp_delete_attachment( $imageID );                       // Delete our image
			delete_term_meta( $term_id, $field_name );// Delete our image meta
			exit;
		}

		esc_html_e( 'Contact Administrator', 'bazaar' ); // If we've reached this point, something went wrong - enable debugging
		exit;
	}

	add_action( 'wp_ajax_bazaar_qodef_tax_del_image', 'bazaar_qodef_tax_del_image' );
}

/* Taxonomy custom fields functions - END */

?>