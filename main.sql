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

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `photos` varchar(255) NOT NULL,
  `photo_comments` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `view` int(11) NOT NULL,
  `latitude` int(11) DEFAULT NULL,
  `longitude` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`(191),`subtitle`(191)),
  KEY `user_id` (`user_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
--
-- テーブルのデータをダンプしています `articles`
--

INSERT INTO `articles` VALUES (3,'nvfnav','vfanlnvf','eb41a93c27dc0be341021d2ef531fb02.png+791511d96a55b0e6bebc93fb284469e1.gif+85abfd812653eeab1a4763c8012679ed.jpg+35323ada5631b76d22e48360b43b3dbd.png','',6,12,NULL,NULL,'2015-10-20 15:08:14','2015-11-27 06:44:00',NULL),(4,'aaaああああ','っっっっっf','4be1072eed742e4a82efdd355e5c96de.jpg','',6,39,NULL,NULL,'2015-10-27 04:16:02','2015-12-07 03:12:59',NULL),(5,'gggg','fdhfjak','fe7b14686a3745a2610c5f90d024c796.jpg+6c05829265fc403e6432c2aeec86d93e.png+f51363e3a14083dabf0a6033c9c87f0e.png','',6,0,NULL,NULL,'2015-11-20 06:08:53','2015-11-20 06:08:53',NULL),(6,'v?~A?v?~A?f','vf?~A| ?~C??~A~Admv','f2ff56d6f434f103ef7ada6904e1fdd9.jpg','',6,0,NULL,NULL,'2015-11-20 09:50:27','2015-11-20 09:50:27',NULL),(7,'hvh','bhv','1fed18f2aed939c16ab48478b24e0912.png+d597da6ee73ad912197cd9741fab39f9.png+2ad6c3401be24a15c52fe1cb1e3616db.jpg+5f7df1be922546ec08436c695d85c793.png','',6,0,NULL,NULL,'2015-11-20 10:14:03','2015-11-20 10:14:03',NULL),(8,'vafva','vfavf','8e9c04d0511f0e0f0acb4073b5e0666c.jpg','',6,0,NULL,NULL,'2015-11-20 12:56:09','2015-11-20 12:56:09',NULL),(9,'vafdv','vaa','a35732a342d71b48c35c9fa929bce5c2.jpg+c0090a8b73523b349c28742d6af9ebd3.png','',6,0,NULL,NULL,'2015-11-21 22:11:10','2015-11-21 22:11:10',NULL),(10,'vafdv','vaa','15668352801470638845d77bd36b51f1.png','',6,0,NULL,NULL,'2015-11-21 22:12:28','2015-11-21 22:12:28',NULL),(11,'hnnrn','nhgnr','54fc29bdff608102f8293bbfe0c7b08f.png+79176d73dd1165f41e654b81e63e5684.png','',6,0,NULL,NULL,'2015-11-22 05:45:15','2015-11-22 05:45:15',NULL),(12,'hnnrn','nhgnr','0b77b9e6e4216785c1f483afd7329261.png+0c1f7f6256b69519f2fe52cc8cabb8f8.png','',6,0,NULL,NULL,'2015-11-22 05:46:18','2015-11-22 05:46:18',NULL);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

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
  `facephoto` blob DEFAULT NULL ,
  `active` int(11) NOT NULL DEFAULT '0',
  `profile` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
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
