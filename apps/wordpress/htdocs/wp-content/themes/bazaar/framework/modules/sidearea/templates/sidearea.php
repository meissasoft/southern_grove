<section class="qodef-side-menu">
    <div class="qodef-close-side-menu-holder">
        <a class="qodef-close-side-menu" href="#" target="_self">
            <?php echo bazaar_qodef_icon_collections()->renderIcon('icon_close', 'font_elegant'); ?>
        </a>
    </div>
    <div class="qodef-side-area-holders">
        <div class="qodef-side-menu-top">
            <?php if(is_active_sidebar('sidearea')) {
                dynamic_sidebar('sidearea');
            } ?>
        </div>
        <?php if(is_active_sidebar('sidearea-bottom')) { ?>
            <div class="qodef-side-menu-bottom">
                <?php dynamic_sidebar('sidearea-bottom'); ?>
            </div>
        <?php } ?>
    </div>
</section>