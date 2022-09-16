<?php
/**
 * Created by KabiWeb.
 * User: bvkhanh88@gmail.com
 * Date: 28/05/2019
 * Time: 00:30
 *
 * Updated: 06/2019
 *
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/*
 * post metabox registration
 */
if (!function_exists('kbw_register_pp_meta_boxes')) {
    function kbw_register_pp_meta_boxes()
    {
        $meta_boxes = array();
        
        $prefix = 'kbw_pp_';
        
        $pp_field = array(
            array(
                'name' => __('Other Info', 'kbw'),
                'id' => "{$prefix}other_info",
                'desc' => __('', 'kbw'),
                'type' => 'textarea',
            ),
            array(
                'name' => __('Banner Above', 'kbw'),
                'id' => "{$prefix}banner_above",
                'desc' => esc_html__('Please provide the Banner Above.', 'kbw'),
                'type' => 'wysiwyg',
                'raw' => true,
                'std' => __('', 'kbw'),
                'options' => array(
                    'textarea_rows' => 2,
                    'teeny' => false,
                    'media_buttons' => true,
                )
            ),
            array(
                'name' => __('Banner Below', 'kbw'),
                'id' => "{$prefix}banner_below",
                'desc' => esc_html__('Please provide the Banner Below.', 'kbw'),
                'type' => 'wysiwyg',
                'raw' => true,
                'std' => __('', 'kbw'),
                'options' => array(
                    'textarea_rows' => 2,
                    'teeny' => false,
                    'media_buttons' => true,
                )
            ),
            array(
                'name' => __('Post Below Title', 'kbw'),
                'id' => "{$prefix}post_below_title",
                'desc' => __('', 'kbw'),
                'type' => 'post',
                'post_type' => '',
                'field_type' => 'select_advanced',
                'multiple' => true,
            )
        );
        $pp_field = apply_filters('kbw_pp_fields', $pp_field);
        
        //Post Info
        $meta_boxes[] = array(
            'id' => 'kbw_pp_info',
            'title' => __('Post / Page Information', 'kbw'),
            'post_types' => array('page', 'post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => $pp_field
        );
        
        $meta_boxes = apply_filters('kbw_register_pp_meta_boxes', $meta_boxes);
        return $meta_boxes;
    }
}


/*
 * maincpt metabox registration
 */
if (!function_exists('kbw_register_maincpt_meta_boxes')) {
    function kbw_register_maincpt_meta_boxes()
    {
        $enable_content_type = (kbw_get_option('enable-maincpt')) ? esc_attr(kbw_get_option('enable-maincpt')) : true;
        $slug_admin = 'maincpt';
        $singular_name = (kbw_get_option('maincpt-singular-name')) ? esc_attr(kbw_get_option('maincpt-singular-name')) : __('Maincpt', 'kbw');
        $meta_boxes = array();
        $prefix = $slug_admin . '_';
        
        $maincpt_fields = array(
            array(
                'name' => __('Price', 'kbw'),
                'id' => "{$prefix}price",
                'desc' => __('', 'kbw'),
                'type' => 'text',
                'std' => 'Call me',
            ),
            array(
                'name' => __('Sale Price', 'kbw'),
                'id' => "{$prefix}sale_price",
                'desc' => __('', 'kbw'),
                'type' => 'text',
                'std' => 'Call me',
            ),
            array(
                'name' => __('Gallery', 'kbw'),
                'id' => "{$prefix}gallery",
                'type' => 'image_advanced',
                'max_file_uploads' => 50,
            ),
            array(
                'name' => __('Video URL', 'kbw'),
                'id' => "{$prefix}video_url",
                'desc' => __('', 'kbw'),
                'type' => 'text',
                'std' => '',
            ),
            array(
                'name' => __('Short Description', 'kbw'),
                'id' => "{$prefix}short_des",
                'type' => 'wysiwyg',
                'raw' => true,
                'std' => __('', 'kbw'),
                'options' => array(
                    'textarea_rows' => 5,
                    'teeny' => false,
                    //'media_buttons' => false,
                )
            ),
            array(
                'name' => __('Promotion', 'kbw'),
                'id' => "{$prefix}promotion",
                'type' => 'wysiwyg',
                'raw' => true,
                'std' => __('', 'kbw'),
                'options' => array(
                    'textarea_rows' => 5,
                    'teeny' => false,
                    //'media_buttons' => false,
                )
            ),
            array(
                'name' => __('Extra box', 'kbw'),
                'id' => "{$prefix}extra_info",
                'type' => 'wysiwyg',
                'raw' => true,
                'std' => __('', 'kbw'),
                'options' => array(
                    'textarea_rows' => 5,
                    'teeny' => false,
                    //'media_buttons' => false,
                )
            )
        );
        $maincpt_fields = apply_filters('kbw_maincpt_fields', $maincpt_fields);
        
        //Maincpt Info
        $meta_boxes[] = array(
            'id' => 'maincpt_info',
            'title' => sprintf(__('%s Extra Info', 'kbw'), $singular_name),
            'post_types' => array($slug_admin),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => $maincpt_fields
        );
        
        $meta_boxes = apply_filters('kbw_register_maincpt_meta_boxes', $meta_boxes);
        return ($enable_content_type) ? $meta_boxes : array();
    }
}


/*
 * testimonial metabox registration
 */
if (!function_exists('kbw_register_testimonial_meta_boxes')) {
    function kbw_register_testimonial_meta_boxes()
    {
        $enable_content_type = (kbw_get_option('enable-testimonial')) ? esc_attr(kbw_get_option('enable-testimonial')) : true;
        $slug_admin = 'Testimonial';
        $singular_name = __('Testimonial', 'kbw');
        $meta_boxes = array();
        $prefix = 'testimonial_';
        
        $testimonial_fields = array(
            array(
                'name' => __('Phone', 'kbw'),
                'id' => "{$prefix}phone",
                'desc' => __('', 'kbw'),
                'type' => 'text',
                'std' => '',
            ),
            array(
                'name' => __('Email', 'kbw'),
                'id' => "{$prefix}email",
                'desc' => __('', 'kbw'),
                'type' => 'text',
                'std' => '',
            ),
            array(
                'name' => __('Job', 'kbw'),
                'id' => "{$prefix}job",
                'desc' => __('', 'kbw'),
                'type' => 'text',
                'std' => 'officer',
            ),
            array(
                'name' => __('Link', 'kbw'),
                'id' => "{$prefix}link",
                'desc' => __('', 'kbw'),
                'type' => 'text',
                'std' => 'https://kabivi.com',
            ),
            array(
                'name' => esc_html__('Social', 'hkt'),
                'id' => "{$prefix}social",
                'desc' => __('', 'hkt'),
                'type' => 'text',
                'std' => array('https://facebook.com', 'https://youtube.com', 'https://twitter.com'),
                'clone' => true,
                'sort_clone' => true
            )
        );
        $testimonial_fields = apply_filters('kbw_testimonial_fields', $testimonial_fields);
        
        $meta_boxes[] = array(
            'id' => 'testimonial_info',
            'title' => sprintf(__('%s Extra Info', 'kbw'), $singular_name),
            'post_types' => array($slug_admin),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => $testimonial_fields
        );
        
        $meta_boxes = apply_filters('kbw_register_testimonial_meta_boxes', $meta_boxes);
        return ($enable_content_type) ? $meta_boxes : array();
    }
}


/*
 * taxonomy metabox registration
 */
if (!function_exists('kbw_register_taxonomy_meta_boxes')) {
    function kbw_register_taxonomy_meta_boxes()
    {
        $meta_boxes = array();
        $taxonomy_name = array('category');
        if (kbw_get_option('enable-maincpt')) $taxonomy_name[] = 'maincpt_cat';
        $taxonomy_name = apply_filters('kbw_taxonomy_metaboxes', $taxonomy_name);
        
        $prefix = 'term_';
        //Cat Meta Box.
        $meta_boxes[] = array(
            'id' => 'kbw_taxonomy',
            'title' => esc_html__('Term Custom Info', 'kbw'),
            'taxonomies' => $taxonomy_name,
            'fields' => array(
                array(
                    'name' => esc_html__('Subtitle', 'kbw'),
                    'id' => 'subtitle',
                    'type' => 'text',
                    'value' => ''
                ),
                array(
                    'name' => esc_html__('Image', 'kbw'),
                    'id' => 'thumbnail_id',
                    'type' => 'image_advanced',
                    'mime_type' => 'image/png',
                    'max_file_uploads' => 1,
                )
            ),
        );
        
        $meta_boxes = apply_filters('kbw_register_taxonomy_meta_boxes', $meta_boxes);
        return $meta_boxes;
    }
}


/*
 * woo product metabox registration
 */
if (kbw_isWooCommerce()) {
    if (!function_exists('kbw_register_product_meta_boxes')) {
        function kbw_register_product_meta_boxes()
        {
            $meta_boxes = array();
            
            $prefix = 'product_';
            //Product Info
            $meta_boxes[] = array(
                'id' => 'product_info',
                'title' => __('Product Extra Info', 'kbw'),
                'post_types' => array('product'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => __('Is Combo', 'trav'),
                        'id' => "{$prefix}combo",
                        'desc' => __('Add this product to combo.', 'kbw'),
                        'type' => 'checkbox',
                        'std' => array(),
                    ),
                    array(
                        'name' => __('Video URL', 'kbw'),
                        'id' => "{$prefix}video_url",
                        'desc' => __('', 'kbw'),
                        'type' => 'text',
                        'std' => '',
                    ),
                    array(
                        'name' => __('Origin', 'kbw'),
                        'id' => "{$prefix}origin",
                        'desc' => __('', 'kbw'),
                        'type' => 'text',
                        'std' => '',
                    ),
                    array(
                        'name' => __('Weight/Unit', 'kbw'),
                        'id' => "{$prefix}weight",
                        'desc' => __('', 'kbw'),
                        'type' => 'text',
                        'std' => '',
                    ),
                    array(
                        'name' => __('Box Extra', 'kbw'),
                        'id' => "{$prefix}extra_info",
                        'type' => 'wysiwyg',
                        'raw' => true,
                        'std' => __('', 'kbw'),
                        'options' => array(
                            'textarea_rows' => 5,
                            'teeny' => false,
                            'media_buttons' => true,
                        ),
                    ),
                    array(
                        'name' => __('WC Related Posts', 'kbw'),
                        'id' => "{$prefix}wc_related_post",
                        'desc' => __('', 'kbw'),
                        'type' => 'post',
                        'post_type' => '',
                        'field_type' => 'select_advanced',
                        'multiple' => true,
                    ),
                )
            );
            
            $meta_boxes = apply_filters('kbw_register_product_meta_boxes', $meta_boxes);
            return $meta_boxes;
        }
    }
}


/*
 * rwmb metabox registration
 */
if (!function_exists('kbw_register_meta_boxes')) {
    add_filter('rwmb_meta_boxes', 'kbw_register_meta_boxes');
    function kbw_register_meta_boxes($meta_boxes)
    {
        //post custom post_type
        $post_meta_boxes = kbw_register_pp_meta_boxes();
        $meta_boxes = array_merge($meta_boxes, $post_meta_boxes);
        
        //maincpt custom post_type
        $maincpt_meta_boxes = kbw_register_maincpt_meta_boxes();
        $meta_boxes = array_merge($meta_boxes, $maincpt_meta_boxes);
        
        //testimonial custom post_type
        $testimonial_meta_boxes = kbw_register_testimonial_meta_boxes();
        $meta_boxes = array_merge($meta_boxes, $testimonial_meta_boxes);
        
        //taxonomy
        $taxonomy_meta_boxes = kbw_register_taxonomy_meta_boxes();
        $meta_boxes = array_merge($meta_boxes, $taxonomy_meta_boxes);
        
        //woo product custom post_type
        if (kbw_isWooCommerce()) {
            $product_meta_boxes = kbw_register_product_meta_boxes();
            $meta_boxes = array_merge($meta_boxes, $product_meta_boxes);
        }
        
        $meta_boxes = apply_filters('kbw_register_meta_boxes', $meta_boxes);
        return $meta_boxes;
    }
}
