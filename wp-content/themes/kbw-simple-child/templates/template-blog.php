<?php
/**
 * Template Name: Page Blog
 */

$kbw_container_class = kbw_main_container_class();
$kbw_page_class = kbw_page_class(false);
$kbw_article_class = 'full-w';
$layout_custom = '';
$thumbnail = 'kbw-thumbnail';

$pid = get_the_ID();
$banner_id = get_post_thumbnail_id($pid);
$banner_id = $banner_id ? $banner_id : 55;
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="page-custom page-nosidebar">
        <?php if (!is_home() && !is_front_page()) { //kbwcustom ?>
            <div class="kbw-row-stretch bc-wrap">
                <img src="<?php echo kbw_wp_img_src($banner_id, 'full') ?>" alt="Banner">
                <div class="container p-0">
                    <div class="bc-inner d-flex justify-content-center align-items-center wow fadeInUp">
                        <h1 class="title entry-title"><?php kbw_title(); ?></h1>
                        <?php kbw_breadcrumbs(); ?>
                        <?php echo kbw_search_form('post') ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="post-single-content">
            <?php echo do_shortcode('[kbw_listing_category order="asc" class="wow fadeInUp"]') ?>

            <div class="listing-featured wow fadeInUp">
                <?php echo do_shortcode('[kbw_post layout=list is_slider=yes column=1 number_posts=5 style="style-list change-none" thumbnail=kbw-main-feature excerpt_length=40 title=hide navigation=false]'); ?>
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

            <div class="post-listing archive-box post-article wow fadeInUp">
                <div class="heading-title"><span><?php echo __('Lastest Update', 'kbw') ?></span></div>
                <div class="listing-wrap clearfix">
                    <?php echo do_shortcode('[kbw_post layout=list number_posts=-1 style="style-list change-none" thumbnail=' . $thumbnail . ' excerpt_length=20 title=hide pagination=false number_posts=10]'); ?>
                </div>
            </div>
        </div> <!--.post-single-content box mark-links-->
    </div><!--/#page-->
</div>
<?php get_footer(); ?>
