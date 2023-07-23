<?php

function cws_vc_shortcode_sc_menu ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		'menu'						=> 'none',
		'el_class'					=> '',
		/* -----> STYLING TAB <----- */
        'line_height'               => '24',
		'color'						=> "#ffffff",
		'hover_color'				=> "#ffea74",
		'submenu_color'				=> "#243238",
		'submenu_color_hover'		=> PRIMARY_COLOR,
 	);
 	$responsive_vars = array(
 		/* -----> RESPONSIVE TABS <----- */
 		'all' => array(
 			'custom_styles'		=> '',
 			'customize_align'	=> false,
			'alignment'			=> 'flex-start',
 		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "cws_menu_" );

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
	if( $line_height ){
		$styles .= "
			#".$id." > ul > li > a{
				line-height: ".(int)esc_attr($line_height)."px;
			}
		";	
	}
	if( $customize_align ){
		$styles .= "
			#".$id."{
				-webkit-justify-content: ".esc_attr($alignment).";
				justify-content: ".esc_attr($alignment).";
			}
		";
	}
	if( !empty($color) ){
		$styles .= "
			#".$id." > .menu > .menu-item > a,
			#".$id." > .menu > .menu-item > a:after{
				color: ".esc_attr($color).";
			}
			#".$id." > .menu > .menu-item:not(:first-child):before{
				background-color: ".esc_attr($color).";
			}
		";
	}
    if( !empty($submenu_color) ){
        $styles .= "
			#".$id." > .menu .sub-menu > .menu-item > a{
				color: ".esc_attr($submenu_color).";
			}
		";
    }
    if( !empty($bg_color) ){
        $styles .= "
			#".$id." > .menu > .menu-item > a{
				background-color: ".esc_attr($bg_color).";
			}
		";
    }
	if( !empty($hover_color) || !empty($submenu_color_hover) || !empty($bg_color_hover) ){
        if( !empty($hover_color) ) {
            $styles .= "
                #" . $id . " .menu-item-object-cws-new-megamenu .sub-menu .cws_megamenu_item .widgettitle:before{
                    background-color: " . esc_attr($hover_color) . ";
                }
                #" . $id . " > .menu > .menu-item.current-menu-item > a,
                #" . $id . " > .menu > .menu-item.current-menu-item > a:after,
                #" . $id . " > .menu > .menu-item.current-item-parent > a,
                #" . $id . " > .menu > .menu-item.current-item-parent > a:after{
                    color: " . esc_attr($hover_color) . ";
                }
            ";
        }
        if( !empty($bg_color_hover) ) {
            $styles .= "
                #" . $id . " > .menu > .menu-item.current-menu-item > a,
                #" . $id . " > .menu > .menu-item.current-item-parent > a{
                    background-color: " . esc_attr($bg_color_hover) . ";
                }
            ";
        }
        if( !empty($submenu_color_hover) ) {
            $styles .= "
                #".$id." > .menu .sub-menu > .menu-item.current-menu-item > a,
                #".$id." > .menu .sub-menu > .menu-item.current-item-parent > a{
                    color: ".esc_attr($submenu_color_hover).";
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

            if( !empty($hover_color) ) {
                $styles .= "
                    #" . $id . " > .menu > .menu-item:hover > a,
                    #" . $id . " > .menu > .menu-item:hover > a:after{
                        color: " . esc_attr($hover_color) . ";
                    }
                ";
            }
            if( !empty($bg_color_hover) ) {
                $styles .= "
                    #" . $id . " > .menu > .menu-item:hover > a{
                        background-color: " . esc_attr($bg_color_hover) . ";
                    }
                ";
            }
            if( !empty($submenu_color_hover) ) {
                $styles .= "
                    #".$id." > .menu .sub-menu > .menu-item > a:hover{
                        color: ".esc_attr($submenu_color_hover).";
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
		$customize_align_landscape 
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
					#".$id." > ul{
						-webkit-justify-content: ".esc_attr($alignment_landscape).";
						justify-content: ".esc_attr($alignment_landscape).";
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
					.".$id."{
						".$vc_portrait_styles.";
					}
				";
			}
			if( $customize_align_portrait ){
				$styles .= "
					#".$id." > ul{
						-webkit-justify-content: ".esc_attr($alignment_portrait).";
						justify-content: ".esc_attr($alignment_portrait).";
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
					.".$id."{
						".$vc_mobile_styles.";
					}
				";
			}
			if( $customize_align_mobile ){
				$styles .= "
					#".$id." > ul{
						-webkit-justify-content: ".esc_attr($alignment_mobile).";
						justify-content: ".esc_attr($alignment_mobile).";
					}
				";	
			}

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */

	cws__vc_styles($styles);
	
	/* -----> Divider module output <----- */
	$out .= "<div id='".$id."' class='menu-main-container " . esc_attr($menu) . " cws_menu_module". ( !empty($el_class) ?
        " $el_class" :
            "" ) ."'>";

		ob_start();
			wp_nav_menu( array(
				'menu'  			=> $menu,
				'container'       	=> false,
				'menu_class'      	=> 'menu '.$menu.'-menu',
				'fallback_cb'     	=> false,
				'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           	=> 0
			));
		$out .= ob_get_clean();
	$out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_menu', 'cws_vc_shortcode_sc_menu' );

?>