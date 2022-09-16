<?php
/**
 *  Widgets
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

/**
 * ENABLE WIDGETIZED SIDEBAR
 */
if (function_exists('register_sidebar')) {
    add_action('widgets_init', 'kbw_register_sidebars', 10);
    function kbw_register_sidebars()
    {
        // Default sidebar
        register_sidebar(array(
            'name' => __('Sidebar', 'kbw'),
            'description' => __('Default sidebar.', 'kbw'),
            'id' => 'sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span class="inline-title">',
            'after_title' => '</span></h3>',
        ));

        // Footer1 Sidebar
        register_sidebar(array(
            'name' => __('Footer 1', 'kbw'),
            'description' => __('Footer 1', 'kbw'),
            'id' => 'footer-1',
            'before_widget' => '<div id="%1$s" class="widget widget-f1 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        // Footer2 Sidebar
        register_sidebar(array(
            'name' => __('Footer 2', 'kbw'),
            'description' => __('Footer 2', 'kbw'),
            'id' => 'footer-2',
            'before_widget' => '<div id="%1$s" class="widget widget-f2 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        // Footer3 Sidebar
        register_sidebar(array(
            'name' => __('Footer 3', 'kbw'),
            'description' => __('Footer 3', 'kbw'),
            'id' => 'footer-3',
            'before_widget' => '<div id="%1$s" class="widget widget-f3 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        // Footer4 Sidebar
        register_sidebar(array(
            'name' => __('Footer 4', 'kbw'),
            'description' => __('Footer 4', 'kbw'),
            'id' => 'footer-4',
            'before_widget' => '<div id="%1$s" class="widget widget-f4 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}

function kbw_get_sidebars()
{
    global $wp_registered_sidebars;
    $hidden_sidebars = array('sidebar', 'shop-sidebar', 'product-sidebar');
    $all_sidebar = array();
    foreach ($wp_registered_sidebars as $sidebar) {
        if (!in_array($sidebar['id'], $hidden_sidebars)) {
            if (!empty($sidebar['id'])) $all_sidebar[strtolower($sidebar['id'])] = $sidebar['name'];
        }
    }
    return $all_sidebar;
    //return array( 'sidebar'=>'Sidebar', 'top-footer'=> 'Top Footer' );
}


## Custom Widgets ------------------------------------------------------------
//locate_template('inc/widgets/kbw-widget-facebook.php', true, true);
locate_template('inc/widgets/kbw-widget-posts.php', true, true);
//locate_template('inc/widgets/kbw-widget-maincpt.php', true, true);
