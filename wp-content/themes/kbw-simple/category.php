<?php
/**
 * The template for displaying category pages.
 *
 * @package WordPress
 * @subpackage kabiweb
 * @since kabiweb 1.0
 * @author Khanh Bui - bvkhanh88@gmail.com
 */

$kbw_container_class = kbw_main_container_class();
$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'article';
$layout_custom = 'list';
$thumbnail = 'kbw-thumbnail';

$category_id = get_query_var('cat');
$child_args = array('hide_empty' => false, 'child_of' => $category_id);
$child_cats = get_terms('category', $child_args); //var_dump($child_terms);

$category_obj = get_category($category_id);
$category_slug = $category_obj->slug;

$category_description = category_description();
$category_description = apply_filters('the_content', $category_description);

$cat_count = $category_obj->category_count;
$thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true);
$thumnail_src = $thumbnail_id ? kbw_wp_img_src($thumbnail_id, $thumbnail) : KBW_THEME_DIRECTORY_URI . '/assets/images/nothumb.png';

$GLOBALS['kbw_excerpt'] = 'yes';
$GLOBALS['kbw_excerpt_length'] = 150;
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <div class="<?php echo $kbw_article_class; ?>">
            <?php kbw_breadcrumbs(); ?>
            <h1 class="title category postsby">
                <a href="<?php echo get_term_link($category_id); ?>"><span><?php echo single_cat_title('', false); ?></span></a>
            </h1>
            <?php if (!empty($category_description)) echo '<div class="clear"></div><div class="archive-description">' . $category_description . '</div>'; ?>
            <div class="post-listing archive-box post-article">
                <div class="listing-wrap <?php echo $layout_custom == 'grid' ? 'row row-flex-20 row-post' : 'clearfix'; ?>">
                    <?php $i = $j = 1; ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php get_template_part('templates/loops/post-item', $layout_custom); ?>
                        <?php $j++; ?>
                    <?php endwhile; endif; ?>
                </div>
                <?php kbw_posts_pagination(); ?>
            </div>
            <div class="clear-20"></div>
            <?php //get_template_part('templates/parts/kbw-share'); //hkcustom ?>
            <div class="clear"></div>
            <?php //kbw_facebook_comment_display(get_term_link($category_id)); ?>
        </div>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
