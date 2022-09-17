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
$kbw_article_class = 'full-w';

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

$post_time = get_the_time('M d Y');
$author_id = get_post_field ('post_author', get_the_ID());
$author_link = get_author_posts_url($author_id);
$author_link = 'javascript: void(0)';
$author_title = get_the_author_meta('display_name', $author_id);

$pid = get_the_ID();
$banner_id = get_post_thumbnail_id($pid);
$banner_id = !empty($banner_id) ? $banner_id : 55;

$currLang = kbw_get_current_lang();
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <div class="kbw-row-stretch bc-wrap">
            <img src="<?php echo kbw_wp_img_src($banner_id, 'full') ?>" alt="Banner">
            <div class="container p-0">
                <div class="bc-inner d-flex justify-content-center align-items-center wow fadeInUp">
                    <h1 class="title category postsby"><?php kbw_title(); ?></h1>
                    <div class="time"><?php echo sprintf('%1$s | by <a href="%2$s" class="postby">%3$s</a>', $post_time, $author_link, $author_title); ?></div>
                    <?php kbw_breadcrumbs(); ?>
                    <?php //echo kbw_search_form('post') ?>
                </div>
            </div>
        </div>
        <article class="<?php echo $kbw_article_class; ?>" id="the-post">
            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                <?php if (wp_get_current_user()->ID != 1) kbw_setPostViews(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
                    <div class="post-single-content box mark-links entry-content kbw-lightgallery wow fadeInUp">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="thecontent clearfix">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="tags">
                                    <div class="heading-title"><span><?php echo __('Hashtag', 'kbw'); ?></span></div>
                                    <?php kbw_the_tags(0, '<div class="taglist">', '', '</div>') ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php //kbw_facebook_comment_display(get_the_permalink()); ?>
                    </div><!--/.post-single-content-->
                </div><!--/.g post-->
                <?php //comments_template('', true); ?>
                <?php get_template_part('templates/related/related-' . $post_type); ?>
            <?php endwhile; /* end loop */ ?>
        </article>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
