<?php
// KBW Recent Products - Lists recent products – useful on the homepage.
add_shortcode('kbw_recent_products', 'kbw_recent_products_func');
function kbw_recent_products_func($atts, $content = null)
{
    ob_start();

    $output = $title = $view = $per_page = $columns = $column_width = $addlinks_pos = $orderby = $order = $pagination = $navigation = $autoplay = $animation_type = $animation_duration = $animation_delay = $class = $margin = '';
    extract(shortcode_atts(array(
        'title' => '',
        'view' => 'grid',
        'per_page' => 12,
        'columns' => 4,
        'column_width' => '',
        'orderby' => 'date',
        'order' => 'desc',
        'addlinks_pos' => '',
        'navigation' => true,
        'autoplay' => false,
        'pagination' => false,
        'animation_type' => '',
        'animation_duration' => 1000,
        'animation_delay' => 0,
        'class' => '',
        'margin' => 10,
    ), $atts));

    ?>

    <?php
    $animation_attributes = '';
    if ($animation_type) {
        $animation_attributes .= ' data-appear-animation="' . $animation_type . '"';
        if ($animation_delay)
            $animation_attributes .= ' data-appear-animation-delay="' . $animation_delay . '"';
        if ($animation_duration && $animation_duration != 1000)
            $animation_attributes .= ' data-appear-animation-duration="' . $animation_duration . '"';
    }
    ?>

    <div class="kbw-product <?php echo $class; ?>"<?php echo $animation_attributes; ?>>
        <?php
        if ($title) {
            if ($view == 'slider') {
                echo '<h2 class="slider-title"><span class="inline-title">' . $title . '</span><span class="line"></span></h2>';
            } else {
                echo '<h2 class="section-title">' . $title . '</h2>';
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

        echo do_shortcode('[recent_products per_page="' . $per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '"]');

        if ($view == 'slider')
            echo '</div>';
        ?>
    </div>

    <?php
    return ob_get_clean();
}

//Load into Composer
add_action('init', 'kbw_load_recent_products_func', 99);
function kbw_load_recent_products_func()
{
    if (function_exists('kc_add_map')) {
        kc_add_map(
            array(

                'kbw_recent_products' => array(
                    'name' => __('KBW Recent Products', 'kbw'),
                    'description' => __('Lists recent products – useful on the homepage', 'kbw'),
                    'category' => __('KBW Framework', 'kbw'),
                    'icon' => 'sl-paper-plane',
                    'title' => __('KBW Recent Products', 'kbw'),

                    'params' => array(
                        array(
                            'name' => 'title',
                            'label' => __('Title', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'Newness Product', // remove this if you do not need a default content
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
                            'value' => 'slider', // remove this if you do not need a default content
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

    if (function_exists('vc_map')) {
        $animation_type = '';
        $animation_duration = '';
        $animation_delay = '';
        $custom_class = '';
        $order_by_values = '';
        $order_way_values = '';

        vc_map(
            array(
                'name' => "KBW " . __('Recent products', 'js_composer'),
                'base' => 'kbw_recent_products',
                'icon' => '',
                'category' => __('KBW Framework', 'kbw'),
                'description' => __('Display products set as "featured"', 'kbw'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __('Title', 'woocommerce'),
                        'param_name' => 'title',
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('View mode', 'kbw'),
                        'param_name' => 'view',
                        'value' => array(),
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Per page', 'js_composer'),
                        'value' => 12,
                        'param_name' => 'per_page',
                        'description' => __('The "per_page" shortcode determines how many products to show on the page', 'js_composer'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Columns', 'kbw'),
                        'param_name' => 'columns',
                        'dependency' => Array('element' => 'view', 'value' => array('slider', 'grid')),
                        'std' => '4',
                        'value' => array(),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Column Width', 'kbw'),
                        'param_name' => 'column_width',
                        'dependency' => Array('element' => 'view', 'value' => array('slider', 'grid')),
                        'value' => array(),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Order by', 'js_composer'),
                        'param_name' => 'orderby',
                        'value' => $order_by_values,
                        'description' => sprintf(__('Select how to sort retrieved products. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Order way', 'js_composer'),
                        'param_name' => 'order',
                        'value' => $order_way_values,
                        'description' => sprintf(__('Designates the ascending or descending order. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Add Links Position', 'kbw'),
                        'description' => __('Select position of add to cart, add to wishlist, quickview.', 'kbw'),
                        'param_name' => 'addlinks_pos',
                        'value' => ''
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __('Show Slider Navigation', 'kbw'),
                        'param_name' => 'navigation',
                        'std' => 'yes',
                        'dependency' => Array('element' => 'view', 'value' => array('slider')),
                        'value' => array(__('Yes', 'js_composer') => 'yes')
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __('Show Slider Pagination', 'kbw'),
                        'param_name' => 'pagination',
                        'std' => 'no',
                        'dependency' => Array('element' => 'view', 'value' => array('slider')),
                        'value' => array(__('Yes', 'js_composer') => 'yes')
                    ),
                )
            )
        ); //End VC MAP
    } // End if VisualComposer
}
