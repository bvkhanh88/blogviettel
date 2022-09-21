<?php
// Show multiple products in a category by slug.
add_shortcode('kbw_product_category', 'kbw_product_category_func');
function kbw_product_category_func($atts, $content = null)
{
    ob_start();
    
    $output = $title = $view = $per_page = $columns = $column_width = $addlinks_pos = $orderby = $order = $pagination = $navigation = $autoplay = $animation_type = $animation_duration = $animation_delay = $class = $margin = $category = $view_all = '';
    extract(shortcode_atts(array(
        'title' => '',
        'view' => 'grid',
        'per_page' => 8,
        'columns' => 4,
        'column_width' => '',
        'orderby' => 'date',
        'order' => 'desc',
        'category' => '',
        'addlinks_pos' => '',
        'navigation' => true,
        'autoplay' => false,
        'pagination' => false,
        'animation_type' => '',
        'animation_duration' => 1000,
        'animation_delay' => 0,
        'class' => '',
        'margin' => 15,
        'view_all' => false
    ), $atts));
    wp_reset_query();
    
    $animation_attributes = '';
    if ($animation_type) {
        $animation_attributes .= ' data-appear-animation="' . $animation_type . '"';
        if ($animation_delay)
            $animation_attributes .= ' data-appear-animation-delay="' . $animation_delay . '"';
        if ($animation_duration && $animation_duration != 1000)
            $animation_attributes .= ' data-appear-animation-duration="' . $animation_duration . '"';
    }
    
    $num_prod = false;
    if ($category != '') {
        if (is_numeric($category)) {
            $term = get_term_by('id', $category, 'product_cat');
            if (!empty($term) && !is_wp_error($term)) {
                $num_prod = $term->count;
            }
        } else {
            if (strpos($category, ',')) {
                $cate_arr = explode(',', $category);
                if (is_numeric($cate_arr[0])) {
                    $term = get_term_by('id', $cate_arr[0], 'product_cat');
                } else {
                    $term = get_term_by('slug', $cate_arr[0], 'product_cat');
                }
            } else {
                $term = get_term_by('slug', $category, 'product_cat');
                if (!empty($term) && !is_wp_error($term)) {
                    $num_prod = $term->count;
                }
            }
        }
    }
    
    if (empty($link_cat) || $link_cat == '') {
        $link_cat = !empty($term) && !is_wp_error($term) ? get_term_link($term->term_id) : 'javascript: void(0)';
    }
    ?>

    <div class="kbw-product <?php echo $class; ?> clearfix"<?php echo $animation_attributes; ?>>
        <?php
        if ($title) {
            if ($view == 'slider') {
                echo '<h2 class="slider-title"><span class="inline-title">' . $title . '</span><span class="line"></span></h2>';
            } else {
                echo '<h2 class="section-title"><span class="inline-title">' . $title . '</span></h2>';
            }
        }
        
        if ($view == 'slider') {
            $options = array();
            $responsive = array();
            $options['autoHeight'] = true;
            $options['items'] = $columns;
            $options['autoplay'] = ($autoplay) ? true : false;
            $options['nav'] = ($navigation) ? true : false;
            $options['dots'] = ($pagination) ? true : false;
            $options['margin'] = (int)$margin;
            $responsive[0]['items'] = 2;
            $responsive[481]['items'] = 2;
            $responsive[768]['items'] = 3;
            $responsive[992]['items'] = $columns;
            $responsive[1200]['items'] = $columns;
            $options['responsive'] = $responsive;
            
            $options = json_encode($options);
            echo '<div class="slider-wrapper" data-owl-config="' . esc_attr($options) . '">';
        }
        
        global $woocommerce_loop;
        $woocommerce_loop['view'] = $view;
        $woocommerce_loop['columns'] = $columns;
        $woocommerce_loop['column_width'] = $column_width;
        $woocommerce_loop['pagination'] = $pagination;
        $woocommerce_loop['navigation'] = $navigation;
        $woocommerce_loop['addlinks_pos'] = $addlinks_pos;
        
        echo do_shortcode('[product_category per_page="' . $per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '" category="' . $category . '"]');
        
        if ($view_all) echo '<div class="col-inner text-center clearfix"><a rel="noopener noreferrer" href="' . $link_cat . '" class="button secondary view-all">' . ( !$num_prod ? __('View more', 'kbw') : sprintf(__('View all %s product', 'kbw'), $num_prod) ) . '<i class="fa fa-angle-right"></i></a></div>';
        
        if ($view == 'slider')
            echo '</div>';
        ?>
    </div>
    
    <?php
    return ob_get_clean();
}


//Load into Composer
add_action('init', 'kbw_load_product_category_func', 99);
function kbw_load_product_category_func()
{
    if (function_exists('kc_add_map')) {
        kc_add_map(
            array(
                'kbw_product_category' => array(
                    'name' => __('KBW Product Category', 'kbw'),
                    'description' => __('Show multiple products in a category by slug – useful on the homepage', 'kbw'),
                    'category' => __('KBW Framework', 'kbw'),
                    'icon' => 'sl-paper-plane',
                    'title' => __('KBW Product Category', 'kbw'),
                    
                    'params' => array(
                        array(
                            'name' => 'title',
                            'label' => __('Title', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'view',
                            'label' => __('View Type', 'kbw'),
                            'type' => 'select',  // USAGE SELECT TYPE
                            'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                                'grid' => 'Grid',
                                'slider' => 'Slider',
                            ),
                            'value' => 'grid', // remove this if you do not need a default content
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
                            'name' => 'per_page',
                            'label' => __('Number show', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '8', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'columns',
                            'label' => esc_html__('Columns', 'kbw'),
                            'type' => 'select',  // USAGE SELECT TYPE
                            'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6'
                            ),
                            'value' => '4', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'view',
                                'hide_when' => array('list')
                            )
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => __('Orderby', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'date', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'order',
                            'label' => __('Order', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'DESC', // remove this if you do not need a default content
                            'description' => '',
                        )
                    )
                ), // End of elemnt shortcode
            
            )
        ); // END KC ADD MAP
    } // End if KingComposer
}