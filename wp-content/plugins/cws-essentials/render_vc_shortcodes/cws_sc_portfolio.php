<?php

function cws_vc_shortcode_sc_portfolio ( $atts = array(), $content = "" ){
	$portfolio_hide_meta = get_theme_mod('cws_portfolio_hide_meta') ? get_theme_mod('cws_portfolio_hide_meta') : array();

	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"tax"							=> "",
		"layout"						=> get_theme_mod('cws_portfolio_layout'),
		"hover"							=> get_theme_mod('cws_portfolio_hover'),
		"orderby"						=> get_theme_mod('cws_portfolio_orderby'),
		"order"							=> get_theme_mod('cws_portfolio_order'),
		"columns"						=> get_theme_mod('cws_portfolio_columns'),
		"total_items_count"				=> "-1",
		"items_pp"						=> get_theme_mod('cws_portfolio_items_pp'),
 		"no_spacing"					=> get_theme_mod('cws_portfolio_no_spacing'),
		"pagination"					=> get_theme_mod('cws_portfolio_pagination'),
		"hide_meta"						=> true,
		"portfolio_hide_meta"			=> implode(',', (array)$portfolio_hide_meta),
		"char_limit"                    => '67',
		"related_query"					=> "",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"title_color"					=> '',
		"meta_color"					=> '',
		"accent_color"					=> SECONDARY_COLOR,
		"divider_color"					=> '#ff0000',
		"background_color"				=> '',2423
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
	$terms = isset( $atts[ $tax . "_terms" ] ) ? $atts[ $tax . "_terms" ] : "";
	$id = uniqid( "cws_portfolio_" );
	$is_carousel = $layout == 'carousel' || $layout == 'carousel_wide';
	$hover = $layout == 'carousel_wide' ? $layout : $hover;
	$items_pp = empty($items_pp) ? '-1' : $items_pp;

	/* -----> Enqueuing scripts <----- */
	if( $layout == 'grid_filter' || $layout == 'masonry' || $layout == 'pinterest' ){
		wp_enqueue_script( 'isotope' );
	}
	if( $layout == 'asymmetric' ){
        wp_enqueue_script( 'cws-parallax-scroll', plugin_dir_url( __FILE__ ) . '../assets/js/jquery.parallax-scroll.js', array( 'jquery-easing' ), '1.0.0' );
	}

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
	if( !empty($title_color) ){
		$styles .= "
			#".$id." .cws_portfolio_items .cws_portfolio_item .h6,
			#".$id." .cws_portfolio_items .cws_portfolio_item .h5,
			#".$id." .cws_portfolio_items .cws_portfolio_item .h4,
			#".$id." .cws_portfolio_items .cws_portfolio_item .h3,
			#".$id." .cws_portfolio_items .cws_portfolio_item .h2,
			#".$id." .cws_portfolio_items .cws_portfolio_item .h1,
			#".$id." .cws_portfolio_items .cws_portfolio_item h1,
			#".$id." .cws_portfolio_items .cws_portfolio_item h2,
			#".$id." .cws_portfolio_items .cws_portfolio_item h3,
			#".$id." .cws_portfolio_items .cws_portfolio_item h4,
			#".$id." .cws_portfolio_items .cws_portfolio_item h5,
			#".$id." .cws_portfolio_items .cws_portfolio_item h6{
				color: ".$title_color.";
			}
		";
	}
	if( !empty($meta_color) ){
		$styles .= "
			#".$id." .cws_portfolio_items .cws_portfolio_item .meta,
			#".$id." .cws_portfolio_items .cws_portfolio_item .meta > a,
			#".$id." .cws_portfolio_items .cws_portfolio_item .image_wrapper .hidden_info .advanced_detail{
				color: ".$meta_color.";
			}
		";
	}
	if( !empty($background_color) ){
		$styles .= "
			#".$id." .cws_portfolio_items .cws_portfolio_item .image_wrapper .hidden_info{
				background: ".$background_color.";
			}
		";
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
        
        $styles .= "
            #".$id." .cws_portfolio_items .cws_portfolio_item .meta > a:hover,
            #".$id." .cws_portfolio_items .cws_portfolio_item .text_info a:hover {
                color: ".esc_attr($accent_color).";
            }
        ";
        
        $styles .= "
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
	$terms_temp = $all_terms = array();
	$filter_terms = $terms = explode(",", $terms);

	if( !empty($related_query) ){
		$related_query_atts = array();

		if( $related_query == 'category' ){
			$single_terms = cws_get_taxonomy_links('cws_portfolio_cat', '', 'backend', get_the_ID());

			if( !empty($single_terms) ){
				$related_query_atts['tax_query'] = array(
					array(
						'taxonomy'	=> 'cws_portfolio_cat',
						'field'		=> 'slug',
						'terms'		=> $single_terms
					)
				);
			} else {
				$related_query_atts['orderby'] = 'rand';
			}
		} else if( $related_query == 'tags' ){
			$single_terms = cws_get_taxonomy_links('cws_portfolio_tag', '', 'backend', get_the_ID());

			if( !empty($single_terms) ){
				$related_query_atts['tax_query'] = array(
					array(
						'taxonomy'	=> 'cws_portfolio_tag',
						'field'		=> 'slug',
						'terms'		=> $single_terms
					)
				);
			} else {
				$related_query_atts['orderby'] = 'rand';
			}
		} else if( $related_query == 'random' ){
			$related_query_atts['orderby'] = 'rand';
		} else if( $related_query == 'latest' ){
			$related_query_atts['order'] = 'DESC';
			$related_query_atts['orderby'] = 'date';
		}
	}

	foreach( $terms as $term ){
		if( !empty($term) ) $terms_temp[] = $term;
	}

	$all_terms_temp = !empty($tax) ? get_terms($tax) : array();
	$all_terms_temp = !is_wp_error($all_terms_temp) ? $all_terms_temp : array();

	foreach( $all_terms_temp as $term ){
		$all_term[] = $term->slug;
	}

	$terms = !empty($terms_temp) ? $terms_temp : $all_terms;

	/* -----> Formating Main Query <----- */
	$query_atts = array(
		'post_type'			=> 'cws_portfolio',
		'post_status'		=> 'publish',
		'posts_per_page' 	=> -1,
		'paged'				=> -1
	);

	if( empty($related_query) ){
		$query_atts['orderby'] = $orderby;
		$query_atts['order'] = $order;

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
	} else {
		$query_atts = array_merge($query_atts, $related_query_atts);
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

	if( $is_carousel ){
		$query_atts['nopaging']	= true;
	}

	$q = new WP_Query( $query_atts ); // Create prerender query

	if( $layout == 'motion_category' ){
		$items_pp = '-1';
	}

	if( $items_pp != '-1' ){
		$pages_quantity = $q->found_posts > $total_items_count ? ceil( $total_items_count / $items_pp ) : ceil( $q->found_posts / $items_pp );
	} else {
		$pages_quantity = '1';
	}

	/*-----------------------------------------------------------------------*/
	if( ( $layout == 'grid_filter' || $layout == 'motion_category' ) && $tax != 'title' ) {

		$filter_items_count = $total_items_count == '999' ? $items_pp : $total_items_count;
		$cycle_breaker = $items_pp == '-1' ? $total_items_count : $items_pp;

		$breakpoint = ceil((int)$filter_items_count / count($terms)); // How many post should be picked from each term

		for( $i=0; $i < $pages_quantity; $i++ ){
			$post_IDs[$i] = array();

			$temp_filter_terms = $filter_terms;
			foreach( $temp_filter_terms as $v ){
				$terms_count_control[$v] = 0; // Count control variable
			}

			foreach( $q->posts as $key => $post ){

				$current_tax_terms = wp_get_post_terms($post->ID, $tax);
				$current_terms = array();

				foreach( $current_tax_terms as $tax_term ){
					$current_terms[] = $tax_term->slug;
				}

				foreach( $current_terms as $current_term ){

					if( in_array($current_term, $temp_filter_terms) && $i+1 <= $filter_items_count){

						if( !in_array($post->ID, $post_IDs[$i]) ){ // Check if post has some of choosen terms

							if( count($post_IDs[$i]) < $cycle_breaker ){ // Break cycle if posts enough

								if( $terms_count_control[$current_term] >= $breakpoint ){ // Remove term from filter terms array when posts are enough
									$key_to_remove = array_search($current_term, $temp_filter_terms);
									unset($temp_filter_terms[$key_to_remove]);
								} else {
									$post_IDs[$i][$post->ID] = $post->ID; // Prepare posts for adding to choosed query
								}

								$terms_count_control[$current_term]++; // Update count control value

							}

						}

					}

				}
			}

			// Remove added posts from initial array
			foreach( $q->posts as $key => $post ){
				if( in_array($post->ID, $post_IDs[$i]) ){
					unset($q->posts[$key]);
				}
			}

			$q->posts = array_values($q->posts);

			// Show random post within required category if posts are not enough
			if( count(array_merge(...$post_IDs)) < $filter_items_count * ($i + 1) && array_merge(...$post_IDs) < $q->found_posts ){

				for( $index=0; $index < $filter_items_count - count($post_IDs[$i]); $index++ ){
					$post = (array)$q->posts;
					$post = $post[$index];

					$post_IDs[$i][$post['ID']] = $post['ID'];
				}
			}
		}

		$query_atts['posts_per_page'] = $items_pp;

		$ajax_query_atts = $query_atts;

		$query_atts['post__in'] = $post_IDs[(int)$paged-1]; // Add choosen posts to render query
	} else {

		$items_pp = $items_pp == '-1' ? '999' : $items_pp;

		for( $i=0; $i < $pages_quantity ; $i++ ){
			$count = 0;
			$post_IDs[$i] = array();

			foreach( $q->posts as $key => $post ){
				if( $count < $items_pp && count(array_merge(...$post_IDs)) < $total_items_count ){
					$post_IDs[$i][$post->ID] = $post->ID;
					unset($q->posts[$key]);
				}

				$count ++;
			}
		}

		$query_atts['posts_per_page'] = $items_pp;

		$ajax_query_atts = $query_atts;

		$query_atts['post__in'] = $post_IDs[(int)$paged-1]; // Add choosen posts to render query
	}

	if( $tax == 'title' ){
		$query_atts['paged'] = $paged;
	}

	$final_q = new WP_Query( $query_atts );

	/*-----------------------------------------------------------------------*/

	$found_posts = $final_q->found_posts;
	$max_paged = $found_posts > $total_items_count ? ceil( $total_items_count / $items_pp ) : ceil( $found_posts / $items_pp );

	/* -----> Portfolio module output <----- */
	$module_classes = "cws_portfolio_module";
	$module_classes .= " layout_".$layout;
	$module_classes .= " hover_".$hover;
	if( !$is_carousel && $layout != 'motion_category' ){
		$module_classes .= " columns_".$columns;
	} else if( $layout == 'motion_category' ){
		$module_classes .= " columns_".count($terms);
	}
	$module_classes .= !empty($el_class) ? " ".esc_attr($el_class) : '';

	$module_atts = " data-columns='".$columns."'";
	$module_atts .= " data-spacings='".(!$no_spacing ? 'true' : 'false')."'";
	if( $pagination == 'load_more' ){
		$module_atts .= " data-ajax-query=".json_encode($ajax_query_atts)."";
		$module_atts .= " data-ajax-posts=".json_encode($post_IDs)."";
		$module_atts .= " data-ajax-page=".json_encode($paged)."";
		$module_atts .= " data-ajax-tax=".json_encode($tax)."";
		$module_atts .= " data-ajax-hover=".json_encode($hover)."";
		$module_atts .= " data-ajax-layout=".json_encode($layout)."";
		$module_atts .= " data-ajax-portfolio_hide_meta".json_encode($portfolio_hide_meta)."";
	}

	$carousel_atts = "";
	if( $is_carousel ){
		$carousel_atts .= $layout == 'carousel_wide' ? " data-pagination=on" : '';
		$carousel_atts .= $layout == 'carousel' ? " data-navigation=on" : "";
		$carousel_atts .= $layout == 'carousel' ? " data-columns=".$columns."" : " data-columns=1";
		$carousel_atts .= $columns > 4 ? " data-tablet-portrait=4" : "";
		$carousel_atts .= " data-infinite=on";
		$carousel_atts .= " data-draggable=on";
		$carousel_atts .= " data-autoplay=on";
		$carousel_atts .= " data-autoplay-speed=4000";
	}

	if( $final_q->have_posts() ):
		ob_start();

			echo "<div id='".$id."' class='".$module_classes."' ".$module_atts.">";

				if( $layout == 'grid_filter' ){
					echo "<ul class='portfolio-filter'>";

						$terms = !empty($terms) ? $terms : array();

						echo "<li class='portfolio-filter-trigger active' data-value='all'>".esc_html_x('All', 'frontend', 'cws-essentials')."</li>";
						foreach( $terms as $term ){
							echo "<li class='portfolio-filter-trigger' data-value='f_".$term."'>".esc_html($term)."</li>";
						}

					echo "</ul>";
				} else if( $layout == 'motion_category' ){
					echo "<div class='portfolio-motion-cats'>";

						$terms = !empty($terms) ? $terms : array();
						$temp_terms = $terms;
						$images = array();

						foreach( $terms as $term ){
							echo "<a href='".get_term_link( $term, $tax )."' class='portfolio-motion-cat h6'>".esc_html($term)."</a>";
						}

						foreach ($temp_terms as $term) {
							$count = 0;

							foreach ($final_q->posts as $post) {
								$post_terms = cws_get_taxonomy_links($tax, '', 'backend', $post->ID);

								if( in_array($term, $post_terms) && $count == 0 ){

									$images[] = get_the_post_thumbnail_url($post->ID, 'full');

									if( ($key = array_search($term, $temp_terms)) !== false ){
										unset($terms_temp[$key]);
									}

									$count ++;
								}
							}
						}

						echo "<div class='mobile_only'>";
							foreach( $images as $key => $image ){
								echo "<div class='portfolio-mobile-motion-cat".($key == '0' ? ' active' : '')."' style='background-image: url(".$image.")'></div>";
							}
						echo "</div>";



					echo "</div>";
				}

				if( $layout == 'motion_category' ){
					foreach( $terms as $term ){
						echo "<div class='cws_portfolio_items_wrapper'>";
							echo "<div class='cws_portfolio_items".($no_spacing ? ' no_spacing' : '')."'>";

							while( $final_q->have_posts() ) : $final_q->the_post();

								$post_terms = $tax != 'title' ? cws_get_taxonomy_links($tax, '', 'backend') : array();

								if( in_array($term, $post_terms) ){
									// Get Taxonomy links
									$categories = strripos($portfolio_hide_meta, 'categories') === false ? cws_get_taxonomy_links('cws_portfolio_cat', ', ') : '';
									$tags = strripos($portfolio_hide_meta, 'tags') === false ? cws_get_taxonomy_links('cws_portfolio_tag', ', ') : '';
                                    
                                    // Get Excerpt
                                    $excerpt = '';
                                    $pid = get_the_ID();
                                    $post = get_post( $pid );
                                    
                                    $excerpt = !empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
                                    $excerpt = trim( preg_replace( "/[\s]{2,}/", " ", strip_shortcodes( strip_tags( $excerpt ) ) ) );
                                    $excerpt = wptexturize( $excerpt );
                                    $excerpt = substr( $excerpt, 0, $char_limit );

									echo '<div class="cws_portfolio_item'.($hover == 'swipe_right' ? ' boxed' : '').'">';
										if( !empty( get_the_post_thumbnail(get_the_ID()) ) ){
											echo '<div class="image_wrapper hover_'.esc_attr($hover).'" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), 'full').')">';
												echo '<a href="'.get_permalink().'">';
													echo get_the_post_thumbnail(get_the_ID());
												echo '</a>';
												if( $hover != 'swipe_right' ){
													echo '<div class="hidden_info">';
														if( strripos($portfolio_hide_meta, 'title') === false ){
														echo '<a class="h5" href="'.get_permalink().'">';
															echo get_the_title();
															echo '</a>';
														}
                                                        if( strripos($portfolio_hide_meta, 'excerpt') === false ){
                                                            echo '<div class="excerpt">'.esc_html($excerpt).'</div>';
                                                        }
														if( !empty($categories) || !empty($tags) ){
                                                            echo '<div class="meta">';
                                                                echo sprintf('%s', $categories);
                                                                echo !empty($categories) && !empty($tags) ? ' / ' : '';
                                                                echo sprintf('%s', $tags);
                                                            echo '</div>';
														}
													echo '</div>';
												}
											echo "</div>";
										}

										if( $hover == 'swipe_right' ){
											echo '<div class="text_info">';
												if( strripos($portfolio_hide_meta, 'title') === false ){
												    echo '<h5>'.get_the_title().'</h5>';
												}
                                                if( strripos($portfolio_hide_meta, 'divider') === false ){
                                                    echo '<span class="title_divider">';
                                                    echo '<svg width="26" height="6" viewBox="0 0 48 10" fill="' . esc_attr($divider_color) .'" xmlns="http://www.w3.org/2000/svg">';
                                                    echo '<path d="M46.3924 7.90145C43.6029 7.99388 42.0667 6.41256 40.8318 5.14414C39.7299 4.01114 38.8615 3.11957 37.2075 3.17184C35.5534 3.2241 34.807 4.18445 33.8352 5.37599C32.7581 6.72102 31.4184 8.39764 28.6289 8.49007C25.8394 8.58251 24.3031 7.00119 23.0683 5.73277C21.9664 4.59977 21.098 3.7082 19.4439 3.76047C17.7899 3.81274 17.0434 4.77307 16.0716 5.96461C14.9945 7.30965 13.6549 8.98627 10.8653 9.0787C8.07581 9.17114 6.53955 7.58982 5.30474 6.3214C4.20284 5.1884 3.33443 4.29683 1.68038 4.3491C1.34685 4.36015 1.019 4.23842 0.768943 4.0107C0.518888 3.78297 0.367113 3.46789 0.347011 3.13479C0.326909 2.80168 0.440126 2.47783 0.661753 2.23447C0.883379 1.99111 1.19526 1.84819 1.52879 1.83713C4.31832 1.7447 5.85458 3.32602 7.08939 4.59444C8.19129 5.72743 9.0597 6.61901 10.7138 6.56674C12.3678 6.51447 13.1143 5.55413 14.0861 4.36259C15.1632 3.01756 16.5028 1.34095 19.2923 1.24851C22.0819 1.15607 23.6181 2.73739 24.8529 4.00581C25.9548 5.13881 26.8232 6.03038 28.4773 5.97811C30.1314 5.92584 30.8778 4.9655 31.8496 3.77396C32.9267 2.42893 34.2664 0.752314 37.0559 0.659877C39.8454 0.567441 41.3817 2.14876 42.6165 3.41718C43.7184 4.55017 44.5868 5.44175 46.2409 5.38948C46.406 5.38401 46.5715 5.41108 46.7279 5.46914C46.8843 5.52721 47.0285 5.61512 47.1523 5.72788C47.2761 5.84064 47.3771 5.97603 47.4495 6.12632C47.5219 6.27661 47.5643 6.43885 47.5742 6.60379C47.5842 6.76873 47.5615 6.93313 47.5075 7.08761C47.4535 7.24209 47.3692 7.38361 47.2595 7.50411C47.1497 7.62461 47.0167 7.72172 46.8679 7.78989C46.7192 7.85807 46.5576 7.89597 46.3924 7.90145Z"/>';
                                                    echo '</svg>';
                                                    echo '</span>';
                                                }
                                                if( strripos($portfolio_hide_meta, 'excerpt') === false ){
                                                    echo '<div class="excerpt">'.esc_html($excerpt).'</div>';
                                                }
                                                if( !empty($categories) || !empty($tags) ) {
                                                    echo '<div class="meta">';
                                                        echo sprintf('%s', $categories);
                                                        echo !empty($categories) && !empty($tags) ? ' / ' : '';
                                                        echo sprintf('%s', $tags);
                                                    echo '</div>';
                                                }
											echo '</div>';
										}
									echo "</div>";
								}

							endwhile;

							echo "</div>";

						echo "</div>";
					}
				} else {
					echo "<div class='cws_portfolio_items ".($no_spacing ? 'no_spacing' : '')." ".( $is_carousel ? 'cws_carousel_wrapper' : '' )."' ".esc_attr($carousel_atts).">";

						if( $is_carousel ){
							echo "<div class='cws_carousel'>";
						}

						if( $layout == 'masonry' ){
							echo '<div class="grid-sizer"></div>';
						}

						while( $final_q->have_posts() ) : $final_q->the_post();

							// Get Metaboxes
							$client = cws_get_metabox('portfolio_client');
							$author = cws_get_metabox('portfolio_author');
							
							// Get Excerpt
                            $excerpt = '';
                            $pid = get_the_ID();
                            $post = get_post( $pid );
                            
                            $excerpt = !empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
                            $excerpt = trim( preg_replace( "/[\s]{2,}/", " ", strip_shortcodes( strip_tags( $excerpt ) ) ) );
                            $excerpt = wptexturize( $excerpt );
                            $excerpt = substr( $excerpt, 0, $char_limit );

							// Get Taxonomy links
							$categories = strripos($portfolio_hide_meta, 'categories') === false ? cws_get_taxonomy_links('cws_portfolio_cat', ', ') : '';
							$tags = strripos($portfolio_hide_meta, 'tags') === false ? cws_get_taxonomy_links('cws_portfolio_tag', ', ') : '';

							// Get Filters for Isotope
							$filter_atts = wp_get_post_terms(get_the_ID(), $tax);
							$filter_by = array();

							if( !empty($filter_atts) && $tax != 'title' ){
								foreach( $filter_atts as $k => $v ){
									$filter_by[] = 'f_'.$v->slug;
								}
							}

							$filter_atts = !empty($filter_by) ? implode(' ', $filter_by) : '';

							// Get Custom Masonry Size
							$masonry_width = $layout == 'masonry' ? (int)cws_get_metabox('portfolio_masonry_width') : '1';
							$masonry_height = $layout == 'masonry' ? (int)cws_get_metabox('portfolio_masonry_height') : '1';

							echo '<div class="cws_portfolio_item preloaded all '.esc_attr($filter_atts).($hover == 'swipe_right' ? ' boxed' : '').'" data-masonry-width="'.$masonry_width.'" data-masonry-height="'.$masonry_height.'">';

								if( !empty( get_the_post_thumbnail(get_the_ID()) ) ){
									echo '<div class="image_wrapper hover_'.esc_attr($hover).'" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), 'full').')">';
										echo '<a href="'.get_permalink().'">';
											echo get_the_post_thumbnail(get_the_ID());
										echo '</a>';
										if( $hover != 'swipe_right' ){
											echo '<div class="hidden_info">';
												if( strripos($portfolio_hide_meta, 'title') === false ){
												echo '<a class="h5" href="'.get_permalink().'">';
													echo get_the_title();
													echo '</a>';
												}
                                                if( strripos($portfolio_hide_meta, 'excerpt') === false ){
                                                    echo '<div class="excerpt">'.esc_html($excerpt).'</div>';
                                                }
												if( !empty($categories) || !empty($tags) ){
												echo '<div class="meta">';
													echo sprintf('%s', $categories);
													echo !empty($categories) && !empty($tags) ? ' / ' : '';
													echo sprintf('%s', $tags);
												echo '</div>';
												}
												if( $layout == 'carousel_wide' ){
													echo '<i class="open_info">';
														echo '<svg x="0px" y="0px" width="28.208px" height="28.333px" viewBox="0 0 28.208 28.333" enable-background="new 0 0 28.208 28.333" xml:space="preserve">
																<line fill="#FFFFFF" stroke="#FFFFFF" stroke-miterlimit="10" x1="26.873" y1="1.522" x2="1.463" y2="26.67"></line>
																<line fill="#FFFFFF" stroke="#FFFFFF" stroke-miterlimit="10" x1="27.232" y1="0.64" x2="27.177" y2="10.981"></line>
																<line fill="#FFFFFF" stroke="#FFFFFF" stroke-miterlimit="10" x1="27.716" y1="1.151" x2="17.374" y2="1.098"></line>
																<line fill="#FFFFFF" stroke="#FFFFFF" stroke-miterlimit="10" x1="1.074" y1="27.75" x2="1.13" y2="17.409"></line>
																<line fill="#FFFFFF" stroke="#FFFFFF" stroke-miterlimit="10" x1="0.591" y1="27.239" x2="10.933" y2="27.293"></line>
															</svg>';
													echo '</i>';

													echo '<div class="advanced_info">';

														echo '<a href="'.get_permalink().'" class="h3">'.get_the_title().'</a>';
														echo '<div class="advanced_details">';
															echo '<div class="advanced_detail">';
																echo '<p class="label">'.esc_html_x('Date', 'frontend', 'cws-essentials').'</p>';
																echo get_the_date();
															echo '</div>';

															if( !empty($author) ){
																echo '<div class="advanced_detail">';
																	echo '<p class="label">'.esc_html_x('Author', 'frontend', 'cws-essentials').'</p>';
																	echo sprintf('%s', $author);
																echo '</div>';
															}

															if( !empty($client) ){
																echo '<div class="advanced_detail">';
																	echo '<p class="label">'.esc_html_x('Client', 'frontend', 'cws-essentials').'</p>';
																	echo sprintf('%s', $client);
																echo '</div>';
															}
														echo '</div>';

														if( !empty(get_the_content()) ){
															echo '<div class="advanced_content">';
																echo get_the_content();
															echo '</div>';
														}

													echo '</div>';
												}
											echo '</div>';
										}
									echo "</div>";
								}

								if( $hover == 'swipe_right' ){
									echo '<div class="text_info">';
										if( strripos($portfolio_hide_meta, 'title') === false ){
										    echo '<a href="'.get_the_permalink().'" class="h5">'.get_the_title().'</a>';
										}
                                        if( strripos($portfolio_hide_meta, 'divider') === false ){
                                            echo '<span class="title_divider">';
                                                echo '<svg width="26" height="6" viewBox="0 0 48 10" fill="' . esc_attr($divider_color) .'" xmlns="http://www.w3.org/2000/svg">';
                                                    echo '<path d="M46.3924 7.90145C43.6029 7.99388 42.0667 6.41256 40.8318 5.14414C39.7299 4.01114 38.8615 3.11957 37.2075 3.17184C35.5534 3.2241 34.807 4.18445 33.8352 5.37599C32.7581 6.72102 31.4184 8.39764 28.6289 8.49007C25.8394 8.58251 24.3031 7.00119 23.0683 5.73277C21.9664 4.59977 21.098 3.7082 19.4439 3.76047C17.7899 3.81274 17.0434 4.77307 16.0716 5.96461C14.9945 7.30965 13.6549 8.98627 10.8653 9.0787C8.07581 9.17114 6.53955 7.58982 5.30474 6.3214C4.20284 5.1884 3.33443 4.29683 1.68038 4.3491C1.34685 4.36015 1.019 4.23842 0.768943 4.0107C0.518888 3.78297 0.367113 3.46789 0.347011 3.13479C0.326909 2.80168 0.440126 2.47783 0.661753 2.23447C0.883379 1.99111 1.19526 1.84819 1.52879 1.83713C4.31832 1.7447 5.85458 3.32602 7.08939 4.59444C8.19129 5.72743 9.0597 6.61901 10.7138 6.56674C12.3678 6.51447 13.1143 5.55413 14.0861 4.36259C15.1632 3.01756 16.5028 1.34095 19.2923 1.24851C22.0819 1.15607 23.6181 2.73739 24.8529 4.00581C25.9548 5.13881 26.8232 6.03038 28.4773 5.97811C30.1314 5.92584 30.8778 4.9655 31.8496 3.77396C32.9267 2.42893 34.2664 0.752314 37.0559 0.659877C39.8454 0.567441 41.3817 2.14876 42.6165 3.41718C43.7184 4.55017 44.5868 5.44175 46.2409 5.38948C46.406 5.38401 46.5715 5.41108 46.7279 5.46914C46.8843 5.52721 47.0285 5.61512 47.1523 5.72788C47.2761 5.84064 47.3771 5.97603 47.4495 6.12632C47.5219 6.27661 47.5643 6.43885 47.5742 6.60379C47.5842 6.76873 47.5615 6.93313 47.5075 7.08761C47.4535 7.24209 47.3692 7.38361 47.2595 7.50411C47.1497 7.62461 47.0167 7.72172 46.8679 7.78989C46.7192 7.85807 46.5576 7.89597 46.3924 7.90145Z"/>';
                                                echo '</svg>';
                                            echo '</span>';
                                        }
                                        if( strripos($portfolio_hide_meta, 'excerpt') === false ){
                                            echo '<div class="excerpt">'.esc_html($excerpt).'</div>';
                                        }
                                        if( !empty($categories) || !empty($tags) ) {
                                            echo '<div class="meta">';
                                                echo sprintf('%s', $categories);
                                                echo !empty($categories) && !empty($tags) ? ' / ' : '';
                                                echo sprintf('%s', $tags);
                                            echo '</div>';
                                        }
									echo '</div>';
								}

							echo '</div>';

						endwhile;

						if( $is_carousel ){
							echo "</div>";
						}

					echo "</div>";
				}


			echo "</div>";

			if( !$is_carousel ) promosys__pagination( $final_q, $total_items_count, $items_pp, $pagination, $pages_quantity );

		wp_reset_postdata();
		$out .= ob_get_clean();
	endif;

	return $out;
}
add_shortcode( 'cws_sc_portfolio', 'cws_vc_shortcode_sc_portfolio' );


function cws_portfolio_scripts() {
	global $wp_query;
    
    wp_enqueue_script( 'cws-portfolio', plugin_dir_url( __FILE__ ) . '../assets/js/cws-portfolio.js', array('promosys-theme'), '' );
    wp_enqueue_script( 'jquery-easing', plugin_dir_url( __FILE__ ) . '../assets/js/jquery.easing.js', array('jquery'), '1.3.0' );
}
add_action( 'wp_enqueue_scripts', 'cws_portfolio_scripts' );


function cws_portfolio_ajax_handler(){
	$query = $_POST['query'];
	$posts = $_POST['posts'];
	$page = (int)$_POST['page'];
	$tax = $_POST['tax'];
	$hover = $_POST['hover'];
	$layout = $_POST['layout'];
	$portfolio_hide_meta = $_POST['portfolio_hide_meta'];

	if( empty($posts[$page]) ){
		wp_die();
	}

	$query['post__in'] = $posts[$page];

	query_posts( $query );

	if( have_posts() ) :
 
		while( have_posts() ): the_post();
 
			// Get Taxonomy links
			$categories = cws_get_taxonomy_links('cws_portfolio_cat', ', ');
			$tags = cws_get_taxonomy_links('cws_portfolio_tag', ', ');

			// Get Filters for Isotope
			$filter_atts = wp_get_post_terms(get_the_ID(), $tax);
			$filter_by = array();

			if( !empty($filter_atts) && $tax != 'title' ){
				foreach( $filter_atts as $k => $v ){
					$filter_by[] = 'f_'.$v->slug;
				}

			}
			$filter_atts = !empty($filter_by) ? implode(' ', $filter_by) : '';

			// Get Custom Masonry Size
			$masonry_width = $layout == 'masonry' ? (int)cws_get_metabox('portfolio_masonry_width') : '1';
			$masonry_height = $layout == 'masonry' ? (int)cws_get_metabox('portfolio_masonry_height') : '1';

			echo '<div class="cws_portfolio_item all '.esc_attr($filter_atts).($hover == 'swipe_right' ? ' boxed' : '').'" data-masonry-width="'.$masonry_width.'" data-masonry-height="'.$masonry_height.'">';

				if( !empty( get_the_post_thumbnail(get_the_ID()) ) ){
					echo '<div class="image_wrapper hover_'.esc_attr($hover).'" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), 'full').')">';
						echo '<a href="'.get_permalink().'">';
							echo $layout == 'pinterest' ? get_the_post_thumbnail(get_the_ID()) : '';
						echo '</a>';
						if( $hover != 'swipe_right' ){
							echo '<div class="hidden_info">';
								echo '<a class="link" href="'.get_permalink().'"></a>';
								if( strripos($portfolio_hide_meta, 'title') === false ){
								echo '<a class="h5" href="'.get_permalink().'">';
									echo get_the_title();
									echo '</a>';
								}
								if( !empty($categories) || !empty($tags) ){
								echo '<p>';
									echo sprintf('%s', $categories);
									echo !empty($categories) && !empty($tags) ? ' / ' : '';
									echo sprintf('%s', $tags);
								echo '</p>';
								}
							echo '</div>';
						}
					echo "</div>";
				}

				if( $hover == 'swipe_right' ){
					echo '<div class="text_info">';
						if( strripos($portfolio_hide_meta, 'title') === false ){
						    echo '<h5>'.get_the_title().'</h5>';
						}
                        if( strripos($portfolio_hide_meta, 'divider') === false ){
                            echo '<span class="title_divider">';
                            echo '<svg width="26" height="6" viewBox="0 0 48 10" fill="' . esc_attr($divider_color) .'" xmlns="http://www.w3.org/2000/svg">';
                            echo '<path d="M46.3924 7.90145C43.6029 7.99388 42.0667 6.41256 40.8318 5.14414C39.7299 4.01114 38.8615 3.11957 37.2075 3.17184C35.5534 3.2241 34.807 4.18445 33.8352 5.37599C32.7581 6.72102 31.4184 8.39764 28.6289 8.49007C25.8394 8.58251 24.3031 7.00119 23.0683 5.73277C21.9664 4.59977 21.098 3.7082 19.4439 3.76047C17.7899 3.81274 17.0434 4.77307 16.0716 5.96461C14.9945 7.30965 13.6549 8.98627 10.8653 9.0787C8.07581 9.17114 6.53955 7.58982 5.30474 6.3214C4.20284 5.1884 3.33443 4.29683 1.68038 4.3491C1.34685 4.36015 1.019 4.23842 0.768943 4.0107C0.518888 3.78297 0.367113 3.46789 0.347011 3.13479C0.326909 2.80168 0.440126 2.47783 0.661753 2.23447C0.883379 1.99111 1.19526 1.84819 1.52879 1.83713C4.31832 1.7447 5.85458 3.32602 7.08939 4.59444C8.19129 5.72743 9.0597 6.61901 10.7138 6.56674C12.3678 6.51447 13.1143 5.55413 14.0861 4.36259C15.1632 3.01756 16.5028 1.34095 19.2923 1.24851C22.0819 1.15607 23.6181 2.73739 24.8529 4.00581C25.9548 5.13881 26.8232 6.03038 28.4773 5.97811C30.1314 5.92584 30.8778 4.9655 31.8496 3.77396C32.9267 2.42893 34.2664 0.752314 37.0559 0.659877C39.8454 0.567441 41.3817 2.14876 42.6165 3.41718C43.7184 4.55017 44.5868 5.44175 46.2409 5.38948C46.406 5.38401 46.5715 5.41108 46.7279 5.46914C46.8843 5.52721 47.0285 5.61512 47.1523 5.72788C47.2761 5.84064 47.3771 5.97603 47.4495 6.12632C47.5219 6.27661 47.5643 6.43885 47.5742 6.60379C47.5842 6.76873 47.5615 6.93313 47.5075 7.08761C47.4535 7.24209 47.3692 7.38361 47.2595 7.50411C47.1497 7.62461 47.0167 7.72172 46.8679 7.78989C46.7192 7.85807 46.5576 7.89597 46.3924 7.90145Z"/>';
                            echo '</svg>';
                            echo '</span>';
                        }
						if( !empty($categories) || !empty($tags) ){
						echo '<p>';
							echo sprintf('%s', $categories);
							echo !empty($categories) && !empty($tags) ? ' / ' : '';
							echo sprintf('%s', $tags);
						echo '</p>';
						}
					echo '</div>';
				}

			echo '</div>';
 
		endwhile;
 
	endif;

	wp_die();
}
add_action( 'wp_ajax_cws_portfolio_loadmore', 'cws_portfolio_ajax_handler' );
add_action( 'wp_ajax_nopriv_cws_portfolio_loadmore', 'cws_portfolio_ajax_handler' );

?>