<div class="qodef-full-width">
    <div class="qodef-full-width-inner">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="qodef-portfolio-single-holder <?php echo esc_attr($holder_classes); ?>">
				<?php if(post_password_required()) {
					echo get_the_password_form();
				} else {
					do_action('bazaar_qodef_portfolio_page_before_content');
					
					qodef_core_get_cpt_single_module_template_part('templates/single/layout-collections/'.$item_layout, 'portfolio', '', $params);
					
					do_action('bazaar_qodef_portfolio_page_after_content');
					
					qodef_core_get_cpt_single_module_template_part('templates/single/parts/navigation', 'portfolio', $item_layout);
					?>
					
					<div class="qodef-container">
						<div class="qodef-container-inner clearfix">
							<?php qodef_core_get_cpt_single_module_template_part('templates/single/parts/comments', 'portfolio'); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>