<article class="qodef-pl-item <?php echo esc_attr($this_object->getArticleClasses($params)); ?>">
	<div class="qodef-pl-item-inner">
		<?php echo qodef_core_get_cpt_shortcode_module_template_part('portfolio', 'layout-collections/'.$item_style, '', $params); ?>
		
		<a itemprop="url" class="qodef-pli-link qodef-block-drag-link" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"></a>
	</div>
</article>