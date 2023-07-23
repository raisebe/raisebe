<?php
defined( 'ABSPATH' ) or die();

// Logo Margins
if( get_theme_mod('logo_margins') ){
	$logo_margins = get_theme_mod('logo_margins');
}
if( get_theme_mod('footer_logo_margins') ){
	$footer_logo_margins = get_theme_mod('footer_logo_margins');
	foreach( $footer_logo_margins as $key => $value ){
		promosys__define_style('.footer-logo', array(
			'margin-'.$key => esc_attr($value)
		));
	}
}


/*
----> Boxed styles
*/
promosys__define_style('body[data-boxed="true"] .site.wrap', array(
	'background-color' => esc_attr(get_theme_mod('boxed_bg_color', '#fff'))
));


/*
----> Copyrights styles
*/
if( get_theme_mod('footer_spacings') ){
    $footer_paddings = get_theme_mod('footer_spacings');
    foreach( $footer_paddings as $key => $value ){
        promosys__define_style('.site-footer .footer-copyright', array(
            'padding-'.$key => esc_attr($value)
        ));
    }
}
promosys__define_style('
    .site-footer .footer-copyright p,
    .site-footer .footer-copyright .footer_logotype .sitename,
    .site-footer .wpm-language-switcher.switcher-list li,
    .site-footer .wpm-language-switcher.switcher-list li span,
	.site-footer .wpm-language-switcher.switcher-list li a', array(
        'color' => esc_attr(get_theme_mod('copyright_color', '#ffffff'))
));
promosys__define_style('
    .site-footer .wpm-language-switcher.switcher-select', array(
        'background-color' => esc_attr(get_theme_mod('copyright_color', '#ffffff'))
));
promosys__define_style('
    .site-footer .wpm-language-switcher.switcher-list li img', array(
        'border-color' => esc_attr(get_theme_mod('copyright_color', '#ffffff'))
));

if( get_theme_mod('footer_bg_type') == 'color' && !empty(get_theme_mod('footer_bg_color')) ){
    promosys__define_style('
        .site-footer', array(
            'background-color' => esc_attr(get_theme_mod('footer_bg_color', PRIMARY_COLOR))
    ));
}
if( get_theme_mod('footer_bg_type') == 'simple_gradient' ){
    promosys__define_style('.site-footer', array(
        'background' => '-webkit-linear-gradient('.esc_attr(get_theme_mod('footer_bg_gradient_angle', '140')).'deg, '.esc_attr(get_theme_mod('footer_bg_gradient_1', PRIMARY_COLOR)).', '.esc_attr(get_theme_mod('footer_bg_gradient_2', SECONDARY_COLOR)).');',
        'background' => 'linear-gradient('.esc_attr(get_theme_mod('footer_bg_gradient_angle', '140')).'deg, '.esc_attr(get_theme_mod('footer_bg_gradient_1', PRIMARY_COLOR)).', '.esc_attr(get_theme_mod('footer_bg_gradient_2', SECONDARY_COLOR)).');'
    ));
}


/*
----> Typography styles
*/
foreach( PROMOSYS_FONTS as $font ){
	$family = 'sans-serif';
	$color = esc_html(get_theme_mod($font.'_font_color', '#000'));
	$size = esc_html(get_theme_mod($font.'_font_size', '18px'));
	$height = esc_html(get_theme_mod($font.'_font_height', 'initial'));

	if( get_theme_mod($font.'_font_family') ){
		$family = esc_html( get_theme_mod($font.'_font_family') );
		$family = explode(',', $family);
		$family = $family[0];
	}

	if( $font == 'body' ){
		promosys__define_style( '
		        body, 
		        select
		', array(
			'font-family' 	=> $family,
			'color'			=> $color,
			'font-size'		=> $size,
			'line-height'	=> $height,
		) );
		promosys__define_style( '
		        .cws-widget ul li a,
		        .vc_toggle .vc_toggle_title .vc_toggle_icon,
		        body.wpb-js-composer .vc_tta-controls-icon,
		        .woocommerce.single .content-area .site-main > .type-product .woocommerce-tabs .tabs li a,
		        .wp-block-categories-list li > a,
		        .wp-block-archives-list li > a
		    ', array(
			    'color'			   => $color,
		) );
		promosys__define_style( '
		        .cws-widget .calendar_wrap table caption,
		        .wp-block-calendar table caption
		    ', array(
			    'background-color' => $color,
		) );
		promosys__define_style( '
		        .custom_sidebars_wrapper .sidebar .cws-widget .widget-title,
		        .cancel-reply,
		        .cws_service_module.icon_shape_ellipse .service_content_wrapper .service_title .service_title_text,
		        .cws_service_module.icon_shape_triangle .service_content_wrapper .service_title .service_title_text,
		        .wp-block-calendar table tr,
		        .cws_milestone_module .milestone_title,
		        blockquote
		    ', array(
                'font-family' 	   => $family,
		) );
	} else if( $font == 'menu' ){
		promosys__define_style( '
		    .cws_header_template .menu-main-container > .menu > .menu-item > a,
		    .cws_sticky_template .menu-main-container > .menu > .menu-item > a,
		    .site-header .menu-main-container > .menu > .menu-item > a,
		    .site-sticky .menu-main-container > .menu > .menu-item > a
		    ', array(
                'font-family' 	=> $family,
                'font-size'		=> $size,
                'line-height'	=> $height,
		) );
	} else if( $font == 'titles' ){
		promosys__define_style( '
				h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6,
				body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab > a,
				.sidebar .cws-widget .widget-title,
				.cws-widget.widget_recent_entries ul li a,
				div.wpforms-container-full .wpforms-form .wpforms-head-container .wpforms-title,
				.cws-widget .recentcomments > a,
				.cws-widget.widget_rss ul li a.rsswidget,
				.post-navigation .nav-links li .post-nav-text-wrapper .post-title,
				.comment-body .comment-meta .comment-admin,
				.cws-widget .product_list_widget li a,
				.mini-cart .woo_mini_cart .woo_items_count,
				.mini-cart .woo_mini_cart ul li .cart-item-title,
				ul.products li.product .woocommerce-loop-product__title,
				ul.products li.product .woocommerce-loop-category__title,
				.woocommerce.single .content-area .site-main > .type-product .summary .woocommerce-product-rating .woocommerce-review-link,
				.quantity input,
				.woocommerce.single .content-area .site-main > .type-product .woocommerce-tabs .woocommerce-Tabs-panel .commentlist li .comment_container .comment-text .comment-header .woocommerce-review__author,
				.woocommerce-cart .woocommerce-cart-form > .shop_table th,
				.woocommerce-cart .woocommerce-cart-form > .shop_table .amount,
				.woocommerce-cart .woocommerce-cart-form > .shop_table tr.cart_item td.product-name,
				.wp-block-search .wp-block-search__label,
				.wp-block-rss .wp-block-rss__item .wp-block-rss__item-title,
				.wp-block-latest-posts li > a,
				.wp-block-latest-comments .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta .wp-block-latest-comments__comment-link,
				.cws_tips_module .cws_tips_wrapper .cws_tip .tip_info_wrapper p,
				.cws_popup_video_module .video-link .icon_title
			', array(
				'font-family' 	=> $family,
				'color'			=> $color,
			)
		);
        promosys__define_style( '
                .woocommerce-pagination ul.page-numbers li a,
                .woocommerce-pagination ul.page-numbers li span,
                .woocommerce-pagination ul.page-numbers > span,
                .woocommerce-pagination ul.page-numbers > a,
                .paging-navigation:not(.load_more) .pagination li a,
                .paging-navigation:not(.load_more) .pagination li span,
                .paging-navigation:not(.load_more) .pagination > span,
                .paging-navigation:not(.load_more) .pagination > a,
                .post.cws-alternate-view.format-link .post-media-wrapper .post-media a,
                .post.cws-alternate-view.format-quote .post-media-wrapper .post-media .media-quote p:before,
                .post-format.format_quote blockquote > p:before,
                .post-format.format_link a,
                .woocommerce.single .content-area .site-main > .type-product div[class*="woocommerce-product-gallery"] .woocommerce-product-gallery__trigger,
                .woocommerce.single .content-area .site-main > .type-product .woocommerce-tabs .tabs li.active a,
                .woocommerce.single .content-area .site-main > .type-product .woocommerce-tabs .woocommerce-Tabs-panel .shop_attributes th,
                .woocommerce-cart .woocommerce-cart-form > .shop_table tr.cart_item td.product-remove .remove,
                .portfolio-single-content .portfolio-content-wrapper .aside-part .label,
                .main_member_info .text-information .experience,
                .main_member_info .social-icons-wrapper .label
			', array(
                'color'			=> $color,
            )
        );
        promosys__define_style( '
                .cws-widget .price_slider_wrapper .price_slider_amount .button:hover,
                .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button:not(.checkout),
                .mini-cart .woo_mini_cart .woocommerce-mini-cart__buttons a.button:not(.checkout),
                .woocommerce-cart .woocommerce-cart-form .cws_coupon .coupon button
			', array(
                'background'	=> $color,
            )
        );
		promosys__define_style( '
				.title_ff,
				.woocommerce-breadcrumb,
				.breadcrumbs-wrapper,
				.cws_breadcrumbs_module,
				.cws_header_template .sub-menu .menu-item > a,
                .cws_sticky_template .sub-menu .menu-item > a,
                .site-header .sub-menu .menu-item > a,
                .site-sticky .sub-menu .menu-item > a,
                .site-search .search-form .label .search-field,
                .site-search .search-form .label .search-field::placeholder,
                .wpm-language-switcher a,
                .cws_textmodule .cws_textmodule_content,
                .info_box_title,
                .banner_title,
                .testimonial,
                .cws-widget .calendar_wrap table caption,
                .wp-block-calendar table caption,
                .post-navigation .nav-links li .post-nav-link,
                .woocommerce .shop_top_info_wrapper .woocommerce-result-count,
                .woocommerce .shop_top_info_wrapper .woocommerce-ordering .orderby,
                .cws-widget .price_slider_wrapper .price_slider_amount .button,
                .widget_shopping_cart_content .woocommerce-mini-cart__buttons a.button,
                .mini-cart .woo_mini_cart .woocommerce-mini-cart__buttons a.button,
                ul.products li.product .cws_buttons_wrapper .button,
                .woocommerce.single .content-area .site-main > .type-product .summary .product_categories,
                .woocommerce.single .content-area .site-main > .type-product .summary .cart button,
                .woocommerce.single .content-area .site-main > .type-product .woocommerce-tabs .tabs li a,
                #review_form_wrapper .comment-form .comment-notes,
                #review_form_wrapper .comment-form label,
                .woocommerce-cart .woocommerce-cart-form > .shop_table .product-quantity,
                .woocommerce-cart .woocommerce-cart-form .cart_totals .shop_table,
                .woocommerce-info,
                .woocommerce-error,
                .woocommerce-message,
                .woocommerce-info a.showcoupon,
                .woocommerce-info a.button,
                .woocommerce-error a.showcoupon,
                .woocommerce-error a.button,
                .woocommerce-message a.showcoupon,
                .woocommerce-message a.button,
                body.woocommerce-checkout .checkout_coupon p,
                form.woocommerce-checkout .woocommerce-checkout-review-order,
                .woocommerce.single .content-area .site-main > .type-product .summary .cart .woocommerce-grouped-product-list .woocommerce-grouped-product-list-item__label label,
                .woocommerce.single .content-area .site-main > .type-product .summary .cart .woocommerce-grouped-product-list .woocommerce-grouped-product-list-item__price,
                .cws_portfolio_module .portfolio-filter .portfolio-filter-trigger,
                .cws_portfolio_module .cws_portfolio_items .cws_portfolio_item .text_info .meta,
                .search-trigger .search-trigger-text,
                .menu-right-info .cws_button,
                cws_milestone_module div.milestone_title
			', array(
				'font-family' 	=> $family,
			)
		);
	}
}


/*
----> Sticky styles
*/
if( get_theme_mod('sticky_spacings') ){
	$sticky_paddings = get_theme_mod('sticky_spacings');
	foreach( $sticky_paddings as $key => $value ){
		promosys__define_style('.site-sticky:not(.sticky-mobile) > .container', array(
			'padding-'.$key => esc_attr($value)
		));
	}
}
promosys__define_style('.site-sticky', array(
	'background-color' => esc_attr(get_theme_mod('sticky_background', '#ffffff'))
));
promosys__define_style('.site-sticky.shadow', array(
	'-webkit-box-shadow' => '0 0 20px 0 '.esc_attr(get_theme_mod('sticky_shadow_color', 'rgba(16,1,148, 0.1)')),
	'-moz-box-shadow' => '0 0 20px 0 '.esc_attr(get_theme_mod('sticky_shadow_color', 'rgba(16,1,148, 0.1)')),
	'box-shadow' => '0 0 20px 0 '.esc_attr(get_theme_mod('sticky_shadow_color', 'rgba(16,1,148, 0.1)'))
));
promosys__define_style('
    .site-sticky .search-trigger,
	.site-sticky .mini_cart_trigger,
	.site-sticky.sticky-mobile  .mini_cart_trigger,
	
	.sticky-right-info .wpm-language-switcher.switcher-list li,
	.sticky-right-info .wpm-language-switcher.switcher-list li a,
	
	.cws_sticky_template .menu-main-container > .menu > .menu-item,
	.site-sticky .menu-main-container > .menu > .menu-item', array(
	    'color' => esc_attr(get_theme_mod('sticky_font_color', '#243238')
    )
));
promosys__define_style('
	.site-sticky.sticky-mobile .menu-trigger span,
	.sticky-right-info .wpm-language-switcher.switcher-select', array(
	    'background-color' => esc_attr(get_theme_mod('sticky_font_color', '#243238'))
    )
);
promosys__define_style('
    .site-sticky .wpm-language-switcher.switcher-select,
    .site-sticky .wpm-language-switcher.switcher-list li img,
    .site-sticky .wpm-language-switcher.switcher-dropdown .item-language-main > span', array(
        'border-color' => esc_attr(get_theme_mod('sticky_font_color', '#243238'))
    )
);
promosys__define_style('
	.cws_sticky_template .menu-main-container > .menu > .menu-item.current-menu-item,
	.cws_sticky_template .menu-main-container > .menu > .menu-item.current-menu-ancestor,
	.cws_sticky_template .menu-main-container > .menu > .menu-item.current-item-parent,
	.sticky-right-info .wpm-language-switcher.switcher-list li.active span,
	
	.site-sticky .menu-main-container > .menu > .menu-item.current-menu-item,
	.site-sticky .menu-main-container > .menu > .menu-item.current-item-parent,
	.site-sticky .menu-main-container > .menu > .menu-item.current-menu-ancestor', array(
	    'color' => esc_attr(get_theme_mod('sticky_accent_font_color', PRIMARY_COLOR))
    )
);
promosys__define_style('
    .sticky-right-info .extra-button .cws_button', array(
        'color' => esc_attr(get_theme_mod('sticky_extra_button_font_color', "#3B545F"))
    )
);
promosys__define_style('
    .sticky-right-info .extra-button .cws_button', array(
        'border-color' => esc_attr(get_theme_mod('sticky_extra_button_bd_color', "#3B545F"))
    )
);
promosys__define_style('
    .sticky-right-info .extra-button .cws_button', array(
        'background-color' => esc_attr(get_theme_mod('sticky_extra_button_bg_color'))
    )
);

/*
----> Top Bar styles
*/
if( get_theme_mod('top_bar_spacings') ){
	$top_bar_paddings = get_theme_mod('top_bar_spacings');
	foreach( $top_bar_paddings as $key => $value ){
		promosys__define_style('.site-header .top-bar-box', array(
			'padding-'.$key => esc_attr($value)
		));
	}
}
promosys__define_style('.site-header .top-bar-box', array(
	'background-color' => esc_attr(get_theme_mod('top_bar_bg_color', '#FFFFFF'))
));
promosys__define_style('.site-header .top-bar-box:before', array(
	'background-color' => esc_attr(get_theme_mod('top_bar_border_color', '#CCCCCC'))
));
promosys__define_style('.site-header .header_icons > * ~ .mini-cart:not(:first-child) .woo_mini-count', array(
	'border-color' => esc_attr(get_theme_mod('top_bar_border_color', '#CCCCCC'))
));
promosys__define_style('
    .site-header .top-bar-box .container > *,
	.site-header .top-bar-box .container > * > a,
	.site-header .header_icons > .mini-cart > a,
	.site-header .wishlist_products_counter_number,
	.site-header .cws_compare_count,
	.site-header .woo_mini-count > span', array(
		'color' => esc_attr(get_theme_mod('top_bar_font_color', 'rgba(255,255,255,.5)'))
	)
);


/*
----> Header general styles
*/
if( get_theme_mod('header_bg_type') == 'color' && !empty(get_theme_mod('header_bg_color')) ){
    promosys__define_style('.site-header', array(
        'background-color' => esc_attr(get_theme_mod('header_bg_color'))
    ));
}
if( get_theme_mod('header_bg_type') == 'simple_gradient' ){
    promosys__define_style('.site-header', array(
        'background' => '-webkit-linear-gradient('.esc_attr(get_theme_mod('header_bg_gradient_angle', '140')).'deg, '.esc_attr(get_theme_mod('header_bg_gradient_1', PRIMARY_COLOR)).', '.esc_attr(get_theme_mod('header_bg_gradient_2', SECONDARY_COLOR)).');',
        'background' => 'linear-gradient('.esc_attr(get_theme_mod('header_bg_gradient_angle', '140')).'deg, '.esc_attr(get_theme_mod('header_bg_gradient_1', PRIMARY_COLOR)).', '.esc_attr(get_theme_mod('header_bg_gradient_2', SECONDARY_COLOR)).');'
    ));
}
if( get_theme_mod('add_header_overlay') && !empty(get_theme_mod('header_overlay_color')) ){
    promosys__define_style('.site-header-overlay', array(
        'background-color' => esc_attr(get_theme_mod('header_overlay_color'))
    ));
}



/*
----> Title Area styles
*/
if( get_theme_mod('title_area_spacings') ){
	$title_paddings = get_theme_mod('title_area_spacings');
    foreach( $title_paddings as $key => $value ){
        promosys__define_style('.page_title_container', array(
            'padding-'.$key => esc_attr($value)
        ));
    }
}
if( get_theme_mod('mobile_title_area_spacings') ){
	$mobile_title_paddings = get_theme_mod('mobile_title_area_spacings');
	foreach( $mobile_title_paddings as $key => $value ){
		promosys__define_style('.site-header-mobile .page_title_container', array(
		    'padding-'.$key => esc_attr($value)
        ));
	}
}
promosys__define_style('body:not(.single) .page_title_container .page_title_customizer_size', array( 
	'font-size' => esc_attr(get_theme_mod('title_archive_font_size'))
));
promosys__define_style('body.single .page_title_container .page_title_customizer_size', array( 
	'font-size' => esc_attr(get_theme_mod('title_single_font_size'))
));

if( get_theme_mod('title_bg_type') == 'color' && !empty(get_theme_mod('title_bg_color')) ){
    promosys__define_style('.page_title_container:not(.custom)', array(
        'background-color' => esc_attr(get_theme_mod('title_bg_color'))
    ));
}
if( get_theme_mod('title_bg_type') == 'simple_gradient' ){
    promosys__define_style('.page_title_container:not(.custom)', array(
        'background' => '-webkit-linear-gradient('.esc_attr(get_theme_mod('title_bg_gradient_angle', '140')).'deg, '.esc_attr(get_theme_mod('title_background_gradient_1', PRIMARY_COLOR)).', '.esc_attr(get_theme_mod('title_background_gradient_2', SECONDARY_COLOR)).');',
        'background' => 'linear-gradient('.esc_attr(get_theme_mod('title_bg_gradient_angle', '140')).'deg, '.esc_attr(get_theme_mod('title_background_gradient_1', PRIMARY_COLOR)).', '.esc_attr(get_theme_mod('title_background_gradient_2', SECONDARY_COLOR)).');'
    ));
}

if( get_theme_mod('add_title_overlay') && !empty(get_theme_mod('title_overlay')) ){
    promosys__define_style('.page_title_overlay', array(
        'background-color' => esc_attr(get_theme_mod('title_overlay'))
    ));
}

promosys__define_style('.page_title_container .page_title_customizer_size .page_title', array(
    'color' => esc_attr(get_theme_mod('title_title_color', '#ffffff'))
));

promosys__define_style('.page_title_container:not(.custom) .page_title_wrapper, .page_title_container:not(.custom) .page_title_wrapper a', array(
	'color' => esc_attr(get_theme_mod('title_text_color', '#ffffff'))
));
promosys__define_style('.page_title_container .title_divider svg', array(
	'fill' => esc_attr(get_theme_mod('title_divider_color', '#ffffff'))
));


/*
----> Menu styles
*/
if( get_theme_mod('menu_spacings') ){
	$menu_paddings = get_theme_mod('menu_spacings');
	foreach( $menu_paddings as $key => $value ){
		promosys__define_style('.menu-main-container.header_menu > ul > .menu-item > a', array(
			'padding-'.$key => esc_attr($value).' !important'
		));
	}
}
promosys__define_style('
	.cws_header_template .menu-main-container > .menu > .menu-item,
	.site-header .menu-main-container > .menu > .menu-item,
	
	.site-header .site_logotype .sitename,
	.site-header .search-trigger,
	.site-header .wpm-language-switcher.switcher-list li,
	.site-header .wpm-language-switcher.switcher-list li a,
	.site-header .mini_cart_trigger', array(
		'color' => esc_attr(get_theme_mod('menu_font_color', '#ffffff'))
	)
);
promosys__define_style('
    .site-header .custom_sidebar_trigger .hamburger,
    .site-header .wpm-language-switcher.switcher-select', array(
	    'background-color' => esc_attr(get_theme_mod('menu_font_color', '#ffffff')) . ' !important'
    )
);
promosys__define_style('
    .site-header .wpm-language-switcher.switcher-select,
    .site-header .wpm-language-switcher.switcher-list li img,
    .site-header .wpm-language-switcher.switcher-dropdown .item-language-main > span', array(
        'border-color' => esc_attr(get_theme_mod('menu_font_color', '#ffffff'))
    )
);
promosys__define_style('
    .cws_header_template .menu-main-container > .menu > .menu-item.current-menu-item,
    .cws_header_template .menu-main-container > .menu > .menu-item.current-menu-ancestor,
    .cws_header_template .menu-main-container > .menu > .menu-item.current-item-parent,
    .site-header .wpm-language-switcher.switcher-list li.active span,
	
	.site-header .menu-main-container > .menu > .menu-item.current-menu-item,
	.site-header .menu-main-container > .menu > .menu-item.current-item-parent,
	.site-header .menu-main-container > .menu > .menu-item.current-menu-ancestor', array(
	    'color' => esc_attr(get_theme_mod('menu_accent_font_color', '#FFEA74'))
    )
);
promosys__define_style('
    .cws_header_template .menu-main-container .sub-menu .menu-item,
	.cws_sticky_template .menu-main-container .sub-menu .menu-item,
	.site-header .menu-main-container .sub-menu .menu-item,
	.site-sticky .menu-main-container .sub-menu .menu-item', array(
		'color' => esc_attr(get_theme_mod('submenu_font_color', '#243238'))
	)
);
promosys__define_style('
    .cws_header_template .menu-main-container .sub-menu .menu-item.current-menu-item,
    .cws_header_template .menu-main-container .sub-menu .menu-item.current-menu-ancestor,
    .cws_header_template .menu-main-container .sub-menu .menu-item.current-item-parent,
    
	.cws_sticky_template .menu-main-container .sub-menu .menu-item.current-menu-item,
	.cws_sticky_template .menu-main-container .sub-menu .menu-item.current-menu-ancestor,
	.cws_sticky_template .menu-main-container .sub-menu .menu-item.current-item-parent,
	
	.site-header .menu-main-container .sub-menu .menu-item.current-menu-item,
	.site-header .menu-main-container .sub-menu .menu-item.current-menu-ancestor,
	.site-header .menu-main-container .sub-menu .menu-item.current-item-parent,
	
	.site-sticky .menu-main-container .sub-menu .menu-item.current-menu-item,
	.site-sticky .menu-main-container .sub-menu .menu-item.current-item-parent,
	.site-sticky .menu-main-container .sub-menu .menu-item.current-menu-ancestor', array(
		'color' => esc_attr(get_theme_mod('submenu_font_color_hover', PRIMARY_COLOR))
	)
);
promosys__define_style('
    .menu-right-info .extra-button .cws_button', array(
        'color' => esc_attr(get_theme_mod('menu_extra_button_font_color', "#fff"))
    )
);
promosys__define_style('
    .menu-right-info .extra-button .cws_button', array(
        'border-color' => esc_attr(get_theme_mod('menu_extra_button_bd_color', "#fff"))
    )
);
promosys__define_style('
    .menu-right-info .extra-button .cws_button', array(
        'background-color' => esc_attr(get_theme_mod('menu_extra_button_bg_color'))
    )
);

/*
----> Mobile menu styles
*/
if( get_theme_mod('mobile_menu_spacings') ){
	$mobile_menu_paddings = get_theme_mod('mobile_menu_spacings');
	foreach( $mobile_menu_paddings as $key => $value ){
		promosys__define_style('
		    .site-header-mobile .top-bar-box,
		    .sticky-mobile
		', array(
			'padding-'.$key => esc_attr($value)
		));
	}
}
promosys__define_style('
	.site-header-mobile .top-bar-box,
	.site-sticky.sticky-mobile', array( 
		'background-color' => esc_attr(get_theme_mod('mobile_topbar_bg', "#fff"))
	)
);
promosys__define_style('
	.site-header-mobile .menu-trigger span', array(
		'background-color' => esc_attr(get_theme_mod('mobile_icons_color', '#000'))
	)
);
promosys__define_style('
	.site-header-mobile .top-bar-box .container .mini-cart > a,
	.site-header-mobile .top-bar-box .site_logotype .sitename
	', array(
		'color' => esc_attr(get_theme_mod('mobile_icons_color', '#000'))
	)
);
promosys__define_style('
	.site-header-mobile .menu-main-container > .menu > .menu-item,
	.site-header-mobile .menu-box .menu-box-info .menu-box-info-item,
	.site-header-mobile .wpm-language-switcher.switcher-list li span,
	.site-header-mobile .wpm-language-switcher.switcher-list li a
	', array(
		'color' => esc_attr(get_theme_mod('mobile_menu_font_color', 'rgba(74,74,74,0.8)'))
	)
);
promosys__define_style('
	.site-header-mobile .menu-main-container > .menu > .menu-item.active,
	.site-header-mobile .menu-main-container > .menu > .menu-item.current-menu-item,
	.site-header-mobile .menu-main-container > .menu > .menu-item.current-item-parent', array(
		'color' => esc_attr(get_theme_mod('mobile_accent_font_color', 'rgba(255,255,255,0.8)'))
	)
);
promosys__define_style('
	.site-header-mobile .menu-main-container > .menu > .menu-item > a', array(
        'background-color' => esc_attr(get_theme_mod('mobile_menu_bg_color', '#fff'))
    )
);
promosys__define_style('
	.site-header-mobile .menu-main-container > .menu > .menu-item.active > a,
	.site-header-mobile .menu-main-container > .menu > .menu-item.current-menu-item > a,
	.site-header-mobile .menu-main-container > .menu > .menu-item.current-item-parent > a', array(
        'background-color' => esc_attr(get_theme_mod('mobile_accent_bg_color', PRIMARY_COLOR))
    )
);
promosys__define_style('
	.site-header-mobile .menu-main-container .sub-menu .menu-item', array(
        'color' => esc_attr(get_theme_mod('mobile_submenu_color', 'rgba(74,74,74,0.8)'))
    )
);
promosys__define_style('
	.site-header-mobile .menu-main-container .sub-menu .menu-item.active,
	.site-header-mobile .menu-main-container .sub-menu .menu-item.current-menu-item,
	.site-header-mobile .menu-main-container .sub-menu .menu-item.current-item-parent', array(
        'color' => esc_attr(get_theme_mod('mobile_submenu_accent_color', PRIMARY_COLOR))
    )
);
promosys__define_style('
    .site-header-mobile .menu-box .extra-button .cws_button', array(
        'color' => esc_attr(get_theme_mod('mobile_extra_button_font_color'))
    )
);
promosys__define_style('
    .site-header-mobile .menu-box .extra-button .cws_button', array(
        'border-color' => esc_attr(get_theme_mod('mobile_extra_button_bd_color'))
    )
);
promosys__define_style('
    .site-header-mobile .menu-box .extra-button .cws_button', array(
        'background-color' => esc_attr(get_theme_mod('mobile_extra_button_bg_color'))
    )
);


/*
----> Responsive styles
*/
promosys__define_style('start-responsive', array(
    'desktop' => 'start'
));

// Sticky Menu
promosys__define_style('
	.site-sticky .search-trigger:hover,
    .site-sticky .mini_cart_trigger:hover,
    .cws_sticky_template .menu-main-container > .menu > .menu-item:hover,
    .site-sticky .menu-main-container .wpm-language-switcher.switcher-list li a:hover,
    .site-sticky .menu-main-container > .menu > .menu-item:hover', array(
		'color' => esc_attr(get_theme_mod('sticky_accent_font_color', SECONDARY_COLOR))
	)
);
promosys__define_style('
    .site-sticky .wpm-language-switcher.switcher-dropdown .item-language-main:hover > span,
    .site-sticky .wpm-language-switcher.switcher-list li a:hover img', array(
        'border-color' => esc_attr(get_theme_mod('sticky_accent_font_color', SECONDARY_COLOR))
    )
);

promosys__define_style('
    .sticky-right-info .extra-button .cws_button:not(:disabled):hover', array(
        'color' => esc_attr(get_theme_mod('sticky_extra_button_font_color_hover', "#fff"))
    )
);
promosys__define_style('
    .sticky-right-info .extra-button .cws_button:not(:disabled):hover', array(
        'border-color' => esc_attr(get_theme_mod('sticky_extra_button_bd_color_hover', "#3B545F"))
    )
);
promosys__define_style('
    .sticky-right-info .extra-button .cws_button:not(:disabled):hover', array(
        'background-color' => esc_attr(get_theme_mod('sticky_extra_button_bg_color_hover', "#3B545F"))
    )
);

// Menu styles
promosys__define_style('
    .cws_header_template .menu-main-container .sub-menu .menu-item:hover,
	.cws_sticky_template .menu-main-container .sub-menu .menu-item:hover,
	.site-header .menu-main-container .sub-menu .menu-item:hover,
	.site-sticky .menu-main-container .sub-menu .menu-item:hover', array(
	    'color' => esc_attr(get_theme_mod('submenu_font_color_hover', PRIMARY_COLOR))
    )
);
promosys__define_style('
    .custom_sidebar_trigger:hover .hamburger', array(
        'background-color' => esc_attr(get_theme_mod('menu_accent_font_color', '#FFEA74'))
    )
);
promosys__define_style('
    .site-header .search-trigger:hover,
    .site-header .mini_cart_trigger:hover,
    .cws_header_template .menu-main-container > .menu > .menu-item:hover,
	.site-header .menu-main-container > .menu > .menu-item:hover,
	.menu-main-container .wpm-language-switcher.switcher-list li a:hover', array(
	    'color' => esc_attr(get_theme_mod('menu_accent_font_color', '#FFEA74'))
    )
);
promosys__define_style('
    .site-header .wpm-language-switcher.switcher-dropdown .item-language-main:hover > span,
    .site-header .wpm-language-switcher.switcher-list li a:hover img', array(
        'border-color' => esc_attr(get_theme_mod('menu_accent_font_color', '#FFEA74'))
    )
);
promosys__define_style('
    .menu-right-info .extra-button .cws_button:not(:disabled):hover', array(
        'color' => esc_attr(get_theme_mod('menu_extra_button_font_color_hover', "#000"))
    )
);
promosys__define_style('
    .menu-right-info .extra-button .cws_button:not(:disabled):hover', array(
        'border-color' => esc_attr(get_theme_mod('menu_extra_button_bd_color_hover', "#fff"))
    )
);
promosys__define_style('
    .menu-right-info .extra-button .cws_button:not(:disabled):hover', array(
        'background-color' => esc_attr(get_theme_mod('menu_extra_button_bg_color_hover', "#fff"))
    )
);

// Menu Mobile
promosys__define_style('
    .site-header-mobile .menu-box .extra-button .cws_button:not(:disabled):hover', array(
        'color' => esc_attr(get_theme_mod('mobile_extra_button_font_color_hover'))
    )
);
promosys__define_style('
    .site-header-mobile .menu-box .extra-button .cws_button:not(:disabled):hover', array(
        'border-color' => esc_attr(get_theme_mod('mobile_extra_button_bd_color_hover'))
    )
);
promosys__define_style('
    .site-header-mobile .menu-box .extra-button .cws_button:not(:disabled):hover', array(
        'background-color' => esc_attr(get_theme_mod('mobile_extra_button_bg_color_hover'))
    )
);

// Top Bar
promosys__define_style('
	.top-bar-box .container > * > a:hover,
	.top-bar-box .container .header_icons .search-trigger:hover,
	.header_icons > .mini-cart > a:hover', array(
		'color' => esc_attr(get_theme_mod('top_bar_font_color_hover', '#fff'))
	)
);

// Title Area styles
promosys__define_style('.page_title_container:not(.custom) .page_title_wrapper a:hover', array(
    'color' => esc_attr(get_theme_mod('title_text_color_hover', '#FFEA74'))
));

promosys__define_style('end-responsive', array(
    'desktop' => 'end'
));