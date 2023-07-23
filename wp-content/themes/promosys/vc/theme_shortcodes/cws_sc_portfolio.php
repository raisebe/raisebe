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
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Title Color', 'backend', 'promosys' ),
			"param_name"		=> "title_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> PRIMARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Meta Color', 'backend', 'promosys' ),
			"param_name"		=> "meta_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> 'rgba(0,0,0, .4)',
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Accent Color', 'backend', 'promosys' ),
			"param_name"		=> "accent_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR,
		),
        array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Divider Color', 'backend', 'promosys' ),
			"param_name"		=> "divider_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> SECONDARY_COLOR,
		),
		array(
			"type"				=> "colorpicker",
			"heading"			=> esc_html_x( 'Background Color', 'backend', 'promosys' ),
			"param_name"		=> "background_color",
			"group"				=> esc_html_x( "Styling", 'backend', 'promosys' ),
			"edit_field_class" 	=> "vc_col-xs-6",
			"value"				=> 'rgba(0,0,0, .6)',
		),
	);
    
    /* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
    $styles_landscape = $styles_portrait = $styles_mobile = $styles;
    
    $styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
    $styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
    $styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	/* -----> GET TAXONOMIES <----- */
	$post_type = "cws_portfolio";
	$taxonomies = $titles_arr = array();
	$taxes = get_object_taxonomies ( 'cws_portfolio', 'object' );
	$avail_taxes = array(
		esc_html_x( 'None', 'backend', 'promosys' )	=> '',
		esc_html_x( 'Titles', 'backend', 'promosys' )	=> 'title',
	);
	$portfolio_hide_meta = get_theme_mod('cws_portfolio_hide_meta') ? (array)get_theme_mod('cws_portfolio_hide_meta') : array();

	foreach( $taxes as $tax => $tax_obj ){
		$tax_name = isset( $tax_obj->labels->name ) && !empty( $tax_obj->labels->name ) ? $tax_obj->labels->name : $tax;
		$avail_taxes[$tax_name] = $tax;
	}
	array_push( $taxonomies, array(
		"type"			=> "dropdown",
		"heading"		=> esc_html__( 'Filter by', 'promosys' ),
		"param_name"	=> "tax",
		"description"	=> esc_html_x( 'Filter by titles is not applicable when Motion Category Layout used.', 'backend', 'promosys' ),
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

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Layout', 'backend', 'promosys' ),
				"param_name"		=> "layout",
                "edit_field_class" 	=> "vc_col-xs-6",
				"value"				=> array(
					esc_html_x( 'Grid', 'backend', 'promosys' )					=> 'grid',
					esc_html_x( 'Grid with Filter', 'backend', 'promosys' )		=> 'grid_filter',
					esc_html_x( 'Masonry', 'backend', 'promosys' )				=> 'masonry',
					esc_html_x( 'Pinterest', 'backend', 'promosys' )			=> 'pinterest',
					esc_html_x( 'Asymmetric', 'backend', 'promosys' )			=> 'asymmetric',
					esc_html_x( 'Carousel', 'backend', 'promosys' )				=> 'carousel',
					esc_html_x( 'Carousel Wide', 'backend', 'promosys' )		=> 'carousel_wide',
					esc_html_x( 'Motion Category', 'backend', 'promosys' )		=> 'motion_category',
				),
				"std"				=> get_theme_mod('cws_portfolio_layout')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Hover', 'backend', 'promosys' ),
				"param_name"		=> "hover",
                "edit_field_class" 	=> "vc_col-xs-6",
				"value"				=> array(
					esc_html_x( 'Overlay', 'backend', 'promosys' )				=> 'overlay',
					esc_html_x( 'Slide From Bottom', 'backend', 'promosys' )	=> 'slide_bottom',
					esc_html_x( 'Slide From Left', 'backend', 'promosys' )		=> 'slide_left',
					esc_html_x( 'Swipe Right', 'backend', 'promosys' )			=> 'swipe_right',
				),
				'dependency'	=> array(
					'element'		=> 'layout',
					'value'			=> array( "grid", "grid_filter", "masonry", "pinterest", "asymmetric", "carousel", "motion_category" )
				),
				"std"			=> get_theme_mod('cws_portfolio_hover')
			),
		),
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
				'std'				=> get_theme_mod('cws_portfolio_orderby')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Order', 'backend', 'promosys' ),
				"param_name"		=> "order",
				"value"				=> array(
					esc_html_x( 'ASC', 'backend', 'promosys' )	=> 'ASC',
					esc_html_x( 'DESC', 'backend', 'promosys' )	=> 'DESC',
				),
				'std'				=> get_theme_mod('cws_portfolio_order')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Columns', 'backend', 'promosys' ),
				"param_name"		=> "columns",
				"edit_field_class" 	=> "vc_col-xs-4",
				"value"				=> array(
					esc_html_x( '2', 'backend', 'promosys' )		=> '2',
					esc_html_x( '3', 'backend', 'promosys' )		=> '3',
					esc_html_x( '4', 'backend', 'promosys' )		=> '4',
					esc_html_x( '5', 'backend', 'promosys' )		=> '5',
					esc_html_x( '6', 'backend', 'promosys' )		=> '6',
				),
				'dependency'	=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest", "carousel" )
				),
				"std"				=> get_theme_mod('cws_portfolio_columns')
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
				"value"				=> "-1",
				'dependency'		=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest", "asymmetric" )
				),
				"std"				=> get_theme_mod('cws_portfolio_items_pp')
			),
			array(
				'type'				=> 'checkbox',
				'param_name'		=> 'no_spacing',
                'edit_field_class' 	=> 'cws-checkbox vc_col-xs-12',
				'value'				=> array(
					esc_html_x( 'Disable Spacings', 'backend', 'promosys' ) => true
				),
				'dependency'	=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest" )
				),
				'std'				=> get_theme_mod('cws_portfolio_no_spacing')
			),
			array(
				"type"				=> "dropdown",
				"heading"			=> esc_html_x( 'Pagination', 'backend', 'promosys' ),
				"param_name"		=> "pagination",
				"value"				=> array(
					esc_html_x( 'Standart', 'backend', 'promosys' )		=> 'standart',
					esc_html_x( 'Load More', 'backend', 'promosys' )		=> 'load_more',
				),
				'dependency'		=> array(
					'element'	=> 'layout',
					'value'		=> array( "grid", "grid_filter", "masonry", "pinterest", "asymmetric" )
				),
				"std"				=> get_theme_mod('cws_portfolio_pagination')
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
				'param_name'	=> 'portfolio_hide_meta',
				'dependency'	=> array(
					'element'	=> 'hide_meta',
					'not_empty'	=> true
				),
				'value'			=> array(
					esc_html_x( 'None', 'backend', 'promosys' )				=> '',
					esc_html_x( 'Title', 'backend', 'promosys' )			=> 'title',
					esc_html_x( 'Excerpt', 'backend', 'promosys' )			=> 'excerpt',
					esc_html_x( 'Categories', 'backend', 'promosys' )		=> 'categories',
					esc_html_x( 'Tags', 'backend', 'promosys' )				=> 'tags',
					esc_html_x( 'Divider', 'backend', 'promosys' )			=> 'divider',
				),
				'std'			=> implode(',', $portfolio_hide_meta)
			),
            array(
                "type"				=> "textfield",
                "heading"			=> esc_html_x( 'Excerpt characters limit', 'backend', 'promosys' ),
                "param_name"		=> "char_limit",
                "edit_field_class" 	=> "vc_col-xs-12",
                "value"				=> "67"
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
		"name"				=> esc_html_x( 'CWS Portfolio', 'backend', 'promosys' ),
		"base"				=> "cws_sc_portfolio",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Portfolio extends WPBakeryShortCode {
	    }
	}
?>