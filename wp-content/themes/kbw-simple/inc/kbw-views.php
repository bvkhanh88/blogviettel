<?php
// function to display number of posts.
function kbw_views($text = '', $postID = '')
{
    global $post;

    if (!kbw_get_option('post_views')) {
        //return false;
    }

    if (empty($postID)) {
        $postID = $post->ID;
    }

    $count_key = 'kbw_views';
    $count = get_post_meta($postID, $count_key, true);
    $count = @number_format($count);
    if (empty($count)) {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 0);
        $count = 0;
    }
    return '<span class="post-views"><i class="fa fa-eye"></i>' . $count . ' ' . $text . '</span> ';
}

// function to count views.
function kbw_setPostViews()
{
    global $post, $page;

    if (!kbw_get_option('post_views') || $page > 1) {
        //return false;
    }

    $count = 0;
    $postID = $post->ID;
    $count_key = 'kbw_views';
    $count = (int)get_post_meta($postID, $count_key, true);

    if (!defined('WP_CACHE') || !WP_CACHE) {
        $count++;
        update_post_meta($postID, $count_key, (int)$count);
    }
}

### Function: Calculate Post Views With WP_CACHE Enabled
add_action('wp_enqueue_scripts', 'kbw_postview_cache_count_enqueue');
function kbw_postview_cache_count_enqueue()
{
    global $post;
    if (is_single() && (defined('WP_CACHE') && WP_CACHE) && kbw_get_option('post_views')) {
        // Enqueue and localize script here
        wp_register_script('kbw-postviews-cache', KBW_THEME_DIRECTORY_URI . '/assets/js/postviews-cache.js', array('jquery'));
        wp_localize_script('kbw-postviews-cache', 'kbwViewsCacheL10n', array('admin_ajax_url' => admin_url('admin-ajax.php', (is_ssl() ? 'https' : 'http')), 'post_id' => intval($post->ID)));
        wp_enqueue_script('kbw-postviews-cache');
    }
}

### Function: Increment Post Views
add_action('wp_ajax_postviews', 'kbw_increment_views');
add_action('wp_ajax_nopriv_postviews', 'kbw_increment_views');
function kbw_increment_views()
{
    global $wpdb;
    if (!empty($_GET['postviews_id']) && kbw_get_option('post_views')) {
        $post_id = intval($_GET['postviews_id']);
        if ($post_id > 0 && defined('WP_CACHE') && WP_CACHE) {
            $count = 0;
            $count_key = 'kbw_views';
            $count = (int)get_post_meta($post_id, $count_key, true);
            $count++;

            update_post_meta($post_id, $count_key, (int)$count);
            echo $count;
        }
    }
    exit();
}

// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'kbw_posts_column_views');
add_action('manage_posts_custom_column', 'kbw_posts_custom_column_views', 5, 2);
function kbw_posts_column_views($defaults)
{
    $defaults['kbw_post_views'] = __('Views', 'kbw');
    return $defaults;
}

function kbw_posts_custom_column_views($column_name, $id)
{
    if ($column_name === 'kbw_post_views') {
        echo kbw_views('', get_the_ID());
    }
}
