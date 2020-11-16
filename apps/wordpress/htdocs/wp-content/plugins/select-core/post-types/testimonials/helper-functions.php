<?php

if ( ! function_exists( 'qodef_core_testimonials_meta_box_functions' ) ) {
	function qodef_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'bazaar_qodef_meta_box_post_types_save', 'qodef_core_testimonials_meta_box_functions' );
	add_filter( 'bazaar_qodef_meta_box_post_types_remove', 'qodef_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'qodef_core_register_testimonials_cpt' ) ) {
	function qodef_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'QodeCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'qodef_core_filter_register_custom_post_types', 'qodef_core_register_testimonials_cpt' );
}