<?php
$qodef_blog_type = bazaar_qodef_get_archive_blog_list_layout();
bazaar_qodef_include_blog_helper_functions( 'lists', $qodef_blog_type );
$qodef_holder_params = bazaar_qodef_get_holder_params_blog();

get_header();
bazaar_qodef_get_title();
get_template_part( 'slider' );
?>

<div class="<?php echo esc_attr( $qodef_holder_params['holder'] ); ?>">
	<?php do_action( 'bazaar_qodef_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $qodef_holder_params['inner'] ); ?>">
		<?php bazaar_qodef_get_blog( $qodef_blog_type ); ?>
	</div>
	
	<?php do_action( 'bazaar_qodef_before_container_close' ); ?>
</div>

<?php do_action( 'bazaar_qodef_blog_list_additional_tags' ); ?>
<?php get_footer(); ?>
