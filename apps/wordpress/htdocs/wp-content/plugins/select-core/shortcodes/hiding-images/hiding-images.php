<?php
namespace QodeCore\CPT\Shortcodes\HidingImages;

use QodeCore\Lib;

class HidingImages implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'qodef_hiding_images';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                    => esc_html__('Hiding Images', 'select-core'),
            'base'                    => $this->getBase(),
            'as_parent'               => array('only' => 'qodef_hiding_image'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category'                => esc_html__('by Select', 'select-core'),
            'icon'                    => 'icon-wpb-hiding-images extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'heading'     => esc_html__('Main Image', 'select-core'),
                    'type'        => 'attach_image',
                    'admin-label' => true,
                    'param_name'  => 'main_image',
                    'value'       => '',
                    'description' => esc_html__('This image is shown inside the laptop monitor in the middle', 'select-core'),
                ),
                array(
                    'heading'     => esc_html__('Link', 'select-core'),
                    'type'        => 'textfield',
                    'param_name'  => 'link',
                    'admin_label' => true
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Target', 'select-core'),
                    'param_name' => 'target',
                    'value'      => array(
                        ''                           => '',
                        esc_html__('Self', 'select-core')  => '_self',
                        esc_html__('Blank', 'select-core') => '_blank'
                    ),
                    'dependency' => array('element' => 'link', 'not_empty' => true),
                ),
            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'main_image' => '',
            'link'       => '',
            'target'     => '_self'
        );

        $params = shortcode_atts($args, $atts);

        extract($params);

        $params['content'] = $content;

        return qodef_core_get_shortcode_module_template_part('templates/hiding-images', 'hiding-images', '', $params);
    }
}