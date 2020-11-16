<?php
namespace QodeCore\CPT\Shortcodes\ProductInfo;

use QodeCore\Lib;

class ProductInfo implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'qodef_product_info';

        add_action('vc_before_init', array($this,'vcMap'));

        //Product id filter
        add_filter( 'vc_autocomplete_qodef_product_info_product_id_callback', array( &$this, 'productIdAutocompleteSuggester', ), 10, 1 );

        //Product id render
        add_filter( 'vc_autocomplete_qodef_product_info_product_id_render', array( &$this, 'productIdAutocompleteRender', ), 10, 1 );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__( 'Select Product Info', 'bazaar' ),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by Select', 'bazaar' ),
                    'icon'                      => 'icon-wpb-product-info extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'product_id',
                            'heading'     => esc_html__( 'Selected Product', 'bazaar' ),
                            'settings'    => array(
                                'sortable'      => true,
                                'unique_values' => true
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => esc_html__( 'If you left this field empty then product ID will be of the current page', 'bazaar' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'product_info_type',
                            'heading'     => esc_html__( 'Product Info Type', 'bazaar' ),
                            'value'       => array(
                                esc_html__( 'With Image', 'bazaar' )	=> 'with_image',
                                esc_html__( 'Minimal', 'bazaar' ) 	 	=> 'minimal',
                            ),
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'product_info_position',
                            'heading'     => esc_html__( 'Product Info Position', 'bazaar' ),
                            'value'       => array(
                                esc_html__( 'Info On The Left', 'bazaar' )	=> 'info-on-the-left',
                                esc_html__( 'Info On The Right', 'bazaar' ) => 'info-on-the-right',
                            ),
                            'dependency'   => array('element' => 'product_info_type', 'value' => 'with_image'),
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_custom_image',
                            'heading'     => esc_html__( 'Enable Custom Image', 'bazaar' ),
                            'value'       => array_flip(bazaar_qodef_get_yes_no_select_array(false)),
                            'admin_label' => true,
                            'save_always' => true,
                            'dependency'   => array('element' => 'product_info_type', 'value' => 'with_image')
                        ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'custom_image',
                            'heading'     => esc_html__( 'Custom Image', 'bazaar' ),
                            'admin_label' => true,
                            'save_always' => true,
                            'dependency'  => array('element' => 'enable_custom_image', 'value' => 'yes')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'product_info_color',
                            'heading'    => esc_html__( 'Product Info Color', 'bazaar' ),
                            'group'      => esc_html__( 'Product Info Style', 'bazaar' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'title_tag',
                            'heading'     => esc_html__( 'Title Tag', 'bazaar' ),
                            'value'       => array_flip( bazaar_qodef_get_title_tag( true, array( 'p' => 'p' ) ) ),
                            'description' => esc_html__( 'Set title tag for product title element', 'bazaar' ),
                            'group'       => esc_html__( 'Product Info Style', 'bazaar' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'featured_image_size',
                            'heading'    => esc_html__( 'Featured Image Proportions', 'bazaar' ),
                            'value'      => array(
                                esc_html__( 'Default', 'bazaar' )        => '',
                                esc_html__( 'Original', 'bazaar' )       => 'full',
                                esc_html__( 'Square', 'bazaar' )         => 'square',
                                esc_html__( 'Landscape', 'bazaar' )      => 'landscape',
                                esc_html__( 'Portrait', 'bazaar' )       => 'portrait',
                                esc_html__( 'Medium', 'bazaar' )         => 'medium',
                                esc_html__( 'Large', 'bazaar' )          => 'large',
                                esc_html__( 'Shop Catalog', 'bazaar' )   => 'shop_catalog',
                                esc_html__( 'Shop Single', 'bazaar' )    => 'shop_single',
                                esc_html__( 'Shop Thumbnail', 'bazaar' ) => 'shop_thumbnail'
                            ),
                            'dependency'  => array('element' => 'enable_custom_image', 'value' => 'no')
                        ),
                        array(
                            'type' => 'colorpicker',
                            'param_name' => 'trim_background_color',
                            'heading' => esc_html__('Trim Background Color','bazaar'),
                        ),
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'product_id'          => '',
            'product_info_type'   => 'with_image',
            'product_info_position'   => 'info-on-the-left',
            'enable_custom_image' => 'no',
            'custom_image'        => '',
            'product_info_color'  => '',
            'title_tag'           => 'h2',
            'featured_image_size' => 'full',
            'trim_background_color' => ''
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['product_id'] = !empty($params['product_id']) ? $params['product_id'] : get_the_ID();
        $params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];

        $params['product_info_style'] = $this->getProductInfoStyle($params);
        $params['product_trim_style'] = $this->getProductTrimStyle($params);

        $html = '';
        $html .= '<div class="qodef-product-info '. $product_info_type . ' '. $product_info_position .'">';
        $html .= '<div class="qodef-pi-info-inner">';
        $html .= '<div class="qodef-pi-text-holder">';
        switch ($product_info_type) {
            case 'with_image':
                $html .= $this->getItemTitleHtml($params);
                $html .= $this->getItemPriceHtml($params);
                $html .= $this->getItemLearnMoreHtml($params);
                $html .= '</div>';
                $html .= $this->getItemFeaturedImageHtml($params);
                break;
            case 'minimal':
                $html .= $this->getItemTitleHtml($params);
                $html .= $this->getItemPriceHtml($params);
                $html .= $this->getItemLearnMoreHtml($params);
                $html .= '</div>';
                break;
            default:
                $html .= $this->getItemTitleHtml($params);
                $html .= $this->getItemPriceHtml($params);
                $html .= $this->getItemLearnMoreHtml($params);
                $html .= '</div>';
                break;
        }

        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Return product info styles
     *
     * @param $params
     *
     * @return array
     */
    private function getProductInfoStyle( $params ) {
        $styles = array();

        if ( ! empty( $params['product_info_color'] ) ) {
            $styles[] = 'color: ' . $params['product_info_color'];
        }

        return $styles;
    }

    /**
     * Return product trim styles
     *
     * @param $params
     *
     * @return array
     */
    private function getProductTrimStyle( $params ) {
        $styles = array();

        if ( ! empty( $params['trim_background_color'] ) ) {
            $styles[] = 'border-color: ' . $params['trim_background_color'];
        }

        return $styles;
    }

    /**
     * Generates product title html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getItemTitleHtml( $params ) {
        $html               = '';
        $product_id         = $params['product_id'];
        $title              = get_the_title( $product_id );
        $title_tag          = $params['title_tag'];
        $product_info_style = $params['product_info_style'];

        if ( ! empty( $title ) ) {
            $html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="qodef-pi-title entry-title" ' . bazaar_qodef_get_inline_style( $product_info_style ) . '>';
            $html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $product_id ) ) . '">' . esc_html( $title ) . '</a>';
            $html .= '</' . esc_attr( $title_tag ) . '>';
        }

        return $html;
    }

    /**
     * Generates product featured image html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getItemFeaturedImageHtml( $params ) {
        $html                = '';
        $product_id          = $params['product_id'];
        $featured_image_size = ! empty( $params['featured_image_size'] ) ? $params['featured_image_size'] : 'full';
        $featured_image      = get_the_post_thumbnail( $product_id, $featured_image_size );
        $product_trim_style = $params['product_trim_style'];

        if(!empty($params['custom_image'])){
            $custom_image = wp_get_attachment_image($params['custom_image'], 'full');
            $html = '<div class="qodef-pi-image"><a itemprop="url" class="qodef-pi-image" href="' . esc_url( get_the_permalink( $product_id ) ) . '"><div class="qodef-pi-trim" ' . bazaar_qodef_get_inline_style( $product_trim_style ) . '></div>' . $custom_image . '</a></div>';
        }
        else if ( ! empty( $featured_image ) ) {
            $html = '<div class="qodef-pi-image"><a itemprop="url" class="qodef-pi-image" href="' . esc_url( get_the_permalink( $product_id ) ) . '"><div class="qodef-pi-trim" ' . bazaar_qodef_get_inline_style( $product_trim_style ) . '></div>' . $featured_image . '</a></div>';
        }

        return $html;
    }

    /**
     * Generates product price html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getItemPriceHtml( $params ) {
        $html               = '';
        $product_id         = $params['product_id'];
        $product            = wc_get_product( $product_id );
        $product_info_style = $params['product_info_style'];

        if ( $price_html = $product->get_price_html() ) {
            $html = '<div class="qodef-pi-price" ' . bazaar_qodef_get_inline_style( $product_info_style ) . '>' . $price_html . '</div>';
        }

        return $html;
    }

    /**
     * Generates product add to cart html based on id
     *
     * @param $params
     *
     * @return html
     */
    public function getItemLearnMoreHtml( $params ) {
        $product_id = $params['product_id'];

        $html = bazaar_qodef_get_button_html(array(
            'link' 		=> get_permalink($product_id),
            'text' 		=> 'learn more',
            'type' 		=> 'simple',
            'dripicon' 	=> 'dripicon-arrow-thin-right',
            'icon_pack' => 'dripicons'
        ));

        return $html;
    }

    /**
     * Filter product by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function productIdAutocompleteSuggester( $query ) {
        global $wpdb;
        $product_id = (int) $query;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'product' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__( 'Id', 'bazaar' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'bazaar' ) . ': ' . $value['title'] : '' );
                $results[] = $data;
            }
        }

        return $results;

    }

    /**
     * Find product by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function productIdAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {

            $product = get_post( (int) $query );
            if ( ! is_wp_error( $product ) ) {

                $product_id = $product->ID;
                $product_title = $product->post_title;

                $product_title_display = '';
                if ( ! empty( $portfolio_title ) ) {
                    $product_title_display = ' - ' . esc_html__( 'Title', 'bazaar' ) . ': ' . $product_title;
                }

                $product_id_display = esc_html__( 'Id', 'bazaar' ) . ': ' . $product_id;

                $data          = array();
                $data['value'] = $product_id;
                $data['label'] = $product_id_display . $product_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}