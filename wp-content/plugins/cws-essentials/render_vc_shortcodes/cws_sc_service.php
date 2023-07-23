<?php
function cws_vc_shortcode_sc_service ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
        "icon_img"                          => "icon",
        "icon_lib"						    => "FontAwesome",
        "image"							    => "",
        "title"                             => "",
		"url"							    => "",
		"new_tab"						    => true,
		"el_class"						    => "",
		
		/* -----> STYLING TAB <----- */
        "style"                             => "icon_top",
        "vertical_align"                    => "flex-start",
        "icon_shape"					    => "none",
        "image_shape"					    => "rounded",
        "icon_color_type"			        => "simple",
        "icon_color"			            => "#243238",
        "icon_gradient_start"			    => PRIMARY_COLOR,
        "icon_gradient_finish"			    => SECONDARY_COLOR,
        "icon_gradient_angle"			    => "154",
        "icon_gradient_custom"			    => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "shape_front_color_type"            => "simple",
        "shape_front_color"                 => "",
        "shape_front_gradient_start"        => PRIMARY_COLOR,
        "shape_front_gradient_finish"       => SECONDARY_COLOR,
        "shape_front_gradient_angle"        => "154",
        "shape_front_gradient_custom"       => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "shape_back_color_type"             => "simple",
        "shape_back_color"                  => "#FAF5FE",
        "shape_back_gradient_start"         => PRIMARY_COLOR,
        "shape_back_gradient_finish"        => SECONDARY_COLOR,
        "shape_back_gradient_angle"         => "154",
        "shape_back_gradient_custom"        => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "add_icon_hover"                    => false,
        "icon_color_type_hover"             => "simple",
        "icon_color_hover"                  => "#243238",
        "icon_gradient_start_hover"         => PRIMARY_COLOR,
        "icon_gradient_finish_hover"        => SECONDARY_COLOR,
        "icon_gradient_angle_hover"         => "154",
        "icon_gradient_custom_hover"        => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "shape_front_color_type_hover"      => "simple",
        "shape_front_color_hover"           => "",
        "shape_front_gradient_start_hover"  => PRIMARY_COLOR,
        "shape_front_gradient_finish_hover" => SECONDARY_COLOR,
        "shape_front_gradient_angle_hover"  => "154",
        "shape_front_gradient_custom_hover" => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "shape_back_color_type_hover"       => "simple",
        "shape_back_color_hover"            => "#FAF5FE",
        "shape_back_gradient_start_hover"   => PRIMARY_COLOR,
        "shape_back_gradient_finish_hover"  => SECONDARY_COLOR,
        "shape_back_gradient_angle_hover"   => "154",
        "shape_back_gradient_custom_hover"  => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        
        "title_tag"                         => "h5",
        "title_color_type"                  => "simple",
        "title_color"                       => "#243238",
        "title_gradient_start"              => PRIMARY_COLOR,
        "title_gradient_finish"             => SECONDARY_COLOR,
        "title_gradient_angle"              => "154",
        "title_gradient_custom"             => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "add_title_hover"                   => false,
        "title_color_type_hover"            => "simple",
        "title_color_hover"                 => "#243238",
        "title_gradient_start_hover"        => PRIMARY_COLOR,
        "title_gradient_finish_hover"       => SECONDARY_COLOR,
        "title_gradient_angle_hover"        => "154",
        "title_gradient_custom_hover"       => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        
        "divider_color_type"                => "simple",
        "divider_color"                     => PRIMARY_COLOR,
        "divider_gradient_start"            => PRIMARY_COLOR,
        "divider_gradient_finish"           => SECONDARY_COLOR,
        "divider_gradient_custom"           => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "add_divider_hover"                 => false,
        "divider_color_type_hover"          => "simple",
        "divider_color_hover"               => PRIMARY_COLOR,
        "divider_gradient_start_hover"      => PRIMARY_COLOR,
        "divider_gradient_finish_hover"     => SECONDARY_COLOR,
        "divider_gradient_custom_hover"     => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        
        "font_color"                        => "#3b545f",
        "font_accent_color"                 => PRIMARY_COLOR,
        "font_accent_hover"                 => SECONDARY_COLOR,
        "add_text_hover"                    => false,
        "font_color_hover"                  => "#3b545f",
        "font_accent_color_hover"           => PRIMARY_COLOR,
        "font_accent_hover_hover"           => SECONDARY_COLOR,
        
        "add_background"                    => false,
        "background_color_type"             => "simple",
        "background_color"                  => "",
        "background_gradient_start"         => PRIMARY_COLOR,
        "background_gradient_finish"        => SECONDARY_COLOR,
        "background_gradient_angle"         => "154",
        "background_gradient_custom"        => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "add_background_hover"              => false,
        "background_color_type_hover"       => "simple",
        "background_color_hover"            => "",
        "background_gradient_start_hover"   => PRIMARY_COLOR,
        "background_gradient_finish_hover"  => SECONDARY_COLOR,
        "background_gradient_angle_hover"   => "154",
        "background_gradient_custom_hover"  => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "hover"                             => "none",
        "add_shadow"                        => false,
        "shadow_css"                        => "",
        "shadow_css_hover"                  => "",
	);

	$responsive_vars = array(
		"all" => array(
            "customize_align"                   => false,
            "module_alignment"                  => "center",
            "custom_styles"                     => "",
            
            "add_icon"                          => false,
            "icon_size"					        => "50px",
            "icon_margin"					    => "",
            
            "add_title"                         => false,
            "title_size"                        => "20px",
            "title_line_height"                 => "29px",
            "title_margin"                      => "23px",
            
            "add_divider"                       => false,
            "divider_margin"                    => "",
            
            "add_text"                          => false,
            "text_size"                         => "16px",
            "text_line_height"                  => "32px",
            "text_margin"                       => "9px",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$icon = esc_attr(cws_ext_vc_sc_get_icon($atts));
	$image_alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
	$image = !empty($image) ? wp_get_attachment_image_src($image, 'full')[0] : '';
	$content = apply_filters( "the_content", $content );
	$id = uniqid( "cws_service_" );
	$title = wp_kses( $title, array(
		"b"			=> array(),
		"strong"	=> array(),
		"mark"		=> array(),
		"br"		=> array()
	));

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
	if(
	    !empty($vc_desktop_styles) ||
        (
            (
                $style == 'icon_left' ||
                $style == 'icon_right'
            ) && !empty($vertical_align)
        ) ||
        $customize_align
    ){
	    $flex_align = '';
	    if ( ($style == 'icon_left' || $style == 'icon_right') && $customize_align ) {
	        if ($module_alignment == 'left') {
                $flex_align = 'flex-start';
            } elseif ($module_alignment == 'right') {
                $flex_align = 'flex-end';
            } elseif ($module_alignment == 'center') {
                $flex_align = 'center';
            }
        }
		$styles .= "
			#" . $id . "{".
                (!empty($vc_desktop_styles) ? $vc_desktop_styles : "") .
                (($style == 'icon_left' || $style == 'icon_right') && !empty($vertical_align) ? "-webkit-align-items: ".$vertical_align."; -moz-align-items: ".$vertical_align."; -ms-align-items: ".$vertical_align."; align-items: ".$vertical_align.";" : "") .
                ($customize_align ? "text-align: ".$module_alignment.";" : "") .
                (($style == 'icon_left' || $style == 'icon_right') && $customize_align ? "-webkit-justify-content: ".$flex_align."; -moz-justify-content: ".$flex_align."; -ms-justify-content: ".$flex_align."; justify-content: ".$flex_align.";" : "") .
			"}
		";
	}
 
	// Icon color styles
    if (
        !empty($add_icon) && ($icon_img == 'icon') && !empty($icon) && (
            (!empty($icon_size)) ||
            ($icon_color_type == 'simple' && !empty($icon_color)) ||
            ($icon_color_type == 'gradient') ||
            ($icon_color_type == 'custom_gradient' && !empty($icon_gradient_custom))
        )
    ) {
        $styles .= "#".$id." .service_icon_wrapper i{";
    
        $styles .= (!empty($icon_size) ? "font-size: " . esc_attr($icon_size) . ";" : "");
        
        if ( $icon_color_type == 'simple' && !empty($icon_color) ) {
            $styles .= "color: ".esc_attr($icon_color).";";
        }
        if ( $icon_color_type == 'gradient' ) {
            $icon_gradient_start = !empty($icon_gradient_start) ? $icon_gradient_start : 'transparent';
            $icon_gradient_finish = !empty($icon_gradient_finish) ? $icon_gradient_finish : 'transparent';
            $icon_gradient_angle = !empty($icon_gradient_angle) ? (int)$icon_gradient_angle.'deg' : '0deg';
            $styles .= "background-image: linear-gradient(".esc_attr($icon_gradient_angle).', '.esc_attr($icon_gradient_start).', '.esc_attr($icon_gradient_finish).");";
        }
        if ( $icon_color_type == 'custom_gradient' && !empty($icon_gradient_custom) ) {
            $styles .= esc_attr($icon_gradient_custom);
        }
        $styles .= "}";
    } elseif (!empty($add_icon) && ($icon_img == 'image') && !empty($image) && !empty($icon_size)) {
        $styles .= "
            #".$id." .service_image_wrapper img{
               max-height: " . esc_attr($icon_size) . ";
            }
        ";
    }
    if ( !empty($add_icon) && !empty($icon_margin) ) {
        if ( $icon_img == 'icon' && !empty($icon) ) {
            $styles .= "
                #".$id." .service_icon_wrapper{
                   margin: " . esc_attr($icon_margin) . ";
                }
            ";
        }
        if ( $icon_img == 'image' && !empty($image) ) {
            $styles .= "
                #".$id." .service_image_wrapper{
                   margin: " . esc_attr($icon_margin) . ";
                }
            ";
        }
    }
    // Icon shape styles
    if (
        !empty($add_icon) && ($icon_img == 'icon') && !empty($icon) && $icon_shape != 'none'
    ) {
        if (
            ($shape_front_color_type == 'simple' && !empty($shape_front_color)) ||
            ($shape_front_color_type == 'gradient') ||
            ($shape_front_color_type == 'custom_gradient' && !empty($shape_front_gradient_custom))
        ) {
            $styles .= "
                #".$id." .service_icon_wrapper .shape_front{";
                if ( $shape_front_color_type == 'simple' && !empty($shape_front_color) ) {
                    $styles .= "background: ".esc_attr($shape_front_color).";";
                }
                if ( $shape_front_color_type == 'gradient' ) {
                    $shape_front_gradient_start = !empty($shape_front_gradient_start) ? $shape_front_gradient_start : 'transparent';
                    $shape_front_gradient_finish = !empty($shape_front_gradient_finish) ? $shape_front_gradient_finish : 'transparent';
                    $shape_front_gradient_angle = !empty($shape_front_gradient_angle) ? (int)$shape_front_gradient_angle.'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(".esc_attr($shape_front_gradient_angle).', '.esc_attr($shape_front_gradient_start).', '.esc_attr($shape_front_gradient_finish).");";
                }
                if ( $shape_front_color_type == 'custom_gradient' && !empty($shape_front_gradient_custom) ) {
                    $styles .= esc_attr($shape_front_gradient_custom);
                }
            $styles .= "
                }
            ";
        }
        if (
            ($shape_back_color_type == 'simple' && !empty($shape_back_color)) ||
            ($shape_back_color_type == 'gradient') ||
            ($shape_back_color_type == 'custom_gradient' && !empty($shape_back_gradient_custom))
        ) {
            $styles .= "
                #".$id." .service_icon_wrapper .shape_back{";
            if ( $shape_back_color_type == 'simple' && !empty($shape_back_color) ) {
                $styles .= "background: ".esc_attr($shape_back_color).";";
            }
            if ( $shape_back_color_type == 'gradient' ) {
                $shape_back_gradient_start = !empty($shape_back_gradient_start) ? $shape_back_gradient_start : 'transparent';
                $shape_back_gradient_finish = !empty($shape_back_gradient_finish) ? $shape_back_gradient_finish : 'transparent';
                $shape_back_gradient_angle = !empty($shape_back_gradient_angle) ? (int)$shape_back_gradient_angle.'deg' : '0deg';
                $styles .= "background-image: linear-gradient(".esc_attr($shape_back_gradient_angle).', '.esc_attr($shape_back_gradient_start).', '.esc_attr($shape_back_gradient_finish).");";
            }
            if ( $shape_back_color_type == 'custom_gradient' && !empty($shape_back_gradient_custom) ) {
                $styles .= esc_attr($shape_back_gradient_custom);
            }
            $styles .= "
                }
            ";
        }
    }
    
    // Title styles
    if ( !empty($add_title) && !empty($title) ) {
        if (
            !empty($title_size) ||
            !empty($title_line_height) ||
            !empty($title_margin)
        ) {
            $styles .= "
                #" . $id . " .service_content_wrapper .service_title{" .
                    (!empty($title_size) ? "font-size: " . esc_attr($title_size) . ";" : "") .
                    (!empty($title_line_height) ? "line-height: " . esc_attr($title_line_height) . ";" : "") .
                    (!empty($title_margin) ? "margin-top: " . esc_attr($title_margin) . ";" : "") .
                "}
            ";
        }
        if (
            ($title_color_type == 'simple' && !empty($title_color)) ||
            ($title_color_type == 'gradient') ||
            ($title_color_type == 'custom_gradient' && !empty($title_gradient_custom))
        ) {
            $styles .= "#" . $id . " .service_content_wrapper .service_title .service_title_text{";
                if ($title_color_type == 'simple' && !empty($title_color)) {
                    $styles .= "color: " . esc_attr($title_color) . ";";
                }
                if ($title_color_type == 'gradient') {
                    $title_gradient_start = !empty($title_gradient_start) ? $title_gradient_start : 'transparent';
                    $title_gradient_finish = !empty($title_gradient_finish) ? $title_gradient_finish : 'transparent';
                    $title_gradient_angle = !empty($title_gradient_angle) ? (int)$title_gradient_angle . 'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(" . esc_attr($title_gradient_angle) . ', ' . esc_attr($title_gradient_start) . ', ' . esc_attr($title_gradient_finish) . ");";
                }
                if ($title_color_type == 'custom_gradient' && !empty($title_gradient_custom)) {
                    $styles .= esc_attr($title_gradient_custom);
                }
            $styles .= "}";
        }
    }
    
    // Divider styles
    if ( !empty($add_divider) ) {
        if ( !empty($divider_margin) ) {
            $styles .= "
                #" . $id . " .service_content_wrapper .service_divider{
                    margin-top: " . esc_attr($divider_margin) . ";
                }
            ";
        }
        if (
            ($divider_color_type == 'simple' && !empty($divider_color)) ||
            ($divider_color_type == 'gradient') ||
            ($divider_color_type == 'custom_gradient' && !empty($divider_gradient_custom))
        ) {
            $styles .= "#" . $id . " .service_content_wrapper .service_divider .service_divider_inner {";
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
    
    // Content styles
    if ( !empty($add_text) && !empty($content) ) {
        if (
            !empty($text_size) ||
            !empty($font_color) ||
            !empty($text_line_height) ||
            !empty($text_margin)
        ) {
            $styles .= "
                #" . $id . " .service_content_wrapper .content_wrapper{" .
                    (!empty($text_size) ? "font-size: " . esc_attr($text_size) . ";" : "") .
                    (!empty($text_line_height) ? "line-height: " . esc_attr($text_line_height) . ";" : "") .
                    (!empty($text_margin) ? "margin-top: " . esc_attr($text_margin) . ";" : "") .
                    (!empty($font_color) ? "color: " . esc_attr($font_color) . ";" : "") .
                "}
            ";
        }
        if ( !empty($font_color) ) {
            $styles .= "
				#".$id." .service_content_wrapper .content_wrapper li{
					color: ".esc_attr($font_color).";
				}
			";
        }
        if ( !empty($font_accent_color) ) {
            $styles .= "
				#".$id." .service_content_wrapper .content_wrapper a,
				#".$id." .service_content_wrapper .content_wrapper li:before{
					color: ".esc_attr($font_accent_color).";
				}
			";
        }
    }
    
    // Background styles
    if (
        !empty($add_background) && (
            ($background_color_type == 'simple' && !empty($background_color)) ||
            ($background_color_type == 'gradient') ||
            ($background_color_type == 'custom_gradient' && !empty($background_gradient_custom)) ||
            (!empty($add_shadow) && !empty($shadow_css))
        )
    ) {
        $styles .= "#" . $id . " .service_background {";
        if (
            ($background_color_type == 'simple' && !empty($background_color)) ||
            ($background_color_type == 'gradient') ||
            ($background_color_type == 'custom_gradient' && !empty($background_gradient_custom))
        ) {
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
        }
        if ( !empty($add_shadow) && !empty($shadow_css) ) {
            $styles .= "-webkit-box-shadow: " . esc_attr($shadow_css) . ";";
            $styles .= "-moz-box-shadow: " . esc_attr($shadow_css) . ";";
            $styles .= "box-shadow: " . esc_attr($shadow_css) . ";";
        }
        $styles .= "}";
    }
	
	if(
	    ( !empty($add_background) &&
            (
                ( !empty($add_background_hover) && (
                    ($background_color_type_hover == 'simple' && !empty($background_color_hover)) ||
                    ($background_color_type_hover == 'gradient') ||
                    ($background_color_type_hover == 'custom_gradient' && !empty($background_gradient_custom_hover))
                )) ||
                (!empty($add_shadow) && !empty($shadow_css_hover))
            )
        ) ||
        ( !empty($add_icon) && ($icon_img == 'icon') && !empty($icon) && !empty($add_icon_hover) &&
            (
                (
                    ($icon_color_type_hover == 'simple' && !empty($icon_color_hover)) ||
                    ($icon_color_type_hover == 'gradient') ||
                    ($icon_color_type_hover == 'custom_gradient' && !empty($icon_gradient_custom_hover))
                ) ||
                ( $icon_shape != 'none' &&
                    (
                        ($shape_front_color_type_hover == 'simple' && !empty($shape_front_color_hover)) ||
                        ($shape_front_color_type_hover == 'gradient') ||
                        ($shape_front_color_type_hover == 'custom_gradient' && !empty($shape_front_gradient_custom_hover)) ||
                        ($shape_back_color_type_hover == 'simple' && !empty($shape_back_color_hover)) ||
                        ($shape_back_color_type_hover == 'gradient') ||
                        ($shape_back_color_type_hover == 'custom_gradient' && !empty($shape_back_gradient_custom_hover))
                    )
                )
            )
        ) ||
        ( !empty($add_title) && !empty($title) && !empty($add_title_hover) &&
            (
                ($title_color_type_hover == 'simple' && !empty($title_color_hover)) ||
                ($title_color_type_hover == 'gradient') ||
                ($title_color_type_hover == 'custom_gradient' && !empty($title_gradient_custom_hover))
            )
        ) ||
        ( !empty($add_text) && !empty($content) &&
            (
                ( !empty($add_text_hover) &&
                    (
                        !empty($font_color_hover) ||
                        !empty($font_accent_color_hover) ||
                        !empty($font_accent_hover_hover)
                    )
                ) ||
                ( !empty($font_accent_hover) )
            )
        )
    ){
		$styles .= "
			@media
				screen and (min-width: 1367px),
				screen and (min-width: 1200px) and (any-hover: hover),
				screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
				screen and (min-width: 1200px) and (-ms-high-contrast: none),
				screen and (min-width: 1200px) and (-ms-high-contrast: active)
			{
		";
        
        if (
            !empty($add_icon) && ($icon_img == 'icon') && !empty($icon) && !empty($add_icon_hover) &&
            (
                ($icon_color_type_hover == 'simple' && !empty($icon_color_hover)) ||
                ($icon_color_type_hover == 'gradient') ||
                ($icon_color_type_hover == 'custom_gradient' && !empty($icon_gradient_custom_hover))
            )
        ) {
            $styles .= "#".$id.":hover .service_icon_wrapper i{";
            
            if ( $icon_color_type_hover == 'simple' && !empty($icon_color_hover) ) {
                $styles .= "
                    color: ".esc_attr($icon_color_hover).";
                    -webkit-background-clip: inherit;
				    -webkit-text-fill-color: inherit;
                ";
            }
            if ( $icon_color_type_hover == 'gradient' ) {
                $icon_gradient_start_hover = !empty($icon_gradient_start_hover) ? $icon_gradient_start_hover : 'transparent';
                $icon_gradient_finish_hover = !empty($icon_gradient_finish_hover) ? $icon_gradient_finish_hover : 'transparent';
                $icon_gradient_angle_hover = !empty($icon_gradient_angle_hover) ? (int)$icon_gradient_angle_hover.'deg' : '0deg';
                $styles .= "background-image: linear-gradient(".esc_attr($icon_gradient_angle_hover).', '.esc_attr($icon_gradient_start_hover).', '.esc_attr($icon_gradient_finish_hover).");";
            }
            if ( $icon_color_type_hover == 'custom_gradient' && !empty($icon_gradient_custom_hover) ) {
                $styles .= esc_attr($icon_gradient_custom_hover);
            }
            $styles .= "}";
        }
        if ( !empty($add_icon) && ($icon_img == 'icon') && !empty($icon) && $icon_shape != 'none' && !empty($add_icon_hover) ) {
            if (
                ($shape_front_color_type_hover == 'simple' && !empty($shape_front_color_hover)) ||
                ($shape_front_color_type_hover == 'gradient') ||
                ($shape_front_color_type_hover == 'custom_gradient' && !empty($shape_front_gradient_custom_hover))
            ) {
                $styles .= "
                #".$id.":hover .service_icon_wrapper .shape_front{";
                if ( $shape_front_color_type_hover == 'simple' && !empty($shape_front_color_hover) ) {
                    $styles .= "background: ".esc_attr($shape_front_color_hover).";";
                }
                if ( $shape_front_color_type_hover == 'gradient' ) {
                    $shape_front_gradient_start_hover = !empty($shape_front_gradient_start_hover) ? $shape_front_gradient_start_hover : 'transparent';
                    $shape_front_gradient_finish_hover = !empty($shape_front_gradient_finish_hover) ? $shape_front_gradient_finish_hover : 'transparent';
                    $shape_front_gradient_angle_hover = !empty($shape_front_gradient_angle_hover) ? (int)$shape_front_gradient_angle_hover.'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(".esc_attr($shape_front_gradient_angle_hover).', '.esc_attr($shape_front_gradient_start_hover).', '.esc_attr($shape_front_gradient_finish_hover).");";
                }
                if ( $shape_front_color_type_hover == 'custom_gradient' && !empty($shape_front_gradient_custom_hover) ) {
                    $styles .= esc_attr($shape_front_gradient_custom_hover);
                }
                $styles .= "
                }
            ";
            }
            if (
                ($shape_back_color_type_hover == 'simple' && !empty($shape_back_color_hover)) ||
                ($shape_back_color_type_hover == 'gradient') ||
                ($shape_back_color_type_hover == 'custom_gradient' && !empty($shape_back_gradient_custom_hover))
            ) {
                $styles .= "
                #".$id.":hover .service_icon_wrapper .shape_back{";
                if ( $shape_back_color_type_hover == 'simple' && !empty($shape_back_color_hover) ) {
                    $styles .= "background: ".esc_attr($shape_back_color_hover).";";
                }
                if ( $shape_back_color_type_hover == 'gradient' ) {
                    $shape_back_gradient_start_hover = !empty($shape_back_gradient_start_hover) ? $shape_back_gradient_start_hover : 'transparent';
                    $shape_back_gradient_finish_hover = !empty($shape_back_gradient_finish_hover) ? $shape_back_gradient_finish_hover : 'transparent';
                    $shape_back_gradient_angle_hover = !empty($shape_back_gradient_angle_hover) ? (int)$shape_back_gradient_angle_hover.'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(".esc_attr($shape_back_gradient_angle_hover).', '.esc_attr($shape_back_gradient_start_hover).', '.esc_attr($shape_back_gradient_finish_hover).");";
                }
                if ( $shape_back_color_type_hover == 'custom_gradient' && !empty($shape_back_gradient_custom_hover) ) {
                    $styles .= esc_attr($shape_back_gradient_custom_hover);
                }
                $styles .= "
                }
            ";
            }
        }
			
        if (
            !empty($add_background) &&
            (
                (!empty($add_shadow) && !empty($shadow_css_hover)) ||
                (
                    !empty($add_background_hover) &&
                    (
                        ($background_color_type_hover == 'simple' && !empty($background_color_hover)) ||
                        ($background_color_type_hover == 'gradient') ||
                        ($background_color_type_hover == 'custom_gradient' && !empty($background_gradient_custom_hover))
                    )
                )
            )
        ) {
            $styles .= "#" . $id . ":hover .service_background {";
            if ( !empty($add_shadow) && !empty($shadow_css_hover) ) {
                $styles .= "-webkit-box-shadow: " . esc_attr($shadow_css_hover) . ";";
                $styles .= "-moz-box-shadow: " . esc_attr($shadow_css_hover) . ";";
                $styles .= "box-shadow: " . esc_attr($shadow_css_hover) . ";";
            }
            if (
                !empty($add_background_hover) &&
                (
                    ($background_color_type_hover == 'simple' && !empty($background_color_hover)) ||
                    ($background_color_type_hover == 'gradient') ||
                    ($background_color_type_hover == 'custom_gradient' && !empty($background_gradient_custom_hover))
                )
            ) {
                if ($background_color_type_hover == 'simple' && !empty($background_color_hover)) {
                    $styles .= "background: " . esc_attr($background_color_hover) . ";";
                }
                if ($background_color_type_hover == 'gradient') {
                    $background_gradient_start_hover = !empty($background_gradient_start_hover) ? $background_gradient_start_hover : 'transparent';
                    $background_gradient_finish_hover = !empty($background_gradient_finish_hover) ? $background_gradient_finish_hover : 'transparent';
                    $styles .= "background-image: linear-gradient(90deg," . esc_attr($background_gradient_start_hover) . ', ' . esc_attr($background_gradient_finish_hover) . ");";
                }
                if ($background_color_type_hover == 'custom_gradient' && !empty($background_gradient_custom_hover)) {
                    $styles .= esc_attr($background_gradient_custom_hover);
                }
            }
            $styles .= "}";
        }
        
        if (
            !empty($add_title) && !empty($title) && !empty($add_title_hover) &&
            (
                ($title_color_type_hover == 'simple' && !empty($title_color_hover)) ||
                ($title_color_type_hover == 'gradient') ||
                ($title_color_type_hover == 'custom_gradient' && !empty($title_gradient_custom_hover))
            )
        ) {
            $styles .= "#" . $id . ":hover .service_content_wrapper .service_title .service_title_text{";
                if ($title_color_type_hover == 'simple' && !empty($title_color_hover)) {
                    $styles .= "color: " . esc_attr($title_color_hover) . ";";
                }
                if ($title_color_type_hover == 'gradient') {
                    $title_gradient_start_hover = !empty($title_gradient_start_hover) ? $title_gradient_start_hover : 'transparent';
                    $title_gradient_finish_hover = !empty($title_gradient_finish_hover) ? $title_gradient_finish_hover : 'transparent';
                    $title_gradient_angle_hover = !empty($title_gradient_angle_hover) ? (int)$title_gradient_angle_hover . 'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(" . esc_attr($title_gradient_angle_hover) . ', ' . esc_attr($title_gradient_start_hover) . ', ' . esc_attr($title_gradient_finish_hover) . ");";
                }
                if ($title_color_type_hover == 'custom_gradient' && !empty($title_gradient_custom_hover)) {
                    $styles .= esc_attr($title_gradient_custom_hover);
                }
            $styles .= "}";
        }
        
        // Divider styles
        if (
            !empty($add_divider) && !empty($add_divider_hover) &&
            (
                ($divider_color_type_hover == 'simple' && !empty($divider_color_hover)) ||
                ($divider_color_type_hover == 'gradient') ||
                ($divider_color_type_hover == 'custom_gradient' && !empty($divider_gradient_custom_hover))
            )
        ) {
            $styles .= "#" . $id . ":hover .service_content_wrapper .service_divider .service_divider_inner {";
                if ($divider_color_type_hover == 'simple' && !empty($divider_color_hover)) {
                    $styles .= "background: " . esc_attr($divider_color_hover) . ";";
                }
                if ($divider_color_type_hover == 'gradient') {
                    $divider_gradient_start_hover = !empty($divider_gradient_start_hover) ? $divider_gradient_start_hover : 'transparent';
                    $divider_gradient_finish_hover = !empty($divider_gradient_finish_hover) ? $divider_gradient_finish_hover : 'transparent';
                    $styles .= "background-image: linear-gradient(90deg," . esc_attr($divider_gradient_start_hover) . ', ' . esc_attr($divider_gradient_finish_hover) . ");";
                }
                if ($divider_color_type_hover == 'custom_gradient' && !empty($divider_gradient_custom_hover)) {
                    $styles .= esc_attr($divider_gradient_custom_hover);
                }
            $styles .= "}";
        }
        
        // Content styles
        if (
            !empty($add_text) && !empty($content) &&
            (
                (
                    !empty($add_text_hover) &&
                    (
                        !empty($font_color_hover) ||
                        !empty($font_accent_color_hover) ||
                        !empty($font_accent_hover_hover)
                    )
                ) ||
                (
                    !empty($font_accent_hover)
                )
            )
        ) {
            if ( !empty($font_accent_hover) ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .content_wrapper a:hover{
                        color: " . esc_attr($font_accent_hover) . ";
                    }
                ";
            }
            if (
                !empty($add_text_hover)
            ) {
                if ( !empty($font_color_hover) ) {
                    $styles .= "
                        #" . $id . ":hover .service_content_wrapper .content_wrapper,
                        #" . $id . ":hover .service_content_wrapper .content_wrapper li {
                            color: " . esc_attr($font_color_hover) . ";
                        }
                    ";
                }
                if ( !empty($font_accent_hover_hover) ) {
                    $styles .= "
                        #" . $id . ":hover .service_content_wrapper .content_wrapper a:hover{
                            color: ".esc_attr($font_accent_hover_hover).";
                        }
                    ";
                }
                if ( !empty($font_accent_color_hover) ) {
                    $styles .= "
                        #" . $id . ":hover .service_content_wrapper .content_wrapper a,
                        #" . $id . ":hover .service_content_wrapper .content_wrapper li:before{
                            color: ".esc_attr($font_accent_color_hover).";
                        }
                    ";
                }
            }
        }
		
		$styles .= "
			}
		";
	}
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if(
		!empty($vc_landscape_styles) ||
		$customize_align_landscape ||
        (
            !empty($icon) && !empty($add_icon_landscape) && !empty($icon_size_landscape)
        ) ||
        (
            !empty($add_icon_landscape) && !empty($icon_margin_landscape)
        ) ||
        (
            !empty($add_title_landscape) && !empty($title) &&
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
            !empty($add_text_landscape) && !empty($content) &&
            (
                !empty($text_size_landscape) ||
                !empty($text_line_height_landscape) ||
                !empty($text_margin_landscape)
            )
        )
	){
		$styles .= "
			@media 
				screen and (max-width: 1199px), /*Check, is device a tablet*/
				screen and (max-width: 1366px) and (any-hover: none) /*Enable this styles for iPad Pro 1024-1366*/
			{
		";
        
            $flex_align_landscape = '';
            if ( ($style == 'icon_left' || $style == 'icon_right') && $customize_align_landscape ) {
                if ($module_alignment_landscape == 'left') {
                    $flex_align_landscape = 'flex-start';
                } elseif ($module_alignment_landscape == 'right') {
                    $flex_align_landscape = 'flex-end';
                } elseif ($module_alignment_landscape == 'center') {
                    $flex_align_landscape = 'center';
                }
            }
			if(
			    !empty($vc_landscape_styles) ||
                $customize_align_landscape
            ){
				$styles .= "
					#".$id."{" .
                        (!empty($vc_landscape_styles) ? $vc_landscape_styles : "") .
                        ($customize_align_landscape ? "text-align: ".$module_alignment_landscape.";" : "").
                        (($style == 'icon_left' || $style == 'icon_right') && $customize_align_landscape ? "-webkit-justify-content: ".$flex_align_landscape."; -moz-justify-content: ".$flex_align_landscape."; -ms-justify-content: ".$flex_align_landscape."; justify-content: ".$flex_align_landscape.";" : "") .
					"}
				";
			}
			
			if( !empty($icon) && !empty($add_icon_landscape) && !empty($icon_size_landscape) ){
			    if ( $icon_img == 'icon' ) {
                    $styles .= "
                        #".$id." .service_icon_wrapper i{
                            font-size: " . esc_attr($icon_size_landscape). ";
                        }
                    ";
                }
			    if ( $icon_img == 'image' ) {
                    $styles .= "
                        #".$id." .service_image_wrapper img{
                            max-height: " . esc_attr($icon_size_landscape) . ";
                        }
                    ";
                }
            }
            if ( !empty($add_icon) && !empty($icon_margin_landscape) ) {
                if ( $icon_img == 'icon' && !empty($icon) ) {
                    $styles .= "
                        #".$id." .service_icon_wrapper{
                           margin: " . esc_attr($icon_margin_landscape) . ";
                        }
                    ";
                }
                if ( $icon_img == 'image' && !empty($image) ) {
                    $styles .= "
                        #".$id." .service_image_wrapper{
                           margin: " . esc_attr($icon_margin_landscape) . ";
                        }
                    ";
                }
            }
            if ( !empty($add_title_landscape) && !empty($title) &&
                (
                    !empty($title_size_landscape) ||
                    !empty($title_line_height_landscape) ||
                    !empty($title_margin_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .service_title{" .
                        (!empty($title_size_landscape) ? "font-size: " . esc_attr($title_size_landscape) . ";" : "") .
                        (!empty($title_line_height_landscape) ? "line-height: " . esc_attr($title_line_height_landscape) . ";" : "") .
                        (!empty($title_margin_landscape) ? "margin-top: " . esc_attr($title_margin_landscape) . ";" : "") .
                    "}
                ";
            }
            if ( !empty($add_divider_landscape) && !empty($divider_margin_landscape) ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .service_divider{
                        margin-top: " . esc_attr($divider_margin_landscape) . ";
                    }
                ";
            }
            if ( !empty($add_text_landscape) && !empty($content) &&
                (
                    !empty($text_size_landscape) ||
                    !empty($text_line_height_landscape) ||
                    !empty($text_margin_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .content_wrapper{" .
                        (!empty($text_size_landscape) ? "font-size: " . esc_attr($text_size_landscape) . ";" : "") .
                        (!empty($text_line_height_landscape) ? "line-height: " . esc_attr($text_line_height_landscape) . ";" : "") .
                        (!empty($text_margin_landscape) ? "margin-top: " . esc_attr($text_margin_landscape) . ";" : "") .
                    "}
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
		$customize_align_portrait ||
        (
            !empty($icon) && !empty($add_icon_portrait) && !empty($icon_size_portrait)
        ) ||
        (
            !empty($add_icon_portrait) && !empty($icon_margin_portrait)
        ) ||
        (
            !empty($add_title_portrait) && !empty($title) &&
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
            !empty($add_text_portrait) && !empty($content) &&
            (
                !empty($text_size_portrait) ||
                !empty($text_line_height_portrait) ||
                !empty($text_margin_portrait)
            )
        )
	){
		$styles .= "
			@media screen and (max-width: 991px){
		";
        
            $flex_align_portrait = '';
            if ( ($style == 'icon_left' || $style == 'icon_right') && $customize_align_portrait ) {
                if ($module_alignment_portrait == 'left') {
                    $flex_align_portrait = 'flex-start';
                } elseif ($module_alignment_portrait == 'right') {
                    $flex_align_portrait = 'flex-end';
                } elseif ($module_alignment_portrait == 'center') {
                    $flex_align_portrait = 'center';
                }
            }
            if(
                !empty($vc_portrait_styles) ||
                $customize_align_portrait
            ){
                $styles .= "
					#".$id."{" .
                        (!empty($vc_portrait_styles) ? $vc_portrait_styles : "") .
                        ($customize_align_portrait ? "text-align: ".$module_alignment_portrait.";" : "").
                        (($style == 'icon_left' || $style == 'icon_right') && $customize_align_portrait ? "-webkit-justify-content: ".$flex_align_portrait."; -moz-justify-content: ".$flex_align_portrait."; -ms-justify-content: ".$flex_align_portrait."; justify-content: ".$flex_align_portrait.";" : "") .
                    "}
				";
            }
        
            if( !empty($icon) && !empty($add_icon_portrait) && !empty($icon_size_portrait) ){
                if ( $icon_img == 'icon' ) {
                    $styles .= "
                        #".$id." .service_icon_wrapper i{
                            font-size: " . esc_attr($icon_size_portrait). ";
                        }
                    ";
                }
                if ( $icon_img == 'image' ) {
                    $styles .= "
                        #".$id." .service_image_wrapper img{
                            max-height: " . esc_attr($icon_size_portrait) . ";
                        }
                    ";
                }
            }
            if ( !empty($add_icon) && !empty($icon_margin_portrait) ) {
                if ( $icon_img == 'icon' && !empty($icon) ) {
                    $styles .= "
                        #".$id." .service_icon_wrapper{
                           margin: " . esc_attr($icon_margin_portrait) . ";
                        }
                    ";
                }
                if ( $icon_img == 'image' && !empty($image) ) {
                    $styles .= "
                        #".$id." .service_image_wrapper{
                            margin: " . esc_attr($icon_margin_portrait) . ";
                        }
                    ";
                }
            }
            if ( !empty($add_title_portrait) && !empty($title) &&
                (
                    !empty($title_size_portrait) ||
                    !empty($title_line_height_portrait) ||
                    !empty($title_margin_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .service_title{" .
                        (!empty($title_size_portrait) ? "font-size: " . esc_attr($title_size_portrait) . ";" : "") .
                        (!empty($title_line_height_portrait) ? "line-height: " . esc_attr($title_line_height_portrait) . ";" : "") .
                        (!empty($title_margin_portrait) ? "margin-top: " . esc_attr($title_margin_portrait) . ";" : "") .
                    "}
                ";
            }
            if ( !empty($add_divider_portrait) && !empty($divider_margin_portrait) ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .service_divider{
                        margin-top: " . esc_attr($divider_margin_portrait) . ";
                    }
                ";
            }
            if ( !empty($add_text_portrait) && !empty($content) &&
                (
                    !empty($text_size_portrait) ||
                    !empty($text_line_height_portrait) ||
                    !empty($text_margin_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .content_wrapper{" .
                        (!empty($text_size_portrait) ? "font-size: " . esc_attr($text_size_portrait) . ";" : "") .
                        (!empty($text_line_height_portrait) ? "line-height: " . esc_attr($text_line_height_portrait) . ";" : "") .
                        (!empty($text_margin_portrait) ? "margin-top: " . esc_attr($text_margin_portrait) . ";" : "") .
                    "}
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
		$customize_align_mobile ||
        (
            !empty($icon) && !empty($add_icon_mobile) && !empty($icon_size_mobile)
        ) ||
        (
            !empty($add_icon_mobile) && !empty($icon_margin_mobile)
        ) ||
        (
            !empty($add_title_mobile) && !empty($title) &&
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
            !empty($add_text_mobile) && !empty($content) &&
            (
                !empty($text_size_mobile) ||
                !empty($text_line_height_mobile) ||
                !empty($text_margin_mobile)
            )
        )
	){
		$styles .= "
			@media screen and (max-width: 767px){
		";
        
            $flex_align_mobile = '';
            if ( ($style == 'icon_left' || $style == 'icon_right') && $customize_align_mobile ) {
                if ($module_alignment_mobile == 'left') {
                    $flex_align_mobile = 'flex-start';
                } elseif ($module_alignment_mobile == 'right') {
                    $flex_align_mobile = 'flex-end';
                } elseif ($module_alignment_mobile == 'center') {
                    $flex_align_mobile = 'center';
                }
            }
            if(
                !empty($vc_mobile_styles) ||
                $customize_align_mobile
            ){
                $styles .= "
					#".$id."{" .
                        (!empty($vc_mobile_styles) ? $vc_mobile_styles : "") .
                        ($customize_align_mobile ? "text-align: ".$module_alignment_mobile.";" : "").
                        (($style == 'icon_left' || $style == 'icon_right') && $customize_align_mobile ? "-webkit-justify-content: ".$flex_align_mobile."; -moz-justify-content: ".$flex_align_mobile."; -ms-justify-content: ".$flex_align_mobile."; justify-content: ".$flex_align_mobile.";" : "") .
                    "}
				";
            }
        
            if( !empty($icon) && !empty($add_icon_mobile) && !empty($icon_size_mobile) ){
                if ( $icon_img == 'icon' ) {
                    $styles .= "
                        #".$id." .service_icon_wrapper i{
                            font-size: " . esc_attr($icon_size_mobile). ";
                        }
                    ";
                }
                if ( $icon_img == 'image' ) {
                    $styles .= "
                        #".$id." .service_image_wrapper img{
                            max-height: " . esc_attr($icon_size_mobile) . ";
                        }
                    ";
                }
            }
            if ( !empty($add_icon) && !empty($icon_margin_mobile) ) {
                if ( $icon_img == 'icon' && !empty($icon) ) {
                    $styles .= "
                        #".$id." .service_icon_wrapper{
                            margin: " . esc_attr($icon_margin_mobile) . ";
                        }
                    ";
                }
                if ( $icon_img == 'image' && !empty($image) ) {
                    $styles .= "
                        #".$id." .service_image_wrapper{
                            margin: " . esc_attr($icon_margin_mobile) . ";
                        }
                    ";
                }
            }
            if ( !empty($add_title_mobile) && !empty($title) &&
                (
                    !empty($title_size_mobile) ||
                    !empty($title_line_height_mobile) ||
                    !empty($title_margin_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .service_title{" .
                        (!empty($title_size_mobile) ? "font-size: " . esc_attr($title_size_mobile) . ";" : "") .
                        (!empty($title_line_height_mobile) ? "line-height: " . esc_attr($title_line_height_mobile) . ";" : "") .
                        (!empty($title_margin_mobile) ? "margin-top: " . esc_attr($title_margin_mobile) . ";" : "") .
                    "}
                ";
            }
            if ( !empty($add_divider_mobile) && !empty($divider_margin_mobile) ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .service_divider{
                        margin-top: " . esc_attr($divider_margin_mobile) . ";
                    }
                ";
            }
            if ( !empty($add_text_mobile) && !empty($content) &&
                (
                    !empty($text_size_mobile) ||
                    !empty($text_line_height_mobile) ||
                    !empty($text_margin_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .service_content_wrapper .content_wrapper{" .
                        (!empty($text_size_mobile) ? "font-size: " . esc_attr($text_size_mobile) . ";" : "") .
                        (!empty($text_line_height_mobile) ? "line-height: " . esc_attr($text_line_height_mobile) . ";" : "") .
                        (!empty($text_margin_mobile) ? "margin-top: " . esc_attr($text_margin_mobile) . ";" : "") .
                    "}
                ";
            }

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */ 

	cws__vc_styles($styles);

	$icon_output = '';

	$module_classes = 'cws_service_module';
	$module_classes .= !empty($add_icon) && !empty($style) ? ' style_'.esc_attr($style) : "";
	
	$module_classes .= !empty($add_icon) && !empty($icon_shape) && $icon_img == "icon" ? ' icon_shape_'.esc_attr($icon_shape) : "";
	$module_classes .= !empty($add_icon) && !empty($image_shape) && $icon_img == "image" ? ' image_shape_'.esc_attr($image_shape) : "";
	$module_classes .= !empty($add_background) && !empty($hover) ? ' hover_effect_'.esc_attr($hover) : "";

	$module_classes .= $customize_align ? ' align_'.esc_attr($module_alignment) : '';
	$module_classes .= $customize_align_landscape ? ' landscape_align_'.esc_attr($module_alignment_landscape) : '';
	$module_classes .= $customize_align_portrait ? ' portrait_align_'.esc_attr($module_alignment_portrait) : '';
	$module_classes .= $customize_align_mobile ? ' mobile_align_'.esc_attr($module_alignment_mobile) : '';

	$module_classes .= !empty($el_class) ? ' '  .esc_attr($el_class) : "";

	$start_tag = !empty($url) ? "<a href='".esc_url($url)."'".($new_tab ? ' target="_blank"' : '')."" : "<div";
	$end_tag = !empty($url) ? "</a>" : "</div>";

	/* -----> Getting Icon <----- */
	if( !empty($icon_lib) ){
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

	/* -----> Filter Products module output <----- */
	$out .= $start_tag." id='".$id."' class='".$module_classes."'>";
	    if ( $add_background ) {
	       $out .= '<div class="service_background'.(!empty($background_color_type) ? ' color_type_' . esc_attr($background_color_type) : '').'"></div>';
        }
		if( $icon_img == 'icon' && !empty($icon) ){
			$out .= "<div class='service_icon_wrapper".(!empty($icon_color_type) ? " color_type_" . esc_attr($icon_color_type) : "")."'>";
                if ( $icon_shape != 'none' ) {
                    $out .= '<div class="shape_back"></div>';
                    $out .= '<div class="shape_front"></div>';
                }
				$out .= $icon_output;
			$out .= "</div>";
		} else if( $icon_img == 'image' && !empty($image) ){
			$out .= "<div class='service_image_wrapper'>";
				$out .= "<img src='".esc_url($image)."' alt='".esc_attr($image_alt)."' />";
			$out .= "</div>";
		}
		$out .= '<div class="service_content_wrapper">';
			if( !empty($title) ){
				$out .= '<'.$title_tag.' class="service_title'.(!empty($title_color_type) ? ' color_type_' . esc_attr($title_color_type) : '').'">';
					$out .= sprintf('<span class="service_title_text">%s</span>', $title);
				$out .= '</'.$title_tag.'>';
			}
            if( !empty($add_divider) ){
                $out .= '<div class="service_divider">';
                    $out .= '<div class="service_divider_inner"></div>';
                $out .= "</div>";
            }
			if( !empty($content) ){
				$out .= "<div class='content_wrapper'>";
					$out .= $content;
				$out .= "</div>";
			}
		$out .= '</div>';

	$out .= $end_tag;

	return $out;
}
add_shortcode( 'cws_sc_service', 'cws_vc_shortcode_sc_service' );

?>