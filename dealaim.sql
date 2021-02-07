-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2021 at 10:50 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dealaim`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_acc`
--

CREATE TABLE `bank_acc` (
  `bank_id` int(11) NOT NULL,
  `acc_number` varchar(25) NOT NULL,
  `acc_full_name` varchar(75) NOT NULL,
  `acc_expiry` varchar(10) NOT NULL,
  `acc_cvc` int(4) NOT NULL,
  `acc_balance` float(6,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_acc`
--

INSERT INTO `bank_acc` (`bank_id`, `acc_number`, `acc_full_name`, `acc_expiry`, `acc_cvc`, `acc_balance`, `user_id`) VALUES
(1, '4188900029398001', 'Butrint Selishta', '10 / 2023', 992, 760.50, 1),
(2, '4141414141414141', 'Butrint Selishta', '02 / 2031', 244, 560.33, 3),
(3, '4141414141414141', 'Butrint Selishta', '02 / 2029', 292, 114.90, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(20) NOT NULL,
  `cat_title` varchar(50) NOT NULL,
  `cat_link` varchar(50) NOT NULL,
  `parent_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_link`, `parent_id`) VALUES
(1, 'Elektronik', '', 0),
(2, 'Laptop', 'http://127.0.0.1/dealaim/products.php', 1),
(3, 'Telefon', 'http://127.0.0.1/dealaim/products.php', 1),
(4, 'Makina', 'http://127.0.0.1/dealaim/products.php', 0),
(5, 'Vetura', 'http://127.0.0.1/dealaim/products.php', 4),
(6, 'WEB', 'http://127.0.0.1/dealaim/products.php', 0),
(7, 'Template', 'http://127.0.0.1/dealaim/products.php', 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_unique_id` varchar(100) NOT NULL,
  `prod_img` varchar(500) NOT NULL,
  `prod_title` varchar(100) NOT NULL,
  `prod_cmimi` float(6,2) NOT NULL,
  `prod_from` datetime NOT NULL,
  `prod_to` datetime NOT NULL,
  `prod_pershkrimi` varchar(5000) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_isApproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_unique_id`, `prod_img`, `prod_title`, `prod_cmimi`, `prod_from`, `prod_to`, `prod_pershkrimi`, `cat_id`, `user_id`, `prod_isApproved`) VALUES
(1, 'butrintselishta_601ea928f3e95', 'photo1_butrintselishta_601ea928f3e95.jpg | photo2_butrintselishta_601ea928f3e95.jpg | photo3_butrintselishta_601ea928f3e95.jpg | ', 'asdfgfddf', 23.50, '2021-02-07 12:00:00', '2021-02-12 12:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 1, 0),
(2, 'butrintselishta_601ea9da17620', 'photo1_butrintselishta_601ea9da17620.jpg', 'asdfgfddf', 23.50, '2021-02-07 12:00:00', '2021-02-12 12:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 1, 0),
(3, 'butrintselishta_601ea9f5a3435', 'photo1_butrintselishta_601ea9f5a3435.jpg', 'asdfgfddf', 23.50, '2021-02-07 12:00:00', '2021-02-12 12:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 1, 0),
(4, 'butrintselishta_60205e6dc66e6', 'photo1_butrintselishta_60205e6dc66e6.jpg', 'asdasfsdsdgasdsa', 23.50, '2021-02-08 12:00:00', '2021-02-10 12:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prod_manufacturers`
--

CREATE TABLE `prod_manufacturers` (
  `prod_man_id` int(11) NOT NULL,
  `prod_manufacturer` varchar(25) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod_manufacturers`
--

INSERT INTO `prod_manufacturers` (`prod_man_id`, `prod_manufacturer`, `cat_id`) VALUES
(1, 'Acer', 2),
(2, 'Apple', 2),
(3, 'Asus', 2),
(4, 'Dell', 2),
(5, 'HP', 2),
(6, 'Lenovo', 2),
(13, 'Apple', 3),
(14, 'Samsung', 3),
(15, 'Hauwei', 3),
(16, 'Xiaomi', 3),
(17, 'LG', 3),
(18, 'Google', 3),
(19, 'Audi', 5),
(20, 'BMW', 5),
(21, 'Mercedes', 5),
(22, 'Volkswagen', 5),
(23, 'Peguet', 5),
(24, 'Citroen', 5),
(25, 'Toyota', 5),
(26, 'Ford', 5);

-- --------------------------------------------------------

--
-- Table structure for table `prod_specifications`
--

CREATE TABLE `prod_specifications` (
  `spec_id` int(11) NOT NULL,
  `tel_man` varchar(30) DEFAULT NULL COMMENT 'PHONE_MANUFACTURER',
  `tel_mod` varchar(30) DEFAULT NULL COMMENT 'TEL_MODEL',
  `tel_cond` varchar(30) DEFAULT NULL COMMENT 'PHONE_CONDITION',
  `tel_col` varchar(30) DEFAULT NULL COMMENT 'TEL_COLOR',
  `tel_im` varchar(30) DEFAULT NULL COMMENT 'PHONE_INTERNAL MEMORY',
  `tel_ram` varchar(30) DEFAULT NULL COMMENT 'PHONE_RAM MEMORY',
  `tel_scn` varchar(30) DEFAULT NULL COMMENT 'TEL_SIM CARD NUMBER',
  `tel_os` varchar(30) DEFAULT NULL COMMENT 'TEL_OPERATING SYSTEM',
  `tel_op` varchar(30) DEFAULT NULL COMMENT 'TEL_ORIGIN OF PRODUCTION',
  `lap_man` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_MANUFACTURER',
  `lap_mod` varchar(30) NOT NULL COMMENT 'LAPTOP_MODEL',
  `lap_con` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_CONDITION',
  `lap_dia` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_DIAGONAL',
  `lap_col` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_COLOR',
  `lap_proc` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_PROVCESOR',
  `lap_ram` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_RAM MEMORY',
  `lap_im` varchar(30) DEFAULT NULL COMMENT 'LAPTOM_INTERNAL MEMORY',
  `lap_ims` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_INTERNAL MEMORY SPACE',
  `lap_gc` varchar(30) DEFAULT NULL COMMENT 'LAPTOP_GRAPHIC CARD',
  `mak_man` varchar(30) DEFAULT NULL COMMENT 'MAKINA_MANUNFACTURER',
  `mak_mod` varchar(30) DEFAULT NULL COMMENT 'MAKINA_MODEL',
  `mak_km` varchar(30) DEFAULT NULL COMMENT 'MAKINA_KILOMETERS',
  `mak_py` varchar(30) DEFAULT NULL COMMENT 'MAKINA_YEAR OF PRODUCTION',
  `mak_type` varchar(30) DEFAULT NULL COMMENT 'MAKINA_TYPE',
  `mak_col` varchar(30) DEFAULT NULL COMMENT 'MAKINA_COLOR',
  `mak_tra` varchar(30) DEFAULT NULL COMMENT 'MAKINA_TRANSMISSIONER',
  `mak_fu` varchar(30) DEFAULT NULL COMMENT 'MAKINA_FUELS',
  `mak_cub` varchar(30) DEFAULT NULL COMMENT 'MAKINA_CUBICS',
  `wt_cat` varchar(30) DEFAULT NULL COMMENT 'WEB_TEMPLATE CATEGORY',
  `wt_ut` varchar(30) NOT NULL COMMENT 'WEB_TEMPLATE USED TECHNOLOGIES',
  `wt_lo` varchar(30) NOT NULL COMMENT 'WEB_TEMPLATE LAYOUT',
  `wp_doc` varchar(30) NOT NULL COMMENT 'WEB_TEMPLATE DOCUMENTATION',
  `prod_unique_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `token_id` int(11) NOT NULL,
  `plain_txt` varchar(50) NOT NULL,
  `token` varchar(350) NOT NULL,
  `conf_type` varchar(20) NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`token_id`, `plain_txt`, `token`, `conf_type`, `type`) VALUES
(1, 'butrintselishtaa@gmail.com', 'c1c8de2bb6d24bb17b4945885e68ba8bb35e2dec1f617dc4167eab4530fb963e2a21d8920e4caa25543c95078554f2ff8f5b7c40bf22aded603d8df4e222b89213af03f3aece8faaa2eedd56f44969a5c454b34a0e6d759bf00951f464d9e21d', 'account_confirm', 1),
(2, 'butrintselishtaa@gmail.com', 'ad0fafc8e0b548258e02c98500e55601b4a48bb61b5c7ac91903269303b0c35d3342f2f346287451fef551a79a9778ac577442f5f612a6fd46512ff365688d32a5796af63dd4b2d3e6656048ecc7c48eb3319750446c34b4ed745f4c9b0e2137', 'account_confirm', 1),
(4, 'hutono3@mailinator.com', '500ed6bcc9f2f34e5782db199c2438e22cbd73e0e61623c04e2b1ad9a2c0e59f97fc237ad570006a7b983ac648d4532dcc9d1bb40ec61338fb60fa4488aca63769d13a4169e492905cc6259e96c3a46ab2b6e1e77c6dcd1d2b648526c0a84f42', 'account_confirm', 1),
(5, 'butrintselishtaa@gmail.com', '7f139301b356ffc77891495c790e53c249e9fc140a485941f541091038e48e37be424f29ccfc09e6cf1a10e15df029ecd7d8e605da58e8a17de25b8a9b1610db36e7dd82c8b86bc728f73a425c868acdaac2bf9cb03b5723486e78c99b30ceb2', 'account_confirm', 0),
(6, 'butrintselishta1', '73cd0115309b5ee8f1b6d92f5b0a64903b2d492a0c5aeb9a10ad98d3f19330c69697ebb5fc8101a46028116d4d50c7fb88e29e2568463ccf1627cf554be623aec78acc35d4d0b3b237ef839fc5748b7c', 'reset_password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(350) NOT NULL,
  `profile_pic` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel_nr` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` int(5) NOT NULL,
  `address` varchar(50) NOT NULL,
  `pid_number` int(16) DEFAULT NULL,
  `terms_and_conditions` tinyint(1) DEFAULT NULL,
  `status` int(3) NOT NULL,
  `user_balance` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `profile_pic`, `first_name`, `last_name`, `email`, `tel_nr`, `birthday`, `city`, `postal_code`, `address`, `pid_number`, `terms_and_conditions`, `status`, `user_balance`) VALUES
(1, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', 'profile_pic_butrintselishta.jpg', 'Butrint', 'Selishta', 'butrintselishta@gmail.com', '+383 44 991 412', '1970-01-01', 'Gjilan', 30000, 'Madeleine Albright, 76', 1123423123, 1, 3, 158.00),
(3, 'butrinti18', '$argon2i$v=19$m=65536,t=4,p=1$dGUwQ2VudVBneElrWmZJRg$FCCUgtDRC3iW6++54v/e0sK4eXcH/NmBX8sIUEvIHns', 'default_pic.png', 'Butrint', 'Selishta', 'hutono3@mailinator.com', '+38344333333', '2002-03-07', 'Gjilan', 60000, 'Madeleine Albright, 72', NULL, NULL, 2, 0.00),
(4, 'butrintselishta1', '$argon2i$v=19$m=65536,t=4,p=1$NlJPZnQwdDdhUFFXb0R2Yg$6hM/ehDTnUvVn80YMSEhsxuBKphbZvx4zOGq1bkh5PI', 'default_pic.png', 'Butrint', 'Selishta', 'butrintselishtaa@gmail.com', '+383 44 991 411', '2002-03-07', 'Gjilan', 60000, 'Madeleine Albright, 72', 2147483647, 1, 3, 0.00);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `users_pass_reset` BEFORE UPDATE ON `users` FOR EACH ROW INSERT INTO users_pass_reset
VALUES (
	'',
    OLD.username,
    OLD.password,
    NEW.password,
    NOW()
)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_pass_reset`
--

CREATE TABLE `users_pass_reset` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `old_password` varchar(350) NOT NULL,
  `new_password` varchar(350) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_pass_reset`
--

INSERT INTO `users_pass_reset` (`id`, `username`, `old_password`, `new_password`, `update_time`) VALUES
(1, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:11:40'),
(2, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:12:43'),
(3, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:12:59'),
(4, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:19:08'),
(5, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:20:48'),
(6, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:20:51'),
(7, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:20:53'),
(8, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 15:21:18'),
(9, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 16:10:31'),
(10, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-01 22:36:27'),
(11, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 09:17:40'),
(12, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:13:03'),
(13, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:14:21'),
(14, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:14:38'),
(15, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:15:04'),
(16, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:15:10'),
(17, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:15:40'),
(18, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:15:54'),
(19, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:16:08'),
(20, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:16:19'),
(21, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:16:38'),
(22, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:16:54'),
(23, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '2021-02-02 12:22:50'),
(24, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$QTBYSG5nOVdoSlkwYWNsLw$zM89U/5JN/7XTs0vDfMmCgISbpwrPa9zDN2IeEjytd0', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:26:52'),
(25, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:28:40'),
(26, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:28:45'),
(27, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:29:28'),
(28, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:29:37'),
(29, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:32:09'),
(30, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:34:31'),
(31, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:36:43'),
(32, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 12:36:57'),
(33, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 13:56:16'),
(34, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:04:07'),
(35, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:04:30'),
(36, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:04:43'),
(37, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:05:02'),
(38, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:33:29'),
(39, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:35:29'),
(40, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:35:53'),
(41, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:36:21'),
(42, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:36:31'),
(43, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:37:21'),
(44, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:39:29'),
(45, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:42:30'),
(46, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:42:48'),
(47, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:46:35'),
(48, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:47:42'),
(49, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:48:23'),
(50, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:56:34'),
(51, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:56:51'),
(52, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 14:57:23'),
(53, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 15:01:16'),
(54, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '2021-02-02 15:01:54'),
(55, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$TG1zVHo4Q2dxZ2hlTmNlaQ$ck3P8WRYwfRfLQZDcA0ZcJMyD2TEgETiSjO6NT1KKTQ', '$argon2i$v=19$m=65536,t=4,p=1$eHcxb1dFUmFZVnUyU0xFWg$BM7bSrDR5Fs8wfqwAzgC7aQiQb8NWZWI5Q2WRj/lIGY', '2021-02-02 15:06:16'),
(56, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$eHcxb1dFUmFZVnUyU0xFWg$BM7bSrDR5Fs8wfqwAzgC7aQiQb8NWZWI5Q2WRj/lIGY', '$argon2i$v=19$m=65536,t=4,p=1$bXlYeXkwRzA5QnBrWXh4Uw$H8807TnA72ni19yCgiHRVJm3qBumEuKh8I/KbogcTJw', '2021-02-02 15:06:33'),
(57, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$bXlYeXkwRzA5QnBrWXh4Uw$H8807TnA72ni19yCgiHRVJm3qBumEuKh8I/KbogcTJw', '$argon2i$v=19$m=65536,t=4,p=1$MUlLZHRRQ0dtaTBvWGk5cw$1iqRE/Oboz9MIaWM8vfdLZ1Y+y+ulBHWaQryvO5s1us', '2021-02-02 15:07:08'),
(58, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$MUlLZHRRQ0dtaTBvWGk5cw$1iqRE/Oboz9MIaWM8vfdLZ1Y+y+ulBHWaQryvO5s1us', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '2021-02-02 15:11:30'),
(59, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '2021-02-02 15:12:39'),
(60, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '2021-02-02 15:13:31'),
(61, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '2021-02-02 15:13:40'),
(62, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$UlNoMGR5VkZUV0l3bTVFVg$J3nuhGqwIXhgAO11mfESfOK1t3O0OFFrJ5hNyGwkdFI', '$argon2i$v=19$m=65536,t=4,p=1$RFdKM3E4YXI0NlRaTkt2YQ$kwjV8HeYSHLbpzwwh5gJcLPxWPW/pHN+abcvxDgVhnE', '2021-02-02 15:13:52'),
(63, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$RFdKM3E4YXI0NlRaTkt2YQ$kwjV8HeYSHLbpzwwh5gJcLPxWPW/pHN+abcvxDgVhnE', '$argon2i$v=19$m=65536,t=4,p=1$d1dhVzdudnVmVG03eVIwTQ$O4HCw/cgOcF8Kq8JO1e7bM2h009Fjphl+gRlj4y8MvY', '2021-02-02 15:16:28'),
(64, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$d1dhVzdudnVmVG03eVIwTQ$O4HCw/cgOcF8Kq8JO1e7bM2h009Fjphl+gRlj4y8MvY', '$argon2i$v=19$m=65536,t=4,p=1$c1VFMGdlMmtScU0wcVFuZg$jX5tkukf4c+eHhnIvPu3EohRY8KorxNbMKtMpJKTPbc', '2021-02-02 15:16:37'),
(65, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$c1VFMGdlMmtScU0wcVFuZg$jX5tkukf4c+eHhnIvPu3EohRY8KorxNbMKtMpJKTPbc', '$argon2i$v=19$m=65536,t=4,p=1$RUdudkNSN0ZRLk0xVUp3cg$r3XoNdKYtQhd44i5WUWf/aWYA0nCSAgEqwOl+u9OxWQ', '2021-02-02 15:20:43'),
(66, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$RUdudkNSN0ZRLk0xVUp3cg$r3XoNdKYtQhd44i5WUWf/aWYA0nCSAgEqwOl+u9OxWQ', '$argon2i$v=19$m=65536,t=4,p=1$RUdudkNSN0ZRLk0xVUp3cg$r3XoNdKYtQhd44i5WUWf/aWYA0nCSAgEqwOl+u9OxWQ', '2021-02-02 15:23:27'),
(67, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$RUdudkNSN0ZRLk0xVUp3cg$r3XoNdKYtQhd44i5WUWf/aWYA0nCSAgEqwOl+u9OxWQ', '$argon2i$v=19$m=65536,t=4,p=1$ckFybmJjUmZNUmQ2WGRJQQ$7qK6hu470w45oSqbPP5xfAE4nGfLr04aIFZ6s5xkZas', '2021-02-02 15:23:54'),
(68, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$ckFybmJjUmZNUmQ2WGRJQQ$7qK6hu470w45oSqbPP5xfAE4nGfLr04aIFZ6s5xkZas', '$argon2i$v=19$m=65536,t=4,p=1$ckFybmJjUmZNUmQ2WGRJQQ$7qK6hu470w45oSqbPP5xfAE4nGfLr04aIFZ6s5xkZas', '2021-02-02 15:24:02'),
(69, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$ckFybmJjUmZNUmQ2WGRJQQ$7qK6hu470w45oSqbPP5xfAE4nGfLr04aIFZ6s5xkZas', '$argon2i$v=19$m=65536,t=4,p=1$ckFybmJjUmZNUmQ2WGRJQQ$7qK6hu470w45oSqbPP5xfAE4nGfLr04aIFZ6s5xkZas', '2021-02-02 15:24:12'),
(70, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$ckFybmJjUmZNUmQ2WGRJQQ$7qK6hu470w45oSqbPP5xfAE4nGfLr04aIFZ6s5xkZas', '$argon2i$v=19$m=65536,t=4,p=1$NWhVc0p3blFLWW9VYmUvNQ$lpiQ7PLSPQ2Xri1Xmr/4l/EZmA/ozEnxNOuX5+PO3Do', '2021-02-02 15:24:25'),
(71, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$NWhVc0p3blFLWW9VYmUvNQ$lpiQ7PLSPQ2Xri1Xmr/4l/EZmA/ozEnxNOuX5+PO3Do', '$argon2i$v=19$m=65536,t=4,p=1$U3M4RnR3Wnd4WFUvUEpGVA$9cU0vXWKWdthbhmGJfizzbUMwrSkbZM9UT5hUBtVI8c', '2021-02-02 15:24:35'),
(72, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$U3M4RnR3Wnd4WFUvUEpGVA$9cU0vXWKWdthbhmGJfizzbUMwrSkbZM9UT5hUBtVI8c', '$argon2i$v=19$m=65536,t=4,p=1$U3M4RnR3Wnd4WFUvUEpGVA$9cU0vXWKWdthbhmGJfizzbUMwrSkbZM9UT5hUBtVI8c', '2021-02-02 15:25:12'),
(73, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$U3M4RnR3Wnd4WFUvUEpGVA$9cU0vXWKWdthbhmGJfizzbUMwrSkbZM9UT5hUBtVI8c', '$argon2i$v=19$m=65536,t=4,p=1$U3M4RnR3Wnd4WFUvUEpGVA$9cU0vXWKWdthbhmGJfizzbUMwrSkbZM9UT5hUBtVI8c', '2021-02-02 15:25:23'),
(74, 'butrinti18', '$argon2i$v=19$m=65536,t=4,p=1$dGUwQ2VudVBneElrWmZJRg$FCCUgtDRC3iW6++54v/e0sK4eXcH/NmBX8sIUEvIHns', '$argon2i$v=19$m=65536,t=4,p=1$dGUwQ2VudVBneElrWmZJRg$FCCUgtDRC3iW6++54v/e0sK4eXcH/NmBX8sIUEvIHns', '2021-02-02 15:34:23'),
(75, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$U3M4RnR3Wnd4WFUvUEpGVA$9cU0vXWKWdthbhmGJfizzbUMwrSkbZM9UT5hUBtVI8c', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-03 09:07:40'),
(76, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-03 10:42:03'),
(77, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-04 13:47:09'),
(78, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-04 16:03:34'),
(79, 'butrinti18', '$argon2i$v=19$m=65536,t=4,p=1$dGUwQ2VudVBneElrWmZJRg$FCCUgtDRC3iW6++54v/e0sK4eXcH/NmBX8sIUEvIHns', '$argon2i$v=19$m=65536,t=4,p=1$dGUwQ2VudVBneElrWmZJRg$FCCUgtDRC3iW6++54v/e0sK4eXcH/NmBX8sIUEvIHns', '2021-02-04 19:57:19'),
(80, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-06 14:53:51'),
(81, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-06 14:54:34'),
(82, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-06 16:23:06'),
(83, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-06 16:23:26'),
(84, 'butrintselishta', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '$argon2i$v=19$m=65536,t=4,p=1$azhxenpESGFvUWlqT1ExeA$lJOvHTXEbhcw9O8awnZ4Fh0CG+DGW30usj5jncRKc8M', '2021-02-06 16:24:06'),
(85, 'butrintselishta1', '$argon2i$v=19$m=65536,t=4,p=1$WUlwdHhucnNFZ2NIdDAuZQ$laaf6eNe7uPxffCgOMGk7/FCwXVx8KQ2WJhNj6OZQv4', '$argon2i$v=19$m=65536,t=4,p=1$WUlwdHhucnNFZ2NIdDAuZQ$laaf6eNe7uPxffCgOMGk7/FCwXVx8KQ2WJhNj6OZQv4', '2021-02-06 16:27:50'),
(86, 'butrintselishta1', '$argon2i$v=19$m=65536,t=4,p=1$WUlwdHhucnNFZ2NIdDAuZQ$laaf6eNe7uPxffCgOMGk7/FCwXVx8KQ2WJhNj6OZQv4', '$argon2i$v=19$m=65536,t=4,p=1$NlJPZnQwdDdhUFFXb0R2Yg$6hM/ehDTnUvVn80YMSEhsxuBKphbZvx4zOGq1bkh5PI', '2021-02-06 16:29:02'),
(87, 'butrintselishta1', '$argon2i$v=19$m=65536,t=4,p=1$NlJPZnQwdDdhUFFXb0R2Yg$6hM/ehDTnUvVn80YMSEhsxuBKphbZvx4zOGq1bkh5PI', '$argon2i$v=19$m=65536,t=4,p=1$NlJPZnQwdDdhUFFXb0R2Yg$6hM/ehDTnUvVn80YMSEhsxuBKphbZvx4zOGq1bkh5PI', '2021-02-06 16:30:04'),
(88, 'butrintselishta1', '$argon2i$v=19$m=65536,t=4,p=1$NlJPZnQwdDdhUFFXb0R2Yg$6hM/ehDTnUvVn80YMSEhsxuBKphbZvx4zOGq1bkh5PI', '$argon2i$v=19$m=65536,t=4,p=1$NlJPZnQwdDdhUFFXb0R2Yg$6hM/ehDTnUvVn80YMSEhsxuBKphbZvx4zOGq1bkh5PI', '2021-02-06 16:30:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_acc`
--
ALTER TABLE `bank_acc`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `prod_manufacturers`
--
ALTER TABLE `prod_manufacturers`
  ADD PRIMARY KEY (`prod_man_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `prod_specifications`
--
ALTER TABLE `prod_specifications`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_pass_reset`
--
ALTER TABLE `users_pass_reset`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_acc`
--
ALTER TABLE `bank_acc`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prod_manufacturers`
--
ALTER TABLE `prod_manufacturers`
  MODIFY `prod_man_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `prod_specifications`
--
ALTER TABLE `prod_specifications`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_pass_reset`
--
ALTER TABLE `users_pass_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_acc`
--
ALTER TABLE `bank_acc`
  ADD CONSTRAINT `bank_acc_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `prod_manufacturers`
--
ALTER TABLE `prod_manufacturers`
  ADD CONSTRAINT `prod_manufacturers_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
