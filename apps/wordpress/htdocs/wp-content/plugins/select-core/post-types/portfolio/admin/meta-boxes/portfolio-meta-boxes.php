<?php

if ( ! function_exists( 'qodef_core_map_portfolio_meta' ) ) {
	function qodef_core_map_portfolio_meta() {
		global $bazaar_qodef_Framework;
		
		$qode_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$qode_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$qodePortfolioImages = new BazaarQodefMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'select-core' ), '', '', 'portfolio_images' );
		$bazaar_qodef_Framework->qodeMetaBoxes->addMetaBox( 'portfolio_images', $qodePortfolioImages );
		
		$qodef_portfolio_image_gallery = new BazaarQodefMultipleImages( 'qodef-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'select-core' ), esc_html__( 'Choose your portfolio images', 'select-core' ) );
		$qodePortfolioImages->addChild( 'qodef-portfolio-image-gallery', $qodef_portfolio_image_gallery );
		
		//Portfolio Images/Videos 2
		
		$qodePortfolioImagesVideos2 = new BazaarQodefMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images/Videos (single upload)', 'select-core' ) );
		$bazaar_qodef_Framework->qodeMetaBoxes->addMetaBox( 'portfolio_images_videos2', $qodePortfolioImagesVideos2 );
		
		$qodef_portfolio_images_videos2 = new BazaarQodefImagesVideosFramework( '', '' );
		$qodePortfolioImagesVideos2->addChild( 'qode_portfolio_images_videos2', $qodef_portfolio_images_videos2 );
		
		//Portfolio Additional Sidebar Items
		
		$qodeAdditionalSidebarItems = bazaar_qodef_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'select-core' ),
				'name'  => 'portfolio_properties'
			)
		);
		
		$qode_portfolio_properties = bazaar_qodef_add_options_framework(
			array(
				'label'  => esc_html__( 'Portfolio Properties', 'select-core' ),
				'name'   => 'qode_portfolio_properties',
				'parent' => $qodeAdditionalSidebarItems
			)
		);
	}
	
	add_action( 'bazaar_qodef_meta_boxes_map', 'qodef_core_map_portfolio_meta', 40 );
}