<?php
/**
 * kabiweb blog function
 *
 * @package WordPress
 * @subpackage kabiweb
 * @since kabiweb 2.0
 *
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 */

// Paging Navigation
if (!function_exists('kbw_paging_navigation')) {
    function kbw_paging_navigation($myquery = false)
    {
        kbw_posts_pagination($myquery);
    }
}

// Paging Load More
if (!function_exists('kbw_paging_load_more')) {
    function kbw_paging_load_more($myquery = false)
    {
        global $wp_query;
        
        if (empty($myquery)) {
            $link = get_next_posts_page_link($wp_query->max_num_pages);
        } else {
            $link = get_next_posts_page_link($myquery->max_num_pages);
        }
        if (empty($link)) return;
        ?>

        <div class="paging-navigation clearfix text-center wow fadeInUp" data-wow-delay="0.3s">
            <button data-href="<?php echo esc_url($link); ?>" type="button" data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php esc_html_e('Loading...', 'kbw'); ?>" class="kbw-load-more"><?php esc_html_e('Load More', 'kbw'); ?></button>
        </div>
        
        <?php
    }
}

// Paging Infinite Scroll
if (!function_exists('kbw_paging_infinite_scroll')) {
    function kbw_paging_infinite_scroll($myquery = false)
    {
        kbw_posts_pagination($myquery);
    }
}