<?php
if ( ! function_exists( 'bazaar_qodef_header_bottom_menu_styles' ) ) {
    function bazaar_qodef_header_bottom_menu_styles() {
        $vertical_header_styles = array();

        $vertical_header_selectors = array(
            '.qodef-header-bottom .qodef-vertical-menu-nav-holder-outer'
        );

        $vertical_background_color = bazaar_qodef_options()->getOptionValue( 'vertical_header_background_color' );
        $vertical_background_image = bazaar_qodef_options()->getOptionValue( 'vertical_header_background_image' );
        $vertical_shadow_enabled   = bazaar_qodef_options()->getOptionValue( 'vertical_header_shadow' );
        $vertical_border_enabled   = bazaar_qodef_options()->getOptionValue( 'vertical_header_border' );

        if ( ! empty( $vertical_background_color ) ) {
            $vertical_header_styles['background-color'] = $vertical_background_color;
        }

        if ( ! empty( $vertical_background_image ) ) {
            $vertical_header_styles['background-image'] = 'url(' . esc_url( $vertical_background_image ) . ')';
        }

        if ( $vertical_shadow_enabled === 'yes' ) {
            $vertical_header_styles['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
        }

        if ( $vertical_border_enabled === 'yes' ) {
            $header_border_color = bazaar_qodef_options()->getOptionValue( 'vertical_header_border_color' );

            if ( ! empty( $header_border_color ) ) {
                $vertical_header_styles['border-left'] = '1px solid ' . $header_border_color;
            }
        }

        echo bazaar_qodef_dynamic_css( $vertical_header_selectors, $vertical_header_styles );
    }

    add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_header_bottom_menu_styles' );
}

if ( ! function_exists( 'bazaar_qodef_header_bottom_main_menu_styles' ) ) {
    /**
     * Generates styles for vertical main main menu
     */
    function bazaar_qodef_header_bottom_main_menu_styles() {

        // vertical menu 1st level style

        $first_level_styles = bazaar_qodef_get_typography_styles( 'vertical_menu_1st' );

        $first_level_selector = array(
            '.qodef-header-bottom nav.qodef-fullscreen-menu > ul > li > a'
        );

        echo bazaar_qodef_dynamic_css( $first_level_selector, $first_level_styles );

        $first_level_hover_styles = array();

        $first_level_hover_color = bazaar_qodef_options()->getOptionValue( 'vertical_menu_1st_hover_color' );
        if ( ! empty( $first_level_hover_color ) ) {
            $first_level_hover_styles['color'] = $first_level_hover_color;
        }

        $first_level_hover_selector = array(
            '.qodef-header-bottom nav.qodef-fullscreen-menu > ul > li > a:hover',
            '.qodef-header-bottom nav.qodef-fullscreen-menu > ul > li > a.qodef-active-item',
            '.qodef-header-bottom nav.qodef-fullscreen-menu > ul > li > a.current-menu-ancestor'
        );

        echo bazaar_qodef_dynamic_css( $first_level_hover_selector, $first_level_hover_styles );

        // vertical menu 2nd level style

        $second_level_styles = bazaar_qodef_get_typography_styles( 'vertical_menu_2nd' );

        $second_level_selector = array(
            '.qodef-header-bottom nav.qodef-fullscreen-menu ul li ul li a'
        );

        echo bazaar_qodef_dynamic_css( $second_level_selector, $second_level_styles );

        $second_level_hover_styles = array();

        $second_level_hover_color = bazaar_qodef_options()->getOptionValue( 'vertical_menu_2nd_hover_color' );
        if ( ! empty( $second_level_hover_color ) ) {
            $second_level_hover_styles['color'] = $second_level_hover_color;
        }

        $second_level_hover_selector = array(
            '.qodef-header-bottom nav.qodef-fullscreen-menu ul li ul li a:hover',
            '.qodef-header-bottom nav.qodef-fullscreen-menu ul li ul li.current-menu-ancestor > a',
            '.qodef-header-bottom nav.qodef-fullscreen-menu ul li ul li.current-menu-item > a'
        );

        echo bazaar_qodef_dynamic_css( $second_level_hover_selector, $second_level_hover_styles );

        // vertical menu 3rd level style

        $third_level_styles = bazaar_qodef_get_typography_styles( 'vertical_menu_3rd' );

        $third_level_selector = array(
            '.qodef-header-vertical-sliding nav.qodef-fullscreen-menu ul li ul li ul li a'
        );

        echo bazaar_qodef_dynamic_css( $third_level_selector, $third_level_styles );


        $third_level_hover_styles = array();

        $third_level_hover_color = bazaar_qodef_options()->getOptionValue( 'vertical_menu_3rd_hover_color' );
        if ( ! empty( $third_level_hover_color ) ) {
            $third_level_hover_styles['color'] = $third_level_hover_color;
        }

        $third_level_hover_selector = array(
            '.qodef-header-bottom nav.qodef-fullscreen-menu ul li ul li ul li a:hover',
            '.qodef-header-bottom nav.qodef-fullscreen-menu ul li ul li ul li.current-menu-ancestor > a',
            '.qodef-header-bottom nav.qodef-fullscreen-menu ul li ul li ul li.current-menu-item > a'
        );

        echo bazaar_qodef_dynamic_css( $third_level_hover_selector, $third_level_hover_styles );
    }

    add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_header_bottom_main_menu_styles' );
}