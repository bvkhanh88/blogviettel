<?php
/**
 * The template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage kabiweb
 * @since kabiweb 1.0
 * @author Khanh Bui - bvkhanh88@gmail.com
 */

$kbw_container_class = kbw_main_container_class();
$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'article';

$post_type = get_post_type(get_the_ID());

$terms = get_the_terms($post->ID, 'category'); //print_r($terms);
$postcats = get_the_category(get_the_ID()); //print_r($postcats);

//article type
$post_style = get_post_meta(get_the_ID(), 'post_style', true);
foreach ($postcats as $postcat) {
    $postcat_ids[] = $postcat->term_id;
}
$check = false;
if ($post_style == 'design') {
    $check = true;
    $kbw_article_class = 'full-width';
}
$GLOBALS['postcats'] = $postcats;
$GLOBALS['post_style'] = $post_style;
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <article class="<?php echo $kbw_article_class; ?>" id="the-post">
            <?php kbw_breadcrumbs(); ?>
            <?php //kbwcustom
            if ($check) {
                get_template_part('templates/single-other');
            } else { ?>
                <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                    <?php if (wp_get_current_user()->ID != 1) kbw_setPostViews(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
                        <div class="single-post">
                            <header>
                                <h1 class="title single-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
                                    <span itemprop="name"><?php the_title(); ?></span>
                                </h1>
                                <div class="info">
                                    <?php get_template_part('templates/parts/meta-post'); ?>
                                    <?php get_template_part('templates/parts/kbw-share'); ?>
                                </div>
                            </header>
                            <div class="post-single-content box mark-links entry-content kbw-lightgallery">
                                <div class="thecontent clearfix">
                                    <?php the_content(); ?>
                                    <div class="tags"><?php kbw_the_tags(0, '<span class="tagtext">' . __('Tags', 'kbw') . ':</span>', ', ') ?></div>
                                </div>
                                <div class="clear"></div>
                                <?php kbw_facebook_comment_display(get_the_permalink()); ?>
                            </div><!--/.post-single-content-->
                        </div><!--/.single_post-->
                    </div><!--/.g post-->
                    <?php //comments_template('', true); ?>
                    <?php get_template_part('templates/related/related-' . $post_type); ?>
                <?php endwhile; /* end loop */ ?>
            <?php } ?>
        </article>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
