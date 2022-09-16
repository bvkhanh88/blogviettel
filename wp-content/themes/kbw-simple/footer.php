<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage kabiweb
 * @since kabiweb 1.0
 * @author Khanh Bui - bvkhanh88@gmail.com
 */

$footer_style = kbw_get_option('footer_style') ? kbw_get_option('footer_style') : 'footer-1';
$kbw_footer_container_class = kbw_get_option('footer_layout') ? esc_attr(kbw_get_option('footer_layout')) : 'container';
$footer_vars = array('%year%', '%site%', '%url%');
$footer_val = array(date('Y'), get_bloginfo('name'), home_url());
$copyright = do_shortcode('[kbw_load_option id="copyright" editor="1"]');
$copyright = str_replace($footer_vars, $footer_val, $copyright);
$copyright = htmlspecialchars_decode($copyright);
?>
</div><!--.main-container-->
<?php do_action('kbw_before_footer'); ?>
<footer id="site-footer" class="<?php echo $footer_style; ?>" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
    <div class="<?php echo $kbw_footer_container_class; ?> p-0">
        <?php kbw_get_template('footer-default.php', '/templates/footers') ?>
    </div><!--.container-->
    <div id="copyrights" class="copyrights inner text-center text-md-left">
        <div class="<?php echo $kbw_footer_container_class; ?> p-0">
            <?php echo htmlspecialchars_decode($copyright); ?>
        </div>
    </div>
</footer><!--#site-footer-->
<?php do_action('kbw_after_footer'); ?>
</div><!--/.kbw-content-->
</div><!--/#wrapper-->
<div id="topcontrol" class="fa fa-angle-up" title="Scroll To Top" data-bottom="50px"></div>
<?php wp_footer(); ?>
</body>
</html>