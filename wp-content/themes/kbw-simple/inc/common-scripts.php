<?php
/**
 *  Common Scripts
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

/**
 * Replace `no-js` with `js` from the body's class name.
 */
add_action('wp_head', 'kbw_nojs_js_class', 1);
function kbw_nojs_js_class()
{
    echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace( /\bno-js\b/,\'js\' );</script>';
}


/**
 * Add jQuery: Enqueue .js files.
 */
add_action('wp_enqueue_scripts', 'kbw_scripts');
function kbw_scripts()
{
    wp_enqueue_script('jquery');
    
    // Jquery UI Js
    $kbw_jquery_ui = apply_filters('kbw_enable_jquery_ui', false);
    if ($kbw_jquery_ui)
        wp_enqueue_script('kbw-script-jquery-ui', KBW_THEME_DIRECTORY_URI . '/assets/plugins/jquery-ui/jquery-ui.min.js', array('jquery'), false, false);
    
    // Bootstrap Js
    wp_enqueue_script('kbw-popper', KBW_THEME_DIRECTORY_URI . '/assets/plugins/popper.js/dist/umd/popper.min.js', array('jquery'), false, true);
    wp_register_script('kbw-script-bootstrap', KBW_THEME_DIRECTORY_URI . '/assets/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('kbw-script-bootstrap');
    
    // PLUGINS JS
    if (WP_DEBUG) {
        //wp_enqueue_script('plugin-scripts', KBW_THEME_DIRECTORY_URI . '/assets/js/plugin-scripts.js', array('jquery'), false, true);
    }
    
    // Other Plugins JS
    wp_register_script('flexslider-scripts', KBW_THEME_DIRECTORY_URI . '/assets/plugins/flex-slider/jquery.flexslider-min.js', array('jquery'), KBW_VERSION, true);
    
    // KBW MAIN JS
    wp_register_script('kbw-main-scripts', KBW_THEME_DIRECTORY_URI . '/assets/js/kabiweb' . (WP_DEBUG ? '' : '.min') . '.js', array('jquery'), KBW_VERSION, true);
    
    ## Inline Vars
    $sticky_menu = apply_filters('kbw_sticky_menu', true);
    $sticky_sidebar = apply_filters('kbw_sticky_sidebar', false);
    $sticky_sidebar_top = apply_filters('kbw_sticky_sidebar_top', 70);
    $dropdown_menu_ww = apply_filters('dropdown_menu_ww', 992);
    $scrollto_h = apply_filters('kbw_scrollto_h', 40);
    $wowjs = apply_filters('kbw_wowjs_active', false);
    $kbw_js_vars = array(
        "siteurl" => esc_url(home_url()),
        "ajaxurl" => admin_url('admin-ajax.php'),
        "theme_url" => KBW_THEME_DIRECTORY_URI,
        "sticky_menu" => $sticky_menu,
        "sticky_sidebar" => $sticky_sidebar,
        "sticky_sidebar_top" => $sticky_sidebar_top,
        "dropdown_menu_ww" => $dropdown_menu_ww,
        "scrollto_h" => $scrollto_h,
        "wowjs" => $wowjs,
        "lightbox_gallery" => 'lightgallery',
        "responsive" => true,
        "is_home" => (is_home() || is_front_page()) ? true : false,
        "is_singular" => is_singular(),
        "fb_app_id" => (kbw_get_option('facebook_app_id')) ? kbw_get_option('facebook_app_id') : '1524800134509668',
        "kbw_copy" => false,
        "right_click" => false,
        //"visitor_ip" => kbw_get_visitor_ip(),
        "thistime" => time(),
        "verticle_menu_num" => 7,
        "lang_copy_alert" => __('Content is Copy Protected', 'kbw'),
        "lang_right_click_alert" => __('Right Mouse Click is Disabled', 'kbw'),
        "lang_no_results" => __('No Results', 'kbw'),
        "lang_results_found" => __('Results Found', 'kbw'),
        "lang_showdmore" => __('Show more', 'kbw'),
        "lang_close_menu" => __('Close Menu', 'kbw'),
        "modal_notice" => apply_filters('kbw_modal_notice', false)
    );
    wp_localize_script('kbw-main-scripts', 'kbw', $kbw_js_vars);
    wp_enqueue_script('kbw-main-scripts');
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    ## For facebook & Google + share
    if (is_singular() && kbw_get_option('post_og_cards') && (!function_exists('bp_current_component') || (function_exists('bp_current_component') && !bp_current_component())) && !defined('WPSEO_VERSION')) kbw_og_data();
}


/**
 * Add css: Enqueue .css files.
 */
add_action('wp_enqueue_scripts', 'kbw_styles', 10);
function kbw_styles()
{
    //Font Awesome
    wp_register_style('fontawesome', KBW_THEME_DIRECTORY_URI . '/assets/css/font-awesome.min.css');
    wp_enqueue_style('fontawesome');
    
    //Jquery UI Css
    $kbw_jquery_ui = apply_filters('kbw_enable_jquery_ui', false);
    if ($kbw_jquery_ui)
        wp_enqueue_style('kbw-style-jquery-ui', KBW_THEME_DIRECTORY_URI . '/assets/plugins/jquery-ui/jquery-ui' . (WP_DEBUG ? '' : '.min') . '.css');
    
    //Bootstrap Css
    wp_register_style('kbw-style-bootstrap', KBW_THEME_DIRECTORY_URI . '/assets/plugins/bootstrap/css/bootstrap' . (WP_DEBUG ? '' : '.min') . '.css');
    wp_enqueue_style('kbw-style-bootstrap');
    
    // PLUGINS CSS
    if (WP_DEBUG) {
        //wp_register_style('plugin-styles', KBW_THEME_DIRECTORY_URI . '/assets/css/plugin-styles' . (WP_DEBUG ? '' : '.min') . '.css');
        //wp_enqueue_style('plugin-styles');
    }
    
    // Other Plugins CSS
    wp_register_style('flexslider-styles', KBW_THEME_DIRECTORY_URI . '/assets/plugins/flex-slider/flexslider.css');
    
    //Register Main style.css file
    wp_enqueue_style('kbw-parent-style', get_stylesheet_uri());
    $handle = 'kbw-parent-style';
    
    // KBW MAIN STYLE
    wp_enqueue_style('kbw-main-style', KBW_THEME_DIRECTORY_URI . '/assets/css/kabiweb' . (WP_DEBUG ? '' : '.min') . '.css');
}


/**
 * Remove ver parameter from CSS and JS file calls
 */
if (kbw_get_option('kbw_remove_ver_params')) {
    add_filter('script_loader_src', 'kbw_remove_script_version', 15, 1);
    add_filter('style_loader_src', 'kbw_remove_script_version', 15, 1);
    function kbw_remove_script_version($src)
    {
        if (is_admin())
            return $src;
        
        $parts = explode('?ver', $src);
        return $parts[0];
    }
}


/**
 * Load assets to be loaded in the footer.
 */
add_action('wp_footer', 'kbw_load_footer_scripts');
function kbw_load_footer_scripts()
{

}
