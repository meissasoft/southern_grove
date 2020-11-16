<?php

if(!function_exists('bazaar_qodef_design_styles')) {
    /**
     * Generates general custom styles
     */
    function bazaar_qodef_design_styles() {
	    $font_family = bazaar_qodef_options()->getOptionValue( 'google_fonts' );
	    if ( ! empty( $font_family ) && bazaar_qodef_is_font_option_valid( $font_family ) ) {
		    $font_family_selector = array(
			    'body'
		    );
		    echo bazaar_qodef_dynamic_css( $font_family_selector, array( 'font-family' => bazaar_qodef_get_font_option_val( $font_family ) ) );
	    }

		$first_main_color = bazaar_qodef_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
                'h1',
                'h2',
                'h3',
                'h4',
                'h5',
                'a:hover',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'p a:hover',
                'a',
                'p a',
                'blockquote',
                '.qodef-comment-holder .qodef-comment-text .comment-edit-link',
                '.qodef-comment-holder .qodef-comment-text .comment-reply-link',
                '.qodef-comment-holder .qodef-comment-text .replay',
                '.qodef-comment-holder .qodef-comment-text .comment-edit-link:hover',
                '.qodef-comment-holder .qodef-comment-text .comment-reply-link:hover',
                '.qodef-comment-holder .qodef-comment-text .replay:hover',
                '.qodef-comment-holder .qodef-comment-text #cancel-comment-reply-link',
                '.qodef-comment-holder .qodef-comment-text #cancel-comment-reply-link:hover',
                '#respond input[type=text]:focus',
                '#respond textarea:focus',
                'input[type=text]:focus',
                'input[type=email]:focus',
                'input[type=password]:focus',
                '.qodef-owl-slider .owl-nav .owl-next',
                '.qodef-owl-slider .owl-nav .owl-prev',
                '.qodef-owl-slider .owl-nav .owl-next:hover',
                '.qodef-owl-slider .owl-nav .owl-prev:hover',
                '.qodef-404-page .qodef-page-not-found .qodef-404-subtitle',
                'footer .widget.widget_archive ul li a:hover',
                'footer .widget.widget_categories ul li a:hover',
                'footer .widget.widget_meta ul li a:hover',
                'footer .widget.widget_nav_menu ul li a:hover',
                'footer .widget.widget_pages ul li a:hover',
                'footer .widget.widget_recent_entries ul li a:hover',
                'footer .widget.qodef-search-post-type-widget .qodef-post-type-search-results ul li a:hover',
                'footer .qodef-footer-bottom-holder .widget.widget_nav_menu ul li a:hover',
                '.qodef-side-menu .widget .qodef-widget-title-holder .qodef-widget-title',
                '.qodef-side-menu .widget ul li a:hover',
                '.qodef-side-menu .widget.widget_archive ul li a:hover',
                '.qodef-side-menu .widget.widget_categories ul li a:hover',
                '.qodef-side-menu .widget.widget_meta ul li a:hover',
                '.qodef-side-menu .widget.widget_nav_menu ul li a:hover',
                '.qodef-side-menu .widget.widget_pages ul li a:hover',
                '.qodef-side-menu .widget.widget_recent_entries ul li a:hover',
                '.qodef-side-menu .widget #wp-calendar tfoot a:hover',
                '.qodef-side-menu .widget.widget_search .input-holder button:hover',
                '.qodef-side-menu .widget.qodef-search-post-type-widget .qodef-post-type-search-results ul li a:hover',
                '.qodef-side-menu .widget.widget_tag_cloud a:hover',
                '.qodef-side-menu .widget.widget_text a:hover',
                '.wpb_widgetised_column .widget ul li a',
                '.wpb_widgetised_column .widget ul li a:hover',
                'aside.qodef-sidebar .widget ul li a',
                'aside.qodef-sidebar .widget ul li a:hover',
                '.wpb_widgetised_column .widget .qodef-widget-title-holder .qodef-widget-title',
                'aside.qodef-sidebar .widget .qodef-widget-title-holder .qodef-widget-title',
                '.wpb_widgetised_column .widget.widget_archive ul li a:hover',
                '.wpb_widgetised_column .widget.widget_categories ul li a:hover',
                '.wpb_widgetised_column .widget.widget_meta ul li a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul li a:hover',
                '.wpb_widgetised_column .widget.widget_pages ul li a:hover',
                '.wpb_widgetised_column .widget.widget_recent_entries ul li a:hover',
                'aside.qodef-sidebar .widget.widget_archive ul li a:hover',
                'aside.qodef-sidebar .widget.widget_categories ul li a:hover',
                'aside.qodef-sidebar .widget.widget_meta ul li a:hover',
                'aside.qodef-sidebar .widget.widget_nav_menu ul li a:hover',
                'aside.qodef-sidebar .widget.widget_pages ul li a:hover',
                'aside.qodef-sidebar .widget.widget_recent_entries ul li a:hover',
                '.wpb_widgetised_column .widget #wp-calendar tfoot a',
                '.wpb_widgetised_column .widget #wp-calendar tfoot a:hover',
                'aside.qodef-sidebar .widget #wp-calendar tfoot a',
                'aside.qodef-sidebar .widget #wp-calendar tfoot a:hover',
                '.wpb_widgetised_column .widget.widget_search .input-holder button:hover',
                'aside.qodef-sidebar .widget.widget_search .input-holder button:hover',
                '.wpb_widgetised_column .widget.qodef-search-post-type-widget .qodef-post-type-search-results ul li a:hover',
                'aside.qodef-sidebar .widget.qodef-search-post-type-widget .qodef-post-type-search-results ul li a:hover',
                '.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
                'aside.qodef-sidebar .widget.widget_tag_cloud a:hover',
                '.wpb_widgetised_column .widget.widget_text a:hover',
                'aside.qodef-sidebar .widget.widget_text a:hover',
                '.widget .qodef-widget-title-holder .qodef-widget-title',
                '.widget ul li a',
                '.widget ul li a:hover',
                '.widget.widget_archive ul li a:hover',
                '.widget.widget_categories ul li a:hover',
                '.widget.widget_meta ul li a:hover',
                '.widget.widget_nav_menu ul li a:hover',
                '.widget.widget_pages ul li a:hover',
                '.widget.widget_recent_entries ul li a:hover',
                '.widget #wp-calendar tfoot a',
                '.widget #wp-calendar tfoot a:hover',
                '.widget.widget_search .input-holder button:hover',
                '.widget.qodef-search-post-type-widget .qodef-post-type-search-results ul li a:hover',
                '.widget.widget_tag_cloud a:hover',
                '.widget.widget_text a:hover',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-standard li .qodef-tweet-text a',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-standard li .qodef-tweet-text a:hover',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-standard li .qodef-tweet-text span',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-slider li .qodef-twitter-icon i',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-slider li .qodef-tweet-text a',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-slider li .qodef-tweet-text a:hover',
                '.widget.widget_qodef_twitter_widget .qodef-twitter-widget.qodef-twitter-slider li .qodef-tweet-text span',
                'body .pp_pic_holder #pp_full_res .pp_inline',
                'body .pp_pic_holder a.pp_arrow_next:hover',
                'body .pp_pic_holder a.pp_arrow_previous:hover',
                'body .pp_pic_holder a.pp_next',
                'body .pp_pic_holder a.pp_previous',
                'body .pp_pic_holder a.pp_close:hover',
                '.qodef-blog-holder article.sticky .qodef-post-title a',
                '.qodef-main-menu .menu-item-language .submenu-languages a:hover',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-top>div a:hover',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-bottom .qodef-post-info-bottom-left>div.qodef-post-info-category a:hover',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-bottom .qodef-post-info-author a:hover',
                '.qodef-blog-holder.qodef-blog-standard article .qodef-post-info-bottom .qodef-post-info-comments-holder:hover span:first-child',
                '.qodef-blog-holder.qodef-blog-standard article.format-link .qodef-post-mark .qodef-link-mark',
                '.qodef-author-description .qodef-author-description-text-holder .qodef-author-name a',
                '.qodef-author-description .qodef-author-description-text-holder .qodef-author-name a:hover',
                '.qodef-author-description .qodef-author-description-text-holder .qodef-author-social-icons a',
                '.qodef-author-description .qodef-author-description-text-holder .qodef-author-social-icons a:hover',
                '.qodef-bl-standard-pagination ul li.qodef-bl-pag-active a',
                '.qodef-blog-pagination ul li a.qodef-pag-active',
                '.qodef-blog-pag-loading',
                '.qodef-blog-single-navigation .qodef-blog-single-next:hover',
                '.qodef-blog-single-navigation .qodef-blog-single-prev:hover',
                '.qodef-blog-list-holder .qodef-bli-info>div a:hover',
                '.qodef-blog-list-holder .qodef-post-read-more-button a',
                '.qodef-blog-list-holder.qodef-bl-minimal .qodef-post-info-date a:hover',
                '.qodef-blog-holder.qodef-blog-single article .qodef-post-info-top>div a:hover',
                '.qodef-blog-holder.qodef-blog-single article.format-link .qodef-post-text-main .qodef-post-mark .qodef-link-mark',
                '.qodef-main-menu ul li a:hover',
                '.qodef-main-menu>ul>li.qodef-active-item>a',
                '.qodef-main-menu>ul>li:hover>a',
                '.qodef-main-menu>ul>li>a',
                '.qodef-drop-down .second .inner ul li.current-menu-ancestor>a',
                '.qodef-drop-down .second .inner ul li.current-menu-item>a',
                '.qodef-drop-down .wide .second .inner>ul>li>a',
                '.qodef-drop-down .wide .second .inner>ul>li.current-menu-ancestor>a',
                '.qodef-drop-down .wide .second .inner>ul>li.current-menu-item>a',
                '.qodef-header-bottom .qodef-fullscreen-menu ul li a:hover',
                '.qodef-header-bottom .qodef-fullscreen-menu>ul>li.qodef-active-item>a',
                '.qodef-header-bottom .qodef-fullscreen-menu>ul>li>a',
                'nav.qodef-fullscreen-menu>ul>li>a',
                'nav.qodef-fullscreen-menu>ul>li.qodef-active-item>a',
                '.qodef-header-vertical-sliding .qodef-vertical-menu-opener a',
                '.qodef-header-vertical-sliding .qodef-fullscreen-menu>ul:not(.sub_menu)>li.qodef-active-item>a',
                '.qodef-header-vertical-sliding .qodef-fullscreen-menu ul>li>a:hover',
                '.qodef-header-vertical-sliding .qodef-fullscreen-menu>ul>li>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li a:hover',
                '.qodef-header-vertical .qodef-vertical-menu ul li a .qodef-menu-featured-icon',
                '.qodef-header-vertical .qodef-vertical-menu ul li.current-menu-ancestor>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li.current-menu-item>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li.current_page_item>a',
                '.qodef-header-vertical .qodef-vertical-menu ul li.qodef-active-item>a',
                '.qodef-header-vertical .qodef-vertical-menu>ul>li>a',
                '.qodef-mobile-header .qodef-mobile-menu-opener.qodef-mobile-menu-opened a',
                '.qodef-mobile-header .qodef-mobile-nav ul li a:hover',
                '.qodef-mobile-header .qodef-mobile-nav ul li h5:hover',
                '.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-ancestor>a',
                '.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-item>a',
                '.qodef-mobile-header .qodef-mobile-nav ul li a',
                '.qodef-mobile-header .qodef-mobile-nav ul li h5',
                '.qodef-mobile-header .qodef-mobile-nav .qodef-grid>ul>li.qodef-active-item>a',
                '.qodef-search-page-holder .qodef-search-page-form .qodef-form-holder .qodef-search-submit:hover',
                '.qodef-search-page-holder article.sticky .qodef-post-title a',
                '.qodef-fullscreen-search-holder .qodef-search-field',
                '.qodef-fullscreen-search-holder .qodef-search-submit',
                '.qodef-fullscreen-search-holder .qodef-search-submit:hover',
                '.qodef-fullscreen-search-holder .qodef-fullscreen-search-close',
                '.qodef-fullscreen-search-holder .qodef-fullscreen-search-close:hover',
                '.qodef-side-menu-button-opener.opened',
                '.qodef-side-menu-button-opener:hover',
                '.qodef-side-menu a.qodef-close-side-menu',
                '.qodef-title-holder.qodef-breadcrumbs-type .qodef-breadcrumbs a:hover',
                '.qodef-title-holder.qodef-standard-with-breadcrumbs-type .qodef-breadcrumbs a:hover',
                '.qodef-pl-filter-holder ul li span',
                '.qodef-pl-filter-holder ul li.qodef-pl-current span',
                '.qodef-pl-filter-holder ul li:hover span',
                '.qodef-pl-standard-pagination ul li.qodef-pl-pag-active a',
                '.qodef-pl-loading',
                '.qodef-portfolio-slider-holder .owl-nav .owl-next:hover .qodef-next-icon',
                '.qodef-portfolio-slider-holder .owl-nav .owl-next:hover .qodef-prev-icon',
                '.qodef-portfolio-slider-holder .owl-nav .owl-prev:hover .qodef-next-icon',
                '.qodef-portfolio-slider-holder .owl-nav .owl-prev:hover .qodef-prev-icon',
                '.qodef-portfolio-slider-holder .owl-nav .qodef-next-icon',
                '.qodef-portfolio-slider-holder .owl-nav .qodef-prev-icon',
                '.qodef-portfolio-list-holder.qodef-pl-gallery-overlay article .qodef-pli-text .qodef-pli-category-holder a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-gallery-layout .qodef-ps-content-holder .qodef-ps-info-holder .qodef-ps-info-item a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-gallery-layout .qodef-ps-social-info-holder .qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-gallery-layout .qodef-ps-social-info-holder .qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-portfolio-single-likes a span',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-ps-content-item .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-ps-info-item.qodef-ps-custom-field .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-ps-info-item.qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-ps-info-item.qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-huge-images-layout .qodef-ps-like a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-images-layout .qodef-ps-content-holder .qodef-ps-info-holder .qodef-ps-info-item a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-images-layout .qodef-ps-social-info-holder .qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-images-layout .qodef-ps-social-info-holder .qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-masonry-layout .qodef-ps-content-holder .qodef-ps-info-holder .qodef-ps-info-item a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-masonry-layout .qodef-ps-social-info-holder .qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-masonry-layout .qodef-ps-social-info-holder .qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-slider-layout .qodef-ps-content-holder .qodef-ps-info-holder .qodef-ps-info-item a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-slider-layout .qodef-ps-social-info-holder .qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-slider-layout .qodef-ps-social-info-holder .qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-small-gallery-layout .qodef-portfolio-single-likes a span',
                '.qodef-portfolio-single-holder.qodef-ps-small-gallery-layout .qodef-ps-content-item .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-gallery-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-gallery-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-gallery-layout .qodef-ps-info-item.qodef-ps-custom-field .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-gallery-layout .qodef-ps-info-item.qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-gallery-layout .qodef-ps-info-item.qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-portfolio-single-likes a span',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-ps-content-item .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-ps-info-item.qodef-ps-custom-field .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-ps-info-item.qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-ps-info-item.qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-small-images-layout .qodef-ps-like a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-masonry-layout .qodef-ps-content-item .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-masonry-layout .qodef-portfolio-single-likes a span',
                '.qodef-portfolio-single-holder.qodef-ps-small-masonry-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-masonry-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-masonry-layout .qodef-ps-info-item.qodef-ps-custom-field .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-masonry-layout .qodef-ps-info-item.qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-masonry-layout .qodef-ps-info-item.qodef-ps-social-share:before',
                '.qodef-portfolio-single-holder.qodef-ps-small-slider-layout .qodef-portfolio-single-likes a span',
                '.qodef-portfolio-single-holder.qodef-ps-small-slider-layout .qodef-ps-content-item .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-slider-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-slider-layout .qodef-ps-info-item:not(.qodef-ps-content-title):not(.qodef-ps-content-item) a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-slider-layout .qodef-ps-info-item.qodef-ps-custom-field .qodef-ps-info-title',
                '.qodef-portfolio-single-holder.qodef-ps-small-slider-layout .qodef-ps-info-item.qodef-ps-social-share a:hover',
                '.qodef-portfolio-single-holder.qodef-ps-small-slider-layout .qodef-ps-info-item.qodef-ps-social-share:before',
                '.qodef-ps-navigation .qodef-ps-back-btn a:hover span',
                '.qodef-accordion-holder span.qodef-accordion-title',
                '.qodef-accordion-holder.qodef-ac-boxed.qodef-white-skin .qodef-accordion-title.ui-state-active',
                '.qodef-accordion-holder.qodef-ac-boxed.qodef-white-skin .qodef-accordion-title.ui-state-default.ui-state-hover',
                '.qodef-banner-holder .qodef-banner-link-text .qodef-banner-link-hover span',
                '.qodef-btn.qodef-btn-outline',
                '.qodef-countdown .countdown-row .countdown-section .countdown-amount',
                '.qodef-countdown.qodef-dark-skin .countdown-row .countdown-section .countdown-amount',
                '.qodef-counter-holder .qodef-counter',
                '.qodef-counter-holder .qodef-counter-title',
                '.qodef-full-screen-sections .qodef-fss-nav-holder a',
                '.qodef-dark-header .qodef-full-screen-sections .qodef-fss-nav-holder a',
                '.qodef-icon-list-holder .qodef-il-icon-holder>*',
                '.qodef-pie-chart-holder .qodef-pc-percentage .qodef-pc-percent',
                '.qodef-price-table .qodef-pt-inner ul li.qodef-pt-prices .qodef-pt-value',
                '.qodef-price-table .qodef-pt-inner ul li.qodef-pt-prices .qodef-pt-price',
                '.qodef-price-table .qodef-pt-inner ul li.qodef-pt-content ul li:before',
                '.qodef-price-table .qodef-pt-inner ul li.qodef-pt-button a',
                '.qodef-social-share-holder.qodef-dropdown .qodef-social-share-dropdown-opener .social_share',
                '.qodef-social-share-holder.qodef-dropdown .qodef-social-share-dropdown-opener:hover',
                '.qodef-tabs.qodef-tabs-standard .qodef-tabs-nav li a',
                '.qodef-tabs.qodef-tabs-boxed .qodef-tabs-nav li a',
                '.qodef-tabs.qodef-tabs-simple .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs.qodef-tabs-simple .qodef-tabs-nav li.ui-state-hover a',
                '.qodef-tabs.qodef-tabs-vertical .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs.qodef-tabs-vertical .qodef-tabs-nav li.ui-state-hover a',
                '.qodef-team .qodef-team-social-wrapp .qodef-icon-shortcode',
                '.qodef-video-button-holder .qodef-video-button-play',
            );

            $woo_color_selector = array();
            if(bazaar_qodef_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.qodef-woocommerce-page.woocommerce-cart .woocommerce>form table.cart tr.cart_item td.product-remove a',
                    '.qodef-woocommerce-page.woocommerce-cart .woocommerce>form table.cart tr.cart_item td.product-remove a:hover',
                    '.qodef-woocommerce-page.woocommerce-cart .woocommerce>form table.cart td.actions button[type=submit]',
                    '.qodef-woocommerce-page.woocommerce-cart .woocommerce>form table.cart td.actions input[type=submit]',
                    '.qodef-woocommerce-page.woocommerce-cart .cart-collaterals table th',
                    '.qodef-woocommerce-page.woocommerce-cart .cart-collaterals tr.order-total td',
                    '.qodef-woocommerce-page .woocommerce-checkout table th',
                    '.qodef-woocommerce-page.woocommerce-order-received .woocommerce ul.order_details li strong',
                    '.woocommerce-page .qodef-content label',
                    'div.woocommerce label',
                    '.woocommerce .qodef-new-product',
                    '.qodef-woocommerce-page .woocommerce-error>a:hover',
                    '.qodef-woocommerce-page .woocommerce-info>a:hover',
                    '.qodef-woocommerce-page .woocommerce-message>a:hover',
                    '.qodef-woocommerce-page .woocommerce-info .showcoupon:hover',
                    '.woocommerce-pagination .page-numbers li a.current',
                    '.woocommerce-pagination .page-numbers li a:hover',
                    '.woocommerce-pagination .page-numbers li span.current',
                    '.woocommerce-pagination .page-numbers li span:hover',
                    '.qodef-woo-view-all-pagination a:hover',
                    '.qodef-woocommerce-page .select2-container--default.select2-container--open .select2-selection--single',
                    '.woocommerce-page .qodef-content .qodef-quantity-buttons .qodef-quantity-minus:hover',
                    '.woocommerce-page .qodef-content .qodef-quantity-buttons .qodef-quantity-plus:hover',
                    'div.woocommerce .qodef-quantity-buttons .qodef-quantity-minus:hover',
                    'div.woocommerce .qodef-quantity-buttons .qodef-quantity-plus:hover',
                    '.qodef-woocommerce-page .select2-container--default .select2-results__option[aria-disabled=true]',
                    '.qodef-woocommerce-page .select2-container--default .select2-results__option[aria-selected=true]',
                    '.qodef-woocommerce-page .select2-container--default .select2-results__option--highlighted[aria-selected]',
                    '.woocommerce .star-rating',
                    '.qodef-woocommerce-page .qodef-content .variations .reset_variations',
                    '.qodef-woocommerce-page .qodef-content .product-type-grouped table.group_table a:hover',
                    '.qodef-woocommerce-page.woocommerce-account .qodef-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li.is-active a',
                    '.qodef-woocommerce-page.woocommerce-account .qodef-woocommerce-account-navigation .woocommerce-MyAccount-navigation ul li:hover a',
                    '.qodef-woocommerce-page.woocommerce-account .woocommerce form.edit-account fieldset>legend',
                    '.qodef-woocommerce-page.woocommerce-account .woocommerce table.shop_table th',
                    '.qodef-woocommerce-page.woocommerce-account .vc_row .woocommerce form.login p label:not(.inline)',
                    '.qodef-content .woocommerce.add_to_cart_inline del',
                    '.qodef-content .woocommerce.add_to_cart_inline ins',
                    'div.woocommerce>.single-product .woocommerce-tabs table th',
                    '.qodef-woo-single-page .qodef-single-product-summary .price',
                    '.qodef-woo-single-page .qodef-single-product-summary .qodef-single-product-share-wish .qodef-woo-social-share-holder>span',
                    '.qodef-woo-single-page .qodef-single-product-summary .product_meta>span a:hover',
                    '.qodef-woo-single-page .qodef-single-product-summary p.stock.in-stock',
                    '.qodef-woo-single-page .qodef-single-product-summary p.stock.out-of-stock',
                    '.qodef-woo-single-page .woocommerce-tabs ul.tabs>li>a',
                    '.qodef-woo-single-page .woocommerce-tabs #reviews ol.commentlist .comment_container .comment-text .woocommerce-review__author',
                    '.qodef-woo-single-page .woocommerce-tabs #reviews .comment-respond .comment-reply-title',
                    '.qodef-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a:before',
                    '.qodef-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a.active:after',
                    '.qodef-shopping-cart-dropdown .qodef-item-info-holder .remove',
                    '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-subtotal-holder>*',
                    '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-view-cart',
                    '.widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content .total>*',
                    '.widget.woocommerce.widget_layered_nav .qodef-widget-title-holder h5.qodef-widget-title',
                    '.widget.woocommerce.widget_layered_nav ul li.chosen a',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .price_slider_amount button',
                    '.widget.woocommerce.widget_products ul li .amount',
                    '.widget.woocommerce.widget_recently_viewed_products ul li .amount',
                    '.widget.woocommerce.widget_top_rated_products ul li .amount',
                    '.widget.woocommerce.widget_product_search .woocommerce-product-search button:hover',
                    '.qodef-product-detail .qodef-pd-text-holder .qodef-pd-price',
                    '.qodef-product-info .qodef-pi-text-holder .qodef-btn',
                    '.qodef-pla-holder .qodef-pla-text-wrapper .qodef-pla-rating',
                    '.qodef-plcs-holder .qodef-owl-slider .owl-nav .owl-next:hover>span',
                    '.qodef-plcs-holder .qodef-owl-slider .owl-nav .owl-prev:hover>span',
                    '.qodef-plc-holder .qodef-owl-slider .owl-nav .owl-next:hover>span',
                    '.qodef-plc-holder .qodef-owl-slider .owl-nav .owl-prev:hover>span',
                    '.qodef-pl-holder .qodef-prl-loading .qodef-prl-loading-msg',
                    '.qodef-pl-holder .qodef-pl-categories ul li a',
                    '.qodef-pl-holder .qodef-pl-categories ul li a.active',
                    '.qodef-pl-holder .qodef-pl-categories ul li a:hover',
                    '.qodef-pl-holder .qodef-pl-ordering-outer .qodef-pl-ordering div h5',
                    '.qodef-pl-holder .qodef-pl-ordering-outer .qodef-pl-ordering div ul li a.active',
                    '.qodef-pl-holder .qodef-pl-ordering-outer .qodef-pl-ordering div ul li a:hover',
                    '.qodef-pl-holder .qodef-pli .qodef-pli-rating',
                    '.qodef-pl-holder .qodef-pli-inner .qodef-pli-image .qodef-pli-new-product',
                    '.qodef-pl-holder.qodef-info-below-image .qodef-pli .qodef-pli-text-wrapper .qodef-pli-add-to-cart a:hover',
                    '.qodef-pl-holder.qodef-info-on-image.qodef-product-info-light .qodef-pli-text .qodef-pli-text-inner .entry-title',
                    '.qodef-pp-holder .qodef-ppi .qodef-ppi-inner .qodef-ppi-text-wrapper .qodef-qodef-big-product-add-to-cart a:hover',
                    '.qodef-pp-holder .qodef-ppi .qodef-ppi-inner .qodef-ppi-text-wrapper .qodef-qodef-small-product-add-to-cart a:hover',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .variations .reset_variations',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .variations .reset_variations',
                    '#yith-quick-view-modal #yith-quick-view-content .summary table.group_table a:hover',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary table.group_table a:hover',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .price',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .price',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .qodef-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .qodef-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .qodef-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .qodef-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .qodef-single-product-share-wish .qodef-woo-social-share-holder>span',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .qodef-single-product-share-wish .qodef-woo-social-share-holder>span',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:after',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:after',
                    '#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:after',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:after',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:after',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:after',
                    '#yith-quick-view-modal #yith-quick-view-content .summary p.stock.in-stock',
                    '#yith-quick-view-modal #yith-quick-view-content .summary p.stock.out-of-stock',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.in-stock',
                    '.yith-quick-view.yith-modal #yith-quick-view-content .summary p.stock.out-of-stock',
                    '#yith-quick-view-modal #yith-quick-view-close',
                    '.yith-quick-view.yith-modal #yith-quick-view-close',
                    '#yith-wcwl-popup-message #yith-wcwl-message',
                    '.woocommerce-wishlist .woocommerce-error>a:hover',
                    '.woocommerce-wishlist .woocommerce-info>a:hover',
                    '.woocommerce-wishlist .woocommerce-message>a:hover',
                    '.woocommerce-wishlist table.wishlist_table tbody tr td.product-remove a',
                    '.woocommerce-wishlist table.wishlist_table tbody tr td.product-remove a:hover',
                    '.woocommerce-wishlist table.wishlist_table tbody tr td.product-add-to-cart a',
                    '.qodef-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:after',
                    '.qodef-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:after',
                    '.qodef-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:after',
                    '.qodef-wishlist-widget-holder a',
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

	        $color_important_selector = array(
                '.qodef-header-bottom .qodef-vertical-area-widget-holder .qodef-social-icon-widget-holder:hover',
                '.qodef-btn.qodef-btn-simple:not(.qodef-btn-custom-hover-color):hover',
	        );

            $background_color_selector = array(
                '.qodef-st-loader .pulse',
                '.qodef-st-loader .double_pulse .double-bounce1',
                '.qodef-st-loader .double_pulse .double-bounce2',
                '.qodef-st-loader .cube',
                '.qodef-st-loader .rotating_cubes .cube1',
                '.qodef-st-loader .rotating_cubes .cube2',
                '.qodef-st-loader .stripes>div',
                '.qodef-st-loader .wave>div',
                '.qodef-st-loader .two_rotating_circles .dot1',
                '.qodef-st-loader .two_rotating_circles .dot2',
                '.qodef-st-loader .five_rotating_circles .container1>div',
                '.qodef-st-loader .five_rotating_circles .container2>div',
                '.qodef-st-loader .five_rotating_circles .container3>div',
                '.qodef-st-loader .atom .ball-1:before',
                '.qodef-st-loader .atom .ball-2:before',
                '.qodef-st-loader .atom .ball-3:before',
                '.qodef-st-loader .atom .ball-4:before',
                '.qodef-st-loader .clock .ball:before',
                '.qodef-st-loader .mitosis .ball',
                '.qodef-st-loader .lines .line1',
                '.qodef-st-loader .lines .line2',
                '.qodef-st-loader .lines .line3',
                '.qodef-st-loader .lines .line4',
                '.qodef-st-loader .fussion .ball',
                '.qodef-st-loader .fussion .ball-1',
                '.qodef-st-loader .fussion .ball-2',
                '.qodef-st-loader .fussion .ball-3',
                '.qodef-st-loader .fussion .ball-4',
                '.qodef-st-loader .wave_circles .ball',
                '.qodef-st-loader .pulse_circles .ball',
                '#submit_comment',
                '.post-password-form input[type=submit]',
                'input.wpcf7-form-control.wpcf7-submit',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.qodef-owl-slider .owl-dots .owl-dot.active span',
                '.qodef-owl-slider .owl-dots .owl-dot:hover span',
                'body .pp_overlay',
                '.qodef-page-footer .widget_icl_lang_sel_widget #lang_sel ul ul',
                '.qodef-page-footer .widget_icl_lang_sel_widget #lang_sel_click ul ul',
                '.qodef-top-bar .widget_icl_lang_sel_widget #lang_sel ul ul',
                '.qodef-top-bar .widget_icl_lang_sel_widget #lang_sel_click ul ul',
                '.qodef-blog-holder article.format-audio .qodef-blog-audio-holder .mejs-container',
                '.qodef-blog-holder article.format-audio .qodef-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
                '.qodef-blog-holder article.format-audio .qodef-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.qodef-blog-pag-loading>div',
                '.qodef-bl-loading>div',
                '.qodef-page-footer .qodef-footer-top-holder',
                '.qodef-top-bar-background',
                '.qodef-top-bar',
                '.qodef-pl-loading>div',
                '.qodef-portfolio-slider-holder .owl-dots .owl-dot.active span',
                '.qodef-portfolio-slider-holder .owl-dots .owl-dot:hover span',
                '.qodef-accordion-holder.qodef-ac-boxed .qodef-accordion-title.ui-state-active',
                '.qodef-accordion-holder.qodef-ac-boxed .qodef-accordion-title.ui-state-hover',
                '.qodef-btn.qodef-btn-solid',
                '.qodef-dropcaps.qodef-circle',
                '.qodef-dropcaps.qodef-square',
                '.qodef-dark-header #fp-nav ul li a.active span',
                '.qodef-dark-header #fp-nav ul li a:hover span',
                '.qodef-icon-shortcode.qodef-circle',
                '.qodef-icon-shortcode.qodef-dropcaps.qodef-circle',
                '.qodef-icon-shortcode.qodef-square',
                '.qodef-image-with-text-holder.qodef-iwt-text-over-image .qodef-iwt-text-holder .qodef-iwt-title:after',
                '.qodef-price-table.dark-skin .qodef-pt-inner',
                '.qodef-progress-bar .qodef-pb-content-holder .qodef-pb-content',
                '.qodef-tabs.qodef-tabs-standard .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs.qodef-tabs-boxed .qodef-tabs-nav li.ui-state-active a',
                '.qodef-tabs.qodef-tabs-boxed .qodef-tabs-nav li.ui-state-hover a',
            );

            $woo_background_color_selector = array();
            if(bazaar_qodef_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.woocommerce-page .qodef-content .wc-forward:not(.added_to_cart):not(.checkout-button)',
                    '.woocommerce-page .qodef-content a.added_to_cart',
                    '.woocommerce-page .qodef-content a.button',
                    '.woocommerce-page .qodef-content button[type=submit]:not(.qodef-woo-search-widget-button)',
                    '.woocommerce-page .qodef-content input[type=submit]',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button)',
                    'div.woocommerce a.added_to_cart',
                    'div.woocommerce a.button',
                    'div.woocommerce button[type=submit]:not(.qodef-woo-search-widget-button)',
                    'div.woocommerce input[type=submit]',
                    '.woocommerce .qodef-new-product',
                    '.woocommerce .qodef-onsale',
                    '.woocommerce .qodef-out-of-stock',
                    '.qodef-woocommerce-page .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice',
                    '.qodef-woo-single-page .woocommerce-tabs ul.tabs>li.active a',
                    '.qodef-woo-single-page .woocommerce-tabs ul.tabs>li.active a:after',
                    '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-view-cart',
                    '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-view-checkout',
                    '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-view-cart:hover',
                    '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-view-checkout:hover',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
                    '.qodef-pla-holder .qodef-pla-inner .qodef-pla-image .qodef-pla-new-product',
                    '.qodef-pla-holder .qodef-pla-inner .qodef-pla-image .qodef-pla-onsale',
                    '.qodef-pla-holder .qodef-pla-inner .qodef-pla-image .qodef-pla-out-of-stock',
                    '.qodef-pl-holder .qodef-pli-inner .qodef-pli-image .qodef-pli-new-product',
                    '.qodef-pl-holder .qodef-pli-inner .qodef-pli-image .qodef-pli-onsale',
                    '.qodef-pl-holder .qodef-pli-inner .qodef-pli-image .qodef-pli-out-of-stock',
                    '.qodef-pp-holder .qodef-ppi .qodef-ppi-inner .qodef-ppi-text .qodef-ppi-text-inner .qodef-yith-wcqv-holder a',
                    '.qodef-pl-holder .qodef-pli-inner .qodef-pli-text-inner .qodef-yith-wcqv-holder .yith-wcqv-button',
                    '.qodef-plc-holder .qodef-plc-item .qodef-plc-text-inner .qodef-yith-wcqv-holder .yith-wcqv-button',
                    'ul.products>.product .qodef-pl-inner .qodef-pl-text-inner .qodef-yith-wcqv-holder .yith-wcqv-button',
                );
            }

            $background_color_important_selector = array(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-bg):hover',
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-hover-bg):hover',
            );

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $border_color_selector = array(
                '.qodef-st-loader .pulse_circles .ball',
                '.qodef-owl-slider .owl-dots .owl-dot.active span',
                '.qodef-owl-slider .owl-dots .owl-dot:hover span',
                '.qodef-portfolio-slider-holder .owl-dots .owl-dot.active span',
                '.qodef-portfolio-slider-holder .owl-dots .owl-dot:hover span',
                '.qodef-accordion-holder.qodef-ac-boxed .qodef-accordion-title.ui-state-active',
                '.qodef-btn.qodef-btn-outline',
                '.qodef-tabs.qodef-tabs-standard .qodef-tabs-nav li.ui-state-active a',
                '.qodef-woocommerce-page .select2-container--default .select2-search--dropdown .select2-search__field:focus',
                '.qodef-shopping-cart-dropdown .qodef-cart-bottom .qodef-view-cart',
            );

            $border_top_color_selector = array(
                '.qodef-blog-holder article.format-audio .qodef-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-float .mejs-time-float-corner'
            );

            $border_bottom_color_selector = array(
                '.qodef-price-table .qodef-pt-inner ul li.qodef-pt-separator .qodef-separator',
                '.qodef-section-title-holder .qodef-separator'
            );

            $border_color_important_selector = array(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-border-hover):hover',
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-border-hover):hover',
            );

            echo bazaar_qodef_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo bazaar_qodef_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo bazaar_qodef_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
            echo bazaar_qodef_dynamic_css($background_color_important_selector, array('background-color' => $first_main_color . '!important'));
            echo bazaar_qodef_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
            echo bazaar_qodef_dynamic_css($border_top_color_selector, array('border-top-color' => $first_main_color));
            echo bazaar_qodef_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => $first_main_color));
            echo bazaar_qodef_dynamic_css($border_color_important_selector, array('border-color' => $first_main_color. '!important'));
        }

        $page_background_color = bazaar_qodef_options()->getOptionValue( 'page_background_color' );
	    if ( ! empty( $page_background_color ) ) {
		    $background_color_selector = array(
                'body',
                '.qodef-content',
                '.qodef-container'
		    );
		    echo bazaar_qodef_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
	    }
	
	    $selection_color = bazaar_qodef_options()->getOptionValue( 'selection_color' );
	    if ( ! empty( $selection_color ) ) {
		    echo bazaar_qodef_dynamic_css( '::selection', array( 'background' => $selection_color ) );
		    echo bazaar_qodef_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
	    }
	
	    $preload_background_styles = array();
	
	    if ( bazaar_qodef_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
		    $preload_background_styles['background-image'] = 'url(' . bazaar_qodef_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
	    }
	
	    echo bazaar_qodef_dynamic_css( '.qodef-preload-background', $preload_background_styles );
    }

    add_action('bazaar_qodef_style_dynamic', 'bazaar_qodef_design_styles');
}

if ( ! function_exists( 'bazaar_qodef_content_styles' ) ) {
	function bazaar_qodef_content_styles() {
		$content_style = array();
		
		$padding_top = bazaar_qodef_options()->getOptionValue( 'content_top_padding' );
		if ( $padding_top !== '' ) {
			$content_style['padding-top'] = bazaar_qodef_filter_px( $padding_top ) . 'px';
		}
		
		$content_selector = array(
			'.qodef-content .qodef-content-inner > .qodef-full-width > .qodef-full-width-inner',
		);
		
		echo bazaar_qodef_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();
		
		$padding_top_in_grid = bazaar_qodef_options()->getOptionValue( 'content_top_padding_in_grid' );
		if ( $padding_top_in_grid !== '' ) {
			$content_style_in_grid['padding-top'] = bazaar_qodef_filter_px( $padding_top_in_grid ) . 'px';
		}
		
		$content_selector_in_grid = array(
			'.qodef-content .qodef-content-inner > .qodef-container > .qodef-container-inner',
		);
		
		echo bazaar_qodef_dynamic_css( $content_selector_in_grid, $content_style_in_grid );
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_content_styles' );
}

if ( ! function_exists( 'bazaar_qodef_h1_styles' ) ) {
	function bazaar_qodef_h1_styles() {
		$margin_top    = bazaar_qodef_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = bazaar_qodef_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = bazaar_qodef_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = bazaar_qodef_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = bazaar_qodef_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_h1_styles' );
}

if ( ! function_exists( 'bazaar_qodef_h2_styles' ) ) {
	function bazaar_qodef_h2_styles() {
		$margin_top    = bazaar_qodef_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = bazaar_qodef_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = bazaar_qodef_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = bazaar_qodef_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = bazaar_qodef_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_h2_styles' );
}

if ( ! function_exists( 'bazaar_qodef_h3_styles' ) ) {
	function bazaar_qodef_h3_styles() {
		$margin_top    = bazaar_qodef_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = bazaar_qodef_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = bazaar_qodef_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = bazaar_qodef_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = bazaar_qodef_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_h3_styles' );
}

if ( ! function_exists( 'bazaar_qodef_h4_styles' ) ) {
	function bazaar_qodef_h4_styles() {
		$margin_top    = bazaar_qodef_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = bazaar_qodef_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = bazaar_qodef_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = bazaar_qodef_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = bazaar_qodef_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_h4_styles' );
}

if ( ! function_exists( 'bazaar_qodef_h5_styles' ) ) {
	function bazaar_qodef_h5_styles() {
		$margin_top    = bazaar_qodef_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = bazaar_qodef_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = bazaar_qodef_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = bazaar_qodef_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = bazaar_qodef_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_h5_styles' );
}

if ( ! function_exists( 'bazaar_qodef_h6_styles' ) ) {
	function bazaar_qodef_h6_styles() {
		$margin_top    = bazaar_qodef_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = bazaar_qodef_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = bazaar_qodef_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = bazaar_qodef_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = bazaar_qodef_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_h6_styles' );
}

if ( ! function_exists( 'bazaar_qodef_text_styles' ) ) {
	function bazaar_qodef_text_styles() {
		$item_styles = bazaar_qodef_get_typography_styles( 'text' );
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo bazaar_qodef_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_text_styles' );
}

if ( ! function_exists( 'bazaar_qodef_link_styles' ) ) {
	function bazaar_qodef_link_styles() {
		$link_styles      = array();
		$link_color       = bazaar_qodef_options()->getOptionValue( 'link_color' );
		$link_font_style  = bazaar_qodef_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = bazaar_qodef_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = bazaar_qodef_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo bazaar_qodef_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_link_styles' );
}

if ( ! function_exists( 'bazaar_qodef_link_hover_styles' ) ) {
	function bazaar_qodef_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = bazaar_qodef_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = bazaar_qodef_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo bazaar_qodef_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo bazaar_qodef_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'bazaar_qodef_style_dynamic', 'bazaar_qodef_link_hover_styles' );
}

if ( ! function_exists( 'bazaar_qodef_smooth_page_transition_styles' ) ) {
	function bazaar_qodef_smooth_page_transition_styles( $style ) {
		$id            = bazaar_qodef_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = bazaar_qodef_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.qodef-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= bazaar_qodef_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
		$spinner_color = bazaar_qodef_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.qodef-st-loader .qodef-rotate-circles > div',
			'.qodef-st-loader .pulse',
			'.qodef-st-loader .double_pulse .double-bounce1',
			'.qodef-st-loader .double_pulse .double-bounce2',
			'.qodef-st-loader .cube',
			'.qodef-st-loader .rotating_cubes .cube1',
			'.qodef-st-loader .rotating_cubes .cube2',
			'.qodef-st-loader .stripes > div',
			'.qodef-st-loader .wave > div',
			'.qodef-st-loader .two_rotating_circles .dot1',
			'.qodef-st-loader .two_rotating_circles .dot2',
			'.qodef-st-loader .five_rotating_circles .container1 > div',
			'.qodef-st-loader .five_rotating_circles .container2 > div',
			'.qodef-st-loader .five_rotating_circles .container3 > div',
			'.qodef-st-loader .atom .ball-1:before',
			'.qodef-st-loader .atom .ball-2:before',
			'.qodef-st-loader .atom .ball-3:before',
			'.qodef-st-loader .atom .ball-4:before',
			'.qodef-st-loader .clock .ball:before',
			'.qodef-st-loader .mitosis .ball',
			'.qodef-st-loader .lines .line1',
			'.qodef-st-loader .lines .line2',
			'.qodef-st-loader .lines .line3',
			'.qodef-st-loader .lines .line4',
			'.qodef-st-loader .fussion .ball',
			'.qodef-st-loader .fussion .ball-1',
			'.qodef-st-loader .fussion .ball-2',
			'.qodef-st-loader .fussion .ball-3',
			'.qodef-st-loader .fussion .ball-4',
			'.qodef-st-loader .wave_circles .ball',
			'.qodef-st-loader .pulse_circles .ball'
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= bazaar_qodef_dynamic_css( $spinner_selectors, $spinner_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'bazaar_qodef_add_page_custom_style', 'bazaar_qodef_smooth_page_transition_styles' );
}