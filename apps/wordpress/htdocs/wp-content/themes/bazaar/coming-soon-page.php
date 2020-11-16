<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * bazaar_qodef_header_meta hook
	 *
	 * @see bazaar_qodef_header_meta() - hooked with 10
	 * @see bazaar_qodef_user_scalable_meta() - hooked with 10
	 * @see qodef_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'bazaar_qodef_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * bazaar_qodef_after_body_tag hook
	 *
	 * @see bazaar_qodef_get_side_area() - hooked with 10
	 * @see bazaar_qodef_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'bazaar_qodef_after_body_tag' ); ?>

	<div class="qodef-wrapper">
		<div class="qodef-wrapper-inner">
			<div class="qodef-content">
				<div class="qodef-content-inner">
					<div class="qodef-full-width">
						<div class="qodef-full-width-inner">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>