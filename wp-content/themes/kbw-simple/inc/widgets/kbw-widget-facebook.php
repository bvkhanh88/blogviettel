<?php
/*-----------------------------------------------------------------------------------
	Widget Name: KBW Facebook
	Version: 1.0
-----------------------------------------------------------------------------------*/

add_action('widgets_init', 'kbw_register_facebook_widget_box');
function kbw_register_facebook_widget_box()
{
    register_widget('kbw_facebook_widget');
}

class kbw_facebook_widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array('classname' => 'facebook-widget');
        $control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'kbw-facebook-widget');
        parent::__construct(
            'kbw-facebook-widget',
            sprintf(__('%sFacebook', 'kbw'), 'KBW '),
            array('description' => __('Display Facebook Widget', 'kbw'))
        );
    }
    
    public function form($instance)
    {
        $defaults = array(
            'title' => __('Find us on Facebook', 'kbw'),
            'height' => 250
        );
        $instance = wp_parse_args((array)$instance, $defaults);
        $title = isset($instance['title']) ? $instance['title'] : __('Find us on Facebook', 'kbw');
        $height = !empty($instance['height']) ? $instance['height'] : 350;
        $fpage_url = !empty($instance['page_url']) ? $instance['page_url'] : '';
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kbw') ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" class="widefat" value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('page_url'); ?>"><?php _e('Page URL :', 'tie') ?></label>
            <input type="text" name="<?php echo $this->get_field_name('page_url'); ?>" id="<?php echo $this->get_field_id('page_url'); ?>" class="widefat" value="<?php echo $fpage_url; ?>"/>
        </p>
        <p style="display: none;">
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'kbw') ?></label>
            <input type="number" name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" class="widefat" value="<?php echo $height; ?>"/>
        </p>
        
        <?php
    }
    
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['page_url'] = strip_tags($new_instance['page_url']);
        $instance['height'] = intval($new_instance['height']);
        return $instance;
    }
    
    public function widget($args, $instance)
    {
        global $before_widget, $after_widget, $before_title, $after_title;
        
        extract($args);
        
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $page_url = $instance['page_url'];
        $height = $instance['height'];
        $protocol = is_ssl() ? 'https' : 'http';
        
        echo $before_widget;
        if ($title) {
            echo $before_title;
            echo $title;
            echo $after_title;
        }
        //echo '<div class="facebook-box"><iframe src="' . $protocol . '://www.facebook.com/plugins/likebox.php?href=' . $page_url . '&amp;width=350&amp;height=' . $height . '&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden;width:350px;height:' . $height . 'px;"></iframe></div>';
        echo '<div class="fb-page" data-href="' . $page_url . '" data-tabs="" data-width="600" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="' . $page_url . '" class="fb-xfbml-parse-ignore"><a href="' . $page_url . '"></a></blockquote></div>';
        echo $after_widget;
    }
}
