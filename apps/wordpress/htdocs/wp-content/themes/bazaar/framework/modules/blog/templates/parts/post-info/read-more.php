<?php if ( ! bazaar_qodef_post_has_read_more() ) { ?>
	<div class="qodef-post-read-more-button">
		<?php
		if ( bazaar_qodef_core_plugin_installed() ) {
			echo bazaar_qodef_get_button_html(
				apply_filters(
					'bazaar_qodef_blog_template_read_more_button',
					array(
						'type'         => 'simple',
						'size'         => 'medium',
						'link'         => get_the_permalink(),
						'text'         => esc_html__( 'learn more', 'bazaar' ),
						'custom_class' => 'qodef-blog-list-button',
						'dripicon' 	   => 'dripicon-arrow-thin-right',
						'icon_pack'    => 'dripicons'
					)
				)
			);
		} else { ?>
			<a itemprop="url" href="<?php echo esc_url( get_the_permalink() ); ?>" target="_self" class="qodef-btn qodef-btn-medium qodef-btn-simple qodef-blog-list-button">
                <span class="qodef-btn-text"><?php echo esc_html__( 'READ MORE', 'bazaar' ); ?></span>
			</a>
		<?php } ?>
	</div>
<?php } ?>