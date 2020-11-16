<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Qodef_Hiding_Images extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'qodef_core_add_hiding_images_shortcodes' ) ) {
    function qodef_core_add_hiding_images_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'QodeCore\CPT\Shortcodes\HidingImages\HidingImages',
            'QodeCore\CPT\Shortcodes\HidingImages\HidingImage'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'qodef_core_filter_add_vc_shortcode', 'qodef_core_add_hiding_images_shortcodes' );
}

if ( ! function_exists( 'qodef_core_set_hiding_images_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for progress bar shortcode to set our icon for Visual Composer shortcodes panel
     */
    function qodef_core_set_hiding_images_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-hiding-images';
        $shortcodes_icon_class_array[] = '.icon-wpb-hiding-image';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'qodef_core_filter_add_vc_shortcodes_custom_icon_class', 'qodef_core_set_hiding_images_icon_class_name_for_vc_shortcodes' );
}