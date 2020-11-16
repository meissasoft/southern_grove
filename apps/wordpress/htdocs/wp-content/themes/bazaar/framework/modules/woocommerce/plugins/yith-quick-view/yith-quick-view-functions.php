<?php

if(!function_exists('bazaar_qodef_woocommerce_quickview_link')) {
    /**
     * Function that returns quick view link
     */
    function bazaar_qodef_woocommerce_quickview_link(){
        global $product;

        $product_id = $product->get_id();

        print '<div class="qodef-yith-wcqv-holder"><a href="#" class="yith-wcqv-button" data-product_id="'.$product_id.'"><span>'.esc_html__('quick look', 'bazaar').'</span></a></div>';

    }
    add_action('bazaar_qodef_woocommerce_info_below_image_hover', 'bazaar_qodef_woocommerce_quickview_link',1);
}

if(!function_exists('bazaar_qodef_woocommerce_disable_yith_pretty_photo')) {
    /**
     * Function that disable YITH Quick View pretty photo style
     */
    function bazaar_qodef_woocommerce_disable_yith_pretty_photo() {
        //is woocommerce installed?
        if(bazaar_qodef_is_woocommerce_installed() && bazaar_qodef_is_yith_wcqv_install()) {

            wp_deregister_style('woocommerce_prettyPhoto_css');
        }
    }

    add_action('wp_footer', 'bazaar_qodef_woocommerce_disable_yith_pretty_photo');
}