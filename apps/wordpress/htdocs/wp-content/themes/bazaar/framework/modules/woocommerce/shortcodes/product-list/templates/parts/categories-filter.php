<?php if ( $show_category_filter == 'yes' ) { ?>
    <div class="qodef-pl-categories">
        <h6 class="qodef-pl-categories-label"><?php esc_html_e( 'Categories', 'bazaar' ); ?></h6>
        <ul>
			<?php print bazaar_qodef_get_module_part( $categories_filter_list ); ?>
        </ul>
    </div>
<?php } ?>