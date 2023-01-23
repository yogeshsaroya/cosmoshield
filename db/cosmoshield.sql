-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 23, 2023 at 06:12 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmoshield`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text,
  `message_type` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `message_type`, `created`, `modified`) VALUES
(1, 9, 'asdfsdaf', 1, '2023-01-22 07:05:45', '2023-01-22 07:05:45'),
(2, 9, '\nHello\n', 2, '2023-01-22 07:05:55', '2023-01-22 07:05:55'),
(3, 9, 'Hi\n', 2, '2023-01-22 07:05:57', '2023-01-22 07:05:57'),
(4, 9, 'Test which is a new approach to have all solutions\r\n\r\n', 1, '2023-01-22 07:05:58', '2023-01-22 07:05:58'),
(5, 9, 'Hello', 1, '2023-01-22 07:24:23', '2023-01-22 07:24:23'),
(6, 9, 'How can i help you?', 2, '2023-01-22 10:18:47', '2023-01-22 10:18:47'),
(7, 10, 'Hi', 1, '2023-01-22 10:37:17', '2023-01-22 10:37:17'),
(8, 10, 'How can i help you?', 2, '2023-01-22 10:38:01', '2023-01-22 10:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `image`, `created`, `modified`) VALUES
(5, 9, '743-43906.jpg', '2023-01-22 06:31:17', '2023-01-22 06:31:17'),
(6, 9, '686-969102.jpg', '2023-01-22 06:31:23', '2023-01-22 06:31:23'),
(7, 9, '567-banner_main_1.jpg', '2023-01-22 06:31:29', '2023-01-22 06:31:29'),
(8, 9, '147-wallpaperflare.com_wallpaper (1).jpg', '2023-01-22 06:32:44', '2023-01-22 06:32:44'),
(9, 9, '470-pexels-alyssa-polaris-1859585.jpg', '2023-01-22 06:32:49', '2023-01-22 06:32:49'),
(10, 10, '494-wallpaperflare.com_wallpaper.jpg', '2023-01-22 10:37:12', '2023-01-22 10:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `reason` varchar(1024) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1: in progress, 2 : Fraudulent, 3 : No fraud detected\r\n',
  `whois_data` text,
  `whois_data_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `domain`, `reason`, `email`, `status`, `whois_data`, `whois_data_date`, `created`, `modified`) VALUES
(1, 'sadf', 'sadf', 'saroya.com@gmail.com', 1, NULL, NULL, '2023-01-20 07:29:06', '2023-01-20 07:29:06'),
(2, 'abc.com', 'sadfsd', 'saroya.com@gmail.com', 1, NULL, NULL, '2023-01-20 07:40:36', '2023-01-22 08:10:26'),
(3, 'abc.com	', 'sdff', 'saroya.com@gmail.com', 3, NULL, NULL, '2023-01-20 07:40:54', '2023-01-22 08:10:33'),
(4, 'abasdf.in', 'abc.com	', 'saroya.com@gmail.com', 1, NULL, NULL, '2023-01-20 07:50:56', '2023-01-22 08:10:21'),
(5, 'sdaf.com', 'asdfsadf', 'admin@admin.com', 2, NULL, NULL, '2023-01-22 01:40:33', '2023-01-22 08:10:31'),
(6, 'aa.com', 'aa', 'admin@admin.com', 1, NULL, NULL, '2023-01-22 01:40:41', '2023-01-22 08:10:19'),
(8, 'google.com', 'sdfad', 'cakephp.com@gmail.com', 1, NULL, NULL, '2023-01-22 10:37:05', '2023-01-22 10:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `email_sender` varchar(100) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `email_password` varchar(100) DEFAULT NULL,
  `email_host` varchar(100) DEFAULT NULL,
  `email_port` int(11) DEFAULT NULL,
  `whois_api_key` varchar(64) DEFAULT NULL COMMENT 'https://www.ip2location.io/dashboard',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email_sender`, `email_address`, `email_password`, `email_host`, `email_port`, `whois_api_key`, `created`, `modified`) VALUES
(1, 'support', 'support@superpad.finance', 'super@1234!', 'mail.superpad.finance', 587, '15BD37B169896A518A3D2DA6348D1640', '2022-03-15 13:20:49', '2023-01-23 00:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `unbondings`
--

CREATE TABLE `unbondings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wallet_id` int(11) DEFAULT NULL,
  `wallet_address` varchar(256) DEFAULT NULL,
  `coin` varchar(128) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unbondings`
--

INSERT INTO `unbondings` (`id`, `user_id`, `wallet_id`, `wallet_address`, `coin`, `created`) VALUES
(6, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(7, 9, 3, 'asdfs', 'Juno', '2023-01-22 08:33:55'),
(8, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(9, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(10, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(11, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(12, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(13, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(14, 9, 2, 'asdfsadf', 'Cosmos', '2023-01-22 08:33:50'),
(15, 10, 4, 'asdf', 'Cosmos', '2023-01-22 10:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT '2',
  `reset_password_key` varchar(128) DEFAULT NULL,
  `reset_password_key_expiry` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `role`, `reset_password_key`, `reset_password_key_expiry`, `created`, `modified`) VALUES
(9, NULL, NULL, 'saroya.com@gmail.com', 'admin@admin.com', '$2y$10$5Y31Kwu89Fs7cBeeqvV/suPBk3bCAc7we3Cim.RRL8c2rdxLWDgDK', 1, NULL, NULL, '2023-01-19 07:10:55', '2023-01-20 05:39:45'),
(10, NULL, NULL, 'cakephp.com@gmail.com', 'cakephp.com', '$2y$10$lE52zjWLRXNqm2/yvbAly.3lZ4hNsnqr4EqUkkp4VOTTPEG0SUm3.', 2, NULL, NULL, '2023-01-22 10:31:18', '2023-01-22 10:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `seed` varchar(1024) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `name`, `seed`, `created`) VALUES
(2, 9, 'asdf', 'asdf', '2023-01-22 03:43:30'),
(3, 9, 'retrewt', 'ewrterwt', '2023-01-22 08:33:45'),
(4, 10, 'sdf', 'asdf', '2023-01-22 10:37:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domain` (`domain`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unbondings`
--
ALTER TABLE `unbondings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unbondings`
--
ALTER TABLE `unbondings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
