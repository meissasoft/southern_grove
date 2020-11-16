<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="qodef-pl-loading">
		<div class="qodef-pl-loading-bounce1"></div>
		<div class="qodef-pl-loading-bounce2"></div>
		<div class="qodef-pl-loading-bounce3"></div>
	</div>
	<div class="qodef-pl-load-more-holder">
		<div class="qodef-pl-load-more" <?php bazaar_qodef_inline_style($holder_styles); ?>>
			<?php 
				echo bazaar_qodef_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'large',
					'text' => esc_html__('LOAD MORE', 'select-core')
				));
			?>
		</div>
	</div>
<?php }