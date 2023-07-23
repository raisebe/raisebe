<?php
function cws_vc_shortcode_sc_icon_list ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"dir"							=> "line",
		"icon_bg"						=> false,
		"values"						=> "",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"icons_color"					=> "#ffffff",
		"icons_color_hover"				=> "#ffea74",
		"icons_bg"						=> PRIMARY_COLOR,
		"icons_bg_hover"				=> PRIMARY_COLOR,
		"text_color"				    => "#ffffff",
		"text_hover"				    => "#ffea74",
	);

	$responsive_vars = array(
		"all" => array(
			"custom_styles"		=> "",
			"customize_align"	=> false,
			"alignment"			=> "left",
			"customize_size"	=> false,
			"icons_size"		=> "18px",
			"title_size"		=> "16px",
			"spacing"			=> "36px"
		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$values = (array)vc_param_group_parse_atts($values);
	$id = uniqid( "cws_icon_list_" );
	if( class_exists('WooCommerce') ){
		$cws_woocommerce = new Promosys_WooExt();
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
			#".$id."{
				".$vc_desktop_styles.";
			}
		";
	}
	if( $customize_align ){
		$styles .= "
			#".$id."{
				text-align: ".esc_attr($alignment).";
			}
		";	
	}
	if( $customize_size ){
		if( !empty($icons_size) ){
			$styles .= "
				#".$id." i:before{
					font-size: ".(int)esc_attr($icons_size)."px;
				}
			";
		}
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .title,
				#".$id." .login-block,
				#".$id." li{
					font-size: ".(int)esc_attr($title_size)."px;
				}
			";
		}
		if( !empty($spacing) ){
			$styles .= "
				#".$id.".direction_line .cws_icon_list_wrapper > *{
					margin-left: ".round(((int)esc_attr($spacing)/2))."px;
					margin-right: ".round(((int)esc_attr($spacing)/2))."px;
				}
				#".$id.".direction_column .cws_icon_list_wrapper > * > *:not(:first-child){
					margin-top: ".(int)esc_attr($spacing)."px;
				}
			";
		}
	}
    if ( $dir == 'line' ) {
        if ( $customize_size && !empty($spacing) ) {
            $styles .= "
				#".$id.".direction_line .cws_icon_list_wrapper > *:not(:first-child):before{
					left: -". ( floor((int)esc_attr($spacing)/2 - 1) ) ."px;
				}
				#".$id.".direction_line .cws_icon_list_wrapper > .social_button + *:not(.social_button){
					margin-left: ". ( (int)esc_attr($spacing) - 5 ) ."px !important;
				}
			";
        } else {
            $styles .= "
				#".$id.".direction_line .cws_icon_list_wrapper > *:not(:first-child):before{
					left: -7px;
				}
			";
        }
    }
    
    
    
    
    if( !empty($icons_color) || !empty($icons_bg) ){
        $styles .= "
			#".$id." .custom_url i,
			#".$id." .social_button i,
			#".$id." .mini-cart .woo_mini-count > span
			{".
                (!empty($icons_color) ? "color: " . esc_attr($icons_color) . ";" : "") .
                (!empty($icons_bg) ? "background-color: " . esc_attr($icons_bg) . ";" : "") .
            "}
		";
    }
    if( !empty($text_color) ){
        $styles .= "
			#".$id.",
			#".$id." li,
			#".$id." p,
			#".$id." a,
			#".$id." .mini-cart .woo_mini-count:before,
			#".$id." .hamburger
			{
				color: ".esc_attr($text_color).";
			}
			#".$id.".direction_line .cws_icon_list_wrapper > *:not(:first-child).with_divider:before,
			#".$id." .cws_icon_list_wrapper > a.custom_sidebar_trigger .hamburger
			{
				background-color: ".esc_attr($text_color).";
			}
		";
    }
	if( !empty($icons_color_hover) || !empty($icons_bg_hover) || !empty($text_hover) ){
		$styles .= "
			@media 
				screen and (min-width: 1367px), /*Disable this styles for iPad Pro 1024-1366*/
				screen and (min-width: 1200px) and (any-hover: hover), /*Check, is device a desktop (Not working on IE & FireFox)*/
				screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0), /*Check, is device a desktop with firefox*/
				screen and (min-width: 1200px) and (-ms-high-contrast: none), /*Check, is device a desktop with IE 10 or above*/
				screen and (min-width: 1200px) and (-ms-high-contrast: active) /*Check, is device a desktop with IE 10 or above*/
			{";
		
                if( !empty($icons_color_hover) || !empty($icons_bg_hover) ){
                    $styles .= "
                        #".$id." .custom_url:hover i,
                        #".$id." .social_button:hover i,
                        #".$id." .mini-cart .woo_mini-count:hover > span,
                        #".$id." .cws_icon_list_wrapper > a.custom_sidebar_trigger:hover .hamburger
                        {".
                            (!empty($icons_color_hover) ? "color: " . esc_attr($icons_color_hover) . ";" : "") .
                            (!empty($icons_bg_hover) ? "background-color: " . esc_attr($icons_bg_hover) . ";" : "") .
                        "}
                    ";
                }
                if( !empty($text_hover) ){
                    $styles .= "
                        #".$id." a:hover,
                        #".$id." .mini-cart .woo_mini-count:hover:before,
                        #".$id." li.item-language-main > span:hover
                        {
                            color: ".esc_attr($text_hover).";
                        }
                        #".$id." .cws_icon_list_wrapper > a.custom_sidebar_trigger:hover .hamburger
                        {
                            background-color: ".esc_attr($text_hover).";
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
		$customize_align_landscape || 
		$customize_size_landscape
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
			if( $customize_size_landscape ){
				if( !empty($icons_size_landscape) ){
					$styles .= "
						#".$id." *:before{
							font-size: ".(int)esc_attr($icons_size_landscape)."px;
						}
					";
				}
				if( !empty($title_size_landscape) ){
					$styles .= "
						#".$id." .title,
						#".$id." li{
							font-size: ".(int)esc_attr($title_size_landscape)."px;
						}
					";	
				}
				if( !empty($spacing_landscape) ){
					$styles .= "
						#".$id.".direction_line .cws_icon_list_wrapper > *:not(:first-child){
							margin-left: ".(int)esc_attr($spacing_landscape)."px;
						}
						#".$id.".direction_column .cws_icon_list_wrapper > * > *{
							margin-top: ".(int)esc_attr($spacing_landscape)."px;
						}
					";
				}
			}
			if( $customize_align_landscape ){
				$styles .= "
					#".$id."{
						text-align: ".esc_attr($alignment_landscape).";
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
		$customize_size_portrait 
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
			if( $customize_size_portrait ){
				if( !empty($icons_size_portrait) ){
					$styles .= "
						#".$id." *:before{
							font-size: ".(int)esc_attr($icons_size_portrait)."px;
						}
					";
				}
				if( !empty($title_size_portrait) ){
					$styles .= "
						#".$id." .title,
						#".$id." li{
							font-size: ".(int)esc_attr($title_size_portrait)."px;
						}
					";	
				}
				if( !empty($spacing_portrait) ){
					$styles .= "
						#".$id.".direction_line .cws_icon_list_wrapper > *:not(:first-child){
							margin-left: ".(int)esc_attr($spacing_portrait)."px;
						}
						#".$id.".direction_column .cws_icon_list_wrapper > * > *{
							margin-top: ".(int)esc_attr($spacing_portrait)."px;
						}
					";
				}
			}
			if( $customize_align_portrait ){
				$styles .= "
					#".$id."{
						text-align: ".esc_attr($alignment_portrait).";
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
		$customize_size_mobile
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
			if( $customize_size_mobile ){
				if( !empty($icons_size_mobile) ){
					$styles .= "
						#".$id." *:before{
							font-size: ".(int)esc_attr($icons_size_mobile)."px;
						}
					";
				}
				if( !empty($title_size_mobile) ){
					$styles .= "
						#".$id." .title,
						#".$id." li{
							font-size: ".(int)esc_attr($title_size_mobile)."px;
						}
					";	
				}
				if( !empty($spacing_mobile) ){
					$styles .= "
						#".$id.".direction_line .cws_icon_list_wrapper > *:not(:first-child){
							margin-left: ".(int)esc_attr($spacing_mobile)."px;
						}
						#".$id.".direction_column .cws_icon_list_wrapper > * > *{
							margin-top: ".(int)esc_attr($spacing_mobile)."px;
						}
					";
				}
			}
			if( $customize_align_mobile ){
				$styles .= "
					#".$id."{
						text-align: ".esc_attr($alignment_mobile).";
					}
				";	
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */

	cws__vc_styles($styles);

	$module_classes = 'cws_icon_list_module';
//	$module_classes .= ' header_icons';
	$module_classes .= ' direction_'.esc_attr($dir);
	$module_classes .= $icon_bg ? ' icon_bg' : '';
	$module_classes .= !empty($el_class) ? ' '.esc_attr($el_class) : '';

	/* -----> Filter Products module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."'>";
	    $out .= "<div class='cws_icon_list_wrapper'>";

		foreach( $values as $value ){
            $icon = esc_attr(cws_ext_vc_sc_get_icon($value));

            $icon_output = '';

            /* -----> Getting Icon <----- */
            if( empty($icon_lib) ){
                $icon_lib = 'FontAwesome';
            }
            if( $icon_lib == 'cws_svg' ){
                $icon = "icon_".$icon_lib;
                $svg_icon = json_decode(str_replace("``", "\"", $value[$icon]), true);
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

            $title = !empty($value['title']) ? esc_html($value['title']) : '';
			$url = !empty($value['url']) ? esc_url($value['url']) : '';
			$sidebar = !empty($value['sidebar']) ? esc_attr($value['sidebar']) : '';
			$divider = !empty($value['add_divider']) ? ' with_divider' : '';

			switch( $value['function'] ){
				case 'sidebar':
					$out .= "<a href='#' class='custom_sidebar_trigger".(!empty($divider) ? esc_attr($divider) : "")."' data-sidebar='".esc_attr($sidebar)."'>";
						$out .= '<span class="icon_sidebar_trigger"><span class="hamburger"></span></span>';
						$out .= !empty($title) ? "<span class='title'>".$title."</span>" : "";
					$out .= "</a>";
					break;
				case 'cart':
					if( class_exists('WooCommerce') ){
						$out .= "<div class='item".(!empty($divider) ? esc_attr($divider) : "")."'>".$cws_woocommerce->cws_woocommerce_get_mini_cart()."</div>";
					}
					break;
				case 'lang':
					if( function_exists('wpm_language_switcher') ){
					    $out .= "<div class='item".(!empty($divider) ? esc_attr($divider) : "")."'>";
						ob_start();
                            wpm_language_switcher ('dropdown', 'both');
						$out .= ob_get_clean();
						$out .= "</div>";
					}
					break;
				case 'cws_search':
					$out .= "<a class='search-trigger".(!empty($divider) ? esc_attr($divider) : "").(!empty($title) ? " with_title" : "")."'>";
						$out .= !empty($title) ? "<span class='title'>".$title."</span>" : "";
					$out .= "</a>";
					break;
                case 'login':
                    $out .= "<div class='login-block".(!empty($divider) ? esc_attr($divider) : "")."'>";
                        $out .= wp_loginout('', false);
                        $out .= "<span class='login-separator'> / </span>";
                        $out .= wp_register('', '', false);
                    $out .= '</div>';
                    break;
                case 'social':
                    $link = $url;
                    $start_tag = !empty($link) ? "<a href='".esc_url($link)."'" : '<p';
                    $end_tag = !empty($link) ? "</a>" : "</p>";
                    $out .= $start_tag." class='social_button custom_url".(!empty($divider) ? esc_attr($divider) : "")."'>";
                        $out .= !empty($title) ? "<span class='title'>".$title."</span>" : "";
                        $out .= !empty($icon) ? $icon_output : '';
                    $out .= $end_tag;
                    break;
                case 'extra':
                    if ( !empty($url) && !empty($title) ) {
                        $out .= "<a href='".esc_url($url)."' class='extra_button".(!empty($divider) ? esc_attr($divider) : "")."'>";
                            $out .= !empty($title) ? $title : "";
                        $out .= "</a>";
                    }
                    break;
				case 'custom':
					if( $value['type'] == 'phone' ){
						$link = 'tel:'.$url;
					} else if( $value['type'] == 'mail' ){
						$link = 'mailto:'.$url;
					} else {
						$link = $url;
					}

					$start_tag = !empty($link) ? "<a href='".esc_url($link)."'" : '<p';
					$end_tag = !empty($link) ? "</a>" : "</p>";

					$out .= $start_tag." class='custom_url".(!empty($divider) ? esc_attr($divider) : "")."'>";
						$out .= !empty($icon) ? $icon_output : '';
						$out .= !empty($title) ? "<span class='title'>".$title."</span>" : "";
					$out .= $end_tag;
					break;
			}
		}

	    $out .= "</div>";
	$out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_icon_list', 'cws_vc_shortcode_sc_icon_list' );

?>