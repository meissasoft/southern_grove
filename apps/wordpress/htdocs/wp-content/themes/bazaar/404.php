<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * bazaar_qodef_header_meta hook
	 *
	 * @see bazaar_qodef_header_meta() - hooked with 10
	 * @see bazaar_qodef_user_scalable_meta - hooked with 10
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
	
	<div class="qodef-wrapper qodef-404-page">
		<div class="qodef-wrapper-inner">
            <?php
            /**
             * bazaar_qodef_after_wrapper_inner hook
             *
             * @see bazaar_qodef_get_header() - hooked with 10
             * @see bazaar_qodef_get_mobile_header() - hooked with 10
             */
            do_action( 'bazaar_qodef_after_wrapper_inner' ); ?>
			<?php get_template_part( 'slider' ); ?>

            <?php
            /**
             * bazaar_qodef_after_header_area hook
             *
             * @see bazaar_qodef_back_to_top_button() - hooked with 10
             * @see bazaar_qodef_get_full_screen_menu() - hooked with 10
             */
            do_action( 'bazaar_qodef_after_header_area' ); ?>

			<div class="qodef-content" <?php bazaar_qodef_content_elem_style_attr(); ?>>
				<div class="qodef-content-inner">
					<div class="qodef-page-not-found">
						<?php
						$qodef_title_image_404 = bazaar_qodef_options()->getOptionValue( '404_page_title_image' );
						$qodef_title_404       = bazaar_qodef_options()->getOptionValue( '404_title' );
						$qodef_subtitle_404    = bazaar_qodef_options()->getOptionValue( '404_subtitle' );
						$qodef_text_404        = bazaar_qodef_options()->getOptionValue( '404_text' );
						$qodef_button_label    = bazaar_qodef_options()->getOptionValue( '404_back_to_home' );
						$qodef_button_style    = bazaar_qodef_options()->getOptionValue( '404_button_style' );
						
						if ( ! empty( $qodef_title_image_404 ) ) { ?>
							<div class="qodef-404-title-image">
								<img src="<?php echo esc_url( $qodef_title_image_404 ); ?>" alt="<?php esc_html_e( '404 Title Image', 'bazaar' ); ?>" />
							</div>
						<?php } ?>
						
						<span class="qodef-404-title">
							<?php if ( ! empty( $qodef_title_404 ) ) {
								echo esc_html( $qodef_title_404 );
							} else {
								esc_html_e( '404', 'bazaar' );
							} ?>
						</span>
						
						<span class="qodef-404-subtitle">
							<?php if ( ! empty( $qodef_subtitle_404 ) ) {
								echo esc_html( $qodef_subtitle_404 );
							} else {
								esc_html_e( 'Page not found', 'bazaar' );
							} ?>
						</span>
						
						<p class="qodef-404-text">
							<?php if ( ! empty( $qodef_text_404 ) ) {
								echo esc_html( $qodef_text_404 );
							} else {
								esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'bazaar' );
							} ?>
						</p>
						
						<?php
						$qodef_params           = array();
						$qodef_params['text']   = ! empty( $qodef_button_label ) ? $qodef_button_label : esc_html__( 'back to home', 'bazaar' );
						$qodef_params['link']   = esc_url( home_url( '/' ) );
						$qodef_params['target'] = '_self';
						$qodef_params['size']   = 'medium';
						$qodef_params['fe_icon'] = 'arrow_right';
						$qodef_params['icon_pack'] = 'font_elegant';
						
						if ( $qodef_button_style == 'light-style' ) {
							$qodef_params['custom_class'] = 'qodef-btn-light-style';
						}
						
						echo bazaar_qodef_execute_shortcode( 'qodef_button', $qodef_params ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>