<?php

function cws_vc_shortcode_sc_button ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
        "title"							=> "Click Me!",
        "url"							=> "#",
        "new_tab"						=> false,
        
        "btn_style"						=> "arrow_fade_in",
        "btn_size"						=> "medium",
        "add_shadow"                    => false,
		
		"set_bg"                        => false,
		"bg_color_type"                 => "custom_gradient",
        "btn_bg_color"					=> PRIMARY_COLOR,
        "bg_gradient_start"				=> PRIMARY_COLOR,
        "bg_gradient_finish"			=> SECONDARY_COLOR,
        "bg_gradient_angle"			    => "90",
        "bg_gradient_custom"			=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
        
        "bg_color_type_hover"           => "simple",
        "btn_bg_color_hover"			=> PRIMARY_COLOR,
        "bg_gradient_start_hover"		=> PRIMARY_COLOR,
        "bg_gradient_finish_hover"		=> SECONDARY_COLOR,
        "bg_gradient_angle_hover"		=> "90",
        "bg_gradient_custom_hover"		=> "background-image: linear-gradient(90deg, ".PRIMARY_COLOR." -8.57%, ".SECONDARY_COLOR." 184.64%);",
		
		"set_color"                     => false,
		"btn_font_color"                => "#ffffff",
		"btn_font_color_hover"          => "#ffffff",
		
		"set_border"                    => false,
		"btn_border_color"              => "",
		"btn_border_color_hover"        => "",
		
		"add_icon"                      => false,
		"icon_lib"						=> "FontAwesome",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_align"	=> false,
			"aligning"			=> "left",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$icon = esc_attr(cws_ext_vc_sc_get_icon($atts));
	$id_wrapper = uniqid( "cws_button_wrapper_" );
	$id = uniqid( "cws_button_" );

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
	if( $customize_align ){
		$styles .= "
			#".$id_wrapper."{
				text-align: ".$aligning.";
			}
		";
	}
	if( !empty($vc_desktop_styles) ){
		$styles .= "
			#".$id."{
				".$vc_desktop_styles."
			}
		";
	}
	
	
	if( !empty($set_bg) || !empty($set_color) || !empty($set_border) ){
		$styles .= "#".$id."{";
            if ( !empty($set_bg) ) {
                if ( $bg_color_type == 'simple' && !empty($btn_bg_color) ) {
                    $styles .= "background-image: linear-gradient(90deg, ".esc_attr($btn_bg_color).",".esc_attr($btn_bg_color).");";
                }
                if ( $bg_color_type == 'gradient' ) {
                    $bg_gradient_start = !empty($bg_gradient_start) ? $bg_gradient_start : 'transparent';
                    $bg_gradient_finish = !empty($bg_gradient_finish) ? $bg_gradient_finish : 'transparent';
                    $bg_gradient_angle = !empty($bg_gradient_angle) ? (int)$bg_gradient_angle.'deg' : '0deg';
                    $styles .= "background-color: ".esc_attr($bg_gradient_start).";";
                    $styles .= "background-image: linear-gradient(".esc_attr($bg_gradient_angle).', '.esc_attr($bg_gradient_start).', '.esc_attr($bg_gradient_finish).");";
                }
                if ( $bg_color_type == 'custom_gradient' ) {
                    $styles .= esc_attr($bg_gradient_custom);
                }
            }
            if ( !empty($set_color) && !empty($btn_font_color) ) {
                $styles .= "color: ".esc_attr($btn_font_color).";";
            }
            if ( !empty($set_border) ) {
                $styles .= "border: solid 1px transparent;";
            }
            if ( !empty($set_border) && !empty($btn_border_color) ) {
                $styles .= "border-color: ".esc_attr($btn_border_color).";";
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
        
            $styles .= "#".$id.":hover{";
                if ( !empty($set_bg) ) {
                    if ( $bg_color_type_hover == 'simple' && !empty($btn_bg_color_hover) ) {
                        $styles .= "background-image: linear-gradient(90deg, ".esc_attr($btn_bg_color_hover).",".esc_attr($btn_bg_color_hover).");";
                    }
                    if ( $bg_color_type_hover == 'gradient' ) {
                        $bg_gradient_start_hover = !empty($bg_gradient_start_hover) ? $bg_gradient_start_hover : 'transparent';
                        $bg_gradient_finish_hover = !empty($bg_gradient_finish_hover) ? $bg_gradient_finish_hover : 'transparent';
                        $bg_gradient_angle_hover = !empty($bg_gradient_angle_hover) ? (int)$bg_gradient_angle_hover.'deg' : '0deg';
                        $styles .= "background-image: linear-gradient(".esc_attr($bg_gradient_angle_hover).', '.esc_attr($bg_gradient_start_hover).', '.esc_attr($bg_gradient_finish_hover).");";
                    }
                    if ( $bg_color_type_hover == 'custom_gradient' ) {
                        $styles .= esc_attr($bg_gradient_custom_hover);
                    }
                }
                if ( !empty($set_color) && !empty($btn_font_color_hover) ) {
                    $styles .= "color: ".esc_attr($btn_font_color_hover).";";
                }
                if ( !empty($set_border) && !empty($btn_border_color_hover) ) {
                    $styles .= "border-color: ".esc_attr($btn_border_color_hover).";";
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
		$customize_align_landscape 
	){
		$styles .= "
			@media 
				screen and (max-width: 1199px), /*Check, is device a tablet*/
				screen and (max-width: 1366px) and (any-hover: none) /*Enable this styles for iPad Pro 1024-1366*/
			{
		";

			if( !empty($vc_landscape_styles) ){
				$styles .= "
					#".$id."{
						".$vc_landscape_styles."
					}
				";
			}
			if( $customize_align_landscape ){
				$styles .= "
					#".$id_wrapper."{
						text-align: ".$aligning_landscape.";
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
		$customize_align_portrait 
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
			if( $customize_align_portrait ){
				$styles .= "
					#".$id_wrapper."{
						text-align: ".$aligning_portrait.";
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
		$customize_align_mobile 
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
			if( $customize_align_mobile ){
				$styles .= "
					#".$id_wrapper."{
						text-align: ".$aligning_mobile.";
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
	$button_classes .= !empty($add_shadow) ? ' shadow' : '';

	/* -----> Button module output <----- */
	if( !empty($title) ){
		$out .= "<div id='".$id_wrapper."' class='cws_button_wrapper".(!empty($el_class) ? ' '.esc_attr($el_class):'')."'>";
			$out .= "<a id='".$id."' class='".$button_classes."' href='".(!empty($url) ? $url : '#')."' ".($new_tab ? 'target="_blank"' : '').">";
				$out .= "<span>";
					$out .= $icon_output;
					$out.= esc_html($title);
				$out .= "</span>";
			$out .= "</a>";
		$out .= "</div>";
	}

	return $out;
}
add_shortcode( 'cws_sc_button', 'cws_vc_shortcode_sc_button' );

?>