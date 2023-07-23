<?php
// Helper function for getting group names
function cws_landscape_group_name(){
	return esc_html_x('Tablet', 'VC Group Name', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_landscape-tablets'></i>";
}
function cws_tablet_group_name(){
	return esc_html_x('Tablet', 'VC Group Name', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_portrait-tablets'></i>";
}
function cws_mobile_group_name(){
	return esc_html_x('Mobile', 'VC Group Name', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_portrait-smartphones'></i>";
}

// Helper function for adding responsive style
function cws_responsive_styles($styles, $resolution, $group) {
    $new_styles = array();
	foreach ($styles as $key => $value) {

		if( isset($value['param_name']) ){
			$value['param_name'] .= '_'.$resolution;
		}
		if( isset($value['dependency']) && isset($value['dependency']['element']) ){
			if( !isset($value['dependency']['resize']) ){
				$value['dependency']['element'] .= '_'.$resolution;
			}
		}
		if( isset($value['group']) ){
			$value['group'] = $group;
		}
		if( isset($value['responsive']) && ($value['responsive'] == $resolution || $value['responsive'] == 'all') ){
			$new_styles[] = $value;
		}
	}

	return $new_styles;
}

// Helper function for transforming hex to rgba
function cws_Hex2RGBA( $hex, $opacity = '1' ) {
	$hex = str_replace('#', '', $hex);
	$color = '';

	if(strlen($hex) == 3) {
		$color = hexdec(substr($hex, 0, 1 )) . ',';
		$color .= hexdec(substr($hex, 1, 1 )) . ',';
		$color .= hexdec(substr($hex, 2, 1 )) . ',';
	}
	else if(strlen($hex) == 6) {
		$color = hexdec(substr($hex, 0, 2 )) . ',';
		$color .= hexdec(substr($hex, 2, 2 )) . ',';
		$color .= hexdec(substr($hex, 4, 2 )) . ',';
	}
	$color .= $opacity;
	return "rgba($color)";
}

// Helper function for arrays merge
function cws_ext_merge_arrs ( $arrs = array() ){
	$r = array();
	for ( $i = 0; $i < count( $arrs ); $i++ ){
		$r = array_merge( $r, $arrs[$i] );
	}
	return $r;
}

// Helper function that geting VC responsive classes
function vc_responsive_styles($array){
	$desktop = $landscape = $portrait = $mobile = "";

	if( gettype($array) == 'array' ){
		foreach ($array as $key => $value) {
			if( $key == 'custom_styles' ){
				$desktop = $value;
			} else if( $key == 'custom_styles_landscape' ){
				$landscape = $value;
			} else if( $key == 'custom_styles_portrait' ){
				$portrait = $value;
			} else if( $key == 'custom_styles_mobile' ){
				$mobile = $value;
			}
		}
	}

	return array($desktop, $landscape, $portrait, $mobile);
}

// Helper function that adding responsive suffix
function add_responsive_suffix($variables){
	foreach ($variables as $key => $value) {

		if( $key == 'all' ){
			$inner_array = $value;

			foreach ($inner_array as $inner_key => $inner_value) {
				$inner_array[$inner_key.'_landscape'] = $inner_value;
				$inner_array[$inner_key.'_portrait'] = $inner_value;
				$inner_array[$inner_key.'_mobile'] = $inner_value;	
			}

			$variables['all'] = $inner_array;
		} else if( $key == 'landscape' ){
			$inner_array = $value;

			foreach ($inner_array as $inner_key => $inner_value) {
				$inner_array[$inner_key.'_landscape'] = $inner_value;
			}

			$variables['landscape'] = $inner_array;
		} else if( $key == 'portrait' ){
			$inner_array = $value;

			foreach ($inner_array as $inner_key => $inner_value) {
				$inner_array[$inner_key.'_portrait'] = $inner_value;
			}

			$variables['portrait'] = $inner_array;
		} else if( $key == 'mobile' ){
			$inner_array = $value;

			foreach ($inner_array as $inner_key => $inner_value) {
				$inner_array[$inner_key.'_mobile'] = $inner_value;
			}

			$variables['mobile'] = $inner_array;
		}

	}

	!isset($variables['all']) ? $variables['all'] = array() : '';
	!isset($variables['landscape']) ? $variables['landscape'] = array() : '';
	!isset($variables['portrait']) ? $variables['portrait'] = array() : '';
	!isset($variables['mobile']) ? $variables['mobile'] = array() : '';

	$out = array_merge($variables['all'], $variables['landscape'], $variables['portrait'], $variables['mobile']);

	return $out;
}

// Helper function that adding background properties to responsive vars
function add_bg_properties( $array ){

	if( array_key_exists('all', $array) ){
		foreach ($array as $key => $value) {
			if( isset($key) && ($key) == 'all' ){
				$value['bg_position'] = 'top';
				$value['bg_size'] = 'cover';
				$value['bg_repeat'] = 'no-repeat';
				$value['custom_bg_position'] = '';
				$value['custom_bg_size'] = '';
				$value['bg_display'] = '';

				$array[$key] = $value;
			}
		}
	} else {
		$array['all'] = array(
			'bg_position' => 'top',
			'bg_size' => 'cover',
			'bg_repeat' => 'no-repeat',
			'custom_bg_position' => '',
			'custom_bg_size' => '',
			'bg_display' => '',
		);
	}

	return $array;
}

/**/
/* Composer Background-Properties Group */
/**/
function cws_structure_background_props($layout){
	/* -----> STYLING GROUP TITLES <----- */
	$group_name = esc_html__('Design Options', 'promosys');
	$landscape_group = esc_html__('Tablet', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_landscape-tablets'></i>";
	$portrait_group = esc_html__('Tablet', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_portrait-tablets'></i>";
	$mobile_group = esc_html__('Mobile', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_portrait-smartphones'></i>";

	/*-----> Desktop Background Properties <-----*/
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "bg_position",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> array(
				esc_html__( 'Center Top', 'promosys' ) 		=> 'top',
				esc_html__( 'Center Center', 'promosys' ) 	=> 'center',
				esc_html__( 'Center Bottom', 'promosys' ) 	=> 'bottom',
				esc_html__( 'Custom', 'promosys' ) 			=> 'custom',
			),
			"std"				=> "center"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "bg_size",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> array(
				esc_html__( 'Auto', 'promosys' ) 			=> 'auto',
				esc_html__( 'Cover', 'promosys' ) 		=> 'cover',
				esc_html__( 'Contain', 'promosys' ) 		=> 'contain',
				esc_html__( 'Custom', 'promosys' ) 		=> 'custom',
			),
			"std"				=> "cover"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Repeat', 'promosys' ),
			"param_name"		=> "bg_repeat",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> array(
				esc_html__( 'No Repeat', 'promosys' ) 	=> 'no-repeat',
				esc_html__( 'Repeat', 'promosys' ) 		=> 'repeat',
				esc_html__( 'Repeat Y', 'promosys' ) 		=> 'repeat-y',
				esc_html__( 'Repeat X', 'promosys' ) 		=> 'repeat-x',
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type" 				=> "dropdown",
			"heading" 			=> esc_html__("Background Attachment", 'promosys'),
			"param_name" 		=> "bg_attachment",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"value" 			=> array(
				esc_html__("Scroll", 'promosys') 	=> "scroll",
				esc_html__("Fixed", 'promosys') 	=> "fixed",
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "custom_bg_position",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "bg_position",
				"value"		=> "custom"
			),
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "custom_bg_size",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "bg_size",
				"value"		=> "custom"
			),
			"value"				=> ""
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html_x( 'Background Hover Effect', 'CWS_VC_Banner', 'promosys' ),
			"param_name"		=> "bg_hover",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> array(
				esc_html_x( 'No Hover', 'CWS_VC_Banner', 'promosys' )		=> 'no_hover',
				esc_html_x( 'Zoom In', 'CWS_VC_Banner', 'promosys' )		=> 'zoom_in',
				esc_html_x( 'Zoom Out', 'CWS_VC_Banner', 'promosys' )		=> 'zoom_out',
				esc_html_x( 'Shift right', 'CWS_VC_Banner', 'promosys' )	=> 'shift_right',
				esc_html_x( 'Shift left', 'CWS_VC_Banner', 'promosys' )	=> 'shift_left',
			),
			"description"		=> esc_html_x( "Background Size & Background Position will be ignored with any property except 'No Hover'", "CWS_VC_Banner", 'promosys'),
			"std"				=> 'no_hover'
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Animation Durations (sec.)', "CWS_VC_Banner", 'promosys' ),
			"param_name"		=> "bg_transition",
			"group"				=> $group_name,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "bg_hover",
				"value"		=> array( 'zoom_in', 'zoom_out', 'shift_right', 'shift_left' ),
			),
			"value"				=> "0.3"
		)
	);

	/*-----> Landscape Background Properties <-----*/
	vc_add_param(
		$layout,
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles_landscape",
			"group"			=> $landscape_group, 
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_bg_landscape",
			"group"			    => $landscape_group,
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"			    => array( esc_html__( 'Customize Background', 'promosys' ) => true )
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "bg_position_landscape",
			"group"				=> $landscape_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_landscape",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'Center Top', 'promosys' ) 		=> 'top',
				esc_html__( 'Center Center', 'promosys' ) 	=> 'center',
				esc_html__( 'Center Bottom', 'promosys' ) 	=> 'bottom',
				esc_html__( 'Custom', 'promosys' ) 			=> 'custom',
			),
			"std"				=> "center"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "bg_size_landscape",
			"group"				=> $landscape_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_landscape",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'Auto', 'promosys' ) 		=> 'auto',
				esc_html__( 'Cover', 'promosys' ) 		=> 'cover',
				esc_html__( 'Contain', 'promosys' ) 		=> 'contain',
				esc_html__( 'Custom', 'promosys' ) 		=> 'custom',
			),
			"std"				=> "cover"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Repeat', 'promosys' ),
			"param_name"		=> "bg_repeat_landscape",
			"group"				=> $landscape_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_landscape",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'No Repeat', 'promosys' ) 	=> 'no-repeat',
				esc_html__( 'Repeat', 'promosys' ) 		=> 'repeat',
				esc_html__( 'Repeat Y', 'promosys' ) 	=> 'repeat-y',
				esc_html__( 'Repeat X', 'promosys' ) 	=> 'repeat-x',
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type" 				=> "dropdown",
			"heading" 			=> esc_html__("Background Attachment", 'promosys'),
			"param_name" 		=> "bg_attachment_landscape",
			"group"				=> $landscape_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_landscape",
				"not_empty"	=> true
			),
			"value" 			=> array(
				esc_html__("Scroll", 'promosys') => "scroll",
				esc_html__("Fixed", 'promosys') => "fixed",
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "custom_bg_position_landscape",
			"group"				=> $landscape_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "bg_position_landscape",
				"value"		=> "custom"
			),
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "custom_bg_size_landscape",
			"group"				=> $landscape_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "bg_size_landscape",
				"value"		=> "custom"
			),
			"value"				=> ""
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"			    => "checkbox",
			"param_name"	    => "hide_bg_landscape",
			"group"			    => $landscape_group,
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"			    => array( esc_html__( 'Hide Background', 'promosys' ) => true )
		)
	);

	/*-----> Portrait Background Properties <-----*/
	vc_add_param(
		$layout,
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles_portrait",
			"group"			=> $portrait_group
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_bg_portrait",
			"group"			    => $portrait_group,
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"			    => array( esc_html__( 'Customize Background', 'promosys' ) => true )
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "bg_position_portrait",
			"group"				=> $portrait_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_portrait",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'Center Top', 'promosys' ) 		=> 'top',
				esc_html__( 'Center Center', 'promosys' ) 	=> 'center',
				esc_html__( 'Center Bottom', 'promosys' ) 	=> 'bottom',
				esc_html__( 'Custom', 'promosys' ) 			=> 'custom',
			),
			"std"				=> "center"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "bg_size_portrait",
			"group"				=> $portrait_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_portrait",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'Auto', 'promosys' ) 		=> 'auto',
				esc_html__( 'Cover', 'promosys' ) 		=> 'cover',
				esc_html__( 'Contain', 'promosys' ) 		=> 'contain',
				esc_html__( 'Custom', 'promosys' ) 		=> 'custom',
			),
			"std"				=> "cover"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Repeat', 'promosys' ),
			"param_name"		=> "bg_repeat_portrait",
			"group"				=> $portrait_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_portrait",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'No Repeat', 'promosys' ) 	=> 'no-repeat',
				esc_html__( 'Repeat', 'promosys' ) 		=> 'repeat',
				esc_html__( 'Repeat Y', 'promosys' ) 	=> 'repeat-y',
				esc_html__( 'Repeat X', 'promosys' ) 	=> 'repeat-x',
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type" 				=> "dropdown",
			"heading" 			=> esc_html__("Background Attachment", 'promosys'),
			"param_name" 		=> "bg_attachment_portrait",
			"group"				=> $portrait_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_portrait",
				"not_empty"	=> true
			),
			"value" 			=> array(
				esc_html__("Scroll", 'promosys') => "scroll",
				esc_html__("Fixed", 'promosys') => "fixed",
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "custom_bg_position_portrait",
			"group"				=> $portrait_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "bg_position_portrait",
				"value"		=> "custom"
			),
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "custom_bg_size_portrait",
			"group"				=> $portrait_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "bg_size_portrait",
				"value"		=> "custom"
			),
			"value"				=> ""
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"			    => "checkbox",
			"param_name"	    => "hide_bg_portrait",
			"group"			    => $portrait_group,
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"			    => array( esc_html__( 'Hide Background', 'promosys' ) => true )
		)
	);

	/*-----> Mobile Background Properties <-----*/
	vc_add_param(
		$layout,
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles_mobile",
			"group"			=> $mobile_group
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_bg_mobile",
			"group"			    => $mobile_group,
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"			    => array( esc_html__( 'Customize Background', 'promosys' ) => true )
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "bg_position_mobile",
			"group"				=> $mobile_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_mobile",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'Center Top', 'promosys' ) 		=> 'top',
				esc_html__( 'Center Center', 'promosys' ) 	=> 'center',
				esc_html__( 'Center Bottom', 'promosys' ) 	=> 'bottom',
				esc_html__( 'Custom', 'promosys' ) 			=> 'custom',
			),
			"std"				=> "center"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "bg_size_mobile",
			"group"				=> $mobile_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_mobile",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'Auto', 'promosys' ) 		=> 'auto',
				esc_html__( 'Cover', 'promosys' ) 		=> 'cover',
				esc_html__( 'Contain', 'promosys' ) 		=> 'contain',
				esc_html__( 'Custom', 'promosys' ) 		=> 'custom',
			),
			"std"				=> "cover"
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Repeat', 'promosys' ),
			"param_name"		=> "bg_repeat_mobile",
			"group"				=> $mobile_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_mobile",
				"not_empty"	=> true
			),
			"value"				=> array(
				esc_html__( 'No Repeat', 'promosys' ) 	=> 'no-repeat',
				esc_html__( 'Repeat', 'promosys' ) 		=> 'repeat',
				esc_html__( 'Repeat Y', 'promosys' ) 	=> 'repeat-y',
				esc_html__( 'Repeat X', 'promosys' ) 	=> 'repeat-x',
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type" 				=> "dropdown",
			"heading" 			=> esc_html__("Background Attachment", 'promosys'),
			"param_name" 		=> "bg_attachment_mobile",
			"group"				=> $mobile_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "customize_bg_mobile",
				"not_empty"	=> true
			),
			"value" 			=> array(
				esc_html__("Scroll", 'promosys') => "scroll",
				esc_html__("Fixed", 'promosys') => "fixed",
			)
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "custom_bg_position_mobile",
			"group"				=> $mobile_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "bg_position_mobile",
				"value"		=> "custom"
			),
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "custom_bg_size_mobile",
			"group"				=> $mobile_group,
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "bg_size_mobile",
				"value"		=> "custom"
			),
			"value"				=> ""
		)
	);
	vc_add_param(
		$layout,
		array(
			"type"			    => "checkbox",
			"param_name"	    => "hide_bg_mobile",
			"group"			    => $mobile_group,
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"			    => array( esc_html__( 'Hide Background', 'promosys' ) => true )
		)
	);
}
function cws_module_background_props(){
	$background_properties = array(
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "bg_position",
			"group"				=> esc_html__( "Styling", 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> "all",
			"value"				=> array(
				esc_html__( 'Center Top', 'promosys' ) 		=> 'top',
				esc_html__( 'Center Center', 'promosys' ) 	=> 'center',
				esc_html__( 'Center Bottom', 'promosys' ) 	=> 'bottom',
				esc_html__( 'Custom', 'promosys' ) 			=> 'custom',
			)
		),
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "bg_size",
			"group"				=> esc_html__( "Styling", 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> "all",
			"value"				=> array(
				esc_html__( 'Auto', 'promosys' ) 		=> 'auto',
				esc_html__( 'Cover', 'promosys' ) 		=> 'cover',
				esc_html__( 'Contain', 'promosys' ) 		=> 'contain',
				esc_html__( 'Custom', 'promosys' ) 		=> 'custom',
			)
		),
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__( 'Background Repeat', 'promosys' ),
			"param_name"		=> "bg_repeat",
			"group"				=> esc_html__( "Styling", 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> "all",
			"value"				=> array(
				esc_html__( 'No Repeat', 'promosys' ) 	=> 'no-repeat',
				esc_html__( 'Repeat Y', 'promosys' ) 	=> 'repeat-y',
				esc_html__( 'Repeat X', 'promosys' ) 	=> 'repeat-x',
			)
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Position', 'promosys' ),
			"param_name"		=> "custom_bg_position",
			"group"				=> esc_html__( "Styling", 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"	=> array(
				"element"	=> "bg_position",
				"value"		=> "custom"
			),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html__( 'Background Size', 'promosys' ),
			"param_name"		=> "custom_bg_size",
			"group"				=> esc_html__( "Styling", 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"dependency"		=> array(
				"element"	=> "bg_size",
				"value"		=> "custom"
			),
			"value"				=> ""
		),
		array(
			"type"			    => "checkbox",
			"param_name"	    => "bg_display",
			"group"			    => esc_html__( "Styling", 'promosys' ),
			"responsive"	    => "all",
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"value"			    => array( esc_html__( 'Hide Background on this resolution', 'promosys' ) => true )
		),
	);

	return $background_properties;
}
/**/
/* \Composer Background-Properties Group */
/**/

/**/
/* Composer Icon Params Group */
/**/
function cws_ext_icon_vc_sc_config_params( $dep_el = "", $dep_val = false, $value_el = false, $tab = '' ){
	$libs_param = array(
		'type'              => 'dropdown',
		'heading'           => __( 'Icon library', 'promosys' ),
		'value'             => array(
			__( 'Font Awesome', 'promosys' ) => 'fontawesome',
			__( 'Open Iconic', 'promosys' ) => 'openiconic',
			__( 'Typicons', 'promosys' ) => 'typicons',
			__( 'Entypo', 'promosys' ) => 'entypo',
			__( 'Linecons', 'promosys' ) => 'linecons',
			__( 'Mono Social', 'promosys' ) => 'monosocial',
		),
		'param_name'        => 'icon_lib',
		'description'       => __( 'Select icon library.', 'promosys' ),
        'edit_field_class' 	=> 'vc_col-xs-4',
	);
	if ( !empty( $dep_el ) ){
		$libs_param['dependency'] = array(
			"element"	=> $dep_el
		);
		if ( is_bool( $dep_val ) ){
			$libs_param['dependency']['not_empty'] = $dep_val;
		} else{
			$libs_param['dependency']['value'] = $dep_val;
		}
		if(!empty($value_el)){
			$libs_param['dependency']['value'] = $value_el;
		}
	}
	$iconpickers = array(
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'promosys' ),
			'param_name' => 'icon_fontawesome',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_lib',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'promosys' ),
            'edit_field_class' 	=> 'vc_col-xs-8',
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'promosys' ),
			'param_name' => 'icon_openiconic',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_lib',
				'value' => 'openiconic',
			),
			'description' => __( 'Select icon from library.', 'promosys' ),
            'edit_field_class' 	=> 'vc_col-xs-8',
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'promosys' ),
			'param_name' => 'icon_typicons',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_lib',
				'value' => 'typicons',
			),
			'description' => __( 'Select icon from library.', 'promosys' ),
            'edit_field_class' 	=> 'vc_col-xs-8',
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'promosys' ),
			'param_name' => 'icon_entypo',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_lib',
				'value' => 'entypo',
			),
            'edit_field_class' 	=> 'vc_col-xs-8',
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'promosys' ),
			'param_name' => 'icon_linecons',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_lib',
				'value' => 'linecons',
			),
			'description' => __( 'Select icon from library.', 'promosys' ),
            'edit_field_class' 	=> 'vc_col-xs-8',
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'promosys' ),
			'param_name' => 'icon_monosocial',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'type' => 'monosocial',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_lib',
				'value' => 'monosocial',
			),
			'description' => __( 'Select icon from library.', 'promosys' ),
            'edit_field_class' 	=> 'vc_col-xs-8',
		)
	);

	// Flaticons
	$flat_icons = cws_get_all_flaticon_icons();
	$flat_icons_first = '';
	$flat_icons_lib_key = esc_html_x( 'CWS Flaticons', 'backend', 'promosys' );

	if( is_array($flat_icons) && !empty($flat_icons) ){
		$flat_icons_first = $flat_icons[0];
		$libs_param['value'][$flat_icons_lib_key] = 'cws_flaticons';

		array_push( $iconpickers, array(
			'type' => 'iconpicker',
			'heading' => esc_html_x( 'Icon', 'backend', 'promosys' ),
			'param_name' => 'icon_cws_flaticons',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'type' => 'cws_flaticons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_lib',
				'value' => 'cws_flaticons',
			),
			'description' => esc_html_x( 'Select icon from library.', 'backend', 'promosys' ),
            'edit_field_class' 	=> 'vc_col-xs-8',
		));
	}

	$svg_lib_key = esc_html_x( 'CWS SVG', 'backend', 'promosys' );
	$libs_param['value'][$svg_lib_key] = 'cws_svg';
	array_push( $iconpickers, array(
		"type"			=> "cws_svg",
		"heading"		=> esc_html_x( 'SVG Icon', 'backend', 'promosys' ),
		"param_name"	=> "icon_cws_svg",
		'dependency' 	=> array(
			'element' 	=> 'icon_lib',
			'value' 	=> 'cws_svg',
		),
		'description' 	=> esc_html_x( 'Select icon from library.', 'backend', 'promosys' ),
	));
    
    if ( $tab == 'button' ){
        $libs_param['group'] = esc_html_x( "Button", 'backend', 'promosys' );
        foreach ($iconpickers as &$value) {
            $value['group'] = esc_html_x( "Button", 'backend', 'promosys' );
        }
        unset($value);
    } elseif ( $tab == 'styling' ){
        $libs_param['group'] = esc_html_x( "Styling", 'backend', 'promosys' );
        foreach ($iconpickers as &$value) {
            $value['group'] = esc_html_x( "Styling", 'backend', 'promosys' );
        }
        unset($value);
    }

	// Output
	$params = array_merge( array( $libs_param ), $iconpickers );
	return $params;
}
/**/
/* \Composer Icon Params Group */
/**/

/**/
/* Get Selected Icons from Composer Attributes */
/**/
function cws_ext_vc_sc_get_icon ( $atts ){
	$defaults = array(
		'icon_lib' 				=> 'fontawesome',
		'icon_fontawesome'		=> '',
		'icon_openiconic'		=> '',
		'icon_typicons'			=> '',
		'icon_entypo'			=> '',
		'icon_linecons'			=> '',
		'icon_monosocial'		=> '',
		'icon_cws_flaticons'	    => '',
		'icon_cws_svg'			=> '',
	);
	$proc_atts 	= wp_parse_args( $atts, $defaults );
	$lib 		= $proc_atts['icon_lib'];
	$icon_key 	= "icon_$lib";
	$icon 		= isset( $atts[$icon_key] ) ? $atts[$icon_key] : "";
	return $icon;
}

function cws_render_builder_gradient_rules_hover( $options ) {
	extract(shortcode_atts(array(
		'cws_gradient_color_from' => "#000000",
		'cws_gradient_color_to' => '#0eecbd',
		'cws_gradient_type' => 'linear',
		'cws_gradient_angle' => '45',
		'cws_gradient_shape_variant_type' => 'simple',
		'cws_gradient_shape_type' => 'ellipse',
		'cws_gradient_size_keyword_type' => 'farthest-corner',
		'cws_gradient_size_type' => '',
	), $options));

	$cws_gradient_color_from = isset($options['cws_bg_hover_gradient_color_from']) ? $options['cws_bg_hover_gradient_color_from'] : $cws_gradient_color_from;
	$cws_gradient_color_to = isset($options['cws_bg_hover_gradient_color_to']) ? $options['cws_bg_hover_gradient_color_to'] : $cws_gradient_color_to;
	$cws_gradient_type = isset($options['cws_bg_hover_gradient_type']) ? $options['cws_bg_hover_gradient_type'] : $cws_gradient_type;
	$cws_gradient_angle = isset($options['cws_bg_hover_gradient_angle']) ? $options['cws_bg_hover_gradient_angle'] : $cws_gradient_angle;
	
	$cws_gradient_shape_variant_type = isset($options['cws_bg_hover_gradient_shape_variant_type']) ? $options['cws_bg_hover_gradient_shape_variant_type'] : $cws_gradient_shape_variant_type;
	$cws_gradient_shape_type = isset($options['cws_bg_hover_gradient_shape_type']) ? $options['cws_bg_hover_gradient_shape_type'] : $cws_gradient_shape_type;
	$cws_gradient_size_keyword_type = isset($options['cws_bg_hover_gradient_size_keyword_type']) ? $options['cws_bg_hover_gradient_size_keyword_type'] : $cws_gradient_size_keyword_type;
	$cws_gradient_size_type = isset($options['cws_bg_hover_gradient_size_type']) ? $options['cws_bg_hover_gradient_size_type'] : $cws_gradient_size_type;
	
	$out = '';
	if ( $cws_gradient_type == 'linear' ) {
		$out .= "background: -webkit-linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
		$out .= "background: -o-linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
		$out .= "background: -moz-linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
		$out .= "background: linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
	}
	else if ( $cws_gradient_type == 'radial' ) {
		if ( $cws_gradient_shape_variant_type == 'simple' ) {
			$out .= "background: -webkit-radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -o-radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -moz-radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
		}
		else if ( $cws_gradient_shape_variant_type == 'extended' ) {
		
			$out .= "background: -webkit-radial-gradient(" . ( !empty( $cws_gradient_size_type ) ? " " . $cws_gradient_size_type . "," : "" ) . ( !empty( $cws_gradient_size_keyword_type ) ? " " . $cws_gradient_size_keyword_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -o-radial-gradient(" . ( !empty( $cws_gradient_size_type ) ? " " . $cws_gradient_size_type . "," : "" ) . ( !empty( $cws_gradient_size_keyword_type ) ? " " . $cws_gradient_size_keyword_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -moz-radial-gradient(" . ( !empty( $cws_gradient_size_type ) ? " " . $cws_gradient_size_type . "," : "" ) . ( !empty( $cws_gradient_size_keyword_type ) ? " " . $cws_gradient_size_keyword_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: radial-gradient(" . ( !empty( $cws_gradient_size_keyword_type ) && !empty( $cws_gradient_size_type ) ? " $cws_gradient_size_keyword_type at $cws_gradient_size_type" : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
		}
	}
	$out .= "border-color: transparent;-webkit-background-clip: border;-moz-background-clip: border;background-clip: border-box;-webkit-background-origin: border;-moz-background-origin: border;background-origin: border-box;";
	return preg_replace('/\s+/',' ', $out);
}

function cws_render_builder_gradient_rules( $options ) {
	extract(shortcode_atts(array(
		'cws_gradient_color_from' => "#000000",
		'cws_gradient_color_to' => '#0eecbd',
		'cws_gradient_type' => 'linear',
		'cws_gradient_angle' => '45',
		'cws_gradient_shape_variant_type' => 'simple',
		'cws_gradient_shape_type' => 'ellipse',
		'cws_gradient_size_keyword_type' => 'farthest-corner',
		'cws_gradient_size_type' => '',
	), $options));
	$out = '';
	if ( $cws_gradient_type == 'linear' ) {
		$out .= "background: -webkit-linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
		$out .= "background: -o-linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
		$out .= "background: -moz-linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
		$out .= "background: linear-gradient(" . $cws_gradient_angle . "deg, $cws_gradient_color_from, $cws_gradient_color_to);";
	}
	else if ( $cws_gradient_type == 'radial' ) {
		if ( $cws_gradient_shape_variant_type == 'simple' ) {
			$out .= "background: -webkit-radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -o-radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -moz-radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: radial-gradient(" . ( !empty( $cws_gradient_shape_type ) ? " " . $cws_gradient_shape_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
		}
		else if ( $cws_gradient_shape_variant_type == 'extended' ) {
		
			$out .= "background: -webkit-radial-gradient(" . ( !empty( $cws_gradient_size_type ) ? " " . $cws_gradient_size_type . "," : "" ) . ( !empty( $cws_gradient_size_keyword_type ) ? " " . $cws_gradient_size_keyword_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -o-radial-gradient(" . ( !empty( $cws_gradient_size_type ) ? " " . $cws_gradient_size_type . "," : "" ) . ( !empty( $cws_gradient_size_keyword_type ) ? " " . $cws_gradient_size_keyword_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: -moz-radial-gradient(" . ( !empty( $cws_gradient_size_type ) ? " " . $cws_gradient_size_type . "," : "" ) . ( !empty( $cws_gradient_size_keyword_type ) ? " " . $cws_gradient_size_keyword_type . "," : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
			$out .= "background: radial-gradient(" . ( !empty( $cws_gradient_size_keyword_type ) && !empty( $cws_gradient_size_type ) ? " $cws_gradient_size_keyword_type at $cws_gradient_size_type" : "" ) . " $cws_gradient_color_from, $cws_gradient_color_to);";
		}
	}
	$out .= "border-color: transparent;-webkit-background-clip: border;-moz-background-clip: border;background-clip: border-box;-webkit-background-origin: border;-moz-background-origin: border;background-origin: border-box;";
	return preg_replace('/\s+/',' ', $out);
}

?>