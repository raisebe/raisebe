<?php
defined( 'ABSPATH' ) or die();

add_filter( 'the_content_more_link', 'promosys__modify_read_more_link' );

function promosys__modify_read_more_link() {
	return promosys__read_more();
}

function promosys__post_featured( $post_hide_meta = '', $cropped = false, $layout = '' ){
	/* -----> Variables declaration <----- */
	$out = $temp_out = $image = '';
	$post_permalink = get_permalink();
	$post_target = '_self';
	$post_format = get_post_format();
	$pid = get_the_id();

	/* -----> Get Post Thumbnail <----- */
	if( has_post_thumbnail() ){
		$thumbnail_id = get_post_thumbnail_id($pid);

		$thumb_title = get_post($pid)->post_title;
		$thumb_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
		$thumb_alt = !empty($thumb_alt) ? $thumb_alt : $thumb_title;

		$img_src = wp_get_attachment_image_url( $thumbnail_id, 'full' );
		$img_srcset = wp_get_attachment_image_srcset( $thumbnail_id, 'full' );

		$img_sizes = '';

		if ( $layout == '2' || $layout == 'checkerboard' || $layout == 'small' ) {
	        $img_sizes = '(max-width: 767px) 100vw, 50vw';
	    } elseif ( $layout == '3' ) {
	        $img_sizes = '(max-width: 767px) 100vw, (max-width: 991px) 50vw, 33vw';
	    } elseif ( $layout == '4' ) {
	        $img_sizes = '(max-width: 767px) 100vw, (max-width: 991px) 50vw, (max-width: 1366px) 33vw, 25vw';
	    } else {
	        $img_sizes = '100vw';
	    }

		if( !$cropped ){
			ob_start();
				the_post_thumbnail( 'full', array(
					'alt' => esc_attr($thumb_alt),
					'sizes' => esc_attr($img_sizes)
				) );
			$image .= ob_get_clean();
		} else {
			$image .= "<div class='cropped_image' style='background-image: url(".esc_url($img_src).")'></div>";
		}
	}

	/* -----> Print Post Media <----- */
	$post_media_classes = 'post-media';
	$post_media_classes .= ' format'.$post_format;
	$post_media_classes .= $cropped ? ' cropped' : '';

	if( strripos($post_hide_meta, 'featured') === false ){
		if( $post_format == 'gallery' && !empty(cws_get_metabox('format_gallery')) ){
			$gallery = explode(',', cws_get_metabox('format_gallery'));

			$temp_out .= '<div class="media-gallery cws_carousel_wrapper" data-navigation="on" data-draggable="on" data-auto-height="on">';
				$temp_out .= '<div class="cws_carousel">';
					foreach ($gallery as $image) {
						$alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
						$src = wp_get_attachment_image_src( $image, 'full' )[0];

						$temp_out .= "<img src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
					}
				$temp_out .= '</div>';
			$temp_out .= '</div>';
		} else if( $post_format == 'link' && !empty(cws_get_metabox('format_link_title')) ){
			$link_title = cws_get_metabox('format_link_title');
			$link_url = cws_get_metabox('format_link_url');

			$gradient = uniqid('gradient_');

			if( !empty($link_title) && !empty($link_url) ){
				$temp_out .= '<a class="media-link media-alternate" href="'.esc_url($link_url).'" target="_blank">';
					$temp_out .= esc_html($link_title);
				$temp_out .='</a>';
			}
		} else if( $post_format == 'quote' && !empty(cws_get_metabox('format_quote')) ){
			$quote = cws_get_metabox('format_quote');
			$quote_author = cws_get_metabox('format_quote_author');

			$gradient = uniqid('gradient_');

			if( !empty($quote) ){
				$temp_out .= '<blockquote class="media-quote media-alternate">';
					$temp_out .= '<p>'.esc_html($quote).'</p>';
					$temp_out .= !empty($quote_author) ? '<cite>'.esc_html($quote_author).'</cite>' : '';
				$temp_out .='</blockquote>';
			}
		} else if( $post_format == 'video' && !empty(cws_get_metabox('format_video')) ){
			$video = cws_get_metabox('format_video');

			$temp_out .= '<div class="media-video">';
				$temp_out .= apply_filters( "the_content", "[embed]".$video."[/embed]" );
			$temp_out .= '</div>';
		} else if( $post_format == 'audio' && !empty(cws_get_metabox('format_audio')) ){
			$audio = cws_get_metabox('format_audio');

			$temp_out .= '<div class="media-audio">';
				$temp_out .= apply_filters( "the_content", "[embed]".$audio."[/embed]" );
			$temp_out .= '</div>';
		} else if( has_post_thumbnail() ) {
			$temp_out .= '<a class="featured-image" href="'.esc_url( $post_permalink ) .'" target="'.esc_attr( $post_target ).'">';

				$temp_out .= $image;
			$temp_out .= '</a>';
		}
	}

	if( !empty($temp_out) ){
		$out .= '<div class="'.esc_attr($post_media_classes).'">';
			$out .= $temp_out;
		$out .= '</div>';
	}

	return $out;
}

function promosys__post_title( $post_hide_meta = '' ){
	if( strripos($post_hide_meta, 'title') === false ) : ?>

	<h4 class="post-title">
		<a href="<?php the_permalink() ?>" rel="bookmark">
			<?php the_title() ?>
		</a>
	</h4>

	<?php endif;
}

function promosys__post_category( $post_hide_meta = '' ){			
	$post_cats = get_the_category();
	$uniq_cats = array();

	foreach( $post_cats as $cat ){
		if( $cat->slug != 'uncategorized' ){
			$uniq_cats[] = $cat->term_id;
		}
	};

	if( !empty($uniq_cats) && strripos($post_hide_meta, 'cats') === false ){
		echo '<div class="post-categories">';
            echo esc_html_x('Categories: ', 'frontend', 'promosys');
			foreach ($uniq_cats as $key) {
				echo'<span><a href="'.get_category_link($key).'" rel="category tag">'.get_cat_name($key).'</a></span> ';
			}
		echo '</div>';
	}
}

function promosys__post_tags( $post_hide_meta = '' ){
    $out = '';
    if( strripos($post_hide_meta, 'tags') === false && !empty( get_the_tags() ) ) {
        $out .= '<div class="post-tags">';
            $out .= get_the_tag_list('', '', '');
        $out .= '</div>';
        return $out;
    }
}

function promosys__post_author( $post_hide_meta = '' ){
	if( strripos($post_hide_meta, 'author') === false && !empty(get_the_author_posts_link()) ){
		echo '<div class="meta-item post-author">';
            echo get_avatar(get_the_author_meta('ID'), 35, 'mm');
			echo get_the_author_posts_link();
		echo '</div>';
	}
}

function promosys__post_date( $post_hide_meta = '', $type = 'simple' ){
	$date = get_day_link((int)get_the_date('Y'), (int)get_the_date('m'), (int)get_the_date('d'));

	if( strripos($post_hide_meta, 'date') === false ){
		echo '<div class="meta-item post-date">';
			if( $type == 'simple' ){
				echo '<a href="'.esc_url($date).'">'.esc_html( get_the_date( get_option( 'date_format' ) ) ).'</a>';
			} elseif( $type == 'short' ){
				echo '<a href="'.esc_url($date).'">';
					echo esc_html( get_the_date('M j, H:i') );
				echo '</a>';
			}
		echo '</div>';
	}
}

function promosys__post_comments( $post_hide_meta = '' ){
	if( strripos($post_hide_meta, 'comments') === false ){
		echo '<div class="meta-item comments_count">';
			echo '<a href="'.get_permalink().'#comments">'.get_comments_number().'</a>';
		echo '</div>';
	}
}

function promosys__post_share( $post_hide_meta = '' ){
	if( strripos($post_hide_meta, 'share') === false ){
		get_template_part( 'tmpl/post/content-sharing' );
	}
}

function promosys__read_more( $title = '', $post_hide_meta = '', $button_size = 'small', $button_style = 'arrow_fade_in', $button_shadow = true, $button_icon = '' ){
	$post_permalink = get_permalink();
	$post_target    = '_self';
	$out 			= '';
	$title 			= empty($title) ? get_theme_mod('blog_read_more') : $title;
    
    $button_classes = 'blog-readmore cws_button';
    $button_classes .= $button_size != 'medium' ? ' ' . esc_attr($button_size) : '';
    $button_classes .= !empty($button_style) ? ' ' . esc_attr($button_style) : ' simple';
    $button_classes .= !empty($button_shadow) ? ' shadow' : '';

	if ( get_post_format() == 'link' ) {
		$post_permalink = get_post_meta( get_the_ID(), '_post_link', true );
		$post_target    = get_post_meta( get_the_ID(), '_post_link_target', true );
	}

	$out .= '<div class="blog-readmore-wrap">';
		$out .= '<a class="'.esc_attr($button_classes).'" href="'. esc_url($post_permalink ) .'" target="'. esc_attr($post_target) .'">';
			$out .= '<span>';
                $out .= !empty($button_icon) ? $button_icon : '';
			    $out .= esc_html($title);
			$out .= '</span>';
		$out .= '</a>';
	$out .= '</div>';

	if( strripos($post_hide_meta, 'read_more') !== false )
		$out = '';

	return $out;
}

function promosys__the_content( $max_length = '', $post_hide_meta = '' ){
	$excerpt 	= get_the_excerpt();
	$content 	= get_the_content();
	$content 	= apply_filters( 'the_content', $content );
	$content 	= str_replace( ']]>', ']]&gt;', $content );
	$max_length = !empty($max_length) ? (int)$max_length : (int)get_theme_mod('blog_chars_count');


	if( has_excerpt() ){
		$content = esc_html($excerpt);
	} else {
		if( $max_length != '-1' ){
			if( strlen($content) > $max_length ){
				$content = str_replace( promosys__read_more(), '', $content);
			    $content = trim( preg_replace( "/[\s]{2,}/", " ", strip_shortcodes(strip_tags($content)) ));
			    $content = mb_substr($content, 0, $max_length) . '...';
			}

			if( $max_length == '0' ){
				$content = '';
			}
		}
	}

    if( strripos($post_hide_meta, 'excerpt') !== false )
        $content = '';

	ob_start();
		wp_link_pages( array(
			'before'      => '<div class="paging-navigation in-post"><div class="pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'promosys' ) . '</span>',
			'after'       => '</div></div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
	$content .= ob_get_clean();

	return $content;
}