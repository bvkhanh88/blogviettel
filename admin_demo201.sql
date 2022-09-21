-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2022 at 09:52 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_demo201`
--

-- --------------------------------------------------------

--
-- Table structure for table `kbw_commentmeta`
--

CREATE TABLE `kbw_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kbw_comments`
--

CREATE TABLE `kbw_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kbw_links`
--

CREATE TABLE `kbw_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kbw_options`
--

CREATE TABLE `kbw_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_options`
--

INSERT INTO `kbw_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://demo201.kabiweb.com', 'yes'),
(2, 'home', 'http://demo201.kabiweb.com', 'yes'),
(3, 'blogname', 'Viettel Data Platform', 'yes'),
(4, 'blogdescription', 'Nền tảng công nghệ hoàn chỉnh', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'bvkhanh88@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'd/m/Y', 'yes'),
(24, 'time_format', 'H:i', 'yes'),
(25, 'links_updated_date_format', 'j F, Y g:i a', 'yes'),
(26, 'comment_moderation', '', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:5:{i:0;s:21:\"polylang/polylang.php\";i:1;s:36:\"contact-form-7/wp-contact-form-7.php\";i:2;s:27:\"js_composer/js_composer.php\";i:3;s:47:\"regenerate-thumbnails/regenerate-thumbnails.php\";i:4;s:53:\"velvet-blues-update-urls/velvet-blues-update-urls.php\";}', 'yes'),
(34, 'category_base', '/chuyen-muc', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '7', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'kbw-simple', 'yes'),
(41, 'stylesheet', 'kbw-simple-child', 'yes'),
(42, 'comment_registration', '', 'yes'),
(43, 'html_type', 'text/html', 'yes'),
(44, 'use_trackback', '0', 'yes'),
(45, 'default_role', 'subscriber', 'yes'),
(46, 'db_version', '53496', 'yes'),
(47, 'uploads_use_yearmonth_folders', '1', 'yes'),
(48, 'upload_path', '', 'yes'),
(49, 'blog_public', '1', 'yes'),
(50, 'default_link_category', '2', 'yes'),
(51, 'show_on_front', 'page', 'yes'),
(52, 'tag_base', '/tag', 'yes'),
(53, 'show_avatars', '1', 'yes'),
(54, 'avatar_rating', 'G', 'yes'),
(55, 'upload_url_path', '', 'yes'),
(56, 'thumbnail_size_w', '150', 'yes'),
(57, 'thumbnail_size_h', '150', 'yes'),
(58, 'thumbnail_crop', '1', 'yes'),
(59, 'medium_size_w', '0', 'yes'),
(60, 'medium_size_h', '0', 'yes'),
(61, 'avatar_default', 'mystery', 'yes'),
(62, 'large_size_w', '0', 'yes'),
(63, 'large_size_h', '0', 'yes'),
(64, 'image_default_link_type', 'none', 'yes'),
(65, 'image_default_size', '', 'yes'),
(66, 'image_default_align', '', 'yes'),
(67, 'close_comments_for_old_posts', '', 'yes'),
(68, 'close_comments_days_old', '14', 'yes'),
(69, 'thread_comments', '1', 'yes'),
(70, 'thread_comments_depth', '5', 'yes'),
(71, 'page_comments', '', 'yes'),
(72, 'comments_per_page', '50', 'yes'),
(73, 'default_comments_page', 'newest', 'yes'),
(74, 'comment_order', 'asc', 'yes'),
(75, 'sticky_posts', 'a:0:{}', 'yes'),
(76, 'widget_categories', 'a:0:{}', 'yes'),
(77, 'widget_text', 'a:6:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:4:\"text\";s:232:\"<img class=\"alignnone size-full wp-image-21\" src=\"/wp-content/uploads/2022/09/logo.png\" alt=\"\" width=\"191\" height=\"56\" />\r\n\r\nTellus nibh lacus, quis lobortis volutpat aliquam. Vivamus elit magna tellus, orci libero proin tortor, ...\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;}i:3;a:5:{s:5:\"title\";s:7:\"Company\";s:4:\"text\";s:168:\"<a href=\"/gioi-thieu\">Giới thiệu</a>\r\n\r\n<a href=\"/tai-lieu\">Tài liệu</a>\r\n\r\n<a href=\"##\">Service</a>\r\n\r\n<a href=\"/blog\">Blog</a>\r\n\r\n<a href=\"##\">Case Studies</a>\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;s:8:\"pll_lang\";s:2:\"vi\";}i:4;a:5:{s:5:\"title\";s:8:\"Resource\";s:4:\"text\";s:168:\"<a href=\"/gioi-thieu\">Giới thiệu</a>\r\n\r\n<a href=\"/tai-lieu\">Tài liệu</a>\r\n\r\n<a href=\"##\">Service</a>\r\n\r\n<a href=\"/blog\">Blog</a>\r\n\r\n<a href=\"##\">Case Studies</a>\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;s:8:\"pll_lang\";s:2:\"vi\";}i:5;a:5:{s:5:\"title\";s:7:\"Company\";s:4:\"text\";s:179:\"<a href=\"/en/about-us\">About us</a>\r\n\r\n<a href=\"/en/documentation\">Documentation</a>\r\n\r\n<a href=\"##\">Service</a>\r\n\r\n<a href=\"/en/blog-en\">Blog</a>\r\n\r\n<a href=\"##\">Case Studies</a>\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;s:8:\"pll_lang\";s:2:\"en\";}i:6;a:5:{s:5:\"title\";s:8:\"Resource\";s:4:\"text\";s:179:\"<a href=\"/en/about-us\">About us</a>\r\n\r\n<a href=\"/en/documentation\">Documentation</a>\r\n\r\n<a href=\"##\">Service</a>\r\n\r\n<a href=\"/en/blog-en\">Blog</a>\r\n\r\n<a href=\"##\">Case Studies</a>\";s:6:\"filter\";b:1;s:6:\"visual\";b:1;s:8:\"pll_lang\";s:2:\"en\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(78, 'widget_rss', 'a:0:{}', 'yes'),
(79, 'uninstall_plugins', 'a:0:{}', 'no'),
(80, 'timezone_string', '', 'yes'),
(81, 'page_for_posts', '0', 'yes'),
(82, 'page_on_front', '2', 'yes'),
(83, 'default_post_format', '0', 'yes'),
(84, 'link_manager_enabled', '0', 'yes'),
(85, 'finished_splitting_shared_terms', '1', 'yes'),
(86, 'site_icon', '0', 'yes'),
(87, 'medium_large_size_w', '0', 'yes'),
(88, 'medium_large_size_h', '0', 'yes'),
(89, 'wp_page_for_privacy_policy', '3', 'yes'),
(90, 'show_comments_cookies_opt_in', '1', 'yes'),
(91, 'admin_email_lifespan', '1666252942', 'yes'),
(92, 'disallowed_keys', '', 'no'),
(93, 'comment_previously_approved', '1', 'yes'),
(94, 'auto_plugin_theme_update_emails', 'a:0:{}', 'no'),
(95, 'auto_update_core_dev', 'enabled', 'yes'),
(96, 'auto_update_core_minor', 'enabled', 'yes'),
(97, 'auto_update_core_major', 'enabled', 'yes'),
(98, 'wp_force_deactivated_plugins', 'a:0:{}', 'yes'),
(99, 'initial_db_version', '49752', 'yes'),
(100, 'kbw_user_roles', 'a:6:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:73:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:19:\"access_kingcomposer\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:0;s:31:\"vc_access_rules_unfiltered_html\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:24:\"vc_access_rules_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:45:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:19:\"access_kingcomposer\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:0;s:31:\"vc_access_rules_unfiltered_html\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:20:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:0;s:31:\"vc_access_rules_unfiltered_html\";b:0;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:15:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:0;s:31:\"vc_access_rules_frontend_editor\";b:0;s:31:\"vc_access_rules_unfiltered_html\";b:0;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:0;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:12:\"kbw_busowner\";a:2:{s:4:\"name\";s:18:\"KBW Business Owner\";s:12:\"capabilities\";a:16:{s:4:\"read\";b:1;s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:12:\"read_product\";b:1;s:13:\"edit_products\";b:1;s:23:\"edit_published_products\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:0;s:31:\"vc_access_rules_frontend_editor\";b:0;s:31:\"vc_access_rules_unfiltered_html\";b:0;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:0;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}}', 'yes'),
(101, 'fresh_site', '0', 'yes'),
(102, 'WPLANG', 'vi', 'yes'),
(103, 'widget_block', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'sidebars_widgets', 'a:7:{s:19:\"wp_inactive_widgets\";a:0:{}s:7:\"sidebar\";a:2:{i:0;s:18:\"kbw_posts_widget-2\";i:1;s:18:\"kbw_posts_widget-3\";}s:8:\"footer-1\";a:1:{i:0;s:6:\"text-2\";}s:8:\"footer-2\";a:2:{i:0;s:6:\"text-3\";i:1;s:6:\"text-5\";}s:8:\"footer-3\";a:2:{i:0;s:6:\"text-4\";i:1;s:6:\"text-6\";}s:8:\"footer-4\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(105, 'cron', 'a:9:{i:1663729970;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1663730425;a:1:{s:21:\"wp_update_user_counts\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1663733137;a:1:{s:19:\"kbw_twicedaily_cron\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1663769569;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1663769570;a:5:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}s:18:\"wp_https_detection\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1663769614;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1663769616;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1663770643;a:1:{s:19:\"hkt_twicedaily_cron\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}s:7:\"version\";i:2;}', 'yes'),
(106, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_archives', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'widget_meta', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(114, 'widget_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(115, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(116, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(117, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(119, 'recovery_keys', 'a:0:{}', 'yes'),
(120, 'https_detection_errors', 'a:2:{s:23:\"ssl_verification_failed\";a:1:{i:0;s:36:\"Xác thực SSL không thành công.\";}s:19:\"bad_response_source\";a:1:{i:0;s:61:\"Có vẻ như phản hồi không đến từ trang web này.\";}}', 'yes'),
(121, 'theme_mods_twentytwentyone', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1634049039;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}}}}', 'yes'),
(144, 'recently_activated', 'a:0:{}', 'yes'),
(156, 'finished_updating_comment_type', '1', 'yes'),
(157, 'new_admin_email', 'bvkhanh88@gmail.com', 'yes'),
(174, 'wpcf7', 'a:2:{s:7:\"version\";s:5:\"5.6.3\";s:13:\"bulk_validate\";a:4:{s:9:\"timestamp\";i:1660037710;s:7:\"version\";s:5:\"5.6.1\";s:11:\"count_valid\";i:1;s:13:\"count_invalid\";i:0;}}', 'yes'),
(179, 'kc_options', 'a:3:{s:9:\"max_width\";s:6:\"1200px\";s:8:\"css_code\";s:0:\"\";s:7:\"license\";s:0:\"\";}', 'no'),
(181, 'widget_kc_widget_content', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(195, 'current_theme', 'Kabiweb Developer', 'yes'),
(196, 'theme_mods_hkt-simple-child', 'a:4:{i:0;b:0;s:18:\"nav_menu_locations\";a:1:{s:12:\"primary-menu\";i:2;}s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1634357135;s:4:\"data\";a:6:{s:19:\"wp_inactive_widgets\";a:0:{}s:7:\"sidebar\";a:1:{i:0;s:18:\"hkt_posts_widget-2\";}s:8:\"footer-1\";a:0:{}s:8:\"footer-2\";a:0:{}s:8:\"footer-3\";a:0:{}s:8:\"footer-4\";a:0:{}}}}', 'yes'),
(197, 'theme_switched', '', 'yes'),
(198, 'redux_version_upgraded_from', '3.6.18', 'yes'),
(199, 'widget_hkt-facebook-widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(200, 'widget_hkt_posts_widget', 'a:2:{i:2;a:10:{s:5:\"title\";s:17:\"Bài viết mới\";s:7:\"cats_id\";s:1:\"0\";s:12:\"title_length\";i:7;s:3:\"qty\";i:5;s:4:\"date\";i:1;s:10:\"show_thumb\";i:1;s:10:\"box_layout\";s:16:\"horizontal-small\";s:12:\"show_excerpt\";i:0;s:14:\"excerpt_length\";i:10;s:4:\"type\";s:6:\"recent\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(201, 'widget_hkt_maincpt_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(203, 'kbw_simple', 'a:35:{s:12:\"theme_layout\";s:4:\"wide\";s:11:\"main_layout\";s:5:\"right\";s:4:\"logo\";s:36:\"/wp-content/uploads/2022/09/logo.png\";s:7:\"favicon\";s:39:\"/wp-content/uploads/2022/09/favicon.png\";s:7:\"hotline\";s:12:\"0968.909.308\";s:5:\"phone\";s:12:\"0968.909.308\";s:5:\"email\";s:19:\"bvkhanh88@gmail.com\";s:7:\"address\";s:23:\"HV Nong Nghiep Viet Nam\";s:9:\"address_2\";s:14:\"Gia Lam, Hanoi\";s:13:\"kbw-thumbnail\";a:2:{i:0;s:3:\"406\";i:1;s:3:\"302\";}s:9:\"kbw-small\";a:2:{i:0;s:3:\"150\";i:1;s:3:\"150\";}s:13:\"header_layout\";s:9:\"container\";s:12:\"header_style\";s:8:\"header-1\";s:19:\"mobile_header_style\";s:15:\"header-mobile-1\";s:23:\"mobile_header_menu_drop\";s:18:\"menu-drop-dropdown\";s:13:\"footer_layout\";s:9:\"container\";s:12:\"footer_style\";s:8:\"footer-1\";s:12:\"maincpt-slug\";s:7:\"maincpt\";s:12:\"maincpt-name\";s:7:\"Maincpt\";s:21:\"maincpt-singular-name\";s:7:\"Maincpt\";s:16:\"maincpt-cat-name\";s:16:\"Maincpt Category\";s:17:\"maincpt-cats-name\";s:18:\"Maincpt Categories\";s:16:\"maincpt-cat-slug\";s:11:\"maincpt-cat\";s:18:\"maincpt-skill-name\";s:13:\"Maincpt Skill\";s:19:\"maincpt-skills-name\";s:14:\"Maincpt Skills\";s:18:\"maincpt-skill-slug\";s:13:\"maincpt-skill\";s:15:\"facebook_app_id\";s:16:\"1524800134509668\";s:11:\"fanpage_url\";s:43:\"https://www.facebook.com/facebookappVietnam\";s:10:\"responsive\";s:4:\"true\";s:20:\"custom_wp_image_size\";s:4:\"true\";s:10:\"post_views\";s:4:\"true\";s:18:\"enable-testimonial\";s:4:\"true\";s:9:\"copyright\";s:134:\"Copyright ©️ 2022 - Xây dựng bởi Ban Quản trị Dữ liệu - Tập đoàn Công Nghiệp Viễn Thông Quân đội Viettel\";s:8:\"module_1\";s:14:\"Gia Lam, Hanoi\";s:15:\"link_getstarted\";s:27:\"http://demo201.kabiweb.com/\";}', 'yes'),
(210, 'theme_mods_hkt-simple', 'a:4:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1634049802;s:4:\"data\";a:6:{s:19:\"wp_inactive_widgets\";a:0:{}s:7:\"sidebar\";a:5:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";i:3;s:7:\"block-5\";i:4;s:7:\"block-6\";}s:8:\"footer-1\";a:0:{}s:8:\"footer-2\";a:0:{}s:8:\"footer-3\";a:0:{}s:8:\"footer-4\";a:0:{}}}}', 'yes'),
(220, 'secret_key', 'oOwlr<(hHSl*TA}]}jslq*vtmSJq)#a5-]C>;)CX{Sz~1uwG|Aq>/P7_hXv>1- }', 'no'),
(221, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:\"auto_add\";a:0:{}}', 'yes'),
(235, 'theme_mods_kbw-simple-child', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:3:{s:12:\"primary-menu\";i:2;s:11:\"footer-menu\";i:0;s:6:\"mobile\";i:0;}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(236, 'widget_kbw-facebook-widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(237, 'widget_kbw_posts_widget', 'a:3:{i:2;a:11:{s:5:\"title\";s:17:\"Bài viết mới\";s:7:\"cats_id\";s:1:\"0\";s:12:\"title_length\";i:7;s:3:\"qty\";i:5;s:4:\"date\";i:1;s:10:\"show_thumb\";i:1;s:10:\"box_layout\";s:16:\"horizontal-small\";s:12:\"show_excerpt\";i:0;s:14:\"excerpt_length\";i:10;s:4:\"type\";s:6:\"recent\";s:8:\"pll_lang\";s:2:\"vi\";}i:3;a:11:{s:5:\"title\";s:12:\"Recent Posts\";s:7:\"cats_id\";s:1:\"0\";s:12:\"title_length\";i:15;s:3:\"qty\";i:5;s:4:\"date\";i:1;s:10:\"show_thumb\";i:1;s:10:\"box_layout\";s:16:\"horizontal-small\";s:12:\"show_excerpt\";i:0;s:14:\"excerpt_length\";i:10;s:4:\"type\";s:6:\"recent\";s:8:\"pll_lang\";s:2:\"en\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(238, 'widget_kbw_maincpt_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(240, 'kbw_active', '3.0', 'yes'),
(250, '_transient_health-check-site-status-result', '{\"good\":13,\"recommended\":4,\"critical\":2}', 'yes'),
(342, 'dismissed_update_core', 'a:1:{s:8:\"5.8.2|vi\";b:1;}', 'no'),
(459, 'db_upgraded', '', 'yes'),
(706, 'vc_version', '6.9.0', 'yes'),
(707, 'wpb_js_composer_license_activation_notified', 'yes', 'yes'),
(708, 'wpb_js_google_fonts_subsets', 'a:1:{i:0;s:5:\"latin\";}', 'yes'),
(709, 'wpb_js_gutenberg_disable', '1', 'yes'),
(710, 'wpb_js_default_template_post_type', 'a:0:{}', 'yes'),
(745, 'user_count', '1', 'no'),
(748, 'can_compress_scripts', '1', 'no'),
(893, 'wp_calendar_block_has_published_posts', '1', 'yes'),
(1007, '_site_transient_timeout_browser_620eeaccf0f03dc51ea5a9f1f3fb4360', '1663818096', 'no'),
(1008, '_site_transient_browser_620eeaccf0f03dc51ea5a9f1f3fb4360', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:9:\"105.0.0.0\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(1034, 'polylang', 'a:16:{s:7:\"browser\";i:0;s:7:\"rewrite\";i:1;s:12:\"hide_default\";i:1;s:10:\"force_lang\";i:1;s:13:\"redirect_lang\";i:1;s:13:\"media_support\";b:0;s:9:\"uninstall\";i:0;s:4:\"sync\";a:0:{}s:10:\"post_types\";a:1:{i:0;s:7:\"project\";}s:10:\"taxonomies\";a:0:{}s:7:\"domains\";a:0:{}s:7:\"version\";s:5:\"3.2.7\";s:16:\"first_activation\";i:1663233251;s:12:\"default_lang\";s:2:\"vi\";s:9:\"nav_menus\";a:1:{s:16:\"kbw-simple-child\";a:3:{s:12:\"primary-menu\";a:2:{s:2:\"vi\";i:2;s:2:\"en\";i:19;}s:11:\"footer-menu\";a:2:{s:2:\"vi\";i:0;s:2:\"en\";i:0;}s:6:\"mobile\";a:2:{s:2:\"vi\";i:0;s:2:\"en\";i:0;}}}s:16:\"previous_version\";s:5:\"3.2.6\";}', 'yes'),
(1035, 'polylang_wpml_strings', 'a:0:{}', 'yes'),
(1036, 'widget_polylang', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(1050, 'pll_dismissed_notices', 'a:2:{i:0;s:6:\"wizard\";i:1;s:8:\"lingotek\";}', 'yes'),
(1188, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:62:\"https://downloads.wordpress.org/release/vi/wordpress-6.0.2.zip\";s:6:\"locale\";s:2:\"vi\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:62:\"https://downloads.wordpress.org/release/vi/wordpress-6.0.2.zip\";s:10:\"no_content\";s:0:\"\";s:11:\"new_bundled\";s:0:\"\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:5:\"6.0.2\";s:7:\"version\";s:5:\"6.0.2\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.9\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1663728653;s:15:\"version_checked\";s:5:\"6.0.2\";s:12:\"translations\";a:0:{}}', 'no'),
(1189, '_site_transient_update_themes', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1663722501;s:7:\"checked\";a:3:{s:16:\"kbw-simple-child\";s:3:\"2.1\";s:10:\"kbw-simple\";s:3:\"3.1\";s:15:\"twentytwentytwo\";s:3:\"1.2\";}s:8:\"response\";a:0:{}s:9:\"no_update\";a:1:{s:15:\"twentytwentytwo\";a:6:{s:5:\"theme\";s:15:\"twentytwentytwo\";s:11:\"new_version\";s:3:\"1.2\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentytwentytwo/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentytwentytwo.1.2.zip\";s:8:\"requires\";s:3:\"5.9\";s:12:\"requires_php\";s:3:\"5.6\";}}s:12:\"translations\";a:0:{}}', 'no'),
(1207, 'testimonial_type_children', 'a:0:{}', 'yes'),
(1301, '_site_transient_timeout_php_check_d4508776add2ac959ef9a5d5285e77c3', '1663911701', 'no'),
(1302, '_site_transient_php_check_d4508776add2ac959ef9a5d5285e77c3', 'a:5:{s:19:\"recommended_version\";s:3:\"7.4\";s:15:\"minimum_version\";s:6:\"5.6.20\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no'),
(1386, 'recovery_mode_email_last_sent', '1663381604', 'yes'),
(1454, '_site_transient_timeout_php_check_2f5acf219326a8bc5331ee302b9812f4', '1663992555', 'no'),
(1455, '_site_transient_php_check_2f5acf219326a8bc5331ee302b9812f4', 'a:5:{s:19:\"recommended_version\";s:3:\"7.4\";s:15:\"minimum_version\";s:6:\"5.6.20\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no'),
(1716, 'category_children', 'a:0:{}', 'yes'),
(1817, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1663728653;s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:7:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:3:\"5.0\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:54:\"https://downloads.wordpress.org/plugin/akismet.5.0.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:59:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272\";s:2:\"1x\";s:59:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:61:\"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.0\";}s:36:\"contact-form-7/wp-contact-form-7.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:28:\"w.org/plugins/contact-form-7\";s:4:\"slug\";s:14:\"contact-form-7\";s:6:\"plugin\";s:36:\"contact-form-7/wp-contact-form-7.php\";s:11:\"new_version\";s:5:\"5.6.3\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/contact-form-7/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/plugin/contact-form-7.5.6.3.zip\";s:5:\"icons\";a:3:{s:2:\"2x\";s:67:\"https://ps.w.org/contact-form-7/assets/icon-256x256.png?rev=2279696\";s:2:\"1x\";s:59:\"https://ps.w.org/contact-form-7/assets/icon.svg?rev=2339255\";s:3:\"svg\";s:59:\"https://ps.w.org/contact-form-7/assets/icon.svg?rev=2339255\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:69:\"https://ps.w.org/contact-form-7/assets/banner-1544x500.png?rev=860901\";s:2:\"1x\";s:68:\"https://ps.w.org/contact-form-7/assets/banner-772x250.png?rev=880427\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.9\";}s:45:\"contact-form-entries/contact-form-entries.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:34:\"w.org/plugins/contact-form-entries\";s:4:\"slug\";s:20:\"contact-form-entries\";s:6:\"plugin\";s:45:\"contact-form-entries/contact-form-entries.php\";s:11:\"new_version\";s:5:\"1.2.8\";s:3:\"url\";s:51:\"https://wordpress.org/plugins/contact-form-entries/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/plugin/contact-form-entries.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:73:\"https://ps.w.org/contact-form-entries/assets/icon-256x256.png?rev=1926543\";s:2:\"1x\";s:73:\"https://ps.w.org/contact-form-entries/assets/icon-128x128.png?rev=1926543\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:75:\"https://ps.w.org/contact-form-entries/assets/banner-772x250.png?rev=1926543\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"3.8\";}s:9:\"hello.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:5:\"1.7.2\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/hello-dolly.1.7.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=2052855\";s:2:\"1x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=2052855\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/hello-dolly/assets/banner-1544x500.jpg?rev=2645582\";s:2:\"1x\";s:66:\"https://ps.w.org/hello-dolly/assets/banner-772x250.jpg?rev=2052855\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.6\";}s:21:\"polylang/polylang.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:22:\"w.org/plugins/polylang\";s:4:\"slug\";s:8:\"polylang\";s:6:\"plugin\";s:21:\"polylang/polylang.php\";s:11:\"new_version\";s:5:\"3.2.7\";s:3:\"url\";s:39:\"https://wordpress.org/plugins/polylang/\";s:7:\"package\";s:57:\"https://downloads.wordpress.org/plugin/polylang.3.2.7.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:61:\"https://ps.w.org/polylang/assets/icon-256x256.png?rev=1331499\";s:2:\"1x\";s:61:\"https://ps.w.org/polylang/assets/icon-128x128.png?rev=1331499\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/polylang/assets/banner-1544x500.png?rev=1405299\";s:2:\"1x\";s:63:\"https://ps.w.org/polylang/assets/banner-772x250.png?rev=1405299\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.6\";}s:47:\"regenerate-thumbnails/regenerate-thumbnails.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:35:\"w.org/plugins/regenerate-thumbnails\";s:4:\"slug\";s:21:\"regenerate-thumbnails\";s:6:\"plugin\";s:47:\"regenerate-thumbnails/regenerate-thumbnails.php\";s:11:\"new_version\";s:5:\"3.1.5\";s:3:\"url\";s:52:\"https://wordpress.org/plugins/regenerate-thumbnails/\";s:7:\"package\";s:70:\"https://downloads.wordpress.org/plugin/regenerate-thumbnails.3.1.5.zip\";s:5:\"icons\";a:1:{s:2:\"1x\";s:74:\"https://ps.w.org/regenerate-thumbnails/assets/icon-128x128.png?rev=1753390\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:77:\"https://ps.w.org/regenerate-thumbnails/assets/banner-1544x500.jpg?rev=1753390\";s:2:\"1x\";s:76:\"https://ps.w.org/regenerate-thumbnails/assets/banner-772x250.jpg?rev=1753390\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.7\";}s:53:\"velvet-blues-update-urls/velvet-blues-update-urls.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:38:\"w.org/plugins/velvet-blues-update-urls\";s:4:\"slug\";s:24:\"velvet-blues-update-urls\";s:6:\"plugin\";s:53:\"velvet-blues-update-urls/velvet-blues-update-urls.php\";s:11:\"new_version\";s:6:\"3.2.10\";s:3:\"url\";s:55:\"https://wordpress.org/plugins/velvet-blues-update-urls/\";s:7:\"package\";s:74:\"https://downloads.wordpress.org/plugin/velvet-blues-update-urls.3.2.10.zip\";s:5:\"icons\";a:1:{s:7:\"default\";s:75:\"https://s.w.org/plugins/geopattern-icon/velvet-blues-update-urls_727172.svg\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:78:\"https://ps.w.org/velvet-blues-update-urls/assets/banner-772x250.jpg?rev=486343\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.5\";}}s:7:\"checked\";a:8:{s:19:\"akismet/akismet.php\";s:3:\"5.0\";s:36:\"contact-form-7/wp-contact-form-7.php\";s:5:\"5.6.3\";s:45:\"contact-form-entries/contact-form-entries.php\";s:5:\"1.2.8\";s:9:\"hello.php\";s:5:\"1.7.2\";s:21:\"polylang/polylang.php\";s:5:\"3.2.7\";s:47:\"regenerate-thumbnails/regenerate-thumbnails.php\";s:5:\"3.1.5\";s:53:\"velvet-blues-update-urls/velvet-blues-update-urls.php\";s:6:\"3.2.10\";s:27:\"js_composer/js_composer.php\";s:5:\"6.9.0\";}}', 'no'),
(1818, '_transient_pll_languages_list', 'a:2:{i:0;a:24:{s:7:\"term_id\";i:7;s:4:\"name\";s:14:\"Tiếng Việt\";s:4:\"slug\";s:2:\"vi\";s:10:\"term_group\";i:0;s:16:\"term_taxonomy_id\";i:7;s:5:\"count\";i:13;s:10:\"tl_term_id\";i:8;s:19:\"tl_term_taxonomy_id\";i:8;s:8:\"tl_count\";i:5;s:6:\"locale\";s:2:\"vi\";s:6:\"is_rtl\";i:0;s:3:\"w3c\";s:2:\"vi\";s:8:\"facebook\";s:5:\"vi_VN\";s:8:\"home_url\";s:27:\"http://demo201.kabiweb.com/\";s:10:\"search_url\";s:27:\"http://demo201.kabiweb.com/\";s:4:\"host\";N;s:5:\"mo_id\";s:2:\"74\";s:13:\"page_on_front\";i:2;s:14:\"page_for_posts\";b:0;s:9:\"flag_code\";s:2:\"vn\";s:8:\"flag_url\";s:67:\"http://demo201.kabiweb.com/wp-content/plugins/polylang/flags/vn.png\";s:4:\"flag\";s:435:\"<img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAATlBMVEX+AAD2AADvAQH/eXn+cXL9amr8YmL9Wlr8UlL7TkvoAAD8d0f6Pz/3ODf2Ly/0KSf6R0f6wTv60T31IBz6+jr4+Cv3QybzEhL4bizhAADgATv8AAAAW0lEQVR4AQXBgU3DQBRAMb+7jwKVUPefkQEQTYJqByBENpKUGoZslXoN5LPONH8G9WWZ7pGlOn6XZmaGRce1J/seei4dl+7dPWDqkk7+58e3+igdlySPcYbwBG+lPhCjrtt9EgAAAABJRU5ErkJggg==\" alt=\"Tiếng Việt\" width=\"16\" height=\"11\" style=\"width: 16px; height: 11px;\" />\";s:15:\"custom_flag_url\";N;s:11:\"custom_flag\";N;}i:1;a:24:{s:7:\"term_id\";i:10;s:4:\"name\";s:7:\"English\";s:4:\"slug\";s:2:\"en\";s:10:\"term_group\";i:0;s:16:\"term_taxonomy_id\";i:10;s:5:\"count\";i:11;s:10:\"tl_term_id\";i:11;s:19:\"tl_term_taxonomy_id\";i:11;s:8:\"tl_count\";i:3;s:6:\"locale\";s:5:\"en_GB\";s:6:\"is_rtl\";i:0;s:3:\"w3c\";s:5:\"en-GB\";s:8:\"facebook\";s:5:\"en_GB\";s:8:\"home_url\";s:30:\"http://demo201.kabiweb.com/en/\";s:10:\"search_url\";s:30:\"http://demo201.kabiweb.com/en/\";s:4:\"host\";N;s:5:\"mo_id\";s:2:\"75\";s:13:\"page_on_front\";i:76;s:14:\"page_for_posts\";b:0;s:9:\"flag_code\";s:2:\"gb\";s:8:\"flag_url\";s:67:\"http://demo201.kabiweb.com/wp-content/plugins/polylang/flags/gb.png\";s:4:\"flag\";s:636:\"<img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAt1BMVEWSmb66z+18msdig8La3u+tYX9IaLc7W7BagbmcUW+kqMr/q6n+//+hsNv/lIr/jIGMnNLJyOP9/fyQttT/wb3/////aWn+YWF5kNT0oqz0i4ueqtIZNJjhvt/8gn//WVr/6+rN1+o9RKZwgcMPJpX/VFT9UEn+RUX8Ozv2Ly+FGzdYZrfU1e/8LS/lQkG/mbVUX60AE231hHtcdMb0mp3qYFTFwNu3w9prcqSURGNDaaIUMX5FNW5wYt7AAAAAjklEQVR4AR3HNUJEMQCGwf+L8RR36ajR+1+CEuvRdd8kK9MNAiRQNgJmVDAt1yM6kSzYVJUsPNssAk5N7ZFKjVNFAY4co6TAOI+kyQm+LFUEBEKKzuWUNB7rSH/rSnvOulOGk+QlXTBqMIrfYX4tSe2nP3iRa/KNK7uTmWJ5a9+erZ3d+18od4ytiZdvZyuKWy8o3UpTVAAAAABJRU5ErkJggg==\" alt=\"English\" width=\"16\" height=\"11\" style=\"width: 16px; height: 11px;\" />\";s:15:\"custom_flag_url\";N;s:11:\"custom_flag\";N;}}', 'yes');
INSERT INTO `kbw_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1819, 'rewrite_rules', 'a:245:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:53:\"^(en)/wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:92:\"index.php?lang=$matches[1]&sitemap=$matches[2]&sitemap-subtype=$matches[3]&paged=$matches[4]\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:39:\"^(en)/wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:64:\"index.php?lang=$matches[1]&sitemap=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:15:\"(en)/project/?$\";s:44:\"index.php?lang=$matches[1]&post_type=project\";s:10:\"project/?$\";s:35:\"index.php?lang=vi&post_type=project\";s:45:\"(en)/project/feed/(feed|rdf|rss|rss2|atom)/?$\";s:61:\"index.php?lang=$matches[1]&post_type=project&feed=$matches[2]\";s:40:\"project/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?lang=vi&post_type=project&feed=$matches[1]\";s:40:\"(en)/project/(feed|rdf|rss|rss2|atom)/?$\";s:61:\"index.php?lang=$matches[1]&post_type=project&feed=$matches[2]\";s:35:\"project/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?lang=vi&post_type=project&feed=$matches[1]\";s:32:\"(en)/project/page/([0-9]{1,})/?$\";s:62:\"index.php?lang=$matches[1]&post_type=project&paged=$matches[2]\";s:27:\"project/page/([0-9]{1,})/?$\";s:53:\"index.php?lang=vi&post_type=project&paged=$matches[1]\";s:54:\"(en)/chuyen-muc/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:69:\"index.php?lang=$matches[1]&category_name=$matches[2]&feed=$matches[3]\";s:49:\"chuyen-muc/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:49:\"(en)/chuyen-muc/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:69:\"index.php?lang=$matches[1]&category_name=$matches[2]&feed=$matches[3]\";s:44:\"chuyen-muc/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:30:\"(en)/chuyen-muc/(.+?)/embed/?$\";s:63:\"index.php?lang=$matches[1]&category_name=$matches[2]&embed=true\";s:25:\"chuyen-muc/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:42:\"(en)/chuyen-muc/(.+?)/page/?([0-9]{1,})/?$\";s:70:\"index.php?lang=$matches[1]&category_name=$matches[2]&paged=$matches[3]\";s:37:\"chuyen-muc/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:24:\"(en)/chuyen-muc/(.+?)/?$\";s:52:\"index.php?lang=$matches[1]&category_name=$matches[2]\";s:19:\"chuyen-muc/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:49:\"(en)/tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:59:\"index.php?lang=$matches[1]&tag=$matches[2]&feed=$matches[3]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:44:\"(en)/tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:59:\"index.php?lang=$matches[1]&tag=$matches[2]&feed=$matches[3]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:25:\"(en)/tag/([^/]+)/embed/?$\";s:53:\"index.php?lang=$matches[1]&tag=$matches[2]&embed=true\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:37:\"(en)/tag/([^/]+)/page/?([0-9]{1,})/?$\";s:60:\"index.php?lang=$matches[1]&tag=$matches[2]&paged=$matches[3]\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:19:\"(en)/tag/([^/]+)/?$\";s:42:\"index.php?lang=$matches[1]&tag=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:50:\"(en)/type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:67:\"index.php?lang=$matches[1]&post_format=$matches[2]&feed=$matches[3]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:58:\"index.php?lang=vi&post_format=$matches[1]&feed=$matches[2]\";s:45:\"(en)/type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:67:\"index.php?lang=$matches[1]&post_format=$matches[2]&feed=$matches[3]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:58:\"index.php?lang=vi&post_format=$matches[1]&feed=$matches[2]\";s:26:\"(en)/type/([^/]+)/embed/?$\";s:61:\"index.php?lang=$matches[1]&post_format=$matches[2]&embed=true\";s:21:\"type/([^/]+)/embed/?$\";s:52:\"index.php?lang=vi&post_format=$matches[1]&embed=true\";s:38:\"(en)/type/([^/]+)/page/?([0-9]{1,})/?$\";s:68:\"index.php?lang=$matches[1]&post_format=$matches[2]&paged=$matches[3]\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:59:\"index.php?lang=vi&post_format=$matches[1]&paged=$matches[2]\";s:20:\"(en)/type/([^/]+)/?$\";s:50:\"index.php?lang=$matches[1]&post_format=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:41:\"index.php?lang=vi&post_format=$matches[1]\";s:40:\"(en)/project/[^/]+/attachment/([^/]+)/?$\";s:49:\"index.php?lang=$matches[1]&attachment=$matches[2]\";s:35:\"project/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:50:\"(en)/project/[^/]+/attachment/([^/]+)/trackback/?$\";s:54:\"index.php?lang=$matches[1]&attachment=$matches[2]&tb=1\";s:45:\"project/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:70:\"(en)/project/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:65:\"project/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"(en)/project/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:60:\"project/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"(en)/project/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:67:\"index.php?lang=$matches[1]&attachment=$matches[2]&cpage=$matches[3]\";s:60:\"project/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:46:\"(en)/project/[^/]+/attachment/([^/]+)/embed/?$\";s:60:\"index.php?lang=$matches[1]&attachment=$matches[2]&embed=true\";s:41:\"project/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:29:\"(en)/project/([^/]+)/embed/?$\";s:57:\"index.php?lang=$matches[1]&project=$matches[2]&embed=true\";s:24:\"project/([^/]+)/embed/?$\";s:40:\"index.php?project=$matches[1]&embed=true\";s:33:\"(en)/project/([^/]+)/trackback/?$\";s:51:\"index.php?lang=$matches[1]&project=$matches[2]&tb=1\";s:28:\"project/([^/]+)/trackback/?$\";s:34:\"index.php?project=$matches[1]&tb=1\";s:53:\"(en)/project/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:63:\"index.php?lang=$matches[1]&project=$matches[2]&feed=$matches[3]\";s:48:\"project/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?project=$matches[1]&feed=$matches[2]\";s:48:\"(en)/project/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:63:\"index.php?lang=$matches[1]&project=$matches[2]&feed=$matches[3]\";s:43:\"project/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?project=$matches[1]&feed=$matches[2]\";s:41:\"(en)/project/([^/]+)/page/?([0-9]{1,})/?$\";s:64:\"index.php?lang=$matches[1]&project=$matches[2]&paged=$matches[3]\";s:36:\"project/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?project=$matches[1]&paged=$matches[2]\";s:48:\"(en)/project/([^/]+)/comment-page-([0-9]{1,})/?$\";s:64:\"index.php?lang=$matches[1]&project=$matches[2]&cpage=$matches[3]\";s:43:\"project/([^/]+)/comment-page-([0-9]{1,})/?$\";s:47:\"index.php?project=$matches[1]&cpage=$matches[2]\";s:37:\"(en)/project/([^/]+)(?:/([0-9]+))?/?$\";s:63:\"index.php?lang=$matches[1]&project=$matches[2]&page=$matches[3]\";s:32:\"project/([^/]+)(?:/([0-9]+))?/?$\";s:46:\"index.php?project=$matches[1]&page=$matches[2]\";s:29:\"(en)/project/[^/]+/([^/]+)/?$\";s:49:\"index.php?lang=$matches[1]&attachment=$matches[2]\";s:24:\"project/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:39:\"(en)/project/[^/]+/([^/]+)/trackback/?$\";s:54:\"index.php?lang=$matches[1]&attachment=$matches[2]&tb=1\";s:34:\"project/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:59:\"(en)/project/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:54:\"project/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"(en)/project/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:49:\"project/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"(en)/project/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:67:\"index.php?lang=$matches[1]&attachment=$matches[2]&cpage=$matches[3]\";s:49:\"project/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:35:\"(en)/project/[^/]+/([^/]+)/embed/?$\";s:60:\"index.php?lang=$matches[1]&attachment=$matches[2]&embed=true\";s:30:\"project/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:39:\"testimonial/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:49:\"testimonial/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:69:\"testimonial/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:64:\"testimonial/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:64:\"testimonial/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:45:\"testimonial/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:28:\"testimonial/([^/]+)/embed/?$\";s:44:\"index.php?testimonial=$matches[1]&embed=true\";s:32:\"testimonial/([^/]+)/trackback/?$\";s:38:\"index.php?testimonial=$matches[1]&tb=1\";s:40:\"testimonial/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?testimonial=$matches[1]&paged=$matches[2]\";s:47:\"testimonial/([^/]+)/comment-page-([0-9]{1,})/?$\";s:51:\"index.php?testimonial=$matches[1]&cpage=$matches[2]\";s:36:\"testimonial/([^/]+)(?:/([0-9]+))?/?$\";s:50:\"index.php?testimonial=$matches[1]&page=$matches[2]\";s:28:\"testimonial/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:38:\"testimonial/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:58:\"testimonial/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:53:\"testimonial/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:53:\"testimonial/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:34:\"testimonial/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:57:\"testimonial-type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:69:\"index.php?taxonomy=testimonial_type&term=$matches[1]&feed=$matches[2]\";s:52:\"testimonial-type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:69:\"index.php?taxonomy=testimonial_type&term=$matches[1]&feed=$matches[2]\";s:33:\"testimonial-type/([^/]+)/embed/?$\";s:63:\"index.php?taxonomy=testimonial_type&term=$matches[1]&embed=true\";s:45:\"testimonial-type/([^/]+)/page/?([0-9]{1,})/?$\";s:70:\"index.php?taxonomy=testimonial_type&term=$matches[1]&paged=$matches[2]\";s:27:\"testimonial-type/([^/]+)/?$\";s:52:\"index.php?taxonomy=testimonial_type&term=$matches[1]\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:13:\"favicon\\.ico$\";s:19:\"index.php?favicon=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:37:\"(en)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?lang=$matches[1]&&feed=$matches[2]\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:35:\"index.php?lang=vi&&feed=$matches[1]\";s:32:\"(en)/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?lang=$matches[1]&&feed=$matches[2]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:35:\"index.php?lang=vi&&feed=$matches[1]\";s:13:\"(en)/embed/?$\";s:38:\"index.php?lang=$matches[1]&&embed=true\";s:8:\"embed/?$\";s:29:\"index.php?lang=vi&&embed=true\";s:25:\"(en)/page/?([0-9]{1,})/?$\";s:45:\"index.php?lang=$matches[1]&&paged=$matches[2]\";s:20:\"page/?([0-9]{1,})/?$\";s:36:\"index.php?lang=vi&&paged=$matches[1]\";s:32:\"(en)/comment-page-([0-9]{1,})/?$\";s:55:\"index.php?lang=$matches[1]&&page_id=2&cpage=$matches[2]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:46:\"index.php?lang=vi&&page_id=2&cpage=$matches[1]\";s:7:\"(en)/?$\";s:26:\"index.php?lang=$matches[1]\";s:46:\"(en)/comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:59:\"index.php?lang=$matches[1]&&feed=$matches[2]&withcomments=1\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?lang=vi&&feed=$matches[1]&withcomments=1\";s:41:\"(en)/comments/(feed|rdf|rss|rss2|atom)/?$\";s:59:\"index.php?lang=$matches[1]&&feed=$matches[2]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?lang=vi&&feed=$matches[1]&withcomments=1\";s:22:\"(en)/comments/embed/?$\";s:38:\"index.php?lang=$matches[1]&&embed=true\";s:17:\"comments/embed/?$\";s:29:\"index.php?lang=vi&&embed=true\";s:49:\"(en)/search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:57:\"index.php?lang=$matches[1]&s=$matches[2]&feed=$matches[3]\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:48:\"index.php?lang=vi&s=$matches[1]&feed=$matches[2]\";s:44:\"(en)/search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:57:\"index.php?lang=$matches[1]&s=$matches[2]&feed=$matches[3]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:48:\"index.php?lang=vi&s=$matches[1]&feed=$matches[2]\";s:25:\"(en)/search/(.+)/embed/?$\";s:51:\"index.php?lang=$matches[1]&s=$matches[2]&embed=true\";s:20:\"search/(.+)/embed/?$\";s:42:\"index.php?lang=vi&s=$matches[1]&embed=true\";s:37:\"(en)/search/(.+)/page/?([0-9]{1,})/?$\";s:58:\"index.php?lang=$matches[1]&s=$matches[2]&paged=$matches[3]\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:49:\"index.php?lang=vi&s=$matches[1]&paged=$matches[2]\";s:19:\"(en)/search/(.+)/?$\";s:40:\"index.php?lang=$matches[1]&s=$matches[2]\";s:14:\"search/(.+)/?$\";s:31:\"index.php?lang=vi&s=$matches[1]\";s:52:\"(en)/author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:67:\"index.php?lang=$matches[1]&author_name=$matches[2]&feed=$matches[3]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:58:\"index.php?lang=vi&author_name=$matches[1]&feed=$matches[2]\";s:47:\"(en)/author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:67:\"index.php?lang=$matches[1]&author_name=$matches[2]&feed=$matches[3]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:58:\"index.php?lang=vi&author_name=$matches[1]&feed=$matches[2]\";s:28:\"(en)/author/([^/]+)/embed/?$\";s:61:\"index.php?lang=$matches[1]&author_name=$matches[2]&embed=true\";s:23:\"author/([^/]+)/embed/?$\";s:52:\"index.php?lang=vi&author_name=$matches[1]&embed=true\";s:40:\"(en)/author/([^/]+)/page/?([0-9]{1,})/?$\";s:68:\"index.php?lang=$matches[1]&author_name=$matches[2]&paged=$matches[3]\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:59:\"index.php?lang=vi&author_name=$matches[1]&paged=$matches[2]\";s:22:\"(en)/author/([^/]+)/?$\";s:50:\"index.php?lang=$matches[1]&author_name=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:41:\"index.php?lang=vi&author_name=$matches[1]\";s:74:\"(en)/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&day=$matches[4]&feed=$matches[5]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:88:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:69:\"(en)/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&day=$matches[4]&feed=$matches[5]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:88:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:50:\"(en)/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:91:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&day=$matches[4]&embed=true\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:82:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:62:\"(en)/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:98:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&day=$matches[4]&paged=$matches[5]\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:89:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:44:\"(en)/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:80:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&day=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:71:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:61:\"(en)/([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:81:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&feed=$matches[4]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:72:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:56:\"(en)/([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:81:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&feed=$matches[4]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:72:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:37:\"(en)/([0-9]{4})/([0-9]{1,2})/embed/?$\";s:75:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&embed=true\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:66:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&embed=true\";s:49:\"(en)/([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:82:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]&paged=$matches[4]\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:73:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:31:\"(en)/([0-9]{4})/([0-9]{1,2})/?$\";s:64:\"index.php?lang=$matches[1]&year=$matches[2]&monthnum=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:55:\"index.php?lang=vi&year=$matches[1]&monthnum=$matches[2]\";s:48:\"(en)/([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:60:\"index.php?lang=$matches[1]&year=$matches[2]&feed=$matches[3]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?lang=vi&year=$matches[1]&feed=$matches[2]\";s:43:\"(en)/([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:60:\"index.php?lang=$matches[1]&year=$matches[2]&feed=$matches[3]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?lang=vi&year=$matches[1]&feed=$matches[2]\";s:24:\"(en)/([0-9]{4})/embed/?$\";s:54:\"index.php?lang=$matches[1]&year=$matches[2]&embed=true\";s:19:\"([0-9]{4})/embed/?$\";s:45:\"index.php?lang=vi&year=$matches[1]&embed=true\";s:36:\"(en)/([0-9]{4})/page/?([0-9]{1,})/?$\";s:61:\"index.php?lang=$matches[1]&year=$matches[2]&paged=$matches[3]\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:52:\"index.php?lang=vi&year=$matches[1]&paged=$matches[2]\";s:18:\"(en)/([0-9]{4})/?$\";s:43:\"index.php?lang=$matches[1]&year=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:34:\"index.php?lang=vi&year=$matches[1]\";s:32:\"(en)/.?.+?/attachment/([^/]+)/?$\";s:49:\"index.php?lang=$matches[1]&attachment=$matches[2]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:42:\"(en)/.?.+?/attachment/([^/]+)/trackback/?$\";s:54:\"index.php?lang=$matches[1]&attachment=$matches[2]&tb=1\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:62:\"(en)/.?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"(en)/.?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"(en)/.?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:67:\"index.php?lang=$matches[1]&attachment=$matches[2]&cpage=$matches[3]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:38:\"(en)/.?.+?/attachment/([^/]+)/embed/?$\";s:60:\"index.php?lang=$matches[1]&attachment=$matches[2]&embed=true\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:21:\"(en)/(.?.+?)/embed/?$\";s:58:\"index.php?lang=$matches[1]&pagename=$matches[2]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:25:\"(en)/(.?.+?)/trackback/?$\";s:52:\"index.php?lang=$matches[1]&pagename=$matches[2]&tb=1\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:45:\"(en)/(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?lang=$matches[1]&pagename=$matches[2]&feed=$matches[3]\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:40:\"(en)/(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?lang=$matches[1]&pagename=$matches[2]&feed=$matches[3]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:33:\"(en)/(.?.+?)/page/?([0-9]{1,})/?$\";s:65:\"index.php?lang=$matches[1]&pagename=$matches[2]&paged=$matches[3]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:40:\"(en)/(.?.+?)/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?lang=$matches[1]&pagename=$matches[2]&cpage=$matches[3]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:29:\"(en)/(.?.+?)(?:/([0-9]+))?/?$\";s:64:\"index.php?lang=$matches[1]&pagename=$matches[2]&page=$matches[3]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:32:\"(en)/[^/]+/attachment/([^/]+)/?$\";s:49:\"index.php?lang=$matches[1]&attachment=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:42:\"(en)/[^/]+/attachment/([^/]+)/trackback/?$\";s:54:\"index.php?lang=$matches[1]&attachment=$matches[2]&tb=1\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:62:\"(en)/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"(en)/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"(en)/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:67:\"index.php?lang=$matches[1]&attachment=$matches[2]&cpage=$matches[3]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:38:\"(en)/[^/]+/attachment/([^/]+)/embed/?$\";s:60:\"index.php?lang=$matches[1]&attachment=$matches[2]&embed=true\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:21:\"(en)/([^/]+)/embed/?$\";s:54:\"index.php?lang=$matches[1]&name=$matches[2]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:25:\"(en)/([^/]+)/trackback/?$\";s:48:\"index.php?lang=$matches[1]&name=$matches[2]&tb=1\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:45:\"(en)/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:60:\"index.php?lang=$matches[1]&name=$matches[2]&feed=$matches[3]\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:40:\"(en)/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:60:\"index.php?lang=$matches[1]&name=$matches[2]&feed=$matches[3]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:33:\"(en)/([^/]+)/page/?([0-9]{1,})/?$\";s:61:\"index.php?lang=$matches[1]&name=$matches[2]&paged=$matches[3]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:40:\"(en)/([^/]+)/comment-page-([0-9]{1,})/?$\";s:61:\"index.php?lang=$matches[1]&name=$matches[2]&cpage=$matches[3]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:29:\"(en)/([^/]+)(?:/([0-9]+))?/?$\";s:60:\"index.php?lang=$matches[1]&name=$matches[2]&page=$matches[3]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:21:\"(en)/[^/]+/([^/]+)/?$\";s:49:\"index.php?lang=$matches[1]&attachment=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:31:\"(en)/[^/]+/([^/]+)/trackback/?$\";s:54:\"index.php?lang=$matches[1]&attachment=$matches[2]&tb=1\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:51:\"(en)/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:46:\"(en)/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:66:\"index.php?lang=$matches[1]&attachment=$matches[2]&feed=$matches[3]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:46:\"(en)/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:67:\"index.php?lang=$matches[1]&attachment=$matches[2]&cpage=$matches[3]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:27:\"(en)/[^/]+/([^/]+)/embed/?$\";s:60:\"index.php?lang=$matches[1]&attachment=$matches[2]&embed=true\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(1823, '_transient_timeout_global_styles_kbw-simple-child', '1663728711', 'no'),
(1824, '_transient_global_styles_kbw-simple-child', 'body{--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--duotone--dark-grayscale: url(\'#wp-duotone-dark-grayscale\');--wp--preset--duotone--grayscale: url(\'#wp-duotone-grayscale\');--wp--preset--duotone--purple-yellow: url(\'#wp-duotone-purple-yellow\');--wp--preset--duotone--blue-red: url(\'#wp-duotone-blue-red\');--wp--preset--duotone--midnight: url(\'#wp-duotone-midnight\');--wp--preset--duotone--magenta-yellow: url(\'#wp-duotone-magenta-yellow\');--wp--preset--duotone--purple-green: url(\'#wp-duotone-purple-green\');--wp--preset--duotone--blue-orange: url(\'#wp-duotone-blue-orange\');--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}', 'no'),
(1826, '_site_transient_timeout_theme_roots', '1663730455', 'no'),
(1827, '_site_transient_theme_roots', 'a:3:{s:16:\"kbw-simple-child\";s:7:\"/themes\";s:10:\"kbw-simple\";s:7:\"/themes\";s:15:\"twentytwentytwo\";s:7:\"/themes\";}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `kbw_postmeta`
--

CREATE TABLE `kbw_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_postmeta`
--

INSERT INTO `kbw_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(2, 3, '_wp_page_template', 'default'),
(3, 2, '_edit_last', '1'),
(4, 2, '_edit_lock', '1663579190:1'),
(6, 7, '_form', '<label> Họ tên:\n    [text* your-name] </label>\n\n<label> Email:\n    [email* your-email] </label>\n\n<label> Tiêu đề:\n    [text* your-subject] </label>\n\n<label> Lời nhắn (Không bắt buộc)\n    [textarea your-message] </label>\n\n[submit \"Gửi\"]'),
(7, 7, '_mail', 'a:9:{s:6:\"active\";b:1;s:7:\"subject\";s:30:\"[_site_title] \"[your-subject]\"\";s:6:\"sender\";s:30:\"[_site_title] <cskh@demowp.hk>\";s:9:\"recipient\";s:19:\"[_site_admin_email]\";s:4:\"body\";s:255:\"Gửi đến từ: [your-name] <[your-email]>\nTiêu đề: [your-subject]\n\nNội dung thông điệp:\n[your-message]\n\n-- \nEmail này được gửi đến từ form liên hệ của website [_site_title]\nĐường dẫn: [_url]\nVào lúc: [_time], [_date]\";s:18:\"additional_headers\";s:22:\"Reply-To: [your-email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";b:1;s:13:\"exclude_blank\";b:0;}'),
(8, 7, '_mail_2', 'a:9:{s:6:\"active\";b:1;s:7:\"subject\";s:30:\"[_site_title] \"[your-subject]\"\";s:6:\"sender\";s:35:\"[_site_title] <wordpress@demowp.hk>\";s:9:\"recipient\";s:12:\"[your-email]\";s:4:\"body\";s:142:\"Nội dung thông điệp:\n[your-message]\n\n-- \nEmail này được gửi đến từ form liên hệ của website [_site_title] ([_site_url])\";s:18:\"additional_headers\";s:29:\"Reply-To: [_site_admin_email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";b:0;s:13:\"exclude_blank\";b:0;}'),
(9, 7, '_messages', 'a:22:{s:12:\"mail_sent_ok\";s:53:\"Xin cảm ơn, form đã được gửi thành công.\";s:12:\"mail_sent_ng\";s:118:\"Có lỗi xảy ra trong quá trình gửi. Xin vui lòng thử lại hoặc liên hệ người quản trị website.\";s:16:\"validation_error\";s:86:\"Có một hoặc nhiều mục nhập có lỗi. Vui lòng kiểm tra và thử lại.\";s:4:\"spam\";s:118:\"Có lỗi xảy ra trong quá trình gửi. Xin vui lòng thử lại hoặc liên hệ người quản trị website.\";s:12:\"accept_terms\";s:67:\"Bạn phải chấp nhận điều khoản trước khi gửi form.\";s:16:\"invalid_required\";s:28:\"Mục này là bắt buộc.\";s:16:\"invalid_too_long\";s:36:\"Nhập quá số kí tự cho phép.\";s:17:\"invalid_too_short\";s:44:\"Nhập ít hơn số kí tự tối thiểu.\";s:13:\"upload_failed\";s:36:\"Tải file lên không thành công.\";s:24:\"upload_file_type_invalid\";s:69:\"Bạn không được phép tải lên file theo định dạng này.\";s:21:\"upload_file_too_large\";s:31:\"File kích thước quá lớn.\";s:23:\"upload_failed_php_error\";s:36:\"Tải file lên không thành công.\";s:12:\"invalid_date\";s:46:\"Định dạng ngày tháng không hợp lệ.\";s:14:\"date_too_early\";s:58:\"Ngày này trước ngày sớm nhất được cho phép.\";s:13:\"date_too_late\";s:54:\"Ngày này quá ngày gần nhất được cho phép.\";s:14:\"invalid_number\";s:38:\"Định dạng số không hợp lệ.\";s:16:\"number_too_small\";s:48:\"Con số nhỏ hơn số nhỏ nhất cho phép.\";s:16:\"number_too_large\";s:48:\"Con số lớn hơn số lớn nhất cho phép.\";s:23:\"quiz_answer_not_correct\";s:30:\"Câu trả lời chưa đúng.\";s:13:\"invalid_email\";s:38:\"Địa chỉ e-mail không hợp lệ.\";s:11:\"invalid_url\";s:22:\"URL không hợp lệ.\";s:11:\"invalid_tel\";s:39:\"Số điện thoại không hợp lệ.\";}'),
(10, 7, '_additional_settings', ''),
(11, 7, '_locale', 'vi'),
(12, 1, 'hkt_views', '3'),
(13, 2, 'hkt_views', '3'),
(14, 8, '_edit_last', '1'),
(15, 8, '_edit_lock', '1663635389:1'),
(17, 8, '_hkt_sidebar_custom', ''),
(18, 8, '_hkt_sidebar_location', ''),
(19, 8, 'kc_data', 'a:8:{i:0;s:0:\"\";s:4:\"mode\";s:0:\"\";s:3:\"css\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:7:\"classes\";s:0:\"\";s:9:\"thumbnail\";s:0:\"\";s:9:\"collapsed\";s:0:\"\";s:9:\"optimized\";s:0:\"\";}'),
(20, 8, 'kc_raw_content', 'Đang cập nhật...'),
(21, 9, '_edit_last', '1'),
(22, 9, '_edit_lock', '1634050139:1'),
(24, 9, '_hkt_sidebar_custom', ''),
(25, 9, '_hkt_sidebar_location', ''),
(26, 9, 'kc_data', 'a:8:{i:0;s:0:\"\";s:4:\"mode\";s:0:\"\";s:3:\"css\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:7:\"classes\";s:0:\"\";s:9:\"thumbnail\";s:0:\"\";s:9:\"collapsed\";s:0:\"\";s:9:\"optimized\";s:0:\"\";}'),
(27, 9, 'kc_raw_content', '[contact-form-7 id=\"7\" title=\"Form liên hệ 1\"]'),
(28, 10, '_menu_item_type', 'post_type'),
(29, 10, '_menu_item_menu_item_parent', '0'),
(30, 10, '_menu_item_object_id', '2'),
(31, 10, '_menu_item_object', 'page'),
(32, 10, '_menu_item_target', ''),
(33, 10, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(34, 10, '_menu_item_xfn', ''),
(35, 10, '_menu_item_url', ''),
(64, 14, '_edit_last', '1'),
(65, 14, '_edit_lock', '1634050286:1'),
(66, 2, 'kc_data', 'a:8:{i:0;s:0:\"\";s:4:\"mode\";s:0:\"\";s:3:\"css\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:7:\"classes\";s:0:\"\";s:9:\"thumbnail\";s:0:\"\";s:9:\"collapsed\";s:0:\"\";s:9:\"optimized\";s:0:\"\";}'),
(68, 2, '_hkt_sidebar_custom', ''),
(69, 2, '_hkt_sidebar_location', ''),
(70, 2, 'kc_raw_content', ''),
(72, 15, '_edit_last', '1'),
(73, 15, '_edit_lock', '1663577029:1'),
(74, 2, 'kbw_views', '406'),
(78, 2, '_kbw_sidebar_custom', ''),
(79, 2, '_kbw_sidebar_location', ''),
(82, 2, '_wpb_vc_js_status', 'true'),
(84, 21, '_wp_attached_file', '2022/09/logo.png'),
(85, 21, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:191;s:6:\"height\";i:56;s:4:\"file\";s:16:\"2022/09/logo.png\";s:8:\"filesize\";i:3620;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:15:\"logo-150x56.png\";s:5:\"width\";i:150;s:6:\"height\";i:56;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:3112;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:15:\"logo-150x56.png\";s:5:\"width\";i:150;s:6:\"height\";i:56;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:3112;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(87, 22, '_edit_last', '1'),
(88, 22, '_edit_lock', '1663437908:1'),
(90, 22, '_kbw_sidebar_custom', ''),
(91, 22, '_kbw_sidebar_location', ''),
(92, 22, '_wpb_vc_js_status', 'true'),
(93, 23, '_edit_last', '1'),
(95, 23, '_kbw_sidebar_custom', ''),
(96, 23, '_kbw_sidebar_location', ''),
(97, 23, '_wpb_vc_js_status', 'false'),
(98, 23, '_edit_lock', '1663235372:1'),
(99, 24, '_menu_item_type', 'post_type'),
(100, 24, '_menu_item_menu_item_parent', '0'),
(101, 24, '_menu_item_object_id', '23'),
(102, 24, '_menu_item_object', 'page'),
(103, 24, '_menu_item_target', ''),
(104, 24, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(105, 24, '_menu_item_xfn', ''),
(106, 24, '_menu_item_url', ''),
(108, 25, '_menu_item_type', 'post_type'),
(109, 25, '_menu_item_menu_item_parent', '0'),
(110, 25, '_menu_item_object_id', '22'),
(111, 25, '_menu_item_object', 'page'),
(112, 25, '_menu_item_target', ''),
(113, 25, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(114, 25, '_menu_item_xfn', ''),
(115, 25, '_menu_item_url', ''),
(117, 26, '_menu_item_type', 'custom'),
(118, 26, '_menu_item_menu_item_parent', '0'),
(119, 26, '_menu_item_object_id', '26'),
(120, 26, '_menu_item_object', 'custom'),
(121, 26, '_menu_item_target', ''),
(122, 26, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(123, 26, '_menu_item_xfn', ''),
(124, 26, '_menu_item_url', '##'),
(126, 27, '_menu_item_type', 'custom'),
(127, 27, '_menu_item_menu_item_parent', '0'),
(128, 27, '_menu_item_object_id', '27'),
(129, 27, '_menu_item_object', 'custom'),
(130, 27, '_menu_item_target', ''),
(131, 27, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(132, 27, '_menu_item_xfn', ''),
(133, 27, '_menu_item_url', '##'),
(135, 10, '_wp_old_date', '2021-10-12'),
(139, 29, '_wp_attached_file', '2022/09/favicon.png'),
(140, 29, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:100;s:6:\"height\";i:100;s:4:\"file\";s:19:\"2022/09/favicon.png\";s:8:\"filesize\";i:11200;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(141, 30, '_wp_attached_file', '2022/09/img-aboutus.png'),
(142, 30, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:562;s:6:\"height\";i:432;s:4:\"file\";s:23:\"2022/09/img-aboutus.png\";s:8:\"filesize\";i:357525;s:5:\"sizes\";a:8:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:23:\"img-aboutus-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:42237;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:23:\"img-aboutus-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:170601;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:23:\"img-aboutus-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:170601;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:23:\"img-aboutus-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:170601;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:23:\"img-aboutus-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:170601;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:23:\"img-aboutus-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:170601;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:23:\"img-aboutus-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:42237;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:23:\"img-aboutus-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:170601;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(143, 2, '_wp_page_template', 'templates/template-landingpage.php'),
(144, 31, '_wp_attached_file', '2022/09/why-1.png'),
(145, 31, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:190;s:6:\"height\";i:161;s:4:\"file\";s:17:\"2022/09/why-1.png\";s:8:\"filesize\";i:3883;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:17:\"why-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:4304;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:17:\"why-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:4304;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(146, 32, '_wp_attached_file', '2022/09/why-2.png'),
(147, 32, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:190;s:6:\"height\";i:159;s:4:\"file\";s:17:\"2022/09/why-2.png\";s:8:\"filesize\";i:2716;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:17:\"why-2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:3713;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:17:\"why-2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:3713;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(148, 33, '_wp_attached_file', '2022/09/noimage.png'),
(149, 33, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:512;s:6:\"height\";i:366;s:4:\"file\";s:19:\"2022/09/noimage.png\";s:8:\"filesize\";i:2206;s:5:\"sizes\";a:8:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:19:\"noimage-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:490;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:19:\"noimage-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1421;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:19:\"noimage-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1421;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:19:\"noimage-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1421;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:19:\"noimage-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1421;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:19:\"noimage-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1421;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:19:\"noimage-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:490;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:19:\"noimage-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1421;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(150, 37, '_wp_attached_file', '2022/09/icon-service.png'),
(151, 37, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:48;s:6:\"height\";i:47;s:4:\"file\";s:24:\"2022/09/icon-service.png\";s:8:\"filesize\";i:2381;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(152, 41, '_wp_attached_file', '2022/09/testimonial-1.png'),
(153, 41, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:475;s:6:\"height\";i:354;s:4:\"file\";s:25:\"2022/09/testimonial-1.png\";s:8:\"filesize\";i:189860;s:5:\"sizes\";a:8:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:25:\"testimonial-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:36201;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:25:\"testimonial-1-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:137518;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:25:\"testimonial-1-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:137518;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:25:\"testimonial-1-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:127450;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:25:\"testimonial-1-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:127450;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:25:\"testimonial-1-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:127450;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:25:\"testimonial-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:36201;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:25:\"testimonial-1-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:127450;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(154, 40, '_edit_last', '1'),
(155, 40, '_thumbnail_id', '41'),
(156, 40, 'testimonial_job', 'Ceo'),
(157, 40, 'testimonial_link', 'https://kabivi.com'),
(158, 40, 'testimonial_social', 'a:3:{i:0;s:20:\"https://facebook.com\";i:1;s:19:\"https://youtube.com\";i:2;s:19:\"https://twitter.com\";}'),
(159, 40, '_edit_lock', '1663259132:1'),
(160, 42, '_edit_last', '1'),
(161, 42, '_edit_lock', '1663578900:1'),
(162, 42, '_thumbnail_id', '41'),
(163, 42, 'testimonial_email', 'Director'),
(164, 42, 'testimonial_job', 'Officer'),
(165, 42, 'testimonial_link', 'https://kabivi.com'),
(166, 42, 'testimonial_social', 'a:3:{i:0;s:20:\"https://facebook.com\";i:1;s:19:\"https://youtube.com\";i:2;s:19:\"https://twitter.com\";}'),
(169, 43, '_edit_last', '1'),
(170, 43, '_edit_lock', '1663577021:1'),
(171, 44, '_wp_attached_file', '2022/09/clients-logo-1.png'),
(172, 44, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:272;s:6:\"height\";i:72;s:4:\"file\";s:26:\"2022/09/clients-logo-1.png\";s:8:\"filesize\";i:7961;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:25:\"clients-logo-1-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:5611;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:25:\"clients-logo-1-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:5611;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(173, 45, '_wp_attached_file', '2022/09/clients-logo-2.png'),
(174, 45, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:272;s:6:\"height\";i:72;s:4:\"file\";s:26:\"2022/09/clients-logo-2.png\";s:8:\"filesize\";i:6076;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:25:\"clients-logo-2-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:4019;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:25:\"clients-logo-2-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:4019;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(175, 46, '_wp_attached_file', '2022/09/clients-logo-3.png'),
(176, 46, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:272;s:6:\"height\";i:72;s:4:\"file\";s:26:\"2022/09/clients-logo-3.png\";s:8:\"filesize\";i:9063;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:25:\"clients-logo-3-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:6174;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:25:\"clients-logo-3-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:6174;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(177, 47, '_wp_attached_file', '2022/09/clients-logo-4.png'),
(178, 47, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:272;s:6:\"height\";i:72;s:4:\"file\";s:26:\"2022/09/clients-logo-4.png\";s:8:\"filesize\";i:9960;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:25:\"clients-logo-4-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:6123;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:25:\"clients-logo-4-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:6123;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(179, 48, '_wp_attached_file', '2022/09/clients-logo-5.png'),
(180, 48, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:272;s:6:\"height\";i:72;s:4:\"file\";s:26:\"2022/09/clients-logo-5.png\";s:8:\"filesize\";i:7400;s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:25:\"clients-logo-5-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:4223;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:25:\"clients-logo-5-150x72.png\";s:5:\"width\";i:150;s:6:\"height\";i:72;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:4223;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(181, 43, 'kbw_slider', 'a:7:{i:1;a:4:{s:5:\"title\";s:0:\"\";s:4:\"link\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:2:\"id\";s:2:\"44\";}i:2;a:4:{s:5:\"title\";s:0:\"\";s:4:\"link\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:2:\"id\";s:2:\"45\";}i:3;a:4:{s:5:\"title\";s:0:\"\";s:4:\"link\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:2:\"id\";s:2:\"46\";}i:4;a:4:{s:5:\"title\";s:0:\"\";s:4:\"link\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:2:\"id\";s:2:\"47\";}i:5;a:4:{s:5:\"title\";s:0:\"\";s:4:\"link\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:2:\"id\";s:2:\"48\";}i:6;a:4:{s:5:\"title\";s:0:\"\";s:4:\"link\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:2:\"id\";s:2:\"45\";}i:7;a:4:{s:5:\"title\";s:0:\"\";s:4:\"link\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:2:\"id\";s:2:\"44\";}}'),
(184, 50, '_wp_attached_file', '2022/09/img-main-catalog.png'),
(185, 50, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:406;s:6:\"height\";i:302;s:4:\"file\";s:28:\"2022/09/img-main-catalog.png\";s:8:\"filesize\";i:3177;s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:28:\"img-main-catalog-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:512;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:28:\"img-main-catalog-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1222;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:28:\"img-main-catalog-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1222;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:28:\"img-main-catalog-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:1222;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:28:\"img-main-catalog-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:512;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(188, 51, '_edit_last', '1'),
(189, 51, '_edit_lock', '1663235610:1'),
(191, 1, '_edit_last', '1'),
(193, 1, '_wp_old_slug', 'chao-moi-nguoi'),
(194, 1, '_edit_lock', '1663573772:1'),
(197, 52, '_edit_last', '1'),
(199, 52, '_kbw_sidebar_custom', ''),
(200, 52, '_kbw_sidebar_location', ''),
(201, 52, '_edit_lock', '1662952585:1'),
(202, 53, '_edit_last', '1'),
(204, 53, '_kbw_sidebar_custom', ''),
(205, 53, '_kbw_sidebar_location', ''),
(206, 53, '_edit_lock', '1663238053:1'),
(207, 54, '_edit_last', '1'),
(209, 54, '_kbw_sidebar_custom', ''),
(210, 54, '_kbw_sidebar_location', ''),
(211, 54, '_edit_lock', '1662952496:1'),
(222, 55, '_wp_attached_file', '2022/09/heading-blog.png'),
(223, 55, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:1440;s:6:\"height\";i:504;s:4:\"file\";s:24:\"2022/09/heading-blog.png\";s:8:\"filesize\";i:817791;s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:24:\"heading-blog-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:30497;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:24:\"heading-blog-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:140099;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:24:\"heading-blog-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:140099;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:24:\"heading-blog-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:129399;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:24:\"heading-blog-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:129399;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:24:\"heading-blog-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:129399;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:24:\"heading-blog-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:30497;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:24:\"heading-blog-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:139248;}s:15:\"kbw-main-single\";a:5:{s:4:\"file\";s:24:\"heading-blog-750x504.png\";s:5:\"width\";i:750;s:6:\"height\";i:504;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:436850;}s:16:\"kbw-main-feature\";a:5:{s:4:\"file\";s:24:\"heading-blog-515x504.png\";s:5:\"width\";i:515;s:6:\"height\";i:504;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:310404;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:24:\"heading-blog-475x354.png\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:186853;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(224, 23, '_thumbnail_id', '55'),
(225, 56, '_wp_attached_file', '2022/09/heading-documentation.png'),
(226, 56, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:1440;s:6:\"height\";i:504;s:4:\"file\";s:33:\"2022/09/heading-documentation.png\";s:8:\"filesize\";i:578388;s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:33:\"heading-documentation-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:26366;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:33:\"heading-documentation-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:116225;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:33:\"heading-documentation-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:116225;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:33:\"heading-documentation-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:107673;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:33:\"heading-documentation-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:107673;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:33:\"heading-documentation-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:107673;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:33:\"heading-documentation-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:26366;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:33:\"heading-documentation-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:115732;}s:15:\"kbw-main-single\";a:5:{s:4:\"file\";s:33:\"heading-documentation-750x504.png\";s:5:\"width\";i:750;s:6:\"height\";i:504;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:298465;}s:16:\"kbw-main-feature\";a:5:{s:4:\"file\";s:33:\"heading-documentation-515x504.png\";s:5:\"width\";i:515;s:6:\"height\";i:504;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:217821;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:33:\"heading-documentation-475x354.png\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:150555;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(227, 22, '_thumbnail_id', '56'),
(228, 23, '_wp_page_template', 'templates/template-blog.php'),
(229, 22, '_wp_page_template', 'templates/template-nosidebar.php'),
(274, 1, '_kbw_sidebar_custom', ''),
(275, 1, '_kbw_sidebar_location', ''),
(280, 59, '_wp_attached_file', '2022/09/blog-featured.png'),
(281, 59, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:513;s:6:\"height\";i:561;s:4:\"file\";s:25:\"2022/09/blog-featured.png\";s:8:\"filesize\";i:437537;s:5:\"sizes\";a:9:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:25:\"blog-featured-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:36409;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:25:\"blog-featured-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:177802;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:25:\"blog-featured-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:177802;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:25:\"blog-featured-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:163861;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:25:\"blog-featured-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:163861;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:25:\"blog-featured-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:163861;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:25:\"blog-featured-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:36409;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:25:\"blog-featured-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:176618;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:25:\"blog-featured-475x354.png\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:236832;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(282, 54, '_thumbnail_id', '59'),
(288, 60, '_wp_attached_file', '2021/10/rectangle-1.png'),
(289, 60, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:810;s:6:\"height\";i:602;s:4:\"file\";s:23:\"2021/10/rectangle-1.png\";s:8:\"filesize\";i:534172;s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:41866;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-1-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:172636;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-1-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:172636;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:23:\"rectangle-1-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:159864;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:23:\"rectangle-1-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:159864;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:23:\"rectangle-1-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:159864;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:23:\"rectangle-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:41866;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:23:\"rectangle-1-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:174539;}s:15:\"kbw-main-single\";a:5:{s:4:\"file\";s:23:\"rectangle-1-750x602.png\";s:5:\"width\";i:750;s:6:\"height\";i:602;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:487941;}s:16:\"kbw-main-feature\";a:5:{s:4:\"file\";s:23:\"rectangle-1-515x565.png\";s:5:\"width\";i:515;s:6:\"height\";i:565;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:324889;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:23:\"rectangle-1-475x354.png\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:222760;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(290, 1, '_thumbnail_id', '60'),
(292, 61, '_wp_attached_file', '2022/09/rectangle-2.png'),
(293, 61, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:810;s:6:\"height\";i:602;s:4:\"file\";s:23:\"2022/09/rectangle-2.png\";s:8:\"filesize\";i:597566;s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:41607;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-2-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:187659;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-2-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:187659;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:23:\"rectangle-2-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:173777;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:23:\"rectangle-2-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:173777;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:23:\"rectangle-2-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:173777;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:23:\"rectangle-2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:41607;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:23:\"rectangle-2-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:189710;}s:15:\"kbw-main-single\";a:5:{s:4:\"file\";s:23:\"rectangle-2-750x602.png\";s:5:\"width\";i:750;s:6:\"height\";i:602;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:540543;}s:16:\"kbw-main-feature\";a:5:{s:4:\"file\";s:23:\"rectangle-2-515x565.png\";s:5:\"width\";i:515;s:6:\"height\";i:565;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:339933;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:23:\"rectangle-2-475x354.png\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:243565;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(294, 52, '_thumbnail_id', '61'),
(296, 62, '_wp_attached_file', '2022/09/rectangle-3.png'),
(297, 62, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:810;s:6:\"height\";i:602;s:4:\"file\";s:23:\"2022/09/rectangle-3.png\";s:8:\"filesize\";i:497612;s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-3-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:40548;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-3-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:162670;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:23:\"rectangle-3-406x302.png\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:162670;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:23:\"rectangle-3-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:150387;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:23:\"rectangle-3-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:150387;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:23:\"rectangle-3-400x280.png\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:150387;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:23:\"rectangle-3-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:40548;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:23:\"rectangle-3-405x301.png\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:164095;}s:15:\"kbw-main-single\";a:5:{s:4:\"file\";s:23:\"rectangle-3-750x602.png\";s:5:\"width\";i:750;s:6:\"height\";i:602;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:468983;}s:16:\"kbw-main-feature\";a:5:{s:4:\"file\";s:23:\"rectangle-3-515x565.png\";s:5:\"width\";i:515;s:6:\"height\";i:565;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:328359;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:23:\"rectangle-3-475x354.png\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:9:\"image/png\";s:8:\"filesize\";i:209194;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(298, 53, '_thumbnail_id', '62'),
(302, 53, 'kbw_views', '9'),
(305, 65, '_wp_attached_file', '2022/09/carbon-cloud-app.png'),
(306, 65, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:88;s:6:\"height\";i:88;s:4:\"file\";s:28:\"2022/09/carbon-cloud-app.png\";s:8:\"filesize\";i:1308;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(307, 66, '_wp_attached_file', '2022/09/carbon-cloud-service-management.png'),
(308, 66, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:88;s:6:\"height\";i:88;s:4:\"file\";s:43:\"2022/09/carbon-cloud-service-management.png\";s:8:\"filesize\";i:1415;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(309, 67, '_wp_attached_file', '2022/09/carbon-user-role.png'),
(310, 67, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:88;s:6:\"height\";i:88;s:4:\"file\";s:28:\"2022/09/carbon-user-role.png\";s:8:\"filesize\";i:1896;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(311, 68, '_wp_attached_file', '2022/09/fluent-document-bullet-list-20-regular.png'),
(312, 68, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:88;s:6:\"height\";i:88;s:4:\"file\";s:50:\"2022/09/fluent-document-bullet-list-20-regular.png\";s:8:\"filesize\";i:1349;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(313, 69, '_wp_attached_file', '2022/09/octicon-code-square-1.png'),
(314, 69, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:48;s:6:\"height\";i:48;s:4:\"file\";s:33:\"2022/09/octicon-code-square-1.png\";s:8:\"filesize\";i:725;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(315, 70, '_wp_attached_file', '2022/09/octicon-code-square-2.png'),
(316, 70, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:48;s:6:\"height\";i:48;s:4:\"file\";s:33:\"2022/09/octicon-code-square-2.png\";s:8:\"filesize\";i:739;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(317, 71, '_wp_attached_file', '2022/09/octicon-code-square-3.png'),
(318, 71, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:48;s:6:\"height\";i:48;s:4:\"file\";s:33:\"2022/09/octicon-code-square-3.png\";s:8:\"filesize\";i:746;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(319, 72, '_wp_attached_file', '2022/09/octicon-code-square-4.png'),
(320, 72, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:48;s:6:\"height\";i:48;s:4:\"file\";s:33:\"2022/09/octicon-code-square-4.png\";s:8:\"filesize\";i:698;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(321, 73, '_wp_attached_file', '2022/09/octicon-code-square-5.png'),
(322, 73, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:48;s:6:\"height\";i:48;s:4:\"file\";s:33:\"2022/09/octicon-code-square-5.png\";s:8:\"filesize\";i:696;s:5:\"sizes\";a:0:{}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(323, 74, '_pll_strings_translations', 'a:0:{}'),
(324, 75, '_pll_strings_translations', 'a:0:{}'),
(325, 76, '_edit_last', '1'),
(327, 76, '_edit_lock', '1663634852:1'),
(328, 10, '_wp_old_date', '2022-09-09'),
(329, 25, '_wp_old_date', '2022-09-09'),
(330, 26, '_wp_old_date', '2022-09-09'),
(331, 24, '_wp_old_date', '2022-09-09'),
(332, 27, '_wp_old_date', '2022-09-09'),
(333, 77, '_menu_item_type', 'post_type'),
(334, 77, '_menu_item_menu_item_parent', '0'),
(335, 77, '_menu_item_object_id', '76'),
(336, 77, '_menu_item_object', 'page'),
(337, 77, '_menu_item_target', ''),
(338, 77, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(339, 77, '_menu_item_xfn', ''),
(340, 77, '_menu_item_url', ''),
(343, 76, '_kbw_sidebar_custom', ''),
(344, 76, '_kbw_sidebar_location', ''),
(345, 76, '_wpb_vc_js_status', 'true'),
(346, 76, '_wp_page_template', 'templates/template-landingpage.php'),
(355, 79, '_wp_page_template', 'templates/template-nosidebar.php'),
(356, 79, '_thumbnail_id', '56'),
(357, 79, '_edit_last', '1'),
(358, 79, '_kbw_sidebar_custom', ''),
(359, 79, '_kbw_sidebar_location', ''),
(360, 79, '_wpb_vc_js_status', 'true'),
(361, 79, '_edit_lock', '1663437984:1'),
(362, 80, '_wp_page_template', 'templates/template-blog.php'),
(363, 80, '_thumbnail_id', '55'),
(364, 80, '_edit_last', '1'),
(365, 80, '_kbw_sidebar_custom', ''),
(366, 80, '_kbw_sidebar_location', ''),
(367, 80, '_wpb_vc_js_status', 'false'),
(368, 80, '_edit_lock', '1663235392:1'),
(369, 81, '_menu_item_type', 'post_type'),
(370, 81, '_menu_item_menu_item_parent', '0'),
(371, 81, '_menu_item_object_id', '80'),
(372, 81, '_menu_item_object', 'page'),
(373, 81, '_menu_item_target', ''),
(374, 81, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(375, 81, '_menu_item_xfn', ''),
(376, 81, '_menu_item_url', ''),
(378, 82, '_menu_item_type', 'post_type'),
(379, 82, '_menu_item_menu_item_parent', '0'),
(380, 82, '_menu_item_object_id', '79'),
(381, 82, '_menu_item_object', 'page'),
(382, 82, '_menu_item_target', ''),
(383, 82, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(384, 82, '_menu_item_xfn', ''),
(385, 82, '_menu_item_url', ''),
(387, 83, '_menu_item_type', 'custom'),
(388, 83, '_menu_item_menu_item_parent', '0'),
(389, 83, '_menu_item_object_id', '83'),
(390, 83, '_menu_item_object', 'custom'),
(391, 83, '_menu_item_target', ''),
(392, 83, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(393, 83, '_menu_item_xfn', ''),
(394, 83, '_menu_item_url', '##'),
(396, 84, '_menu_item_type', 'custom'),
(397, 84, '_menu_item_menu_item_parent', '0'),
(398, 84, '_menu_item_object_id', '84'),
(399, 84, '_menu_item_object', 'custom'),
(400, 84, '_menu_item_target', ''),
(401, 84, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(402, 84, '_menu_item_xfn', ''),
(403, 84, '_menu_item_url', '##'),
(406, 85, 'kbw_views', '0'),
(409, 86, '_edit_last', '1'),
(410, 86, '_edit_lock', '1663577544:1'),
(411, 87, 'kbw_views', '0'),
(412, 88, 'kbw_views', '0'),
(417, 89, 'kbw_views', '0'),
(428, 90, 'hkt_views', '3'),
(430, 90, '_thumbnail_id', '60'),
(431, 90, '_edit_last', '1'),
(432, 90, '_edit_lock', '1663574740:1'),
(438, 90, '_kbw_sidebar_custom', ''),
(439, 90, '_kbw_sidebar_location', ''),
(444, 90, 'kbw_views', '2'),
(454, 93, '_edit_last', '1'),
(455, 93, '_edit_lock', '1663387887:1'),
(456, 94, '_edit_last', '1'),
(457, 94, '_edit_lock', '1663387897:1'),
(458, 95, '_edit_last', '1'),
(459, 95, '_edit_lock', '1663573486:1'),
(472, 96, 'kbw_views', '0'),
(506, 99, 'kbw_views', '0'),
(507, 99, '_thumbnail_id', '59'),
(508, 100, 'kbw_views', '0'),
(509, 100, '_thumbnail_id', '59'),
(511, 101, '_thumbnail_id', '102'),
(512, 101, '_edit_last', '1'),
(513, 101, '_edit_lock', '1663575235:1'),
(515, 101, '_kbw_sidebar_custom', ''),
(516, 101, '_kbw_sidebar_location', ''),
(522, 102, '_wp_attached_file', '2022/09/sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1.jpg');
INSERT INTO `kbw_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(523, 102, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:5000;s:6:\"height\";i:2532;s:4:\"file\";s:83:\"2022/09/sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1.jpg\";s:8:\"filesize\";i:2534006;s:5:\"sizes\";a:11:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:7986;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-406x302.jpg\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:36497;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-406x302.jpg\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:36497;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-400x280.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:32980;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-400x280.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:32980;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-400x280.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:32980;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:7986;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-405x301.jpg\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:36414;}s:15:\"kbw-main-single\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-750x750.jpg\";s:5:\"width\";i:750;s:6:\"height\";i:750;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:148919;}s:16:\"kbw-main-feature\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-515x565.jpg\";s:5:\"width\";i:515;s:6:\"height\";i:565;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:81588;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:83:\"sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1-475x354.jpg\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:49464;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(525, 103, '_edit_last', '1'),
(526, 103, '_edit_lock', '1663578662:1'),
(528, 103, '_kbw_sidebar_custom', ''),
(529, 103, '_kbw_sidebar_location', ''),
(530, 105, '_wp_attached_file', '2022/09/5-dieu-thu-vi-ve-gio-04.jpg'),
(531, 105, '_wp_attachment_metadata', 'a:6:{s:5:\"width\";i:728;s:6:\"height\";i:745;s:4:\"file\";s:35:\"2022/09/5-dieu-thu-vi-ve-gio-04.jpg\";s:8:\"filesize\";i:145269;s:5:\"sizes\";a:10:{s:9:\"thumbnail\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:5947;}s:14:\"post-thumbnail\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-406x302.jpg\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:19855;}s:13:\"kbw-thumbnail\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-406x302.jpg\";s:5:\"width\";i:406;s:6:\"height\";i:302;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:19855;}s:11:\"kbw-related\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-400x280.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:18151;}s:9:\"kbw-large\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-400x280.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:18151;}s:10:\"kbw-medium\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-400x280.jpg\";s:5:\"width\";i:400;s:6:\"height\";i:280;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:18151;}s:9:\"kbw-small\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:5947;}s:16:\"kbw-main-catalog\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-405x301.jpg\";s:5:\"width\";i:405;s:6:\"height\";i:301;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:19819;}s:16:\"kbw-main-feature\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-515x565.jpg\";s:5:\"width\";i:515;s:6:\"height\";i:565;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:42361;}s:21:\"kbw-testimonial-thumb\";a:5:{s:4:\"file\";s:35:\"5-dieu-thu-vi-ve-gio-04-475x354.jpg\";s:5:\"width\";i:475;s:6:\"height\";i:354;s:9:\"mime-type\";s:10:\"image/jpeg\";s:8:\"filesize\";i:26023;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(532, 103, '_thumbnail_id', '105'),
(581, 109, '_edit_last', '1'),
(582, 109, '_edit_lock', '1663577534:1'),
(583, 109, '_thumbnail_id', '102'),
(591, 110, '_edit_last', '1'),
(592, 110, '_edit_lock', '1663577589:1'),
(593, 110, '_thumbnail_id', '61'),
(602, 111, '_edit_last', '1'),
(603, 111, '_edit_lock', '1663579173:1'),
(604, 111, '_thumbnail_id', '62'),
(627, 112, '_edit_last', '1'),
(628, 112, '_edit_lock', '1663635284:1'),
(629, 112, '_thumbnail_id', '59'),
(630, 112, 'testimonial_job', 'CTO'),
(631, 112, 'testimonial_link', 'https://kabiweb.com'),
(632, 112, 'testimonial_social', 'a:3:{i:0;s:20:\"https://facebook.com\";i:1;s:19:\"https://youtube.com\";i:2;s:19:\"https://twitter.com\";}'),
(641, 111, 'kbw_views', '0'),
(642, 110, 'kbw_views', '0'),
(643, 109, 'kbw_views', '0'),
(644, 95, 'kbw_views', '0'),
(645, 94, 'kbw_views', '0'),
(646, 93, 'kbw_views', '0'),
(647, 86, 'kbw_views', '0'),
(648, 51, 'kbw_views', '0'),
(649, 103, 'kbw_views', '0'),
(650, 101, 'kbw_views', '0'),
(651, 54, 'kbw_views', '0'),
(652, 52, 'kbw_views', '0'),
(653, 1, 'kbw_views', '0'),
(657, 112, 'kbw_views', '0'),
(658, 42, 'kbw_views', '0'),
(659, 40, 'kbw_views', '0'),
(660, 114, 'kc_data', 'a:8:{i:0;s:0:\"\";s:4:\"mode\";s:0:\"\";s:3:\"css\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:7:\"classes\";s:0:\"\";s:9:\"thumbnail\";s:0:\"\";s:9:\"collapsed\";s:0:\"\";s:9:\"optimized\";s:0:\"\";}'),
(661, 114, 'kc_raw_content', 'Đang cập nhật...'),
(662, 114, '_edit_last', '1'),
(663, 114, '_edit_lock', '1663635409:1'),
(665, 114, '_kbw_sidebar_custom', ''),
(666, 114, '_kbw_sidebar_location', ''),
(667, 114, '_wpb_vc_js_status', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `kbw_posts`
--

CREATE TABLE `kbw_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8_unicode_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_posts`
--

INSERT INTO `kbw_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2021-10-12 14:12:49', '2021-10-12 07:12:49', '<!-- wp:paragraph -->\r\n<p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it but right to find fault with a man who chooses enjoy.</p>\r\n<!-- /wp:paragraph -->', 'Mission is to bring the power of AI to every business', '', 'publish', 'open', 'open', '', 'mission-is-to-bring-the-power-of-ai-to-every-business', '', '', '2022-09-12 10:18:19', '2022-09-12 03:18:19', '', 0, 'http://lpviettel.hk/?p=1', 0, 'post', '', 0),
(2, 1, '2021-10-12 14:12:49', '2021-10-12 07:12:49', '[vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"banner\" el_class=\"style-1 bg-color\"][vc_column][vc_column_text]\r\n<h2>Viettel Data Platform</h2>\r\nNền tảng công nghệ hoàn chỉnh, giúp doanh nghiệp dễ dàng triển khai một hệ thống Big Data nhanh chóng, đơn giản và tiết kiệm nguồn lực cho việc phát triển các sản phầm dựa trên dữ liệu doanh nghiệp[/vc_column_text][vc_btn title=\"Xem chi tiết\" link=\"url:%23%23\" el_class=\"kbw-button-wrap large\"][/vc_column][/vc_row][vc_row el_id=\"row_01\" el_class=\"style-1 bg-color bg-white\"][vc_column width=\"1/2\" el_class=\"image\"][vc_single_image image=\"30\" img_size=\"full\" css_animation=\"fadeInLeft\"][/vc_column][vc_column width=\"1/2\" el_class=\"text\"][vc_column_text css_animation=\"fadeInRight\" el_class=\"vc_title alink-arrow-wrap\"]\r\n<h5><strong>Về chúng tôi</strong></h5>\r\n<h2>Mission is to bring the power of AI to every business</h2>\r\nTo take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it but right to find fault with a man who chooses enjoy.\r\n\r\n<a href=\"##\">Xem thêm</a>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -39px; top: -3.82812px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"row_02\" el_class=\"style-1 bg-color row-service\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h5><strong>Dịch vụ</strong></h5>\r\n<h2>Dịch vụ chúng tôi cung cấp</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -83px; top: 40.1719px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][vc_row_inner el_class=\"services\"][vc_column_inner el_class=\"wow fadeInLeft\"][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner el_class=\"btn-control\"][vc_btn title=\"Prev\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_03\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text css_animation=\"fadeInLeft\" el_class=\"vc_title\"]\r\n<h5><strong>Case Studies</strong></h5>\r\n<h2>Latest from our projects</h2>\r\n[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"Tất cả\" css_animation=\"fadeInRight\" el_class=\"kbw-button-wrap\" link=\"url:%23%23\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"project\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" column_mb=\"1\" margin=\"25\" thumbnail=\"kbw-main-catalog\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_04\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_column_text el_class=\"vc_title center\"]\r\n<h5><strong>Why Choose Us</strong></h5>\r\n<h2>Reason for people choose us</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][vc_row_inner][vc_column_inner el_class=\"col-left wow fadeInLeft\" width=\"1/2\"][kbw_box image=\"31\" title=\"Mission is to bring the power\" display_style=\"style2\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some\r\n\r\n<a href=\"##\">Xem thêm</a>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -30px; top: 55px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/kbw_box][kbw_box image=\"32\" title=\"Mission is to bring the power\" display_style=\"style2\" element_class=\"reverse\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some\r\n\r\n<a href=\"##\">Xem thêm</a>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -30px; top: 55px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/kbw_box][/vc_column_inner][vc_column_inner el_class=\"col-right\" width=\"1/2\"][vc_single_image image=\"33\" img_size=\"full\" css_animation=\"fadeInRight\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" el_id=\"row_05\" el_class=\"style-1 bg-color row-testimonial\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text css_animation=\"fadeInLeft\" el_class=\"vc_title\"]\r\n<h5><strong>Testimonials</strong></h5>\r\n<h2>Words from our clients</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 457px; top: 40.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"Prev\" css_animation=\"fadeInRight\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" css_animation=\"fadeInRight\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"testimonial\" layout=\"slider\" is_slider=\"yes\" navigation=\"false\" column=\"1\" column_mb=\"1\" thumbnail=\"kbw-testimonial-thumb\" taxonomy=\"testimonial_type\" category=\"tieng-viet\" number_posts=\"10\" excerpt_length=\"300\" class=\"wow fadeInUp\"][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_06\" el_class=\"style-1 bg-color bg-white row-blog\"][vc_column][vc_column_text el_class=\"vc_title center\"]\r\n<h5><strong>Our Blog</strong></h5>\r\n<h2>Latest thinking in AI and our\r\ncompany news</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][kbw_post title=\"hide\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" margin=\"25\" excerpt=\"no\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"row_07\" el_class=\"style-1 bg-color bg-grey row-client\"][vc_column][vc_column_text el_class=\"vc_title center\"]\r\n<h5><strong>Clients</strong></h5>\r\n<h2>Latest thinking in AI and our</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][vc_raw_html]JTVCa2J3X3NsaWRlciUyMGlkJTNEJTIyNDMlMjIlMjB0eXBlJTNEJTIyZ3JpZCUyMiUyMGNvbHVtbiUzRCUyMjQlMjIlMjBjb2x1bW5fbWIlM0QlMjIyJTIyJTIwY29sdW1uX2dhcCUzRCUyMjcwJTIyJTVE[/vc_raw_html][/vc_column][/vc_row]', 'Trang chủ', '', 'publish', 'closed', 'closed', '', 'trang-chu', '', '', '2022-09-18 02:15:58', '2022-09-17 19:15:58', '', 0, 'http://lpviettel.hk/?page_id=2', 0, 'page', '', 0),
(3, 1, '2021-10-12 14:12:49', '2021-10-12 14:12:49', '<!-- wp:heading --><h2>Chúng tôi là ai</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Địa chỉ website là: http://lpviettel.hk.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Bình luận</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Khi khách truy cập để lại bình luận trên trang web, chúng tôi thu thập dữ liệu được hiển thị trong biểu mẫu bình luận và cũng là địa chỉ IP của người truy cập và chuỗi user agent của người dùng trình duyệt để giúp phát hiện spam</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Một chuỗi ẩn danh được tạo từ địa chỉ email của bạn (còn được gọi là hash) có thể được cung cấp cho dịch vụ Gravatar để xem bạn có đang sử dụng nó hay không. Chính sách bảo mật của dịch vụ Gravatar có tại đây: https://automattic.com/privacy/. Sau khi chấp nhận bình luận của bạn, ảnh tiểu sử của bạn được hiển thị công khai trong ngữ cảnh bình luận của bạn.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Media</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Nếu bạn tải hình ảnh lên trang web, bạn nên tránh tải lên hình ảnh có dữ liệu vị trí được nhúng (EXIF GPS) đi kèm. Khách truy cập vào trang web có thể tải xuống và giải nén bất kỳ dữ liệu vị trí nào từ hình ảnh trên trang web.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Cookies</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Nếu bạn viết bình luận trong website, bạn có thể cung cấp cần nhập tên, email địa chỉ website trong cookie. Các thông tin này nhằm giúp bạn không cần nhập thông tin nhiều lần khi viết bình luận khác. Cookie này sẽ được lưu giữ trong một năm.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Nếu bạn vào trang đăng nhập, chúng tôi sẽ thiết lập một cookie tạm thời để xác định nếu trình duyệt cho phép sử dụng cookie. Cookie này không bao gồm thông tin cá nhân và sẽ được gỡ bỏ khi bạn đóng trình duyệt.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Khi bạn đăng nhập, chúng tôi sẽ thiết lập một vài cookie để lưu thông tin đăng nhập và lựa chọn hiển thị. Thông tin đăng nhập gần nhất lưu trong hai ngày, và lựa chọn hiển thị gần nhất lưu trong một năm. Nếu bạn chọn &quot;Nhớ tôi&quot;, thông tin đăng nhập sẽ được lưu trong hai tuần. Nếu bạn thoát tài khoản, thông tin cookie đăng nhập sẽ bị xoá.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Nếu bạn sửa hoặc công bố bài viết, một bản cookie bổ sung sẽ được lưu trong trình duyệt. Cookie này không chứa thông tin cá nhân và chỉ đơn giản bao gồm ID của bài viết bạn đã sửa. Nó tự động hết hạn sau 1 ngày.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Nội dung nhúng từ website khác</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Các bài viết trên trang web này có thể bao gồm nội dung được nhúng (ví dụ: video, hình ảnh, bài viết, v.v.). Nội dung được nhúng từ các trang web khác hoạt động theo cùng một cách chính xác như khi khách truy cập đã truy cập trang web khác.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Những website này có thể thu thập dữ liệu về bạn, sử dụng cookie, nhúng các trình theo dõi của bên thứ ba và giám sát tương tác của bạn với nội dung được nhúng đó, bao gồm theo dõi tương tác của bạn với nội dung được nhúng nếu bạn có tài khoản và đã đăng nhập vào trang web đó.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Chúng tôi chia sẻ dữ liệu của bạn với ai</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>If you request a password reset, your IP address will be included in the reset email.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Dữ liệu của bạn tồn tại bao lâu</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Nếu bạn để lại bình luận, bình luận và siêu dữ liệu của nó sẽ được giữ lại vô thời hạn. Điều này là để chúng tôi có thể tự động nhận ra và chấp nhận bất kỳ bình luận nào thay vì giữ chúng trong khu vực đợi kiểm duyệt.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Đối với người dùng đăng ký trên trang web của chúng tôi (nếu có), chúng tôi cũng lưu trữ thông tin cá nhân mà họ cung cấp trong hồ sơ người dùng của họ. Tất cả người dùng có thể xem, chỉnh sửa hoặc xóa thông tin cá nhân của họ bất kỳ lúc nào (ngoại trừ họ không thể thay đổi tên người dùng của họ). Quản trị viên trang web cũng có thể xem và chỉnh sửa thông tin đó.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Các quyền nào của bạn với dữ liệu của mình</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Nếu bạn có tài khoản trên trang web này hoặc đã để lại nhận xét, bạn có thể yêu cầu nhận tệp xuất dữ liệu cá nhân mà chúng tôi lưu giữ về bạn, bao gồm mọi dữ liệu bạn đã cung cấp cho chúng tôi. Bạn cũng có thể yêu cầu chúng tôi xóa mọi dữ liệu cá nhân mà chúng tôi lưu giữ về bạn. Điều này không bao gồm bất kỳ dữ liệu nào chúng tôi có nghĩa vụ giữ cho các mục đích hành chính, pháp lý hoặc bảo mật.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Các dữ liệu của bạn được gửi tới đâu</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Văn bản được đề xuất: </strong>Các bình luận của khách (không phải là thành viên) có thể được kiểm tra thông qua dịch vụ tự động phát hiện spam.</p><!-- /wp:paragraph -->', 'Chính sách bảo mật', '', 'draft', 'closed', 'open', '', 'chinh-sach-bao-mat', '', '', '2021-10-12 14:12:49', '2021-10-12 14:12:49', '', 0, 'http://lpviettel.hk/?page_id=3', 0, 'page', '', 0),
(7, 1, '2021-10-12 21:21:12', '2021-10-12 14:21:12', '<label> Họ tên:\r\n    [text* your-name] </label>\r\n\r\n<label> Email:\r\n    [email* your-email] </label>\r\n\r\n<label> Tiêu đề:\r\n    [text* your-subject] </label>\r\n\r\n<label> Lời nhắn (Không bắt buộc)\r\n    [textarea your-message] </label>\r\n\r\n[submit \"Gửi\"]\n1\n[_site_title] \"[your-subject]\"\n[_site_title] <cskh@demowp.hk>\n[_site_admin_email]\nGửi đến từ: [your-name] <[your-email]>\r\nTiêu đề: [your-subject]\r\n\r\nNội dung thông điệp:\r\n[your-message]\r\n\r\n-- \r\nEmail này được gửi đến từ form liên hệ của website [_site_title]\r\nĐường dẫn: [_url]\r\nVào lúc: [_time], [_date]\nReply-To: [your-email]\n\n1\n\n1\n[_site_title] \"[your-subject]\"\n[_site_title] <wordpress@demowp.hk>\n[your-email]\nNội dung thông điệp:\r\n[your-message]\r\n\r\n-- \r\nEmail này được gửi đến từ form liên hệ của website [_site_title] ([_site_url])\nReply-To: [_site_admin_email]\n\n\n\nXin cảm ơn, form đã được gửi thành công.\nCó lỗi xảy ra trong quá trình gửi. Xin vui lòng thử lại hoặc liên hệ người quản trị website.\nCó một hoặc nhiều mục nhập có lỗi. Vui lòng kiểm tra và thử lại.\nCó lỗi xảy ra trong quá trình gửi. Xin vui lòng thử lại hoặc liên hệ người quản trị website.\nBạn phải chấp nhận điều khoản trước khi gửi form.\nMục này là bắt buộc.\nNhập quá số kí tự cho phép.\nNhập ít hơn số kí tự tối thiểu.\nTải file lên không thành công.\nBạn không được phép tải lên file theo định dạng này.\nFile kích thước quá lớn.\nTải file lên không thành công.\nĐịnh dạng ngày tháng không hợp lệ.\nNgày này trước ngày sớm nhất được cho phép.\nNgày này quá ngày gần nhất được cho phép.\nĐịnh dạng số không hợp lệ.\nCon số nhỏ hơn số nhỏ nhất cho phép.\nCon số lớn hơn số lớn nhất cho phép.\nCâu trả lời chưa đúng.\nĐịa chỉ e-mail không hợp lệ.\nURL không hợp lệ.\nSố điện thoại không hợp lệ.', 'Form liên hệ 1', '', 'publish', 'closed', 'closed', '', 'form-lien-he-1', '', '', '2021-12-26 18:33:31', '2021-12-26 11:33:31', '', 0, 'http://lpviettel.hk/?post_type=wpcf7_contact_form&#038;p=7', 0, 'wpcf7_contact_form', '', 0),
(8, 1, '2021-10-12 21:50:35', '2021-10-12 14:50:35', 'Đang cập nhật...', 'Giới thiệu', '', 'publish', 'closed', 'closed', '', 'gioi-thieu', '', '', '2021-10-12 21:50:35', '2021-10-12 14:50:35', '', 0, 'http://lpviettel.hk/?page_id=8', 0, 'page', '', 0),
(9, 1, '2021-10-12 21:50:55', '2021-10-12 14:50:55', '[contact-form-7 id=\"7\" title=\"Form liên hệ 1\"]', 'Liên hệ', '', 'publish', 'closed', 'closed', '', 'lien-he', '', '', '2021-10-12 21:50:55', '2021-10-12 14:50:55', '', 0, 'http://lpviettel.hk/?page_id=9', 0, 'page', '', 0),
(10, 1, '2022-09-15 16:27:44', '2021-10-12 14:51:58', ' ', '', '', 'publish', 'closed', 'closed', '', '10', '', '', '2022-09-15 16:27:44', '2022-09-15 09:27:44', '', 0, 'http://lpviettel.hk/?p=10', 1, 'nav_menu_item', '', 0),
(14, 1, '2021-10-12 21:53:40', '2021-10-12 14:53:40', '', 'Main Slider', '', 'publish', 'closed', 'closed', '', 'main-slider', '', '', '2021-10-12 21:53:40', '2021-10-12 14:53:40', '', 0, 'http://lpviettel.hk/?post_type=hkt_slider&#038;p=14', 0, 'hkt_slider', '', 0),
(15, 1, '2021-10-16 14:44:23', '2021-10-16 07:44:23', '', 'Main Slider', '', 'publish', 'closed', 'closed', '', 'main-slider', '', '', '2021-10-16 14:44:23', '2021-10-16 07:44:23', '', 0, 'http://lpviettel.hk/?post_type=kbw_slider&#038;p=15', 0, 'kbw_slider', '', 0),
(21, 1, '2022-09-08 21:16:49', '2022-09-08 14:16:49', '', 'logo', '', 'inherit', 'open', 'closed', '', 'logo', '', '', '2022-09-08 21:16:49', '2022-09-08 14:16:49', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/logo.png', 0, 'attachment', 'image/png', 0),
(22, 1, '2022-09-09 00:27:03', '2022-09-08 17:27:03', '[vc_row css_animation=\"fadeInUp\" el_id=\"row-doc1\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h2>Getting Started with CDP Public Cloud</h2>\r\n[/vc_column_text][vc_row_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"66\" title=\"Learn about CDP Public Cloud\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"65\" title=\"Quickly deploy a CDP environment\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"67\" title=\"CDP onboarding for production\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"68\" title=\"Cloud provider requirements\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_doc2\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h2>CDP Public Cloud Data Services</h2>\r\n[/vc_column_text][vc_row_inner][vc_column_inner el_class=\"five-columns\"][kbw_box image=\"69\" title=\"Data Catalog\" display_style=\"style5\"][/kbw_box][kbw_box image=\"70\" title=\"Data Engineering\" display_style=\"style5\"][/kbw_box][kbw_box image=\"71\" title=\"Data Hub\" display_style=\"style5\"][/kbw_box][kbw_box image=\"72\" title=\"Data Visualization\" display_style=\"style5\"][/kbw_box][kbw_box image=\"73\" title=\"Data Warehouse\" display_style=\"style5\"][/kbw_box][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner el_class=\"five-columns\"][kbw_box image=\"69\" title=\"Data Catalog\" display_style=\"style5\"][/kbw_box][kbw_box image=\"70\" title=\"Data Engineering\" display_style=\"style5\"][/kbw_box][kbw_box image=\"71\" title=\"Data Hub\" display_style=\"style5\"][/kbw_box][kbw_box image=\"72\" title=\"Data Visualization\" display_style=\"style5\"][/kbw_box][kbw_box image=\"73\" title=\"Data Warehouse\" display_style=\"style5\"][/kbw_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_doc3\" el_class=\"style-2 bg-color\"][vc_column][vc_tta_tabs][vc_tta_section title=\"Cloudera Manager\" tab_id=\"1663061329034-dd0c803b-448c\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>Cloudera Manager</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"Cloudera Runtime\" tab_id=\"1663061329047-ad70385f-45af\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>Cloudera Runtime</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"CDP Patterns\" tab_id=\"1663061374528-837ab709-b37a\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>CDP Patterns</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"Preview Features\" tab_id=\"1663061382869-a1ebfb99-8626\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>Preview Features</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row-news\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h2>Latest Updates</h2>\r\n[/vc_column_text][kbw_post layout=\"list\" number_posts=\"10\" excerpt_length=\"20\" style=\"style-list change-none\" class=\"post-listing\"][/vc_column][/vc_row]', 'Tài liệu', '', 'publish', 'closed', 'closed', '', 'tai-lieu', '', '', '2022-09-18 01:07:27', '2022-09-17 18:07:27', '', 0, 'http://lpviettel.hk/?page_id=22', 0, 'page', '', 0),
(23, 1, '2022-09-09 00:27:20', '2022-09-08 17:27:20', '', 'Blog', '', 'publish', 'closed', 'closed', '', 'blog', '', '', '2022-09-15 16:51:47', '2022-09-15 09:51:47', '', 0, 'http://lpviettel.hk/?page_id=23', 0, 'page', '', 0),
(24, 1, '2022-09-15 16:27:44', '2022-09-08 17:28:20', ' ', '', '', 'publish', 'closed', 'closed', '', '24', '', '', '2022-09-15 16:27:44', '2022-09-15 09:27:44', '', 0, 'http://lpviettel.hk/?p=24', 4, 'nav_menu_item', '', 0),
(25, 1, '2022-09-15 16:27:44', '2022-09-08 17:28:20', ' ', '', '', 'publish', 'closed', 'closed', '', '25', '', '', '2022-09-15 16:27:44', '2022-09-15 09:27:44', '', 0, 'http://lpviettel.hk/?p=25', 2, 'nav_menu_item', '', 0),
(26, 1, '2022-09-15 16:27:44', '2022-09-08 17:28:20', '', 'Service', '', 'publish', 'closed', 'closed', '', 'service', '', '', '2022-09-15 16:27:44', '2022-09-15 09:27:44', '', 0, 'http://lpviettel.hk/?p=26', 3, 'nav_menu_item', '', 0),
(27, 1, '2022-09-15 16:27:44', '2022-09-08 17:28:20', '', 'Case Studies', '', 'publish', 'closed', 'closed', '', 'case-studies', '', '', '2022-09-15 16:27:44', '2022-09-15 09:27:44', '', 0, 'http://lpviettel.hk/?p=27', 5, 'nav_menu_item', '', 0),
(28, 1, '2022-09-18 00:35:04', '2022-09-17 17:35:04', '<p>[vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"banner\" el_class=\"style-1 bg-color\"][vc_column][vc_column_text]</p>\n<h2>Viettel Data Platform</h2>\n<p>Nền tảng công nghệ hoàn chỉnh, giúp doanh nghiệp dễ dàng triển khai một hệ thống Big Data nhanh chóng, đơn giản và tiết kiệm nguồn lực cho việc phát triển các sản phầm dựa trên dữ liệu doanh nghiệp[/vc_column_text][vc_btn title=\"Xem chi tiết\" link=\"url:%23%23\" el_class=\"kbw-button-wrap large\"][/vc_column][/vc_row][vc_row el_id=\"row_01\" el_class=\"style-1 bg-color bg-white\"][vc_column width=\"1/2\" el_class=\"image\"][vc_single_image image=\"30\" img_size=\"full\" css_animation=\"fadeInLeft\"][/vc_column][vc_column width=\"1/2\" el_class=\"text\"][vc_column_text css_animation=\"fadeInRight\" el_class=\"vc_title alink-arrow-wrap\"]</p>\n<h5><strong>Về chúng tôi</strong></h5>\n<h2>Mission is to bring the power of AI to every business</h2>\n<p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it but right to find fault with a man who chooses enjoy.</p>\n<p><a href=\"##\">Xem thêm</a></p>\n<div id=\"gtx-trans\" style=\"position: absolute; left: -39px; top: -3.82812px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"row_02\" el_class=\"style-1 bg-color row-service\"][vc_column][vc_column_text el_class=\"vc_title\"]</p>\n<h5><strong>Dịch vụ</strong></h5>\n<h2>Dịch vụ chúng tôi cung cấp</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: -83px; top: 40.1719px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][vc_row_inner el_class=\"services\"][vc_column_inner el_class=\"wow animate__fadeInLeft\"][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Xem thêm\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner el_class=\"btn-control\"][vc_btn title=\"Prev\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_03\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text css_animation=\"fadeInLeft\" el_class=\"vc_title\"]</p>\n<h5><strong>Case Studies</strong></h5>\n<h2>Latest from our projects</h2>\n<p>[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"Tất cả\" css_animation=\"fadeInRight\" el_class=\"kbw-button-wrap\" link=\"url:%23%23\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"project\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" column_mb=\"1\" margin=\"25\" thumbnail=\"kbw-main-catalog\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_04\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_column_text el_class=\"vc_title center\"]</p>\n<h5><strong>Why Choose Us</strong></h5>\n<h2>Reason for people choose us</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][vc_row_inner][vc_column_inner el_class=\"col-left wow fadeInLeft\" width=\"1/2\"][kbw_box image=\"31\" title=\"Mission is to bring the power\" display_style=\"style2\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some</p>\n<p><a href=\"##\">Xem thêm</a></p>\n<div id=\"gtx-trans\" style=\"position: absolute; left: -30px; top: 55px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/kbw_box][kbw_box image=\"32\" title=\"Mission is to bring the power\" display_style=\"style2\" element_class=\"reverse\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some</p>\n<p><a href=\"##\">Xem thêm</a></p>\n<div id=\"gtx-trans\" style=\"position: absolute; left: -30px; top: 55px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/kbw_box][/vc_column_inner][vc_column_inner el_class=\"col-right\" width=\"1/2\"][vc_single_image image=\"33\" img_size=\"full\" css_animation=\"fadeInRight\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" el_id=\"row_05\" el_class=\"style-1 bg-color row-testimonial\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text css_animation=\"fadeInLeft\" el_class=\"vc_title\"]</p>\n<h5><strong>Testimonials</strong></h5>\n<h2>Words from our clients</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 457px; top: 40.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"Prev\" css_animation=\"fadeInRight\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"testimonial\" layout=\"slider\" is_slider=\"yes\" navigation=\"false\" column=\"1\" column_mb=\"1\" thumbnail=\"kbw-testimonial-thumb\" taxonomy=\"testimonial_type\" category=\"tieng-viet\" number_posts=\"10\" excerpt_length=\"300\" class=\"wow fadeInDown\"][/vc_column][/vc_row][vc_row el_id=\"row_06\" el_class=\"style-1 bg-color bg-white row-blog\"][vc_column][vc_column_text el_class=\"vc_title center\"]</p>\n<h5><strong>Our Blog</strong></h5>\n<h2>Latest thinking in AI and our<br />\ncompany news</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][kbw_post title=\"hide\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" margin=\"25\" excerpt=\"no\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" el_id=\"row_07\" el_class=\"style-1 bg-color bg-grey row-client\"][vc_column][vc_column_text el_class=\"vc_title center\"]</p>\n<h5><strong>Clients</strong></h5>\n<h2>Latest thinking in AI and our</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][vc_raw_html]JTVCa2J3X3NsaWRlciUyMGlkJTNEJTIyNDMlMjIlMjB0eXBlJTNEJTIyZ3JpZCUyMiUyMGNvbHVtbiUzRCUyMjQlMjIlMjBjb2x1bW5fbWIlM0QlMjIyJTIyJTIwY29sdW1uX2dhcCUzRCUyMjcwJTIyJTVE[/vc_raw_html][/vc_column][/vc_row]</p>\n', 'Trang chủ', '', 'inherit', 'closed', 'closed', '', '2-autosave-v1', '', '', '2022-09-18 00:35:04', '2022-09-17 17:35:04', '', 2, 'http://lpviettel.hk/?p=28', 0, 'revision', '', 0),
(29, 1, '2022-09-09 10:59:01', '2022-09-09 03:59:01', '', 'favicon', '', 'inherit', 'open', 'closed', '', 'favicon', '', '', '2022-09-09 10:59:01', '2022-09-09 03:59:01', '', 2, 'http://lpviettel.hk/wp-content/uploads/2022/09/favicon.png', 0, 'attachment', 'image/png', 0),
(30, 1, '2022-09-09 10:59:08', '2022-09-09 03:59:08', '', 'img-aboutus', '', 'inherit', 'open', 'closed', '', 'img-aboutus', '', '', '2022-09-09 10:59:08', '2022-09-09 03:59:08', '', 2, 'http://lpviettel.hk/wp-content/uploads/2022/09/img-aboutus.png', 0, 'attachment', 'image/png', 0),
(31, 1, '2022-09-10 01:06:20', '2022-09-09 18:06:20', '', 'why-1', '', 'inherit', 'open', 'closed', '', 'why-1', '', '', '2022-09-10 01:06:20', '2022-09-09 18:06:20', '', 2, 'http://lpviettel.hk/wp-content/uploads/2022/09/why-1.png', 0, 'attachment', 'image/png', 0),
(32, 1, '2022-09-10 01:06:21', '2022-09-09 18:06:21', '', 'why-2', '', 'inherit', 'open', 'closed', '', 'why-2', '', '', '2022-09-10 01:06:21', '2022-09-09 18:06:21', '', 2, 'http://lpviettel.hk/wp-content/uploads/2022/09/why-2.png', 0, 'attachment', 'image/png', 0),
(33, 1, '2022-09-10 01:33:21', '2022-09-09 18:33:21', '', 'noimage', '', 'inherit', 'open', 'closed', '', 'noimage', '', '', '2022-09-10 01:33:21', '2022-09-09 18:33:21', '', 2, 'http://lpviettel.hk/wp-content/uploads/2022/09/noimage.png', 0, 'attachment', 'image/png', 0),
(37, 1, '2022-09-10 09:39:33', '2022-09-10 02:39:33', '', 'icon-service', '', 'inherit', 'open', 'closed', '', 'icon-service', '', '', '2022-09-10 09:39:33', '2022-09-10 02:39:33', '', 2, 'http://lpviettel.hk/wp-content/uploads/2022/09/icon-service.png', 0, 'attachment', 'image/png', 0),
(40, 1, '2022-09-11 10:16:50', '2022-09-11 03:16:50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquet bibendum aliquam a lobortis ullamcorper. Nunc placerat purus condimentum ac nam aliquam, eget lectus ligula. Ullamcorper urna, pulvinar erat velit massa. Justo, orci bibendum at bibendum. Viverra.', 'Donal Archar', '', 'publish', 'closed', 'closed', '', 'donal-archar', '', '', '2022-09-15 23:25:32', '2022-09-15 16:25:32', '', 0, 'http://lpviettel.hk/?post_type=testimonial&#038;p=40', 0, 'testimonial', '', 0),
(41, 1, '2022-09-11 10:16:42', '2022-09-11 03:16:42', '', 'testimonial-1', '', 'inherit', 'open', 'closed', '', 'testimonial-1', '', '', '2022-09-11 10:16:42', '2022-09-11 03:16:42', '', 40, 'http://lpviettel.hk/wp-content/uploads/2022/09/testimonial-1.png', 0, 'attachment', 'image/png', 0),
(42, 1, '2022-09-11 11:37:55', '2022-09-11 04:37:55', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquet bibendum aliquam a lobortis ullamcorper. Nunc placerat purus condimentum ac nam aliquam, eget lectus ligula. Ullamcorper urna, pulvinar erat velit massa. Justo, orci bibendum at bibendum. Viverra.', 'Donal Archar', '', 'publish', 'closed', 'closed', '', 'donal-archar-2', '', '', '2022-09-15 23:25:54', '2022-09-15 16:25:54', '', 0, 'http://lpviettel.hk/?post_type=testimonial&#038;p=42', 0, 'testimonial', '', 0),
(43, 1, '2022-09-11 12:02:21', '2022-09-11 05:02:21', '', 'Client logo', '', 'publish', 'closed', 'closed', '', 'client-logo', '', '', '2022-09-11 12:02:38', '2022-09-11 05:02:38', '', 0, 'http://lpviettel.hk/?post_type=kbw_slider&#038;p=43', 0, 'kbw_slider', '', 0),
(44, 1, '2022-09-11 12:02:01', '2022-09-11 05:02:01', '', 'clients-logo-1', '', 'inherit', 'open', 'closed', '', 'clients-logo-1', '', '', '2022-09-11 12:02:01', '2022-09-11 05:02:01', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/clients-logo-1.png', 0, 'attachment', 'image/png', 0),
(45, 1, '2022-09-11 12:02:04', '2022-09-11 05:02:04', '', 'clients-logo-2', '', 'inherit', 'open', 'closed', '', 'clients-logo-2', '', '', '2022-09-11 12:02:04', '2022-09-11 05:02:04', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/clients-logo-2.png', 0, 'attachment', 'image/png', 0),
(46, 1, '2022-09-11 12:02:06', '2022-09-11 05:02:06', '', 'clients-logo-3', '', 'inherit', 'open', 'closed', '', 'clients-logo-3', '', '', '2022-09-11 12:02:06', '2022-09-11 05:02:06', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/clients-logo-3.png', 0, 'attachment', 'image/png', 0),
(47, 1, '2022-09-11 12:02:09', '2022-09-11 05:02:09', '', 'clients-logo-4', '', 'inherit', 'open', 'closed', '', 'clients-logo-4', '', '', '2022-09-11 12:02:09', '2022-09-11 05:02:09', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/clients-logo-4.png', 0, 'attachment', 'image/png', 0),
(48, 1, '2022-09-11 12:02:11', '2022-09-11 05:02:11', '', 'clients-logo-5', '', 'inherit', 'open', 'closed', '', 'clients-logo-5', '', '', '2022-09-11 12:02:11', '2022-09-11 05:02:11', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/clients-logo-5.png', 0, 'attachment', 'image/png', 0),
(50, 1, '2022-09-11 14:37:28', '2022-09-11 07:37:28', '', 'img-main-catalog', '', 'inherit', 'open', 'closed', '', 'img-main-catalog', '', '', '2022-09-11 14:37:28', '2022-09-11 07:37:28', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/img-main-catalog.png', 0, 'attachment', 'image/png', 0),
(51, 1, '2022-09-11 15:37:16', '2022-09-11 08:37:16', 'Mission is to bring the power of AI to every business', 'Mission is to bring the power of AI to every business', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business', '', '', '2022-09-15 16:55:47', '2022-09-15 09:55:47', '', 0, 'http://lpviettel.hk/?post_type=project&#038;p=51', 0, 'project', '', 0),
(52, 1, '2022-09-11 15:51:13', '2022-09-11 08:51:13', 'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it but right to find fault with a man who chooses enjoy.', 'Mission is to bring the power of AI to every business 2', '', 'publish', 'open', 'open', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-2', '', '', '2022-09-12 10:18:39', '2022-09-12 03:18:39', '', 0, 'http://lpviettel.hk/?p=52', 0, 'post', '', 0),
(53, 1, '2022-09-11 15:51:26', '2022-09-11 08:51:26', '<div>\r\n<div>\r\n<div>\r\n\r\nA monitoring system is a necessary component of any data platform. We can find a lot of different services that use different approaches to the same thing, and all of them provide quite similar features and work reliably, which is most important. Moreover, there is also an opportunity to take advantage of reading logs. This is a really useful feature when debugging an issue in an application or check what is happening on your platform. How can this be achieved?\r\n<h2>Why do we need logs?</h2>\r\nWe need to start with some questions to explain why and for what monitoring systems with log analytics can be useful. The first thing is about performing complex monitoring of each process in our platform. When talking about Big Data solutions, it is imperative to check that all real-time processing jobs work as expected, because we have to act quickly if there are any issues. It is also important to validate how any changes in the code help in the processing part.\r\n\r\nHere we can talk about processing jobs that run on Apache Spark and Apache Flink. The first part of the monitoring process is focused on getting metrics like the number of processed events, JVM statistics or used Task Managers. The second is about log analytics. We want to detect any warnings or errors in the log files and analyze them later during post mortem or to find any invalid data sources. Moreover, we can set up alerts based on the log files that could be really helpful for detecting issues, even with a different component.\r\n\r\nThere is also a need to provide all log files in real time, because any lag in sending them can cause problems and would not provide the required effect for IT and business developers. In the case of a Flink job, we want to check that all triggers work as expected, and if not then we would need to find the reason for this in the log files. We want to find values in logs later by looking for an exact phrase.\r\n\r\nThere are several solutions on the market, and we have tried many different approaches to finding the one tailored to the needs of the service.\r\n<h2>Elastic stack and friends</h2>\r\nThe most common solution when talking about log analytics is Elastic stack. We can use ElasticSearch for indexing, Logstash for processing log files that are sent by Filebeat or Fluentd from machines directly and Kibana for data visualization and alerts. It is a really mature and well-developed platform where you can find a lot of plugins.\r\n\r\nIt is a great solution for indexing logs for business developers when you have to index all the content of log files. We also need to remember about technical requirements. You can tune up the parameters, but it still requires a great amount of CPU and RAM to run everything smoothly.\r\n<h2>A great rival in the market</h2>\r\nWe had Elastic stack in one project. We had Filebeat, Logstash, ElasticSearch and Kibana and we were not able to make it faster, even after implementing some changes. The overall performance was not the best and we therefore started searching for a more powerful solution. Our case was focused on getting logs from Flink jobs and NiFi pipelines because we wanted to check what was inside their logs and find some target values in the historical data.\r\n\r\nWe have a monitoring system based on Prometheus and Grafana. We started by searching for available solutions that would provide better performance, and we could add log analytics in the Grafana directly.\r\n\r\nThen we decided to test Loki. It is a horizontally-scalable, highly-available, multi-tenant log aggregation system inspired by Prometheus. It is designed to be very cost effective and easy to operate. It does not index the contents of the logs, but rather a set of labels for each log stream. The project was started in 2018 and was developed by Grafana Labs so, as you may expect, we can query Loki data in Grafana, which happens to be very useful\r\n\r\n</div>\r\n</div>\r\n</div>', 'Mission is to bring the power of AI to every business 3', '', 'publish', 'open', 'open', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-3', '', '', '2022-09-13 09:46:25', '2022-09-13 02:46:25', '', 0, 'http://lpviettel.hk/?p=53', 0, 'post', '', 0),
(54, 1, '2022-09-11 15:51:38', '2022-09-11 08:51:38', 'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it but right to find fault with a man who chooses enjoy.', 'Mission is to bring the power of AI to every business 4', '', 'publish', 'open', 'open', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-4', '', '', '2022-09-12 09:04:09', '2022-09-12 02:04:09', '', 0, 'http://lpviettel.hk/?p=54', 0, 'post', '', 0),
(55, 1, '2022-09-11 18:00:42', '2022-09-11 11:00:42', '', 'heading-blog', '', 'inherit', 'open', 'closed', '', 'heading-blog', '', '', '2022-09-11 18:00:42', '2022-09-11 11:00:42', '', 0, 'http://lpviettel.hk/wp-content/uploads/2022/09/heading-blog.png', 0, 'attachment', 'image/png', 0),
(56, 1, '2022-09-11 18:35:35', '2022-09-11 11:35:35', '', 'heading-documentation', '', 'inherit', 'open', 'closed', '', 'heading-documentation', '', '', '2022-09-11 18:35:35', '2022-09-11 11:35:35', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/heading-documentation.png', 0, 'attachment', 'image/png', 0),
(58, 1, '2022-09-12 00:56:28', '2022-09-11 17:56:28', '<p>[vc_row el_id=\"row-category\" el_class=\"style-1\"][vc_column][vc_raw_html]PHA+SSBhbSByYXcgaHRtbCBibG9jay48YnIvPkNsaWNrIGVkaXQgYnV0dG9uIHRvIGNoYW5nZSB0aGlzIGh0bWw8L3A+[/vc_raw_html][/vc_column][/vc_row]</p>\n', 'Blog', '', 'inherit', 'closed', 'closed', '', '23-autosave-v1', '', '', '2022-09-12 00:56:28', '2022-09-11 17:56:28', '', 23, 'http://lpviettel.hk/?p=58', 0, 'revision', '', 0),
(59, 1, '2022-09-12 09:04:03', '2022-09-12 02:04:03', '', 'blog-featured', '', 'inherit', 'open', 'closed', '', 'blog-featured', '', '', '2022-09-12 09:04:03', '2022-09-12 02:04:03', '', 54, 'http://lpviettel.hk/wp-content/uploads/2022/09/blog-featured.png', 0, 'attachment', 'image/png', 0),
(60, 1, '2022-09-12 10:18:12', '2022-09-12 03:18:12', '', 'Rectangle 1', '', 'inherit', 'open', 'closed', '', 'rectangle-1', '', '', '2022-09-12 10:18:12', '2022-09-12 03:18:12', '', 1, 'http://lpviettel.hk/wp-content/uploads/2021/10/rectangle-1.png', 0, 'attachment', 'image/png', 0),
(61, 1, '2022-09-12 10:18:32', '2022-09-12 03:18:32', '', 'Rectangle 2', '', 'inherit', 'open', 'closed', '', 'rectangle-2', '', '', '2022-09-12 10:18:32', '2022-09-12 03:18:32', '', 52, 'http://lpviettel.hk/wp-content/uploads/2022/09/rectangle-2.png', 0, 'attachment', 'image/png', 0),
(62, 1, '2022-09-12 10:19:00', '2022-09-12 03:19:00', '', 'Rectangle 3', '', 'inherit', 'open', 'closed', '', 'rectangle-3', '', '', '2022-09-12 10:19:00', '2022-09-12 03:19:00', '', 53, 'http://lpviettel.hk/wp-content/uploads/2022/09/rectangle-3.png', 0, 'attachment', 'image/png', 0),
(63, 1, '2022-09-12 15:17:57', '2022-09-12 08:17:57', '<div>\n<div>\n<div>\n\nA monitoring system is a necessary component of any data platform. We can find a lot of different services that use different approaches to the same thing, and all of them provide quite similar features and work reliably, which is most important. Moreover, there is also an opportunity to take advantage of reading logs. This is a really useful feature when debugging an issue in an application or check what is happening on your platform. How can this be achieved?\n<h2>Why do we need logs?</h2>\nWe need to start with some questions to explain why and for what monitoring systems with log analytics can be useful. The first thing is about performing complex monitoring of each process in our platform. When talking about Big Data solutions, it is imperative to check that all real-time processing jobs work as expected, because we have to act quickly if there are any issues. It is also important to validate how any changes in the code help in the processing part.\n\nHere we can talk about processing jobs that run on Apache Spark and Apache Flink. The first part of the monitoring process is focused on getting metrics like the number of processed events, JVM statistics or used Task Managers. The second is about log analytics. We want to detect any warnings or errors in the log files and analyze them later during post mortem or to find any invalid data sources. Moreover, we can set up alerts based on the log files that could be really helpful for detecting issues, even with a different component.\n\nThere is also a need to provide all log files in real time, because any lag in sending them can cause problems and would not provide the required effect for IT and business developers. In the case of a Flink job, we want to check that all triggers work as expected, and if not then we would need to find the reason for this in the log files. We want to find values in logs later by looking for an exact phrase.\n\nThere are several solutions on the market, and we have tried many different approaches to finding the one tailored to the needs of the service.\n<h2>Elastic stack and friends</h2>\nThe most common solution when talking about log analytics is Elastic stack. We can use ElasticSearch for indexing, Logstash for processing log files that are sent by Filebeat or Fluentd from machines directly and Kibana for data visualization and alerts. It is a really mature and well-developed platform where you can find a lot of plugins.\n\nIt is a great solution for indexing logs for business developers when you have to index all the content of log files. We also need to remember about technical requirements. You can tune up the parameters, but it still requires a great amount of CPU and RAM to run everything smoothly.\n\nA great rival in the market\n\nWe had Elastic stack in one project. We had Filebeat, Logstash, ElasticSearch and Kibana and we were not able to make it faster, even after implementing some changes. The overall performance was not the best and we therefore started searching for a more powerful solution. Our case was focused on getting logs from Flink jobs and NiFi pipelines because we wanted to check what was inside their logs and find some target values in the historical data.\n\nWe have a monitoring system based on Prometheus and Grafana. We started by searching for available solutions that would provide better performance, and we could add log analytics in the Grafana directly.\n\nThen we decided to test Loki. It is a horizontally-scalable, highly-available, multi-tenant log aggregation system inspired by Prometheus. It is designed to be very cost effective and easy to operate. It does not index the contents of the logs, but rather a set of labels for each log stream. The project was started in 2018 and was developed by Grafana Labs so, as you may expect, we can query Loki data in Grafana, which happens to be very useful\n\n</div>\n</div>\n</div>', 'Mission is to bring the power of AI to every business 3', '', 'inherit', 'closed', 'closed', '', '53-autosave-v1', '', '', '2022-09-12 15:17:57', '2022-09-12 08:17:57', '', 53, 'http://lpviettel.hk/?p=63', 0, 'revision', '', 0);
INSERT INTO `kbw_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(64, 1, '2022-09-14 15:14:03', '2022-09-14 08:14:03', '<p>[vc_row el_id=\"row-doc1\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]</p>\n<h2>Getting Started with CDP Public Cloud</h2>\n<p>[/vc_column_text][vc_row_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"66\" title=\"Learn about CDP Public Cloud\" display_style=\"style4\"]Overview and advantages of CDP<br />\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"65\" title=\"Quickly deploy a CDP environment\" display_style=\"style4\"]Overview and advantages of CDP<br />\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"67\" title=\"CDP onboarding for production\" display_style=\"style4\"]Overview and advantages of CDP<br />\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"68\" title=\"Cloud provider requirements\" display_style=\"style4\"]Overview and advantages of CDP<br />\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_id=\"row_doc2\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]</p>\n<h2>CDP Public Cloud Data Services</h2>\n<p>[/vc_column_text][vc_row_inner][vc_column_inner][kbw_box image=\"69\" title=\"Data Catalog\"][/kbw_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_id=\"row_doc3\" el_class=\"style-2 bg-color\"][vc_column][vc_tta_tabs][vc_tta_section title=\"Cloudera Manager\" tab_id=\"1663061329034-dd0c803b-448c\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]</p>\n<h3>Cloudera Manager</h3>\n<p>Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"Cloudera Runtime\" tab_id=\"1663061329047-ad70385f-45af\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]</p>\n<h3>Cloudera Runtime</h3>\n<p>Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"CDP Patterns\" tab_id=\"1663061374528-837ab709-b37a\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]</p>\n<h3>CDP Patterns</h3>\n<p>Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"Preview Features\" tab_id=\"1663061382869-a1ebfb99-8626\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]</p>\n<h3>Preview Features</h3>\n<p>Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_id=\"row-news\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]</p>\n<h2>Latest Updates</h2>\n<p>[/vc_column_text][kbw_post layout=\"list\" number_posts=\"10\" excerpt_length=\"20\" style=\"style-list change-none\" class=\"post-listing\"][/vc_column][/vc_row]</p>\n', 'Documentation', '', 'inherit', 'closed', 'closed', '', '22-autosave-v1', '', '', '2022-09-14 15:14:03', '2022-09-14 08:14:03', '', 22, 'http://lpviettel.hk/?p=64', 0, 'revision', '', 0),
(65, 1, '2022-09-14 08:34:26', '2022-09-14 01:34:26', '', 'carbon_cloud-app', '', 'inherit', 'open', 'closed', '', 'carbon_cloud-app', '', '', '2022-09-14 08:34:26', '2022-09-14 01:34:26', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/carbon-cloud-app.png', 0, 'attachment', 'image/png', 0),
(66, 1, '2022-09-14 08:34:28', '2022-09-14 01:34:28', '', 'carbon_cloud-service-management', '', 'inherit', 'open', 'closed', '', 'carbon_cloud-service-management', '', '', '2022-09-14 08:34:28', '2022-09-14 01:34:28', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/carbon-cloud-service-management.png', 0, 'attachment', 'image/png', 0),
(67, 1, '2022-09-14 08:34:30', '2022-09-14 01:34:30', '', 'carbon_user-role', '', 'inherit', 'open', 'closed', '', 'carbon_user-role', '', '', '2022-09-14 08:34:30', '2022-09-14 01:34:30', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/carbon-user-role.png', 0, 'attachment', 'image/png', 0),
(68, 1, '2022-09-14 08:34:32', '2022-09-14 01:34:32', '', 'fluent_document-bullet-list-20-regular', '', 'inherit', 'open', 'closed', '', 'fluent_document-bullet-list-20-regular', '', '', '2022-09-14 08:34:32', '2022-09-14 01:34:32', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/fluent-document-bullet-list-20-regular.png', 0, 'attachment', 'image/png', 0),
(69, 1, '2022-09-14 15:13:20', '2022-09-14 08:13:20', '', 'octicon_code-square-1', '', 'inherit', 'open', 'closed', '', 'octicon_code-square-1', '', '', '2022-09-14 15:13:20', '2022-09-14 08:13:20', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/octicon-code-square-1.png', 0, 'attachment', 'image/png', 0),
(70, 1, '2022-09-14 15:13:22', '2022-09-14 08:13:22', '', 'octicon_code-square-2', '', 'inherit', 'open', 'closed', '', 'octicon_code-square-2', '', '', '2022-09-14 15:13:22', '2022-09-14 08:13:22', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/octicon-code-square-2.png', 0, 'attachment', 'image/png', 0),
(71, 1, '2022-09-14 15:13:23', '2022-09-14 08:13:23', '', 'octicon_code-square-3', '', 'inherit', 'open', 'closed', '', 'octicon_code-square-3', '', '', '2022-09-14 15:13:23', '2022-09-14 08:13:23', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/octicon-code-square-3.png', 0, 'attachment', 'image/png', 0),
(72, 1, '2022-09-14 15:13:25', '2022-09-14 08:13:25', '', 'octicon_code-square-4', '', 'inherit', 'open', 'closed', '', 'octicon_code-square-4', '', '', '2022-09-14 15:13:25', '2022-09-14 08:13:25', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/octicon-code-square-4.png', 0, 'attachment', 'image/png', 0),
(73, 1, '2022-09-14 15:13:27', '2022-09-14 08:13:27', '', 'octicon_code-square-5', '', 'inherit', 'open', 'closed', '', 'octicon_code-square-5', '', '', '2022-09-14 15:13:27', '2022-09-14 08:13:27', '', 22, 'http://lpviettel.hk/wp-content/uploads/2022/09/octicon-code-square-5.png', 0, 'attachment', 'image/png', 0),
(74, 1, '2022-09-15 16:14:49', '2022-09-15 09:14:49', '', 'polylang_mo_7', '', 'private', 'closed', 'closed', '', 'polylang_mo_7', '', '', '2022-09-15 16:14:49', '2022-09-15 09:14:49', '', 0, 'http://lpviettel.hk/?post_type=polylang_mo&p=74', 0, 'polylang_mo', '', 0),
(75, 1, '2022-09-15 16:14:50', '2022-09-15 09:14:50', '', 'polylang_mo_10', '', 'private', 'closed', 'closed', '', 'polylang_mo_10', '', '', '2022-09-15 16:14:50', '2022-09-15 09:14:50', '', 0, 'http://lpviettel.hk/?post_type=polylang_mo&p=75', 0, 'polylang_mo', '', 0),
(76, 1, '2022-09-15 16:16:49', '2022-09-15 09:16:49', '[vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"banner\" el_class=\"style-1 bg-color\"][vc_column][vc_column_text]\r\n<h2>Viettel Data Platform</h2>\r\nA complete technology platform, making it easy for businesses to deploy a fast, simple and resource-saving Big Data system for the development of products based on enterprise data.[/vc_column_text][vc_btn title=\"View detail\" link=\"url:%23%23\" el_class=\"kbw-button-wrap large\"][/vc_column][/vc_row][vc_row el_id=\"row_01\" el_class=\"style-1 bg-color bg-white\"][vc_column width=\"1/2\" el_class=\"image\"][vc_single_image image=\"30\" img_size=\"full\" css_animation=\"fadeInLeft\"][/vc_column][vc_column width=\"1/2\" el_class=\"text\"][vc_column_text css_animation=\"fadeInRight\" el_class=\"vc_title alink-arrow-wrap\"]\r\n<h5><strong>About Us</strong></h5>\r\n<h2>Mission is to bring the power of AI to every business</h2>\r\nTo take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it but right to find fault with a man who chooses enjoy.\r\n\r\n<a href=\"##\">More About us</a>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -39px; top: -3.82812px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"row_02\" el_class=\"style-1 bg-color row-service\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h5><strong>Service</strong></h5>\r\n<h2>Services we provide</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -83px; top: 40.1719px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][vc_row_inner el_class=\"services\"][vc_column_inner el_class=\"wow fadeInLeft\"][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner el_class=\"btn-control\"][vc_btn title=\"Prev\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_03\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text css_animation=\"fadeInLeft\" el_class=\"vc_title\"]\r\n<h5><strong>Case Studies</strong></h5>\r\n<h2>Latest from our projects</h2>\r\n[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"All Project\" css_animation=\"fadeInRight\" el_class=\"kbw-button-wrap\" link=\"url:%23%23\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"project\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" column_mb=\"1\" margin=\"25\" thumbnail=\"kbw-main-catalog\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_04\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_column_text el_class=\"vc_title center\"]\r\n<h5><strong>Why Choose Us</strong></h5>\r\n<h2>Reason for people choose us</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][vc_row_inner][vc_column_inner el_class=\"col-left wow fadeInLeft\" width=\"1/2\"][kbw_box image=\"31\" title=\"Mission is to bring the power\" display_style=\"style2\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some\r\n\r\n<a href=\"##\">Read More</a>[/kbw_box][kbw_box image=\"32\" title=\"Mission is to bring the power\" display_style=\"style2\" element_class=\"reverse\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some\r\n\r\n<a href=\"##\">Read More</a>[/kbw_box][/vc_column_inner][vc_column_inner el_class=\"col-right\" width=\"1/2\"][vc_single_image image=\"33\" img_size=\"full\" css_animation=\"fadeInRight\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" el_id=\"row_05\" el_class=\"style-1 bg-color row-testimonial\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text css_animation=\"fadeInLeft\" el_class=\"vc_title\"]\r\n<h5><strong>Testimonials</strong></h5>\r\n<h2>Words from our clients</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 457px; top: 40.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"Prev\" css_animation=\"fadeInRight\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" css_animation=\"fadeInRight\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"testimonial\" layout=\"slider\" is_slider=\"yes\" navigation=\"false\" column=\"1\" column_mb=\"1\" thumbnail=\"kbw-testimonial-thumb\" taxonomy=\"testimonial_type\" category=\"tieng-anh\" number_posts=\"10\" excerpt_length=\"300\" class=\"wow fadeInUp\"][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_06\" el_class=\"style-1 bg-color bg-white row-blog\"][vc_column][vc_column_text el_class=\"vc_title center\"]\r\n<h5><strong>Our Blog</strong></h5>\r\n<h2>Latest thinking in AI and our\r\ncompany news</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][kbw_post title=\"hide\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" margin=\"25\" excerpt=\"no\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"row_07\" el_class=\"style-1 bg-color bg-grey row-client\"][vc_column][vc_column_text el_class=\"vc_title center\"]\r\n<h5><strong>Clients</strong></h5>\r\n<h2>Latest thinking in AI and our</h2>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\r\n<div class=\"gtx-trans-icon\"></div>\r\n</div>\r\n[/vc_column_text][vc_raw_html]JTVCa2J3X3NsaWRlciUyMGlkJTNEJTIyNDMlMjIlMjB0eXBlJTNEJTIyZ3JpZCUyMiUyMGNvbHVtbiUzRCUyMjQlMjIlMjBjb2x1bW5fbWIlM0QlMjIyJTIyJTIwY29sdW1uX2dhcCUzRCUyMjcwJTIyJTVE[/vc_raw_html][/vc_column][/vc_row]', 'Home', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2022-09-18 01:04:54', '2022-09-17 18:04:54', '', 0, 'http://lpviettel.hk/home-english/', 0, 'page', '', 0),
(77, 1, '2022-09-15 16:50:37', '2022-09-15 09:29:03', ' ', '', '', 'publish', 'closed', 'closed', '', '77', '', '', '2022-09-15 16:50:37', '2022-09-15 09:50:37', '', 0, 'http://lpviettel.hk/?p=77', 1, 'nav_menu_item', '', 0),
(78, 1, '2022-09-18 01:03:38', '2022-09-17 18:03:38', '<p>[vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"banner\" el_class=\"style-1 bg-color\"][vc_column][vc_column_text]</p>\n<h2>Viettel Data Platform</h2>\n<p>A complete technology platform, making it easy for businesses to deploy a fast, simple and resource-saving Big Data system for the development of products based on enterprise data.[/vc_column_text][vc_btn title=\"View detail\" link=\"url:%23%23\" el_class=\"kbw-button-wrap large\"][/vc_column][/vc_row][vc_row el_id=\"row_01\" el_class=\"style-1 bg-color bg-white\"][vc_column width=\"1/2\" el_class=\"image\"][vc_single_image image=\"30\" img_size=\"full\" css_animation=\"fadeInLeft\"][/vc_column][vc_column width=\"1/2\" el_class=\"text\"][vc_column_text css_animation=\"fadeInRight\" el_class=\"vc_title alink-arrow-wrap\"]</p>\n<h5><strong>About Us</strong></h5>\n<h2>Mission is to bring the power of AI to every business</h2>\n<p>To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it but right to find fault with a man who chooses enjoy.</p>\n<p><a href=\"##\">More About us</a></p>\n<div id=\"gtx-trans\" style=\"position: absolute; left: -39px; top: -3.82812px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" css_animation=\"fadeInUp\" el_id=\"row_02\" el_class=\"style-1 bg-color row-service\"][vc_column][vc_column_text el_class=\"vc_title\"]</p>\n<h5><strong>Service</strong></h5>\n<h2>Services we provide</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: -83px; top: 40.1719px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][vc_row_inner el_class=\"services\"][vc_column_inner el_class=\"wow fadeInLeft\"][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][kbw_box image=\"37\" title=\"Data Science\" link=\"##\" link_text=\"Read more\" display_style=\"style3\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi---[/kbw_box][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner el_class=\"btn-control\"][vc_btn title=\"Prev\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_03\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text css_animation=\"fadeInLeft\" el_class=\"vc_title\"]</p>\n<h5><strong>Case Studies</strong></h5>\n<h2>Latest from our projects</h2>\n<p>[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"All Project\" css_animation=\"fadeInRight\" el_class=\"kbw-button-wrap\" link=\"url:%23%23\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"project\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" column_mb=\"1\" margin=\"25\" thumbnail=\"kbw-main-catalog\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_04\" el_class=\"style-1 bg-color bg-white\"][vc_column][vc_column_text el_class=\"vc_title center\"]</p>\n<h5><strong>Why Choose Us</strong></h5>\n<h2>Reason for people choose us</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][vc_row_inner][vc_column_inner el_class=\"col-left wow fadeInLeft\" width=\"1/2\"][kbw_box image=\"31\" title=\"Mission is to bring the power\" display_style=\"style2\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some</p>\n<p><a href=\"##\">Read More</a>[/kbw_box][kbw_box image=\"32\" title=\"Mission is to bring the power\" display_style=\"style2\" element_class=\"reverse\"]To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some</p>\n<p><a href=\"##\">Read More</a>[/kbw_box][/vc_column_inner][vc_column_inner el_class=\"col-right\" width=\"1/2\"][vc_single_image image=\"33\" img_size=\"full\" css_animation=\"fadeInRight\"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" el_id=\"row_05\" el_class=\"style-1 bg-color row-testimonial\"][vc_column][vc_row_inner el_class=\"title-button\"][vc_column_inner width=\"2/3\"][vc_column_text el_class=\"vc_title\"]</p>\n<h5><strong>Testimonials</strong></h5>\n<h2>Words from our clients</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 457px; top: 40.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][/vc_column_inner][vc_column_inner el_class=\"btn-control\" width=\"1/3\"][vc_btn title=\"Prev\" el_class=\"kbw-button-control prev\"][vc_btn title=\"Next\" el_class=\"kbw-button-control next\"][/vc_column_inner][/vc_row_inner][kbw_custompost title=\"hide\" post_type=\"testimonial\" layout=\"slider\" is_slider=\"yes\" navigation=\"false\" column=\"1\" column_mb=\"1\" thumbnail=\"kbw-testimonial-thumb\" taxonomy=\"testimonial_type\" category=\"tieng-anh\" number_posts=\"10\" excerpt_length=\"300\"][/vc_column][/vc_row][vc_row el_id=\"row_06\" el_class=\"style-1 bg-color bg-white row-blog\"][vc_column][vc_column_text el_class=\"vc_title center\"]</p>\n<h5><strong>Our Blog</strong></h5>\n<h2>Latest thinking in AI and our<br />\ncompany news</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][kbw_post title=\"hide\" is_slider=\"yes\" navigation=\"false\" pagination=\"true\" margin=\"25\" excerpt=\"no\" style=\"change-zoom\"][/vc_column][/vc_row][vc_row full_width=\"stretch_row\" el_id=\"row_07\" el_class=\"style-1 bg-color bg-grey row-client\"][vc_column][vc_column_text el_class=\"vc_title center\"]</p>\n<h5><strong>Clients</strong></h5>\n<h2>Latest thinking in AI and our</h2>\n<div id=\"gtx-trans\" style=\"position: absolute; left: 1px; top: 96.2656px;\">\n<div class=\"gtx-trans-icon\"></div>\n</div>\n<p>[/vc_column_text][vc_raw_html]JTVCa2J3X3NsaWRlciUyMGlkJTNEJTIyNDMlMjIlMjB0eXBlJTNEJTIyZ3JpZCUyMiUyMGNvbHVtbiUzRCUyMjQlMjIlMjBjb2x1bW5fbWIlM0QlMjIyJTIyJTIwY29sdW1uX2dhcCUzRCUyMjcwJTIyJTVE[/vc_raw_html][/vc_column][/vc_row]</p>\n', 'Home', '', 'inherit', 'closed', 'closed', '', '76-autosave-v1', '', '', '2022-09-18 01:03:38', '2022-09-17 18:03:38', '', 76, 'http://lpviettel.hk/?p=78', 0, 'revision', '', 0),
(79, 1, '2022-09-15 16:47:36', '2022-09-15 09:47:36', '[vc_row css_animation=\"fadeInUp\" el_id=\"row-doc1\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h2>Getting Started with CDP Public Cloud</h2>\r\n[/vc_column_text][vc_row_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"66\" title=\"Learn about CDP Public Cloud\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"65\" title=\"Quickly deploy a CDP environment\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"67\" title=\"CDP onboarding for production\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][vc_column_inner width=\"1/4\"][kbw_box image=\"68\" title=\"Cloud provider requirements\" display_style=\"style4\"]Overview and advantages of CDP\r\nPublic Cloud that is a cloud form factor of CDP.[/kbw_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_doc2\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h2>CDP Public Cloud Data Services</h2>\r\n[/vc_column_text][vc_row_inner][vc_column_inner el_class=\"five-columns\"][kbw_box image=\"69\" title=\"Data Catalog\" display_style=\"style5\"][/kbw_box][kbw_box image=\"70\" title=\"Data Engineering\" display_style=\"style5\"][/kbw_box][kbw_box image=\"71\" title=\"Data Hub\" display_style=\"style5\"][/kbw_box][kbw_box image=\"72\" title=\"Data Visualization\" display_style=\"style5\"][/kbw_box][kbw_box image=\"73\" title=\"Data Warehouse\" display_style=\"style5\"][/kbw_box][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner el_class=\"five-columns\"][kbw_box image=\"69\" title=\"Data Catalog\" display_style=\"style5\"][/kbw_box][kbw_box image=\"70\" title=\"Data Engineering\" display_style=\"style5\"][/kbw_box][kbw_box image=\"71\" title=\"Data Hub\" display_style=\"style5\"][/kbw_box][kbw_box image=\"72\" title=\"Data Visualization\" display_style=\"style5\"][/kbw_box][kbw_box image=\"73\" title=\"Data Warehouse\" display_style=\"style5\"][/kbw_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row_doc3\" el_class=\"style-2 bg-color\"][vc_column][vc_tta_tabs][vc_tta_section title=\"Cloudera Manager\" tab_id=\"1663061329034-dd0c803b-448c\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>Cloudera Manager</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"Cloudera Runtime\" tab_id=\"1663061329047-ad70385f-45af\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>Cloudera Runtime</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"CDP Patterns\" tab_id=\"1663061374528-837ab709-b37a\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>CDP Patterns</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][vc_tta_section title=\"Preview Features\" tab_id=\"1663061382869-a1ebfb99-8626\"][vc_column_text el_class=\"Cloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.\"]\r\n<h3>Preview Features</h3>\r\nCloudera Manager is a component of CDP. After creating a cluster with Management Console, use Cloudera Manager to manage, configure, and monitor the cluster.[/vc_column_text][vc_btn title=\"More detail\" link=\"url:%23\" el_class=\"kbw-button-wrap large\"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row css_animation=\"fadeInUp\" el_id=\"row-news\" el_class=\"style-2 bg-color\"][vc_column][vc_column_text el_class=\"vc_title\"]\r\n<h2>Latest Updates</h2>\r\n[/vc_column_text][kbw_post layout=\"list\" number_posts=\"10\" excerpt_length=\"20\" style=\"style-list change-none\" class=\"post-listing\"][/vc_column][/vc_row]', 'Documentation', '', 'publish', 'closed', 'closed', '', 'documentation', '', '', '2022-09-18 01:08:28', '2022-09-17 18:08:28', '', 0, 'http://lpviettel.hk/?page_id=79', 0, 'page', '', 0),
(80, 1, '2022-09-15 16:49:00', '2022-09-15 09:49:00', '', 'Blog', '', 'publish', 'closed', 'closed', '', 'blog-en', '', '', '2022-09-15 16:49:10', '2022-09-15 09:49:10', '', 0, 'http://lpviettel.hk/?page_id=80', 0, 'page', '', 0),
(81, 1, '2022-09-15 16:50:37', '2022-09-15 09:50:36', ' ', '', '', 'publish', 'closed', 'closed', '', '81', '', '', '2022-09-15 16:50:37', '2022-09-15 09:50:37', '', 0, 'http://lpviettel.hk/?p=81', 4, 'nav_menu_item', '', 0),
(82, 1, '2022-09-15 16:50:37', '2022-09-15 09:50:35', ' ', '', '', 'publish', 'closed', 'closed', '', '82', '', '', '2022-09-15 16:50:37', '2022-09-15 09:50:37', '', 0, 'http://lpviettel.hk/?p=82', 2, 'nav_menu_item', '', 0),
(83, 1, '2022-09-15 16:50:37', '2022-09-15 09:50:35', '', 'Service', '', 'publish', 'closed', 'closed', '', 'service-2', '', '', '2022-09-15 16:50:37', '2022-09-15 09:50:37', '', 0, 'http://lpviettel.hk/?p=83', 3, 'nav_menu_item', '', 0),
(84, 1, '2022-09-15 16:50:37', '2022-09-15 09:50:36', '', 'Case Studies', '', 'publish', 'closed', 'closed', '', 'case-studies-2', '', '', '2022-09-15 16:50:37', '2022-09-15 09:50:37', '', 0, 'http://lpviettel.hk/?p=84', 5, 'nav_menu_item', '', 0),
(85, 1, '2022-09-15 16:53:08', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-15 16:53:08', '0000-00-00 00:00:00', '', 0, 'http://lpviettel.hk/?post_type=project&p=85', 0, 'project', '', 0),
(86, 1, '2022-09-15 16:54:25', '2022-09-15 09:54:25', 'Mission is to bring the power of AI to every business', 'Mission is to bring the power of AI to every business en_Gb', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-en_gb', '', '', '2022-09-15 16:56:18', '2022-09-15 09:56:18', '', 0, 'http://lpviettel.hk/?post_type=project&#038;p=86', 0, 'project', '', 0),
(87, 1, '2022-09-15 16:54:31', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-15 16:54:31', '0000-00-00 00:00:00', '', 0, 'http://lpviettel.hk/?post_type=project&p=87', 0, 'project', '', 0),
(88, 1, '2022-09-15 16:54:56', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-15 16:54:56', '0000-00-00 00:00:00', '', 0, 'http://lpviettel.hk/?post_type=project&p=88', 0, 'project', '', 0),
(89, 1, '2022-09-15 16:55:58', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-15 16:55:58', '0000-00-00 00:00:00', '', 0, 'http://lpviettel.hk/?post_type=project&p=89', 0, 'project', '', 0),
(90, 1, '2022-09-15 17:36:28', '2022-09-15 10:36:28', '<div>\r\n<div>\r\n<div>\r\n\r\nA monitoring system is a necessary component of any data platform. We can find a lot of different services that use different approaches to the same thing, and all of them provide quite similar features and work reliably, which is most important. Moreover, there is also an opportunity to take advantage of reading logs. This is a really useful feature when debugging an issue in an application or check what is happening on your platform. How can this be achieved?\r\n<h2>Why do we need logs?</h2>\r\nWe need to start with some questions to explain why and for what monitoring systems with log analytics can be useful. The first thing is about performing complex monitoring of each process in our platform. When talking about Big Data solutions, it is imperative to check that all real-time processing jobs work as expected, because we have to act quickly if there are any issues. It is also important to validate how any changes in the code help in the processing part.\r\n\r\nHere we can talk about processing jobs that run on Apache Spark and Apache Flink. The first part of the monitoring process is focused on getting metrics like the number of processed events, JVM statistics or used Task Managers. The second is about log analytics. We want to detect any warnings or errors in the log files and analyze them later during post mortem or to find any invalid data sources. Moreover, we can set up alerts based on the log files that could be really helpful for detecting issues, even with a different component.\r\n\r\nThere is also a need to provide all log files in real time, because any lag in sending them can cause problems and would not provide the required effect for IT and business developers. In the case of a Flink job, we want to check that all triggers work as expected, and if not then we would need to find the reason for this in the log files. We want to find values in logs later by looking for an exact phrase.\r\n\r\nThere are several solutions on the market, and we have tried many different approaches to finding the one tailored to the needs of the service.\r\n<h2>Elastic stack and friends</h2>\r\nThe most common solution when talking about log analytics is Elastic stack. We can use ElasticSearch for indexing, Logstash for processing log files that are sent by Filebeat or Fluentd from machines directly and Kibana for data visualization and alerts. It is a really mature and well-developed platform where you can find a lot of plugins.\r\n\r\nIt is a great solution for indexing logs for business developers when you have to index all the content of log files. We also need to remember about technical requirements. You can tune up the parameters, but it still requires a great amount of CPU and RAM to run everything smoothly.\r\n<h2>A great rival in the market</h2>\r\nWe had Elastic stack in one project. We had Filebeat, Logstash, ElasticSearch and Kibana and we were not able to make it faster, even after implementing some changes. The overall performance was not the best and we therefore started searching for a more powerful solution. Our case was focused on getting logs from Flink jobs and NiFi pipelines because we wanted to check what was inside their logs and find some target values in the historical data.\r\n\r\nWe have a monitoring system based on Prometheus and Grafana. We started by searching for available solutions that would provide better performance, and we could add log analytics in the Grafana directly.\r\n\r\nThen we decided to test Loki. It is a horizontally-scalable, highly-available, multi-tenant log aggregation system inspired by Prometheus. It is designed to be very cost effective and easy to operate. It does not index the contents of the logs, but rather a set of labels for each log stream. The project was started in 2018 and was developed by Grafana Labs so, as you may expect, we can query Loki data in Grafana, which happens to be very useful\r\n\r\n</div>\r\n</div>\r\n</div>', 'Mission is to bring the power of AI to every business en_Gb', '', 'publish', 'open', 'open', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-en_gb', '', '', '2022-09-15 17:36:28', '2022-09-15 10:36:28', '', 0, 'http://lpviettel.hk/?p=90', 0, 'post', '', 0),
(91, 1, '2022-09-15 18:27:34', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-15 18:27:34', '0000-00-00 00:00:00', '', 0, 'http://lpviettel.hk/?p=91', 0, 'post', '', 0),
(92, 1, '2022-09-17 09:16:22', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-17 09:16:22', '0000-00-00 00:00:00', '', 0, 'http://lpviettel.hk/?p=92', 0, 'post', '', 0),
(93, 1, '2022-09-17 11:13:48', '2022-09-17 04:13:48', '', 'Mission is to bring the power of AI to every business 2', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-2', '', '', '2022-09-17 11:13:48', '2022-09-17 04:13:48', '', 0, 'http://demo201.kabiweb.com/?post_type=project&#038;p=93', 0, 'project', '', 0),
(94, 1, '2022-09-17 11:13:57', '2022-09-17 04:13:57', '', 'Mission is to bring the power of AI to every business 3', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-3', '', '', '2022-09-17 11:13:57', '2022-09-17 04:13:57', '', 0, 'http://demo201.kabiweb.com/?post_type=project&#038;p=94', 0, 'project', '', 0),
(95, 1, '2022-09-17 11:14:06', '2022-09-17 04:14:06', '', 'Mission is to bring the power of AI to every business 4', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-4', '', '', '2022-09-17 11:14:06', '2022-09-17 04:14:06', '', 0, 'http://demo201.kabiweb.com/?post_type=project&#038;p=95', 0, 'project', '', 0),
(96, 1, '2022-09-19 14:48:00', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-19 14:48:00', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?post_type=project&p=96', 0, 'project', '', 0),
(97, 1, '2022-09-19 14:48:23', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-19 14:48:23', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?post_type=project&p=97', 0, 'project', '', 0),
(98, 1, '2022-09-19 14:51:24', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-19 14:51:24', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?post_type=project&p=98', 0, 'project', '', 0),
(99, 1, '2022-09-19 15:03:15', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-19 15:03:15', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?p=99', 0, 'post', '', 0),
(100, 1, '2022-09-19 15:03:41', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-19 15:03:41', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?p=100', 0, 'post', '', 0),
(101, 1, '2022-09-19 15:03:59', '2022-09-19 08:03:59', '1212312332', 'Mission is to bring the power of AI to every business 4', '', 'publish', 'open', 'open', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-4-2', '', '', '2022-09-19 15:11:02', '2022-09-19 08:11:02', '', 0, 'http://demo201.kabiweb.com/?p=101', 0, 'post', '', 0),
(102, 1, '2022-09-19 15:09:57', '2022-09-19 08:09:57', '', 'sand_sea_sky_palm_trees_nature_tropical_landscape_beautiful_5000x2532', '', 'inherit', 'open', 'closed', '', 'sand_sea_sky_palm_trees_nature_tropical_landscape_beautiful_5000x2532', '', '', '2022-09-19 15:09:57', '2022-09-19 08:09:57', '', 101, 'http://demo201.kabiweb.com/wp-content/uploads/2022/09/sand-sea-sky-palm-trees-nature-tropical-landscape-beautiful-5000x2532-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(103, 1, '2022-09-19 15:17:41', '2022-09-19 08:17:41', 'Khánh láo toét', 'Khánh láo toét', '', 'publish', 'open', 'open', '', 'khanh-lao-toet', '', '', '2022-09-19 15:43:23', '2022-09-19 08:43:23', '', 0, 'http://demo201.kabiweb.com/?p=103', 0, 'post', '', 0),
(104, 1, '2022-09-19 15:17:51', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-19 15:17:51', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?p=104', 0, 'post', '', 0),
(105, 1, '2022-09-19 15:21:12', '2022-09-19 08:21:12', '', '5-Dieu-Thu-Vi-Ve-Gio-04', '', 'inherit', 'open', 'closed', '', '5-dieu-thu-vi-ve-gio-04', '', '', '2022-09-19 15:21:12', '2022-09-19 08:21:12', '', 103, 'http://demo201.kabiweb.com/wp-content/uploads/2022/09/5-dieu-thu-vi-ve-gio-04.jpg', 0, 'attachment', 'image/jpeg', 0),
(106, 1, '2022-09-19 15:41:48', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-19 15:41:48', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?p=106', 0, 'post', '', 0),
(107, 1, '2022-09-19 15:44:53', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-19 15:44:53', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?p=107', 0, 'post', '', 0),
(108, 1, '2022-09-19 15:50:51', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'open', 'open', '', '', '', '', '2022-09-19 15:50:51', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?p=108', 0, 'post', '', 0),
(109, 1, '2022-09-19 15:52:03', '2022-09-19 08:52:03', 'Mission is to bring the power of AI to every business 2', 'Mission is to bring the power of AI to every business 2_E', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-2_e', '', '', '2022-09-19 15:54:17', '2022-09-19 08:54:17', '', 0, 'http://demo201.kabiweb.com/?post_type=project&#038;p=109', 0, 'project', '', 0),
(110, 1, '2022-09-19 15:55:13', '2022-09-19 08:55:13', 'Mission is to bring the power of AI to every business 3_E', 'Mission is to bring the power of AI to every business 3_E', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-3_e', '', '', '2022-09-19 15:55:13', '2022-09-19 08:55:13', '', 0, 'http://demo201.kabiweb.com/?post_type=project&#038;p=110', 0, 'project', '', 0),
(111, 1, '2022-09-19 15:56:04', '2022-09-19 08:56:04', 'Mission is to bring the power of AI to every business 3_E', 'Mission is to bring the power of AI to every business 4_E', '', 'publish', 'closed', 'closed', '', 'mission-is-to-bring-the-power-of-ai-to-every-business-4_e', '', '', '2022-09-19 15:56:04', '2022-09-19 08:56:04', '', 0, 'http://demo201.kabiweb.com/?post_type=project&#038;p=111', 0, 'project', '', 0),
(112, 1, '2022-09-19 16:19:58', '2022-09-19 09:19:58', 'Never explain yourself to anyone. Because the person who likes you doesn’t need it, and the person who dislikes you won’t believe it', 'Khánh Trịnh', '', 'publish', 'closed', 'closed', '', 'khanh-trinh', '', '', '2022-09-20 07:53:22', '2022-09-20 00:53:22', '', 0, 'http://demo201.kabiweb.com/?post_type=testimonial&#038;p=112', 0, 'testimonial', '', 0),
(113, 1, '2022-09-20 07:57:15', '0000-00-00 00:00:00', '', 'Lưu bản nháp tự động', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2022-09-20 07:57:15', '0000-00-00 00:00:00', '', 0, 'http://demo201.kabiweb.com/?post_type=testimonial&p=113', 0, 'testimonial', '', 0),
(114, 1, '2022-09-20 07:59:07', '2022-09-20 00:59:07', 'Updating...', 'About Us', '', 'publish', 'closed', 'closed', '', 'about-us', '', '', '2022-09-20 07:59:07', '2022-09-20 00:59:07', '', 0, 'http://demo201.kabiweb.com/?page_id=114', 0, 'page', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kbw_termmeta`
--

CREATE TABLE `kbw_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kbw_terms`
--

CREATE TABLE `kbw_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_terms`
--

INSERT INTO `kbw_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Tin tức', 'tin-tuc', 0),
(2, 'Menu Tiếng Việt', 'menu-tieng-viet', 0),
(4, 'Technology', 'technology', 0),
(5, 'Datalake', 'datalake', 0),
(6, 'Product manager', 'product-manager', 0),
(7, 'Tiếng Việt', 'vi', 0),
(8, 'Tiếng Việt', 'pll_vi', 0),
(9, 'pll_6322ed0a0ca09', 'pll_6322ed0a0ca09', 0),
(10, 'English', 'en', 0),
(11, 'English', 'pll_en', 0),
(12, 'News', 'news', 0),
(15, 'pll_6322ed735cd75', 'pll_6322ed735cd75', 0),
(16, 'pll_6322ed735cd8b', 'pll_6322ed735cd8b', 0),
(17, 'pll_6322ed735cd9f', 'pll_6322ed735cd9f', 0),
(18, 'pll_6322ed81d645b', 'pll_6322ed81d645b', 0),
(19, 'Menu Tiếng Anh', 'menu-tieng-anh', 0),
(20, 'pll_6322f4b83d6f9', 'pll_6322f4b83d6f9', 0),
(21, 'pll_6322f50c7018d', 'pll_6322f50c7018d', 0),
(22, 'pll_6322f6c202900', 'pll_6322f6c202900', 0),
(23, 'pll_6323002c2000a', 'pll_6323002c2000a', 0),
(24, 'Tiếng Việt', 'tieng-viet', 0),
(25, 'Tiếng Anh', 'tieng-anh', 0),
(26, 'pll_6328226f994c7', 'pll_6328226f994c7', 0),
(27, 'Technology', 'technology', 0),
(28, 'pll_63282562eb805', 'pll_63282562eb805', 0),
(29, 'Technology', 'technology-en', 0),
(30, 'pll_63282bab229ad', 'pll_63282bab229ad', 0),
(31, 'Công nghệ', 'technology-2', 0),
(33, 'pll_63282db3b5b96', 'pll_63282db3b5b96', 0),
(34, 'pll_63282e71645b4', 'pll_63282e71645b4', 0),
(35, 'pll_63282ea44f6a7', 'pll_63282ea44f6a7', 0),
(36, 'pll_6329105bbb531', 'pll_6329105bbb531', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kbw_term_relationships`
--

CREATE TABLE `kbw_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_term_relationships`
--

INSERT INTO `kbw_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(1, 7, 0),
(1, 8, 0),
(1, 9, 0),
(1, 23, 0),
(2, 7, 0),
(2, 18, 0),
(3, 7, 0),
(4, 8, 0),
(4, 15, 0),
(5, 8, 0),
(5, 16, 0),
(6, 8, 0),
(6, 17, 0),
(8, 7, 0),
(8, 36, 0),
(9, 7, 0),
(10, 2, 0),
(12, 9, 0),
(12, 11, 0),
(22, 7, 0),
(22, 20, 0),
(23, 7, 0),
(23, 21, 0),
(24, 2, 0),
(25, 2, 0),
(26, 2, 0),
(27, 2, 0),
(27, 11, 0),
(27, 28, 0),
(29, 11, 0),
(29, 30, 0),
(31, 8, 0),
(31, 28, 0),
(40, 24, 0),
(42, 24, 0),
(42, 25, 0),
(51, 7, 0),
(51, 22, 0),
(52, 1, 0),
(52, 7, 0),
(53, 1, 0),
(53, 4, 0),
(53, 5, 0),
(53, 6, 0),
(53, 7, 0),
(54, 1, 0),
(54, 7, 0),
(54, 26, 0),
(76, 10, 0),
(76, 18, 0),
(77, 19, 0),
(79, 10, 0),
(79, 20, 0),
(80, 10, 0),
(81, 19, 0),
(82, 19, 0),
(83, 19, 0),
(84, 19, 0),
(85, 10, 0),
(86, 10, 0),
(86, 22, 0),
(87, 7, 0),
(88, 10, 0),
(89, 10, 0),
(90, 10, 0),
(90, 12, 0),
(90, 23, 0),
(91, 7, 0),
(92, 7, 0),
(93, 7, 0),
(93, 33, 0),
(94, 7, 0),
(94, 34, 0),
(95, 7, 0),
(95, 35, 0),
(96, 10, 0),
(97, 7, 0),
(98, 7, 0),
(99, 7, 0),
(99, 12, 0),
(100, 10, 0),
(100, 12, 0),
(101, 10, 0),
(101, 12, 0),
(101, 26, 0),
(103, 10, 0),
(103, 27, 0),
(103, 29, 0),
(104, 7, 0),
(106, 7, 0),
(107, 7, 0),
(108, 7, 0),
(109, 10, 0),
(109, 33, 0),
(110, 10, 0),
(110, 34, 0),
(111, 10, 0),
(111, 35, 0),
(112, 24, 0),
(112, 25, 0),
(114, 10, 0),
(114, 36, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kbw_term_taxonomy`
--

CREATE TABLE `kbw_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_term_taxonomy`
--

INSERT INTO `kbw_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 4),
(2, 2, 'nav_menu', '', 0, 5),
(4, 4, 'post_tag', '', 0, 1),
(5, 5, 'post_tag', '', 0, 1),
(6, 6, 'post_tag', '', 0, 1),
(7, 7, 'language', 'a:3:{s:6:\"locale\";s:2:\"vi\";s:3:\"rtl\";i:0;s:9:\"flag_code\";s:2:\"vn\";}', 0, 13),
(8, 8, 'term_language', '', 0, 5),
(9, 9, 'term_translations', 'a:2:{s:2:\"vi\";i:1;s:2:\"en\";i:12;}', 0, 2),
(10, 10, 'language', 'a:3:{s:6:\"locale\";s:5:\"en_GB\";s:3:\"rtl\";i:0;s:9:\"flag_code\";s:2:\"gb\";}', 0, 11),
(11, 11, 'term_language', '', 0, 3),
(12, 12, 'category', '', 0, 2),
(15, 15, 'term_translations', 'a:1:{s:2:\"vi\";i:4;}', 0, 1),
(16, 16, 'term_translations', 'a:1:{s:2:\"vi\";i:5;}', 0, 1),
(17, 17, 'term_translations', 'a:1:{s:2:\"vi\";i:6;}', 0, 1),
(18, 18, 'post_translations', 'a:2:{s:2:\"vi\";i:2;s:2:\"en\";i:76;}', 0, 2),
(19, 19, 'nav_menu', '', 0, 5),
(20, 20, 'post_translations', 'a:2:{s:2:\"en\";i:79;s:2:\"vi\";i:22;}', 0, 2),
(21, 21, 'post_translations', 'a:1:{s:2:\"vi\";i:23;}', 0, 1),
(22, 22, 'post_translations', 'a:2:{s:2:\"en\";i:86;s:2:\"vi\";i:51;}', 0, 2),
(23, 23, 'post_translations', 'a:2:{s:2:\"en\";i:90;s:2:\"vi\";i:1;}', 0, 2),
(24, 24, 'testimonial_type', '', 0, 3),
(25, 25, 'testimonial_type', '', 0, 2),
(26, 26, 'post_translations', 'a:2:{s:2:\"en\";i:101;s:2:\"vi\";i:54;}', 0, 2),
(27, 27, 'category', '', 0, 1),
(28, 28, 'term_translations', 'a:2:{s:2:\"en\";i:27;s:2:\"vi\";i:31;}', 0, 2),
(29, 29, 'post_tag', '', 0, 1),
(30, 30, 'term_translations', 'a:1:{s:2:\"en\";i:29;}', 0, 1),
(31, 31, 'category', '', 0, 0),
(33, 33, 'post_translations', 'a:2:{s:2:\"en\";i:109;s:2:\"vi\";i:93;}', 0, 2),
(34, 34, 'post_translations', 'a:2:{s:2:\"en\";i:110;s:2:\"vi\";i:94;}', 0, 2),
(35, 35, 'post_translations', 'a:2:{s:2:\"en\";i:111;s:2:\"vi\";i:95;}', 0, 2),
(36, 36, 'post_translations', 'a:2:{s:2:\"en\";i:114;s:2:\"vi\";i:8;}', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kbw_usermeta`
--

CREATE TABLE `kbw_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_usermeta`
--

INSERT INTO `kbw_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'bvkhanh88'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'kbw_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'kbw_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'vc_pointers_backend_editor,text_widget_custom_html'),
(15, 1, 'show_welcome_panel', '0'),
(17, 1, 'kbw_user-settings', 'hidetb=1&mfold=o&editor=tinymce&post_dfw=off&libraryContent=browse&edit_element_vcUIPanelWidth=749&edit_element_vcUIPanelLeft=815px&edit_element_vcUIPanelTop=94px'),
(18, 1, 'kbw_user-settings-time', '1663235504'),
(19, 1, 'kbw_dashboard_quick_press_last_post_id', '92'),
(20, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:12:\"42.114.151.0\";}'),
(21, 1, 'closedpostboxes_dashboard', 'a:0:{}'),
(22, 1, 'metaboxhidden_dashboard', 'a:2:{i:0;s:21:\"dashboard_site_health\";i:1;s:17:\"dashboard_primary\";}'),
(23, 1, 'wpcf7_hide_welcome_panel_on', 'a:2:{i:0;s:3:\"5.5\";i:1;s:3:\"5.6\";}'),
(24, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),
(25, 1, 'metaboxhidden_nav-menus', 'a:4:{i:0;s:24:\"add-post-type-kc-section\";i:1;s:12:\"add-post_tag\";i:2;s:15:\"add-post_format\";i:3;s:23:\"add-kc-section-category\";}'),
(26, 1, 'meta-box-order_dashboard', 'a:4:{s:6:\"normal\";s:40:\"dashboard_site_health,dashboard_activity\";s:4:\"side\";s:21:\"dashboard_quick_press\";s:7:\"column3\";s:10:\"kbw_notice\";s:7:\"column4\";s:0:\"\";}'),
(27, 1, 'kbw_r_tru_u_x', 'a:2:{s:2:\"id\";s:0:\"\";s:7:\"expires\";i:86400;}'),
(28, 1, 'nav_menu_recently_edited', '19'),
(30, 1, 'kbw_media_library_mode', 'grid'),
(31, 1, 'session_tokens', 'a:5:{s:64:\"37fff1354c220f5315a775ddf75244781c05f12afa51dde5deb94a14318e5d3a\";a:4:{s:10:\"expiration\";i:1664422892;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36\";s:5:\"login\";i:1663213292;}s:64:\"b1c4d00ca3135029a06a29e5d497d41e83071209e05aae414c6ae513b3695d0b\";a:4:{s:10:\"expiration\";i:1664597353;s:2:\"ip\";s:13:\"42.114.151.21\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36\";s:5:\"login\";i:1663387753;}s:64:\"3c68e99dace79c3fa6d875b3832f1c9064a35c881fde3048cd3b725ba567feaa\";a:4:{s:10:\"expiration\";i:1664782850;s:2:\"ip\";s:13:\"42.114.151.21\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36\";s:5:\"login\";i:1663573250;}s:64:\"63a6b5d5ce5eb82e87d295383dd796ccdb64bbd227a50aca5a10496f8d68df98\";a:4:{s:10:\"expiration\";i:1663746094;s:2:\"ip\";s:14:\"116.97.240.102\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36\";s:5:\"login\";i:1663573294;}s:64:\"299d63a3373feff7c195086a46117e54d37d5bc79c008d4b8a7635d1e679973d\";a:4:{s:10:\"expiration\";i:1663746335;s:2:\"ip\";s:14:\"116.97.240.102\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36\";s:5:\"login\";i:1663573535;}}'),
(32, 1, 'closedpostboxes_page', 'a:1:{i:0;s:12:\"postimagediv\";}'),
(33, 1, 'metaboxhidden_page', 'a:5:{i:0;s:10:\"postcustom\";i:1;s:16:\"commentstatusdiv\";i:2;s:11:\"commentsdiv\";i:3;s:7:\"slugdiv\";i:4;s:9:\"authordiv\";}'),
(34, 1, 'description_en', ''),
(35, 1, 'meta-box-order_project', 'a:7:{s:8:\"form_top\";s:0:\"\";s:16:\"before_permalink\";s:0:\"\";s:11:\"after_title\";s:0:\"\";s:12:\"after_editor\";s:0:\"\";s:4:\"side\";s:29:\"ml_box,postimagediv,submitdiv\";s:6:\"normal\";s:19:\"postexcerpt,slugdiv\";s:8:\"advanced\";s:0:\"\";}'),
(36, 1, 'screen_layout_project', '2'),
(37, 1, 'meta-box-order_testimonial', 'a:7:{s:8:\"form_top\";s:0:\"\";s:16:\"before_permalink\";s:0:\"\";s:11:\"after_title\";s:0:\"\";s:12:\"after_editor\";s:0:\"\";s:4:\"side\";s:42:\"submitdiv,testimonial_typediv,postimagediv\";s:6:\"normal\";s:24:\"testimonial_info,slugdiv\";s:8:\"advanced\";s:0:\"\";}'),
(38, 1, 'screen_layout_testimonial', '2');

-- --------------------------------------------------------

--
-- Table structure for table `kbw_users`
--

CREATE TABLE `kbw_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kbw_users`
--

INSERT INTO `kbw_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'bvkhanh88', '$P$BBiF3qZMyaIZOk99RkjuHEh3Dd1cbH1', 'bvkhanh88', 'bvkhanh88@gmail.com', 'http://demowp.hk', '2021-10-12 14:12:48', '', 0, 'bvkhanh88');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kbw_commentmeta`
--
ALTER TABLE `kbw_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `kbw_comments`
--
ALTER TABLE `kbw_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `kbw_links`
--
ALTER TABLE `kbw_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `kbw_options`
--
ALTER TABLE `kbw_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indexes for table `kbw_postmeta`
--
ALTER TABLE `kbw_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `kbw_posts`
--
ALTER TABLE `kbw_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `kbw_termmeta`
--
ALTER TABLE `kbw_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `kbw_terms`
--
ALTER TABLE `kbw_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `kbw_term_relationships`
--
ALTER TABLE `kbw_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `kbw_term_taxonomy`
--
ALTER TABLE `kbw_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `kbw_usermeta`
--
ALTER TABLE `kbw_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `kbw_users`
--
ALTER TABLE `kbw_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kbw_commentmeta`
--
ALTER TABLE `kbw_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kbw_comments`
--
ALTER TABLE `kbw_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kbw_links`
--
ALTER TABLE `kbw_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kbw_options`
--
ALTER TABLE `kbw_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1828;

--
-- AUTO_INCREMENT for table `kbw_postmeta`
--
ALTER TABLE `kbw_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=668;

--
-- AUTO_INCREMENT for table `kbw_posts`
--
ALTER TABLE `kbw_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `kbw_termmeta`
--
ALTER TABLE `kbw_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kbw_terms`
--
ALTER TABLE `kbw_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kbw_term_taxonomy`
--
ALTER TABLE `kbw_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kbw_usermeta`
--
ALTER TABLE `kbw_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `kbw_users`
--
ALTER TABLE `kbw_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
