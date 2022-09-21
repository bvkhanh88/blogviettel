<?php
// KBW Sale Products
add_shortcode('kbw_sale_products', 'kbw_sale_products_func');
function kbw_sale_products_func($atts, $content = null)
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
        'margin' => 15,
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

        echo do_shortcode('[sale_products per_page="' . $per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '"]');

        if ($view == 'slider')
            echo '</div>';
        ?>
    </div>

    <?php
    return ob_get_clean();
}
