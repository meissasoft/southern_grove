<?php if ( $show_ordering_filter == 'yes' ) { ?>
    <div class="qodef-pl-ordering-outer">
        <h6><?php esc_html_e( 'Filter', 'bazaar' ); ?></h6>
        <div class="qodef-pl-ordering">
            <div>
                <h5><?php esc_html_e( 'Sort By', 'bazaar' ); ?></h5>
                <ul>
					<?php print bazaar_qodef_get_module_part( $ordering_filter_list ); ?>
                </ul>
            </div>
            <div>
                <h5><?php esc_html_e( 'Price Range', 'bazaar' ); ?></h5>
                <ul class="qodef-pl-ordering-price">
					<?php print bazaar_qodef_get_module_part( $pricing_filter_list ); ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>