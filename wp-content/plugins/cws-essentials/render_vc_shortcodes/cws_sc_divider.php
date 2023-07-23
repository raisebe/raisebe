<?php

function cws_vc_shortcode_sc_divider ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		'style'						=> 'simple',
		'el_class'					=> '',
		/* -----> STYLING TAB <----- */
		'color'						=> PRIMARY_COLOR,
		'gradient_start_color'		=> PRIMARY_COLOR,
		'gradient_finish_color'		=> SECONDARY_COLOR,
 	);
 	$responsive_vars = array(
 		/* -----> RESPONSIVE TABS <----- */
 		'all' => array(
 			'custom_styles'		=> '',
 		),
	);

	$responsive_defaults = add_responsive_suffix($responsive_vars);
	$defaults = array_merge($defaults, $responsive_defaults);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = $vc_desktop_class = $vc_landscape_class = $vc_portrait_class = $vc_mobile_class = "";
	$id = uniqid( "cws_divider_" );

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
	if ( !empty($vc_desktop_styles) ){
		$styles .= "
			#".$id."{
				".$vc_desktop_styles.";
			}
		";
	}
	
	if ( $style == 'simple' ){
	    if( !empty($color) ) {
	        $styles .= "
                #" . $id . " .cws_divider{
                    background-color: " . esc_attr($color) . ";
                }
            ";
	    }
	}
	if ( $style == 'gradient' ){
	    if ( !empty($gradient_start_color) || !empty($gradient_finish_color) ) {
            $gradient_start_color = !empty($gradient_start_color) ? $gradient_start_color : 'transparent';
            $gradient_finish_color = !empty($gradient_finish_color) ? $gradient_finish_color : 'transparent';
	        $styles .= "
                #" . $id . " .cws_divider{
                    background-image: linear-gradient(90deg, " . esc_attr($gradient_start_color) . ", " . esc_attr($gradient_finish_color) . ");
                }
            ";
	    }
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
				#".$id."{
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
				#".$id."{
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
				#".$id."{
					".$vc_mobile_styles.";
				}
			";

		$styles .= "
			}
		";
	}
	/* -----> End of mobile styles <----- */
	
	cws__vc_styles($styles);

	$module_classes = 'cws_divider_wrapper';
	$module_classes .= ' style_'.esc_attr($style);
	$module_classes .= !empty($el_class) ? ' '.esc_attr($el_class) : '';
	
	/* -----> Divider module output <----- */
	$out .= "<div id='".$id."' class='".$module_classes."'>";
		$out .= "<div class='cws_divider'>";
            if ( $style == 'special' && (!empty($gradient_start_color) || !empty($gradient_finish_color)) ) {
                $gradient_start_color = !empty($gradient_start_color) ? $gradient_start_color : 'transparent';
                $gradient_finish_color = !empty($gradient_finish_color) ? $gradient_finish_color : 'transparent';
                $out .= '<svg width="48" height="10" viewBox="0 0 48 10" fill="none" xmlns="http://www.w3.org/2000/svg">';
                    $out .= '<path d="M46.3924 7.90145C43.6029 7.99388 42.0667 6.41256 40.8318 5.14414C39.7299 4.01114 38.8615 3.11957 37.2075 3.17184C35.5534 3.2241 34.807 4.18445 33.8352 5.37599C32.7581 6.72102 31.4184 8.39764 28.6289 8.49007C25.8394 8.58251 24.3031 7.00119 23.0683 5.73277C21.9664 4.59977 21.098 3.7082 19.4439 3.76047C17.7899 3.81274 17.0434 4.77307 16.0716 5.96461C14.9945 7.30965 13.6549 8.98627 10.8653 9.0787C8.07581 9.17114 6.53955 7.58982 5.30474 6.3214C4.20284 5.1884 3.33443 4.29683 1.68038 4.3491C1.34685 4.36015 1.019 4.23842 0.768943 4.0107C0.518888 3.78297 0.367113 3.46789 0.347011 3.13479C0.326909 2.80168 0.440126 2.47783 0.661753 2.23447C0.883379 1.99111 1.19526 1.84819 1.52879 1.83713C4.31832 1.7447 5.85458 3.32602 7.08939 4.59444C8.19129 5.72743 9.0597 6.61901 10.7138 6.56674C12.3678 6.51447 13.1143 5.55413 14.0861 4.36259C15.1632 3.01756 16.5028 1.34095 19.2923 1.24851C22.0819 1.15607 23.6181 2.73739 24.8529 4.00581C25.9548 5.13881 26.8232 6.03038 28.4773 5.97811C30.1314 5.92584 30.8778 4.9655 31.8496 3.77396C32.9267 2.42893 34.2664 0.752314 37.0559 0.659877C39.8454 0.567441 41.3817 2.14876 42.6165 3.41718C43.7184 4.55017 44.5868 5.44175 46.2409 5.38948C46.406 5.38401 46.5715 5.41108 46.7279 5.46914C46.8843 5.52721 47.0285 5.61512 47.1523 5.72788C47.2761 5.84064 47.3771 5.97603 47.4495 6.12632C47.5219 6.27661 47.5643 6.43885 47.5742 6.60379C47.5842 6.76873 47.5615 6.93313 47.5075 7.08761C47.4535 7.24209 47.3692 7.38361 47.2595 7.50411C47.1497 7.62461 47.0167 7.72172 46.8679 7.78989C46.7192 7.85807 46.5576 7.89597 46.3924 7.90145Z"  fill="url(#paint0_linear)"/>';
                    $out .= '<defs>';
                        $out .= '<linearGradient id="paint0_linear" x1="-3.70371" y1="9.08232" x2="87.5548" y2="9.08233" gradientUnits="userSpaceOnUse">';
                            $out .= '<stop stop-color="'.esc_attr($gradient_start_color).'"/>';
                            $out .= '<stop offset="1" stop-color="'.esc_attr($gradient_finish_color).'"/>';
                        $out .= '</linearGradient>';
                    $out .= '</defs>';
                $out .= '</svg>';
            }
		$out .= "</div>";
	$out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_divider', 'cws_vc_shortcode_sc_divider' );

?>