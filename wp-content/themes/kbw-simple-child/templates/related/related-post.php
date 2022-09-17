<?php
$args = kbw_related_args('post', 'category', 5);
$my_query = new WP_Query($args);

// Some option variable
$GLOBALS['kbw_post_type'] = $args['post_type'];
$GLOBALS['kbw_excerpt'] = 'yes';
$GLOBALS['kbw_excerpt_length'] = 20;

$style = 'list';
$thumbnail = 'kbw-thumbnail';
$related_column = kbw_get_option('single_related_post_column') ? kbw_get_option('single_related_post_column') : 3;

if ($my_query->have_posts()) { ?>
    <section class="related-posts mt-4 wow fadeInUp">
        <h4 class="widget-title"><span class="inline-title"><?php echo __('Related Posts', 'kbw') ?></span></h4>
        <div class="post-listing">
            <div class="listing-wrap <?php echo $style == 'grid' ? 'row row-flex-20 row-post' : 'clearfix'; ?>">
                <?php $i = $j = 1;
                while ($my_query->have_posts()) { ?>
                    <?php $my_query->the_post(); ?>
                    <?php get_template_part('templates/loops/post-item', 'list'); ?>
                    <?php $i++; ?>
                <?php } ?>
                <?php wp_reset_query(); ?>
                <?php wp_reset_postdata(); ?>
                <?php $kbw_post_type = $kbw_thumbnail = $kbw_style = $kbw_is_slider = $kbw_column = $kbw_column_mb = $kbw_post_meta = $kbw_excerpt = $kbw_excerpt_length = ''; // reset global var ?>
            </div>
        </div>
    </section>
<?php } ?>
