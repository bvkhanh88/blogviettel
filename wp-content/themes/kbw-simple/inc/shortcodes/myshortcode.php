<?php
/**
 *  Shortcodes
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

/* load theme option */
if (!function_exists('kbw_load_option_shortcode')) {
    add_shortcode('kbw_load_option', 'kbw_load_option_shortcode');
    function kbw_load_option_shortcode($atts, $content = null)
    {
        $id = $editor = '';
        extract(shortcode_atts(array(
            'id' => '',
            'editor' => '1',
        ), $atts));
        
        if (kbw_get_option($id) && !is_array(kbw_get_option($id))) {
            $result = $editor == 1 ? wpautop(kbw_get_option($id)) : kbw_get_option($id);
            return $result;
        } else {
            return false;
        }
    }
}

/* kbw section */
if (!function_exists('kbw_section_shortcode')) {
    add_shortcode('kbw_section', 'kbw_section_shortcode');
    function kbw_section_shortcode($atts, $content = null)
    {
        $id = $class = $layout = '';
        extract(shortcode_atts(array(
            'id' => '',
            'class' => '',
            'layout' => 'kbw-container'
        ), $atts));
        ob_start(); ?>

        <section <?php if ($id) echo 'id="' . $id . '"'; ?> class="kbw-section <?php echo $class ?>">
            <div class="section-content <?php echo $layout; ?>">
                <?php echo do_shortcode($content); ?>
            </div>
        </section>
        
        <?php
        return ob_get_clean();
    }
}

/* Shortcode include sidebar */
if (!function_exists('kbw_widget_sidebar_shortcode')) {
    add_shortcode('kbw_widget_sidebar', 'kbw_widget_sidebar_shortcode');
    function kbw_widget_sidebar_shortcode($atts)
    {
        $sidebar_name = '';
        extract(shortcode_atts(array(
            'sidebar_name' => '',
        ), $atts));
        ob_start();
        
        if ('' === $sidebar_name) {
            return null;
        }
        dynamic_sidebar($sidebar_name);
        
        return ob_get_clean();
    }
}

/* Open/Close Tag */
if (!function_exists('kbw_tagopen_shortcode')) {
    add_shortcode('kbw_tagopen', 'kbw_tagopen_shortcode');
    function kbw_tagopen_shortcode($atts, $content = null)
    {
        $tag = $class = $data_section_name = '';
        extract(shortcode_atts(array(
            'tag' => 'div',
            'class' => '',
            'data_section_name' => '0',
        ), $atts));
        $data_section = ($data_section_name == '0') ? '' : ' data-section-name="' . $data_section_name . '"';
        return '<' . $tag . ' class="kbw-tag ' . $class . $data_section . '">';
    }
}

if (!function_exists('kbw_tagclose_shortcode')) {
    add_shortcode('kbw_tagclose', 'kbw_tagclose_shortcode');
    function kbw_tagclose_shortcode($atts)
    {
        $tag = '';
        extract(shortcode_atts(array(
            'tag' => 'div'
        ), $atts));
        
        return '</' . $tag . '>';
    }
}

/*marque tag*/
if (!function_exists('kbw_marquee_shortcode')) {
    add_shortcode('kbw_marquee', 'kbw_marquee_shortcode');
    function kbw_marquee_shortcode($atts, $content = null)
    {
        $class = $direction = '';
        extract(shortcode_atts(array(
            'class' => '',
            'direction' => 'left'
        ), $atts));
        ob_start(); ?>

        <div class="kbw-marquee <?php echo $class ?>">
            <div class="kbw-marquee-content">
                <marquee class="<?php echo $class ?>" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5" direction="<?php echo $direction; ?>" width="100%" align="center"><?php echo do_shortcode($content); ?></marquee>
            </div>
        </div>
        
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

/* kbw parallax */
if (!function_exists('kbw_parallax_shortcode')) {
    add_shortcode('kbw_parallax', 'kbw_parallax_shortcode');
    function kbw_parallax_shortcode($atts, $content = null)
    {
        $class = $url_parallax = '';
        extract(shortcode_atts(array(
            'class' => '',
            'url_parallax' => '',
        ), $atts));
        
        $html = '<div class="kbw-parallax ' . $class . '" id="parallax" style="background-image: url(' . $url_parallax . ');">';
        $html .= do_shortcode($content);
        $html .= '</div>';
        
        return $html;
    }
}

//shortcode kbw_block
if (!function_exists('kbw_block_shortcode')) {
    add_shortcode('kbw_block', 'kbw_block_shortcode');
    function kbw_block_shortcode($atts, $content = null)
    {
        $class = $block_type = $id_option = '';
        extract(shortcode_atts(array(
            'class' => '',
            'block_type' => '',
            'id_option' => 'kbw_customer',
        ), $atts));
        
        ob_start(); ?>
        
        <?php
        if ($block_type == '') { ?>
            <div class="box-block<?php echo esc_attr($class); ?>">
                <?php echo do_shortcode($content); ?>
            </div>
        <?php } ?>
        
        <?php
        if ($block_type == 'bx-slider') {
        
        }
        ?>
        
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

//shortcode kbw_search
if (!function_exists('kbw_search_form_shortcode')) {
    add_shortcode('kbw_search_form', 'kbw_search_form_shortcode');
    function kbw_search_form_shortcode($atts, $content = null)
    {
        $el_class = $post_type = $style = '';
        extract(shortcode_atts(array(
            'el_class' => '',
            'post_type' => 'post',
            'style' => ''
        ), $atts));
        return kbw_search_form($post_type, $style, $el_class);
    }
}

//shortcode display logo
if (!function_exists('kbw_logo_shortcode')) {
    add_shortcode('kbw_logo', 'kbw_logo_shortcode');
    function kbw_logo_shortcode($atts, $content = null)
    {
        $class = $post_type = $thumbnail = $column = $column_gap = $navigation = $pagination = '';
        extract(shortcode_atts(array(
            'class' => '',
            'post_type' => 'post',
            'thumbnail' => 'kbw-thumbnail',
            'column' => 6,
            'column_gap' => 20,
            'navigation' => true,
            'pagination' => false
        ), $atts));
        
        ob_start();
        
        $class = empty($class) ? '' : (' ' . $class);
        
        $list_logos = kbw_get_option('gallery_home');
        $list_logos = explode(',', $list_logos);
        $options = $responsive = array();
        $options['autoHeight'] = true;
        $options['autoplay'] = true;
        $options['autoplayHoverPause'] = false;
        $options['items'] = (int)$column;
        $options['nav'] = ($navigation) ? true : false;
        $options['dots'] = ($pagination) ? true : false;
        $options['margin'] = (int)$column_gap;
        $responsive[0]['items'] = 2;
        $responsive[481]['items'] = 2;
        $responsive[768]['items'] = 3;
        $responsive[992]['items'] = 4;
        $responsive[1200]['items'] = (int)$column;
        $options['responsive'] = $responsive;
        $options = json_encode($options);
        ?>

        <div class="kbw-logo<?php echo $class; ?>">
            <div class="slider-wrapper slider" data-owl-config="<?php echo esc_attr($options); ?>">
                <div class="slider-inner">
                    <div class="kbwCarousel">
                        <?php if (!empty($list_logos)) { ?>
                            <?php foreach ($list_logos as $logo_img_id) { ?>
                                <div class="item logo-item">
                                    <a href="##"><img src="<?php echo kbw_wp_img_src($logo_img_id, $thumbnail) ?>"/></a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
