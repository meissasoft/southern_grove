<?php if(bazaar_qodef_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = bazaar_qodef_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>
    <div class="qodef-ps-navigation">
        <?php if(get_previous_post() !== '') : ?>
            <div class="qodef-ps-prev">
                <?php if($nav_same_category) {
	                previous_post_link('%link','<h5 class="qodef-ps-prev-title">%title</h5><span class="qodef-ps-nav-mark fa fa-angle-left"></span><span class="qodef-ps-prev-text">Previous</span>', true, '', 'portfolio-category');
                } else {
	                previous_post_link('%link','<h5 class="qodef-ps-prev-title">%title</h5><span class="qodef-ps-nav-mark fa fa-angle-left"></span><span class="qodef-ps-prev-text">Previous</span>');
                } ?>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="qodef-ps-back-btn">
                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="fa fa-th-large"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="qodef-ps-next">
                <?php if($nav_same_category) {
                    next_post_link('%link', '<h5 class="qodef-ps-next-title">%title</h5><span class="qodef-ps-next-text">Next</span><span class="qodef-ps-nav-mark fa fa-angle-right"></span>', true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', '<h5 class="qodef-ps-next-title">%title</h5><span class="qodef-ps-next-text">Next</span><span class="qodef-ps-nav-mark fa fa-angle-right"></span>');
                } ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>