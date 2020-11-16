<?php
$qodef_search_holder_params = bazaar_qodef_get_holder_params_search();
?>
<?php get_header(); ?>
<?php bazaar_qodef_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="<?php echo esc_attr( $qodef_search_holder_params['holder'] ); ?>">
		<?php do_action( 'bazaar_qodef_after_container_open' ); ?>
		<div class="<?php echo esc_attr( $qodef_search_holder_params['inner'] ); ?>">
			<?php bazaar_qodef_get_search_page(); ?>
		</div>
		<?php do_action( 'bazaar_qodef_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>