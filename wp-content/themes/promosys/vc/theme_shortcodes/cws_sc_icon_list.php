<?php
    /* -----> ICONS PROPERTIES <----- */
    $icons = cws_ext_icon_vc_sc_config_params('function', array('custom', 'social'));

	/* -----> SIDEBARS PROPERTIES <----- */
	$sidebars = get_theme_mod('theme_sidebars');
	$sb_arr = array();

	if( !empty($sidebars) ){
		foreach( $sidebars as $k => $v ){
			$sb_arr[$v] = $k;
		}
	}

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
			"param_name"	    => "customize_align",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	    => "all",
            'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
			"value"			    => array( esc_html_x( 'Customize Alignment', 'backend', 'promosys' ) => true ),
		),
		array(
			"type"			    => "dropdown",
			"heading"		    => esc_html_x( 'Alignment', 'backend', 'promosys' ),
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
			"param_name"	    => "alignment",
			"responsive"	    => "all",
			"dependency"		=> array(
				"element"	  => "customize_align",
				"not_empty"	  => true
			),
			"value"			    => array(
				esc_html_x( "Left", 'backend', 'promosys' )     => 'left',
				esc_html_x( "Center", 'backend', 'promosys' )   => 'center',
				esc_html_x( "Right", 'backend', 'promosys' )    => 'right',
			),
		),
		array(
			"type"			    => "checkbox",
			"param_name"	    => "customize_size",
			"group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
			"responsive"	    => "all",
			"value"			    => array( esc_html_x( 'Customize Size', 'backend', 'promosys' ) => true ),
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Icons Size', 'backend', 'promosys' ),
			"param_name"		=> "icons_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "18px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Title Size', 'backend', 'promosys' ),
			"param_name"		=> "title_size",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "16px",
		),
		array(
			"type"				=> "textfield",
			"heading"			=> esc_html_x( 'Spacings', 'backend', 'promosys' ),
			"param_name"		=> "spacing",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-4",
			"responsive"		=> 'all',
			"dependency"		=> array(
				"element"	=> "customize_size",
				"not_empty"	=> true
			),
			"value"				=> "36px",
		),
		
		
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icon Color', 'backend', 'promosys' ),
			"param_name"		=> "icons_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ffffff",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icon Color on Hover', 'backend', 'promosys' ),
			"param_name"		=> "icons_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> "#ffea74",
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Icons BG', 'backend', 'promosys' ),
			"param_name"		=> "icons_bg",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
			    "element"	    => "icon_bg",
				"not_empty"		=> true
			),
			"value"				=> PRIMARY_COLOR,
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Icons BG on Hover', 'backend', 'promosys' ),
            "param_name"		=> "icons_bg_hover",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"		=> array(
                "element"	    => "icon_bg",
                "not_empty"		=> true
            ),
            "value"				=> PRIMARY_COLOR,
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Text Color', 'backend', 'promosys' ),
            "param_name"		=> "text_color",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#ffffff",
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Text Accent Color', 'backend', 'promosys' ),
            "param_name"		=> "text_hover",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#ffea74",
        ),
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
				"heading"		=> esc_html_x( 'Direction', 'CWS_VC_Button', 'promosys' ),
				"param_name"	=> "dir",
				"value"			=> array(
					esc_html_x( 'Column', 'CWS_VC_Button', 'promosys' )	=> 'column',
					esc_html_x( 'Line', 'CWS_VC_Button', 'promosys' )	=> 'line'
				),
                "std"           => "line",
			),
			array(
				"type"				=> "checkbox",
				"param_name"		=> "icon_bg",
				"value"				=> array( esc_html_x( 'Add Icons Background', 'backend', 'promosys' ) => true ),
                'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
			),
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Menu List', 'backend', 'promosys' ),
                'param_name' 	=> 'values',
                'params' 		=> array_merge( array(
					array(
						"type"				=> "dropdown",
						"heading"			=> esc_html_x( 'Function', 'backend', 'promosys' ),
						"param_name"		=> "function",
						"admin_label"		=> true,
						"value"				=> array(
							esc_html_x( "Custom URL", 'backend', 'promosys' ) 		    => 'custom',
							esc_html_x( "Woo Cart", 'backend', 'promosys' )		        => 'cart',
							esc_html_x( "Language Switcher", 'backend', 'promosys' )	=> 'lang',
							esc_html_x( "Search", 'backend', 'promosys' )			    => 'cws_search',
							esc_html_x( "Custom Sidebar", 'backend', 'promosys' )	    => 'sidebar',
							esc_html_x( "Login/Register Link", 'backend', 'promosys' )	=> 'login',
							esc_html_x( "Social Button", 'backend', 'promosys' )	    => 'social',
						)
					),
					array(
						"type"				=> "dropdown",
						"heading"			=> esc_html_x( 'Type', 'backend', 'promosys' ),
						"param_name"		=> "type",
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> "custom"
						),
						"value"				=> array(
							esc_html_x( "Simple", 'backend', 'promosys' ) 		=> 'simple',
							esc_html_x( "Phone Call", 'backend', 'promosys' )	=> 'phone',
							esc_html_x( "Send Mail", 'backend', 'promosys' )	=> 'mail',
						)
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
						"param_name"		=> "title",
						"edit_field_class" 	=> "vc_col-xs-6",
                        "admin_label"		=> true,
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> array("custom", "sidebar", "cws_search", "social", "extra")
						),
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Url', 'backend', 'promosys' ),
						"param_name"		=> "url",
						"edit_field_class" 	=> "vc_col-xs-6",
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> array("custom", "social", "extra"),
						),
						"value"				=> ""
					),
					array(
						"type"				=> "dropdown",
						"heading"			=> esc_html_x( 'Sidebar', 'backend', 'promosys' ),
						"param_name"		=> "sidebar",
						"edit_field_class" 	=> "vc_col-xs-6",
						"dependency"		=> array(
							"element"	=> "function",
							"value"		=> "sidebar"
						),
						"value"				=> $sb_arr
					),
                    array(
                        "type"				=> "checkbox",
                        "param_name"		=> "add_divider",
                        "value"				=> array( esc_html_x( 'Add Vertical divider', 'backend', 'promosys' ) => true ),
                        'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
                        "dependency"		=> array(
                            "element"	=> "dir",
                            "value"		=> "line"
                        ),
                    ),
                ),
                $icons
                ),
                "value"			=> "",
            ),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'backend', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'backend', 'promosys' ),
				"param_name"		=> "el_class",
				"value"				=> ""
			),
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

	/* -----> MODULE DECLARATION <----- */

	vc_map( array(
		"name"				=> esc_html_x( 'CWS Icon List', 'backend', 'promosys' ),
		"base"				=> "cws_sc_icon_list",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Icon_List extends WPBakeryShortCode {
	    }
	}
?>