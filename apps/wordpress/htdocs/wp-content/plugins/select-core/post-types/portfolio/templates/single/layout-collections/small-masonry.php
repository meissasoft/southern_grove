<?php
$masonry_classes = '';
$number_of_columns = bazaar_qodef_get_meta_field_intersect('portfolio_single_masonry_columns_number');
if(!empty($number_of_columns)) {
	$masonry_classes .= ' qodef-ps-'.$number_of_columns.'-columns';
}
$space_between_items = bazaar_qodef_get_meta_field_intersect('portfolio_single_masonry_space_between_items');
if(!empty($space_between_items)) {
	$masonry_classes .= ' qodef-ps-'.$space_between_items.'-space';
}
?>
<div class="qodef-grid-row">
	<div class="qodef-grid-col-8">
		<div class="qodef-ps-image-holder qodef-ps-masonry-images <?php echo esc_attr($masonry_classes); ?>">
			<div class="qodef-ps-image-inner">
				<div class="qodef-ps-grid-sizer"></div>
				<div class="qodef-ps-grid-gutter"></div>
				<?php
				$media = qodef_core_get_portfolio_single_media();
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="qodef-ps-image <?php echo esc_attr($single_media['holder_classes']); ?>">
							<?php qodef_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="qodef-grid-col-4">
		<div class="qodef-ps-info-holder qodef-ps-info-sticky-holder">
            <?php
            //get portfolio title section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/title', 'portfolio', $item_layout);

            //get portfolio content section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);

            //get portfolio custom fields section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);

            //get portfolio date section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);

            //get portfolio category section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);

            //get portfolio tags section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);

            //get portfolio share section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
            ?>
		</div>
	</div>
</div>