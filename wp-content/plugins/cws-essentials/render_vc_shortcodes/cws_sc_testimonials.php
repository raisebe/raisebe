<?php

function cws_vc_shortcode_sc_testimonials ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"columns"						=> "1",
		
		"carousel"						=> false,
		"autoplay"						=> false,
		"autoplay_speed"				=> "3000",
        "slides_to_scroll"				=> "1",
		
		"pointer_color"                 => "#f4475c",
		"dots_color"                    => "#f2f2f2",
		"active_dots_color_type"        => "custom_gradient",
		"active_dots_color"             => PRIMARY_COLOR,
		"active_dots_gradient_start"    => PRIMARY_COLOR,
		"active_dots_gradient_finish"   => SECONDARY_COLOR,
		"active_dots_gradient_angle"    => "90",
		"active_dots_gradient_custom"   => "background-image: linear-gradient(105.13deg, #FEDA75 -53.56%, #FA7E1E 35.31%, #D62976 76.67%, #962FBF 141.02%, #4F5BD5 188.52%);",
		
		"values"						=> "",
		
		"el_class"						=> "",
		
		/* -----> STYLING TAB <----- */
		"add_avatar"				    => false,
		"avatar_bd_color_type"          => "custom_gradient",
		"avatar_bd_color"               => PRIMARY_COLOR,
		"avatar_bd_gradient_start"      => PRIMARY_COLOR,
		"avatar_bd_gradient_finish"     => SECONDARY_COLOR,
		"avatar_bd_gradient_angle"      => "-18",
		"avatar_bd_gradient_custom"     => "background-image: linear-gradient(108deg, #FCB04E 0%, #E95647 65%, #C82A86 80%);",
        
        "pos_color"				        => "#9B9B9B",
        
        "name_color"				    => "#243238",
        
        "text_color"				    => "",
        
        "add_background"                => true,
        "background_color_type"         => "custom_gradient",
        "background_color"              => PRIMARY_COLOR,
        "background_gradient_start"     => PRIMARY_COLOR,
        "background_gradient_finish"    => SECONDARY_COLOR,
        "background_gradient_angle"     => "-18",
        "background_gradient_custom"    => "background-image: linear-gradient(174.86deg, #FFFFFF 7.72%, #FAEFFF 145.46%);",
	);

	$responsive_vars = array(
		"all" => array(
            "add_position"				    => false,
            "pos_font_size"				    => "14px",
            "pos_margin_bottom"				=> "7px",
            
            "add_name"				        => false,
            "name_font_size"				=> "25px",
            "name_margin_bottom"		    => "11px",
            
            "add_text"				        => false,
            "text_font_size"				=> "18px",
            "text_lh"		                => "35px",
			
			"custom_styles"		=> "",
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$values = (array)vc_param_group_parse_atts($values);
	$id = uniqid( "cws_testimonials_" );

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
			#".$id."{
				".$vc_desktop_styles."
			}
		";
	}
	
	// Avatar styles
	if (
	    !empty($add_avatar) &&
        (
            ($avatar_bd_color_type == 'simple' && !empty($avatar_bd_color)) ||
            ($avatar_bd_color_type == 'gradient') ||
            ($avatar_bd_color_type == 'custom_gradient' && !empty($avatar_bd_gradient_custom))
        )
    ) {
        $styles .= "#".$id." .testimonial .image_wrapper{";
            if ( $avatar_bd_color_type == 'simple' && !empty($avatar_bd_color) ) {
                $styles .= "background: ".esc_attr($avatar_bd_color).";";
            }
            if ( $avatar_bd_color_type == 'gradient' ) {
                $avatar_bd_gradient_start = !empty($avatar_bd_gradient_start) ? $avatar_bd_gradient_start : 'transparent';
                $avatar_bd_gradient_finish = !empty($avatar_bd_gradient_finish) ? $avatar_bd_gradient_finish : 'transparent';
                $avatar_bd_gradient_angle = !empty($avatar_bd_gradient_angle) ? (int)$avatar_bd_gradient_angle.'deg' : '0deg';
                $styles .= "background-image: linear-gradient(".esc_attr($avatar_bd_gradient_angle).', '.esc_attr($avatar_bd_gradient_start).', '.esc_attr($avatar_bd_gradient_finish).");";
            }
            if ( $avatar_bd_color_type == 'custom_gradient' && !empty($avatar_bd_gradient_custom) ) {
                $styles .= esc_attr($avatar_bd_gradient_custom);
            }
        $styles .= "}";
    }
	
	// Position styles
    if (
        !empty($add_position) &&
        (
            !empty($pos_font_size) ||
            !empty($pos_margin_bottom) ||
            !empty($pos_color)
        )
    ) {
        $styles .= "#".$id." .testimonial .testimonial_position{".
            ( !empty($pos_font_size) ? "font-size: " . esc_attr($pos_font_size) . ";" : "" ).
            ( !empty($pos_margin_bottom) ? "margin-bottom: " . esc_attr($pos_margin_bottom) . ";" : "" ).
            ( !empty($pos_color) ? "color: " . esc_attr($pos_color) . ";" : "" ).
        "}";
    }
    
    // Name styles
    if (
        !empty($add_name) &&
        (
            !empty($name_font_size) ||
            !empty($name_margin_bottom) ||
            !empty($name_color)
        )
    ) {
        $styles .= "#".$id." .testimonial .testimonial_name{".
            ( !empty($name_font_size) ? "font-size: " . esc_attr($name_font_size) . ";" : "" ).
            ( !empty($name_margin_bottom) ? "margin-bottom: " . esc_attr($name_margin_bottom) . ";" : "" ).
            ( !empty($name_color) ? "color: " . esc_attr($name_color) . ";" : "" ).
            "}";
    }
    
    // Text styles
    if (
        !empty($add_text) &&
        (
            !empty($text_font_size) ||
            !empty($text_lh) ||
            !empty($text_color)
        )
    ) {
        $styles .= "#".$id." .testimonial .testimonial_desc{".
            ( !empty($text_font_size) ? "font-size: " . esc_attr($text_font_size) . ";" : "" ).
            ( !empty($text_lh) ? "line-height: " . esc_attr($text_lh) . ";" : "" ).
            ( !empty($text_color) ? "color: " . esc_attr($text_color) . ";" : "" ).
        "}";
    }
    
    // Background styles
    if (
        !empty($add_background) &&
        (
            ($background_color_type == 'simple' && !empty($background_color)) ||
            ($background_color_type == 'gradient') ||
            ($background_color_type == 'custom_gradient' && !empty($background_gradient_custom))
        )
    ) {
        $styles .= "#".$id." .testimonial .content_wrapper:after{";
        if ( $background_color_type == 'simple' && !empty($background_color) ) {
            $styles .= "background: ".esc_attr($background_color).";";
        }
        if ( $background_color_type == 'gradient' ) {
            $background_gradient_start = !empty($background_gradient_start) ? $background_gradient_start : 'transparent';
            $background_gradient_finish = !empty($background_gradient_finish) ? $background_gradient_finish : 'transparent';
            $background_gradient_angle = !empty($background_gradient_angle) ? (int)$background_gradient_angle.'deg' : '0deg';
            $styles .= "background-image: linear-gradient(".esc_attr($background_gradient_angle).', '.esc_attr($background_gradient_start).', '.esc_attr($background_gradient_finish).");";
        }
        if ( $background_color_type == 'custom_gradient' && !empty($background_gradient_custom) ) {
            $styles .= esc_attr($background_gradient_custom);
        }
        $styles .= "}";
    }
    
    // Slider styles
    if ( !empty($carousel) ) {
        if ( !empty($pointer_color) ) {
            $styles .= "
                #".$id." .cws_carousel .slick-dots li button svg,
                #".$id." .cws_custom_carousel .slick-dots li button svg{
                    fill: " . esc_attr($pointer_color) . ";
                }
            ";
        }
        if ( !empty($dots_color) ) {
            $styles .= "
                #".$id." .cws_carousel .slick-dots li:not(.slick-active) button,
                #".$id." .cws_custom_carousel .slick-dots li:not(.slick-active) button{
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
                #".$id." .cws_carousel .slick-dots li.slick-active button,
                #".$id." .cws_custom_carousel .slick-dots li.slick-active button{
            ";
                if ( $active_dots_color_type == 'simple' && !empty($active_dots_color) ) {
                    $styles .= "background: ".esc_attr($active_dots_color).";";
                }
                if ( $active_dots_color_type == 'gradient' ) {
                    $active_dots_gradient_start = !empty($active_dots_gradient_start) ? $active_dots_gradient_start : 'transparent';
                    $active_dots_gradient_finish = !empty($active_dots_gradient_finish) ? $active_dots_gradient_finish : 'transparent';
                    $active_dots_gradient_angle = !empty($active_dots_gradient_angle) ? (int)$active_dots_gradient_angle.'deg' : '0deg';
                    $styles .= "background-image: linear-gradient(".esc_attr($active_dots_gradient_angle).', '.esc_attr($active_dots_gradient_start).', '.esc_attr($active_dots_gradient_finish).");";
                }
                if ( $active_dots_color_type == 'custom_gradient' && !empty($active_dots_gradient_custom) ) {
                    $styles .= esc_attr($active_dots_gradient_custom);
                }
            $styles .= "}";
        }
    }
	
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if(
	    !empty($vc_landscape_styles) ||
        (
            !empty($add_position_landscape) &&
            (
                !empty($pos_font_size_landscape) ||
                !empty($pos_margin_bottom_landscape)
            )
        ) ||
        (
            !empty($add_name_landscape) &&
            (
                !empty($name_font_size_landscape) ||
                !empty($name_margin_bottom_landscape)
            )
        ) ||
        (
            !empty($add_text_landscape) &&
            (
                !empty($text_font_size_landscape) ||
                !empty($text_lh_landscape)
            )
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
						".$vc_landscape_styles.";
					}
				";
			}
			
			if (
                !empty($add_position_landscape) &&
                (
                    !empty($pos_font_size_landscape) ||
                    !empty($pos_margin_bottom_landscape)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_position{".
                    ( !empty($pos_font_size_landscape) ? "font-size: " . esc_attr($pos_font_size_landscape) . ";" : "" ).
                    ( !empty($pos_margin_bottom_landscape) ? "margin-bottom: " . esc_attr($pos_margin_bottom_landscape) . ";" : "" ).
                "}";
            }
        
            if (
                !empty($add_name_landscape) &&
                (
                    !empty($name_font_size_landscape) ||
                    !empty($name_margin_bottom_landscape)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_name{".
                    ( !empty($name_font_size_landscape) ? "font-size: " . esc_attr($name_font_size_landscape) . ";" : "" ).
                    ( !empty($name_margin_bottom_landscape) ? "margin-bottom: " . esc_attr($name_margin_bottom_landscape) . ";" : "" ).
                "}";
            }
        
            if (
                !empty($add_text_landscape) &&
                (
                    !empty($text_font_size_landscape) ||
                    !empty($text_lh_landscape)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_desc{".
                    ( !empty($text_font_size_landscape) ? "font-size: " . esc_attr($text_font_size_landscape) . ";" : "" ).
                    ( !empty($text_lh_landscape) ? "line-height: " . esc_attr($text_lh_landscape) . ";" : "" ).
                "}";
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
            !empty($add_position_portrait) &&
            (
                !empty($pos_font_size_portrait) ||
                !empty($pos_margin_bottom_portrait)
            )
        ) ||
        (
            !empty($add_name_portrait) &&
            (
                !empty($name_font_size_portrait) ||
                !empty($name_margin_bottom_portrait)
            )
        ) ||
        (
            !empty($add_text_portrait) &&
            (
                !empty($text_font_size_portrait) ||
                !empty($text_lh_portrait)
            )
        )
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
        
            if (
                !empty($add_position_portrait) &&
                (
                    !empty($pos_font_size_portrait) ||
                    !empty($pos_margin_bottom_portrait)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_position{".
                    ( !empty($pos_font_size_portrait) ? "font-size: " . esc_attr($pos_font_size_portrait) . ";" : "" ).
                    ( !empty($pos_margin_bottom_portrait) ? "margin-bottom: " . esc_attr($pos_margin_bottom_portrait) . ";" : "" ).
                "}";
            }
            
            if (
                !empty($add_name_portrait) &&
                (
                    !empty($name_font_size_portrait) ||
                    !empty($name_margin_bottom_portrait)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_name{".
                    ( !empty($name_font_size_portrait) ? "font-size: " . esc_attr($name_font_size_portrait) . ";" : "" ).
                    ( !empty($name_margin_bottom_portrait) ? "margin-bottom: " . esc_attr($name_margin_bottom_portrait) . ";" : "" ).
                "}";
            }
            
            if (
                !empty($add_text_portrait) &&
                (
                    !empty($text_font_size_portrait) ||
                    !empty($text_lh_portrait)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_desc{".
                    ( !empty($text_font_size_portrait) ? "font-size: " . esc_attr($text_font_size_portrait) . ";" : "" ).
                    ( !empty($text_lh_portrait) ? "line-height: " . esc_attr($text_lh_portrait) . ";" : "" ).
                "}";
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
            !empty($add_position_mobile) &&
            (
                !empty($pos_font_size_mobile) ||
                !empty($pos_margin_bottom_mobile)
            )
        ) ||
        (
            !empty($add_name_mobile) &&
            (
                !empty($name_font_size_mobile) ||
                !empty($name_margin_bottom_mobile)
            )
        ) ||
        (
            !empty($add_text_mobile) &&
            (
                !empty($text_font_size_mobile) ||
                !empty($text_lh_mobile)
            )
        )
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
        
            if (
                !empty($add_position_mobile) &&
                (
                    !empty($pos_font_size_mobile) ||
                    !empty($pos_margin_bottom_mobile)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_position{".
                    ( !empty($pos_font_size_mobile) ? "font-size: " . esc_attr($pos_font_size_mobile) . ";" : "" ).
                    ( !empty($pos_margin_bottom_mobile) ? "margin-bottom: " . esc_attr($pos_margin_bottom_mobile) . ";" : "" ).
                "}";
            }
            
            if (
                !empty($add_name_mobile) &&
                (
                    !empty($name_font_size_mobile) ||
                    !empty($name_margin_bottom_mobile)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_name{".
                    ( !empty($name_font_size_mobile) ? "font-size: " . esc_attr($name_font_size_mobile) . ";" : "" ).
                    ( !empty($name_margin_bottom_mobile) ? "margin-bottom: " . esc_attr($name_margin_bottom_mobile) . ";" : "" ).
                "}";
            }
            
            if (
                !empty($add_text_mobile) &&
                (
                    !empty($text_font_size_mobile) ||
                    !empty($text_lh_mobile)
                )
            ) {
                $styles .= "#".$id." .testimonial .testimonial_desc{".
                    ( !empty($text_font_size_mobile) ? "font-size: " . esc_attr($text_font_size_mobile) . ";" : "" ).
                    ( !empty($text_lh_mobile) ? "line-height: " . esc_attr($text_lh_mobile) . ";" : "" ).
                "}";
            }

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */

	$module_classes = "cws_testimonials_module";
	$module_classes .= $carousel ? " cws_carousel_wrapper" : '';
	$module_classes .= !empty($el_class) ? " ".esc_attr($el_class) : '';

	$module_atts = 'data-columns="'.$columns.'"';
	$module_atts .= ' data-pagination="on" data-draggable="on" data-infinite="on" data-auto-height="on"';
	$module_atts .= ' data-slides-to-scroll="'.esc_attr($slides_to_scroll).'"';
	$module_atts .= $autoplay ? ' data-autoplay="on"' : '';
	$module_atts .= $autoplay && !empty($autoplay_speed) ? ' data-autoplay-speed="'.esc_attr($autoplay_speed).'"' : '';

	/* -----> Banner module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."' ".($carousel ? $module_atts : '').">";
		$out .= "<div class='".($carousel ? 'cws_carousel' : 'cws_testimonials_wrapper columns_'.$columns)."'>";

			foreach ($values as $value) {
                $id_item = uniqid( "cws_testimonials_item_" );
			    
				$out .= "<div class='testimonial' id='" . esc_attr($id_item) . "'>";

					$image = '';
					if( !empty($value['image']) ){
						$image_alt = get_post_meta($value['image'], '_wp_attachment_image_alt', TRUE);
						$image = wp_get_attachment_image_src($value['image'], array('109', '109'))[0];
					}
                
                    if( !empty($image) ){
                        $out .= "<div class='image_wrapper'>";
                            $out .= "<img src='".esc_url($image)."' alt='".esc_attr($image_alt)."' />";
                        $out .= "</div>";
                    }

					$out .= "<div class='content_wrapper'>";
                        if ( !empty($value['name']) || !empty($value['position']) ) {
						    $out .= "<div class='testimonial_info'>";
                        }
                            if( !empty($value['position']) ){
                                $out .= "<div class='testimonial_position'>".esc_html($value['position'])."</div>";
                            }
                            if( !empty($value['name']) ){
                                $out .= "<div class='testimonial_name'>".esc_html($value['name'])."</div>";
                            }
                        if ( !empty($value['name']) || !empty($value['position']) ) {
                            $out .= "</div>";
                        }
                        if( !empty($value['description']) ){
                            $out .= "<p class='testimonial_desc'>".esc_html($value['description'])."</p>";
                        }
					$out .= "</div>";

				$out .= "</div>";
			}

		$out .= "</div>";
	$out .= "</div>";
    
    cws__vc_styles($styles);

	return $out;
}
add_shortcode( 'cws_sc_testimonials', 'cws_vc_shortcode_sc_testimonials' );

?>