<?php
/*-----------------------------------------------------------------------------------
	Widget Name: KBW Posts
	Version: 1.0
-----------------------------------------------------------------------------------*/

// Register widget
add_action('widgets_init', 'kbw_register_posts_widget');
function kbw_register_posts_widget()
{
    register_widget('kbw_posts_widget');
}

class kbw_posts_widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'kbw_posts_widget',
            sprintf(__('%sPosts', 'kbw'), 'KBW '),
            array('description' => __('Display posts', 'kbw'))
        );
    }
    
    public function form($instance)
    {
        $defaults = array(
            'post_type' => 'post',
            'cats_id' => '0',
            'title_length' => 7,
            'date' => 1,
            'show_thumb' => 1,
            'box_layout' => 'horizontal-small',
            'show_excerpt' => 1,
            'excerpt_length' => 10,
            'type' => 'recent',
        );
        $instance = wp_parse_args((array)$instance, $defaults);
        $title = isset($instance['title']) ? $instance['title'] : __('Recent Posts', 'kbw');
        $post_type = $instance['post_type'];
        $cats_id = isset($instance['cats_id']) ? esc_attr($instance['cats_id']) : '';
        $title_length = isset($instance['title_length']) ? intval($instance['title_length']) : 7;
        $qty = isset($instance['qty']) ? intval($instance['qty']) : 5;
        $date = isset($instance['date']) ? esc_attr($instance['date']) : 1;
        $show_thumb = isset($instance['show_thumb']) ? esc_attr($instance['show_thumb']) : 1;
        $box_layout = $instance['box_layout'];
        $show_excerpt = isset($instance['show_excerpt']) ? esc_attr($instance['show_excerpt']) : 0;
        $excerpt_length = isset($instance['excerpt_length']) ? esc_attr($instance['excerpt_length']) : 10;
        $type = $instance['type'];
        
        $categories_obj = get_categories();
        $categories = array();
        foreach ($categories_obj as $pn_cat) {
            $categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kbw'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p id="kbw_choose_category" class="kbw-toogle post">
            <?php $cats_id = (strpos($cats_id, ',') !== false) ? explode(',', $cats_id) : array($cats_id); ?>
            <label for="<?php echo $this->get_field_id('cats_id'); ?>"><?php _e('Category:', 'kbw') ?></label>
            <select multiple="multiple" id="<?php echo $this->get_field_id('cats_id'); ?>[]" name="<?php echo $this->get_field_name('cats_id'); ?>[]">
                <option value="0" <?php if (is_array($cats_id) && in_array(0, $cats_id)) echo ' selected="selected"'; ?>>
                    All
                </option>
                <?php foreach ($categories as $key => $option) { ?>
                    <option value="<?php echo $key ?>" <?php if (is_array($cats_id) && in_array($key, $cats_id)) echo ' selected="selected"'; ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('qty'); ?>"><?php _e('Number of Posts to show', 'kbw'); ?></label>
            <input id="<?php echo $this->get_field_id('qty'); ?>" name="<?php echo $this->get_field_name('qty'); ?>" type="number" min="1" step="1" value="<?php echo esc_attr($qty); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_length'); ?>"><?php _e('Title Length:', 'kbw'); ?>
                <input id="<?php echo $this->get_field_id('title_length'); ?>" name="<?php echo $this->get_field_name('title_length'); ?>" type="number" min="1" step="1" value="<?php echo esc_attr($title_length); ?>"/>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("show_thumb"); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_thumb"); ?>" name="<?php echo $this->get_field_name("show_thumb"); ?>" value="1" <?php checked(1, $show_thumb, true); ?> />
                <?php _e('Show Thumbnails', 'kbw'); ?>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('box_layout'); ?>"><?php _e('Posts layout:', 'kbw'); ?></label>
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
        $instance['cats_id'] = implode(',', $new_instance['cats_id']);
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
        $cats_id = $instance['cats_id'];
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
        echo self::kbw_get_posts($cats_id, $title_length, $qty, $date, $show_thumb, $box_layout, $show_excerpt, $excerpt_length, $type);
        echo $after_widget;
    }
    
    public function kbw_get_posts($cats_id, $title_length, $qty, $date, $show_thumb, $box_layout, $show_excerpt, $excerpt_length, $type)
    {
        global $post;
        $original_post = $post;
        
        $no_image = ($show_thumb) ? '' : ' no-thumb';
        if ('horizontal-small' === $box_layout) {
            $thumbnail = 'kbw-small';
            $open_li_item = '<li class="post-box horizontal-small horizontal-container' . $no_image . '"><div class="horizontal-container-inner">';
            $close_li_item = '</div></li>';
        } else {
            $thumbnail = 'kbw-thumbnail';
            $open_li_item = '<li class="post-box vertical-small' . $no_image . '">';
            $close_li_item = '</li>';
        }
        
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $qty,
            'no_found_rows' => true,
            'ignore_sticky_posts' => true
        );
        
        if ($cats_id != 0) {
            if (strpos($cats_id, ',') !== false) {
                $cat_arr = explode(',', $cats_id);
                $args['category__in'] = $cat_arr;
            } else {
                $args['cat'] = $cats_id;
            }
        }
        
        if ($type == 'most_viewed') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'kbw_views';
        }
        if ($type == 'featured') {
            $meta_query = array();
            $meta_query[] = array(
                'key' => 'kbw_featured',
                'value' => 1,
            );
            $args['meta_query'] = $meta_query;
        }
        
        $myposts = new WP_Query($args);
        
        echo '<ul class="kbw-posts advanced-recent-posts">';
        if ($myposts->have_posts()) : while ($myposts->have_posts()): $myposts->the_post(); ?>
            <?php echo $open_li_item; ?>
            
            <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumbnail != 'none' && $show_thumb == 1) : ?>
                <div class="post-thumbnail post-img">
                    <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php the_post_thumbnail($thumbnail); ?>
                        <span class="fa overlay-icon"></span> </a>
                </div><!-- post-thumbnail /-->
            <?php endif; ?>
            <div class="post-data entry">
                <div class="post-title">
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo get_the_title(); ?></a>
                </div>
                <?php if ($date == 1 || $type === 'most_viewed') : ?>
                    <div class="post-info">
                        <?php if ($type != 'most_viewed') : ?>
                            <span class="thetime updated"><i class="fa fa-clock-o"></i> <?php the_time(get_option('date_format')); ?></span>
                        <?php else: ?>
                            <span class="post-views"><i class="fa fa-eye"></i> <?php echo number_format(get_post_meta(get_the_ID(), 'kbw_views', true)); ?></span>
                        <?php endif; ?>
                    </div><!--.post-info-->
                <?php endif; ?>
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
