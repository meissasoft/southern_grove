<div class="qodef-full-screen-sections <?php echo esc_attr($holder_classes); ?>" <?php echo bazaar_qodef_get_inline_attrs($holder_data); ?>>
	<div class="qodef-fss-wrapper">
		<?php echo do_shortcode($content); ?>
	</div>
	<?php if($enable_navigation === 'yes') { ?>
		<div class="qodef-fss-nav-holder">
			<a id="qodef-fss-nav-up" href="#" target="_self"><span class='icon-arrows-up'></span></a>
			<a id="qodef-fss-nav-down" href="#" target="_self"><span class='icon-arrows-down'></span></a>
		</div>
	<?php } ?>
</div>