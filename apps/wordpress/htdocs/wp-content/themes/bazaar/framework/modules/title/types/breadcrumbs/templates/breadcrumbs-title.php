<?php do_action('bazaar_qodef_before_page_title'); ?>

<div class="qodef-title-holder <?php echo esc_attr($holder_classes); ?>" <?php bazaar_qodef_inline_style($holder_styles); ?> <?php echo bazaar_qodef_get_inline_attrs($holder_data); ?>>
	<?php if(!empty($title_image)) { ?>
		<div class="qodef-title-image">
			<img itemprop="image" src="<?php echo esc_url($title_image['src']); ?>" alt="<?php echo esc_attr($title_image['alt']); ?>" />
		</div>
	<?php } ?>
	<div class="qodef-title-wrapper" <?php bazaar_qodef_inline_style($wrapper_styles); ?>>
		<div class="qodef-title-inner">
			<div class="qodef-grid">
				<?php bazaar_qodef_custom_breadcrumbs(); ?>
			</div>
	    </div>
	</div>
</div>

<?php do_action('bazaar_qodef_after_page_title'); ?>
