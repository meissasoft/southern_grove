<li class="qodef-bl-item clearfix">
	<div class="qodef-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			bazaar_qodef_get_module_template_part( 'templates/parts/image', 'blog', '', $params );
		} ?>
        <div class="qodef-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="qodef-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                bazaar_qodef_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                bazaar_qodef_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                bazaar_qodef_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                bazaar_qodef_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                bazaar_qodef_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                bazaar_qodef_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php bazaar_qodef_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="qodef-bli-excerpt">
		        <?php bazaar_qodef_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
		        <?php bazaar_qodef_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
	        </div>
        </div>
	</div>
</li>