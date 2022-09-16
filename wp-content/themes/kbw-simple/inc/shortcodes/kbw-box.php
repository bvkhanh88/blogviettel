<?php
/**
 * Kbw Box
 * Create a Kbw Box in WPBakery
 *
 * @package kabiweb
 * @author Kabiweb - bvkhanh88@gmail.com
 * @authorURI: https://kabiweb.com
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('kbw_box_shortcode')) {
    add_shortcode('kbw_box', 'kbw_box_shortcode');
    function kbw_box_shortcode($atts, $content = null, $tag = '')
    {
        $atts = (shortcode_atts(array(
            'title' => '',
            'subtitle' => '',
            'price' => '',
            'link' => '',
            'link_text' => '',
            'image' => '',
            'image_size' => 'full',
            'display_style' => 'style1',
            'element_class' => '',
            'element_id' => ''
        ), $atts));
        
        $title = esc_html($atts['title']);
        $subtitle = esc_html($atts['subtitle']);
        $price = esc_html($atts['price']);
        $link = esc_html($atts['link']);
        $link_text = esc_html($atts['link_text']);
        
        $image_size = $atts['image_size'];
        $image = wp_get_attachment_image($atts['image'], $image_size);
        $display_style = esc_html($atts['display_style']);
        $element_class = esc_attr($atts['element_class']);
        $element_id = !empty($element_id) ? esc_attr($element_id) : 'kbw-box-' . rand();
        
        if (!defined('WPB_VC_VERSION') && function_exists('wpb_js_remove_wpautop')) {
            $content = wpb_js_remove_wpautop($content, true);
        }
        
        ob_start();
        ?>
        
        <?php
        if ($display_style == 'style1') { ?>
            <div class="kbw-box style1 <?php echo $element_class ?>" id="<?php echo $element_id ?>">
                <div class='box-heading-wrap'>
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-subtitle"><?php echo $subtitle ?></div>
                    <div class="box-price"><?php echo $price ?></div>
                </div>
                <?php if (!empty($link)) { ?>
                    <div class="box-link">
                        <a href="<?php echo $link ?>" class="alink"><?php echo $link_text ?></a>
                    </div>
                <?php } ?>
                <div class="box-content kbw-box-scroll"><?php echo $content ?></div>
            </div>
        <?php } elseif ($display_style == 'style2') { ?>
            <div class="kbw-box <?php echo $display_style . ' ' . $element_class ?>" id="<?php echo $element_id ?>">
                <div class="kbw-box-inner">
                    <?php if ($image) { ?>
                        <div class="box-image"><?php echo $image ?></div>
                    <?php } ?>
                    <div class="box-content">
                        <h3 class="box-title"><?php echo $title ?></h3>
                        <div class="box-text"><?php echo $content ?></div>
                        <?php if (!empty($link)) { ?>
                            <div class="box-link">
                                <a href="<?php echo $link ?>" class="alink"><?php echo $link_text ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } elseif ($display_style == 'style3') { ?>
            <div class="kbw-box <?php echo $display_style . ' ' . $element_class ?>" id="<?php echo $element_id ?>">
                <div class="kbw-box-inner">
                    <div class="box-top">
                        <?php if ($image) { ?>
                            <div class="box-image"><?php echo $image ?></div>
                        <?php } ?>
                        <div class="box-content">
                            <h3 class="box-title"><?php echo $title ?></h3>
                            <div class="box-text"><?php echo $content ?></div>
                        </div>
                    </div>
                    <?php if (!empty($link)) { ?>
                        <div class="box-bottom box-link">
                            <a href="<?php echo $link ?>" class="alink alink-arrow"><?php echo $link_text ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="kbw-box <?php echo $display_style . ' ' . $element_class ?>" id="<?php echo $element_id ?>">
                <div class="kbw-box-inner">
                    <?php if ($image) { ?>
                        <div class="box-image"><?php echo $image ?></div>
                    <?php } ?>
                    <div class="box-content">
                        <h3 class="box-title"><?php echo $title ?></h3>
                        <div class="box-text"><?php echo $content ?></div>
                        <?php if (!empty($link)) { ?>
                            <div class="box-link">
                                <a href="<?php echo $link ?>" class="alink"><?php echo $link_text ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

//Load into Composer
add_action('init', 'kbw_box_map_shortcode', 99);
function kbw_box_map_shortcode()
{
    // BEGIN JS COMPOSER
    if (function_exists('vc_map')) {
        vc_map(array(
            'name' => "" . __('KBW Box', 'kbw'),
            'base' => 'kbw_box',
            'category' => __('KABIWEB', 'kbw'),
            'icon' => 'icon-wpb-layer-shape-text',
            'description' => __('KBW Box Description', 'kbw'),
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => __('Image', 'kbw'),
                    'param_name' => 'image',
                    'value' => '',
                    'description' => __('Select image from media library.', 'kbw'),
                    'dependency' => array(
                        'element' => 'source',
                        'value' => 'media_library',
                    ),
                    'admin_label' => false,
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'heading' => __('Title', 'kbw'),
                    'param_name' => 'title',
                    'value' => __('', 'kbw'),
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'heading' => __('Sub Title', 'kbw'),
                    'param_name' => 'subtitle',
                    'value' => __('', 'kbw'),
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'heading' => __('Price', 'kbw'),
                    'param_name' => 'price',
                    'value' => __('', 'kbw'),
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'heading' => __('Link', 'kbw'),
                    'param_name' => 'link',
                    'value' => __('', 'kbw'),
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'heading' => __('Link text', 'kbw'),
                    'param_name' => 'link_text',
                    'value' => __('', 'kbw'),
                ),
                array(
                    'type' => 'textarea_html',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __('Content', 'kbw'),
                    'param_name' => 'content', // Important: Only one textarea_html param per content element allowed and it should have 'content' as a 'param_name'
                ),
                
                array(
                    'type' => 'textfield',
                    'heading' => __('Display Style', 'kbw'),
                    'param_name' => 'display_style',
                    'admin_label' => true,
                    'value' => '',
                    'std' => 'style1', // Your default value
                    'group' => __('Style', 'kbw'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Image size', 'kbw'),
                    'param_name' => 'image_size',
                    'admin_label' => true,
                    'value' => 'full',
                    'group' => __('Style', 'kbw'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Element ID', 'kbw'),
                    'param_name' => 'element_id',
                    'value' => __('', 'kbw'),
                    'description' => __('Enter element ID (Note: make sure it is unique and valid).', 'kbw'),
                    'group' => __('Style', 'kbw'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Extra class name', 'kbw'),
                    'param_name' => 'element_class',
                    'value' => __('', 'kbw'),
                    'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'kbw'),
                    'group' => __('Style', 'kbw'),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __('CSS box', 'js_composer'),
                    'param_name' => 'css',
                    'group' => __('Design Options', 'js_composer'),
                )
            )
        )); // End VC MAP
    } // End if VisualComposer
}
