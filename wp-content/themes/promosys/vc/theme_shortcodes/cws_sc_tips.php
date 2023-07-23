<?php
	/* -----> STYLING TAB PROPERTIES <----- */
	$styles = array(
		array(
			"type"			=> "css_editor",
			"param_name"	=> "custom_styles",
			"group"			=> esc_html_x( "Styling", 'CWS_VC_Tips', 'promosys' ),
			"responsive"	=> 'all'
		)
	);

	/* -----> GET PRODUCTS <----- */
	$products_array = array(
		esc_html_x('Custom Tooltip', 'CWS_VC_Tips', 'promosys') => 'custom'
	);
	$args = array(
	    'post_type'			=> 'product',
	    'posts_per_page'	=> '-1',
	);

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) :
		while( $products->have_posts() ):
			$products->the_post();
			$products_array[get_the_title()] = get_the_ID();
		endwhile;
	endif;

	/* -----> RESPONSIVE STYLING TABS PROPERTIES <----- */
	$styles_landscape = $styles_portrait = $styles_mobile = $styles;

	$styles_landscape = cws_responsive_styles($styles_landscape, 'landscape', cws_landscape_group_name());
	$styles_portrait = cws_responsive_styles($styles_portrait, 'portrait', cws_tablet_group_name());
	$styles_mobile = cws_responsive_styles($styles_mobile, 'mobile', cws_mobile_group_name());

	$params = cws_ext_merge_arrs( array(
		/* -----> GENERAL TAB <----- */
		array(
			array(
				"type"			=> "attach_image",
				"heading"		=> esc_html__( 'Image', 'promosys' ),
				"param_name"	=> "image",
			),
			array(
                'type' 			=> 'param_group',
                'heading' 		=> esc_html_x( 'Tips', 'CWS_VC_Tips', 'promosys' ),
                'param_name' 	=> 'values',
                'params' 		=> array(
					array(
						"type"			=> "dropdown",
						"admin_label"	=> true,
						"heading"		=> esc_html_x( 'Choose Product', 'CWS_VC_Tips', 'promosys' ),
						"param_name"	=> "product",
						"value"			=> $products_array
					),
					array(
						"type"				=> "attach_image",
						"heading"			=> esc_html__( 'Image', 'promosys' ),
						"param_name"		=> "tip_image",
						"dependency"		=> array(
							"element"	=> "product",
							"value"		=> "custom"
						),
					),
					array(
						"type"				=> "textfield",
						"admin_label"		=> true,
						"heading"			=> esc_html_x( 'Title', 'CWS_VC_Tips', 'promosys' ),
						"param_name"		=> "title",
						"edit_field_class" 	=> "vc_col-xs-4",
						"dependency"		=> array(
							"element"	=> "product",
							"value"		=> "custom"
						),
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"admin_label"		=> true,
						"heading"			=> esc_html_x( 'Price', 'CWS_VC_Tips', 'promosys' ),
						"param_name"		=> "price",
						"edit_field_class" 	=> "vc_col-xs-4",
						"dependency"		=> array(
							"element"	=> "product",
							"value"		=> "custom"
						),
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Url', 'CWS_VC_Tips', 'promosys' ),
						"param_name"		=> "url",
						"edit_field_class" 	=> "vc_col-xs-4",
						"dependency"		=> array(
							"element"	=> "product",
							"value"		=> "custom"
						),
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Top (percents)', 'CWS_VC_Tips', 'promosys' ),
						"param_name"		=> "pos_top",
						"edit_field_class" 	=> "vc_col-xs-6",
						"value"				=> ""
					),
					array(
						"type"				=> "textfield",
						"heading"			=> esc_html_x( 'Left (percents)', 'CWS_VC_Tips', 'promosys' ),
						"param_name"		=> "pos_left",
						"edit_field_class" 	=> "vc_col-xs-6",
						"value"				=> ""
					),
                ),
                "value"			=> "",
            ),
			array(
				"type"				=> "textfield",
				"heading"			=> esc_html_x( 'Extra class name', 'CWS_VC_Tips', 'promosys' ),
				"description"		=> esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'CWS_VC_Tips', 'promosys' ),
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
		"name"				=> esc_html_x( 'CWS Tips', 'CWS_VC_Tips', 'promosys' ),
		"base"				=> "cws_sc_tips",
		"category"			=> "By CWS",
		"icon" 				=> "cws_icon",
		"weight"			=> 80,
		"params"			=> $params
	));

	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_CWS_Sc_Tips extends WPBakeryShortCode {
	    }
	}
?>