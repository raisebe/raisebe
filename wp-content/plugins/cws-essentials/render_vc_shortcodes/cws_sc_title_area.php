<?php

function cws_vc_shortcode_sc_title_area ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"show_mask"				    => true,
		"mask"					    => "",
		"mask_start"			    => "bottom_center",
		"hide_fields"			    => "none",
		"mouse_anim"			    => false,
		"scroll_anim"			    => false,
		"el_class"				    => "",
 		/* -----> STYLES TABS <----- */
 		"share_bg"				    => true,
		"customize_colors"          => false,
		"overlay_color_type"        => "custom_gradient",
		"overlay_color"             => SECONDARY_COLOR,
		"overlay_gradient_start"    => PRIMARY_COLOR,
		"overlay_gradient_finish"   => SECONDARY_COLOR,
		"overlay_gradient_angle"    => "154",
		"overlay_gradient_custom"   => "background-image: linear-gradient(178.32deg, rgba(255, 255, 255, 0.5) -20.58%, rgba(255, 255, 255, 0) 97.59%), linear-gradient(140.43deg, #FEDA75 -42.06%, #FA7E1E 10.13%, #D62976 34.42%, #962FBF 72.21%, #4F5BD5 100.11%); background-position: 0 -60%; background-size: 100% 267%; opacity: 0.8;",
		
		"title_color"			    => '#fff',
		"divider_color"			    => '#fff',
		"info_color"		        => '#fff',
		"info_color_hover"		    => '#ffea74',
		"breadcrumbs_color"		    => '#fff',
		"breadcrumbs_color_hover"   => '#ffea74',
 	);
 	$responsive_vars = array(
 		/* -----> RESPONSIVE TABS <----- */
 		"all" => array(
 			"custom_styles"		    => "",
 			"customize_size"	    => false,
			"title_size"		    => "50px",
			"title_margins"		    => "0px 0px 0px 0px",
			"divider_margins"	    => "7px 0px 12px 0px",
			"info_size"             => "16px",
			"breadcrumbs_size"	    => "18px",
 		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "cws_title_area_" );

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
	if( $show_mask && !empty($mask) ){
	    if ( !empty($share_bg) ) {
            $styles .= ".cws_header_template_bg{";
        } else {
            $styles .= "#".$id."{";
        }
		$styles .= "
				-webkit-mask-image: url(".wp_get_attachment_image_url($mask).");
				-webkit-mask-size: cover;
			    -webkit-mask-repeat: no-repeat;
	    		-webkit-mask-position: ".esc_attr(str_replace('_', ' ', $mask_start)).";
			}
		";
	}
	if( $customize_size ){
		if( !empty($title_size) ){
			$styles .= "
				#".$id." .page_title{
					font-size: ".(int)esc_attr($title_size)."px;
				}
			";
		}
		if( !empty($title_margins) ){
			$styles .= "
				#".$id." .page_title{
					margin: ".esc_attr($title_margins).";
				}
			";
		}
		if( !empty($divider_margins) ){
			$styles .= "
				#".$id." .title_divider{
					margin: ".esc_attr($divider_margins).";
				}
			";
		}
		if( !empty($breadcrumbs_size) ){
			$styles .= "
				#".$id." .woocommerce-breadcrumb *,
				#".$id." .breadcrumbs *{
					font-size: ".(int)esc_attr($breadcrumbs_size)."px;
				}
			";
		}
	}
    if ( $customize_colors ) {
        // Background styles
        if (
            ($overlay_color_type == 'simple' && !empty($overlay_color)) ||
            ($overlay_color_type == 'gradient') ||
            ($overlay_color_type == 'custom_gradient' && !empty($overlay_gradient_custom))
        ) {
            if ( !empty($share_bg) ) {
                $styles .= ".cws_header_template_bg {";
            } else {
                $styles .= "#" . $id . " .page_title_overlay {";
            }
            if (
                ($overlay_color_type == 'simple' && !empty($overlay_color)) ||
                ($overlay_color_type == 'gradient') ||
                ($overlay_color_type == 'custom_gradient' && !empty($overlay_gradient_custom))
            ) {
                if ($overlay_color_type == 'simple' && !empty($overlay_color)) {
                    $styles .= "background: " . esc_attr($overlay_color) . ";";
                }
                if ($overlay_color_type == 'gradient') {
                    $overlay_gradient_start = !empty($overlay_gradient_start) ? $overlay_gradient_start : 'transparent';
                    $overlay_gradient_finish = !empty($overlay_gradient_finish) ? $overlay_gradient_finish : 'transparent';
                    $styles .= "background-image: linear-gradient(90deg," . esc_attr($overlay_gradient_start) . ', ' . esc_attr($overlay_gradient_finish) . ");";
                }
                if ($overlay_color_type == 'custom_gradient' && !empty($overlay_gradient_custom)) {
                    $styles .= esc_attr($overlay_gradient_custom);
                }
            }
            $styles .= "}";
        }
        
        
        
        
        if( !empty($title_color) ){
            $styles .= "
                #".$id." .page_title{
                    color: ".esc_attr($title_color).";
                }
            ";
        }
        if( !empty($divider_color) ){
            $styles .= "
                #".$id." .title_divider svg{
                    fill: ".esc_attr($divider_color).";
                }
            ";
        }
        if( !empty($info_color) ){
            $styles .= "
                #".$id." .single_post_meta,
                #".$id." .single_post_meta a{
                    color: ".esc_attr($info_color).";
                }
            ";
        }
        if( !empty($breadcrumbs_color) ){
            $styles .= "
                #".$id." .woocommerce-breadcrumb *,
                #".$id." .breadcrumbs *{
                    color: ".esc_attr($breadcrumbs_color).";
                }
            ";
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
        
        if( !empty($info_color_hover) ){
            $styles .= "
                #".$id." .single_post_meta a:hover{
                    color: ".esc_attr($info_color_hover).";
                }
            ";
        }
        if( !empty($breadcrumbs_color_hover) ){
            $styles .= "
                #".$id." .breadcrumbs a:hover,
                #".$id." .woocommerce-breadcrumb a:hover{
                    color: ".esc_attr($breadcrumbs_color_hover).";
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
				if( !empty($title_size_landscape) ){
					$styles .= "
						#".$id." .page_title{
							font-size: ".(int)esc_attr($title_size_landscape)."px;
						}
					";
				}
				if( !empty($title_margins_landscape) ){
					$styles .= "
						#".$id." .page_title{
							margin: ".esc_attr($title_margins_landscape).";
						}
					";
				}
				if( !empty($divider_margins_landscape) ){
					$styles .= "
						#".$id." .title_divider{
							margin: ".esc_attr($divider_margins_landscape).";
						}
					";
				}
				if( !empty($breadcrumbs_size_landscape) ){
					$styles .= "
						#".$id." .woocommerce-breadcrumb *,
						#".$id." .breadcrumbs *{
							font-size: ".(int)esc_attr($breadcrumbs_size_landscape)."px;
						}
					";
				}
			}

		$styles .= "
			}
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if( 
		!empty($vc_portrait_styles) || 
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
				if( !empty($title_size_portrait) ){
					$styles .= "
						#".$id." .page_title{
							font-size: ".(int)esc_attr($title_size_portrait)."px;
						}
					";
				}
				if( !empty($title_margins_portrait) ){
					$styles .= "
						#".$id." .page_title{
							margin: ".esc_attr($title_margins_portrait).";
						}
					";
				}
				if( !empty($divider_margins_portrait) ){
					$styles .= "
						#".$id." .title_divider{
							margin: ".esc_attr($divider_margins_portrait).";
						}
					";
				}
				if( !empty($breadcrumbs_size_portrait) ){
					$styles .= "
						#".$id." .woocommerce-breadcrumb *,
						#".$id." .breadcrumbs *{
							font-size: ".(int)esc_attr($breadcrumbs_size_portrait)."px;
						}
					";
				}
			}

		$styles .= "
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if( 
		!empty($vc_mobile_styles) || 
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
				if( !empty($title_size_mobile) ){
					$styles .= "
						#".$id." .page_title{
							font-size: ".(int)esc_attr($title_size_mobile)."px;
						}
					";
				}
				if( !empty($title_margins_mobile) ){
					$styles .= "
						#".$id." .page_title{
							margin: ".esc_attr($title_margins_mobile).";
						}
					";
				}
				if( !empty($divider_margins_mobile) ){
					$styles .= "
						#".$id." .title_divider{
							margin: ".esc_attr($divider_margins_mobile).";
						}
					";
				}
				if( !empty($breadcrumbs_size_mobile) ){
					$styles .= "
						#".$id." .woocommerce-breadcrumb *,
						#".$id." .breadcrumbs *{
							font-size: ".(int)esc_attr($breadcrumbs_size_mobile)."px;
						}
					";
				}
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */

	cws__vc_styles($styles);

	$extra_classes = '';
	$extra_classes .= $mouse_anim ? ' mouse_anim' : '';
	$extra_classes .= $scroll_anim ? ' scroll_anim' : '';
	$extra_classes .= $share_bg ? ' shared_bg' : '';
	$extra_classes .= !empty($el_class) ? ' '.$el_class : "";

	$extra_styles = 'style="';
	$extra_styles .= !empty(cws_get_metabox('title_image')) ? ' background-image: url('.wp_get_attachment_image_src( cws_get_metabox('title_image'), "full" )[0].');' : '';
	$extra_styles .= '"';
	
	/* -----> Title Area module output <----- */
	$out .= "<div id='".$id."' class='custom page_title_container ".$extra_classes."' ".$extra_styles.">";
	    $out .= '<div class="page_title_overlay"></div>';

		$out .= "<div class='page_title_wrapper container'>";
		
			if( strripos($hide_fields, 'title') === false ){
				$out .= '<div class="page_title_customizer_size">';
					$out .= "<h1 class='page_title'>";
						$out .= cws_get_page_title();
					$out .= "</h1>";
				$out .= '</div>';
			}
    
            if(
                strripos($hide_fields, 'info') === false &&
                is_single()
            ){
                $out .=  '<div class="single_post_meta">';
                    ob_start();
                        promosys__post_date('', 'simple');
                    $out .= ob_get_clean();
                $out .=  '</div>';
            }
    
			if( strripos($hide_fields, 'divider') === false ){
				$out .= "<span class='title_divider'>";
                    $out .= '<svg width="48" height="10" viewBox="0 0 48 10" fill="#000" xmlns="http://www.w3.org/2000/svg">';
                        $out .= '<path d="M46.3924 7.90145C43.6029 7.99388 42.0667 6.41256 40.8318 5.14414C39.7299 4.01114 38.8615 3.11957 37.2075 3.17184C35.5534 3.2241 34.807 4.18445 33.8352 5.37599C32.7581 6.72102 31.4184 8.39764 28.6289 8.49007C25.8394 8.58251 24.3031 7.00119 23.0683 5.73277C21.9664 4.59977 21.098 3.7082 19.4439 3.76047C17.7899 3.81274 17.0434 4.77307 16.0716 5.96461C14.9945 7.30965 13.6549 8.98627 10.8653 9.0787C8.07581 9.17114 6.53955 7.58982 5.30474 6.3214C4.20284 5.1884 3.33443 4.29683 1.68038 4.3491C1.34685 4.36015 1.019 4.23842 0.768943 4.0107C0.518888 3.78297 0.367113 3.46789 0.347011 3.13479C0.326909 2.80168 0.440126 2.47783 0.661753 2.23447C0.883379 1.99111 1.19526 1.84819 1.52879 1.83713C4.31832 1.7447 5.85458 3.32602 7.08939 4.59444C8.19129 5.72743 9.0597 6.61901 10.7138 6.56674C12.3678 6.51447 13.1143 5.55413 14.0861 4.36259C15.1632 3.01756 16.5028 1.34095 19.2923 1.24851C22.0819 1.15607 23.6181 2.73739 24.8529 4.00581C25.9548 5.13881 26.8232 6.03038 28.4773 5.97811C30.1314 5.92584 30.8778 4.9655 31.8496 3.77396C32.9267 2.42893 34.2664 0.752314 37.0559 0.659877C39.8454 0.567441 41.3817 2.14876 42.6165 3.41718C43.7184 4.55017 44.5868 5.44175 46.2409 5.38948C46.406 5.38401 46.5715 5.41108 46.7279 5.46914C46.8843 5.52721 47.0285 5.61512 47.1523 5.72788C47.2761 5.84064 47.3771 5.97603 47.4495 6.12632C47.5219 6.27661 47.5643 6.43885 47.5742 6.60379C47.5842 6.76873 47.5615 6.93313 47.5075 7.08761C47.4535 7.24209 47.3692 7.38361 47.2595 7.50411C47.1497 7.62461 47.0167 7.72172 46.8679 7.78989C46.7192 7.85807 46.5576 7.89597 46.3924 7.90145Z"/>';
                    $out .= '</svg>';
				$out .= "</span>";
			}
    
            if( strripos($hide_fields, 'breadcrumbs') === false ){
                ob_start();
                    get_template_part( 'tmpl/header-breadcrumbs' );
                $out .= ob_get_clean();
            }

		$out .= "</div>";
	$out .= "</div>";

	// endif;

	return $out;
}
add_shortcode( 'cws_sc_title_area', 'cws_vc_shortcode_sc_title_area' );

?>