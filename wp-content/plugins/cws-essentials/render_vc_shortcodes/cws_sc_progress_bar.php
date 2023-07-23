<?php

function cws_vc_shortcode_sc_progress_bar ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
        'title'						=> '',
        'percents'					=> '',
        'el_class'					=> '',
        
        /* -----> STYLING TAB <----- */
        'add_title'					=> false,
        'title_color'				=> '#243238',
        
        'add_counter'				=> false,
        'percents_color'			=> '#243238',
        
        'add_bar'                   => false,
        'bar_color_type'            => 'simple',
        'bar_color'                 => PRIMARY_COLOR,
        'bar_gradient_start'		=> PRIMARY_COLOR,
        'bar_gradient_finish'		=> SECONDARY_COLOR,
        'bar_gradient_custom'		=> 'background-image: linear-gradient(90deg, #F76331 -8.57%, #C01FB8 184.64%);',
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
	$percents = !empty($percents) ? esc_attr($percents) : '100';
	$id = uniqid('cws_progress_bar_');

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
	if( !empty($add_title) && !empty($title) && !empty($title_color) ){
		$styles .= "
			#".$id." .cws_progress_bar_title{
				color: ".esc_attr($title_color).";
			}
		";	
	}
	if( !empty($add_counter) && !empty($percents) && !empty($percents_color) ){
		$styles .= "
			#".$id." .percents{
				color: ".esc_attr($percents_color).";
			}
		";	
	}
    if( !empty($add_counter) && !empty($percents) && !empty($add_bar) ) {
        $styles .= "#".$id." .progress_bar .bar{";
            if ( $bar_color_type == 'simple' && !empty($bar_color) ) {
                $styles .= "background: ".esc_attr($bar_color).";";
            }
            if ( $bar_color_type == 'gradient' ) {
                $bar_gradient_start = !empty($bar_gradient_start) ? $bar_gradient_start : 'transparent';
                $bar_gradient_finish = !empty($bar_gradient_finish) ? $bar_gradient_finish : 'transparent';
                $styles .= "background-image: linear-gradient(90deg, ".esc_attr($bar_gradient_start).", ".esc_attr($bar_gradient_finish).");";
            }
            if ( $bar_color_type == 'custom_gradient' ) {
                $styles .= esc_attr($bar_gradient_custom);
            }
        $styles .= "}";
    }
	/* -----> End of default styles <----- */

	/* -----> Customize landscape styles <----- */
	if( !empty($vc_landscape_styles) ){
		$styles .= "
			@media 
				screen and (max-width: 1199px),
				screen and (max-width: 1366px) and (any-hover: none)
			{
				#".$id."{
					".$vc_landscape_styles.";
				}
			}
		";
	}
	/* -----> End of landscape styles <----- */

	/* -----> Customize portrait styles <----- */
	if( !empty($vc_portrait_styles) ){
		$styles .= "
			@media screen and (max-width: 991px){
				#".$id."{
					".$vc_portrait_styles.";
				}
			}
		";
	}
	/* -----> End of portrait styles <----- */

	/* -----> Customize mobile styles <----- */
	if( !empty($vc_mobile_styles) ){
		$styles .= "
			@media screen and (max-width: 767px){
				#".$id."{
					".$vc_mobile_styles.";
				}
			}
		";
	}
	/* -----> End of mobile styles <----- */
	cws__vc_styles($styles);
	
	/* -----> Divider module output <----- */
	$out .= "<div id='".$id."' class='cws_progress_bar_module ".esc_attr($el_class)."'>";
		if( !empty($title) ){
			$out .= "<div class='cws_progress_bar_title'>".esc_html($title)."</div>";
		}
        if( !empty($percents) ) {
            $out .= "<div class='progress_bar'>";
                $out .= "<span class='bar' data-percent='" . $percents . "'></span>";
                $out .= "<span class='percents'>" . (int)esc_html($percents) . "%</span>";
            $out .= "</div>";
        }
    $out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_progress_bar', 'cws_vc_shortcode_sc_progress_bar' );

?>