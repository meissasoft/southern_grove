<?php
$i    = 0;
$rand = rand(0,1000);
?>
<div class="qodef-image-gallery <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-ig-slider qodef-owl-slider" <?php echo bazaar_qodef_get_inline_attrs($slider_data); ?>>
		<?php foreach ($images as $image) { ?>
			<div class="qodef-ig-image">
				<?php if ($image_behavior === 'lightbox') { ?>
					<a itemprop="image" class="qodef-ig-lightbox qodef-block-drag-link" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
				<?php } else if ($image_behavior === 'custom-link' && !empty($custom_links)) { ?>
					<a itemprop="url" class="qodef-ig-custom-link qodef-block-drag-link" href="<?php echo esc_url($custom_links[$i++]); ?>" target="<?php echo esc_attr($custom_link_target); ?>" title="<?php echo esc_attr($image['title']); ?>">
				<?php } ?>
					<?php if(is_array($image_size) && count($image_size)) :
						echo bazaar_qodef_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
					else:
						echo wp_get_attachment_image($image['image_id'], $image_size);
					endif; ?>
				<?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>