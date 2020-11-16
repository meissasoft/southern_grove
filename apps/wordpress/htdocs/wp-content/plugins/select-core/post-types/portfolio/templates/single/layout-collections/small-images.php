<div class="qodef-grid-row">
	<div class="qodef-grid-col-8">
        <div class="qodef-ps-image-holder">
            <div class="qodef-ps-image-inner">
                <?php
                $media = qodef_core_get_portfolio_single_media();
                
                if(is_array($media) && count($media)) : ?>
                    <?php foreach($media as $single_media) : ?>
                        <div class="qodef-ps-image">
                            <?php qodef_core_get_portfolio_single_media_html($single_media); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
	<div class="qodef-grid-col-4">
        <div class="qodef-ps-info-holder qodef-ps-info-sticky-holder">
            <?php
            //get portfolio title section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/title', 'portfolio', $item_layout);

            //get portfolio content section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);

            //get portfolio custom fields section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);

            //get portfolio date section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);

            //get portfolio category section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);

            //get portfolio tags section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);

            //get portfolio share section
            qodef_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
            ?>
        </div>
    </div>
</div>