<?php
//** PAGINATION ====**********=>
if (!function_exists('kbw_pagination')) {
    /**
     * Display the pagination.
     *
     * @param string $pages
     * @param int $range
     */
    function kbw_pagination($pages = '', $range = 3)
    {
        $kbw_options = get_option(KBW_THEME_NAME);
        $kbw_options['kbw_pagenavigation_type'] = 1;
        if (isset($kbw_options['kbw_pagenavigation_type']) && $kbw_options['kbw_pagenavigation_type'] == '1') { // numeric pagination
            the_posts_pagination(array(
                'mid_size' => 5,
                'prev_text' => __('Previous', 'kbw'),
                'next_text' => __('Next', 'kbw'),
            ));
        } else { // traditional or ajax pagination ?>
            <div class="pagination pagination-previous-next">
                <ul>
                    <li class="nav-previous"><?php next_posts_link('<i class="fa fa-angle-left"></i> ' . __('Previous', 'kbw')); ?></li>
                    <li class="nav-next"><?php previous_posts_link(__('Next', 'kbw') . ' <i class="fa fa-angle-right"></i>'); ?></li>
                </ul>
            </div>
            <?php
        }
    }
}


### PAGINATION EXTRA
if (!function_exists('kbw_pagination_extra')) {
    function kbw_pagination_extra($query = false, $num = false)
    {
        ?>
        <div class="pagination kbw-pagination">
            <?php echo kbw_get_pagination_extra($query, $num); ?>
        </div>
        <?php
    }
}


### Function: Page Navigation: Boxed Style Paging
function kbw_get_pagination_extra($query = false, $num = false, $before = '', $after = '')
{
    global $wpdb, $wp_query;
    
    $output_html = '';
    $pagenavi_options = kbw_pagination_extra_init();

    if (!is_single()) {
        if (!empty($query)) {
            $request = $query->request;
            $numposts = $query->found_posts;
            $max_page = $query->max_num_pages;
            $posts_per_page = intval($num);
        } else {
            $request = $wp_query->request;
            $numposts = $wp_query->found_posts;
            $max_page = $wp_query->max_num_pages;
            $posts_per_page = intval(get_query_var('posts_per_page'));
        }

        $paged = intval(get_query_var('paged'));
        $paged_2 = intval(get_query_var('page'));

        if (empty($paged) && !empty($paged_2)) {
            $paged = intval(get_query_var('page'));
        }

        if (empty($paged) || $paged == 0) {
            $paged = 1;
        }

        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1 / 2);
        $half_page_end = ceil($pages_to_show_minus_1 / 2);
        $start_page = $paged - $half_page_start;
        if ($start_page <= 0) {
            $start_page = 1;
        }
        $end_page = $paged + $half_page_end;
        if (($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if ($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if ($start_page <= 0) {
            $start_page = 1;
        }
        $larger_per_page = $larger_page_to_show * $larger_page_multiple;
        $larger_start_page_start = (kbw_n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = kbw_n_round($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = kbw_n_round($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = kbw_n_round($end_page, 10) + ($larger_per_page);
        if ($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if ($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if ($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if ($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if ($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            
            //$output_html .= $before.'<div class="pagenavi">'."\n";

            if (!empty($pages_text)) {
                $output_html .= '<span class="pages">' . $pages_text . '</span>';
            }
            
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                $output_html .= '<a href="' . esc_url(get_pagenum_link()) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
                if (!empty($pagenavi_options['dotleft_text'])) {
                    $output_html .= '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
                }
            }
            
            if ($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for ($i = $larger_start_page_start; $i < $larger_start_page_end; $i += $larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    $output_html .= '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
                }
            }
            
            if (empty($query)) $output_html .= '<span id="kbw-prev-page">';
            previous_posts_link($pagenavi_options['prev_text']);
            if (empty($query)) $output_html .= '</span>';
            
            for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    $output_html .= '<span class="current">' . $current_page_text . '</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    $output_html .= '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
                }
            }
            
            if (empty($query)) $output_html .= '<span id="kbw-next-page">';
            next_posts_link($pagenavi_options['next_text'], $max_page);
            if (empty($query)) $output_html .= '</span>';
            
            if ($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for ($i = $larger_end_page_start; $i <= $larger_end_page_end; $i += $larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    $output_html .= '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
                }
            }
            if ($end_page < $max_page) {
                if (!empty($pagenavi_options['dotright_text'])) {
                    $output_html .= '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                $output_html .= '<a href="' . esc_url(get_pagenum_link($max_page)) . '" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
            }

            //$output_html .= '</div>'.$after."\n";
        }
    }
    
    return $output_html;
}


### Function: Round To The Nearest Value
function kbw_n_round($num, $tonearest)
{
    return floor($num / $tonearest) * $tonearest;
}


### Function: Page Navigation Options
function kbw_pagination_extra_init()
{
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = __('Page %CURRENT_PAGE% of %TOTAL_PAGES%');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = __('&laquo; First');
    $pagenavi_options['last_text'] = __('Last &raquo;');
    $pagenavi_options['next_text'] = __('&raquo;', 'kbw');
    $pagenavi_options['prev_text'] = __('&laquo;', 'kbw');
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';


    $pagenavi_options['num_pages'] = 5;

    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 3;
    $pagenavi_options['larger_page_numbers_multiple'] = 10;

    return $pagenavi_options;
}


### Numbered Pagination
if (!function_exists('kbw_posts_pagination')) {
    function kbw_posts_pagination($myquery = false)
    {
        global $wp_query;

        $prev_arrow = is_rtl() ? '<i class="fa fa-angle-right"></i>' : '<i class="fa fa-angle-left"></i>';
        $next_arrow = is_rtl() ? '<i class="fa fa-angle-left"></i>' : '<i class="fa fa-angle-right"></i>';

        if (!empty($myquery)) {
            $total = $myquery->max_num_pages;
        } else {
            $total = $wp_query->max_num_pages;
        }

        $paged = intval(get_query_var('paged'));
        $paged_2 = intval(get_query_var('page'));

        if (empty($paged) && !empty($paged_2)) {
            $paged = intval(get_query_var('page'));
        }

        if (empty($paged) || $paged == 0) {
            $paged = 1;
        }

        $big = 999999999; // need an unlikely integer
        if ($total > 1) {

            if (!$current_page = get_query_var('paged'))
                $current_page = 1;
            if (get_option('permalink_structure')) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            $pages = paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => $format,
                'current' => $paged,
                'total' => $total,
                'mid_size' => 3,
                'type' => 'array',
                'prev_text' => $prev_arrow,
                'next_text' => $next_arrow,
            ));
    
            if (is_array($pages)) {
                echo '<ul class="page-numbers pagination nav-pagination kbw-pagination links text-center">';
                foreach ($pages as $page) {
                    $page = str_replace("page-numbers", "page-number", $page);
                    echo "<li>$page</li>";
                }
                echo '</ul>';
            }
        }
    }
}
