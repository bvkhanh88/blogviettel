<?php
/**
 * The template for displaying all pages.
 *
 * Other pages can use a different template by creating a file following any of these format:
 * - page-$slug.php
 * - page-$id.php
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
$kbw_article_class = (is_home() || is_front_page()) ? 'full-width' : 'article';
$layout_custom = '';

$banner = get_post_meta(get_the_id(), 'kbw_pp_banner_above', true);
if (!$banner) $banner = do_shortcode('[kbw_load_option id="module-1" editor="0"]');
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <article class="<?php echo $kbw_article_class; ?>" id="the-post">
            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                <?php if (wp_get_current_user()->ID != 1 && function_exists('kbw_setPostViews')) kbw_setPostViews(); ?>
                <?php kbw_breadcrumbs(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
                    <div class="single-page">
                        <?php if (!is_home() && !is_front_page()) { //kbwcustom ?>
                            <header>
                                <h1 class="title entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h1>
                            </header>
                        <?php } ?>

                        <div class="post-single-content box mark-links entry-content">
                            <?php the_content(); ?>
                        </div><!--.post-content box mark-links-->
                        <div class="clear clear-30"></div>
                        
                        <?php if (!is_home() && !is_front_page()) { ?>
                            <?php //get_template_part('templates/parts/kbw-share'); ?>
                            <?php //kbw_facebook_comment_display(get_the_permalink()); ?>
                        <?php } ?>
                    </div>
                </div>
                <?php //comments_template( '', true ); ?>
            <?php endwhile; ?>
        </article>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div><!--/#page-->
</div>
<?php get_footer(); ?>
