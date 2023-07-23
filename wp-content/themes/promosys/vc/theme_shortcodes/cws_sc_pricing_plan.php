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
            "param_name"	    => "customize_colors",
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            "value"			    => array( esc_html_x( 'Customize Colors', 'backend', 'promosys' ) => true ),
        ),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background color', 'backend', 'promosys' ),
			"param_name"		=> "block_bg_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-12",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> "#ffffff"
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Background Start Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "block_gradient_start",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> "#c6512e"
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Background Finish Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "block_gradient_finish",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> "#c1289e"
        ),
		
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> "#243238"
		),
        array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color on Hover', 'backend', 'promosys' ),
			"param_name"		=> "title_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> "#ffffff"
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Price Color', 'backend', 'promosys' ),
            "param_name"		=> "price_color",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> SECONDARY_COLOR
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Price Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "price_color_hover",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> "#ffffff"
        ),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'promosys' ),
			"param_name"		=> "text_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> "#243238"
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Text Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "text_color_hover",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> "#ffffff"
        ),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'List Items bullet Color', 'backend', 'promosys' ),
			"param_name"		=> "bullet_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> ''
		),
        array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'List Items bullet Color on Hover', 'backend', 'promosys' ),
			"param_name"		=> "bullet_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> "#FFDD6E"
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'List Items divider Color', 'backend', 'promosys' ),
            "param_name"		=> "divider_color",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> "rgba(84, 88, 214, 0.2)"
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'List Items divider Color on Hover', 'backend', 'promosys' ),
            "param_name"		=> "divider_color_hover",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> "rgba(255, 255, 255, 0.3)"
        ),

		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Button Title', 'backend', 'promosys' ),
			"param_name"		=> "btn_font_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> '#ffffff'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Button Background', 'backend', 'promosys' ),
			"param_name"		=> "btn_bg_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> SECONDARY_COLOR
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Button Title Hover', 'backend', 'promosys' ),
			"param_name"		=> "btn_font_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> '#243238'
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Button Background Hover', 'backend', 'promosys' ),
			"param_name"		=> "btn_bg_color_hover",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
			"value"				=> '#ffffff'
		),
        
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Banner Text Color', 'backend', 'promosys' ),
            "param_name"		=> "attention_color",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> '#ffffff'
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Banner Background Color', 'backend', 'promosys' ),
            "param_name"		=> "attention_bg",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "dependency"	    => array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
            "value"				=> '#5557D6'
        ),
	);

    /* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
    $styles_landscape = $styles_portrait = $styles_mobile = $styles;

    $styles_landscape =  cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
    $styles_portrait =  cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
    $styles_mobile =  cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Title', 'backend', 'promosys' ),
				"param_name"		=> "title",
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Price', 'backend', 'promosys' ),
				"param_name"		=> "price",
				"edit_field_class" 	=> "vc_col-xs-6",
				"default"			=> "49"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Currency', 'backend', 'promosys' ),
				"param_name"		=> "currency",
				"edit_field_class" 	=> "vc_col-xs-6",
				"default"			=> "$"
			),
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Currency Position', 'backend', 'promosys' ),
                "param_name"		=> "currency_pos",
                "edit_field_class" 	=> "vc_col-xs-4",
                "value"				=> array(
                    esc_html_x( 'Before price', 'backend', 'promosys' )		=> 'before',
                    esc_html_x( 'After price', 'backend', 'promosys' )		=> 'after',
                )
            ),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Price Description', 'backend', 'promosys' ),
				"param_name"		=> "price_desc",
				"edit_field_class" 	=> "vc_col-xs-6",
				"default"			=> "/mo"
			),
            array(
                "type"				=> "attach_image",
                "heading"			=> esc_html_x( 'Image', 'backend', 'promosys' ),
                "param_name"		=> "image",
            ),
			array(
				"type"				=> "textarea_html",
				"heading"			=> esc_html_x( 'Text', 'backend', 'promosys' ),
				"param_name"		=> "content",
			),
            array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Button Title', 'backend', 'promosys' ),
				"param_name"		=> "button_title",
				"value"				=> "",
				"edit_field_class" 	=> "vc_col-xs-6",
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Button URL', 'backend', 'promosys' ),
				"param_name"		=> "button_url",
				"value"				=> "#",
				"edit_field_class" 	=> "vc_col-xs-6",
			),
            array(
                "type"				=> "checkbox",
                "param_name"		=> "highlighted",
                "value"				=> array( esc_html__( 'Highlight this item', 'promosys' ) => true ),
                "edit_field_class" 	=> "cws-checkbox vc_col-xs-12",
            ),
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Banner text', 'backend', 'promosys' ),
                "param_name"		=> "attention_text",
                "value"             => "",
                "edit_field_class" 	=> "vc_col-xs-12",
                "dependency"	    => array(
                    "element"		=> "highlighted",
                    "not_empty"		=> true
                ),
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
		"name"				=> esc_html_x( 'CWS Pricing Plan', 'backend', 'promosys' ),
		"base"				=> "cws_sc_pricing_plan",
		'category'			=> "By CWS",
		"icon"     			=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Pricing_Plan extends WPBakeryShortCode {
	    }
	}

?>