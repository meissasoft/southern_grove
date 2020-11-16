<?php
namespace QodeCore\CPT\Shortcodes\PricingTable;

use QodeCore\Lib;

class PricingTableItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_pricing_table_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Select Pricing Table Item', 'select-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-pricing-table-item extended-custom-icon',
					'category'                  => esc_html__( 'by Select', 'select-core' ),
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'qodef_pricing_table' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'select-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'select-core' )
						),
						array(
								'type'        => 'dropdown',
								'param_name'  => 'skin',
								'heading'     => esc_html__( 'Skin', 'select-core' ),
								'value'       => array(
									esc_html__( 'Default', 'select-core' ) => '',
									esc_html__( 'Dark', 'select-core' )   => 'dark-skin'
								),
								'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'select-core' ),
							'value'       => esc_html__( 'Basic Plan', 'select-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'price',
							'heading'    => esc_html__( 'Price', 'select-core' )
						),
						array(
								'type'       => 'textfield',
								'param_name' => 'subtitle',
								'heading'    => esc_html__( 'Subtitle', 'select-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'currency',
							'heading'     => esc_html__( 'Currency', 'select-core' ),
							'description' => esc_html__( 'Default mark is $', 'select-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'select-core' ),
							'value'       => esc_html__( 'BUY NOW', 'select-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Button Link', 'select-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea_html',
							'param_name' => 'content',
							'heading'    => esc_html__( 'Content', 'select-core' ),
							'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'             => '',
			'skin' => '',
			'title'                    => '',
			'price'                    => '100',
			'subtitle'                 => '',
			'currency'                 => '$',
			'button_text'              => '',
			'link'                     => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']             = preg_replace( '#^<\/p>|<p>$#', '', $content ); // delete p tag before and after content
		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['button_type']         = 'simple';
		
		$html = qodef_core_get_shortcode_module_template_part( 'templates/pricing-table-template', 'pricing-table', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		$holderClasses[] = !empty($params['skin']) ? $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}

}