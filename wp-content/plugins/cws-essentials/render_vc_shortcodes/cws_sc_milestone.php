<?php

function cws_vc_shortcode_sc_milestone ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
        "count"                             => "50",
        "symbol"                            => "",
        "title"                             => "",
		"el_class"						    => "",
		
		/* -----> STYLING TAB <----- */
        "counter_color_type"                => "simple",
        "counter_color"                     => PRIMARY_COLOR,
        "counter_gradient_start"            => PRIMARY_COLOR,
        "counter_gradient_finish"           => SECONDARY_COLOR,
        "counter_gradient_angle"            => "154",
        "counter_gradient_custom"           => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        
        "title_tag"                         => "h5",
        "title_color_type"                  => "simple",
        "title_color"                       => "#243238",
        "title_gradient_start"              => PRIMARY_COLOR,
        "title_gradient_finish"             => SECONDARY_COLOR,
        "title_gradient_angle"              => "154",
        "title_gradient_custom"             => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        
        "font_color"                        => "#3b545f",
        "font_accent_color"                 => PRIMARY_COLOR,
        "font_accent_hover"                 => SECONDARY_COLOR,
        
        "add_background"                    => false,
        "background_color_type"             => "simple",
        "background_color"                  => "",
        "background_gradient_start"         => PRIMARY_COLOR,
        "background_gradient_finish"        => SECONDARY_COLOR,
        "background_gradient_angle"         => "154",
        "background_gradient_custom"        => "background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);",
        "add_shadow"                        => false,
        "shadow_css"                        => "",
	);

	$responsive_vars = array(
		"all" => array(
            "customize_align"                   => false,
            "module_alignment"                  => "center",
            "custom_styles"                     => "",
            
            "add_counter"                       => false,
            "counter_size"					    => "50px",
            "counter_line_height"			    => "65px",
            
            "add_title"                         => false,
            "title_size"                        => "18px",
            "title_line_height"                 => "24px",
            "title_margin"                      => "5px",
            
            "add_text"                          => false,
            "text_size"                         => "14px",
            "text_line_height"                  => "25px",
            "text_margin"                       => "12px",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
    $content = apply_filters( "the_content", $content );
	$id = uniqid( "cws_milestone_" );
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
        $customize_align
    ){
        $styles .= "
			#" . $id . "{".
                (!empty($vc_desktop_styles) ? $vc_desktop_styles : "") .
                ($customize_align ? "text-align: " . $module_alignment . ";" : "") .
            "}
		";
    }
    
    // Counter styles
    if ( !empty($add_counter) && !empty($count) ) {
        if (
            !empty($counter_size) ||
            !empty($counter_line_height)
        ) {
            $styles .= "
                #" . $id . " .count_wrapper .counter,
                #" . $id . " .count_wrapper .symbol{" .
                    (!empty($counter_size) ? "font-size: " . esc_attr($counter_size) . ";" : "") .
                    (!empty($counter_line_height) ? "line-height: " . esc_attr($counter_line_height) . ";" : "") .
                "}
            ";
        }
        if (
            ($counter_color_type == 'simple' && !empty($counter_color)) ||
            ($counter_color_type == 'gradient') ||
            ($counter_color_type == 'custom_gradient' && !empty($counter_gradient_custom))
        ) {
            $styles .= "#" . $id . " .count_wrapper{";
                if ($counter_color_type == 'simple' && !empty($counter_color)) {
                    $styles .= "color: " . esc_attr($counter_color) . ";";
                }
                if ($counter_color_type == 'gradient') {
                    $counter_gradient_start = !empty($counter_gradient_start) ? $counter_gradient_start : 'transparent';
                    $counter_gradient_finish = !empty($counter_gradient_finish) ? $counter_gradient_finish : 'transparent';
                    $counter_gradient_angle = !empty($counter_gradient_angle) ? (int)$counter_gradient_angle . 'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(" . esc_attr($counter_gradient_angle) . ', ' . esc_attr($counter_gradient_start) . ', ' . esc_attr($counter_gradient_finish) . ");";
                }
                if ($counter_color_type == 'custom_gradient' && !empty($counter_gradient_custom)) {
                    $styles .= esc_attr($counter_gradient_custom);
                }
            $styles .= "}";
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
                #" . $id . " .milestone_title{" .
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
            $styles .= "#" . $id . " .milestone_title .milestone_title_text{";
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
    
    // Content styles
    if ( !empty($add_text) && !empty($content) ) {
        if (
            !empty($text_size) ||
            !empty($font_color) ||
            !empty($text_line_height) ||
            !empty($text_margin)
        ) {
            $styles .= "
                #" . $id . " .content_wrapper{" .
                (!empty($text_size) ? "font-size: " . esc_attr($text_size) . ";" : "") .
                (!empty($text_line_height) ? "line-height: " . esc_attr($text_line_height) . ";" : "") .
                (!empty($text_margin) ? "margin-top: " . esc_attr($text_margin) . ";" : "") .
                (!empty($font_color) ? "color: " . esc_attr($font_color) . ";" : "") .
                "}
            ";
        }
        if ( !empty($font_color) ) {
            $styles .= "
				#".$id." .content_wrapper li{
					color: ".esc_attr($font_color).";
				}
			";
        }
        if ( !empty($font_accent_color) ) {
            $styles .= "
				#".$id." .content_wrapper a,
				#".$id." .content_wrapper li:before{
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
        $styles .= "#" . $id . " .milestone_background {";
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
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
    if(
        !empty($vc_landscape_styles) ||
        $customize_align_landscape ||
        (
            !empty($add_counter_landscape) && !empty($count) &&
            (
                !empty($counter_size_landscape) ||
                !empty($counter_line_height_landscape)
            )
        ) ||
        (
            !empty($add_title_landscape) && !empty($title) &&
            (
                !empty($title_size_landscape) ||
                !empty($title_line_height_landscape) ||
                !empty($title_margin_landscape) )
        ) ||
        (
            !empty($add_text_landscape) && !empty($content) &&
            (
                !empty($text_size_landscape) ||
                !empty($text_line_height_landscape) ||
                !empty($text_margin_landscape) )
        )
    ){
        $styles .= "
			@media
				screen and (max-width: 1199px), /*Check, is device a tablet*/
				screen and (max-width: 1366px) and (any-hover: none) /*Enable this styles for iPad Pro 1024-1366*/
			{
		";
        
            if(
                !empty($vc_landscape_styles) ||
                $customize_align_landscape
            ){
                $styles .= "
                    #" . $id . "{".
                        (!empty($vc_landscape_styles) ? $vc_landscape_styles : "") .
                        ($customize_align_landscape ? "text-align: ".$module_alignment_landscape.";" : "") .
                    "}
                ";
            }
            
            if ( !empty($add_counter_landscape) && !empty($count) &&
                (
                    !empty($counter_size_landscape) ||
                    !empty($counter_line_height_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .count_wrapper .counter,
                    #" . $id . " .count_wrapper .symbol{" .
                        (!empty($counter_size_landscape) ? "font-size: " . esc_attr($counter_size_landscape) . ";" : "") .
                        (!empty($counter_line_height_landscape) ? "line-height: " . esc_attr($counter_line_height_landscape) . ";" : "") .
                    "}
                ";
            }
            
            if ( !empty($add_title_landscape) && !empty($title) &&
                (
                    !empty($title_size_landscape) ||
                    !empty($title_line_height_landscape) ||
                    !empty($title_margin_landscape)
                )
            ) {
                $styles .= "
                    #" . $id . " .milestone_title{" .
                        (!empty($title_size_landscape) ? "font-size: " . esc_attr($title_size_landscape) . ";" : "") .
                        (!empty($title_line_height_landscape) ? "line-height: " . esc_attr($title_line_height_landscape) . ";" : "") .
                        (!empty($title_margin_landscape) ? "margin-top: " . esc_attr($title_margin_landscape) . ";" : "") .
                    "}
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
                    #" . $id . " .content_wrapper{" .
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
            !empty($add_counter_portrait) && !empty($count) &&
            (
                !empty($counter_size_portrait) ||
                !empty($counter_line_height_portrait)
            )
        ) ||
        (
            !empty($add_title_portrait) && !empty($title) &&
            (
                !empty($title_size_portrait) ||
                !empty($title_line_height_portrait) ||
                !empty($title_margin_portrait) )
        ) ||
        (
            !empty($add_text_portrait) && !empty($content) &&
            (
                !empty($text_size_portrait) ||
                !empty($text_line_height_portrait) ||
                !empty($text_margin_portrait) )
        )
    ){
        $styles .= "
			@media screen and (max-width: 991px){
		";
        
            if(
                !empty($vc_portrait_styles) ||
                $customize_align_portrait
            ){
                $styles .= "
                    #" . $id . "{".
                        (!empty($vc_portrait_styles) ? $vc_portrait_styles : "") .
                        ($customize_align_portrait ? "text-align: ".$module_alignment_portrait.";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_counter_portrait) && !empty($count) &&
                (
                    !empty($counter_size_portrait) ||
                    !empty($counter_line_height_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .count_wrapper .counter,
                    #" . $id . " .count_wrapper .symbol{" .
                        (!empty($counter_size_portrait) ? "font-size: " . esc_attr($counter_size_portrait) . ";" : "") .
                        (!empty($counter_line_height_portrait) ? "line-height: " . esc_attr($counter_line_height_portrait) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_title_portrait) && !empty($title) &&
                (
                    !empty($title_size_portrait) ||
                    !empty($title_line_height_portrait) ||
                    !empty($title_margin_portrait)
                )
            ) {
                $styles .= "
                    #" . $id . " .milestone_title{" .
                        (!empty($title_size_portrait) ? "font-size: " . esc_attr($title_size_portrait) . ";" : "") .
                        (!empty($title_line_height_portrait) ? "line-height: " . esc_attr($title_line_height_portrait) . ";" : "") .
                        (!empty($title_margin_portrait) ? "margin-top: " . esc_attr($title_margin_portrait) . ";" : "") .
                    "}
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
                    #" . $id . " .content_wrapper{" .
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
            !empty($add_counter_mobile) && !empty($count) &&
            (
                !empty($counter_size_mobile) ||
                !empty($counter_line_height_mobile)
            )
        ) ||
        (
            !empty($add_title_mobile) && !empty($title) &&
            (
                !empty($title_size_mobile) ||
                !empty($title_line_height_mobile) ||
                !empty($title_margin_mobile) )
        ) ||
        (
            !empty($add_text_mobile) && !empty($content) &&
            (
                !empty($text_size_mobile) ||
                !empty($text_line_height_mobile) ||
                !empty($text_margin_mobile) )
        )
    ){
        $styles .= "
			@media screen and (max-width: 767px){
		";
        
            if(
                !empty($vc_mobile_styles) ||
                $customize_align_mobile
            ){
                $styles .= "
                    #" . $id . "{".
                        (!empty($vc_mobile_styles) ? $vc_mobile_styles : "") .
                        ($customize_align_mobile ? "text-align: ".$module_alignment_mobile.";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_counter_mobile) && !empty($count) &&
                (
                    !empty($counter_size_mobile) ||
                    !empty($counter_line_height_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .count_wrapper .counter,
                    #" . $id . " .count_wrapper .symbol{" .
                        (!empty($counter_size_mobile) ? "font-size: " . esc_attr($counter_size_mobile) . ";" : "") .
                        (!empty($counter_line_height_mobile) ? "line-height: " . esc_attr($counter_line_height_mobile) . ";" : "") .
                    "}
                ";
            }
        
            if ( !empty($add_title_mobile) && !empty($title) &&
                (
                    !empty($title_size_mobile) ||
                    !empty($title_line_height_mobile) ||
                    !empty($title_margin_mobile)
                )
            ) {
                $styles .= "
                    #" . $id . " .milestone_title{" .
                        (!empty($title_size_mobile) ? "font-size: " . esc_attr($title_size_mobile) . ";" : "") .
                        (!empty($title_line_height_mobile) ? "line-height: " . esc_attr($title_line_height_mobile) . ";" : "") .
                        (!empty($title_margin_mobile) ? "margin-top: " . esc_attr($title_margin_mobile) . ";" : "") .
                    "}
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
                    #" . $id . " .content_wrapper{" .
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
	
    $module_classes = 'cws_milestone_module';
    $module_classes .= $customize_align ? ' align_'.esc_attr($module_alignment) : '';
    $module_classes .= $customize_align_landscape ? ' landscape_align_'.esc_attr($module_alignment_landscape) : '';
    $module_classes .= $customize_align_portrait ? ' portrait_align_'.esc_attr($module_alignment_portrait) : '';
    $module_classes .= $customize_align_mobile ? ' mobile_align_'.esc_attr($module_alignment_mobile) : '';
    
    $module_classes .= !empty($el_class) ? ' '  .esc_attr($el_class) : "";

	/* -----> Milestone module output <----- */
	$out .= "<div id='" . $id . "' class='" . $module_classes . "'>";
	
        if ( !empty($add_background) ) {
            $out .= '<div class="milestone_background'.(!empty($background_color_type) ? ' color_type_' . esc_attr($background_color_type) : '').'"></div>';
        }

        if( !empty($count) ){
            $out .= "<div class='count_wrapper title_ff".(!empty($counter_color_type) ? " color_type_" . esc_attr($counter_color_type) : "")."'>";
                $out .= "<span class='counter'>".esc_html($count)."</span>";
                if( !empty($symbol) ){
                    $out .= "<span class='symbol'>".esc_html($symbol)."</span>";
                }
            $out .= "</div>";
        }
        
        if( !empty($title) ){
            $out .= '<'.$title_tag.' class="milestone_title'.(!empty($title_color_type) ? ' color_type_' . esc_attr($title_color_type) : '').'">';
                $out .= sprintf('<span class="milestone_title_text">%s</span>', $title);
            $out .= '</'.$title_tag.'>';
        }
        
        if( !empty($content) ){
            $out .= "<div class='content_wrapper'>";
                $out .= $content;
            $out .= "</div>";
        }
        
	$out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_milestone', 'cws_vc_shortcode_sc_milestone' );

?>