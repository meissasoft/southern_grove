<?php
/*
 * Essential actions
 * since 1.0
 */

function business_space_do_home_slider(){
	if(is_front_page() && get_theme_mod('slider_in_home_page' , 1)) 
		get_template_part('templates/featured', 'slider' );
}
add_action('business_space_home_slider', 'business_space_do_home_slider');

function business_space_do_before_header(){
	get_template_part( 'templates/header', 'ad' ); 
}

add_action('business_space_before_header', 'business_space_do_before_header');


function business_space_do_header(){

		get_template_part( 'templates/top', 'contacts' );
		
		do_action('business_space_before_header');
		
		$business_space_header = get_theme_mod('header_layout', 1);
		
		if ($business_space_header == 0) {
			echo '<div id="site-header-main" class="site-header-main">';
			get_template_part( 'templates/header', 'default' );
			//woocommerce layout
		} else if($business_space_header == 1 && class_exists('WooCommerce')){
			get_template_part( 'templates/woocommerce', 'header' ); 
			//list layout
		} else if ($business_space_header == 2){
			get_template_part( 'templates/header', 'list' );
		} else {
			//default layout
			echo '<div id="site-header-main" class="site-header-main">';
			get_template_part( 'templates/header', 'default' );
		}
		
		if(is_front_page()){
			get_template_part( 'templates/header', 'hero' );
			get_template_part( 'templates/header', 'shortcode' );
		}
		
		/* end header div in default header layouts */
		if ($business_space_header == 0) {
			echo '</div><!-- .site-header-main -->';
		}

}

add_action('business_space_header', 'business_space_do_header');

