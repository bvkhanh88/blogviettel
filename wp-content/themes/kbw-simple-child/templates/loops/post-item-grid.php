<?php
global $kbw_post_type, $kbw_is_slider, $kbw_thumbnail, $kbw_style, $kbw_column, $kbw_column_mb, $kbw_post_meta, $kbw_excerpt, $kbw_excerpt_length;

$related_column = kbw_get_option('single_related_post_column') ? kbw_get_option('single_related_post_column') : 3;
if (!$kbw_post_type || $kbw_post_type == '') {
    $kbw_post_type = 'post';
}
if (!$kbw_is_slider || $kbw_is_slider == '') {
    $kbw_is_slider = 'no';
}
if (!$kbw_thumbnail || $kbw_thumbnail == '') {
    $kbw_thumbnail = 'kbw-thumbnail';
}
if (!$kbw_style || $kbw_style == '') {
    $kbw_style = 'change-zoom';
}
if (!$kbw_column || $kbw_column == '') {
    $kbw_column = $related_column;
}
if (!$kbw_column_mb || $kbw_column_mb == '') {
    $kbw_column_mb = 1;
}
if (!isset($kbw_post_meta)) {
    $kbw_post_meta = 'yes';
}
if (!isset($kbw_excerpt)) {
    $kbw_excerpt = 'yes';
}
if (!$kbw_excerpt_length || $kbw_excerpt_length == '') {
    $kbw_excerpt_length = 20;
}
$elm_class = $kbw_is_slider != 'yes' ? ' col-' . (12 / $kbw_column_mb) . ' col-md-4 col-lg-' . (12 / $kbw_column) : 'w100';
?>

<article <?php post_class(sprintf("item post-item grid %s", $elm_class)); ?>>
    <div class="recent-item <?php echo $kbw_style; ?>">
        <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $kbw_thumbnail != 'none') : ?>
            <div class="post-thumbnail">
                <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php the_post_thumbnail($kbw_thumbnail); ?>
                    <span class="fa overlay-icon"></span>
                </a>
                <?php do_action('kbw_after_post_loop_thumbnail', $kbw_post_type); ?>
            </div><!-- post-thumbnail /-->
        <?php else: ?>
            <div class="post-thumbnail">
                <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                    <img src="<?php echo kbw_wp_img_src(IMG_CATALOG_DEFAULT, $kbw_thumbnail) ?>" alt="<?php echo get_the_title() ?>">
                </a>
            </div>
        <?php endif; ?>
        <div class="entry">
            <?php do_action('kbw_before_post_loop_item_title', $kbw_post_type); ?>
            <div class="label"><?php echo __('Latest New', 'kbw') ?></div>
            <div class="post-box-title">
                <a href="<?php the_permalink($post->ID); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo get_the_title($post->ID); ?></a>
            </div>
            <?php if ($kbw_post_meta === 'yes') : ?>
                <div class="post-info">
                    <?php get_template_part('templates/parts/meta-archives'); ?>
                </div><!--.post-info-->
            <?php endif; ?>
            <?php do_action('kbw_after_post_loop_item_title', $kbw_post_type); ?>
            <?php if ($kbw_excerpt == 'yes') : ?>
                <div class="excerpt">
                    <p><?php echo kbw_truncate(get_the_excerpt($post->ID), $kbw_excerpt_length, 'words'); ?></p>
                </div>
            <?php endif; ?>
            <?php do_action('kbw_after_post_loop_item_grid_excerpt', $kbw_post_type); ?>
            <a href="<?php the_permalink(); ?>" class="view-more alink-arrow" rel="nofollow"><?php _e('Read more &raquo;', 'kbw') ?></a>
        </div>
    </div>
</article>
