<div class="qodef-testimonial-content" id="qodef-testimonials-<?php echo esc_attr( $current_id ) ?>">
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="qodef-testimonial-image">
			<?php echo get_the_post_thumbnail( get_the_ID(), array( 66, 66 ) ); ?>
		</div>
	<?php } ?>
	<div class="qodef-testimonial-text-holder">
		<?php if ( ! empty( $text ) ) { ?>
			<p class="qodef-testimonial-text"><?php echo esc_html( $text ); ?></p>
		<?php } ?>
		<?php if ( ! empty( $author ) ) { ?>
			<div class="qodef-testimonial-author">
				<h5 class="qodef-testimonials-author-name"><?php echo esc_html( $author ); ?></h5>
				<?php if ( ! empty( $position ) ) { ?>
					<p class="qodef-testimonials-author-job"><?php echo esc_html( $position ); ?></p>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>