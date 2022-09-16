<?php
if (!class_exists('Redux')) {
    return;
}

$opt_name = KBW_THEME_NAME;
$page_slug = 'kbw-options';
$page_title = 'KBW Options';
$menu_title = 'KBW Options';
$author_url = 'https://www.facebook.com/bvkhanh88';

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'opt_name' => $opt_name,
    'disable_tracking' => true,
    'display_name' => $theme->get('Name'),
    'display_version' => $theme->get('Version'),
    'menu_type' => 'menu',
    'allow_sub_menu' => false,
    'menu_title' => __($menu_title, 'kbw'),
    'page_title' => __($page_title, 'kbw'),
    'google_api_key' => '',
    'google_update_weekly' => false,
    'async_typography' => true,
    //'disable_google_fonts_link' => true,      // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    'admin_bar_icon' => 'dashicons-portfolio',
    'admin_bar_priority' => 50,
    'global_variable' => $opt_name,
    'dev_mode' => false,
    'update_notice' => false,
    'customizer' => false,
    //'open_expanded'     => true,     // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,     // Disable the save warning when a user changes a field
    'page_priority' => null,
    'page_parent' => 'themes.php',
    'page_permissions' => 'manage_options',
    'menu_icon' => '',
    'last_tab' => '',
    'page_icon' => 'icon-themes',
    'page_slug' => $page_slug,
    'save_defaults' => true,
    'default_show' => false,
    'default_mark' => '',
    'show_import_export' => true,
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    'output_tag' => true,
    //'footer_credit'     => '',       // Disable the footer credit of Redux. Please leave if you can help it.
    'database' => '',
    'system_info' => false,
    //'compiler'             => true,
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    )
);

$args['share_icons'][] = array(
    'url' => 'https://www.facebook.com/bvkhanh88',
    'title' => 'Follow us on FB',
    'icon' => 'el el-facebook'
);
$args['share_icons'][] = array(
    'url' => 'https://twitter.com/bvkhanh88',
    'title' => 'Follow us on Twitter',
    'icon' => 'el el-twitter'
);

$args['intro_text'] = '';
$args['footer_text'] = '<strong>Copyright &copy; 2019 <a href="' . $author_url . '" target="_blank">HK THEME</a></strong>';

Redux::setArgs($opt_name, $args);

$tabs = array(
    array(
        'id' => 'redux-help-tab-1',
        'title' => __('Theme Information', 'kbw'),
        'content' => __('<p>If you have any question please check documentation <a href="' . $author_url . '">Documentation</a>. And that are beyond the scope of documentation, please feel free to contact us.</p>', 'kbw')
    ),
);
Redux::setHelpTab($opt_name, $tabs);

// Set the help sidebar
$content = __('<p></p>', 'kbw');
Redux::setHelpSidebar($opt_name, $content);

//Basic Settings
Redux::setSection($opt_name, array(
    'title' => __('Basic Settings', 'kbw'),
    'id' => 'basic-settings',
    'icon' => 'el el-home',
    'class' => 'kbw-section-option kbw-show',
    'fields' => array(
        array(
            'id' => 'main_layout',
            'type' => 'image_select',
            'title' => __('Main Layout', 'kbw'),
            'subtitle' => __('Select main content and sidebar alignment.', 'kbw'),
            'options' => array(
                'nosidebar' => array(
                    'alt' => 'Full Width',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'left' => array(
                    'alt' => 'Left Sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'right' => array(
                    'alt' => 'Right Sidebar',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'left-right' => array(
                    'alt' => 'Two Sidebar L-R',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
                'two-sidebar-left' => array(
                    'alt' => 'Two Sidebar Left',
                    'img' => ReduxFramework::$_url . 'assets/img/3cl.png'
                ),
                'two-sidebar-right' => array(
                    'alt' => 'Two Sidebar Right',
                    'img' => ReduxFramework::$_url . 'assets/img/3cr.png'
                ),
            ),
            'default' => 'right',
        ),
        array(
            'id' => 'logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo Image', 'kbw'),
            'compiler' => 'true',
            'desc' => '',
            'subtitle' => __('Set an image file for your logo', 'kbw'),
            //'default' => array('url' => KBW_THEME_DIRECTORY_URI . "/assets/images/logo.png"),
        ),
        array(
            'id' => 'logo_mobile',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo Mobile Image', 'kbw'),
            'compiler' => 'true',
            'desc' => '',
            'subtitle' => __('Set an image file for your logo', 'kbw'),
            //'default' => array('url' => KBW_THEME_DIRECTORY_URI . "/assets/images/logo.png"),
        ),
        array(
            'id' => 'favicon',
            'type' => 'media',
            'url' => true,
            'title' => __('Favicon'),
            'compiler' => 'true',
            'desc' => '',
            'subtitle' => __('Set a 16x16 ico image for your favicon', 'kbw'),
            'default' => array('url' => KBW_THEME_DIRECTORY_URI . "/assets/images/favicon.png"),
        ),
        array(
            'id' => 'sub_sitetitle',
            'type' => 'text',
            'title' => __('Sub Site Title', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '',
        ),
        array(
            'id' => 'phone',
            'type' => 'text',
            'title' => __('Phone', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '0968909308',
        ),
        array(
            'id' => 'hotline',
            'type' => 'text',
            'title' => __('Hotline', 'kbw'),
            'subtitle' => __('Set hotline number in header. Leave blank to hide phone number field', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '0968909308',
        ),
        array(
            'id' => 'email',
            'type' => 'text',
            'title' => __('Email', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => 'bvkhanh88@gmail.com',
        ),
        array(
            'id' => 'address',
            'type' => 'text',
            'title' => __('Address 1', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => 'HV Nong Nghiep Vietnam',
        ),
        array(
            'id' => 'address_2',
            'type' => 'text',
            'title' => __('Address 2', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => 'HV Nong Nghiep Vietnam',
        ),
        array(
            'id' => 'gallery_home',
            'type' => 'gallery',
            'title' => __('Add/Edit Gallery Home', 'kbw'),
            'subtitle' => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'kbw'),
            'desc' => __('This is the description field, again good for additional info.', 'kbw'),
        )
    )
));

//Config Image Size
Redux::setSection($opt_name, array(
    'title' => __('Config Image Size', 'kbw'),
    'id' => 'config-image-size',
    'icon' => 'el el-picture',
    'class' => 'kbw-section-option kbw-show',
    'fields' => array(
        
        //KBW Thumbnail Size
        array(
            'id' => 'section-kbw-thumbnail-size',
            'type' => 'section',
            'title' => esc_html__('Thumbnail Image Size', 'kbw'),
            'indent' => true
        ),
        array(
            'id' => 'kbw-thumbnail-width',
            'type' => 'text',
            'title' => __('Thumbnail Width (px)', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '400',
        ),
        array(
            'id' => 'kbw-thumbnail-height',
            'type' => 'text',
            'title' => __('Thumbnail Height (px)', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '280',
        ),
        
        //KBW Related Size
        array(
            'id' => 'section-related-size',
            'type' => 'section',
            'title' => esc_html__('Related Image Size', 'kbw'),
            'indent' => true
        ),
        array(
            'id' => 'kbw-related-width',
            'type' => 'text',
            'title' => __('Related Width (px)', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '400',
        ),
        array(
            'id' => 'kbw-related-height',
            'type' => 'text',
            'title' => __('Related Height (px)', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '280',
        ),
        
        //KBW Small Size
        array(
            'id' => 'section-small-size',
            'type' => 'section',
            'title' => esc_html__('Small Image Size', 'kbw'),
            'indent' => true
        ),
        array(
            'id' => 'kbw-small-width',
            'type' => 'text',
            'title' => __('Small Width (px)', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '150',
        ),
        array(
            'id' => 'kbw-small-height',
            'type' => 'text',
            'title' => __('Small Height (px)', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '150',
        ),
    )
));


//Styling Options


//Header
Redux::setSection($opt_name, array(
    'title' => __('Header', 'kbw'),
    'id' => 'header-settings',
    'icon' => 'el el-credit-card',
    'class' => 'kbw-section-option kbw-show-admin',
    'fields' => array(
        array(
            'id' => 'section-top-bar-desktop',
            'type' => 'section',
            'title' => esc_html__('Desktop Settings', 'kbw'),
            'indent' => true
        ),
        array(
            'id' => 'header_layout',
            'type' => 'button_set',
            'title' => esc_html__('Header Layout', 'kbw'),
            'subtitle' => esc_html__('Select Layout', 'kbw'),
            'desc' => '',
            'options' => array(
                'full' => esc_html__('Full Width', 'kbw'),
                'container' => esc_html__('Container', 'kbw')
            ),
            'default' => 'container',
            'required' => array(),
        ),
        array(
            'id' => 'header_style',
            'type' => 'select',
            'title' => __('Header Style', 'kbw'),
            'subtitle' => __('Select header style', 'kbw'),
            'options' => array(
                'header-1' => 'Style 1',
                'header-2' => 'Style 2',
                'header-3' => 'Style 3'
            ),
            'default' => 'header-1',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'kbw_header_code',
            'type' => 'textarea',
            'title' => __('Header Code', 'kbw'),
            'subtitle' => __('Enter the code which you need to place before closing </head> tag. (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)', 'kbw'),
            'desc' => __('', 'kbw'),
            'default' => '',
        ),
        
        //--------------------------------------------------------------
        array(
            'id' => 'section-top-bar-mobile',
            'type' => 'section',
            'title' => esc_html__('Mobile Settings', 'kbw'),
            'indent' => true
        ),
        array(
            'id' => 'mobile_header_style',
            'type' => 'image_select',
            'title' => esc_html__('Mobile Header Style', 'kbw'),
            'subtitle' => esc_html__('Select header mobile layout', 'kbw'),
            'desc' => '',
            'options' => array(
                'header-mobile-1' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/header/header-mobile-style-1.png'),
                'header-mobile-2' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/header/header-mobile-style-2.png'),
                'header-mobile-3' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/header/header-mobile-style-3.png'),
                'header-mobile-4' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/header/header-mobile-style-4.png'),
            ),
            'default' => 'header-mobile-1'
        ),
        array(
            'id' => 'mobile_header_menu_drop',
            'type' => 'button_set',
            'title' => esc_html__('Menu Drop Type', 'kbw'),
            'subtitle' => esc_html__('Set menu drop type for mobile header', 'kbw'),
            'desc' => '',
            'options' => array(
                'menu-drop-dropdown' => esc_html__('Dropdown Menu', 'kbw'),
                'menu-drop-fly' => esc_html__('Fly Menu', 'kbw')
            ),
            'default' => 'menu-drop-fly'
        ),
    )
));


//Header Customize


//Footer
Redux::setSection($opt_name, array(
    'title' => __('Footer', 'kbw'),
    'id' => 'footer-settings',
    'icon' => 'el el-website',
    'class' => 'kbw-section-option kbw-show-admin',
    'fields' => array(
        array(
            'id' => 'footer_layout',
            'type' => 'button_set',
            'title' => esc_html__('Footer Layout', 'kbw'),
            'subtitle' => esc_html__('Select Layout', 'kbw'),
            'desc' => '',
            'options' => array(
                'full' => esc_html__('Full Width', 'kbw'),
                'container' => esc_html__('Container', 'kbw')
            ),
            'default' => 'container',
            'required' => array(),
        ),
        array(
            'id' => 'footer_style',
            'type' => 'image_select',
            'title' => esc_html__('Footer Style', 'kbw'),
            'subtitle' => esc_html__('Select the footer column layout.', 'kbw'),
            'desc' => '',
            'options' => array(
                'footer-1' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-1.jpg'),
                'footer-2' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-2.jpg'),
                'footer-3' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-3.jpg'),
                'footer-4' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-4.jpg'),
                'footer-5' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-5.jpg'),
                'footer-6' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-6.jpg'),
                'footer-7' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-7.jpg'),
                'footer-8' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-8.jpg'),
                'footer-9' => array('title' => '', 'img' => KBW_THEME_DIRECTORY_URI . '/assets/images/theme-options/footer/footer-layout-9.jpg'),
            ),
            'default' => 'footer-1'
        )
    )
));


//Sidebars

//Archive Settings

//Post Settings

//Custom Post Type Settings
Redux::setSection($opt_name, array(
    'title' => __('Main Content Type', 'kbw'),
    //'id' => 'cpt-settings',
    'icon' => 'el el-screenshot',
    //'icon_class' => 'icon',
    'class' => 'kbw-section-option kbw-show-admin',
    'fields' => array(
        array(
            'id' => 'section-top-bar-ganeral-cpt',
            'type' => 'section',
            'title' => esc_html__('Ganeral', 'kbw'),
            'indent' => true
        ),
        array(
            'id' => 'enable-maincpt',
            'type' => 'switch',
            'title' => __('Maincpt Content Type', 'kbw'),
            'default' => false,
            'on' => __('Enable', 'kbw'),
            'off' => __('Disable', 'kbw'),
        ),
        array(
            'id' => "maincpt-slug",
            'type' => 'text',
            'title' => __('Slug', 'kbw'),
            'placeholder' => 'maincpt',
            'required' => array('enable-maincpt', '=', true),
        ),
        array(
            'id' => "maincpt-name",
            'type' => 'text',
            'title' => __('Name', 'kbw'),
            'placeholder' => __('Maincpt', 'kbw'),
            'required' => array('enable-maincpt', '=', true),
        ),
        array(
            'id' => "maincpt-singular-name",
            'type' => 'text',
            'title' => __('Singular Name', 'kbw'),
            'placeholder' => __('Maincpt', 'kbw'),
            'required' => array('enable-maincpt', '=', true),
        ),
        array(
            'id' => 'enable-maincpt-cat',
            'type' => 'switch',
            'title' => __('Maincpt Category', 'kbw'),
            'default' => false,
            'on' => __('Enable', 'kbw'),
            'off' => __('Disable', 'kbw'),
            'required' => array('enable-maincpt', '=', true),
        ),
        array(
            'id' => "maincpt-cat-name",
            'type' => 'text',
            'title' => __('Category label', 'kbw'),
            'placeholder' => 'Maincpt Category',
            'required' => array('enable-maincpt-cat', '=', true),
        ),
        array(
            'id' => "maincpt-cats-name",
            'type' => 'text',
            'title' => __('Categories label', 'kbw'),
            'placeholder' => 'Maincpt Categories',
            'required' => array('enable-maincpt-cat', '=', true),
        ),
        array(
            'id' => "maincpt-cat-slug",
            'type' => 'text',
            'title' => __('Category Slug', 'kbw'),
            'placeholder' => 'maincpt-cat',
            'required' => array('enable-maincpt-cat', '=', true),
        ),
        array(
            'id' => 'enable-maincpt-skill',
            'type' => 'switch',
            'title' => __('Maincpt Skill', 'kbw'),
            'default' => false,
            'on' => __('Enable', 'kbw'),
            'off' => __('Disable', 'kbw'),
            'required' => array('enable-maincpt', '=', true),
        ),
        array(
            'id' => "maincpt-skill-name",
            'type' => 'text',
            'title' => __('Skill label', 'kbw'),
            'placeholder' => 'Maincpt Skill',
            'required' => array('enable-maincpt-skill', '=', true),
        ),
        array(
            'id' => "maincpt-skills-name",
            'type' => 'text',
            'title' => __('Skills label', 'kbw'),
            'placeholder' => 'Maincpt Skills',
            'required' => array('enable-maincpt-skill', '=', true),
        ),
        array(
            'id' => "maincpt-skill-slug",
            'type' => 'text',
            'title' => __('Skill Slug', 'kbw'),
            'placeholder' => 'maincpt-skill',
            'required' => array('enable-maincpt-skill', '=', true),
        ),
        array(
            'id' => "maincpt-archive-page",
            'type' => 'select',
            'data' => 'page',
            'title' => __('Maincpt Page', 'kbw'),
            'required' => array('enable-maincpt', '=', true),
        )
    )
));

if (kbw_isWooCommerce()) {

} //End kbw_isWoocommerce()

//Advance Settings
$field_advance_settings = array(
    array(
        'id' => 'enable-testimonial',
        'type' => 'switch',
        'title' => __('Enable Testimonial', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'desc' => __('', 'kbw'),
        'default' => false,
    ),
    array(
        'id' => "fast-order-page",
        'type' => 'select',
        'data' => 'page',
        'title' => __('Fast Order Page', 'kbw'),
        'required' => array(),
    ),
    array(
        'id' => 'kbw-currency-symbol',
        'type' => 'text',
        'title' => __('Currency symbol', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'default' => 'đ',
    ),
    array(
        'id' => 'facebook_app_id',
        'type' => 'text',
        'title' => __('Facebook App ID', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'default' => '1524800134509668',
    ),
    array(
        'id' => 'fanpage_url',
        'type' => 'text',
        'title' => __('Fanpage URL', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'default' => 'https://www.facebook.com/facebookappVietnam',
    ),
    array(
        'id' => 'dashboard_logo',
        'type' => 'media',
        'url' => true,
        'title' => __('WordPress Login page Logo'),
        'compiler' => 'true',
        'desc' => '',
        'subtitle' => __('Set an image file for your logo login page', 'kbw'),
        //'default' => array('url' => KBW_THEME_DIRECTORY_URI . "/assets/images/logo.png"),
    ),
    array(
        'id' => 'dashboard_logo_url',
        'type' => 'text',
        'title' => __('WordPress Login page Logo URL', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'default' => '',
    ),
    array(
        'id' => 'hide_adminbar_frontend',
        'type' => 'switch',
        'title' => __('Disable Frontend Adminbar', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'desc' => __('', 'kbw'),
        'default' => false,
    ),
    array(
        'id' => 'custom_admin_theme',
        'type' => 'switch',
        'title' => __('Custom Admin Theme', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'desc' => __('', 'kbw'),
        'default' => false,
    ),
    array(
        'id' => 'custom_wp_image_size',
        'type' => 'switch',
        'title' => __('Custom WP Image Size', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'desc' => __('', 'kbw'),
        'default' => false,
    ),
    array(
        'id' => 'post_views',
        'type' => 'switch',
        'title' => __('Views Meta', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'desc' => __('', 'kbw'),
        'on' => __('Show', 'kbw'),
        'off' => __('Hide', 'kbw'),
        'default' => false,
    )
);
if (kbw_isWooCommerce()) {
    $field_advance_settings[] = array(
        'id' => 'custom_woo_image_size',
        'type' => 'switch',
        'title' => __('Custom Woocommerce Image Size', 'kbw'),
        'subtitle' => __('', 'kbw'),
        'desc' => __('', 'kbw'),
        'default' => false,
    );
}
Redux::setSection($opt_name, array(
    'title' => __('Advance Settings', 'kbw'),
    'id' => 'advance-settings',
    'icon' => 'el el-wrench',
    'class' => 'kbw-section-option kbw-show',
    'fields' => $field_advance_settings
));

//Custom Module Settings
Redux::setSection($opt_name, array(
    'title' => __('Custom Modules', 'kbw'),
    'id' => 'module-settings',
    //'icon'  => '',
    'class' => 'kbw-section-option kbw-show',
    'fields' => array(
        array(
            'id' => 'header_html',
            'type' => 'ace_editor',
            'mode' => 'html',
            'theme' => 'monokai',
            'title' => esc_html__('Header Content', 'kbw'),
            'subtitle' => esc_html__('Add Content for Custom Text', 'kbw'),
            'desc' => '',
            'default' => '',
            'options' => array('minLines' => 15, 'maxLines' => 60),
        ),
        array(
            'id' => 'module-1',
            'type' => 'editor',
            'title' => __('Module 1', 'kbw'),
            'subtitle' => __('', 'kbw'),
            'default' => file_get_contents(dirname(__FILE__) . '/templates/header-content.html'),
            'args' => array(
                'teeny' => false,
                'textarea_rows' => 10,
            )
        ),
        array(
            'id' => 'copyright',
            'type' => 'editor',
            'title' => __('Copyright', 'kbw'),
            'subtitle' => __('These tags can be included in the textarea above and will be replaced when a page is displayed.<br /><br />%<strong>year</strong>% : Replaced with the current year.<br />%<strong>site</strong>% : Replaced with The site\'s name.<br />%<strong>url</strong>% : Replaced with The site\'s URL.', 'kbw'),
            'default' => '<p>Copyright ©%year% <strong>%site%</strong>. All Right Reserved.</p>',
            'args' => array(
                'teeny' => false,
                'textarea_rows' => 10,
            )
        )
    )
));

// add-on compatibility
$kbw_add_on_settings = apply_filters('kbw_options_addon_settings', array());
if (!empty($acc_add_on_settings)) {
    Redux::setSection($opt_name, array(
        'title' => __('Add-On Settings', 'kbw'),
        'id' => 'kbw-add-settings',
        'subsection' => true,
        'fields' => array($kbw_add_on_settings)
    ));
}

if (file_exists(dirname(__FILE__) . '/README.md')) {
    $section = array(
        'icon' => 'el el-list-alt',
        'title' => __('Documentation', 'kbw'),
        'fields' => array(
            array(
                'id' => '17',
                'type' => 'raw',
                'markdown' => true,
                'content' => file_get_contents(dirname(__FILE__) . '/README.md')
            ),
        ),
    );
    //Redux::setSection($opt_name, $section);
}
