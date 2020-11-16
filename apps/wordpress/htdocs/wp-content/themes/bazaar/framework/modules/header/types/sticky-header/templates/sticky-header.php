<?php do_action('bazaar_qodef_before_sticky_header'); ?>

<div class="qodef-sticky-header">
    <?php do_action( 'bazaar_qodef_after_sticky_menu_html_open' ); ?>
    <div class="qodef-sticky-holder">
        <?php if($sticky_header_in_grid) : ?>
        <div class="qodef-grid">
            <?php endif; ?>
            <div class=" qodef-vertical-align-containers">
                <div class="qodef-position-left">
                    <div class="qodef-position-left-inner">
                        <?php if(!$hide_logo) {
                            bazaar_qodef_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="qodef-position-right">
                    <div class="qodef-position-right-inner">
						<?php bazaar_qodef_get_sticky_menu('qodef-sticky-nav'); ?>
						<?php if(is_active_sidebar('qodef-sticky-right')) : ?>
                            <?php dynamic_sidebar('qodef-sticky-right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
	<?php do_action( 'bazaar_qodef_before_sticky_menu_html_close' ); ?>
</div>

<?php do_action('bazaar_qodef_after_sticky_header'); ?>