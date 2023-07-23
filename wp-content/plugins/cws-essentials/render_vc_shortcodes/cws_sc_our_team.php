<?php

function cws_vc_shortcode_sc_our_team ( $atts = array(), $content = "" ){
	$team_hide_meta = get_theme_mod('cws_staff_hide_meta') ? get_theme_mod('cws_staff_hide_meta') : array();

	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"tax"							=> "",
		"orderby"						=> get_theme_mod('cws_staff_order_by'),
		"order"							=> get_theme_mod('cws_staff_order'),
		"image_layout"                  => 'special',
		"columns"						=> get_theme_mod('cws_staff_columns'),
		"total_items_count"				=> "-1",
		"items_pp"						=> get_theme_mod('cws_staff_items_pp'),
		"thumb_size"					=> "full",
		"chars_count"					=> "98",
		"carousel"						=> false,
		"hide_meta"						=> true,
		"team_hide_meta"				=> implode(',', (array)$team_hide_meta),
		"button_title"                  => esc_html_x( 'Read More', 'backend', 'cws-essentials' ),
		"el_class"						=> "",
		
		/* -----> STYLING TAB <----- */
        "customize_colors"              => false,
		"title_color"					=> '#243238',
		"text_color"					=> '',
		"accent_color"					=> SECONDARY_COLOR,
		"socials_color"					=> PRIMARY_COLOR,
		"meta_color"				    => '',
		"divider_color"				    => '#ff0000',
		"gradient_start"				=> '#81D3E4',
		"gradient_finish"				=> '#6076FA',
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
	$count = 1;
	$total_items_count = $total_items_count == '-1' ? 999 : $total_items_count;
	$terms_temp = $all_terms = array();
	$team_hide_meta = $hide_meta == false ? '' : $team_hide_meta;
	$terms = isset( $atts[ $tax . "_terms" ] ) ? $atts[ $tax . "_terms" ] : "";
	$id = uniqid( "cws_our_team_" );

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
				".$vc_desktop_styles."
			}
		";
	}
	
	if ( !empty($customize_colors) ) {
        if( !empty($title_color) ){
            $styles .= "
                #".$id." .cws_team_member .information_wrapper h4,
                #".$id." .cws_team_member .information_wrapper .name a,
                #".$id." .cws_team_member .information_wrapper .email,
                #".$id." .cws_team_member .information_wrapper .email a,
                #".$id." .cws_team_member .information_wrapper .phone,
                #".$id." .cws_team_member .information_wrapper .phone a,
                #".$id." .cws_team_member .information_wrapper .experience strong{
                    color: ".$title_color.";
                }
            ";
        }
        if( !empty($text_color) ){
            $styles .= "
                #".$id." .cws_team_member .information_wrapper{
                    color: ".$text_color.";
                }
            ";
        }
        if( !empty($divider_color) ){
            $styles .= "
                #".$id." .cws_team_member .information_wrapper > div .divider{
                    background-color: ".$divider_color.";
                }
            ";
        }
        if( !empty($accent_color) ){
            $styles .= "
                #".$id." .cws_team_member .information_wrapper .cws_button_wrapper .cws_button{
                    border-color: ".$accent_color.";
                }
                #".$id." .cws_team_member .information_wrapper .cws_button_wrapper .cws_button{
                    background-color: ".$accent_color.";
                }
            ";
        }
        if( !empty($socials_color) ){
            $styles .= "
                #".$id." .cws_team_member .information_wrapper .socials .social-icons li a{
                    color: ".$socials_color.";
                }
            ";
        }
        if( !empty($border_color) ){
            $styles .= "
                #".$id." .cws_team_member .information_wrapper,
                #".$id." .cws_team_member .information_wrapper .cws_button_wrapper:not(:first-child){
                    border-color: ".$border_color.";
                }
            ";
        }
        if( !empty($meta_color) ){
            $styles .= "
                #".$id." .cws_team_member .information_wrapper .meta,
                #".$id." .cws_team_member .information_wrapper .meta a{
                    color: ".$meta_color.";
                }
            ";
        }
        if( !empty($gradient_start) || !empty($gradient_finish) ){
            $styles .= "
                #".$id.".image_layout_triangle .cws_team_member .image_wrapper_bg,
                #".$id.".image_layout_special .cws_team_member .image_wrapper_bg{";
            if ( !empty($gradient_start) && empty($gradient_finish) ){
                $styles .= "background: ".esc_attr($gradient_start).";";
            }
            if ( empty($gradient_start) && !empty($gradient_finish) ){
                $styles .= "background: ".esc_attr($gradient_finish).";";
            }
            if ( !empty($gradient_start) && !empty($gradient_finish) ){
                $styles .= "background: linear-gradient(45.67deg, ".esc_attr($gradient_start)." 24.97%, ".esc_attr($gradient_finish)." 84.78%);";
            }
            $styles .= "}";
        }
        
        if( !empty($accent_color) ){
            $styles .= "
                @media
                    screen and (min-width: 1367px),
                    screen and (min-width: 1200px) and (any-hover: hover),
                    screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
                    screen and (min-width: 1200px) and (-ms-high-contrast: none),
                    screen and (min-width: 1200px) and (-ms-high-contrast: active)
                {
            ";
    
            if( !empty($accent_color) ){
                $styles .= "
                    #".$id." .cws_team_member .information_wrapper h4 a:hover,
                    #".$id." .cws_team_member .information_wrapper .email a:hover,
                    #".$id." .cws_team_member .information_wrapper .phone a:hover,
                    #".$id." .cws_team_member .information_wrapper .socials .social-icons li a:hover,
                    #".$id." .cws_team_member .information_wrapper .cws_button_wrapper .cws_button:hover{
                        color: ".$accent_color.";
                    }
                ";
            }
            
            $styles .= "
                }
            ";
        }
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

	/* -----> Formating Filter By Query <----- */
	$terms = explode(",", $terms);

	foreach( $terms as $term ){
		if( !empty($term) ) $terms_temp[] = $term;
	}

	$all_terms_temp = !empty($tax) ? get_terms($tax) : array();
	$all_terms_temp = !is_wp_error($all_terms_temp) ? $all_terms_temp : array();

	foreach( $all_terms_temp as $term ){
		$all_terms[] = $term->slug;
	}

	$terms = !empty($terms_temp) ? $terms_temp : $all_terms;

	/* -----> Formating Main Query <----- */
	$query_atts = array(
		'post_type'			=> 'cws_staff',
		'post_status'		=> 'publish',
		'orderby'			=> $orderby,
		'order'				=> $order,
	);

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

	if( !$carousel ){
		$query_atts['paged'] = $paged;
		$query_atts['posts_per_page'] = $items_pp;
	} else {
		$query_atts['nopaging']	= true;
		$query_atts['posts_per_page'] = -1;
	}

	if( !empty($terms) && $tax != 'title' ){
		$query_atts['tax_query'] = array(
			array(
				'taxonomy'		=> $tax,
				'field'			=> 'slug',
				'terms'			=> $terms
			)
		);
	} else if( !empty($tax) && $tax == 'title' ){
		$query_atts['post__in'] = explode(',', $atts['titles']);
	}

	$q = new WP_Query( $query_atts );

	$found_posts = $q->found_posts;

	$requested_posts = $found_posts > $total_items_count ? $total_items_count : $found_posts;
	$max_paged = $found_posts > $total_items_count ? ceil( $total_items_count / $items_pp ) : ceil( $found_posts / $items_pp );

	/* -----> Our Team module output <----- */
	$module_classes = "cws_our_team_module";
	$module_classes .= $carousel ? " cws_carousel_wrapper" : " columns_".$columns;
    $module_classes .= !empty($image_layout) ? " image_layout_" . esc_attr($image_layout) : "";
	$module_classes .= !empty($el_class) ? " ".esc_attr($el_class) : '';

	$module_atts = "";
	if( $carousel ){
		$module_atts .= " data-pagination='on'";
		$module_atts .= " data-columns='".$columns."'";
		$module_atts .= " data-draggable='on'";
		$module_atts .= " data-tablet-portrait='2'";
	}

	if( $q->have_posts() ):
		ob_start();

			echo "<div id='".$id."' class='".$module_classes."' ".$module_atts.">";

				echo $carousel ? "<div class='cws_carousel'>" : "";

				while( $q->have_posts() && $count <= $total_items_count ) : $q->the_post();

					$position = cws_get_taxonomy_links('cws_staff_member_position', ', ');
					$department = cws_get_taxonomy_links('cws_staff_member_department', ', ');
					$experience = cws_get_metabox('staff_experience');
					$email = cws_get_metabox('staff_email');
					$phone = cws_get_metabox('staff_phone');
					$biography = cws_get_metabox('staff_biography');
					$socials = (array)json_decode(cws_get_metabox('staff_socials'));

					echo "<div class='cws_team_member'>";
                        if( strripos($team_hide_meta, 'photo') === false ) {
                            echo "<div class='image_wrapper'>";
                                echo "<div class='image_wrapper_bg'></div>";
                                echo "<div class='image_wrapper_inner'>";
                                    echo "<a href='" . get_permalink() . "'>";
                                        the_post_thumbnail($thumb_size);
                                    echo "</a>";
                                echo "</div>";
                            echo "</div>";
                        }

						echo "<div class='information_wrapper'>";
						
							if( strripos($team_hide_meta, 'name') === false ){
								echo "<h5 class='name'>";
								    echo "<a href='".get_permalink()."'>";
									    the_title();
								    echo "</a>";
								echo "</h5>";
							}
                    
                            if ( ( !empty($position) && strripos($team_hide_meta, 'position') === false ) || ( !empty($department) && strripos($team_hide_meta, 'department') === false ) ){
                                echo "<div class='meta'>";
                                    if ( !empty($position) && strripos($team_hide_meta, 'position') === false ){
                                        echo "<div class='position'>";
                                        echo sprintf('%s', $position);
                                        echo "</div>";
                                    }
                                    if( !empty($department) && strripos($team_hide_meta, 'department') === false ){
                                        echo "<div class='department'>";
                                        echo sprintf('%s', $department);
                                        echo "</div>";
                                    }
                                echo "</div>";
                            }

							if( !empty($socials) && strripos($team_hide_meta, 'socials') === false && !empty($socials) ){
							    echo "<div class='socials'>";
                                    echo "<div class='divider'></div>";
							        echo '<ul class="social-icons">';
							        foreach( $socials as $key => $value ){
							            $value = (array)$value;
							            echo '<li>';
                                            echo '<a href="'.esc_url($value['social_url']).'" title="'.esc_attr($value['social_title']).'" target="_blank">';
                                                echo '<i class="cwsicon-'.esc_attr($value['social_icon']).'"></i>';
                                            echo '</a>';
							            echo '</li>';
							        }
							        echo '</ul>';
							    echo "</div>";
							}

							if( strripos($team_hide_meta, 'experience') === false && !empty($experience) ){
								echo "<div class='experience'>";
                                    echo "<div class='divider'></div>";
									echo "<strong>" . esc_html_x( 'Experience: ', 'frontend', 'cws-essentials' ) . "</strong>";
									echo esc_html($experience);
								echo "</div>";
							}
                    
                            if( (strripos($team_hide_meta, 'phone') === false && !empty($phone)) || (strripos($team_hide_meta, 'email') === false && !empty($email)) ) {
                                echo "<div class='contacts'>";
                                    echo "<div class='divider'></div>";
                                if (strripos($team_hide_meta, 'phone') === false && !empty($phone)) {
                                    echo "<div class='phone'>";
                                    echo "<a href='tel:" . esc_attr($phone) . "'>";
                                    echo esc_html($phone);
                                    echo "</a>";
                                    echo "</div>";
                                }
                                if (strripos($team_hide_meta, 'email') === false && !empty($email)) {
                                    echo "<div class='email'>";
                                    echo "<a href='mailto:" . esc_attr($email) . "'>";
                                    echo esc_html($email);
                                    echo "</a>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                    
                            if( strripos($team_hide_meta, 'biography') === false && !empty($biography) ){
                                echo "<div class='biography'>";
                                echo "<div class='divider'></div>";
                                if ( empty($chars_count) || $chars_count == '-1' ) {
                                    echo esc_html($biography);
                                } else {
                                    $chars_count = (int)$chars_count;
                                    if( strlen($biography) > $chars_count ){
                                        $biography = trim( preg_replace( "/[\s]{2,}/", " ", strip_shortcodes(strip_tags($biography)) ));
                                        $biography = mb_substr($biography, 0, $chars_count) . '...';
                                    }
                                    if( $chars_count == '0' ){
                                        $biography = '';
                                    }
                                    echo esc_html($biography);
                                }
                                echo "</div>";
                            }

//							if( strripos($team_hide_meta, 'info') === false && !empty(get_the_content()) ){
//								echo "<div class='personal_info'>";
//									echo "<h6>".esc_html_x( 'Personal Information:', 'frontend', 'cws-essentials' )."</h6>";
//									the_content();
//								echo "</div>";
//							}
							if( strripos($team_hide_meta, 'more') === false && !empty($button_title) ){
								echo "<div class='cws_button_wrapper'>";
								    echo '<a class="cws_button small arrow_fade_in shadow" href="'.get_permalink().'"><span>'.esc_html($button_title).'</span></a>';
								echo "</div>";
							}

						echo "</div>";

					echo '</div>';

					$count ++;

				endwhile;

				echo $carousel ? "</div>" : "";

			echo "</div>";

			if( !$carousel ) promosys__pagination( $q, $total_items_count, $items_pp, 'standart', $max_paged );

		wp_reset_postdata();
		$out .= ob_get_clean();
	endif;

	return $out;
}
add_shortcode( 'cws_sc_our_team', 'cws_vc_shortcode_sc_our_team' );

?>