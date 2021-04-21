-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 12:25 PM
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
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `about_img` varchar(50) NOT NULL,
  `about_img_pos` varchar(10) DEFAULT NULL,
  `about_title` varchar(50) NOT NULL,
  `about_desc_lead` varchar(150) DEFAULT NULL,
  `about_desc` varchar(1000) NOT NULL,
  `about_layout` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `about_img`, `about_img_pos`, `about_title`, `about_desc_lead`, `about_desc`, `about_layout`) VALUES
(1, 'about_2.svg', 'left', 'Qëllimi', 'Cili është qëllimi i kësaj kompanie?\r\n', 'Duke marrë parasysh që ekzistenca e këtyre sistemeve të ankandit të hapur në vendin tonë është shumë e vogël, DealAim është zgjidhja. <br/> Qëllimi themelor i kësaj kompanie është lehtësimi në shtije e blerje të produkteve për çdo person. Secili nga ne mbi moshën 18 vjeçe ka mundësin e blerjes së produkteve dhe vendosjes së produkteve të veta në ankand për shitje.', 'kush_jemi_ne'),
(2, 'logo_circle.png', 'right', 'Historiku', 'Kur u formuam?', 'Si një kompani e re, DealAim filloi punën në fillim të vitit 2021. <br/> DealAim është një kompani inovative e cila fillimisht është duke u zhvilluar vetëm mbrenda Republikës tonë derisa me kohë besojmë e shpresojmë të zgjerohet edhe në rajon e më gjerë.', 'kush_jemi_ne'),
(3, 'ti-wallet', NULL, 'Pagesa të sigurta', NULL, 'Çdo pagesë është e sigurtë në kompanin tonë, parat tuaja do të mbesin gjithmonë të tuajat.', 'pse_ne'),
(4, 'ti-help-alt', NULL, 'H24 Mbështetje', NULL, '24/7 mbështetje të pakursyer për përdoruesit tanë. ', 'pse_ne'),
(5, 'ti-medall-alt', NULL, '+ 100 Përdorues', NULL, 'Kemi marrë besimin e më shumë se 100 përdoruesve veçse.', 'pse_ne');

-- --------------------------------------------------------

--
-- Table structure for table `bank_acc`
--

CREATE TABLE `bank_acc` (
  `bank_id` int(11) NOT NULL,
  `acc_number` varchar(25) NOT NULL,
  `acc_full_name` varchar(75) NOT NULL,
  `acc_expiry` varchar(10) NOT NULL,
  `acc_cvc` varchar(4) NOT NULL,
  `acc_balance` float(8,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 'Makina', '', 0),
(5, 'Vetura', 'http://127.0.0.1/dealaim/products.php', 4),
(6, 'WEB', '', 0),
(7, 'Template', 'http://127.0.0.1/dealaim/products.php', 6);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `faq_data` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `faq_data`) VALUES
(1, '<div>\r\n                    <b class=\"quest_auc\">Si të marr pjesë në ankand?</b>\r\n                    <p style=\"margin-bottom:30px;\">Për të marrë pjesë në ankand ju së pari duhet të regjistroheni.</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Si të regjistrohem?</b>\r\n                    <p style=\"margin-bottom:30px;\">Për tu regjistruar shkoni tek <a href=\"signin.php\" style=\"font-weight:900;\"> <i class=\"ti-user\"></i> </a> e cila gjendet ne anen e djatht të faqes, dhe shtypni <a href=\"signin.php\" style=\"font-weight:900;\"><strong> Kyçu ose Regjistrohu </strong></a> dhe më pas shfaqet format për regjistrim. Regjistrimi është falas!</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Jam regjistruar, ende nuk po mundem të ofertoj?</b>\r\n                    <p style=\"margin-bottom:30px;\">Pasi të regjistroheni ju krijoni një llogari tuajën personale por qe prap nuk mund të ofertoni për ndonjë produkt pasi që duhet të merrni statusin e blerësit.</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Si t\'a marr statusin e BLERËS-it?</b>\r\n                    <p style=\"margin-bottom:30px;\">Pasi të kyçeni në llogarinë tuaj, në krye të faqes, përkatësisht tek pjesa e menusë i\'u shfaqet një link i ri <strong>\'APLIKO PËR BLERËS\'</strong>, klikoni aty dhe mbushini të dhënat që kërkohen!</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Si t\'i tërheq/depozitoj paratë në llogari?</b>\r\n                    <p style=\"margin-bottom:30px;\">Pasi të merrni statusin e blerësit krijohet bilanci me 0.00€, për të depozituar para ju shkoni tek <a style=\"font-weight:900;\"> <i class=\"ti-user\"> </i></a>në anën e djatht në krye të faqes dhe klikoni tek <strong>PANELI</strong>, pasi të hapet faqja e panelit shkoni tek <strong>BILANCI IM </strong>, aty e keni mundësinë e depozitimit të parave!</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Si shpallet blerësi i produktit?</b>\r\n                    <p style=\"margin-bottom:30px;\">Produkti përkatës i dalur në ankand ka një kohë të caktuar të përfundimit të tij, ofertuesi i fundit për produktin përkatës është edhe fitues i tij, pra është <strong>BLERËS-i</strong> i atij produkti.</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Çka nëse nuk fitoj ankandin, ku mbesin paratë e mija?</b>\r\n                    <p style=\"margin-bottom:30px;\">Në rast se ju keni ofertuar për produktin përkatës por në fund ju nuk keni dal fituesi i atij ankandit padyshim që paratë tuaja mbeten tuajat, pra me përfudnimin e ankandit paratë i\'u kthehen në llogari të gjithë ofertuesve të cilët kan dal si humbësa nga ai ankand!</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Kam statusin e blerësit por dua të fus edhe produktet e mija në ankand?</b>\r\n                    <p style=\"margin-bottom:30px;\">Për të futur produktet tuaja në ankand ju duhet të merrni statusin e <strong> SHITËS-it </strong>!</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Si t\'a marr statusin e SHITËS-it?</b>\r\n                    <p style=\"margin-bottom:30px;\">Pasi të keni marrë statusin e BLERËS-it, në krye të faqes, përkatësisht tek pjesa e menusë i\'u shfaqet një link i ri <strong>\'APLIKO PËR SHITËS\'</strong>, klikoni aty dhe mbushini të dhënat që kërkohen! </p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Kam statusin e shitësit, si të vendos produktin tim në ankand?</b>\r\n                    <p style=\"margin-bottom:30px;\">Pasi të keni marrë statusin e SHITËS-it, në krye të faqes, në vendin e njejtë tek pjesa e menusë i\'u shfaqet një link i ri <strong>\'SHTO NJË PRODUKT\'</strong>, klikoni aty dhe mbushini të dhënat rreth produktit!<br>\r\n                    Nëse të dhënat mbushen në rregull produkti vazhdon në procesim dhe mbrenda 24 orëve produkti PRANOHET ose REFUZOHET nga stafi.\r\n                     </p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">Çka ndodhë me mbylljen e ankandit për produktin tim?</b>\r\n                    <p style=\"margin-bottom:30px;\">Pasi koha e përfundimit të arrijë në 00:00:00 ankandi MBYLLET, me mbylljen e ankandit, nëse ka pasur ofertues fitues del ofertuesi i fundit dhe paratë e ofertës së fundit kalojnë në llogarinë tuaj. Ndërsa nëse ankandi mbyllet pa ofertues, do të thotë se produkti juaj nuk ka arritur të shitur</p>\r\n                </div>\r\n                <div>\r\n                    <b class=\"quest_auc\">VËREJTJE</b><br/>\r\n                    <b style=\"margin-bottom:30px;\">Të gjitha produktet që vendosni në ankand fillojnë në datën e përcaktuar nga ju dhe në ora 12:00PM dhe mbyllen në ditën e dhënë në ora 12:00PM, në rast se pranimi i produktit vonohet nga ana jonë deri pas datës së vendosur nga shitësi, produkti del në ankand një ditë më vonë dhe mbyllet një ditë më vonë se që është kërkuar.</b>\r\n                </div>');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `footer_id` int(11) NOT NULL,
  `footer_title` varchar(150) DEFAULT NULL,
  `footer_link` varchar(50) DEFAULT NULL,
  `footer_layout` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`footer_id`, `footer_title`, `footer_link`, `footer_layout`) VALUES
(1, 'Kontakti', 'contact.php', 'links'),
(2, 'Si funksionon?', 'faq.php', 'links'),
(3, 'Rreth Nesh', 'about.php', 'links'),
(4, 'Të shitura', 'closed.php', 'links'),
(5, 'Ballina', 'index.php', 'links'),
(6, 'info@dealaim.com', '<i class=\'ti-email\'></i>', 'contacts'),
(7, '+383 44 991 411', '<i class=\'ti-headphone-alt\'></i>', 'contacts'),
(8, 'Medeleine Albright, Aferdita, 76<br>Gjilan - KOSOVË', '<i class=\'ti-home\'></i>', 'contacts'),
(10, '<i class=\'ti-youtube\'></i>', 'https://youtube.com', 'icons'),
(11, '<i class=\'ti-twitter\'></i>', 'https://twitter.com/butrintselishta', 'icons'),
(12, '<i class=\'ti-instagram\'></i>', 'https://instagram.com/butrintselishta', 'icons'),
(13, '<i class=\'ti-facebook\'></i>', 'https://facebook.com/butrintseelishta', 'icons');

-- --------------------------------------------------------

--
-- Table structure for table `income_ratio`
--

CREATE TABLE `income_ratio` (
  `income_id` int(11) NOT NULL,
  `acc_number` varchar(25) NOT NULL,
  `acc_company` varchar(25) NOT NULL,
  `tariff_type` varchar(30) NOT NULL,
  `profit` float(6,2) NOT NULL,
  `acc_company_balance` float(6,2) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_unique_id` varchar(100) NOT NULL,
  `prod_img` varchar(500) NOT NULL,
  `prod_title` varchar(100) NOT NULL,
  `prod_price` float(8,2) NOT NULL,
  `prod_from` datetime NOT NULL,
  `prod_to` datetime NOT NULL,
  `prod_description` varchar(5000) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_isApproved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `prod_offers`
--

CREATE TABLE `prod_offers` (
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offer_time` datetime NOT NULL,
  `offer_price` float(8,2) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `is_sold` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `car_man` varchar(30) DEFAULT NULL COMMENT 'CAR_MANUNFACTURER',
  `car_mod` varchar(30) DEFAULT NULL COMMENT 'CAR_MODEL',
  `car_km` varchar(30) DEFAULT NULL COMMENT 'CAR_KILOMETERS',
  `car_py` varchar(30) DEFAULT NULL COMMENT 'CAR_YEAR OF PRODUCTION',
  `car_type` varchar(30) DEFAULT NULL COMMENT 'CAR_TYPE',
  `car_col` varchar(30) DEFAULT NULL COMMENT 'CAR_COLOR',
  `car_tra` varchar(30) DEFAULT NULL COMMENT 'CAR_TRANSMISSIONER',
  `car_fu` varchar(30) DEFAULT NULL COMMENT 'CAR_FUELS',
  `car_cub` varchar(30) DEFAULT NULL COMMENT 'CAR_CUBICS',
  `wt_template` varchar(1000) DEFAULT NULL,
  `wt_cat` varchar(30) DEFAULT NULL COMMENT 'WEB_TEMPLATE CATEGORY',
  `wt_ut` varchar(50) DEFAULT NULL COMMENT 'WEB_TEMPLATE USED TECHNOLOGIES',
  `wt_lo` varchar(30) DEFAULT NULL COMMENT 'WEB_TEMPLATE LAYOUT',
  `wt_doc` varchar(30) DEFAULT NULL COMMENT 'WEB_TEMPLATE DOCUMENTATION',
  `prod_unique_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod_specifications`
--

INSERT INTO `prod_specifications` (`spec_id`, `tel_man`, `tel_mod`, `tel_cond`, `tel_col`, `tel_im`, `tel_ram`, `tel_scn`, `tel_os`, `tel_op`, `lap_man`, `lap_mod`, `lap_con`, `lap_dia`, `lap_col`, `lap_proc`, `lap_ram`, `lap_im`, `lap_ims`, `lap_gc`, `car_man`, `car_mod`, `car_km`, `car_py`, `car_type`, `car_col`, `car_tra`, `car_fu`, `car_cub`, `wt_template`, `wt_cat`, `wt_ut`, `wt_lo`, `wt_doc`, `prod_unique_id`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dell', 'XPS 15 ', 'I përdorur', '15.6', 'E Hirtë', 'Intel Core i7-9750H', '16', 'HDD', '512', 'NVIDIA GeForce GTX 1650 4GB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'butrinti12_6051e7c922c602.88399509'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BMW', 'M3 6 Speed', '20,000', '2014', 'Kupe', 'e Hirtë', 'Automatik', 'Naftë', '2000', NULL, NULL, NULL, NULL, NULL, 'butrinti12_6051e99073f533.22784807'),
(3, 'Samsung', 'S 10', 'I ri', 'E zezë', '128', '8', '1', 'Android', 'JAPONI', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'egzonsherifi_6051eeacdabce4.38325007'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ysera|template_blendish_605856b65d1b88.11495683.zip', 'Dyqan i stolive të çmuara', 'HTML,CSS,JS,BOOTSTRAP', 'Responsivë', 'I dokumentuar', 'blendish_605856b65d1b88.11495683'),
(5, 'Apple', 'Iphone 11', 'I ri', 'E zezë', '64', '4', '1', 'IOS', 'EUROPE', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'blendish_605858f5012e19.69067250'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HP', 'ENVY x360', 'I ri', '15.6', 'E zezë', 'AMD Ryzen™ 5 4500U', '8', 'SSD', '256', 'AMD Radeon™ Graphics', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'egzonsherifi_60585a56e65ff4.49963559'),
(7, 'Hauwei', 'Huawei P Smart (2019)', 'I përdorur', 'E zezë', '64', '3', '2', 'Android', 'CHINA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'egzonsherifi_6058603d52a642.83540563'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin-template|template_leozeqiri_6059a4976b7149.20729896.zip', 'Admin Dashboard', 'HTML,CSS, BOOTSTRAP, JS, JQUERY', 'Responsivë', 'I dokumentuar', 'leozeqiri_6059a4976b7149.20729896'),
(9, 'LG', 'V30', 'I përdorur', 'E zezë', '64', '3', '2', 'Android', 'CHINA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'egzonsherifi_605dce19279930.47804071'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Apple', 'M1 CHIP', 'I ri', ' 13.3', 'E hirtë', 'Apple M1', '8', 'SSD', ' 256', 'E integruar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Butrinti12_605dcfa4ef18e0.41969065'),
(11, 'Samsung', 'A51', 'I përdorur', 'E zezë', '128', '4', '1', 'Android', 'Shtetet e Bashkuara të Amerike', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'halilrexhepi_6062ce0b87d661.86339660'),
(12, 'Hauwei', 'Huawei P Smart', 'I përdorur', 'E zezë', '32', '3', '2', 'Android', 'Japoni', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'halilrexhepi_6062cf217116b3.93284663'),
(13, 'Google', 'Pixel 3', 'I përdorur', 'E Bardhë', '64', '4', '1', 'Android', 'USA', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'halilrexhepi_60639a5ca95f84.12125592'),
(14, 'Samsung', 'A7', 'I ri', 'E Kaltër', '64', '4', '1', 'Android', 'Kinë', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'butrinti12_60639bd6569756.06180598'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dell', 'Latitude E5440 E6440 E7440', 'I ri', '14.1', 'E hirtë', 'Intel Core i5 4th Gen', '16', 'SSD', '256', 'Intel HD Graphics 4400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'blendish_6063a14af08b00.54317482'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'diffdash-free-admin-template_17aee2d8fd9bcea20|template_leozeqiri_6063a33eb48a95.91946778.zip', 'Dashboard', 'HTML,CSS, BOOTSTRAP, JS, JQUERY', 'Responsivë', 'I dokumentuar', 'leozeqiri_6063a33eb48a95.91946778');

-- --------------------------------------------------------

--
-- Table structure for table `tariffs`
--

CREATE TABLE `tariffs` (
  `tariff_id` int(11) NOT NULL,
  `tariff_type` varchar(30) NOT NULL,
  `tariff_percentage` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tariffs`
--

INSERT INTO `tariffs` (`tariff_id`, `tariff_type`, `tariff_percentage`) VALUES
(1, 'Tërheqje parash', '1.2%'),
(2, 'Shitje e produktit', '5.5%');

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

-- --------------------------------------------------------

--
-- Table structure for table `trigger_user_pass_reset`
--

CREATE TABLE `trigger_user_pass_reset` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `old_password` varchar(350) NOT NULL,
  `new_password` varchar(350) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `user_balance` float(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `users_pass_reset` BEFORE UPDATE ON `users` FOR EACH ROW INSERT INTO trigger_user_pass_reset
VALUES (
	'',
    OLD.username,
    OLD.password,
    NEW.password,
    NOW()
)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `bank_acc`
--
ALTER TABLE `bank_acc`
  ADD PRIMARY KEY (`bank_id`),
  ADD UNIQUE KEY `acc_number` (`acc_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`footer_id`);

--
-- Indexes for table `income_ratio`
--
ALTER TABLE `income_ratio`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `tariff_type` (`tariff_type`),
  ADD KEY `acc_number` (`acc_number`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_unique_id` (`prod_unique_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `prod_manufacturers`
--
ALTER TABLE `prod_manufacturers`
  ADD PRIMARY KEY (`prod_man_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `prod_offers`
--
ALTER TABLE `prod_offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `prod_specifications`
--
ALTER TABLE `prod_specifications`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `prod_unique_id` (`prod_unique_id`);

--
-- Indexes for table `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`tariff_id`),
  ADD UNIQUE KEY `tariff_type` (`tariff_type`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `trigger_user_pass_reset`
--
ALTER TABLE `trigger_user_pass_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bank_acc`
--
ALTER TABLE `bank_acc`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `footer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `income_ratio`
--
ALTER TABLE `income_ratio`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prod_manufacturers`
--
ALTER TABLE `prod_manufacturers`
  MODIFY `prod_man_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `prod_offers`
--
ALTER TABLE `prod_offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prod_specifications`
--
ALTER TABLE `prod_specifications`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `tariff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trigger_user_pass_reset`
--
ALTER TABLE `trigger_user_pass_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_acc`
--
ALTER TABLE `bank_acc`
  ADD CONSTRAINT `bank_acc_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `income_ratio`
--
ALTER TABLE `income_ratio`
  ADD CONSTRAINT `income_ratio_ibfk_1` FOREIGN KEY (`tariff_type`) REFERENCES `tariffs` (`tariff_type`),
  ADD CONSTRAINT `income_ratio_ibfk_2` FOREIGN KEY (`acc_number`) REFERENCES `bank_acc` (`acc_number`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

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

--
-- Constraints for table `prod_offers`
--
ALTER TABLE `prod_offers`
  ADD CONSTRAINT `prod_offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `prod_offers_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`);

--
-- Constraints for table `prod_specifications`
--
ALTER TABLE `prod_specifications`
  ADD CONSTRAINT `prod_specifications_ibfk_1` FOREIGN KEY (`prod_unique_id`) REFERENCES `products` (`prod_unique_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
