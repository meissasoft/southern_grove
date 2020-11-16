<?php
$image_size        = isset( $image_size ) ? $image_size : 'full';
$image_gallery_val = get_post_meta( get_the_ID(), 'qodef_post_gallery_images_meta', true );
?>

<?php if ( ! empty( $image_gallery_val ) ) { ?>
	<div class="qodef-post-image">
		<div class="qodef-blog-gallery qodef-owl-slider">
			<?php
			$image_gallery_array = explode( ',', $image_gallery_val );
			
			if ( isset( $image_gallery_array ) && count( $image_gallery_array ) > 0 ):
				foreach ( $image_gallery_array as $gimg_id ): ?>
					<div>
						<?php if ( bazaar_qodef_blog_item_has_link() ) { ?>
							<a itemprop="url" href="<?php the_permalink(); ?>">
						<?php } ?>
							<?php echo wp_get_attachment_image( $gimg_id, $image_size ); ?>
						<?php if ( bazaar_qodef_blog_item_has_link() ) { ?>
							</a>
						<?php } ?>
					</div>
				<?php endforeach;
			endif;
			?>
		</div>
	</div>
<?php } ?>