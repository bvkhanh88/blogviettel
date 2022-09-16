<?php
//KBW Slider
if (!function_exists('hk_slider_shortcode')):
    add_shortcode('kbw_slider', 'kbw_slider_shortcode');
    function kbw_slider_shortcode($atts, $content = false)
    {
        $class = $type = $slide_theme = $id = $thumbnail = $navigation = $pagination = $column = $column_mb = $column_gap = '';
        extract(shortcode_atts(array(
            'id' => '',
            'type' => 'owl',
            'slide_theme' => 'default',
            'thumbnail' => 'full',
            'navigation' => true,
            'pagination' => false,
            'column' => 1,
            'column_mb' => 1,
            'column_gap' => 0,
            'class' => '',
        ), $atts));
        wp_reset_query();
        
        global $post;
        $original_post = $post;
        
        $kbw_slider_id = $id;
        $get_kbw_slider = get_post_custom($kbw_slider_id);
        $kbw_slider = isset($get_kbw_slider["kbw_slider"]) ? unserialize($get_kbw_slider["kbw_slider"][0]) : array();
        //$kbw_slider_type = $get_kbw_slider["kbw_slide_type"][0];
        
        $number = count($kbw_slider);
        
        $options = $responsive = array();
        $options['autoHeight'] = true;
        $options['autoplay'] = true;
        $options['autoplayHoverPause'] = true;
        $options['items'] = 1;
        $options['nav'] = ($navigation) ? true : false;;
        $options['dots'] = ($pagination) ? true : false;
        $options['loop'] = true;
        $options['margin'] = intval($column_gap);
        $responsive[0]['items'] = intval($column_mb);
        $responsive[481]['items'] = intval($column_mb);
        $responsive[768]['items'] = intval($column_mb);
        $responsive[992]['items'] = intval($column);
        $responsive[1200]['items'] = intval($column);
        $options['responsive'] = $responsive;
        $options = json_encode($options);
        
        ob_start(); ?>
        
        <?php
        if ($type == 'owl' || $type == 'owl-show-text') { ?>

            <div class="slider-wrapper slider<?php echo $class != '' ? ' ' . $class : ''; ?>" data-owl-config="<?php echo esc_attr($options); ?>">
                <div class="slider-inner">
                    <div class="kbwCarousel">
                        <?php if ($kbw_slider): $i = 0; ?>
                            <?php foreach ($kbw_slider as $slide): $i++; ?>
                                <?php $slide_text = !empty($slide['title']) || !empty($slide['caption']) ? true : false; ?>
                                <div class="item slide-item">
                                    <div class="post-image">
                                        <?php if (!empty($slide['link']) && !$slide_text) echo '<a href="' . stripslashes($slide['link']) . '">'; ?>
                                        <img src="<?php echo kbw_wp_img_src($slide['id'], $thumbnail) ?>" alt="<?php echo stripslashes($slide['title']) ?>" title="<?php echo stripslashes($slide['title']) ?>"/>
                                        <span class="mask"></span>
                                        <?php if (!empty($slide['link']) && !$slide_text) echo '</a>'; ?>
                                    </div>
                                    <?php if ($slide_text && $type == 'owl-show-text') { ?>
                                        <div class="content-container <?php echo $slide_theme; ?>">
                                            <div class="container">
                                                <?php if (!empty($slide['title'])) { ?>
                                                    <h2 class="text-uppercase text-white text-shadow"><?php echo stripslashes($slide['title']); ?></h2>
                                                <?php } ?>
                                                <?php if (!empty($slide['caption'])) { ?>
                                                    <p class="excerpt text-white text-shadow"><?php echo stripslashes($slide['caption']); ?></p>
                                                    <div class="btn-action">
                                                        <a href="<?php echo !empty($slide['link']) ? $slide['link'] : 'javascript: void(0)'; ?>" class="kbw-btn primary arrows" alt="">
                                                            <span><?php echo __('View more', 'kbw') ?></span>
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        
        <?php } elseif ($type == 'smart') {
            $options_thumb = $responsive_thumb = array();
            $options_thumb['items'] = 4;
            $responsive_thumb[0]['items'] = 4;
            $responsive_thumb[600]['items'] = 4;
            $responsive_thumb[1000]['items'] = 4;
            $options_thumb['responsive'] = $responsive_thumb;
            $options_thumb = json_encode($options_thumb);
            ?>

            <div class="kbw-slider-thumb">
                <div class="slider-wrapper<?php echo $class != '' ? ' ' . $class : ''; ?>" data-owl-config="<?php echo esc_attr($options); ?>">
                    <div class="slider-controls">
                        <a class="slider-left" href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
                        <a class="slider-right" href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a>
                    </div>
                    <div class="kbwCarousel">
                        <?php if ($kbw_slider) {
                            $i = 0; ?>
                            <?php foreach ($kbw_slider as $slide): $i++; ?>
                                <div class="item slide-item">
                                    <div class="post-image">
                                        <?php if (!empty($slide['link'])) echo '<a href="' . stripslashes($slide['link']) . '">'; ?>
                                        <img src="<?php echo kbw_wp_img_src($slide['id'], $thumbnail) ?>" alt="<?php echo stripslashes($slide['title']) ?>" title="<?php echo stripslashes($slide['title']) ?>"/>
                                        <span class="mask"></span>
                                        <?php if (!empty($slide['link'])) echo '</a>'; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="thumb-wrapper" data-owl-config="<?php echo esc_attr($options_thumb); ?>">
                    <div class="thumb">
                        <?php if ($kbw_slider) {
                            $ii = 0; ?>
                            <?php foreach ($kbw_slider as $slide): $ii++; ?>
                                <div class="item thumb-item">
                                    <p class="slide-title"><?php echo stripslashes($slide['title']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                    <div class="thumb-controls">
                        <a class="slider-thumb-left" href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
                        <a class="slider-thumb-right" href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        
        <?php } elseif ($type == 'grid') { ?>
            <?php
            $margin = in_array(intval($column_gap), array(0, 10, 15, 20, 25, 30)) ? intval($column_gap) : 20;
            $item_class = ' col-' . (12 / intval($column_mb)) . ' col-md-4 col-lg-' . (12 / intval($column));
            ?>
            <div class="image-grid d-flex w-100">
                <div class="row row-flex-<?php echo $margin; ?>">
                    <?php if ($kbw_slider): ?>
                        <?php $i = 0;
                        foreach ($kbw_slider as $slide): $i++; ?>
                            <div class="item<?php echo $item_class; ?>">
                                <?php if (!empty($slide['link'])) echo '<a href="' . stripslashes($slide['link']) . '">'; ?>
                                <img src="<?php echo kbw_wp_img_src($slide['id'], $thumbnail) ?>" class="mb-2" alt="<?php echo stripslashes($slide['title']) ?>" title="<?php echo stripslashes($slide['title']) ?>"/>
                                <span class="mask"></span>
                                <?php if (!empty($slide['link'])) echo '</a>'; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        
        <?php } elseif ($type == 'flickity') {
            wp_enqueue_script('flickity');
            $random_id = rand(); ?>

            <div class="kbwFlickity flickity-enabled is-draggable" tabindex="0">
                <?php if ($kbw_slider) {
                    $i = 0; ?>
                    <?php foreach ($kbw_slider as $slide): $i++; ?>
                        <div class="slide-item  item<?php echo $i; ?> col-md-6 col-sm-12 col-xs-12">
                            <div class="post-image">
                                <?php if (!empty($slide['link'])) echo '<a href="' . stripslashes($slide['link']) . '">'; ?>
                                <img src="<?php echo kbw_wp_img_src($slide['id'], $thumbnail) ?>" alt="<?php echo stripslashes($slide['title']) ?>" title="<?php echo stripslashes($slide['title']) ?>"/>
                                <span class="mask"></span>
                                <?php if (!empty($slide['link'])) echo '</a>'; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
        
        <?php } ?>
        
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    //Load into Composer
    add_action('init', 'kbw_load_kbw_slider_shortcode', 99);
    function kbw_load_kbw_slider_shortcode()
    {
        if (function_exists('kc_add_map')) {
            kc_add_map(
                array(
                    
                    'kbw_slider' => array(
                        'name' => __('KBW Slider', 'kbw'),
                        'description' => __('', 'kbw'),
                        'category' => __('KBW Framework', 'kbw'),
                        'icon' => 'sl-paper-plane',
                        'title' => __('KBW Slider', 'kbw'),
                        
                        'params' => array(
                            array(
                                'name' => 'id',
                                'label' => __('Slider ID', 'kbw'),
                                'type' => 'text',  // USAGE TEXT TYPE
                                'value' => '', // remove this if you do not need a default content
                                'description' => '',
                            ),
                            array(
                                'name' => 'type',
                                'label' => __('Slider type', 'kbw'),
                                'type' => 'text',  // USAGE TEXT TYPE
                                'value' => 'owl', // remove this if you do not need a default content
                                'description' => '',
                            ),
                            array(
                                'name' => 'slide_theme',
                                'label' => __('Theme', 'kbw'),
                                'type' => 'text',  // USAGE TEXT TYPE
                                'value' => 'default', // remove this if you do not need a default content
                                'description' => '',
                            ),
                            array(
                                'name' => 'thumbnail',
                                'label' => __('Image size', 'kbw'),
                                'type' => 'text',  // USAGE TEXT TYPE
                                'value' => 'full', // remove this if you do not need a default content
                                'description' => '',
                            ),
                            array(
                                'name' => 'navigation',
                                'label' => esc_html__('Navigation', 'kbw'),
                                'type' => 'checkbox',
                                'options' => array(
                                    'true' => 'Yes',
                                ),
                                'value' => 'true', // remove this if you do not need a default content
                                'description' => ''
                            ),
                            array(
                                'name' => 'pagination',
                                'label' => esc_html__('Pagination', 'kbw'),
                                'type' => 'checkbox',
                                'options' => array(
                                    'true' => 'Yes',
                                ),
                                'value' => 'false', // remove this if you do not need a default content
                                'description' => ''
                            ),
                            array(
                                'name' => 'class',
                                'label' => __('Custom class', 'kbw'),
                                'type' => 'text',  // USAGE TEXT TYPE
                                'value' => '', // remove this if you do not need a default content
                                'description' => '',
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
                                'value' => '1', // remove this if you do not need a default content
                                'description' => '',
                                'relation' => array(
                                    'parent' => 'type',
                                    'hide_when' => array('list')
                                )
                            ),
                            array(
                                'name' => 'column_mb',
                                'label' => esc_html__('Column MB', 'kbw'),
                                'type' => 'select',  // USAGE SELECT TYPE
                                'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3'
                                ),
                                'value' => '1', // remove this if you do not need a default content
                                'description' => '',
                                'relation' => array(
                                    'parent' => 'type',
                                    'show_when' => 'grid'
                                ),
                            ),
                            array(
                                'name' => 'column_gap',
                                'label' => esc_html__('Column Gap', 'kbw'),
                                'type' => 'number',  // USAGE TEXT TYPE
                                'value' => '0', // remove this if you do not need a default content
                                'description' => '',
                                'relation' => array(
                                    'parent' => 'type',
                                    'hide_when' => array('list')
                                )
                            )
                        )
                    ), // End of elemnt shortcode
                
                )
            ); // END KC ADD MAP
        } // End if KingComposer
    }
endif;
