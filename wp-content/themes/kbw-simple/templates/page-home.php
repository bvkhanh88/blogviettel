<?php
/**
 * Template Name: Home Page Template
 */

$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'full-width';
$layout_custom = '';
?>

<?php get_header(); ?>
<div id="page" class="<?php echo $kbw_page_class; ?> page-home">
    <article class="<?php echo $kbw_article_class; ?> p-0">
        <div class="page-home entry-content">
            <?php the_content(); ?>
        </div>
        <div class="clear"></div>
    </article>
</div>
<?php get_footer(); ?>

