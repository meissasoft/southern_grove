<?php
get_header();
bazaar_qodef_get_title();
get_template_part('slider');
?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action('bazaar_qodef_after_container_open'); ?>
	<div class="qodef-container-inner clearfix">
		<?php
			$qodef_taxonomy_id = get_queried_object_id();
			$qodef_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';			
			$qodef_taxonomy = ! empty( $qodef_taxonomy_id ) ? get_term_by( 'id', $qodef_taxonomy_id, $qodef_taxonomy_type) : '';
			$qodef_taxonomy_slug = !empty($qodef_taxonomy) ? $qodef_taxonomy->slug : '';
			$qodef_taxonomy_name = !empty($qodef_taxonomy) ? $qodef_taxonomy->taxonomy : '';
		
			qodef_core_get_archive_portfolio_list($qodef_taxonomy_slug, $qodef_taxonomy_name);
		?>
	</div>
	<?php do_action('bazaar_qodef_before_container_close'); ?>
</div>
<?php get_footer(); ?>