<?php
    add_filter('block_categories', 'cwshdgb_block_categories');
    function cwshdgb_block_categories($cats) {
        array_unshift($cats, array('slug'  => 'cwshdgb', 'title' => 'CWS Header Blocks', 'icon' => null ));
        array_unshift($cats, array('slug'  => 'cwsgb', 'title' => 'CWS Blocks', 'icon' => null ));
        return $cats;
    }
    /* /update */
    
    function cws_fix_shortcodes_autop($content){
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        
        $content = strtr($content, $array);
        
        return $content;
    }
    
    function cws_lang_select($content) {
        if ( function_exists('wpm') ) {
            $content = wpm_translate_string($content);
        }
        return $content;
    }
    
    function cws_hf_adminmenu() {
        add_menu_page(
            'CWS Templates',
            'CWS Templates',
            'read',
            'cws-templates',
            '', // Callback, leave empty
            'dashicons-calendar',
            24 // Position
        );
        
        //remove_submenu_page( 'edit.php?post_type=cws-tmpl-header', 'edit.php?post_type=cws-tmpl-header' );
        add_submenu_page('cws-templates', 'Header', 'Header', 'manage_options', 'edit.php?post_type=cws-tmpl-header');
        add_submenu_page('cws-templates', 'Add Header', 'Add Header', 'manage_options', 'post-new.php?post_type=cws-tmpl-header');
        
        //remove_submenu_page( 'edit.php?post_type=cws-tmpl-footer', 'edit.php?post_type=cws-tmpl-footer' );
        add_submenu_page('cws-templates', 'Footer', 'Footer', 'manage_options', 'edit.php?post_type=cws-tmpl-footer');
        add_submenu_page('cws-templates', 'Add Footer', 'Add Footer', 'manage_options', 'post-new.php?post_type=cws-tmpl-footer');
        
        //remove_submenu_page( 'edit.php?post_type=cws-tmpl-sticky', 'edit.php?post_type=cws-tmpl-sticky' );
        add_submenu_page('cws-templates', 'Sticky Menu', 'Sticky', 'manage_options', 'edit.php?post_type=cws-tmpl-sticky');
        add_submenu_page('cws-templates', 'Add Sticky Menu', 'Add Sticky', 'manage_options', 'post-new.php?post_type=cws-tmpl-sticky');
        
        remove_submenu_page( 'cws-templates', 'cws-templates' );
    }
    
    add_action( 'admin_menu', 'cws_hf_adminmenu' );
    add_action('init', 'cws_hf_init');
    
    
    function cws_hf_init() {
        $labels = array(
            'name' => __('Header Templates', 'cws_hf'),
            'singular_name' => __('Header Template', 'cws_hf'),
            'add_new' => __('Add Header Template', 'cws_hf'),
            'add_new_item' => __('Add New Header Template', 'cws_hf'),
            'edit_item' => __('Edit Header Template', 'cws_hf'),
            'new_item' => __('New Header Template', 'cws_hf'),
            'view_item' => __('View Header Template', 'cws_hf'),
            'search_items' => __('Search Header Template', 'cws_hf'),
            'not_found' => __('No Header Templates found', 'cws_hf'),
            'not_found_in_trash' => __('No Header Templates found in Trash', 'cws_hf'),
            'parent_item_colon' => '',
            'menu_name' => __('Header Templates', 'cws_hf')
        );
        
        $labelsf = array(
            'name' => __('Footer Templates', 'cws_hf'),
            'singular_name' => __('Footer Template', 'cws_hf'),
            'add_new' => __('Add Footer Template', 'cws_hf'),
            'add_new_item' => __('Add New Footer Template', 'cws_hf'),
            'edit_item' => __('Edit Footer Template', 'cws_hf'),
            'new_item' => __('New Footer Template', 'cws_hf'),
            'view_item' => __('View Footer Template', 'cws_hf'),
            'search_items' => __('Search Footer Template', 'cws_hf'),
            'not_found' => __('No Footer Templates found', 'cws_hf'),
            'not_found_in_trash' => __('No Footer Templates found in Trash', 'cws_hf'),
            'parent_item_colon' => '',
        );
        
        $labelss = array(
            'name' => __('Sticky Templates', 'cws_hf'),
            'singular_name' => __('Sticky Template', 'cws_hf'),
            'add_new' => __('Add Sticky Template', 'cws_hf'),
            'add_new_item' => __('Add New Sticky Template', 'cws_hf'),
            'edit_item' => __('Edit Sticky Template', 'cws_hf'),
            'new_item' => __('New Sticky Template', 'cws_hf'),
            'view_item' => __('View Sticky Template', 'cws_hf'),
            'search_items' => __('Search Sticky Template', 'cws_hf'),
            'not_found' => __('No Sticky Templates found', 'cws_hf'),
            'not_found_in_trash' => __('No Sticky Templates found in Trash', 'cws_hf'),
            'parent_item_colon' => '',
        );
        
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'show_in_menu' => false,
            'hierarchical' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
        );
        register_post_type('cws-tmpl-header', $args);
        
        $args = array(
            'labels' => $labelsf,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'capability_type' => 'post',
            'hierarchical' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
        );
        register_post_type('cws-tmpl-footer', $args);
        
        $args = array(
            'labels' => $labelss,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'capability_type' => 'post',
            'hierarchical' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
        );
        register_post_type('cws-tmpl-sticky', $args);
    }
    
    add_action( 'add_meta_boxes', 'cwshf_post_addmb' );
    
    function cwshf_post_addmb() {
        add_meta_box( 'cws-post-metabox-id-3', 'CWS Template Options', 'cwshf_mb_page_callback', 'page', 'normal', 'high' );
    }
    
    function cwshf_mb_page_callback( $post ) {
        wp_nonce_field( 'cwshf_mb_nonce', 'mb_nonce' );
        
        $cws_stored_meta = get_post_meta( $post->ID, 'cwshf_mb_post', true );
        $meta_header = $meta_footer = $meta_sticky = 0;
        
        if (!empty($cws_stored_meta)) {
            $meta_header = (int)$cws_stored_meta['header'];
            $meta_footer = (int)$cws_stored_meta['footer'];
            $meta_sticky = (int)$cws_stored_meta['sticky'];
        }
        echo '<p>Header Templates</p>';
        echo '<select name="cwshf_header">';
            echo '<option value="">'.esc_html_x('Default', 'backend', 'cws-essentials').'</option>';
            echo buildTemplates('cws-tmpl-header', $meta_header);
        echo '</select>';
        
        echo '<p>Footer Templates</p>';
        echo '<select name="cwshf_footer">';
            echo '<option value="">'.esc_html_x('Default', 'backend', 'cws-essentials').'</option>';
            echo buildTemplates('cws-tmpl-footer', $meta_footer);
        echo '</select>';
        
        echo '<p>Sticky Templates</p>';
        echo '<select name="cwshf_sticky">';
            echo '<option value="">'.esc_html_x('Default', 'backend', 'cws-essentials').'</option>';
            echo buildTemplates('cws-tmpl-sticky', $meta_sticky);
        echo '</select>';
    }
    
    function buildTemplates($term, $selected) {
        $args = array(
            'post_type' => $term,
            'posts_per_page' => -1
        );
        
        $r_query = new WP_Query($args);
        $ret = '';
        foreach ($r_query->posts as $k => $v) {
            $sel = $v->ID === $selected ? ' selected' : '';
            $ret .= sprintf('<option value="%s"%s>%s</option>', $v->ID, $sel, $v->post_title);
        }
        return $ret;
    }
    
    add_action( 'save_post', 'cwshf_metabox_save', 11, 2 );
    
    function cwshf_metabox_save($post_id, $post) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
        
        if ( !isset( $_POST['mb_nonce']) || !wp_verify_nonce($_POST['mb_nonce'], 'cwshf_mb_nonce') )
            return;
        
        if ( !current_user_can( 'edit_post', $post->ID ) )
            return;
        
        $save_array = array();
        
        foreach($_POST as $key => $value) {
            if (0 === strpos($key, 'cwshf_')) {
                $save_array[substr($key, 6)] = $value;
            }
        }
        
        if (!empty($save_array)) {
            update_post_meta($post_id, 'cwshf_mb_post', $save_array);
        }
    }
    add_action( 'cws_custom_sticky', 'cwshf_sticky', 5 );
    function cwshf_sticky() {
        global $post;
        
        if( !empty($post) ){
            $cws_stored_meta = get_post_meta( $post->ID, 'cwshf_mb_post', true );
            $meta_sticky = 0;
            
            if (!empty($cws_stored_meta) && !empty($cws_stored_meta['sticky'])) {
                $vc_shortcodes_custom_css = get_post_meta( $cws_stored_meta['sticky'], '_wpb_shortcodes_custom_css', true );
                $vc_shortcodes_custom_css = strip_tags( $vc_shortcodes_custom_css );
                cws__vc_styles($vc_shortcodes_custom_css);
                
                $meta_sticky = (int)$cws_stored_meta['sticky'];
                $page_object = get_page( $meta_sticky );
                $content = $page_object->post_content;
                $content = cws_fix_shortcodes_autop($content);
                
                
                $content = cws_lang_select($content);
                
                echo "<div class='cws_sticky_template'>";
                    echo "<div class='container'>";
                        echo do_shortcode($content);
                    echo "</div>";
                echo "</div>";
            }
        }
    }
    
    add_action( 'cws_custom_footer', 'cwshf_footer', 5 );
    function cwshf_footer(){
        global $post;
        
        if( !empty($post) ){
            $cws_stored_meta = get_post_meta( $post->ID, 'cwshf_mb_post', true );
            $meta_footer = 0;
            
            if( !empty($cws_stored_meta) && !empty($cws_stored_meta['footer']) ){
                $vc_shortcodes_custom_css = get_post_meta( $cws_stored_meta['footer'], '_wpb_shortcodes_custom_css', true );
                $vc_shortcodes_custom_css = strip_tags( $vc_shortcodes_custom_css );
                cws__vc_styles($vc_shortcodes_custom_css);
                
                $meta_footer = (int)$cws_stored_meta['footer'];
                $page_object = get_page( $meta_footer );
                $content = $page_object->post_content;
                $content = cws_fix_shortcodes_autop($content);
                $content = cws_lang_select($content);
                
                echo "<div class='cws_footer_template".( get_theme_mod('sticky_footer') ? ' sticky_footer' : '' )."'>";
                    echo "<div class='container'>";
                        echo do_shortcode($content);
                    echo "</div>";
                echo "</div>";
            }
        }
    }
    
    add_action( 'cws_custom_header', 'cwshf_header', 5 );
    function cwshf_header() {
        global $post;
        
        if( !empty($post) ){
            $cws_stored_meta = get_post_meta( $post->ID, 'cwshf_mb_post', true );
            $meta_header = 0;
            
            if (!empty($cws_stored_meta) && !empty($cws_stored_meta['header'])) {
                $vc_shortcodes_custom_css = get_post_meta( $cws_stored_meta['header'], '_wpb_shortcodes_custom_css', true );
                $vc_shortcodes_custom_css = strip_tags( $vc_shortcodes_custom_css );
                
                cws__vc_styles($vc_shortcodes_custom_css);
                
                $meta_header = (int)$cws_stored_meta['header'];
                $page_object = get_page( $meta_header );
                $load_sidebars = array();
                $content = $page_object->post_content;
                $content = cws_fix_shortcodes_autop($content);
                
                
                
                $content = cws_lang_select($content);
                
                $extra_classes = get_post_meta($page_object->ID, '_cws_header_absolute', true) == 'on' ? 'absolute_pos' : '';
                
                echo "<div class='cws_header_template ".esc_attr($extra_classes)."'>";
                    echo "<div class='cws_header_template_bg'></div>";
                    echo "<div class='container'>";
                        $out = do_shortcode($content);
                        
                        // Check any custom sidebar to load
                        preg_match_all("/data-sidebar=.+?(\'|\")>/", $out, $results);
                        
                        foreach( $results[0] as $value ){
                            preg_match("/(\'|\").+?(\'|\")/", $value, $result);
                            $result = trim($result[0], "'");
                            $result = trim($result, '"');
                            
                            $load_sidebars[] = promosys__get_sidebar( '', $result, 'right', 'default', $result );
                        }
                        
                        echo $out;
                    echo "</div>";
                echo "</div>";
                
                if( !empty($load_sidebars) ){
                    echo "<div class='custom_sidebars_wrapper'>";
                    foreach( $load_sidebars as $sidebar ){
                        echo $sidebar;
                    }
                    echo "</div>";
                }
            }
        }
    }
