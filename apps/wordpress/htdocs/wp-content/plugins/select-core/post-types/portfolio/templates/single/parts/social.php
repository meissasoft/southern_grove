<div class="qodef-ps-social">
    <div class="qodef-ps-like">
        <?php if( function_exists('bazaar_qodef_get_like') ) bazaar_qodef_get_like(); ?>
    </div>
    <?php if(bazaar_qodef_options()->getOptionValue('enable_social_share') == 'yes' && bazaar_qodef_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
        <div class="qodef-ps-info-item qodef-ps-social-share">
            <?php echo bazaar_qodef_get_social_share_html() ?>
        </div>
    <?php endif; ?>
</div>
