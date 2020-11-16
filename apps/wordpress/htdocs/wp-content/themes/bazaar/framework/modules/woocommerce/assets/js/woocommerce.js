(function($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;
    woocommerce.qodefOnWindowLoad = qodefOnWindowLoad;
    woocommerce.qodefOnWindowResize = qodefOnWindowResize;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
	    qodefInitSingleProductLightbox();
        qodefInitProductListFilter().init();
        qodefAddingToCart();
        qodefAddingToWishlist();
	    qodefWishlistRefresh().init();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitProductListMasonryShortcode();
        qodefInitProductListAnimatedShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitProductListMasonryShortcode();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function qodefInitQuantityButtons() {
		$(document).on('click', '.qodef-quantity-minus, .qodef-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.qodef-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('qodef-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue > 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(1);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function qodefInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.qodef-woocommerce-page .qodef-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}

        if($('#shipping_method').length > 0) {
            $( document.body ).on('updated_shipping_method updated_wc_div', function() {
                console.log("OPA");
                var select = $('.woocommerce-shipping-calculator').find('select#calc_shipping_country');
                console.log(select.length);
                if(select.length) {
                    select.select2({});
                }
                var selectState = $('.woocommerce-shipping-calculator').find('select#calc_shipping_state');
                console.log(selectState.length);
                if(selectState.length) {
                    selectState.select2({});
                }
            });
        }
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function qodefInitSingleProductLightbox() {
		var item = $('.qodef-woo-single-page .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof qodef.modules.common.qodefPrettyPhoto === "function") {
				qodef.modules.common.qodefPrettyPhoto();
			}
		}
	}

    /**
     * Init Resize Product Items
     */
    function qodefResizeProductItems(size,container){
        if(container.hasClass('qodef-pl-images-fixed')) {
            var padding = parseInt(container.find('.qodef-pli').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-default'),
                largeWidthMasonryItem = container.find('.qodef-large-width'),
                largeHeightMasonryItem = container.find('.qodef-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-large-width-height');

            if (qodef.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', 2 * size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    function qodefInitProductListFilter(){
        var productList = $('.qodef-pl-holder');
        var queryParams = {};

        var initFilterClick = function(thisProductList){
            var links = thisProductList.find('.qodef-pl-categories a, .qodef-pl-ordering a');

            links.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var clickedLink = $(this);
                if(!clickedLink.hasClass('active')) {
                    initMainPagFunctionality(thisProductList, clickedLink);
                }
            });
        }

        //used for replacing content after ajax call
        var qodefReplaceStandardContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.html(responseHtml);
            loader.fadeOut();
        };

        //used for replacing content after ajax call
        var qodefReplaceMasonryContent = function(thisProductListInner, loader, responseHtml) {
            thisProductListInner.find('.qodef-pli').remove();

            thisProductListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
	        var size = thisProductListInner.find('.qodef-pl-sizer').width();
	        qodefResizeProductItems(size, thisProductListInner);
            
            setTimeout(function() {
                thisProductListInner.isotope('layout');
                loader.fadeOut();
            }, 400);
        };

        //used for storing parameters in global object
        var qodefReturnOrderingParemeters = function(queryParams, data){

            for (var key in data) {
                queryParams[key] = data[key];
            }

            //store ordering parameters
            switch(queryParams.ordering) {
                case 'menu_order':
                    queryParams.metaKey = '';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'menu_order title';
                    break;
                case 'popularity':
                    queryParams.metaKey = 'total_sales';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'rating':
                    queryParams.metaKey = '_wc_average_rating';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'newness':
                    queryParams.metaKey = '';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'date';
                    break;
                case 'price':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'asc';
                    queryParams.orderby = 'meta_value_num';
                    break;
                case 'price-desc':
                    queryParams.metaKey = '_price';
                    queryParams.order = 'desc';
                    queryParams.orderby = 'meta_value_num';
                    break;
            }

            return queryParams;
        }

        var initMainPagFunctionality = function(thisProductList, clickedLink){
            var thisProductListInner = thisProductList.find('.qodef-pl-outer');

            var loadData = qodef.modules.common.getLoadMoreData(thisProductList),
                loader = thisProductList.find('.qodef-prl-loading');

            //store parameters in global object
            qodefReturnOrderingParemeters(queryParams, clickedLink.data());

            //set paremeters for new query passed through ajax
            loadData.category = queryParams.category !== undefined ? queryParams.category : '';
            loadData.metaKey = queryParams.metaKey !== undefined ? queryParams.metaKey : '';
            loadData.order = queryParams.order !== undefined ? queryParams.order : '';
            loadData.orderby = queryParams.orderby !== undefined ? queryParams.orderby : '';
            loadData.minPrice = queryParams.minprice !== undefined ? queryParams.minprice : '';
            loadData.maxPrice = queryParams.maxprice !== undefined ? queryParams.maxprice : '';

	        var nonceHolder = thisProductList.find('input[name*="qodef_product_load_more_nonce_"]');

	        loadData.product_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
	        loadData.product_load_more_nonce = nonceHolder.val();

            loader.fadeIn();

            var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadData, 'qodef_product_ajax_load_category');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: QodefAjaxUrl,
                success: function (data) {

                    var response = $.parseJSON(data),
                        responseHtml =  response.html;

                    thisProductList.waitForImages(function(){
                        clickedLink.parent().siblings().find('a').removeClass('active');
                        clickedLink.addClass('active');
                        if(thisProductList.hasClass('qodef-masonry-layout')) {
                            qodefReplaceMasonryContent(thisProductListInner, loader, responseHtml);
                        }else{
                            qodefReplaceStandardContent(thisProductListInner, loader, responseHtml);
                        }
                        qodefAddingToCart();
                        qodefAddingToWishlist();
                    });

                }
            });
        }

        var initMobileFilterClick = function(cliked, holder){
            cliked.on('click',function(){
                if(qodef.windowWidth <= 768) {
                    if(!cliked.hasClass('opened')){
                        cliked.addClass('opened');
                        holder.slideDown();
                    }else{
                        cliked.removeClass('opened');
                        holder.slideUp();
                    }
                }
            });
        }

        return {
            init: function () {
                if (productList.length) {
                    productList.each(function () {
                        var thisProductList = $(this);
                        initFilterClick(thisProductList);

                        initMobileFilterClick(thisProductList.find('.qodef-pl-ordering-outer h6'), thisProductList.find('.qodef-pl-ordering'));
                        initMobileFilterClick(thisProductList.find('.qodef-pl-categories-label'),thisProductList.find('.qodef-pl-categories-label').next('ul'));
                    });
                }
            },

        }
    }
	
	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function qodefInitProductListMasonryShortcode() {
		var container = $('.qodef-pl-holder.qodef-masonry-layout .qodef-pl-outer');
		
		if (container.length) {
			container.each(function () {
				var thisContainer = $(this);
                var size = thisContainer.find('.qodef-pl-sizer').width();
                var thisContainerParent = $(this).parent();

                qodefResizeProductItems(size, thisContainerParent);
				
				thisContainer.waitForImages(function () {
					thisContainer.isotope({
                        layoutMode: 'packery',
						itemSelector: '.qodef-pli',
						resizable: false,
                        packery: {
							columnWidth: '.qodef-pl-sizer',
							gutter: '.qodef-pl-gutter'
						}
					});
					
					setTimeout(function () {
						if (typeof qodef.modules.common.qodefInitParallax === "function") {
							qodef.modules.common.qodefInitParallax();
						}
					}, 1000);
					
					thisContainer.isotope('layout').css('opacity', 1);
				});
			});
		}
	}

	/*
	 ** Init Product List Animated Shortcode Layout
	 */
	function qodefInitProductListAnimatedShortcode() {

		var productListAnimatedHolder = $('.qodef-pla-holder:not(.qodef-pla-animation-disabled)');

		if(productListAnimatedHolder.length) {
			productListAnimatedHolder.each(function(){
                var productList = $(this),
				    productListItem = productList.children('.qodef-pla-item');

                productList.animate({opacity: 1}, 1000, 'easeInOutQuad');

				productListItem.appear(function(){
                    $(this).addClass('qodef-pla-animated');
                });
			});
		}
	}

    function qodefAddingToCart() {
        var addToCartButtons = $('.add_to_cart_button, .single_add_to_cart_button');

        if (addToCartButtons.length) {
            addToCartButtons.on('click',function(){
                $(this).text(qodefGlobalVars.vars.qodefAddingToCartLabel);
            });
        }
    }

    function qodefAddingToWishlist() {
        var wishlistButtons = $('.add_to_wishlist');

        if (wishlistButtons.length) {
            wishlistButtons.on('click',function(){
                var wishlistButton = $(this),
                    wishlistItem,
                    wishlistItemOffset,
                    heightAdj,
                    widthAdj;

                //absolute centering over added item
                if (wishlistButton.closest('.qodef-pli').length) {
                    wishlistItem = wishlistButton.closest('.qodef-pli');            // product list shortcode
                } else if (wishlistButton.closest('.qodef-plc-item').length) {
                    wishlistItem = wishlistButton.closest('.qodef-plc-item');       // product carousel shortcode
                } else if (wishlistButton.closest('.product').length) {
                    wishlistItem = wishlistButton.closest('.product');              // WooCommerce template
                }

                wishlistItemOffset = wishlistItem.find('img').offset();
                heightAdj = wishlistItem.find('img').height()/2;
                widthAdj = wishlistItem.find('img').width()/2;

                $('#yith-wcwl-popup-message').css({
                    'top': wishlistItemOffset.top + heightAdj,
                    'left': wishlistItemOffset.left + widthAdj,
                });

                wishlistButton.addClass('qodef-adding-to-wishlist');

                $(document).on('added_to_wishlist', function(){
                    wishlistButton.removeClass('qodef-adding-to-wishlist');

                    setTimeout(function(){
                        var wishlistMsg = $('#yith-wcwl-popup-message');

                        wishlistMsg.stop().addClass('qodef-wishlist-vanish-out');
                        wishlistMsg.one('webkitAnimationEnd oanimationend msAnimationEnd animationend' ,function(){
                            wishlistMsg.removeClass('qodef-wishlist-vanish-out');
                        });
                    }, 1000);
                });
            });
        }
    }

	function qodefWishlistRefresh() {

		var initRefreshWishlist = function(){
			var nonceHolder = $('.qodef-wishlist-widget-holder').find('input[name*="bazaar_select_product_wishlist_nonce_"]');

			var data = {
				action: 'qodef_product_ajax_wishlist',
				product_wishlist_id: nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length),
				product_wishlist_nonce: nonceHolder.val()
			};

			$.ajax({
				url: qodefGlobalVars.vars.qodefAjaxUrl,
				type: "POST",
				data: data,
				success:function(data) {
					$('.qodef-wishlist-widget-holder .qodef-wishlist-items-number span').html(data['wishlist_count_products']);
				}
			});
		};

		return {
			init: function () {
				//trigger defined in jquery.yith-wcwl.js, after product is added to wishlist
				$('body').on('added_to_wishlist',function(){
					initRefreshWishlist();
				});

				//after product is removed from wishlist list
				$('#yith-wcwl-form').on('click', '.product-remove a, .product-add-to-cart a', function() {
					setTimeout(function() {
						initRefreshWishlist();
					}, 2000);
				});
			}

		}

	}

})(jQuery);