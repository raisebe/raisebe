<?php

function cws_vc_shortcode_sc_text ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		'title'				            => '',
        'subtitle'                      => '',
        'el_class'					    => '',
        
        /* -----> STYLING TAB <----- */
        'title_tag'				        => 'h3',
        'title_color_type'				=> 'simple',
        'title_color'				    => '#243238',
        'title_gradient_start'			=> PRIMARY_COLOR,
        'title_gradient_finish'			=> SECONDARY_COLOR,
        'title_gradient_angle'          => '154',
        'title_gradient_custom'         => 'background-image: linear-gradient(154.77deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%);',
        
        'subtitle_color'                => '#ffffff',
        'subtitle_bg_color_type'        => 'simple',
        'subtitle_bg_color'             => PRIMARY_COLOR,
        'subtitle_bg_gradient_start'    => PRIMARY_COLOR,
        'subtitle_bg_gradient_finish'   => SECONDARY_COLOR,
        'subtitle_bg_gradient_angle'    => '154',
        'subtitle_bg_gradient_custom'   => 'background-image: linear-gradient(151.18deg, #5C52D8 -42.06%, #4F5BD5 130.7%);',
        
        'divider_color_type'            => 'simple',
        'divider_color'                 => PRIMARY_COLOR,
        'divider_gradient_start'        => PRIMARY_COLOR,
        'divider_gradient_finish'       => SECONDARY_COLOR,
        
        'font_color'                    => '#3b545f',
        'font_accent_color'             => PRIMARY_COLOR,
        'font_color_hover'              => SECONDARY_COLOR,
 	);
 	$responsive_vars = array(
 		/* -----> RESPONSIVE TABS <----- */
 		'all' => array(
 			'custom_styles'		=> '',
 			'customize_align'	=> false,
 			'module_alignment'	=> 'left',
 			
 			'add_title' 	    => false,
 			'title_size' 	    => '',
 			'title_line_height' => '',
 			'title_margin' 	    => '25px',
           
            'add_subtitle'      => false,
            'subtitle_size'     => '12px',
            'subtitle_margin'   => '19px',
            
            'add_divider'       => false,
            'divider_margin'    => '18px',
            
            'add_text'          => false,
            'text_size'         => '16px',
 		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "cws_textmodule_" );
	$title = wp_kses( $title, array(
		"b"			=> array(),
		"strong"	=> array(),
		"mark"		=> array(),
		"br"		=> array(),
		"sup"		=> array(),
		"sub"		=> array(),
		"em"		=> array(),
		"i"		    => array(),
		"u"		    => array(),
	));
	$subtitle = wp_kses( $subtitle, array(
		"b"			=> array(),
		"strong"	=> array(),
		"mark"		=> array(),
		"br"		=> array(),
		"sup"		=> array(),
		"sub"		=> array(),
		"em"		=> array(),
		"i"		    => array(),
		"u"		    => array(),
	));

	$content = apply_filters( "the_content", $content );
	// Remove empty <p> && <p></p> tags
	$content = preg_replace('/<p[^>]*><\\/p[^>]*>/', '', $content); 
	$content = preg_replace('/<p[^>]*>$/', '', $content); 

	$first_p = substr($content, 0, 4);
	if( $first_p == '</p>' ){
		$content = substr($content, 5);
	}

	$last_p = substr($content, -4, -1);
	if( $last_p == '<p>' ){
		$content = substr($content, 0, -4);
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
	if( !empty($vc_desktop_styles) ){
		$styles .= "
			.".$id."{
				".$vc_desktop_styles.";
			}
		";
	}
	
	if ( !empty($add_title) && !empty($title) ) {
	    if ( !empty($title_size) || !empty($title_line_height) || !empty($title_margin) ) {
            $styles .= "
                ." . $id . " .cws_textmodule_title{" .
                    (!empty($title_size) ? "font-size: " . esc_attr($title_size) . ";" : "") .
                    (!empty($title_line_height) ? "line-height: " . esc_attr($title_line_height) . ";" : "") .
                    (!empty($title_margin) ? "margin-bottom: " . esc_attr($title_margin) . ";" : "") .
                "}
            ";
        }
        $styles .= ".".$id." .cws_textmodule_title .cws_textmodule_title_text{";
            if ( $title_color_type == 'simple' && !empty($title_color) ) {
                $styles .= "color: ".esc_attr($title_color).";";
            }
            if ( $title_color_type == 'gradient' ) {
                $title_gradient_start = !empty($title_gradient_start) ? $title_gradient_start : 'transparent';
                $title_gradient_finish = !empty($title_gradient_finish) ? $title_gradient_finish : 'transparent';
                $title_gradient_angle = !empty($title_gradient_angle) ? (int)$title_gradient_angle.'deg' : '0deg';
                $styles .= "background-image: linear-gradient(".esc_attr($title_gradient_angle).', '.esc_attr($title_gradient_start).', '.esc_attr($title_gradient_finish).");";
            }
            if ( $title_color_type == 'custom_gradient' ) {
                $styles .= esc_attr($title_gradient_custom);
            }
        $styles .= "}";
    }
    
    if ( !empty($add_divider) ) {
        if ( !empty($divider_margin) ) {
            $styles .= "
                ." . $id . " .cws_textmodule_divider{
                    margin-top: " . esc_attr($divider_margin) . ";
                }
            ";
        }
        if (
            ($divider_color_type == 'simple' && !empty($divider_color)) ||
            ($divider_color_type == 'gradient')
        ) {
            $styles .= "." . $id . " .cws_textmodule_divider .cws_textmodule_divider_inner {";
            if ($divider_color_type == 'simple' && !empty($divider_color)) {
                $styles .= "background: " . esc_attr($divider_color) . ";";
            }
            if ($divider_color_type == 'gradient') {
                $divider_gradient_start = !empty($divider_gradient_start) ? $divider_gradient_start : 'transparent';
                $divider_gradient_finish = !empty($divider_gradient_finish) ? $divider_gradient_finish : 'transparent';
                $styles .= "background-image: linear-gradient(90deg," . esc_attr($divider_gradient_start) . ', ' . esc_attr($divider_gradient_finish) . ");";
            }
            $styles .= "}";
        }
    }
    
    if (
        !empty($add_subtitle) && !empty($subtitle) &&
        (
            !empty($subtitle_size) ||
            !empty($subtitle_margin) ||
            !empty($subtitle_color) ||
            ($subtitle_bg_color_type == 'simple' && !empty($subtitle_bg_color)) ||
            ($subtitle_bg_color_type == 'gradient') ||
            ($subtitle_bg_color_type == 'custom_gradient' && !empty($subtitle_bg_gradient_custom))
        )
    ) {
        $styles .= "." . $id . " .cws_textmodule_subtitle .cws_textmodule_subtitle_text {";
                $styles .= (!empty($subtitle_size) ? "font-size: ".esc_attr($subtitle_size).";" : "");
                $styles .= (!empty($subtitle_margin) ? "margin-bottom: ".esc_attr($subtitle_margin).";" : "");
                $styles .= (!empty($subtitle_color) ? "color: ".esc_attr($subtitle_color).";" : "");
                if ($subtitle_bg_color_type == 'simple' && !empty($subtitle_bg_color)) {
                    $styles .= "background: " . esc_attr($subtitle_bg_color) . ";";
                }
                if ($subtitle_bg_color_type == 'gradient') {
                    $subtitle_bg_gradient_start = !empty($subtitle_bg_gradient_start) ? $subtitle_bg_gradient_start : 'transparent';
                    $subtitle_bg_gradient_finish = !empty($subtitle_bg_gradient_finish) ? $subtitle_bg_gradient_finish : 'transparent';
                    $styles .= "background-image: linear-gradient(90deg," . esc_attr($subtitle_bg_gradient_start) . ', ' . esc_attr($subtitle_bg_gradient_finish) . ");";
                }
                if ($subtitle_bg_color_type == 'custom_gradient' && !empty($subtitle_bg_gradient_custom)) {
                    $styles .= esc_attr($subtitle_bg_gradient_custom);
                }
        $styles .= "}";
    }
    
    if ( !empty($add_text) && !empty($content) ) {
        if ( !empty($text_size) || !empty($font_color) ) {
            $styles .= "
                ." . $id . " .cws_textmodule_content{" .
                    (!empty($text_size) ? "font-size: " . esc_attr($text_size) . ";" : "") .
                    (!empty($font_color) ? "color: " . esc_attr($font_color) . ";" : "") .
                "}
            ";
        }
        if ( !empty($font_color) ) {
            $styles .= "
				.".$id." .cws_textmodule_content li{
					color: ".esc_attr($font_color).";
				}
			";
        }
        if ( !empty($font_accent_color) ) {
            $styles .= "
				.".$id." .cws_textmodule_content a,
				.".$id." .cws_textmodule_content li:before{
					color: ".esc_attr($font_accent_color).";
				}
			";
        }
    }
    
    if ( !empty($font_color_hover) ) {
        $styles .= "
            @media
				screen and (min-width: 1367px),
				screen and (min-width: 1200px) and (any-hover: hover),
				screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
				screen and (min-width: 1200px) and (-ms-high-contrast: none),
				screen and (min-width: 1200px) and (-ms-high-contrast: active)
			{
				.".$id." .cws_textmodule_content a:hover{
					color: ".esc_attr($font_color_hover).";
				}
			}
		";
    }
	
    if( !empty($customize_align) ){
        $styles .= "
			.".$id."{
				text-align: ".$module_alignment.";
			}
		";
    }
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( 
		!empty($vc_landscape_styles) || 
		$customize_align_landscape || 
		( !empty($add_title_landscape) && !empty($title) && (!empty($title_size_landscape) || !empty($title_line_height_landscape) || !empty($title_margin_landscape)) ) ||
		( !empty($add_divider_landscape) && !empty($divider_margin_landscape) ) ||
        ( !empty($add_subtitle_landscape) && !empty($subtitle) && (!empty($subtitle_size_landscape) || !empty($subtitle_margin_landscape)) ) ||
        ( !empty($add_text_landscape) && !empty($content) && !empty($text_size_landscape) )
	){
		$styles .= "
			@media 
				screen and (max-width: 1199px),
				screen and (max-width: 1366px) and (any-hover: none)
			{
		";

			if( !empty($vc_landscape_styles) ){
				$styles .= "
					.".$id."{
						".$vc_landscape_styles.";
					}
				";
			}
			if( $customize_align_landscape ){
				$styles .= "
					.".$id."{
						text-align: ".$module_alignment_landscape.";
					}
				";
			}
            if ( !empty($add_title_landscape) && !empty($title) && (!empty($title_size_landscape) || !empty($title_line_height_landscape) || !empty($title_margin_landscape)) ) {
                $styles .= "
                    ." . $id . " .cws_textmodule_title{" .
                        (!empty($title_size_landscape) ? "font-size: " . esc_attr($title_size_landscape) . ";" : "") .
                        (!empty($title_line_height_landscape) ? "line-height: " . esc_attr($title_line_height_landscape) . ";" : "") .
                        (!empty($title_margin_landscape) ? "margin-bottom: " . esc_attr($title_margin_landscape) . ";" : "") .
                    "}
                ";
            }
            if ( !empty($add_divider_landscape) && !empty($divider_margin_landscape) ) {
                $styles .= "
                    ." . $id . " .cws_textmodule_divider{
                        margin-bottom: " . esc_attr($divider_margin_landscape) . ";
                    }
                ";
            }
            if ( !empty($add_subtitle_landscape) && !empty($subtitle) && (!empty($subtitle_size_landscape) || !empty($subtitle_margin_landscape)) ) {
                $styles .= "
                    .".$id." .cws_textmodule_subtitle{".
                        (!empty($subtitle_size_landscape) ? "font-size: ".esc_attr($subtitle_size_landscape).";" : "").
                        (!empty($subtitle_margin_landscape) ? "margin-bottom: ".esc_attr($subtitle_margin_landscape).";" : "").
                    "}
                ";
            }
            if ( !empty($add_text) && !empty($content) && !empty($text_size_landscape) ) {
                $styles .= "
                    .". $id . " .cws_textmodule_content{
                        font-size: " . esc_attr($text_size_landscape) . ";
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
        ( !empty($add_title_portrait) && !empty($title) && (!empty($title_size_portrait) || !empty($title_line_height_portrait) || !empty($title_margin_portrait)) ) ||
        ( !empty($add_divider_portrait) && !empty($divider_margin_portrait) ) ||
        ( !empty($add_subtitle_portrait) && !empty($subtitle) && (!empty($subtitle_size_portrait) || !empty($subtitle_margin_portrait)) ) ||
        ( !empty($add_text_portrait) && !empty($content) && !empty($text_size_portrait) )
	){
		$styles .= "
			@media screen and (max-width: 991px){
		";

			if( !empty($vc_portrait_styles) ){
				$styles .= "
					.".$id."{
						".$vc_portrait_styles.";
					}
				";
			}
			if( $customize_align_portrait ){
				$styles .= "
					.".$id."{
						text-align: ".$module_alignment_portrait.";
					}
				";
			}
            if ( !empty($add_title_portrait) && !empty($title) && (!empty($title_size_portrait) || !empty($title_line_height_portrait) || !empty($title_margin_portrait)) ) {
                $styles .= "
                    ." . $id . " .cws_textmodule_title{" .
                        (!empty($title_size_portrait) ? "font-size: " . esc_attr($title_size_portrait) . ";" : "") .
                        (!empty($title_line_height_portrait) ? "line-height: " . esc_attr($title_line_height_portrait) . ";" : "") .
                        (!empty($title_margin_portrait) ? "margin-bottom: " . esc_attr($title_margin_portrait) . ";" : "") .
                    "}
                ";
            }
            if ( !empty($add_divider_portrait) && !empty($divider_margin_portrait) ) {
                $styles .= "
                    ." . $id . " .cws_textmodule_divider{
                        margin-bottom: " . esc_attr($divider_margin_portrait) . ";
                    }
                ";
            }
            if ( !empty($add_subtitle_portrait) && !empty($subtitle) && (!empty($subtitle_size_portrait) || !empty($subtitle_margin_portrait)) ) {
                $styles .= "
                    .".$id." .cws_textmodule_subtitle{".
                        (!empty($subtitle_size_portrait) ? "font-size: ".esc_attr($subtitle_size_portrait).";" : "").
                        (!empty($subtitle_margin_portrait) ? "margin-bottom: ".esc_attr($subtitle_margin_portrait).";" : "").
                    "}
                ";
            }
            if ( !empty($add_text) && !empty($content) && !empty($text_size_portrait) ) {
                $styles .= "
                    .". $id . " .cws_textmodule_content{
                        font-size: " . esc_attr($text_size_portrait) . ";
                    }
                ";
            }
			
		$styles .= "
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if ( !empty($vc_mobile_styles) || $customize_align_mobile ||
        ( !empty($add_title_mobile) && !empty($title) && (!empty($title_size_mobile) || !empty($title_line_height_mobilet) || !empty($title_margin_mobile)) ) ||
        ( !empty($add_divider_mobile) && !empty($divider_margin_mobile) ) ||
        ( !empty($add_subtitle_mobile) && !empty($subtitle) && (!empty($subtitle_size_mobile) || !empty($subtitle_margin_mobile)) ) ||
        ( !empty($add_text_mobile) && !empty($content) && !empty($text_size_mobile) )
	){
		$styles .= "
		    @media screen and (max-width: 767px){
		";

			if( !empty($vc_mobile_styles) ){
				$styles .= "
					.".$id."{
						".$vc_mobile_styles.";
					}
				";
			}
			if( $customize_align_mobile ){
				$styles .= "
					.".$id."{
						text-align: ".$module_alignment_mobile.";
					}
				";
			}
            if ( !empty($add_title_mobile) && !empty($title) && (!empty($title_size_mobile) || !empty($title_line_height_mobile) || !empty($title_margin_mobile)) ) {
                $styles .= "
                    ." . $id . " .cws_textmodule_title{" .
                        (!empty($title_size_mobile) ? "font-size: " . esc_attr($title_size_mobile) . ";" : "") .
                        (!empty($title_line_height_mobile) ? "line-height: " . esc_attr($title_line_height_mobile) . ";" : "") .
                        (!empty($title_margin_mobile) ? "margin-bottom: " . esc_attr($title_margin_mobile) . ";" : "") .
                    "}
                ";
            }
            if ( !empty($add_divider_mobile) && !empty($divider_margin_mobile) ) {
                $styles .= "
                    ." . $id . " .cws_textmodule_divider{
                        margin-bottom: " . esc_attr($divider_margin_mobile) . ";
                    }
                ";
            }
            if ( !empty($add_subtitle_mobile) && !empty($subtitle) && (!empty($subtitle_size_mobile) || !empty($subtitle_margin_mobile)) ) {
                $styles .= "
                    .".$id." .cws_textmodule_subtitle{".
                        (!empty($subtitle_size_mobile) ? "font-size: ".esc_attr($subtitle_size_mobile).";" : "").
                        (!empty($subtitle_margin_mobile) ? "margin-bottom: ".esc_attr($subtitle_margin_mobile).";" : "").
                    "}
                ";
            }
            if ( !empty($add_text) && !empty($content) && !empty($text_size_mobile) ) {
                $styles .= "
                    .". $id . " .cws_textmodule_content{
                        font-size: " . esc_attr($text_size_mobile) . ";
                    }
                ";
            }
			
		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */
	cws__vc_styles($styles);

	$module_classes = $id.' cws_textmodule';
	$module_classes .= !empty($el_class) ? ' '.esc_attr($el_class) : '';

	/* -----> Text module output <----- */
	if ( !empty($title) || !empty($add_divider) || !empty($subtitle) || !empty($content) ){
		$out .= "<div class='".$module_classes."'>"; //ID in class, coz slick-slider rewrite ID.
        
            if( !empty($subtitle) ){
                $out .= "<div class='cws_textmodule_subtitle'>";
                    $out .= "<div class='cws_textmodule_subtitle_text'>". $subtitle ."</div>";
                $out .= "</div>";
            }
            
            if( !empty($title) ){
                $out .= "<".$title_tag." class='cws_textmodule_title'>";
                    $out .= "<span class='cws_textmodule_title_text title_color_".esc_attr($title_color_type)."'>";
                        $out .= $title;
                    $out .= "</span>";
				$out .= "</".$title_tag.">";
            }
            
            if( !empty($add_divider) ){
                $out .= '<div class="cws_textmodule_divider">';
                    $out .= '<div class="cws_textmodule_divider_inner"></div>';
                $out .= "</div>";
            }
            
            if( !empty($content) ){
                $out .= "<div class='cws_textmodule_content'>";
                    $out .= $content;
                $out .= "</div>";
            }

		$out .= "</div>";
	}

	return $out;
}
add_shortcode( 'cws_sc_text', 'cws_vc_shortcode_sc_text' );

?>