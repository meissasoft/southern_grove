<?php do_action( 'bazaar_qodef_before_page_header' ); ?>

    <header class="qodef-page-header">
		<?php do_action( 'bazaar_qodef_after_page_header_html_open' ); ?>
        <div class="qodef-fixed-wrapper">
            <div class="qodef-menu-area">
				<?php do_action( 'bazaar_qodef_after_header_menu_area_html_open' ) ?>

				<?php if ( $menu_area_in_grid ) : ?>
                <div class="qodef-grid">
					<?php endif; ?>

                    <div class="qodef-vertical-align-containers">
                        <div class="qodef-position-left">
                            <div class="qodef-position-left-inner">
								<?php if ( is_active_sidebar( 'bottom_menu_left_area' ) ) : ?>
									<?php dynamic_sidebar( 'bottom_menu_left_area' ); ?>
								<?php endif; ?>
                            </div>
                        </div>
                        <div class="qodef-position-center">
                            <div class="qodef-position-center-inner">
								<?php if ( ! $hide_logo ) {
									bazaar_qodef_get_logo();
								} ?>
                            </div>
                        </div>
                        <div class="qodef-position-right">
                            <div class="qodef-position-right-inner">
								<?php if ( is_active_sidebar( 'bottom_menu_right_area' ) ) : ?>
									<?php dynamic_sidebar( 'bottom_menu_right_area' ); ?>
								<?php endif; ?>
                                <a href="javascript:void(0)" class="qodef-header-bottom-menu-opener">
                                <span class="qodef-header-bottom-image">
                                    <img class="qodef-header-bottom-image-dark" src="<?php echo esc_url( $bottom_opener_image ); ?> " alt="<?php esc_attr_e( 'Header bottom opener dark', 'bazaar' ); ?>"/>
                                    <img class="qodef-header-bottom-image-light" src="<?php echo esc_url( $bottom_opener_image_light ); ?> " alt="<?php esc_attr_e( 'Header bottom opener light', 'bazaar' ); ?>"/>
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>

					<?php if ( $menu_area_in_grid ) : ?>
                </div>
			<?php endif; ?>
            </div>
        </div>
		<?php do_action( 'bazaar_qodef_before_page_header_html_close' ); ?>
    </header>

<?php do_action( 'bazaar_qodef_after_page_header' ); ?>