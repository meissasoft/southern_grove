<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$qodef_sidebar_layout = bazaar_qodef_sidebar_layout();

get_header();
bazaar_qodef_get_title();
get_template_part( 'slider' );

//Woocommerce content
if ( ! is_singular( 'product' ) ) { ?>
	<div class="qodef-container">
		<div class="qodef-container-inner clearfix">
			<div class="qodef-grid-row">
				<div <?php echo bazaar_qodef_get_content_sidebar_class(); ?>>
					<?php bazaar_qodef_woocommerce_content(); ?>
				</div>
				<?php if ( $qodef_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo bazaar_qodef_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="qodef-container">
		<div class="qodef-container-inner clearfix">
			<?php bazaar_qodef_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>