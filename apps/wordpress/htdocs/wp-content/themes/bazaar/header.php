<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * bazaar_qodef_header_meta hook
	 *
	 * @see bazaar_qodef_header_meta() - hooked with 10
	 * @see bazaar_qodef_user_scalable_meta - hooked with 10
	 * @see qodef_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'bazaar_qodef_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * bazaar_qodef_after_body_tag hook
	 *
	 * @see bazaar_qodef_get_side_area() - hooked with 10
	 * @see bazaar_qodef_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'bazaar_qodef_after_body_tag' ); ?>

    <div class="qodef-wrapper">
        <div class="qodef-wrapper-inner">
            <?php
            /**
             * bazaar_qodef_after_wrapper_inner hook
             *
             * @see bazaar_qodef_get_header() - hooked with 10
             * @see bazaar_qodef_get_mobile_header() - hooked with 10
             */
            do_action( 'bazaar_qodef_after_wrapper_inner' ); ?>
	
	        <?php
	        /**
	         * bazaar_qodef_after_header_area hook
	         *
	         * @see bazaar_qodef_back_to_top_button() - hooked with 10
	         * @see bazaar_qodef_get_full_screen_menu() - hooked with 10
	         */
	        do_action( 'bazaar_qodef_after_header_area' ); ?>
	        
            <div class="qodef-content" <?php bazaar_qodef_content_elem_style_attr(); ?>>
                <div class="qodef-content-inner">