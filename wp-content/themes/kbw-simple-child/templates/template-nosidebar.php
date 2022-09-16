<?php
/**
 * Template Name: Page Nosidebar
 */

$kbw_container_class = kbw_main_container_class();
$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'full-w';
$layout_custom = '';

$pid = get_the_ID();
$banner_id = get_post_thumbnail_id($pid);
$banner_id = $banner_id ? $banner_id : 55;
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="page-custom page-nosidebar">
        <?php if (have_posts()) while (have_posts()) : the_post(); ?>
            <?php if (!is_home() && !is_front_page()) { //kbwcustom ?>
                <div class="kbw-row-stretch bc-wrap">
                    <img src="<?php echo kbw_wp_img_src($banner_id, 'full') ?>" alt="Banner">
                    <div class="container p-0">
                        <div class="bc-inner d-flex justify-content-center align-items-center">
                            <h1 class="title entry-title"><?php kbw_title(); ?></h1>
                            <?php kbw_breadcrumbs(); ?>
                            <?php echo kbw_search_form('post') ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="post-single-content">
                <?php the_content(); ?>
            </div> <!--.post-single-content box mark-links-->
        <?php endwhile; ?>
    </div><!--/#page-->
</div>
<?php get_footer(); ?>
