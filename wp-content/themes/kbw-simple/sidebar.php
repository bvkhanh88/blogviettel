<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage kabiweb
 * @since kabiweb 1.0
 * @author Khanh Bui - bvkhanh88@gmail.com
 */
?>

<?php
$sidebar = 'sidebar';
$sidebar_location = 'left';
if ($sidebar != 'kbw_nosidebar' && $sidebar_location != 'full') {
    ?>
    <aside id="sidebar" class="sidebar" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
        <?php if (!dynamic_sidebar($sidebar)) : ?>
            <div id="sidebar-search" class="widget">
                <h3 class="widget-title"><?php _e('Search', 'kbw'); ?></h3>
                <?php get_search_form(); ?>
            </div>
            <div id="sidebar-archives" class="widget">
                <h3 class="widget-title"><?php _e('Archives', 'kbw') ?></h3>
                <ul>
                    <?php wp_get_archives('type=monthly'); ?>
                </ul>
            </div>
            <div id="sidebar-meta" class="widget">
                <h3 class="widget-title"><?php _e('Meta', 'kbw') ?></h3>
                <ul>
                    <?php wp_register(); ?>
                    <li><?php wp_loginout(); ?></li>
                    <?php wp_meta(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </aside><!--#sidebar-->
<?php } ?>
