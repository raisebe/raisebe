<?php

function cws_vc_shortcode_sc_pricing_plan ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"title"							=> "",
		"price"							=> "49",
		"currency"						=> "$",
		"currency_pos"                  => "before",
		"price_desc"					=> "/mo",
        "image"							=> "",
		"button_title"					=> "",
		"button_url"					=> "#",
		"attention_text"                => "",
		"highlighted"                   => false,
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
        "customize_colors"              => false,
		
		"block_bg_color"				=> "#ffffff",
		"block_gradient_start"		    => "#c6512e",
        "block_gradient_finish"			=> "#c1289e",
		"title_color"					=> "#243238",
		"title_color_hover"				=> "#ffffff",
		"price_color"				    => SECONDARY_COLOR,
		"price_color_hover"				=> "#ffffff",
		"text_color"		            => "#243238",
		"text_color_hover"		        => "#ffffff",
		"bullet_color"		            => "",
		"bullet_color_hover"		    => "#FFDD6E",
		"divider_color"		            => "rgba(84, 88, 214, 0.2)",
		"divider_color_hover"		    => "rgba(255, 255, 255, 0.3)",
		"btn_font_color"				=> '#ffffff',
		"btn_bg_color"					=> SECONDARY_COLOR,
		"btn_font_color_hover"			=> '#243238',
		"btn_bg_color_hover"			=> '#ffffff',
		"attention_color"			    => "#ffffff",
		"attention_bg"			        => "#5557D6",
	);

    $responsive_vars = array(
        "all" => array(
            "custom_styles"		        => ""
        ),
    );

    $responsive_defaults = add_responsive_suffix($responsive_vars);
    $defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "cws_pricing_plan_" );
	$content = apply_filters( "the_content", $content );

	$first_p = substr($content, 0, 4);
	if( $first_p == '</p>' ){
		$content = substr($content, 5);
	}

	$last_p = substr($content, -4, -1);
	if( $last_p == '<p>' ){
		$content = substr($content, 0, -4);
	}
    
    $image_alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
    $image = !empty($image) ? wp_get_attachment_image_src($image, 'full')[0] : '';

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
    if ( $customize_colors ) {
        if (!empty($block_bg_color)) {
            $styles .= "
                #" . $id . "{
                    background-color: " . esc_attr($block_bg_color) . ";
                }
            ";
        }
        
        if (!empty($title_color)) {
            $styles .= "
                #" . $id . " .cws_pricing_plan_header .cws_pricing_plan_title{
                    color: " . esc_attr($title_color) . ";
                }
            ";
        }
        if (!empty($price_color)) {
            $styles .= "
                #" . $id . " .cws_pricing_plan_header .cws_pricing_plan_price{
                    color: " . esc_attr($price_color) . ";
                }
            ";
        }
        if (!empty($text_color)) {
            $styles .= "
                #" . $id . " .cws_pricing_plan_content .content-wrapper ul li,
                #" . $id . " .cws_pricing_plan_content .content-wrapper ol li,
                #" . $id . " .cws_pricing_plan_content .attention,
                #" . $id . " .cws_pricing_plan_content .content-wrapper p{
                    color: " . esc_attr($text_color) . ";
                }
            ";
        }
        if (!empty($bullet_color)) {
            $styles .= "
                #" . $id . " .cws_pricing_plan_content .content-wrapper ul li:before,
                #" . $id . " .cws_pricing_plan_content .content-wrapper ol li:before{
                    color: " . esc_attr($bullet_color) . ";
                }
            ";
        }
        if (!empty($divider_color)) {
            $styles .= "
                #" . $id . " .cws_pricing_plan_content .content-wrapper ul li:not(:first-child),
                #" . $id . " .cws_pricing_plan_content .content-wrapper ol li:not(:first-child){
                    border-top-color: " . esc_attr($divider_color) . ";
                }
            ";
        }
        if (!empty($btn_font_color)) {
            $styles .= "
                #" . $id . " .cws_button_wrapper .cws_button{
                    color: " . esc_attr($btn_font_color) . ";
                }
            ";
        }
        if (!empty($btn_bg_color)) {
            $styles .= "
                #" . $id . " .cws_button_wrapper .cws_button{
                    background: " . esc_attr($btn_bg_color) . ";
                }
            ";
        }
        if (!empty($attention_color) || !empty($attention_bg)) {
            $styles .= "
                #" . $id . " .cws_pricing_plan_header .attention{".
                    (!empty($attention_color) ? "color: " . esc_attr($attention_color) . ";" : "").
                    (!empty($attention_bg) ? "background-color: " . esc_attr($attention_bg) . ";" : "").
                "}
            ";
        }
        if( !empty($block_gradient_start) || !empty($block_gradient_finish) ){
            $styles .= "
                #".$id.":before{
            ";
                if ( !empty($block_gradient_start) && empty($block_gradient_finish) ){
                    $styles .= "background: ".esc_attr($block_gradient_start).";";
                }
                if ( empty($block_gradient_start) && !empty($block_gradient_finish) ){
                    $styles .= "background: ".esc_attr($block_gradient_finish).";";
                }
                if ( !empty($block_gradient_start) && !empty($block_gradient_finish) ){
                    $styles .= "background: linear-gradient(147.09deg, ".esc_attr($block_gradient_start)." -28.73%, ".esc_attr($block_gradient_finish)." 121.37%);";
                }
            $styles .= "
                }
            ";
        }
        if ( !empty($highlighted) ) {
            if (!empty($title_color_hover)) {
                $styles .= "
                    #" . $id . ".highlighted .cws_pricing_plan_header .cws_pricing_plan_title{
                        color: " . esc_attr($title_color_hover) . ";
                    }
                ";
            }
            if (!empty($price_color_hover)) {
                $styles .= "
                    #" . $id . ".highlighted .cws_pricing_plan_header .cws_pricing_plan_price{
                        color: " . esc_attr($price_color_hover) . ";
                    }
                ";
            }
            if (!empty($text_color_hover)) {
                $styles .= "
                    #" . $id . ".highlighted .cws_pricing_plan_content .content-wrapper ul li,
                    #" . $id . ".highlighted .cws_pricing_plan_content .content-wrapper ol li,
                    #" . $id . ".highlighted .cws_pricing_plan_content .attention,
                    #" . $id . ".highlighted .cws_pricing_plan_content .content-wrapper p{
                        color: " . esc_attr($text_color_hover) . ";
                    }
                ";
            }
            if (!empty($bullet_color_hover)) {
                $styles .= "
                    #" . $id . ".highlighted .cws_pricing_plan_content .content-wrapper ul li:before,
                    #" . $id . ".highlighted .cws_pricing_plan_content .content-wrapper ol li:before{
                        color: " . esc_attr($bullet_color_hover) . ";
                    }
                ";
            }
            if (!empty($divider_color_hover)) {
                $styles .= "
                    #" . $id . ".highlighted .cws_pricing_plan_content .content-wrapper ol li:not(:first-child),
                    #" . $id . ".highlighted .cws_pricing_plan_content .content-wrapper ul li:not(:first-child){
                        border-top-color: " . esc_attr($divider_color_hover) . " !important;
                    }
                ";
            }
    
    
            if (!empty($btn_font_color_hover)) {
                $styles .= "
                    #" . $id . ".highlighted .cws_button_wrapper .cws_button{
                        color: " . esc_attr($btn_font_color_hover) . " !important;
                    }
                ";
            }
            if (!empty($btn_bg_color_hover)) {
                $styles .= "
                    #" . $id . ".highlighted .cws_button_wrapper .cws_button{
                        background: " . esc_attr($btn_bg_color_hover) . " !important;
                    }
                ";
            }
        }
        $styles .= "
            @media
                screen and (min-width: 1367px),
                screen and (min-width: 1200px) and (any-hover: hover),
                screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
                screen and (min-width: 1200px) and (-ms-high-contrast: none),
                screen and (min-width: 1200px) and (-ms-high-contrast: active)
                {
            ";
        
            if (!empty($title_color_hover)) {
                $styles .= "
                    #" . $id . ":hover .cws_pricing_plan_header .cws_pricing_plan_title{
                        color: " . esc_attr($title_color_hover) . ";
                    }
                ";
            }
            if (!empty($price_color_hover)) {
                $styles .= "
                    #" . $id . ":hover .cws_pricing_plan_header .cws_pricing_plan_price{
                        color: " . esc_attr($price_color_hover) . ";
                    }
                ";
            }
            if (!empty($text_color_hover)) {
                $styles .= "
                    #" . $id . ":hover .cws_pricing_plan_content .content-wrapper ul li,
                    #" . $id . ":hover .cws_pricing_plan_content .content-wrapper ol li,
                    #" . $id . ":hover .cws_pricing_plan_content .attention,
                    #" . $id . ":hover .cws_pricing_plan_content .content-wrapper p{
                        color: " . esc_attr($text_color_hover) . ";
                    }
                ";
            }
            if (!empty($bullet_color_hover)) {
                $styles .= "
                    #" . $id . ":hover .cws_pricing_plan_content .content-wrapper ul li:before,
                    #" . $id . ":hover .cws_pricing_plan_content .content-wrapper ol li:before{
                        color: " . esc_attr($bullet_color_hover) . ";
                    }
                ";
            }
            if (!empty($divider_color_hover)) {
                $styles .= "
                    #" . $id . ":hover .cws_pricing_plan_content .content-wrapper ol li:not(:first-child),
                    #" . $id . ":hover .cws_pricing_plan_content .content-wrapper ul li:not(:first-child){
                        border-top-color: " . esc_attr($divider_color_hover) . " !important;
                    }
                ";
            }


            if (!empty($btn_font_color_hover)) {
                $styles .= "
                    #" . $id . ":hover .cws_button_wrapper .cws_button{
                        color: " . esc_attr($btn_font_color_hover) . " !important;
                    }
                ";
            }
            if (!empty($btn_bg_color_hover)) {
                $styles .= "
                    #" . $id . ":hover .cws_button_wrapper .cws_button{
                        background: " . esc_attr($btn_bg_color_hover) . " !important;
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
        !empty($vc_landscape_styles)
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
        $styles .= "
			}
		";
    }
    /* -----> End of landscape styles <----- */

    /* -----> Customize portrait styles <----- */
    if(
        !empty($vc_portrait_styles)
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

        $styles .= "
			}
		";
    }
    /* -----> End of portrait styles <----- */

    /* -----> Customize mobile styles <----- */
    if(
        !empty($vc_mobile_styles)
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
        $styles .= "
			}
		";
    }
    /* -----> End of mobile styles <----- */

    cws__vc_styles($styles);

	$module_classes = 'cws_pricing_plan_module';
	$module_classes .= !empty($highlighted) ? ' highlighted' : '';
	$module_classes .= !empty($el_class) ? ' '.esc_attr($el_class) : '';

	/* -----> Pricing Plan module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."'>";
		if( !empty($title) || !empty($price) || !empty($price_desc) || !empty($image) ){
			$out .= "<div class='cws_pricing_plan_header'>";
			    $out .= !empty($title) ? "<h3 class='cws_pricing_plan_title'>" . esc_html($title) . "</h3>" : "";
                if( !empty($image) ){
                    $out .= '<div class="cws_pricing_plan_image">';
                        $out .= '<img class="image" src="'.$image.'" alt="'.esc_attr($image_alt).'" />';
                    $out .= '</div>';
                }
			    $out .= !empty($price) ? "<div class='cws_pricing_plan_price'>" : "";
			        $out .= !empty($price) && !empty($currency) && $currency_pos == 'before' ? "<span class='currency'>" . esc_html($currency) . "</span>" : "";
			        $out .= !empty($price) ? "<span class='price_value'>" . esc_html($price) . "</span>" : "";
                    $out .= !empty($price) && !empty($currency) && $currency_pos == 'after' ? "<span class='currency'>" . esc_html($currency) . "</span>" : "";
                    $out .= !empty($price_desc) ? "<span class='price_description'>" . esc_html($price_desc) . "</span>" : "";
			    $out .= !empty($price) ? "</div>" : "";
            $out .= !empty($attention_text) ? "<div class='attention'><div class='attention_text'>".$attention_text."</div></div>" : "";
			$out .= "</div>";
		}

        $out .= "<div class='cws_pricing_plan_content'>";
            $out .= !empty($content) ? "<div class='content-wrapper'>".$content."</div>" : "";
            if( !empty($button_title) && !empty($button_url) ){
                $out .= "<div class='cws_button_wrapper'>";
                    $out .= "<a href='".esc_url($button_url)."' class='cws_button'>".esc_html($button_title)."</a>";
                $out .= "</div>";
            }
        $out .= "</div>";
	$out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_pricing_plan', 'cws_vc_shortcode_sc_pricing_plan' );

?>