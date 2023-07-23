<?php
/*
Plugin Name: CWS Essentials
Description: Internal use for cwsthemes themes only.
Version:     1.0.1
Author:      CWSThemes
Author URI:  http://cwsthemes.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: cws-essentials
*/
if( !defined('ABSPATH') ){
	exit;
}

require_once( 'metaboxes/metaboxes_exec.php' );
require_once( 'cws_headers.php' );
require_once( 'cws_staff.php' );
require_once( 'cws_portfolio.php' );

if( class_exists('Vc_Manager') ){
    function separator_settings_field( $settings, $value ) {
        $out = '<div class="cws-separator">';
        $out .= '<hr/>';
        $out .= '<input name="'.esc_attr($settings['param_name']).'" ';
        $out .= 'class="wpb_vc_param_value wpb-textinput '.
            esc_attr( $settings['param_name'] ) . ' ' .
            esc_attr( $settings['type'] ).'_field" ';
        $out .='type="hidden" value="'.esc_attr($value).'"/>';
        $out .= '</div>';
        
        return $out;
    }
    vc_add_shortcode_param( 'separator', 'separator_settings_field' );
    
    function placeholder_settings_field( $settings, $value ) {
        $out = '<div class="cws-placeholder">';
        $out .= '<input name="'.esc_attr($settings['param_name']).'" ';
        $out .= 'class="wpb_vc_param_value wpb-textinput '.
            esc_attr( $settings['param_name'] ) . ' ' .
            esc_attr( $settings['type'] ).'_field" ';
        $out.='type="hidden" value="'.esc_attr($value).'"/>';
        $out .= '</div>';
        
        return $out;
    }
    vc_add_shortcode_param( 'placeholder', 'placeholder_settings_field' );
}

if ( !class_exists( "CWS_Essentials" ) ){
	class CWS_Essentials {

		public function __construct(){
			add_action( 'wp_head', array( $this, 'cws_ajaxurl' ) );
		}

		public function cws_ajaxurl() {
		    echo '<script type="text/javascript">
		           var cws_ajaxurl = "' . admin_url('admin-ajax.php') . '";
		         </script>';
		}

		public function cws_register_widgets( $widgets ){
			foreach( $widgets as $w ){
				$php = PROMOSYS__PLUGINS_DIR . 'cws-essentials/widgets/' . strtolower($w) . '.php';

				if( file_exists($php) ){
					require_once $php;
					register_widget($w);
				}
			}
		}

		public function cws_get_file_contents( $file ){
			return file_get_contents($file);
		}
		
	}
}

$essentials = new CWS_Essentials();
    
    
    
    if (!defined('CWSESSENTIALS_PLUGIN_NAME'))
        define('CWSESSENTIALS_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));
    
    if (!defined('CWSESSENTIALS_PLUGIN_DIR'))
        define('CWSESSENTIALS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . CWSESSENTIALS_PLUGIN_NAME);
    
    if (!defined('CWSESSENTIALS_PLUGIN_URL'))
        define('CWSESSENTIALS_PLUGIN_URL', plugins_url() . '/' . CWSESSENTIALS_PLUGIN_NAME);



    
    function cws_core_cwsfw_get_grouped_types() {
        return array('tab');
    }
    
    function cws_core_cwsfw_fillMbAttributes($meta, &$attr, $prefix = '') {
        foreach ($meta as $k => $v) {
            $entry = !empty($prefix) ? $prefix . "[$k]" : $k;
            //$attr_k = &$attr[$k];
            
            $attr_k = &cws_core_cwsfw_find_array_keys($attr, $entry);
            if ($attr_k) {
                switch ($attr_k['type']) {
                    case 'text':
                    case 'number':
                    case 'textarea':
                    case 'datetime':
                    case 'gallery':
                        $attr_k['value'] = htmlentities(stripslashes($v));
                        break;
                    case 'media':
                        if (isset($attr_k['layout'])) {
                            cws_core_cwsfw_fillMbAttributes($v, $attr_k['layout']);
                        }
                        $attr_k['value'] = $v;
                        break;
                    case 'radio':
                        if (is_array($attr_k['value'])) {
                            foreach ($attr_k['value'] as $key => $val) {
                                if ($key == $v) {
                                    $attr_k['value'][$key][1] = true;
                                } else {
                                    $attr_k['value'][$key][1] = false;
                                }
                            }
                        }
                        break;
                    case 'checkbox':
                        $atts = '';
                        if (isset($attr_k['atts'])) {
                            $atts = $attr_k['atts'];
                        }
                        if ('on' === $v || '1' == $v) {
                            $atts .= ' checked';
                            $attr_k['atts'] = $atts;
                        } else {
                            $attr_k['atts'] = str_replace('checked', '', $atts);
                        }
                        break;
                    case 'group':
                        if (!empty($v)) {
                            $attr_k['value'] = $v;
                        }
                        break;
                    case 'dimensions':
                    case 'margins':
                        foreach ($v as $key => $value) {
                            if (isset($attr_k['value'][$key])) {
                                $attr_k['value'][$key]['value'] = $value;
                            }
                        }
                        break;
                    case 'font':
                        foreach ($v as $key => $value) {
                            $attr_k['value'][$key] = $value;
                        }
                        break;
                    case 'taxonomy':
                    case 'post_type':
                    case 'select':
                        if (is_array($attr_k['source']) /*&& !empty($v)*/) {
                            //Empty values in listbox, if check values (Issue), comment it condition its FIX
                            foreach ($attr_k['source'] as $key => $value) {
                                $attr_k['source'][$key][1] = false; // reset all
                            }
                            if (is_array($v)) {
                                foreach ($v as $key => $value) {
                                    if ( !empty($value) && '!!!dummy!!!' !== $value ) {
                                        $attr_k['source'][$value][1] = true;
                                    }
                                }
                            } else {
                                $attr_k['source'][$v][1] = true;
                            }
                        } else {
                            if (is_string($v)) {
                                $attr_k['source'] .= ' ' . $v;
                            } else {
                                $attr_k['source'] = null;
                            }
                        }
                        break;
                    case 'fields':
                        cws_core_cwsfw_fillMbAttributes($v, $attr_k['layout'], $prefix);
                        break;
                    default:
                        break;
                }
            }
        }
    }
    
    function &cws_core_cwsfw_find_array_keys(&$attr, $key) {
        $ret = null;
        $non_grouped = cws_core_cwsfw_get_grouped_types();
        if (isset($attr[$key]) && !in_array($attr[$key]['type'], $non_grouped)) {
            $ret = &$attr[$key];
        } else {
            foreach ($attr as $k=>&$value) {
                if (isset($value['layout'][$key])) {
                    $ret = &$value['layout'][$key];
                    break;
                }
            }
        }
        return $ret;
    }
    
    function cws_core_cwsfw_print_layout ($layout, $prefix, &$values = null) {
        $out = '';
        $isTabs = false;
        $isCustomizer = is_customize_preview();
        $tabs = array();
        $bIsWidget = '[' === substr($prefix, -1);
        $tabs_idx = 0;
        $current_wn_to = false;
        global $current_screen;
        if(isset($current_screen->id) && $current_screen->id == 'toplevel_page_cwsfw'){
            $current_wn_to = true;
        }
        
        foreach ($layout as $key => $v) {
            if (isset($v['customizer']) && !$v['customizer']['show'] && $isCustomizer) continue;
            if ($bIsWidget && empty($v)) continue;
            $row_classes = isset($v['rowclasses']) ? $v['rowclasses'] : 'row row_options ' . $key;
            $row_classes = isset($v['addrowclasses']) ? $row_classes . ' ' . $v['addrowclasses'] : $row_classes;
            
            $row_atts = isset($v['row_atts']) ? ' ' . $v['row_atts'] : '';
            
            $row_atts = $v['type'] === 'media' ? $row_atts . ' data-role="media"' : $row_atts;
            
            if (isset($values) && isset($v['value']) ) {
                $values[$key] = $v['value'];
            }
            
            if ($bIsWidget) {
                $a = strpos($key, '[');
                if (false !== $a) {
                    $name = substr($key, 0, $a) . ']' . substr($key, $a, -1) . ']';
                } else {
                    $name = $key . ']';
                }
            } else {
                $name = $key;
            }
            $salt = '';
            if ('module' !== $v['type'] && 'tab' !== $v['type']) {
                $out .= '<div class="' . $row_classes . '"' . $row_atts . '>';
                if (isset($v['label']) || isset($v['title'])) {
                    if ('checkbox' === $v['type']) {
                        $salt = '_' . time()*rand(1,1024);
                    }
                    $cws_print_title = isset($v['title']) ? $v['title'] : (isset($v['label']) ? $v['label'] : '' );
                    $out .= '<label for="' . $prefix . $name . $salt . '">' . $cws_print_title . '</label>';
                    if (isset($v['tooltip']) && is_array($v['tooltip']) ) {
                        $out .= '<div class="cwsfw-qtip dashicons-before" title="' . $v['tooltip']['title'] . '" qt-content="'
                            .$v['tooltip']['content'].'">';
                        $out .= '</div>';
                    }
                }
                $out .= "<div>";
            }
            if(!$current_wn_to){
                $value = isset($v['value']) && !is_array($v['value']) ? ' value="' . htmlspecialchars_decode($v['value']) . '"' : '';
            }else{
                $value = isset($v['value']) && !is_array($v['value']) ? ' value="' . $v['value'] . '"' : '';
            }
            
            $atts = isset($v['atts']) ? ' ' . $v['atts'] : '';
            switch ($v['type']) {
                case 'text':
                case 'number':
                    $ph = isset($value['placeholder']) ? ' placeholder="' . $value['placeholder'] . '"' : '';
                    if (isset($v['verification'])) {
                        $atts .= ' data-verification="' . esc_attr( str_replace('"', '\'', json_encode($v['verification'])) ) . '"';
                    }
                    $out .= '<input type="'. $v['type'] .'" name="'. $prefix . $name .'"' . $value . $atts . $ph . '>';
                    break;
                case 'info':
                    $subtype = isset($v['subtype']) ? $v['subtype'] : 'info';
                    $out .= '<div class="'. $subtype .'">';
                    if (isset($v['icon']) && is_array($v['icon'])) {
                        $out .= '<div class="info_icon">';
                        switch ($v['icon'][0]) {
                            case 'fa':
                                $out .= "<i class='fa fa-2x fa-{$v['icon'][1]}'></i>";
                                break;
                        }
                        $out .= '</div>';
                    }
                    $out .= '<div class="info_desc">';
                    $out .= $v['value'];
                    $out .= '</div>';
                    $out .= '<div class="clear"></div>';
                    $out .= '</div>';
                    break;
                case 'checkbox':
                    $value = ' value="1"';
                    if (!empty($atts) && false !== strpos($atts, 'checked')) {
                        $values[$key] = '1';
                    } else {
                        $values[$key] = '0';
                    }
                    $out .= '<input type="hidden" name="'. $prefix . $name .'" value="0">';
                    $out .= '<input type="'. $v['type'] .'" name="'. $prefix . $name .'" id="' . $prefix . $name . $salt.'"' . $value . $atts . '>';
                    $out .= '<label for="' . $prefix . $name . $salt.'">'. (isset($v['label']) ? $v['label'] : '') .'</label>';
                    break;
                case 'radio':
                    $radio_cols = isset($v['cols']) ? (int)$v['cols'] : 0;
                    if (isset($v['subtype']) && 'images' === $v['subtype']) {
                        $out .= '<ul class="cws_image_select">';
                        foreach ($v['value'] as $k => $value) {
                            $selected = '';
                            $selected_class = '';
                            if (isset($value[1]) && true === $value[1]) {
                                $selected = ' checked';
                                $values[$key] = $k;
                            }
                            $out .= '<li class="image_select' . $selected . '">';
                            $out .= '<div class="cws_img_select_wrap">';
                            $src = $value[3];
                            if (substr($value[3], 0, 4) === '/img') {
                                $src = CWSESSENTIALS_PLUGIN_URL . $src;
                            }
                            $out .= '<img src="' . $src . '" alt="image"/>';
                            $data_options = !empty($value[2]) ? ' data-options="' . $value[2] . '"' : '';
                            $out .= '<input type="'. $v['type'] .'" name="'. $prefix. $name . '" value="' . $k . '" title="' . $k . '"' .  $data_options . $selected . '/>' . $value[0] . '<br/>';
                            $out .= '</div>';
                            $out .= '</li>';
                        }
                        $out .= '<div class="clear"></div>';
                        $out .= '</ul>';
                    } else {
                        $i = 0;
                        $br = $radio_cols ? '' : '<br/>';
                        foreach ($v['value'] as $k => $value) {
                            $selected = '';
                            if (isset($value[1]) && true === $value[1]) {
                                $selected = ' checked="checked"';
                                $values[$key] = $k;
                            }
                            $data_options = !empty($value[2]) ? ' data-options="' . $value[2] . '"' : '';
                            $out .= '<input type="'. $v['type'] .'" name="'. $prefix. $name . '" value="' . $k . '" title="' . $k . '"' .  $data_options . $selected . '>' . $value[0] . $br;
                            $i++;
                            if ($radio_cols && $i === $radio_cols) {
                                $out .= '<br/>';
                                $i = 0;
                            }
                        }
                    }
                    break;
                case 'insertmedia':
                    $out .= '<div class="cws_tmce_buttons">';
                    $out .= 	'<a href="#" id="insert-media-button" class="button insert-media add_media" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>';
                    $out .= 	'<div class="cws_tmce_controls">';
                    $out .= 	'<a href="#" id="cws-switch-text" class="button" data-editor="content" data-mode="tmce" title="Switch to Text">Switch to Text</a>';
                    $out .= '</div></div>';
                    break;
                case 'fields':
                    $out .= '<div class="cwsfw_fields">';
                    $values[$key] = array();
                    $out .= cws_core_cwsfw_print_layout( $v['layout'], $prefix . $name . '[', $values[$key], true ); // here would be a template stored
                    $out .= '</div>';
                    break;
                case 'group':
                    if (isset($v['value'])) {
                        $out .= '<script type="text/javascript" class="cwsfe_group_values" data-field_name="'.$prefix .$key .(!empty($prefix) ? ']' : '').'" data-field_value=\''.json_encode($v['value']).'\'>';
                        // $out .= 'if(undefined===window[\'cws_groups\']){window[\'cws_groups\']={};}';
                        // $out .= 'window[\'cws_groups\'][\'' . $prefix .$key .(!empty($prefix) ? ']' : '').'\']=\'' . json_encode($v['value']) . '\';';
                        // $out .= 'window[\'cws_groups\'][\'' . $key .'\']=\'' . json_encode($v['value']) . '\';';
                        $out .= '</script>';
                    }
                    $out .= '<script class="cwsfe_group" style="display:none" data-key="'.$key.'" data-templ="group_template" type="text/html">';
                    $out .= cws_core_cwsfw_print_layout( $v['layout'], $prefix . $name . '[%d][', $values ); //would be a template stored
                    $out .= '</script>';
                    $out .= '<ul class="groups"></ul>';
                    if (isset($v['button_title'])) {
                        $out .= '<button type="button" class="'.(isset($v['button_class']) ? $v['button_class'] : '').'" name="'.$key.'">'.(isset($v['button_icon']) ? '<i class="'. $v['button_icon'] .'"></i> ' : ''). $v['button_title'] .'</button>';
                    }
                    break;
                case 'textarea':
                    $out .= '<textarea name="'. $prefix . $name .'"' . $atts . '>' . (isset($v['value']) ? $v['value'] : '') . '</textarea>';
                    break;
                case 'button':
                    $out .= '<button type="button" name="'. $prefix . $name .'"' . $atts . '>' . (isset($v['btitle']) ? $v['btitle'] : '') . '</button>';
                    break;
                case 'datetime_add':
                    $out .= '<ul class="recurring_events" data-pattern="'. $prefix . $name .'" data-lang="'. esc_html__('From', 'cws-essentials') . '|' . esc_html__('till', 'cws-essentials') .'">';
                    if (!empty($v['source'])) {
                        $i = 0;
                        foreach ($v['source'] as $dstart => $dend) {
                            $out .= '<li class="recdate">'. esc_html__('From', 'cws-essentials') .' <span>'.$dstart.'</span> '.esc_html__('till', 'cws-essentials').' <span>'. $dend .'</span><div class="close"></div>';
                            $out .= '<input type="hidden" name="'.$prefix.$key.'['.$i.'][s]" value="'.$dstart.'" />';
                            $out .= '<input type="hidden" name="'.$prefix.$key.'['.$i.'][e]" value="'.$dend.'" />';
                            $out .= '</li>';
                            $i++;
                        }
                    }
                    $datatype = 'datepicker;periodpicker;'.$key.'-end';
                    $out .= '<input type="text" data-cws-type="'. $datatype .'" name="'. $key .'"' . $value . $atts . '>';
                    $out .= '<div class="row '. $key .'-end">';
                    $out .= '<input type="text" name="'. $key .'-end">';
                    $out .= '<button type="button" name="'.$key.'">Add '. $v['title'] .'</button>';
                    $out .= '</ul>';
                    break;
                case 'datetime':
                    if (isset($v['dtype'])) {
                        list($dtype, $end) = $v['dtype'];
                        $datatype = 'datepicker;' . $dtype .';'. $end;
                        $out .= '<input type="text" data-cws-type="'. $datatype .'" name="'. $prefix . $name .'"' . $value . $atts . '>';
                    }
                    break;
                case 'map':
                    $out .= '<div class="cws_maps" id="' . $key . '"></div>';
                    break;
                case 'taxonomy':
                    $taxonomy = isset($v['taxonomy']) ? $v['taxonomy'] : '';
                    $ismul = (false !== strpos($atts, 'multiple'));
                    $out .= '<select name="'. $prefix . $name . ($ismul ? '[]':''). '"' . $atts . '>';
                    $out .= cws_core_cwsfw_print_taxonomy($taxonomy, $v['source']);
                    $out .= '</select>';
                    break;
                case 'post_type':
            
                    $taxonomy = isset($v['post_type']) ? $v['post_type'] : '';
                    $ismul = (false !== strpos($atts, 'multiple'));
                    $out .= '<select name="'. $prefix . $name . ($ismul ? '[]':''). '"' . $atts . '>';
                    $out .= cws_core_cwsfw_print_post_type($taxonomy, $v['source']);
                    $out .= '</select>';
                    break;
                case 'input_group':
                    $out .= '<fieldset class="' . substr($key, 2) . '">';
                    $source = $v['source'];
                    foreach ($source as $key => $value) {
                        $out .= sprintf('<input type="%s" id="%s" name="%s" placeholder="%s">', $value[0], $key, $prefix.$key, $value[1]);
                    }
                    $out .= '</fieldset>';
                    break;
                case 'select':
                    if (false !== strpos($atts, 'multiple') ) {
                        $name .= '[]';
                        $out .= '<input type="hidden" name="'. $prefix . $name .'" value="!!!dummy!!!">'; // dummy
                    }
                    $out .= '<select name="'. $prefix . $name .'"' . $atts;
                    $closed_tag = false;
                    if (!empty($v['source'])) {
                        $source = $v['source'];
                        if (is_array($source)) {
                            reset($source);
                            $fk = key($source);
                            if (!empty($source[$fk][2])) {
                                $out .= ' data-options="select:options">';
                                $closed_tag = true;
                            }
                        }
                        if (!$closed_tag) {
                            $out .= '>';
                            $closed_tag = true;
                        }
                        if ( is_string($source) ) {
                            if (strpos($source, ' ') !== false) {
                                list($func, $arg0) = explode(' ', $source, 2);
                            } else {
                                $arg0 = '';
                                $func = $source;
                            }
                            $out .= call_user_func_array('cws_core_cwsfw_print_' . $func, array($arg0) );
                        } else {
                    
                            foreach ($source as $k => $value) {
                                $selected = '';
                                if (isset($value[1]) && true === $value[1]) {
                                    $selected = ' selected';
                                    $values[$key] = $k;
                                }
                                $data_options = !empty($value[2]) ? ' data-options="' . $value[2] . '"' : '';
                                $out .= '<option value="' . $k . '"' . $data_options . $selected .'>' . $value[0] . '</option>';
                            }
                        }
                    } else {
                        $out .= '>';
                    }
                    $out .= '</select>';
                    break;
                case 'media':
                    $isValueSet = !empty($v['value']['src']);
                    
                    $display_none = ' style="display:none"';
                    $out .= '<div class="img-wrapper">';
                    $out .= !empty($v['subtitle']) ? '<p><span class="sub_title">'.$v['subtitle'].'</span></p>' : '';
            
                    $out .= '<div class="media-img-wrapper">';
                    $out .= '<img src'. ($isValueSet ? '="'.$v['value']['src'] . '"' : '') .'/>';
                    $out .= '</div>';
            
                    $url_atts = !empty($v['url-atts']) ? ' ' . $v['url-atts'] : ' readonly type="hidden"';
                    $out .= '<input class="widefat" type="hidden" data-key="img"' . $url_atts . ' id="' . $prefix . $name . '" name="' . $prefix . $name . '[src]" value="' . ($isValueSet ? $v['value']['src']:'') . '" />';
                    $out .= '<a class="pb-media-cws-pb"'. ($isValueSet ? $display_none : '') .'><i class="far fa-image"></i> '. esc_html__('Select', 'cws-essentials') . '</a>';
                    $out .= '<a class="pb-remov-cws-pb"'. ($isValueSet ? '' : $display_none) .'><i class="fas fa-times"></i></a>';
                    $out .= '<input class="widefat" data-key="img-id" readonly id="' . $prefix . $name . '[id]" name="' . $prefix . $name . '[id]" type="hidden" value="'.($isValueSet ? $v['value']['id']:'').'" />';
                    if (isset($v['layout'])) {
                        $out .= '<div class="media_supplements">';
                        $out .=	cws_core_cwsfw_print_layout( $v['layout'], $prefix . $name . '[' );
                        $out .= '</div>';
                    }
                    $out .= '</div>';
                    break;
                case 'gallery':
                    $isValueSet = !empty($v['value']);
                    $out .= '<div class="img-wrapper">';
                    $out .= '<a class="pb-gmedia-cws-pb">'. esc_html__('Select', 'cws-essentials') . '</a>';
                    $out .= '<input class="widefat" data-key="gallery" readonly id="' . $prefix . $name . '" name="' . $prefix . $name . '" type="hidden" value="' . ($isValueSet ? esc_attr($v['value']):'') . '" />';
                    if ($isValueSet) {
                        $g_value = htmlspecialchars_decode($v['value'], ENT_NOQUOTES); // shortcodes should be un-escaped
                        $ids = shortcode_parse_atts($g_value);
                        if (isset($ids['ids'])) {
                            preg_match_all('/\d+/', $ids['ids'], $match);
                            if (!empty($match)) {
                                $out .= '<div class="cws_gallery">';
                                foreach ($match[0] as $k => $val) {
                                    $out .= '<img src="' . wp_get_attachment_url($val) . '">';
                                }
                                $out .= '<div class="clear"></div></div>';
                            }
                        }
                    }
                    $out .= '</div>';
                    break;
            }
            if (isset($v['description'])) {
                $out .= '<div class="description">' . $v['description'] . '</div>';
            }
            if ('module' !== $v['type'] && 'tab' !== $v['type'] ) {
                $out .= "</div>";
                $out .= '</div>';
            }
        }
        if ($isTabs) {
            $out .= '<div class="clear"></div>';
            $tabs_out = '<div class="cws_pb_ftabs">';
            foreach ($tabs as $key => $v) {
                if (is_array($v['icon'])) {
                    $icon = sprintf('<i class="%s %s-%s"></i>', $v['icon'][0], $v['icon'][0], $v['icon'][1]);
                } else {
                    // direct link
                    $icon = '<span></span>';
                }
                $tabs_out .= '<a href=# data-tab="'. $v['tab'] .'" class="' . ($v['active'] ? 'active' : '') .'">' . $icon . $v['title'] . '</a>';
            }
            $tabs_out .= '<div class="clear"></div></div>';
            $out = $tabs_out . $out;
        }
        return $out;
    }
    
    function cws_core_cwsfw_print_post_type($name, $src) {
        $source = cws_core_cwsfw_get_post_type_array($name);
        $output = '<option value=""></option>';
        foreach($source as $k=>$v) {
            $selected = (!empty($src[$k]) && true === $src[$k][1]) ? ' selected' : '';
            $output .= '<option value="' . $k . '"'.$selected.'>' . $v . '</option>';
        }
        return $output;
    }
    function cws_core_cwsfw_get_post_type_array($tax, $args = '') {
        global $wpdb;
        $post_type_array = array();
        if(!empty($tax)){
            $tax   = esc_sql( $tax );
            $res = $wpdb->get_results("SELECT ID,post_title,post_name FROM $wpdb->posts WHERE $wpdb->posts.post_type LIKE '$tax' AND $wpdb->posts.post_status = 'publish'");
            foreach ($res as $key => $value) {
                $post_type_array[$value->ID] = $value->post_title;
            }
        }
        
        return $post_type_array;
    }
    
    function cws_core_cwsfw_print_taxonomy($name, $src) {
        $source = cws_core_cwsfw_get_taxonomy_array($name);
        $output = '<option value=""></option>';
        foreach($source as $k=>$v) {
            $selected = (!empty($src[$k]) && true === $src[$k][1]) ? ' selected' : '';
            $output .= '<option value="' . $k . '"'.$selected.'>' . $v . '</option>';
        }
        return $output;
    }
    function cws_core_cwsfw_get_taxonomy_array($tax, $args = '') {
        $terms = get_terms($tax, $args);
        $ret = array();
        if (!is_wp_error($terms)) {
            foreach ($terms as $k=>$v) {
                $slug = str_replace('%', '|', $v->slug);
                $ret[$slug] = $v->name;
            }
        }
        return $ret;
    }

//Add thumbnail image to posts
function add_post_thumb_name ($columns) {
    $columns = array_slice($columns, 0, 1, true) +
        array('post_thumbnail' => esc_html__('Thumbnails', 'cws-essentials')) +
        array_slice($columns, 1, NULL, true);
    return $columns;
}
add_filter('manage_post_posts_columns', 'add_post_thumb_name');

//Add thumbnail image to posts
function add_post_thumb ($column, $id) {
    if ('post_thumbnail' === $column) {
        echo the_post_thumbnail('thumbnail');
    }
}
add_action('manage_post_posts_custom_column', 'add_post_thumb', 5, 2);
    
/*Term images*/
add_action( 'admin_init', 'cws_taxonomy_image_init');
    
function cws_taxonomy_image_init(){
    $taxonomies = get_taxonomies();
        
    add_filter('manage_edit-category_columns', 'cws_category_columns');
    add_filter('manage_category_custom_column', 'cws_category_columns_fields', 10, 3);
        
    foreach ((array) $taxonomies as $taxonomy) {
        if ($taxonomy == 'category'){
            cws_add_custom_column_fields($taxonomy);
        }
    }
}
    
function cws_add_custom_column_fields($taxonomy){
    add_action($taxonomy."_add_form_fields", 'cws_show_extra_term_fields');
    add_action($taxonomy."_edit_form_fields", 'cws_show_extra_term_fields');
        
    add_action("created_".$taxonomy, 'cws_save_extra_term_fields' );
    add_action("edited_".$taxonomy, 'cws_save_extra_term_fields' );
        
    //Add custom columns
    add_filter("manage_edit-".$taxonomy."_columns", 'cws_category_columns');
    add_filter("manage_".$taxonomy."_custom_column", 'cws_category_columns_fields', 10, 3);
}
    
function cws_category_columns($columns){
    $columns['image'] = esc_html__( 'Image', 'cws-essentials' );
    return $columns;
}
    
function cws_category_columns_fields($deprecated, $column_name, $term_id){
    $term_image = get_term_meta( $term_id, 'cws_mb_term' );
    if (!empty($term_image)){
        echo "<img class='term_table_img' src='".$term_image[0]['image']['src']."' alt=''>";
    }
}

// Extra term fields
function cws_show_extra_term_fields( $term_id ) {
    global $pagenow;
        
    $mb_attr = array(
        'image' => array(
            'title' => esc_html__( 'Image', 'cws-essentials' ),
            'subtitle' => esc_html__( 'Upload your photo here.', 'cws-essentials' ),
            'addrowclasses' => 'hide_label wide_picture box grid-col-12',
            'type' => 'media',
        ),
    );
        
    if ( in_array($pagenow,array('edit-tags.php','term.php')) ){
        echo '<h3>Additional categories information (CWS Themes)</h3>';
        echo '<div id="cws-post-metabox-id-1">';
            echo '<div class="inside" data-w="0">';
            wp_nonce_field( 'cws_mb_nonce', 'mb_nonce' );
            if (gettype ($term_id) == 'object'){
                $cws_stored_meta = get_term_meta( $term_id->term_id, 'cws_mb_term' );
            }
            if (function_exists('cws_core_cwsfw_fillMbAttributes') ) {
                if (!empty($cws_stored_meta[0])) {
                    cws_core_cwsfw_fillMbAttributes($cws_stored_meta[0], $mb_attr);
                }
                echo cws_core_cwsfw_print_layout($mb_attr, 'cws_mb_');
            }
            echo "</div>";
        echo "</div>";
    }
}
    
    function cws_save_extra_term_fields( $term_id/*, $tt_id*/) {
        $save_array = array();
        
        foreach($_POST as $key => $value) {
            if (0 === strpos($key, 'cws_mb_')) {
                if ('on' === $value) {
                    $value = '1';
                }
                if (is_array($value)) {
                    foreach ($value as $k => $val) {
                        if (is_array($val)) {
                            $save_array[substr($key, 7)][$k] = $val;
                        } else {
                            $save_array[substr($key, 7)][$k] = esc_html($val);
                        }
                    }
                } else {
                    $save_array[substr($key, 7)] = esc_html($value);
                }
            }
        }
        if (!empty($save_array)) {
            update_term_meta( $term_id, 'cws_mb_term', $save_array );
        }
        return;
    }

?>