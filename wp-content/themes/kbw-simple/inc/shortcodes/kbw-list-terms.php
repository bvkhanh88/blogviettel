<?php
/**
 *  Shortcodes Get List Term Of Taxonomy
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 *
 **/

/*Display List Product Cat*/
add_shortcode('kbw_terms', 'kbw_terms_shortcode');
function kbw_terms_shortcode($atts, $content = null)
{
    $output = $title = $taxonomy = $layout = $is_slider = $autoplay = $navigation = $pagination = $margin = $margin_mb = $thumbnail = $style = $column = $column_mb = $number = $per_page = $orderby = $order = $parent = $child_of = $hide_empty = $ids = $exclude = $hide_count = $show_child_term = $class = $offset = '';
    extract(shortcode_atts(array(
        'title' => '',
        'taxonomy' => 'maincpt_cat',
        'layout' => 'grid',
        'is_slider' => 'no',
        'autoplay' => false,
        'navigation' => true,
        'pagination' => false,
        'margin' => 15,
        'margin_mb' => 5,
        'thumbnail' => 'kbw-thumbnail',
        'style' => 'zoom-image',
        'column' => 4,
        'column_mb' => 2,
        'number' => 6,
        'per_page' => 12,
        'column_width' => '',
        'orderby' => 'term_id', //argument: 'name', 'slug', 'term_group', 'term_id', 'id', 'description' and you are using title which is not in the accepted terms fields
        'order' => 'DESC',
        'hide_empty' => '0',
        'parent' => '',
        'child_of' => '',
        'ids' => '',
        'exclude' => '',
        'offset' => 0,
        'hide_count' => false,
        'show_child_term' => 1,
        'class' => '',
    ), $atts));
    
    $current_term = 0;
    if (is_tax()) {
        $queried_taxonomy = get_query_var('taxonomy');
        $queried_term = get_query_var('term');
        $term_obj = get_term_by('slug', $queried_term, $queried_taxonomy);
        $current_term = $term_obj->term_id;
    }
    
    $cat_include = ($ids != '' && strpos($ids, ',') !== false) ? explode(',', $ids) : array($ids);
    $cat_exclude = ($exclude != '' && strpos($exclude, ',') !== false) ? explode(',', $exclude) : array($exclude);
    
    $args = array(
        'taxonomy' => $taxonomy,
        'number' => $number,
        'hide_empty' => $hide_empty,
        'orderby' => $orderby,
        'order' => $order
    );
    
    if ($ids == '') {
        $args['parent'] = $parent;
        $args['child_of'] = $child_of;
        $args['offset'] = $offset;
        $args['exclude'] = $cat_exclude;
    } else {
        $args['include'] = $cat_include;
    }
    
    $all_terms = get_terms($args);
    if ($orderby == 'rand') {
        shuffle($all_terms);
    }
    
    if (empty($all_terms) || is_wp_error($all_terms))
        return false;
    
    $show_child_term = $show_child_term ? true : false;
    $show_post_count = $hide_count ? false : true;
    $current_term = isset($_GET[$taxonomy]) && $_GET[$taxonomy] != '' ? $_GET[$taxonomy] : get_query_var($taxonomy);
    $random_id = 'kbw-block-' . rand();
    
    ob_start(); ?>
    
    <?php
    if ($layout == 'grid') {
        $options = $responsive = array();
        $options['autoHeight'] = true;
        $options['items'] = $column;
        $options['autoplay'] = ($autoplay) ? true : false;
        $options['nav'] = ($navigation) ? true : false;
        $options['dots'] = ($pagination) ? true : false;
        $options['margin'] = (int)$margin;
        $responsive[0]['margin'] = (int)$margin_mb;
        $responsive[0]['items'] = (int)$column_mb;
        $responsive[481]['items'] = (int)$column_mb;
        $responsive[768]['items'] = (int)$column > 1 ? 2 : 1;
        $responsive[992]['items'] = (int)$column > 1 ? 2 : 1;
        $responsive[1200]['items'] = (int)$column;
        $options['responsive'] = $responsive;
        $options = json_encode($options);
        
        echo '<div class="kbw-block-wrap kbw-posts list-terms ' . $taxonomy . '">';
        if ($is_slider == 'yes') echo '<div class="slider-wrapper" data-owl-config="' . esc_attr($options) . '">';
        echo '<div class="kbw-block-inner kbw-posts-inner list-terms-inner ' . (($is_slider == 'yes') ? 'kbwCarousel' : 'row row-flex-' . (in_array($margin, array(0, 10, 15, 20, 25, 30)) ? (int)$margin : 20)) . '">';
        
        foreach ($all_terms as $term) {
            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            if (empty($thumbnail_id) || $thumbnail_id == '') $thumbnail_id = 121;
            ?>
            <div class="item post-item term-item grid <?php echo ($is_slider != 'yes') ? ('col-6 col-md-' . (12 / $column) . ' col-lg-' . (12 / $column)) : (''); ?>">
                <div class="recent-item <?php echo $layout . ' ' . $style; ?>">
                    <div class="inner">
                        <div class="post-thumbnail term-thumb">
                            <a href="<?php echo get_term_link($term->term_id); ?>">
                                <img src="<?php echo kbw_wp_img_src($thumbnail_id, $thumbnail); ?>" alt="<?php echo $term->name; ?>">
                            </a>
                        </div>
                        <div class="entry">
                            <div class="post-box-title">
                                <a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a>
                            </div>
                            <div class="excerpt">
                                <p><?php echo kbw_truncate($term->description, 40, 'words'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        
        echo '</div>';
        if ($is_slider == 'yes') echo '</div>';
        echo '</div>'; ?>
    
    <?php } else if ($layout == 'subcat-menu') {
        $arg = array();
        $arg['orderby'] = $orderby;
        $arg['order'] = $order;
        ?>

        <div class="list-term menu-term kbw-menu-term">
            <?php kbw_generate_hierarchical_terms($taxonomy, $all_terms, '', '', 'menu-ul'); ?>
        </div>
    
    <?php } else if ($layout == 'menu') {
        $is_dropdown = false;
        
        $instance = array();
        $instance['orderby'] = $orderby;
        $instance['order'] = $order;
        $instance['show_post_count'] = $show_post_count;
        $random_id = 'kbw-product-categories-' . rand(0, 1000);
        
        echo '<div class="kbw-menu-category ' . $style . '">';
        if ($title != '' && $title != 'hide') {
            echo '<div class="category-box-title">';
            echo '<div class="category-title">';
            echo '<span class="label-text"><i class="fa fa-bars"></i>' . $title . '</span>';
            echo '<span class="icond"><i class="fa fa-angle-down"></i></span>';
            echo '</div>';
            echo '</div>';
        }
        echo '<div class="kbw-product-categories category-list clear" id="' . $random_id . '">';
        echo '<ul class="menu ' . ($is_dropdown || wp_is_mobile() ? 'dropdown_mode is_dropdown' : 'hover_mode') . '">';
        foreach ($all_terms as $term) {
            $current_class = ($current_term == $term->slug) ? 'current' : '';
            $child_temp = get_terms($taxonomy, array('parent' => $term->term_id, 'hide_empty' => false));
            $has_child_class = (!empty($child_temp) && !is_wp_error($child_temp) ? ' has-child' : '');
            echo '<li class="term-item' . $has_child_class . '">';
            echo '<span class="icon-toggle"></span>';
            echo '<a href="' . get_term_link($term->slug, $taxonomy) . '" class="' . $current_class . '"><span class="term_name">' . $term->name . '</span>';
            if ($show_post_count) {
                echo '<span class="num-product"> (' . $term->count . ') </span>';
            }
            echo "</a>";
            if ($show_child_term) {
                kbw_get_child_terms($term->term_id, $taxonomy, $instance, $current_term);
            }
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        
    } else if ($layout == 'menu-simple') {
        
        echo '<div class="kbw-menu-simple ' . $style . '">';
        if ($title != '' && $title != 'hide') {
            echo '<div class="title"><h3>' . $title . '</h3></div>';
        }
        echo '<div class="module-content">';
        echo '<ul class="">';
        foreach ($all_terms as $term) {
            $child_args = array(
                'hide_empty' => false,
                'child_of' => $term->term_id,
                'orderby' => $orderby,
                'order' => $order
            );
            $child_terms = get_terms($taxonomy, $child_args);
            echo '<li class="term-item term-item-' . $term->term_id . '">';
            echo '<a href="' . get_term_link($term->slug, $taxonomy) . '" class=""><span class="term_name">' . $term->name . '</span></a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        
    } else if ($layout == 'col-hierarchical') { ?>
        <div class="row kbw-list-terms">
            <?php foreach ($all_terms as $term) {
                $child_args = array(
                    'hide_empty' => false,
                    'child_of' => $term->term_id,
                    'orderby' => $orderby,
                    'order' => $order
                );
                $child_terms = get_terms($taxonomy, $child_args);
                ?>
                <div class="col-md-3">
                    <div class="item term-item term-item-<?php echo $term->term_id; ?>">
                        <a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a>
                        <?php
                        if (!empty($child_terms) && !is_wp_error($child_terms)) {
                            echo '<ul>';
                            foreach ($child_terms as $key => $c_term) {
                                echo '<li class="menu-item term-' . $c_term->slug . '"><a class="" href="' . get_term_link($c_term->term_id) . '"><i class="fa fa-angle-right"></i>' . $c_term->name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
            <?php unset($all_terms, $child_terms); ?>
        </div>
    <?php } ?>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


// Get child term
function kbw_get_child_terms($term_id, $taxonomy, $instance, $current_term)
{
    $args = array(
        'taxonomy' => $taxonomy,
        'child_of' => 0,
        'parent' => $term_id,
        'orderby' => $instance['orderby'],
        'order' => $instance['order'],
        'hierarchical' => 0,
        'title_li' => '',
        'hide_empty' => 0
    );
    $child_terms = get_terms($taxonomy, $args);
    if ($child_terms && !is_wp_error($child_terms)) {
        if ($instance['orderby'] == 'rand') {
            shuffle($child_terms);
        }
        echo '<ul class="sub-menu sub-cat">';
        foreach ($child_terms as $c_term) {
            $current_class = ($current_term == $c_term->slug) ? 'current' : '';
            echo '<li>';
            echo '<span class="icon-toggle"></span>';
            echo '<a href="' . get_term_link($c_term, $taxonomy) . '" class="' . $current_class . '"><span class="term-name">' . $c_term->name . '</span>';
            if ($instance['show_post_count']) {
                echo '<span class="num-product"> (' . $c_term->count . ') </span>';
            }
            echo "</a>";
            kbw_get_child_terms($c_term->term_id, $taxonomy, $instance, $current_term);
            echo '</li>';
        }
        echo '</ul>';
    }
}

//Load into Composer
add_action('init', 'kbw_load_kbw_terms_shortcode', 99);
function kbw_load_kbw_terms_shortcode()
{
    $kbw_taxonomies = array(
        'category' => 'Category',
        'maincpt_cat' => 'Maincpt Category'
    );
    if (kbw_isWooCommerce()) {
        $kbw_taxonomies['product_cat'] = __('Product Category', 'kbw');
    }
    $kbw_taxonomies = apply_filters('kbw_shortcode_taxonomies', $kbw_taxonomies);
    
    if (function_exists('kc_add_map')) {
        kc_add_map(
            array(
                
                'kbw_terms' => array(
                    'name' => __('KBW Terms', 'kbw'),
                    'description' => __('', 'kbw'),
                    'category' => __('KBW Framework', 'kbw'),
                    'icon' => 'sl-paper-plane',
                    'title' => __('KBW Terms', 'kbw'),
                    
                    'params' => array(
                        array(
                            'name' => 'title',
                            'label' => __('Title', 'kbw'),
                            'type' => 'text',
                            'value' => 'List Terms',
                            'description' => '',
                        ),
                        array(
                            'name' => 'taxonomy',
                            'label' => __('Taxonomy', 'kbw'),
                            'type' => 'select',
                            'options' => $kbw_taxonomies,
                            'value' => 'category',
                            'description' => '',
                        ),
                        array(
                            'name' => 'layout',
                            'label' => __('Layout', 'kbw'),
                            'type' => 'select',
                            'options' => array(
                                'grid' => 'Grid',
                                'list' => 'List',
                                'menu' => 'Menu',
                                'subcat-menu' => 'Subcat Menu'
                            ),
                            'value' => 'grid',
                            'description' => '',
                        ),
                        array(
                            'name' => 'is_slider',
                            'label' => esc_html__('Is Slider', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'yes' => 'Yes',
                            ),
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'show_when' => 'grid'
                            ),
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'true' => 'Yes',
                            ),
                            'description' => '',
                            'relation' => array(
                                'parent' => 'is_slider',
                                'show_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'navigation',
                            'label' => esc_html__('Navigation', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'true' => 'Yes',
                            ),
                            'value' => 'true', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'is_slider',
                                'show_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'pagination',
                            'label' => esc_html__('Pagination', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'true' => 'Yes',
                            ),
                            'description' => '',
                            'relation' => array(
                                'parent' => 'is_slider',
                                'show_when' => 'yes'
                            ),
                        ),
                        array(
                            'name' => 'column',
                            'label' => esc_html__('Column', 'kbw'),
                            'type' => 'select',
                            'options' => array(
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                            ),
                            'value' => '3',
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'show_when' => 'grid'
                            ),
                        ),
                        array(
                            'name' => 'column_mb',
                            'label' => esc_html__('Column Mobile', 'kbw'),
                            'type' => 'select',
                            'options' => array(
                                '1' => '1',
                                '2' => '2'
                            ),
                            'value' => '1',
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'show_when' => 'grid'
                            ),
                        ),
                        array(
                            'name' => 'margin',
                            'label' => esc_html__('Column Gap', 'kbw'),
                            'type' => 'number',  // USAGE TEXT TYPE
                            'value' => '15', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'hide_when' => array('list')
                            )
                        ),
                        array(
                            'name' => 'margin_mb',
                            'label' => esc_html__('Column Gap Mobile', 'kbw'),
                            'type' => 'number',  // USAGE TEXT TYPE
                            'value' => '15', // remove this if you do not need a default content
                            'description' => '',
                            'relation' => array(
                                'parent' => 'layout',
                                'hide_when' => array('list')
                            )
                        ),
                        array(
                            'name' => 'ids',
                            'label' => esc_html__('Term Include IDS', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'exclude',
                            'label' => esc_html__('Term Exclude IDS', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'parent',
                            'label' => __('Parent ID', 'kbw'),
                            'type' => 'text',
                            'value' => '',
                            'description' => '',
                            'relation' => array(
                                'parent' => 'ids',
                                'show_when' => ''
                            ),
                        ),
                        array(
                            'name' => 'number',
                            'label' => esc_html__('Number', 'kbw'),
                            'type' => 'number',
                            'value' => '9',
                            'description' => '',
                            'relation' => array(
                                'parent' => 'ids',
                                'show_when' => ''
                            ),
                        ),
                        array(
                            'name' => 'offset',
                            'label' => __('Offset', 'kbw'),
                            'type' => 'number',
                            'value' => '0',
                            'description' => '',
                            'relation' => array(
                                'parent' => 'ids',
                                'show_when' => ''
                            ),
                        ),
                        array(
                            'name' => 'thumbnail',
                            'label' => __('Thumbnail', 'kbw'),
                            'type' => 'text',
                            'value' => 'kbw-thumbnail',
                            'description' => '',
                        ),
                        array(
                            'name' => 'style',
                            'label' => __('Style', 'kbw'),
                            'type' => 'text',
                            'value' => 'default',
                            'description' => 'Eg: default, change-hover, change-zoom ...',
                        ),
                        array(
                            'name' => 'hide_empty',
                            'label' => esc_html__('Hide Empty', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                '0' => 'Yes',
                            ),
                            'value' => '',
                            'description' => '',
                        ),
                        array(
                            'name' => 'hide_count',
                            'label' => esc_html__('Hide Count', 'kbw'),
                            'type' => 'checkbox',
                            'options' => array(
                                'true' => 'Yes',
                            ),
                            'value' => 'true',
                            'description' => '',
                        ),
                        array(
                            'name' => 'order',
                            'label' => __('Order', 'kbw'),
                            'type' => 'select',  // USAGE SELECT TYPE
                            'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                                'DESC' => 'DESC',
                                'ASC' => 'ASC',
                            ),
                            'value' => 'DESC', // remove this if you do not need a default content
                            'description' => '',
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => __('Orderby', 'kbw'),
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'term_id', // remove this if you do not need a default content
                            'description' => '',
                        ),
                    )
                ), // End of elemnt shortcode
            
            )
        ); // END KC ADD MAP
    } // End if KingComposer
}
