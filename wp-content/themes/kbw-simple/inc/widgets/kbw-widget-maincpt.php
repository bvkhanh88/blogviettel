<?php
/*-----------------------------------------------------------------------------------
    Widget Name: KBW Maincpt
    Version: 1.0
-----------------------------------------------------------------------------------*/

// Register widget
add_action('widgets_init', 'kbw_register_maincpt_widget');
function kbw_register_maincpt_widget()
{
    register_widget('kbw_maincpt_widget');
}

class kbw_maincpt_widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'kbw_maincpt_widget',
            sprintf(__('%sMaincpt', 'kbw'), 'KBW '),
            array('description' => __('', 'kbw'))
        );
    }
    
    public function form($instance)
    {
        $defaults = array(
            'post_type' => 'maincpt',
            'taxonomy' => 'maincpt_cat',
            'title_length' => 7,
            'date' => 1,
            'show_thumb' => 1,
            'box_layout' => 'horizontal-small',
            'show_excerpt' => 1,
            'excerpt_length' => 10,
            'type' => 'recent',
        );
        
        $instance = wp_parse_args((array)$instance, $defaults);
        
        $title = isset($instance['title']) ? $instance['title'] : __('Recent Maincpt', 'kbw');
        $post_type = $instance['post_type'];
        $taxonomy = $instance['taxonomy'];
        $term_slug = isset($instance['term_slug']) ? esc_attr($instance['term_slug']) : '';
        $location_slug = isset($instance['location_slug']) ? esc_attr($instance['location_slug']) : '';
        $title_length = isset($instance['title_length']) ? intval($instance['title_length']) : 7;
        $qty = isset($instance['qty']) ? intval($instance['qty']) : 5;
        $date = isset($instance['date']) ? esc_attr($instance['date']) : 1;
        $show_thumb = isset($instance['show_thumb']) ? esc_attr($instance['show_thumb']) : 1;
        $box_layout = $instance['box_layout'];
        $show_excerpt = isset($instance['show_excerpt']) ? esc_attr($instance['show_excerpt']) : 0;
        $excerpt_length = isset($instance['excerpt_length']) ? esc_attr($instance['excerpt_length']) : 10;
        $type = $instance['type'];
        
        $all_terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => 0,
        ));
        $all_locations = get_terms(array(
            'taxonomy' => 'location',
            'hide_empty' => 1,
        ));
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kbw'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p class="choose-post-type">
            <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:', 'kbw'); ?>
                <input type="text" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" value="<?php echo esc_attr($post_type); ?>"/>
            </label>
        </p>
        <p class="choose-taxonomy">
            <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:', 'kbw'); ?>
                <input type="text" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>" value="<?php echo esc_attr($taxonomy); ?>"/>
            </label>
        </p>
        <p>
            <?php $term_slug = (strpos($term_slug, ',') !== false) ? explode(',', $term_slug) : array($term_slug); ?>
            <label for="<?php echo $this->get_field_id('term_slug'); ?>"><?php _e('Maincpt Cat:', 'kbw') ?></label>
            <select multiple="multiple" id="<?php echo $this->get_field_id('term_slug'); ?>[]" name="<?php echo $this->get_field_name('term_slug'); ?>[]">
                <option value="" <?php if (is_array($term_slug) && in_array('', $term_slug)) echo ' selected="selected"'; ?>>
                    All
                </option>
                <?php if (!is_wp_error($all_terms)) foreach ($all_terms as $term) { ?>
                    <option value="<?php echo $term->slug; ?>" <?php if (is_array($term_slug) && in_array($term->slug, $term_slug)) echo ' selected="selected"'; ?>><?php echo $term->name; ?></option>
                <?php } ?>
            </select>
        </p>
        
        <?php
        if (!empty($all_locations) && !is_wp_error($all_locations)) { ?>
            <p>
                <?php $location_slug = (strpos($location_slug, ',') !== false) ? explode(',', $location_slug) : array($location_slug); ?>
                <label for="<?php echo $this->get_field_id('location_slug'); ?>"><?php _e('Location:', 'kbw') ?></label>
                <select id="<?php echo $this->get_field_id('location_slug'); ?>[]" name="<?php echo $this->get_field_name('location_slug'); ?>[]">
                    <option value="" <?php if (is_array($location_slug) && in_array('', $location_slug)) echo ' selected="selected"'; ?>>
                        All
                    </option>
                    <?php if (!is_wp_error($all_locations)) foreach ($all_locations as $location) { ?>
                        <option value="<?php echo $location->slug; ?>" <?php if (is_array($location_slug) && in_array($location->slug, $location_slug)) echo ' selected="selected"'; ?>><?php echo $location->name; ?></option>
                    <?php } ?>
                </select>
            </p>
        <?php } ?>

        <p>
            <label for="<?php echo $this->get_field_id('qty'); ?>"><?php _e('Number of Posts to show', 'kbw'); ?></label>
            <input type="number" id="<?php echo $this->get_field_id('qty'); ?>" name="<?php echo $this->get_field_name('qty'); ?>" min="1" step="1" value="<?php echo esc_attr($qty); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_length'); ?>"><?php _e('Title Length:', 'kbw'); ?>
                <input type="number" id="<?php echo $this->get_field_id('title_length'); ?>" name="<?php echo $this->get_field_name('title_length'); ?>" min="1" step="1" value="<?php echo esc_attr($title_length); ?>"/>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("show_thumb"); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_thumb"); ?>" name="<?php echo $this->get_field_name("show_thumb"); ?>" value="1" <?php checked(1, $show_thumb, true); ?> />
                <?php _e('Show Thumbnails', 'kbw'); ?>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('box_layout'); ?>"><?php _e('Layout:', 'kbw'); ?></label>
            <select id="<?php echo $this->get_field_id('box_layout'); ?>" name="<?php echo $this->get_field_name('box_layout'); ?>">
                <option value="horizontal-small" <?php selected($box_layout, 'horizontal-small', true); ?>><?php _e('Horizontal', 'kbw'); ?></option>
                <option value="vertical-small" <?php selected($box_layout, 'vertical-small', true); ?>><?php _e('Vertical', 'kbw'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("date"); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>" value="1" <?php checked(1, $date, true); ?> />
                <?php _e('Show post date', 'kbw'); ?>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("show_excerpt"); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_excerpt"); ?>" name="<?php echo $this->get_field_name("show_excerpt"); ?>" value="1" <?php checked(1, $show_excerpt, true); ?> />
                <?php _e('Show excerpt', 'kbw'); ?>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt Length:', 'kbw'); ?>
                <input id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="number" min="1" step="1" value="<?php echo esc_attr($excerpt_length); ?>"/>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Show Type:', 'kbw'); ?></label>
            <select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
                <option value="recent" <?php selected($type, 'recent', true); ?>><?php _e('Recent', 'kbw'); ?></option>
                <option value="most_viewed" <?php selected($type, 'most_viewed', true); ?>><?php _e('Most Viewed', 'kbw'); ?></option>
                <option value="featured" <?php selected($type, 'featured', true); ?>><?php _e('Featured', 'kbw'); ?></option>
                <option value="popular" <?php selected($type, 'popular', true); ?>><?php _e('Popular', 'kbw'); ?></option>
            </select>
        </p>
    
    <?php }
    
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = $new_instance['post_type'];
        $instance['taxonomy'] = $new_instance['taxonomy'];
        $instance['term_slug'] = isset($new_instance['term_slug']) ? implode(',', $new_instance['term_slug']) : '';
        $instance['location_slug'] = isset($new_instance['location_slug']) ? implode(',', $new_instance['location_slug']) : '';
        $instance['title_length'] = intval($new_instance['title_length']);
        $instance['qty'] = intval($new_instance['qty']);
        $instance['date'] = isset($new_instance['date']) ? intval($new_instance['date']) : 0;
        $instance['show_thumb'] = isset($new_instance['show_thumb']) ? intval($new_instance['show_thumb']) : 0;
        $instance['box_layout'] = $new_instance['box_layout'];
        $instance['show_excerpt'] = isset($new_instance['show_excerpt']) ? intval($new_instance['show_excerpt']) : 0;
        $instance['excerpt_length'] = intval($new_instance['excerpt_length']);
        $instance['type'] = $new_instance['type'];
        return $instance;
    }
    
    public function widget($args, $instance)
    {
        global $before_widget, $after_widget, $before_title, $after_title;
        
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $post_type = $instance['post_type'];
        $taxonomy = $instance['taxonomy'];
        $term_slug = $instance['term_slug'];
        $location_slug = $instance['location_slug'];
        $qty = (int)$instance['qty'];
        $title_length = $instance['title_length'];
        $date = $instance['date'];
        $show_thumb = (int)$instance['show_thumb'];
        $box_layout = isset($instance['box_layout']) ? $instance['box_layout'] : 'horizontal-small';
        $show_excerpt = $instance['show_excerpt'];
        $excerpt_length = $instance['excerpt_length'];
        $type = isset($instance['type']) ? $instance['type'] : 'recent';
        
        echo $before_widget;
        if (!empty($title)) echo $before_title . $title . $after_title;
        echo self::kbw_get_customposts($post_type, $taxonomy, $term_slug, $location_slug, $title_length, $qty, $date, $show_thumb, $box_layout, $show_excerpt, $excerpt_length, $type);
        echo $after_widget;
    }
    
    public function kbw_get_customposts($post_type, $taxonomy, $term_slug, $location_slug, $title_length, $qty, $date, $show_thumb, $box_layout, $show_excerpt, $excerpt_length, $type)
    {
        global $post, $wp_post_types;
        $original_post = $post;
        
        $no_image = ($show_thumb) ? '' : ' no-thumb';
        if ('horizontal-small' === $box_layout) {
            $thumbnail = 'kbw-small';
            $open_li_item = '<li class="post-box horizontal-small horizontal-container' . $no_image . '"><div class="horizontal-container-inner">';
            $close_li_item = '</div></li>';
        } else {
            $thumbnail = 'kbw-small';
            $open_li_item = '<li class="post-box vertical-small' . $no_image . '">';
            $close_li_item = '</li>';
        }
        
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $qty,
            'no_found_rows' => true,
            'ignore_sticky_posts' => true
        );
        
        if ($term_slug != '') $args[$taxonomy] = $term_slug;
        
        if ($type == 'most_viewed') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'kbw_views';
        }
        
        //kbwcustom - kbwdev
        if ($location_slug != '') {
            $meta_query = array();
            $meta_query[] = array(
                'key' => $post_type . '_city',
                'value' => get_term_by('slug', $location_slug, 'location')->term_id,
            );
            $args['meta_query'] = $meta_query;
        }
        
        $myposts = new WP_Query($args);
        
        echo '<ul class="kbw-posts advanced-recent-posts">';
        if ($myposts->have_posts()) : while ($myposts->have_posts()): $myposts->the_post();
            $show_price = false;
            if (kbw_isWooCommerce() && $post_type == 'product') {
                global $product;
                $price = $product->get_price();
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
                $saving_price = $sale_price ? $regular_price - $sale_price : 0;
                $show_price = kbw_display_price_html($regular_price, $sale_price);
            }
            
            echo $open_li_item;
            ?>
            
            <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumbnail != 'none' && $show_thumb == 1) : ?>
                <div class="post-thumbnail post-img">
                    <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php the_post_thumbnail($thumbnail); ?>
                        <span class="fa overlay-icon"></span>
                    </a>
                </div><!-- post-thumbnail /-->
            <?php endif; ?>
            <div class="post-data entry">
                <div class="post-title">
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo get_the_title(); ?></a>
                </div>

                <div class="post-info">
                    <?php if ($date == 1 || $type === 'most_viewed') : ?>
                        <?php if ($type != 'most_viewed') : ?>
                            <span class="thetime updated"><i class="fa fa-clock-o"></i> <?php the_time(get_option('date_format')); ?></span>
                        <?php else: ?>
                            <span class="post-views"><i class="fa fa-eye"></i> <?php echo number_format(get_post_meta(get_the_ID(), 'kbw_views', true)); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo $show_price ? $show_price : ''; ?>
                </div><!--.post-info-->
                
                <?php if ($show_excerpt == 1) : ?>
                    <div class="post-excerpt">
                        <p><?php echo kbw_truncate(get_the_excerpt(), $excerpt_length, 'words'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php echo $close_li_item; ?>
        <?php endwhile;endif;
        $post = $original_post;
        wp_reset_query();
        echo '</ul>' . "\r\n";
    }
}
