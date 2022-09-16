<?php
/**
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Deactivate meta box plugin if it is active.
 */
add_action('init', 'kbw_deactivate_meta_box_plugin');
function kbw_deactivate_meta_box_plugin()
{
    if (is_plugin_active('meta-box/meta-box.php')) {
        deactivate_plugins('meta-box/meta-box.php');
        add_action('admin_notices', function () {
            ?>
            <div class="update-nag notice is-dismissible">
                <p><strong><?php _e('Meta Box plugin has been deactivated!', 'kbw'); ?></strong></p>
                <p><?php _e('As similar functionality is already embedded with in KabiWeb Framework.', 'kbw'); ?></p>
                <p>
                    <em><?php _e('So, You should completely remove it from your plugins.', 'kbw'); ?></em>
                </p>
            </div>
            <?php
        });
    }
}

/**
 * Embedded Meta Box Plugin
 */
if (!class_exists('RW_Meta_Box')) {
    if (file_exists(KBW_INC_DIR . '/lib/meta-box/meta-box.php')) {
        require_once(KBW_INC_DIR . '/lib/meta-box/meta-box.php');
    }
}

// Include meta box tabs
if (!class_exists('MB_Tabs')) {
    if (file_exists(KBW_INC_DIR . '/lib/mb-extensions/meta-box-tabs/meta-box-tabs.php')) {
        require_once(KBW_INC_DIR . '/lib/mb-extensions/meta-box-tabs/meta-box-tabs.php');
    }
    
}

// Include term meta extension
if (!class_exists('MB_Term_Meta_Box')) {
    if (file_exists(KBW_INC_DIR . '/lib/mb-extensions/mb-term-meta/mb-term-meta.php')) {
        require_once(KBW_INC_DIR . '/lib/mb-extensions/mb-term-meta/mb-term-meta.php');
    }
}


/**
 * Deactivate redux framework plugin if it is active.
 */
//add_action('init', 'kbw_deactivate_redux_plugin');

/**
 * Embedded Redux Framework
 */
$redux_path = KBW_INC_DIR . '/lib/redux-framework';
if (is_dir($redux_path)):
    if (!class_exists('ReduxFramework')) {
        //require_once($redux_path . '/ReduxCore/framework.php');
    }
    if (!isset($redux_demo)) {
        //require_once($redux_path . '/config.php');
    }
endif;
