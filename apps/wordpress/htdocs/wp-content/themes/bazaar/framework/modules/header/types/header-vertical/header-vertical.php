<?php
namespace BazaarQodef\Modules\Header\Types;

use BazaarQodef\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Vertical layout and option
 *
 * Class HeaderVertical
 */
class HeaderVertical extends HeaderType {
    protected $mobileHeaderHeight;
    protected $verticalHeaderWidth;

	public function __construct() {
		$this->slug = 'header-vertical';
		
		if ( ! is_admin() ) {
			$this->mobileHeaderHeight = bazaar_qodef_set_default_mobile_menu_height_for_header_types();
            $this->verticalHeaderWidth =  300;
			
			add_action( 'wp', array( $this, 'setHeaderHeightProps' ) );
			
			add_filter( 'bazaar_qodef_js_global_variables', array( $this, 'getGlobalJSVariables' ) );
			add_filter( 'bazaar_qodef_per_page_js_vars', array( $this, 'getPerPageJSVariables' ) );
		}
	}
	
	/**
	 * Loads template for header type
	 *
	 * @param array $parameters associative array of variables to pass to template
	 */
	public function loadTemplate( $parameters = array() ) {
		$parameters['holder_class'] = bazaar_qodef_vertical_header_holder_class();
		
		$parameters = apply_filters( 'bazaar_qodef_header_vertical_parameters', $parameters );
		
		bazaar_qodef_get_module_template_part( 'templates/' . $this->slug, $this->moduleName . '/types/' . $this->slug, '', $parameters );
	}
	
	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
	}
	
	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return mixed
	 */
	public function calculateHeightOfTransparency() {
		$menuAreaTransparent = false;
		
		if ( is_404() ) {
			$menuAreaTransparent = true;
		}
		
		$transparencyHeight = 0;
		
		if ( $menuAreaTransparent ) {
			$transparencyHeight = $this->mobileHeaderHeight;
		}
		
		return $transparencyHeight;
	}
	
	/**
	 * Returns height of header parts that are totaly transparent
	 *
	 * @return mixed
	 */
	public function calculateHeightOfCompleteTransparency() {
		return 0;
	}
	
	/**
	 * Returns header height
	 *
	 * @return mixed
	 */
	public function calculateHeaderHeight() {
		return 0;
	}
	
	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables( $globalVariables ) {
		$globalVariables['qodefLogoAreaHeight'] = 0;
		$globalVariables['qodefMenuAreaHeight'] = 0;
		
		return $globalVariables;
	}
	
	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables( $perPageVars ) {
		$perPageVars['qodefHeaderTransparencyHeight'] = 0;
        $perPageVars['qodefHeaderVerticalWidth'] = $this->verticalHeaderWidth;
		
		return $perPageVars;
	}
}