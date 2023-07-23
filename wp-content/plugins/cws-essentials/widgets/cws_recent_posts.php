<?php
/**
 * CWS Recent Posts Widget Class
 */

class CWS_Recent_Posts extends WP_Widget {
	public function __construct() {
		$widget_options = array( 
		  'classname' => 'cws_recent_posts',
		  'description' => esc_html_x('Displays custom "CWS Recent Posts" widget', 'Widget CWS-Recent-Posts', 'cws-essentials'),
		);

		parent::__construct( 'cws_recent_posts', 'CWS Recent Posts', $widget_options );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$needle = array( '">', "'>" );
		$args['before_widget'] = str_replace($needle, ' cws-recent-posts">', $args['before_widget']);

		echo $args['before_widget'];
		if ( !empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		if( !empty( $instance['posts_count'] ) ){

			$arguments = array(
				'numberposts' => $instance['posts_count'],
				'category' => 0,
				'post_status' => 'publish'
			);
			$recent_posts = wp_get_recent_posts($arguments);


			echo '<ul class="recent_posts_wrapper">';
				foreach ($recent_posts as $post) {
					echo '<li>';
						echo get_the_post_thumbnail( $post['ID'], 'thumbnail' );
						echo '<div class="recent_post_content">';
                    
                            if ( function_exists('wpm') ) {
                                echo '<h6><a href="'.esc_url(get_permalink($post['ID'])).'">'.wpm_translate_string($post["post_title"]).'</a></h6>';
                            } else {
                                echo '<h6><a href="'.esc_url(get_permalink($post['ID'])).'">'.$post["post_title"].'</a></h6>';
                            }
                            
//                            echo '<span class="category">';
//                                the_category( ', ', '', $post['ID'] );
//                            echo '</span>';
                            echo '<span class="date">';
                                echo get_the_date( 'F j, Y', $post['ID'] );
                            echo '</span>';
						echo '</div>';
					echo '</li>';
				}
			echo '</ul>';
		}
		echo $args['after_widget'];

	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title = !empty( $instance['title'] ) ? $instance['title'] : esc_html_x( 'New widget', 'Widget CWS-Recent-Posts', 'cws-essentials' );
		$posts_count = !empty( $instance['posts_count'] ) ? $instance['posts_count'] : 3;
		?>
		
		<div class='widget-row'>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_html_x( 'Title:', 'Widget CWS-Recent-Posts', 'cws-essentials' ); ?>
			</label>
			<div class="widget-inner-content">
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</div>
		</div>

		<div class='widget-row'>
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts_count' ) ); ?>">
				<?php echo esc_html_x( 'Posts count:', 'Widget CWS-Recent-Posts', 'cws-essentials' ); ?>
			</label>
			<div class="widget-inner-content">
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('posts_count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('posts_count') ); ?>" type="number" value="<?php echo esc_attr($posts_count); ?>" />
			</div>
		</div>

		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( !empty($new_instance['title']) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['posts_count'] = ( !empty($new_instance['posts_count']) ) ? (int)$new_instance['posts_count'] : '';

		return $instance;
	}
}

?>