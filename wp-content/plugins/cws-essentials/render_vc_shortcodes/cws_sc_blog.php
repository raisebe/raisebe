<?php

function cws_vc_shortcode_sc_blog ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"post_tax"					    => "",
		"orderby"					    => "date",
		"order"						    => "DESC",
		"layout"					    => "large",
		"enable_masonry"			    => false,
		"enable_carousel"			    => false,
		"post_hide_meta_override"	    => false,
		"post_hide_meta"			    => "",
		"total_items_count"			    => "-1",
		"items_pp"					    => get_theme_mod("blog_posts_per_page"),
		"chars_count"				    => get_theme_mod('blog_chars_count'),
		"el_class"					    => "",
		
		/* -----> STYLING TAB <----- */
        "add_title"                     => false,
        "title_size"                    => "25px",
        "title_line_height"             => "38px",
        "title_margin"                  => "20px",
        "title_color"                   => "#243238",
        "title_color_hover"             => SECONDARY_COLOR,
        
        "add_tags"                      => false,
        "tags_text_color"               => "#3b545f",
        "tags_text_color_hover"         => "#ffffff",
        "tags_bg_color"                 => "rgba(242, 242, 242, 0.7)",
        "tags_bg_color_hover"           => SECONDARY_COLOR,
        
        "add_divider"                   => false,
        "divider_margin"                => "10px",
        "divider_color_type"            => "custom_gradient",
        "divider_color"                 => PRIMARY_COLOR,
        "divider_gradient_start"        => PRIMARY_COLOR,
        "divider_gradient_finish"       => SECONDARY_COLOR,
        "divider_gradient_custom"       => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        
        "add_text"                      => false,
        "text_size"                     => "16px",
        "text_line_height"              => "32px",
        "text_margin"                   => "9px",
        "font_color"                    => "#3b545f",
        "font_accent_color"             => PRIMARY_COLOR,
        "font_accent_hover"             => SECONDARY_COLOR,
        
        "add_categories"                => false,
        "categories_size"               => "16px",
        "categories_line_height"        => "32px",
        "categories_margin"             => "9px",
        "categories_color"              => "#3b545f",
        "categories_color_hover"        => PRIMARY_COLOR,
        
        "add_meta"                      => false,
        "meta_margin"                   => "38px",
        "meta_border_color"             => "#fdeff9",
        "meta_text_color"               => "#3b545f",
        "meta_accent_color"             => SECONDARY_COLOR,
        "meta_text_color_hover"         => "#3b545f",
        
        "add_background"                => false,
        "background_color_type"         => "simple",
        "background_color"              => "#ffffff",
        "background_gradient_start"     => PRIMARY_COLOR,
        "background_gradient_finish"    => SECONDARY_COLOR,
        "background_gradient_angle"     => "154",
        "background_gradient_custom"    => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "border_color_type"             => "simple",
        "border_color"                  => "#f2f2f2",
        "border_gradient_start"         => "#f2f2f2",
        "border_gradient_finish"        => "#f2f2f2",
        "border_gradient_angle"         => "90",
        "border_gradient_custom"        => "background-image: linear-gradient(90deg, #f2f2f2 -8.57%, #f2f2f2 184.64%);",
        "border_active_color_type"      => "custom_gradient",
        "border_active_color"           => PRIMARY_COLOR,
        "border_active_gradient_start"  => PRIMARY_COLOR,
        "border_active_gradient_finish" => SECONDARY_COLOR,
        "border_active_gradient_angle"  => "90",
        "border_active_gradient_custom" => "background-image: linear-gradient(90deg, #f76331 -8.57%, #c01fb8 184.64%);",
        "add_shadow"                    => true,
        "shadow_css"                    => "20px 15px 25px rgba(80, 94, 100, 0.04)",
        "shadow_css_hover"              => "",
        
        "add_slider"                    => false,
        "pointer_color"                 => "#f4475c",
        "dots_color"                    => "#f2f2f2",
        "active_dots_color_type"        => "custom_gradient",
        "active_dots_color"             => PRIMARY_COLOR,
        "active_dots_gradient_start"    => PRIMARY_COLOR,
        "active_dots_gradient_finish"   => SECONDARY_COLOR,
        "active_dots_gradient_angle"    => "90",
        "active_dots_gradient_custom"   => "background-image: linear-gradient(105.13deg, #FEDA75 -53.56%, #FA7E1E 35.31%, #D62976 76.67%, #962FBF 141.02%, #4F5BD5 188.52%);",
        "arrow_color"                   => "#ffffff",
        "arrow_bg_color"                => "rgba(255, 255, 255, 0.4)",
        "arrow_color_hover"             => SECONDARY_COLOR,
        "arrow_bg_color_hover"          => "#ffffff",
        
        "add_button"                    => false,
        "button_margin"                 => "30px",
        
        /* -----> BUTTON TAB <----- */
        "btn_title"                     => "Read More",
        "btn_style"                     => "arrow_fade_in",
        "btn_size"                      => "medium",
        "btn_add_shadow"                => true,
        "btn_set_bg"                    => false,
        "btn_bg_color_type"             => "custom_gradient",
        "btn_bg_color"                  => PRIMARY_COLOR,
        "btn_bg_gradient_start"         => PRIMARY_COLOR,
        "btn_bg_gradient_finish"        => SECONDARY_COLOR,
        "btn_bg_gradient_angle"         => "90",
        "btn_bg_gradient_custom"        => "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
        "btn_bg_color_type_hover"       => "simple",
        "btn_bg_color_hover"            => PRIMARY_COLOR,
        "btn_bg_gradient_start_hover"   => PRIMARY_COLOR,
        "btn_bg_gradient_finish_hover"  => SECONDARY_COLOR,
        "btn_bg_gradient_angle_hover"   => "90",
        "btn_bg_gradient_custom_hover"  => "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
        "btn_set_color"                 => false,
        "btn_font_color"                => "#ffffff",
        "btn_font_color_hover"          => "#ffffff",
        "btn_set_border"                => false,
        "btn_border_color"              => "",
        "btn_border_color_hover"        => "",
        "btn_add_icon"                  => false,
        "icon_lib"						=> "FontAwesome",
	);

	$responsive_vars = array(
 		/* -----> RESPONSIVE TABS <----- */
 		"all" => array(
 			"custom_styles"		=> "",
 		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $tax_query = $count = "";
	$id = uniqid( "cws_blog_" );
    $icon = esc_attr(cws_ext_vc_sc_get_icon($atts));
    $total_items_count = $total_items_count == '-1' ? 999 : $total_items_count;
    if( $layout == 'def' ){
        $layout = get_theme_mod('blog_view') == 'large' ? '1' : get_theme_mod('blog_columns');
    }

	/* -----> Visual Composer Responsive styles <----- */
	list( $vc_desktop_class, $vc_landscape_class, $vc_portrait_class, $vc_mobile_class ) = vc_responsive_styles($atts);

	preg_match("/(?<=\{).+?(?=\})/", $vc_desktop_class, $vc_desktop_styles); 
	$vc_desktop_styles = implode($vc_desktop_styles);

	preg_match("/(?<=\{).+?(?=\})/", $vc_landscape_class, $vc_landscape_styles);
	$vc_landscape_styles = implode($vc_landscape_styles);

	preg_match("/(?<=\{).+?(?=\})/", $vc_portrait_class, $vc_portrait_styles);
	$vc_portrait_styles = implode($vc_portrait_styles);

	preg_match("/(?<=\{).+?(?=\})/", $vc_mobile_class, $vc_mobile_styles);
	$vc_mobile_styles = implode($vc_mobile_styles);

	/* -----> Customize default styles <----- */
    // Custom styles
	if( !empty($vc_desktop_styles) ){
		$styles .= "
			#".$id."{
				".$vc_desktop_styles."
			}
		";
	}
    
    // Title styles
    if (
        !empty($add_title) &&
        (
            !empty($title_size) ||
            !empty($title_line_height) ||
            !empty($title_margin) ||
            !empty($title_color)
        )
    ) {
        $styles .= "
            #" . $id . " .post .post-inner .post-information .post-title{" .
                (!empty($title_size) ? "font-size: " . esc_attr($title_size) . ";" : "") .
                (!empty($title_line_height) ? "line-height: " . esc_attr($title_line_height) . ";" : "") .
                (!empty($title_margin) ? "margin-top: " . esc_attr($title_margin) . ";" : "") .
                (!empty($title_color) ? "color: " . esc_attr($title_color) . ";" : "") .
            "}
        ";
    }
    if (
        !empty($add_title) &&
        (
            !empty($title_size) ||
            !empty($title_line_height)
        )
    ) {
        $styles .= "
            #" . $id . " .post.cws-alternate-view .post-media-wrapper .post-media,
            #" . $id . " .post.cws-alternate-view.format-quote .post-media-wrapper .post-media .media-quote{" .
                (!empty($title_size) ? "font-size: " . esc_attr($title_size) . ";" : "") .
                (!empty($title_line_height) ? "line-height: " . esc_attr($title_line_height) . ";" : "") .
            "}
        ";
    }
    if (
        !empty($add_title) && !empty($title_color)
    ) {
        $styles .= "
            #" . $id . " .post.cws-alternate-view.format-link .post-media-wrapper .post-media a{" .
                (!empty($title_color) ? "color: " . esc_attr($title_color) . ";" : "") .
            "}
        ";
    }
    
    // Tags styles
    if (
        !empty($add_tags) &&
        (
            !empty($tags_text_color) ||
            !empty($tags_bg_color)
        )
    ) {
        $styles .= "
            #" . $id . " .post .post-inner .post-information .post-tags a{" .
                (!empty($tags_text_color) ? "color: " . esc_attr($tags_text_color) . ";" : "") .
                (!empty($tags_bg_color) ? "background-color: " . esc_attr($tags_bg_color) . ";" : "") .
            "}
        ";
    }
    
    // Divider styles
    if ( !empty($add_divider) ) {
        if ( !empty($divider_margin) ) {
            $styles .= "
                #" . $id . " .post .post-inner .post-information .post-divider{
                    margin-top: " . esc_attr($divider_margin) . ";
                }
            ";
        }
        if (
            ($divider_color_type == 'simple' && !empty($divider_color)) ||
            ($divider_color_type == 'gradient') ||
            ($divider_color_type == 'custom_gradient' && !empty($divider_gradient_custom))
        ) {
            $styles .= "#" . $id . " .post .post-inner .post-information .post-divider .post-divider-inner {";
            if ($divider_color_type == 'simple' && !empty($divider_color)) {
                $styles .= "background: " . esc_attr($divider_color) . ";";
            }
            if ($divider_color_type == 'gradient') {
                $divider_gradient_start = !empty($divider_gradient_start) ? $divider_gradient_start : 'transparent';
                $divider_gradient_finish = !empty($divider_gradient_finish) ? $divider_gradient_finish : 'transparent';
                $styles .= "background-image: linear-gradient(90deg," . esc_attr($divider_gradient_start) . ', ' . esc_attr($divider_gradient_finish) . ");";
            }
            if ($divider_color_type == 'custom_gradient' && !empty($divider_gradient_custom)) {
                $styles .= esc_attr($divider_gradient_custom);
            }
            $styles .= "}";
        }
    }
    
    // Excerpt styles
    if ( !empty($add_text) ) {
        if (
            !empty($text_size) ||
            !empty($text_line_height) ||
            !empty($text_margin) ||
            !empty($font_color)
        ) {
            $styles .= "
                #" . $id . " .post .post-inner .post-information .post-content{" .
                    (!empty($text_size) ? "font-size: " . esc_attr($text_size) . ";" : "") .
                    (!empty($text_line_height) ? "line-height: " . esc_attr($text_line_height) . ";" : "") .
                    (!empty($text_margin) ? "margin-top: " . esc_attr($text_margin) . ";" : "") .
                    (!empty($font_color) ? "color: " . esc_attr($font_color) . ";" : "") .
                "}
            ";
        }
        if ( !empty($font_color) ) {
            $styles .= "
				#".$id." .post .post-inner .post-information .post-content li{
					color: ".esc_attr($font_color).";
				}
			";
        }
        if ( !empty($font_accent_color) ) {
            $styles .= "
				#".$id." .post .post-inner .post-information .post-content a,
				#".$id." .post .post-inner .post-information .post-content li:before{
					color: ".esc_attr($font_accent_color).";
				}
			";
        }
    }
    
    // Categories styles
    if ( !empty($add_categories) ) {
        if (
            !empty($categories_size) ||
            !empty($categories_line_height) ||
            !empty($categories_margin) ||
            !empty($categories_color)
        ) {
            $styles .= "
                #" . $id . " .post .post-inner .post-information .post-categories,
                #" . $id . " .post .post-inner .post-information .post-categories a{" .
                    (!empty($categories_size) ? "font-size: " . esc_attr($categories_size) . ";" : "") .
                    (!empty($categories_line_height) ? "line-height: " . esc_attr($categories_line_height) . ";" : "") .
                    (!empty($categories_margin) ? "margin-top: " . esc_attr($categories_margin) . ";" : "") .
                    (!empty($categories_color) ? "color: " . esc_attr($categories_color) . ";" : "") .
                "}
            ";
        }
    }
    
    // Meta styles
    if ( !empty($add_meta) ) {
        if ( !empty($meta_margin) ) {
            $styles .= "
                #" . $id . " .post .post-inner .post-information .post-footer{
                    margin-top: " . esc_attr($meta_margin) . ";
                }
            ";
        }
        if ( !empty($meta_text_color) ) {
            $styles .= "
                #" . $id . " .post .post-inner .post-information .post-footer .meta-item{
                    color: " . esc_attr($meta_text_color) . ";
                }
            ";
        }
        if ( !empty($meta_border_color) ) {
            $styles .= "
                #" . $id . " .post .post-inner .post-information .post-footer:before{
                    background-color: " . esc_attr($meta_border_color) . ";
                }
            ";
        }
        if ( !empty($meta_accent_color) ) {
            $styles .= "
                #" . $id . " .post .post-inner .post-information .post-footer .meta-item:not(:last-child):after{
                    background-color: " . esc_attr($meta_accent_color) . ";
                }
                #" . $id . " .post .post-inner .post-information .post-footer .meta-item.post-date:before,
                #" . $id . " .post .post-inner .post-information .post-footer .meta-item.comments_count:before{
                    color: " . esc_attr($meta_accent_color) . ";
                }
            ";
        }
    }
    
    // Background styles
    if ( !empty($add_background) ) {
        if (
            ($border_color_type == 'simple' && !empty($border_color)) ||
            ($border_color_type == 'gradient') ||
            ($border_color_type == 'custom_gradient' && !empty($border_gradient_custom)) ||
            (
                !empty($add_shadow) && !empty($shadow_css)
            )
        ) {
            $styles .= "
                #" . $id . " .post {
            ";
                if (
                    ($border_color_type == 'simple' && !empty($border_color)) ||
                    ($border_color_type == 'gradient') ||
                    ($border_color_type == 'custom_gradient' && !empty($border_gradient_custom))
                ) {
                    if ($border_color_type == 'simple' && !empty($border_color)) {
                        $styles .= "background: " . esc_attr($border_color) . ";";
                    }
                    if ($border_color_type == 'gradient') {
                        $border_gradient_start = !empty($border_gradient_start) ? $border_gradient_start : 'transparent';
                        $border_gradient_finish = !empty($border_gradient_finish) ? $border_gradient_finish : 'transparent';
                        $styles .= "background-image: linear-gradient(" . (int)esc_attr($border_gradient_angle) . "deg," . esc_attr($border_gradient_start) . ", " . esc_attr($border_gradient_finish) . ");";
                    }
                    if ($border_color_type == 'custom_gradient' && !empty($border_gradient_custom)) {
                        $styles .= esc_attr($border_gradient_custom);
                    }
                }
                if ( !empty($add_shadow) && !empty($shadow_css) ) {
                    $styles .= "-webkit-box-shadow: " . esc_attr($shadow_css) . ";";
                    $styles .= "-moz-box-shadow: " . esc_attr($shadow_css) . ";";
                    $styles .= "box-shadow: " . esc_attr($shadow_css) . ";";
                }
            $styles .= "
                }
            ";
        }
        if (
            ($background_color_type == 'simple' && !empty($background_color)) ||
            ($background_color_type == 'gradient') ||
            ($background_color_type == 'custom_gradient' && !empty($background_gradient_custom))
        ) {
            $styles .= "
                #" . $id . " .post .post-inner {
            ";
                if ($background_color_type == 'simple' && !empty($background_color)) {
                    $styles .= "background: " . esc_attr($background_color) . ";";
                }
                if ($background_color_type == 'gradient') {
                    $background_gradient_start = !empty($background_gradient_start) ? $background_gradient_start : 'transparent';
                    $background_gradient_finish = !empty($background_gradient_finish) ? $background_gradient_finish : 'transparent';
                    $styles .= "background-image: linear-gradient(90deg," . esc_attr($background_gradient_start) . ', ' . esc_attr($background_gradient_finish) . ");";
                }
                if ($background_color_type == 'custom_gradient' && !empty($background_gradient_custom)) {
                    $styles .= esc_attr($background_gradient_custom);
                }
            $styles .= "
                }
            ";
        }
        if (
            ($border_active_color_type == 'simple' && !empty($border_active_color)) ||
            ($border_active_color_type == 'gradient') ||
            ($border_active_color_type == 'custom_gradient' && !empty($border_active_gradient_custom))
        ) {
        
            $styles .= "
                #" . $id . " .post.sticky,
                #" . $id . " .post.cws-alternate-view.format-quote,
                #" . $id . " .post.cws-alternate-view.format-link .post-media-wrapper .post-media a:before
                #" . $id . " .post.sticky:before {
            ";
                if (
                    ($border_active_color_type == 'simple' && !empty($border_active_color)) ||
                    ($border_active_color_type == 'gradient') ||
                    ($border_active_color_type == 'custom_gradient' && !empty($border_active_gradient_custom))
                ) {
                    if ($border_active_color_type == 'simple' && !empty($border_active_color)) {
                        $styles .= "background: " . esc_attr($border_active_color) . ";";
                    }
                    if ($border_active_color_type == 'gradient') {
                        $border_active_gradient_start = !empty($border_active_gradient_start) ? $border_active_gradient_start : 'transparent';
                        $border_active_gradient_finish = !empty($border_active_gradient_finish) ? $border_active_gradient_finish : 'transparent';
                        $styles .= "background-image: linear-gradient(90deg," . esc_attr($border_active_gradient_start) . ', ' . esc_attr($border_active_gradient_finish) . ");";
                    }
                    if ($border_active_color_type == 'custom_gradient' && !empty($border_active_gradient_custom)) {
                        $styles .= esc_attr($border_active_gradient_custom);
                    }
                }
            $styles .= "
                }
            ";
        }
    }
    
    // Carousel styles
    if ( !empty($enable_carousel) && !empty($add_slider) ) {
        if ( !empty($dots_color) ) {
            $styles .= "
                #" . $id . " .cws_carousel .slick-dots li:not(.slick-active) button{
                    background: " . esc_attr($dots_color) . ";
                }
            ";
        }
        if (
            ($active_dots_color_type == 'simple' && !empty($active_dots_color)) ||
            ($active_dots_color_type == 'gradient') ||
            ($active_dots_color_type == 'custom_gradient' && !empty($active_dots_gradient_custom))
        ) {
            $styles .= "
                #" . $id . " .cws_carousel .slick-dots li.slick-active button {
            ";
                if ($active_dots_color_type == 'simple' && !empty($active_dots_color)) {
                    $styles .= "background: " . esc_attr($active_dots_color) . ";";
                }
                if ($active_dots_color_type == 'gradient') {
                    $active_dots_gradient_start = !empty($active_dots_gradient_start) ? $active_dots_gradient_start : 'transparent';
                    $active_dots_gradient_finish = !empty($active_dots_gradient_finish) ? $active_dots_gradient_finish : 'transparent';
                    $styles .= "background-image: linear-gradient(" . (int)esc_attr($active_dots_gradient_angle) . "deg," . esc_attr($active_dots_gradient_start) . ", " . esc_attr($active_dots_gradient_finish) . ");";
                }
                if ($active_dots_color_type == 'custom_gradient' && !empty($active_dots_gradient_custom)) {
                    $styles .= esc_attr($active_dots_gradient_custom);
                }
            $styles .= "
                }
            ";
        }
        if (
            !empty($arrow_color) ||
            !empty($arrow_bg_color)
        ) {
            $styles .= "
                #" . $id . " .cws_carousel_wrapper .cws_carousel .slick-arrow{" .
                    (!empty($arrow_color) ? "color: " . esc_attr($arrow_color) . ";" : "") .
                    (!empty($arrow_bg_color) ? "background-color: " . esc_attr($arrow_bg_color) . ";" : "") .
                "}
            ";
        }
    }
    
    // Button styles
    if ( !empty($add_button) && !empty($button_margin) ) {
        $styles .= "
            #" . $id . " .post .post-inner .post-information .blog-readmore-wrap{
                margin-top: " . esc_attr($button_margin) . ";
            }
        ";
    }
    if(
        !empty($add_button) &&
        (
            (
                !empty($btn_set_bg) &&
                (
                    ($btn_bg_color_type == 'simple' && !empty($btn_bg_color)) ||
                    ($btn_bg_color_type == 'gradient') ||
                    ($btn_bg_color_type == 'custom_gradient' && !empty($btn_bg_gradient_custom))
                )
            ) ||
            (
                !empty($btn_set_color) && !empty($btn_font_color)
            ) ||
            (
                !empty($btn_set_border) && !empty($btn_border_color)
            )
        )
    ) {
        $styles .= "
            #" . $id . " .post .post-inner .post-information .blog-readmore-wrap .cws_button{
        ";
            if (!empty($btn_set_bg)) {
                if ($btn_bg_color_type == 'simple' && !empty($btn_bg_color)) {
                    $styles .= "background-image: linear-gradient(90deg, " . esc_attr($btn_bg_color) . "," . esc_attr($btn_bg_color) . ");";
                }
                if ($btn_bg_color_type == 'gradient') {
                    $btn_bg_gradient_start = !empty($btn_bg_gradient_start) ? $btn_bg_gradient_start : 'transparent';
                    $btn_bg_gradient_finish = !empty($btn_bg_gradient_finish) ? $btn_bg_gradient_finish : 'transparent';
                    $btn_bg_gradient_angle = !empty($btn_bg_gradient_angle) ? (int)$btn_bg_gradient_angle . 'deg' : '0deg';
                    $styles .= "background-color: " . esc_attr($btn_bg_gradient_start) . ";";
                    $styles .= "background-image: linear-gradient(" . esc_attr($btn_bg_gradient_angle) . ', ' . esc_attr($btn_bg_gradient_start) . ', ' . esc_attr($btn_bg_gradient_finish) . ");";
                }
                if ($btn_bg_color_type == 'custom_gradient') {
                    $styles .= esc_attr($bg_gradient_custom);
                }
            }
            if (!empty($btn_set_color) && !empty($btn_font_color)) {
                $styles .= "color: " . esc_attr($btn_font_color) . ";";
            }
            if (!empty($btn_set_border)) {
                $styles .= "border: solid 1px transparent;";
            }
            if (!empty($btn_set_border) && !empty($btn_border_color)) {
                $styles .= "border-color: " . esc_attr($btn_border_color) . ";";
            }
        $styles .= "
            }
        ";
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    if (
        (
            !empty($add_title) && !empty($title_color_hover)
        ) ||
        (
            !empty($add_tags) &&
            (
                !empty($tags_text_color_hover) ||
                !empty($tags_bg_color_hover)
            )
        ) ||
        (
            !empty($add_text) && !empty($font_accent_hover)
        ) ||
        (
            !empty($add_categories) && !empty($categories_color_hover)
        ) ||
        (
            !empty($add_meta) && !empty($meta_text_color_hover)
        ) ||
        (
            !empty($add_background) && !empty($add_shadow) && !empty($shadow_css_hover)
        ) ||
        (
            !empty($enable_carousel) && !empty($add_slider) &&
            (
                !empty($arrow_color_hover) ||
                !empty($arrow_bg_color_hover)
            )
        ) ||
        (
            !empty($add_button) &&
            (
                !empty($btn_set_bg_hover) ||
                !empty($btn_set_color_hover) ||
                !empty($btn_set_border_hover)
            )
        ) ||
        (
            !empty($add_button) &&
            (
                (
                    !empty($btn_set_bg) &&
                    (
                        ($btn_bg_color_type_hover == 'simple' && !empty($btn_bg_color_hover)) ||
                        ($btn_bg_color_type_hover == 'gradient') ||
                        ($btn_bg_color_type_hover == 'custom_gradient' && !empty($btn_bg_gradient_custom_hover))
                    )
                ) ||
                (
                    !empty($btn_set_color) && !empty($btn_font_color_hover)
                ) ||
                (
                    !empty($btn_set_border) && !empty($btn_border_color_hover)
                )
            )
        )
    ) {
        $styles .= "
			@media
				screen and (min-width: 1367px),
				screen and (min-width: 1200px) and (any-hover: hover),
				screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
				screen and (min-width: 1200px) and (-ms-high-contrast: none),
				screen and (min-width: 1200px) and (-ms-high-contrast: active)
			{
		";
    
            if ( !empty($add_title) && !empty($title_color_hover) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-title a:hover,
                    #" . $id . " .post.cws-alternate-view.format-link .post-media-wrapper .post-media a:hover{
                        color: " . esc_attr($title_color_hover) . ";
                    }
                ";
            }
        
            if (
                !empty($add_tags) &&
                (
                    !empty($tags_text_color_hover) ||
                    !empty($tags_bg_color_hover)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-tags a:hover{" .
                        (!empty($tags_text_color_hover) ? "color: " . esc_attr($tags_text_color_hover) . ";" : "") .
                        (!empty($tags_bg_color_hover) ? "background-color: " . esc_attr($tags_bg_color_hover) . ";" : "") .
                    "}
                ";
            }
    
            if ( !empty($add_text) && !empty($font_accent_hover) ) {
                $styles .= "
                    #".$id." .post .post-inner .post-information .post-content a:hover{
                        color: ".esc_attr($font_accent_hover).";
                    }
                ";
            }
    
            if ( !empty($add_categories) && !empty($categories_color_hover) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-categories a:hover{
                        color: " . esc_attr($categories_color_hover) . ";
                    }
                ";
            }
    
            if ( !empty($add_meta) && !empty($meta_text_color_hover) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-footer .meta-item a:hover{
                        color: " . esc_attr($meta_text_color_hover) . ";
                    }
                ";
            }
    
            if ( !empty($add_background) && !empty($add_shadow) && !empty($shadow_css_hover) ) {
                $styles .= "
                    #" . $id . " .post:hover{
                        -webkit-box-shadow: " . esc_attr($shadow_css_hover) . ";
                        -moz-box-shadow: " . esc_attr($shadow_css_hover) . ";
                        box-shadow: " . esc_attr($shadow_css_hover) . ";
                    }
                ";
            }
    
            if (
                !empty($enable_carousel) && !empty($add_slider) &&
                (
                    !empty($arrow_color_hover) ||
                    !empty($arrow_bg_color_hover)
                )
            ) {
                $styles .= "
                    #" . $id . " .cws_carousel_wrapper .cws_carousel .slick-arrow:hover{" .
                        (!empty($arrow_color_hover) ? "color: " . esc_attr($arrow_color_hover) . ";" : "") .
                        (!empty($arrow_bg_color_hover) ? "background-color: " . esc_attr($arrow_bg_color_hover) . ";" : "") .
                    "}
                ";
            }
            
            if (
                !empty($add_button) &&
                (
                    (
                        !empty($btn_set_bg) &&
                        (
                            ($btn_bg_color_type_hover == 'simple' && !empty($btn_bg_color_hover)) ||
                            ($btn_bg_color_type_hover == 'gradient') ||
                            ($btn_bg_color_type_hover == 'custom_gradient' && !empty($btn_bg_gradient_custom_hover))
                        )
                    ) ||
                    (
                        !empty($btn_set_color) && !empty($btn_font_color_hover)
                    ) ||
                    (
                        !empty($btn_set_border) && !empty($btn_border_color_hover)
                    )
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .blog-readmore-wrap .cws_button:hover{
                ";
                    if (!empty($btn_set_bg)) {
                        if ($btn_bg_color_type_hover == 'simple' && !empty($btn_bg_color_hover)) {
                            $styles .= "background-image: linear-gradient(90deg, " . esc_attr($btn_bg_color_hover) . "," . esc_attr($btn_bg_color_hover) . ");";
                        }
                        if ($btn_bg_color_type_hover == 'gradient') {
                            $btn_bg_gradient_start_hover = !empty($btn_bg_gradient_start_hover) ? $btn_bg_gradient_start_hover : 'transparent';
                            $btn_bg_gradient_finish_hover = !empty($btn_bg_gradient_finish_hover) ? $btn_bg_gradient_finish_hover : 'transparent';
                            $btn_bg_gradient_angle_hover = !empty($btn_bg_gradient_angle_hover) ? (int)$btn_bg_gradient_angle_hover . 'deg' : '0deg';
                            $styles .= "background-color: " . esc_attr($btn_bg_gradient_start_hover) . ";";
                            $styles .= "background-image: linear-gradient(" . esc_attr($btn_bg_gradient_angle_hover) . ', ' . esc_attr($btn_bg_gradient_start_hover) . ', ' . esc_attr($btn_bg_gradient_finish_hover) . ");";
                        }
                        if ($btn_bg_color_type_hover == 'custom_gradient') {
                            $styles .= esc_attr($bg_gradient_custom_hover);
                        }
                    }
                    if (!empty($btn_set_color) && !empty($btn_font_color_hover)) {
                        $styles .= "color: " . esc_attr($btn_font_color_hover) . ";";
                    }
                    if (!empty($btn_set_border) && !empty($btn_border_color_hover)) {
                        $styles .= "border-color: " . esc_attr($btn_border_color_hover) . ";";
                    }
                $styles .= "
                    }
                ";
            }
    
        $styles .= "
			}
		";
    }
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if(
	    !empty($vc_landscape_styles) ||
        (
            !empty($add_title_landscape) &&
            (
                !empty($title_size_landscape) ||
                !empty($title_line_height_landscape) ||
                !empty($title_margin_landscape)
            )
        ) ||
        (
            !empty($add_divider_landscape) && !empty($divider_margin_landscape)
        ) ||
        (
            !empty($add_text_landscape) &&
            (
                !empty($text_size_landscape) ||
                !empty($text_line_height_landscape) ||
                !empty($text_margin_landscape)
            )
        ) ||
        (
            !empty($add_categories_landscape) &&
            (
                !empty($categories_size_landscape) ||
                !empty($categories_line_height_landscape) ||
                !empty($categories_margin_landscape)
            )
        ) ||
        (
            !empty($add_meta_landscape) && !empty($meta_margin_landscape)
        ) ||
        (
            !empty($add_button_landscape) && !empty($button_margin_landscape)
        )
    ){
		$styles .= "
			@media
				screen and (max-width: 1199px),
				screen and (max-width: 1366px) and (any-hover: none)
			{
		";
            if( !empty($vc_landscape_styles) ){
                $styles .= "
                    #".$id."{
                        ".$vc_landscape_styles."
                    }
                ";
            }
            
            if (
                !empty($add_title_landscape) &&
                (
                    !empty($title_size_landscape) ||
                    !empty($title_line_height_landscape) ||
                    !empty($title_margin_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-title{" .
                        (!empty($title_size_landscape) ? "font-size: " . esc_attr($title_size_landscape) . ";" : "") .
                        (!empty($title_line_height_landscape) ? "line-height: " . esc_attr($title_line_height_landscape) . ";" : "") .
                        (!empty($title_margin_landscape) ? "margin-top: " . esc_attr($title_margin_landscape) . ";" : "") .
                    "}
                ";
            }
            if (
                !empty($add_title_landscape) &&
                (
                    !empty($title_size_landscape) ||
                    !empty($title_line_height_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .post.cws-alternate-view .post-media-wrapper .post-media,
                    #" . $id . " .post.cws-alternate-view.format-quote .post-media-wrapper .post-media .media-quote{" .
                        (!empty($title_size_landscape) ? "font-size: " . esc_attr($title_size_landscape) . ";" : "") .
                        (!empty($title_line_height_landscape) ? "line-height: " . esc_attr($title_line_height_landscape) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_divider_landscape) && !empty($divider_margin_landscape) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-divider{
                        margin-top: " . esc_attr($divider_margin_landscape) . ";
                    }
                ";
            }
        
            if (
                !empty($add_text_landscape) &&
                (
                    !empty($text_size_landscape) ||
                    !empty($text_line_height_landscape) ||
                    !empty($text_margin_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-content{" .
                        (!empty($text_size_landscape) ? "font-size: " . esc_attr($text_size_landscape) . ";" : "") .
                        (!empty($text_line_height_landscape) ? "line-height: " . esc_attr($text_line_height_landscape) . ";" : "") .
                        (!empty($text_margin_landscape) ? "margin-top: " . esc_attr($text_margin_landscape) . ";" : "") .
                    "}
                ";
            }
        
            if (
                !empty($add_categories_landscape) &&
                (
                    !empty($categories_size_landscape) ||
                    !empty($categories_line_height_landscape) ||
                    !empty($categories_margin_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-categories,
                    #" . $id . " .post .post-inner .post-information .post-categories a{" .
                        (!empty($categories_size_landscape) ? "font-size: " . esc_attr($categories_size_landscape) . ";" : "") .
                        (!empty($categories_line_height_landscape) ? "line-height: " . esc_attr($categories_line_height_landscape) . ";" : "") .
                        (!empty($categories_margin_landscape) ? "margin-top: " . esc_attr($categories_margin_landscape) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_meta_landscape) && !empty($meta_margin_landscape) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-footer{
                        margin-top: " . esc_attr($meta_margin_landscape) . ";
                    }
                ";
            }
        
            if ( !empty($add_button_landscape) && !empty($button_margin_landscape) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .blog-readmore-wrap{
                        margin-top: " . esc_attr($button_margin_landscape) . ";
                    }
                ";
            }
            
        $styles .= "
            }
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if(
	    !empty($vc_portrait_styles) ||
        (
            !empty($add_title_portrait) &&
            (
                !empty($title_size_portrait) ||
                !empty($title_line_height_portrait) ||
                !empty($title_margin_portrait)
            )
        ) ||
        (
            !empty($add_divider_portrait) && !empty($divider_margin_portrait)
        ) ||
        (
            !empty($add_text_portrait) &&
            (
                !empty($text_size_portrait) ||
                !empty($text_line_height_portrait) ||
                !empty($text_margin_portrait)
            )
        ) ||
        (
            !empty($add_categories_portrait) &&
            (
                !empty($categories_size_portrait) ||
                !empty($categories_line_height_portrait) ||
                !empty($categories_margin_portrait)
            )
        ) ||
        (
            !empty($add_meta_portrait) && !empty($meta_margin_portrait)
        ) ||
        (
            !empty($add_button_portrait) && !empty($button_margin_portrait)
        )
    ){
        $styles .= "
			@media screen and (max-width: 991px){
		";
            if( !empty($vc_portrait_styles) ){
                $styles .= "
					#".$id."{
						".$vc_portrait_styles."
					}
				";
            }
        
            if (
                !empty($add_title_portrait) &&
                (
                    !empty($title_size_portrait) ||
                    !empty($title_line_height_portrait) ||
                    !empty($title_margin_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-title{" .
                        (!empty($title_size_portrait) ? "font-size: " . esc_attr($title_size_portrait) . ";" : "") .
                        (!empty($title_line_height_portrait) ? "line-height: " . esc_attr($title_line_height_portrait) . ";" : "") .
                        (!empty($title_margin_portrait) ? "margin-top: " . esc_attr($title_margin_portrait) . ";" : "") .
                    "}
                ";
            }
            if (
                !empty($add_title_portrait) &&
                (
                    !empty($title_size_portrait) ||
                    !empty($title_line_height_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .post.cws-alternate-view .post-media-wrapper .post-media,
                    #" . $id . " .post.cws-alternate-view.format-quote .post-media-wrapper .post-media .media-quote{" .
                        (!empty($title_size_portrait) ? "font-size: " . esc_attr($title_size_portrait) . ";" : "") .
                        (!empty($title_line_height_portrait) ? "line-height: " . esc_attr($title_line_height_portrait) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_divider_portrait) && !empty($divider_margin_portrait) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-divider{
                        margin-top: " . esc_attr($divider_margin_portrait) . ";
                    }
                ";
            }
        
            if (
                !empty($add_text_portrait) &&
                (
                    !empty($text_size_portrait) ||
                    !empty($text_line_height_portrait) ||
                    !empty($text_margin_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-content{" .
                        (!empty($text_size_portrait) ? "font-size: " . esc_attr($text_size_portrait) . ";" : "") .
                        (!empty($text_line_height_portrait) ? "line-height: " . esc_attr($text_line_height_portrait) . ";" : "") .
                        (!empty($text_margin_portrait) ? "margin-top: " . esc_attr($text_margin_portrait) . ";" : "") .
                    "}
                ";
            }
        
            if (
                !empty($add_categories_portrait) &&
                (
                    !empty($categories_size_portrait) ||
                    !empty($categories_line_height_portrait) ||
                    !empty($categories_margin_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-categories,
                    #" . $id . " .post .post-inner .post-information .post-categories a{" .
                        (!empty($categories_size_portrait) ? "font-size: " . esc_attr($categories_size_portrait) . ";" : "") .
                        (!empty($categories_line_height_portrait) ? "line-height: " . esc_attr($categories_line_height_portrait) . ";" : "") .
                        (!empty($categories_margin_portrait) ? "margin-top: " . esc_attr($categories_margin_portrait) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_meta_portrait) && !empty($meta_margin_portrait) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-footer{
                        margin-top: " . esc_attr($meta_margin_portrait) . ";
                    }
                ";
            }
        
            if ( !empty($add_button_portrait) && !empty($button_margin_portrait) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .blog-readmore-wrap{
                        margin-top: " . esc_attr($button_margin_portrait) . ";
                    }
                ";
            }
            
        $styles .= "
            }
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if(
	    !empty($vc_mobile_styles) ||
        (
            !empty($add_title_mobile) &&
            (
                !empty($title_size_mobile) ||
                !empty($title_line_height_mobile) ||
                !empty($title_margin_mobile)
            )
        ) ||
        (
            !empty($add_divider_mobile) && !empty($divider_margin_mobile)
        ) ||
        (
            !empty($add_text_mobile) &&
            (
                !empty($text_size_mobile) ||
                !empty($text_line_height_mobile) ||
                !empty($text_margin_mobile)
            )
        ) ||
        (
            !empty($add_categories_mobile) &&
            (
                !empty($categories_size_mobile) ||
                !empty($categories_line_height_mobile) ||
                !empty($categories_margin_mobile)
            )
        ) ||
        (
            !empty($add_meta_mobile) &&
            (
            !empty($meta_margin_mobile)
            )
        ) ||
        (
            !empty($add_button_mobile) && !empty($button_margin_mobile)
        )
    ){
        $styles .= "
			@media screen and (max-width: 767px){
		";
            if( !empty($vc_mobile_styles) ){
                $styles .= "
					#".$id."{
						".$vc_mobile_styles."
					}
				";
            }
        
            if (
                !empty($add_title_mobile) &&
                (
                    !empty($title_size_mobile) ||
                    !empty($title_line_height_mobile) ||
                    !empty($title_margin_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-title{" .
                        (!empty($title_size_mobile) ? "font-size: " . esc_attr($title_size_mobile) . ";" : "") .
                        (!empty($title_line_height_mobile) ? "line-height: " . esc_attr($title_line_height_mobile) . ";" : "") .
                        (!empty($title_margin_mobile) ? "margin-top: " . esc_attr($title_margin_mobile) . ";" : "") .
                    "}
                ";
            }
            if (
                !empty($add_title_mobile) &&
                (
                    !empty($title_size_mobile) ||
                    !empty($title_line_height_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .post.cws-alternate-view .post-media-wrapper .post-media,
                    #" . $id . " .post.cws-alternate-view.format-quote .post-media-wrapper .post-media .media-quote{" .
                        (!empty($title_size_mobile) ? "font-size: " . esc_attr($title_size_mobile) . ";" : "") .
                        (!empty($title_line_height_mobile) ? "line-height: " . esc_attr($title_line_height_mobile) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_divider_mobile) && !empty($divider_margin_mobile) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-divider{
                        margin-top: " . esc_attr($divider_margin_mobile) . ";
                    }
                ";
            }
        
            if (
                !empty($add_text_mobile) &&
                (
                    !empty($text_size_mobile) ||
                    !empty($text_line_height_mobile) ||
                    !empty($text_margin_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-content{" .
                        (!empty($text_size_mobile) ? "font-size: " . esc_attr($text_size_mobile) . ";" : "") .
                        (!empty($text_line_height_mobile) ? "line-height: " . esc_attr($text_line_height_mobile) . ";" : "") .
                        (!empty($text_margin_mobile) ? "margin-top: " . esc_attr($text_margin_mobile) . ";" : "") .
                    "}
                ";
            }
        
            if (
                !empty($add_categories_mobile) &&
                (
                    !empty($categories_size_mobile) ||
                    !empty($categories_line_height_mobile) ||
                    !empty($categories_margin_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-categories,
                    #" . $id . " .post .post-inner .post-information .post-categories a{" .
                        (!empty($categories_size_mobile) ? "font-size: " . esc_attr($categories_size_mobile) . ";" : "") .
                        (!empty($categories_line_height_mobile) ? "line-height: " . esc_attr($categories_line_height_mobile) . ";" : "") .
                        (!empty($categories_margin_mobile) ? "margin-top: " . esc_attr($categories_margin_mobile) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_meta_mobile) && !empty($meta_margin_mobile) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .post-footer{
                        margin-top: " . esc_attr($meta_margin_mobile) . ";
                    }
                ";
            }
        
            if ( !empty($add_button_mobile) && !empty($button_margin_mobile) ) {
                $styles .= "
                    #" . $id . " .post .post-inner .post-information .blog-readmore-wrap{
                        margin-top: " . esc_attr($button_margin_mobile) . ";
                    }
                ";
            }
        
        $styles .= "
            }
		";
	}
	/* -----> End of mobile styles <----- */

	cws__vc_styles($styles);

	/* -----> Filter by Titles, Category, Tags, Formats <----- */
//	if( !empty($atts['post_tax']) && $atts['post_tax'] != 'title' ){
    if(
        ( !empty($atts['post_tax']) && $atts['post_tax'] == 'category' && !empty($atts['post_category_terms']) ) ||
        ( !empty($atts['post_tax']) && $atts['post_tax'] == 'post_tag' && !empty($atts['post_post_tag_terms']) ) ||
        ( !empty($atts['post_tax']) && $atts['post_tax'] == 'post_format' && !empty($atts['post_post_format_terms']) )
    ){
		$tax_query = array(
			array(
				"taxonomy"	=> $atts['post_tax'],
				"field"		=> "slug",
				"operator"	=> "IN"
			)
		);

		if( $atts['post_tax'] == 'category' ){
			$terms = $atts['post_category_terms'];
			$tax_query[0]['terms'] = strripos($terms, ',') ? explode(',', $terms) : $terms;
		} else if( $atts['post_tax'] == 'post_tag' ){
			$terms = $atts['post_post_tag_terms'];
			$tax_query[0]['terms'] = strripos($terms, ',') ? explode(',', $terms) : $terms;
		} else if( $atts['post_tax'] == 'post_format' ){
			$terms = $atts['post_post_format_terms'];
			$tax_query[0]['terms'] = strripos($terms, ',') ? explode(',', $terms) : $terms;
		}
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

	$query_atts = array(
		'post_type'				=> 'post',
		'post_status'			=> 'publish',
		'posts_per_page'		=> $items_pp,
		'paged'					=> $paged,
		'tax_query'				=> $tax_query,
		'orderby'				=> $orderby,
		'order'					=> $order,
		'ignore_sticky_posts'	=> true
	);

	if( !empty($atts['post_tax']) && $atts['post_tax'] == 'title' && !empty($atts['titles']) ){
		$query_atts['post__in'] = explode(',', $atts['titles']);
	}

	$carousel_atts = 'data-columns='.esc_attr($layout).'';
	$carousel_atts .= $layout > 2 ? ' data-tablet-portrait=2' : '';
	$carousel_atts .= ' data-pagination=on';
	$carousel_atts .= ' data-navigation=on';
	$carousel_atts .= ' data-auto-height=on';
	$carousel_atts .= ' data-draggable=on';

	/* -----> Blog module output <----- */
	$q = new WP_Query( $query_atts );

	if ( $q->have_posts() ):
		ob_start();

		echo "<div id='".$id."' class='cws_blog_module_wrapper'>";

			echo '<div class="blog layout_'.$layout.'">';
				echo '<div class="content_inner '.($enable_masonry ? 'masonry' : '').'" data-columns="'.$layout.'">';

					if( $enable_carousel ){
						echo '<div class="cws_carousel_wrapper" '.esc_attr($carousel_atts).'>';
							echo '<div class="cws_carousel">';
					}

					while( $q->have_posts() && $count < $total_items_count ):
						$q->the_post(); 

						$extra_class = 'post';
						$link_title = cws_get_metabox('format_link_title');
		                $link_url = cws_get_metabox('format_link_url');
		                $quote = cws_get_metabox('format_quote');

		                if( (!empty($link_title) && !empty($link_url) && get_post_format() == 'link') || (!empty($quote) && get_post_format() == 'quote') ) {
		                    $extra_class .= ' cws-alternate-view';
		                }
					?>
						<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
							<div class="post-inner">
								<?php if( !empty(promosys__post_featured( $post_hide_meta )) ) : ?>
									<div class="post-media-wrapper">
										<!-- Featured Media -->
										<?php echo promosys__post_featured( $post_hide_meta, false, $layout ) ?>
									</div>
								<?php endif; ?>
								
								<div class='post-information'>
                                    <?php  if( (empty($link_title) && empty($link_url) || get_post_format() != 'link') && (empty($quote) ||
                                        get_post_format() != 'quote') ) { ?>
                                    
                                    <!-- Post Tags -->
                                    <?php echo promosys__post_tags($post_hide_meta) ?>
                                    
                                    <!-- Post Title -->
                                    <?php promosys__post_title($post_hide_meta) ?>
                                    
                                    <?php if ( strripos($post_hide_meta, 'title') === false && !empty(get_the_title()) && !empty(promosys__the_content($chars_count, $post_hide_meta)) ) : ?>
                                        <div class="post-divider">
                                            <div class="post-divider-inner"></div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Post Content -->
                                    <?php if( !empty(promosys__the_content($chars_count, $post_hide_meta)) ) : ?>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <?php echo promosys__the_content($chars_count, $post_hide_meta) ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Post Categories -->
                                    <?php promosys__post_category($post_hide_meta) ?>
                                    
                                    <!-- Post Read More Button -->
                                    <?php
                                        /* -----> Getting Icon <----- */
                                        if( !empty($icon_lib) ){
                                            $icon_output = '';
                                            if( $icon_lib == 'cws_svg' ){
                                                $icon = "icon_".$icon_lib;
                                                $svg_icon = json_decode(str_replace("``", "\"", $atts[$icon]), true);
                                                $upload_dir = wp_upload_dir();
                                                $this_folder = $upload_dir['basedir'] . '/cws-svgicons/' . md5($svg_icon['collection']) . '/';
            
                                                $icon_output .= "<i class='svg' style='width:".$svg_icon['width']."px; height:".$svg_icon['height']."px;'>";
                                                $icon_output .= file_get_contents($this_folder . $svg_icon['name']);
                                                $icon_output .= "</i>";
                                            } else {
                                                if( !empty($icon) ){
                                                    $icon_output .= '<i class="'.esc_attr($icon).'"></i>';
                                                }
                                            }
                                        }
    
                                        echo promosys__read_more($btn_title, $post_hide_meta, $btn_size, $btn_style, $btn_add_shadow, $icon_output);
                                    ?>
                                
                                <?php } ?>
                                    <!-- Post Footer -->
                                    <div class="post-footer">
                                        <?php
                                            promosys__post_author( $post_hide_meta );
                                            promosys__post_date( $post_hide_meta, 'simple' );
                                            promosys__post_comments( $post_hide_meta );
                                        ?>
                                    </div>
                                    
								</div>
							</div>
						</div>
					<?php $count++; endwhile;

					if( $enable_carousel ){
							echo '</div>';
						echo '</div>';
					}

				echo '</div>';
			echo '</div>';

			if( !$enable_carousel ) promosys__pagination( $q, $total_items_count, $items_pp );

		echo "</div>";

		wp_reset_postdata();
		$out .= ob_get_clean();
	endif;

	return $out;
}
add_shortcode( 'cws_sc_blog', 'cws_vc_shortcode_sc_blog' );

?>