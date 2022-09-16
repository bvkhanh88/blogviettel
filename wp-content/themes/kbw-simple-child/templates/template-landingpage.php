<?php
/**
 * Template Name: Landing Page Template
 */

$kbw_container_class = kbw_main_container_class();
$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'w-100';
$layout_custom = '';
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="page-custom ldpage">
        <?php if (have_posts()) while (have_posts()) : the_post(); ?>
            <?php if (!is_home() && !is_front_page()) { //kbwcustom ?>
                <header class="d-none">
                    <h1 class="title entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h1>
                </header>
            <?php } ?>
            <div class="post-single-content">
                <?php the_content(); ?>
            </div> <!--.post-single-content box mark-links-->
        <?php endwhile; ?>
    </div>
</div>
<?php get_footer(); ?>

