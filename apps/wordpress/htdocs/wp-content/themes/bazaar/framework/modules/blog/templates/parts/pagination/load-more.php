<?php if($max_num_pages > 1) { ?>
	<div class="qodef-blog-pag-loading">
		<div class="qodef-blog-pag-bounce1"></div>
		<div class="qodef-blog-pag-bounce2"></div>
		<div class="qodef-blog-pag-bounce3"></div>
	</div>
	<div class="qodef-blog-pag-load-more">
		<?php
        if(bazaar_qodef_core_plugin_installed()) {
			echo bazaar_qodef_get_button_html(
                apply_filters(
                    'bazaar_qodef_blog_template_load_more_button',
                    array(
                        'link' => 'javascript: void(0)',
                        'size' => 'large',
                        'text' => esc_html__('Load more', 'bazaar')
			        )
                )
            );
        } else { ?>
            <a itemprop="url" href="javascript:void(0)" target="_self" class="qodef-btn qodef-btn-large qodef-btn-solid">
                <span class="qodef-btn-text">
                    <?php echo esc_html__('Load more', 'bazaar'); ?>
                </span>
            </a>
		<?php } ?>
	</div>
<?php
	$unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'qodef_blog_load_more_nonce_' . $unique_id, 'qodef_blog_load_more_nonce_' . $unique_id );
}