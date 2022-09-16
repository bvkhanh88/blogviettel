<?php
/**
 * The template for displaying archive pages.
 *
 * Used for displaying archive-type pages. These views can be further customized by
 * creating a separate template for each one.
 *
 * - author.php (Author archive)
 * - category.php (Category archive)
 * - date.php (Date archive)
 * - tag.php (Tag archive)
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
$thumbnail = 'kbw-thumbnail';

if (is_tax()) {
    $term_description = term_description();
    $term_description = apply_filters('the_content', $term_description);
}

$banner_id = !empty($banner_id) ? $banner_id : 55;
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <div class="kbw-row-stretch bc-wrap">
            <img src="<?php echo kbw_wp_img_src($banner_id, 'full') ?>" alt="Banner">
            <div class="container p-0">
                <div class="bc-inner d-flex justify-content-center align-items-center">
                    <h1 class="title entry-title"><?php kbw_title(); ?></h1>
                    <?php kbw_breadcrumbs(); ?>
                    <?php //echo kbw_search_form('post') ?>
                </div>
            </div>
        </div>
        <div class="<?php echo $kbw_article_class; ?>">
            <?php if (!empty($term_description)) echo '<div class="clear"></div><div class="archive-description">' . $term_description . '</div>'; ?>
            <div class="post-listing archive-box <?php echo $layout_custom; ?>">
                <?php $i = $j = 1; ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part('templates/loops/post-item', $layout_custom); ?>
                    <?php $j++; ?>
                <?php endwhile; endif; ?>
            </div>
            <div class="clear-20"></div>
        </div>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
