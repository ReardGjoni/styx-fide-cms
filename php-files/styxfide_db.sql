-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2019 at 11:14 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1
USE `styxfide`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `styxfide`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(55) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '2019-01-14 09:00:09', '2019-01-14 09:01:41'),
(2, 'JavaScript', '2019-01-14 09:01:52', '2019-01-14 09:02:15'),
(3, 'MySQLi', '2019-01-14 09:01:57', '2019-01-14 09:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment_content` text COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment_content`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'Nice bro', '2019-01-14 08:05:18', '2019-01-22 11:45:57'),
(2, 3, 20, 'bla bla lorem', '2019-01-22 09:02:35', '2019-01-22 09:03:23'),
(3, 1, 12, 'lorem HIPSTERUM', '2019-01-22 09:04:05', '2019-01-22 09:04:57'),
(4, 2, 20, 'Jkqwehjkqweqwenqwe jqwenqew', '2019-01-22 09:04:27', '2019-01-22 11:46:35'),
(5, 3, 11, 'kjqwebkjqwebkqebkqewbq kwekqwbek jqwe', '2019-01-22 09:05:15', '2019-01-22 09:06:35'),
(6, 4, 12, 'Oqoweh123 213qwdar qw', '2019-01-22 09:05:50', '2019-01-22 09:06:19'),
(7, 1, 11, 'TEST', '2019-01-29 15:43:37', NULL),
(8, 18, 11, 'Test Comment', '2019-01-30 13:39:11', NULL),
(9, 1, 11, 'Cool article', '2019-02-15 19:51:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `role`) VALUES
(0, 'user'),
(2, 'moderator'),
(3, 'admin'),
(4, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT '',
  `access_allowed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `name`, `access_allowed`) VALUES
(1, 3, 'edit_users', 1),
(2, 2, 'edit_posts', 1),
(3, 1, 'create_posts', 1),
(4, 3, 'edit_posts', 1),
(5, 3, 'categories', 1),
(6, 3, 'settings', 1),
(7, 3, 'create_posts', 1),
(8, 2, 'create_posts', 1),
(9, 3, 'delete_posts', 1),
(10, 2, 'delete_posts', 0),
(11, 0, 'view_posts', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(55) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'PHP Rules', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.                                                                                                                                                  ', '2019-01-14 09:05:18', '2019-01-30 15:00:39'),
(4, 20, 2, 'JS Frameworks', 'Bone.js, Amber.js, Angular.js, Viu.js ...', '2019-01-22 10:04:27', '2019-01-30 15:04:04'),
(6, 11, 1, 'Offtopic', 'Hier steht Quatsch', '2019-01-22 10:05:50', '2019-02-15 22:22:55'),
(7, 11, 3, 'MySQL For the Win', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.', '2019-02-14 23:19:19', '2019-02-15 22:39:54'),
(9, 11, 3, 'Cms', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.', '2019-02-14 23:19:19', '2019-02-15 22:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text COLLATE utf8_bin NOT NULL,
  `pwdResetSelector` text COLLATE utf8_bin NOT NULL,
  `pwdResetToken` longtext COLLATE utf8_bin NOT NULL,
  `pwdResetExpires` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `usersvet`
--

CREATE TABLE `usersvet` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `userName` varchar(25) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `pwd` char(255) COLLATE utf8_bin NOT NULL,
  `auth_code` char(255) COLLATE utf8_bin DEFAULT NULL,
  `activated` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usersvet`
--

INSERT INTO `usersvet` (`id`, `group_id`, `userName`, `email`, `pwd`, `auth_code`, `activated`, `created_at`, `updated_at`) VALUES
(11, 3, 'rgjoni', 'reard.gjoni97@hotmail.co.uk', '$2y$10$TxHGD1r4Zqutx8Ki2KoFCuOM0T7mUDyqfoNAcXW1HnLuEgTKbaC5a', NULL, 1, '2019-01-22 14:04:43', '2019-02-15 18:41:43'),
(12, 1, 'reardGJoni', 'reard.gjoni97@hotmail.co.ukr', '$2y$10$yGopht7f/4PTqRCQlbOo7OxjzcTn95IVRigbazV049ZMI0d4efPaO', NULL, 1, '2019-01-24 16:52:01', '2019-02-13 17:30:08'),
(20, 2, 'monaLisa', 'mona-lisa@gmail.com', '$2y$10$4RddmHo8y6xJg/d4tMZCF.zSq8GiE0BJq4ZF9I5UCv/wORado7ACe', NULL, 1, '2019-01-25 17:42:15', '2019-01-29 15:47:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `usersvet`
--
ALTER TABLE `usersvet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersvet`
--
ALTER TABLE `usersvet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
