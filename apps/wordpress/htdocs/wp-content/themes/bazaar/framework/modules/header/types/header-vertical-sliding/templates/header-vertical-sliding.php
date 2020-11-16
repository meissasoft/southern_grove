<?php
$fullscreen_image       = QODE_ASSETS_ROOT . "/img/sidearea-opener.png";
$fullscreen_image_light = QODE_ASSETS_ROOT . "/img/sidearea-opener-light.png";
?>

<?php do_action( 'bazaar_qodef_before_page_header' ); ?>
<aside class="qodef-vertical-menu-area <?php echo esc_html( $holder_class ); ?>">
    <div class="qodef-vertical-menu-area-inner">
        <div class="qodef-vertical-area-background"></div>
        <div class="qodef-vertical-menu-nav-holder-outer">
            <div class="qodef-vertical-menu-nav-holder">
                <div class="qodef-vertical-menu-holder-nav-inner">
					<?php bazaar_qodef_get_header_vertical_sliding_main_menu(); ?>
                </div>
                <div class="qodef-vertival-menu-holer-widget-area">
					<?php bazaar_qodef_get_header_vertical_menu_sliding_widget_areas(); ?>
                </div>
            </div>
        </div>
		<?php if ( ! $hide_logo ) {
			bazaar_qodef_get_logo();
		} ?>
        <div class="qodef-vertical-menu-holder">
            <div class="qodef-vertical-menu-table">
                <div class="qodef-vertical-menu-table-cell">

                    <div class="qodef-vertical-menu-opener">
                        <a href="#">
                            <span class="qodef-fullscreen-image">
                                <img class="qodef-fullscreen-image-dark" src="<?php echo esc_url( $fullscreen_image ); ?> " alt="<?php esc_attr_e( 'fullscreen-image', 'bazaar' ); ?>"/>
                                <img class="qodef-fullscreen-image-light" src="<?php echo esc_url( $fullscreen_image_light ); ?> " alt="<?php esc_attr_e( 'fullscreen-image', 'bazaar' ); ?>"/>
                            </span>
                        </a>
                    </div>
                    <div class="qodef-vertical-area-widget-holder">
						<?php bazaar_qodef_get_header_vertical_sliding_widget_areas(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<?php do_action( 'bazaar_qodef_after_page_header' ); ?>
