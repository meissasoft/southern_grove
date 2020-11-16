<?php

namespace QodeCore\CPT\Shortcodes\CardsGallery;

use QodeCore\Lib;

/**
 * Class CardsGallery
 */
class CardsGallery implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * ZoomingSlider constructor.
	 */
	public function __construct() {
		$this->base = 'qodef_cards_gallery';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Cards Gallery','select-core'),
			'base'                      => $this->base,
			'category'                  => 'by Select',
			'icon'                      => 'icon-wpb-cards-gallery extended-custom-icon',
            'allowed_container_element' => 'vc_row',
			'params'                    => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__('Images','select-core'),
                    'param_name'  => 'images',
                    'description' => esc_html__('Select images from media library','select-core')
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Cards Background Color','select-core'),
                    'param_name'  => 'background_color'
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Rounded Edges', 'select-core'),
                    'param_name'  => 'rounded_edges',
                    'value'       => array(
                        esc_html__('No', 'select-core')  => 'no',
                        esc_html__('Yes', 'select-core') => 'yes'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Layout', 'select-core'),
                    'param_name'  => 'layout',
                    'value'       => array(
                        esc_html__('Shuffled right', 'select-core') => 'shuffled-right',
                        esc_html__('Shuffled left', 'select-core') => 'shuffled-left',
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Bundle Animation', 'select-core'),
                    'param_name'  => 'bundle_animation',
                    'value'       => array(
                        esc_html__('No', 'select-core')  => 'no',
                        esc_html__('Yes', 'select-core') => 'yes'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
            )
		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
        $args = array(
            'images' => '',
            'background_color' => '',
            'rounded_edges' => 'no',
            'layout' => 'shuffled-right',
            'bundle_animation' => 'no'
        );

        $params = shortcode_atts($args, $atts);
        $params['images'] = $this->getGalleryImages($params);
        $params['holder_classes'] = $this->getHolderClasses($params);
        if($params['background_color'] !== ''){
            $params['background_color'] = 'background-color:'.$params['background_color'];
        }

		return qodef_core_get_shortcode_module_template_part('templates/cards-gallery', 'cards-gallery', '', $params);
	}

    /**
     * Return images for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getGalleryImages($params) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach($image_ids as $id) {

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src($id, 'full');
            $image['url']      = $image_original[0];
            $image['title']    = get_the_title($id);
            $image['image_link'] = get_post_meta($id, 'attachment_image_link', true);
            $image['image_target'] = get_post_meta($id, 'attachment_image_target', true);

            $image_dimensions = bazaar_qodef_get_image_dimensions($image['url']);
            if(is_array($image_dimensions) && array_key_exists('height', $image_dimensions)) {

                if(!empty($image_dimensions['height']) && $image_dimensions['width']) {
                    $image['height'] = $image_dimensions['height'];
                    $image['width']  = $image_dimensions['width'];
                }
            }

            $images[$i] = $image;
            $i++;
        }

        return $images;

    }

    private function getHolderClasses($params) {
        $classes = array('qodef-cards-gallery-holder');

        if ($params['bundle_animation'] == 'yes') {
            $classes[] = 'qodef-no-events qodef-bundle-animation';
        }

        if ($params['rounded_edges'] == 'yes') {
            $classes[] = 'qodef-rounded-edges';
        }

        $classes[] = 'qodef-'.$params['layout'];

        return $classes;
    }
}