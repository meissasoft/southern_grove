<?php do_action('bazaar_qodef_before_page_header'); ?>

<header class="qodef-page-header">
	<?php do_action('bazaar_qodef_after_page_header_html_open'); ?>
	
    <div class="qodef-logo-area">
	    <?php do_action( 'bazaar_qodef_after_header_logo_area_html_open' ); ?>
	    
        <?php if($logo_area_in_grid) : ?>
            <div class="qodef-grid">
        <?php endif; ?>
			
            <div class="qodef-vertical-align-containers">
                <div class="qodef-position-center">
                    <div class="qodef-position-center-inner">
                        <?php if(!$hide_logo) {
                            bazaar_qodef_get_logo();
                        } ?>
                    </div>
                </div>
            </div>
	            
        <?php if($logo_area_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
	
    <?php if($show_fixed_wrapper) : ?>
        <div class="qodef-fixed-wrapper">
    <?php endif; ?>
	        
    <div class="qodef-menu-area">
	    <?php do_action( 'bazaar_qodef_after_header_menu_area_html_open' ); ?>
	    
        <?php if($menu_area_in_grid) : ?>
            <div class="qodef-grid">
        <?php endif; ?>
	            
            <div class="qodef-vertical-align-containers">
                <div class="qodef-position-center">
                    <div class="qodef-position-center-inner">
                        <?php bazaar_qodef_get_main_menu(); ?>
                    </div>
                </div>
            </div>
	            
        <?php if($menu_area_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
	
    <?php if($show_fixed_wrapper) { ?>
        </div>
	<?php } ?>
	
	<?php if($show_sticky) {
		bazaar_qodef_get_sticky_header('centered', 'header/types/header-centered');
	} ?>
	
	<?php do_action('bazaar_qodef_before_page_header_html_close'); ?>
</header>

<?php do_action('bazaar_qodef_after_page_header'); ?>