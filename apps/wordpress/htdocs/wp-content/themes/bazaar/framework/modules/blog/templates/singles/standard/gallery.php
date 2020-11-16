<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php bazaar_qodef_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
        </div>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-info-top">
                    <?php bazaar_qodef_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php bazaar_qodef_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php bazaar_qodef_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php bazaar_qodef_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php bazaar_qodef_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-text-main">
                    <?php the_content(); ?>
                    <?php do_action('bazaar_qodef_single_link_pages'); ?>
                </div>
                <div class="qodef-post-info-bottom clearfix">
                        <?php bazaar_qodef_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                        <?php bazaar_qodef_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>