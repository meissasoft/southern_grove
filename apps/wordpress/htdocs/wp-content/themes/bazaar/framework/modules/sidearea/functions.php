<?php
if ( ! function_exists( 'bazaar_qodef_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function bazaar_qodef_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'bazaar' ),
				'description'   => esc_html__( 'Side Area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
        register_sidebar(
            array(
                'id'            => 'sidearea-bottom',
                'name'          => esc_html__( 'Side Area Bottom', 'bazaar' ),
                'description'   => esc_html__( 'Side Area Bottom', 'bazaar' ),
                'before_widget' => '<div id="%1$s" class="widget qodef-sidearea %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );
	}
	
	add_action( 'widgets_init', 'bazaar_qodef_register_side_area_sidebar' );
}

if ( ! function_exists( 'bazaar_qodef_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function bazaar_qodef_side_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'qodef_side_area_opener' ) ) {
			
			$classes[] = 'qodef-side-menu-slide-from-right';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'bazaar_qodef_side_menu_body_class' );
}

if ( ! function_exists( 'bazaar_qodef_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function bazaar_qodef_get_side_area() {
		
		if ( is_active_widget( false, false, 'qodef_side_area_opener' ) ) {
			
			bazaar_qodef_get_module_template_part( 'templates/sidearea', 'sidearea' );
		}
	}
	
	add_action( 'bazaar_qodef_after_body_tag', 'bazaar_qodef_get_side_area', 10 );
}