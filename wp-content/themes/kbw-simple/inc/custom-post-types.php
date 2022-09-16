<?php
/**
 * Created by KabiWeb.
 * User: bvkhanh88@gmail.com
 * Date: 20/10/2018
 * Time: 16:18
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Get content type labels
function kbw_get_cpt_labels($singular_name, $name, $title = false)
{
    if (!$title)
        $title = $name;
    
    $labels = array(
        "name" => $title,
        "singular_name" => $singular_name,
        //'menu_name' => $singular_name,
        //'all_items' => __("All", 'kbw'),
        "add_new" => __("Add New", 'kbw'),
        "add_new_item" => __("Add New", 'kbw'),
        "edit_item" => __("Edit", 'kbw'),
        'update_item' => __("Update", 'kbw'),
        "new_item" => __("New", 'kbw'),
        "view_item" => __("View", 'kbw'),
        "search_items" => sprintf(__("Search %s", 'kbw'), $name),
        "not_found" => sprintf(__("No %s found", 'kbw'), $name),
        "not_found_in_trash" => sprintf(__("No %s found in Trash", 'kbw'), $name),
        "parent_item_colon" => "",
    );
    
    return $labels;
}


// Get content type taxonomy labels
function kbw_get_taxonomy_labels($singular_name, $name)
{
    $labels = array(
        "name" => $name,
        "singular_name" => $singular_name,
        'menu_name' => $name,
        "search_items" => __("Search", 'kbw'),
        "all_items" => __("All", 'kbw'),
        "parent_item" => __("Parent", 'kbw'),
        "parent_item_colon" => __("Parent:", 'kbw'),
        "add_new_item" => __("Add New", 'kbw'),
        "new_item_name" => __("New", 'kbw'),
        "edit_item" => __("Edit", 'kbw'),
        "update_item" => __("Update", 'kbw'),
        "separate_items_with_commas" => sprintf(__("Separate %s with commas", 'kbw'), $name),
        "add_or_remove_items" => sprintf(__("Add or remove %s", 'kbw'), $singular_name),
        "choose_from_most_used" => sprintf(__("Choose from the most used %s", 'kbw'), $singular_name),
        "not_found" => sprintf(__("%s not found.", 'kbw'), $singular_name),
    );
    
    return $labels;
}


/*
 * Register Maincpt
 */
add_action('init', 'kbw_add_maincpt_content_type');
function kbw_add_maincpt_content_type()
{
    global $kbw_options;
    
    $enable_content_type = kbw_get_option('enable-maincpt');
    if (!$enable_content_type)
        return;
    
    $slug = (isset($kbw_options) && isset($kbw_options['maincpt-slug']) && $kbw_options['maincpt-slug']) ? esc_attr($kbw_options['maincpt-slug']) : 'maincpt';
    $content_type = 'maincpt';
    $name = (isset($kbw_options) && isset($kbw_options['maincpt-name']) && $kbw_options['maincpt-name']) ? $kbw_options['maincpt-name'] : __('Maincpt', 'kbw');
    $singular_name = (isset($kbw_options) && isset($kbw_options['maincpt-singular-name']) && $kbw_options['maincpt-singular-name']) ? $kbw_options['maincpt-singular-name'] : __('Maincpt', 'kbw');
    
    $enable_content_type_cat = kbw_get_option('enable-maincpt-cat');
    $cat_name = (isset($kbw_options) && isset($kbw_options['maincpt-cat-name']) && $kbw_options['maincpt-cat-name']) ? $kbw_options['maincpt-cat-name'] : __('Maincpt Category', 'kbw');
    $cats_name = (isset($kbw_options) && isset($kbw_options['maincpt-cats-name']) && $kbw_options['maincpt-cats-name']) ? $kbw_options['maincpt-cats-name'] : __('Maincpt Categories', 'kbw');
    
    $enable_content_type_skill = kbw_get_option('enable-maincpt-skill');
    $skill_name = (isset($kbw_options) && isset($kbw_options['maincpt-skill-name']) && $kbw_options['maincpt-skill-name']) ? $kbw_options['maincpt-skill-name'] : __('Maincpt Skill', 'kbw');
    $skills_name = (isset($kbw_options) && isset($kbw_options['maincpt-skills-name']) && $kbw_options['maincpt-skills-name']) ? $kbw_options['maincpt-skills-name'] : __('Maincpt Skills', 'kbw');
    
    $cat_slug = (isset($kbw_options) && isset($kbw_options['maincpt-cat-slug']) && $kbw_options['maincpt-cat-slug']) ? esc_attr($kbw_options['maincpt-cat-slug']) : 'maincpt-cat';
    $skill_slug = (isset($kbw_options) && isset($kbw_options['maincpt-skill-slug']) && $kbw_options['maincpt-skill-slug']) ? esc_attr($kbw_options['maincpt-skill-slug']) : 'maincpt-skill';
    
    $cat_content_type = 'maincpt_cat';
    $skill_content_type = 'maincpt_skill';
    
    $archive_page_id = (isset($kbw_options) && isset($kbw_options['maincpt-archive-page']) && $kbw_options['maincpt-archive-page']) ? esc_attr($kbw_options['maincpt-archive-page']) : 0;
    $has_archive = true;
    if ($archive_page_id && get_post($archive_page_id))
        $has_archive = get_page_uri($archive_page_id);
    
    $args = array(
        'labels' => kbw_get_cpt_labels($singular_name, $name),
        'description' => sprintf(__('Post type %s', 'kbw'), $content_type),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            //'comments',
        ),
        'taxonomies' => array($cat_content_type, 'location', $skill_slug),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 8,
        //'menu_icon' => '',
        'can_export' => true,
        'has_archive' => $has_archive,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => $slug, 'with_front' => true),
    );
    
    // Filter the arguments to register post type.
    $args = apply_filters('kbw_maincpt_post_type_args', $args);
    register_post_type($content_type, $args);
    flush_rewrite_rules();
    
    if ($enable_content_type_cat) {
        $cat_args = array(
            'labels' => kbw_get_taxonomy_labels($cat_name, $cats_name),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            //'meta_box_cb' => false,
            'query_var' => true,
            'rewrite' => array('slug' => $cat_slug)
        );
    
        // Filter the arguments
        $cat_args = apply_filters('kbw_maincpt_cat_args', $cat_args);
        register_taxonomy($cat_content_type, $content_type, $cat_args);
        flush_rewrite_rules();
    }
    
    if ($enable_content_type_skill) {
        $skill_arg = array(
            'labels' => kbw_get_taxonomy_labels($skill_name, $skills_name),
            'hierarchical' => false, //True - as Category, False - as Tag
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $skill_slug)
        );
    
        // Filter the arguments
        $skill_arg = apply_filters('kbw_maincpt_skill_args', $skill_arg);
        register_taxonomy($skill_content_type, $content_type, $skill_arg);
        flush_rewrite_rules();
    }
}


/*
 * Register Testimonial
 */
$enable_testimonial = kbw_get_option('enable-testimonial');
$enable_testimonial = apply_filters('kbw_enable_testimonial', $enable_testimonial);
if ($enable_testimonial) add_action('init', 'kbw_register_testimonial_content_type');
if (!function_exists('kbw_register_testimonial_content_type')) {
    function kbw_register_testimonial_content_type()
    {
        $name = apply_filters('kbw_testimonial_name', __('Testimonials', 'kbw'));
        $singular_name = apply_filters('kbw_testimonial_singular', __('Testimonials', 'kbw'));
        $content_type = 'testimonial';
        $slug = apply_filters('kbw_testimonial_slug', __('testimonial', 'kbw'));
        
        $testi_type_enable = apply_filters('kbw_testi_type_enable', false);
        $cat_name = apply_filters('kbw_testimonial_cat_name', __('Testimonial Type', 'kbw'));
        $cats_name = apply_filters('kbw_testimonial_cats_name', __('Testimonial Types', 'kbw'));
        $cat_content_type = 'testimonial_type';
        $cat_slug = apply_filters('kbw_testi_cat_slug', __('testimonial-type', 'kbw'));
        
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
                //'excerpt',
                //'author',
                'thumbnail',
                //'comments',
            ),
            'taxonomies' => array($cat_content_type),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-format-quote', //icon display
            'can_export' => true,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 9,
            'rewrite' => array('slug' => $slug, 'with_front' => false)
        );
        
        // Filter the arguments to register post type.
        $args = apply_filters('kbw_testimonial_post_type_args', $args);
        register_post_type($content_type, $args);
        flush_rewrite_rules();
        
        //--- Reg Testimonial Type
        if ($testi_type_enable) {
            $cate_args = array(
                'labels' => kbw_get_taxonomy_labels($cat_name, $cats_name),
                'hierarchical' => true,
                'public' => false,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'meta_box_cb' => null,
                'query_var' => true,
                'rewrite' => array('slug' => $cat_slug)
            );
            
            // Filter the arguments
            $cate_args = apply_filters('kbw_testimonial_cate_args', $cate_args);
            register_taxonomy($cat_content_type, $content_type, $cate_args);
            flush_rewrite_rules();
        }
    }
}


/*
 * register location taxonomy
 */
$enable_location = apply_filters('kbw_enable_location', false);
if ($enable_location):
    if (!function_exists('kbw_register_location_taxonomy')) {
        add_action('init', 'kbw_register_location_taxonomy', 0);
        function kbw_register_location_taxonomy()
        {
            global $kbw_options;
            
            $enable_content_type = kbw_get_option('enable-maincpt');
            if (!$enable_content_type)
                return;
            
            $content_has_location = array('maincpt');
            
            $labels = array(
                'name' => _x('Locations', 'taxonomy general name', 'kbw'),
                'singular_name' => _x('Location', 'taxonomy singular name', 'kbw'),
                'menu_name' => __('Locations', 'kbw'),
                'all_items' => __('View all', 'kbw'),
                "parent_item" => __("Parent", 'kbw'),
                "parent_item_colon" => __("Parent:", 'kbw'),
                'new_item_name' => __('New Location', 'kbw'),
                'add_new_item' => __('Add Location', 'kbw'),
                'edit_item' => __('Edit Location', 'kbw'),
                'update_item' => __('Update Location', 'kbw'),
                'separate_items_with_commas' => __('Separate locations with commas', 'kbw'),
                'search_items' => __('Find Location', 'kbw'),
                'add_or_remove_items' => __('Add or remove Location', 'kbw'),
                'choose_from_most_used' => __('Choose from the most used locations', 'kbw'),
                'not_found' => __('Location not found.', 'kbw'),
            
            );
            
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'meta_box_cb' => false,
                'rewrite' => array('slug' => 'location', 'with_front' => true)
            );
            register_taxonomy('location', $content_has_location, $args);
            
            flush_rewrite_rules();
        }
    }
endif;
