<?php
global $display_args;

$pid = get_the_ID();
$post_type = isset($display_args['post_type']) ? $display_args['post_type'] : 'testimonial';
$thumbnail = isset($display_args['thumbnail']) ? $display_args['thumbnail'] : 'kbw-thumbnail';
$style = isset($display_args['style']) ? $display_args['style'] : 'change-zoom';
$is_slider = isset($display_args['is_slider']) ? $display_args['is_slider'] : 'no';
$column = isset($display_args['column']) ? $display_args['column'] : 4;
$column_mb = isset($display_args['column_mb']) ? $display_args['column_mb'] : 1;
$excerpt = isset($display_args['excerpt']) ? $display_args['excerpt'] : 'yes';
$excerpt_length = isset($display_args['excerpt_length']) ? $display_args['excerpt_length'] : 20;

$elm_class = $is_slider != 'yes' ? ' col-' . (12 / $column_mb) . ' col-md-4 col-lg-' . (12 / $column) : 'w100';

$phone = get_post_meta($pid, 'testimonial_phone', true);
$email = get_post_meta($pid, 'testimonial_email', true);
$job = get_post_meta($pid, 'testimonial_job', true);
$link = get_post_meta($pid, 'testimonial_link', true);
$social = get_post_meta($pid, 'testimonial_social', true);

$excerpt_length = 300;
?>

<div <?php post_class(sprintf("item post-item grid %s", $elm_class)); ?>>
    <div class="testimonial-bg">
        <div class="testimonial-pic"><?php the_post_thumbnail($thumbnail); ?></div>
        <div class="testimonial-content">
            <div class="testimonial-text">
                <p><?php echo kbw_truncate(get_the_excerpt(get_the_ID()), $excerpt_length, 'words'); ?></p>
            </div>
            <div class="testimonial-detail">
                <p class="testimonial-name"><?php echo get_the_title(); ?></p>
                <p class="testimonial-job"><?php echo $job; ?></p>
            </div>
        </div>
        <div class="quote-right"></div>
    </div>
</div>
