<?php
/**
 * The template for displaying all single products.
 */

$kbw_container_class = kbw_main_container_class();
$kbw_page_class = kbw_page_class(false);
$kbw_page_class .= ' single_product single-maincpt';
$kbw_article_class = 'article';

$pid = get_the_ID();
$maincpt_meta = get_post_meta($pid);

//$maincpt_cats = wp_get_post_terms($pid, 'maincpt_cat');
$terms = get_the_terms($pid, 'maincpt_cat'); //print_r($terms);
//$postcat = get_the_category(get_the_ID()); //print_r($postcat);

$maincpt_price = get_post_meta($pid, 'maincpt_price', true);
$sale_price = get_post_meta($pid, 'maincpt_sale_price', true);
$maincpt_short_des = get_post_meta($pid, 'maincpt_short_des', true);
$maincpt_short_des = apply_filters('the_content', $maincpt_short_des);
$promotion = get_post_meta($pid, 'maincpt_promotion', true);
$promotion = apply_filters('the_content', $promotion);
$currency_symbol = (kbw_get_option('kbw-currency-symbol')) ? kbw_get_option('kbw-currency-symbol') : 'VNĐ';
$buy_price = (is_numeric($sale_price) ? $sale_price : (is_numeric($maincpt_price) ? $maincpt_price : 0));
?>

<?php get_header(); ?>
<div class="main-content-container <?php echo $kbw_container_class; ?> p-0 clearfix">
    <div id="page" class="<?php echo $kbw_page_class; ?>">
        <article class="<?php echo $kbw_article_class; ?>" id="the-post">
            <?php kbw_breadcrumbs(); ?>
            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                <?php kbw_setPostViews() ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('g post maincpt'); ?>>
                    <div class="single_post">
                        <div class="post-single-content box mark-links entry-content kbw-lightgallery product">
                            <div class="thecontent clearfix">
                                <div class="detail-product">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="images product-gallery">
                                                <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail()) : ?>
                                                    <div class="post-thumbnail">
                                                        <?php //echo get_post_thumbnail_id($post->ID); ?>
                                                        <a href="<?php echo get_the_post_thumbnail_url($pid, 'full'); ?>" rel="nofollow" class="">
                                                            <?php the_post_thumbnail('kbw-main-single'); ?>
                                                        </a>
                                                    </div><!-- post-thumbnail /-->
                                                <?php endif; ?>
                                                <div class="thumbnails list_thumbs">
                                                    <?php kbw_post_gallery($pid, 'maincpt') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <header>
                                                <h1 class="title single-title product-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
                                                    <span itemprop="name"><?php the_title(); ?></span>
                                                </h1>
                                                <?php get_template_part('templates/parts/meta-post'); ?>
                                            </header>
                                            <div class="short-description">
                                                <?php echo $maincpt_short_des; ?>
                                            </div>
                                            <div class="kbw-price">
                                                <p class="price">
                                                    <?php if (is_numeric($sale_price)) { ?>
                                                        <?php if (is_numeric($maincpt_price)) { ?>
                                                            <del>
                                                                <span class="label"><?php echo __('Price: ', 'kbw'); ?></span>
                                                                <span class="amount"><?php echo number_format($maincpt_price, '0', ',', '.'); ?></span>
                                                                <span class="currency-symbol"><?php echo $currency_symbol; ?></span>
                                                            </del>
                                                        <?php } ?>
                                                        <ins>
                                                            <span class="label"><?php echo __('Sale price: ', 'kbw'); ?></span>
                                                            <span class="amount"><?php echo number_format($sale_price, '0', ',', '.'); ?></span>
                                                            <span class="currency-symbol"><?php echo $currency_symbol; ?></span>
                                                        </ins>
                                                    <?php } else if (is_numeric($maincpt_price)) { ?>
                                                        <span class="label"><?php echo __('Price: ', 'kbw'); ?></span>
                                                        <span class="amount"><?php echo number_format($maincpt_price, '0', ',', '.'); ?></span>
                                                        <span class="currency-symbol"><?php echo $currency_symbol; ?></span>
                                                    <?php } else { ?>
                                                        <span class="label call-price"><?php echo __('Contact price: ', 'kbw'); ?></span>
                                                        <span class="hotline"><?php echo kbw_get_option('hotline'); ?></span>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                            <div class="post-action mb-3">
                                                <button class="btn text-center btn-buy open-modal kbw-button" data-post-id="<?php echo $pid; ?>" data-title="<?php echo get_the_title() ?>" data-price="<?php echo number_format($buy_price, '0', ',', '.'); ?>">
                                                    <a href="tel:<?php echo kbw_get_option('hotline'); ?>" class="text-white"><?php echo __('Buy Now', 'kbw') ?></a>
                                                </button>
                                                <!-- kbw modal content -->
                                                <div class="modal fade kbw-modal" tabindex="-1" role="dialog" aria-labelledby="kbw_modal_label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="kbw_modal_label"><?php echo __('Đặt mua', 'kbw') . ' - ' . get_the_title($pid); ?></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php echo do_shortcode('[contact-form-7 id="73" title="Form book"]'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal -->
                                            </div>
                                            <?php get_template_part('templates/parts/kbw-share'); ?>

                                            <form class="cart kbw-cart hide" action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?php echo $pid; ?>">
                                                <div class="quantity">
                                                    <a class="btn-number fa fa-minus" data-type="minus"></a>
                                                    <input type="text" name="quantity" id="" class="input-text qty text" step="1" min="1" max="" value="1" title="SL" size="4" inputmode="numeric">
                                                    <a class="btn-number fa fa-plus" data-type="plus"></a>
                                                </div>
                                                <button type="submit" class="kbw-single-add-to-cart button alt"><?php _e('Add to cart', 'kbw') ?></button>
                                            </form>

                                            <div class="product-meta mb-2 hide">
                                                <span class="posted_in">
                                                    <?php echo __('Category: ', 'kbw'); ?>
                                                    <?php kbw_the_terms($pid); ?>
                                                </span>
                                            </div>
                                            <?php //get_template_part('templates/parts/kbw-share'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content product-entry product-tab mt-4">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs mt-2 m-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab-description" role="tab">
                                                <span class="hidden-xs-down"><?php echo __('Description', 'kbw') ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-additional" role="tab">
                                                <span class="hidden-xs-down"><?php echo __('Specifications', 'kbw') ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-reviews" role="tab">
                                                <span class="hidden-xs-down"><?php echo __('Review', 'kbw') ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item hide">
                                            <a class="nav-link" data-toggle="tab" href="#tab-block-1" role="tab">
                                                <span class="hidden-xs-down"><?php echo __('Ordering guide', 'kbw') ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item hide">
                                            <a class="nav-link" data-toggle="tab" href="#tab-block-2" role="tab">
                                                <span class="hidden-xs-down"><?php echo __('Báo giá', 'kbw') ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active py-3" id="tab-description" role="tabpanel">
                                            <?php the_content(); ?>
                                            <div class="tags"><?php the_tags('<span class="tagtext">' . __('Tags', 'kbw') . ':</span>', ', ') ?></div>
                                        </div>
                                        <div class="tab-pane py-4" id="tab-additional" role="tabpanel">
                                            <?php echo($promotion ? $promotion : '') ?>
                                        </div>
                                        <div class="tab-pane py-4" id="tab-reviews" role="tabpanel">
                                            <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-width="100%"></div>
                                        </div>
                                        <div class="tab-pane py-4" id="tab-block-1" role="tabpanel">
                                            tab-block-1
                                        </div>
                                        <div class="tab-pane py-4" id="tab-block-2" role="tabpanel">
                                            tab-block-2
                                        </div>
                                    </div>
                                </div>
                                <?php get_template_part('templates/related/related-maincpt'); ?>
                            </div>
                            <div class="clear"></div>
                        </div><!--.post-single-content-->
                    </div><!--.single_post-->
                </div><!--.g post-->
                <?php //comments_template('', true); ?>
            <?php endwhile; /* end loop */ ?>
        </article>
        <?php if ($kbw_article_class === 'article') get_sidebar(); ?>
    </div><!--#page-->
</div>
<?php get_footer(); ?>
