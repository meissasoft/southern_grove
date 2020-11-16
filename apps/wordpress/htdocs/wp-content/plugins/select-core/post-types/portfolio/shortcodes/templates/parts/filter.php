<?php if($filter == 'yes') {
	$filter_categories    = $this_object->getFilterCategories($params);
	$filter_holder_styles = $this_object->getFilterHolderStyles($params);
	$filter_styles        = $this_object->getFilterStyles($params);
	?>
	<div class="qodef-pl-filter-holder" <?php bazaar_qodef_inline_style($filter_holder_styles); ?>>
		<div class="qodef-plf-inner">
			<?php
			if(is_array($filter_categories) && count($filter_categories)){ ?>
				<ul <?php bazaar_qodef_inline_style($filter_styles); ?>>
					<li class="qodef-pl-filter" data-filter="">
						<span><?php esc_html_e('Show all', 'select-core')?></span>
					</li>
					<?php foreach($filter_categories as $cat) { ?>
						<li class="qodef-pl-filter" data-filter=".portfolio-category-<?php echo esc_attr($cat->slug); ?>">
							<span><?php echo esc_html($cat->name); ?></span>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
<?php } ?>
