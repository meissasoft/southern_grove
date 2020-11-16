<div class="qodef-price-table <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pt-inner">
		<ul>
			<li class="qodef-pt-title-holder">
				<h5 class="qodef-pt-title"><?php echo esc_html($title); ?></h5>
			</li>
			<li class="qodef-pt-prices">
				<span class="qodef-pt-value"><?php echo esc_html($currency); ?></span>
				<span class="qodef-pt-price"><?php echo esc_html($price); ?></span>
			</li>
			<li class="qodef-pt-subtitle">
				<span><?php echo esc_html($subtitle); ?></span>
			</li>
			<li class="qodef-pt-separator">
				<span class="qodef-separator"></span>
			</li>
			<li class="qodef-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="qodef-pt-button">
					<?php echo bazaar_qodef_get_button_html(array(
						'link' 		=> $link,
						'text' 		=> $button_text,
						'type' 		=> $button_type,
                        'dripicon' 	   => 'dripicon-arrow-thin-right',
                        'icon_pack'    => 'dripicons'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>