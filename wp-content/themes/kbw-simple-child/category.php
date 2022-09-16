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
$kbw_article_class = 'full-w';
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

$GLOBALS['kbw_thumbnail'] = $thumbnail;
$GLOBALS['kbw_excerpt'] = 'yes';
$GLOBALS['kbw_excerpt_length'] = 150;

$banner_id = !empty($banner_id) ? $banner_id : 55;
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <div class="kbw-row-stretch bc-wrap">
            <img src="<?php echo kbw_wp_img_src($banner_id, 'full') ?>" alt="Banner">
            <div class="container p-0">
                <div class="bc-inner d-flex justify-content-center align-items-center">
                    <h1 class="title category postsby"><?php echo single_cat_title('', false); ?></h1>
                    <?php kbw_breadcrumbs(); ?>
                    <?php echo kbw_search_form('post') ?>
                </div>
            </div>
        </div>
        <div class="<?php echo $kbw_article_class; ?>">
            <?php echo do_shortcode('[kbw_listing_category order="asc"]') ?>

            <div class="listing-featured">
                <?php echo do_shortcode('[kbw_post category=' . $category_slug . ' layout=list is_slider=yes column=1 number_posts=5 style="style-list change-none" thumbnail=kbw-main-feature excerpt_length=40 title=hide navigation=false]'); ?>
                <?php
                $GLOBALS['kbw_thumbnail'] = $thumbnail;
                $GLOBALS['kbw_excerpt_length'] = 20;
                ?>
                <?php if (have_posts()): ?>
                    <div class="btn-control wpb_column">
                        <div class="wpb_wrapper">
                            <div class="kbw-button-control prev">
                                <button class="vc_btn3">Prev</button>
                            </div>
                            <div class="kbw-button-control next">
                                <button class="vc_btn3">Next</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="post-listing archive-box post-article">
                <div class="heading-title <?php echo !have_posts() ? 'd-none' : '' ?>"><span><?php echo __('Lastest Update', 'kbw') ?></span></div>
                <div class="listing-wrap <?php echo $layout_custom == 'grid' ? 'row row-flex-20 row-post' : 'clearfix'; ?>">
                    <?php $i = $j = 1; ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php get_template_part('templates/loops/post-item', $layout_custom); ?>
                        <?php $j++; ?>
                    <?php endwhile; endif; ?>
                </div>
                <?php kbw_posts_pagination(); ?>
            </div>
        </div>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
