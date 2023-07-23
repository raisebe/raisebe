<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"responsive"	=> "all",
		),
        array(
            "type"			    => "checkbox",
            "param_name"	    => "customize_colors",
            'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
            "group"			    => esc_html_x( "Styling", 'backend', 'promosys' ),
            "responsive"	    => "all",
            "value"			    => array( esc_html_x( 'Customize Color', 'backend', 'promosys' ) => true ),
        ),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '#243238',
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
		),
        array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Text Color', 'backend', 'promosys' ),
			"param_name"		=> "text_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> '',
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Accent Color', 'backend', 'promosys' ),
			"param_name"		=> "accent_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR,
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Socials Color', 'backend', 'promosys' ),
			"param_name"		=> "socials_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
		),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Meta Color', 'backend', 'promosys' ),
            "param_name"		=> "meta_color",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> '',
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Divider Color', 'backend', 'promosys' ),
            "param_name"		=> "divider_color",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#ff0000",
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Picture background gradient start color', 'backend', 'promosys' ),
            "param_name"		=> "gradient_start",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#81D3E4",
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
        ),
        array(
            "type"				=> "colorpicker",
            "heading"			=> esc_html_x( 'Picture background gradient finish color', 'backend', 'promosys' ),
            "param_name"		=> "gradient_finish",
            "group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
            "edit_field_class" 	=> "vc_col-xs-6",
            "value"				=> "#6076FA",
            "dependency"	=> array(
                "element"		=> "customize_colors",
                "not_empty"		=> true
            ),
        ),
	);

	/* -----> GET TAXONOMIES <----- */
	$post_type = "cws_staff";
	$taxonomies = $titles_arr = array();
	$taxes = get_object_taxonomies ( 'cws_staff', 'object' );
	$avail_taxes = array(
		esc_html_x( 'None', 'backend', 'promosys' )	=> '',
		esc_html_x( 'Titles', 'backend', 'promosys' )	=> 'title',
	);

	$staff_hide_meta = get_theme_mod('cws_staff_hide_meta') ? (array)get_theme_mod('cws_staff_hide_meta') : array();

	foreach( $taxes as $tax => $tax_obj ){
		$tax_name = isset( $tax_obj->labels->name ) && !empty( $tax_obj->labels->name ) ? $tax_obj->labels->name : $tax;
		$avail_taxes[$tax_name] = $tax;
	}
	array_push( $taxonomies, array(
		"type"			=> "dropdown",
		"heading"		=> esc_html__( 'Filter by', 'promosys' ),
		"param_name"	=> "tax",
		"value"			=> $avail_taxes
	));
	foreach ( $avail_taxes as $tax_name => $tax ) {
		if ($tax == 'title'){
			global $wpdb;

			$results = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type LIKE %s and post_status = 'publish'", $post_type ) );

		    foreach( $results as $index => $post ) {
                if ( function_exists('wpm') ) {
                    $post_title = wpm_translate_string($post->post_title);
                } else {
                    $post_title = $post->post_title;
                }
		        $titles_arr[$post_title] = $post->ID;
		    }
			array_push( $taxonomies, array(
				"type"				=> "cws_dropdown",
				"multiple"			=> "true",
				"heading"			=> esc_html_x( 'Titles', 'backend', 'promosys' ),
				"param_name"		=> "titles",
				'edit_field_class'	=> 'inside-box vc_col-xs-12',
				"dependency"		=> array(
					"element"	=> "tax",
					"value"		=> 'title'
				),
				"value"				=> $titles_arr
			));		
		} else {
			$terms = get_terms( $tax );
			$avail_terms = array(
				''				=> ''
			);
			if ( !is_a( $terms, 'WP_Error' ) ){
				foreach ( $terms as $term ) {
					$avail_terms[$term->name] = $term->slug;
				}
			}
			array_push( $taxonomies, array(
				"type"			=> "cws_dropdown",
				"multiple"		=> "true",
				"heading"		=> $tax_name,
				"param_name"	=> "{$tax}_terms",
				"dependency"	=> array(
					"element"	=> "tax",
					"value"		=> $tax
				),
				"value"			=> $avail_terms
			));				
		}
	}
    
    /* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
    $styles_landscape = $styles_portrait = $styles_mobile = $styles;
    
    $styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
    $styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
    $styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		$taxonomies,
		array(
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Order By', 'backend', 'promosys' ),
				"param_name"		=> "orderby",
				"value"				=> array(
					esc_html_x( 'Date', 'backend', 'promosys' )		=> 'date',
					esc_html_x( 'Order ID', 'backend', 'promosys' )	=> 'menu_order',
					esc_html_x( 'Title', 'backend', 'promosys' )		=> 'title',
				),
				'std'				=> get_theme_mod('cws_staff_order_by')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Order', 'backend', 'promosys' ),
				"param_name"		=> "order",
                'edit_field_class' 	=> 'vc_col-xs-6',
				"value"				=> array(
					esc_html_x( 'ASC', 'backend', 'promosys' )		=> 'ASC',
					esc_html_x( 'DESC', 'backend', 'promosys' )	=> 'DESC',
				),
				'std'				=> get_theme_mod('cws_staff_order')
			),
            array(
                "type"				=> "dropdown",
                "heading"			=> esc_html_x( 'Image layout', 'backend', 'promosys' ),
                "param_name"		=> "image_layout",
                "edit_field_class" 	=> "vc_col-xs-6",
                "value"				=> array(
                    esc_html_x( 'Round', 'backend', 'promosys' )		=> 'round',
                    esc_html_x( 'Triangle', 'backend', 'promosys' )		=> 'triangle',
                    esc_html_x( 'Square', 'backend', 'promosys' )		=> 'square',
                    esc_html_x( 'Special', 'backend', 'promosys' )		=> 'special',
                ),
                "std"				=> 'special'
            ),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Columns', 'backend', 'promosys' ),
				"param_name"		=> "columns",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array(
					esc_html_x( '1', 'backend', 'promosys' )		=> '1',
					esc_html_x( '2', 'backend', 'promosys' )		=> '2',
					esc_html_x( '3', 'backend', 'promosys' )		=> '3',
					esc_html_x( '4', 'backend', 'promosys' )		=> '4',
				),
				"std"				=> get_theme_mod('cws_staff_columns')
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Items to Show', 'backend', 'promosys' ),
				"description"		=> esc_html_x( 'Enter "-1" to show all posts', 'backend', 'promosys' ),
				"param_name"		=> "total_items_count",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> "-1"
			),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Items per Page', 'backend', 'promosys' ),
				"param_name"		=> "items_pp",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> get_theme_mod('cws_staff_items_pp'),
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> esc_html_x( 'Max Thumbnail Size', 'backend', 'promosys' ),
				'param_name'		=> 'thumb_size',
                "edit_field_class" 	=> "vc_col-xs-4",
				'value'				=> array(
					esc_html_x( 'Full', 'backend', 'promosys' )		    => 'full',
					esc_html_x( 'Large', 'backend', 'promosys' )		=> 'large',
					esc_html_x( 'Medium', 'backend', 'promosys' )		=> 'medium',
					esc_html_x( 'Thumbnail', 'backend', 'promosys' )	=> 'thumbnail',
				)
			),
            array(
                'type'				=> 'textfield',
                'heading'			=> esc_html_x( 'Content Character Limit', 'backend', 'promosys' ),
                'param_name'		=> 'chars_count',
                "edit_field_class" 	=> "vc_col-xs-4",
                'value'				=> '98',
                "description"		=> esc_html_x( 'Enter "-1" to show full text', 'backend', 'promosys' ),
            ),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'carousel',
                'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
				'value'				=> array(
					esc_html_x( 'Carousel', 'backend', 'promosys' ) => true
				)
			),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'hide_meta',
                'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
				'value'				=> array(
					esc_html_x( 'Hide Meta Data', 'backend', 'promosys' ) => true
				),
				'std'				=> '1'
			),
			array(
				'type'			=> 'cws_dropdown',
				'multiple'		=> "true",
				'heading'		=> esc_html_x( 'Hide', 'backend', 'promosys' ),
				'param_name'	=> 'team_hide_meta',
				'dependency'	=> array(
					'element'	=> 'hide_meta',
					'not_empty'	=> true
				),
				'value'			=> array(
					esc_html_x( 'None', 'backend', 'promosys' )					=> '',
					esc_html_x( 'Photo', 'backend', 'promosys' )				=> 'photo',
					esc_html_x( 'Name', 'backend', 'promosys' )					=> 'name',
					esc_html_x( 'Position', 'backend', 'promosys' )				=> 'position',
					esc_html_x( 'Department', 'backend', 'promosys' )			=> 'department',
					esc_html_x( 'Experience', 'backend', 'promosys' )			=> 'experience',
					esc_html_x( 'Email', 'backend', 'promosys' )				=> 'email',
					esc_html_x( 'Phone Number', 'backend', 'promosys' )			=> 'phone',
					esc_html_x( 'Socials', 'backend', 'promosys' )				=> 'socials',
					esc_html_x( 'Biography', 'backend', 'promosys' )			=> 'biography',
					esc_html_x( 'More Button', 'backend', 'promosys' )		    => 'more',
				),
				'std'			=> implode(',', $staff_hide_meta)
			),
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'More Button Title', 'backend', 'promosys' ),
                "param_name"		=> "button_title",
                "value"				=> esc_html_x( 'Read More', 'backend', 'promosys' ),
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
		"name"				=> esc_html_x( 'CWS Our Team', 'backend', 'promosys' ),
		"base"				=> "cws_sc_our_team",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Our_Team extends WPBakeryShortCode {
	    }
	}
?>