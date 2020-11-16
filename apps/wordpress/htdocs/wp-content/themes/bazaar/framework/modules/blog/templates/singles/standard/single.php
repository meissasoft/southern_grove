<?php

bazaar_qodef_get_single_post_format_html($blog_single_type);

do_action('bazaar_qodef_after_article_content');

bazaar_qodef_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

bazaar_qodef_get_module_template_part('templates/parts/single/author-info', 'blog');

bazaar_qodef_get_module_template_part('templates/parts/single/single-navigation', 'blog');

bazaar_qodef_get_module_template_part('templates/parts/single/comments', 'blog');