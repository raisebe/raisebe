<?php

function cws_vc_shortcode_sc_notice ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"notice"					=> "FINAL CLEARANCE: Take 20% off ‘Sale Must-Haves'",
		"closable"					=> true,
		"font_color"				=> "#ffffff",
		"close_color"				=> PRIMARY_COLOR,
		"close_color_hover"			=> SECONDARY_COLOR,
		"el_class"					=> "",
 	);
 	$responsive_vars = array(
 		/* -----> RESPONSIVE TABS <----- */
 		"all" => array(
 			"custom_styles"		=> "",
 		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "cws_notice_" );

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
	if( !empty($font_color) ){
		$styles .= "
			#".$id."{
				color: ".esc_attr($font_color).";
			}
		";
	}
	if( !empty($close_color) ){
		$styles .= "
			#".$id." .close-btn{
				color: ".esc_attr($close_color).";
			}
		";
	}
    
    if( !empty($closable) && !empty($close_color_hover) ){
        $styles .= "
            @media
                screen and (min-width: 1367px),
                screen and (min-width: 1200px) and (any-hover: hover),
                screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
                screen and (min-width: 1200px) and (-ms-high-contrast: none),
                screen and (min-width: 1200px) and (-ms-high-contrast: active)
            {
                #".$id." .close-btn:hover{
                    color: ".esc_attr($close_color_hover).";
                }
            }
        ";
    }
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( !empty($vc_landscape_styles) ){
		$styles .= "
			@media 
				screen and (max-width: 1199px),
				screen and (max-width: 1366px) and (any-hover: none)
			{
		";

			$styles .= "
				.".$id."{
					".$vc_landscape_styles.";
				}
			";

		$styles .= "
			}
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if( !empty($vc_portrait_styles) ){
		$styles .= "
			@media screen and (max-width: 991px){
		";

			$styles .= "
				.".$id."{
					".$vc_portrait_styles.";
				}
			";

		$styles .= "
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if( !empty($vc_mobile_styles) ){
		$styles .= "
			@media screen and (max-width: 767px){
		";

			$styles .= "
				.".$id."{
					".$vc_mobile_styles.";
				}
			";

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */
	cws__vc_styles($styles);
	
	/* -----> Notice module output <----- */
	$out .= "<div id='".$id."' class='top_bar_notice custom_notice". ( !empty($el_class) ? " $el_class" : "" ) ."'>";
		$out .= esc_html($notice);
		$out .= $closable ? '<span class="close-btn"></span>' : '';
	$out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_notice', 'cws_vc_shortcode_sc_notice' );

?>