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

$theme_layout = kbw_get_option('theme_layout') ? kbw_get_option('theme_layout') : 'wide';
$header_style = kbw_get_option('header_style') ? kbw_get_option('header_style') : 'header-1';
$kbw_main_content_class = ' right-sidebar';
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <!--[if IE ]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <meta property="fb:app_id" content="<?php echo kbw_get_option('facebook_app_id'); ?>"/>
    <?php kbw_meta(); ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
<?php //echo '<pre>';print_r($kbw_options);echo '</pre>'; //Test Theme Options ?>

<div id="wrapper" class="kbw <?php echo $theme_layout; ?>" data-theme="light" data-layout="horizontal" data-header-position="relative" data-breadcrumb="<?php echo kbw_get_option('breadcrumbs') ? 'show' : 'hide'; ?>">
    <div class="inner-wrapper kbw-content">
        <div id="catcher-header" class="catcher-header-fixed clear"></div>
        <?php get_template_part("/templates/headers/{$header_style}"); ?>

        <div id="main-content" class="main-container<?php echo $kbw_main_content_class; ?>">
