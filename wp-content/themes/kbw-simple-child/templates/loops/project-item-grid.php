<?php
global $display_args;

$pid = get_the_ID();
$related_column = kbw_get_option('single_related_cpt_column') ? kbw_get_option('single_related_cpt_column') : 3;

$post_type = isset($display_args['post_type']) ? $display_args['post_type'] : 'maincpt';
$thumbnail = isset($display_args['thumbnail']) ? $display_args['thumbnail'] : 'kbw-thumbnail';
$style = isset($display_args['style']) ? $display_args['style'] : 'change-zoom';
$is_slider = isset($display_args['is_slider']) ? $display_args['is_slider'] : 'no';
$column = isset($display_args['column']) ? $display_args['column'] : $related_column;
$column_mb = isset($display_args['column_mb']) ? $display_args['column_mb'] : 1;
$post_meta = isset($display_args['post_meta']) ? $display_args['post_meta'] : 'yes';
$excerpt = isset($display_args['excerpt']) ? $display_args['excerpt'] : 'yes';
$excerpt_length = isset($display_args['excerpt_length']) ? $display_args['excerpt_length'] : 20;

$elm_class = $is_slider != 'yes' ? ' col-' . (12 / $column_mb) . ' col-md-4 col-lg-' . (12 / $column) : 'w100';
?>

<div <?php post_class(sprintf("item post-item grid %s", $elm_class)); ?>>
    <div class="recent-item <?php echo $style; ?>">
        <?php if (function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumbnail != 'none') : ?>
            <div class="post-thumbnail">
                <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php the_post_thumbnail($thumbnail); ?>
                    <span class="fa overlay-icon"></span>
                </a>
                <?php do_action('kbw_after_main_loop_item_thumbnail', $post_type); ?>
            </div><!-- post-thumbnail /-->
        <?php else: ?>
            <div class="post-thumbnail">
                <a rel="nofollow" href="<?php the_permalink(); ?>" rel="bookmark">
                    <img src="<?php echo kbw_wp_img_src(IMG_CATALOG_DEFAULT, $thumbnail) ?>" alt="<?php echo get_the_title() ?>">
                </a>
            </div>
        <?php endif; ?>
        <div class="entry">
            <?php do_action('kbw_before_main_loop_item_title', $post_type); ?>
            <div class="label"><?php echo __('Our project', 'kbw') ?></div>
            <div class="post-box-title">
                <a href="<?php the_permalink($pid); ?>" rel="bookmark" title="<?php echo get_the_title($pid); ?>"><?php echo get_the_title($pid); ?></a>
            </div>
            <?php do_action('kbw_after_main_loop_item_title', $post_type); ?>
            <?php if ($excerpt == 'yes') : ?>
                <div class="excerpt">
                    <p><?php echo kbw_truncate(get_the_excerpt($pid), $excerpt_length, 'words'); ?></p>
                </div>
            <?php endif; ?>
            <?php do_action('kbw_after_main_loop_item_grid_excerpt', $post_type); ?>
        </div>
    </div>
</div>
