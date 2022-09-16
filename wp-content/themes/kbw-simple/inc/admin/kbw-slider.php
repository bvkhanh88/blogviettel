<?php
if (!function_exists('kbw_slider_register')) {
    add_action('init', 'kbw_slider_register');
    function kbw_slider_register()
    {
        $name = 'KBW Sliders';
        $singular_name = 'Slider';
        $slug = 'slider';
        $content_type = 'kbw_slider';
        
        $labels = array(
            'name' => $name,
            'singular_name' => $singular_name,
            'all_items' => __('All', 'kbw'),
            'add_new_item' => __('Add new', 'kbw'),
            'add_new' => __('Add new', 'kbw'),
        );
        
        $args = array(
            'labels' => $labels,
            'supports' => array('title'),
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-images-alt', //icon display
            'can_export' => true,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'rewrite' => array('slug' => $slug, 'with_front' => false)
        );
        
        register_post_type($content_type, $args);
    }
}

add_action("admin_init", "kbw_slider_init");
function kbw_slider_init()
{
    //add_meta_box("kbw_slider_config", "Config Slider", "kbw_slider_config", "kbw_slider", "normal", "high");
    add_meta_box("kbw_slider_slides", "KBW Slides", "kbw_slider_slides", "kbw_slider", "normal", "high");
}

function kbw_slider_config()
{
    global $post;
    // Add an nonce field so we can check for it later.
    wp_nonce_field('kbw_inner_slider_config_metabox', 'kbw_inner_slider_config_metabox_nonce');
    
    $slide_type = (get_post_meta($post->ID, 'kbw_slide_type', true)) ? get_post_meta($post->ID, 'kbw_slide_type', true) : '';
    $slide_effect = (get_post_meta($post->ID, 'kbw_slide_effect', true)) ? get_post_meta($post->ID, 'kbw_slide_effect', true) : '';
    $slide_theme = (get_post_meta($post->ID, 'kbw_slide_theme', true)) ? get_post_meta($post->ID, 'kbw_slide_theme', true) : '';
    
    $output_html = '<div class="kbw-metabox kbw-field">';
    $output_html .= '<div class="kbw-label"><label>' . __('Slide Type: ', 'kbw') . '</label></div>';
    $output_html .= '<div class="kbw-input kbw-select">';
    $output_html .= '<select name="kbw_slide_type" id="kbw_slide_type">';
    $output_html .= '<option value="iosslider" ' . selected("iosslider", $slide_type, false) . '>iosSlider</option>';
    $output_html .= '<option value="nivo_slider" ' . selected("nivo_slider", $slide_type, false) . '>Nivo Slider</option>';
    $output_html .= '</select>';
    $output_html .= '</div></div>';
    
    $output_html .= '<div class="kbw-metabox kbw-field">';
    $output_html .= '<div class="kbw-label"><label>' . __('Slide Theme: ', 'kbw') . '</label></div>';
    $output_html .= '<div class="kbw-input kbw-select">';
    $output_html .= '<select name="kbw_slide_theme" id="kbw_slide_theme">';
    $output_html .= '<option value="default">Default</option>';
    $output_html .= '<option value="bar" ' . selected("bar", $slide_theme, false) . '>Bar</option>';
    $output_html .= '<option value="dark" ' . selected("dark", $slide_theme, false) . '>Dark</option>';
    $output_html .= '<option value="light" ' . selected("light", $slide_theme, false) . '>Light</option>';
    $output_html .= '</select>';
    $output_html .= '</div></div>';
    
    $output_html .= '<div class="kbw-metabox kbw-field">';
    $output_html .= '<div class="kbw-label"><label>' . __('Slide Effect: ', 'kbw') . '</label></div>';
    $output_html .= '<div class="kbw-input kbw-select">';
    $output_html .= '<select name="kbw_slide_effect" id="kbw_slide_effect">';
    $output_html .= '<option value="random">Random</option>';
    $output_html .= '<option value="sliceDown" ' . selected("sliceDown", $slide_effect, false) . '>(1) sliceDown</option>';
    $output_html .= '<option value="sliceDownLeft" ' . selected("sliceDownLeft", $slide_effect, false) . '>(2) sliceDownLeft</option>';
    $output_html .= '<option value="sliceUp" ' . selected("sliceUp", $slide_effect, false) . '>(3) sliceUp</option>';
    $output_html .= '<option value="sliceUpLeft" ' . selected("sliceUpLeft", $slide_effect, false) . '>(4) sliceUpLeft</option>';
    $output_html .= '<option value="sliceUpDown" ' . selected("sliceUpDown", $slide_effect, false) . '>(5) sliceUpDown</option>';
    $output_html .= '<option value="sliceUpDownLeft" ' . selected("sliceUpDownLeft", $slide_effect, false) . '>(6) sliceUpDownLeft</option>';
    $output_html .= '<option value="fold" ' . selected("fold", $slide_effect, false) . '>(7) fold</option>';
    $output_html .= '<option value="fade" ' . selected("fade", $slide_effect, false) . '>(8) fade</option>';
    $output_html .= '<option value="slideInRight" ' . selected("slideInRight", $slide_effect, false) . '>(9) slideInRight</option>';
    $output_html .= '<option value="slideInLeft" ' . selected("slideInLeft", $slide_effect, false) . '>(10) slideInLeft</option>';
    $output_html .= '<option value="boxRandom" ' . selected("boxRandom", $slide_effect, false) . '>(11) boxRandom</option>';
    $output_html .= '<option value="boxRain" ' . selected("boxRain", $slide_effect, false) . '>(12) boxRain</option>';
    $output_html .= '<option value="boxRainReverse" ' . selected("boxRainReverse", $slide_effect, false) . '>(13) boxRainReverse</option>';
    $output_html .= '<option value="boxRainGrow" ' . selected("boxRainGrow", $slide_effect, false) . '>(14) boxRainGrow</option>';
    $output_html .= '<option value="boxRainGrowReverse" ' . selected("boxRainGrowReverse", $slide_effect, false) . '>(15) boxRainGrowReverse</option>';
    $output_html .= '</select>';
    $output_html .= '</div></div>';
    
    echo $output_html;
}

//add_action('save_post', 'kbw_save_config');
function kbw_save_config($post_id)
{
    // Check if our nonce is set.
    if (!isset($_POST['kbw_inner_slider_config_metabox_nonce']))
        return $post_id;
    $nonce = $_POST['kbw_inner_slider_config_metabox_nonce'];
    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'kbw_inner_slider_config_metabox'))
        return $post_id;
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    
    // Check the user's permissions.
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return $post_id;
    }
    
    /* OK, its safe for us to save the data now. */
    global $post;
    
    if (!empty($_POST['kbw_slide_type']) && $_POST['kbw_slide_type'] != "") {
        update_post_meta($post->ID, 'kbw_slide_type', $_POST['kbw_slide_type']);
    } else {
        if (isset($post->ID))
            delete_post_meta($post->ID, 'kbw_slide_type');
    }
    
    if (!empty($_POST['kbw_slide_theme']) && $_POST['kbw_slide_theme'] != "") {
        update_post_meta($post->ID, 'kbw_slide_theme', $_POST['kbw_slide_theme']);
    } else {
        if (isset($post->ID))
            delete_post_meta($post->ID, 'kbw_slide_theme');
    }
    
    if (!empty($_POST['kbw_slide_effect']) && $_POST['kbw_slide_effect'] != "") {
        update_post_meta($post->ID, 'kbw_slide_effect', $_POST['kbw_slide_effect']);
    } else {
        if (isset($post->ID))
            delete_post_meta($post->ID, 'kbw_slide_effect');
    }
    
    return '';
}

function kbw_slider_slides()
{
    global $post;
    $slider = '';
    $custom = get_post_custom($post->ID);
    
    if (!empty($custom["kbw_slider"][0]))
        $slider = unserialize($custom["kbw_slider"][0]);
    
    wp_enqueue_media();
    ?>
    <script>
        jQuery(document).ready(function () {
            jQuery(function () {
                jQuery("#kbw-slider-items").sortable({placeholder: "ui-state-highlight"});
            });

            /* Uploading files */
            var kbw_uploader;
            jQuery('#upload_add_slide').bind('click', function (event) {
                event.preventDefault();

                kbw_uploader = wp.media.frames.kbw_uploader = wp.media({
                    title: '<?php _e('Insert Images | Hold CTRL to Multi Select .', 'kbw') ?>',
                    library: {
                        type: 'image'
                    },
                    button: {
                        text: 'Select',
                    },
                    multiple: true
                });

                kbw_uploader.on('select', function () {
                    var selection = kbw_uploader.state().get('selection');

                    selection.map(function (attachment) {
                        attachment = attachment.toJSON();
                        jQuery('#kbw-slider-items').append('<li id="listItem_' + nextCell + '" class="ui-state-default"><div class="widget-content option-item"><div class="slider-img"><img src="' + attachment.url + '" alt=""></div><label for="kbw_slider[' + nextCell + '][title]"><span><?php _e('Slide Title:', 'kbw') ?></span><input id="kbw_slider[' + nextCell + '][title]" name="kbw_slider[' + nextCell + '][title]" value="" type="text" /></label><label for="kbw_slider[' + nextCell + '][link]"><span><?php _e('Slide Link:', 'kbw') ?></span><input id="kbw_slider[' + nextCell + '][link]" name="kbw_slider[' + nextCell + '][link]" value="" type="text" /></label><label for="kbw_slider[' + nextCell + '][caption]"><span class="slide-caption"><?php _e('Slide Caption:', 'kbw') ?></span><textarea name="kbw_slider[' + nextCell + '][caption]" id="kbw_slider[' + nextCell + '][caption]"></textarea></label><input id="kbw_slider[' + nextCell + '][id]" name="kbw_slider[' + nextCell + '][id]" value="' + attachment.id + '" type="hidden" /><a class="del-cat"></a></div></li>');
                        nextCell++;
                    });
                });

                kbw_uploader.open();
            });
        });
    </script>

    <input id="upload_add_slide" type="button" class="button button-large button-primary builder_active" value="<?php _e('Add New Slide', 'kbw') ?>"/>

    <ul id="kbw-slider-items">
        <?php
        $i = 0;
        if (!empty($slider)) {
            foreach ($slider as $slide):
                $i++; ?>
                <li id="listItem_<?php echo $i ?>" class="ui-state-default">
                    <div class="widget-content option-item">
                        <div class="slider-img"><?php echo wp_get_attachment_image($slide['id'], 'kbw-thumbnail'); ?></div>
                        <label for="kbw_slider[<?php echo $i ?>][title]">
                            <span><?php _e('Slide Title:', 'kbw') ?> </span>
                            <input id="kbw_slider[<?php echo $i ?>][title]" name="kbw_slider[<?php echo $i ?>][title]" value="<?php echo stripslashes($slide['title']) ?>" type="text"/>
                        </label>
                        <label for="kbw_slider[<?php echo $i ?>][link]">
                            <span><?php _e('Slide Link:', 'kbw') ?></span>
                            <input id="kbw_slider[<?php echo $i ?>][link]" name="kbw_slider[<?php echo $i ?>][link]" value="<?php echo stripslashes($slide['link']) ?>" type="text"/>
                        </label>
                        <label for="kbw_slider[<?php echo $i ?>][caption]">
                            <span class="slide-caption"><?php _e('Slide Caption:', 'kbw') ?></span>
                            <textarea name="kbw_slider[<?php echo $i ?>][caption]" id="kbw_slider[<?php echo $i ?>][caption]"><?php echo stripslashes($slide['caption']); ?></textarea>
                        </label>

                        <input id="kbw_slider[<?php echo $i ?>][id]" name="kbw_slider[<?php echo $i ?>][id]" value="<?php echo $slide['id'] ?>" type="hidden"/>
                        <a class="del-cat"></a>
                    </div>
                </li>
            <?php endforeach;
        } else {
            echo '<p>' . __('Use the button above to add slides.', 'kbw') . '</p>';
        } ?>
    </ul>
    <script> var nextCell = <?php echo $i + 1 ?>;</script>
    
    <?php
}

add_action('save_post', 'kbw_save_slide');
function kbw_save_slide()
{
    global $post;
    
    if (!empty($_POST['kbw_slider']) && $_POST['kbw_slider'] != "") {
        update_post_meta($post->ID, 'kbw_slider', $_POST['kbw_slider']);
    } else {
        if (isset($post->ID))
            delete_post_meta($post->ID, 'kbw_slider');
    }
}

add_filter("manage_edit-kbw_slider_columns", "kbw_slider_edit_columns");
function kbw_slider_edit_columns($columns)
{
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __('Title', 'kbw'),
        "slides" => __('Number of slides', 'kbw'),
        "id" => __('ID', 'kbw'),
        "date" => __('Date', 'kbw'),
    );
    
    return $columns;
}

add_action("manage_kbw_slider_posts_custom_column", "kbw_slider_custom_columns");
function kbw_slider_custom_columns($column)
{
    global $post;
    
    $original_post = $post;
    
    switch ($column) {
        case "slides":
            $custom_slider_args = array('post_type' => 'kbw_slider', 'p' => $post->ID, 'no_found_rows' => 1);
            $custom_slider = new WP_Query($custom_slider_args);
            while ($custom_slider->have_posts()) {
                $number = 0;
                $custom_slider->the_post();
                $custom = get_post_custom($post->ID);
                if (!empty($custom["kbw_slider"][0])) {
                    $slider = unserialize($custom["kbw_slider"][0]);
                    echo $number = count($slider);
                } else echo 0;
            }
            
            $post = $original_post;
            //wp_reset_query();
            break;
        
        case "id":
            echo $post->ID;
            break;
    }
}
