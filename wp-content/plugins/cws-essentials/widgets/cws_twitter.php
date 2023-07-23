<?php
/**
 * CWS Twitter Widget Class
 */

class CWS_Twitter extends WP_Widget {
	public function __construct() {
		$widget_options = array( 
		  'classname' => 'cws_twitter',
		  'description' => esc_html_x('Displays custom "CWS Twitter" widget', 'Widget CWS-Twitter', 'cws-essentials'),
		);

		parent::__construct( 'cws_twitter', 'CWS Twitter', $widget_options );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$needle = array( '">', "'>" );
		$args['before_widget'] = str_replace($needle, '">', $args['before_widget']);

		echo $args['before_widget'];

		if ( !empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

        $out = '';
        $tw_username = trim($instance['username']) ? trim($instance['username']) : 'Creative_WS';

        if ( !is_numeric( $instance['items'] ) || !is_numeric( $instance['visible'] ) ) return $out;

        if (function_exists('getTweets')) {
            $tweets = getTweets($tw_username, (int)$instance['items']);
        } else {
            $tweets = '';
        }

        if ( is_string( $tweets ) ) {
            $out .= do_shortcode( "[cws_sc_info_box style='warning' title='" . esc_attr__( 'Twitter responds:', 'cws-essentials' ) . "' description='$tweets' closable='1'][/cws_sc_info_box]" );
        } else if ( is_array( $tweets ) && isset($tweets['error']) ){
            echo esc_html($tweets['error']);
        } else if ( is_array( $tweets ) ) {
            $use_carousel = count( $tweets ) > $instance['visible'];
            $section_class = "cws_tweets";
            $section_class .= $use_carousel ? " cws_carousel_wrapper" : '';

            $section_atts = " data-columns='".$instance['visible']."'";
            $section_atts .= " data-pagination='on'";
            $section_atts .= " data-auto-height='on'";
            $section_atts .= " data-draggable='on'";

            //Reg-exp for links
            $find_links = "/(https?:\/\/|ftp:\/\/|www\.)((?![.,?!;:()]*(\s|$))[^\s]){2,}/";

            $out .= "<div class='".esc_attr($section_class)."'".$section_atts.">";
            $out .= "<div class='" . ( $use_carousel ? "cws_carousel " : "") . "cws_wrapper'>";
            $carousel_item_closed = false;

            for ( $i=0; $i<count( $tweets ); $i++ ) {
                $tweet = $tweets[$i];

                if ( $use_carousel && ( $i == 0 || $carousel_item_closed ) ) {
                    wp_enqueue_script('slick-slider');
                    $out .= "<div class='item'>";
                    $carousel_item_closed = false;
                }

                //Remove image links from text
                $tweet_text = preg_replace($find_links, '', $tweet['text']);
                $tweet_entitties = isset( $tweet['entities'] ) ? $tweet['entities'] : array();
                $tweet_urls = isset( $tweet_entitties['urls'] ) && is_array( $tweet_entitties['urls'] ) ? $tweet_entitties['urls'] : array();

                foreach ( $tweet_urls as $tweet_url ) {
                    $display_url = isset( $tweet_url['display_url'] ) ? $tweet_url['display_url'] : '';
                    $received_url = isset( $tweet_url['url'] ) ? $tweet_url['url'] : '';
                    $tweet_text  .= "<a href='".esc_url($received_url)."'>".esc_html($display_url)."</a>";
                }

                $item_content = '';
                $item_content .= !empty( $tw_username ) ? "<a href='".esc_url("https://twitter.com/" . $tw_username)."' class='tweet_author' target='_blank' title='@" . esc_attr($tw_username) . "'></a>" : "";
                $item_content .= !empty( $tweet_text ) ? "<div class='tweet_content'>$tweet_text</div>" : '';
                if ( $instance['showdate'] ) {
                    $tweet_date = isset( $tweet['created_at'] ) ? $tweet['created_at'] : '';
                    $tweet_date_formatted = sprintf(
                            esc_html_x( '%s', 'Widget CWS-Twitter', 'cws-essentials' ),
                            human_time_diff( date( "U", strtotime( $tweet_date )), current_time( 'timestamp' ) )
                    );
                    $item_content .= "<div class='tweet_date'>$tweet_date_formatted</div>";
                }

                $out .= !empty( $item_content ) ? "<div class='cws_tweet'>$item_content</div>" : '';
                $temp1 = ( $i + 1 ) / (int)$instance['visible'];
                if ( $use_carousel && ( $temp1 - floor( $temp1 ) == 0 || $i == count( $tweets ) - 1 ) ) {
                    $out .= "</div>";
                    $carousel_item_closed = true;
                }
            }

            $out .= "</div>";
            $out .= "</div>";
        }

        echo sprintf('%s', $out);

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title = !empty( $instance['title'] ) ? $instance['title'] : esc_html_x( 'New widget', 'Widget CWS-Twitter', 'cws-essentials' );
		$username = !empty( $instance['username'] ) ? $instance['username'] : 'Creative_WS';
		$items = !empty( $instance['items'] ) ? $instance['items'] : '1';
		$visible = !empty( $instance['visible'] ) ? $instance['visible'] : '1';
        $showdate = !empty( $instance['showdate'] ) ? true : false;
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_html_x( 'Title:', 'Widget CWS-Twitter', 'cws-essentials' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>">
                <?php echo esc_html_x( 'Username:', 'Widget CWS-Twitter', 'cws-essentials' ); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('username') ); ?>" name="<?php echo esc_attr( $this->get_field_name('username') ); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
        </p>

	    <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'items' ) ); ?>">
                <?php echo esc_html_x( 'Tweets to extract:', 'Widget CWS-Twitter', 'cws-essentials' ); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id('items') ); ?>" name="<?php echo esc_attr( $this->get_field_name('items') ); ?>" type="number" value="<?php echo esc_attr($items); ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'visible' ) ); ?>">
                <?php echo esc_html_x( 'Tweets to show:', 'Widget CWS-Twitter', 'cws-essentials' ); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id('visible') ); ?>" name="<?php echo esc_attr( $this->get_field_name('visible') ); ?>" type="number" value="<?php echo esc_attr($visible); ?>" />
        </p>

        <p>
            <?php $checked = $showdate == true ? 'checked="checked"' : ''; ?>
            <input class="checkbox" id="<?php echo esc_attr( $this->get_field_id('showdate') ); ?>" name="<?php echo esc_attr( $this->get_field_name('showdate') ); ?>" type="checkbox" <?php echo sprintf('%s', $checked); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'showdate' ) ); ?>">
                <?php echo esc_html_x( 'Show date?', 'Widget CWS-Twitter', 'cws-essentials' ); ?>
            </label>
        </p>

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
		$instance['username'] = ( !empty($new_instance['username']) ) ? sanitize_text_field( $new_instance['username'] ) : '';
		$instance['items'] = ( !empty($new_instance['items']) ) ? sanitize_text_field( $new_instance['items'] ) : '';
		$instance['visible'] = ( !empty($new_instance['visible']) ) ? sanitize_text_field( $new_instance['visible'] ) : '';
        $instance['showdate'] = ( !empty($new_instance['showdate']) ) ? sanitize_text_field( $new_instance['showdate'] ) : '';

		return $instance;
	}
}

?>