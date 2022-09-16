<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kbwtheme
 */

if (post_password_required()) : ?>
    <p class="no-comments"><?php echo __('This post is password protected. Enter the password to view comments.', 'kbw'); ?></p>
    <?php
    return;
endif;
?>

<?php do_action('kbw_before_comments'); ?>

<div id="comments" class="comments-area">
    <?php comment_form(); ?>
    
    <?php if (have_comments()) : ?>
        <h3 class="comments-title uppercase">
            <?php
            printf( // WPCS: XSS OK.
                esc_html(_nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'kbw')),
                number_format_i18n(get_comments_number()),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h3>

        <ol class="comment-list">
            <?php wp_list_comments(array('callback' => 'kbw_comment', 'max_depth' => 2)); ?>
        </ol>
        
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'kbw'); ?></h2>
                <div class="nav-links nex-prev-nav">
                    <div class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'kbw')); ?></div>
                    <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'kbw')); ?></div>
                </div>
            </nav>
        <?php endif; // Check for comment navigation. ?>
    <?php endif; // Check for have_comments(). ?>
    
    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'kbw'); ?></p>
    <?php endif; ?>
</div>
