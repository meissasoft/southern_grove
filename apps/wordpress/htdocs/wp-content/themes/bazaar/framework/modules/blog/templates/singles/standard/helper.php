<?php

if( !function_exists('bazaar_qodef_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function bazaar_qodef_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'qodef-container';
        $params_list['inner'] = 'qodef-container-inner clearfix';

        return $params_list;
    }

    add_filter( 'bazaar_qodef_blog_holder_params', 'bazaar_qodef_get_blog_holder_params' );
}

if( !function_exists('bazaar_qodef_get_blog_single_holder_classes') ) {
    /**
     * Function that generates blog holder classes for single blog page
     */
    function bazaar_qodef_get_blog_single_holder_classes($classes) {
        $sidebar_classes   = array();
        $sidebar_classes[] = 'qodef-grid-large-gutter';
	
	    $classes = $classes . ' ' . implode(' ', $sidebar_classes);
	    
        return $classes;
    }

    add_filter( 'bazaar_qodef_blog_single_holder_classes', 'bazaar_qodef_get_blog_single_holder_classes' );
}

if( !function_exists('bazaar_qodef_blog_part_params') ) {
    function bazaar_qodef_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h3';
        $part_params['link_tag'] = 'h4';
        $part_params['quote_tag'] = 'h4';

        return array_merge($params, $part_params);
    }

    add_filter( 'bazaar_qodef_blog_part_params', 'bazaar_qodef_blog_part_params' );
}