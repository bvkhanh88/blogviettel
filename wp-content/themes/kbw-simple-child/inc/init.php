<?php
/**
 * kabiweb kbw-simple
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 * @date 18/07/2019
 */

define('PAGE_BLOG', 23);
define('IMG_CATALOG_DEFAULT', 50);

//** Config smtp gmail **********//
add_action('phpmailer_init', 'kbw_config_smtp_mail');
function kbw_config_smtp_mail($phpmailer)
{
    if (!is_object($phpmailer))
        $phpmailer = (object)$phpmailer;
    
    $phpmailer->Mailer = 'smtp';
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 587;
    $phpmailer->Username = 'server.webmailvn@gmail.com';
    $phpmailer->Password = 'wippiqaradfqkyzf';
    $phpmailer->SMTPSecure = 'TLS';
    $phpmailer->From = 'admin@kabiweb.com';
    $phpmailer->FromName = get_bloginfo('name');
}

//** Custom hook **********//
add_action('kbw_after_post_loop_item_excerpt', 'kbw_view_more_btn', 3);
function kbw_view_more_btn($post_type)
{
    global $post;
    echo '<a href="' . get_the_permalink($post->ID) . '" class="view-more">' . __('Xem thêm', 'kbw') . '</a>';
}

// Custom menu posision
//add_filter('kbw_register_menu', 'kbw_register_menu_func');
function kbw_register_menu_func($locations)
{
    $locations['second_primary_menu'] = __('Second Primary Menu', 'kbw');
    return $locations;
}

// Post / Page Metaboxes
add_filter('kbw_pp_fields', 'kbw_pp_field_func');
function kbw_pp_field_func($pp_field)
{
    $pp_field = array(
        array(
            'name' => __('Other Info', 'kbw'),
            'id' => "pp_other_info",
            'desc' => __('', 'kbw'),
            'type' => 'textarea',
        )
    );
    return $pp_field;
}

//-- kbwcontactus function
function kbw_contactus($all_args = false)
{

}


//** kbw_layout_custom_post **********//
add_action('kbw_layout_custom_post', 'kbw_layout_custom_post_func');
function kbw_layout_custom_post_func($all_args)
{
    $myquery = new WP_Query($all_args['args']);
    if ($all_args['kbw_custom_layout'] == 'yes') { ?>
        <?php if ($all_args['layout'] == 'grid') { ?>
        
        <?php } ?>
    <?php }
}


// Theme filter
add_filter('kbw_testi_type_enable', function() {
    return true;
});
add_filter('kbw_breadcrumbs_delimiter', function() {
    return ' / ';
});
add_filter('kbw_blog_base', function() {
    return true;
});
add_filter('kbw_blog_base_link', function() {
    return get_page_link(PAGE_BLOG);
});

/* Project Post Type */
if (!function_exists('kbw_project_content_type')) {
    add_action('init', 'kbw_project_content_type');
    function kbw_project_content_type()
    {
        $name = __('Projects');
        $singular_name = __('Projects');
        $content_type = 'project';
        $slug = 'project';
        
        $labels = array(
            'name' => $name,
            'singular_name' => $singular_name,
            'all_items' => __("All", 'kbw'),
            'add_new_item' => __("Add new", 'kbw'),
            'add_new' => __('Add new', 'kbw'),
        );
        
        $args = array(
            'labels' => $labels,
            'description' => sprintf(__('Post type %s', 'kbw'), $content_type),
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                //'author',
                'thumbnail',
                //'comments',
            ),
            'taxonomies' => array(''),
            'public' => true,
            'show_ui' => true,
            'menu_icon' => 'dashicons-building',
            'hierarchical' => false,
            'menu_position' => 8,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'query_var' => true,
            'has_archive' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => $slug, 'with_front' => false)
        );
        register_post_type($content_type, $args);
        flush_rewrite_rules();
    }
}

add_shortcode('kbw_listing_category', 'kbw_listing_category_shortcode');
function kbw_listing_category_shortcode($atts, $content = null)
{
    $output = $title = $class = $layout = $offset = $number = $per_page = $orderby = $order = $style = $hide_empty = $parent = $child_of = $ids = $exclude = '';
    extract(shortcode_atts(array(
        'title' => '',
        'layout' => 'menu',
        'is_slider' => 'no',
        'autoplay' => false,
        'navigation' => true,
        'pagination' => false,
        'margin' => 15,
        'margin_mb' => 5,
        'thumbnail' => 'kbw-thumbnail',
        'style' => 'zoom-image',
        'column' => 4,
        'column_mb' => 2,
        'number' => 6,
        'per_page' => 12,
        'column_width' => '',
        'orderby' => 'term_id', //argument: 'name', 'slug', 'term_group', 'term_id', 'id', 'description' and you are using title which is not in the accepted terms fields
        'order' => 'DESC',
        'hide_empty' => '0',
        'parent' => '',
        'child_of' => '',
        'ids' => '',
        'exclude' => '',
        'offset' => 0,
        'hide_count' => false,
        'show_child_term' => 1,
        'class' => '',
    ), $atts));
    
    $current_termid = 0;
    if (is_category()) {
        $category_id = get_query_var('cat');
        $category_obj = get_category($category_id);
        $current_termid = $category_obj->term_id;
    }
    
    $cat_include = ($ids != '' && strpos($ids, ',') !== false) ? explode(',', $ids) : array($ids);
    $cat_exclude = ($exclude != '' && strpos($exclude, ',') !== false) ? explode(',', $exclude) : array($exclude);
    
    $args = array(
        'taxonomy' => 'category',
        'number' => $number,
        'hide_empty' => $hide_empty,
        'orderby' => $orderby,
        'order' => $order
    );
    
    if ($ids == '') {
        $args['parent'] = $parent;
        $args['child_of'] = $child_of;
        $args['offset'] = $offset;
        $args['exclude'] = $cat_exclude;
    } else {
        $args['include'] = $cat_include;
    }
    
    $cat_terms = get_terms($args);
    
    if (empty($cat_terms) || is_wp_error($cat_terms))
        return false;
    
    if ($orderby == 'rand') {
        shuffle($cat_terms);
    }
    
    ob_start(); ?>
    
    <?php
    if ($layout == 'menu') { ?>
        <div class="kbw-menu-category">
            <?php if ($title != '' && $title != 'hide') echo '<div class="heading-title">' . $title . '</div>'; ?>
            <ul class="menu-term">
                <li class="item-term-menu <?php echo $current_termid == 0 ? 'active' : ''; ?>"><a href="<?php echo get_page_link(PAGE_BLOG) ?>"><span><?php echo __('All', 'kbw') ?></span></a></li>
                
                <?php foreach ($cat_terms as $term) { ?>
                    <?php if ($term->term_id == $current_termid) { ?>
                        <li class="item-term-menu active"><a href="<?php echo get_term_link($term->term_id) ?>"><span><?php echo $term->name ?></span></a></li>
                    <?php } else { ?>
                        <li class="item-term-menu"><a href="<?php echo get_term_link($term->term_id) ?>"><span><?php echo $term->name ?></span></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
