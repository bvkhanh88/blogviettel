<?php
/**
 * The main template file.
 *
 * Used to display the homepage when home.php doesn't exist.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
$view = 'list';
$thumbnail = 'kbw-thumbnail';

if (is_category()) {
    $category_description = category_description();
    $category_description = apply_filters('the_content', $category_description);
}
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?> page-index">
        <div class="<?php echo $kbw_article_class; ?>">
            <?php kbw_breadcrumbs(); ?>
            <h1 class="title"><span><?php kbw_title(); ?></span></h1>
            <?php if (!empty($category_description)) echo '<div class="clear"></div><div class="archive-description">' . $category_description . '</div>'; ?>
            <div class="post-listing archive-box <?php echo $layout_custom; ?>">
                <div class="listing-wrap clearfix">
                    <?php $i = $j = 1; ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php get_template_part('templates/loops/post-item', $layout_custom); ?>
                        <?php $j++; ?>
                    <?php endwhile; endif; ?>
                </div>
                <?php kbw_posts_pagination(); ?>
            </div>
            <div class="clear-20"></div>
        </div>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
