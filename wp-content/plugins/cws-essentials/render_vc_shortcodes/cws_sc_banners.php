<?php

function cws_vc_shortcode_sc_banners ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"title"							=> "",
		"description"					=> "",
		"banner_url"					=> "#",
		"new_tab"						=> false,
		"el_class"						=> "",
		
		/* -----> STYLING TAB <----- */
        "add_overlay"					=> false,
        "add_button"					=> false,
		"title_color"					=> "",
		"text_color"					=> "",
		"overlay_color_type"			=> "simple",
		"overlay_bg_color"			    => PRIMARY_COLOR,
		"overlay_gradient_start"		=> PRIMARY_COLOR,
		"overlay_gradient_finish"		=> SECONDARY_COLOR,
		"overlay_gradient_angle"		=> "90",
		"overlay_gradient_custom"		=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
        "title_vertical"                => "top",
        
        /* -----> BUTTON TAB <----- */
        "btn_title"                     => "Click Me!",
        "button_pos"                    => "default",
        "btn_style"                     => "arrow_fade_in",
        "btn_size"                      => "medium",
        "btn_add_shadow"                => false,
        "btn_set_bg"                    => false,
        "btn_bg_color_type"             => "simple",
        "btn_bg_color"                  => "rgba(255, 255, 255, 0.01)",
        "btn_bg_gradient_start"         => PRIMARY_COLOR,
        "btn_bg_gradient_finish"        => SECONDARY_COLOR,
        "btn_bg_gradient_angle"         => "90",
        "btn_bg_gradient_custom"        => "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
        "btn_bg_color_type_hover"       => "simple",
        "btn_bg_color_hover"            => "#ffffff",
        "btn_bg_gradient_start_hover"   => PRIMARY_COLOR,
        "btn_bg_gradient_finish_hover"  => SECONDARY_COLOR,
        "btn_bg_gradient_angle_hover"   => "154",
        "btn_bg_gradient_custom_hover"  => "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
        "btn_set_color"                 => false,
        "btn_font_color"                => "#ffffff",
        "btn_font_color_hover"          => "#000000",
        "btn_set_border"                => false,
        "btn_border_color"              => "#ffffff",
        "btn_border_color_hover"        => "#ffffff",
        "btn_add_icon"                  => false,
        "icon_lib"						=> "FontAwesome",
	);

	$responsive_vars = array(
		"all" => array(
            "add_title"                 => false,
            "title_size"                => "25px",
            "title_lh"                  => "38px",
            "title_margin_bottom"       => "2px",
			"add_description"           => false,
			"text_size"                 => "14px",
			"text_lh"                   => "18px",
            "min_height"                => "",
			"customize_align"	        => false,
			"module_alignment"	        => "left",
            "custom_styles"		        => "",
		),
	);
	$responsive_vars = add_bg_properties($responsive_vars); //Add custom background properties to responsive vars array

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
    $icon = esc_attr(cws_ext_vc_sc_get_icon($atts));
	$id = uniqid( "cws_banner_" );
	$title = wp_kses( $title, array(
		"b"			=> array(),
		"strong"	=> array(),
		"mark"		=> array(),
		"br"		=> array()
	));
	$description = wp_kses( $description, array(
		"b"			=> array(),
		"strong"	=> array(),
		"mark"		=> array(),
		"br"		=> array()
	));
	$start_tag = empty($add_button) && empty($btn_title) && !empty($banner_url) ? '<a href="'.esc_url($banner_url).'"'.($new_tab ? ' target="_blank"' : '') : '<div';
    $end_tag = empty($add_button) && empty($btn_title) && !empty($banner_url) ? '</a>' : '</div>';
	
	/* -----> Visual Composer Responsive styles <----- */
	list( $vc_desktop_class, $vc_landscape_class, $vc_portrait_class, $vc_mobile_class ) = vc_responsive_styles($atts);

	preg_match("/(?<=\{).+?(?=\})/", $vc_desktop_class, $vc_desktop_styles); 
	$vc_desktop_styles = implode($vc_desktop_styles);
	$vc_desktop_styles .= "
		background-position: ".(!empty($custom_bg_position) ? $custom_bg_position : $bg_position )." !important;
		background-size: ".(!empty($custom_bg_size) ? $custom_bg_size : $bg_size )." !important;
		background-repeat: ".$bg_repeat." !important;
		". ($bg_display == '1' ? 'background-image: none !important;' : '') ."
	";

	preg_match("/(?<=\{).+?(?=\})/", $vc_landscape_class, $vc_landscape_styles);
	$vc_landscape_styles = implode($vc_landscape_styles);
	$vc_landscape_styles .= "
		background-position: ".(!empty($custom_bg_position_landscape) ? $custom_bg_position_landscape : $bg_position_landscape )." !important;
		background-size: ".(!empty($custom_bg_size_landscape) ? $custom_bg_size_landscape : $bg_size_landscape )." !important;
		background-repeat: ".$bg_repeat_landscape." !important;
		". ($bg_display_landscape == '1' ? 'background-image: none !important;' : '') ."
	";

	preg_match("/(?<=\{).+?(?=\})/", $vc_portrait_class, $vc_portrait_styles);
	$vc_portrait_styles = implode($vc_portrait_styles);
	$vc_portrait_styles .= "
		background-position: ".(!empty($custom_bg_position_portrait) ? $custom_bg_position_portrait : $bg_position_portrait )." !important;
		background-size: ".(!empty($custom_bg_size_portrait) ? $custom_bg_size_portrait : $bg_size_portrait )." !important;
		background-repeat: ".$bg_repeat_portrait." !important;
		". ($bg_display_portrait == '1' ? 'background-image: none !important;' : '') ."
	";

	preg_match("/(?<=\{).+?(?=\})/", $vc_mobile_class, $vc_mobile_styles);
	$vc_mobile_styles = implode($vc_mobile_styles);
	$vc_mobile_styles .= "
		background-position: ".(!empty($custom_bg_position_mobile) ? $custom_bg_position_mobile : $bg_position_mobile )." !important;
		background-size: ".(!empty($custom_bg_size_mobile) ? $custom_bg_size_mobile : $bg_size_mobile )." !important;
		background-repeat: ".$bg_repeat_mobile." !important;
		". ($bg_display_mobile == '1' ? 'background-image: none !important;' : '') ."
	";

	/* -----> Customize default styles <----- */
	if( !empty($vc_desktop_styles) ){
		$styles .= "
			#".$id."{
				".$vc_desktop_styles."
			}
		";
	}
	if( $customize_align ){
		$styles .= "
			#".$id."{
				text-align: ".$module_alignment.";
			}
		";
	}
 
	if( !empty($min_height) ){
	    $styles .= "
               #".$id."{
                min-height: ".esc_attr($min_height).";
            }
        ";
	}
	if(
	    !empty($add_title) && !empty($title) &&
        (
            !empty($title_size) ||
            !empty($title_lh) ||
            !empty($title_margin_bottom) ||
            !empty($title_color)
        )
    ){
	    $styles .= "
            #".$id." .banner_title{
                " . ( !empty($title_size) ? "font-size: " . esc_attr($title_size) . ";" : "" ) . "
                " . ( !empty($title_lh) ? "line-height: " . esc_attr($title_lh) . ";" : "" ) . "
                " . ( !empty($title_margin_bottom) ? "margin-bottom: " . esc_attr($title_margin_bottom) . ";" : "" ) . "
                " . ( !empty($title_color) ? "color: " . esc_attr($title_color) . ";" : "" ) . "
            }
        ";
	}
	if(
	    !empty($add_description) && !empty($description) &&
        (
            !empty($text_size) ||
            !empty($text_lh) ||
            !empty($text_margin_bottom) ||
            !empty($text_color)
        )
    ){
	    $styles .= "
            #".$id." .banner_desc{
                " . ( !empty($text_size) ? "font-size: ".esc_attr($text_size).";" : "" ) . "
                " . ( !empty($text_lh) ? "line-height: ".esc_attr($text_lh).";" : "" ) . "
                " . ( !empty($text_margin_bottom) ? "margin-bottom: " . $title_margin_bottom . ";" : "" ) . "
                " . ( !empty($text_color) ? "color: " . $text_color . ";" : "" ) . "
            }
        ";
	}
    if( !empty($add_overlay) ){
        $styles .= "#".$id.":before{";
            if ( $overlay_color_type == 'simple' && !empty($overlay_bg_color) ) {
                $styles .= "background-image: linear-gradient(90deg, ".esc_attr($overlay_bg_color).",".esc_attr($overlay_bg_color).");";
            }
            if ( $overlay_color_type == 'gradient' ) {
                $overlay_gradient_start = !empty($overlay_gradient_start) ? $overlay_gradient_start : 'transparent';
                $overlay_gradient_finish = !empty($overlay_gradient_finish) ? $overlay_gradient_finish : 'transparent';
                $overlay_gradient_angle = !empty($overlay_gradient_angle) ? (int)$overlay_gradient_angle.'deg' : '0deg';
                $styles .= "background-color: ".esc_attr($overlay_gradient_start).";";
                $styles .= "background-image: linear-gradient(".esc_attr($overlay_gradient_angle).', '.esc_attr($overlay_gradient_start).', '.esc_attr($overlay_gradient_finish).");";
            }
            if ( $overlay_color_type == 'custom_gradient' ) {
                $styles .= esc_attr($overlay_gradient_custom);
            }
        $styles .= "}";
    }
    
    if( !empty($btn_set_bg) || !empty($btn_set_color) || !empty($btn_set_border) ) {
        $styles .= "#" . $id . " .cws_button{";
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
        $styles .= "}";
    
        $styles .= "
            @media
                screen and (min-width: 1367px),
                screen and (min-width: 1200px) and (any-hover: hover),
                screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
                screen and (min-width: 1200px) and (-ms-high-contrast: none),
                screen and (min-width: 1200px) and (-ms-high-contrast: active)
            {
        ";
    
        $styles .= "#" . $id . " .cws_button:hover{";
            if (!empty($btn_set_bg)) {
                if ($btn_bg_color_type_hover == 'simple' && !empty($btn_bg_color_hover)) {
                    $styles .= "background-image: linear-gradient(90deg, " . esc_attr($btn_bg_color_hover) . "," . esc_attr($btn_bg_color_hover) . ");";
                }
                if ($btn_bg_color_type_hover == 'gradient') {
                    $btn_bg_gradient_start_hover = !empty($btn_bg_gradient_start_hover) ? $btn_bg_gradient_start_hover : 'transparent';
                    $btn_bg_gradient_finish_hover = !empty($btn_bg_gradient_finish_hover) ? $btn_bg_gradient_finish_hover : 'transparent';
                    $btn_bg_gradient_angle_hover = !empty($btn_bg_gradient_angle_hover) ? (int)$btn_bg_gradient_angle_hover . 'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(" . esc_attr($btn_bg_gradient_angle_hover) . ', ' . esc_attr($btn_bg_gradient_start_hover) . ', ' . esc_attr($btn_bg_gradient_finish_hover) . ");";
                }
                if ($btn_bg_color_type_hover == 'custom_gradient') {
                    $styles .= esc_attr($btn_bg_gradient_custom_hover);
                }
            }
            if (!empty($btn_set_color) && !empty($btn_font_color_hover)) {
                $styles .= "color: " . esc_attr($btn_font_color_hover) . ";";
            }
            if (!empty($btn_set_border) && !empty($btn_border_color_hover)) {
                $styles .= "border-color: " . esc_attr($btn_border_color_hover) . ";";
            }
        $styles .= "}";
    
        $styles .= "
            }
        ";
    }
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( 
		!empty($vc_landscape_styles) ||
		$customize_align_landscape ||
        !empty($min_height_landscape) ||
        (!empty($add_title_landscape) && !empty($title) && ( !empty($title_size_landscape) || !empty($title_lh_landscape) || !empty($title_margin_bottom_landscape) )) ||
        (!empty($add_description_landscape) && !empty($description_landscape) && ( !empty($text_size_landscape) || !empty($text_lh_landscape) || !empty($text_margin_bottom_landscape) ))
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
						".$vc_landscape_styles.";
					}
				";
			}
			if( $customize_align_landscape ){
				$styles .= "
					#".$id."{
						text-align: ".$module_alignment_landscape.";
					}
				";
			}
			
            if( !empty($min_height_landscape) ){
                $styles .= "
                    #".$id."{
                        min-height: ".esc_attr($min_height_landscape).";
                    }
                ";
            }
            if(
                !empty($add_title_landscape) && !empty($title) &&
                (
                    !empty($title_size_landscape) ||
                    !empty($title_lh_landscape) ||
                    !empty($title_margin_bottom_landscape)
                )
            ){
                $styles .= "
                    #".$id." .banner_title{
                        " . ( !empty($title_size_landscape) ? "font-size: " . esc_attr($title_size_landscape) . ";" : "" ) . "
                        " . ( !empty($title_lh_landscape) ? "line-height: " . esc_attr($title_lh_landscape) . ";" : "" ) . "
                        " . ( !empty($title_margin_bottom_landscape) ? "margin-bottom: " . esc_attr($title_margin_bottom_landscape) . ";" : "" ) . "
                    }
                ";
            }
            if(
                !empty($add_description_landscape) && !empty($description_landscape) &&
                (
                    !empty($text_size_landscape) ||
                    !empty($text_lh_landscape) ||
                    !empty($text_margin_bottom_landscape)
                )
            ){
                $styles .= "
                    #".$id." .banner_desc{
                        " . ( !empty($text_size_landscape) ? "font-size: ".esc_attr($text_size_landscape).";" : "" ) . "
                        " . ( !empty($text_lh_landscape) ? "line-height: ".esc_attr($text_lh_landscape).";" : "" ) . "
                        " . ( !empty($text_margin_bottom_landscape) ? "margin-bottom: " . $title_margin_bottom_landscape . ";" : "" ) . "
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
		$customize_align_portrait ||
        !empty($min_height_portrait) ||
        (!empty($add_title_portrait) && !empty($title) && ( !empty($title_size_portrait) || !empty($title_lh_portrait) || !empty($title_margin_bottom_portrait) )) ||
        (!empty($add_description_portrait) && !empty($description_portrait) && ( !empty($text_size_portrait) || !empty($text_lh_portrait) || !empty($text_margin_bottom_portrait) ))
	){
		$styles .= "
			@media screen and (max-width: 991px){
		";

			if( !empty($vc_portrait_styles) ){
				$styles .= "
					#".$id."{
						".$vc_portrait_styles.";
					}
				";
			}
			if( $customize_align_portrait ){
				$styles .= "
					#".$id."{
						text-align: ".$module_alignment_portrait.";
					}
				";
			}
        
            if( !empty($min_height_portrait) ){
                $styles .= "
                    #".$id."{
                        min-height: ".esc_attr($min_height_portrait).";
                    }
                ";
            }
            if(
                !empty($add_title_portrait) && !empty($title) &&
                (
                    !empty($title_size_portrait) ||
                    !empty($title_lh_portrait) ||
                    !empty($title_margin_bottom_portrait)
                )
            ){
                $styles .= "
                    #".$id." .banner_title{
                        " . ( !empty($title_size_portrait) ? "font-size: " . esc_attr($title_size_portrait) . ";" : "" ) . "
                        " . ( !empty($title_lh_portrait) ? "line-height: " . esc_attr($title_lh_portrait) . ";" : "" ) . "
                        " . ( !empty($title_margin_bottom_portrait) ? "margin-bottom: " . esc_attr($title_margin_bottom_portrait) . ";" : "" ) . "
                    }
                ";
            }
            if(
                !empty($add_description_portrait) && !empty($description_portrait) &&
                (
                    !empty($text_size_portrait) ||
                    !empty($text_lh_portrait) ||
                    !empty($text_margin_bottom_portrait)
                )
            ){
                $styles .= "
                    #".$id." .banner_desc{
                        " . ( !empty($text_size_portrait) ? "font-size: ".esc_attr($text_size_portrait).";" : "" ) . "
                        " . ( !empty($text_lh_portrait) ? "line-height: ".esc_attr($text_lh_portrait).";" : "" ) . "
                        " . ( !empty($text_margin_bottom_portrait) ? "margin-bottom: " . $title_margin_bottom_portrait . ";" : "" ) . "
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
		$customize_align_mobile ||
        !empty($min_height_mobile) ||
        (!empty($add_title_mobile) && !empty($title) && ( !empty($title_size_mobile) || !empty($title_lh_mobile) || !empty($title_margin_bottom_mobile) )) ||
        (!empty($add_description_mobile) && !empty($description_mobile) && ( !empty($text_size_mobile) || !empty($text_lh_mobile) || !empty($text_margin_bottom_mobile) ))
	){
		$styles .= "
			@media screen and (max-width: 767px){
		";

			if( !empty($vc_mobile_styles) ){
				$styles .= "
					#".$id."{
						".$vc_mobile_styles.";
					}
				";
			}
			if( $customize_align_mobile ){
				$styles .= "
					#".$id."{
						text-align: ".$module_alignment_mobile.";
					}
				";
			}
        
            if( !empty($min_height_mobile) ){
                $styles .= "
                    #".$id."{
                        min-height: ".esc_attr($min_height_mobile).";
                    }
                ";
            }
            if(
                !empty($add_title_mobile) && !empty($title) &&
                (
                    !empty($title_size_mobile) ||
                    !empty($title_lh_mobile) ||
                    !empty($title_margin_bottom_mobile)
                )
            ){
                $styles .= "
                    #".$id." .banner_title{
                        " . ( !empty($title_size_mobile) ? "font-size: " . esc_attr($title_size_mobile) . ";" : "" ) . "
                        " . ( !empty($title_lh_mobile) ? "line-height: " . esc_attr($title_lh_mobile) . ";" : "" ) . "
                        " . ( !empty($title_margin_bottom_mobile) ? "margin-bottom: " . esc_attr($title_margin_bottom_mobile) . ";" : "" ) . "
                    }
                ";
            }
            if(
                !empty($add_description_mobile) && !empty($description_mobile) &&
                (
                    !empty($text_size_mobile) ||
                    !empty($text_lh_mobile) ||
                    !empty($text_margin_bottom_mobile)
                )
            ){
                $styles .= "
                    #".$id." .banner_desc{
                        " . ( !empty($text_size_mobile) ? "font-size: ".esc_attr($text_size_mobile).";" : "" ) . "
                        " . ( !empty($text_lh_mobile) ? "line-height: ".esc_attr($text_lh_mobile).";" : "" ) . "
                        " . ( !empty($text_margin_bottom_mobile) ? "margin-bottom: " . $title_margin_bottom_mobile . ";" : "" ) . "
                    }
                ";
            }

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */

	cws__vc_styles($styles);
    
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
    
    $button_classes = 'cws_button';
    $button_classes .= $btn_size != 'medium' ? ' '.esc_attr($btn_size) : '';
    $button_classes .= !empty($btn_style) ? ' '.esc_attr($btn_style) : '';
    $button_classes .= !empty($btn_add_shadow) ? ' shadow' : '';

	$module_classes = "cws_banner_module";
	$module_classes .= " button_".esc_attr($button_pos);
	$module_classes .= " vertical_align_".esc_attr($title_vertical);
	$module_classes .= " align_".esc_attr($module_alignment);
	$module_classes .= $customize_align_landscape ? " landscape_align_".esc_attr($module_alignment_landscape) : '';
	$module_classes .= $customize_align_portrait ? " portrait_align_".esc_attr($module_alignment_portrait) : '';
	$module_classes .= $customize_align_mobile ? " mobile_align_".esc_attr($module_alignment_mobile) : '';
	$module_classes .= !empty($el_class) ? " ".esc_attr($el_class) : '';

	/* -----> Banner module output <----- */
	$out .= $start_tag." id='".$id."' class='".$module_classes."'>";
	    $out .= "<div class='banner_part'>";
	        $out .= ( !empty($title) ? "<p class='banner_title title_ff'>".$title."</p>" : "" );
	        $out .= ( !empty($description) ? "<p class='banner_desc'>".$description."</p>" : "" );
	    $out .= "</div>";
            
	    if( !empty($add_button) && !empty($btn_title) && !empty($banner_url) ){
	        $out .= "<div class='banner_part'>";
	            $out .= "<div class='cws_button_wrapper'>";
	                $out .= "<a class='".$button_classes."' href='".(!empty($banner_url) ? esc_url($banner_url) : '#')."' ".($new_tab ? 'target="_blank"' : '').">";
	                    $out .= "<span>";
	                        $out .= $icon_output;
	                        $out.= esc_html($btn_title);
	                    $out .= "</span>";
                    $out .= "</a>";
                $out .= "</div>";
            $out .= "</div>";
	    }
	$out .= $end_tag;

	return $out;
}
add_shortcode( 'cws_sc_banners', 'cws_vc_shortcode_sc_banners' );

?>