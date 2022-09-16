<?php
/**
 * Template Name: Full Width
 */

$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'full-w';
$layout_custom = '';
?>

<?php get_header(); ?>
<div id="page" class="<?php echo $kbw_page_class; ?>">
    <?php if (have_posts()) while (have_posts()) : the_post(); ?>
        <?php kbw_breadcrumbs(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
            <?php if (!is_home() && !is_front_page()) { //kbwcustom ?>
                <header>
                    <h1 class="title entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h1>
                </header>
                <div class="post-single-content box mark-links entry-content kbw-lightgallery">
                    <?php the_content(); ?>
                </div><!--.post-content box mark-links-->
                <div class="clear clear-30"></div>
            <?php } ?>
        </div>
    <?php endwhile; ?>
</div><!--/#page-->
<?php get_footer(); ?>

