<?php
$gallery_classes = '';
$number_of_columns = bazaar_qodef_get_meta_field_intersect('portfolio_single_gallery_columns_number');
if(!empty($number_of_columns)) {
	$gallery_classes .= ' qodef-ps-'.$number_of_columns.'-columns';
}
$space_between_items = bazaar_qodef_get_meta_field_intersect('portfolio_single_gallery_space_between_items');
if(!empty($space_between_items)) {
	$gallery_classes .= ' qodef-ps-'.$space_between_items.'-space';
}
?>
<div class="qodef-ps-content-holder">

	<?php qodef_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>

	<div class="qodef-ps-info-holder">
		<?php
		//get portfolio custom fields section
		qodef_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);

		//get portfolio date section
		qodef_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);

        //get portfolio categories section
        qodef_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);

		//get portfolio tags section
		qodef_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);

		?>
	</div>

</div>
<div class="qodef-ps-image-holder qodef-ps-gallery-images <?php echo esc_attr($gallery_classes); ?>">
	<div class="qodef-ps-image-inner">
		<?php
		$media = qodef_core_get_portfolio_single_media();
		
		if(is_array($media) && count($media)) : ?>
			<?php foreach($media as $single_media) : ?>
				<div class="qodef-ps-image">
					<?php qodef_core_get_portfolio_single_media_html($single_media); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
<div class="qodef-ps-social-info-holder">
	<?php
	//get portfolio share section
	qodef_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
	?>
</div>