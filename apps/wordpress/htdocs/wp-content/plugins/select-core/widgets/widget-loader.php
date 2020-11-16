<?php

if ( ! function_exists( 'bazaar_qodef_register_widgets' ) ) {
	function bazaar_qodef_register_widgets() {
		$widgets = apply_filters( 'bazaar_qodef_register_widgets', $widgets = array() );

		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}

	add_action( 'widgets_init', 'bazaar_qodef_register_widgets' );
}