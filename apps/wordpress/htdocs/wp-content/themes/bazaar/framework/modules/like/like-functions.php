<?php

if ( ! function_exists( 'bazaar_qodef_like' ) ) {
	/**
	 * Returns BazaarQodefLike instance
	 *
	 * @return BazaarQodefLike
	 */
	function bazaar_qodef_like() {
		return BazaarQodefLike::get_instance();
	}
}

function bazaar_qodef_get_like() {
	
	echo wp_kses( bazaar_qodef_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}