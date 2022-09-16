<p class="post-meta">
    <?php if (kbw_get_option('post_author')): ?>
        <span class="post-meta-author"><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" title=""><?php echo get_the_author() ?> </a></span>
    <?php endif; ?>
    <?php if (kbw_get_option('post_date')): ?>
        <?php kbw_get_time() ?>
    <?php endif; ?>
    <?php if (kbw_get_option('post_cats') && get_post_type(get_the_ID()) == 'post'): ?>
        <span class="post-cats"><i class="fa fa-folder"></i><?php printf('%1$s', get_the_category_list(', ')); ?></span>
    <?php endif; ?>
    <?php if (kbw_get_option('post_comments')): ?>
        <span class="post-comments"><i class="fa fa-comments"></i><?php comments_popup_link(__('Leave a comment', 'kbw'), __('1 Comment', 'kbw'), __('% Comments', 'kbw')); ?></span>
    <?php endif; ?>
    <?php if (kbw_get_option('post_views') && function_exists('kbw_views')): ?>
        <?php echo kbw_views(__('views', 'kbw')); ?>
    <?php endif; ?>
</p>