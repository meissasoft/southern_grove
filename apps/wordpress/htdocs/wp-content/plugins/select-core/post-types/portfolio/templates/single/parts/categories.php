<?php if(bazaar_qodef_options()->getOptionValue('portfolio_single_hide_categories') !== 'yes') : ?>
    <?php
    $categories   = wp_get_post_terms(get_the_ID(), 'portfolio-category');
    if(is_array($categories) && count($categories)) : ?>
        <div class="qodef-ps-info-item qodef-ps-categories">
            <p class="qodef-ps-info-title"><?php esc_html_e('Category:', 'select-core'); ?></p>
            <?php foreach($categories as $cat) { ?>
                <a itemprop="url" class="qodef-ps-info-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
            <?php } ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
