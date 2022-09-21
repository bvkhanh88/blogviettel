<?php
/**
 * Created by KabiWeb.
 * User: bvkhanh88@gmail.com
 * Date: 15/06/2018
 * Time: 11:21
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Add Metabox (not use Meta Box Plugin).
 */
add_action('add_meta_boxes', 'kbw_add_post_seeting_metabox');
function kbw_add_post_seeting_metabox()
{
    $screens = array('post', 'page');
    if (kbw_isWooCommerce()) $screens[] = 'product';
    if (kbw_get_option('enable-maincpt')) $screens[] = 'maincpt';
    foreach ($screens as $screen) {
        //Add a "Sidebar" selection metabox.
        add_meta_box(
            'kbw_post_seeting_metabox',                   // id
            __('Sidebar Seetings', 'kbw'),                   // title
            'kbw_inner_post_seeting_metabox',         // callback
            $screen,                                         // post_type
            'side',                                   // context (normal, advanced, side, after_title)
            'high'                                    // priority (high, core, default, low)
        // callback args ($post passed by default)
        );
    }
}


/**
 * Print the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function kbw_inner_post_seeting_metabox($post)
{
    // Add an nonce field so we can check for it later.
    wp_nonce_field('kbw_inner_post_seeting_metabox', 'kbw_inner_post_seeting_metabox_nonce');
    
    /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
    global $wp_registered_sidebars;
    
    $sidebar_custom = get_post_meta($post->ID, '_kbw_sidebar_custom', true);
    $sidebar_custom = esc_attr($sidebar_custom);
    $sidebar_location = get_post_meta($post->ID, '_kbw_sidebar_location', true);
    $sidebar_location = esc_attr($sidebar_location);
    
    echo '<div class="label"><label>' . __('Custom Sidebar: ', 'kbw') . '</label></div>';
    // Select custom seeting from dropdown
    echo '<div class="input select"><select name="kbw_sidebar_custom" id="kbw_sidebar_custom">';
    
    echo '<option value="" ' . selected('', $sidebar_custom, false) . '>-- ' . __('Default', 'kbw') . ' --</option>';
    // Exclude built-in sidebars
    $sidebars = kbw_get_sidebars();
    foreach ($sidebars as $sidebar_id => $sidebar_name) {
        echo '<option value="' . $sidebar_id . '"' . selected($sidebar_id, $sidebar_custom, false) . '>' . $sidebar_name . '</option>';
    }
    echo '<option value="kbw_nosidebar" ' . selected('kbw_nosidebar', $sidebar_custom, false) . '>' . __('No Sidebar', 'kbw') . '</option>';
    
    echo '</select></div>';
    
    //Seeting with isset sidebar
    echo '<div class="kbw_sidebar_location_fields">';
    echo '<div class="label"><label>' . __('Layout: ', 'kbw') . '</label></div><div class="input"><label for="kbw_sidebar_location_default"><input type="radio" name="kbw_sidebar_location" id="kbw_sidebar_location_default" value="" ' . checked('', $sidebar_location, false) . '>' . __('Default', 'kbw') . '</label><label for="kbw_sidebar_location_left"><input type="radio" name="kbw_sidebar_location" id="kbw_sidebar_location_left" value="left" ' . checked('left', $sidebar_location, false) . '>' . __('Left', 'kbw') . '</label><label for="kbw_sidebar_location_right"><input type="radio" name="kbw_sidebar_location" id="kbw_sidebar_location_right" value="right" ' . checked('right', $sidebar_location, false) . '>' . __('Right', 'kbw') . '</label></div>';
    echo '</div>';
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            function kbw_toggle_sidebar_custom_fields() {
                $('.kbw_sidebar_location_fields').toggle(($('#kbw_sidebar_custom').val() !== 'kbw_nosidebar'));
            }

            kbw_toggle_sidebar_custom_fields();
            $('#kbw_sidebar_custom').change(function () {
                kbw_toggle_sidebar_custom_fields();
            });
        });
    </script>
    
    <?php
}


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 * @return int
 */
add_action('save_post', 'kbw_save_post_seeting');
function kbw_save_post_seeting($post_id)
{
    /*
    * We need to verify this came from our screen and with proper authorization,
    * because save_post can be triggered at other times.
    */
    
    // Check if our nonce is set.
    if (!isset($_POST['kbw_inner_post_seeting_metabox_nonce']))
        return $post_id;
    $nonce = $_POST['kbw_inner_post_seeting_metabox_nonce'];
    
    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'kbw_inner_post_seeting_metabox'))
        return $post_id;
    
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    
    // Check the user's permissions.
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return $post_id;
    }
    
    /* OK, its safe for us to save the data now. */
    
    // Sanitize user input.
    $sidebar_custom = sanitize_text_field($_POST['kbw_sidebar_custom']);
    $sidebar_location = sanitize_text_field($_POST['kbw_sidebar_location']);
    
    //Update the meta field in the database.
    update_post_meta($post_id, '_kbw_sidebar_custom', $sidebar_custom);
    update_post_meta($post_id, '_kbw_sidebar_location', $sidebar_location);
    return true;
}


/**
 * Add Featured meta to Publish box
 */
add_action('post_submitbox_misc_actions', 'kbw_featured_post_field');
function kbw_featured_post_field()
{
    global $post;
    
    /* check if this is a post, if not then we won't add the custom field */
    /* change this post type to any type you want to add the custom field to */
    if (get_post_type($post) != 'post') return false;
    
    /* get the value corrent value of the custom field */
    $value = get_post_meta($post->ID, 'kbw_featured', true);
    ?>
    <div class="misc-pub-section" id="kbw_featured_field">
        <?php //if there is a value (1), check the checkbox
        ?>
        <label>
            <div class="dashicons dashicons-star-empty" style="padding: 0 2px 0 0; color: #888;"></div> <?php _e('Featured Post', 'kbw'); ?>
            <input type="checkbox"<?php echo(!empty($value) ? ' checked="checked"' : null) ?> value="1" name="kbw_featured" id="kbw_featured" style="display: none;"/></label>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $('#kbw_featured').change(function () {
                var $this = $(this),
                    $icon = $this.parent().find('.dashicons');

                if ($this.is(':checked')) {
                    $icon.attr('class', 'dashicons dashicons-star-filled');
                } else {
                    $icon.attr('class', 'dashicons dashicons-star-empty');
                }
            });
            $('#kbw_featured_field').find('.dashicons').attr('class', function () {
                return $('#kbw_featured').is(':checked') ? 'dashicons dashicons-star-filled' : 'dashicons dashicons-star-empty';
            });
        });
    </script>
    <?php
    return true;
}


/**
 * Save featured meta
 */
add_action('save_post', 'kbw_save_featured_meta');
function kbw_save_featured_meta($postid)
{
    /* check if this is an autosave */
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return false;
    
    /* check if the user can edit this page */
    if (!current_user_can('edit_page', $postid)) return false;
    
    // check if quick edit
    if (isset($_POST['_inline_edit']) && wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
        return false;
    
    /* check if there's a post id and check if this is a post */
    /* make sure this is the same post type as above */
    if (empty($postid) || (!empty($_POST['post_type']) && $_POST['post_type'] != 'post') || (!empty($_GET['post_type']) && $_GET['post_type'] != 'post')) return false;
    
    /* if you are going to use text fields, then you should change the part below */
    /* use add_post_meta, update_post_meta and delete_post_meta, to control the stored value */
    
    /* check if the custom field is submitted (checkboxes that aren't marked, aren't submitted) */
    if (isset($_POST['kbw_featured'])) {
        /* store the value in the database */
        add_post_meta($postid, 'kbw_featured', 1, true);
    } else {
        /* not marked? delete the value in the database */
        delete_post_meta($postid, 'kbw_featured');
    }
    return true;
}
