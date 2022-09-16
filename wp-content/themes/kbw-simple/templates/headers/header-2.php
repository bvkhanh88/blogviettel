<?php
$header_style = kbw_get_option('header_style') ? kbw_get_option('header_style') : 'header-2';
$header_style_mb = kbw_get_option('mobile_header_style') ? kbw_get_option('mobile_header_style') : 'header-mobile-1';
$kbw_header_container_class = kbw_get_option('header_layout') ? esc_attr(kbw_get_option('header_layout')) : 'container';
$kbw_logo = kbw_get_option('logo');
?>
<header id="site-header" class="<?php echo $header_style . ' ' . $header_style_mb; ?>" role="banner" itemscope itemtype="http://schema.org/WPHeader">
    <div id="header" class="header-main">
        <div class="<?php echo $kbw_header_container_class; ?> p-0">
            <div class="row-header row-flex-5">
                <div class="header-logo header-left col-lg-3">
                    <?php if ($kbw_logo != '') { ?>
                        <?php if (is_front_page() || is_home() || is_404()) { ?>
                            <h1 id="logo" class="image-logo" itemprop="headline">
                                <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($kbw_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
                            </h1><!-- END #logo -->
                        <?php } else { ?>
                            <h2 id="logo" class="image-logo" itemprop="headline">
                                <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($kbw_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
                            </h2><!-- END #logo -->
                        <?php } ?>
                    <?php } else { ?>
                        <?php if (is_front_page() || is_home() || is_404()) { ?>
                            <h1 id="logo" class="text-logo" itemprop="headline">
                                <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a>
                            </h1><!-- END #logo -->
                        <?php } else { ?>
                            <h2 id="logo" class="text-logo" itemprop="headline">
                                <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a>
                            </h2><!-- END #logo -->
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="header-menu header-right col-lg-9">
                    <div id="catcher" class="clear"></div>
                    <div id="kbw-navigation" class="sticky-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                        <button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>
                        <a href="#" id="pull" class="toggle-mobile-menu hide"><?php _e('Menu', 'kbw'); ?></a>
                        <nav class="navigation clearfix mobile-menu-wrapper">
                            <div class="nav-header mobile-only d-block d-lg-none">
                                <a href="javascript: void(0)" class="close-menu"><i class="fa fa-times-circle"></i></a>
                            </div>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'primary-menu',
                                    'menu' => '',
                                    'container' => '',
                                    'container_class' => '',
                                    'container_id' => '',
                                    'menu_class' => 'menu clearfix',
                                    'menu_id' => 'mainmenu',
                                    //'walker' => new KBW_Walker_Nav_Menu,
                                    'fallback_cb'=> false
                                )
                            );
                            ?>
                            <div class="nav-footer mobile-only d-block d-lg-none">
                                <p><?php echo esc_attr(get_bloginfo('name')); ?></p>
                                <p><?php echo esc_attr(get_bloginfo('description')); ?></p>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>