-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 12:22 PM
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

--
-- Dumping data for table `bank_acc`
--

INSERT INTO `bank_acc` (`bank_id`, `acc_number`, `acc_full_name`, `acc_expiry`, `acc_cvc`, `acc_balance`, `user_id`) VALUES
(1, '4106711240003923', 'DealAIM Company', '07 / 2030', '298', 2828.65, NULL),
(2, '5120990867582221', 'Butrint Selishta', '04 / 2031', '991', 6479.50, 2),
(3, '4140223489310001', 'Valonis Ramadani', '11 / 2030', '009', 536.31, 3),
(4, '4130233291002903', 'Egzon Sherifi', '09 / 2025', '109', 9526.03, 4),
(5, '5302019903299321', 'Blendi Shkodra', '02 / 2031', '991', 804.16, 5),
(6, '4299803928776331', 'Elvis Sylejmani', '08 / 2027', '865', 8123.58, 6),
(7, '5123320001006720', 'Leonit Zeqiri', '04 / 2026', '1', 1672.72, 7),
(8, '4793939230493993', 'Halil Rexhepi', '04 / 2030', '234', 17051.96, 8),
(9, '5192388820092384', 'Shpresim Musliu', '03 / 2028', '239', 10273.14, 9),
(10, '4029930008576632', 'Arber  Syla', '05 / 2021', '299', 12184.29, 10),
(11, '5123444567788990', 'Egzon Selishta', '05 / 2028', '223', 14614.18, 11);

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

--
-- Dumping data for table `income_ratio`
--

INSERT INTO `income_ratio` (`income_id`, `acc_number`, `acc_company`, `tariff_type`, `profit`, `acc_company_balance`, `date_time`) VALUES
(1, '5120990867582221', 'DealAIM Company', 'Tërheqje parash', 0.60, 0.60, '2021-03-17 11:05:09'),
(2, '4140223489310001', 'DealAIM Company', 'Tërheqje parash', 0.29, 0.89, '2021-03-17 12:17:08'),
(3, '4130233291002903', 'DealAIM Company', 'Tërheqje parash', 14.40, 15.29, '2021-03-17 13:04:52'),
(4, '4130233291002903', 'DealAIM Company', 'Tërheqje parash', 1.20, 16.49, '2021-03-17 13:07:32'),
(5, '5120990867582221', 'DealAIM Company', 'Shitje e produktit', 41.25, 57.74, '2021-03-22 09:24:06'),
(6, '5120990867582221', 'DealAIM Company', 'Shitje e produktit', 72.50, 910.24, '2021-03-23 08:23:40'),
(7, '4299803928776331', 'DealAIM Company', 'Tërheqje parash', 18.00, 928.24, '2021-03-23 08:52:00'),
(8, '5302019903299321', 'DealAIM Company', 'Shitje e produktit', 2.23, 930.47, '2021-03-24 15:40:20'),
(9, '4130233291002903', 'DealAIM Company', 'Shitje e produktit', 10.56, 941.03, '2021-03-24 15:46:57'),
(10, '4130233291002903', 'DealAIM Company', 'Shitje e produktit', 1250.00, 2191.03, '2020-12-30 09:21:55'),
(11, '4130233291002903', 'DealAIM Company', 'Tërheqje parash', 24.00, 2215.03, '2021-03-25 09:48:43'),
(12, '4130233291002903', 'DealAIM Company', 'Tërheqje parash', 24.00, 2239.03, '2021-03-25 09:49:05'),
(13, '5120990867582221', 'DealAIM Company', 'Tërheqje parash', 23.76, 2262.79, '2021-03-25 10:00:31'),
(14, '5120990867582221', 'DealAIM Company', 'Tërheqje parash', 11.04, 2273.83, '2021-03-25 10:00:49'),
(15, '5302019903299321', 'DealAIM Company', 'Shitje e produktit', 37.12, 2310.95, '2021-03-26 08:33:14'),
(16, '5123320001006720', 'DealAIM Company', 'Shitje e produktit', 1.26, 2312.22, '2021-03-26 08:37:21'),
(17, '4130233291002903', 'DealAIM Company', 'Tërheqje parash', 23.81, 2336.02, '2021-03-30 08:56:15'),
(18, '4130233291002903', 'DealAIM Company', 'Tërheqje parash', 24.00, 2360.02, '2021-03-30 08:56:25'),
(19, '5120990867582221', 'DealAIM Company', 'Tërheqje parash', 23.77, 2383.79, '2021-03-30 08:56:49'),
(20, '4793939230493993', 'DealAIM Company', 'Shitje e produktit', 7.30, 2391.09, '2021-03-30 21:12:27'),
(21, '4793939230493993', 'DealAIM Company', 'Shitje e produktit', 16.08, 2407.17, '2021-03-30 21:47:52'),
(22, '5120990867582221', 'DealAIM Company', 'Shitje e produktit', 67.56, 2454.35, '2021-03-28 12:00:00'),
(23, '4793939230493993', 'DealAIM Company', 'Shitje e produktit', 59.55, 2513.90, '2021-02-28 12:00:00'),
(24, '4140223489310001', 'DealAIM Company', 'Tërheqje parash', 28.47, 2542.37, '2021-02-26 12:00:00'),
(25, '4130233291002903', 'DealAIM Company', 'Shitje e produktit', 75.99, 2618.36, '2021-02-25 12:00:00'),
(26, '4793939230493993', 'DealAIM Company', 'Shitje e produktit', 68.03, 2686.39, '2021-03-29 12:00:00'),
(27, '4140223489310001', 'DealAIM Company', 'Shitje e produktit', 73.78, 2760.17, '2021-03-27 12:00:00'),
(28, '4130233291002903', 'DealAIM Company', 'Shitje e produktit', 56.00, 2816.17, '2021-02-27 12:00:00'),
(29, '4029930008576632', 'DealAIM Company', 'Tërheqje parash', 1.20, 2817.37, '2021-03-31 09:30:34'),
(30, '4793939230493993', 'DealAIM Company', 'Shitje e produktit', 7.42, 2824.80, '2021-03-31 09:44:20'),
(31, '5120990867582221', 'DealAIM Company', 'Shitje e produktit', 3.85, 2828.65, '2021-03-31 12:21:48');

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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `full_name`, `email`, `phone`, `message`, `user_id`, `received_at`, `status`) VALUES
(1, 'Butrint Selishta', 'bselishta11@gmail.com', '+383 44 333 333', 'asdsd', 4, '2021-03-09 13:55:53', 1),
(2, 'aaaaaaasdf  asdasfsafsaf', 'asdasf', 'asfdasads', 'asdasdsadsadsa', NULL, '2021-03-24 13:56:00', 1),
(3, 'Butrint Selishta', 'bselishta11@gmail.com', '+383 44 333 333', 'asdsaf', 4, '2021-03-01 13:56:03', 1),
(4, 'Butrint Selishta', 'butrintselishtaa@gmail.com', '+38344991411', 'ershendetje Butrint,\r\n\r\nSot ju kemi derguar email per pranim te aplikacionit, andaj ju lutem nese veq e keni vendose te jeni pjese e trajnimit, ju lutem e konfirmoni ne ate email me shkrim.\r\n\r\nCdo te mire!', NULL, '2021-02-17 13:56:07', 1),
(5, 'Valonis Ramadani', 'valo_ramadani@gmail.com', '044223994', 'Njoftim\r\n\r\nRezultate për DS 01.02.2021 janë në e-Learning\r\n\r\nKonsultime më 08.02.2021 në ora 19:30 në linkun:\r\n\r\nmeet.google.com/wcx-ikwp-uqx', NULL, '2021-03-10 14:24:53', 1),
(6, 'Butrint Selishta', 'butrintselishtaa@gmail.com', '+383-45-223-322', 'Butrint Butrint ButrintButrintButrint Butrint ButrintButrint Butrint\r\nButrintButrintButrintButrintButrint\r\nButrintButrintButrintButrintButrint\r\nButrintButrintButrintButrintButrintButrintButrintButrintButrintButrintButrintButrint', 2, '2021-03-25 10:00:14', 1),
(7, 'Butrint Selishta', 'bselishta1@gmail.com', '', 'Butrint selishta, antar i perjashtuar nga deal aim.\r\nkerkoj te me ktheni llogarine time pasi që nuk kam thyer rregullat.', NULL, '2021-03-31 00:19:55', 0);

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

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_unique_id`, `prod_img`, `prod_title`, `prod_price`, `prod_from`, `prod_to`, `prod_description`, `cat_id`, `user_id`, `prod_isApproved`) VALUES
(1, 'butrinti12_6051e7c922c602.88399509', 'photo1_butrinti12_6051e7c922c602.88399509.jpg|photo2_butrinti12_6051e7c922c602.88399509.jpg|photo3_butrinti12_6051e7c922c602.88399509.jpg|photo4_butrinti12_6051e7c922c602.88399509.jpg', 'XPS 15 Laptop | 15.6\'\'', 750.00, '2021-03-18 12:00:00', '2021-03-20 12:00:00', '<p><b>Njihuni me laptopin më të vogël të performancës 15,6-inç në planet\r\nVendndodhja e përmirësuar e kamerës: Ne e shtyam risinë në kufijtë e saj për të krijuar kamerën tonë më të vogël HD që është vendosur në pjesën e sipërme të ekranit të famshëm InfinityEdge - tani përpara dhe në qendër.\r\n\r\nNdërtimi revolucionar i kamerës së internetit: Kamera e re XPS 15 nuk është thjesht më e vogël - është edhe më e mirë. </b></p><p>Një lente e re me 4 elementë përdor më shumë elemente sesa një kamerë tipike në internet për të dhënë video të mprehtë në të gjitha zonat e kornizës, ndërsa zvogëlimi i përkohshëm i zhurmës përdor ulje të përparuar të zhurmës, duke përmirësuar ndjeshëm cilësinë e videos, veçanërisht në kushtet e ndriçimit të zbehtë. Më në fund, lentja është mbledhur me makineri precize për të siguruar që të gjitha pikat e figurës janë në fokus.</p><p>\r\nEkran InfinityEdge: Ekrani praktikisht pa kufij maksimalizon hapësirën e ekranit duke akomoduar një ekran 15,6 inç brenda një laptopi më afër madhësisë së një 14 inçësh, falë një kornize që mat vetëm 6,04 mm në anët dhe 7,08 mm në pjesën e sipërme.\r\n\r\nDizajn i një lloji: Me një matje të hollë 11-17 mm dhe duke filluar me vetëm 4 paund (1.8 kg) me një makinë solide, XPS 15 është një nga laptopët më të lehtë në klasë të performancës 15 inç në botë.</p>', 2, 2, 3),
(2, 'butrinti12_6051e99073f533.22784807', 'photo1_butrinti12_6051e99073f533.22784807.jpg|photo2_butrinti12_6051e99073f533.22784807.jpg|photo3_butrinti12_6051e99073f533.22784807.jpg|photo4_butrinti12_6051e99073f533.22784807.jpg|photo5_butrinti12_6051e99073f533.22784807.jpg', '2002 BMW M3 6-Speed', 15500.00, '2021-03-18 12:00:00', '2021-03-22 12:00:00', '<p><b>Kjo BMW M3 e vitit 2002 tregon vetëm 20 km milje dhe thuhet se është një shembull i pa modifikuar i mundësuar nga një 3.2-litër S54 inline-gjashtë i çiftuar me një transmision manual me 6 shpejtësi.</b> </p><p>Bojra besohet të jetë origjinale, dhe makina u porosit me Paketën e Ftohtë të Motit. Raportohet se ishte garazhuar për disa vjet nga pronari i mëparshëm dhe drejtohej rrallë. Shitësi beson se ai është pronari i tretë dhe ka shtuar 200 milje që nga blerja e makinës një vit më parë. Ky E46 M3 shitet me një Carfax pa aksidente dhe një titull të pastër të Pensilvanisë në emrin e shitësit.\r\n\r\nE gjithë bojëra prej Titanium Silver thuhet se është origjinale, dhe gjendja është e detajuar në fotografitë e galerisë. Treguesit e qartë të sinjalit të kthesës dhe një hënë e energjisë u opsionuan në blerje.\r\n\r\nRrotat janë artikuj prej aliazhi me dy folëse me një fund të Shadow Chrome. </p><p>Paketa e Ftohtë e Motit e opsionuar në këtë makinë përfshinte rondele fenerësh, sedilje të nxehta, fshirëse që ndiejnë shiun dhe një çantë skish. Fenerët ksenon janë gjithashtu të pajisur.</p>', 5, 2, 3),
(3, 'egzonsherifi_6051eeacdabce4.38325007', 'photo1_egzonsherifi_6051eeacdabce4.38325007.jpg|photo2_egzonsherifi_6051eeacdabce4.38325007.jpg|photo3_egzonsherifi_6051eeacdabce4.38325007.jpg|photo4_egzonsherifi_6051eeacdabce4.38325007.jpg|photo5_egzonsherifi_6051eeacdabce4.38325007.jpg', 'Samsung Galaxy S10 Telefon', 650.00, '2021-03-19 12:00:00', '2021-03-20 12:00:00', '<p><b>Samsung Galaxy S10 e çon serinë klasike S një hap gjigant më tej, me një kamerë të përparme dhe 3 kamera të pasme, duke përfshirë një lente ultra të gjerë dhe ultra-zoom, është e lehtë për të kapur çdo kënd të një skene.\r\n</b></p><p>\r\nRisi e telefonit inteligjent me një ekran infinity-o: zbuloni një ekran pa fund të bukur, me buzë të lakuara; pa butonin e shtëpisë, pa vrimë për marrësin dhe një hapje të thjeshtë të pikës për kamerën e përparme, Galaxy S10 ju jep një përvojë shikimi të pandërprerë\r\n\r\nPowerShare: kjo ju jep superfuqinë për të ndarë fuqinë tuaj kudo që të jeni, thjesht lidhni Galaxy Watch me S10 dhe karikoni ato në të njëjtën kohë, ose riktheni mikun tuaj në jetë\r\n\r\nKamera e Vizionit të Vërtetë: me një kamerë të përparme, 3 kamera të pasme dhe lenten ultra të gjerë dhe ultra-zoom.</p><p> Galaxy S10 ju lejon të xhironi çdo skenë ashtu si sytë tuaj e shohin atë\r\n\r\nSmartphone pa SIM me skaner ultrasonik të gjurmëve të gishtërinjve: mënyra më e re për të mbajtur të sigurt telefonin dhe informacionin tuaj Android, lexon çdo kreshtë dhe nivel të gishtit tuaj, madje performon në temperatura të ulëta dhe rrezet e diellit.</p><p>Pastroni ndërfaqen për të bërë gjithçka pa mundim: ekranet nuk janë të ndotura, ikonat shfaqen me ngjyra, aplikacioni SmartThings është instaluar tashmë dhe madje e kemi bërë më të lehtë përdorimin me një dorë</p>', 3, 4, 3),
(4, 'blendish_605856b65d1b88.11495683', 'photo1_blendish_605856b65d1b88.11495683.png|photo2_blendish_605856b65d1b88.11495683.png|photo3_blendish_605856b65d1b88.11495683.png|photo4_blendish_605856b65d1b88.11495683.png', 'YSera HTML5 CSS3 BOOTSTRAP', 40.50, '2021-03-23 12:00:00', '2021-03-24 12:00:00', '<p><b>Ysera</b> është një dyqani fuqishëm i argjendarisë HTML, i krijuar në Bootstrap3, HTML5, CSS3, JavaScript, jQuery. </p><p>Dizajni është i përshtatshëm për të gjitha dyqanet moderne, tregjet e bazuara në shitës, faqet e internetit të partnerëve. Supershtë super për dyqan mode, dyqan dixhital, dyqan elektronik, dyqan lojërash, dyqane ushqimesh, dyqane pajisjesh, dyqane të pajisjeve shtëpiake ose ndonjë kategori tjetër. </p><p>\r\nLista e veçorive:\r\n</p><ol><li>3+ Faqet Kryesore të Parapërgatitura\r\nHTML5 / CSS 3</li><li>\r\nPlotësisht i përgjegjshëm\r\n</li><li>Stili i dizajnit të sheshtë\r\n</li><li>Renditja e Gjerësisë së plotë</li><li>\r\nFaqet e Brendshme: Faqet e Blogut, Produkti i Rrjetit, Produkti i Rrjetit LeftSideBar, Rrjeti i Produktit të Rrjetit, Shporta e Blerjes, Blerja, Regjistrohu / Identifikohu, Rreth Nesh, Kontaktoni, Lista e Produktit, listproducts_bannerslider, listproducts_leftsidebar, listproducts_leftsidebar_bannerslider, lista e produkteve të stilit, inblog_left-inblog_left shirita sider\r\n</li><li>Mega Top Menu\r\n</li><li>Menuja vertikale</li><li> Mega\r\nMenyja ngjitëse\r\n</li><li>Shfaqje Slidesh e banderolave</li><li>\r\nShërbimet\r\nKarusel\r\n</li><li>jQuery i përmirësuar\r\nSkedarët </li><li>HTML\r\nDizajn HTML5 dhe CSS3 pa Tabela\r\nLista &amp; Pamja e Rrjetit (Produktet)\r\nImazhe me zoom të brendshëm të jQuery\r\nShfletues të pajtueshëm: IE9 +, Firefox, Safari, Opera, Chrome, Edge\r\nDokumentacioni i Përfshirë\r\nLehtë për tu personalizuar\r\nMbështetje dhe azhurnim\r\nEdhe me shume…</li></ol>', 7, 5, 3),
(5, 'blendish_605858f5012e19.69067250', 'photo1_blendish_605858f5012e19.69067250.jpg|photo2_blendish_605858f5012e19.69067250.jpg|photo3_blendish_605858f5012e19.69067250.jpg|photo4_blendish_605858f5012e19.69067250.jpg', 'Apple iPhone 11, 64GB', 675.00, '2021-03-22 12:00:00', '2021-03-25 12:00:00', '<p><b>IPhone 11 64gb ngjyrë e zezë për shitje.\r\n</b></p><p>Shitet iphone 11 Black 64 GB i ri 2 jave i paperdorur me adapter origjinal foli e fotroll</p>', 3, 5, 3),
(6, 'egzonsherifi_60585a56e65ff4.49963559', 'photo1_egzonsherifi_60585a56e65ff4.49963559.jpg|photo2_egzonsherifi_60585a56e65ff4.49963559.jpg|photo3_egzonsherifi_60585a56e65ff4.49963559.jpg|photo4_egzonsherifi_60585a56e65ff4.49963559.jpg|photo5_egzonsherifi_60585a56e65ff4.49963559.jpg', 'HP ENVY x360 | 15.6', 630.00, '2021-03-23 12:00:00', '2021-03-25 12:00:00', '<p><b>Më shumë fuqi, më shumë siguri dhe më shumë mënyra për t\'i bërë të gjitha. </b></p><p>Kabriola 15 \"HP ENVY x360 ju lejon të përshtateni me gjithçka që dita juaj ka në dyqan, pa dëmtuar fuqinë ose sigurinë.</p><p> Me fuqinë dhe shkathtësinë që dëshironi dhe një suitë të tipareve të fundit të sigurisë që ju nevojiten, ju mund të qëndroni produktiv dhe të mbrojtur si kurrë më parë.\r\nKrijuar duke pasur parasysh privatësinë tuaj\r\nMbroni privatësinë tuaj me një Webcam Kill Switch të integruar që çaktivizon kamerën e PC tuaj.</p><p> Një lexues i integruar i gjurmëve të gishtave ju jep një hyrje pa ndërprerje, ndërsa HP BIOS Recovery ndihmon në mbrojtjen e PC tuaj nga korrupsioni.\r\n</p><p>Seamless. E theksuar. E bukur.\r\nNga materialet e tij dalluese dhe dizajni ikonik, ky PC nxjerr një bukuri të pashembullt. Ndërtuar i hollë dhe i lehtë për ata që janë në lëvizje - prisni karakteristika premium të dizajnit duke përfshirë një tastierë të shkëlqyeshme me ndriçim të pasmë, profil të përsosur dhe skarë të altoparlantëve me model gjeometrik.\r\nArgëtimi i nivelit tjetër\r\n</p><p>Ngrini argëtimin tuaj në një ekran me rezolucion të lartë. Altoparlantët HP, të akorduar me porosi në bashkëpunim me ekspertë në Bang &amp; Olufsen, japin një tingull të pasur dhe autentik. Mos dëgjoni vetëm - lini që përvoja gjithëpërfshirëse t\'ju prek.</p>', 2, 4, 3),
(7, 'egzonsherifi_6058603d52a642.83540563', 'photo1_egzonsherifi_6058603d52a642.83540563.jpg|photo2_egzonsherifi_6058603d52a642.83540563.jpg|photo3_egzonsherifi_6058603d52a642.83540563.jpg|photo4_egzonsherifi_6058603d52a642.83540563.jpg', 'Huawei P smart (2019) POT-LX1AF - 64GB', 192.00, '2021-03-23 12:00:00', '2021-03-24 12:00:00', '<p><b>Shitet Huawei p Smart (unlocked)\r\n</b>\r\n<br class=\"Apple-interchange-newline\"></p><p>Në gjendje perfekte i përdorur vetëm 2 javë\r\n</p>', 3, 4, 3),
(8, 'leozeqiri_6059a4976b7149.20729896', 'photo1_leozeqiri_6059a4976b7149.20729896.png|photo2_leozeqiri_6059a4976b7149.20729896.png|photo3_leozeqiri_6059a4976b7149.20729896.png|photo4_leozeqiri_6059a4976b7149.20729896.png|photo5_leozeqiri_6059a4976b7149.20729896.png', 'Admin DASHBOARD DiffDash, responzivë', 23.00, '2021-03-24 12:00:00', '2021-03-25 12:00:00', '<p>Shitet template për admin dashboar full responsivë</p><p>\r\nKarakteristikat e këtij modelit janë\r\n</p><ul><li>Panel i thjeshtë, pa karakteristika dhe elemente të mbivlerësuar\r\n</li><li>Grafiku i linjës, diagrami i shiritave, diagrami i sipërfaqes, tabela e byrekut, tabela e donutëve dhe tabela e përbërë\r\n</li><li>Grafik Mini Line, Grafik Mini Bar dhe Grafik Mini Pie\r\n</li><li>Njoftim i ngjashëm me Growl\r\nSkeda me stile të ndryshme\r\nButonat, grupet e butonave, butonin e shiritit të mjeteve, butonin me ikonë, butonat e lëshimit dhe lëshimit</li><li>\r\nElemente të stilizuara </li><li>Bootstrap si mesazhe alarmi, fizarmonikë, shirita përparimi, këshilla për veglat, popovers, faqosje dhe më shumë\r\n670+ Font Awesome icons dhe përfshin 170 Ikona Lineare\r\n</li><li>Kutitë e zgjedhjes dhe butonat e radios</li><li>\r\nInpute themelore, grupe hyrëse\r\nElementë të avancuar të formës si p.sh. datapicker, multilelect bootstrap (hyrja intuitive e zgjedhjes), hyrjet e maskuara\r\n</li><li>Vlerësimi i formës, ofron shumë skenarë të vlefshmërisë së hyrjes, shumë të lehtë për t\'u konfiguruar dhe konfiguruar\r\n</li><li>Krijuar me skedarë Sass dhe të organizuar mirë HTML, CSS dhe Javascript\r\nHTML dhe Redaktori i Markdown\r\nTestuar ndër-shfletuesin\r\n</li><li>E vlefshme HTML5 W3C</li></ul>', 7, 7, 3),
(9, 'egzonsherifi_605dce19279930.47804071', 'photo1_egzonsherifi_605dce19279930.47804071.jpg|photo2_egzonsherifi_605dce19279930.47804071.jpg|photo3_egzonsherifi_605dce19279930.47804071.jpg|photo4_egzonsherifi_605dce19279930.47804071.jpg|photo5_egzonsherifi_605dce19279930.47804071.jpg', 'LG V30 64GB UNLOCKED, GSM T-Mobile, 64Bit CPU', 179.00, '2021-03-27 12:00:00', '2021-03-28 12:00:00', '<p>Shkyçur për të gjithë Transportuesit GSM dhe do të punojë me T-Mobile, AT&amp;T, Ultra Mobile, Mobile të Thjeshtë, Kriket, Etj ose ndonjë ofrues tjetër të rrjetit GSM në botë.</p><p>\r\n\r\nNUK do të punojë me ndonjë transportues CDMA (Verizon, Sprint, Boost Mobile, Page Plus, etj.) Radio FM që punon pa ndonjë problem. Me karikim wireless.\r\n\r\nIt\'sshtë një telefon i rrënjosur plotësisht (Jailbreak) që përdor kornizën më të fundit Magisk 20.4 me Magisk 7.4.2 Instalimi i grazhdit për qasje në rrënjë dhe kalimin e Safetynet.</p><p>\r\n\r\nKjo pajisje mbështet gjithashtu deri në 256 GB kartelë microSD (karta SD nuk përfshihet).\r\n\r\nROM-i i tij është vetëm 1350MB krahasuar me ROM të rëndë të aksioneve tuaj bloatware të rëndë. Kjo është arsyeja pse ajo funksionon shumë lehtë dhe shpejt.\r\n</p><p>\r\n\r\n\r\nModeli i Zhvilluesit / Zhbllokimi OEM është zhbllokuar në këtë telefon duke përdorur mjetet e Linux. Ky telefon ka zhbllokuar bootloader, ai u zhbllokua duke përdorur mjetet e Linux. Instaluar gjithashtu rikuperimin më të fundit me projektin e rikuperimit të fitimit të ekipit TWRP v.3.3.3.0</p>', 3, 4, 3),
(10, 'Butrinti12_605dcfa4ef18e0.41969065', 'photo1_Butrinti12_605dcfa4ef18e0.41969065.jpg|photo2_Butrinti12_605dcfa4ef18e0.41969065.jpg|photo3_Butrinti12_605dcfa4ef18e0.41969065.jpg|photo4_Butrinti12_605dcfa4ef18e0.41969065.jpg|photo5_Butrinti12_605dcfa4ef18e0.41969065.jpg', ' MacBook Pro 13.3', 799.99, '2021-03-27 12:00:00', '2021-03-29 12:00:00', 'Karakteristikat: \r\nÇipi M1 i dizajnuar nga Apple për një hap gjigant në CPU, GPU dhe performancën e të mësuarit në makinë\r\n\r\nBëni më shumë punë me deri në 20 orë jetëgjatësi të baterisë, më e gjata ndonjëherë në një Mac²\r\n\r\nCPU me 8 bërthama jep deri në 2.8x performancë më të shpejtë për të fluturuar përmes rrjedhave të punës më shpejt se kurrë¹\r\n\r\nGPU me 8 bërthama me grafikë deri në 5 herë më të shpejtë për aplikacione dhe lojëra me grafikë\r\n\r\nMotor Neural 16-bërthamë për të mësuar makinerinë e përparuar\r\n\r\n8 GB memorie të unifikuar kështu që gjithçka që bëni është e shpejtë dhe e rrjedhshme\r\n\r\nHapësira ruajtëse Super fast SSD nis aplikacionet dhe hap skedarët në çast\r\n\r\nSistemi i ftohjes aktive mban një performancë të jashtëzakonshme\r\n\r\nEkran Retina 13,3 inç me shkëlqim 500 gr për ngjyra të gjalla dhe detaje të pabesueshme të imazhit\r\n\r\nKamera FaceTime HD me procesor të përparuar të sinjalit të imazhit për thirrje video më të qarta dhe më të mprehta\r\n\r\nArray me tre mikrofona me cilësi studio kap zërin tuaj më qartë\r\n\r\nBrezi i ardhshëm Wi-Fi 6 për lidhje më të shpejtë\r\n\r\nDy porta Thunderbolt / USB 4 për karikim dhe pajisje shtesë\r\n\r\nTastierë Magjike me Ndriçim me Touch Bar dhe Touch ID për zhbllokim të sigurt dhe pagesa\r\n\r\nmacOS Big Sur me një dizajn të ri të guximshëm dhe azhurnime kryesore të aplikacioneve për Safari, Mesazhet dhe Hartat\r\n\r\n¹ Krahasuar me gjeneratën e mëparshme.\r\n\r\nLife Jetëgjatësia e baterisë ndryshon nga përdorimi dhe konfigurimi. Shihni apple.com/bateritë për më shumë informacion.\r\n\r\nSize Madhësia e ekranit matet në mënyrë diagonale.', 2, 2, 3),
(11, 'halilrexhepi_6062ce0b87d661.86339660', 'photo1_halilrexhepi_6062ce0b87d661.86339660.jpg|photo2_halilrexhepi_6062ce0b87d661.86339660.jpg|photo3_halilrexhepi_6062ce0b87d661.86339660.jpg|photo4_halilrexhepi_6062ce0b87d661.86339660.jpg|photo5_halilrexhepi_6062ce0b87d661.86339660.jpg', 'Samsung Galaxy A51 A515F 128GB DUOS GSM Unlocked ', 292.30, '2021-03-30 12:00:00', '2021-03-30 21:46:26', 'Ekrani i Infinity-O i A51 optimizon simetrinë vizuale. Tani mund të luani, të shikoni, të shfletoni dhe të kryeni shumë detyra pa ndërprerje në një ekran me ekran të gjerë 6,5 \"FHD + - të gjitha mundësohen nga teknologjia Super AMOLED. Gëzoni një përvojë smartphone që minimizon kornizën dhe maksimizon çdo inç të hapësirës së ekranit. Modeli ritmik i Tematika e dizajnit e A51 vjen në nuanca pastel të lëmuara dhe elegante, duke përfshirë Prism Crush Black, White, Blue dhe Pink. Një përfundim shkëlqim shkëlqim shton prekjen perfekte të stilit në trupin e tij të hijshëm dhe të hollë, duke përzier në mënyrë të përsosur stilin me komoditetin në dorë. Shko ultra rezolucion të lartë me një kamerë kryesore 48MP për fotografi të freskëta dhe të qarta ditën dhe natën. Një kamerë ultra e gjerë 123 ° 12MP kap më shumë pamje.', 3, 8, 1),
(12, 'halilrexhepi_6062cf217116b3.93284663', 'photo1_halilrexhepi_6062cf217116b3.93284663.jpg|photo2_halilrexhepi_6062cf217116b3.93284663.jpg|photo3_halilrexhepi_6062cf217116b3.93284663.jpg', 'Huawei P Smart 2017 32gb', 132.76, '2021-03-30 12:00:00', '2021-03-30 09:12:39', '<p>Tiparet:</p><ol><li>Camera, </li><li>Colour Screen,</li><li> Fingerprint Sensor,</li><li> Dual Rear Cameras, </li><li>Digital Compass,</li><li> Email Access,</li><li> FM Radio, </li><li>Front Camera, </li><li>GPRS, </li><li>GPS, </li><li>Internet Connectivity,</li><li> Nano SIM,</li><li> NFC Connectivity,</li><li> Proximity Sensor, </li><li>Touch Screen, </li><li>Video Calling,</li><li> Video Camera, </li><li>Vibration,</li><li> Wi-Fi Capable<br></li></ol>', 3, 8, 3),
(13, 'halilrexhepi_60639a5ca95f84.12125592', 'photo1_halilrexhepi_60639a5ca95f84.12125592.jpg|photo2_halilrexhepi_60639a5ca95f84.12125592.jpg|photo3_halilrexhepi_60639a5ca95f84.12125592.jpg|photo4_halilrexhepi_60639a5ca95f84.12125592.jpg', 'Google Pixel 3 - 64GB', 135.00, '2021-03-30 12:00:00', '2021-03-31 09:44:00', '<p>Tiparet:\r\n</p><ul><li>Features	Proximity Sensor, </li><li>Accelerometer, </li><li>Fingerprint Sensor\r\n</li><li>Color	White\r\n</li><li>Network	Unlocked\r\n</li><li>Screen Size	5.5 in\r\n</li><li>Connectivity	Bluetooth, 4G, USB Type-C, NFC, 2G, Wi-Fi, 3G\r\n</li><li>Processor	Octa Core\r\n</li><li>Operating System	Android\r\nLock Status	</li><li>Factory Unlocked\r\nManufacturer Color	Clearly </li><li>White\r\nContract	Without Contract\r\n</li><li>Camera Resolution	12.0 MP</li></ul>', 3, 8, 3),
(14, 'butrinti12_60639bd6569756.06180598', 'photo1_butrinti12_60639bd6569756.06180598.jpg|photo2_butrinti12_60639bd6569756.06180598.jpg|photo3_butrinti12_60639bd6569756.06180598.jpg|photo4_butrinti12_60639bd6569756.06180598.jpg|photo5_butrinti12_60639bd6569756.06180598.jpg', 'Smartphone Samsung a7 2018', 70.00, '2021-03-30 12:00:00', '2021-03-31 12:21:05', '<ol><li>Unshtë shkyçur për çdo rrjet</li><li>Ekrani eshte ne gjendje perfekte\r\najo që është prishur është mika e qelqit\r\n</li><li>Kthimi është mirë.</li><li> Nuk ka gërvishtje\r\n</li><li>Kutia origjinale është e përfshirë</li><li>\r\nPërdoret\r\n</li><li>Nuk e njeh kamerën e përparme\r\n</li><li>Ndonjë pyetje në lidhje me produktin ju lutemi bëni</li></ol>', 3, 2, 3),
(15, 'blendish_6063a14af08b00.54317482', 'photo1_blendish_6063a14af08b00.54317482.jpg|photo2_blendish_6063a14af08b00.54317482.jpg|photo3_blendish_6063a14af08b00.54317482.jpg|photo4_blendish_6063a14af08b00.54317482.jpg|photo5_blendish_6063a14af08b00.54317482.jpg', 'Dell 14.1', 350.00, '2021-03-30 12:00:00', '2021-03-31 12:00:00', '<p><b><u>�PC-të AAA janë një partner i autorizuar nga Microsoft për rinovim. </u></b></p><p>(MAR) Kompjuteri juaj përfshin një instalim të ri të Windows 10 me një rezervë të rikuperimit. </p><p>Gërvishtjet e vogla dhe gërvishtjet e lehta mund të jenë të pranishme. Komponentët origjinal janë instaluar për të siguruar cilësi. Kompjuteri juaj do të dërgohet në mënyrë të sigurt në një kuti të re ngjyrë kafe për të siguruar një përvojë të shkëlqyer të dorëzimit. \"</p>', 2, 5, 3),
(16, 'leozeqiri_6063a33eb48a95.91946778', 'photo1_leozeqiri_6063a33eb48a95.91946778.png|photo2_leozeqiri_6063a33eb48a95.91946778.png|photo3_leozeqiri_6063a33eb48a95.91946778.png|photo4_leozeqiri_6063a33eb48a95.91946778.png', 'Admin template', 22.00, '2021-03-30 12:00:00', '2021-03-30 14:00:00', 'Admin template\r\nadmin telmplate template admin template\r\nadmin telmplate template admin template\r\nadmin telmplate template', 7, 7, 2);

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

--
-- Dumping data for table `prod_offers`
--

INSERT INTO `prod_offers` (`offer_id`, `user_id`, `offer_time`, `offer_price`, `prod_id`, `is_sold`) VALUES
(1, 4, '2021-03-18 15:45:26', 726.50, 1, 0),
(2, 4, '2021-03-18 15:45:34', 728.00, 1, 0),
(3, 4, '2021-03-18 15:45:40', 730.00, 1, 0),
(4, 4, '2021-03-18 15:45:46', 745.00, 1, 0),
(5, 4, '2021-03-18 15:45:49', 750.00, 1, 1),
(6, 4, '2021-03-20 23:24:51', 15020.00, 2, 0),
(7, 3, '2021-03-20 23:44:31', 15112.15, 2, 0),
(8, 4, '2021-03-22 09:56:36', 15220.50, 2, 0),
(9, 3, '2021-03-22 09:57:55', 15500.00, 2, 1),
(10, 2, '2021-03-23 08:34:38', 645.23, 5, 0),
(11, 4, '2021-03-23 08:43:09', 650.50, 5, 0),
(12, 3, '2021-03-23 08:44:40', 665.00, 5, 0),
(13, 6, '2021-03-23 08:53:37', 670.00, 5, 0),
(14, 6, '2021-03-24 09:27:40', 27.00, 4, 0),
(15, 7, '2021-03-24 09:28:38', 29.25, 4, 0),
(16, 6, '2021-03-24 09:28:55', 31.50, 4, 0),
(17, 4, '2021-03-24 09:29:21', 33.50, 4, 0),
(18, 6, '2021-03-24 09:29:38', 35.50, 4, 0),
(19, 4, '2021-03-24 09:29:55', 36.75, 4, 0),
(20, 6, '2021-03-24 09:30:02', 39.00, 4, 0),
(21, 7, '2021-03-24 09:30:39', 40.50, 4, 1),
(22, 7, '2021-03-24 09:42:14', 175.00, 7, 0),
(23, 2, '2021-03-24 09:42:54', 176.32, 7, 0),
(24, 5, '2021-03-24 09:43:33', 177.50, 7, 0),
(25, 2, '2021-03-24 09:43:41', 179.00, 7, 0),
(26, 8, '2021-03-24 09:44:57', 182.00, 7, 0),
(27, 7, '2021-03-24 09:45:21', 184.50, 7, 0),
(28, 2, '2021-03-24 09:46:21', 189.00, 7, 0),
(29, 8, '2021-03-24 09:46:53', 192.00, 7, 1),
(30, 2, '2021-03-25 09:24:54', 675.00, 5, 1),
(31, 2, '2021-03-25 09:42:27', 15.00, 8, 0),
(32, 4, '2021-03-25 09:43:06', 16.52, 8, 0),
(33, 6, '2021-03-25 09:43:35', 18.90, 8, 0),
(34, 2, '2021-03-25 09:43:52', 21.00, 8, 0),
(35, 4, '2021-03-25 09:44:07', 23.00, 8, 1),
(41, 9, '2021-03-30 21:08:07', 125.50, 12, 0),
(42, 2, '2021-03-30 21:09:21', 132.76, 12, 1),
(43, 9, '2021-03-30 21:36:07', 280.00, 11, 0),
(44, 2, '2021-03-30 21:43:15', 285.00, 11, 0),
(45, 9, '2021-03-30 21:44:13', 292.30, 11, 1),
(46, 10, '2021-03-31 09:31:54', 125.80, 13, 0),
(47, 2, '2021-03-31 09:34:06', 130.00, 13, 0),
(48, 10, '2021-03-31 09:34:35', 135.00, 13, 1),
(49, 5, '2021-03-31 10:17:29', 55.23, 14, 0),
(50, 7, '2021-03-31 10:18:07', 58.00, 14, 0),
(51, 5, '2021-03-31 10:18:25', 60.00, 14, 0),
(52, 7, '2021-03-31 10:26:34', 63.00, 14, 0),
(53, 5, '2021-03-31 10:26:45', 65.00, 14, 0),
(54, 11, '2021-03-31 12:17:50', 70.00, 14, 1);

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

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`token_id`, `plain_txt`, `token`, `conf_type`, `type`) VALUES
(1, 'info@dealaim.com', '5c374e27788d5debe820010fd50b1f00d493740f1a21b6a4b2ae6c3b046cd61f90005439ab843d9949a5b9462af9fb322d28a9c535b25e7aab4c2451d4dac1d5a85aa5604265a64a7280bdd0fddeaf12', 'account_confirm', 1),
(2, 'butrintselishtaa@gmail.com', '60404d783cbe7b1d89ad91704200fe812ba24be325164a0c5e0be413cb66e67fdef4b3ca22c2690eee32b769d41bed6abd2462af130fb7f1f95bc45caa2b09d74fad362c9d1b8e50c17b0f17501f070ead2ca479315ebae3bde76e70dbe564f7', 'account_confirm', 1),
(3, 'valonis.ramadani@gmail.com', '8fd50800a502ef799b8d08da6e0bd86b2053a2dea76077dbfc3b77258558016266342dee788ed864ea0f519a9a3523406028a0b8207155c26bb64084079f50885622b77f91e3c10ba3227e3c989c670c1a933ef20e95d9b83a688e9ccce13e2c', 'account_confirm', 1),
(4, 'egzon_sherifi1@gmail.com', 'd20069f8a83c4a536225fb9b5153a3ee0b6b3c975cb577bce39e530017600ed7b4d95fe8d926b1b7a04cfcc04ed7ca8051657117353b034e427d61fff7a4a7aa24e36a1e0831c4049b198e1651ae659272255b6330a5e7368ababfd1590af560', 'account_confirm', 1),
(5, 'blendishkodra@gmail.com', '35ac06091d04c08f6367c142a1a59e2cc51993ed0b4da170f99469e2bc1fcca7ac3b2686986167c20a567d365d6b7e03454fa5123e4b8f0e21be4373c384a94cdf9fedef0eca9430b3234500904f0e8cf89d7e13957a768fc3799320b2ded667', 'account_confirm', 0),
(6, 'elvis.sylejmani@gmail.com', 'd06234a8152d6ba67bb03b51e3de9bd7a24ed9730be60721c4ba4ae102cf4df60f75793c419809fd1aae03f9d121cffc27314d1b60300d6388cb49525c88a96848a96fba69c012bdc8219e56655315a9f803ba344dfce7b45c6ab4a0123fcbae', 'account_confirm', 1),
(7, 'leozeqiri1@gmail.com', '2c4697a8e71ac5d594a421f86dc6c2559e896db7f9215b24341cd2ba32d5df5cfdd22b9ac3b16127cf0bdd642f29b97b3fa68f4ecbb7072b604f6673c561d45f8ca1c43321f4ba3a331508cd01dd1f46', 'account_confirm', 1),
(8, 'halili22@gmail.com', '02909865c27405ba941522e197a436543c784d55764193e1f27c310c215c0e3176519822d11eec31e0efb48e777104085fc46c3dc6d36645dda878a86f4ab95bfe5bb9db3757d9705bb73fbafd0a0dcf', 'account_confirm', 1),
(9, 'shpresim.123@gmail.com', 'fc07dcdec0dc785d029acf44810facfbd152b4e3e949a8734bd4b0e4c14bf61da150f2e87b314f2c6972897c8b0ae9403d96e2048de4c4efe4484913a7843e27e382b79e9ad4bd3176a255f9666c0b64e1a71383b223803b37566e5012e11874', 'account_confirm', 1),
(10, 'shpresimmusliu', '99a55d89a58d845ba8711f14dc24fd5be5c357f8e749b74071da665883fa97a780f25f5b5f2427b4e34d8088353ea842b1627f75ff5476e54ac8c9bbc208b3a4462597b48331366c47c3a8883b92d4cf', 'reset_password', 1),
(11, 'butrintselishtaa1@gmail.com', '6e47f5ed2e2640ee620ab50b648c7567735fb09e23fd922235d73a71b9be3f6162da204883fe10d4804592859f11fd613c5b528766999b904041446663532d4d38a791e87a531e6654c272fc51b16fd5728e0d371098eb5c52a265130bda5216', 'account_confirm', 1),
(12, 'egzoni123@gmail.com', 'ba92f46ec50323e5daf5e7d2bf71f1605d40735825c049e81f83058699540c978442bb5a63a16d47344e1cd221f414efda1354416961985cba9d01f6e157379b9bb67bcfc269b63c3715b1c3b979d805', 'account_confirm', 1);

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

--
-- Dumping data for table `trigger_user_pass_reset`
--

INSERT INTO `trigger_user_pass_reset` (`id`, `username`, `old_password`, `new_password`, `update_time`) VALUES
(1, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '2021-03-17 10:35:56'),
(2, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '2021-03-17 10:36:19'),
(3, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-17 10:49:14'),
(4, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-17 11:03:45'),
(5, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-17 11:05:00'),
(6, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-17 11:05:09'),
(7, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-17 11:06:50'),
(8, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-17 12:10:53'),
(9, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-17 12:13:52'),
(10, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-17 12:16:57'),
(11, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-17 12:17:08'),
(12, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 12:43:02'),
(13, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 12:46:56'),
(14, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 12:48:50'),
(15, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 12:49:47'),
(16, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 12:59:30'),
(17, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 12:59:36'),
(18, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 13:04:27'),
(19, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 13:04:37'),
(20, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 13:04:52'),
(21, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-17 13:07:32'),
(22, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-18 15:45:26'),
(23, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-18 15:45:34'),
(24, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-18 15:45:40'),
(25, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-18 15:45:46'),
(26, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-18 15:45:49'),
(27, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-20 23:24:37'),
(28, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-20 23:24:51'),
(29, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-20 23:44:00'),
(30, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-20 23:44:31'),
(31, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-22 09:21:50'),
(32, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-22 09:22:36'),
(33, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-22 09:23:04'),
(34, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-22 09:23:23'),
(35, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-22 09:24:06'),
(36, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-22 09:56:37'),
(37, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-22 09:57:55'),
(38, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-23 08:23:40'),
(39, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-23 08:23:40'),
(40, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-23 08:34:38'),
(41, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-23 08:43:09'),
(42, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-23 08:44:40'),
(43, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-23 08:49:29'),
(44, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-23 08:50:41'),
(45, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-23 08:51:25'),
(46, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-23 08:52:00'),
(47, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-23 08:53:37'),
(48, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-23 08:56:25'),
(49, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-23 08:57:21'),
(50, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-23 08:58:42'),
(51, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-23 08:59:10'),
(52, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-23 10:27:40'),
(53, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-23 12:59:21'),
(54, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-23 14:46:52'),
(55, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-23 14:54:11'),
(56, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-23 15:10:01'),
(57, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-24 09:27:40'),
(58, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-24 09:28:38'),
(59, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-24 09:28:56'),
(60, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-24 09:29:21'),
(61, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-24 09:29:38'),
(62, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-24 09:29:56'),
(63, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-24 09:30:03'),
(64, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-24 09:30:39'),
(65, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-24 09:42:14'),
(66, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-24 09:42:54'),
(67, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-24 09:43:33'),
(68, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-24 09:43:41'),
(69, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-24 09:44:46'),
(70, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-24 09:44:57'),
(71, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-24 09:45:21'),
(72, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-24 09:46:21'),
(73, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-24 09:46:53'),
(74, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-24 15:40:20'),
(75, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-24 15:40:20'),
(76, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-24 15:40:20'),
(77, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-24 15:46:57'),
(78, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-24 15:46:57'),
(79, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-24 15:46:57'),
(80, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-24 15:46:57'),
(81, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-25 09:24:55'),
(82, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-25 09:42:27'),
(83, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-25 09:43:07'),
(84, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-25 09:43:35'),
(85, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-25 09:43:52'),
(86, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-25 09:44:07'),
(87, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-25 09:48:43'),
(88, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-25 09:49:05'),
(89, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-25 10:00:31'),
(90, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-25 10:00:49'),
(91, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', '2021-03-26 08:33:14'),
(92, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-26 08:33:14'),
(93, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-26 08:33:14'),
(94, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-26 08:33:14'),
(95, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-26 08:37:21'),
(96, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', '2021-03-26 08:37:21'),
(97, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-26 08:37:21'),
(98, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '2021-03-26 11:38:17'),
(99, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '2021-03-26 11:43:24'),
(100, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '2021-03-26 12:06:52'),
(101, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '2021-03-26 12:09:43'),
(102, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', '2021-03-26 13:15:01'),
(103, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-27 09:27:15'),
(104, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-27 09:27:33'),
(105, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-27 09:27:38'),
(106, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-27 09:27:42'),
(107, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-27 09:27:48'),
(108, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-30 08:56:15'),
(109, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', '2021-03-30 08:56:25'),
(110, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-30 08:56:49'),
(111, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$TUd3NE1aWnAyMjFaTm5LdA$9QNt2jI0XbRZtMSDhYEGd548ZffBh/Wi7hTtmqJNNgM', '$argon2i$v=19$m=65536,t=4,p=1$TUd3NE1aWnAyMjFaTm5LdA$9QNt2jI0XbRZtMSDhYEGd548ZffBh/Wi7hTtmqJNNgM', '2021-03-30 20:53:35'),
(112, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$TUd3NE1aWnAyMjFaTm5LdA$9QNt2jI0XbRZtMSDhYEGd548ZffBh/Wi7hTtmqJNNgM', '$argon2i$v=19$m=65536,t=4,p=1$TUd3NE1aWnAyMjFaTm5LdA$9QNt2jI0XbRZtMSDhYEGd548ZffBh/Wi7hTtmqJNNgM', '2021-03-30 20:59:55'),
(113, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$TUd3NE1aWnAyMjFaTm5LdA$9QNt2jI0XbRZtMSDhYEGd548ZffBh/Wi7hTtmqJNNgM', '$argon2i$v=19$m=65536,t=4,p=1$TUd3NE1aWnAyMjFaTm5LdA$9QNt2jI0XbRZtMSDhYEGd548ZffBh/Wi7hTtmqJNNgM', '2021-03-30 21:00:06'),
(114, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$TUd3NE1aWnAyMjFaTm5LdA$9QNt2jI0XbRZtMSDhYEGd548ZffBh/Wi7hTtmqJNNgM', '$argon2i$v=19$m=65536,t=4,p=1$TEhtL01YOHNmOEYvbkhWMA$KvwBR1WRd6h4AmmCfyGujLCOoNGfFAyf3kWKQE5xBA8', '2021-03-30 21:00:17'),
(115, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$TEhtL01YOHNmOEYvbkhWMA$KvwBR1WRd6h4AmmCfyGujLCOoNGfFAyf3kWKQE5xBA8', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 21:00:35'),
(116, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 21:04:23'),
(117, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 21:07:12'),
(118, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 21:08:07'),
(119, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-30 21:09:21'),
(120, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 21:12:27'),
(121, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-30 21:12:27'),
(122, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 21:36:07'),
(123, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-30 21:43:15'),
(124, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 21:44:13'),
(125, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-30 21:47:52'),
(126, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-30 21:47:52'),
(127, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-30 23:46:25'),
(128, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-30 23:47:26'),
(129, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 23:52:02'),
(130, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 23:56:25'),
(131, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-30 23:57:13'),
(132, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-31 00:00:01'),
(133, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-31 00:01:05'),
(134, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-31 00:01:21'),
(135, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-31 00:01:29'),
(136, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '2021-03-31 00:02:55'),
(137, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VVRRN3J5SlFWeHlTSkhKNg$zZi/LqaoVtJuxe7TbRMHwtM6aHC6S/2JKOG8xmUskKs', '$argon2i$v=19$m=65536,t=4,p=1$VkRsMHVTaEJEYTE4elNKVQ$Mht/iQeQ/ghCQ9z14YckMqDT3o4UtXiEjTxRwU0zGEM', '2021-03-31 00:20:46'),
(138, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '2021-03-31 09:21:17'),
(139, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '2021-03-31 09:25:24'),
(140, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '2021-03-31 09:28:27'),
(141, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '2021-03-31 09:30:34'),
(142, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '2021-03-31 09:31:54'),
(143, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-31 09:34:06'),
(144, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '2021-03-31 09:34:35'),
(145, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', '2021-03-31 09:36:27'),
(146, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-31 09:44:19'),
(147, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', '2021-03-31 09:44:20'),
(148, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-31 10:17:29'),
(149, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-31 10:18:08'),
(150, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-31 10:18:25'),
(151, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-31 10:26:34'),
(152, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-31 10:26:45'),
(153, 'egzoni123', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '2021-03-31 12:12:24'),
(154, 'egzoni123', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '2021-03-31 12:15:25'),
(155, 'egzoni123', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '2021-03-31 12:16:52'),
(156, 'egzoni123', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '2021-03-31 12:17:50'),
(157, 'egzoni123', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', '2021-03-31 12:18:56'),
(158, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', '2021-03-31 12:21:48'),
(159, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', '2021-03-31 12:21:48'),
(160, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', '2021-03-31 12:21:48');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `profile_pic`, `first_name`, `last_name`, `email`, `tel_nr`, `birthday`, `city`, `postal_code`, `address`, `pid_number`, `terms_and_conditions`, `status`, `user_balance`) VALUES
(1, 'dealaim', '$argon2i$v=19$m=65536,t=4,p=1$bXFrMHBHU3lnN2tJNXp3dg$ZmBUuzOZmlzUvIOKcA9FodLjsY+JxkXh3Im1nAf09vs', 'profile_pic_dealaim.png', 'DealAim', 'Company', 'info@dealaim.com', '+383 44 991 411', '1998-03-10', 'Gjilan', 60000, 'Aferdita, 76', NULL, NULL, 101, NULL),
(2, 'butrinti12', '$argon2i$v=19$m=65536,t=4,p=1$SWI1UkJBdEQwdjBwbWx2cQ$DSdI+Mz+50/3HVD6x5meJOss2iZe+t8+brZURxz2MtM', 'default_pic.png', 'Butrint', 'Selishta', 'butrintselishtaa@gmail.com', '+383-45-223-322', '1998-03-10', 'Gjilan', 60000, 'Madeleine Albright, 76', 1241944308, 1, 3, 9933.64),
(3, 'valonisr', '$argon2i$v=19$m=65536,t=4,p=1$L3J1aEJXMENScHc0bUYxUw$nAXU6d7Lzx8xOxUXxvsIsgZwVdwCh+Lqyiuy5e0bxEc', 'default_pic.png', 'Valonis', 'Ramadani', 'valonis.ramadani@gmail.com', '+355 4 221 3655', '1999-11-15', 'Durres', 20001, 'Rruga Kinema Gloria,  281', NULL, NULL, 2, 828.00),
(4, 'egzonsherifi', '$argon2i$v=19$m=65536,t=4,p=1$TnJwcWR4UWVNaWl1ajExeA$pyXlrB8H6LiNzSPFjaWKD6TNmdCJHhOrQ2i7Ue8M5dE', 'default_pic.png', 'Egzoni', 'Sherifi', 'egzon_sherifi1@gmail.com', '+383 44 909 232', '1996-06-01', 'Cerrnice', 60000, 'Cërrnicë, 123', 1259923902, 1, 3, 7624.44),
(5, 'blendish', '$argon2i$v=19$m=65536,t=4,p=1$T2t6S09JT3BMc2pIbzRoaA$gByeaBCPkKNzjOskx2WEKmthxI9cjH0a4GBOL1Ekc0A', 'default_pic.png', 'Blendi', 'Shkodra', 'blendishkodra@gmail.com', '+383-45-433-369', '1996-10-11', 'Ferizaj', 70000, 'Ramadan Rexhepi, 14', 2147483647, 1, 3, 3676.14),
(6, 'elvissylejmani', '$argon2i$v=19$m=65536,t=4,p=1$UjczY1Vva2x0aXJialJ3Uw$fkNDAinHNnaXbds/NXJ1Tg/P44G6EHZRjfQFCn+7sxA', 'default_pic.png', 'Elvis', 'Sylejmani', 'elvis.sylejmani@gmail.com', '+383 44 200 902', '1998-10-04', 'Viti', 60000, 'Rr. UÇK-së, 02', NULL, NULL, 2, 4050.00),
(7, 'leozeqiri', '$argon2i$v=19$m=65536,t=4,p=1$dWhyVmlJRFdyNzlnZVdIeQ$S4IGk83CRPudS39m8rbnWfCDJRO9x6W/FGqpNJtyxt8', 'default_pic.png', 'Leonit', 'Zeqiri', 'leozeqiri1@gmail.com', '+383 49 334 292', '1997-12-26', 'Viti', 60000, 'Rr. Dëshmoret e Kombit, 101', 1265562308, 1, 3, 452.24),
(8, 'halilrexhepi', '$argon2i$v=19$m=65536,t=4,p=1$cE1NaDhiMXdYeW4yNTVrMg$LxE4TdPufltbCuCHBnYbWFKhcTIQ7mOOTOpOOe+918k', 'default_pic.png', 'Halil', 'Rexhepi', 'halili22@gmail.com', '+38346902017', '1999-09-06', 'Ferizaj', 70000, 'Nëna Terezë, 192', 1249843809, 1, 3, 537.25),
(9, 'shpresimmusliu', '$argon2i$v=19$m=65536,t=4,p=1$VkRsMHVTaEJEYTE4elNKVQ$Mht/iQeQ/ghCQ9z14YckMqDT3o4UtXiEjTxRwU0zGEM', 'profile_pic_shpresimmusliu.jpg', 'Shpresim', 'Musliu', 'shpresim.123@gmail.com', '+383 43 222 112', '1995-03-18', 'Gjilan', 6000, 'Rr.Nena Terezë, 166', NULL, NULL, 2, NULL),
(10, 'arbersyl', '$argon2i$v=19$m=65536,t=4,p=1$enRONkFyMTEuanBad2RocQ$lSDDhvFSKXAL6kH4egQ1UIN4oEw5MHo70oNkX/MhGSM', 'default_pic.png', 'Arber', 'Syla', 'butrintselishtaa1@gmail.com', '+383 49 992 322', '1998-03-18', 'Gjilan', 60000, 'Nena Tereze, 82', 1241944308, 1, 3, 2265.00),
(11, 'egzoni123', '$argon2i$v=19$m=65536,t=4,p=1$Lk02OU41Yi9kVE9PUHJVTA$H6RwRUHb4jHJQuKmSOnApmZCmKz/lYKictE/VUcoLUk', 'default_pic.png', 'Egzon', 'Selishta', 'egzoni123@gmail.com', '+383 44 222 222', '1998-03-23', 'Gjilan', 6000, 'Nena Tereze, 189', 2147483647, 1, 3, 1930.00);

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
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `prod_manufacturers`
--
ALTER TABLE `prod_manufacturers`
  MODIFY `prod_man_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `prod_offers`
--
ALTER TABLE `prod_offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trigger_user_pass_reset`
--
ALTER TABLE `trigger_user_pass_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
