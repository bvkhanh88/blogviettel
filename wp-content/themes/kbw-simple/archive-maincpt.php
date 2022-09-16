<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$kbw_container_class = kbw_main_container_class();
$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'full-w';
$layout_custom = 'grid';
$thumbnail = 'kbw-thumbnail';

$term = $child_terms = array();
$display_type = 'products'; //products, subcategories, both, product-in-sub

if (is_tax()) {
    $term_description = term_description();
    $term_description = apply_filters('the_content', $term_description);
    
    $queried_taxonomy = get_query_var('taxonomy');
    $queried_term = get_query_var('term');
    $term = $term_obj = get_term_by('slug', $queried_term, $queried_taxonomy);
    
    $child_args = array(
        'hide_empty' => false,
        'child_of' => $term->term_id,
    );
    $child_terms = get_terms($queried_taxonomy, $child_args); //var_dump($child_terms);
    
    $layout_custom = get_term_meta($term->term_id, '_kbw_layout_custom_taxonomy', true);
    if (empty($layout_custom) || $layout_custom == '') $layout_custom = 'grid';
}
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <div class="<?php echo $kbw_article_class; ?>">
            <?php kbw_breadcrumbs(); ?>
            <h1 class="title entry-title">
                <span><?php kbw_title(); ?></span>
            </h1>
            <?php if (!empty($term_description)) echo '<div class="clear"></div><div class="archive-description entry-content">' . $term_description . '</div>'; ?>

            <div class="post-listing archive-box maincpt product">
                <?php
                if ($display_type == 'product-in-sub' && !empty($child_terms) && !is_wp_error($child_terms)) {
                    foreach ($child_terms as $child_term) {
                        echo do_shortcode('[kbw_custompost post_type="maincpt" taxonomy="maincpt_cat" category="' . $child_term->slug . '" column="3" excerpt="no" layout="grid" thumbnail="' . $thumbnail . '"]');
                    }
                } else if ($display_type == 'subcategories' && !empty($child_terms) && !is_wp_error($child_terms)) {
                    echo do_shortcode('[kbw_terms taxonomy="maincpt_cat" layout="grid-right" parent="' . $term->term_id . '" columns="4" thumbnail="' . $thumbnail . '"]');
                } else {
                    if ($layout_custom == 'grid') echo '<div class="row row-flex-20 row-maincpt">';
                    $i = $j = 1;
                    if (have_posts()) : while (have_posts()) : the_post();
                        global $post;
                        get_template_part('templates/loops/main-item', $layout_custom);
                        $i++;
                    endwhile; endif;
                    wp_reset_query();
                    if ($layout_custom == 'grid') echo '</div>';
                    
                    // reset global var
                    unset($display_args);
                    
                    if ($i !== 0) {
                        // No pagination if there is no posts
                        kbw_posts_pagination();
                    }
                }
                ?>
            </div>
        </div>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div><!--#page-->
</div>
<?php get_footer(); ?>
