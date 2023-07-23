<?php
defined( 'ABSPATH' ) or die();
?>

<div id="post-<?php the_ID() ?>" <?php post_class( 'post' ) ?>>

    <?php
    $post_format = get_post_format();

    if( (!empty($post_format) && $post_format != 'chat') || has_post_thumbnail() ) :

        $post_format = empty($post_format) ? 'standard' : $post_format;
        ?>

        <?php switch( $post_format ){
        case 'gallery':
            $gallery = explode(',', cws_get_metabox('format_gallery'));
            if( is_array($gallery) && !empty(cws_get_metabox('format_gallery')) ) : ?>
                <div class="post-format format_gallery">
                    <div class="cws_carousel_wrapper" data-navigation="on" data-draggable="on" duto-height="on">
                        <div class="cws_carousel">
                            <?php
                            foreach ($gallery as $image) {
                                $alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                                $src = wp_get_attachment_image_src( $image, 'full' )[0];

                                echo "<img src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
                            }
                            ?>
                        </div>
                    </div>
                </div>

            <?php endif;
            break;
        case 'link':
            $link_title = cws_get_metabox('format_link_title');
            $link_url = cws_get_metabox('format_link_url');

            if( !empty($link_title) && !empty($link_url) ) {
                echo '<div class="post-format format_link">';
                    echo '<a href="' . esc_url($link_url) . '" target="_blank">' . esc_html($link_title) . '</a>';
                echo '</div>';
            }
            break;
        case 'quote':
            $quote_title = cws_get_metabox('format_quote');
            $quote_author = cws_get_metabox('format_quote_author');

            if( !empty($quote_title) ){
                echo '<div class="post-format format_quote">';
                    echo '<blockquote>';
                        echo '<p>' . esc_html($quote_title) . '</p>';
                        echo !empty($quote_author) ? '<cite>'.esc_html($quote_author).'</cite>' : '';
                    echo '</blockquote>';
                echo '</div>';
            }

            break;
        case 'video':
            $video = cws_get_metabox('format_video');

            if( !empty($video) ){
                echo '<div class="post-format format_video">';
                    echo apply_filters( "the_content", "[embed]".$video."[/embed]" );
                echo '</div>';
            }

            break;
        case 'audio':
            $audio = cws_get_metabox('format_audio');

            if( !empty($audio) ){
                echo '<div class="post-format format_audio">';
                    echo apply_filters( "the_content", "[embed]".$audio."[/embed]" );
                echo '</div>';
            }

            break;
        case 'chat':
            break;
        default:
            $pid = get_the_id();

            if( has_post_thumbnail() ){
                echo '<div class="post-format format_' . esc_attr($post_format) . '">';
                    $thumbnail_id = get_post_thumbnail_id($pid);

                    $thumb_title = get_post($thumbnail_id)->post_title;
                    $thumb_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    $thumb_alt = !empty($thumb_alt) ? $thumb_alt : $thumb_title;

                    the_post_thumbnail( 'full', array(
                        'alt' => esc_attr($thumb_alt),
                    ) );
                echo '</div>';
            }

            break;
    } ?>
    <?php
    endif;
    ?>

    <div class="post-inner">
        <div class="post-content">
            
            <?php if( !empty(get_the_tags()) ) : ?>
                <div class="post-meta">
                    <div class="post-tags">
                        <?php if( !empty(get_the_tags()) ){
                            the_tags('', ' ');
                        } ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="post-content-inner">
                <?php the_content(); ?>
            </div>

            <?php
                wp_link_pages( array(
                    'before'      => '<div class="paging-navigation in-post"><div class="pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'promosys' ) . '</span>',
                    'after'       => '</div></div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>

            <?php promosys__post_category('') ?>
            
        </div>

    </div>
</div>