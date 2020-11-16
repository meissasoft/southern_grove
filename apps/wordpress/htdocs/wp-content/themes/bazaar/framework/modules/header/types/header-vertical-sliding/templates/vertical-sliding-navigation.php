<?php do_action('bazaar_qodef_before_top_navigation'); ?>
<nav class="qodef-fullscreen-menu">
    <?php
    wp_nav_menu(array(
        'theme_location'  => 'popup-navigation',
        'container'       => '',
        'container_class' => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'fallback_cb'     => 'top_navigation_fallback',
        'link_before'     => '<span>',
        'link_after'      => '</span>',
        'walker'          => new BazaarQodefFullscreenNavigationWalker()
    ));
    ?>
</nav>
<?php do_action('bazaar_qodef_after_top_navigation'); ?>