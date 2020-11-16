<?php if(bazaar_qodef_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="qodef-ps-info-item qodef-ps-date">
        <p class="qodef-ps-info-title"><?php esc_html_e('Date:', 'select-core'); ?></p>
        <p itemprop="dateCreated" class="qodef-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(bazaar_qodef_get_page_id()); ?>"/>
    </div>
<?php endif; ?>