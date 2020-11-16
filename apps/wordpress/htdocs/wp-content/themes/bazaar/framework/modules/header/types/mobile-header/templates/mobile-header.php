<?php do_action('bazaar_qodef_before_mobile_header'); ?>

<header class="qodef-mobile-header">
	<?php do_action('bazaar_qodef_after_mobile_header_html_open'); ?>
	
	<div class="qodef-mobile-header-inner">
		<div class="qodef-mobile-header-holder">
			<div class="qodef-grid">
				<div class="qodef-vertical-align-containers">
					<div class="qodef-vertical-align-containers">
						<?php if($show_navigation_opener) : ?>
							<div class="qodef-mobile-menu-opener">
								<a href="javascript:void(0)">
									<span class="qodef-mobile-menu-icon">
										<?php echo bazaar_qodef_icon_collections()->renderIcon('icon_menu', 'font_elegant'); ?>
									</span>
									<?php if(!empty($mobile_menu_title)) { ?>
										<h5 class="qodef-mobile-menu-text"><?php echo esc_attr($mobile_menu_title); ?></h5>
									<?php } ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="qodef-position-center">
							<div class="qodef-position-center-inner">
								<?php bazaar_qodef_get_mobile_logo(); ?>
							</div>
						</div>
						<div class="qodef-position-right">
							<div class="qodef-position-right-inner">
								<?php if(is_active_sidebar('qodef-right-from-mobile-logo')) {
									dynamic_sidebar('qodef-right-from-mobile-logo');
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php bazaar_qodef_get_mobile_nav(); ?>
	</div>
	
	<?php do_action('bazaar_qodef_before_mobile_header_html_close'); ?>
</header>

<?php do_action('bazaar_qodef_after_mobile_header'); ?>