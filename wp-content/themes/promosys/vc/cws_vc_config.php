<?php
	if ( !class_exists( 'cws_ext_VC_Config' ) ){
		class cws_ext_VC_Config{
			public function __construct ( $args = array() ){
				require_once(trailingslashit(get_template_directory()) . '/vc/vc_extends/cws_vc_extends.php');

				add_action( 'admin_init', array( $this, 'remove_meta_boxes' ) );
				add_action( 'admin_menu', array( $this, 'remove_grid_elements_menu' ) );
				add_action( 'vc_iconpicker-type-cws_flaticons', array( $this, 'add_cws_flaticons' ) );

				add_action( 'init', array( $this, 'remove_vc_elements' ) );
				add_action( 'init', array( $this, 'config' ) );
				if( PROMOSYS__ACTIVE ){
					add_action( 'init', array( $this, 'extend_shortcodes' ) );
				}
				add_action( 'init', array( $this, 'extend_params' ) );
				add_action( 'init', array( $this, 'modify_vc_elements' ) );
			}
			public function add_cws_shortcode($name, $param1, $param2)  {
				$short = 'shortcode';
				call_user_func('vc_add_' . $short.$name, $param1, $param2);
			}
			// Remove Teaser metabox
			public function remove_meta_boxes() {
				remove_meta_box( 'vc_teaser', 'page', 		'side' );
				remove_meta_box( 'vc_teaser', 'post', 		'side' );
				remove_meta_box( 'vc_teaser', 'portfolio', 	'side' );
				remove_meta_box( 'vc_teaser', 'product', 	'side' );
			}
			// Remove 'Grid Elements' from Admin menu
			public function remove_grid_elements_menu(){
				remove_menu_page( 'edit.php?post_type=vc_grid_item' );
			}
			// Remove VC Elements
			public function remove_vc_elements (){
				vc_remove_element( 'vc_separator' );
				vc_remove_element( 'vc_text_separator' );
				vc_remove_element( 'vc_message' );
				vc_remove_element( 'vc_gallery' );
				vc_remove_element( 'vc_tta_tour' );
				vc_remove_element( 'vc_tta_pageable' );
				vc_remove_element( 'vc_custom_heading' );
				vc_remove_element( 'vc_cta' );
				vc_remove_element( 'vc_posts_slider' );
				vc_remove_element( 'vc_progress_bar' );
				vc_remove_element( 'vc_basic_grid' );
				vc_remove_element( 'vc_media_grid' );
				vc_remove_element( 'vc_masonry_grid' );
				vc_remove_element( 'vc_masonry_media_grid' );
				vc_remove_element( 'vc_widget_sidebar' );
			}
			public function config(){
				vc_set_default_editor_post_types( array(
					'page',					
					'megamenu_item',
					'cws-megamenu',
					'cws-tmpl-footer',
					'cws-tmpl-sticky',
					'cws-tmpl-header',
				)); 
			}
			// Extend Composer with Theme Shortcodes
			public function extend_shortcodes (){
				$shortcodes = array(
					'cws_sc_banners',
					'cws_sc_blog',
					'cws_sc_button',
					'cws_sc_breadcrumbs',
					'cws_sc_carousel',
					'cws_sc_divider',
					'cws_sc_gallery',
					'cws_sc_icon',
					'cws_sc_icon_list',
					'cws_sc_image',
					'cws_sc_info_box',
					'cws_sc_latest_posts',
					'cws_sc_logo',
					'cws_sc_menu',
					'cws_sc_menu_list',
					'cws_sc_milestone',
                    'cws_sc_notice',
					'cws_sc_our_team',
					'cws_sc_portfolio',
					'cws_sc_pricing_plan',
					'cws_sc_progress_bar',
					'cws_sc_roadmap',
					'cws_sc_search',
					'cws_sc_service',
					'cws_sc_testimonials',
					'cws_sc_text',
					'cws_sc_tips',
					'cws_sc_title_area',
					'cws_sc_popup_video',
				);
				if( class_exists('WooCommerce') ){
					$shortcodes[] = 'cws_sc_tips';
				}

				if( PROMOSYS__ACTIVE ){
					foreach( $shortcodes as $shortcode ){
						require_once( trailingslashit( get_template_directory() ) . 'vc/theme_shortcodes/'.$shortcode.'.php' );
						require_once( PROMOSYS__PLUGINS_DIR . 'cws-essentials/render_vc_shortcodes/'.$shortcode.'.php' );
					}
				}
			}
			// Extend Composer with Custom Parametres
			public function extend_params (){
				require_once( trailingslashit( get_template_directory() ) . 'vc/params/cws_dropdown.php' );
				require_once( trailingslashit( get_template_directory() ) . 'vc/params/cws_svg.php' );
			}
			// Modify VC Elements
			public function modify_vc_elements (){
				if ( function_exists( 'vc_add'.'_shortcode_param' ) ) {
 					$this->add_cws_shortcode('_param' , 'cws_svg' , 'cws_vc_svg');
				}				
				vc_remove_param( 'vc_row', 'columns_placement' );		

				vc_remove_param( 'vc_tta_accordion', 'style' );
				vc_remove_param( 'vc_tta_accordion', 'shape' );
				vc_remove_param( 'vc_tta_accordion', 'color' );
				vc_remove_param( 'vc_tta_accordion', 'no_fill' );
				vc_remove_param( 'vc_tta_accordion', 'spacing' );
				vc_remove_param( 'vc_tta_accordion', 'gap' );

				vc_remove_param( 'vc_tta_tabs', 'style' );
				vc_remove_param( 'vc_tta_tabs', 'shape' );
				vc_remove_param( 'vc_tta_tabs', 'color' );
				vc_remove_param( 'vc_tta_tabs', 'no_fill_content_area' );
				vc_remove_param( 'vc_tta_tabs', 'spacing' );
				vc_remove_param( 'vc_tta_tabs', 'gap' );
				vc_remove_param( 'vc_tta_tabs', 'pagination_style' );
				vc_remove_param( 'vc_tta_tabs', 'pagination_color' );

				vc_remove_param( 'vc_toggle', 'style' );
				vc_remove_param( 'vc_toggle', 'color' );
				vc_remove_param( 'vc_toggle', 'size' );
				vc_remove_param( 'vc_toggle', 'use_custom_heading' );

				vc_remove_param( 'vc_images_carousel', 'partial_view' );	
			}
			public function add_cws_flaticons ( $icons ){
				$icon_id = "";
				$fi_array = array();
				$fi_icons = cws_get_all_flaticon_icons();

				if ( !is_array( $fi_icons ) || empty( $fi_icons ) ){
					return $icons;
				}

				for ( $i = 0; $i < count( $fi_icons ); $i++ ){
					$icon_id = $fi_icons[$i];
					$icon_class = "flaticon-{$icon_id}";
					array_push( $fi_array, array( "$icon_class" => $icon_id ) );
				}
				$icons = array_merge( $icons, $fi_array );
				return $icons;
			}
		}
	}
	/**/
	/* Config and enable extension */
	/**/
	$vc_config = new cws_ext_VC_Config ();
	/**/
	/* \Config and enable extension */


	if(!class_exists('VC_CWS_Background')){
		class VC_CWS_Background extends cws_ext_VC_Config{
			static public $row_atts = '';
			static public $column_atts = '';

			function __construct(){
				add_action('admin_init', array($this,'cws_extra_vc_params'));
			}

			/* -----> Start Customize VC_ROW <-----*/
			public static function cws_open_vc_shortcode($atts, $content){
				extract( shortcode_atts( array(
					/* From cws_vc_extends.php -> cws_structure_background_props() */
					//Desktop
					"bg_position"					=> "center",
					"bg_size"						=> "cover",
					"bg_repeat"						=> "no-repeat",
					"bg_attachment"					=> "scroll",
					"custom_bg_position"			=> "",
					"custom_bg_size"				=> "",
					"bg_hover"						=> "no_hover",
					"bg_transition"					=> "0.3",
					"add_shadow"					=> false,
					"shadow_color"					=> "rgba(0,0,0, .15)",
					//Landscape
					"custom_styles_landscape" 		=> "",
					"customize_bg_landscape"		=> false,
					"bg_position_landscape"			=> "center",
					"bg_size_landscape"				=> "cover",
					"bg_repeat_landscape"			=> "no-repeat",
					"bg_attachment_landscape"		=> "scroll",
					"custom_bg_position_landscape"	=> "",
					"custom_bg_size_landscape"		=> "",
					"hide_bg_landscape" 			=> false,
					//Portrait
					"custom_styles_portrait" 		=> "",
					"customize_bg_portrait"			=> false,
					"bg_position_portrait"			=> "center",
					"bg_size_portrait"				=> "cover",
					"bg_repeat_portrait"			=> "no-repeat",
					"bg_attachment_portrait"		=> "scroll",
					"custom_bg_position_portrait"	=> "",
					"custom_bg_size_portrait"		=> "",
					"hide_bg_portrait" 				=> false,
					//Mobile
					"custom_styles_mobile" 			=> "",
					"customize_bg_mobile"			=> false,
					"bg_position_mobile"			=> "center",
					"bg_size_mobile"				=> "cover",
					"bg_repeat_mobile"				=> "no-repeat",
					"bg_attachment_mobile"			=> "scroll",
					"custom_bg_position_mobile"		=> "",
					"custom_bg_size_mobile"			=> "",
					"hide_bg_mobile" 				=> false,
					/*\ From cws_structure_background_props \*/

					/* Start Overlay Properties */
					"bg_cws_color" 						=> "none",
					"cws_overlay_color" 				=> PRIMARY_COLOR,
					"cws_gradient_color_from" 			=> "#000",
					"cws_gradient_color_to" 			=> "#fff",
					"cws_gradient_opacity" 				=> "50",
					"cws_gradient_type" 				=> "linear",
					"cws_gradient_angle" 				=> "45",
					"cws_gradient_shape_variant_type" 	=> "simple",
					"cws_gradient_shape_type" 			=> "ellipse",
					"cws_gradient_size_keyword_type" 	=> "closest-side",
					"cws_gradient_size_type" 			=> "60% 55%",
					/*\ End Overlay Properties \*/

					/* Start Extra Layer Properties */
					"add_layers" 				=> false,
					"cws_layer_image" 			=> "",
					"extra_layer_pos" 			=> "left",
					"extra_layer_width" 		=> "",
					"extra_layer_size" 			=> "initial",
					"extra_layer_position" 		=> "left top",
					"extra_layer_repeat" 		=> "no-repeat",
					"extra_layer_bg" 			=> "",
					"extra_layer_margin" 		=> "0px 0px",
					"extra_layer_opacity" 		=> "100",
					"hide_layer_landscape" 		=> false,
					"hide_layer_portrait" 		=> false,
					"hide_layer_mobile" 		=> false,
					"overflow_hidden"			=> false,
					"z_index" 					=> "",
					"shift" 					=> "",
					/* End Extra Layer Properties */

					/* Start Particles Properties */
                    "particles"					=> false,
                    "particles_width"			=> "300px",
                    "particles_height"			=> "300px",
                    "particles_hide"			=> "767",
                    "particles_left"			=> "",
                    "particles_top"				=> "",
                    "particles_start"			=> "top_left",
                    "particles_speed"			=> "2",
                    "particles_size"			=> "10",
                    "particles_linked"			=> false,
                    "particles_count"			=> "25",
                    "particles_shape"			=> "circle",
                    "particle_images"			=> "",
                    "particles_mode"			=> "out",
                    "particles_direction" 		=> "none",
                    "particles_straight"  		=> false,
                    "particles_random_size"		=> false,
                    "particles_random_opacity"	=> false,
                    "particles_color"			=> PRIMARY_COLOR,
					/*\ End Particles Properties \*/

					/* Start Mask Properties */
					"add_mask"			=> false,
					"mask_image"		=> "",
					"mask_start"		=> "top_left"
					/*\ End Mask Properties \*/

				), $atts ) );

				/* -----> Variables declaration <----- */
				$out = $styles = $full_width = $extra_layer_styles = $particles_styles = $particles_wrap_styles = $particles_data = "";
				$id = uniqid( "cws_content_" );

				/* -----> Visual Composer Responsive styles <----- */
				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_landscape, $vc_landscape_styles); 
				$vc_landscape_styles = implode($vc_landscape_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_portrait, $vc_portrait_styles); 
				$vc_portrait_styles = implode($vc_portrait_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_mobile, $vc_mobile_styles); 
				$vc_mobile_styles = implode($vc_mobile_styles);

				/* -----> Customize default styles <----- */
				$styles .= "
					.".$id." > .vc_row{
						background-attachment: ".$bg_attachment." !important;
						background-repeat: ".$bg_repeat." !important;
					}
				";
				if( $bg_size == 'custom' && !empty($custom_bg_size) ){
					$styles .= "
						.".$id." > .vc_row{
							background-size: ".$custom_bg_size." !important;
						}
					";
				} else if( $bg_size == 'custom' && empty($custom_bg_size) ) {
					$styles .= "
						.".$id." > .vc_row{
							background-size: cover !important;
						}
					";
				} else {
					$styles .= "
						.".$id." > .vc_row{
							background-size: ".$bg_size." !important;
						}
					";
				}
				if( $bg_position == 'custom' && !empty($custom_bg_position) ){
					$styles .= "
						.".$id." > .vc_row{
							background-position: ".$custom_bg_position." !important;
						}
					";
				} else if( $bg_position == 'custom' && empty($custom_bg_position) ) {
					$styles .= "
						.".$id." > .vc_row{
							background-position: center center !important;
						}
					";
				} else {
					$styles .= "
						.".$id." > .vc_row{
							background-position: ".$bg_position." !important;
						}
					";
				}
				if( $bg_cws_color == 'color' && !empty($cws_overlay_color) ){
					$styles .= "
						.".$id." > .vc_row:before{
							background-color: ".$cws_overlay_color.";
						}
					";
				}
				if( $bg_hover != 'no_hover' && !empty($bg_transition) ){
					$styles .= "
						@media 
							screen and (min-width: 1367px),
							screen and (min-width: 1200px) and (any-hover: hover),
							screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
							screen and (min-width: 1200px) and (-ms-high-contrast: none),
							screen and (min-width: 1200px) and (-ms-high-contrast: active)
						{
					";

						$styles .= "
							.".$id." > .vc_row{
								-webkit-transition-duration: ".esc_attr($bg_transition)."s;
								transition-duration: ".esc_attr($bg_transition)."s;
							}
						";

					$styles .= "
						}
					";
				}
				if( $bg_cws_color == 'gradient' ){
					!empty($cws_gradient_color_from) ? $color1 = esc_attr($cws_gradient_color_from) : $color1 = '#000';
					!empty($cws_gradient_color_to) ? $color2 = esc_attr($cws_gradient_color_to) : $color2 = '#fff';
					!empty($cws_gradient_opacity) ? $opacity = (esc_attr($cws_gradient_opacity) / 100) : $opacity = 0;


					if( $cws_gradient_type == 'linear' ){
						!empty($cws_gradient_angle) ? $angle = (int)esc_attr($cws_gradient_angle) : $angle = 0;

						$styles .= "
							.".$id." > .vc_row:before{
								background: -webkit-linear-gradient(".$angle."deg, ".$color1.", ".$color2." );
								background: -moz-linear-gradient(".$angle."deg, ".$color1.", ".$color2." );
								background: -o-linear-gradient(".$angle."deg, ".$color1.", ".$color2." );
								background: linear-gradient(".$angle."deg, ".$color1.", ".$color2." );
								opacity: ".$opacity.";
							}
						";
					} else if( $cws_gradient_type == 'radial' ){
						!empty($cws_gradient_size_type) ? $size = esc_attr($cws_gradient_size_type) : $size = '0% 0%';

						if( $cws_gradient_shape_variant_type == 'simple' ){
							$styles .= "
								.".$id." > .vc_row:before{
									background: -webkit-radial-gradient(".$cws_gradient_shape_type.", ".$color1.", ".$color2." );
									background: -moz-radial-gradient(".$cws_gradient_shape_type.", ".$color1.", ".$color2." );
									background: -o-radial-gradient(".$cws_gradient_shape_type.", ".$color1.", ".$color2." );
									background: radial-gradient(".$cws_gradient_shape_type.", ".$color1.", ".$color2." );
									opacity: ".$opacity.";
								}
							";
						} else {
							$styles .= "
								.".$id." > .vc_row:before{
									background: -webkit-radial-gradient(".$size." ".$cws_gradient_size_keyword_type.", ".$color1." , ".$color2." );
									background: -moz-radial-gradient(".$size." ".$cws_gradient_size_keyword_type.", ".$color1." , ".$color2." );
									background: -o-radial-gradient(".$size." ".$cws_gradient_size_keyword_type.", ".$color1." , ".$color2." );
									background: radial-gradient(".$cws_gradient_size_keyword_type." at ".$size.", ".$color1." , ".$color2." );
									opacity: ".$opacity.";
								}
							";
						}
					}
				}
				if( $overflow_hidden ){
					$styles .= "
						.".$id." > .vc_row{
							overflow: hidden !important;
						}
					";
				}
				if( !empty($z_index) ){
					$styles .= "
						.".$id." > .vc_row{
							position: relative;
							overflow: visible;
							z-index: ".(int)esc_attr($z_index).";
						}
					";
				}
				if( !empty($shift) ){
					$styles .= "
						#".$id."{
							position: relative;
							bottom: ".(int)esc_attr($shift)."px;
						}
					";
				}
				if( $add_shadow ){
					$styles .= "
						#".$id." > .vc_row{
							-webkit-box-shadow: 0 0 35px 0 ".esc_attr($shadow_color).";
							-moz-box-shadow: 0 0 35px 0 ".esc_attr($shadow_color).";
							box-shadow: 0 0 35px 0 ".esc_attr($shadow_color).";
						}
					";
				}
				/* -----> End of default styles <----- */

				/* -----> Customize landscape styles <----- */
				if(
					!empty($custom_styles_landscape) || 
					$customize_bg_landscape || 
					$hide_bg_landscape || 
					$hide_layer_landscape 
				){
					$styles .= "
						@media screen and (max-width: 1199px){
					";

						if( !empty($custom_styles_landscape) ){
							$styles .= "
								.".$id." > .vc_row{
									".$vc_landscape_styles."
								}
							";
						}
						if( $customize_bg_landscape ){
							$styles .= "
								.".$id." > .vc_row{
									background-attachment: ".$bg_attachment_landscape." !important;
									background-repeat: ".$bg_repeat_landscape." !important;
								}
							";
							if( $bg_size_landscape == 'custom' && !empty($custom_bg_size_landscape) ){
								$styles .= "
									.".$id." > .vc_row{
										background-size: ".$custom_bg_size_landscape." !important;
									}
								";
							} else if( $bg_size_landscape == 'custom' && empty($custom_bg_size_landscape) ) {
								$styles .= "
									.".$id." > .vc_row{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									.".$id." > .vc_row{
										background-size: ".$bg_size_landscape." !important;
									}
								";
							}
							if( $bg_position_landscape == 'custom' && !empty($custom_bg_position_landscape) ){
								$styles .= "
									.".$id." > .vc_row{
										background-position: ".$custom_bg_position_landscape." !important;
									}
								";
							} else if( $bg_position_landscape == 'custom' && empty($custom_bg_position_landscape) ) {
								$styles .= "
									.".$id." > .vc_row{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									.".$id." > .vc_row{
										background-position: ".$bg_position_landscape." !important;
									}
								";
							}
						}
						if( $hide_bg_landscape ){
							$styles .= "
								.".$id." > .vc_row{
									background-image: none !important;
								}
							";
						}
						if( $hide_layer_landscape ){
							$styles .= "
								#".$id." > .cws_layer{
									display: none;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of landscape styles <----- */

				/* -----> Customize portrait styles <----- */
				if(
					!empty($custom_styles_portrait) || 
					$customize_bg_portrait || 
					$hide_bg_portrait || 
					$hide_layer_portrait 
				){
					$styles .= "
						@media screen and (max-width: 991px){
					";

						if( !empty($custom_styles_portrait) ){
							$styles .= "
								.".$id." > .vc_row{
									".$vc_portrait_styles."
								}
							";
						}
						if( $customize_bg_portrait ){
							$styles .= "
								.".$id." > .vc_row{
									background-attachment: ".$bg_attachment_portrait." !important;
									background-repeat: ".$bg_repeat_portrait." !important;
								}
							";
							if( $bg_size_portrait == 'custom' && !empty($custom_bg_size_portrait) ){
								$styles .= "
									.".$id." > .vc_row{
										background-size: ".$custom_bg_size_portrait." !important;
									}
								";
							} else if( $bg_size_portrait == 'custom' && empty($custom_bg_size_portrait) ) {
								$styles .= "
									.".$id." > .vc_row{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									.".$id." > .vc_row{
										background-size: ".$bg_size_portrait." !important;
									}
								";
							}
							if( $bg_position_portrait == 'custom' && !empty($custom_bg_position_portrait) ){
								$styles .= "
									.".$id." > .vc_row{
										background-position: ".$custom_bg_position_portrait." !important;
									}
								";
							} else if( $bg_position_portrait == 'custom' && empty($custom_bg_position_portrait) ) {
								$styles .= "
									.".$id." > .vc_row{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									.".$id." > .vc_row{
										background-position: ".$bg_position_portrait." !important;
									}
								";
							}
						}
						if( $hide_bg_portrait ){
							$styles .= "
								.".$id." > .vc_row{
									background-image: none !important;
								}
							";
						}
						if( $hide_layer_portrait ){
							$styles .= "
								#".$id." > .cws_layer{
									display: none;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of portrait styles <----- */

				/* -----> Customize mobile styles <----- */
				if(
					!empty($custom_styles_mobile) || 
					$customize_bg_mobile || 
					$hide_bg_mobile || 
					$hide_layer_mobile 
				){
					$styles .= "
						@media screen and (max-width: 767px){
					";

						if( !empty($custom_styles_mobile) ){
							$styles .= "
								.".$id." > .vc_row{
									".$vc_mobile_styles."
								}
							";
						}
						if( $customize_bg_mobile ){
							$styles .= "
								.".$id." > .vc_row{
									background-attachment: ".$bg_attachment_mobile." !important;
									background-repeat: ".$bg_repeat_mobile." !important;
								}
							";
							if( $bg_size_mobile == 'custom' && !empty($custom_bg_size_mobile) ){
								$styles .= "
									.".$id." > .vc_row{
										background-size: ".$custom_bg_size_mobile." !important;
									}
								";
							} else if( $bg_size_mobile == 'custom' && empty($custom_bg_size_mobile) ) {
								$styles .= "
									.".$id." > .vc_row{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									.".$id." > .vc_row{
										background-size: ".$bg_size_mobile." !important;
									}
								";
							}
							if( $bg_position_mobile == 'custom' && !empty($custom_bg_position_mobile) ){
								$styles .= "
									.".$id." > .vc_row{
										background-position: ".$custom_bg_position_mobile." !important;
									}
								";
							} else if( $bg_position_mobile == 'custom' && empty($custom_bg_position_mobile) ) {
								$styles .= "
									.".$id." > .vc_row{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									.".$id." > .vc_row{
										background-position: ".$bg_position_mobile." !important;
									}
								";
							}
						}
						if( $hide_bg_mobile ){
							$styles .= "
								.".$id." > .vc_row{
									background-image: none !important;
								}
							";
						}
						if( $hide_layer_mobile ){
							$styles .= "
								.".$id." > .cws_layer{
									display: none;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of mobile styles <----- */


				/* -----> Custom VC_ROW output <----- */
				$row_classes = $id;
				$row_classes .= " cws-content";
				$row_classes .= " background_".$bg_hover;
				$row_classes .= $add_mask ? " mask_".$mask_start : '';

				$row_data = $add_mask ? 'data-mask="'.wp_get_attachment_image_src($mask_image)[0].'"' : '';

				$out = '<div id="'.$id.'" class="'.$row_classes.'" '.$row_data.'>';

				$styles = trim($styles);
				$styles = preg_replace('/\s+/', ' ', $styles);

				cws__vc_styles($styles);

				/*-----> Get VC_ROW properties <-----*/
				$sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass( 'vc_row' );
				$row_class_vc = vc_map_get_attributes( $sc_obj->getShortcode(), $atts );
				extract( $row_class_vc );

				$extra_layer_classes = "";
				$extra_layer_atts = "";

				if( !empty($full_width) ){
					$extra_layer_classes .= " cws_stretch_row";
					$extra_layer_atts .= " data-vc-full-width='true' data-vc-full-width-init='false'";
				}

				/*-----> Extra Layer Input <-----*/
				if( $add_layers ){
					if( !empty($cws_layer_image) ){
						$src = wp_get_attachment_image_src($cws_layer_image, 'full');
						$extra_layer_styles .= 'background-image:url("'.esc_attr($src[0]).'");';
					}

					$extra_layer_styles .= "
						".(!empty($extra_layer_pos) ? $extra_layer_pos.":0%;" : '')."
						".(!empty($extra_layer_width) ? " width:".(float)esc_attr($extra_layer_width)."% !important;" : '')."
						".(!empty($extra_layer_size) ? " background-size:".$extra_layer_size.";" : '')."
						".(!empty($extra_layer_position) ? " background-position:".$extra_layer_position.";" : '')."
						".(!empty($extra_layer_repeat) ? " background-repeat:".$extra_layer_repeat.";" : '')."
						".(!empty($extra_layer_bg) ? " background-color:".$extra_layer_bg.";" : '')."
						".(!empty($extra_layer_margin) ? " margin: ".esc_attr($extra_layer_margin).";" : 'cws_vc_config.php')."
						".(!empty($extra_layer_opacity) ? " opacity: ".( (int)esc_attr($extra_layer_opacity) / 100 ).";" : '')."
					";

					$out .= "<div class='cws_layer".$extra_layer_classes."'".$extra_layer_atts.">";
						$out .= "<div style='".esc_attr($extra_layer_styles)."'></div>";
					$out .= "</div>";

					if( !empty($full_width) ){
						$out .= "<div class='vc_row-full-width vc_clearfix'></div>";
					}
				}
                
                /*-----> Particles <-----*/
                if( $particles ){
                    wp_enqueue_script( 'particles' );
                    
                    $particles_id = uniqid('particles-');
                    
                    $particles_data .= !empty($particles_color) ? " data-color='".esc_attr($particles_color)."'" : "";
                    $particles_data .= !empty($particles_size) ? " data-size='".esc_attr($particles_size)."'" : "";
                    $particles_data .= !empty($particles_linked) ? " data-linked='".esc_attr($particles_linked)."'" : "";
                    $particles_data .= !empty($particles_count) ? " data-count='".esc_attr($particles_count)."'" : "";
                    $particles_data .= !empty($particles_speed) ? " data-speed='".esc_attr($particles_speed)."'" : "";
                    $particles_data .= !empty($particles_hide) ? " data-hide='".esc_attr($particles_hide)."'" : "";
                    $particles_data .= !empty($particles_shape) ? " data-shape='".esc_attr($particles_shape)."'" : "";
                    $particles_data .= !empty($particles_mode) ? " data-mode='".esc_attr($particles_mode)."'" : "";
                    $particles_data .= !empty($particles_direction) ? " data-direction='".esc_attr($particles_direction)."'" : "";
                    $particles_data .= !empty($particles_straight) ? " data-straight='".esc_attr($particles_straight)."'" : "";
                    $particles_data .= !empty($particles_random_size) ? " data-random-size='".esc_attr($particles_random_size)."'" : "";
                    $particles_data .= !empty($particles_random_opacity) ? " data-random-opacity='".esc_attr($particles_random_opacity)."'" : "";
                    
                    // Particles Images
                    $particle_images = (array)vc_param_group_parse_atts($particle_images);
                    $json_images = array();
                    
                    if( !empty($particle_images) ){
                        foreach ($particle_images as $key => $value) {
                            $value = $value['particle_image'];
                            
                            if( !empty($value) ){
                                $json_images[$key]['url'] = wp_get_attachment_image_src($value)[0];
                                $json_images[$key]['width'] = wp_get_attachment_image_src($value)[1];
                                $json_images[$key]['height'] = wp_get_attachment_image_src($value)[2];
                            }
                        }
                    }
                    
                    $particles_data .= !empty($json_images) ? " data-images='".json_encode($json_images)."'" : "";
                    
                    // Particles Styles
                    $particles_styles .= !empty($particles_width) ? "width:".esc_attr($particles_width).";" : "";
                    $particles_styles .= !empty($particles_height) ? "height:".esc_attr($particles_height).";" : "";
                    
                    $particles_wrap_styles .= !empty($particles_left) ? "margin-left:".esc_attr($particles_left).";" : "";
                    $particles_wrap_styles .= !empty($particles_top) ? "margin-top:".esc_attr($particles_top).";" : "";
                    
                    $out .= "<div class='particles-wrapper' ". (!empty($particles_wrap_styles) ? 'style="'.$particles_wrap_styles.'"' : '') .">";
                    $out .= "<div id='".$particles_id."' class='particles-js ".$particles_start."' ".$particles_data." style='".$particles_styles."'></div>";
                    $out .= "</div>";
                    
                    
                    if( !empty($full_width) ){
                        $out .= "<div class='vc_row-full-width vc_clearfix'></div>";
                    }
                }

				return $out;
			}
			public static function cws_close_vc_shortcode($atts, $content){
				$out = "</div>";

				return $out;
			}
			/*\ -----> End Customize VC_ROW <-----\*/


			/* -----> Start Customize VC_COLUMN <-----*/
			public static function cws_open_vc_shortcode_column($atts, $content){
				extract( shortcode_atts( array(
					/* From cws_vc_extends.php -> cws_structure_background_props() */
					//Desktop
					"bg_position"					=> "center",
					"bg_size"						=> "cover",
					"bg_repeat"						=> "no-repeat",
					"bg_attachment"					=> "scroll",
					"custom_bg_position"			=> "",
					"custom_bg_size"				=> "",
					//Landscape
					"custom_styles_landscape" 		=> "",
					"customize_bg_landscape"		=> false,
					"bg_position_landscape"			=> "center",
					"bg_size_landscape"				=> "cover",
					"bg_repeat_landscape"			=> "no-repeat",
					"bg_attachment_landscape"		=> "scroll",
					"custom_bg_position_landscape"	=> "",
					"custom_bg_size_landscape"		=> "",
					"hide_bg_landscape" 			=> false,
					//Portrait
					"custom_styles_portrait" 		=> "",
					"customize_bg_portrait"			=> false,
					"bg_position_portrait"			=> "center",
					"bg_size_portrait"				=> "cover",
					"bg_repeat_portrait"			=> "no-repeat",
					"bg_attachment_portrait"		=> "scroll",
					"custom_bg_position_portrait"	=> "",
					"custom_bg_size_portrait"		=> "",
					"hide_bg_portrait" 				=> false,
					//Mobile
					"custom_styles_mobile" 			=> "",
					"customize_bg_mobile"			=> false,
					"bg_position_mobile"			=> "center",
					"bg_size_mobile"				=> "cover",
					"bg_repeat_mobile"				=> "no-repeat",
					"bg_attachment_mobile"			=> "scroll",
					"custom_bg_position_mobile"		=> "",
					"custom_bg_size_mobile"			=> "",
					"hide_bg_mobile" 				=> false,
					/*\ From cws_structure_background_props \*/
					"column_shadow_color"			=> "",
					"animation_load"				=> "none",
					"animation_duration"			=> "1000",
					"animation_delay"				=> "0",
					"timing_function"				=> "ease",
					"custom_timing_function"		=> "",
					"place_ahead"					=> false,
				), $atts ) );

				/* -----> Variables declaration <----- */
				$out = $styles = $offset = $width = "";
				$id = uniqid( "cws_column_" );

				/* -----> Visual Composer Responsive styles <----- */
				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_landscape, $vc_landscape_styles); 
				$vc_landscape_styles = implode($vc_landscape_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_portrait, $vc_portrait_styles); 
				$vc_portrait_styles = implode($vc_portrait_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_mobile, $vc_mobile_styles); 
				$vc_mobile_styles = implode($vc_mobile_styles);

				/* -----> Customize default styles <----- */
				$styles .= "
					#".$id." > .wpb_column > .vc_column-inner{
						background-attachment: ".$bg_attachment." !important;
						background-repeat: ".$bg_repeat." !important;
					}
				";
				if( $bg_size == 'custom' && !empty($custom_bg_size) ){
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-size: ".$custom_bg_size." !important;
						}
					";
				} else if( $bg_size == 'custom' && empty($custom_bg_size) ) {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-size: cover !important;
						}
					";
				} else {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-size: ".$bg_size." !important;
						}
					";
				}
				if( $bg_position == 'custom' && !empty($custom_bg_position) ){
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-position: ".$custom_bg_position." !important;
						}
					";
				} else if( $bg_position == 'custom' && empty($custom_bg_position) ) {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-position: center center !important;
						}
					";
				} else {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-position: ".$bg_position." !important;
						}
					";
				}
				if( !empty($column_shadow_color) ){
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							-webkit-box-shadow: 0px 0px 35px 0px ".esc_attr($column_shadow_color).";
							-moz-box-shadow: 0px 0px 35px 0px ".esc_attr($column_shadow_color).";
							box-shadow: 0px 0px 35px 0px ".esc_attr($column_shadow_color).";
						}
					";
				}
				if( $animation_load != 'none' ){
					if( !empty($animation_duration) ){
						$styles .= "
							#".$id."{
								transition-duration: ".(int)$animation_duration."ms;
							}
						";
					}
					if( !empty($animation_delay) ){
						$styles .= "
							#".$id."{
								transition-delay: ".(int)$animation_delay."ms;
							}
						";
					}
					if( !empty($timing_function) ){
						$styles .= "
							#".$id."{
								transition-timing-function: ".($timing_function != 'custom' ? $timing_function : $custom_timing_function ).";
							}
						";
					}
				}
				/* -----> End of default styles <----- */

				/* -----> Customize landscape styles <----- */
				if(
					!empty($custom_styles_landscape) || 
					$customize_bg_landscape || 
					$hide_bg_landscape 
				){
					$styles .= "
						@media screen and (max-width: 1199px){
					";

						if( !empty($custom_styles_landscape) ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									".$vc_landscape_styles."
								}
							";
						}
						if( $customize_bg_landscape ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-attachment: ".$bg_attachment_landscape." !important;
									background-repeat: ".$bg_repeat_landscape." !important;
								}
							";
							if( $bg_size_landscape == 'custom' && !empty($custom_bg_size_landscape) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$custom_bg_size_landscape." !important;
									}
								";
							} else if( $bg_size_landscape == 'custom' && empty($custom_bg_size_landscape) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$bg_size_landscape." !important;
									}
								";
							}
							if( $bg_position_landscape == 'custom' && !empty($custom_bg_position_landscape) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$custom_bg_position_landscape." !important;
									}
								";
							} else if( $bg_position_landscape == 'custom' && empty($custom_bg_position_landscape) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$bg_position_landscape." !important;
									}
								";
							}
						}
						if( $hide_bg_landscape ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-image: none !important;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of landscape styles <----- */

				/* -----> Customize portrait styles <----- */
				if(
					!empty($custom_styles_portrait) || 
					$customize_bg_portrait || 
					$hide_bg_portrait 
				){
					$styles .= "
						@media screen and (max-width: 991px){
					";

						if( !empty($custom_styles_portrait) ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									".$vc_portrait_styles."
								}
							";
						}
						if( $customize_bg_portrait ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-attachment: ".$bg_attachment_portrait." !important;
									background-repeat: ".$bg_repeat_portrait." !important;
								}
							";
							if( $bg_size_portrait == 'custom' && !empty($custom_bg_size_portrait) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$custom_bg_size_portrait." !important;
									}
								";
							} else if( $bg_size_portrait == 'custom' && empty($custom_bg_size_portrait) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$bg_size_portrait." !important;
									}
								";
							}
							if( $bg_position_portrait == 'custom' && !empty($custom_bg_position_portrait) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$custom_bg_position_portrait." !important;
									}
								";
							} else if( $bg_position_portrait == 'custom' && empty($custom_bg_position_portrait) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$bg_position_portrait." !important;
									}
								";
							}
						}
						if( $hide_bg_portrait ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-image: none !important;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of portrait styles <----- */

				/* -----> Customize mobile styles <----- */
				if(
					!empty($custom_styles_mobile) || 
					$customize_bg_mobile || 
					$hide_bg_mobile || 
					$place_ahead 
				){
					$styles .= "
						@media screen and (max-width: 767px){
					";

						if( !empty($custom_styles_mobile) ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									".$vc_mobile_styles."
								}
							";
						}
						if( $customize_bg_mobile ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-attachment: ".$bg_attachment_mobile." !important;
									background-repeat: ".$bg_repeat_mobile." !important;
								}
							";
							if( $bg_size_mobile == 'custom' && !empty($custom_bg_size_mobile) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$custom_bg_size_mobile." !important;
									}
								";
							} else if( $bg_size_mobile == 'custom' && empty($custom_bg_size_mobile) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$bg_size_mobile." !important;
									}
								";
							}
							if( $bg_position_mobile == 'custom' && !empty($custom_bg_position_mobile) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$custom_bg_position_mobile." !important;
									}
								";
							} else if( $bg_position_mobile == 'custom' && empty($custom_bg_position_mobile) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$bg_position_mobile." !important;
									}
								";
							}
						}
						if( $hide_bg_mobile ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-image: none !important;
								}
							";
						}
						if( $place_ahead ){
							$styles .= "
								#".$id."{
									-ms-flex-order: -1;
									 -webkit-order: -1;
											 order: -1;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of mobile styles <----- */

				/*-----> Get VC_ROW properties <-----*/
				$sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass('vc_column');
				$atts = vc_map_get_attributes( $sc_obj->getShortcode(), $atts );
				extract( $atts );

				$width = wpb_translateColumnWidthToSpan( $width );
				$width = vc_column_offset_class_merge( $offset, $width );

				$animation_classes = '';
				$animation_classes .= $animation_load != 'none' ? $animation_load.' animated' : '';

				/* -----> Custom VC_COLUMN output <----- */
				$out .= '<div class="row_hover_effect"></div>';

				$out .= "<div id='".$id."' class='cws_column_wrapper ".$width." ".$animation_classes."'>";

				cws__vc_styles($styles);

				return $out;
			}
			public static function cws_close_vc_shortcode_column($atts, $content){
				$out = "</div>";
				return $out;
			}
			/*\ -----> End Customize VC_COLUMN <-----\*/


			/* -----> Start Customize VC_ROW_INNER <-----*/
			public static function cws_open_vc_shortcode_row_inner($atts, $content){
				extract( shortcode_atts( array(
					/* From cws_vc_extends.php -> cws_structure_background_props() */
					//Desktop
					"bg_position"					=> "center",
					"bg_size"						=> "cover",
					"bg_repeat"						=> "no-repeat",
					"bg_attachment"					=> "scroll",
					"custom_bg_position"			=> "",
					"custom_bg_size"				=> "",
					"add_shadow"					=> false,
					//Landscape
					"custom_styles_landscape" 		=> "",
					"customize_bg_landscape"		=> false,
					"bg_position_landscape"			=> "center",
					"bg_size_landscape"				=> "cover",
					"bg_repeat_landscape"			=> "no-repeat",
					"bg_attachment_landscape"		=> "scroll",
					"custom_bg_position_landscape"	=> "",
					"custom_bg_size_landscape"		=> "",
					"hide_bg_landscape" 			=> false,
					//Portrait
					"custom_styles_portrait" 		=> "",
					"customize_bg_portrait"			=> false,
					"bg_position_portrait"			=> "center",
					"bg_size_portrait"				=> "cover",
					"bg_repeat_portrait"			=> "no-repeat",
					"bg_attachment_portrait"		=> "scroll",
					"custom_bg_position_portrait"	=> "",
					"custom_bg_size_portrait"		=> "",
					"hide_bg_portrait" 				=> false,
					//Mobile
					"custom_styles_mobile" 			=> "",
					"customize_bg_mobile"			=> false,
					"bg_position_mobile"			=> "center",
					"bg_size_mobile"				=> "cover",
					"bg_repeat_mobile"				=> "no-repeat",
					"bg_attachment_mobile"			=> "scroll",
					"custom_bg_position_mobile"		=> "",
					"custom_bg_size_mobile"			=> "",
					"hide_bg_mobile" 				=> false,
					/*\ From cws_structure_background_props \*/
				), $atts ) );

				/* -----> Variables declaration <----- */
				$out = $styles = "";
				$id = uniqid( "cws_inner_row_" );

				/* -----> Visual Composer Responsive styles <----- */
				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_landscape, $vc_landscape_styles); 
				$vc_landscape_styles = implode($vc_landscape_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_portrait, $vc_portrait_styles); 
				$vc_portrait_styles = implode($vc_portrait_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_mobile, $vc_mobile_styles); 
				$vc_mobile_styles = implode($vc_mobile_styles);

				/* -----> Customize default styles <----- */
				$styles .= "
					#".$id." > .vc_row{
						background-attachment: ".$bg_attachment." !important;
						background-repeat: ".$bg_repeat." !important;
					}
				";
				if( $bg_size == 'custom' && !empty($custom_bg_size) ){
					$styles .= "
						#".$id." > .vc_row{
							background-size: ".$custom_bg_size." !important;
						}
					";
				} else if( $bg_size == 'custom' && empty($custom_bg_size) ) {
					$styles .= "
						#".$id." > .vc_row{
							background-size: cover !important;
						}
					";
				} else {
					$styles .= "
						#".$id." > .vc_row{
							background-size: ".$bg_size." !important;
						}
					";
				}
				if( $bg_position == 'custom' && !empty($custom_bg_position) ){
					$styles .= "
						#".$id." > .vc_row{
							background-position: ".$custom_bg_position." !important;
						}
					";
				} else if( $bg_position == 'custom' && empty($custom_bg_position) ) {
					$styles .= "
						#".$id." > .vc_row{
							background-position: center center !important;
						}
					";
				} else {
					$styles .= "
						#".$id." > .vc_row{
							background-position: ".$bg_position." !important;
						}
					";
				}
				/* -----> End of default styles <----- */

				/* -----> Customize landscape styles <----- */
				if(
					!empty($custom_styles_landscape) || 
					$customize_bg_landscape || 
					$hide_bg_landscape 
				){
					$styles .= "
						@media screen and (max-width: 1199px){
					";

						if( !empty($custom_styles_landscape) ){
							$styles .= "
								#".$id." > .vc_row{
									".$vc_landscape_styles."
								}
							";
						}
						if( $customize_bg_landscape ){
							$styles .= "
								#".$id." > .vc_row{
									background-attachment: ".$bg_attachment_landscape." !important;
									background-repeat: ".$bg_repeat_landscape." !important;
								}
							";
							if( $bg_size_landscape == 'custom' && !empty($custom_bg_size_landscape) ){
								$styles .= "
									#".$id." > .vc_row{
										background-size: ".$custom_bg_size_landscape." !important;
									}
								";
							} else if( $bg_size_landscape == 'custom' && empty($custom_bg_size_landscape) ) {
								$styles .= "
									#".$id." > .vc_row{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .vc_row{
										background-size: ".$bg_size_landscape." !important;
									}
								";
							}
							if( $bg_position_landscape == 'custom' && !empty($custom_bg_position_landscape) ){
								$styles .= "
									#".$id." > .vc_row{
										background-position: ".$custom_bg_position_landscape." !important;
									}
								";
							} else if( $bg_position_landscape == 'custom' && empty($custom_bg_position_landscape) ) {
								$styles .= "
									#".$id." > .vc_row{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .vc_row{
										background-position: ".$bg_position_landscape." !important;
									}
								";
							}
						}
						if( $hide_bg_landscape ){
							$styles .= "
								#".$id." > .vc_row{
									background-image: none !important;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of landscape styles <----- */

				/* -----> Customize portrait styles <----- */
				if(
					!empty($custom_styles_portrait) || 
					$customize_bg_portrait || 
					$hide_bg_portrait 
				){
					$styles .= "
						@media screen and (max-width: 991px){
					";

						if( !empty($custom_styles_portrait) ){
							$styles .= "
								#".$id." > .vc_row{
									".$vc_portrait_styles."
								}
							";
						}
						if( $customize_bg_portrait ){
							$styles .= "
								#".$id." > .vc_row{
									background-attachment: ".$bg_attachment_portrait." !important;
									background-repeat: ".$bg_repeat_portrait." !important;
								}
							";
							if( $bg_size_portrait == 'custom' && !empty($custom_bg_size_portrait) ){
								$styles .= "
									#".$id." > .vc_row{
										background-size: ".$custom_bg_size_portrait." !important;
									}
								";
							} else if( $bg_size_portrait == 'custom' && empty($custom_bg_size_portrait) ) {
								$styles .= "
									#".$id." > .vc_row{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .vc_row{
										background-size: ".$bg_size_portrait." !important;
									}
								";
							}
							if( $bg_position_portrait == 'custom' && !empty($custom_bg_position_portrait) ){
								$styles .= "
									#".$id." > .vc_row{
										background-position: ".$custom_bg_position_portrait." !important;
									}
								";
							} else if( $bg_position_portrait == 'custom' && empty($custom_bg_position_portrait) ) {
								$styles .= "
									#".$id." > .vc_row{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .vc_row{
										background-position: ".$bg_position_portrait." !important;
									}
								";
							}
						}
						if( $hide_bg_portrait ){
							$styles .= "
								#".$id." > .vc_row{
									background-image: none !important;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of portrait styles <----- */

				/* -----> Customize mobile styles <----- */
				if(
					!empty($custom_styles_mobile) || 
					$customize_bg_mobile || 
					$hide_bg_mobile 
				){
					$styles .= "
						@media screen and (max-width: 767px){
					";

						if( !empty($custom_styles_mobile) ){
							$styles .= "
								#".$id." > .vc_row{
									".$vc_mobile_styles."
								}
							";
						}
						if( $customize_bg_mobile ){
							$styles .= "
								#".$id." > .vc_row{
									background-attachment: ".$bg_attachment_mobile." !important;
									background-repeat: ".$bg_repeat_mobile." !important;
								}
							";
							if( $bg_size_mobile == 'custom' && !empty($custom_bg_size_mobile) ){
								$styles .= "
									#".$id." > .vc_row{
										background-size: ".$custom_bg_size_mobile." !important;
									}
								";
							} else if( $bg_size_mobile == 'custom' && empty($custom_bg_size_mobile) ) {
								$styles .= "
									#".$id." > .vc_row{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .vc_row{
										background-size: ".$bg_size_mobile." !important;
									}
								";
							}
							if( $bg_position_mobile == 'custom' && !empty($custom_bg_position_mobile) ){
								$styles .= "
									#".$id." > .vc_row{
										background-position: ".$custom_bg_position_mobile." !important;
									}
								";
							} else if( $bg_position_mobile == 'custom' && empty($custom_bg_position_mobile) ) {
								$styles .= "
									#".$id." > .vc_row{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .vc_row{
										background-position: ".$bg_position_mobile." !important;
									}
								";
							}
						}
						if( $hide_bg_mobile ){
							$styles .= "
								#".$id." > .vc_row{
									background-image: none !important;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of mobile styles <----- */

				/* -----> Custom VC_ROW_INNER output <----- */
				$out = "<div id='".$id."' class='cws_inner_row_wrapper".($add_shadow ? ' shadow' : '')."'>";

				cws__vc_styles($styles);

				return $out;
			}
			public static function cws_close_vc_shortcode_row_inner($atts, $content){
				$out = "</div>";
				return $out;
			}
			/* -----> End Customize VC_ROW_INNER <-----*/


			/* -----> Start Customize VC_COLUMN_INNER <-----*/
			public static function cws_open_vc_shortcode_column_inner($atts, $content){
				extract( shortcode_atts( array(
					/* From cws_vc_extends.php -> cws_structure_background_props() */
					//Desktop
					"bg_position"					=> "center",
					"bg_size"						=> "cover",
					"bg_repeat"						=> "no-repeat",
					"bg_attachment"					=> "scroll",
					"custom_bg_position"			=> "",
					"custom_bg_size"				=> "",
					//Landscape
					"custom_styles_landscape" 		=> "",
					"customize_bg_landscape"		=> false,
					"bg_position_landscape"			=> "center",
					"bg_size_landscape"				=> "cover",
					"bg_repeat_landscape"			=> "no-repeat",
					"bg_attachment_landscape"		=> "scroll",
					"custom_bg_position_landscape"	=> "",
					"custom_bg_size_landscape"		=> "",
					"hide_bg_landscape" 			=> false,
					//Portrait
					"custom_styles_portrait" 		=> "",
					"customize_bg_portrait"			=> false,
					"bg_position_portrait"			=> "center",
					"bg_size_portrait"				=> "cover",
					"bg_repeat_portrait"			=> "no-repeat",
					"bg_attachment_portrait"		=> "scroll",
					"custom_bg_position_portrait"	=> "",
					"custom_bg_size_portrait"		=> "",
					"hide_bg_portrait" 				=> false,
					//Mobile
					"custom_styles_mobile" 			=> "",
					"customize_bg_mobile"			=> false,
					"bg_position_mobile"			=> "center",
					"bg_size_mobile"				=> "cover",
					"bg_repeat_mobile"				=> "no-repeat",
					"bg_attachment_mobile"			=> "scroll",
					"custom_bg_position_mobile"		=> "",
					"custom_bg_size_mobile"			=> "",
					"hide_bg_mobile" 				=> false,
					/*\ From cws_structure_background_props \*/
					"animation_load"				=> "none",
					"animation_duration"			=> "1000",
					"animation_delay"				=> "0",
					"timing_function"				=> "ease",
					"custom_timing_function"		=> "",
					"place_ahead"					=> false,
				), $atts ) );

				/* -----> Variables declaration <----- */
				$out = $styles = $offset = $width = "";
				$id = uniqid( "cws_column_" );

				/* -----> Visual Composer Responsive styles <----- */
				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_landscape, $vc_landscape_styles); 
				$vc_landscape_styles = implode($vc_landscape_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_portrait, $vc_portrait_styles); 
				$vc_portrait_styles = implode($vc_portrait_styles);

				preg_match("/(?<=\{).+?(?=\})/", $custom_styles_mobile, $vc_mobile_styles); 
				$vc_mobile_styles = implode($vc_mobile_styles);

				/* -----> Customize default styles <----- */
				$styles .= "
					#".$id." > .wpb_column > .vc_column-inner{
						background-attachment: ".$bg_attachment." !important;
						background-repeat: ".$bg_repeat." !important;
					}
				";
				if( $bg_size == 'custom' && !empty($custom_bg_size) ){
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-size: ".$custom_bg_size." !important;
						}
					";
				} else if( $bg_size == 'custom' && empty($custom_bg_size) ) {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-size: cover !important;
						}
					";
				} else {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-size: ".$bg_size." !important;
						}
					";
				}
				if( $bg_position == 'custom' && !empty($custom_bg_position) ){
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-position: ".$custom_bg_position." !important;
						}
					";
				} else if( $bg_position == 'custom' && empty($custom_bg_position) ) {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-position: center center !important;
						}
					";
				} else {
					$styles .= "
						#".$id." > .wpb_column > .vc_column-inner{
							background-position: ".$bg_position." !important;
						}
					";
				}
				if( $animation_load != 'none' ){
					if( !empty($animation_duration) ){
						$styles .= "
							#".$id."{
								transition-duration: ".(int)$animation_duration."ms;
							}
						";
					}
					if( !empty($animation_delay) ){
						$styles .= "
							#".$id."{
								transition-delay: ".(int)$animation_delay."ms;
							}
						";
					}
					if( !empty($timing_function) ){
						$styles .= "
							#".$id."{
								transition-timing-function: ".($timing_function != 'custom' ? $timing_function : $custom_timing_function ).";
							}
						";
					}
				}
				/* -----> End of default styles <----- */

				/* -----> Customize landscape styles <----- */
				if(
					!empty($custom_styles_landscape) || 
					$customize_bg_landscape || 
					$hide_bg_landscape 
				){
					$styles .= "
						@media screen and (max-width: 1199px){
					";

						if( !empty($custom_styles_landscape) ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									".$vc_landscape_styles."
								}
							";
						}
						if( $customize_bg_landscape ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-attachment: ".$bg_attachment_landscape." !important;
									background-repeat: ".$bg_repeat_landscape." !important;
								}
							";
							if( $bg_size_landscape == 'custom' && !empty($custom_bg_size_landscape) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$custom_bg_size_landscape." !important;
									}
								";
							} else if( $bg_size_landscape == 'custom' && empty($custom_bg_size_landscape) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$bg_size_landscape." !important;
									}
								";
							}
							if( $bg_position_landscape == 'custom' && !empty($custom_bg_position_landscape) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$custom_bg_position_landscape." !important;
									}
								";
							} else if( $bg_position_landscape == 'custom' && empty($custom_bg_position_landscape) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$bg_position_landscape." !important;
									}
								";
							}
						}
						if( $hide_bg_landscape ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-image: none !important;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of landscape styles <----- */

				/* -----> Customize portrait styles <----- */
				if(
					!empty($custom_styles_portrait) || 
					$customize_bg_portrait || 
					$hide_bg_portrait 
				){
					$styles .= "
						@media screen and (max-width: 991px){
					";

						if( !empty($custom_styles_portrait) ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									".$vc_portrait_styles."
								}
							";
						}
						if( $customize_bg_portrait ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-attachment: ".$bg_attachment_portrait." !important;
									background-repeat: ".$bg_repeat_portrait." !important;
								}
							";
							if( $bg_size_portrait == 'custom' && !empty($custom_bg_size_portrait) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$custom_bg_size_portrait." !important;
									}
								";
							} else if( $bg_size_portrait == 'custom' && empty($custom_bg_size_portrait) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$bg_size_portrait." !important;
									}
								";
							}
							if( $bg_position_portrait == 'custom' && !empty($custom_bg_position_portrait) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$custom_bg_position_portrait." !important;
									}
								";
							} else if( $bg_position_portrait == 'custom' && empty($custom_bg_position_portrait) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$bg_position_portrait." !important;
									}
								";
							}
						}
						if( $hide_bg_portrait ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-image: none !important;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of portrait styles <----- */

				/* -----> Customize mobile styles <----- */
				if(
					!empty($custom_styles_mobile) || 
					$customize_bg_mobile || 
					$hide_bg_mobile || 
					$place_ahead 
				){
					$styles .= "
						@media screen and (max-width: 767px){
					";

						if( !empty($custom_styles_mobile) ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									".$vc_mobile_styles."
								}
							";
						}
						if( $customize_bg_mobile ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-attachment: ".$bg_attachment_mobile." !important;
									background-repeat: ".$bg_repeat_mobile." !important;
								}
							";
							if( $bg_size_mobile == 'custom' && !empty($custom_bg_size_mobile) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$custom_bg_size_mobile." !important;
									}
								";
							} else if( $bg_size_mobile == 'custom' && empty($custom_bg_size_mobile) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: cover !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-size: ".$bg_size_mobile." !important;
									}
								";
							}
							if( $bg_position_mobile == 'custom' && !empty($custom_bg_position_mobile) ){
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$custom_bg_position_mobile." !important;
									}
								";
							} else if( $bg_position_mobile == 'custom' && empty($custom_bg_position_mobile) ) {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: center center !important;
									}
								";
							} else {
								$styles .= "
									#".$id." > .wpb_column > .vc_column-inner{
										background-position: ".$bg_position_mobile." !important;
									}
								";
							}
						}
						if( $hide_bg_mobile ){
							$styles .= "
								#".$id." > .wpb_column > .vc_column-inner{
									background-image: none !important;
								}
							";
						}
						if( $place_ahead ){
							$styles .= "
								#".$id."{
									-ms-flex-order: -1;
									 -webkit-order: -1;
											 order: -1;
								}
							";
						}

					$styles .= "
						}
					";
				}
				/* -----> End of mobile styles <----- */

				/*-----> Get VC_ROW properties <-----*/
				$sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass('vc_column');
				$atts = vc_map_get_attributes( $sc_obj->getShortcode(), $atts );
				extract( $atts );

				$width = wpb_translateColumnWidthToSpan( $width );
				$width = vc_column_offset_class_merge( $offset, $width );

				$animation_classes = '';
				$animation_classes .= $animation_load != 'none' ? $animation_load.' animated' : '';

				/* -----> Custom VC_COLUMN output <----- */
				$out .= "<div id='".$id."' class='cws_column_wrapper ".$width." ".$animation_classes."'>";

				cws__vc_styles($styles);

				return $out;
			}
			public static function cws_close_vc_shortcode_column_inner($atts, $content){
				$out = "</div>";
				return $out;
			}
			/* -----> End Customize VC_COLUMN_INNER <-----*/


			function cws_extra_vc_params(){
				/* -----> STYLING GROUP TITLES <----- */
				$group_name = esc_html__('Design Options', 'promosys');
				$landscape_group = esc_html__('Tablet', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_landscape-tablets'></i>";
				$portrait_group = esc_html__('Tablet', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_portrait-tablets'></i>";
				$mobile_group = esc_html__('Mobile', 'promosys')."&nbsp;&nbsp;&nbsp;<i class='vc-composer-icon vc-c-icon-layout_portrait-smartphones'></i>";

				if( function_exists('vc_add_param') ){
					/*-----> Extra VC_Row Params <-----*/
					cws_structure_background_props('vc_row');
					//VC_Row Overlay Properties
					vc_add_param(
						'vc_row',
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__("Overlay", 'promosys'),
							"param_name"	=> "bg_cws_color",
							"group" 		=> $group_name,
							"value" 		=> array(
								esc_html__("None", 'promosys') => "none",
								esc_html__("Color", 'promosys') => "color",
								esc_html__("Gradient", 'promosys') => "gradient",
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 			=> "colorpicker",
							"heading"		=> esc_html__( 'Color', 'promosys' ),
							"param_name" 	=> "cws_overlay_color",
							"group" 		=> $group_name,
							"dependency"	=> array(
								"element"	=> "bg_cws_color",
								"value" 	=> "color",
							),
							"value"			=> PRIMARY_COLOR
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "colorpicker",
							"heading"			=> esc_html__( 'From', 'promosys' ),
							"param_name" 		=> "cws_gradient_color_from",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-4",
							"dependency"		=> array(
								"element"	=> "bg_cws_color",
								'value' 	=> 'gradient',
							),
							"value"				=> "#000"
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "colorpicker",
							"heading"			=> esc_html__( 'To', 'promosys' ),
							"param_name" 		=> "cws_gradient_color_to",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-4",
							"dependency"		=> array(
								"element"	=> "bg_cws_color",
								'value' 	=> 'gradient',
							),
							"value"			=> "#fff"
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type"				=> "textfield",
							"heading"			=> esc_html__( 'Opacity', 'promosys' ),
							"param_name"		=> "cws_gradient_opacity",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-4",
							"description"		=> esc_html__( '100 - visible, 0 - invisible', 'promosys' ),
							"dependency"		=> array(
								"element"	=> "bg_cws_color",
								'value' 	=> 'gradient',						
							),
							"value" 			=> '50',
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Type", 'promosys'),
							"param_name"		=> "cws_gradient_type",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							"dependency"		=> array(
								"element"	=> "bg_cws_color",
								'value' 	=> 'gradient',
							),
							"value" 			=> array(
								esc_html__("Linear", 'promosys') => "linear",
								esc_html__("Radial", 'promosys') => "radial",
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type"				=> "textfield",
							"heading"			=> esc_html__( 'Angle', 'promosys' ),
							"param_name"		=> "cws_gradient_angle",
							"value" 			=> '45',
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							"description"		=> esc_html__( 'Degrees: -360 to 360', 'promosys' ),
							"dependency"		=> array(
								"element"	=> "cws_gradient_type",
								'value' 	=> 'linear',						
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Shape variant", 'promosys'),
							"param_name"		=> "cws_gradient_shape_variant_type",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							"dependency"		=> array(
								"element"	=> "cws_gradient_type",
								'value' 	=> 'radial',	
							),
							"value" 			=> array(
								esc_html__("Simple", 'promosys') => "simple",
								esc_html__("Extended", 'promosys') => "extended",
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Shape", 'promosys'),
							"param_name"		=> "cws_gradient_shape_type",
							"group" 			=> $group_name,
							"dependency"		=> array(
								"element"	=> "cws_gradient_shape_variant_type",
								'value' 	=> 'simple',	
							),
							"value" 			=> array(
								esc_html__("Ellipse", 'promosys') => "ellipse",
								esc_html__("Circle", 'promosys') => "circle",
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading"			=> esc_html__("Size keyword", 'promosys'),
							"param_name"		=> "cws_gradient_size_keyword_type",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							"dependency"	=> array(
								"element"	=> "cws_gradient_shape_variant_type",
								'value' => 'extended',	
							),
							"value" => array(
								esc_html__("Closest side", 'promosys') => "closest-side",
								esc_html__("Farthest side", 'promosys') => "farthest-side",
								esc_html__("Closest corner", 'promosys') => "closest-corner",
								esc_html__("Farthest corner", 'promosys') => "farthest-corner",
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Size", 'promosys'),
							"param_name"		=> "cws_gradient_size_type",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							"description"		=> esc_html__( 'Two space separated percent values, for example (60% 55%)', 'promosys' ),
							"dependency"		=> array(
								"element"	=> "cws_gradient_shape_variant_type",
								'value' 	=> 'extended',	
							),
							"value" 			=> '60% 55%',
						)
					);

					//VC_Row Extra Layer Properties
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "checkbox",
							"param_name"		=> "add_layers",
							"group" 			=> $group_name,						
							"value"				=> array( esc_html__( 'Add Layer', 'promosys' ) => true )
						)
					);					
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "attach_image",
							"heading" 			=> esc_html__("Layer", 'promosys'),
							"param_name"		=> "cws_layer_image",
							"group" 			=> $group_name,
							"dependency"		=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							'type' 				=> 'dropdown',
							'heading' 			=> esc_html__( 'Layer position', 'promosys' ),
							'param_name' 		=> 'extra_layer_pos',
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							'dependency' 		=> array(
								'element' 	=> 'add_layers',
								'not_empty' => true,
							),
							'value' 			=> array(
								__( 'Left', 'promosys' ) => 'left',
								__( 'Right', 'promosys' ) => 'right',
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							'type' 				=> 'textfield',
							'heading' 			=> __( 'Layer width', 'promosys' ),
							'param_name' 		=> 'extra_layer_width',
							"group" 			=> $group_name,
							'description' 		=> __( 'In percents', 'promosys' ),
							"edit_field_class" 	=> "vc_col-xs-6",
							'dependency' 		=> array(
								'element' 	=> 'add_layers',
								'not_empty' => true,
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Layer Image Size", 'promosys'),
							"param_name" 		=> "extra_layer_size",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-4",
							"dependency"	=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value" => array(
								esc_html__("Initial", 'promosys') => "initial",
								esc_html__("Cover", 'promosys') => "cover",
								esc_html__("Contain", 'promosys') => "contain",
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Layer Image Position", 'promosys'),
							"param_name" 		=> "extra_layer_position",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-4",
							"dependency"		=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value" 			=> array(
								esc_html__("Left Top", 'promosys') => "left top",
								esc_html__("Left Center", 'promosys') => "left center",
								esc_html__("Left Bottom", 'promosys') => "left bottom",
								esc_html__("Right Top", 'promosys') => "right top",
								esc_html__("Right Center", 'promosys') => "right center",
								esc_html__("Right Bottom", 'promosys') => "right bottom",
								esc_html__("Center Top", 'promosys') => "center top",
								esc_html__("Center Center", 'promosys') => "center center",
								esc_html__("Center Bottom", 'promosys') => "center bottom",
							),	
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Layer Image Position", 'promosys'),
							"param_name" 		=> "extra_layer_repeat",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-4",
							"dependency"		=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value" 			=> array(
								esc_html__("No Repeat", 'promosys') => "no-repeat",
								esc_html__("Repeat", 'promosys') => "repeat",
								esc_html__("Repeat X", 'promosys') => "repeat-x",
								esc_html__("Repeat Y", 'promosys') => "repeat-y",
							),	
						)
					);			
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "colorpicker",
							"heading" 			=> esc_html__("Layer Background Color", 'promosys'),
							"param_name" 		=> "extra_layer_bg",
							"group" 			=> $group_name,
							"dependency"		=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value"				=> '',
						)
					);		
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Layer Margin", 'promosys'),
							"param_name" 		=> "extra_layer_margin",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							"description"		=> esc_html__( '1, 2( top/bottom, left/right ) or 4, space separated, values with units', 'promosys' ),
							"dependency"		=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value" => "0px 0px",
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Layer Opacity", 'promosys'),
							"param_name" 		=> "extra_layer_opacity",
							"group" 			=> $group_name,
							"edit_field_class" 	=> "vc_col-xs-6",
							"description"		=> esc_html__( '100 = Visible, 0 = Transparent', 'promosys' ),
							"dependency"		=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value" => "100",
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type"			=> "checkbox",
							"param_name"	=> "hide_layer_landscape",
							"group"			=> $landscape_group,
							"dependency"	=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value"			=> array( esc_html__( 'Hide Layer', 'promosys' ) => true )
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type"			=> "checkbox",
							"param_name"	=> "hide_layer_portrait",
							"group"			=> $portrait_group,
							"dependency"	=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value"			=> array( esc_html__( 'Hide Layer', 'promosys' ) => true )
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type"			=> "checkbox",
							"param_name"	=> "hide_layer_mobile",
							"group"			=> $mobile_group,
							"dependency"	=> array(
								"element"	=> "add_layers",
								"not_empty"	=> true
							),
							"value"			=> array( esc_html__( 'Hide Layer', 'promosys' ) => true )
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "checkbox",
							"param_name" 		=> "add_shadow",
							"group" 			=> $group_name,
							"value" 			=> array( esc_html__( 'Add Shadow', 'promosys' ) => true )
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "colorpicker",
							"heading" 			=> esc_html__("Shadow Color", 'promosys'),
							"param_name" 		=> "shadow_color",
							"dependency"		=> array(
								"element"	=> "add_shadow",
								"not_empty"	=> true
							),
							"group" 			=> $group_name,
							"value" 			=> "rgba(0,0,0, .15)",
						)
					);
                    vc_add_param(
                        'vc_row',
                        array(
                            "type"			=> "checkbox",
                            "param_name"	=> "particles",
                            "group" 		=> $group_name,
                            "value"			=> array( esc_html__( 'Add particles', 'promosys' ) => true )
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Area Width (with unit)", 'promosys'),
                            "param_name" 		=> "particles_width",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "300px",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Area Height (with unit)", 'promosys'),
                            "param_name" 		=> "particles_height",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "300px",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Hide Particles on Choosen Resolution", 'promosys'),
                            "param_name" 		=> "particles_hide",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "767",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Particles Left Offset (with unit)", 'promosys'),
                            "param_name" 		=> "particles_left",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Particles Top Offset (with unit)", 'promosys'),
                            "param_name" 		=> "particles_top",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "dropdown",
                            "heading" 			=> esc_html__("Particles Start Pos", 'promosys'),
                            "param_name" 		=> "particles_start",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"		=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array(
                                esc_html__("Top Left", 'promosys') => "top_left",
                                esc_html__("Top Center", 'promosys') => "top_center",
                                esc_html__("Top Right", 'promosys') => "top_right",
                                esc_html__("Right Center", 'promosys') => "right_center",
                                esc_html__("Bottom Right", 'promosys') => "bottom_right",
                                esc_html__("Bottom Center", 'promosys') => "bottom_center",
                                esc_html__("Bottom Left", 'promosys') => "bottom_left",
                                esc_html__("Left Center", 'promosys') => "left_center",
                            ),
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Particles Speed (0 to 10)", 'promosys'),
                            "param_name" 		=> "particles_speed",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "2",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Particles Size", 'promosys'),
                            "param_name" 		=> "particles_size",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "10",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "textfield",
                            "heading" 			=> esc_html__("Particles Count (1 to 500)", 'promosys'),
                            "param_name" 		=> "particles_count",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> "25",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "dropdown",
                            "heading" 			=> esc_html__("Particles Shape", 'promosys'),
                            "param_name" 		=> "particles_shape",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"		=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array(
                                esc_html__("Circle", 'promosys') 	=> "circle",
                                esc_html__("Square", 'promosys') 	=> "edge",
                                esc_html__("Hexagon", 'promosys') 	=> "polygon",
                                esc_html__("Image", 'promosys') 	=> "image",
                            ),
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "dropdown",
                            "heading" 			=> esc_html__("Particles Mode", 'promosys'),
                            "param_name" 		=> "particles_mode",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"		=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array(
                                esc_html__("Out", 'promosys') 		=> "out",
                                esc_html__("Bounce", 'promosys') 	=> "bounce",
                            ),
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "dropdown",
                            "heading" 			=> esc_html__("Particles Move", 'promosys'),
                            "param_name" 		=> "particles_direction",
                            "edit_field_class" 	=> "vc_col-xs-4",
                            "dependency"		=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array(
                                esc_html__("Random", 'promosys') 	=> "none",
                                esc_html__("Left", 'promosys') 		=> "left",
                                esc_html__("Right", 'promosys') 	=> "right",
                                esc_html__("Top", 'promosys') 		=> "top",
                                esc_html__("Bottom", 'promosys') 	=> "bottom",
                            ),
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "checkbox",
                            "param_name" 		=> "particles_straight",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array( esc_html__( 'Particles Move Straight', 'promosys' ) => true )
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "checkbox",
                            "param_name" 		=> "particles_random_size",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array( esc_html__( 'Particles Random Size', 'promosys' ) => true )
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "checkbox",
                            "param_name" 		=> "particles_random_opacity",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array( esc_html__( 'Particles Random Opacity', 'promosys' ) => true )
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "checkbox",
                            "param_name" 		=> "particles_linked",
                            "dependency"	=> array(
                                "element"	=> "particles",
                                "not_empty"	=> true
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> array( esc_html__( 'Particles Linked', 'promosys' ) => true )
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            'type' 			=> 'param_group',
                            'heading' 		=> esc_html_x( 'Particle Images', 'backend', 'promosys' ),
                            "description"	=> esc_html_x( 'Please use only square images and don`t use more than 4 images', 'backend', 'promosys' ),
                            'param_name' 	=> 'particle_images',
                            "group" 		=> $group_name,
                            "dependency"	=> array(
                                "element"		=> "particles_shape",
                                "value"			=> "image"
                            ),
                            'params' 		=> array(
                                array(
                                    "type"			=> "attach_image",
                                    "heading"		=> esc_html_x( 'Image', 'backend', 'promosys' ),
                                    "param_name"	=> "particle_image",
                                )
                            ),
                            "value"			=> "",
                        )
                    );
                    vc_add_param(
                        'vc_row',
                        array(
                            "type" 				=> "colorpicker",
                            "heading" 			=> esc_html__("Particles Color (#HEX Only!)", 'promosys'),
                            "param_name" 		=> "particles_color",
                            "dependency"		=> array(
                                "element"	=> "particles_shape",
                                "value"		=> array( "circle", "edge", "polygon" )
                            ),
                            "group" 			=> $group_name,
                            "value" 			=> PRIMARY_COLOR,
                        )
                    );
					vc_add_param(
						'vc_row',
						array(
							"type"				=> "checkbox",
							"param_name"		=> "add_mask",
							"group" 			=> $group_name,
							"description"		=> esc_html__( 'Mask usage is not recommended when particles or layers enabled.', 'promosys' ),
							"value"				=> array( esc_html__( 'Add SVG Mask', 'promosys' ) => true )
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type"				=> "attach_image",
							"heading"			=> esc_html__( 'Image', 'promosys' ),
							"param_name"		=> "mask_image",
							"edit_field_class" 	=> "vc_col-xs-4",
							"group" 			=> $group_name,
							"dependency"		=> array(
								"element"	=> "add_mask",
								"not_empty"	=> true
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Mask Start Pos", 'promosys'),
							"param_name" 		=> "mask_start",
							"edit_field_class" 	=> "vc_col-xs-4",
							"dependency"		=> array(
								"element"	=> "add_mask",
								"not_empty"	=> true
							),
							"group" 			=> $group_name,
							"value" 			=> array(
								esc_html__("Top Left", 'promosys') 		=> "top_left",
								esc_html__("Top Center", 'promosys') 		=> "top_center",
								esc_html__("Top Right", 'promosys') 		=> "top_right",
								esc_html__("Right Center", 'promosys') 	=> "right_center",
								esc_html__("Bottom Right", 'promosys') 	=> "bottom_right",
								esc_html__("Bottom Center", 'promosys')	=> "bottom_center",
								esc_html__("Bottom Left", 'promosys') 		=> "bottom_left",
								esc_html__("Left Center", 'promosys') 		=> "left_center",
							),
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type"				=> "checkbox",
							"param_name"		=> "overflow_hidden",
							"group" 			=> $group_name,
							"value"				=> array( esc_html__( 'Overflow hidden', 'promosys' ) => true )
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Row Z-Index", 'promosys'),
							"param_name" 		=> "z_index",
							"edit_field_class" 	=> "vc_col-xs-6",
							"group" 			=> $group_name,
							"value" 			=> "",
						)
					);
					vc_add_param(
						'vc_row',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Row Bottom Shift", 'promosys'),
							"param_name" 		=> "shift",
							"edit_field_class" 	=> "vc_col-xs-6",
							"group" 			=> $group_name,
							"value" 			=> "",
						)
					);

					/*-----> Extra VC_Column Params <-----*/
					cws_structure_background_props('vc_column');
					vc_add_param(
						'vc_column',
						array(
							"type" 			=> "colorpicker",
							"heading"		=> esc_html__( 'Shadow Color', 'promosys' ),
							"param_name" 	=> "column_shadow_color",
							"group" 		=> $group_name,
							"value"			=> ""
						)
					);
					vc_add_param(
						'vc_column',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Animate on load", 'promosys'),
							"param_name"		=> "animation_load",
							"group" 			=> $group_name,
							"value" 			=> array(
								esc_html__("None", 'promosys') 				=> "none",
								esc_html__("Fade From Left", 'promosys') 		=> "fade_left",
								esc_html__("Fade From Right", 'promosys') 	=> "fade_right",
								esc_html__("Fade From Bottom", 'promosys') 	=> "fade_bottom",
								esc_html__("Slide From Left", 'promosys') 	=> "grow_left",
								esc_html__("Slide From Right", 'promosys') 	=> "grow_right",
								esc_html__("Slide From Bottom", 'promosys') 	=> "grow_bottom",
							),
						)
					);
					vc_add_param(
						'vc_column',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Duration", 'promosys'),
							"param_name"		=> "animation_duration",
							"edit_field_class" 	=> "vc_col-xs-4",
							"group" 			=> $group_name,
							"description"	=> esc_html__( 'In milliseconds', 'promosys' ),
							"dependency"	=> array(
								"element"	=> "animation_load",
								"value" 	=> array( 'fade_left', 'fade_right', 'fade_bottom', 'grow_left', 'grow_right', 'grow_bottom' ),
							),
							"value" 			=> "1000"
						)
					);
					vc_add_param(
						'vc_column',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Delay", 'promosys'),
							"param_name"		=> "animation_delay",
							"edit_field_class" 	=> "vc_col-xs-4",
							"group" 			=> $group_name,
							"description"	=> esc_html__( 'In milliseconds', 'promosys' ),
							"dependency"	=> array(
								"element"	=> "animation_load",
								"value" 	=> array( 'fade_left', 'fade_right', 'fade_bottom', 'grow_left', 'grow_right', 'grow_bottom' ),
							),
							"value" 			=> "0"
						)
					);
					vc_add_param(
						'vc_column',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Timing Function", 'promosys'),
							"param_name"		=> "timing_function",
							"edit_field_class" 	=> "vc_col-xs-4",
							"group" 			=> $group_name,
							"dependency"	=> array(
								"element"	=> "animation_load",
								"value" 	=> array( 'fade_left', 'fade_right', 'fade_bottom', 'grow_left', 'grow_right', 'grow_bottom' ),
							),
							"value" 			=> array(
								esc_html__("Ease", 'promosys') 						=> "ease",
								esc_html__("Preconfigured Cubic-Bezier", 'promosys') 	=> "cubic-bezier(.35,.71,.26,.88)",
								esc_html__("Ease in Out", 'promosys') 					=> "ease-in-out",
								esc_html__("Linear", 'promosys') 						=> "linear",
								esc_html__("Custom", 'promosys') 						=> "custom",
							),
						)
					);
					vc_add_param(
						'vc_column',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Custom Timing Function", 'promosys'),
							"param_name"		=> "custom_timing_function",
							"group" 			=> $group_name,
							"description"	=> esc_html__( 'Enter transition timing function', 'promosys' ),
							"dependency"	=> array(
								"element"	=> "timing_function",
								"value" 	=> array( 'custom' ),
							),
							"value" 			=> ""
						)
					);
					vc_add_param(
						'vc_column',
						array(
							"type" 			=> "checkbox",
							"param_name" 	=> "place_ahead",
							"group" 		=> $mobile_group,
							"description"	=> esc_html__( 'If this column have`t content, use "padding-top" or "padding-bottom" properties for set the column height', 'promosys' ),
							"value"			=> array( esc_html__( 'Put this column on first place', 'promosys' ) => true )
						)
					);

					/*-----> Extra VC_Inner-Row Params <-----*/
					cws_structure_background_props('vc_row_inner');
					vc_add_param(
						'vc_row_inner',
						array(
							"type" 			=> "checkbox",
							"param_name" 	=> "add_shadow",
							"group" 		=> esc_html__('Design Options', 'promosys'),
							"value"			=> array( esc_html__( 'Add Shadow', 'promosys' ) => true )
						)
					);

					/*-----> Extra VC_Inner-Column Params <-----*/
					cws_structure_background_props('vc_column_inner');
					vc_add_param(
						'vc_column_inner',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Animate on load", 'promosys'),
							"param_name"		=> "animation_load",
							"group" 			=> $group_name,
							"value" 			=> array(
								esc_html__("None", 'promosys') 				=> "none",
								esc_html__("Fade From Left", 'promosys') 		=> "fade_left",
								esc_html__("Fade From Right", 'promosys') 	=> "fade_right",
								esc_html__("Fade From Bottom", 'promosys') 	=> "fade_bottom",
								esc_html__("Slide From Left", 'promosys') 	=> "grow_left",
								esc_html__("Slide From Right", 'promosys') 	=> "grow_right",
								esc_html__("Slide From Bottom", 'promosys') 	=> "grow_bottom",
							),
						)
					);
					vc_add_param(
						'vc_column_inner',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Duration", 'promosys'),
							"param_name"		=> "animation_duration",
							"edit_field_class" 	=> "vc_col-xs-4",
							"group" 			=> $group_name,
							"description"	=> esc_html__( 'In milliseconds', 'promosys' ),
							"dependency"	=> array(
								"element"	=> "animation_load",
								"value" 	=> array( 'fade_left', 'fade_right', 'fade_bottom', 'grow_left', 'grow_right', 'grow_bottom' ),
							),
							"value" 			=> "1000"
						)
					);
					vc_add_param(
						'vc_column_inner',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Delay", 'promosys'),
							"param_name"		=> "animation_delay",
							"edit_field_class" 	=> "vc_col-xs-4",
							"group" 			=> $group_name,
							"description"	=> esc_html__( 'In milliseconds', 'promosys' ),
							"dependency"	=> array(
								"element"	=> "animation_load",
								"value" 	=> array( 'fade_left', 'fade_right', 'fade_bottom', 'grow_left', 'grow_right', 'grow_bottom' ),
							),
							"value" 			=> "0"
						)
					);
					vc_add_param(
						'vc_column_inner',
						array(
							"type" 				=> "dropdown",
							"heading" 			=> esc_html__("Timing Function", 'promosys'),
							"param_name"		=> "timing_function",
							"edit_field_class" 	=> "vc_col-xs-4",
							"group" 			=> $group_name,
							"dependency"	=> array(
								"element"	=> "animation_load",
								"value" 	=> array( 'fade_left', 'fade_right', 'fade_bottom', 'grow_left', 'grow_right', 'grow_bottom' ),
							),
							"value" 			=> array(
								esc_html__("Ease", 'promosys') 						=> "ease",
								esc_html__("Preconfigured Cubic-Bezier", 'promosys') 	=> "cubic-bezier(.35,.71,.26,.88)",
								esc_html__("Ease in Out", 'promosys') 					=> "ease-in-out",
								esc_html__("Linear", 'promosys') 						=> "linear",
								esc_html__("Custom", 'promosys') 						=> "custom",
							),
						)
					);
					vc_add_param(
						'vc_column_inner',
						array(
							"type" 				=> "textfield",
							"heading" 			=> esc_html__("Custom Timing Function", 'promosys'),
							"param_name"		=> "custom_timing_function",
							"group" 			=> $group_name,
							"description"	=> esc_html__( 'Enter transition timing function', 'promosys' ),
							"dependency"	=> array(
								"element"	=> "timing_function",
								"value" 	=> array( 'custom' ),
							),
							"value" 			=> ""
						)
					);
					vc_add_param(
						'vc_column_inner',
						array(
							"type" 			=> "checkbox",
							"param_name" 	=> "place_ahead",
							"group" 		=> $mobile_group,
							"description"	=> esc_html__( 'If this column have`t content, use "padding-top" or "padding-bottom" properties for set the column height', 'promosys' ),
							"value"			=> array( esc_html__( 'Put this column on first place', 'promosys' ) => true )
						)
					);
				}
			} 
		}
		new VC_CWS_Background;
	}

	// VC_ROW hook
	if ( !function_exists( 'vc_theme_before_vc_row' ) ) {
		function vc_theme_before_vc_row($atts, $content = null) {
			$GLOBALS['cws_row_atts'] = $atts;
			return VC_CWS_Background::cws_open_vc_shortcode($atts, $content);
		}
	}
	if ( !function_exists( 'vc_theme_after_vc_row' ) ) {
		function vc_theme_after_vc_row($atts, $content = null) {
			unset($GLOBALS['cws_row_atts']);
			return VC_CWS_Background::cws_close_vc_shortcode($atts, $content);
		}
	}

	// VC_COLUMN hook
	if ( !function_exists( 'vc_theme_before_vc_column' ) ) {
		function vc_theme_before_vc_column($atts, $content = null) {
			new VC_CWS_Background();
			return VC_CWS_Background::cws_open_vc_shortcode_column($atts, $content);
		}
	}
	if ( !function_exists( 'vc_theme_after_vc_column' ) ) {
		function vc_theme_after_vc_column($atts, $content = null) {
			new VC_CWS_Background();
			return VC_CWS_Background::cws_close_vc_shortcode_column($atts, $content);
		}
	}

	// VC_ROW_INNER hook
	if ( !function_exists( 'vc_theme_before_vc_row_inner' ) ){
		function vc_theme_before_vc_row_inner($atts, $content = null) {
			new VC_CWS_Background();
			return VC_CWS_Background::cws_open_vc_shortcode_row_inner($atts, $content);
		}
	}
	if ( !function_exists( 'vc_theme_after_vc_row_inner' ) ){
		function vc_theme_after_vc_row_inner($atts, $content = null) {
			new VC_CWS_Background();
			return VC_CWS_Background::cws_close_vc_shortcode_row_inner($atts, $content);
		}
	}

	// VC_COLUMN_INNER hook
	if ( !function_exists( 'vc_theme_before_vc_column_inner' ) ) {
		function vc_theme_before_vc_column_inner($atts, $content = null) {
			new VC_CWS_Background();
			return VC_CWS_Background::cws_open_vc_shortcode_column_inner($atts, $content);
		}
	}
	if ( !function_exists( 'vc_theme_after_vc_column_inner' ) ) {
		function vc_theme_after_vc_column_inner($atts, $content = null) {
			new VC_CWS_Background();
			return VC_CWS_Background::cws_close_vc_shortcode_column_inner($atts, $content);
		}
	}
	
?>