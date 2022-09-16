<?php
/**
 *  Custom Admin Wordpress
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/


/**
 *  Business owner user registration
 */
if (!function_exists('kbw_user_register')) {
    //add_action('user_register', 'kbw_user_register');
    function kbw_user_register($user_id, $password = "", $meta = array())
    {
        if (!empty($_POST['user_role']) && ($_POST['user_role'] == 'business_owner')) {
            $userdata = array();
            $userdata['ID'] = $user_id;
            $userdata['role'] = 'kbw_busowner';
            
            wp_update_user($userdata);
        }
    }
}


/**
 *  Capablilities User
 */
add_action('admin_init', 'kbw_user_capablilities');
if (!function_exists('kbw_user_capablilities')) {
    function kbw_user_capablilities()
    {
        global $wp_roles;
        
        if (!class_exists('WP_Roles')) return;
        if (!isset($wp_roles)) $wp_roles = new WP_Roles(); // @codingStandardsIgnoreLine
        
        $caps = array(
            "edit_product",
            "read_product",
            "delete_product",
            "edit_products",
            "edit_others_products",
            "publish_products",
            "read_private_products",
            "delete_products",
            "delete_private_products",
            "delete_published_products",
            "delete_others_products",
            "edit_private_products",
            "edit_published_products",
        );
        foreach ($caps as $cap) {
            $wp_roles->add_cap('kbw_busowner', $cap);
        }
        
        //remove cap
        $remove_caps = array(
            "read_private_products",
            
            "publish_products",
            
            'edit_product',
            //"edit_products",
            'edit_private_products',
            //"edit_published_products",
            "edit_others_products",
            
            'delete_product',
            "delete_products",
            "delete_private_products",
            "delete_published_products",
            "delete_others_products",
        );
        foreach ($remove_caps as $remove_cap) {
            $wp_roles->remove_cap('kbw_busowner', $remove_cap);
        }
    }
}


/**
 *  Get current user info
 */
if (!function_exists('kbw_get_current_user_info')) {
    function kbw_get_current_user_info()
    {
        $user_info = array(
            'display_name' => '',
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'country_code' => '',
            'phone' => '',
            'birthday' => '',
            'address' => '',
            'city' => '',
            'zip' => '',
            'country' => '',
            'photo_url' => '',
        );
        
        if (is_user_logged_in()) {
            
            $current_user = wp_get_current_user();
            
            $user_id = $current_user->ID;
            $user_info['display_name'] = $current_user->user_firstname;
            $user_info['login'] = $current_user->user_login;
            $user_info['first_name'] = $current_user->user_firstname;
            $user_info['last_name'] = $current_user->user_lastname;
            $user_info['email'] = $current_user->user_email;
            $user_info['description'] = $current_user->description;
            $user_info['country_code'] = get_user_meta($user_id, 'country_code', true);
            $user_info['phone'] = get_user_meta($user_id, 'phone', true);
            $user_info['birthday'] = get_user_meta($user_id, 'birthday', true);
            $user_info['address'] = get_user_meta($user_id, 'address', true);
            $user_info['city'] = get_user_meta($user_id, 'city', true);
            $user_info['zip'] = get_user_meta($user_id, 'zip', true);
            $user_info['country'] = get_user_meta($user_id, 'country', true);
            $user_info['photo_url'] = (isset($current_user->photo_url) && !empty($current_user->photo_url)) ? $current_user->photo_url : '';
            
        }
        
        return $user_info;
    }
}


/**
 *  Custom Admin Page
 */
if (kbw_get_option('hide_adminbar_frontend')) {
    add_filter('show_admin_bar', '__return_false');
}

add_filter('login_headerurl', 'kbw_login_logo_url');
function kbw_login_logo_url()
{
    return get_bloginfo('url');
}

if (kbw_get_option('maintenance_mode_enable')) add_action('get_header', 'kbw_maintenance_mode');
function kbw_maintenance_mode()
{
    if (current_user_can('edit_themes') || is_user_logged_in()) {
        //code here
    } else {
        if (!is_home() && !is_front_page() && !is_page('home')) {
            wp_die('<h1 style="color:#f00">' . __('System maintenance', 'kbw') . '</h1><br /><p></p><br /><br /><a href="/">' . __('RETURN HOME', 'kbw') . '</a>');
        }
    }
}


/**
 *  ADD-REMOVE MENU ADMIN
 */
add_action('admin_menu', 'kbw_admin_menus', 50);
function kbw_admin_menus()
{
    if (!is_admin())
        return;
    
    $submenu_remove_name = (kbw_get_option('submenu_remove_name')) ? kbw_get_option('submenu_remove_name') : '';
    remove_submenu_page('themes.php', $submenu_remove_name . '');
    
    global $submenu;
    if (isset($submenu['themes.php'])) {
        foreach ($submenu['themes.php'] as $index => $menu_item) {
            if (in_array('Header', $menu_item) || in_array('Background', $menu_item)) {
                unset($submenu['themes.php'][$index]);
            }
        }
    }
    
    remove_submenu_page('tools.php', 'redux-about');
    //remove_submenu_page('options-general.php', 'privacy');
    
    if (wp_get_current_user()->ID != 1) {
        //remove_menu_page( 'index.php' ); // Menu Dashboard
        //remove_menu_page( 'edit.php' ); // Menu Post
        //remove_menu_page( 'upload.php' ); // Menu Media
        remove_menu_page('edit-comments.php'); // Menu Comment
        remove_submenu_page('index.php', 'update-core.php'); // Submenu Update core
    }
    if (wp_get_current_user()->ID != 1 && wp_get_current_user()->user_login != 'administrator') {
        //remove_menu_page('edit.php?post_type=page'); // Menu Page
        remove_menu_page('themes.php'); // Menu Theme
        remove_menu_page('plugins.php'); // Menu Plugins
        //remove_menu_page('users.php'); // Menu User
        remove_menu_page('tools.php'); // Menu Tool
        //remove_menu_page('options-general.php'); // Menu Seeting
        //remove_menu_page('wpcf7'); // Menu Contact form 7
        remove_menu_page('kingcomposer');
        remove_menu_page('maxmegamenu');
        remove_menu_page('icwp-wpsf');
    }
    
    // Add Admin Menus
    add_submenu_page(KBW_GLOBAL_SLUG_NAME, __('Menu Manager', 'kbw'), __('Menu Manager', 'kbw'), 'manage_options', admin_url('nav-menus.php'), null);
    add_submenu_page(KBW_GLOBAL_SLUG_NAME, __('Edit Module', 'kbw'), __('Edit Module', 'kbw'), 'manage_options', admin_url('widgets.php'), null);
    //add_menu_page(__('Edit Module', 'kbw'), __('Edit Module', 'kbw'), 'manage_options', 'kbw-widget-manager', 'kbw_widget_manager_output');
}

function kbw_widget_manager_output()
{
    $menu_redirect = isset($_GET['page']) ? $_GET['page'] : false;
    if ($menu_redirect === 'kbw-widget-manager') {
        wp_safe_redirect(home_url('/wp-admin/widgets.php'), 301);
        exit;
    }
}

function kbw_menu_manager_output()
{
    $menu_redirect = isset($_GET['page']) ? $_GET['page'] : false;
    if ($menu_redirect === 'kbw-menu-manager') {
        wp_safe_redirect(home_url('/wp-admin/nav-menus.php'), 301);
        exit;
    }
}


/**
 *  CUSTOMIZE WP-ADMIN BAR
 */
add_action('wp_before_admin_bar_render', 'kbw_admin_bar_render', 999);
function kbw_admin_bar_render()
{
    global $wp_admin_bar;
    
    //Admin bar Back-end
    $wp_admin_bar->remove_menu('wp-logo');
    /** Remove the WordPress logo **/
    $wp_admin_bar->remove_menu('about');
    /** Remove the about WordPress link **/
    $wp_admin_bar->remove_menu('wporg');
    /** Remove the WordPress.org link **/
    $wp_admin_bar->remove_menu('documentation');
    /** Remove the WordPress documentation link **/
    $wp_admin_bar->remove_menu('support-forums');
    /** Remove the support forums link **/
    $wp_admin_bar->remove_menu('feedback');
    /** Remove the feedback link **/
    //$wp_admin_bar->remove_menu('site-name');      /** Remove the site name menu **/
    //$wp_admin_bar->remove_menu('view-site');        /** Remove the view site link **/
    $wp_admin_bar->remove_menu('wpseo-menu');
    /** Remove the view site link **/
    $wp_admin_bar->remove_menu('updates');
    /** Remove the updates link **/
    $wp_admin_bar->remove_menu('comments');
    /** Remove the comments link **/
    $wp_admin_bar->remove_menu('new-content');
    /** Remove the content link **/
    $wp_admin_bar->remove_menu('w3tc');
    /** If you use w3 total cache remove the performance link **/
    //$wp_admin_bar->remove_menu('my-account');     /** Remove the user details tab **/
    
    //Admin bar Front-end
    if (wp_get_current_user()->ID != 1) {
        $wp_admin_bar->remove_menu('customize');
        $wp_admin_bar->remove_menu('themes');
        $wp_admin_bar->remove_menu('widgets');
        $wp_admin_bar->remove_menu('menus');
    }
}

add_action('admin_bar_menu', 'kbw_admin_bar_helper', 35);
function kbw_admin_bar_helper()
{
    global $wp_admin_bar;
    
    $kabiweb_icon = '<img src="' . get_template_directory_uri() . '/inc/admin/images/icon-menu.png" style="height: 20px;vertical-align: middle;margin-top: -4px;">';
    
    if (current_user_can('manage_options')) {
        $wp_admin_bar->add_menu(array(
            'parent' => 0,
            'id' => KBW_GLOBAL_SLUG_NAME,
            'title' => $kabiweb_icon . ' ' . KBW_GLOBAL_MENU_NAME,
            'href' => admin_url('admin.php?page=' . KBW_OPTION_SLUG)
        ));
        $wp_admin_bar->add_menu(array(
            'parent' => KBW_GLOBAL_SLUG_NAME,
            'id' => 'kbwmenumanager_page',
            'title' => __('Menu Manager', 'kbw'),
            'href' => admin_url('nav-menus.php')
        ));
        $wp_admin_bar->add_menu(array(
            'parent' => KBW_GLOBAL_SLUG_NAME,
            'id' => 'kbwwidgetmanager_page',
            'title' => __('Edit Module', 'kbw'),
            'href' => admin_url('widgets.php')
        ));
    }
}


/**
 *  REMOVE DEFAULT WIDGET IN ADMIN
 */
add_action('wp_dashboard_setup', 'kbw_remove_dashboard_widgets', 999);
function kbw_remove_dashboard_widgets()
{
    global $wp_meta_boxes;
    
    //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    //unset($wp_meta_boxes['dashboard']['normal']['core']['welcome-panel']);
    
    unset($wp_meta_boxes['dashboard']['normal']['core']['woocommerce_dashboard_recent_reviews']);
    //unset($wp_meta_boxes['dashboard']['normal']['core']['woocommerce_dashboard_status']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
    //remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' );
    //unset($wp_meta_boxes['dashboard']['side']['core']['redux_dashboard_widget']);
    remove_meta_box('redux_dashboard_widget', 'dashboard', 'side');
    
    remove_action('welcome_panel', 'wp_welcome_panel');
    
    if (wp_get_current_user()->ID != 1) {
        remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    }
}


/**
 *  CREAT WIDGET IN ADMIN PAGE
 */
add_action('wp_dashboard_setup', 'kbw_create_admin_widget_notice');
function kbw_create_admin_widget_notice()
{
    wp_add_dashboard_widget('kbw_notice', __('Introduction', 'kbw'), 'kbw_create_admin_widget_notice_callback');
}

function kbw_create_admin_widget_notice_callback()
{
    //echo do_shortcode('[kbw_category_posts]');
    echo '<p><strong>' . __('Website Information', 'kbw') . '</strong></p>';
    echo '<p>' . get_bloginfo('name') . ' | ' . get_bloginfo('description') . '</p>';
    echo '<p><strong>' . __('Hotline:', 'kbw') . ' </strong>' . kbw_get_option('hotline') . '</p>';
    echo '<p><strong>' . __('Email:', 'kbw') . ' </strong>' . kbw_get_option('email') . '</p>';
    echo '<p><strong>' . __('Address:', 'kbw') . ' </strong>' . kbw_get_option('address') . '</p>';
    echo '<p><strong>' . __('Developer', 'kbw') . '</strong></p>';
    echo '<p>Developed by <a href="https://kabiweb.com/" target="_blank"><strong>KabiWeb</strong></a> on <strong> Wordpress ' . get_bloginfo("version") . '</strong> platform</p>';
}


//CUSTOMIZE FOOTER THANNK YOU
add_filter('admin_footer_text', 'kbw_edit_footer_text');
function kbw_edit_footer_text($content)
{
    return '<span id="footer-thankyou">Developed by <a href="https://kabiweb.com/" target="_blank"><strong>KabiWeb</strong></a></span>';
}


// CUSTOMIZE WP VERSION (FOOTER)
function kbw_change_footer_version()
{
    return '';
}

if (wp_get_current_user()->ID != 1) {
    add_filter('update_footer', 'kbw_change_footer_version', 9999);
}

// Hide the "Please update now" notification
if (wp_get_current_user()->ID != 1) {
    add_action('admin_notices', 'kbw_hide_update_notice', 1);
}
function kbw_hide_update_notice()
{
    remove_action('admin_notices', 'update_nag', 3);
}

//Fix HTML5 contact form 7 on Firefox
//add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

//Not load css, js contact form 7
//add_filter( 'wpcf7_load_js', '__return_false' );
//add_filter( 'wpcf7_load_css', '__return_false' );
