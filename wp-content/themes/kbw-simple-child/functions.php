<?php
/**
 * kabiweb engine room
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 * @date 28/04/2019
 */

define('KBW_PARENT_THEME_NAME', 'kbw_simple');
define('KBWCHILD_OPTION_NAME', 'kbw_simple');

// Child theme enqueue
add_action('wp_enqueue_scripts', 'kbwchild_theme_enqueue_cssjs', 11);
function kbwchild_theme_enqueue_cssjs()
{
    // Styles
    wp_register_style('kbw-plugins-styles', KBWCHILD_THEME_DIRECTORY_URI . '/assets/plugins.css');
    wp_enqueue_style('kbw-plugins-styles');
    
    wp_deregister_style('kbw-parent-style');
    wp_register_style('kbw-parent-style', get_template_directory_uri() . '/style.css');
    //wp_enqueue_style('kbw-parent-style');
    wp_deregister_style('kbw-stylesheet');
    wp_enqueue_style('kbw-stylesheet', get_stylesheet_directory_uri() . '/style.css');
    
    // Scripts
    wp_register_script('kbw-plugins-scripts', KBWCHILD_THEME_DIRECTORY_URI . '/assets/plugins.js', array('jquery'), KBW_VERSION, true);
    wp_enqueue_script('kbw-plugins-scripts');
    
    wp_register_script('kabiweb-child-scripts', KBWCHILD_THEME_DIRECTORY_URI . '/assets/js/kabiweb-child.js', array('jquery'), KBW_VERSION, true);
    $kbwchild_js_vars = array(
        "ajaxurl" => admin_url('admin-ajax.php'),
        "is_home" => (is_home() || is_front_page()) ? true : false,
        "is_singular" => is_singular(),
    );
    wp_localize_script('kabiweb-child-scripts', 'kbwchild', $kbwchild_js_vars);
    wp_enqueue_script('kabiweb-child-scripts');
    
    // Other Plugin
}

add_action('init', 'kbwchild_custom_hook', 999);
function kbwchild_custom_hook()
{
    //remove_action('add_meta_boxes', 'kbw_add_sidebar_metabox');
    //remove_action('manage_posts_custom_column', 'kbw_columns_content');
    //remove_filter('manage_posts_columns', 'kbw_columns_head');
}

//session_start();
//ob_start();

//constants
define('KBWCHILD_THEME_DIRECTORY', get_stylesheet_directory());
define('KBWCHILD_THEME_DIRECTORY_URI', get_stylesheet_directory_uri());
define('KBWCHILD_INC_DIR', dirname(__FILE__) . '/inc');

//require files
require_once KBWCHILD_INC_DIR . '/init.php';
//require_once KBWCHILD_INC_DIR . '/custom-post-types.php';
//require_once KBWCHILD_INC_DIR . '/metaboxes.php';
//require_once KBWCHILD_INC_DIR . '/init-kbw-shop.php';
//require_once KBWCHILD_INC_DIR . '/woocommerce.php';

// set content width
if (!isset($content_width)) $content_width = 900;

//** SETUP THEME ====**********=>
add_action('after_setup_theme', 'kbw_setup_child_theme', 11);
function kbw_setup_child_theme()
{
    // Translation
    load_child_theme_textdomain('kbw', KBWCHILD_THEME_DIRECTORY . '/languages');
    
    remove_image_size('1536x1536');
    remove_image_size('2048x2048');
    
    //kbw thumbnail addition
    add_image_size('kbw-main-catalog', 405, 301, true);
    add_image_size('kbw-main-single', 750, 750, true);
    
    add_image_size('kbw-main-feature', 515, 565, true);
    add_image_size('kbw-testimonial-thumb', 475, 354, true);
    
    if (kbw_isWooCommerce()) {
        add_image_size('kbw-woo-category', 350, 350, true);
        add_image_size('kbw-woo-catalog', 350, 350, true);
        add_image_size('kbw-woo-single', 600, 0, false);
        add_image_size('kbw-woo-gallery-thumbnail', 140, 140, true);
    }
}

// Disable scaled image size
add_filter('big_image_size_threshold', '__return_false');

// Return use Classic Editor
add_filter('use_block_editor_for_post', '__return_false');

// Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
add_filter('use_widgets_block_editor', '__return_false');

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter('gutenberg_use_widgets_block_editor', '__return_false', 100);

// Fix fontawesome fa-solid-900 with KingComposer
if (class_exists('KingComposer')) {
    add_action('wp_enqueue_scripts', 'kbw_enqueue_controls_css', 10000);
    function kbw_enqueue_controls_css()
    {
        //Font Awesome
        wp_deregister_style('fontawesome');
        wp_register_style('kbw-fontawesome', KBWCHILD_THEME_DIRECTORY_URI . '/assets/css/font-awesome.min.css');
        wp_enqueue_style('kbw-fontawesome');
    }
}

//** Remove inline styles processed by the handle name. ====**********=>
//if (!is_customize_preview()) add_action("print_styles_array", 'kbw_remove_inline_style', 100000);
function kbw_remove_inline_style($styles)
{
    $my_handles = array('kbw-parent-style'); // your custom handle here, the one declared as $style in question
    if (!empty($styles)) {
        foreach ($styles as $i => $style) {
            foreach ($my_handles as $my_handle) {
                if ($my_handle === $style) {
                    unset($styles[$i]);
                }
            }
        }
    }
    return $styles;
}

if (is_admin()) {
    add_action('admin_enqueue_scripts', 'kbwchild_admin_register', 1000);
    function kbwchild_admin_register()
    {
        if (wp_get_current_user()->ID != 1) {
            echo '
            <style>
                #user-1, span#footer-thankyou {display: none!important;}
            </style>';
        }
    }
}

add_action('login_head', 'kbwchild_login_css');
function kbwchild_login_css()
{
    echo '
        <style>
            .login h1 a {display: none!important;}
        </style>';
}

//On/Off jquery_ui
add_filter('kbw_enable_jquery_ui', function () {
    return false;
});
//On/Off location taxonomy
add_filter('kbw_enable_location', function () {
    return false;
});
//On/Off stickymenu
add_filter('kbw_sticky_menu', function () {
    return false;
});
//On/Off stickysidebar
add_filter('kbw_sticky_sidebar', function () {
    return false;
});
//On/Off Wow js
add_filter('kbw_wowjs_active', function () {
    return false;
});
//Show/hide breadcrumb
add_filter('kbw_show_breadcrumbs', function () {
    return true;
});
//On/Off modalnotice
add_filter('kbw_modal_notice', function () {
    return false;
});

// add font type & font size selection option in the WYSIWYG editor
add_filter('mce_buttons_2', 'kbwchild_add_mce_extra');
if (!function_exists('kbwchild_add_mce_extra')) {
    function kbwchild_add_mce_extra($buttons)
    {
        //array_unshift($buttons, 'styleselect');
        array_push($buttons,
            "backcolor",
            "anchor",
            "hr",
            "sub",
            "sup",
            "fontselect",
            "fontsizeselect",
            "styleselect",
            "cleanup"
        );
        return $buttons;
    }
}

//** ENABLE WIDGETIZED SIDEBAR ====**********=>
if (function_exists('register_sidebar')) {
    //add_action('widgets_init', 'kbwchild_register_sidebars', 11);
    function kbwchild_register_sidebars()
    {
        // Footer Span3 Sidebar
        register_sidebar(array(
            'name' => __('Sidebar Product', 'kbw'),
            'description' => __('Sidebar Product', 'kbw'),
            'id' => 'sidebar-product',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}

//** GET THEME OPTIONS ====**********=>
if (!function_exists('kbw_get_option')) {
    function kbw_get_option($name)
    {
        $kbw_options = get_option(KBWCHILD_OPTION_NAME);
        if (!empty($kbw_options[$name]))
            return $kbw_options[$name];
        
        return false;
    }
}

//** CHECK WOOCOMMERCE FUNCTION ====**********=>
if (!function_exists('kbw_isWooCommerce')) {
    function kbw_isWooCommerce()
    {
        return class_exists('WooCommerce');
    }
}


// Security SQL Injection
global $user_ID;
if ($user_ID) {
    if (!current_user_can('administrator')) {
        if (strlen($_SERVER['REQUEST_URI']) > 255 ||
            stripos($_SERVER['REQUEST_URI'], "eval(") ||
            stripos($_SERVER['REQUEST_URI'], "CONCAT") ||
            stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
            stripos($_SERVER['REQUEST_URI'], "base64")) {
            @header("HTTP/1.1 414 Request-URI Too Long");
            @header("Status: 414 Request-URI Too Long");
            @header("Connection: Close");
            @exit;
        }
    }
}
