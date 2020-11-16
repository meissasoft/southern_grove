<div class="qodef-fullscreen-menu-holder-outer">
	<div class="qodef-fullscreen-menu-holder">
		<div class="qodef-fullscreen-menu-holder-inner">
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="qodef-container-inner">
			<?php endif;

			//Sidearea above menu
			if(is_active_sidebar( 'fullscreen_menu_above' ) ) : ?>
				<div class="qodef-fullscreen-above-menu-widget-holder">
					<?php dynamic_sidebar('fullscreen_menu_above'); ?>
				</div>
			<?php endif;

			//Navigation
			bazaar_qodef_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal');;

			//Sidearea under menu
			if(is_active_sidebar('fullscreen_menu_below')) : ?>
				<div class="qodef-fullscreen-below-menu-widget-holder">
					<?php dynamic_sidebar('fullscreen_menu_below'); ?>
				</div>
			<?php endif;

			if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>