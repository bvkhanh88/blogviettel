<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage kabiweb
 * @since kabiweb 1.0
 * @author Khanh Bui - bvkhanh88@gmail.com
 */

$kbw_footer_container_class = 'container';
$footer_vars = array('%year%', '%site%', '%url%');
$footer_val = array(date('Y'), get_bloginfo('name'), home_url());
$copyright = do_shortcode('[kbw_load_option id="copyright" editor="1"]');
$copyright = str_replace($footer_vars, $footer_val, $copyright);
$copyright = htmlspecialchars_decode($copyright);
?>
</div><!--.main-container-->

<?php do_action('kbw_before_footer'); ?>
<footer id="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
    <div class="inner wow fadeInUp">
        <div class="<?php echo $kbw_footer_container_class; ?> p-0">
            <div class="row row-flex-25">
                <div class="col-12 col-lg-4">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <div class="col-12 col-lg-4">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
                <div class="col-12 col-lg-4">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            </div>
        </div><!--.container-->
    </div>
    <div id="copyrights" class="copyrights inner text-center">
        <div class="<?php echo $kbw_footer_container_class; ?> p-0">
            <?php echo $copyright; ?>
        </div>
    </div>
</footer><!--#site-footer-->
<?php do_action('kbw_after_footer'); ?>

</div><!--/.kbw-content-->
</div><!--/#wrapper-->

<div id="topcontrol" class="fa fa-angle-up" title="Scroll To Top"></div>
<!-- kbw-contactus -->
<?php wp_footer(); ?>
</body>
</html>