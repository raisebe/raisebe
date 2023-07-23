<?php

function cws_vc_shortcode_sc_info_box ( $atts = array(), $content = "" ){
	$defaults = array(
		/* -----> GENERAL TAB <----- */
		'style'						=> 'info',
		'title'						=> '',
		'description'				=> '',
		'closable'					=> false,
		'el_class'					=> '',
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
    $id = uniqid( "cws_info_box_" );

	$module_classes = 'cws_info_box';
	$module_classes .= ' '.esc_attr($style);
	$module_classes .= !empty($el_class) ? ' '.esc_attr($el_class) : '';
    
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
    /* -----> End of default styles <----- */
    
    /* -----> Customize landscape styles <----- */
    if( !empty($vc_landscape_styles) ){
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
    
            if( !empty($vc_portrait_styles) ){
                $styles .= "
					#".$id."{
						".$vc_portrait_styles.";
					}
				";
            }
        $styles .= "
			}
		";
    }
    /* -----> End of portrait styles <----- */
    
    /* -----> Customize mobile styles <----- */
    if ( !empty($vc_mobile_styles) ){
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
            
        $styles .= "
			}
		";
    }
    /* -----> End of mobile styles <----- */
    cws__vc_styles($styles);
    
    /* -----> Divider module output <----- */
	$out .= "<div class='".$module_classes."' id='".esc_attr($id)."'>";
		$out .= "<div class='icon_wrapper'><i></i></div>";
		$out .= "<div class='content_wrapper'>";
			if( !empty($title) ){
				$out .= "<p class='info_box_title'>".esc_html($title)."</p>";
			}
			if( !empty($description) ){
				$out .= "<p class='info_box_desc'>".esc_html($description)."</p>";
			}
		$out .= "</div>";
		if( $closable ){
			$out .= "<i class='close_info_box'></i>";
		}
	$out .= "</div>";

	return $out;
}
add_shortcode( 'cws_sc_info_box', 'cws_vc_shortcode_sc_info_box' );

?>