<?php do_action('bazaar_qodef_before_page_header'); ?>

<aside class="qodef-vertical-menu-area <?php echo esc_html($holder_class); ?>">
	<div class="qodef-vertical-menu-area-inner">
		<div class="qodef-vertical-area-background"></div>
		<?php if(!$hide_logo) {
			bazaar_qodef_get_logo();
		} ?>
		<?php bazaar_qodef_get_header_vertical_main_menu(); ?>
		<div class="qodef-vertical-area-widget-holder">
			<?php bazaar_qodef_get_header_vertical_widget_areas(); ?>
		</div>
	</div>
</aside>

<?php do_action('bazaar_qodef_after_page_header'); ?>