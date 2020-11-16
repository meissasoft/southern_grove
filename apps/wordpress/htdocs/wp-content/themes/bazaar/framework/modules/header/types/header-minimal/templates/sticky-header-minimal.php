<?php
$fullscreen_image       = QODE_ASSETS_ROOT . "/img/sidearea-opener.png";
$fullscreen_image_light = QODE_ASSETS_ROOT . "/img/sidearea-opener-light.png";
?>

<?php do_action( 'bazaar_qodef_after_sticky_header' ); ?>

<div class="qodef-sticky-header">
	<?php do_action( 'bazaar_qodef_after_sticky_menu_html_open' ); ?>
    <div class="qodef-sticky-holder">
		<?php if ( $sticky_header_in_grid ) : ?>
        <div class="qodef-grid">
			<?php endif; ?>
            <div class=" qodef-vertical-align-containers">
                <div class="qodef-position-left">
                    <div class="qodef-position-left-inner">
						<?php if ( ! $hide_logo ) {
							bazaar_qodef_get_logo( 'sticky' );
						} ?>
                    </div>
                </div>
                <div class="qodef-position-right">
                    <div class="qodef-position-right-inner">
                        <a href="javascript:void(0)" class="qodef-fullscreen-menu-opener">
                            <span class="qodef-fullscreen-image">
                                    <img class="qodef-fullscreen-image-dark" src="<?php echo esc_html( $fullscreen_image ); ?> " alt="<?php esc_attr__( 'fullscreen-image', 'bazaar' ); ?>"/>
                                    <img class="qodef-fullscreen-image-light" src="<?php echo esc_html( $fullscreen_image_light ); ?> " alt="<?php esc_attr__( 'fullscreen-image', 'bazaar' ); ?>"/>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
			<?php if ( $sticky_header_in_grid ) : ?>
        </div>
	<?php endif; ?>
    </div>
</div>

<?php do_action( 'bazaar_qodef_after_sticky_header' ); ?>
