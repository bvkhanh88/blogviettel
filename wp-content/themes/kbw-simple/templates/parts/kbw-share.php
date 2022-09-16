<?php
$protocol = is_ssl() ? 'https' : 'http';
?>

<!-- kbwcustom -->
<div id="kbw_share" class="kbw-share-post">
    <ul>
        <li class="facebook">
            <div class="fb-like" data-href="" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true" data-send="true" data-show-faces="true"></div>
        </li>
        <li class="zalo-like">
            <div class="zalo-follow-only-button" data-oaid="579745863508352884"></div>
        </li>
        <li class="zalo-share">
            <div class="zalo-share-button" data-href="" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>
        </li>
        <li class="twitter">
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-text="" data-via="<?php echo kbw_get_option('share_twitter_username') ?>" data-lang="en">tweet</a>
        </li>
        <li class="linkedin">
            <script src="<?php echo $protocol ?>://platform.linkedin.com/in.js" type="text/javascript"></script>
            <script type="IN/Share" data-url="" data-counter="right"></script>
        </li>
    </ul>
</div>
