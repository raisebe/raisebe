<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			    => "css_editor",
			"param_name"	    => "custom_styles",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	    => 'all'
		),
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_size",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
			"responsive"	    => "all",
			"value"			    => array( esc_html_x( 'Customize Size', 'backend', 'promosys' ) => true ),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Size', 'backend', 'promosys' ),
			"param_name"		=> "title_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "20px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Margins', 'backend', 'promosys' ),
			"param_name"		=> "title_margins",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "25px 0px 0px 0px",
		),
        array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Text Size', 'backend', 'promosys' ),
			"param_name"		=> "text_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "16px",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Shape Background', 'backend', 'promosys' ),
			"param_name"		=> "shape_bg",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#eeeeee",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Shape Background', 'backend', 'promosys' ),
			"param_name"		=> "active_shape_bg",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icon Color', 'backend', 'promosys' ),
			"param_name"		=> "icon_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Icon Color', 'backend', 'promosys' ),
			"param_name"		=> "active_icon_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '#ffffff',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Number Color', 'backend', 'promosys' ),
			"param_name"		=> "number_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Number Color', 'backend', 'promosys' ),
			"param_name"		=> "active_number_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '#ffffff',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Number Background', 'backend', 'promosys' ),
			"param_name"		=> "number_background",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#dddddd",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Active Number Background', 'backend', 'promosys' ),
			"param_name"		=> "active_number_background",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'promosys' ),
			"param_name"		=> "text_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Line Color', 'backend', 'promosys' ),
			"param_name"		=> "line_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Arrow Color', 'backend', 'promosys' ),
			"param_name"		=> "arrow_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		)
	);

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
	$styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
	$styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"			=> "dropdown",
				"heading"		=> esc_html_x( 'Style', 'backend', 'promosys' ),
				"param_name"	=> "style",
				"value"			=> array(
					esc_html_x( 'Square', 'backend', 'promosys' )		=> 'square',
					esc_html_x( 'Round', 'backend', 'promosys' )		=> 'round',
				)
			),
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Values', 'backend', 'promosys' ),
                'param_name' 	=> 'values',
                'params' => array(
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html_x( 'Icon library', 'backend', 'promosys' ),
						"param_name"	=> "icon_lib",
						"description"	=> esc_html_x( 'Select icon library', 'backend', 'promosys' ),
						"value"			=> array(
							'Font Awesome' 	=> 'fontawesome',
							'Open Iconic'	=> 'openiconic',
							'Typicons' 		=> 'typicons',
							'Entypo' 		=> 'entypo',
							'Linecons' 		=> 'linecons',
							'Mono Social' 	=> 'monosocial',
							'CWS Flaticons' => 'cws_flaticons',
							'CWS SVG' 		=> 'cws_svg'
						)
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_fontawesome',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'fontawesome'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_openiconic',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'openiconic',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'openiconic'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_typicons',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'typicons',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'typicons'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_entypo',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'entypo',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'entypo'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_linecons',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'linecons',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'linecons'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_monosocial',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'monosocial',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'monosocial'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"			=> "iconpicker",
						"heading"		=> esc_html_x( 'Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_cws_flaticons',
						"value"			=> '',
						"settings"		=> array(
							'emptyIcon'		=> true,
							'type'			=> 'cws_flaticons',
							'iconsPerPage'	=> 4000
						),
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'cws_flaticons'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"			=> "cws_svg",
						"heading"		=> esc_html_x( 'SVG Icon', 'backend', 'promosys' ),
						"param_name"	=> 'icon_cws_svg',
						"dependency"	=> array(
							'element'	=> 'icon_lib',
							'value'		=> 'cws_svg'
						),
						"description"	=> esc_html_x( 'Select icon from library', 'backend', 'promosys' ),
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Number', 'backend', 'promosys' ),
						"param_name"		=> "number",
						"edit_field_class" 	=> "vc_col-xs-3",
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
						"param_name"		=> "title",
						"edit_field_class" 	=> "vc_col-xs-9",
                        'admin_label' 		=> true,
					),
					array(
						"type"				=> "textarea",
						"heading"			=> esc_html_x( 'Description', 'backend', 'promosys' ),
						"param_name"		=> "description",
					),
					array(
						"type"				=> "checkbox",
						"param_name"		=> "active",
                        "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
						"description"		=> esc_html_x( 'Please, mark it only once.', 'backend', 'promosys' ),
						"value"				=> array( esc_html_x( 'Active', 'backend', 'promosys' ) => true ),
					),
                ),
				'value' 		=> array(),
            ),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'promosys' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			)
		),
		/* -----> STYLING TAB <----- */
		$styles,
		/* -----> TABLET LANDSCAPE TAB <----- */
		$styles_landscape,
		/* -----> TABLET PORTRAIT TAB <----- */
		$styles_portrait,
		/* -----> MOBILE TAB <----- */
		$styles_mobile
	));

	vc_map( array(
		"name"				=> esc_html_x( 'CWS Roadmap', 'backend', 'promosys' ),
		"base"				=> "cws_sc_roadmap",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Roadmap extends WPBakeryShortCode {
	    }
	}
?>