<?php

/**  Get custom metaboxes props  **/
require_once( 'cws_metaboxes.php' );


/**
 * Helper function for adding custom metaboxes
 * 
 * @return  void
 */
function cws_custom_metaboxes(){
    foreach( cws_setup_metaboxes() as $key => $value ){
        add_meta_box(
            $key,
            $value['title'],
            'cws_metaboxes_html',
            $value['screen'],
            $value['context'],
            $value['priority'],
            array( 'key' => $key )
        );
    }
}
add_action('add_meta_boxes', 'cws_custom_metaboxes');


/**
 * The helper function that will used to get
 * custom post types slugs
 *
 * @return  string
 */
function cws_get_slug($slug) {
    $new_slug = get_theme_mod($slug.'_slug');

    $new_slug = !empty($new_slug) ? $new_slug : $slug;

    return sanitize_title($new_slug);
}


/**
 * Output of the custom metaboxes
 * 
 * @return  html
 */
function cws_metaboxes_html( $post, $callback_args ){
    $out = '';
    $key = $callback_args['args']['key'];

    $value = cws_get_metabox($key);

    foreach( cws_setup_metaboxes() as $current_key => $prop ){
        if( $key == $current_key ){
            $dependency = !empty($prop['dependency']) ? 'data-depend-by="'.$prop['dependency']['field'].'" data-depend-operator="'.$prop['dependency']['operator'].'" data-depend-value="'.$prop['dependency']['value'].'"' : '';

            $out .= '<div class="custom_metabox '.( !empty($dependency) ? 'hidden_metabox' : '' ).'" '.$dependency.'>';

                if( $prop['type'] == 'text' ){

                    $out .= '<input name="cws_'.esc_attr($key).'" id="cws_'.esc_attr($key).'" class="cws_custom_meta" type="text" value="'.esc_attr($value).'" />';
                    if( !empty($prop['description']) ){
                        $out .= '<p class="description">'.esc_html($prop['description']).'</p>';
                    }

                } else if( $prop['type'] == 'textarea' ){

                    $out .= '<textarea class="cws_custom_meta" name="cws_'.esc_attr($key).'" id="cws_'.esc_attr($key).'" rows="4">'.esc_attr($value).'</textarea>';
                    if( !empty($prop['description']) ){
                        $out .= '<p class="description">'.esc_html($prop['description']).'</p>';
                    }

                } else if( $prop['type'] == 'select' ){

                    $out .= '<select name="cws_'.esc_attr($key).'" id="cws_'.esc_attr($key).'">';
                        foreach( $prop['input_attr'] as $opt_key => $opt_value ){
                            $out .= '<option value="'.esc_attr($opt_key).'" '.( $value == $opt_key ? 'selected' : '' ).'>'.esc_html($opt_value).'</option>';
                        }
                    $out .= '</select>';
                    if( !empty($prop['description']) ){
                        $out .= '<p class="description">'.esc_html($prop['description']).'</p>';
                    }

                } else if( $prop['type'] == 'checkbox' ){

                    $checked = $value == 'on' ? 'checked="checked"' : '';

                    $out .= '<input type="hidden" name="cws_'.$key.'" value="off" />';
                    $out .= '<input type="checkbox" name="cws_'.$key.'" id="cws_'.$key.'" '.$checked.' />';
                    
                    $out .= '<label for="cws_'.$key.'">'.$prop['title'].'</label>';

                    if( !empty($prop['description']) ){
                        $out .= '<p class="description">'.esc_html($prop['description']).'</p>';
                    }

                } else if( $prop['type'] == 'image' || $prop['type'] == 'gallery' ){

                    $image = wp_get_attachment_image_src( cws_get_metabox($key), 'full' );

                    $out .= '<a href="#" class="'. ( $prop['type'] == 'image' ? 'cws_upload_image' : 'cws_upload_gallery' ) . ( $image ? '' : ' button' ) .'">';
                        if( strpos( cws_get_metabox($key), ',' ) !== false ){
                            $gallery = explode(',', cws_get_metabox($key));

                            $out .= '<div class="gallery">';
                                foreach( $gallery as $img ){
                                    $out .= '<img src="'.wp_get_attachment_image_src( $img, 'full' )[0].'" />';
                                }
                            $out .= '</div>';
                        } else {
                            $out .= $image ? '<img src="'.$image[0].'" />' : esc_html_x('Upload', 'backend', 'cws-essentials');
                        }
                    $out .= '</a>';

                    $out .= '<input type="hidden" name="cws_'.$key.'" id="cws_'.$key.'" value="'.esc_attr($value).'" />';

                    $out .= '<a href="#" class="cws_remove_image" style="display:'.($image ? 'inline-block' : 'none').'">'.esc_html_x('Remove', 'backend', 'cws-essentials').'</a>';

                } else if( $prop['type'] == 'repeater' ){

                    $button_title = !empty($prop['button']) ? esc_html($prop['button']) : 'Add New';

                    $out .= '<ul>';

                        $parsed_value = !empty($value) ? (array)json_decode($value) : array('empty');

                        foreach( $parsed_value as $parsed_v ){
                            $parsed_v = (array)$parsed_v;

                            $out .= '<li>';
                                foreach ($prop['fields'] as $k => $v){

                                    // Avoid warnings
                                    if( isset($parsed_v[0]) && $parsed_v[0] == 'empty' ){
                                        $parsed_v[$k] = '';
                                    }

                                    $out .= '<div class="metabox_repeater_field type_'.esc_attr($v["type"]).'">';
                                    switch( $v['type'] ){
                                        case 'text':
                                            $out .= '<label for="'.esc_attr($k).'">'.esc_html($v["title"]).'</label>';
                                            $out .= '<input id="'.esc_attr($k).'" type="text" value="'.$parsed_v[$k].'" />';
                                            break;
                                        case 'icon':
                                            $out .= '<label>'.esc_html($v["title"]).'</label>';
                                            $out .= '<div class="sneaky-select">';
                                                $out .='<div class="sneaky-selected"></div>';
                                                $out .='<div class="sneaky-items-list">';
                                                    foreach( cws_get_all_flaticon_icons() as $icon ){
                                                        $out .= "<div class='sneaky-item' data-value='".$icon."'><i class='flaticon-".$icon."'></i>- ".$icon."</div>";
                                                    }
                                                $out .='</div>';
                                            $out .= '</div>';
                                            $out .= '<input id="'.esc_attr($k).'" class="sneaky-input" type="hidden" value="'.$parsed_v[$k].'" />';
                                            break;
                                    }
                                    $out .= '</div>';
                                }
                                $out .= '<i class="dublicate_metabox_repeater_field"></i>';
                                $out .= '<i class="remove_metabox_repeater_field"></i>';
                            $out .= '</li>';
                        }

                    $out .= '</ul>';

                    $out .= '<a class="button metabox_repeater_add_new">'.esc_html($button_title).'</a>';

                    $out .= "<input type='hidden' name='cws_".$key."' id='cws_".$key."' value='".$value."' />";

                } else if( $prop['type'] == 'radio' ){

                    foreach( $prop['input_attr'] as $k => $v ){

                        if( $prop['format'] != 'image' ){
                            $out .= '<label for="'.$k.'">'.esc_html($v).'</label>';
                        }

                        $checked = $value == $v ? 'checked="checked"' : '';

                        $out .= '<input class="format_'.( $prop['format'] == 'image' ? 'image' : 'default' ).'" type="radio" name="cws_'.$key.'" id="'.$k.'" value="'.$v.'" '.$checked.' style="'.( $prop['format'] == 'image' ? 'background-image: url('.get_template_directory_uri() . '/admin/img/'.$v.')' : '' ).'"  />';

                    }

                }

            $out .= '</div>';
        }
    }

    echo sprintf('%s', $out);
}

/**
 * Helper function for save custom metaboxes
 * 
 * @return  void
 */
function cws_save_metaboxes( $post_id ){
    foreach( cws_setup_metaboxes() as $key => $value ){

        if( array_key_exists('cws_'.$key, $_POST) ){
            update_post_meta(
                $post_id,
                '_cws_'.$key,
                $_POST['cws_'.$key]
            );
        }

    }
}
add_action('save_post', 'cws_save_metaboxes');

?>