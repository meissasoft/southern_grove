<?php do_action('bazaar_qodef_before_top_navigation'); ?>
<div class="qodef-vertical-menu-outer">
	<nav class="qodef-vertical-menu qodef-vertical-dropdown-on-click">
		<?php
			wp_nav_menu(array(
				'theme_location'  => 'vertical-navigation',
				'container'       => '',
				'container_class' => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'fallback_cb'     => 'top_navigation_fallback',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'walker'          => new BazaarQodefTopNavigationWalker()
			));
		?>
	</nav>
</div>
<?php do_action('bazaar_qodef_after_top_navigation'); ?>