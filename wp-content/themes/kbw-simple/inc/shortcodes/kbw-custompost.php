<?php
if (!function_exists('kbw_custompost_shortcode')) {
    add_shortcode('kbw_custompost', 'kbw_custompost_shortcode');
    function kbw_custompost_shortcode($atts, $content = false)
    {
        $currency_symbol = (kbw_get_option('kbw-currency-symbol')) ? kbw_get_option('kbw-currency-symbol') : 'VNĐ';
        $class = $layout = $post_type = $column = $column_mb = $taxonomy = $category = $offset = $number_posts = $thumbnail = $post_meta = $excerpt = $excerpt_length = $title_length = $view_all = $style = $order = $orderby = $title = $link_cat = $featured = $is_slider = $autoplay = $navigation = $pagination = $margin = $margin_mb = $kbw_custom_layout = '';
        
        $attributes = shortcode_atts(array(
            'post_type' => 'maincpt',
            'title' => '',
            'class' => '',
            'layout' => 'grid',
            'is_slider' => 'no',
            'autoplay' => false,
            'navigation' => true,
            'pagination' => false,
            'margin' => 15,
            'margin_mb' => 5,
            'featured' => 'no',
            'link_cat' => '',
            'column' => 3,
            'column_mb' => 2,
            'taxonomy' => 'default',
            'category' => '',
            'offset' => 0,
            'ids' => '',
            'exclude' => '',
            'number_posts' => 8,
            'thumbnail' => 'kbw-thumbnail',
            'post_meta' => 'no',
            'excerpt' => 'no',
            'excerpt_length' => '15',
            'title_length' => '7',
            'view_all' => 'no',
            'style' => 'default',
            'order' => 'DESC',
            'orderby' => 'post_date',
            'no_found_rows' => true,
            'ignore_sticky_posts' => true,
            'kbw_custom_layout' => 'no'
        ), $atts);
        extract($attributes);
        wp_reset_query();
        
        if (!post_type_exists($post_type)) {
            return false;
        }
        
        $class = empty($class) ? '' : (' ' . $class);
        $style = empty($style) ? '' : (' ' . $style);
        
        if ($taxonomy == 'default') $taxonomy = $post_type . '_cat';
        
        if ($taxonomy != '' && $category != '') {
            if (strpos($category, ',')) {
                $cate_arr = explode(',', $category);
                $term = get_term_by('slug', $cate_arr[0], $taxonomy);
            } else {
                $term = get_term_by('slug', $category, $taxonomy);
            }
        }
        
        if (empty($title) || $title == '') {
            $title = (!empty($term) && !is_wp_error($term) ? $term->name : 'hide');
        }
        
        if (empty($link_cat) || $link_cat == '') {
            $link_cat = (!empty($term) && !is_wp_error($term) ? get_term_link($term->term_id) : esc_url(home_url()) . '/' . $post_type);
        }
        
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $number_posts,
            'order' => $order,
            'orderby' => $orderby,
            'ignore_sticky_posts' => 1
        );
        
        if (empty($ids)) {
            if (!empty($exclude)) {
                $exclude = explode(',', $exclude);
                $args['post__not_in'] = $exclude;
            } elseif ($offset > 0) {
                $args['offset'] = $offset;
            }
        }
        
        if (!empty($ids) && strlen($category) == 0) {
            $ids = explode(',', $ids);
            $args['post__in'] = $ids;
        }
        
        $meta_query = array();
        if ($featured == 'yes') {
            $meta_query[] = array(
                'key' => 'kbw_featured',
                'value' => 1,
            );
        }
        $meta_query = apply_filters('kbw_cpt_meta_query', $meta_query);
        if (count($meta_query) > 1) {
            $meta_query['relation'] = 'AND';
        }
        if (count($meta_query) > 0) {
            $args['meta_query'] = $meta_query;
        }
        
        $tax_query = array();
        if (strlen($taxonomy) > 0 && strlen($category) > 0) {
            //$args[$taxonomy] = $category;
            $tax_query[] = array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => explode(',', $category),
            );
        }
        $tax_query = apply_filters('kbw_cpt_tax_query', $tax_query);
        if (count($tax_query) > 1) {
            $tax_query['relation'] = 'AND';
        }
        if (count($tax_query) > 0) {
            $args['tax_query'] = $tax_query;
        }
        
        if ($pagination) {
            $offset = null;
            $paged = intval(get_query_var('paged'));
            $paged_2 = intval(get_query_var('page'));
            
            if (empty($paged) && !empty($paged_2)) {
                $paged = intval(get_query_var('page'));
            }
            
            $args['paged'] = $paged;
        } else $args['no_found_rows'] = true;
        
        $num_count = count(query_posts($args));
        $myquery = new WP_Query($args);
        
        
        $random_id = 'kbw-block-' . rand();
        
        // Global var
        $display_args = array(
            'post_type' => $post_type,
            'thumbnail' => $thumbnail,
            'style' => $style,
            'is_slider' => $is_slider,
            'column' => $column,
            'column_mb' => $column_mb,
            'post_meta' => $post_meta,
            'excerpt' => $excerpt,
            'excerpt_length' => $excerpt_length
        );
        $GLOBALS['display_args'] = $display_args;
    
        $options = $responsive = array();
        $options['autoHeight'] = true;
        $options['items'] = (int)$column;
        $options['autoplay'] = $autoplay ? true : false;
        $options['nav'] = $navigation == 'true' ? true : false;
        $options['dots'] = $pagination == 'true' ? true : false;
        $options['margin'] = intval($margin);
        $responsive[0]['margin'] = (int)$margin_mb;
        $responsive[0]['items'] = intval($column_mb);
        $responsive[481]['items'] = intval($column_mb);
        $responsive[768]['items'] = (int)$column > 1 ? 2 : 1;
        $responsive[992]['items'] = (int)$column > 1 ? 2 : 1;
        $responsive[1200]['items'] = intval($column);
        $options['responsive'] = $responsive;
        $options = json_encode($options);
        
        ob_start();
        
        if ($kbw_custom_layout == 'yes'):
            wp_reset_query();
            $attributes['args'] = $args;
            do_action("kbw_layout_custom_{$post_type}", $attributes);
            unset($attributes);
        else:
            // Layout List
            if ($layout == 'list') { ?>
                <?php do_action("kbw_before_{$post_type}_list", $display_args); ?>
                <div class="kbw-block-wrap kbw-posts list <?php echo $post_type . $class; ?>">
                    <?php if ($title != '' && $title != 'hide') echo '<div class="cat-box-title clearfix"><h2 class="heading-title">' . ($link_cat != 'none' ? '<a href="' . $link_cat . '">' : '') . '<span class="inline-title">' . $title . '</span>' . ($link_cat != 'none' ? '</a>' : '') . '</h2></div>'; ?>
                    <?php if ($is_slider == 'yes') echo '<div class="slider-wrapper" data-owl-config="' . esc_attr($options) . '">'; ?>
                    <div class="kbw-block-inner kbw-posts-inner <?php echo $is_slider == 'yes' ? 'kbwCarousel' : ''; ?>">
                        <?php
                        $i = $j = 0;
                        if ($myquery->have_posts()) : while ($myquery->have_posts()): $myquery->the_post();
                            $i++;
                            $overridden_template = locate_template("templates/loops/{$post_type}-item-list.php");
                            if ($overridden_template) {
                                get_template_part("templates/loops/{$post_type}-item", 'list');
                            } else {
                                get_template_part('templates/loops/main-item');
                            }
                        endwhile;endif;
                        wp_reset_query();
                        ?>
                    </div>
                    <?php if ($is_slider == 'yes') echo '</div>'; ?>
                    <?php if ($view_all == 'yes') echo '<a href="' . $link_cat . '" class="view-all">' . __('View all', 'kbw') . '</a>'; ?>
                </div>
                <?php do_action("kbw_after_{$post_type}_list", $display_args); ?>
            <?php } else { ?>
                <?php do_action("kbw_before_{$post_type}_{$layout}", $display_args); ?>
                <div class="kbw-block-wrap kbw-posts <?php echo $post_type . $class; ?>">
                    <?php if ($title != '' && $title != 'hide') echo '<div class="cat-box-title clearfix"><h2 class="heading-title">' . ($link_cat != 'none' ? '<a href="' . $link_cat . '">' : '') . '<span class="inline-title">' . $title . '</span>' . ($link_cat != 'none' ? '</a>' : '') . '</h2></div>'; ?>
                    
                    <?php if ($is_slider == 'yes') echo '<div class="slider-wrapper" data-owl-config="' . esc_attr($options) . '">'; ?>
                    <div class="kbw-block-inner kbw-posts-inner <?php echo ($is_slider == 'yes') ? 'kbwCarousel' : 'row row-flex-' . (in_array($margin, array(0, 10, 15, 20, 25, 30)) ? (int)$margin : 20) ?>">
                        <?php
                        $i = $j = 0;
                        if ($myquery->have_posts()) : while ($myquery->have_posts()): $myquery->the_post();
                            $i++;
                            $overridden_template = locate_template("templates/loops/{$post_type}-item-{$layout}.php");
                            if ($overridden_template) {
                                get_template_part("templates/loops/{$post_type}-item", $layout);
                            } else {
                                get_template_part('templates/loops/main-item');
                            }
                        endwhile;endif;
                        wp_reset_query();
                        ?>
                    </div>
                    <?php if ($is_slider == 'yes') echo '</div>'; ?>
                    <?php if ($view_all == 'yes') echo '<a href="' . $link_cat . '" class="view-all">' . __('View all', 'kbw') . '</a>'; ?>
                </div>
                <?php do_action("kbw_after_{$post_type}_{$layout}", $display_args); ?>
            <?php } ?>
        <?php endif; ?>
        
        
        <?php
        // reset global var
        unset($display_args);
        
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}


//Load into Composer
add_action('init', 'kbw_load_kbw_custompost_shortcode', 99);
function kbw_load_kbw_custompost_shortcode()
{
    // BEGIN JS COMPOSER
    if (function_exists('vc_map')) {
        vc_map(array(
            'name' => "" . __('KBW Custompost', 'kbw'),
            'base' => 'kbw_custompost',
            'category' => __('KABIWEB', 'kbw'),
            'icon' => '',
            'description' => __('KBW Custompost Description', 'kbw'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'kbw'),
                    'param_name' => 'title',
                    'value' => ''
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Post Type', 'kbw'),
                    'param_name' => 'post_type',
                    'value' => 'post',
                    'admin_label' => true
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Layout', 'kbw'),
                    'param_name' => 'layout',
                    'description' => 'Eg: slider, grid, list,...',
                    'value' => 'grid', // slider, grid, list,...
                    'admin_label' => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Is slider', 'kbw'),
                    'param_name' => 'is_slider',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'yes',
                        esc_html__('No', 'kbw') => 'no'
                    ),
                    'std' => 'no',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Autoplay', 'kbw'),
                    'param_name' => 'autoplay',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'true',
                        esc_html__('No', 'kbw') => 'false'
                    ),
                    'std' => 'false',
                    'dependency' => array('element' => 'view', 'value' => array('slider')),
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Navigation', 'kbw'),
                    'param_name' => 'navigation',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'true',
                        esc_html__('No', 'kbw') => 'false'
                    ),
                    'std' => 'true',
                    'dependency' => array('element' => 'view', 'value' => array('slider')),
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Pagination', 'kbw'),
                    'param_name' => 'pagination',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'true',
                        esc_html__('No', 'kbw') => 'false'
                    ),
                    'std' => 'false',
                    'dependency' => array('element' => 'layout', 'value' => array('grid', 'slider')),
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Columns', 'kbw'),
                    'param_name' => 'column',
                    'description' => '',
                    'value' => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6'
                    ),
                    'std' => '3',
                    'edit_field_class' => 'vc_col-md-3 vc_column',
                    'dependency' => array('element' => 'layout', 'value' => array('grid', 'slider'))
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Columns MB', 'kbw'),
                    'param_name' => 'column_mb',
                    'description' => '',
                    'value' => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3'
                    ),
                    'std' => '2',
                    'edit_field_class' => 'vc_col-md-3 vc_column',
                    'dependency' => array('element' => 'layout', 'value' => array('grid', 'slider'))
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Column gap', 'kbw'),
                    'param_name' => 'margin',
                    'description' => '',
                    'value' => '20',
                    'edit_field_class' => 'vc_col-md-3 vc_column',
                    'dependency' => array('element' => 'layout', 'value' => array('grid', 'slider'))
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Image Size', 'kbw'),
                    'param_name' => 'thumbnail',
                    'description' => '',
                    'value' => 'kbw-thumbnail'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Taxonomy', 'kbw'),
                    'param_name' => 'taxonomy',
                    'description' => '',
                    'value' => 'category',
                    'edit_field_class' => 'vc_col-md-4 vc_column'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Category', 'kbw'),
                    'param_name' => 'category',
                    'description' => '',
                    'value' => '',
                    'edit_field_class' => 'vc_col-md-4 vc_column'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Category Link', 'kbw'),
                    'param_name' => 'link_cat',
                    'description' => '',
                    'value' => '',
                    'edit_field_class' => 'vc_col-md-4 vc_column'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Number Posts', 'kbw'),
                    'param_name' => 'number_posts',
                    'description' => '',
                    'value' => '9',
                    'edit_field_class' => 'vc_col-md-9 vc_column'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Offset', 'kbw'),
                    'param_name' => 'offset',
                    'description' => '',
                    'value' => '0',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Orderby', 'kbw'),
                    'param_name' => 'orderby',
                    'description' => '',
                    'value' => 'date',
                    'edit_field_class' => 'vc_col-md-9 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Order', 'kbw'),
                    'param_name' => 'order',
                    'description' => '',
                    'value' => array(
                        esc_html__('ASC', 'kbw') => 'ASC',
                        esc_html__('DESC', 'kbw') => 'DESC'
                    ),
                    'std' => 'DESC',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Post meta', 'kbw'),
                    'param_name' => 'post_meta',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'yes',
                        esc_html__('No', 'kbw') => 'no'
                    ),
                    'std' => 'no',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Excerpt', 'kbw'),
                    'param_name' => 'excerpt',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'yes',
                        esc_html__('No', 'kbw') => 'no'
                    ),
                    'std' => 'yes',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Excerpt Length', 'kbw'),
                    'param_name' => 'excerpt_length',
                    'description' => '',
                    'value' => '15',
                    'dependency' => array('element' => 'excerpt', 'value' => array('yes')),
                    'edit_field_class' => 'vc_col-md-6 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('View more button', 'kbw'),
                    'param_name' => 'view_more',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'yes',
                        esc_html__('No', 'kbw') => 'no'
                    ),
                    'std' => 'no',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('View all button', 'kbw'),
                    'param_name' => 'view_all',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'yes',
                        esc_html__('No', 'kbw') => 'no'
                    ),
                    'std' => 'no',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Custom Layout', 'kbw'),
                    'param_name' => 'custom_layout',
                    'description' => '',
                    'value' => array(
                        esc_html__('Yes', 'kbw') => 'yes',
                        esc_html__('No', 'kbw') => 'no'
                    ),
                    'std' => 'no',
                    'edit_field_class' => 'vc_col-md-3 vc_column'
                ),
    
                array(
                    'type' => 'textfield',
                    'heading' => __('IDs', 'kbw'),
                    'param_name' => 'ids',
                    'description' => '',
                    'value' => '',
                    'dependency' => array('element' => 'show', 'value' => array('posts')),
                    'group' => __('Style', 'kbw')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Exclude IDs', 'kbw'),
                    'param_name' => 'exclude',
                    'description' => '',
                    'value' => '',
                    'group' => __('Style', 'kbw')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Style', 'hkt'),
                    'param_name' => 'style',
                    'description' => 'Eg: default, change-hover, change-zoom ...',
                    'value' => 'style-df', // default, change-hover, change-zoom ...
                    'group' => __('Style', 'kbw')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Class element', 'hkt'),
                    'param_name' => 'class',
                    'description' => '',
                    'value' => '',
                    'group' => __('Style', 'kbw')
                )
            )
        )); // End VC MAP
    } // End if VisualComposer
    
    
    // BEGIN KING COMPOSER
    if (function_exists('kc_add_map')) {
        $post_type = array('post' => 'post');
        $layout = array(
            'grid' => 'Grid',
            'list' => 'List'
        );
        if (kbw_get_option('enable-maincpt')) {
            $post_type ['maincpt'] = 'maincpt';
        }
        if (kbw_get_option('enable-project')) {
            $post_type ['project'] = 'project';
        }
        if (kbw_isWooCommerce() || kbw_get_option('enable-product')) {
            $post_type ['product'] = 'product';
            $layout['wc-product'] = 'WC product';
        }
        $enable_testimonial = apply_filters('kbw_enable_testimonial', false);
        $enable_testimonial = (kbw_get_option('enable-testimonial') || $enable_testimonial ? true : false);
        if ($enable_testimonial) {
            $post_type ['testimonial'] = 'testimonial';
            $layout['testimonial'] = 'Testimonial';
        }
        
        kc_add_map(
            array(
                'kbw_custompost' => array(
                    'name' => __('KBW Recent CustomPosts', 'kbw'),
                    'description' => __('Lists recent posts – useful on the homepage', 'kbw'),
                    'category' => __('KBW Framework', 'kbw'),
                    'icon' => 'sl-paper-plane',
                    'title' => __('KBW Recent CustomPost', 'kbw'),
                    
                    'params' => array(
                        array(
                            'name' => 'title',
                            'label' => __('Title', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'post_type',
                            'label' => __('Post Type', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'post', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'layout',
                            'label' => __('Layout', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'grid', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'is_slider',
                            'label' => esc_html__('Is slider', 'kbw'),
                            'type' => 'toggle',  // USAGE RADIO TYPE
                            'value' => 'no', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                //'show_when' => 'grid'
                                'hide_when' => array('list')
                                // hide_when has the opposite effect
                                // NOTICE: Only use one show_when or hide_when in the same time
                                // 'show_when' => 'yes,ok,right'
                                // 'show_when' => array( 'yes', 'ok', 'right' )
                            ),
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'true' => 'Yes',
                            ),
                            'description' => '',
                            'relation' => array(
                                'parent' => 'is_slider',
                                'show_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'navigation',
                            'label' => esc_html__('Navigation', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'true' => 'Yes',
                            ),
                            'value' => 'true', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'is_slider',
                                'show_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'pagination',
                            'label' => esc_html__('Pagination', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'true' => 'Yes',
                            ),
                            'description' => '',
                            'relation' => array(
                                'parent' => 'is_slider',
                                'show_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'column',
                            'label' => esc_html__('Column', 'kbw'),
                            'type' => 'select',  // USAGE SELECT TYPE
                            'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6'
                            ),
                            'value' => '3', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'hide_when' => array('list')
                            )
                        ),
                        array(
                            'name' => 'column_mb',
                            'label' => esc_html__('Column Mobile', 'kbw'),
                            'type' => 'select',
                            'options' => array(
                                '1' => '1',
                                '2' => '2'
                            ),
                            'value' => '1',
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'show_when' => 'grid'
                            ),
                        ),
                        array(
                            'name' => 'margin',
                            'label' => esc_html__('Column Gap', 'kbw'),
                            'type' => 'number',  // USAGE TEXT TYPE
                            'value' => '15', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'hide_when' => array('list')
                            )
                        ),
                        array(
                            'name' => 'margin_mb',
                            'label' => esc_html__('Column Gap Mobile', 'kbw'),
                            'type' => 'number',  // USAGE TEXT TYPE
                            'value' => '15', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'hide_when' => array('list')
                            )
                        ),
                        array(
                            'name' => 'taxonomy',
                            'label' => __('Taxonomy', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'default', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'category',
                            'label' => __('Category', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'link_cat',
                            'label' => __('Category Link', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'featured',
                            'label' => __('Featured', 'kbw'),
                            'type' => 'toggle',  // USAGE RADIO TYPE
                            'value' => 'no', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'ids',
                            'label' => esc_html__('Post IDS', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'featured',
                                //'show_when' => 'no',
                                'hide_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'offset',
                            'label' => __('Offset', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '0', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'featured',
                                //'show_when' => 'no',
                                'hide_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'number_posts',
                            'label' => esc_html__('Number Posts', 'kbw'),
                            'type' => 'number',  // USAGE TEXT TYPE
                            'value' => '9', // remove this if you do not need a default content
                            'description' => ''
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => __('Thumbnail', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'kbw-thumbnail', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'post_meta',
                            'label' => __('Post meta', 'kbw'),
                            'type' => 'toggle',  // USAGE RADIO TYPE
                            'value' => 'no', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'excerpt',
                            'label' => __('Excerpt', 'kbw'),
                            'type' => 'toggle',  // USAGE RADIO TYPE
                            'value' => 'no', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'excerpt_length',
                            'label' => __('Excerpt Length', 'kbw'),
                            'type' => 'number',  // USAGE NUMBER TYPE
                            'value' => '15', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'view_all',
                            'label' => __('View all button', 'kbw'),
                            'type' => 'toggle',  // USAGE RADIO TYPE
                            'value' => 'no', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'style',
                            'label' => __('Style', 'kbw'),
                            'type' => 'text',
                            'value' => 'default', // default, change-hover, change-zoom, youtube-video ...
                            'description' => 'Eg: default, change-hover, change-zoom, youtube-video ...',
                        ),
                        array(
                            'name' => 'class',
                            'label' => __('Class element', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'order',
                            'label' => __('Order', 'kbw'),
                            'type' => 'select',  // USAGE SELECT TYPE
                            'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                                'DESC' => 'DESC',
                                'ASC' => 'ASC',
                            ),
                            'value' => 'DESC', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => __('Orderby', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'post_date', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'kbw_custom_layout',
                            'label' => __('Custom Layout', 'kbw'),
                            'type' => 'toggle',  // USAGE RADIO TYPE
                            'value' => 'no', // remove this if you do not need a default content
                            'description' => '',
                        )
                    )
                ), // End of elemnt shortcode
            
            )
        ); // END KC ADD MAP
    } // End if KingComposer
}
