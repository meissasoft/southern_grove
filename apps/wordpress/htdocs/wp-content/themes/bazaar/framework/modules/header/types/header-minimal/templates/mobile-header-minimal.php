<?php do_action( 'bazaar_qodef_before_mobile_header' ); ?>
<?php $fullscreen_image = QODE_ASSETS_ROOT . "/img/sidearea-opener.png"; ?>
    <header class="qodef-mobile-header">
		<?php do_action( 'bazaar_qodef_after_mobile_header_html_open' ); ?>

        <div class="qodef-mobile-header-inner">
            <div class="qodef-mobile-header-holder">
                <div class="qodef-grid">
                    <div class="qodef-vertical-align-containers">
                        <div class="qodef-position-left">
                            <div class="qodef-position-left-inner">
								<?php bazaar_qodef_get_mobile_logo(); ?>
                            </div>
                        </div>
                        <div class="qodef-position-right">
                            <div class="qodef-position-right-inner">
                                <a href="javascript:void(0)" class="qodef-fullscreen-menu-opener">
                                <span class="qodef-fullscreen-image">
                                    <img class="qodef-fullscreen-image-dark" src="<?php echo esc_html( $fullscreen_image ); ?> " alt="<?php esc_attr__( 'fullscreen-image', 'bazaar' ); ?>"/>
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php do_action( 'bazaar_qodef_before_mobile_header_html_close' ); ?>
    </header>

<?php do_action( 'bazaar_qodef_after_mobile_header' ); ?>