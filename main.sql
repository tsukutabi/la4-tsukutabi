-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成時間: 2015 年 10 月 27 日 07:37
-- サーバのバージョン: 5.5.44
-- PHP のバージョン: 5.5.30-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `tsukutabi_la4`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `photos` varchar(255) NOT NULL,
  `photo_comments` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `latitude` int(11) DEFAULT NULL,
  `longitude` int(11) DEFAULT NULL,
  `departure_at` datetime DEFAULT NULL,
  `return_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`(191),`subtitle`(191)),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- テーブルのデータをダンプしています `articles`
--

INSERT INTO `articles` (`id`, `title`, `subtitle`, `photos`, `photo_comments`, `user_id`, `latitude`, `longitude`, `departure_at`, `return_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'nvfnav', 'vfanlnvf', 'eb41a93c27dc0be341021d2ef531fb02.png+791511d96a55b0e6bebc93fb284469e1.gif+85abfd812653eeab1a4763c8012679ed.jpg+35323ada5631b76d22e48360b43b3dbd.png', '', 6, NULL, NULL, '2015-10-21 00:00:00', '2015-10-22 00:00:00', '2015-10-20 15:08:14', '2015-10-20 15:08:14', NULL),
(4, 'あああああああ', 'えええええええええええええ', '4be1072eed742e4a82efdd355e5c96de.jpg', '', 6, NULL, NULL, '2015-10-27 00:00:00', '2015-10-28 00:00:00', '2015-10-27 04:16:02', '2015-10-27 04:16:02', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `articles_tags`
--

CREATE TABLE IF NOT EXISTS `articles_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`,`article_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- テーブルのデータをダンプしています `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `article_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'あああ', 6, 3, '2015-10-22 09:01:54', '2015-10-22 09:01:54', '0000-00-00 00:00:00'),
(2, 'rrr', 6, 3, '2015-10-22 09:16:26', '2015-10-22 09:16:26', '0000-00-00 00:00:00'),
(3, 'rrr', 6, 3, '2015-10-23 00:24:39', '2015-10-23 00:24:39', '0000-00-00 00:00:00'),
(4, 'rrr', 6, 3, '2015-10-23 01:14:52', '2015-10-23 01:14:52', '0000-00-00 00:00:00'),
(5, 'hh', 6, 3, '2015-10-23 03:49:19', '2015-10-23 03:49:19', '0000-00-00 00:00:00'),
(6, 'u', 6, 3, '2015-10-23 05:33:26', '2015-10-23 05:33:26', '0000-00-00 00:00:00'),
(7, 'hhh', 6, 3, '2015-10-23 05:43:47', '2015-10-23 05:43:47', '0000-00-00 00:00:00'),
(8, 'hhh', 6, 3, '2015-10-23 05:44:00', '2015-10-23 05:44:00', '0000-00-00 00:00:00'),
(9, 'bb', 6, 3, '2015-10-23 06:57:52', '2015-10-23 06:57:52', '0000-00-00 00:00:00'),
(10, 'vadvfa', 6, 3, '2015-10-26 07:51:09', '2015-10-26 07:51:09', '0000-00-00 00:00:00'),
(11, 'vnaklv', 6, 3, '2015-10-27 02:18:09', '2015-10-27 02:18:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `confirms`
--

CREATE TABLE IF NOT EXISTS `confirms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- テーブルのデータをダンプしています `confirms`
--

INSERT INTO `confirms` (`id`, `user_id`, `key`, `created_at`, `updated_at`) VALUES
(1, 1, 'FU2zTDOi37Mxbapa', '2015-10-18 10:08:52', '2015-10-18 10:08:52'),
(2, 2, 'weeGkkw7b1eeogAN', '2015-10-18 10:19:54', '2015-10-18 10:19:54'),
(3, 3, 'Z9EAWghICPFGPmNM', '2015-10-18 11:36:06', '2015-10-18 11:36:06'),
(4, 4, 'YhAhuO1AhKwvG7XJ', '2015-10-18 11:40:09', '2015-10-18 11:40:09'),
(5, 5, 'KWiGfDn07MDULdli', '2015-10-18 15:00:15', '2015-10-18 15:00:15'),
(7, 7, 'gbb46i0wZFykt0mL', '2015-10-19 13:20:22', '2015-10-19 13:20:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `favs`
--

CREATE TABLE IF NOT EXISTS `favs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`article_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- テーブルのデータをダンプしています `favs`
--

INSERT INTO `favs` (`id`, `user_id`, `article_id`, `updated_at`, `created_at`, `deleted_at`) VALUES
(12, 6, 3, '2015-10-27 05:23:32', '2015-10-27 05:23:32', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- テーブルのデータをダンプしています `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, '東京', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'tower', '2015-10-12 00:00:00', '2015-10-12 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(4) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `suspend` int(11) NOT NULL DEFAULT '0',
  `role` int(11) NOT NULL DEFAULT '0',
  `remember_token` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=8 ;

--
-- テーブルのデータをダンプしています `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `active`, `suspend`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'kousuke', 'kousuke.econ15060709@hotmail.co.jp', '$2y$10$atFqwM3kDdTCTbpmPTf5nuawSHX/LQu.7SdpEb/VVjbsGBW3FrAiu', 1, 0, 0, 9, '2015-10-19 12:53:13', '2015-10-20 01:54:06', '0000-00-00 00:00:00'),
(7, 'kousuke', 'kousuke.0709.1992@gmail.com', '$2y$10$cQCfCDZg5BXOfpxNOc7oXurqvv1bcbtuIbcy24K3N4DxB8h00ndl2', 0, 0, 0, NULL, '2015-10-19 13:20:22', '2015-10-19 13:20:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `articles_tags`
--
ALTER TABLE `articles_tags`
  ADD CONSTRAINT `articles_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `articles_tags_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);

--
-- テーブルの制約 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `favs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favs_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
