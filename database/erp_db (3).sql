-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 12:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_settings`
--

CREATE TABLE `application_settings` (
  `m_app_id` int(11) NOT NULL,
  `m_app_name` varchar(200) NOT NULL,
  `m_app_title` varchar(200) NOT NULL,
  `m_app_icon` varchar(200) NOT NULL,
  `m_app_logo` varchar(200) NOT NULL,
  `m_app_white_logo` varchar(200) NOT NULL,
  `m_app_black_logo` varchar(200) NOT NULL,
  `m_app_banner` varchar(200) NOT NULL,
  `m_app_email` varchar(200) NOT NULL,
  `m_app_mobile` varchar(20) NOT NULL,
  `m_app_alt_mobile` varchar(20) NOT NULL,
  `m_app_keywords` text NOT NULL,
  `m_app_description` text NOT NULL,
  `m_app_fb` varchar(200) NOT NULL DEFAULT '#',
  `m_app_insta` varchar(200) NOT NULL DEFAULT '#',
  `m_app_youtube` varchar(200) NOT NULL DEFAULT '#',
  `m_app_linkedin` varchar(200) NOT NULL DEFAULT '#',
  `m_app_twitter` varchar(200) NOT NULL,
  `m_app_whatsapp` varchar(200) DEFAULT NULL,
  `m_app_status` double NOT NULL,
  `m_app_version` double NOT NULL,
  `m_agent_app_version` double NOT NULL,
  `m_app_website` varchar(200) NOT NULL,
  `m_app_address` text NOT NULL,
  `m_app_timezone` varchar(200) NOT NULL,
  `m_app_date_format` varchar(200) NOT NULL,
  `m_app_time_format` varchar(200) NOT NULL,
  `m_app_language` varchar(200) NOT NULL,
  `m_app_currency` varchar(200) NOT NULL,
  `paid_listing_added_amt` double NOT NULL,
  `agent_daily_milestone` double NOT NULL,
  `daily_milestone_amount` double NOT NULL,
  `agent_order_commision` double NOT NULL,
  `agent_referral_perc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `application_settings`
--

INSERT INTO `application_settings` (`m_app_id`, `m_app_name`, `m_app_title`, `m_app_icon`, `m_app_logo`, `m_app_white_logo`, `m_app_black_logo`, `m_app_banner`, `m_app_email`, `m_app_mobile`, `m_app_alt_mobile`, `m_app_keywords`, `m_app_description`, `m_app_fb`, `m_app_insta`, `m_app_youtube`, `m_app_linkedin`, `m_app_twitter`, `m_app_whatsapp`, `m_app_status`, `m_app_version`, `m_agent_app_version`, `m_app_website`, `m_app_address`, `m_app_timezone`, `m_app_date_format`, `m_app_time_format`, `m_app_language`, `m_app_currency`, `paid_listing_added_amt`, `agent_daily_milestone`, `daily_milestone_amount`, `agent_order_commision`, `agent_referral_perc`) VALUES
(1, 'DigitalShakha', 'DigitalShakha', 'logo31.jpg', 'logo1.jpg', '', '', 'logo-main3.jpg', 'contact@digital.in', '90095-36500', '1234567890', 'PolyBond', 'Durg', '', 'https://www.instagram.com/', '', 'https://www.linkedin.com/', 'https://twitter.com/i/flow/login/', 'https://web.whatsapp.com/', 0, 5, 1, '', 'Naharu Nagar Bhilai', 'Asia/Kolkata', 'DD/MM/YY', '24 Hours', '', '', 0, 0, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `master_accounts_tbl`
--

CREATE TABLE `master_accounts_tbl` (
  `m_account_id` bigint(11) NOT NULL,
  `m_account_type` varchar(100) NOT NULL,
  `m_account_name` varchar(250) NOT NULL,
  `m_account_bank` varchar(200) NOT NULL,
  `m_account_number` varchar(50) NOT NULL,
  `m_account_mobile` varchar(20) NOT NULL,
  `m_account_ifsc` varchar(20) NOT NULL,
  `m_account_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0- inactive , 1-active',
  `m_account_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_advance_tbl`
--

CREATE TABLE `master_advance_tbl` (
  `m_advance_id` bigint(20) NOT NULL,
  `m_advance_type` varchar(100) NOT NULL,
  `m_advance_empid` bigint(20) NOT NULL COMMENT 'master employee tbl se',
  `m_advance_month` varchar(20) NOT NULL,
  `m_advance_date` date NOT NULL,
  `m_advance_amt` decimal(10,0) NOT NULL,
  `m_advance_remarks` text NOT NULL,
  `m_advance_status` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_advance_acct` int(11) NOT NULL,
  `m_advance_updatedby` int(11) NOT NULL,
  `m_advance_updatedon` datetime NOT NULL,
  `m_advance_addedby` int(11) NOT NULL,
  `m_advance_addedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_cashacc_tbl`
--

CREATE TABLE `master_cashacc_tbl` (
  `m_cashacc_id` int(11) NOT NULL,
  `m_cashacc_name` varchar(100) NOT NULL,
  `m_cashacc_dept` int(11) NOT NULL,
  `m_cashacc_upiname` tinyint(2) NOT NULL COMMENT '1-cash ,2-paytm,3-phonepay,4-other',
  `m_cashacc_acntno` varchar(50) NOT NULL,
  `m_cashacc_accname` int(11) NOT NULL COMMENT 'master_account_tbl se',
  `m_cashacc_mobileno` bigint(20) NOT NULL,
  `m_cashacc_status` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_cashacc_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_cate_tbl`
--

CREATE TABLE `master_cate_tbl` (
  `m_cat_id` int(11) NOT NULL,
  `m_cat_type` bigint(20) NOT NULL COMMENT '1-category,2-sub_category,3-package,4-size,5-brand',
  `m_cat_name` varchar(200) NOT NULL,
  `m_cat_img` varchar(255) NOT NULL,
  `m_catsub_id` int(11) NOT NULL,
  `m_cat_status` int(11) NOT NULL,
  `m_cat_addedon` datetime NOT NULL,
  `m_cat_updateby` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_cate_tbl`
--

INSERT INTO `master_cate_tbl` (`m_cat_id`, `m_cat_type`, `m_cat_name`, `m_cat_img`, `m_catsub_id`, `m_cat_status`, `m_cat_addedon`, `m_cat_updateby`) VALUES
(3, 1, 'cat3', '0bc8f61a48362935cfa06e83ccb184a8.jpg', 0, 1, '2025-02-12 13:38:00', '2025-02-12 08:08:59'),
(4, 1, 'cate2', 'logo11.jpg', 0, 1, '2025-02-12 13:38:00', '2025-02-12 08:08:48'),
(5, 1, 'cate1', 'logo31.jpg', 0, 1, '2025-02-12 13:38:00', '2025-02-12 08:08:38'),
(6, 2, 'test', '', 1, 1, '2025-02-04 16:59:00', '2025-02-04 11:29:32'),
(7, 2, 'ttttdfg', '', 4, 1, '2025-02-04 16:59:00', '2025-02-04 11:29:05'),
(8, 3, 'package1', '', 0, 1, '2025-02-12 13:32:00', '2025-02-12 08:02:53'),
(9, 4, 'sss', '', 0, 1, '2025-02-12 13:33:00', '2025-02-12 08:03:49'),
(10, 5, 'brand1', '', 0, 1, '2025-02-12 13:34:00', '2025-02-12 08:04:07'),
(11, 5, 'jhg', '', 0, 1, '2025-02-12 13:35:00', '2025-02-12 08:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `master_city_tbl`
--

CREATE TABLE `master_city_tbl` (
  `m_city_id` int(11) NOT NULL,
  `m_city_name` varchar(255) NOT NULL,
  `m_city_state` int(11) NOT NULL,
  `m_city_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `master_city_tbl`
--

INSERT INTO `master_city_tbl` (`m_city_id`, `m_city_name`, `m_city_state`, `m_city_status`) VALUES
(1, 'North and Middle Andaman', 32, 1),
(2, 'South Andaman', 32, 1),
(3, 'Nicobar', 32, 1),
(4, 'Adilabad', 1, 1),
(5, 'Anantapur', 1, 1),
(6, 'Chittoor', 1, 1),
(7, 'East Godavari', 1, 1),
(8, 'Guntur', 1, 1),
(9, 'Hyderabad', 1, 1),
(10, 'Kadapa', 1, 1),
(11, 'Karimnagar', 1, 1),
(12, 'Khammam', 1, 1),
(13, 'Krishna', 1, 1),
(14, 'Kurnool', 1, 1),
(15, 'Mahbubnagar', 1, 1),
(16, 'Medak', 1, 1),
(17, 'Nalgonda', 1, 1),
(18, 'Nellore', 1, 1),
(19, 'Nizamabad', 1, 1),
(20, 'Prakasam', 1, 1),
(21, 'Rangareddi', 1, 1),
(22, 'Srikakulam', 1, 1),
(23, 'Vishakhapatnam', 1, 1),
(24, 'Vizianagaram', 1, 1),
(25, 'Warangal', 1, 1),
(26, 'West Godavari', 1, 1),
(27, 'Anjaw', 3, 1),
(28, 'Changlang', 3, 1),
(29, 'East Kameng', 3, 1),
(30, 'Lohit', 3, 1),
(31, 'Lower Subansiri', 3, 1),
(32, 'Papum Pare', 3, 1),
(33, 'Tirap', 3, 1),
(34, 'Dibang Valley', 3, 1),
(35, 'Upper Subansiri', 3, 1),
(36, 'West Kameng', 3, 1),
(37, 'Barpeta', 2, 1),
(38, 'Bongaigaon', 2, 1),
(39, 'Cachar', 2, 1),
(40, 'Darrang', 2, 1),
(41, 'Dhemaji', 2, 1),
(42, 'Dhubri', 2, 1),
(43, 'Dibrugarh', 2, 1),
(44, 'Goalpara', 2, 1),
(45, 'Golaghat', 2, 1),
(46, 'Hailakandi', 2, 1),
(47, 'Jorhat', 2, 1),
(48, 'Karbi Anglong', 2, 1),
(49, 'Karimganj', 2, 1),
(50, 'Kokrajhar', 2, 1),
(51, 'Lakhimpur', 2, 1),
(52, 'Marigaon', 2, 1),
(53, 'Nagaon', 2, 1),
(54, 'Nalbari', 2, 1),
(55, 'North Cachar Hills', 2, 1),
(56, 'Sibsagar', 2, 1),
(57, 'Sonitpur', 2, 1),
(58, 'Tinsukia', 2, 1),
(59, 'Araria', 4, 1),
(60, 'Aurangabad', 4, 1),
(61, 'Banka', 4, 1),
(62, 'Begusarai', 4, 1),
(63, 'Bhagalpur', 4, 1),
(64, 'Bhojpur', 4, 1),
(65, 'Buxar', 4, 1),
(66, 'Darbhanga', 4, 1),
(67, 'Purba Champaran', 4, 1),
(68, 'Gaya', 4, 1),
(69, 'Gopalganj', 4, 1),
(70, 'Jamui', 4, 1),
(71, 'Jehanabad', 4, 1),
(72, 'Khagaria', 4, 1),
(73, 'Kishanganj', 4, 1),
(74, 'Kaimur', 4, 1),
(75, 'Katihar', 4, 1),
(76, 'Lakhisarai', 4, 1),
(77, 'Madhubani', 4, 1),
(78, 'Munger', 4, 1),
(79, 'Madhepura', 4, 1),
(80, 'Muzaffarpur', 4, 1),
(81, 'Nalanda', 4, 1),
(82, 'Nawada', 4, 1),
(83, 'Patna', 4, 1),
(84, 'Purnia', 4, 1),
(85, 'Rohtas', 4, 1),
(86, 'Saharsa', 4, 1),
(87, 'Samastipur', 4, 1),
(88, 'Sheohar', 4, 1),
(89, 'Sheikhpura', 4, 1),
(90, 'Saran', 4, 1),
(91, 'Sitamarhi', 4, 1),
(92, 'Supaul', 4, 1),
(93, 'Siwan', 4, 1),
(94, 'Vaishali', 4, 1),
(95, 'Pashchim Champaran', 4, 1),
(96, 'Bastar', 36, 1),
(97, 'Bilaspur', 36, 1),
(98, 'Dantewada', 36, 1),
(99, 'Dhamtari', 36, 1),
(100, 'Durg', 36, 1),
(101, 'Jashpur', 36, 1),
(102, 'Janjgir-Champa', 36, 1),
(103, 'Korba', 36, 1),
(104, 'Koriya', 36, 1),
(105, 'Kanker', 36, 1),
(106, 'Kawardha', 36, 1),
(107, 'Mahasamund', 36, 1),
(108, 'Raigarh', 36, 1),
(109, 'Rajnandgaon', 36, 1),
(110, 'Raipur', 36, 1),
(111, 'Surguja', 36, 1),
(112, 'Diu', 29, 1),
(113, 'Daman', 29, 1),
(114, 'Central Delhi', 25, 1),
(115, 'East Delhi', 25, 1),
(116, 'New Delhi', 25, 1),
(117, 'North Delhi', 25, 1),
(118, 'North East Delhi', 25, 1),
(119, 'North West Delhi', 25, 1),
(120, 'South Delhi', 25, 1),
(121, 'South West Delhi', 25, 1),
(122, 'West Delhi', 25, 1),
(123, 'North Goa', 26, 1),
(124, 'South Goa', 26, 1),
(125, 'Ahmedabad', 5, 1),
(126, 'Amreli District', 5, 1),
(127, 'Anand', 5, 1),
(128, 'Banaskantha', 5, 1),
(129, 'Bharuch', 5, 1),
(130, 'Bhavnagar', 5, 1),
(131, 'Dahod', 5, 1),
(132, 'The Dangs', 5, 1),
(133, 'Gandhinagar', 5, 1),
(134, 'Jamnagar', 5, 1),
(135, 'Junagadh', 5, 1),
(136, 'Kutch', 5, 1),
(137, 'Kheda', 5, 1),
(138, 'Mehsana', 5, 1),
(139, 'Narmada', 5, 1),
(140, 'Navsari', 5, 1),
(141, 'Patan', 5, 1),
(142, 'Panchmahal', 5, 1),
(143, 'Porbandar', 5, 1),
(144, 'Rajkot', 5, 1),
(145, 'Sabarkantha', 5, 1),
(146, 'Surendranagar', 5, 1),
(147, 'Surat', 5, 1),
(148, 'Vadodara', 5, 1),
(149, 'Valsad', 5, 1),
(150, 'Ambala', 6, 1),
(151, 'Bhiwani', 6, 1),
(152, 'Faridabad', 6, 1),
(153, 'Fatehabad', 6, 1),
(154, 'Gurgaon', 6, 1),
(155, 'Hissar', 6, 1),
(156, 'Jhajjar', 6, 1),
(157, 'Jind', 6, 1),
(158, 'Karnal', 6, 1),
(159, 'Kaithal', 6, 1),
(160, 'Kurukshetra', 6, 1),
(161, 'Mahendragarh', 6, 1),
(162, 'Mewat', 6, 1),
(163, 'Panchkula', 6, 1),
(164, 'Panipat', 6, 1),
(165, 'Rewari', 6, 1),
(166, 'Rohtak', 6, 1),
(167, 'Sirsa', 6, 1),
(168, 'Sonepat', 6, 1),
(169, 'Yamuna Nagar', 6, 1),
(170, 'Palwal', 6, 1),
(171, 'Bilaspur', 7, 1),
(172, 'Chamba', 7, 1),
(173, 'Hamirpur', 7, 1),
(174, 'Kangra', 7, 1),
(175, 'Kinnaur', 7, 1),
(176, 'Kulu', 7, 1),
(177, 'Lahaul and Spiti', 7, 1),
(178, 'Mandi', 7, 1),
(179, 'Shimla', 7, 1),
(180, 'Sirmaur', 7, 1),
(181, 'Solan', 7, 1),
(182, 'Una', 7, 1),
(183, 'Anantnag', 8, 1),
(184, 'Badgam', 8, 1),
(185, 'Bandipore', 8, 1),
(186, 'Baramula', 8, 1),
(187, 'Doda', 8, 1),
(188, 'Jammu', 8, 1),
(189, 'Kargil', 8, 1),
(190, 'Kathua', 8, 1),
(191, 'Kupwara', 8, 1),
(192, 'Leh', 8, 1),
(193, 'Poonch', 8, 1),
(194, 'Pulwama', 8, 1),
(195, 'Rajauri', 8, 1),
(196, 'Srinagar', 8, 1),
(197, 'Samba', 8, 1),
(198, 'Udhampur', 8, 1),
(199, 'Bokaro', 34, 1),
(200, 'Chatra', 34, 1),
(201, 'Deoghar', 34, 1),
(202, 'Dhanbad', 34, 1),
(203, 'Dumka', 34, 1),
(204, 'Purba Singhbhum', 34, 1),
(205, 'Garhwa', 34, 1),
(206, 'Giridih', 34, 1),
(207, 'Godda', 34, 1),
(208, 'Gumla', 34, 1),
(209, 'Hazaribagh', 34, 1),
(210, 'Koderma', 34, 1),
(211, 'Lohardaga', 34, 1),
(212, 'Pakur', 34, 1),
(213, 'Palamu', 34, 1),
(214, 'Ranchi', 34, 1),
(215, 'Sahibganj', 34, 1),
(216, 'Seraikela and Kharsawan', 34, 1),
(217, 'Pashchim Singhbhum', 34, 1),
(218, 'Ramgarh', 34, 1),
(219, 'Bidar', 9, 1),
(220, 'Belgaum', 9, 1),
(221, 'Bijapur', 9, 1),
(222, 'Bagalkot', 9, 1),
(223, 'Bellary', 9, 1),
(224, 'Bangalore Rural District', 9, 1),
(225, 'Bangalore Urban District', 9, 1),
(226, 'Chamarajnagar', 9, 1),
(227, 'Chikmagalur', 9, 1),
(228, 'Chitradurga', 9, 1),
(229, 'Davanagere', 9, 1),
(230, 'Dharwad', 9, 1),
(231, 'Dakshina Kannada', 9, 1),
(232, 'Gadag', 9, 1),
(233, 'Gulbarga', 9, 1),
(234, 'Hassan', 9, 1),
(235, 'Haveri District', 9, 1),
(236, 'Kodagu', 9, 1),
(237, 'Kolar', 9, 1),
(238, 'Koppal', 9, 1),
(239, 'Mandya', 9, 1),
(240, 'Mysore', 9, 1),
(241, 'Raichur', 9, 1),
(242, 'Shimoga', 9, 1),
(243, 'Tumkur', 9, 1),
(244, 'Udupi', 9, 1),
(245, 'Uttara Kannada', 9, 1),
(246, 'Ramanagara', 9, 1),
(247, 'Chikballapur', 9, 1),
(248, 'Yadagiri', 9, 1),
(249, 'Alappuzha', 10, 1),
(250, 'Ernakulam', 10, 1),
(251, 'Idukki', 10, 1),
(252, 'Kollam', 10, 1),
(253, 'Kannur', 10, 1),
(254, 'Kasaragod', 10, 1),
(255, 'Kottayam', 10, 1),
(256, 'Kozhikode', 10, 1),
(257, 'Malappuram', 10, 1),
(258, 'Palakkad', 10, 1),
(259, 'Pathanamthitta', 10, 1),
(260, 'Thrissur', 10, 1),
(261, 'Thiruvananthapuram', 10, 1),
(262, 'Wayanad', 10, 1),
(263, 'Alirajpur', 11, 1),
(264, 'Anuppur', 11, 1),
(265, 'Ashok Nagar', 11, 1),
(266, 'Balaghat', 11, 1),
(267, 'Barwani', 11, 1),
(268, 'Betul', 11, 1),
(269, 'Bhind', 11, 1),
(270, 'Bhopal', 11, 1),
(271, 'Burhanpur', 11, 1),
(272, 'Chhatarpur', 11, 1),
(273, 'Chhindwara', 11, 1),
(274, 'Damoh', 11, 1),
(275, 'Datia', 11, 1),
(276, 'Dewas', 11, 1),
(277, 'Dhar', 11, 1),
(278, 'Dindori', 11, 1),
(279, 'Guna', 11, 1),
(280, 'Gwalior', 11, 1),
(281, 'Harda', 11, 1),
(282, 'Hoshangabad', 11, 1),
(283, 'Indore', 11, 1),
(284, 'Jabalpur', 11, 1),
(285, 'Jhabua', 11, 1),
(286, 'Katni', 11, 1),
(287, 'Khandwa', 11, 1),
(288, 'Khargone', 11, 1),
(289, 'Mandla', 11, 1),
(290, 'Mandsaur', 11, 1),
(291, 'Morena', 11, 1),
(292, 'Narsinghpur', 11, 1),
(293, 'Neemuch', 11, 1),
(294, 'Panna', 11, 1),
(295, 'Rewa', 11, 1),
(296, 'Rajgarh', 11, 1),
(297, 'Ratlam', 11, 1),
(298, 'Raisen', 11, 1),
(299, 'Sagar', 11, 1),
(300, 'Satna', 11, 1),
(301, 'Sehore', 11, 1),
(302, 'Seoni', 11, 1),
(303, 'Shahdol', 11, 1),
(304, 'Shajapur', 11, 1),
(305, 'Sheopur', 11, 1),
(306, 'Shivpuri', 11, 1),
(307, 'Sidhi', 11, 1),
(308, 'Singrauli', 11, 1),
(309, 'Tikamgarh', 11, 1),
(310, 'Ujjain', 11, 1),
(311, 'Umaria', 11, 1),
(312, 'Vidisha', 11, 1),
(313, 'Ahmednagar', 12, 1),
(314, 'Akola', 12, 1),
(315, 'Amrawati', 12, 1),
(316, 'Aurangabad', 12, 1),
(317, 'Bhandara', 12, 1),
(318, 'Beed', 12, 1),
(319, 'Buldhana', 12, 1),
(320, 'Chandrapur', 12, 1),
(321, 'Dhule', 12, 1),
(322, 'Gadchiroli', 12, 1),
(323, 'Gondiya', 12, 1),
(324, 'Hingoli', 12, 1),
(325, 'Jalgaon', 12, 1),
(326, 'Jalna', 12, 1),
(327, 'Kolhapur', 12, 1),
(328, 'Latur', 12, 1),
(329, 'Mumbai City', 12, 1),
(330, 'Mumbai suburban', 12, 1),
(331, 'Nandurbar', 12, 1),
(332, 'Nanded', 12, 1),
(333, 'Nagpur', 12, 1),
(334, 'Nashik', 12, 1),
(335, 'Osmanabad', 12, 1),
(336, 'Parbhani', 12, 1),
(337, 'Pune', 12, 1),
(338, 'Raigad', 12, 1),
(339, 'Ratnagiri', 12, 1),
(340, 'Sindhudurg', 12, 1),
(341, 'Sangli', 12, 1),
(342, 'Solapur', 12, 1),
(343, 'Satara', 12, 1),
(344, 'Thane', 12, 1),
(345, 'Wardha', 12, 1),
(346, 'Washim', 12, 1),
(347, 'Yavatmal', 12, 1),
(348, 'Bishnupur', 13, 1),
(349, 'Churachandpur', 13, 1),
(350, 'Chandel', 13, 1),
(351, 'Imphal East', 13, 1),
(352, 'Senapati', 13, 1),
(353, 'Tamenglong', 13, 1),
(354, 'Thoubal', 13, 1),
(355, 'Ukhrul', 13, 1),
(356, 'Imphal West', 13, 1),
(357, 'East Garo Hills', 14, 1),
(358, 'East Khasi Hills', 14, 1),
(359, 'Jaintia Hills', 14, 1),
(360, 'Ri-Bhoi', 14, 1),
(361, 'South Garo Hills', 14, 1),
(362, 'West Garo Hills', 14, 1),
(363, 'West Khasi Hills', 14, 1),
(364, 'Aizawl', 15, 1),
(365, 'Champhai', 15, 1),
(366, 'Kolasib', 15, 1),
(367, 'Lawngtlai', 15, 1),
(368, 'Lunglei', 15, 1),
(369, 'Mamit', 15, 1),
(370, 'Saiha', 15, 1),
(371, 'Serchhip', 15, 1),
(372, 'Dimapur', 16, 1),
(373, 'Kohima', 16, 1),
(374, 'Mokokchung', 16, 1),
(375, 'Mon', 16, 1),
(376, 'Phek', 16, 1),
(377, 'Tuensang', 16, 1),
(378, 'Wokha', 16, 1),
(379, 'Zunheboto', 16, 1),
(380, 'Angul', 17, 1),
(381, 'Boudh', 17, 1),
(382, 'Bhadrak', 17, 1),
(383, 'Bolangir', 17, 1),
(384, 'Bargarh', 17, 1),
(385, 'Baleswar', 17, 1),
(386, 'Cuttack', 17, 1),
(387, 'Debagarh', 17, 1),
(388, 'Dhenkanal', 17, 1),
(389, 'Ganjam', 17, 1),
(390, 'Gajapati', 17, 1),
(391, 'Jharsuguda', 17, 1),
(392, 'Jajapur', 17, 1),
(393, 'Jagatsinghpur', 17, 1),
(394, 'Khordha', 17, 1),
(395, 'Kendujhar', 17, 1),
(396, 'Kalahandi', 17, 1),
(397, 'Kandhamal', 17, 1),
(398, 'Koraput', 17, 1),
(399, 'Kendrapara', 17, 1),
(400, 'Malkangiri', 17, 1),
(401, 'Mayurbhanj', 17, 1),
(402, 'Nabarangpur', 17, 1),
(403, 'Nuapada', 17, 1),
(404, 'Nayagarh', 17, 1),
(405, 'Puri', 17, 1),
(406, 'Rayagada', 17, 1),
(407, 'Sambalpur', 17, 1),
(408, 'Subarnapur', 17, 1),
(409, 'Sundargarh', 17, 1),
(410, 'Karaikal', 27, 1),
(411, 'Mahe', 27, 1),
(412, 'Puducherry', 27, 1),
(413, 'Yanam', 27, 1),
(414, 'Amritsar', 18, 1),
(415, 'Bathinda', 18, 1),
(416, 'Firozpur', 18, 1),
(417, 'Faridkot', 18, 1),
(418, 'Fatehgarh Sahib', 18, 1),
(419, 'Gurdaspur', 18, 1),
(420, 'Hoshiarpur', 18, 1),
(421, 'Jalandhar', 18, 1),
(422, 'Kapurthala', 18, 1),
(423, 'Ludhiana', 18, 1),
(424, 'Mansa', 18, 1),
(425, 'Moga', 18, 1),
(426, 'Mukatsar', 18, 1),
(427, 'Nawan Shehar', 18, 1),
(428, 'Patiala', 18, 1),
(429, 'Rupnagar', 18, 1),
(430, 'Sangrur', 18, 1),
(431, 'Ajmer', 19, 1),
(432, 'Alwar', 19, 1),
(433, 'Bikaner', 19, 1),
(434, 'Barmer', 19, 1),
(435, 'Banswara', 19, 1),
(436, 'Bharatpur', 19, 1),
(437, 'Baran', 19, 1),
(438, 'Bundi', 19, 1),
(439, 'Bhilwara', 19, 1),
(440, 'Churu', 19, 1),
(441, 'Chittorgarh', 19, 1),
(442, 'Dausa', 19, 1),
(443, 'Dholpur', 19, 1),
(444, 'Dungapur', 19, 1),
(445, 'Ganganagar', 19, 1),
(446, 'Hanumangarh', 19, 1),
(447, 'Juhnjhunun', 19, 1),
(448, 'Jalore', 19, 1),
(449, 'Jodhpur', 19, 1),
(450, 'Jaipur', 19, 1),
(451, 'Jaisalmer', 19, 1),
(452, 'Jhalawar', 19, 1),
(453, 'Karauli', 19, 1),
(454, 'Kota', 19, 1),
(455, 'Nagaur', 19, 1),
(456, 'Pali', 19, 1),
(457, 'Pratapgarh', 19, 1),
(458, 'Rajsamand', 19, 1),
(459, 'Sikar', 19, 1),
(460, 'Sawai Madhopur', 19, 1),
(461, 'Sirohi', 19, 1),
(462, 'Tonk', 19, 1),
(463, 'Udaipur', 19, 1),
(464, 'East Sikkim', 20, 1),
(465, 'North Sikkim', 20, 1),
(466, 'South Sikkim', 20, 1),
(467, 'West Sikkim', 20, 1),
(468, 'Ariyalur', 21, 1),
(469, 'Chennai', 21, 1),
(470, 'Coimbatore', 21, 1),
(471, 'Cuddalore', 21, 1),
(472, 'Dharmapuri', 21, 1),
(473, 'Dindigul', 21, 1),
(474, 'Erode', 21, 1),
(475, 'Kanchipuram', 21, 1),
(476, 'Kanyakumari', 21, 1),
(477, 'Karur', 21, 1),
(478, 'Madurai', 21, 1),
(479, 'Nagapattinam', 21, 1),
(480, 'The Nilgiris', 21, 1),
(481, 'Namakkal', 21, 1),
(482, 'Perambalur', 21, 1),
(483, 'Pudukkottai', 21, 1),
(484, 'Ramanathapuram', 21, 1),
(485, 'Salem', 21, 1),
(486, 'Sivagangai', 21, 1),
(487, 'Tiruppur', 21, 1),
(488, 'Tiruchirappalli', 21, 1),
(489, 'Theni', 21, 1),
(490, 'Tirunelveli', 21, 1),
(491, 'Thanjavur', 21, 1),
(492, 'Thoothukudi', 21, 1),
(493, 'Thiruvallur', 21, 1),
(494, 'Thiruvarur', 21, 1),
(495, 'Tiruvannamalai', 21, 1),
(496, 'Vellore', 21, 1),
(497, 'Villupuram', 21, 1),
(498, 'Dhalai', 22, 1),
(499, 'North Tripura', 22, 1),
(500, 'South Tripura', 22, 1),
(501, 'West Tripura', 22, 1),
(502, 'Almora', 33, 1),
(503, 'Bageshwar', 33, 1),
(504, 'Chamoli', 33, 1),
(505, 'Champawat', 33, 1),
(506, 'Dehradun', 33, 1),
(507, 'Haridwar', 33, 1),
(508, 'Nainital', 33, 1),
(509, 'Pauri Garhwal', 33, 1),
(510, 'Pithoragharh', 33, 1),
(511, 'Rudraprayag', 33, 1),
(512, 'Tehri Garhwal', 33, 1),
(513, 'Udham Singh Nagar', 33, 1),
(514, 'Uttarkashi', 33, 1),
(515, 'Agra', 23, 1),
(516, 'Allahabad', 23, 1),
(517, 'Aligarh', 23, 1),
(518, 'Ambedkar Nagar', 23, 1),
(519, 'Auraiya', 23, 1),
(520, 'Azamgarh', 23, 1),
(521, 'Barabanki', 23, 1),
(522, 'Badaun', 23, 1),
(523, 'Bagpat', 23, 1),
(524, 'Bahraich', 23, 1),
(525, 'Bijnor', 23, 1),
(526, 'Ballia', 23, 1),
(527, 'Banda', 23, 1),
(528, 'Balrampur', 23, 1),
(529, 'Bareilly', 23, 1),
(530, 'Basti', 23, 1),
(531, 'Bulandshahr', 23, 1),
(532, 'Chandauli', 23, 1),
(533, 'Chitrakoot', 23, 1),
(534, 'Deoria', 23, 1),
(535, 'Etah', 23, 1),
(536, 'Kanshiram Nagar', 23, 1),
(537, 'Etawah', 23, 1),
(538, 'Firozabad', 23, 1),
(539, 'Farrukhabad', 23, 1),
(540, 'Fatehpur', 23, 1),
(541, 'Faizabad', 23, 1),
(542, 'Gautam Buddha Nagar', 23, 1),
(543, 'Gonda', 23, 1),
(544, 'Ghazipur', 23, 1),
(545, 'Gorkakhpur', 23, 1),
(546, 'Ghaziabad', 23, 1),
(547, 'Hamirpur', 23, 1),
(548, 'Hardoi', 23, 1),
(549, 'Mahamaya Nagar', 23, 1),
(550, 'Jhansi', 23, 1),
(551, 'Jalaun', 23, 1),
(552, 'Jyotiba Phule Nagar', 23, 1),
(553, 'Jaunpur District', 23, 1),
(554, 'Kanpur Dehat', 23, 1),
(555, 'Kannauj', 23, 1),
(556, 'Kanpur Nagar', 23, 1),
(557, 'Kaushambi', 23, 1),
(558, 'Kushinagar', 23, 1),
(559, 'Lalitpur', 23, 1),
(560, 'Lakhimpur Kheri', 23, 1),
(561, 'Lucknow', 23, 1),
(562, 'Mau', 23, 1),
(563, 'Meerut', 23, 1),
(564, 'Maharajganj', 23, 1),
(565, 'Mahoba', 23, 1),
(566, 'Mirzapur', 23, 1),
(567, 'Moradabad', 23, 1),
(568, 'Mainpuri', 23, 1),
(569, 'Mathura', 23, 1),
(570, 'Muzaffarnagar', 23, 1),
(571, 'Pilibhit', 23, 1),
(572, 'Pratapgarh', 23, 1),
(573, 'Rampur', 23, 1),
(574, 'Rae Bareli', 23, 1),
(575, 'Saharanpur', 23, 1),
(576, 'Sitapur', 23, 1),
(577, 'Shahjahanpur', 23, 1),
(578, 'Sant Kabir Nagar', 23, 1),
(579, 'Siddharthnagar', 23, 1),
(580, 'Sonbhadra', 23, 1),
(581, 'Sant Ravidas Nagar', 23, 1),
(582, 'Sultanpur', 23, 1),
(583, 'Shravasti', 23, 1),
(584, 'Unnao', 23, 1),
(585, 'Varanasi', 23, 1),
(586, 'Birbhum', 24, 1),
(587, 'Bankura', 24, 1),
(588, 'Bardhaman', 24, 1),
(589, 'Darjeeling', 24, 1),
(590, 'Dakshin Dinajpur', 24, 1),
(591, 'Hooghly', 24, 1),
(592, 'Howrah', 24, 1),
(593, 'Jalpaiguri', 24, 1),
(594, 'Cooch Behar', 24, 1),
(595, 'Kolkata', 24, 1),
(596, 'Malda', 24, 1),
(597, 'Midnapore', 24, 1),
(598, 'Murshidabad', 24, 1),
(599, 'Nadia', 24, 1),
(600, 'North 24 Parganas', 24, 1),
(601, 'South 24 Parganas', 24, 1),
(602, 'Purulia', 24, 1),
(603, 'Uttar Dinajpur', 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_department_tbl`
--

CREATE TABLE `master_department_tbl` (
  `m_dept_id` bigint(11) NOT NULL,
  `m_dept_type` tinyint(2) NOT NULL COMMENT '1-department ,2-designation,3-salary details,4-shift_roster,5-rolls',
  `m_dept_name` varchar(250) NOT NULL,
  `m_dept_code` varchar(100) NOT NULL,
  `m_dept_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0- inactive , 1-active',
  `m_start_time` time NOT NULL,
  `m_end_time` time NOT NULL,
  `m_dept_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `master_department_tbl`
--

INSERT INTO `master_department_tbl` (`m_dept_id`, `m_dept_type`, `m_dept_name`, `m_dept_code`, `m_dept_status`, `m_start_time`, `m_end_time`, `m_dept_added_on`) VALUES
(3, 1, 'rwsr23', 'www23', 1, '00:00:00', '00:00:00', '2025-01-26 18:39:00'),
(4, 1, 'test', '1234', 1, '00:00:00', '00:00:00', '2025-01-26 18:40:00'),
(5, 2, '3edds', 'desg', 1, '00:00:00', '00:00:00', '2025-01-26 18:40:00'),
(6, 2, 'tesgdg', 'test3', 1, '00:00:00', '00:00:00', '2025-01-26 18:40:00'),
(10, 1, 'sdf', 'dffhg', 1, '00:00:00', '00:00:00', '2025-02-03 14:32:00'),
(12, 3, 'Basic', 'addon', 1, '00:00:00', '00:00:00', '2025-02-03 15:57:00'),
(13, 3, 'PF', 'deduction', 1, '00:00:00', '00:00:00', '2025-01-31 21:00:00'),
(14, 3, 'performance ', 'addon', 1, '00:00:00', '00:00:00', '2025-02-01 22:07:00'),
(15, 4, 'day shift1', '', 1, '05:00:00', '10:02:00', '2025-02-03 16:29:00'),
(16, 2, 'dsf', 'sd', 1, '00:00:00', '00:00:00', '2025-02-26 15:07:00'),
(17, 5, 'customer', '1', 1, '00:00:00', '00:00:00', '2025-02-27 14:13:00'),
(18, 5, 'user', '2', 1, '00:00:00', '00:00:00', '2025-02-26 15:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_employee_tbl`
--

CREATE TABLE `master_employee_tbl` (
  `m_emp_id` bigint(20) NOT NULL,
  `m_emp_code` varchar(50) NOT NULL,
  `m_login_type` int(11) NOT NULL COMMENT '1-admin,2-user',
  `m_emp_name` varchar(200) NOT NULL,
  `m_emp_fhname` varchar(200) NOT NULL,
  `m_emp_email` varchar(200) NOT NULL,
  `m_emp_pic` varchar(200) NOT NULL,
  `m_emp_altemail` varchar(100) NOT NULL,
  `m_emp_laddress` text NOT NULL,
  `m_emp_paddress` text NOT NULL,
  `m_emp_mobile` bigint(20) NOT NULL,
  `m_emp_altmobile` bigint(20) NOT NULL,
  `m_emp_dept` int(11) NOT NULL,
  `m_emp_design` int(11) NOT NULL,
  `m_emp_salmode` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-Cash , 2- Bank Amount',
  `m_emp_store` bigint(20) NOT NULL,
  `m_emp_roll` bigint(20) NOT NULL,
  `m_emp_dob` date NOT NULL,
  `m_emp_doj` date NOT NULL,
  `m_emp_dol` date NOT NULL,
  `m_emp_monthly` varchar(200) NOT NULL,
  `m_emp_yearly` varchar(200) NOT NULL,
  `m_emp_dshift` bigint(20) NOT NULL,
  `m_emp_dtype` varchar(100) NOT NULL,
  `m_emp_rest` varchar(50) NOT NULL,
  `m_emp_salary` decimal(10,0) NOT NULL,
  `m_emp_uanno` varchar(50) NOT NULL,
  `m_emp_gross` varchar(100) NOT NULL,
  `m_emp_panno` varchar(50) NOT NULL,
  `m_emp_adharno` bigint(20) NOT NULL,
  `m_emp_accno` bigint(20) NOT NULL,
  `m_emp_bankbranch` varchar(100) NOT NULL,
  `m_emp_bankname` varchar(200) NOT NULL,
  `m_emp_ifsc` varchar(50) NOT NULL,
  `m_emp_prev_empr` varchar(100) NOT NULL,
  `m_emp_prev_dept` varchar(100) NOT NULL,
  `m_emp_prev_design` varchar(100) NOT NULL,
  `m_emp_prev_duration` varchar(50) NOT NULL,
  `m_emp_password` varchar(50) NOT NULL,
  `m_emp_qualification` text NOT NULL,
  `m_emp_epfno` varchar(50) NOT NULL,
  `m_emp_esicno` varchar(50) NOT NULL,
  `m_emp_login_type` tinyint(1) NOT NULL COMMENT '1- security, 2- counter , 3- PRO(leads)',
  `is_tds_applicable` tinyint(1) NOT NULL COMMENT '0- no , 1- yes',
  `is_esic_applicable` tinyint(1) NOT NULL COMMENT '0- no , 1- yes',
  `is_epf_applicable` tinyint(1) NOT NULL COMMENT '0- no , 1- yes',
  `m_emp_status` int(11) NOT NULL COMMENT '1-active, 2- inactive',
  `m_emp_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `master_employee_tbl`
--

INSERT INTO `master_employee_tbl` (`m_emp_id`, `m_emp_code`, `m_login_type`, `m_emp_name`, `m_emp_fhname`, `m_emp_email`, `m_emp_pic`, `m_emp_altemail`, `m_emp_laddress`, `m_emp_paddress`, `m_emp_mobile`, `m_emp_altmobile`, `m_emp_dept`, `m_emp_design`, `m_emp_salmode`, `m_emp_store`, `m_emp_roll`, `m_emp_dob`, `m_emp_doj`, `m_emp_dol`, `m_emp_monthly`, `m_emp_yearly`, `m_emp_dshift`, `m_emp_dtype`, `m_emp_rest`, `m_emp_salary`, `m_emp_uanno`, `m_emp_gross`, `m_emp_panno`, `m_emp_adharno`, `m_emp_accno`, `m_emp_bankbranch`, `m_emp_bankname`, `m_emp_ifsc`, `m_emp_prev_empr`, `m_emp_prev_dept`, `m_emp_prev_design`, `m_emp_prev_duration`, `m_emp_password`, `m_emp_qualification`, `m_emp_epfno`, `m_emp_esicno`, `m_emp_login_type`, `is_tds_applicable`, `is_esic_applicable`, `is_epf_applicable`, `m_emp_status`, `m_emp_added_on`) VALUES
(1, '123', 1, 'admin', 'abc', 'admin@gmail.com', '', '', 'bhilai', 'bk', 1234567890, 987654321, 3, 5, 0, 2, 17, '2010-01-31', '2025-01-06', '0000-00-00', '', '', 0, 'Fix (Office time)', 'none', 9000, '', '10000.00', '', 0, 0, '', '', '', '', '', '', '', '12345', '', '', '', 1, 0, 0, 0, 1, '2025-02-05 15:53:00'),
(2, '1234', 2, 'sona', 'demo', 'sona@gmail.com', '', '', ' ', ' ', 1234567890, 987654321, 3, 5, 0, 2, 18, '2010-02-01', '2025-02-04', '0000-00-00', '2', '12', 15, 'Fix (Office time)', 'none', 4000, '', '4000.00', '', 0, 0, '', '', '', '', '', '', '', '12345', ' ', '', '', 1, 0, 0, 0, 1, '2025-02-26 15:47:00'),
(3, 'sdf', 2, 'jeni', 'jsadgh', 'demo@gmail.com', '', '', ' ', ' ', 8999999999, 8777777777, 3, 5, 0, 2, 18, '2010-02-02', '2025-02-03', '0000-00-00', '', '', 15, 'Fix (Office time)', 'none', 9000, '', '10000.00', '', 0, 0, '', '', '', '', '', '', '', '12345', ' ', '', '', 1, 0, 0, 0, 1, '2025-02-27 12:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_emp_attendance`
--

CREATE TABLE `master_emp_attendance` (
  `m_std_id` int(11) NOT NULL,
  `m_emp_id` bigint(20) NOT NULL,
  `m_time_in` time NOT NULL,
  `m_time_out` time NOT NULL,
  `m_updated_by` datetime NOT NULL,
  `m_updated_on` datetime NOT NULL,
  `m_remark` varchar(100) NOT NULL,
  `m_status` bigint(20) NOT NULL,
  `m_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_emp_attendance`
--

INSERT INTO `master_emp_attendance` (`m_std_id`, `m_emp_id`, `m_time_in`, `m_time_out`, `m_updated_by`, `m_updated_on`, `m_remark`, `m_status`, `m_date`) VALUES
(6, 1, '15:10:19', '15:10:36', '2025-02-05 15:10:19', '2025-02-05 15:10:36', '', 1, '2025-02-05'),
(7, 1, '16:35:24', '16:35:42', '2025-02-06 16:35:24', '2025-02-06 16:35:42', '', 1, '2025-02-06'),
(8, 2, '12:46:18', '12:46:51', '2025-02-07 12:46:18', '2025-02-07 12:46:51', '', 1, '2025-02-07'),
(9, 1, '15:00:28', '15:35:18', '2025-02-07 15:00:28', '2025-02-07 15:35:18', '', 1, '2025-02-07'),
(10, 1, '11:59:13', '15:17:33', '2025-02-11 11:59:13', '2025-02-11 15:17:33', '', 1, '2025-02-11'),
(11, 3, '22:32:37', '22:32:59', '2025-02-11 22:32:37', '2025-02-11 22:32:59', '', 1, '2025-02-11'),
(12, 1, '12:42:21', '12:42:31', '2025-02-12 12:42:21', '2025-02-12 12:42:31', '', 1, '2025-02-12'),
(13, 1, '14:05:21', '00:00:00', '2025-02-18 14:05:21', '0000-00-00 00:00:00', '', 0, '2025-02-18'),
(14, 1, '12:25:36', '14:28:34', '2025-02-21 12:25:36', '2025-02-21 14:28:34', '', 1, '2025-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `master_emp_salary_breakup`
--

CREATE TABLE `master_emp_salary_breakup` (
  `m_esalary_id` int(11) NOT NULL,
  `m_empid` bigint(20) NOT NULL,
  `m_sbreakup_id` bigint(20) NOT NULL,
  `m_amount` double NOT NULL,
  `m_type` int(11) NOT NULL,
  `m_amounttype` int(11) NOT NULL,
  `m_status` int(11) NOT NULL,
  `m_addedon` datetime NOT NULL,
  `m_addedby` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_emp_salary_breakup`
--

INSERT INTO `master_emp_salary_breakup` (`m_esalary_id`, `m_empid`, `m_sbreakup_id`, `m_amount`, `m_type`, `m_amounttype`, `m_status`, `m_addedon`, `m_addedby`) VALUES
(63, 21, 12, 10005, 0, 2, 1, '2025-01-31 17:41:00', '2025-01-31 12:11:35'),
(64, 21, 12, 20005, 0, 2, 1, '2025-01-31 17:41:00', '2025-01-31 12:11:35'),
(65, 21, 12, 522, 0, 2, 1, '2025-01-31 17:41:00', '2025-01-31 12:11:35'),
(72, 23, 12, 34343, 0, 1, 1, '2025-01-31 21:42:00', '2025-01-31 16:12:23'),
(73, 23, 12, 1000, 0, 2, 1, '2025-01-31 21:42:00', '2025-01-31 16:12:23'),
(74, 22, 12, 33344, 0, 1, 1, '2025-02-01 12:34:00', '2025-02-01 07:04:50'),
(75, 22, 12, 5555, 0, 1, 1, '2025-02-01 12:34:00', '2025-02-01 07:04:50'),
(84, 24, 12, 34, 0, 1, 1, '2025-02-01 13:58:00', '2025-02-01 08:28:43'),
(85, 24, 12, 123, 0, 1, 1, '2025-02-01 13:58:00', '2025-02-01 08:28:43'),
(86, 24, 13, 1250, 0, 2, 1, '2025-02-01 13:58:00', '2025-02-01 08:28:43'),
(105, 26, 12, 8000, 0, 1, 1, '2025-02-02 14:02:00', '2025-02-02 08:32:12'),
(106, 26, 12, 1000, 0, 1, 1, '2025-02-02 14:02:00', '2025-02-02 08:32:12'),
(107, 26, 13, 1000, 0, 2, 1, '2025-02-02 14:02:00', '2025-02-02 08:32:12'),
(114, 1, 12, 8000, 0, 1, 1, '2025-02-05 15:53:00', '2025-02-05 10:23:43'),
(115, 1, 12, 1000, 0, 1, 1, '2025-02-05 15:53:00', '2025-02-05 10:23:43'),
(116, 1, 13, 1000, 0, 2, 1, '2025-02-05 15:53:00', '2025-02-05 10:23:43'),
(148, 2, 12, 2000, 0, 1, 1, '2025-02-26 15:47:00', '2025-02-26 10:17:59'),
(149, 2, 12, 2000, 0, 1, 1, '2025-02-26 15:47:00', '2025-02-26 10:17:59'),
(150, 3, 12, 8000, 0, 1, 1, '2025-02-27 12:30:00', '2025-02-27 07:00:07'),
(151, 3, 12, 1000, 0, 1, 1, '2025-02-27 12:30:00', '2025-02-27 07:00:07'),
(152, 3, 13, 1000, 0, 2, 1, '2025-02-27 12:30:00', '2025-02-27 07:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `master_expense_tbl`
--

CREATE TABLE `master_expense_tbl` (
  `m_expense_id` bigint(20) NOT NULL,
  `m_expense_mode` tinyint(1) NOT NULL COMMENT '1- expense , 2- jounal',
  `m_expense_cat` int(11) NOT NULL COMMENT 'master_prodcategory_table se',
  `m_expense_company` varchar(50) NOT NULL,
  `m_expense_date` date NOT NULL,
  `m_expense_voucherno` varchar(50) NOT NULL,
  `m_expense_act` int(11) NOT NULL COMMENT 'master_cassaccout_tbl se',
  `m_expense_amt` decimal(10,0) NOT NULL,
  `m_expense_dept` int(11) NOT NULL COMMENT 'master_department_tbl se',
  `m_expense_remark` text NOT NULL,
  `m_expense_file` text NOT NULL,
  `m_expense_narration` text NOT NULL,
  `m_expense_status` tinyint(1) NOT NULL COMMENT '0-inactive , 1- active',
  `m_expense_resp` bigint(20) NOT NULL COMMENT 'master_employee_tbl se',
  `m_expense_updatedon` datetime NOT NULL,
  `m_expense_updatedby` int(11) NOT NULL,
  `m_expense_addedby` int(11) NOT NULL,
  `m_expense_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_holiday_tbl`
--

CREATE TABLE `master_holiday_tbl` (
  `m_hol_id` int(11) NOT NULL,
  `m_hol_date` date NOT NULL,
  `m_hol_name` varchar(200) NOT NULL,
  `m_hol_status` int(11) NOT NULL,
  `m_hol_addedon` datetime NOT NULL,
  `m_hol_updatedby` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_holiday_tbl`
--

INSERT INTO `master_holiday_tbl` (`m_hol_id`, `m_hol_date`, `m_hol_name`, `m_hol_status`, `m_hol_addedon`, `m_hol_updatedby`) VALUES
(1, '2025-02-03', 'holi', 1, '2025-02-05 15:21:00', '2025-02-05 09:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `master_increaments_tbl`
--

CREATE TABLE `master_increaments_tbl` (
  `m_incrmt_id` bigint(20) NOT NULL,
  `m_incrmt_empid` bigint(20) NOT NULL COMMENT 'master employee tbl se',
  `m_incrmt_strdate` date NOT NULL,
  `m_incrmt_amt` decimal(10,0) NOT NULL,
  `m_incrmt_remarks` text NOT NULL,
  `m_incrmt_design` int(11) NOT NULL,
  `m_old_designation` int(11) NOT NULL,
  `m_old_gross` decimal(10,0) NOT NULL,
  `m_new_gross` decimal(10,0) NOT NULL,
  `m_incrmt_status` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_incrmt_addedon` datetime NOT NULL,
  `m_incrmt_by` bigint(20) NOT NULL COMMENT 'master_emp_tbl'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_leaves_tbl`
--

CREATE TABLE `master_leaves_tbl` (
  `m_leav_id` int(11) NOT NULL,
  `m_leav_empname` bigint(20) NOT NULL,
  `m_leav_date` date NOT NULL,
  `m_leav_type` int(11) NOT NULL,
  `m_leav_duration` int(11) NOT NULL COMMENT '1-full_day,2-multiple,3-first_half,4-second_half',
  `m_leav_fromdate` date NOT NULL,
  `m_leav_todate` date NOT NULL,
  `m_leav_absence` varchar(200) NOT NULL,
  `m_leav_imgfile` varchar(255) NOT NULL,
  `m_leav_status` int(11) NOT NULL,
  `m_leav_addedon` datetime NOT NULL,
  `m_leav_updatedby` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `master_nh_tbl`
--

CREATE TABLE `master_nh_tbl` (
  `m_nh_id` bigint(11) NOT NULL,
  `m_nh_name` varchar(250) NOT NULL,
  `m_nh_dayid` tinyint(4) NOT NULL,
  `m_nh_monthid` tinyint(4) NOT NULL,
  `m_nh_yearid` smallint(6) NOT NULL,
  `m_nh_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0- inactive , 1-active',
  `m_nh_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_notification_tbl`
--

CREATE TABLE `master_notification_tbl` (
  `notification_id` int(11) NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `notification_msg` text NOT NULL,
  `notification_date` date NOT NULL,
  `notification_for` int(11) NOT NULL,
  `notification_image` varchar(255) NOT NULL,
  `notification_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_payment_tbl`
--

CREATE TABLE `master_payment_tbl` (
  `m_payment_id` bigint(20) NOT NULL,
  `m_payment_mode` tinyint(1) NOT NULL COMMENT '1- payment , 2- receipt',
  `m_payment_plotid` int(11) NOT NULL COMMENT 'master_plot_table se',
  `m_payment_company` varchar(50) NOT NULL,
  `m_payment_date` date NOT NULL,
  `m_payment_voucherno` varchar(50) NOT NULL,
  `m_payment_type` tinyint(1) NOT NULL COMMENT '1-debt, 2-credit',
  `m_payment_amount` decimal(10,0) NOT NULL,
  `dollar_exchng_rt` decimal(10,0) NOT NULL,
  `is_dollar` tinyint(1) NOT NULL COMMENT '0-no 1- yes',
  `m_payment_narration` text NOT NULL,
  `m_payment_status` tinyint(1) NOT NULL COMMENT '0-inactive , 1- active',
  `m_payment_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_permission_tbl`
--

CREATE TABLE `master_permission_tbl` (
  `m_perm_id` bigint(11) NOT NULL,
  `m_perm_name` varchar(250) NOT NULL,
  `m_perm_module` varchar(100) NOT NULL,
  `m_perm_module_slug` varchar(50) NOT NULL,
  `m_perm_submodule_slug` varchar(50) NOT NULL,
  `m_perm_type` varchar(200) NOT NULL,
  `m_perm_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0- inactive , 1-active',
  `m_perm_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `master_permission_tbl`
--

INSERT INTO `master_permission_tbl` (`m_perm_id`, `m_perm_name`, `m_perm_module`, `m_perm_module_slug`, `m_perm_submodule_slug`, `m_perm_type`, `m_perm_status`, `m_perm_added_on`) VALUES
(1, 'DEPARTMENT', 'HR', 'HR', 'DPT', '', 1, '2025-02-14 14:28:36'),
(2, 'DESIGNATION', 'HR', 'HR', 'DGN', '', 1, '2025-02-14 14:29:02'),
(3, 'SHIFT ROSTER', 'HR', 'HR', 'SFTR', '', 1, '2025-02-14 13:04:36'),
(4, 'HOLIDAYS', 'HR', 'HR', 'HLD', '', 1, '2025-02-14 13:05:18'),
(5, 'STORES/FACTORY', 'HR', 'HR', 'STRFCT', '', 1, '2025-02-14 13:06:10'),
(6, 'LEAVES', 'HR', 'HR', 'LVS', '', 1, '2025-02-14 13:07:02'),
(7, 'EMPLOYEES', 'HR', 'HR', 'EMP', '', 1, '2025-02-14 13:07:34'),
(8, 'PRODUCT', 'PRODUCT', 'PDT', 'PDT', '', 1, '2025-02-14 13:08:57'),
(9, 'CATEGORY', 'PRODUCT', 'PDT', 'CTG', '', 1, '2025-02-14 13:09:31'),
(10, 'SUB CATEGORY', 'PRODUCT', 'PDT', 'SCTG', '', 1, '2025-02-14 13:10:13'),
(11, 'PRODUCT PACKAGE', 'PRODUCT', 'PDT', 'PDTPACK', '', 1, '2025-02-14 13:12:27'),
(12, 'PRODUCT SIZE', 'PRODUCT', 'PDT', 'PDTSIZE', '', 1, '2025-02-14 13:13:19'),
(13, 'PRODUCT BRAND', 'PRODUCT', 'PDT', 'PDTBRAND', '', 1, '2025-02-14 13:13:50'),
(14, 'ADD SALARY', 'FINANCE', 'FNC', 'ASLR', '', 1, '2025-02-14 13:15:04'),
(15, 'EMPLOYEES SALARY', 'FINANCE', 'FNC', 'EMPSLR', '', 1, '2025-02-14 13:15:58'),
(16, 'EMP ATTENDANCE REPORT', 'FINANCE', 'FNC', 'EMPAR', '', 1, '2025-02-14 13:17:21'),
(17, 'STATE', 'MASTER', 'MST', 'ST', '', 1, '2025-02-14 13:18:10'),
(18, 'CITY', 'MASTER', 'MST', 'CT', '', 1, '2025-02-14 13:18:29'),
(19, 'PERMISSION', 'MASTER', 'MST', 'PRM', '', 1, '2025-02-14 13:19:06'),
(20, 'SALARY BREAKUP', 'MASTER', 'MST', 'SBRK', '', 1, '2025-02-14 14:57:58'),
(21, 'ROLLS', 'HR', 'HR', 'RLS', '', 1, '2025-02-27 15:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `master_product_tbl`
--

CREATE TABLE `master_product_tbl` (
  `m_pro_id` int(11) NOT NULL,
  `m_pro_name` varchar(200) NOT NULL,
  `m_pro_cate` bigint(20) NOT NULL,
  `m_pro_subcate` bigint(20) NOT NULL,
  `m_pro_pack` bigint(20) NOT NULL,
  `m_pro_size` bigint(20) NOT NULL,
  `m_pro_brand` bigint(20) NOT NULL,
  `m_pro_pic` varchar(255) NOT NULL,
  `m_pro_price` double NOT NULL,
  `m_pro_desc` varchar(255) NOT NULL,
  `m_pro_status` int(11) NOT NULL,
  `m_pro_addedon` datetime NOT NULL,
  `m_pro_updatedby` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_product_tbl`
--

INSERT INTO `master_product_tbl` (`m_pro_id`, `m_pro_name`, `m_pro_cate`, `m_pro_subcate`, `m_pro_pack`, `m_pro_size`, `m_pro_brand`, `m_pro_pic`, `m_pro_price`, `m_pro_desc`, `m_pro_status`, `m_pro_addedon`, `m_pro_updatedby`) VALUES
(1, 'pro1', 3, 6, 8, 9, 10, '', 1, 'te', 1, '2025-02-12 16:46:00', '2025-02-12 11:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `master_salaryinst_tbl`
--

CREATE TABLE `master_salaryinst_tbl` (
  `m_salinst_id` bigint(20) NOT NULL,
  `m_salinst_empid` bigint(20) NOT NULL COMMENT 'master employee tbl se',
  `m_salinst_date` date NOT NULL,
  `m_salinst_totaldays` tinyint(2) NOT NULL,
  `m_salinst_prdays` tinyint(2) NOT NULL,
  `m_salinst_lvdays` tinyint(2) NOT NULL,
  `m_salinst_salary` double NOT NULL,
  `m_salinst_absent` int(11) NOT NULL,
  `m_salinst_payable` decimal(10,0) NOT NULL,
  `m_salinst_remarks` text NOT NULL,
  `m_salinst_status` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_salinst_addedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `master_salaryinst_tbl`
--

INSERT INTO `master_salaryinst_tbl` (`m_salinst_id`, `m_salinst_empid`, `m_salinst_date`, `m_salinst_totaldays`, `m_salinst_prdays`, `m_salinst_lvdays`, `m_salinst_salary`, `m_salinst_absent`, `m_salinst_payable`, `m_salinst_remarks`, `m_salinst_status`, `m_salinst_addedon`) VALUES
(1, 1, '2025-02-11', 28, 20, 2, 9000, 6, 6429, '', 1, '0000-00-00 00:00:00'),
(2, 2, '2025-02-11', 28, 25, 1, 4000, 2, 3571, '', 1, '0000-00-00 00:00:00'),
(3, 3, '2025-02-11', 28, 20, 2, 9000, 6, 6429, '', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_state_tbl`
--

CREATE TABLE `master_state_tbl` (
  `m_state_id` int(11) NOT NULL,
  `m_state_name` varchar(50) NOT NULL,
  `m_state_country` int(11) NOT NULL,
  `m_state_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `master_state_tbl`
--

INSERT INTO `master_state_tbl` (`m_state_id`, `m_state_name`, `m_state_country`, `m_state_status`) VALUES
(1, 'ANDHRA PRADESH', 105, 1),
(2, 'ASSAM', 105, 1),
(3, 'ARUNACHAL PRADESH', 105, 1),
(4, 'BIHAR', 105, 1),
(5, 'GUJRAT', 105, 1),
(6, 'HARYANA', 105, 1),
(7, 'HIMACHAL PRADESH', 105, 1),
(8, 'JAMMU & KASHMIR', 105, 1),
(9, 'KARNATAKA', 105, 1),
(10, 'KERALA', 105, 1),
(11, 'MADHYA PRADESH', 105, 1),
(12, 'MAHARASHTRA', 105, 1),
(13, 'MANIPUR', 105, 1),
(14, 'MEGHALAYA', 105, 1),
(15, 'MIZORAM', 105, 1),
(16, 'NAGALAND', 105, 1),
(17, 'ORISSA', 105, 1),
(18, 'PUNJAB', 105, 1),
(19, 'RAJASTHAN', 105, 1),
(20, 'SIKKIM', 105, 1),
(21, 'TAMIL NADU', 105, 1),
(22, 'TRIPURA', 105, 1),
(23, 'UTTAR PRADESH', 105, 1),
(24, 'WEST BENGAL', 105, 1),
(25, 'DELHI', 105, 1),
(26, 'GOA', 105, 1),
(27, 'PONDICHERY', 105, 1),
(28, 'LAKSHDWEEP', 105, 1),
(29, 'DAMAN & DIU', 105, 1),
(30, 'DADRA & NAGAR', 105, 1),
(31, 'CHANDIGARH', 105, 1),
(32, 'ANDAMAN & NICOBAR', 105, 1),
(33, 'UTTARANCHAL', 105, 1),
(34, 'JHARKHAND', 105, 1),
(35, 'CHATTISGARH', 105, 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_store_tbl`
--

CREATE TABLE `master_store_tbl` (
  `m_str_id` int(11) NOT NULL,
  `m_str_name` varchar(200) NOT NULL,
  `m_str_code` varchar(150) NOT NULL,
  `m_str_opening_time` time NOT NULL,
  `m_str_closing_time` time NOT NULL,
  `m_str_manage_name` varchar(200) NOT NULL,
  `m_str_mobile` bigint(20) NOT NULL,
  `m_str_address` varchar(200) NOT NULL,
  `m_state` bigint(20) NOT NULL,
  `m_city` bigint(20) NOT NULL,
  `m_str_status` int(11) NOT NULL,
  `m_str_addedon` datetime NOT NULL,
  `m_str_updatedby` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `master_store_tbl`
--

INSERT INTO `master_store_tbl` (`m_str_id`, `m_str_name`, `m_str_code`, `m_str_opening_time`, `m_str_closing_time`, `m_str_manage_name`, `m_str_mobile`, `m_str_address`, `m_state`, `m_city`, `m_str_status`, `m_str_addedon`, `m_str_updatedby`) VALUES
(2, 'demo', '123', '05:24:00', '05:55:00', 'sqw', 4333333331, 'sdfdsjgj', 0, 0, 1, '2025-02-05 15:22:00', '2025-02-05 09:52:56'),
(3, 'test', '12', '02:25:00', '02:22:00', 'demo', 1234567890, 'hj', 0, 0, 1, '2025-02-05 15:49:00', '2025-02-05 10:19:13'),
(4, 'sdjh', '87', '02:05:00', '05:05:00', 'uwdy', 8778888888, 'uyg', 4, 63, 1, '2025-02-11 11:58:00', '2025-02-11 06:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `m_user_id` int(11) NOT NULL,
  `m_login_type` tinyint(10) NOT NULL COMMENT '1-admin,2-user, 3= branch',
  `m_user_branch` bigint(20) NOT NULL COMMENT 'master_affiliation_tbl se',
  `m_user_date` date NOT NULL,
  `m_user_name` varchar(250) NOT NULL,
  `m_user_joindate` date NOT NULL,
  `m_user_contact` varchar(20) NOT NULL,
  `m_user_experience` int(11) NOT NULL,
  `m_user_email` varchar(250) NOT NULL,
  `m_user_dob` date NOT NULL,
  `m_user_uname` varchar(255) NOT NULL,
  `m_user_password` varchar(255) NOT NULL,
  `m_user_gender` varchar(20) NOT NULL,
  `m_user_qualifiction` varchar(255) NOT NULL,
  `m_user_fname` varchar(255) NOT NULL,
  `m_user_mname` varchar(255) NOT NULL,
  `m_state_id` int(11) NOT NULL,
  `m_city_id` int(11) NOT NULL,
  `m_user_pincode` varchar(10) NOT NULL,
  `m_user_pic` varchar(255) NOT NULL,
  `m_user_resume` varchar(255) NOT NULL,
  `m_user_pan_no` varchar(30) NOT NULL,
  `m_user_pan_img` text NOT NULL,
  `m_user_aadhar_no` varchar(24) NOT NULL,
  `m_user_aadhar_frant_img` text NOT NULL,
  `m_user_aadhar_back_img` text NOT NULL,
  `m_user_status` int(11) NOT NULL DEFAULT 0,
  `m_user_address` text NOT NULL,
  `m_user_added_on` date NOT NULL,
  `m_user_deparment` varchar(255) NOT NULL,
  `m_user_designation` varchar(255) NOT NULL,
  `m_user_fb_link` varchar(100) NOT NULL,
  `m_user_tw_link` varchar(100) NOT NULL,
  `m_user_gl_link` varchar(100) NOT NULL,
  `m_user_insta_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`m_user_id`, `m_login_type`, `m_user_branch`, `m_user_date`, `m_user_name`, `m_user_joindate`, `m_user_contact`, `m_user_experience`, `m_user_email`, `m_user_dob`, `m_user_uname`, `m_user_password`, `m_user_gender`, `m_user_qualifiction`, `m_user_fname`, `m_user_mname`, `m_state_id`, `m_city_id`, `m_user_pincode`, `m_user_pic`, `m_user_resume`, `m_user_pan_no`, `m_user_pan_img`, `m_user_aadhar_no`, `m_user_aadhar_frant_img`, `m_user_aadhar_back_img`, `m_user_status`, `m_user_address`, `m_user_added_on`, `m_user_deparment`, `m_user_designation`, `m_user_fb_link`, `m_user_tw_link`, `m_user_gl_link`, `m_user_insta_link`) VALUES
(1, 1, 0, '2025-01-23', 'admin', '2025-01-23', '1234567890', 0, 'admin@gmail.com', '2025-01-23', 'admin@gmail.com', '12345', 'male', '', '', '', 1, 1, '123456', 'logo.png', '', '', '', '', '', '', 1, 'Naharu nagar bhilai', '0000-00-00', '1', '1', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_user_permission_tbl`
--

CREATE TABLE `master_user_permission_tbl` (
  `m_userperm_id` bigint(20) NOT NULL,
  `m_userperm_userId` bigint(20) NOT NULL,
  `m_userperm_permId` bigint(20) NOT NULL,
  `m_userperm_module` varchar(100) NOT NULL,
  `m_userperm_submodule` varchar(100) NOT NULL,
  `m_userperm_list` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_userperm_add` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_userperm_edit` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_userperm_delete` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_userperm_export` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_userperm_filter` tinyint(1) NOT NULL COMMENT '0-inactive 1- active',
  `m_userperm_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0- inactive , 1-active',
  `m_userperm_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `master_user_permission_tbl`
--

INSERT INTO `master_user_permission_tbl` (`m_userperm_id`, `m_userperm_userId`, `m_userperm_permId`, `m_userperm_module`, `m_userperm_submodule`, `m_userperm_list`, `m_userperm_add`, `m_userperm_edit`, `m_userperm_delete`, `m_userperm_export`, `m_userperm_filter`, `m_userperm_status`, `m_userperm_added_on`) VALUES
(1, 2, 14, 'FNC', 'ASLR', 1, 1, 0, 0, 0, 1, 1, '2025-02-14 15:35:25'),
(2, 2, 1, 'HR', 'DPT', 0, 0, 0, 0, 0, 0, 1, '2025-02-14 15:35:57'),
(3, 2, 2, 'HR', 'DGN', 0, 0, 0, 0, 0, 0, 1, '2025-02-14 15:36:01'),
(4, 2, 15, 'FNC', 'EMPSLR', 0, 0, 0, 0, 0, 1, 1, '2025-02-21 12:31:37'),
(5, 18, 14, 'FNC', 'ASLR', 1, 1, 0, 0, 0, 0, 1, '2025-02-27 12:56:02'),
(6, 18, 1, 'HR', 'DPT', 0, 0, 0, 0, 0, 0, 1, '2025-02-27 12:56:08'),
(7, 18, 15, 'FNC', 'EMPSLR', 1, 0, 0, 0, 0, 0, 1, '2025-02-27 14:14:12'),
(8, 18, 17, 'MST', 'ST', 1, 1, 0, 0, 0, 0, 1, '2025-02-27 14:34:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_settings`
--
ALTER TABLE `application_settings`
  ADD PRIMARY KEY (`m_app_id`);

--
-- Indexes for table `master_accounts_tbl`
--
ALTER TABLE `master_accounts_tbl`
  ADD PRIMARY KEY (`m_account_id`);

--
-- Indexes for table `master_advance_tbl`
--
ALTER TABLE `master_advance_tbl`
  ADD PRIMARY KEY (`m_advance_id`);

--
-- Indexes for table `master_cashacc_tbl`
--
ALTER TABLE `master_cashacc_tbl`
  ADD PRIMARY KEY (`m_cashacc_id`);

--
-- Indexes for table `master_cate_tbl`
--
ALTER TABLE `master_cate_tbl`
  ADD PRIMARY KEY (`m_cat_id`);

--
-- Indexes for table `master_city_tbl`
--
ALTER TABLE `master_city_tbl`
  ADD PRIMARY KEY (`m_city_id`),
  ADD KEY `state_id` (`m_city_state`);

--
-- Indexes for table `master_department_tbl`
--
ALTER TABLE `master_department_tbl`
  ADD PRIMARY KEY (`m_dept_id`);

--
-- Indexes for table `master_employee_tbl`
--
ALTER TABLE `master_employee_tbl`
  ADD PRIMARY KEY (`m_emp_id`);

--
-- Indexes for table `master_emp_attendance`
--
ALTER TABLE `master_emp_attendance`
  ADD PRIMARY KEY (`m_std_id`);

--
-- Indexes for table `master_emp_salary_breakup`
--
ALTER TABLE `master_emp_salary_breakup`
  ADD PRIMARY KEY (`m_esalary_id`);

--
-- Indexes for table `master_expense_tbl`
--
ALTER TABLE `master_expense_tbl`
  ADD PRIMARY KEY (`m_expense_id`);

--
-- Indexes for table `master_holiday_tbl`
--
ALTER TABLE `master_holiday_tbl`
  ADD PRIMARY KEY (`m_hol_id`);

--
-- Indexes for table `master_increaments_tbl`
--
ALTER TABLE `master_increaments_tbl`
  ADD PRIMARY KEY (`m_incrmt_id`);

--
-- Indexes for table `master_leaves_tbl`
--
ALTER TABLE `master_leaves_tbl`
  ADD PRIMARY KEY (`m_leav_id`);

--
-- Indexes for table `master_nh_tbl`
--
ALTER TABLE `master_nh_tbl`
  ADD PRIMARY KEY (`m_nh_id`);

--
-- Indexes for table `master_notification_tbl`
--
ALTER TABLE `master_notification_tbl`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `master_payment_tbl`
--
ALTER TABLE `master_payment_tbl`
  ADD PRIMARY KEY (`m_payment_id`);

--
-- Indexes for table `master_permission_tbl`
--
ALTER TABLE `master_permission_tbl`
  ADD PRIMARY KEY (`m_perm_id`);

--
-- Indexes for table `master_product_tbl`
--
ALTER TABLE `master_product_tbl`
  ADD PRIMARY KEY (`m_pro_id`);

--
-- Indexes for table `master_salaryinst_tbl`
--
ALTER TABLE `master_salaryinst_tbl`
  ADD PRIMARY KEY (`m_salinst_id`);

--
-- Indexes for table `master_state_tbl`
--
ALTER TABLE `master_state_tbl`
  ADD PRIMARY KEY (`m_state_id`);

--
-- Indexes for table `master_store_tbl`
--
ALTER TABLE `master_store_tbl`
  ADD PRIMARY KEY (`m_str_id`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`m_user_id`);

--
-- Indexes for table `master_user_permission_tbl`
--
ALTER TABLE `master_user_permission_tbl`
  ADD PRIMARY KEY (`m_userperm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_settings`
--
ALTER TABLE `application_settings`
  MODIFY `m_app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_accounts_tbl`
--
ALTER TABLE `master_accounts_tbl`
  MODIFY `m_account_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_advance_tbl`
--
ALTER TABLE `master_advance_tbl`
  MODIFY `m_advance_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_cashacc_tbl`
--
ALTER TABLE `master_cashacc_tbl`
  MODIFY `m_cashacc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_cate_tbl`
--
ALTER TABLE `master_cate_tbl`
  MODIFY `m_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_city_tbl`
--
ALTER TABLE `master_city_tbl`
  MODIFY `m_city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=605;

--
-- AUTO_INCREMENT for table `master_department_tbl`
--
ALTER TABLE `master_department_tbl`
  MODIFY `m_dept_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `master_employee_tbl`
--
ALTER TABLE `master_employee_tbl`
  MODIFY `m_emp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_emp_attendance`
--
ALTER TABLE `master_emp_attendance`
  MODIFY `m_std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_emp_salary_breakup`
--
ALTER TABLE `master_emp_salary_breakup`
  MODIFY `m_esalary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `master_expense_tbl`
--
ALTER TABLE `master_expense_tbl`
  MODIFY `m_expense_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_holiday_tbl`
--
ALTER TABLE `master_holiday_tbl`
  MODIFY `m_hol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_increaments_tbl`
--
ALTER TABLE `master_increaments_tbl`
  MODIFY `m_incrmt_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_leaves_tbl`
--
ALTER TABLE `master_leaves_tbl`
  MODIFY `m_leav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_nh_tbl`
--
ALTER TABLE `master_nh_tbl`
  MODIFY `m_nh_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_payment_tbl`
--
ALTER TABLE `master_payment_tbl`
  MODIFY `m_payment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_permission_tbl`
--
ALTER TABLE `master_permission_tbl`
  MODIFY `m_perm_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `master_product_tbl`
--
ALTER TABLE `master_product_tbl`
  MODIFY `m_pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_salaryinst_tbl`
--
ALTER TABLE `master_salaryinst_tbl`
  MODIFY `m_salinst_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_state_tbl`
--
ALTER TABLE `master_state_tbl`
  MODIFY `m_state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `master_store_tbl`
--
ALTER TABLE `master_store_tbl`
  MODIFY `m_str_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `m_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_user_permission_tbl`
--
ALTER TABLE `master_user_permission_tbl`
  MODIFY `m_userperm_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
