<?php
namespace QodeCore\CPT\Shortcodes\HidingImages;

use QodeCore\Lib;

class HidingImage implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'qodef_hiding_image';
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
            'name'                    => esc_html__('Hiding Image', 'select-core'),
            'base'                    => $this->getBase(),
            'as_child'                => array('only' => 'qodef_hiding_images'),
            'category'                => esc_html__('by Select', 'select-core'),
            'icon'                    => 'icon-wpb-hiding-image extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'attach_image',
                    'admin_label' => true,
                    'heading'     => esc_html__('Image', 'select-core'),
                    'param_name'  => 'image',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Link', 'select-core'),
                    'value'       => '',
                    'param_name'  => 'link',
                    'dependency'  => array('element' => 'image', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Target', 'select-core'),
                    'param_name'  => 'target',
                    'value'       => array(
                        esc_html__('Blank', 'select-core') => '_blank',
                        esc_html__('Self', 'select-core')  => '_self'
                    ),
                    'save_always' => true,
                    'dependency'  => array('element' => 'image', 'not_empty' => true)
                )
            )
        ));

    }

    public function render($atts, $content = null) {

        $default_atts = array(
            'image'       => '',
            'link'        => '',
            'target'      => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        return qodef_core_get_shortcode_module_template_part('templates/hiding-image', 'hiding-images', '', $params);

    }
}