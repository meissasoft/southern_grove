<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


if ( ! function_exists( 'agency_starter_default_settings' ) ) :

function agency_starter_default_settings($param){
	$values = array (
					 'background_color'=> '#fff', 
					 'page_background_color'=> '#fff', 
					 'woocommerce_menubar_color'=> '#fff', 
					 'woocommerce_menubar_text_color'=> '#333333', 
					 'link_color'=>  '#8e4403',
					 'main_text_color' => '#1a1a1a', 
					 'primary_color'=> '#1fb5ff',
					 'header_bg_color'=> '#fff',
					 'header_text_color'=> '#333333',
					 'footer_bg_color'=> '#047eb9',
					 'footer_text_color'=> '#fff',
					 'header_contact_social_bg_color'=> '#1fb5ff',
					 'footer_border' =>'1',
					 'hero_border' =>'1',
					 'header_layout' =>'1',
					 'heading_font' => 'Roboto', 
					 'body_font' => 'Google Sans'					 
					 );
					 
	return $values[$param];
}

endif;

/*
 * BEGIN ENQUEUE PARENT ACTION
 * AUTO GENERATED - Do not modify or remove comment markers above or below:
 */
 
/* Override parent theme help notice */



 
if ( !function_exists( 'business_space_locale_css' ) ):
    function business_space_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'business_space_locale_css' );

if ( !function_exists( 'business_space_parent_css' ) ):
    function business_space_parent_css() {
        wp_enqueue_style( 'business_space_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap','fontawesome' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'business_space_parent_css', 10 );


if ( class_exists( 'WP_Customize_Control' ) ) {

	require get_template_directory() .'/inc/color-picker/alpha-color-picker.php';
}


function business_space_wp_body_open(){
	do_action( 'wp_body_open' );
}

if ( ! function_exists( 'business_space_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 */
	function business_space_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

/**
 * @since 1.0.0
 * add home link.
 */
function business_space_nav_wrap() {
  $wrap  = '<ul id="%1$s" class="%2$s">';
  $wrap .= '<li class="hidden-xs"><a href="/"><i class="fa fa-home"></i></a></li>';
  $wrap .= '%3$s';
  $wrap .= '</ul>';
  return $wrap;
}


/* 
 * add customizer settings 
 */
add_action( 'customize_register', 'business_space_customize_register' );  
function business_space_customize_register( $wp_customize ) {

	
	
	//slider button link
		$wp_customize->add_setting( 'slider_button_link' , array(
		'default'    => "",
		'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control('slider_button_link' , array(
		'label' => __('Slider Button Link','business-space' ),
		'section' => 'slider_section',
		'priority' => 13,
		'type'=>'text',
		) );

	// banner image
	$wp_customize->add_setting( 'banner_image' , 
		array(
			'default' 		=> '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'banner_image' ,
		array(
			'label'          => __( 'Banner Image', 'business-space' ),
			'description'	=> __('Upload banner image', 'business-space'),
			'settings'  => 'banner_image',
			'section'        => 'theme_header',
		))
	);
	
	$wp_customize->add_setting('banner_link' , array(
		'default'    => '#',
		'sanitize_callback' => 'esc_url_raw',
	));
	
	
	$wp_customize->add_control('banner_link' , array(
		'label' => __('Banner Link', 'business-space' ),
		'section' => 'theme_header',
		'type'=> 'url',
	) );
	

	//breadcrumb 

	$wp_customize->add_section( 'breadcrumb_section' , array(
		'title'      => __( 'Header Breadcrumb', 'business-space' ),
		'priority'   => 3,
		'panel' => 'theme_options',
	) );


	$wp_customize->add_setting( 'breadcrumb_enable' , array(
		'default'    => false,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agency_starter_sanitize_checkbox',
	));

	$wp_customize->add_control('breadcrumb_enable' , array(
		'label' => __('Enable | Disable Breadcrumb','business-space' ),
		'section' => 'breadcrumb_section',
		'type'=> 'checkbox',
	));					
	
}

/**
 * @package twentysixteen
 * @subpackage business-space
 * Converts a HEX value to RGB.
 */
function business_space_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}


//load actions
require get_stylesheet_directory() .'/inc/actions.php';
//load post widgets
require get_stylesheet_directory() .'/inc/widget-search.php';



/**
 * Theme Breadcrumbs
*/
if( !function_exists('business_space_page_header_breadcrumbs') ):
	function business_space_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = home_url();
		$business_space_page_header_layout = get_theme_mod('business_space_page_header_layout', 'business_space_page_header_layout1');
		if($business_space_page_header_layout == 'business_space_page_header_layout1'):
			$breadcrumb_class = 'center-text';	
		else: $breadcrumb_class = 'text-right'; 
		endif;
		
		echo '<ul id="content" class="page-breadcrumb '.esc_attr( $breadcrumb_class ).'">';			
			if (is_home() || is_front_page()) :
					echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','business-space').'</a></li>';
					    echo '<li class="active">'; echo single_post_title(); echo '</li>';
						else:
						echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','business-space').'</a></li>';
						if ( is_category() ) {
							echo '<li class="active"><a href="'. esc_url( business_space_page_url() ) .'">' . esc_html__('Archive by category','business-space').' "' . single_cat_title('', false) . '"</a></li>';
						} elseif ( is_day() ) {
							echo '<li class="active"><a href="'. esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">'. esc_html(get_the_time('Y')) .'</a>';
							echo '<li class="active"><a href="'. esc_url(get_month_link(esc_attr(get_the_time('Y')),esc_attr(get_the_time('m')))) .'">'. esc_html(get_the_time('F')) .'</a>';
							echo '<li class="active"><a href="'. esc_url( business_space_page_url() ) .'">'. esc_html(get_the_time('d')) .'</a></li>';
						} elseif ( is_month() ) {
							echo '<li class="active"><a href="' . esc_url( get_year_link(esc_attr(get_the_time('Y'))) ) . '">' . esc_html(get_the_time('Y')) . '</a>';
							echo '<li class="active"><a href="'. esc_url( business_space_page_url() ) .'">'. esc_html(get_the_time('F')) .'</a></li>';
						} elseif ( is_year() ) {
							echo '<li class="active"><a href="'. esc_url( business_space_page_url() ) .'">'. esc_html(get_the_time('Y')) .'</a></li>';
                        } elseif ( is_single() && !is_attachment() && is_page('single-product') ) {
						if ( get_post_type() != 'post' ) {
							$cat = get_the_category(); 
							$cat = $cat[0];
							echo '<li>';
								echo esc_html( get_category_parents($cat, TRUE, '') );
							echo '</li>';
							echo '<li class="active"><a href="' . esc_url( business_space_page_url() ) . '">'. wp_title( '',false ) .'</a></li>';
						} }  
						elseif ( is_page() && $post->post_parent ) {
							$parent_id  = $post->post_parent;
							$breadcrumbs = array();
							while ($parent_id) {
							$page = get_page($parent_id);
							$breadcrumbs[] = '<li class="active"><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
							$parent_id  = $page->post_parent;
                            }
							$breadcrumbs = array_reverse($breadcrumbs);
							foreach ($breadcrumbs as $crumb) echo $crumb;
							echo '<li class="active"><a href="' . business_space_page_url() . '">'. get_the_title().'</a></li>';
                        }
						elseif( is_search() )
						{
							echo '<li class="active"><a href="' . esc_url( business_space_page_url() ) . '">'. get_search_query() .'</a></li>';
						}
						elseif( is_404() )
						{
							echo '<li class="active"><a href="' . esc_url( business_space_page_url() ) . '">'.esc_html__('Error 404','business-space').'</a></li>';
						}
						else { 
						    echo '<li class="active"><a href="' . esc_url( business_space_page_url() ) . '">'. esc_html( get_the_title() ) .'</a></li>';
						}
					endif;
			echo '</ul>';
        }
endif;


/**
 * Theme Breadcrumbs Url
*/
function business_space_page_url() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}
