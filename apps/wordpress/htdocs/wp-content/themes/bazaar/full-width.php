<?php
/*
Template Name: Full Width
*/
?>
<?php
$qodef_sidebar_layout = bazaar_qodef_sidebar_layout();

get_header();
bazaar_qodef_get_title();
get_template_part( 'slider' );
?>

<div class="qodef-full-width">
    <?php do_action( 'bazaar_qodef_after_container_open' ); ?>
	<div class="qodef-full-width-inner">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="qodef-grid-row">
				<div <?php echo bazaar_qodef_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action( 'bazaar_qodef_page_after_content' );
					?>
				</div>
				<?php if ( $qodef_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo bazaar_qodef_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>

    <?php do_action( 'bazaar_qodef_before_container_close' ); ?>
</div>

<?php get_footer(); ?>