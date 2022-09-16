<?php
/**
 *  Some functions
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Custom some hook
 */
add_action('init', 'kbw_custom_hook', 999);
function kbw_custom_hook()
{
    //remove_filter('widget_text_content', 'wpautop'); // To remove auto p tags in text widget.
    //remove_action('add_meta_boxes', 'kbw_add_sidebar_metabox');
    //remove_action('manage_posts_custom_column', 'kbw_columns_content');
    //remove_filter('manage_posts_columns', 'kbw_columns_head');
    
    //Fix Notice: ob_end_flush(): failed to send buffer of zlib output compression (1) - with KingComposer
    if (class_exists('KingComposer')) {
        remove_action('shutdown', 'wp_ob_end_flush_all', 1);
    }
}


/*------------[ Meta ]-------------*/
if (!function_exists('kbw_meta')) {
    function kbw_meta()
    {
        global $post;
        $kbw_favicon = kbw2_get_option('favicon'); ?>
        
        <?php
        if ($kbw_favicon) { ?>
            <link rel="icon" href="<?php echo esc_url($kbw_favicon); ?>" type="image/x-icon"/>
        <?php } elseif (function_exists('has_site_icon') && has_site_icon()) { ?>
            <?php printf('<link rel="icon" href="%s" sizes="32x32" />', esc_url(get_site_icon_url(32))); ?>
            <?php sprintf('<link rel="icon" href="%s" sizes="192x192" />', esc_url(get_site_icon_url(192))); ?>
        <?php } ?>
        
        <?php
        if (kbw2_get_option('responsive')) { ?>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <?php }
    }
}
//Display necessary tags in the <head> section.


/*------------[ Head ]-------------*/
if (!function_exists('kbw_head')) {
    add_action('wp_head', 'kbw_head');
    function kbw_head()
    { ?>

        <script type="text/javascript">
            /* <![CDATA[ */
            var fb_app_id = "<?php echo (kbw_get_option('facebook_app_id')) ? (kbw_get_option('facebook_app_id')) : '1524800134509668'; ?>";
            var kbw_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            /* ]]> */
        </script>
        <?php echo htmlspecialchars_decode(kbw_get_option('kbw_header_code')); //Custom Header Code
        ?>
    
    <?php }
}

/*------------[ footer ]-------------*/
add_action('wp_footer', 'kbw_footer');
if (!function_exists('kbw_footer')) {
    //Display the analytics code in the footer.
    function kbw_footer()
    {
        echo kbw_get_option('kbw_footer_code') ? htmlspecialchars_decode(kbw_get_option('kbw_footer_code')) : '';
    }
}


/**
 * Hook header footer
 */
add_action('kbw_after_footer', 'kbw_promotion_modal');
if (!function_exists('kbw_promotion_modal')) {
    function kbw_promotion_modal()
    {
    
    }
}

add_action('kbw_before_footer', 'kbw_before_footer_html');
function kbw_before_footer_html()
{
    //echo do_shortcode('[kbw_load_option id="footer_html" editor="0"]');
}


/*------------[ Copyrights ]-------------*/
//do something


/*------------[ Ganeral ]-------------*/
//Redirect page contact form 7
add_action('wp_footer', 'kbw_custom_cf7_wp_footer');
function kbw_custom_cf7_wp_footer()
{
    global $post;
    
    if (is_single() || is_home() || is_front_page()) { ?>

        <script type="text/javascript">
            document.addEventListener('wpcf7mailsent', function (event) {
                if ('654' === event.detail.contactFormId) { // Sends sumissions on form 105 to the first thank you page
                    //location = '<?php the_permalink(get_the_ID()); ?>';
                    setTimeout(function () {
                        alert('Đăng ký thành công!');
                        //$('.book-wrapper').removeClass('in').hide();
                    }, 2000);
                } else { // Sends submissions on all unaccounted for forms to the third thank you page
                    //location = '<?php the_permalink(get_the_ID()); ?>';
                }
            }, false);
        </script>
    
    <?php } ?>
    <?php
}


/**
 * Custom gallery shordcode for light-gallery
 */
add_shortcode('gallery', 'kbw_lightgallery_gallery_shortcode');
/**
 * Builds the Gallery shortcode output.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @staticvar int $instance
 *
 * @param array $attr {
 *     Attributes of the gallery shortcode.
 *
 * @type string $order Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
 * @type string $orderby The field to use when ordering the images. Default 'menu_order ID'.
 *                                    Accepts any valid SQL ORDERBY statement.
 * @type int $id Post ID.
 * @type string $itemtag HTML tag to use for each image in the gallery.
 *                                    Default 'dl', or 'figure' when the theme registers HTML5 gallery support.
 * @type string $icontag HTML tag to use for each image's icon.
 *                                    Default 'dt', or 'div' when the theme registers HTML5 gallery support.
 * @type string $captiontag HTML tag to use for each image's caption.
 *                                    Default 'dd', or 'figcaption' when the theme registers HTML5 gallery support.
 * @type int $columns Number of columns of images to display. Default 3.
 * @type string|array $size Size of the images to display. Accepts any valid image size, or an array of width
 *                                    and height values in pixels (in that order). Default 'thumbnail'.
 * @type string $ids A comma-separated list of IDs of attachments to display. Default empty.
 * @type string $include A comma-separated list of IDs of attachments to include. Default empty.
 * @type string $exclude A comma-separated list of IDs of attachments to exclude. Default empty.
 * @type string $link What to link each image to. Default empty (links to the attachment page).
 *                                    Accepts 'file', 'none'.
 * }
 * @return string HTML content to display gallery.
 */
function kbw_lightgallery_gallery_shortcode($attr)
{
    $post = get_post();
    
    static $instance = 0;
    $instance++;
    
    if (!empty($attr['ids'])) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if (empty($attr['orderby'])) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }
    
    /**
     * Filters the default gallery shortcode output.
     *
     * If the filtered output isn't empty, it will be used instead of generating
     * the default gallery template.
     *
     * @since 2.5.0
     * @since 4.2.0 The `$instance` parameter was added.
     *
     * @see gallery_shortcode()
     *
     * @param string $output The gallery output. Default empty.
     * @param array $attr Attributes of the gallery shortcode.
     * @param int $instance Unique numeric ID of this gallery shortcode instance.
     */
    $output = apply_filters('post_gallery', '', $attr, $instance);
    if ($output != '') {
        return $output;
    }
    
    $html5 = current_theme_supports('html5', 'gallery');
    $atts = shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post ? $post->ID : 0,
        'itemtag' => $html5 ? 'figure' : 'dl',
        'icontag' => $html5 ? 'div' : 'dt',
        'captiontag' => $html5 ? 'figcaption' : 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => '',
        'link' => ''
    ), $attr, 'gallery');
    
    $id = intval($atts['id']);
    
    if (!empty($atts['include'])) {
        $_attachments = get_posts(array('include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby']));
        
        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif (!empty($atts['exclude'])) {
        $attachments = get_children(array('post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby']));
    } else {
        $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby']));
    }
    
    if (empty($attachments)) {
        return '';
    }
    
    if (is_feed()) {
        $output = "\n";
        foreach ($attachments as $att_id => $attachment) {
            $output .= wp_get_attachment_link($att_id, $atts['size'], true) . "\n";
        }
        return $output;
    }
    
    $itemtag = tag_escape($atts['itemtag']);
    $captiontag = tag_escape($atts['captiontag']);
    $icontag = tag_escape($atts['icontag']);
    $valid_tags = wp_kses_allowed_html('post');
    if (!isset($valid_tags[$itemtag])) {
        $itemtag = 'dl';
    }
    if (!isset($valid_tags[$captiontag])) {
        $captiontag = 'dd';
    }
    if (!isset($valid_tags[$icontag])) {
        $icontag = 'dt';
    }
    
    $columns = intval($atts['columns']);
    $itemwidth = $columns > 0 ? floor(100 / $columns) : 100;
    $float = is_rtl() ? 'right' : 'left';
    
    $selector = "gallery-{$instance}";
    
    $gallery_style = '';
    
    /**
     * Filters whether to print default gallery styles.
     *
     * @since 3.1.0
     *
     * @param bool $print Whether to print default gallery styles.
     *                    Defaults to false if the theme supports HTML5 galleries.
     *                    Otherwise, defaults to true.
     */
    if (apply_filters('use_default_gallery_style', !$html5)) {
        $gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>\n\t\t";
    }
    
    $size_class = sanitize_html_class($atts['size']);
    //$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    
    //hkcustom
    $gallery_div = "<div id='$selector' class='kbw-lightgallery gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    
    /**
     * Filters the default gallery shortcode CSS styles.
     *
     * @since 2.5.0
     *
     * @param string $gallery_style Default CSS styles and opening HTML div container
     *                              for the gallery shortcode output.
     */
    $output = apply_filters('gallery_style', $gallery_style . $gallery_div);
    
    $i = 0;
    foreach ($attachments as $id => $attachment) {
        
        $attr = (trim($attachment->post_excerpt)) ? array('aria-describedby' => "$selector-$id") : '';
        if (!empty($atts['link']) && 'file' === $atts['link']) {
            $image_output = wp_get_attachment_link($id, $atts['size'], false, false, false, $attr);
        } elseif (!empty($atts['link']) && 'none' === $atts['link']) {
            $image_output = wp_get_attachment_image($id, $atts['size'], false, $attr);
        } else {
            $image_output = wp_get_attachment_link($id, $atts['size'], true, false, false, $attr);
        }
        $image_meta = wp_get_attachment_metadata($id);
        
        $orientation = '';
        if (isset($image_meta['height'], $image_meta['width'])) {
            $orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';
        }
        $output .= "<{$itemtag} class='gallery-item'>";
        
        //hkcustom
        $thumb = ($columns != 1) ? 'kbw-thumbnail' : 'full';
        $img_meta = wp_get_attachment_metadata($id);
        $sub_html = (!empty($attachment->post_excerpt)) ? $attachment->post_excerpt : ((isset($img_meta) && !empty($img_meta['image_meta']['caption'])) ? $img_meta['image_meta']['caption'] : '');
        $image_output = '<a class="lg-selector" href="' . wp_get_attachment_image_url($id, 'full') . '" data-responsive="" data-src="" data-sub-html="' . wptexturize($sub_html) . '"><img src="' . wp_get_attachment_image_url($id, $thumb) . '" alt="' . wptexturize($attachment->post_excerpt) . '" /></a>';
        
        $output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
        if ($captiontag && trim($attachment->post_excerpt)) {
            $output .= "
				<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if (!$html5 && $columns > 0 && ++$i % $columns == 0) {
            $output .= '<br style="clear: both" />';
        }
    }
    
    if (!$html5 && $columns > 0 && $i % $columns !== 0) {
        $output .= "
			<br style='clear: both' />";
    }
    
    $output .= "
		</div>\n";
    
    return $output;
}


/*------------[ AJAX ]-------------*/
add_action('wp_ajax_get_data_post', 'kbw_get_data_post');
add_action('wp_ajax_nopriv_get_data_post', 'kbw_get_data_post');
function kbw_get_data_post()
{
    global $wpdb, $post;
    
    if (!empty($_POST['post_id'])) {
        $post_id = intval($_POST['post_id']);
        if ($post_id > 0) {
            // get the post
            $thispost = get_post($post_id);
            
            // check if post exists
            if (!is_object($thispost)) {
                echo 'There is no post with the ID ' . $post_id;
                die();
            }
            echo '<div class="p-2 p-md-4 position-relative">';
            echo '<h2 class="mt-0 mb-4">' . $thispost->post_title . '</h2>';
            echo '<a href="javascript: void(0);" class="close-popup close-1"><i class="fa fa-close"></i></a>';
            echo do_shortcode(wpautop($thispost->post_content));
            echo '<a href="javascript: void(0);" class="close-popup close-2">' . __('Close', 'kbw') . '</a>';
            echo '</div>';
        }
    }
    exit();
}
