<?php
/**
 * kabiweb engine room
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 * @authorURI: https://kabiweb.com
 * @sine 28/04/2019
 *
 */

// Set the theme version number as a global variable
$theme = wp_get_theme('kbw-simple');
$kabiweb_version = $theme['Version'];

if (!session_id()) {
    //session_start();
}
//ob_start();


//constants
define('KBW_FOLDER', 'kbw-simple');
define('KBW_VERSION', '3.0');
define('KBW_THEME_NAME', 'kbw_simple');
define('KBW_TEXTDOMAIN', 'kbw');

// Theme directory.
define('KBW_THEME_DIRECTORY', get_template_directory());

// Theme directory URI.
define('KBW_THEME_DIRECTORY_URI', get_template_directory_uri());

// Theme include directory URI.
define('KBW_INC_DIR', dirname(__FILE__) . '/inc');


// set content width
if (!isset($content_width)) $content_width = 900;


/**
 * Get theme option
 */
$kbw_options = get_option(KBW_THEME_NAME);
if (!function_exists('kbw_get_option')) {
    function kbw_get_option($name)
    {
        $kbw_options = get_option(KBW_THEME_NAME);
        if (!empty($kbw_options[$name]))
            return $kbw_options[$name];
        
        return false;
    }
}

if (!function_exists('kbw_current_design')) {
    /**
     * Returns the current design variation the
     * user has selected
     */
    function kbw_current_design()
    {
        return get_option('kbw_current_design', 'classic');
    }
}

// Theme selected design
define('KBW_DESIGN', kbw_current_design());


/**
 * Setup theme
 */
add_action('after_setup_theme', 'kbw_setup_theme', 10);
function kbw_setup_theme()
{
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('post-formats', array('video'));
    
    add_filter('enable_post_format_ui', '__return_false');
    
    // Translation
    load_theme_textdomain('kbw', get_template_directory() . '/languages');
    
    add_theme_support('post-thumbnails');
    
    $kbw_thumbnail = kbw2_get_option('kbw-thumbnail');
    set_post_thumbnail_size(
        $kbw_thumbnail && is_array($kbw_thumbnail) ? absint($kbw_thumbnail[0]) : 400,
        $kbw_thumbnail && is_array($kbw_thumbnail) ? absint($kbw_thumbnail[1]) : 280,
        true
    );
    
    //kbw thumbnail
    $kbw_thumbnail = kbw2_get_option('kbw-thumbnail');
    add_image_size(
        'kbw-thumbnail',
        $kbw_thumbnail && is_array($kbw_thumbnail) ? absint($kbw_thumbnail[0]) : 400,
        $kbw_thumbnail && is_array($kbw_thumbnail) ? absint($kbw_thumbnail[1]) : 280,
        true
    );
    
    //kbw slide
    $kbw_slider = kbw2_get_option('kbw-slider');
    add_image_size(
        'kbw-slide',
        $kbw_slider && is_array($kbw_slider) ? absint($kbw_slider[0]) : 0,
        $kbw_slider && is_array($kbw_slider) ? absint($kbw_slider[1]) : 0,
        true
    );
    
    //kbw related
    $kbw_related = kbw2_get_option('kbw-related');
    add_image_size(
        'kbw-related',
        $kbw_related && is_array($kbw_related) ? absint($kbw_related[0]) : 400,
        $kbw_related && is_array($kbw_related) ? absint($kbw_related[1]) : 280,
        true
    );
    
    //kbw-large
    $kbw_large = kbw2_get_option('kbw-large');
    add_image_size(
        'kbw-large',
        $kbw_large && is_array($kbw_large) ? absint($kbw_large[0]) : 400,
        $kbw_large && is_array($kbw_large) ? absint($kbw_large[1]) : 280,
        true
    );
    
    //kbw-medium
    $kbw_medium = kbw2_get_option('kbw-medium');
    add_image_size(
        'kbw-medium',
        $kbw_medium && is_array($kbw_medium) ? absint($kbw_medium[0]) : 400,
        $kbw_medium && is_array($kbw_medium) ? absint($kbw_medium[1]) : 280,
        true
    );
    
    //kbw small
    $kbw_small = kbw2_get_option('kbw-small');
    add_image_size(
        'kbw-small',
        $kbw_small && is_array($kbw_small) ? absint($kbw_small[0]) : 150,
        $kbw_small && is_array($kbw_small) ? absint($kbw_small[1]) : 150,
        true
    );
    
    //Custom wp image size
    if (kbw_get_option('custom_wp_image_size')) {
        update_option('thumbnail_size_w', $kbw_small && is_array($kbw_small) ? absint($kbw_small[0]) : 150);
        update_option('thumbnail_size_h', $kbw_small && is_array($kbw_small) ? absint($kbw_small[1]) : 150);
        update_option('thumbnail_crop', 1);
        
        update_option('medium_size_w', 0);
        update_option('medium_size_h', 0);
        
        update_option('large_size_w', 0);
        update_option('large_size_h', 0);
        
        update_option('medium_large_size_w', 0);
        update_option('medium_large_size_h', 0);
    } else {
        update_option('thumbnail_size_w', 150);
        update_option('thumbnail_size_h', 150);
        update_option('thumbnail_crop', 1);
        
        update_option('medium_size_w', 350);
        update_option('medium_size_h', 350);
        
        update_option('large_size_w', 1024);
        update_option('large_size_h', 1024);
        
        update_option('medium_large_size_w', 1024);
        update_option('medium_large_size_h', 1024);
    }
    
    add_filter('widget_text', 'do_shortcode');
    
    if (kbw_isWooCommerce()) {
        // Declare WooCommerce support.
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        
        if (kbw_get_option('custom_woo_image_size')) {
            //kbw woo category
            $kbw_woo_category = kbw2_get_option('kbw-woo-category');
            add_image_size(
                'kbw-woo-category',
                $kbw_woo_category && is_array($kbw_woo_category) ? absint($kbw_woo_category[0]) : 300,
                $kbw_woo_category && is_array($kbw_woo_category) ? absint($kbw_woo_category[1]) : 300,
                true
            );
            
            //kbw woo catalog
            $kbw_woo_catalog = kbw2_get_option('kbw-woo-catalog');
            add_image_size(
                'kbw-woo-catalog',
                $kbw_woo_catalog && is_array($kbw_woo_catalog) ? absint($kbw_woo_catalog[0]) : 300,
                $kbw_woo_catalog && is_array($kbw_woo_catalog) ? absint($kbw_woo_catalog[1]) : 300,
                true
            );
            
            //kbw woo single
            $kbw_woo_single = kbw2_get_option('kbw-woo-single');
            add_image_size(
                'kbw-woo-single',
                $kbw_woo_single && is_array($kbw_woo_single) ? absint($kbw_woo_single[0]) : 600,
                $kbw_woo_single && is_array($kbw_woo_single) ? absint($kbw_woo_single[1]) : 600,
                true
            );
            
            //kbw woo gallery
            $kbw_woo_thumbnail = kbw2_get_option('kbw-woo-thumbnail');
            add_image_size(
                'kbw-woo-gallery-thumbnail',
                $kbw_woo_thumbnail && is_array($kbw_woo_thumbnail) ? absint($kbw_woo_thumbnail[0]) : 150,
                $kbw_woo_thumbnail && is_array($kbw_woo_thumbnail) ? absint($kbw_woo_thumbnail[1]) : 150,
                true
            );
            
            //Fix woocommerce image size
            $woo_theme_support = get_theme_support('woocommerce');
            $woo_theme_support = is_array($woo_theme_support) ? $woo_theme_support[0] : array();
            
            $woo_theme_support['single_image_width'] = 0;
            $woo_theme_support['thumbnail_image_width'] = 0;
            $woo_theme_support['gallery_thumbnail_image_width'] = 0;
            
            remove_theme_support('woocommerce');
            add_theme_support('woocommerce', $woo_theme_support);
        }
    }
    
    //Add User Role
    $kbw_role = array(
        'read' => true,  // true allows this capability
        'edit_posts' => true,
        'delete_posts' => false, // Use false to explicitly deny
    );
    add_role('kbw_busowner', 'KBW Business Owner');
    $role = get_role('kbw_busowner');
    $role->add_cap('read');
    $role->add_cap('upload_files');
    $role->add_cap('edit_posts');
}


/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
add_action('init', 'kabiweb_menus');
function kabiweb_menus()
{
    $locations = array(
        'primary-menu' => __('KBW Header', 'kbw'),
        'footer-menu' => __('KBW Footer', 'kbw'),
        'mobile' => __('KBW Mobile', 'kbw'),
    );
    
    $locations = apply_filters('kbw_register_menu', $locations);
    register_nav_menus($locations);
}


// Remove default image sizes here.
add_filter('intermediate_image_sizes_advanced', 'kbw_remove_default_images', 999);
function kbw_remove_default_images($sizes)
{
    unset($sizes['small']); // 150px
    unset($sizes['medium']); // 300px
    unset($sizes['large']); // 1024px
    unset($sizes['medium_large']); // 768px
    return $sizes;
}

//functions when theme deactivation
if (!function_exists('kbw_switch_theme')) {
    add_action('switch_theme', 'kbw_switch_theme');
    function kbw_switch_theme()
    {
        remove_role('kbw_busowner');
        
        //re-update image size
        update_option('thumbnail_size_w', 150);
        update_option('thumbnail_size_h', 150);
        update_option('thumbnail_crop', 1);
        
        update_option('medium_size_w', 350);
        update_option('medium_size_h', 350);
        
        update_option('large_size_w', 1024);
        update_option('large_size_h', 1024);
        
        update_option('medium_large_size_w', 1024);
        update_option('medium_large_size_h', 1024);
    }
}


//functions when theme activation
if (!function_exists('kbw_after_switch_theme')) {
    add_action('after_switch_theme', 'kbw_after_switch_theme');
    function kbw_after_switch_theme()
    {
        if (!wp_next_scheduled('kbw_hourly_cron')) {
            wp_schedule_event(time(), 'hourly', 'kbw_hourly_cron');
            wp_schedule_event(time(), 'twicedaily', 'kbw_twicedaily_cron');
        }
    }
}


/**
 * Remove [...] and shortcodes
 * @param $output
 * @return string
 */
add_filter('get_the_excerpt', 'kbw_custom_excerpt');
function kbw_custom_excerpt($output)
{
    return preg_replace('/\[[^\]]*]/', '', $output);
}

//** Read More Functions ====**********=>
add_filter('excerpt_more', 'kbw_remove_excerpt');
function kbw_remove_excerpt($more)
{
    return ' &hellip;';
}


/**
 * Add a class to the post if there is a thumbnail
 */
add_filter('post_class', 'kbw_has_thumb_class');
function kbw_has_thumb_class($classes)
{
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $classes[] = 'has-thumb';
    }
    return $classes;
}

// Custom excerpt
add_filter('the_excerpt', 'shortcode_unautop');
add_filter('the_excerpt', 'do_shortcode');

/**
 * Fix Shortcodes
 */
add_filter('widget_text', 'kbw_fix_shortcodes');
add_filter('the_content', 'kbw_fix_shortcodes');
function kbw_fix_shortcodes($content)
{
    $array = array(
        '[raw]' => '',
        '[/raw]' => '',
        '<p>[raw]' => '',
        '[/raw]</p>' => '',
        '[/raw]<br />' => '',
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    
    $content = strtr($content, $array);
    $content = preg_replace("/<br \/>.\[/s", "[", $content);
    
    return $content;
}


/**
 * Sanitize file upload filenames
 */
add_filter('sanitize_file_name', 'kbw_sanitize_file_name_chars', 10);
function kbw_sanitize_file_name_chars($filename)
{
    $sanitized_filename = remove_accents($filename); // Convert to ASCII
    // Standard replacements
    $invalid = array(
        ' ' => '-',
        '%20' => '-',
        '_' => '-'
    );
    $sanitized_filename = str_replace(array_keys($invalid), array_values($invalid), $sanitized_filename);
    
    $sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
    $sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
    $sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
    $sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
    $sanitized_filename = strtolower($sanitized_filename); // Lowercase
    
    return $sanitized_filename;
}


/**
 * Check active woocommerce plugin
 */
if (!function_exists('kbw_isWooCommerce')) {
    function kbw_isWooCommerce()
    {
        return class_exists('WooCommerce');
    }
}


/**
 * Glob include file
 */
$kbw_boot_files = glob(dirname(__FILE__) . "/inc/*.php");
sort($kbw_boot_files);
foreach ($kbw_boot_files as $filename) {
    $file = basename($filename, '.php');
    if (file_exists($filename) && apply_filters("kbw_pre_boot_$file", '__return_true')) {
        require_once($filename);
    }
}
