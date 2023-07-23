<?php

function cws_vc_shortcode_sc_icon ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
        "icon_lib"				=> "FontAwesome",
		"url"					=> "",
        "new_tab"				=> false,
		"el_class"				=> "",
        
        /* -----> STYLING TAB <----- */
        "icon_shape"			=> "none",
        "icon_color_type"       => "simple",
        "icon_color"            => PRIMARY_COLOR,
        "icon_gradient_start"   => PRIMARY_COLOR,
        "icon_gradient_finish"  => SECONDARY_COLOR,
        "icon_gradient_angle"   => "154",
        "icon_gradient_custom"  => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "shape_color_type"      => "simple",
        "shape_color"           => "",
        "shape_gradient_start"  => PRIMARY_COLOR,
        "shape_gradient_finish" => SECONDARY_COLOR,
        "shape_gradient_angle"  => "154",
        "shape_gradient_custom" => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
	);

	$responsive_vars = array(
		"all" => array(
			"add_icon"		    => false,
			"icon_size"		    => "50px",
			
			"customize_align"   => false,
			"module_alignment"  => "center",
			"custom_styles"		=> "",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$icon = esc_attr(cws_ext_vc_sc_get_icon($atts));
	$id = uniqid( "cws_icon_" );

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
        !empty($customize_align)
    ){
		$styles .= "
			#".$id."{".
                (!empty($vc_desktop_styles) ? $vc_desktop_styles : "") .
                ($customize_align ? "text-align: ".$module_alignment.";" : "") .
			"}
		";
	}
    
    if (
        !empty($add_icon) && !empty($icon) && (
            (!empty($icon_size)) ||
            ($icon_color_type == 'simple' && !empty($icon_color)) ||
            ($icon_color_type == 'gradient') ||
            ($icon_color_type == 'custom_gradient' && !empty($icon_gradient_custom))
        )
    ) {
        $styles .= "#".$id." .icon_wrapper i{";
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
    }
    if (
        !empty($add_icon) && !empty($icon) && $icon_shape != 'none'
    ) {
        if (
            ($shape_color_type == 'simple' && !empty($shape_color)) ||
            ($shape_color_type == 'gradient') ||
            ($shape_color_type == 'custom_gradient' && !empty($shape_gradient_custom))
        ) {
            $styles .= "
                #".$id." .icon_wrapper .shape{";
                    if ( $shape_color_type == 'simple' && !empty($shape_color) ) {
                        $styles .= "background: ".esc_attr($shape_color).";";
                    }
                    if ( $shape_color_type == 'gradient' ) {
                        $shape_gradient_start = !empty($shape_gradient_start) ? $shape_gradient_start : 'transparent';
                        $shape_gradient_finish = !empty($shape_gradient_finish) ? $shape_gradient_finish : 'transparent';
                        $shape_gradient_angle = !empty($shape_gradient_angle) ? (int)$shape_gradient_angle.'deg' : '0deg';
                        $styles .= "background-image: linear-gradient(".esc_attr($shape_gradient_angle).', '.esc_attr($shape_gradient_start).', '.esc_attr($shape_gradient_finish).");";
                    }
                    if ( $shape_color_type == 'custom_gradient' && !empty($shape_gradient_custom) ) {
                        $styles .= esc_attr($shape_gradient_custom);
                    }
            $styles .= "
                }
            ";
        }
    }
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if(
	    !empty($vc_landscape_styles) ||
        !empty($customize_align_landscape) ||
        (
            !empty($icon) && !empty($add_icon_landscape) && !empty($icon_size_landscape)
        )
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
                    #".$id."{
                        text-align: ".$module_alignment_landscape.";
                    }
                ";
            }
            
            if( !empty($icon) && !empty($add_icon_landscape) && !empty($icon_size_landscape) ){
                $styles .= "
                    #".$id." .icon_wrapper i{
                        font-size: " . esc_attr($icon_size_landscape). ";
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
        !empty($customize_align_portrait) ||
        (
            !empty($icon) && !empty($add_icon_portrait) && !empty($icon_size_portrait)
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
        
            if( $customize_align_portrait ){
                $styles .= "
                    #".$id."{
                        text-align: ".$module_alignment_portrait.";
                    }
                ";
            }
            
            if( !empty($icon) && !empty($add_icon_portrait) && !empty($icon_size_portrait) ){
                $styles .= "
                    #".$id." .icon_wrapper i{
                        font-size: " . esc_attr($icon_size_portrait). ";
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
        !empty($customize_align_mobile) ||
        (
            !empty($icon) && !empty($add_icon_mobile) && !empty($icon_size_mobile)
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
        
            if( $customize_align_mobile ){
                $styles .= "
                    #".$id."{
                        text-align: ".$module_alignment_mobile.";
                    }
                ";
            }
            
            if( !empty($icon) && !empty($add_icon_mobile) && !empty($icon_size_mobile) ){
                $styles .= "
                    #".$id." .icon_wrapper i{
                        font-size: " . esc_attr($icon_size_mobile). ";
                    }
                ";
            }

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */ 

	cws__vc_styles($styles);

	$icon_output = '';
    
    $module_classes = 'cws_icon_module';
    $module_classes .= !empty($add_icon) && !empty($icon_shape) ? ' icon_shape_'.esc_attr($icon_shape) : "";
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
    if (!empty($icon_output)) {
        $out .= "<div id='" . $id . "' class='" . $module_classes . "'>";
            $out .= $start_tag . " class='icon_wrapper".(!empty($icon_color_type) ? " color_type_" . esc_attr($icon_color_type) : "")."'>";
                if ( $icon_shape != 'none' ) {
                    $out .= '<div class="shape"></div>';
                }
                $out .= $icon_output;
            $out .= $end_tag;
        $out .= "</div>";
    }

	return $out;
}
add_shortcode( 'cws_sc_icon', 'cws_vc_shortcode_sc_icon' );

?>