( function( jQuery ) {
	"use strict";

/* ===========> Helper scripts <=========== */
function is_mobile_device(){
	if ( navigator.userAgent.match( /(Android|iPhone|iPod|iPad|Phone|DROID|webOS|BlackBerry|Windows Phone|ZuneWP7|IEMobile|Tablet|Kindle|Playbook|Nexus|Xoom|SM-N900T|GT-N7100|SAMSUNG-SGH-I717|SM-T330NU)/ ) ) {
		return true;
	} else {
		return false;
	}
}
function cws_detect_browser() {
	var browser = 'unknown';

    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) {
        browser = 'Opera';
    } else if(navigator.userAgent.indexOf("Chrome") != -1 ){
        browser = 'Chrome';
    } else if(navigator.userAgent.indexOf("Safari") != -1){
        browser = 'Safari';
    } else if(navigator.userAgent.indexOf("Firefox") != -1 ){
        browser = 'Firefox';
    } else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )){
    	browser = 'IE';
    }

    jQuery('body').addClass('browser_'+browser);
}
function cws_is_tablet_viewport () {
	if ( window.innerWidth > 767 && window.innerWidth < 1367 && is_mobile_device() ){
		return true;
	} else {
		return false;
	}		
}
function is_mobile () {
	if ( window.innerWidth < 768 ){
		return true;
	} else {
		return false;
	}
}
function not_desktop(){
	if( (window.innerWidth < 1367 && is_mobile_device()) || window.innerWidth < 1200 ){
		return true;
	} else {
		return false;
	}
}
function cws_resize_class() {
	var cwsBody = jQuery('body');
	if( is_mobile_device() && cws_is_tablet_viewport()){
		cwsBody.removeClass('cws_mobile');
		cwsBody.addClass('cws_tablet');
	} else if ( is_mobile_device() && is_mobile() ){
		cwsBody.removeClass('cws_tablet');
		cwsBody.addClass('cws_mobile');
	} else {
		cwsBody.removeClass('cws_tablet');
		cwsBody.removeClass('cws_mobile');
	}
}
function cws_is_mobile () {
	var device = is_mobile_device();
	var viewport = not_desktop();
	return device || viewport;
}
function cws_potfolio_get_columns( element ){
	var windowWidth = jQuery(window).width();
	var columns = element.data('columns');

	if( windowWidth < 1200 && windowWidth > 991 && columns > 4 ){
		columns = 4;
	} else if( windowWidth < 768 && windowWidth > 479 && columns > 2 ){
		columns = 3;
	} else if( windowWidth < 480 && columns > 1 ){
		columns = 1;
	}

	return columns;
}

/* ===========> Scripts Init <=========== */
jQuery(document).ready(function (){
	cws_detect_browser();
	cws_resize_class();
	cws_hide_topbar_notice();
	cws_search_trigger();
	cws_click_overlay();
	cws_magnific_popup_init();
	cws_baner_hover();
	cws_scroll_to_top();
	cws_wishlist_hidden_title();
	cws_custom_sidebars();
	cws_fix_layout_paddings();
	cws_tips_touch();
	cws_video_height();
});

window.addEventListener( "load", function() {
	cws_desktop_menu();
	cws_tablet_menu();
	cws_mobile_menu();
	cws_widget_menu();
	cws_blog_fix_divider();
	cws_show_sidebar();
	cws_masonry();
	cws_page_preloader();
	cws_carousel();
	cws_custom_carousel();
	cws_sticky_menu();
	cws_footer_on_bottom();
	cws_megamenu_pos();
	cws_sticky_footer();
	cws_smooth_title();
	cws_extended_services_size();
	cws_close_info_box();
	cws_progress_bar();
	cws_progress_bar_width();
	cws_icons_wheel_init();
	cws_column_animation();
	cws_milestone_shape_size();
	cws_milestones_count();
	cws_particles_init();
	cws_mask_on_vc_row();
	cws_smooth_comment_anchor();
	cws_simple_staff_style();
	cws_sticky_sidebar();
	cws_3d_images();
	cws_centered_menu();
	cws_our_team_hover_on_devices();
	cws_product_hover_on_devices();
	cws_infinite_autoplay();
	cws_video_height();

	let hashTagActive = false;
	jQuery('.menu-item a').click(function(event) {
		if(!jQuery(this).hasClass("fancy") && jQuery(this).attr("target") != "_blank" && jQuery(this).attr("href") != null){
			let anchor = jQuery(this).attr("href");
			let link = anchor.replace('/#','#');
			let re = new RegExp( "^#.*$" );
			let matches = re.exec( link );

			let current = window.location.toString();
			let currentPage = current.replace(/#.*$/g, '');
			let targetPage = anchor.replace(/#.*$/g, '');
			let currentAnchor = anchor.replace(/^.*#/, '#');

			if ( currentAnchor == '#' ){
				event.preventDefault();
			}

			if (hashTagActive) return;
			hashTagActive = true;

			if ( (currentPage.indexOf(targetPage) != -1 || matches !== null ) && anchor.indexOf("#") != -1 && jQuery(currentAnchor).length ) {
				event.preventDefault();
				jQuery('html, body').animate({
					scrollTop: jQuery(currentAnchor).offset().top
				}, 700, 'linear', function () {
					hashTagActive = false;
				});
			}
		}
	});
});

jQuery(window).resize( function(){
	cws_resize_class();
	cws_masonry();
	cws_desktop_menu();
	cws_tablet_menu();
	cws_mobile_menu();
	cws_magnific_popup_init();
	cws_column_animation();
	cws_footer_on_bottom();
	cws_megamenu_pos();
	cws_sticky_footer();
	cws_sticky_menu();
	cws_milestone_shape_size();
	cws_extended_services_size();
	cws_progress_bar_width();
	cws_video_height();
});

/* ===========> Scripts Declaration <=========== */
function cws_hide_topbar_notice(){
	jQuery('.top_bar_notice .close-btn').on('click', function() {
		jQuery(this).parents('.top_bar_notice').slideUp();
	});
}
function cws_search_trigger(){
	jQuery('.search-trigger').on('click', function() {
		jQuery('.site-search').slideDown(300);
		jQuery('.site-search').find('.search-field').focus();
		jQuery('body').addClass('active');
	});

	jQuery('.close-search').on('click', function() {
		jQuery('body').removeClass('active');
		jQuery('.site-search').slideUp(300);
	});
}
function cws_desktop_menu(){
	jQuery('.current-menu-item').parents('li.menu-item').addClass('current-item-parent');

	jQuery('.menu-item-object-cws-megamenu > a').on('click', function(e){
		e.preventDefault();
		return false;
	});

	if( !not_desktop() ){
		jQuery('.cws_header_template .menu-main-container, .cws_sticky_template .menu-main-container, .menu-box .menu-main-container').css('pointer-events', 'none');

		jQuery('.cws_header_template .menu-main-container > .menu .menu-item, .cws_sticky_template .menu-main-container > .menu .menu-item, .menu-box .menu-main-container > .menu .menu-item, .site-sticky .menu-main-container > .menu .menu-item').has('.sub-menu').off();
		jQuery('.cws_header_template .menu-main-container > .menu .menu-item, .cws_sticky_template .menu-main-container > .menu .menu-item, .menu-box .menu-main-container > .menu .menu-item, .site-sticky .menu-main-container > .menu .menu-item').has('.sub-menu').hover( function() {
			jQuery(this).toggleClass('active');
			jQuery(this).children('.sub-menu').stop().slideToggle(300).toggleClass('active');
		});

		jQuery('.cws_header_template .menu-main-container .sub-menu > .menu-item-has-children, .cws_sticky_template .menu-main-container .sub-menu > .menu-item-has-children, .menu-box .menu-main-container .sub-menu > .menu-item-has-children, .site-sticky .menu-main-container .sub-menu > .menu-item-has-children').off();
		jQuery('.cws_header_template .menu-main-container .sub-menu > .menu-item-has-children, .cws_sticky_template .menu-main-container .sub-menu > .menu-item-has-children, .menu-box .menu-main-container .sub-menu > .menu-item-has-children, .site-sticky .menu-main-container .sub-menu > .menu-item-has-children').hover( function() {
			jQuery(this).children('.sub-menu').toggle();
			jQuery(this).children('a').toggleClass('active');
		});

		jQuery('.cws_header_template .menu-main-container, .cws_sticky_template .menu-main-container, .menu-box .menu-main-container, .site-sticky .menu-main-container').css('pointer-events', 'auto');
	}
}
function cws_tablet_menu(){
	var windowWidth = jQuery(window).width();

	if( 
		jQuery('#site').hasClass('desktop-menu-landscape') && windowWidth < 1200 && windowWidth > 991 || 
		jQuery('#site').hasClass('desktop-menu-both') && windowWidth < 1200 && windowWidth > 768 
	){
		
		if( cws_is_tablet_viewport() ){
			var this_is = {};
			var parent = {};
			var parentsSubMenus = {};

			jQuery('.menu-main-container .menu-item > a').off();
			jQuery('.menu-main-container .menu-item > a').on('click', function(e) {
				this_is = jQuery(this);
				parent = this_is.parent();
				parentsSubMenus = this_is.parents('.menu-item').children('.sub-menu');

				if( parent.has('.sub-menu').length == 1 ){
					e.preventDefault();
					parent.toggleClass('active');
					jQuery('.menu-main-container .sub-menu').not(parentsSubMenus).slideUp(300).removeClass('active');
					parent.children('.sub-menu').stop().slideToggle(300).toggleClass('active');
				}
			});
		}

		jQuery('body').click(function(e) {
			if( jQuery(e.target).closest('.menu-main-container').length === 0 ){
				jQuery('.menu-main-container .sub-menu').slideUp(300).removeClass('active');
			}
		});
	}
}
function cws_mobile_menu(){
	jQuery('.site-header-mobile').find('.menu-item').each(function(i, el){
		if( jQuery(el).find('.sub-menu').length != 0 && jQuery(el).find('.sub-menu-trigger').length == 0 ){
			jQuery(el).append('<span class="sub-menu-trigger"></span>');
		}
	});

	jQuery('.menu-trigger').off();
	jQuery('.menu-trigger').on('click', function(){
		jQuery('body').addClass('active');
		jQuery('.site-header-mobile .menu-box').toggleClass('active');
	});

	jQuery('.sub-menu-trigger').off();
	jQuery('.sub-menu-trigger').on('click', function() {
		if( jQuery(this).parent().hasClass('active') ){
			jQuery(this).prev().slideUp();
			jQuery(this).parent().removeClass('active');
		} else {
			var currentParents = jQuery(this).parents('.menu-item');
			jQuery('.sub-menu-trigger').parent().not(currentParents).removeClass('active');
			jQuery('.sub-menu-trigger').parent().not(currentParents).find('.sub-menu').slideUp(300);

			jQuery(this).prev().slideDown();
			jQuery(this).parent().addClass('active');
		}
	});
}
function cws_widget_menu(){
	jQuery('.cws-widget li, .widget li, .wp-block-categories-list li').has('.sub-menu, .children').prepend('<span class="open"></span>');
	jQuery('.cws-widget li, .widget li, .wp-block-categories-list li').has('.children').children('.post_count').remove();
	jQuery('.cws-widget li, .widget li, .wp-block-categories-list li').has('.children').children('.count').remove();

	jQuery('.cws-widget li .open, .widget li .open, .wp-block-categories-list li .open').on('click', function() {
		var triggeredList = jQuery(this).parent();

		triggeredList.toggleClass('active');
		triggeredList.children('.children, .sub-menu').stop().slideToggle(300);
	});
}
function cws_blog_fix_divider(){
	jQuery('.post-date:only-child').each(function(i, el){
		if( jQuery(el).css('display') == 'none' ){
			jQuery(el).parent().addClass('hidden');
		}
	});
}
function cws_show_sidebar(){
	setTimeout(function(){
		var wH = jQuery(window).height();
		var dH = jQuery(document).height();
		var el = jQuery('.sidebar_trigger');
		var show = jQuery('.sticky_footer').length != 0 ? dH - jQuery('.sticky_footer').height() : dH;

		if( (wH * 2) > dH ){
			el.addClass('active');
		} else {
			jQuery(window).scroll(function() {
				if( (wH + jQuery(this).scrollTop()) >= (show * 0.7) ){
					el.addClass('active');
				} else {
					el.removeClass('active');
				}
			});
		}

		jQuery(el).on('click', function() {
			jQuery('body').addClass('show_sidebar').addClass('active');
		});

		jQuery('.close_sidebar').on('click', function() {
			jQuery('body').removeClass('show_sidebar').removeClass('active');
		});
	}, 1);
}
function cws_click_overlay(){
	jQuery('.body-overlay').on('click', function() {
		jQuery('body').removeClass('active').removeClass('show_sidebar');

		// Site Search default
		jQuery('.site-search').slideUp(300);

		// Mini Cart defaults
		jQuery('.mini-cart').removeClass('active');

		// Custom sidebars defaults
		jQuery('.custom_sidebars_wrapper').removeClass('active');
        jQuery('.icon_sidebar_trigger').removeClass('active');
		// jQuery('.custom_sidebars_wrapper').find('aside').hide();

		// Mobile menu defaults
		jQuery('.site-header-mobile .menu-box').removeClass('active');
		setTimeout(function(){
			jQuery('.site-header-mobile .menu-box .menu').css('left', '0');
			jQuery('.site-header-mobile .close-menu').removeClass('back');
		}, 300);
	});
}
function cws_masonry(){
	if( !is_mobile() ){
		setTimeout(function(){
			
			if( jQuery('div.blog .content_inner.masonry').length != 0 ){
				jQuery('div.blog .content_inner.masonry').masonry({
					itemSelector: 'div.blog .content_inner.masonry .post',
					columnWidth: 'div.blog .content_inner.masonry .post',
				});
			}

			if( jQuery('.cws_gallery_images').length != 0 ){
				jQuery('.cws_gallery_images').each(function(i, el){
					if( jQuery(el).hasClass('masonry') ){
						jQuery(el).masonry({
							itemSelector: '.cws_gallery_image',
							columnWidth: '.cws_gallery_image',
						});
					}
				});
			}

		}, 300);

		if( jQuery('.cws-widget .gallery').length != 0 ){
			jQuery('.cws-widget .gallery').masonry({
				itemSelector: '.cws-widget .gallery .gallery-item',
				columnWidth: '.cws-widget .gallery .gallery-item',
			});
		}
	}
}
function cws_carousel(){
	jQuery( '.cws_carousel_wrapper' ).each( function() {

		var this_is = jQuery(this);

		if( this_is.find('.cws_carousel > *').length <= this_is.data('columns') ){
			return true;
		}

		/* -----> Getting carousel attributes <-----*/	
		if( this_is.hasClass('cws_portfolio_items') ){
			var slidesToShow = cws_potfolio_get_columns(this_is);
		} else {
			var slidesToShow = this_is.data('columns');
		}
		var slidesToScroll = jQuery.isNumeric(this_is.data('slides-to-scroll')) ? this_is.data('slides-to-scroll') : 1;
		var infinite = this_is.data('infinite') == 'on';
		var pagination = this_is.data('pagination') == 'on';
		var navigation = this_is.data('navigation') == 'on';
		var autoHeight = this_is.data('auto-height') == 'on';
		var draggable = this_is.data('draggable') == 'on';
		var autoplay = this_is.data('autoplay') == 'on';
		var autoplaySpeed = this_is.data('autoplay-speed');
		var pauseOnHover = this_is.data('pause-on-hover') == 'on';
		var vertical = this_is.data('vertical') == 'on';
		var verticalSwipe = this_is.data('vertical-swipe') == 'on';
		var tabletLandscape = this_is.data('tablet-landscape');
		var tabletPortrait = this_is.data('tablet-portrait');
		var mobile = this_is.data('mobile');
		var carousel = this_is.children('.cws_carousel');
		var rtl = jQuery('body').hasClass('rtl');

		if( carousel.length == 0 ){
			carousel = this_is.find('.products.cws_carousel'); //Need for woocommerce shortcodes 
		}
		var responsive = { responsive: [] }

		/* -----> Collect attributes in aruments object <-----*/	
		var args = {
			slidesToShow: slidesToShow,
			slidesToScroll: slidesToScroll,
			infinite: infinite,
			dots: pagination,
			arrows: navigation,
			adaptiveHeight: autoHeight,
			draggable: draggable,
			swipeToSlide: true,
			swipe: true,
			touchMove: true,
			touchThreshold: 10,
			autoplay: autoplay,	
			autoplaySpeed: autoplaySpeed,
			pauseOnHover: pauseOnHover, 
			vertical: vertical,
			verticalSwiping: verticalSwipe,
			rtl: rtl,
			margin: 20,
			customPaging: function(slider, i){
				return jQuery('<button type="button" />').text(i + 1).prepend('<svg width="51" height="54" viewBox="0 0 51 54" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
					'<g filter="url(#filter0_d)">\n' +
					'<path d="M41.3172 0.676787L9.49435 0.613895C8.06273 0.612251 6.68969 1.1783 5.67683 2.18771C4.66396 3.19712 4.09409 4.56735 4.0924 5.99742L4.08301 29.3152C4.08313 30.7452 4.65149 32.1175 5.66324 33.1305C6.675 34.1435 8.04742 34.7145 9.47904 34.7179L16.0953 34.7308L16.7865 35.6723L23.8072 45.1159C23.9897 45.3611 24.227 45.5604 24.5001 45.6979C24.7733 45.8353 25.0747 45.9071 25.3804 45.9075C25.6861 45.908 25.9876 45.837 26.2608 45.7003C26.534 45.5636 26.7713 45.365 26.9538 45.1202L34.0355 35.7108L34.684 34.7266L41.3003 34.7395C42.7319 34.7412 44.1049 34.1751 45.1178 33.1657C46.1307 32.1563 46.7005 30.7861 46.7022 29.356L46.7116 6.03824C46.7006 4.6156 46.1277 3.25417 45.1174 2.25011C44.1072 1.24606 42.7414 0.68061 41.3172 0.676787Z"/>\n' +
					'</g>\n' +
					'<path d="M29.6874 9.40727C28.8581 9.39174 28.0377 9.57749 27.2966 9.94858C26.5555 10.3197 25.9158 10.865 25.4325 11.5378C24.9486 10.8695 24.3104 10.3276 23.5721 9.95822C22.8339 9.58885 22.0175 9.4029 21.1924 9.4162C20.4739 9.45717 19.7709 9.64118 19.1249 9.9574C18.4788 10.2736 17.9027 10.7157 17.4304 11.2577C16.9581 11.7996 16.599 12.4305 16.3744 13.1133C16.1497 13.7961 16.064 14.517 16.1222 15.2338C16.133 19.2947 20.7738 22.5507 25.4794 25.9781C30.1326 22.6082 34.7831 19.3791 34.7799 15.3013C34.8471 14.5779 34.7674 13.8482 34.5455 13.156C34.3236 12.4637 33.9641 11.8232 33.4886 11.2728C33.013 10.7224 32.4312 10.2734 31.778 9.95289C31.1249 9.63232 30.4138 9.44675 29.6874 9.40727Z" fill="white"/>\n' +
					'<defs>\n' +
					'<filter id="filter0_d" x="0.0830078" y="0.613892" width="50.6286" height="53.2937" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">\n' +
					'<feFlood flood-opacity="0" result="BackgroundImageFix"/>\n' +
					'<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>\n' +
					'<feOffset dy="4"/>\n' +
					'<feGaussianBlur stdDeviation="2"/>\n' +
					'<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>\n' +
					'<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>\n' +
					'<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>\n' +
					'</filter>\n' +
					'</defs>\n' +
					'</svg>');
			}
		};

		/* -----> Responsive rules <----- */
		if( typeof tabletLandscape !== 'undefined' )
			responsive.responsive.push( cws_carousel_responsive_array(1200, tabletLandscape) );
		
		if( typeof tabletPortrait !== 'undefined' )
			responsive.responsive.push( cws_carousel_responsive_array(992, tabletPortrait) );

		if( typeof mobile !== 'undefined' ){
			responsive.responsive.push( cws_carousel_responsive_array(768, mobile) );
		} else {
			if( this_is.parent().hasClass('layout_carousel') ){
				responsive.responsive.push( cws_carousel_responsive_array(768, 3) );
				responsive.responsive.push( cws_carousel_responsive_array(480, 1) );
			} else {
				responsive.responsive.push( cws_carousel_responsive_array(768, 1) );
			}
		}

		
		args = jQuery.extend({}, args, responsive);

		/* -----> Carousel init <-----*/	
		var carousel_obj = carousel.slick(args);
	});
}
function cws_carousel_responsive_array( res, cols ){
	var out = {
		breakpoint: res,
		settings: {
			slidesToShow: cols,
			slidesToScroll: 1,
		}
	};

	if( res == 768 ){
		out.settings['adaptiveHeight'] = true;
	}

	return out;
}
function cws_custom_carousel(){
	jQuery( '.cws_custom_carousel' ).each( function(i, el){
		var this_is = jQuery(this);
		var columns = '3';
		var custom_columns = this_is.attr('class');
		var rtl = jQuery('body').hasClass('rtl');

		custom_columns = custom_columns.match(/columns-(.*[0-9])/);

		if( custom_columns.length ){
			columns = custom_columns[1];
		}


		this_is.slick({
			slidesToShow: columns,
			slidesToScroll: 1,
			draggable: true,
			dots: true,
			arrows: false,
			rtl: rtl,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
					}
				}
			]
		});
	});
}
function cws_page_preloader(){
	setTimeout(function() {
		jQuery('.cws-blank-preloader').addClass('disabled');
	}, 400);
}
function cws_magnific_popup_init(){
	jQuery('.cws_gallery_images').each(function(i, el){
		if( jQuery(el).hasClass('magnific') ){
			jQuery(el).magnificPopup({
				delegate: '.cws_gallery_image',
				type: 'image',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					tCounter: ''
			    }
			});
		}
	});

	jQuery('.cws_popup_video_module').each(function(i, el){
		jQuery(el).magnificPopup({
			delegate: '.video-link',
			type: 'iframe',
		});
	});

	jQuery('.cws-srv-magnific').magnificPopup({
		type: 'inline',
		callbacks: {
			elementParse: function(item) {
				item.src = '<div class="cws-srv-popup">' + item.el.find('.content_wrapper').text() + '</div>';
				return(item.src);
			}
		}
	});
}
function cws_video_height() {
	jQuery('.wp-block-embed, .post-format.format_video, .media-video').each(function(){
		var w = jQuery(this).width();
		var h = w/16*9;
		jQuery('iframe', this).height(h).width(w);
	});
}
function cws_baner_hover(){
	if( not_desktop() ){

		jQuery('.cws_banner_module.style_1').on('click', function(e){
			if( !jQuery(this).hasClass('active') ) {
				e.preventDefault();
			}

			jQuery('.cws_banner_module.style_1').removeClass('active');
			jQuery(this).addClass('active');
		});

	}
}
function cws_scroll_to_top(){
	jQuery(window).on('scroll', function() {
		if( jQuery(this).scrollTop() > 500 ){
			jQuery('.button-up').addClass('active');
		} else {
			jQuery('.button-up').removeClass('active');
		}
	});

	jQuery('.button-up').on('click', function() {
		jQuery('html, body').animate({
			scrollTop: 0
		}, 1000)
	});
}
function cws_wishlist_hidden_title(){
	var this_is = jQuery('.wishlist_hidden_title');
	var wishlist = this_is.next();

	this_is.appendTo(wishlist);
}
function cws_custom_sidebars(){
	var sidebar_area = jQuery('.custom_sidebars_wrapper');

	jQuery('.custom_sidebar_trigger').on('click', function(e){
		e.preventDefault();

		jQuery('.icon_sidebar_trigger', this).addClass('active');
		var sidebar = jQuery(this).data('sidebar');
		sidebar_area.find('aside.'+sidebar).show();

		setTimeout(function(){
			jQuery('body').addClass('active');
			sidebar_area.addClass('active');
		}, 50);
	});

	sidebar_area.find('.close_custom_sidebar').on('click', function(){
		// sidebar_area.find('aside').hide();
		sidebar_area.removeClass('active');
		jQuery('body').removeClass('active');

        jQuery('.icon_sidebar_trigger.active').removeClass('active');
	});
}
function cws_sticky_menu(){
	var windowWidth = jQuery(window).width();

	if( jQuery('#site').hasClass('desktop-menu-desktop') ){

		if( windowWidth > 1199 ){
			var sticky = jQuery('.site-sticky:not(.sticky-mobile)').length != 0 ? jQuery('.site-sticky:not(.sticky-mobile)') : jQuery('.cws_sticky_template');
			var menu = jQuery('.site-header').length != 0 ? jQuery('.site-header') : jQuery('.cws_header_template');		
		} else {
			var sticky = jQuery('.site-sticky.sticky-mobile');
			var menu = jQuery('.site-header-mobile');
		}

	} else if( jQuery('#site').hasClass('desktop-menu-landscape') ){

		if( windowWidth > 991 ){
			var sticky = jQuery('.site-sticky:not(.sticky-mobile)').length != 0 ? jQuery('.site-sticky:not(.sticky-mobile)') : jQuery('.cws_sticky_template');
			var menu = jQuery('.site-header').length != 0 ? jQuery('.site-header') : jQuery('.cws_header_template');
		} else {
			var sticky = jQuery('.site-sticky.sticky-mobile');
			var menu = jQuery('.site-header-mobile');
		}

	} else if( jQuery('#site').hasClass('desktop-menu-both') ){

		if( windowWidth > 767 ){
			var sticky = jQuery('.site-sticky:not(.sticky-mobile)').length != 0 ? jQuery('.site-sticky:not(.sticky-mobile)') : jQuery('.cws_sticky_template');
			var menu = jQuery('.site-header').length != 0 ? jQuery('.site-header') : jQuery('.cws_header_template');
		} else {
			var sticky = jQuery('.site-sticky.sticky-mobile');
			var menu = jQuery('.site-header-mobile');
		}
	}

	if( sticky.length != 0 ){
		var startScroll = document.documentElement.scrollTop;
		var show = menu.height() * 2;

		if( startScroll > show ){
			sticky.addClass('active');
		}

		jQuery(window).scroll(function(){
			if( jQuery(this).scrollTop() > show ){
				sticky.addClass('active');
			} else {
				sticky.removeClass('active');
				sticky.find('.sub-menu').removeClass('active').slideUp(300);
			}
		});
	}
}
function cws_footer_on_bottom(){
	setTimeout(function(){

		var footer = jQuery('.cws_footer_template, #site-footer');
		var bodyHeight = jQuery('#site').height() - footer.outerHeight();
		var windowHeight = jQuery(window).height();

		if( !footer.hasClass('sticky_footer') ){
			if( windowHeight > bodyHeight && footer.outerHeight() + 100 < windowHeight - bodyHeight ){
				footer.addClass('bottom');
			} else {
				footer.removeClass('bottom');
			}
		}

	}, 300);
}
function cws_megamenu_pos(){
	if( !not_desktop() ){

		setTimeout(function(){
			var rightOffset = 0;
			if ( jQuery('.main-content-inner-wrap').length > 0 ) {
				var rightOffset = jQuery('.main-content-inner-wrap').offset().left;
			}

			jQuery('.menu-item-object-cws-megamenu').each(function(i, el) {

				var width = jQuery(el).find('.cws_megamenu_item').data('width');
				var position = jQuery(el).find('.cws_megamenu_item').data('position');

				if( width != 'full_width' ){
					if( width != 'content_width' ){
						jQuery(el).find('.sub-menu').css('width', width);
					}

					if( position == 'center' ){
						var menuOffset = jQuery(this).offset().left;
						var offset = menuOffset - rightOffset;

						jQuery(this).find('.sub-menu').css({
							'margin-left': '-'+offset+'px',
							'left': '0'
						});
					} else if( position == 'depend' ){
						var menuOffset = jQuery(this).offset().left;
						var menuWidth = jQuery(this).find('.sub-menu').width();
						var windowWidth = jQuery(window).width();

						if( menuWidth + menuOffset > windowWidth ){
							jQuery(this).find('.sub-menu').css({
								'left': 'auto',
								'right': '-10px'
							});
						}
					}
				} else {
					var menuOffset = jQuery(this).offset().left;
					jQuery(this).find('.sub-menu').css({
						'margin-left': '-'+menuOffset+'px',
						'width': '100vw'
					});
				}

			});

		}, 100);


	} else {
		jQuery('.menu-item-object-megamenu_item .sub-menu').css({
			'margin-left': '0',
			'width': '100vw'
		});
	}
}
function cws_sticky_footer(){
	var windowWidth = jQuery(window).width();
	var windowHeight = jQuery(window).height();
	var footerHeight = jQuery('.cws_footer_template, #site-footer').innerHeight();
	var bodyHeight = jQuery('#site').height();
	var footer = jQuery('.sticky_footer');
	var content = jQuery('.before_footer_shortcode').length != 0 ? jQuery('.before_footer_shortcode') : jQuery('.site-content');

	if( footer.length != 0 && windowWidth > 991 ){
		if( bodyHeight < windowHeight && windowHeight - bodyHeight < footerHeight ){
			footer.removeClass('sticky_footer');
			content.css('margin-bottom', '0');
		} else {
			content.css('margin-bottom', Math.round(footerHeight)+'px');
			content.css('padding-bottom', '100px');

			jQuery(window).scroll(function(){
				if( jQuery(this).scrollTop() < 100 && footerHeight > windowHeight / 2 ){
					footer.css('opacity', '0');
				} else {
					footer.css('opacity', '1');
				}
			});
		}
	} else {
		footer.css('opacity', '1');
		content.css('margin-bottom', '0');
	}
}
function cws_smooth_title(){
	var pageTitle = jQuery('.page_title_wrapper');

	if( pageTitle.length > 0 && !not_desktop() && jQuery('.page_title_container').hasClass('scroll_anim') ){
		var titleTop = pageTitle.offset().top;
		var titleHeight = pageTitle.innerHeight();
		var spaceToBtm = parseInt(jQuery('.page_title_container').css('padding-bottom'));

		jQuery(window).scroll(function(){
			if( jQuery(this).scrollTop() < titleTop + spaceToBtm ){

				var shift = (jQuery(this).scrollTop() + 1) / (titleTop + spaceToBtm) * 100;
				var opacity = 1 - (shift / 100);

				pageTitle.css('-webkit-transform', 'translateY('+shift+'px)');
				pageTitle.css('transform', 'translateY('+shift+'px)');
				pageTitle.css('opacity', opacity * 2);
			}
		});
	}
}
function cws_extended_services_size(){
	jQuery('.extended_services_shape').each(function(i, el){
		var scaleY = jQuery(el).parent().innerHeight() / 100;
		var scaleX = jQuery(el).parent().innerWidth() / 100;

		if( is_mobile() && jQuery(el).parent().hasClass('style_hexagon') ){
			jQuery(el).css('transform', 'translate(-50%, -50%) scale(2.9, 2.9)');
		} else {
			jQuery(el).css('transform', 'translate(-50%, -50%) scale('+scaleX+', '+scaleY+')');
		}
	});
}
function cws_close_info_box(){
	jQuery('.close_info_box').on('click', function(){
		jQuery(this).parents('.cws_info_box').fadeOut(300);
	});
}
function cws_progress_bar(){
	var wHeight = jQuery(window).height();

	jQuery('.cws_progress_bar_module').each(function(i, el){
		var top = jQuery(el).offset().top;
		var height = jQuery(el).innerHeight();
		var barWidth = parseInt(jQuery(el).find('.bar').data('percent'));
		var transition = barWidth * 20;

		jQuery(el).find('.bar').css({
			"transition": transition+"ms",
			"-webkit-transition": transition+"ms"
		});

		jQuery(window).scroll(function(){
			if( jQuery(this).scrollTop() + wHeight > top + height ){
				jQuery(el).find('.bar').addClass('visible').width( barWidth+'%' );
			}
		});

	});
}
function cws_progress_bar_width(){
	jQuery('.cws_progress_bar_module').each(function(i, el){
		var barWidth = parseInt(jQuery(el).find('.bar').data('percent'));
		var title = jQuery(el).children('p');
		var titleWidth = (title.width() + 15) / jQuery(el).width() * 100;

		if( barWidth < titleWidth ){
			jQuery(el).find('.percents').hide();
		} else {
			jQuery(el).find('.percents').show();
		}
	});
}
function cws_icons_wheel_init(){
	jQuery('.cws_icons_wheel_module').each(function(i, el){
		//Animate icons when module is visible
		var module_offset = jQuery(el).offset().top;
		var module_show = jQuery(el).innerHeight() / 2;

		if( jQuery(window).scrollTop() + (jQuery(window).height() - module_show) >= module_offset ){
			jQuery(el).find('.icons_wheel_wrapper').addClass('active');
			jQuery(el).find('.circle_wrapper').addClass('active');

			setTimeout(function(){
				jQuery(el).find('.icons_wheel_wrapper').addClass('done');
			}, 1400);
		}

		jQuery(window).on('scroll', function() {
			if( jQuery(window).scrollTop() + (jQuery(window).height() - module_show) >= module_offset ){
				jQuery(el).find('.icons_wheel_wrapper').addClass('active');
				jQuery(el).find('.circle_wrapper').addClass('active');

				setTimeout(function(){
					jQuery(el).find('.icons_wheel_wrapper').addClass('done');
				}, 1400);
			}
		});

		//Wait for animation
		setTimeout(function(){
			//Init main icons_wheel script
			if( jQuery(el).hasClass('on_hover') && !not_desktop() ){
				cws_icons_wheel(jQuery(el), 'hover');
			} else {
				cws_icons_wheel(jQuery(el), 'click');
			}

			//Module Autoplay
			if( jQuery(el).hasClass('autoplay') ){
				var speed = jQuery(el).data('speed');
				
				//Autoplay init
				var wheel_interval = setInterval(function() {
					cws_icons_wheel_autoplay(jQuery(el));
				}, speed);

				if( jQuery(el).hasClass('on_hover') && !not_desktop() ){
					//Remove autoplay on hover and start on hover off
					jQuery(el).find('.icon_wrapper').hover(function() {
						window.clearInterval(wheel_interval);
					}, function() {
						wheel_interval = setInterval(function() {
							cws_icons_wheel_autoplay( jQuery(el) );
						}, speed);
					});
				} else {
					//Remove autoplay on click
					jQuery(el).find('.icon_wrapper').on('click', function() {
						window.clearInterval(wheel_interval);
					});
				}
			}
		}, 1400);
	});
}

function cws_icons_wheel(el, active_trigger){
	jQuery(el).find('.icon_wrapper').on(active_trigger, function() {
		var trigger = jQuery(this).parent().data('trigger');

		jQuery(this).closest('.icons_wheel_wrapper').find('.icon_wrapper').removeClass('active');
		jQuery(this).addClass('active');

		jQuery(this).closest('.icons_wheel_wrapper').find('.icons_wheel_info').removeClass('active');
		jQuery(this).closest('.icons_wheel_wrapper').find('.icons_wheel_info[data-id="'+trigger+'"]').addClass('active');
	});
}

function cws_icons_wheel_autoplay(el, speed){
	var active_el = jQuery(el).find('.icon_wrapper.active');
	var nextEl = active_el.parent().nextAll('.icons_wheel_icon');
	nextEl = nextEl[0];

	if( typeof nextEl == 'undefined'){
		nextEl = jQuery(el).find('.icons_wheel_icon:first-child');
	}
	
	jQuery(el).find('.icon_wrapper').removeClass('active');
	jQuery(nextEl).find('.icon_wrapper').addClass('active');

	jQuery(el).find('.icons_wheel_info').removeClass('active');
	jQuery(nextEl).next('.icons_wheel_info').addClass('active');
}
function cws_column_animation(){
	setTimeout(function(){
		var animatedColumns = [];
		var checkScroll = 0;
		var windowHeight = jQuery(window).height();

		jQuery('.cws_column_wrapper.animated').each(function(i, el){
			var module_offset = jQuery(el).offset().top;
			var module_show = windowHeight - jQuery(el).innerHeight() / 2;

			animatedColumns[i] = [ jQuery(el), module_show, module_offset ];

			if( jQuery(window).scrollTop() + module_show >= module_offset ){
				jQuery(el).addClass('loaded');
			}
		});

		jQuery(window).on('scroll', function(){
			var currentScroll = jQuery(this).scrollTop();

			if( currentScroll > checkScroll + 150 ){
				jQuery(animatedColumns).each(function(i, el){
					if( currentScroll + el[1] >= el[2] ){
						el[0].addClass('loaded');
					}
				});

				checkScroll = currentScroll;
			}
		});
	}, 500);
}
function cws_milestone_shape_size(){
	jQuery('.cws_milestone_module').each(function(i, el){
		var width = jQuery(this).innerWidth() / 100;

		jQuery(this).children('svg').css('transform', 'scale('+width+')');
	});
}
function cws_milestones_count(){
	if( jQuery('.count_wrapper').length > 0 ){
		jQuery('.count_wrapper .counter').counterUp({
			delay: 10,
			time: 1000
		});
	}
}
function cws_particles_init(){
    var particles = [];
    var checkScroll = 0;
    var windowHeight = jQuery(window).height();

    var particlesAtts = [];
    var particlesColor = '#3e4a59';
    var particlesSpeed = 2;
    var particlesSize = 30;
    var particlesLinked = false;
    var particlesCount = 25;
    var particlesShape = 'image';
    var particlesMode = 'out';
    var particlesDirection = "none";
    var particlesStraight = false;
    var particlesRandomSize = false;
    var particlesRandomOpacity = false;
    var particlesHide = 767;
    var particleImages = '';
    var type = '';

    var imgSrc1, imgSrc2, imgSrc3, imgSrc4;

    jQuery('.particles-js').each(function(i, el) {

        var particlesID = jQuery(el).attr('id');
        var particlesOffset = jQuery(el).offset().top;
        var particlesEnd = jQuery(el).offset().top + jQuery(el).innerHeight();
        var particlesRun = windowHeight - jQuery(el).innerHeight() / 10;

        if( jQuery(el).data('hide') != undefined ){
            particlesHide = jQuery(el).data('hide');
        }

        particles[i] = [ jQuery(el), particlesRun, particlesOffset, particlesEnd, particlesHide ];

        if( jQuery(window).width() > particlesHide ){

            /* -----> Grab data attributes <----- */
            if( jQuery(el).data('color') != undefined ){
                particlesColor = jQuery(el).data('color');
            }
            if( jQuery(el).data('speed') != undefined ){
                particlesSpeed = jQuery(el).data('speed');
            }
            if( jQuery(el).data('size') != undefined ){
                particlesSize = jQuery(el).data('size');
            }
            if( jQuery(el).data('linked') != undefined ){
                particlesLinked = jQuery(el).data('linked') == 1 ? true : false;
            }
            if( jQuery(el).data('count') != undefined ){
                particlesCount = jQuery(el).data('count');
            }
            if( jQuery(el).data('shape') != undefined ){
                particlesShape = jQuery(el).data('shape');
            }
            if( jQuery(el).data('mode') != undefined ){
                particlesMode = jQuery(el).data('mode');
            }
            if( jQuery(el).data('direction') != undefined ){
                particlesDirection = jQuery(el).data('direction');
            }
            if( jQuery(el).data('straight') != undefined ){
                particlesStraight = jQuery(el).data('straight');
            }
            if( jQuery(el).data('random-size') != undefined ){
                particlesRandomSize = jQuery(el).data('random-size');
                particlesRandomSize = particlesRandomSize == 1 ? 'true' : 'false';
            }
            if( jQuery(el).data('random-opacity') != undefined ){
                particlesRandomOpacity = jQuery(el).data('random-opacity');
                particlesRandomOpacity = particlesRandomOpacity == 1 ? 'true' : 'false';
            }
            if( jQuery(el).data('images') != undefined ){
                particleImages = jQuery(el).data('images');

                jQuery(particleImages).each(function(i, el){
                    if( i == 0 ){
                        imgSrc1 = el.url;
                    } else if ( i == 1 ){
                        imgSrc2 = el.url;
                    } else if ( i == 2 ){
                        imgSrc3 = el.url;
                    } else if ( i == 3 ){
                        imgSrc4 = el.url;
                    }
                });
            }

            if( particleImages != '' ){
                type = ["image", "image2", "image3", "image4"];
            } else {
                type = particlesShape;
            }

            /* -----> Particles Atts <----- */
            particlesAtts[particlesID] = {
                "particles": {
                    "number": {
                        "value": particlesCount,
                        "density": {
                            "enable": false,
                            "value_area": 200
                        }
                    },
                    "color": {
                        "value": particlesColor
                    },
                    "shape": {
                        "type": type,
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 6
                        },
                        "image": {
                            "src": imgSrc1,
                            "width": 100,
                            "height": 100
                        },
                        "image2": {
                            "src": imgSrc2,
                            "width": 100,
                            "height": 100
                        },
                        "image3": {
                            "src": imgSrc3,
                            "width": 100,
                            "height": 100
                        },
                        "image4": {
                            "src": imgSrc4,
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 1,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 0.2,
                            "opacity_min": 0.5,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": particlesSize,
                        "random": particlesRandomSize,
                        "anim": {
                            "enable": false,
                            "speed": 4.5,
                            "size_min": particlesSize / 5,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": particlesLinked,
                        "distance": 150,
                        "color": particlesColor,
                        "opacity": 1,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": particlesSpeed,
                        "direction": particlesDirection,
                        "random": false,
                        "straight": particlesStraight,
                        "out_mode": particlesMode,
                        "attract": {
                            "enable": false,
                            "rotateX": 0,
                            "rotateY": 0
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": false,
                            "mode": "bubble"
                        },
                        "onclick": {
                            "enable": false,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "push": {
                            "particles_nb": 1
                        }
                    }
                },
                "retina_detect": true,
            }

            // Init particles if its into field of view
            if( jQuery(window).scrollTop() + particlesRun >= particlesOffset && jQuery(window).scrollTop() < particlesEnd ){
                particlesJS(particlesID, particlesAtts[particlesID]);
            }
        }
    });

    jQuery(window).on('scroll', function(){
        var currentScroll = jQuery(this).scrollTop();

        if( currentScroll > checkScroll + 150 || currentScroll < checkScroll - 150 ){
            jQuery(particles).each(function(i, el){

                // Init particles if its into field of view
                if( currentScroll + el[1] >= el[2] && currentScroll < el[3] && jQuery(window).width() > el[4] ) {
                    if( el[0].children().length < 1 ){
                        particlesJS(el[0].attr('id'), particlesAtts[el[0].attr('id')]);
                    }
                }
            });

            if( pJSDom.length > 0 ){
                jQuery(pJSDom).each(function(i, el){

                    var fieldOfView = currentScroll + windowHeight;
                    var particle = jQuery(el.pJS.canvas.el.parentElement);
                    var particleOffsetTop = jQuery(particle).offset().top;
                    var particleEnd = particleOffsetTop + jQuery(particle).innerHeight();

                    if( currentScroll < particleEnd && fieldOfView > particleOffsetTop ){
                        // Run & refresh particles once when it`s into field of view
                        if( pJSDom[i].pJS['onscreen'] === false ){
                            pJSDom[i].pJS.particles.move.enable = true;
                            pJSDom[i].pJS.fn.particlesRefresh();
                            pJSDom[i].pJS['onscreen'] = true;
                        }
                    } else {
                        // Pause particles once when it`s out of field of view
                        if( pJSDom[i].pJS['onscreen'] === true ){
                            pJSDom[i].pJS.particles.move.enable = false;
                            pJSDom[i].pJS['onscreen'] = false;
                        }
                    }

                });

            }

            checkScroll = currentScroll;
        }
    });
}
function cws_mask_on_vc_row(){
	jQuery('.cws-content').each(function(i, el){
		if( typeof jQuery(el).data('mask') != 'undefined' ){
			var mask_url = jQuery(el).data('mask');

			jQuery(el).children('.vc_row').css('-webkit-mask-image', 'url('+mask_url+')' );
		}
	});
}
function cws_smooth_comment_anchor(){
	jQuery('.page_title_wrapper .comments_count a').on('click', function(e){
		e.preventDefault();
        var target = jQuery(this).attr('href');

		jQuery('html, body').animate({ scrollTop: jQuery(target).offset().top - 60 }, 700);

	});
}
function cws_simple_staff_style(){
	if( not_desktop() ){
		jQuery('.cws_our_team_module').removeClass('style_advanced').addClass('style_simple');
	}
}
function cws_sticky_sidebar(){
	jQuery('.main-content-inner.sticky_sb').find('aside.sidebar').stickySidebar({ 
		topSpacing: 150,
		bottomSpacing: 40,
		minWidth: 1200
	});
}
function cws_3d_images(){
	jQuery('.cws_image_module.background_3d').each(function(i, el){

		var max_tilt = jQuery(el).data('max_tilt');
		var perspective = jQuery(el).data('perspective');
		var scale = jQuery(el).data('scale');
		var speed = jQuery(el).data('speed');

		var tilt = jQuery(el).tilt({
			maxTilt:        max_tilt,
			perspective:    perspective,
			easing:         "cubic-bezier(.03,.98,.52,.99)",
			scale:          scale,
			speed:          speed,
			transition:     true,
			disableAxis:    null,
			reset:          true,
			glare:          false,
			maxGlare:       1
		});

		tilt.tilt.reset.call(tilt);

	});
}
function cws_centered_menu(){
	if( !not_desktop() ){
		var logoWidth = jQuery('.site-header .menu-box .site_logotype').width();
		var rightInfoWidth = jQuery('.site-header .menu-box .menu-right-info').width();

		var minWidth = logoWidth < rightInfoWidth ? rightInfoWidth : logoWidth;

		jQuery('.site-header .menu-box .site_logotype, .site-header .menu-box .menu-right-info, .site-sticky .sticky-logo, .site-sticky' +
            ' .sticky-right-info').css('min-width', parseInt(minWidth)+'px');
	}
}
function cws_our_team_hover_on_devices(){
	if( not_desktop() ){
		jQuery('.cws_team_member').on('click', function(e){

			var this_is = jQuery(this);

			if( !this_is.hasClass('device_hover') ){
				e.preventDefault();

				jQuery('.cws_team_member').removeClass('device_hover');
				this_is.addClass('device_hover');
			}
		});
	}
}
function cws_product_hover_on_devices(){
	if( not_desktop() ){
		jQuery('ul.products > li.product').on('click', function(e){

			var this_is = jQuery(this);

			if( !this_is.hasClass('device_hover') ){
				e.preventDefault();

				jQuery('ul.products > li.product').removeClass('device_hover');
				this_is.addClass('device_hover');
			}
		});
	}
}
function cws_fix_layout_paddings(){
	var content = jQuery('.main-content-inner-wrap').text().replace(/\s/g,'');
	if( content.length == 0 ){
		jQuery('#site-content').css('padding-top', '0');
	}
}
function cws_tips_touch(){
	if( not_desktop() ){
		jQuery('.cws_tip').on('click', function(e){
			if( !jQuery(this).hasClass('active') ){
				e.preventDefault();
			}

			jQuery('.cws_tip').removeClass('active');
			jQuery(this).addClass('active');
		});

		jQuery('body').click(function(e) {
			if( jQuery(e.target).closest('.cws_tip').length === 0 ){
				jQuery('.cws_tip').removeClass('active');
			}
		});
	}
}
function cws_infinite_autoplay(){
	if( jQuery('.cws_ticker_content').length != 0 ){
		if (jQuery('body').hasClass('rtl')){
			jQuery('.cws_ticker_content').simplemarquee({direction: "right"});
		} else {
			jQuery('.cws_ticker_content').simplemarquee();
		}
	}
}

} ).call( this, jQuery )