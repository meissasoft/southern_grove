<?php do_action('bazaar_qodef_before_page_header'); ?>

<header class="qodef-page-header">
	<?php do_action('bazaar_qodef_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="qodef-fixed-wrapper">
	<?php endif; ?>
			
	<div class="qodef-menu-area <?php echo esc_attr($menu_area_position_class); ?>">
		<?php do_action('bazaar_qodef_after_header_menu_area_html_open') ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="qodef-grid">
		<?php endif; ?>
				
			<div class="qodef-vertical-align-containers">
				<div class="qodef-position-left">
					<div class="qodef-position-left-inner">
						<?php if(!$hide_logo) {
							bazaar_qodef_get_logo();
						} ?>
						<?php if($menu_area_position === 'left') : ?>
							<?php bazaar_qodef_get_main_menu(); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php if($menu_area_position === 'center') : ?>
					<div class="qodef-position-center">
						<div class="qodef-position-center-inner">
							<?php bazaar_qodef_get_main_menu(); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="qodef-position-right">
					<div class="qodef-position-right-inner">
						<?php if($menu_area_position === 'right') : ?>
							<?php bazaar_qodef_get_main_menu(); ?>
						<?php endif; ?>
						<?php bazaar_qodef_get_header_widget_menu_area(); ?>
					</div>
				</div>
			</div>
			
		<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
	</div>
			
	<?php if($show_fixed_wrapper) { ?>
		</div>
	<?php } ?>
	
	<?php if($show_sticky) {
		bazaar_qodef_get_sticky_header();
	} ?>
	
	<?php do_action('bazaar_qodef_before_page_header_html_close'); ?>
</header>

<?php do_action('bazaar_qodef_after_page_header'); ?>