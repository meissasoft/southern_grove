<?php

if ( ! function_exists( 'bazaar_qodef_register_footer_sidebar' ) ) {
	function bazaar_qodef_register_footer_sidebar() {
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_1',
				'name'          => esc_html__( 'Footer Top Column 1', 'bazaar' ),
				'description'   => esc_html__( 'Widgets added here will appear in the first column of top footer area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-1 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h4 class="qodef-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_2',
				'name'          => esc_html__( 'Footer Top Column 2', 'bazaar' ),
				'description'   => esc_html__( 'Widgets added here will appear in the second column of top footer area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-2 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h4 class="qodef-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_3',
				'name'          => esc_html__( 'Footer Top Column 3', 'bazaar' ),
				'description'   => esc_html__( 'Widgets added here will appear in the third column of top footer area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-3 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h4 class="qodef-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_4',
				'name'          => esc_html__( 'Footer Top Column 4', 'bazaar' ),
				'description'   => esc_html__( 'Widgets added here will appear in the fourth column of top footer area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-4 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h4 class="qodef-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_bottom_column_1',
				'name'          => esc_html__( 'Footer Bottom Column 1', 'bazaar' ),
				'description'   => esc_html__( 'Widgets added here will appear in the first column of bottom footer area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-column-1 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_bottom_column_2',
				'name'          => esc_html__( 'Footer Bottom Column 2', 'bazaar' ),
				'description'   => esc_html__( 'Widgets added here will appear in the second column of bottom footer area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-column-2 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_bottom_column_3',
				'name'          => esc_html__( 'Footer Bottom Column 3', 'bazaar' ),
				'description'   => esc_html__( 'Widgets added here will appear in the third column of bottom footer area', 'bazaar' ),
				'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-column-3 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="qodef-widget-title-holder"><h5 class="qodef-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'bazaar_qodef_register_footer_sidebar' );
}

if ( ! function_exists( 'bazaar_qodef_get_footer' ) ) {
	/**
	 * Loads footer HTML
	 */
	function bazaar_qodef_get_footer() {
		$parameters          = array();
		$page_id             = bazaar_qodef_get_page_id();
		$disable_footer_meta = get_post_meta( $page_id, 'qodef_disable_footer_meta', true );
		
		$parameters['display_footer']        = $disable_footer_meta === 'yes' ? false : true;
		$parameters['display_footer_top']    = bazaar_qodef_show_footer_top();
		$parameters['display_footer_bottom'] = bazaar_qodef_show_footer_bottom();
		$parameters['holder_classes']        = bazaar_qodef_get_footer_classes();
		
		bazaar_qodef_get_module_template_part( 'templates/footer', 'footer', '', $parameters );
	}
	
	add_action( 'bazaar_qodef_get_footer_template', 'bazaar_qodef_get_footer' );
}

if ( ! function_exists( 'bazaar_qodef_get_footer_classes' ) ) {
    /**
     * Get classes for footer holder
     */
    function bazaar_qodef_get_footer_classes() {
        $page_id             = bazaar_qodef_get_page_id();
        $classes = array();

        $uncovering_footer = bazaar_qodef_get_meta_field_intersect('uncovering_footer', $page_id) === 'yes';

        $classes[] = 'qodef-page-footer';

        if($uncovering_footer) {
            $classes[] = 'qodef-footer-uncover';
        }

        return implode( ' ', apply_filters( 'bazaar_qodef_footer_holder_classes', $classes ) );
    }
}

if ( ! function_exists( 'bazaar_qodef_show_footer_top' ) ) {
	/**
	 * Check footer top showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function bazaar_qodef_show_footer_top() {
		$footer_top_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = ( bazaar_qodef_get_meta_field_intersect( 'show_footer_top' ) === 'yes' ) ? true : false;
		
		//check footer columns.If they are empty, disable footer top
		$columns_flag = false;
		for ( $i = 1; $i <= 4; $i ++ ) {
			$footer_columns_id = 'footer_top_column_' . $i;
			if ( is_active_sidebar( $footer_columns_id ) ) {
				$columns_flag = true;
				break;
			}
		}
		
		if ( $option_flag && $columns_flag ) {
			$footer_top_flag = true;
		}
		
		return $footer_top_flag;
	}
}

if ( ! function_exists( 'bazaar_qodef_show_footer_bottom' ) ) {
	/**
	 * Check footer bottom showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function bazaar_qodef_show_footer_bottom() {
		$footer_bottom_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = ( bazaar_qodef_get_meta_field_intersect( 'show_footer_bottom' ) === 'yes' ) ? true : false;
		
		//check footer columns.If they are empty, disable footer bottom
		$columns_flag = false;
		for ( $i = 1; $i <= 3; $i ++ ) {
			$footer_columns_id = 'footer_bottom_column_' . $i;
			if ( is_active_sidebar( $footer_columns_id ) ) {
				$columns_flag = true;
				break;
			}
		}
		
		if ( $option_flag && $columns_flag ) {
			$footer_bottom_flag = true;
		}
		
		return $footer_bottom_flag;
	}
}

if ( ! function_exists( 'bazaar_qodef_get_content_bottom_area' ) ) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function bazaar_qodef_get_content_bottom_area() {
		$parameters = array();
		
		//Current page id
		$id = bazaar_qodef_get_page_id();
		
		//is content bottom area enabled for current page?
		$parameters['content_bottom_area'] = bazaar_qodef_get_meta_field_intersect( 'enable_content_bottom_area', $id );
		
		if ( $parameters['content_bottom_area'] === 'yes' ) {
			
			//Sidebar for content bottom area
			$parameters['content_bottom_area_sidebar'] = bazaar_qodef_get_meta_field_intersect( 'content_bottom_sidebar_custom_display', $id );
			//Content bottom area in grid
			$parameters['grid_class'] = ( bazaar_qodef_get_meta_field_intersect( 'content_bottom_in_grid', $id ) ) === 'yes' ? 'qodef-grid' : 'qodef-full-width';
			
			$parameters['content_bottom_style'] = array();
			
			//Content bottom area background color
			$background_color = bazaar_qodef_get_meta_field_intersect( 'content_bottom_background_color', $id );
			if ( $background_color !== '' ) {
				$parameters['content_bottom_style'][] = 'background-color: ' . $background_color . ';';
			}
			
			if ( is_active_sidebar( $parameters['content_bottom_area_sidebar'] ) ) {
				bazaar_qodef_get_module_template_part( 'templates/parts/content-bottom-area', 'footer', '', $parameters );
			}
		}
	}
}

if ( ! function_exists( 'bazaar_qodef_get_footer_top' ) ) {
	/**
	 * Return footer top HTML
	 */
	function bazaar_qodef_get_footer_top() {
		$parameters = array();
		
		//get number of top footer columns
		$parameters['footer_top_columns'] = bazaar_qodef_options()->getOptionValue( 'footer_top_columns' );
		
		//get footer top grid/full width class
		$parameters['footer_top_grid_class'] = bazaar_qodef_get_meta_field_intersect( 'footer_in_grid', get_the_ID() ) === 'yes' ? 'qodef-grid' : 'qodef-full-width';
		
		//get footer top other classes
		$footer_top_classes = array();
		
		//footer alignment
		$footer_top_alignment = bazaar_qodef_options()->getOptionValue( 'footer_top_columns_alignment' );
		$footer_top_classes[] = ! empty( $footer_top_alignment ) ? 'qodef-footer-top-alignment-' . esc_attr( $footer_top_alignment ) : '';
		
		$footer_top_classes = apply_filters( 'bazaar_qodef_footer_top_classes', $footer_top_classes );
		
		$parameters['footer_top_classes'] = implode( ' ', $footer_top_classes );
		
		bazaar_qodef_get_module_template_part( 'templates/parts/footer-top', 'footer', '', $parameters );
	}
}

if ( ! function_exists( 'bazaar_qodef_get_footer_bottom' ) ) {
	/**
	 * Return footer bottom HTML
	 */
	function bazaar_qodef_get_footer_bottom() {
		$parameters = array();
		
		//get number of bottom footer columns
		$parameters['footer_bottom_columns'] = bazaar_qodef_options()->getOptionValue( 'footer_bottom_columns' );
		
		//get footer top grid/full width class
		$parameters['footer_bottom_grid_class'] = bazaar_qodef_get_meta_field_intersect( 'footer_in_grid', get_the_ID() ) === 'yes' ? 'qodef-grid' : 'qodef-full-width';
		
		//get footer top other classes
		$footer_bottom_classes = array();
		$footer_bottom_classes = apply_filters( 'bazaar_qodef_footer_bottom_classes', $footer_bottom_classes );
		
		$parameters['footer_bottom_classes'] = implode( ' ', $footer_bottom_classes );
		
		bazaar_qodef_get_module_template_part( 'templates/parts/footer-bottom', 'footer', '', $parameters );
	}
}