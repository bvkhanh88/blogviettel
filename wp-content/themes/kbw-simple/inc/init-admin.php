<?php
/**
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

define('KBW_OPTION_NAME', KBW_THEME_NAME);
define('KBW_OPTION_SLUG', 'kbw-panel');

if (!defined('KBW_GLOBAL_MENU_NAME')) {
    define('KBW_GLOBAL_MENU_NAME', __('KabiWeb', 'kbw'));
}
if (!defined('KBW_GLOBAL_SLUG_NAME')) {
    define('KBW_GLOBAL_SLUG_NAME', class_exists('KBW_Framework') ? 'kbw-welcome' : KBW_OPTION_SLUG);
    define('KBW_ADD_TO_SUBMENU', false);
} else {
    define('KBW_ADD_TO_SUBMENU', true);
}

//--- REQUIRE FILES ---//
//Mega menu
//require_once(KBW_INC_DIR . '/kbwmenu/kbwmenu.php');

if (is_admin() || current_user_can('manage_options')) {
    //OPTIONS FUNCTIONS
    require_once(KBW_INC_DIR . '/admin/framework-options.php');
    
    //KBWPANEL
    require_once(KBW_INC_DIR . '/admin/framework-panel.php');
    
    require_once(KBW_INC_DIR . '/admin/admin.php');
    require_once(KBW_INC_DIR . '/admin/kbw-slider.php');
}


if (is_admin()) {
    /*-----------------------------------------------------------------------------------*/
    # Register Admin Scripts and Styles
    /*-----------------------------------------------------------------------------------*/
    add_action('admin_enqueue_scripts', 'kbw_admin_cssjs', 1000);
    function kbw_admin_cssjs()
    {
        global $pagenow;
        
        $ver = time(); // Avoid browser cache for admins
        
        wp_register_style('kbw-admin-style', KBW_THEME_DIRECTORY_URI . '/inc/admin/css/kbw-admin.css', array(), '', 'all');
        wp_enqueue_style('kbw-admin-style');
        
        wp_register_script('kbw-admin-script', KBW_THEME_DIRECTORY_URI . '/inc/admin/js/kbw-admin.js', array('jquery', 'jquery-ui-tooltip'), $ver, false);
        wp_enqueue_script('kbw-admin-script');
        $kbwadmin_js_vars = array(
            "siteurl" => esc_url(home_url()),
            "theme_url" => KBW_THEME_DIRECTORY_URI
        );
        wp_localize_script('kbw-admin-script', 'kbwadmin', $kbwadmin_js_vars);
        
        //ACE Editor
        wp_register_script('kbw-ace-script', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.6/ace.js', array('jquery'), $ver, true);
        wp_enqueue_script('kbw-ace-script');
        
        wp_register_style('custom-admin', KBW_THEME_DIRECTORY_URI . '/inc/admin/css/kbw-admin-custom.css', array(), '', 'all');
        if (kbw_get_option('custom_admin_theme')) wp_enqueue_style('custom-admin');
        
        if (wp_get_current_user()->ID != 1 && wp_get_current_user()->user_login != 'administrator') {
            echo '
            <style>
            .kbw-show-admin, .redux-action_bar input:not(#redux_save_sticky):not(#redux_save) {display: none!important;}
            </style>';
        }
        
        // Enable jquery-migrate for wp5.5
        if (get_bloginfo('version') >= '5.5') {
            $screen = get_current_screen();
            if (in_array($screen->id, array('kbw_slider'))) {
                //wp_enqueue_script('jquery-migrate');
            }
        }
    }
    
    // INSTALL THE THEME
    global $pagenow;
    if (isset($_GET['activated']) && $pagenow == 'themes.php') {
        add_action('init', 'kbw_install_theme', 1);
    }
    function kbw_install_theme()
    {
        global $default_data;
        
        if (!get_option('kbw_active')) {
            kbw_save_settings($default_data);
            update_option('kbw_active', KBW_VERSION);
        }
    }
}


/*--- STYLE FOR LOGIN PAGE ---*/
add_action('login_head', 'kbw_login_css');
function kbw_login_css()
{
    wp_enqueue_style('kbw-login-css', KBW_THEME_DIRECTORY_URI . '/inc/admin/css/kbw-login.css');
}

/**
 * Get Theme Option
 */
if (!function_exists('kbw2_get_option')) {
    function kbw2_get_option($name)
    {
        $get_options = get_option(KBW_OPTION_NAME);
        if (!empty($get_options[$name]))
            return $get_options[$name];
        
        return false;
    }
}


//Default Options
$default_data = array(
    KBW_OPTION_NAME => array(
        'theme_layout' => 'boxed',
        'main_layout' => 'right',
        'header_layout' => 'container',
        'header_style' => 'header-1',
        'mobile_header_style' => 'header-mobile-1',
        'footer_layout' => 'container',
        'footer_style' => 'footer-1',
        'enable-maincpt' => false,
        'enable-maincpt-cat' => false,
        'enable-maincpt-skill' => false,
        'facebook_app_id' => '1524800134509668',
        'fanpage_url' => 'https://www.facebook.com/facebookappVietnam',
        'maintenance_mode_enable' => false,
        'hide_adminbar_frontend' => false,
        'responsive' => true,
        'custom_wp_image_size' => true,
        'post_views' => true,
        'enable-testimonial' => false
    )
);
