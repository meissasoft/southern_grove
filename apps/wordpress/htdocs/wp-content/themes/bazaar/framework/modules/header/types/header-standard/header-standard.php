<?php
namespace BazaarQodef\Modules\Header\Types;

use BazaarQodef\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard layout and option
 *
 * Class HeaderStandard
 */
class HeaderStandard extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;
	protected $menuAreaHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-standard';
		
		if ( ! is_admin() ) {
			$this->menuAreaHeight     = bazaar_qodef_set_default_menu_height_for_header_types();
			$this->mobileHeaderHeight = bazaar_qodef_set_default_mobile_menu_height_for_header_types();
			
			add_action( 'wp', array( $this, 'setHeaderHeightProps' ) );
			
			add_filter( 'bazaar_qodef_js_global_variables', array( $this, 'getGlobalJSVariables' ) );
			add_filter( 'bazaar_qodef_per_page_js_vars', array( $this, 'getPerPageJSVariables' ) );
		}
	}
	
	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate( $parameters = array() ) {
		$page_id                                = bazaar_qodef_get_page_id();
		$menu_area_position                     = bazaar_qodef_get_meta_field_intersect( 'set_menu_area_position', $page_id );
		$parameters['menu_area_position']       = ! empty( $menu_area_position ) ? $menu_area_position : 'right';
		$parameters['menu_area_position_class'] = ! empty( $menu_area_position ) ? 'qodef-menu-' . $menu_area_position : 'qodef-menu-right';
		
		$parameters = apply_filters( 'bazaar_qodef_header_standard_parameters', $parameters );
		
		bazaar_qodef_get_module_template_part( 'templates/' . $this->slug, $this->moduleName . '/types/' . $this->slug, '', $parameters );
	}
	
	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}
	
	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = bazaar_qodef_get_page_id();
		$transparencyHeight = 0;
		
		$menu_background_color_meta        = get_post_meta( $id, 'qodef_menu_area_background_color_meta', true );
		$menu_background_transparency_meta = get_post_meta( $id, 'qodef_menu_area_background_transparency_meta', true );
		$menu_background_color             = bazaar_qodef_options()->getOptionValue( 'menu_area_background_color' );
		$menu_background_transparency      = bazaar_qodef_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_grid_background_color        = bazaar_qodef_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = bazaar_qodef_options()->getOptionValue( 'menu_area_grid_background_transparency' );
		
		if ( ! empty( $menu_background_color_meta ) ) {
			$menuAreaTransparent = ! empty( $menu_background_color_meta ) && $menu_background_transparency_meta !== '1';
		} elseif ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency !== '1';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency !== '1';
		}
		
		$sliderExists        = get_post_meta( $id, 'qodef_page_slider_meta', true ) !== '';
		$contentBehindHeader = get_post_meta( $id, 'qodef_page_content_behind_header_meta', true ) === 'yes';
		
		if ( $sliderExists || $contentBehindHeader || is_404() ) {
			$menuAreaTransparent = true;
		}
		
		if ( $menuAreaTransparent ) {
			$transparencyHeight = $this->menuAreaHeight;
			
			if ( ( $sliderExists && bazaar_qodef_is_top_bar_enabled() )
			     || bazaar_qodef_is_top_bar_enabled() && bazaar_qodef_is_top_bar_transparent()
			) {
				$transparencyHeight += bazaar_qodef_get_top_bar_height();
			}
		}
		
		return $transparencyHeight;
	}
	
	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$id                 = bazaar_qodef_get_page_id();
		$transparencyHeight = 0;
		
		$menu_background_color_meta        = get_post_meta( $id, 'qodef_menu_area_background_color_meta', true );
		$menu_background_transparency_meta = get_post_meta( $id, 'qodef_menu_area_background_transparency_meta', true );
		$menu_background_color             = bazaar_qodef_options()->getOptionValue( 'menu_area_background_color' );
		$menu_background_transparency      = bazaar_qodef_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_grid_background_color        = bazaar_qodef_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = bazaar_qodef_options()->getOptionValue( 'menu_area_grid_background_transparency' );
		
		if ( ! empty( $menu_background_color_meta ) ) {
			$menuAreaTransparent = ! empty( $menu_background_color_meta ) && $menu_background_transparency_meta === '0';
		} elseif ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency === '0';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency === '0';
		}
		
		if ( $menuAreaTransparent ) {
			$transparencyHeight = $this->menuAreaHeight;
		}
		
		return $transparencyHeight;
	}
	
	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->menuAreaHeight;
		if ( bazaar_qodef_is_top_bar_enabled() ) {
			$headerHeight += bazaar_qodef_get_top_bar_height();
		}
		
		return $headerHeight;
	}
	
	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;
		
		return $mobileHeaderHeight;
	}
	
	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables( $globalVariables ) {
		$globalVariables['qodefLogoAreaHeight']     = 0;
		$globalVariables['qodefMenuAreaHeight']     = $this->headerHeight;
		$globalVariables['qodefMobileHeaderHeight'] = $this->mobileHeaderHeight;
		
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
		//calculate transparency height only if header has no sticky behaviour
		$header_behavior = bazaar_qodef_get_meta_field_intersect( 'header_behaviour' );
		if ( ! in_array( $header_behavior, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			$perPageVars['qodefHeaderTransparencyHeight'] = $this->headerHeight - ( bazaar_qodef_get_top_bar_height() + $this->heightOfCompleteTransparency );
		} else {
			$perPageVars['qodefHeaderTransparencyHeight'] = 0;
		}

        $perPageVars['qodefHeaderVerticalWidth'] = 0;
		
		return $perPageVars;
	}
}