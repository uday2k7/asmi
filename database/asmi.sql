-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 07:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `heading`, `description`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'http://127.0.0.1:8000/upload_path/38281678303755.jpg', 'Welcome to Asmi Medical Technologies', 'Asmi Medical Technologies provides Medical Equipment, Diagnostic Instruments and complete Consultation to establish and operation of Diagnostic Centers Hospitals / Nursing Homes.', 1, 0, '2023-02-28 18:17:13', '2023-03-08 19:29:15'),
(2, 'http://127.0.0.1:8000/upload_path/93641678167610.jpg', 'We Care We Deliver', 'Manufacturer & Exporter wide range of Medical Disposables.', 1, 0, '2023-02-28 18:17:13', '2023-03-07 05:40:11'),
(3, 'http://127.0.0.1:8000/assets/frontend/img/slide/slide-3.jpg', 'We Care\n', 'About your Today & Tomorrow\n\n', 1, 0, '2023-02-28 18:17:13', '2023-02-28 18:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `banner_inner`
--

DROP TABLE IF EXISTS `banner_inner`;
CREATE TABLE `banner_inner` (
  `id` int(10) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading_text` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner_inner`
--

INSERT INTO `banner_inner` (`id`, `page_name`, `image`, `heading_text`, `description`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'HOME_CARE_SERVICE', 'http://127.0.0.1:8000/upload_path/58741678165269.jpeg', 'Home Health Care Service66', 'Our goal is to provide the most affordable patient care products & services available.', 1, 0, '2023-02-28 18:17:13', '2023-03-07 05:01:10'),
(2, 'MEDICAL_EQUIPMENTS', 'http://127.0.0.1:8000/upload_path/81471678165416.jpg', 'Medical Equipments', 'Diagnostic/ Lab Equipment\'s / Hospital Equipment\'s / Nursing Home Equipment\'s', 1, 0, '2023-02-28 18:17:13', '2023-03-07 05:03:41'),
(3, 'PROJECT_CONSULTANCY', 'http://127.0.0.1:8000/upload_path/37431678303733.jpg', 'Project Consultancy', 'Project management consultancy services are vital for high impact, time sensitive projects, those most critical to your organization’s success. bbbbb', 1, 0, '2023-02-28 18:17:13', '2023-03-08 19:28:54'),
(4, 'PORTFOLIO', 'http://127.0.0.1:8000/upload_path/29401678303668.jpg', 'Our Portfolio', 'Some of Our Selected Workmmmmm', 1, 0, '2023-02-28 18:17:13', '2023-03-08 19:27:48'),
(5, 'CONTACT_US', 'http://127.0.0.1:8000/assets/frontend/img/slide/slide-1.jpg', 'Contact Us', 'If you want to discuss.mmm', 1, 0, '2023-02-28 18:17:13', '2023-03-08 19:26:55'),
(6, 'ABOUT_US', 'http://127.0.0.1:8000/upload_path/34891678303606.jpg', 'About Us', 'this is about', 1, 0, '2023-02-28 18:17:13', '2023-03-08 19:26:46');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `contact`, `message`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'fgdf', 'demo60@test.com', 'sdsdf', 'v', 1, 0, '2023-03-02 17:19:52', '2023-03-02 17:19:52'),
(2, 'fgdf', 'demo51@test.com', 'dgff', 'dsg', 1, 0, '2023-03-02 17:20:22', '2023-03-02 17:20:22'),
(3, 'dsgdg', 'demo51@test.com', 'sdsdf', 'df', 1, 0, '2023-03-02 17:23:18', '2023-03-02 17:23:18'),
(4, 'fgdf', 'demo51@test.com', 'sdsdf', 'cf', 1, 0, '2023-03-02 17:25:30', '2023-03-02 17:25:30'),
(5, 'sss', 'demo60@test.com', 'yyy', 'vg', 1, 0, '2023-03-02 17:27:21', '2023-03-02 17:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content_details` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `heading`, `content_details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Review & Analysis', 'Review & Analysis\r\nOur Team understands and analyze the Clients requirement and the various dynamics around the clients existing system and turn them into a successful project or Deal.1', 1, '2023-03-02 19:05:55', '2023-03-06 17:48:55'),
(2, 'Evaluation', 'We assure that the implemented equipment\'s meet your proper requirements and the main objectives. We deliver the complete solution to the end user. Their satisfaction is our goal.1', 1, '2023-03-02 19:05:55', '2023-03-06 17:49:01'),
(3, 'Support.', 'We consider client support to be more than a simple customer service operation. Whenever your business needs it the most, we are there to help you out...1', 1, '2023-03-02 19:06:26', '2023-03-06 17:49:07'),
(4, 'Medical Equipment\'s', 'We Provide Standardize Medical Equipment\'s for Diagnostic Centers and Hospitals with affordable Range of Price, superior support & quality products. We continue to expand our horizons to new market with our quality service & support.1', 1, '2023-03-02 19:06:26', '2023-03-06 17:49:14'),
(5, 'Home Health Care Service', 'It is our belief that everyone deserves the proper medical equipment & home health care supplies for their treatment. Our commitment to service is not limited to patients, but extends to caregivers, & physicians as well.1', 1, '2023-03-02 19:06:53', '2023-03-06 17:49:20'),
(6, 'Project Consultation', 'We provide Department wise Building Planning, Budget, Complete Licensing, Commercial & Viability aspect, Cashflow analysis, Project report for finance, IT Solution & Marketing Plan for Diagnostic Centre & Hospital Projects.1', 1, '2023-03-02 19:06:53', '2023-03-06 17:49:26'),
(7, 'Footer About Us', 'We are transforming the medical devices industry by combining best-in-class technology with an unprecedented level of service.\r\n\r\n', 1, '2023-03-02 19:06:53', '2023-03-02 19:06:53'),
(8, 'Opening Time', 'Monday - Saturday, 8AM to 10PM', 1, '2023-03-02 19:06:53', '2023-03-02 19:06:53'),
(9, 'Contact Address', 'R.C. Tower No-1 24/62, Jessore Road, Kolkata - 700028\r\n', 1, '2023-03-02 19:06:53', '2023-03-02 19:06:53'),
(10, 'Contact Phone 1', '+91 8240744006', 1, '2023-03-02 19:06:53', '2023-03-02 19:06:53'),
(11, 'Contact Phone 2', '+91 6290418742', 1, '2023-03-02 19:06:53', '2023-03-02 19:06:53'),
(12, 'Contact Email', 'asmimedicaltechnologies@gmail.com', 1, '2023-03-02 19:06:53', '2023-03-02 19:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('MEDICAL_EQUIPMENTS','ITEMS_WE_OFFERED','PORTFOLIO') NOT NULL DEFAULT 'PORTFOLIO',
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `deleted` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `type`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Group 1', 'PORTFOLIO', 1, 0, '2023-03-07 09:33:03', '2023-03-07 09:33:03'),
(2, 'Group 2', 'PORTFOLIO', 1, 0, '2023-03-07 09:33:11', '2023-03-07 09:33:11'),
(3, 'Group 3', 'PORTFOLIO', 1, 0, '2023-03-07 09:33:18', '2023-03-07 09:33:18'),
(4, 'ANALOG WEIGHT SCALE', 'ITEMS_WE_OFFERED', 1, 0, '2023-03-08 18:29:28', '2023-03-08 18:29:28'),
(5, 'DIGITAL BP MACHINE', 'ITEMS_WE_OFFERED', 1, 0, '2023-03-08 18:29:34', '2023-03-08 18:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `item_details`
--

DROP TABLE IF EXISTS `item_details`;
CREATE TABLE `item_details` (
  `id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_details`
--

INSERT INTO `item_details` (`id`, `item_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'http://127.0.0.1:8000/upload_path/72601678181674.jpg', 1, '2023-03-07 09:34:34', '2023-03-07 09:34:34'),
(2, 3, 'http://127.0.0.1:8000/upload_path/36691708583391.jpg', 1, '2023-03-07 09:34:49', '2024-02-22 06:29:51'),
(3, 3, 'http://127.0.0.1:8000/upload_path/37121708583380.jpg', 1, '2023-03-07 09:34:58', '2024-02-22 06:29:41'),
(4, 2, 'http://127.0.0.1:8000/upload_path/30281678181825.jpg', 1, '2023-03-07 09:37:05', '2023-03-07 09:37:05'),
(5, 2, 'http://127.0.0.1:8000/upload_path/3441678181916.jpg', 1, '2023-03-07 09:37:55', '2023-03-07 09:38:36'),
(6, 2, 'http://127.0.0.1:8000/upload_path/11361678181888.jpg', 1, '2023-03-07 09:38:08', '2023-03-07 09:38:08'),
(7, 1, 'http://127.0.0.1:8000/upload_path/16091678181994.jpg', 1, '2023-03-07 09:39:54', '2023-03-07 09:39:54'),
(8, 1, 'http://127.0.0.1:8000/upload_path/52141678182005.jpg', 1, '2023-03-07 09:40:06', '2023-03-07 09:40:06'),
(9, 1, 'http://127.0.0.1:8000/upload_path/95901678182016.jpg', 1, '2023-03-07 09:40:16', '2023-03-07 09:40:16'),
(10, 1, 'http://127.0.0.1:8000/upload_path/18251678182025.jpg', 1, '2023-03-07 09:40:26', '2023-03-07 09:40:26'),
(11, 1, 'http://127.0.0.1:8000/upload_path/59821678182041.jpg', 1, '2023-03-07 09:40:41', '2023-03-07 09:40:41'),
(12, 5, 'http://127.0.0.1:8000/upload_path/103311678300181.jpg', 1, '2023-03-08 18:29:41', '2023-03-08 18:29:41'),
(13, 4, 'http://127.0.0.1:8000/upload_path/42441678300191.jpg', 1, '2023-03-08 18:29:51', '2023-03-08 18:29:51'),
(14, 4, 'http://127.0.0.1:8000/upload_path/86671678301252.jpg', 1, '2023-03-08 18:47:32', '2023-03-08 18:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_table_users', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `our_expertise`
--

DROP TABLE IF EXISTS `our_expertise`;
CREATE TABLE `our_expertise` (
  `id` int(10) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `our_expertise`
--

INSERT INTO `our_expertise` (`id`, `heading`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Review & Analysis', 'Our Team understands and analyze the Clients requirement and the various dynamics around the clients existing system and turn them into a successful project or Deal.\r\n', 'http://127.0.0.1:8000/assets/frontend/img/doctors/Review-Client.jpeg', 1, '2023-03-02 19:11:26', '2023-03-02 19:11:26'),
(2, 'Evaluation', 'We assure that the implemented equipment\'s meet your proper requirements and the main objectives. We deliver the complete solution to the end user. Their satisfaction is our goal.', 'http://127.0.0.1:8000/upload_path/97351678134759.jpg', 1, '2023-03-02 19:11:26', '2023-03-06 20:32:39'),
(3, 'Support', 'We consider client support to be more than a simple customer service operation. Whenever your business needs it the most, we are there to help you out.\r\n', 'http://127.0.0.1:8000/assets/frontend/img/doctors/Support-1.jpg', 1, '2023-03-02 19:12:15', '2023-03-02 19:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `our_solutions`
--

DROP TABLE IF EXISTS `our_solutions`;
CREATE TABLE `our_solutions` (
  `id` int(10) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `our_solutions`
--

INSERT INTO `our_solutions` (`id`, `heading`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Site Drawing', 'It is mandatory to submit a site plan of the entire project which comply with the actual structural sanctioned building plan as well as the drawing has to comply with the room size requirements of CMOH for every department of the project.\n', 'http://127.0.0.1:8000/assets/frontend/img/doctors/doctors-1.jpg', 1, '2023-03-02 19:11:26', '2023-03-02 19:11:26'),
(2, 'Evaluation', 'We assure that the implemented equipment\'s meet your proper requirements and the main objectives. We deliver the complete solution to the end user. Their satisfaction is our goal.', 'http://127.0.0.1:8000/upload_path/11271678134675.jpg', 1, '2023-03-02 19:11:26', '2023-03-06 20:31:15'),
(3, 'Investment Layout', 'This plan contains complete idea of financial involvement towards set up of the Project. After discussing your objectives and preferences, we thoroughly assess your Investment strategy, depending on your needs.\n', 'http://127.0.0.1:8000/assets/frontend/img/doctors/doctors-3.jpg', 1, '2023-03-02 19:12:15', '2023-03-02 19:12:15'),
(4, 'Manpower Planning\r\n', 'Manpower planning is essentially the process of getting the number of qualified employees and seek to place the right employees in the right job at right time, so that an organization can meet it\'s objectives.\r\n', 'http://127.0.0.1:8000/assets/frontend/img/doctors/doctors-4.jpg', 1, '2023-03-02 19:12:15', '2023-03-02 19:12:15'),
(5, 'Cashflow Analysis', 'A cashflow analysis is for checking up your firms financial health. It is the study of the movement of cash through your business to determine patterns of how to take in and out pay out money.', 'http://127.0.0.1:8000/upload_path/17111678134164.jpeg', 1, '2023-03-02 19:12:15', '2023-03-06 20:24:58'),
(6, 'Viability Aspect1\n', 'It is the most important aspect of the Project. We can get idea from the Cash flow, the amount of Prescription/Cases required for successful run of the Project. We ensure that all their objectives are met.\r\n', 'http://127.0.0.1:8000/assets/frontend/img/doctors/doctors-6.jpg', 1, '2023-03-02 19:12:15', '2023-03-02 19:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'site user id',
  `first_name` varchar(255) NOT NULL COMMENT 'user first name',
  `last_name` varchar(255) NOT NULL COMMENT 'user last name',
  `email` varchar(255) DEFAULT NULL COMMENT 'user email address',
  `mobile` varchar(50) DEFAULT NULL COMMENT 'mobile number with isd; ex: +919999999999',
  `profile_pic` varchar(255) DEFAULT NULL COMMENT 'https://domain.com/user-content/example.png',
  `is_locked` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:not locked; 1: locked',
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:not verified;1:verified',
  `is_mobile_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:not verified;1:verified',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1:deleted\r\n0:not deleted',
  `user_type` tinyint(2) NOT NULL DEFAULT 3 COMMENT '1:superadmin;\r\n2:Admin\r\n3:Influencer',
  `gender` varchar(10) DEFAULT NULL COMMENT 'use constant',
  `password` varchar(255) NOT NULL DEFAULT '0000-00-00' COMMENT 'user password',
  `date_of_birth` date DEFAULT NULL COMMENT 'date of birth',
  `address` text DEFAULT NULL COMMENT 'user address',
  `otp` varchar(6) DEFAULT NULL COMMENT 'otp to verify user information',
  `otp_expires` int(11) NOT NULL DEFAULT 0 COMMENT 'unix timestamp when otp expired',
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:no;1:yes',
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'row entry timestamp',
  `fcm_token` varchar(255) NOT NULL DEFAULT 'NONE' COMMENT 'Google firebase fcm token to send notification',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'row update date time; $model->save()'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `profile_pic`, `is_locked`, `is_email_verified`, `is_mobile_verified`, `is_deleted`, `user_type`, `gender`, `password`, `date_of_birth`, `address`, `otp`, `otp_expires`, `terms_accepted`, `registered_on`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'SuperAdmin', 'asmimedicaltechnologies@gmail.com', NULL, '0', 0, 0, 0, 0, 1, 'Male', '$2y$10$yv2mar9ZZSLzOg.LBOJcGucf2URlHtespDC7ui3OSjF6qIEfmEtaa', '2022-06-01', 'This is a address', NULL, 0, 1, '2022-06-13 03:43:11', 'NONE', '0000-00-00 00:00:00', '2022-06-14 07:13:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_inner`
--
ALTER TABLE `banner_inner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_details`
--
ALTER TABLE `item_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_expertise`
--
ALTER TABLE `our_expertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_solutions`
--
ALTER TABLE `our_solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banner_inner`
--
ALTER TABLE `banner_inner`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_details`
--
ALTER TABLE `item_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `our_expertise`
--
ALTER TABLE `our_expertise`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `our_solutions`
--
ALTER TABLE `our_solutions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'site user id', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
