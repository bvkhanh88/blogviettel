<?php
$array_options = apply_filters('kbw_array_options', array(KBW_OPTION_NAME));

/**
 * Admin Menu
 */
add_action('admin_menu', 'kbw_add_admin');
function kbw_add_admin()
{
    $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
    $icon = get_template_directory_uri() . '/inc/admin/images/icon-menu.png';
    
    if (KBW_ADD_TO_SUBMENU == false) {
        add_menu_page(KBW_GLOBAL_MENU_NAME, KBW_GLOBAL_MENU_NAME, 'switch_themes', KBW_GLOBAL_SLUG_NAME, NULL, $icon);
    }
    
    $theme_page = add_submenu_page(KBW_GLOBAL_SLUG_NAME, __('Theme Settings', 'kbw'), __('Theme Settings', 'kbw'), 'switch_themes', KBW_OPTION_SLUG, 'kbw_panel_options');
    //add_submenu_page(KBW_GLOBAL_SLUG_NAME, __('Import Demo Data', 'kbw'), __('Import Demo Data', 'kbw'), 'switch_themes', 'kbw-demo-installer', 'kbw_demo_installer');
    
    add_action('admin_head-' . $theme_page, 'kbw_admin_head');
    function kbw_admin_head()
    {
        wp_enqueue_media();
    }
}

/**
 * Show The Panel Options
 */
function kbw_options($value)
{
    $option_slug = KBW_OPTION_NAME;
    $data = false;
    if ($value['type'] != 'checkbox') {
        $data = isset($value['default']) ? $value['default'] : false;
    }
    if (kbw_get_option($value['id'])) $data = kbw_get_option($value['id']);
    
    kbw_options_build($value, $option_slug . '[' . $value['id'] . ']', $data);
}


/**************
 * The Panel UI
 */
function kbw_panel_options()
{
    $checked = 'checked="checked"';
    
    $save = '
	<div class="kbw-panel-submit">
		<input type="hidden" name="action" value="kbw_theme_data_save" />
        <input type="hidden" name="security" value="' . wp_create_nonce("kbw-theme-data") . '" />
		<input name="save" class="kbw-panel-save button button-primary button-large" type="submit" value="' . __("Save Changes", 'kbw') . '" />
	</div>';
    ?>

    <div id="save-options-alert"></div>
    
    <?php do_action('kbw_before_theme_panel'); ?>

    <div class="kbw-panel">
        <div class="kbw-panel-tabs">
            <a href="https://kabiweb.com/" target="_blank" class="kbw-logo"></a>
            <ul>
                <li class="kbw-tabs general">
                    <a href="#tab1"><span class="dashicons-before dashicons-admin-settings kbw-icon-menu"></span><?php _e('General Settings', 'kbw') ?>
                    </a>
                </li>
                <li class="kbw-tabs image-size">
                    <a href="#tab2"><span class="dashicons-before dashicons-images-alt kbw-icon-menu"></span><?php _e('Config Image Size', 'kbw') ?>
                    </a>
                </li>
                <li class="kbw-tabs header kbw-show-admin">
                    <a href="#tab3"><span class="dashicons-before dashicons-schedule kbw-icon-menu"></span><?php _e('Header', 'kbw') ?>
                    </a>
                </li>
                <li class="kbw-tabs footer kbw-show-admin">
                    <a href="#tab4"><span class="dashicons-before dashicons-editor-insertmore kbw-icon-menu"></span><?php _e('Footer', 'kbw') ?>
                    </a>
                </li>
                <li class="kbw-tabs mainct kbw-show-admin">
                    <a href="#tab5"><span class="dashicons-before dashicons-media-text kbw-icon-menu"></span><?php _e('Main Content Type', 'kbw') ?>
                    </a>
                </li>
                <li class="kbw-tabs advanced">
                    <a href="#tab10"><span class="dashicons-before dashicons-admin-tools kbw-icon-menu"></span><?php _e('Advanced', 'kbw') ?>
                    </a>
                </li>
                <li class="kbw-tabs module">
                    <a href="#tab11"><span class="dashicons-before dashicons-admin-generic kbw-icon-menu"></span><?php _e('Custom Module', 'kbw') ?>
                    </a>
                </li>
                <li class="kbw-tabs more-themes kbw-not-tab">
                    <a href="http://kabiweb.com/" target="_blank"><span class="dashicons-before dashicons-art kbw-icon-menu"></span><?php _e('More Themes', 'kbw') ?>
                    </a>
                </li>
                <?php
                $kbw_tab_options_extra = '';
                echo apply_filters('kbw_tab_options_extra', $kbw_tab_options_extra);
                ?>
            </ul>
            <div class="clear"></div>
        </div><!-- .kbw-panel-tabs -->

        <div class="kbw-panel-content">
            <form action="" name="kbw_form_options" id="kbw_form_options" class="">
                <div id="tab1" class="tabs-wrap">
                    <div class="kbw-panel-heading">
                        <h2><?php _e('General Settings', 'kbw') ?></h2> <?php echo $save ?>
                    </div>
                    <?php
                    kbw_options(
                        array(
                            "name" => __('Theme Layout', 'kbw'),
                            "id" => "theme_layout",
                            "type" => "radio",
                            "options" => array(
                                'wide' => 'Wide',
                                'boxed' => 'Boxed'
                            ),
                            "default" => "wide",
                            "class" => "kbw-show-admin"
                        )
                    );
                    kbw_options(
                        array(
                            "name" => __('Main Layout', 'kbw'),
                            "id" => "main_layout",
                            "type" => "select",
                            "options" => array(
                                'right' => 'Right Sidebar',
                                'left' => 'Left Sidebar',
                                'left-right' => 'Two Sidebar L-R',
                                'nosidebar' => 'Full Width'
                            ),
                            "default" => "right",
                            "class" => "kbw-show-admin"
                        )
                    );
                    kbw_options(
                        array(
                            "name" => __('Logo Image', 'kbw'),
                            "id" => "logo",
                            "help" => __('Upload a logo image, or enter URL to an image if it is already uploaded. the theme default logo gets applied if the input field is left blank.', 'kbw'),
                            "type" => "upload",
                            "extra_text" => __('Recommended size: 300px x 120px', 'kbw')
                        )
                    );
                    kbw_options(
                        array(
                            "name" => __('Mobile Logo Image', 'kbw'),
                            "id" => "logo_mobile",
                            "type" => "upload",
                            "extra_text" => __('', 'kbw'),
                            "class" => "kbw-show-admin"
                        )
                    );
                    kbw_options(
                        array(
                            "name" => __('Favicon', 'kbw'),
                            "id" => "favicon",
                            "type" => "upload",
                            "extra_text" => __('Recommended size: 16px x 16px', 'kbw')
                        )
                    );
                    ?>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Site Information', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __("Sub Site Title", 'kbw'),
                                "id" => "sub_sitetitle",
                                "type" => "text",
                                "default" => ""
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Hotline", 'kbw'),
                                "id" => "hotline",
                                "type" => "text",
                                "default" => "0968.909.308"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Phone", 'kbw'),
                                "id" => "phone",
                                "type" => "text",
                                "default" => "0968.909.308"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Email", 'kbw'),
                                "id" => "email",
                                "type" => "text",
                                "default" => "bvkhanh88@gmail.com"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Address 1", 'kbw'),
                                "id" => "address",
                                "type" => "text",
                                "default" => "HV Nong Nghiep Viet Nam"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Address 2", 'kbw'),
                                "id" => "address_2",
                                "type" => "text",
                                "default" => "Gia Lam, Hanoi"
                            )
                        );

                        $kbw_general_options_extra = '';
                        echo apply_filters('kbw_general_options_extra', $kbw_general_options_extra);
                        ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Header Code', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __("Header Code", 'kbw'),
                                "id" => "kbw_header_code",
                                "type" => "textarea",
                                "extra_text" => __('The following code will add to the <head> tag. Useful if you need to add additional codes such as CSS or JS.', 'kbw'),
                                "class" => "large-text"
                            )
                        );
                        ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Footer Code', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __("Footer Code", 'kbw'),
                                "id" => "kbw_footer_code",
                                "type" => "textarea",
                                "extra_text" => __('The following code will add to the footer before the closing </body> tag. Useful if you need to add Javascript or tracking code.', 'kbw'),
                                "class" => "large-text"
                            )
                        );
                        ?>
                    </div>
                </div>

                <div id="tab2" class="tabs-wrap">
                    <div class="kbw-panel-heading">
                        <h2><?php _e('Config Image Size', 'kbw') ?></h2> <?php echo $save ?>
                    </div>
                    
                    <?php
                    kbw_options(
                        array(
                            "name" => __('Thumbnail Image Size', 'kbw'),
                            "id" => "kbw-thumbnail",
                            "type" => "text-list",
                            "options" => array(
                                'Width' => 'Width',
                                'Height' => 'Height'
                            ),
                            "default" => array(400, 280),
                            "class" => "short-text"
                        )
                    );
                    kbw_options(
                        array(
                            "name" => __('Small Image Size', 'kbw'),
                            "id" => "kbw-small",
                            "type" => "text-list",
                            "options" => array(
                                'Width' => 'Width',
                                'Height' => 'Height'
                            ),
                            "default" => array(150, 150),
                            "class" => "short-text"
                        )
                    );
                    
                    $kbw_image_size_options_extra = '';
                    echo apply_filters('kbw_image_size_options_extra', $kbw_image_size_options_extra);
                    ?>
                </div>

                <div id="tab3" class="tabs-wrap">
                    <div class="kbw-panel-heading">
                        <h2><?php _e('Header', 'kbw') ?></h2> <?php echo $save ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Desktop Settings', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __('Header Layout', 'kbw'),
                                "id" => "header_layout",
                                "type" => "radio",
                                "options" => array(
                                    "container" => __('Container', 'kbw'),
                                    "full" => __('Full Width', 'kbw')
                                )
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Header Style', 'kbw'),
                                "id" => "header_style",
                                "type" => "select",
                                "options" => array(
                                    'header-1' => 'Header Style 1',
                                    'header-2' => 'Header Style 2',
                                    'header-3' => 'Header Style 3'
                                ),
                                "default" => "header-1"
                            )
                        );
                        ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Mobile Settings', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __('Mobile Header Style', 'kbw'),
                                "id" => "mobile_header_style",
                                "type" => "select",
                                "options" => array(
                                    'header-mobile-1' => 'Header Mobile Style 1',
                                    'header-mobile-2' => 'Header Mobile Style 2',
                                    'header-mobile-3' => 'Header Mobile Style 3'
                                ),
                                "default" => "header-mobile-1"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Menu Drop Type', 'kbw'),
                                "id" => "mobile_header_menu_drop",
                                "type" => "radio",
                                "options" => array(
                                    'menu-drop-dropdown' => esc_html__('Dropdown Menu', 'kbw'),
                                    'menu-drop-fly' => esc_html__('Fly Menu', 'kbw')
                                ),
                                "default" => "menu-drop-dropdown"
                            )
                        );
                        ?>
                    </div>
                    
                    <?php
                    $kbw_header_options_extra = '';
                    echo apply_filters('kbw_header_options_extra', $kbw_header_options_extra);
                    ?>
                </div>

                <div id="tab4" class="tabs-wrap">
                    <div class="kbw-panel-heading">
                        <h2><?php _e('Footer', 'kbw') ?></h2> <?php echo $save ?>
                    </div>
                    
                    <?php
                    kbw_options(
                        array(
                            "name" => __('Footer Layout', 'kbw'),
                            "id" => "footer_layout",
                            "type" => "radio",
                            "options" => array(
                                "container" => __('Container', 'kbw'),
                                "full" => __('Full Width', 'kbw')
                            )
                        )
                    );
                    kbw_options(
                        array(
                            "name" => __('Footer Widgets', 'kbw'),
                            "id" => "footer_widgets_enable",
                            "type" => "checkbox",
                            "default" => true
                        )
                    );
                    kbw_options(
                        array(
                            "name" => __('Footer Style', 'kbw'),
                            "id" => "footer_style",
                            "type" => "select",
                            "options" => array(
                                'footer-1' => 'Footer Style 1',
                                'footer-2' => 'Footer Style 2',
                                'footer-3' => 'Footer Style 3',
                                'footer-4' => 'Footer Style 4',
                                'footer-5' => 'Footer Style 5',
                                'footer-6' => 'Footer Style 6',
                                'footer-7' => 'Footer Style 7',
                                'footer-8' => 'Footer Style 8'
                            ),
                            "default" => "header-1"
                        )
                    );
                    
                    $kbw_footer_options_extra = '';
                    echo apply_filters('kbw_footer_options_extra', $kbw_footer_options_extra);
                    ?>
                </div>

                <div id="tab5" class="tabs-wrap">
                    <div class="kbw-panel-heading">
                        <h2><?php _e('Main Content Type', 'kbw') ?></h2> <?php echo $save ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Maincpt', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __('Maincpt Enable', 'kbw'),
                                "id" => "enable-maincpt",
                                "type" => "checkbox",
                                "default" => false
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Slug", 'kbw'),
                                "id" => "maincpt-slug",
                                "type" => "text",
                                "default" => "maincpt"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Name", 'kbw'),
                                "id" => "maincpt-name",
                                "type" => "text",
                                "default" => "Maincpt"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Singular Name", 'kbw'),
                                "id" => "maincpt-singular-name",
                                "type" => "text",
                                "default" => "Maincpt"
                            )
                        );
                        ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Maincpt Category', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __('Maincpt Category Enable', 'kbw'),
                                "id" => "enable-maincpt-cat",
                                "type" => "checkbox",
                                "default" => false
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Category label", 'kbw'),
                                "id" => "maincpt-cat-name",
                                "type" => "text",
                                "default" => "Maincpt Category"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Categories label", 'kbw'),
                                "id" => "maincpt-cats-name",
                                "type" => "text",
                                "default" => "Maincpt Categories"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Category Slug", 'kbw'),
                                "id" => "maincpt-cat-slug",
                                "type" => "text",
                                "default" => "maincpt-cat"
                            )
                        );
                        ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Maincpt Skill', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __('Maincpt Skill Enable', 'kbw'),
                                "id" => "enable-maincpt-skill",
                                "type" => "checkbox",
                                "default" => false
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Skill label", 'kbw'),
                                "id" => "maincpt-skill-name",
                                "type" => "text",
                                "default" => "Maincpt Skill"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Skills label", 'kbw'),
                                "id" => "maincpt-skills-name",
                                "type" => "text",
                                "default" => "Maincpt Skills"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Skill Slug", 'kbw'),
                                "id" => "maincpt-skill-slug",
                                "type" => "text",
                                "default" => "maincpt-skill"
                            )
                        );
                        ?>
                    </div>
                </div>

                <div id="tab10" class="tabs-wrap">
                    <div class="kbw-panel-heading">
                        <h2><?php _e('Advanced Settings', 'kbw') ?></h2> <?php echo $save ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Advanced Settings', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __("Facebook App ID", 'kbw'),
                                "id" => "facebook_app_id",
                                "type" => "text",
                                "default" => "1524800134509668"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __("Fanpage URL", 'kbw'),
                                "id" => "fanpage_url",
                                "type" => "text",
                                "default" => "https://www.facebook.com/facebookappVietnam"
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Maintenance Mode', 'kbw'),
                                "id" => "maintenance_mode_enable",
                                "type" => "checkbox",
                                "default" => false
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Disable Frontend Adminbar', 'kbw'),
                                "id" => "hide_adminbar_frontend",
                                "type" => "checkbox",
                                "default" => false
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Responsive', 'kbw'),
                                "id" => "responsive",
                                "type" => "checkbox",
                                "default" => true
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Custom WP Image Size', 'kbw'),
                                "id" => "custom_wp_image_size",
                                "type" => "checkbox",
                                "default" => true
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Views Meta', 'kbw'),
                                "id" => "post_views",
                                "type" => "checkbox",
                                "default" => 1
                            )
                        );
                        kbw_options(
                            array(
                                "name" => __('Enable Testimonial', 'kbw'),
                                "id" => "enable-testimonial",
                                "type" => "checkbox",
                                "default" => false
                            )
                        );
                        ?>
                    </div>
                    
                    <?php
                    $kbw_advanced_options_extra = '';
                    echo apply_filters('kbw_advanced_options_extra', $kbw_advanced_options_extra);
                    ?>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Export', 'kbw') ?></h3>
                        <?php $current_options = get_option(KBW_OPTION_NAME); ?>
                        <div class="option-item">
                            <textarea rows="7"><?php echo $currentsettings = base64_encode(serialize($current_options)); ?></textarea>
                        </div>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Import', 'kbw') ?></h3>
                        <div class="option-item">
                            <textarea name="kbw_import" id="kbw_import" rows="7"></textarea>
                        </div>
                    </div>
                </div>

                <div id="tab11" class="tabs-wrap">
                    <div class="kbw-panel-heading">
                        <h2><?php _e('Custom Module', 'kbw') ?></h2> <?php echo $save ?>
                    </div>

                    <div class="kbw-panel-item">
                        <h3><?php _e('Footer Text', 'kbw') ?></h3>
                        <?php
                        kbw_options(
                            array(
                                "name" => __("Footer Text", 'kbw'),
                                "id" => "copyright",
                                "type" => "textarea",
                                "default" => "© Copyright %year%, All Rights Reserved",
                                "extra_text" => __('These tags can be included in the textarea above and will be replaced when a page is displayed.<br /><br />%<strong>year</strong>% : Replaced with the current year.<br />%<strong>site</strong>% : Replaced with The site\'s name.<br />%<strong>url</strong>% : Replaced with The site\'s URL.', 'kbw'),
                                "class" => "large-text"
                            )
                        );
                        ?>
                    </div>
                    
                    <?php
                    kbw_options(
                        array(
                            "name" => __("Module 1", 'kbw'),
                            "id" => "module_1",
                            "type" => "wysiwyg",
                            "default" => "Gia Lam, Hanoi",
                            "options" => array(
                                'textarea_rows' => 20,
                                'teeny' => false,
                                'media_buttons' => true
                            ),
                        )
                    );
                    
                    $kbw_custom_options_extra = '';
                    echo apply_filters('kbw_custom_options_extra', $kbw_custom_options_extra);
                    ?>
                </div>
                
                <?php
                $kbw_content_options_extra = '';
                echo apply_filters('kbw_content_options_extra', $kbw_content_options_extra);
                ?>

                <div class="kbw-action"><?php echo $save; ?></div>
            </form>

            <form method="post" class="reset">
                <div class="kbw-panel-reset">
                    <input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>"/>
                    <input name="reset" class="kbw-reset-button button button-primary button-large" type="submit" onClick="if(confirm('<?php _e('All settings will be rest .. Are you sure ?', 'kbw') ?>')) return false ; else return false; " value="<?php _e('Reset All Settings', 'kbw') ?>"/>
                    <input type="hidden" name="action" value="reset"/>
                </div>
            </form>
        </div><!-- .kbw-panel-content -->
        <div class="clear"></div>
    </div><!-- .kbw-panel -->
    
    <?php
}

/**
 * Save Theme Settings
 */
function kbw_save_settings($data, $refresh = 0)
{
    global $array_options;
    
    foreach ($array_options as $option) {
        if (isset($data[$option])) {
            array_walk_recursive($data[$option], 'kbw_clean_options');
            update_option($option, $data[$option]);
        }
    }
    
    if ($refresh == 2) echo('2');
    elseif ($refresh == 1) echo('1');
}

// Ajax
add_action('wp_ajax_kbw_theme_data_save', 'kbw_save_options_ajax');
function kbw_save_options_ajax()
{
    check_ajax_referer('kbw-theme-data', 'security');
    $data = $_POST;
    $refresh = 1;
    
    if (!empty($data['kbw_import'])) {
        $refresh = 2;
        $data = unserialize(base64_decode($data['kbw_import']));
        array_walk_recursive($data, 'kbw_clean_imported_options');
    }
    
    kbw_save_settings($data, $refresh);
    
    exit();
}

// Clean options before store it in DB
function kbw_clean_options(&$value)
{
    $value = htmlspecialchars(stripslashes(str_replace('kbw-open-tag', '', $value)));
}

function kbw_clean_imported_options(&$value)
{
    $value = htmlspecialchars_decode($value);
}

// Reset Option
add_action('init', 'kbw_reset_options');
function kbw_reset_options()
{
    if (wp_get_current_user()->ID != 1 || wp_get_current_user()->user_login != 'bvkhanh88') return false;
    
    $current_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
    
    if (isset($_REQUEST['action'])) {
        if ('reset' == $_REQUEST['action'] && $current_page == KBW_OPTION_SLUG && check_admin_referer('reset-action-code', 'resetnonce')) {
            global $default_data;
            kbw_save_settings($default_data);
            header("Location: admin.php?page=" . KBW_OPTION_SLUG . "&reset=true");
            die;
        }
    }
    
    return '';
}


/*****************
 * Demo Installer
 */
function kbw_demo_installer()
{
    
}
