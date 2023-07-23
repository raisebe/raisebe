<?php

function cws_vc_shortcode_sc_latest_posts ( $atts = array(), $content = "" ){

	$defaults = array(
		/* -----> GENERAL TAB <----- */
		"title"							=> "",
		"add_icon"                      => false,
        "icon_lib"				        => "FontAwesome",
		"tax"							=> "",
		"total_items_count"				=> "2",
		"el_class"						=> "",
		/* -----> STYLING TAB <----- */
		"title_color"					=> PRIMARY_COLOR,
		"divider_color"                 => "",
		"date_color"					=> PRIMARY_COLOR,
		"article_color"					=> PRIMARY_COLOR,
		"article_color_hover"			=> SECONDARY_COLOR,
        "icon_color"                    => SECONDARY_COLOR,
	);

	$proc_atts = shortcode_atts( $defaults, $atts );
	extract( $proc_atts );

	/* -----> Variables declaration <----- */
	$out = $styles = "";
    $icon = esc_attr(cws_ext_vc_sc_get_icon($atts));
	$terms_temp = $all_terms = array();
	$terms = isset( $atts[ $tax . "_terms" ] ) ? $atts[ $tax . "_terms" ] : "";
	$id = uniqid( "cws_latest_posts_" );

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
		'post_type'				=> 'post',
		'post_status'			=> 'publish',
		'orderby'				=> 'date',
		'order'					=> 'DESC',
		'posts_per_page'		=> '-1',
		'nopaging'				=> true,
		'ignore_sticky_posts'	=> true,
	);

	if( !empty($tax) ){
		$query_atts['tax_query'] = array(
			array(
				'taxonomy'	=> $tax,
				'field'		=> 'slug',
				'terms'		=> $terms
			)
		);
	}

	$q = new WP_Query( $query_atts );
	$count = 0;

	/* -----> Customize default styles <----- */
	if( !empty($title_color) ){
		$styles .= "
			#".$id." h4{
				color: ".$title_color.";
			}
		";
	}
	if( !empty($divider_color) ){
		$styles .= "
			#".$id." h4:before{
				border-color: ".$divider_color.";
			}
			#".$id." h4:after{
				background-color: ".$divider_color.";
			}
		";
	}
	if( !empty($date_color) ){
		$styles .= "
			#".$id." .date,
			#".$id." .category a{
				color: ".$date_color.";
			}
		";
	}
	if( !empty($article_color) ){
		$styles .= "
			#".$id." .title{
				color: ".$article_color.";
			}
		";
	}
    if( !empty($icon_color) ){
        $styles .= "
			#".$id." h4 i{
				color: ".$icon_color.";
			}
		";
    }
	if( !empty($article_color_hover) ){
			$styles .= "
				@media 
					screen and (min-width: 1367px),
					screen and (min-width: 1200px) and (any-hover: hover),
					screen and (min-width: 1200px) and (min--moz-device-pixel-ratio:0),
					screen and (min-width: 1200px) and (-ms-high-contrast: none),
					screen and (min-width: 1200px) and (-ms-high-contrast: active)
				{
					#".$id." .title:hover,
					#".$id." .category a:hover{
						color: ".esc_attr($article_color_hover).";
					}
				}
			";
		}
	/* -----> End of mobile styles <----- */
	
	cws__vc_styles($styles);

    $icon_output = '';

    /* -----> Getting Icon <----- */
    if( !empty($icon_lib) ){
        if( $icon_lib == 'cws_svg' ){
            $icon = "icon_".$icon_lib;
            $svg_icon = json_decode(str_replace("``", "\"", $atts[$icon]), true);
            $upload_dir = wp_upload_dir();
            $this_folder = $upload_dir['basedir'] . '/cws-svgicons/' . md5($svg_icon['collection']) . '/';

            $icon_output .= "<i class='svg' style='width:".$svg_icon['width']."px; height:".$svg_icon['height']."px;'>";
            $icon_output .= file_get_contents($this_folder . $svg_icon['name']);
            $icon_output .= "</i>";
        } else {
            if( !empty($icon) ){
                $icon_output .= '<i class="'.esc_attr($icon).'"></i>';
            }
        }
    }

	/* -----> Latest Posts module output <----- */
	if( $q->have_posts() ):
		ob_start();

			echo "<div id='".$id."' class='cws_latest_posts'>";

			if( !empty($title) ){
				echo "<h4><span class='widget-title-text'>".esc_html($title).(!empty($icon_output) ? wp_kses($icon_output, array(
				        'i' => array(
				            'class' => true
                        ),
                        'svg' => array(
                            'class' => true,
                            'src' => true
                        )
                    )) : '')."</span></h4>";
			}

			while( $q->have_posts() && $count < (int)$total_items_count ) : $q->the_post();

				echo "<div class='cws_latest_post'>";

					if( !empty($image = get_the_post_thumbnail(get_the_ID(), 'thumbnail')) ){
						echo "<a href='".get_permalink()."' class='image_wrapper'>";
							echo $image;
						echo "</a>";
					}

					echo "<div class='info_wrapper'>";
                        echo '<div class="category">';
                            the_category( ', ', '', get_the_ID() );
                        echo '</div>';
						echo "<a href='".get_permalink()."' class='title'>".get_the_title()."</a>";
//						echo "<p class='date'>".get_the_date()."</p>";
					echo "</div>";

				echo "</div>";


				$count++;

			endwhile;

			echo "</div>";

		wp_reset_postdata();
		$out .= ob_get_clean();
	endif;

	return $out;
}
add_shortcode( 'cws_sc_latest_posts', 'cws_vc_shortcode_sc_latest_posts' );

?>