<?php
namespace QodeCore\CPT\Shortcodes\PricingTable;

use QodeCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qodef_pricing_table';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Select Pricing Table', 'select-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'qodef_pricing_table_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by Select', 'select-core' ),
					'icon'                    => 'icon-wpb-pricing-table extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'select-core' ),
							'value'       => array(
								esc_html__( 'One', 'select-core' )   => 'qodef-one-column',
								esc_html__( 'Two', 'select-core' )   => 'qodef-two-columns',
								esc_html__( 'Three', 'select-core' ) => 'qodef-three-columns',
								esc_html__( 'Four', 'select-core' )  => 'qodef-four-columns',
								esc_html__( 'Five', 'select-core' )  => 'qodef-five-columns',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_columns',
							'heading'     => esc_html__( 'Space Between Columns', 'select-core' ),
							'value'       => array(
								esc_html__( 'Normal', 'select-core' )   => 'normal',
								esc_html__( 'Small', 'select-core' )    => 'small',
								esc_html__( 'Tiny', 'select-core' )     => 'tiny',
								esc_html__( 'No Space', 'select-core' ) => 'no'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'columns'               => 'qodef-two-columns',
			'space_between_columns' => 'normal'
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params );
		
		$html = '<div class="qodef-pricing-tables clearfix ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="qodef-pt-wrapper">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['columns'] ) ? $params['columns'] : '';
		$holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'qodef-pt-' . $params['space_between_columns'] . '-space' : '';
		
		return implode( ' ', $holderClasses );
	}
}