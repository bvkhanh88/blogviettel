<?php
/**
 *  Theme functions
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

/**
 * Main container class
 */
if (!function_exists('kbw_main_container_class')) {
    function kbw_main_container_class()
    {
        $kbw_container_class = is_page_template('templates/page-full-width.php') ? 'full-width' : 'container';
        
        return $kbw_container_class;
    }
}

/**
 * Page class generate function
 */
if (!function_exists('kbw_page_class')) {
    function kbw_page_class($echo = true)
    {
        $class = 'content';
        
        if (is_single() || is_page()) {
            $class .= ' single';
            $header_animation = '';
            if (!empty($header_animation)) $class .= ' ' . $header_animation;
        }
        
        if (is_archive()) {
            $class .= ' archive';
        }
        if (is_category()) {
            $class .= ' category';
        }
        
        // Woocommerce
        if (kbw_isWooCommerce()) {
            if (is_shop() || is_product_taxonomy()) {
                $class .= ' shop_page';
            }
            if (is_product()) {
                $class .= ' single_product';
            }
        }
        
        if ($echo) {
            echo $class;
        } else {
            return $class;
        }
        return false;
    }
}

/**
 * Truncate string to x letters/words.
 */
function kbw_truncate($str, $length = 40, $units = 'letters', $ellipsis = '&nbsp;&hellip;')
{
    if ($units == 'letters') {
        if (mb_strlen($str) > $length) {
            return mb_substr($str, 0, $length) . $ellipsis;
        } else {
            return $str;
        }
    } else {
        $words = explode(' ', $str);
        if (count($words) > $length) {
            return implode(" ", array_slice($words, 0, $length)) . $ellipsis;
        } else {
            return $str;
        }
    }
}


/**
 * Breadcrumbs Function
 */
function kbw_breadcrumbs()
{
    $show = apply_filters('kbw_show_breadcrumbs', false);
    if (kbw_get_option('breadcrumbs') || $show) {
        $delimiter = '<span class="delimiter">';
        $delimiter .= kbw_get_option('breadcrumbs_delimiter') ? kbw_get_option('breadcrumbs_delimiter') : '&raquo;';
        $delimiter .= '</span>';
        $before = '<span class="current">';
        $after = '</span>';
        
        if (!is_home() && !is_front_page() || is_paged()) {
            echo '<div id="crumbs" class="breadcrumb kbw-breadcrumb">';
            
            global $post;
            $homeLink = home_url();
            echo '<span class="crumbs-home"><a href="' . $homeLink . '">' . __('Home', 'kbw') . '</a></span> ' . $delimiter . ' ';
            
            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    if (!is_wp_error($cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '))) {
                        $cat_code = str_replace('<a', '<span><a', $cat_code);
                        echo $cat_code = str_replace('</a>', '</a></span>', $cat_code);
                    }
                }
                echo $before . '' . single_cat_title('', false) . '' . $after;
                
            } elseif (is_day()) {
                echo '<span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></span> ' . $delimiter . ' ';
                echo '<span><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></span> ' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;
                
            } elseif (is_month()) {
                echo '<span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></span> ' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<span><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></span> ' . $delimiter . ' ';
                    echo $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    if (!empty($cat)) {
                        if (!is_wp_error($cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' '))) {
                            $cat_code = str_replace('<a', '<span><a', $cat_code);
                            echo $cat_code = str_replace('</a>', '</a></span>', $cat_code);
                        }
                    }
                    echo $before . get_the_title() . $after;
                }
            } elseif ((is_page() && !$post->post_parent) || (function_exists('bp_current_component') && bp_current_component())) {
                echo $before . get_the_title() . $after;
            } elseif (is_search()) {
                echo $before;
                printf(__('Search Results for: %s', 'kbw'), get_search_query());
                echo $after;
            } elseif (is_tax()) {
                global $wp_query;
                $term_obj = $wp_query->get_queried_object();
                echo $before . single_term_title('', false) . $after;
            } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
                //$post_type = get_post_type_object(get_post_type());
                echo $before . get_queried_object()->labels->name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                echo '<span><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></span> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<span><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></span>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } elseif (is_tag()) {
                echo $before;
                echo single_tag_title('', false);
                echo $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before;
                echo $userdata->display_name;
                echo $after;
            } elseif (is_404()) {
                echo $before;
                _e('Not Found', 'kbw');
                echo $after;
            }
            
            if (get_query_var('paged')) {
                if (is_page() || is_archive() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo '&nbsp;<span class="page-num">(';
                echo __('page', 'kbw') . ' ' . get_query_var('paged');
                if (is_page() || is_archive() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')</span>';
            }
            
            echo '</div>';
        }
    }
    wp_reset_query();
}


/**
 * Page titles function
 */
function kbw_title($echo = true)
{
    if (is_home()) {
        if (get_option('page_for_posts', true)) {
            $page_title = get_the_title(get_option('page_for_posts', true));
        } else {
            $page_title = __('Latest Posts', 'kbw');
        }
    } elseif (is_archive()) {
        //$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        if (is_category()) {
            $page_title = single_cat_title('', false);
        } elseif (is_tag()) {
            /* translators: Tag archive title. %s: Tag name */
            $page_title = single_tag_title('', false);
        } elseif (is_tax()) {
            $page_title = single_term_title('', false);
        } elseif (is_post_type_archive()) {
            if (get_search_query()) {
                $page_title = sprintf(__('Search Results for: <small>%s</small>', 'kbw'), get_search_query());
            } else {
                $page_title = get_queried_object()->labels->name;
            }
        } elseif (is_day()) {
            $page_title = sprintf(__('Daily Archives: %s', 'kbw'), get_the_date());
        } elseif (is_month()) {
            $page_title = sprintf(__('Monthly Archives: %s', 'kbw'), get_the_date('F Y'));
        } elseif (is_year()) {
            $page_title = sprintf(__('Yearly Archives: %s', 'kbw'), get_the_date('Y'));
        } elseif (is_author()) {
            $page_title = sprintf(__('Author: %s', 'kbw'), '<span class="vcard">' . get_the_author() . '</span>');
        } else {
            $page_title = single_cat_title('', false);
        }
    } elseif (is_search()) {
        $page_title = sprintf(__('Search Results for: <small>&ldquo;%s&rdquo;</small>', 'kbw'), get_search_query());
        if (get_query_var('paged')) {
            /* translators: %s: page number */
            $page_title .= sprintf(__('&nbsp;&ndash; Page %s', 'kbw'), get_query_var('paged'));
        }
    } elseif (is_404()) {
        $page_title = __('Not Found', 'kbw');
    } else {
        $page_title = get_the_title();
    }
    
    $page_title = apply_filters('kbw_page_title', $page_title);
    
    if ($echo) {
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $page_title;
    } else {
        return $page_title;
    }
}

if (!function_exists('kbw_the_tags')) {
    /**
     * Display schema-compliant the_tags()
     *
     * @param string $before
     * @param string $sep
     * @param string $after
     */
    function kbw_the_tags($post_id = 0, $before = '', $sep = ', ', $after = '')
    {
        $tags = get_the_tags($post_id);
        if (empty($tags) || is_wp_error($tags)) {
            return;
        }
        $tag_links = array();
        foreach ($tags as $tag) {
            $link = get_tag_link($tag->term_id);
            $tag_links[] = '<a href="' . esc_url($link) . '" rel="tag"><span>' . $tag->name . '</span></a>';
        }
        echo $before . join($sep, $tag_links) . $after;
    }
}

if (!function_exists('kbw_the_terms')) {
    function kbw_the_terms($post_id, $taxonomy = 'maincpt_cat', $sep = ', ')
    {
        if (empty($post_id) || !is_numeric($post_id))
            $post_id = get_the_ID();
        
        $terms = get_the_terms($post_id, $taxonomy);
        if (empty($terms) || is_wp_error($terms)) {
            return;
        }
        $term_links = array();
        foreach ($terms as $term) {
            $link = get_tag_link($term->term_id);
            $term_links[] = '<a href="' . esc_url($link) . '" rel="nofollow">' . $term->name . '</a>';
        }
        echo join($sep, $term_links);
    }
}


/**
 * OG Meta for posts
 */
function kbw_og_data()
{
    global $post;
    
    if (function_exists("has_post_thumbnail") && has_post_thumbnail())
        $post_thumb = kbw_thumb_src('kbw-large');
    else {
        $protocol = is_ssl() ? 'https' : 'http';
        $get_meta = get_post_custom($post->ID);
        if (!empty($get_meta["kbw_video_url"][0])) {
            $video_url = $get_meta["kbw_video_url"][0];
            $video_link = @parse_url($video_url);
            if ($video_link['host'] == 'www.youtube.com' || $video_link['host'] == 'youtube.com') {
                parse_str(@parse_url($video_url, PHP_URL_QUERY), $my_array_of_vars);
                $video = $my_array_of_vars['v'];
                $post_thumb = $protocol . '://img.youtube.com/vi/' . $video . '/0.jpg';
            } elseif ($video_link['host'] == 'www.vimeo.com' || $video_link['host'] == 'vimeo.com') {
                $video = (int)substr(@parse_url($video_url, PHP_URL_PATH), 1);
                $url = $protocol . '://vimeo.com/api/v2/video/' . $video . '.php';;
                $contents = @file_get_contents($url);
                $thumb = @unserialize(trim($contents));
                $post_thumb = $thumb[0]['thumbnail_large'];
            }
        }
    }
    
    $og_title = strip_shortcodes(strip_tags((get_the_title()))) . ' - ' . get_bloginfo('name');
    $og_description = strip_tags(strip_shortcodes(apply_filters('kbw_exclude_content', $post->post_content)));
    $og_type = 'article';
    
    if (is_home() || is_front_page()) {
        $og_title = get_bloginfo('name');
        $og_description = get_bloginfo('description');
        $og_type = 'website';
    }
    
    ?>
    <meta property="og:title" content="<?php echo $og_title ?>"/>
    <meta property="og:type" content="<?php echo $og_type ?>"/>
    <meta property="og:description" content="<?php echo wp_html_excerpt($og_description, 100) ?>"/>
    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo('name') ?>"/>
    <?php
    if (!empty($post_thumb)) {
        echo '<meta property="og:image" content="' . $post_thumb . '" />' . "\n";
        echo '<meta property="og:image:alt" content="' . strip_shortcodes(strip_tags((get_the_title()))) . '" />' . "\n";
    }
}

/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
if (!function_exists('kbw_comment')) :
    function kbw_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="post pingback">
                <p><?php _e('Pingback:', 'kbw'); ?><?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'kbw'), '<span class="edit-link">', '<span>'); ?></p>
                <?php
                break;
            default :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment-inner">
                    <div class="flex-row align-top">
                        <div class="flex-col">
                            <div class="comment-author mr-half">
                                <?php echo get_avatar($comment, 70); ?>
                            </div>
                        </div>

                        <div class="flex-col flex-grow">
                            <?php printf(__('%s <span class="says">says:</span>', 'kbw'), sprintf('<cite class="strong fn">%s</cite>', get_comment_author_link())); ?>
                            <?php if ($comment->comment_approved == '0') : ?>
                                <em><?php _e('Your comment is awaiting moderation.', 'kbw'); ?></em>
                                <br/>
                            <?php endif; ?>

                            <div class="comment-content"><?php comment_text(); ?></div>

                            <div class="comment-meta commentmetadata uppercase is-xsmall clear">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>" class="pull-left">
                                        <?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'kbw'), get_comment_date(), get_comment_time()); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link(__('Edit', 'kbw'), '<span class="edit-link ml-half strong">', '</span>'); ?>

                                <div class="reply pull-right">
                                    <?php
                                    comment_reply_link(array_merge($args, array(
                                        'depth' => $depth,
                                        'max_depth' => $args['max_depth'],
                                    )));
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </article>
                <?php
                break;
        endswitch;
    }
endif; // ends check for kbw_comment()

/**
 * Get Related Args Func
 */
if (!function_exists('kbw_related_args')) {
    function kbw_related_args($post_type = 'maincpt', $taxonomy = null, $per_page = false)
    {
        global $wp_post_types, $post;
        
        $single_related_post_enable = true;
        if (!$single_related_post_enable) return false;
        
        $post_id = get_the_ID();
        $kbw_cpt_taxonomy = ($taxonomy == null) ? (kbw_get_option('single_related_cpt_taxonomy') ? kbw_get_option('single_related_cpt_taxonomy') : $post_type . '_cat') : $taxonomy;
        $option_id_related_total = ($post_type == 'post') ? 'single_related_post_total' : 'single_related_cpt_total';
        $single_related_post_total = $per_page ? $per_page : (kbw_get_option($option_id_related_total) ? kbw_get_option($option_id_related_total) : 3);
        
        $args = array(
            'post_type' => $post_type,
            'post__not_in' => array($post_id),
            'posts_per_page' => $single_related_post_total,
            'ignore_sticky_posts' => 1,
            'orderby' => 'date',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-quote', 'post-format-link'),
                    'operator' => 'NOT IN'
                )
            )
        );
        $empty_taxonomy = false;
        
        if ($post_type == 'post') {
            $tag_slugs = wp_get_post_tags($post->ID, array('fields' => 'slugs'));
            $cat_ids = wp_get_post_terms($post->ID, 'category', array('fields' => 'ids'));
            if (count($tag_slugs) == 0 && count($cat_ids) == 0) {
                $empty_taxonomy = true;
                return false;
            }
            
            $single_related_post_condition = kbw_get_option('single_related_post_condition') ? kbw_get_option('single_related_post_condition') : array('category' => 1);
            $related_by_category = isset($single_related_post_condition['category']) && $single_related_post_condition['category'] == 1 ? true : false;
            $related_by_tag = isset($single_related_post_condition['tag']) && $single_related_post_condition['tag'] == 1 ? true : false;
            
            if ($related_by_category && isset($cat_ids) && count($cat_ids) > 0) {
                $args['category__in'] = $cat_ids;
            }
            
            if ($related_by_tag && isset($tag_slugs) && count($tag_slugs) > 0) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => $tag_slugs,
                    'operator' => 'IN'
                );
            }
            
            $args = apply_filters('kbw_related_post_args', $args);
        } else {
            // related posts based on tags or custom taxonomy
            $tags = array(); //print_r($wp_post_types[$post_type]->taxonomies);
            if (isset($wp_post_types[$post_type]) && in_array("post_tags", $wp_post_types[$post_type]->taxonomies)) {
                $tags = get_the_tags($post_id);
            }
            
            if (isset($wp_post_types[$post_type]) && in_array($kbw_cpt_taxonomy, $wp_post_types[$post_type]->taxonomies)) {
                $cat_ids = wp_get_object_terms($post_id, $kbw_cpt_taxonomy, array('fields' => 'ids'));
            }
            
            if (empty($tags) && empty($cat_ids)) {
                $empty_taxonomy = true;
                return false;
            } else {
                if ($kbw_cpt_taxonomy == 'tags') {
                    $tag_ids = array();
                    foreach ($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id;
                    }
                    $args['tag__in'] = $tag_ids;
                } else {
                    $args['tax_query'][] = array(
                        'taxonomy' => $kbw_cpt_taxonomy,
                        'field' => 'id',
                        'terms' => $cat_ids,
                        'operator' => 'IN'
                    );
                }
            }
        }
        
        if ($single_related_post_total != -1) {
            $paged = intval(get_query_var('paged'));
            $paged_2 = intval(get_query_var('page'));
            
            if (empty($paged) && !empty($paged_2)) {
                $paged = intval(get_query_var('page'));
            }
            
            $args['paged'] = $paged;
        }
        
        return $empty_taxonomy ? false : $args;
    }
}


/**
 * Author Box
 */
function kbw_author_box($avatar = true, $social = true, $user_id = false)
{ ?>
    <section id="author-box" class="author-box">
        <div class="author-content author-bio">
            <?php if ($avatar) { ?>
                <div class="author-header">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" title="">
                        <?php echo get_avatar(get_the_author_meta('user_email', $user_id), 80); ?>
                        <div class="author-name"><?php echo get_the_author(); ?></div>
                    </a>
                </div><!-- #author-avatar -->
            <?php } ?>
            <div class="author-description">
                <?php the_author_meta('description', $user_id); ?>
            </div><!-- #author-description -->
            <?php if ($social) { ?>
                <div class="author-social flat-social">
                    <?php if (get_the_author_meta('url', $user_id)) : ?>
                        <a class="social-site" target="_blank" href="<?php echo esc_url(get_the_author_meta('url', $user_id)); ?>"><i class="fa fa-home"></i></a>
                    <?php endif ?>
                    <?php if (get_the_author_meta('facebook', $user_id)) : ?>
                        <a class="social-facebook" target="_blank" href="<?php echo esc_url(get_the_author_meta('facebook', $user_id)); ?>"><i class="fa fa-facebook"></i></a>
                    <?php endif ?>
                    <?php if (get_the_author_meta('youtube', $user_id)) : ?>
                        <a class="social-youtube" target="_blank" href="<?php echo esc_url(get_the_author_meta('youtube', $user_id)); ?>"><i class="fa fa-youtube"></i></a>
                    <?php endif ?>
                    <?php if (get_the_author_meta('instagram', $user_id)) : ?>
                        <a class="social-instagram" target="_blank" href="<?php echo esc_url(get_the_author_meta('instagram', $user_id)); ?>"><i class="fa fa-instagram"></i></a>
                    <?php endif ?>
                    <?php if (get_the_author_meta('twitter', $user_id)) : ?>
                        <a class="social-twitter" target="_blank" href="http://twitter.com/<?php the_author_meta('twitter', $user_id); ?>"><i class="fa fa-twitter"></i><span> @<?php the_author_meta('twitter', $user_id); ?></span></a>
                    <?php endif ?>
                    <?php if (get_the_author_meta('linkedin', $user_id)) : ?>
                        <a class="social-linkedin" target="_blank" href="<?php echo esc_url(get_the_author_meta('linkedin', $user_id)); ?>"><i class="fa fa-linkedin"></i></a>
                    <?php endif ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <?php
}


/**
 * Show KBW Search Form
 */
function kbw_search_form($post_type = 'post', $style = '', $el_class = '')
{
    global $is_IE;
    ob_start(); ?>
    
    <?php
    if ($style == '') { ?>
        <div class="kbw-search<?php echo($el_class != '' ? ' ' . $el_class : ''); ?>">
            <div class="form-search search-inner">
                <form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" id="frmsearch" role="search">
                    <input type="hidden" name="post_type" value="<?php echo $post_type; ?>">
                    <input type="text" class="txt-search" id="search-keyword" name="s" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>"/>
                    <button type="submit" class="search-btn" id="search-btn" name="search-btn" value="">
                        <span class="fa fa-search"></span>
                    </button>
                </form>
            </div>
        </div>
    <?php } elseif ($style == 's-multi') { ?>
        <div class="search-block s-multi<?php echo($el_class != '' ? ' ' . $el_class : ''); ?>">
            <div class="search-inner">
                <form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" id="searchform" role="search">
                    <button class="search-button" type="submit" value="<?php if (!$is_IE) _e('Search', 'kbw') ?>">
                        <i class="fa fa-search"></i>
                    </button>
                    <select name="post_type" class="select-post-type">
                        <option <?php selected(get_query_var('post_type'), 'product') ?> value="product"><?php echo __('Product', 'kbw') ?></option>
                        <option <?php selected(get_query_var('post_type'), 'post') ?> value="post"><?php echo __('Article', 'kbw') ?></option>
                    </select>
                    <input class="search-live" type="text" id="s-input" name="s" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder'); ?>" value="<?php echo get_search_query(); ?>"/>
                </form>
            </div>
        </div>
    <?php } elseif ($style == 's-product') { ?>
        <div class="kbw-search s-product<?php echo($el_class != '' ? ' ' . $el_class : ''); ?>">

        </div>
    <?php } ?>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


/**
 * Get img url by id
 */
if (!function_exists('kbw_wp_img_src')) {
    function kbw_wp_img_src($image_id, $size = 'full')
    {
        global $post;
        $image_url = wp_get_attachment_image_src($image_id, $size);
        return $image_url ? $image_url[0] : false;
    }
}


/**
 * Get img id by url
 */
function kbw_wp_img_id($image_src)
{
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}


/**
 * kbw Thumb SRC
 */
function kbw_thumb_src($size = 'kbw-small')
{
    global $post;
    $image_id = get_post_thumbnail_id($post->ID);
    $image_url = wp_get_attachment_image_src($image_id, $size);
    return $image_url[0];
}


/**
 * Get gallery in post content
 */
function kbw_get_gallery_image_urls($post_id, $type = false, $size = 'full')
{
    $post = get_post($post_id);
    $count = 0;
    // Make sure the post has a gallery in it
    if (!has_shortcode($post->post_content, 'gallery'))
        return;
    // Retrieve all galleries of this post
    $galleries = get_post_galleries_images($post);
    
    // Loop through all galleries found
    foreach ($galleries as $gallery) {
        //echo '<div class="gallery">';
        
        // Loop through each image in each gallery
        foreach ($gallery as $image) {
            $image_id = kbw_wp_img_id($image);
            $image_src = ($image_id) ? kbw_wp_img_src($image_id, $size) : $image;
            
            if (!$type) {
                //echo '<figure class="gallery-item">';
                //echo '<div class="gallery-icon landscape">';
                echo '<a href="' . $image . '" class="kbw-selector-lightgallery"><img src="' . $image_src . '"></a>';
                //echo '</div>';
                //echo '</figure>';
            } else if ($type = 'paragon') {
                echo '<li><a href="' . $image . '" class="kbw-selector-lightgallery"><img src="' . $image_src . '"></a></li>';
            }
        }
        
        //echo '</div>';
    }
    //echo wp_get_attachment_link(33);
}


/**
 * Get post gallery function
 */
if (!function_exists('kbw_post_gallery')) {
    function kbw_post_gallery($post_id, $post_type = 'maincpt', $type = '')
    {
        $gallery_imgs = get_post_meta($post_id, $post_type . '_gallery');
        $nav_class = '';
        if ($type == '') { ?>
            <ul class="slides">
                <?php foreach ($gallery_imgs as $gallery_img) {
                    echo '<li><a href="' . wp_get_attachment_image_url($gallery_img, 'full') . '" rel="nofollow" class="kbw-selector-lightgallery">' . wp_get_attachment_image($gallery_img, 'kbw-small') . '</a></li>';
                } ?>
            </ul>
        <?php } elseif ($type != '') {
            foreach ($gallery_imgs as $gallery_img) {
                echo '<div>';
                echo '<img u="image" src="' . wp_get_attachment_image_url($gallery_img, 'full') . '"/>';
                echo '<img u="thumb" src="' . wp_get_attachment_image_url($gallery_img, 'kbw-small') . '"/>';
                echo '</div>';
            }
        }
    }
}


/**
 * template locate and include function
 */
if (!function_exists('kbw_get_template')) {
    function kbw_get_template($template_name, $template_path = '')
    {
        $template = locate_template(array(
            trailingslashit($template_path) . $template_name,
            $template_name
        ));
        if (!file_exists($template)) {
            _doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $template_name), '1.0');
            return;
        }
        
        include($template);
    }
}


/**
 * Get the post time function
 */
function kbw_get_time($return = false)
{
    global $post;
    
    $time_now = current_time('timestamp');
    $post_time = get_the_time('U');
    
    if ($post_time > $time_now - (60 * 60 * 24 * 30)) {
        $since = sprintf(__('%s ago', 'kbw'), human_time_diff($post_time, $time_now));
    } else {
        $since = get_the_time('d-m-Y H:m');
    }
    echo $post_time = '<span class="kbw-date post-meta-date"><i class="fa fa-clock-o"></i>' . $since . '</span>';
}

/*-- PROJECT
/*-----------------------------*/

/**
 * Get Video embed URL
 */
function kbw_get_video_embed($video_url)
{
    $protocol = is_ssl() ? 'https' : 'http';
    $video_link = @parse_url($video_url);
    if ($video_link['host'] == 'www.youtube.com' || $video_link['host'] == 'youtube.com') {
        parse_str(@parse_url($video_url, PHP_URL_QUERY), $my_array_of_vars);
        $video = $my_array_of_vars['v'];
        $video_output = $protocol . '://www.youtube.com/embed/' . $video . '?rel=0&wmode=opaque&autohide=1&border=0&egm=0&showinfo=0';
    } elseif ($video_link['host'] == 'www.youtu.be' || $video_link['host'] == 'youtu.be') {
        $video = substr(@parse_url($video_url, PHP_URL_PATH), 1);
        $video_output = $protocol . '://www.youtube.com/embed/' . $video . '?rel=0&wmode=opaque&autohide=1&border=0&egm=0&showinfo=0';
    } elseif ($video_link['host'] == 'www.vimeo.com' || $video_link['host'] == 'vimeo.com') {
        $video = (int)substr(@parse_url($video_url, PHP_URL_PATH), 1);
        $video_output = $protocol . '://player.vimeo.com/video/' . $video . '?wmode=opaque';
    } else {
        $video_output = $video_url;
    }
    
    if (!empty($video_output)) return $video_output; ?>
    <?php
    return false;
}


/**
 * Get Video youtube img src
 */
function kbw_get_youtube_video_img($video_url, $img_size = 'hqdefault')
{
    $video_id = explode("?v=", $video_url);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $video_url);
    }
    $youtube_videoID = $video_id[1];
    
    if (empty($youtube_videoID)) {
        $video_id = explode("/v/", $video_url);
        $video_id = explode("&", $video_id[1]);
        $youtube_videoID = $video_id[0];
    }
    
    if ($youtube_videoID) {
        $thumbURL = 'https://img.youtube.com/vi/' . $youtube_videoID . '/' . $img_size . '.jpg';
        return $thumbURL;
    } else {
        return false;
    }
}


/**
 * function to make bussiness manager to see their own property only
 */
if (!function_exists('kbw_posts_for_current_author')) {
    function kbw_posts_for_current_author($query)
    {
        // if ( $query->is_admin && ! current_user_can( 'delete_others_pages' ) ) {
        if ($query->is_admin && !current_user_can('manage_options')) {
            global $user_ID;
            $query->set('author', $user_ID);
        }
        
        return $query;
    }
}


/**
 * Get current page url
 */
if (!function_exists('kbw_get_current_page_url')) {
    function kbw_get_current_page_url()
    {
        global $wp;
        return home_url(add_query_arg(array(), $wp->request));
    }
}


/**
 * Show facebook comment box
 */
function kbw_facebook_comment_display($href = '')
{
    if ($href == '') $href = kbw_get_current_page_url();
    echo '<div class="fb-comments" data-href="' . $href . '" data-numposts="5" data-width="100%"></div>';
}


/**
 * Get the IP Address of a Visitor with PHP
 */
function kbw_get_visitor_ip()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                    return $ip;
                }
            }
        }
    }
    return false;
}


/**
 * Check Taxonomy has parent
 */
function kbw_check_taxonomy_has_parent($id, $taxonomy = 'category', $parent_id = 0)
{
    $term_ojb = get_term_by('id', $id, $taxonomy); //echo '<pre>';print_r($term_ojb);echo '</pre>';
    
    if ($parent_id == 0) {
        $check = ($term_ojb->parent > 0) ? true : false;
    } else {
        $check = ($term_ojb->parent === $parent_id) ? true : false;
    }
    
    return $check;
}


/**
 * Generate Hierarchical Terms
 */
if (!function_exists('kbw_generate_hierarchical_terms')) {
    /**
     * Generate Hierarchical Terms
     *
     * @param $taxonomy_name
     * @param $taxonomy_terms
     * @param $searched_term
     * @param string $prefix
     */
    function kbw_generate_hierarchical_terms($taxonomy_name, $taxonomy_terms, $searched_term, $prefix = "", $view = 'select', $arg = array())
    {
        if (!empty($taxonomy_terms)) {
            if ($view == 'select') {
                foreach ($taxonomy_terms as $term) {
                    $arg_child = array(
                        'taxonomy' => $taxonomy_name,
                        'hide_empty' => false,
                        'parent' => $term->term_id
                    );
                    if (is_array($arg)) $arg_child = array_merge($arg_child, $arg);
                    $child_terms = get_terms($arg_child);
                    if (!$arg) $child_terms = array();
                    
                    echo '<option value="' . $term->slug . '" ' . ($searched_term == $term->slug ? 'selected="selected"' : '') . '>' . $prefix . $term->name . '</option>';
                    if (!empty($child_terms)) {
                        // recursive call
                        kbw_generate_hierarchical_terms($taxonomy_name, $child_terms, $searched_term, '--' . $prefix, 'select');
                    }
                }
            }
            
            if ($view == 'menu-ul') {
                echo '<ul>';
                foreach ($taxonomy_terms as $term) {
                    $arg_child = array(
                        'taxonomy' => $taxonomy_name,
                        'hide_empty' => false,
                        'parent' => $term->term_id
                    );
                    if (is_array($arg)) $arg_child = array_merge($arg_child, $arg);
                    $child_terms = get_terms($arg_child);
                    if (!$arg) $child_terms = array();
                    
                    echo '<li class="menu-item term-item-' . $term->term_id . ($searched_term == $term->slug ? ' current-menu-item' : '') . '">';
                    echo '<a href="' . get_term_link($term->term_id) . '"><span class="" data-id="' . $term->term_id . '" data-slug="' . $term->slug . '" data-name="' . $term->name . '">' . $term->name . '</span></a>';
                    if (!empty($child_terms)) {
                        // recursive call
                        kbw_generate_hierarchical_terms($taxonomy_name, $child_terms, $searched_term, '', 'menu-ul');
                    }
                    echo '</li>';
                }
                echo '</ul>';
            }
        }
    }
}


/**
 * Box chat Facebook display html
 */
function kbw_boxchat_facebook($position = 'right-bottom')
{
    $link_fanpage = kbw_get_option('fanpage_url');
    $fanpage_slug = 'monshopvndotcom';
    $html_title = __('Send message for us with Facebook', 'kbw');
    $html = '';
    $html .= '<div class="fb-livechat kbw-livechat ' . $position . '">';
    $html .= '<div class="kbwfb fb-overlay"></div>';
    $html .= '<div class="fb-widget">';
    $html .= '<div class="kbwfb fb-close"></div>';
    $html .= '<div class="fb-page fb_iframe_widget" data-href="' . $link_fanpage . '" data-width="360" data-height="400" data-adapt-container-width="true" data-show-posts="false" data-small-header="true" data-tabs="messages" data-hide-cover="true" data-show-facepile="false" fb-xfbml-state="rendered" fb-iframe-plugin-query=""></div>';
    $html .= '<div class="fb-credit"><a href="http://kabiweb.com/" target="_blank">Powered by KabiWeb</a></div>';
    $html .= '</div>';
    $html .= '<a href="https://m.me/' . $fanpage_slug . '" title="' . $html_title . '" class="kbwfb fb-button"><div class="bubble">1</div><div class="bubble-msg"></div></a>';
    $html .= '</div>';
    
    return $html;
}
