<?php
defined( 'ABSPATH' ) or die();
?>

	<div class="content blog<?php echo (!empty(get_theme_mod('blog_columns')) ? 'layout_' . esc_attr(get_theme_mod('blog_columns')) : ''); ?>" role="main">
		<?php if ( have_posts() ): ?>
			<div class="content_inner <?php echo (!empty(get_theme_mod('blog_view')) ? ' ' . esc_attr(get_theme_mod('blog_view')) : ''); ?>" data-columns="<?php echo esc_attr(get_theme_mod('blog_columns')); ?>">
				<?php 
					while ( have_posts() ): the_post();
     
					$extra_class = 'post';
					$link_title = cws_get_metabox('format_link_title');
					$link_url = cws_get_metabox('format_link_url');
					$quote = cws_get_metabox('format_quote');
     
					$post_hide_meta = ( !empty(get_theme_mod('blog_hide_meta')) && is_array(get_theme_mod('blog_hide_meta')) ) ? implode(',', (array)get_theme_mod('blog_hide_meta')) : '';
     
					if( (!empty($link_title) && !empty($link_url) && get_post_format() == 'link') || (!empty($quote) && get_post_format() == 'quote') ) {
					    $extra_class .= ' cws-alternate-view';
					}

				?>
					<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
						<div class="post-inner">
							<?php if( !empty(promosys__post_featured($post_hide_meta)) ) : ?>
								<div class="post-media-wrapper">
									<!-- Featured Media -->
									<?php echo promosys__post_featured($post_hide_meta) ?>
								</div>
							<?php endif; ?>

							<div class='post-information'>
                                <?php  if( (empty($link_title) && empty($link_url) || get_post_format() != 'link') && (empty($quote) ||
                                        get_post_format() != 'quote') ) { ?>
                                    
                                    <!-- Post Tags -->
                                    <?php echo promosys__post_tags($post_hide_meta) ?>
                                    
                                    <!-- Post Title -->
                                    <?php promosys__post_title($post_hide_meta) ?>
                                    
                                    <?php if ( strripos($post_hide_meta, 'title') === false && !empty(get_the_title()) && !empty(promosys__the_content(get_theme_mod('blog_chars_count'), $post_hide_meta)) ) : ?>
                                        <div class="post-divider">
                                            <div class="post-divider-inner"></div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Post Content -->
                                    <?php if( !empty(promosys__the_content(get_theme_mod('blog_chars_count'), $post_hide_meta)) ) : ?>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <?php echo promosys__the_content(get_theme_mod('blog_chars_count'), $post_hide_meta) ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Post Categories -->
                                    <?php promosys__post_category($post_hide_meta) ?>
                                    
                                    <!-- Post Read More Button -->
                                    <?php echo promosys__read_more(get_theme_mod('blog_read_more'), $post_hide_meta, 'small') ?>
                                
                                <?php } ?>
                                
                                <!-- Post Footer -->
                                <div class="post-footer">
                                    <?php
                                        promosys__post_author( $post_hide_meta );
                                        promosys__post_date( $post_hide_meta, 'simple' );
                                        promosys__post_comments($post_hide_meta);
                                    ?>
                                </div>

							</div>
						</div>
					</div>
				<?php endwhile ?>
			</div>

			<?php promosys__pagination() ?>
		<?php else: ?>
			<?php get_template_part( 'tmpl/post/content-none' ) ?>
		<?php endif ?>
	</div>
	<!-- /.content -->
