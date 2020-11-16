(function($) {
	"use strict";

    var blog = {};
    qodef.modules.blog = blog;

    blog.qodefOnDocumentReady = qodefOnDocumentReady;
    blog.qodefOnWindowLoad = qodefOnWindowLoad;
    blog.qodefOnWindowResize = qodefOnWindowResize;
    blog.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).on('load', qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitAudioPlayer();
        qodefInitBlogMasonry();
        qodefInitBlogListMasonry();
	    qodefInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
	    qodefInitBlogPagination().init();
	    qodefInitBlogListShortcodePagination().init();
        qodefInitBlogChequered();
        qodefInitBlogMasonryGalleryAppear();
        qodefInitBlogNarrowAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitBlogMasonry();
	    qodefInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
	    qodefInitBlogPagination().scroll();
	    qodefInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function qodefInitAudioPlayer() {
        var players = $('audio.qodef-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function qodefResizeBlogItems(size,container){

        if(container.hasClass('qodef-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-post-size-default'),
                largeWidthMasonryItem = container.find('.qodef-post-size-large-width'),
                largeHeightMasonryItem = container.find('.qodef-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-post-size-large-width-height');

			if (qodef.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function qodefInitBlogMasonry() {
	    var holder = $('.qodef-blog-holder.qodef-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.qodef-blog-holder-inner'),
                    size = thisHolder.find('.qodef-blog-masonry-grid-sizer').width();
			    
                qodefResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.qodef-blog-masonry-grid-gutter',
						    columnWidth: '.qodef-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
				
				    setTimeout(function() {
					    masonry.isotope('layout');
				    }, 800);
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function qodefInitBlogChequered(){
        var container = $('.qodef-blog-holder.qodef-blog-chequered');
        var masonry = container.children('.qodef-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.qodef-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }
	
    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function qodefInitBlogMasonryGallery() {
        var blogList = $('.qodef-blog-holder.qodef-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.qodef-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.qodef-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                qodefInitBlogMasonryGalleryAppear();
            });
        }
    }

    /**
     *  Animate blog masonry gallery type
     */
    function qodefInitBlogMasonryGalleryAppear() {
        var blogList = $('.qodef-blog-holder.qodef-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.qodef-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter === animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('qodef-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function qodefInitBlogNarrowAppear() {
        var blogList = $('.qodef-blog-holder.qodef-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.qodef-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('qodef-appeared');
                    },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function qodefInitBlogPagination(){
		var holder = $('.qodef-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.qodef-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('qodef-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.qodef-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();

			if(nextPage <= maxNumPages){
				loadingItem.addClass('qodef-showing');
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'bazaar_qodef_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('qodef-blog-type-masonry')){
								qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                qodefResizeBlogItems(thisHolderInner.find('.qodef-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								qodefInitAudioPlayer();
								qodef.modules.common.qodefOwlSlider();
								qodef.modules.common.qodefFluidVideo();
                                qodef.modules.common.qodefInitSelfHostedVideoPlayer();
                                qodef.modules.common.qodefSelfHostedVideoSize();
                                qodefInitBlogNarrowAppear();
                                qodefInitBlogMasonryGalleryAppear();
                                qodefInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('qodef-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.qodef-blog-pag-load-more').hide();
			}
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function qodefInitBlogListMasonry() {
		var holder = $('.qodef-blog-list-holder.qodef-bl-masonry');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.qodef-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.qodef-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.qodef-bl-grid-gutter',
							columnWidth: '.qodef-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function qodefInitBlogListShortcodePagination(){
		var holder = $('.qodef-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.qodef-bl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.qodef-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
				thisHolder.addClass('qodef-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.qodef-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();

			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
					loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
					thisHolder.addClass('qodef-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('qodef-showing');
				}
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'bazaar_qodef_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
							qodefInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('qodef-bl-masonry')){
									qodefInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									qodefInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('qodef-bl-masonry')){
									qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('qodef-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.qodef-blog-pag-load-more').hide();
			}
		};
		
		var qodefInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.qodef-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.qodef-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.qodef-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.qodef-bl-pag-next a');
			
			standardPagNumericItem.removeClass('qodef-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('qodef-bl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var qodefInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisHolder.removeClass('qodef-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var qodefInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisHolder.removeClass('qodef-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('qodef-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);