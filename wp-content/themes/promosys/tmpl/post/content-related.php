<?php
defined( 'ABSPATH' ) or die();

// Remove Quote & Link posts from related
$extra_args = array(
    'post_type'		=> 'post',
    'post_status' 	=> 'publish',
    'order' 		=> 'DESC',
    'tax_query' 	=> array(
        array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array( 'post-format-quote', 'post-format-link' )
        )
    )
);

$asides = get_posts( $extra_args );
$posts__not_in = array( get_the_ID() );

if( count($asides) ){
    foreach( $asides as $aside ){
        $posts__not_in[] = $aside->ID;
    }
}

// Query args
$args = array(
	'post_type'           => 'post',
	'posts_per_page'      => (int)get_theme_mod('blog_related_items'),
	'post__not_in'        => $posts__not_in,
	'ignore_sticky_posts' => true
);

$related_item_type = get_theme_mod('blog_related_pick');
$hide_meta = implode(',', (array)get_theme_mod('blog_related_hide'));
$columns = (int)get_theme_mod('blog_related_columns');
$enable_carousel = (int)get_theme_mod('blog_related_items') > (int)get_theme_mod('blog_related_columns') ? true : false;

// Filter by tags
if ( 'tag' == $related_item_type ) {
	if ( ! ( $terms = get_the_tags() ) )
		return;

	$args['tag__in'] = wp_list_pluck( $terms, 'term_id' );
}
// Filter by categories
elseif ( 'category' == $related_item_type ) {
	if ( ! ( $terms = get_the_category() ) )
		return;

	$args['category__in'] = wp_list_pluck( $terms, 'term_id' );
}
// Show random items
elseif ( 'random' == $related_item_type ) {
	$args['orderby'] = 'rand';
}
// Show latest items
elseif ( 'recent' == $related_item_type ) {
	$args['order'] = 'DESC';
	$args['orderby'] = 'date';
}


// Create the query instance
$query = new WP_Query( $args );

if ( $query->have_posts() ):
?>

	<?php if( !empty(cws_get_metabox('related_blog_posts')) && cws_get_metabox('related_blog_posts') != 'none' ) : ?>

		<div class="related-posts">
			<?php echo do_shortcode(cws_get_metabox('related_blog_posts')) ?>
		</div>

	<?php elseif( get_theme_mod('blog_related') && cws_get_metabox('related_blog_posts') != 'none' ) : ?>

		<div class="related-posts">

			<?php if( !empty(get_theme_mod('blog_related_title')) ) : ?>
                <div class="cws_textmodule">
                    <div class="cws_textmodule_info_wrapper">
                        <h5 class="cws_textmodule_title single-content-title">
                            <span class="cws_textmodule_title_text">
                                <?php echo esc_html( get_theme_mod('blog_related_title') ) ?>
                            </span>
                        </h5>
                    </div>
                </div>
			<?php endif ?>

			<div class="blog blog_grid layout_<?php echo esc_attr($columns) ?>">
				<div class="content_inner" data-columns="<?php echo esc_attr($columns) ?>">

					<?php if( $enable_carousel ) : ?>
						<div class="cws_carousel_wrapper" data-columns="<?php echo esc_attr($columns) ?>" data-pagination="on" data-draggable="on">
							<div class="cws_carousel">
					<?php endif; ?>

						<?php 
							while ( $query->have_posts() ): $query->the_post();

							$extra_class = 'post';
       
							$link_title = cws_get_metabox('format_link_title');
							$link_url = cws_get_metabox('format_link_url');
							$quote = cws_get_metabox('format_quote');

							if( ( get_post_format() == 'link' || get_post_format() == 'quote' ) && ( !empty(cws_get_metabox('format_link_title')) || !empty(cws_get_metabox('format_quote')) ) ){
									$extra_class .= ' spacing-top';
							}
						?>

							<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
                                <div class="post-inner">
                                    <?php if( !empty(promosys__post_featured( $hide_meta )) ) : ?>
                                        <div class="post-media-wrapper">
                                            <!-- Featured Media -->
                                            <?php echo promosys__post_featured( $hide_meta, get_theme_mod('blog_related_cropp') ) ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class='post-information'>
                                        <?php  if( (empty($link_title) && empty($link_url) || get_post_format() != 'link') && (empty($quote) ||
                                                get_post_format() != 'quote') ) { ?>
                                            
                                            <!-- Post Tags -->
                                            <?php echo promosys__post_tags( $hide_meta ) ?>
                                            
                                            <!-- Post Title -->
                                            <?php promosys__post_title( $hide_meta ) ?>
                                            
                                            <?php if ( strripos($hide_meta, 'title') === false && !empty(get_the_title()) && !empty(promosys__the_content(get_theme_mod('blog_related_text_length'), $hide_meta)) ) : ?>
                                                <div class="post-divider">
                                                    <div class="post-divider-inner"></div>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <!-- Post Content -->
                                            <?php if( !empty(promosys__the_content(get_theme_mod('blog_related_text_length'), $hide_meta)) ) : ?>
                                                <div class="post-content">
                                                    <?php echo promosys__the_content(get_theme_mod('blog_related_text_length'), $hide_meta) ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <!-- Post Categories -->
                                            <?php promosys__post_category( $hide_meta ) ?>
                                            
                                            <!-- Post Read More Button -->
                                            <?php echo promosys__read_more( get_theme_mod('blog_read_more'), $hide_meta, 'small' ) ?>
                                        
                                        <?php } ?>
                                        <!-- Post Footer -->
                                        <div class="post-footer">
                                            <?php
                                                if(
                                                    strripos($hide_meta, 'author') === false ||
                                                    strripos($hide_meta, 'date') === false ||
                                                    strripos($hide_meta, 'comments') === false
                                                ) {
                                                    promosys__post_author($hide_meta);
                                                    promosys__post_date($hide_meta, 'simple');
                                                    promosys__post_comments($hide_meta);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
							</div>

						<?php endwhile; ?>

					<?php if( $enable_carousel ) : ?>
							</div>
						</div>
					<?php endif; ?>

				</div>
			</div>

			<?php wp_reset_postdata() ?>
		</div>
		
	<?php endif ?>
<?php endif ?>