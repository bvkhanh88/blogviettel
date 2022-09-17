<?php
/**
 * The template for displaying the header.
 * Displays everything from the doctype declaration down to the navigation.
 *
 * @package WordPress
 * @subpackage kabiweb
 * @since kabiweb 1.0
 * @author Khanh Bui - bvkhanh88@gmail.com
 */

global $kbw_options;

$layout_style = kbw_get_option('layout_style') ? kbw_get_option('layout_style') : 'wide';
$header_style = kbw_get_option('header_style') ? kbw_get_option('header_style') : 'header-1';
$kbw_main_content_class = ' right-sidebar';

$header_style = kbw_get_option('header_style') ? kbw_get_option('header_style') : 'header-1';
$header_style_mb = kbw_get_option('mobile_header_style') ? kbw_get_option('mobile_header_style') : 'header-mobile-1';
$kbw_header_container_class = kbw_get_option('header_layout') ? esc_attr(kbw_get_option('header_layout')) : 'container';
$kbw_logo = kbw_get_option('logo');
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="dns-prefetch" href="//www.facebook.com">
    <link rel="dns-prefetch" href="//connect.facebook.net">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <link rel="dns-prefetch" href="//latex.codecogs.com">
    <link rel="dns-prefetch" href="//stc.za.zaloapp.com">
    <link rel="dns-prefetch" href="//sp.zalo.me">
    <link rel="dns-prefetch" href="//platform.twitter.com">
    <link rel="dns-prefetch" href="//static.doubleclick.net">

    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <!--[if IE ]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <meta property="fb:app_id" content="<?php echo kbw_get_option('facebook_app_id'); ?>"/>
    <?php kbw_meta(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
<div id="fb-root"></div>
<?php //echo '<pre>';print_r($kbw_options);echo '</pre>'; //Test Theme Options ?>

<div id="wrapper" class="kbw <?php echo $layout_style; ?>" data-theme="light" data-layout="horizontal" data-header-position="relative" data-breadcrumb="<?php echo kbw_get_option('breadcrumbs') ? 'show' : 'hide'; ?>">
    <div class="inner-wrapper kbw-content">
        <div id="catcher-header" class="catcher-header-fixed clear"></div>
        <header id="site-header" class="<?php echo $header_style . ' ' . $header_style_mb; ?>" role="banner" itemscope itemtype="http://schema.org/WPHeader">
            <div id="header" class="header-main">
                <div class="<?php echo $kbw_header_container_class; ?> p-0">
                    <div class="row-header d-flex justify-content-between align-items-center">
                        <div class="header-logo header-left wow fadeInLeft">
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
                        <div class="header-menu header-right wow fadeInRight">
                            <div id="catcher" class="clear"></div>
                            <div id="kbw-navigation" class="sticky-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
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
                                            'fallback_cb' => false
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
                        <div class="header-language wow fadeInRight">
                            <a href="/en" class="en"><img src="<?php echo KBWCHILD_THEME_DIRECTORY_URI . '/assets/img/icons/flag-en.png' ?>" alt="English"></a>
                            <a href="/" class="vi"><img src="<?php echo KBWCHILD_THEME_DIRECTORY_URI . '/assets/img/icons/flag-2.png' ?>" alt="Vietnamese"></a>
                            <?php if (is_page_template('templates/template-landingpage.php')) { ?>
                                <div class="header-search">
                                    <a href="javascript: void(0)" class="btn-search"><img src="<?php echo KBWCHILD_THEME_DIRECTORY_URI . '/assets/img/icons/icon-search.png' ?>" alt="Search"></a>
                                </div>
                            <?php } else { ?>
                                <a href="javascript: void(0)" class="btn btn-link"><?php echo __('Get Started', 'kbw') ?></a>
                            <?php } ?>
                            <button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div id="main-content" class="main-container<?php echo $kbw_main_content_class; ?>">
