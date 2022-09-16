<?php
if (!function_exists('kbw_post_shortcode')) {
    add_shortcode('kbw_post', 'kbw_post_shortcode');
    function kbw_post_shortcode($atts, $content = false)
    {
        $class = $layout = $post_type = $column = $column_mb = $taxonomy = $category = $offset = $number_posts = $thumbnail = $post_meta = $excerpt = $excerpt_length = $title_length = $view_all = $style = $order = $orderby = $title = $link_cat = $featured = $is_slider = $autoplay = $navigation = $pagination = $margin = $margin_mb = $kbw_custom_layout = '';
        
        $attributes = shortcode_atts(array(
            'post_type' => 'post',
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
            'column_mb' => 1,
            'taxonomy' => 'category',
            'category' => '',
            'offset' => 0,
            'ids' => '',
            'number_posts' => 9,
            'thumbnail' => 'kbw-thumbnail',
            'post_meta' => 'no',
            'excerpt' => 'yes',
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
        
        if ($taxonomy != '' && $category != '') {
            if (strpos($category, ',')) {
                $cate_arr = explode(',', $category);
                $category_obj = get_category_by_slug($cate_arr[0]);
            } else {
                $category_obj = get_category_by_slug($category);
            }
        }
        
        if (empty($title) || $title == '') {
            $title = (!empty($category_obj) && !is_wp_error($category_obj) ? $category_obj->name : 'hide');
        }
        
        if (empty($link_cat) || $link_cat == '') {
            $link_cat = (!empty($category_obj) && !is_wp_error($category_obj) ? get_term_link($category, $taxonomy) : 'javascript: void(0)');
        }
        
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $number_posts,
            'order' => $order,
            'orderby' => $orderby,
            'ignore_sticky_posts' => true,
        );
        
        if (strlen($category) > 0) {
            $args['category_name'] = $category;
        }
        
        if (empty($ids)) {
            if ($offset > 0) {
                $args['offset'] = $offset;
            }
        }
        
        if (!empty($ids) && strlen($category) == 0) {
            $ids = explode(',', $ids);
            $args['post__in'] = $ids;
        }
        
        if ($featured == 'yes') {
            $meta_query = array();
            $meta_query[] = array(
                'key' => 'kbw_featured',
                'value' => 1,
            );
            $args['meta_query'] = $meta_query;
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
        $GLOBALS['kbw_post_type'] = $post_type;
        $GLOBALS['kbw_thumbnail'] = $thumbnail;
        $GLOBALS['kbw_style'] = $style;
        $GLOBALS['kbw_is_slider'] = $is_slider;
        $GLOBALS['kbw_column'] = $column;
        $GLOBALS['kbw_column_mb'] = $column_mb;
        $GLOBALS['kbw_post_meta'] = $post_meta;
        $GLOBALS['kbw_excerpt'] = $excerpt;
        $GLOBALS['kbw_excerpt_length'] = $excerpt_length;
        
        $options = $responsive = array();
        $options['autoHeight'] = true;
        $options['items'] = (int)$column;
        $options['autoplay'] = $autoplay ? true : false;
        $options['nav'] = $navigation == 'true' ? true : false;
        $options['dots'] = $pagination == 'true' ? true : false;
        $options['margin'] = (int)$margin;
        $responsive[0]['margin'] = (int)$margin_mb;
        $responsive[0]['items'] = (int)$column_mb;
        $responsive[481]['items'] = (int)$column_mb;
        $responsive[768]['items'] = (int)$column > 1 ? 2 : 1;
        $responsive[992]['items'] = (int)$column > 1 ? 2 : 1;
        $responsive[1200]['items'] = (int)$column;
        $options['responsive'] = $responsive;
        $options = json_encode($options);
        
        
        ob_start();
        
        if ($kbw_custom_layout == 'yes'):
            wp_reset_query();
            $attributes['post_type'] = 'post';
            $attributes['args'] = $args;
            do_action('kbw_layout_custom_post', $attributes);
        else:
            // Layout Grid
            if ($layout == 'grid') { ?>

                <div class="kbw-block-wrap kbw-posts <?php echo $post_type . $class; ?>">
                    <?php if ($title != '' && $title != 'hide') echo '<div class="cat-box-title clearfix"><h2 class="heading-title">' . ($link_cat != 'none' ? '<a href="' . $link_cat . '">' : '') . '<span class="inline-title">' . $title . '</span>' . ($link_cat != 'none' ? '</a>' : '') . '</h2></div>'; ?>
                    
                    <?php if ($is_slider == 'yes') echo '<div class="slider-wrapper" data-owl-config="' . esc_attr($options) . '">'; ?>
                    <div class="listing-wrap kbw-block-inner kbw-posts-inner <?php echo ($is_slider == 'yes') ? 'kbwCarousel' : 'row row-flex-' . (in_array($margin, array(0, 10, 15, 20, 25, 30)) ? (int)$margin : 20) ?>">
                        <?php $i = $j = 0;
                        if ($myquery->have_posts()) : while ($myquery->have_posts()): $myquery->the_post(); ?>
                            <?php global $post; ?>
                            <?php $i++; ?>
                            <?php get_template_part('templates/loops/post-item', 'grid'); ?>
                        <?php endwhile;endif; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                    <?php if ($is_slider == 'yes') echo '</div>'; ?>
                    <?php if ($view_all == 'yes') echo '<a class="view-all" href="' . $link_cat . '">' . __('View all', 'kbw') . '</a>'; ?>
                    <?php do_action('kbw_after_post_listing_grid', $args); ?>
                </div>
            <?php } ?>
            
            
            <?php // Layout List
            if ($layout == 'list') { ?>
                <div class="kbw-block-wrap kbw-posts list <?php echo $post_type . $class; ?>">
                    <?php if ($title != '' && $title != 'hide') echo '<div class="cat-box-title clearfix"><h2 class="heading-title">' . ($link_cat != 'none' ? '<a href="' . $link_cat . '">' : '') . '<span class="inline-title">' . $title . '</span>' . ($link_cat != 'none' ? '</a>' : '') . '</h2></div>'; ?>
                    <?php if ($is_slider == 'yes') echo '<div class="slider-wrapper" data-owl-config="' . esc_attr($options) . '">'; ?>
                    <div class="kbw-block-inner kbw-posts-inner <?php echo $is_slider == 'yes' ? 'kbwCarousel' : ''; ?>">
                        <?php $i = 0;
                        if ($myquery->have_posts()) : while ($myquery->have_posts()): $myquery->the_post(); ?>
                            <?php global $post; ?>
                            <?php $i++; ?>
                            <?php get_template_part('templates/loops/post-item', 'list'); ?>
                        <?php endwhile;endif; ?>
                        <?php if ($view_all == 'yes') echo '<a class="view-all" href="' . $link_cat . '">' . __('View all', 'kbw') . '</a>'; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                    <?php if ($is_slider == 'yes') echo '</div>'; ?>
                    <div class="clear"></div>
                    <?php if ($pagination && $myquery->max_num_pages > 1) { ?>
                        <div class="recent-box-pagination"><?php kbw_posts_pagination($myquery); ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
            
            
            <?php // Layout Two Column
            if ($layout == 'kbw-two-column') { ?>
                <div id="<?php echo $random_id; ?>" class="kbw-block-wrap kbw-posts kbw-two-column <?php echo $post_type . $class; ?>">
                    <?php if ($title != '' && $title != 'hide') echo '<div class="cat-box-title clearfix"><h2 class="heading-title">' . ($link_cat != 'none' ? '<a href="' . $link_cat . '">' : '') . '<span class="inline-title">' . $title . '</span>' . ($link_cat != 'none' ? '</a>' : '') . '</h2></div>'; ?>
                    <div class="kbw-block-inner kbw-posts-inner row-flex-20">
                        <?php $i = $j = 0;
                        if ($myquery->have_posts()) : while ($myquery->have_posts()):
                            $i++;
                            $j++;
                            $myquery->the_post(); ?>
                            <?php global $post; ?>
                            
                            <?php
                            if ($i == 1) { ?>
                                <?php echo '<div class="col-md-6">'; ?>
                                <div class="item post-item">
                                    <div class="recent-item hover-effect">
                                        <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumbnail != 'none') : ?>
                                            <div class="post-thumbnail">
                                                <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_post_thumbnail($thumbnail); ?>
                                                    <span class="fa overlay-icon"></span>
                                                </a>
                                            </div><!-- post-thumbnail /-->
                                        <?php endif; ?>
                                        <div class="entry">
                                            <div class="post-box-title">
                                                <a href="<?php the_permalink($post->ID); ?>" rel="bookmark"><?php echo get_the_title($post->ID); ?></a>
                                            </div>
                                            <div class="excerpt">
                                                <p><?php echo kbw_truncate(get_the_excerpt($post->ID), $excerpt_length, 'words'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo '</div><div class="col-md-6">'; ?>
                            <?php } ?>
                            
                            <?php
                            if ($i > 1) { ?>
                                <div class="item post-item item-list list">
                                    <div class="recent-item default">
                                        <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumbnail != 'none') : ?>
                                            <div class="post-thumbnail">
                                                <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_post_thumbnail($thumbnail); ?>
                                                    <span class="fa overlay-icon"></span>
                                                </a>
                                            </div><!-- post-thumbnail /-->
                                        <?php endif; ?>
                                        <div class="entry">
                                            <div class="post-box-title">
                                                <a href="<?php the_permalink($post->ID); ?>" rel="bookmark"><?php echo get_the_title($post->ID); ?></a>
                                            </div>
                                            <?php if ($excerpt == 'yes') : ?>
                                                <div class="excerpt">
                                                    <p><?php echo kbw_truncate(get_the_excerpt($post->ID), $excerpt_length, 'words'); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($i == $myquery->post_count) echo '</div>'; ?>
                        
                        <?php endwhile;endif; ?>
                        <?php if ($offset === null && $myquery->max_num_pages > 1) { ?>
                            <div class="recent-box-pagination"><?php //kbw_posts_pagination($myquery); ?></div>
                        <?php } ?>
                        <?php if ($view_all == 'yes') echo '<a class="view-all" href="' . $link_cat . '">' . __('View all', 'kbw') . '</a>'; ?>
                        <div class="clear-30"></div>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            <?php } ?>
            
            
            <?php // Layout Two column 2
            if ($layout == 'kbw-two-column-2') { ?>
                <div id="<?php echo $random_id; ?>" class="kbw-block-wrap kbw-posts kbw-two-column-2 <?php echo $post_type . $class; ?>" data-col="2">
                    <?php if ($title != '' && $title != 'hide') echo '<div class="cat-box-title clearfix"><h2 class="heading-title">' . ($link_cat != 'none' ? '<a href="' . $link_cat . '">' : '') . '<span class="inline-title">' . $title . '</span>' . ($link_cat != 'none' ? '</a>' : '') . '</h2></div>'; ?>
                    <div class="kbw-block-inner kbw-posts-inner">
                        <?php $i = $j = 0;
                        if ($myquery->have_posts()) : while ($myquery->have_posts()):
                            $i++;
                            $j++;
                            $myquery->the_post(); ?>
                            <?php global $post; ?>

                            <div class="item post-item post-item-<?php echo $i; ?> item-<?php echo $j; ?> col-sm-6">
                                <div class="recent-item <?php echo ($j <= 2) ? 'change-hover' : 'item-list'; ?>">
                                    <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumbnail != 'none') : ?>
                                        <div class="post-thumbnail">
                                            <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_post_thumbnail($thumbnail); ?>
                                                <span class="fa overlay-icon"></span>
                                            </a>
                                        </div><!-- post-thumbnail /-->
                                    <?php endif; ?>
                                    <div class="entry">
                                        <div class="post-box-title">
                                            <a href="<?php the_permalink($post->ID); ?>" rel="bookmark"><?php echo get_the_title($post->ID); ?></a>
                                        </div>
                                        <?php if ($excerpt == 'yes') : ?>
                                            <div class="excerpt">
                                                <p><?php echo kbw_truncate(get_the_excerpt($post->ID), $excerpt_length, 'words'); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if ($i == 2) $i = 0; ?>
                        <?php endwhile;endif; ?>
                        <?php if ($pagination && $myquery->max_num_pages > 1) { ?>
                            <div class="recent-box-pagination"><?php //kbw_posts_pagination($myquery); ?></div>
                        <?php } ?>
                        <?php if ($view_all == 'yes') echo '<a class="view-all" href="' . $link_cat . '">' . __('View all', 'kbw') . '</a>'; ?>
                        <div class="clear-30"></div>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            <?php } ?>
            
            
            <?php // Layout Slider Grid
            if ($layout == 'slider-grid-module') { ?>
                <?php
                wp_enqueue_script('flexslider-scripts');
                wp_enqueue_style('flexslider-styles'); ?>

                <div class="slider-grid-module slider kbw-posts <?php echo $post_type . $class; ?>" data-num="7">
                    <?php $i = $j = 0;
                    if ($myquery->have_posts()) : while ($myquery->have_posts()):
                        $i++;
                        $j++;
                        $myquery->the_post(); ?>
                        <?php global $post; ?>

                        <div class="item post-item post-item-<?php echo $i; ?> item-<?php echo $j; ?>">
                            <div class="recent-item change-hover">
                                <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumbnail != 'none') : ?>
                                    <div class="post-thumbnail">
                                        <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_post_thumbnail($thumbnail); ?>
                                            <span class="fa overlay-icon"></span>
                                        </a>
                                    </div><!-- post-thumbnail /-->
                                <?php endif; ?>
                                <div class="entry">
                                    <div class="post-box-title">
                                        <a href="<?php the_permalink($post->ID); ?>" rel="bookmark"><?php echo get_the_title($post->ID); ?></a>
                                    </div>
                                    <?php if ($excerpt == 'yes') : ?>
                                        <div class="excerpt">
                                            <p><?php echo kbw_truncate(get_the_excerpt($post->ID), $excerpt_length, 'words'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($i == 7) $i = 0; ?>
                    <?php endwhile;endif; ?>
                    <?php wp_reset_query(); ?>

                    <script>
                        jQuery(document).ready(function ($) {
                            $('.slider-grid-module').each(function () {
                                var pItems = $(this).find('.item.post-item');
                                var col = $(this).data('num');

                                for (var i = 0; i < pItems.length; i += col) {
                                    pItems.slice(i, i + col).wrapAll('<div class="grid-posts-single-slide"></div>');
                                }

                                $(this).flexslider({
                                    animation: "fade",
                                    selector: ".grid-posts-single-slide",
                                    slideshowSpeed: 7000,
                                    animationSpeed: 600,
                                    randomize: false,
                                    pauseOnHover: true,
                                    prevText: "",
                                    nextText: "",
                                    slideshow: true,
                                    controlNav: false
                                });
                            });
                        });
                    </script>
                </div>
                <div class="clear-30"></div>
            <?php } ?>
        
        <?php endif; ?>
        
        
        <?php
        // reset global var
        $kbw_post_type = $kbw_thumbnail = $kbw_style = $kbw_is_slider = $kbw_column = $kbw_column_mb = $kbw_post_meta = $kbw_excerpt = $kbw_excerpt_length = '';
        
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

//Load into Composer
add_action('init', 'kbw_load_kbw_post_shortcode', 99);
function kbw_load_kbw_post_shortcode()
{
    // BEGIN JS COMPOSER
    if (function_exists('vc_map')) {
        vc_map(array(
            'name' => "" . __('KBW Post', 'kbw'),
            'base' => 'kbw_post',
            'category' => __('KABIWEB', 'kbw'),
            'icon' => '',
            'description' => __('KBW Post Description', 'kbw'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'kbw'),
                    'param_name' => 'title',
                    'value' => ''
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
                    'dependency' => array('element' => 'layout', 'value' => array('slider')),
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
                    'dependency' => array('element' => 'layout', 'value' => array('slider')),
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
                    'dependency' => array('element' => 'layout', 'value' => array('grid', 'slider', 'list')),
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
                    'std' => '1',
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
}
