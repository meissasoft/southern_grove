<div class="qodef-grid-row">
	<div <?php echo bazaar_qodef_get_content_sidebar_class(); ?>>
		<div class="qodef-search-page-holder">
			<?php bazaar_qodef_get_search_page_layout(); ?>
		</div>
		<?php do_action( 'bazaar_qodef_page_after_content' ); ?>
	</div>
	<?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
		<div <?php echo bazaar_qodef_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
</div>