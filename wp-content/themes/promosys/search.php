<?php
defined( 'ABSPATH' ) or die();

global $wp_query;

$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$index = 1 + ( ( $paged - 1 ) * $wp_query->query_vars['posts_per_page'] );
?>

	<?php get_header() ?>

		<?php if ( have_posts() ): ?>
			<div class="content blog layout_large" role="main">
				<div class="container">
					<?php get_search_form() ?>

					<?php 
						while ( have_posts() ): the_post(); 

						$extra_class = 'post';
					?>
						<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
							<div class="post-inner">
								<div class='post-information'>
                                    
                                    <!-- Post Title -->
                                    <?php promosys__post_title() ?>
                                        
                                    <?php if ( !empty(get_the_title()) && !empty(promosys__the_content(200)) ) : ?>
                                        <div class="post-divider">
                                            <div class="post-divider-inner"></div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( !empty(promosys__the_content(200, '')) ) : ?>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <?php echo promosys__the_content(200, '') ?>
                                        </div>
                                    <?php endif; ?>
                                        
                                    <!-- Post Categories -->
                                    <?php promosys__post_category() ?>
                                        
                                    <!-- Post Read More Button -->
                                    <?php echo promosys__read_more(get_theme_mod('blog_read_more'), '', 'small') ?>
                                    <!-- Post Footer -->
                                    <div class="post-footer">
                                        <?php
                                            promosys__post_author();
                                            promosys__post_date();
                                            promosys__post_comments();
                                        ?>
                                    </div>

								</div>
							</div>
						</div>
					<?php endwhile ?>
				</div>
			</div>
			
			<?php promosys__pagination() ?>
		<?php else: ?>
			<div class="content">
				<div class="search-no-results">
					<h3><?php echo esc_html_x( 'Nothing Found', 'Search form', 'promosys' ) ?></h3>
					<p><?php echo esc_html_x( 'Sorry, no posts matched your criteria. Please try another search', 'Search form', 'promosys' ) ?></p>
					
					<p><?php echo esc_html_x( 'You might want to consider some of our suggestions to get better results:', 'Search form', 'promosys' ) ?></p>
					<ul>
						<li><?php echo esc_html_x( 'Check your spelling.', 'Search form', 'promosys' ) ?></li>
						<li><?php echo esc_html_x( 'Try a similar keyword, for example: tablet instead of laptop.', 'Search form', 'promosys' ) ?></li>
						<li><?php echo esc_html_x( 'Try using more than one keyword.', 'Search form', 'promosys' ) ?></li>
					</ul>
				</div>
				<?php get_search_form() ?>
			</div>
		<?php endif ?>

	<?php get_footer() ?>