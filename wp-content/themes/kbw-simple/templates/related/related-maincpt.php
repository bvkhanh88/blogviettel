<?php
$args = kbw_related_args('maincpt', 'maincpt_cat');
$my_query = new WP_Query($args);

// Some option variable
$GLOBALS['kbw_post_type'] = $args['post_type'];
$GLOBALS['kbw_excerpt'] = 'no';

$style = 'grid';
$thumbnail = 'kbw-thumbnail';
$related_column = kbw_get_option('single_related_cpt_column') ? kbw_get_option('single_related_cpt_column') : 3;
$currency_symbol = (kbw_get_option('kbw-currency-symbol')) ? kbw_get_option('kbw-currency-symbol') : 'VNĐ';

$related_title = __('Related Products', 'kbw');
$related_title = apply_filters('kbw_related_title_maincpt', $related_title);

if ($my_query->have_posts()) { ?>
    <section class="related-posts mt-4">
        <h4 class="widget-title"><span class="inline-title"><?php echo $related_title; ?></span></h4>
        <div class="post-listing">
            <div class="listing-wrap <?php echo $style == 'grid' ? 'row row-flex-20 row-post' : 'clearfix'; ?>">
                <?php $i = 1;
                while ($my_query->have_posts()) { ?>
                    <?php $my_query->the_post(); ?>
                    <?php get_template_part('templates/loops/main-item', 'grid'); ?>
                    <?php $i++; ?>
                <?php } ?>
                <?php wp_reset_query(); ?>
                <?php wp_reset_postdata(); ?>
                <?php $kbw_post_type = $kbw_thumbnail = $kbw_style = $kbw_is_slider = $kbw_column = $kbw_column_mb = $kbw_post_meta = $kbw_excerpt = $kbw_excerpt_length = ''; // reset global var ?>
            </div>
        </div>
    </section>
<?php } ?>
