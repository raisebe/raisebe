<?php
/**
 * CWS About Widget Class
 */

class CWS_About extends WP_Widget {
	public function __construct() {
		$widget_options = array( 
		  'classname' => 'cws_about',
		  'description' => esc_html_x('Displays custom "CWS About" widget', 'Widget CWS-About', 'cws-essentials'),
		);

		parent::__construct( 'cws_about', 'CWS About', $widget_options );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$needle = array( '">', "'>" );
		$args['before_widget'] = str_replace($needle, ' cws-about">', $args['before_widget']);

		echo $args['before_widget'];

		if ( !empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		if( !empty( $instance['image_1'] ) ){
			echo '<div class="avatar-wrapper">';
				echo '<img class="avatar" src="'.esc_url($instance["image_1"]).'" alt="" />';
			echo '</div>';
		}
		if ( !empty( $instance['name'] ) ) {
			echo '<h6 class="name">'.esc_html($instance["name"]).'</h6>';
		}
		if ( !empty( $instance['description'] ) ) {
			echo '<p class="description">'.esc_html($instance['description']).'</p>';
		}
		if( !empty( $instance['image_2'] ) ){
			echo '<div class="signature-wrapper">';
				echo '<img class="signature" src="'.esc_url($instance["image_2"]).'" alt="" />';
			echo '</div>';
		}
        if ( !empty( $instance['button_link'] ) && !empty( $instance['button_title'] ) ) {
            echo '<div class="signature-button cws_button_wrapper">';
                echo '<a href="'.esc_url($instance["button_link"]).'" class="cws_button small arrow_fade_in shadow">';
                    echo '<span>'.esc_html($instance["button_title"]).'</span>';
                echo '</a>';
            echo '</div>';
        }

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$title = !empty( $instance['title'] ) ? $instance['title'] : esc_html_x( 'New widget', 'Widget CWS-About', 'cws-essentials' );
		$name = !empty( $instance['name'] ) ? $instance['name'] : esc_html_x( 'John Doe', 'Widget CWS-About', 'cws-essentials' );
		$description = !empty( $instance['description'] ) ? $instance['description'] : esc_html_x( 'Lorem ipsum dolor sit amet', 'Widget CWS-About', 'cws-essentials' );

        $button_link = !empty( $instance['button_link'] ) ? $instance['button_link'] : esc_html_x( '', 'Widget CWS-About', 'cws-essentials' );
        $button_title = !empty( $instance['button_title'] ) ? $instance['button_title'] : esc_html_x( 'Read More', 'Widget CWS-About', 'cws-essentials' );
		?>
		
		<div class='widget-row'>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_html_x( 'Title:', 'Widget CWS-About', 'cws-essentials' ); ?>
			</label>
			<div class="widget-inner-content">
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</div>
		</div>

		<div class='widget-row'>
	        <label for="<?php echo $this->get_field_id( 'image_1' ); ?>">
	        	<?php echo esc_html_x( 'Image:', 'Widget CWS-About', 'cws-essentials' ); ?>
	        </label>
	        <div class="widget-inner-content img-inside">
		        <img class="<?php echo $this->get_field_id( 'image_1' ) ?>_img" src="<?php echo (!empty($instance['image_1'])) ? $instance['image_1'] : ''; ?>" />
		        <input hidden type="text" class="widefat <?php echo $this->get_field_id( 'image_1' ) ?>_url" name="<?php echo esc_attr( $this->get_field_name( 'image_1' ) ); ?>" value="<?php echo !empty($instance['image_1']) ? $instance['image_1'] : ''; ?>" />
		        <button type="button" id="<?php echo $this->get_field_id( 'image_1' ) ?>" class="button js_custom_upload_media<?php echo empty($instance['image_1']) ? ' empty' : ''; ?>"><?php echo esc_html_x('No file selected', 'Widget CWS-About', 'cws-essentials') ?></button>
		        <button id="<?php echo $this->get_field_id( 'image_1' ).'_remove' ?>" type="button" class="button js_custom_remove_media"></button>
	        </div>
	    </div>

	    <div class='widget-row'>
			<label for="<?php echo $this->get_field_id( 'name' ) ?>">
				<?php echo esc_html_x( 'Name:', 'Widget CWS-About', 'cws-essentials' ); ?>
			</label>
			<div class="widget-inner-content">
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('name') ); ?>" type="text" value="<?php echo esc_attr($name); ?>" />
			</div>
		</div>

	    <div class='widget-row'>
	    	<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ) ?>">
				<?php echo esc_html_x( 'Description:', 'Widget CWS-About', 'cws-essentials' ); ?>
			</label>
			<div class="widget-inner-content">
				<input type="text" hidden class="widefat hidden textarea" name="<?php echo $this->get_field_name( 'description' ); ?>" id="<?php echo esc_attr( $this->get_field_id('description') ) ?>" value="<?php echo esc_attr($description); ?>" />
		    	<textarea rows="3" class="widget_textarea_control"><?php echo esc_html($description) ?></textarea>
	    	</div>
	    </div>

	    <div class='widget-row'>
	        <label for="<?php echo $this->get_field_id( 'image_2' ); ?>">
	        	<?php echo esc_html_x( 'Signature:', 'Widget CWS-About', 'cws-essentials' ); ?>
	        </label>
	        <div class="widget-inner-content img-inside">
		        <img class="<?php echo $this->get_field_id( 'image_2' ) ?>_img" src="<?php echo !empty($instance['image_2']) ? $instance['image_2'] : ''; ?>" />
		        <input hidden type="text" class="widefat <?php echo $this->get_field_id( 'image_2' ) ?>_url" name="<?php echo esc_attr( $this->get_field_name( 'image_2' ) ); ?>" value="<?php echo !empty($instance['image_2']) ? $instance['image_2'] : ''; ?>" />
		        <button type="button" id="<?php echo $this->get_field_id( 'image_2' ) ?>" class="button js_custom_upload_media<?php echo empty($instance['image_2']) ? ' empty' : ''; ?>"><?php echo esc_html_x('No file selected', 'Widget CWS-About', 'cws-essentials') ?></button>
		        <button id="<?php echo $this->get_field_id( 'image_2' ).'_remove' ?>" type="button" class="button js_custom_remove_media"></button>
	        </div>
	    </div>

        <div class='widget-row'>
            <label for="<?php echo $this->get_field_id( 'button_link' ) ?>">
                <?php echo esc_html_x( 'Button link:', 'Widget CWS-About', 'cws-essentials' ); ?>
            </label>
            <div class="widget-inner-content">
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('button_link') ); ?>" name="<?php
                echo
                esc_attr( $this->get_field_name('button_link') ); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" />
            </div>
        </div>

        <div class='widget-row'>
            <label for="<?php echo $this->get_field_id( 'button_title' ) ?>">
                <?php echo esc_html_x( 'Button title:', 'Widget CWS-About', 'cws-essentials' ); ?>
            </label>
            <div class="widget-inner-content">
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('button_title') ); ?>" name="<?php
                echo
                esc_attr( $this->get_field_name('button_title') ); ?>" type="text" value="<?php echo esc_attr($button_title); ?>" />
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
		$instance['image_1'] = strip_tags( $new_instance['image_1'] );
		$instance['name'] = ( !empty($new_instance['name']) ) ? sanitize_text_field( $new_instance['name'] ) : '';
		$instance['description'] = ( !empty($new_instance['description']) ) ? sanitize_text_field( $new_instance['description'] ) : '';
		$instance['image_2'] = strip_tags( $new_instance['image_2'] );
        $instance['button_link'] = ( !empty($new_instance['button_link']) ) ? sanitize_text_field( $new_instance['button_link'] ) : '';
        $instance['button_title'] = ( !empty($new_instance['button_title']) ) ? sanitize_text_field( $new_instance['button_title'] ) : '';

		return $instance;
	}
}

?>