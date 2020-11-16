<?php
if($enable_fixed_proportions == 'yes'){
	$masonry_image_size = get_post_meta(get_the_ID(), 'qodef_product_featured_image_size_fixed_meta', true);

	if(empty($masonry_image_size)) {
		$masonry_image_size = 'qodef-default';
	}

	$params['image_size'] = $masonry_image_size;
}
else if($enable_fixed_proportions == 'no'){
	$masonry_image_size = get_post_meta(get_the_ID(), 'qodef_product_featured_image_size_original_meta', true);

	if(empty($masonry_image_size)) {
		$masonry_image_size = 'qodef-default';
	}
}

else {
	$masonry_image_size = '';
}

?>
<div class="qodef-pli <?php echo esc_html($masonry_image_size); ?>">
	<div class="qodef-pli-inner">
		<div class="qodef-pli-image">
			<?php bazaar_qodef_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
		</div>
		<div class="qodef-pli-text" <?php echo bazaar_qodef_get_inline_style($shader_styles); ?>>
			<div class="qodef-pli-text-outer">
				<div class="qodef-pli-text-inner">
					<?php bazaar_qodef_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>

					<?php bazaar_qodef_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>

					<?php bazaar_qodef_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>
					
					<?php bazaar_qodef_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>
					
					<?php bazaar_qodef_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
				</div>
			</div>
		</div>
		<a class="qodef-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</div>