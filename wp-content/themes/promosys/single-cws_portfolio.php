<?php
defined( 'ABSPATH' ) or die(); ?>

<?php get_header() ?>
	<?php while ( have_posts() ): the_post(); ?>

		<?php
			$categories = cws_get_taxonomy_links('cws_portfolio_cat', ', ');
			$tags = cws_get_taxonomy_links('cws_portfolio_tag', ', ');
			$type = cws_get_metabox('portfolio_type');
			$gallery = explode(',', cws_get_metabox('portfolio_gallery'));
            $client = cws_get_metabox('portfolio_client');
			$author = cws_get_metabox('portfolio_author');
			$related = cws_get_metabox('related_portfolio_posts');
			$content = get_the_content();
		?>
		
		<div class="portfolio-single-content type_<?php echo esc_attr($type) ?>">
			<div class="portfolio-media">
				<?php
					switch( $type ){
						case 'small_images':
						    if ( $gallery != array('0' => '') ) {
                                foreach ($gallery as $image) {
                                    $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                    $src = wp_get_attachment_image_src($image, 'full')[0];
                                
                                    echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                                }
                            } elseif ( has_post_thumbnail() ) {
						        $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
						        $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
                            
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }

							break;
						case 'small_slider':
                            if ( $gallery != array('0' => '') ) {
                                echo '<div class="cws_carousel_wrapper" data-columns="1" data-draggable="on" data-pagination="on">';
                                    echo '<div class="cws_carousel">';
    
                                        foreach ($gallery as $image) {
                                            $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                            $src = wp_get_attachment_image_src( $image, 'full' )[0];
    
                                            echo "<img src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
                                        }
    
                                    echo '</div>';
                                echo '</div>';
                            } elseif ( has_post_thumbnail() ) {
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
    
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }

							break;
						case 'large_images':
                            if ( $gallery != array('0' => '') ) {
                                foreach ($gallery as $image) {
                                    $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                    $src = wp_get_attachment_image_src( $image, 'full' )[0];
    
                                    echo "<img src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
                                }
                            } elseif ( has_post_thumbnail() ) {
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
    
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }
							break;
						case 'large_slider':
                            if ( $gallery != array('0' => '') ) {
                                echo '<div class="cws_carousel_wrapper" data-columns="1" data-draggable="on" data-navigation="on" data-auto-height="on">';
                                    echo '<div class="cws_carousel">';
    
                                        foreach ($gallery as $image) {
                                            $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                            $src = wp_get_attachment_image_src( $image, 'full' )[0];
    
                                            echo "<img src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
                                        }
    
                                    echo '</div>';
                                echo '</div>';
                            } elseif ( has_post_thumbnail() ) {
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
    
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }
							break;
						case 'gallery':
                            if ( $gallery != array('0' => '') ) {
                                echo '<div class="cws_gallery_images magnific">';
    
                                    foreach ($gallery as $image) {
                                        $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                        $src = wp_get_attachment_image_src( $image, 'full' )[0];
    
                                        echo "<a href='".esc_url($src)."' class='cws_gallery_image'>";
                                            echo "<img src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
                                        echo "</a>";
                                    }
    
                                echo '</div>';
                            } elseif ( has_post_thumbnail() ) {
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
    
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }
							break;
						case 'small_masonry':
                            if ( $gallery != array('0' => '') ) {
                                echo '<div class="cws_gallery_images masonry">';
    
                                    foreach ($gallery as $image) {
                                        $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                        $src = wp_get_attachment_image_src( $image, 'full' )[0];
    
                                        echo "<img class='cws_gallery_image' src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
                                    }
    
                                echo '</div>';
                            } elseif ( has_post_thumbnail() ) {
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
    
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }
							break;
						case 'large_masonry':
                            if ( $gallery != array('0' => '') ) {
                                echo '<div class="cws_gallery_images masonry">';
    
                                    foreach ($gallery as $image) {
                                        $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                        $src = wp_get_attachment_image_src( $image, 'full' )[0];
    
                                        echo "<img class='cws_gallery_image' src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
                                    }
    
                                echo '</div>';
                            } elseif ( has_post_thumbnail() ) {
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
    
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }
							break;
						case 'custom_layout':
                            if ( $gallery != array('0' => '') ) {
                                $type = substr(cws_get_metabox('portfolio_gallery_template'), 0, -4);
    
                                echo '<div class="gallery_custom_grid '.esc_attr($type).'">';
    
                                    foreach ($gallery as $image) {
                                        $src = wp_get_attachment_image_src( $image, 'full' )[0];
    
                                        echo '<div class="pic" style="background-image: url('.esc_url($src).')"></div>';
                                    }
    
                                echo '</div>';
                            } elseif ( has_post_thumbnail() ) {
                                $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
    
                                echo "<img src='" . esc_url($src) . "' alt='" . esc_attr($alt) . "' />";
                            }
							break;
					}
				?>
			</div>
				
			<?php if( $type != 'small_images' && $type != 'small_slider' && $type != 'small_masonry' ) : ?>
				<h5><?php the_title() ?></h5>
			<?php endif; ?>
			<div class="portfolio-content-wrapper">
				<div class="main-part">
					<?php if( $type == 'small_images' || $type == 'small_slider' || $type == 'small_masonry' ) : ?>
						<h5><?php the_title() ?></h5>
					<?php endif; ?>
					<div class="portfolio-content">
						<?php echo sprintf('%s', $content) ?>
					</div> 
				</div>
				<div class="aside-part">
					<?php if( !empty($categories) ) : ?>
						<div>
							<span class="label">
								<?php echo strripos($categories, ',') !== false ? esc_html_x('Categories:', 'frontend', 'promosys') : esc_html_x('Category:', 'frontend', 'promosys') ?>
							</span>
                            <span class="value">
							    <?php echo sprintf('%s', $categories); ?>
                            </span>
						</div>
					<?php endif; ?>
					<?php if( !empty($author) ) : ?>
						<div>
							<span class="label">
								<?php echo esc_html_x('Author:', 'frontend', 'promosys'); ?>
							</span>
                            <span class="value">
							    <?php echo sprintf('%s', $author); ?>
                            </span>
						</div>
					<?php endif; ?>
                    <?php if( !empty($client) ) : ?>
                        <div>
                            <span class="label">
                                <?php echo esc_html_x('Client:', 'frontend', 'promosys'); ?>
                            </span>
                            <span class="value">
                                <?php echo sprintf('%s', $client); ?>
                            </span>
                        </div>
                    <?php endif; ?>
					<div>
						<span class="label">
							<?php echo esc_html_x('Date:', 'frontend', 'promosys'); ?>
						</span>
                        <span class="value">
						    <?php echo get_the_date(); ?>
                        </span>
					</div>
                    <?php
                        $socials = get_theme_mod('social_share_links');
		                if( !empty($socials) && $socials[0] != 'none' && $socials != 'none') : ?>
                        <div>
                            <div class="title_divider">
                                <svg width="26" height="6" viewBox="0 0 48 10" fill="#ff0000" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46.3924 7.90145C43.6029 7.99388 42.0667 6.41256 40.8318 5.14414C39.7299 4.01114 38.8615 3.11957 37.2075 3.17184C35.5534 3.2241 34.807 4.18445 33.8352 5.37599C32.7581 6.72102 31.4184 8.39764 28.6289 8.49007C25.8394 8.58251 24.3031 7.00119 23.0683 5.73277C21.9664 4.59977 21.098 3.7082 19.4439 3.76047C17.7899 3.81274 17.0434 4.77307 16.0716 5.96461C14.9945 7.30965 13.6549 8.98627 10.8653 9.0787C8.07581 9.17114 6.53955 7.58982 5.30474 6.3214C4.20284 5.1884 3.33443 4.29683 1.68038 4.3491C1.34685 4.36015 1.019 4.23842 0.768943 4.0107C0.518888 3.78297 0.367113 3.46789 0.347011 3.13479C0.326909 2.80168 0.440126 2.47783 0.661753 2.23447C0.883379 1.99111 1.19526 1.84819 1.52879 1.83713C4.31832 1.7447 5.85458 3.32602 7.08939 4.59444C8.19129 5.72743 9.0597 6.61901 10.7138 6.56674C12.3678 6.51447 13.1143 5.55413 14.0861 4.36259C15.1632 3.01756 16.5028 1.34095 19.2923 1.24851C22.0819 1.15607 23.6181 2.73739 24.8529 4.00581C25.9548 5.13881 26.8232 6.03038 28.4773 5.97811C30.1314 5.92584 30.8778 4.9655 31.8496 3.77396C32.9267 2.42893 34.2664 0.752314 37.0559 0.659877C39.8454 0.567441 41.3817 2.14876 42.6165 3.41718C43.7184 4.55017 44.5868 5.44175 46.2409 5.38948C46.406 5.38401 46.5715 5.41108 46.7279 5.46914C46.8843 5.52721 47.0285 5.61512 47.1523 5.72788C47.2761 5.84064 47.3771 5.97603 47.4495 6.12632C47.5219 6.27661 47.5643 6.43885 47.5742 6.60379C47.5842 6.76873 47.5615 6.93313 47.5075 7.08761C47.4535 7.24209 47.3692 7.38361 47.2595 7.50411C47.1497 7.62461 47.0167 7.72172 46.8679 7.78989C46.7192 7.85807 46.5576 7.89597 46.3924 7.90145Z"/>
                                </svg>
                            </div>
                            <span class="label">
                                <?php echo esc_html_x('Share:', 'frontend', 'promosys'); ?>
                            </span>
                            <?php get_template_part( 'tmpl/post/content-sharing' ); ?>
                        </div>
                    <?php endif; ?>
				</div>
			</div>

		</div>

		<?php get_template_part( 'tmpl/post/content-navigator' ) ?>

		<?php if( get_theme_mod('cws_portfolio_related') ) : ?>

			<div class="related-posts">

				<?php if( !empty(get_theme_mod('cws_portfolio_related_title')) ) : ?>
                    <div class="cws_textmodule">
                        <div class="cws_textmodule_info_wrapper">
                            <h5 class="cws_textmodule_title single-content-title">
                                <span class="cws_textmodule_title_text">
                                    <?php echo esc_html( get_theme_mod('cws_portfolio_related_title') ) ?>
                                </span>
                            </h5>
                        </div>
                    </div>
				<?php endif ?>

				<?php 
					echo cws_vc_shortcode_sc_portfolio( array(
						'layout'			=> 'grid',
						'columns' 			=> get_theme_mod('cws_portfolio_related_columns'),
						'total_items_count' => get_theme_mod('cws_portfolio_related_items'),
						'hover'				=> get_theme_mod('cws_portfolio_related_hover'),
						'square_img'		=> false,
						'no_spacing'		=> false,
						'related_query'		=> get_theme_mod('cws_portfolio_related_pick')
					));
				?>

			</div>

		<?php endif; ?>

	<?php endwhile ?>
<?php get_footer() ?>
