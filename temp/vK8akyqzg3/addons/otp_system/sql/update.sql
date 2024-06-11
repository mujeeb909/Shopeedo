-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2020 at 07:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*Column will be added on user table*/
ALTER TABLE `users` CHANGE `verification_code` `verification_code` TEXT NULL DEFAULT NULL;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `otp_configurations`
--

CREATE TABLE `otp_configurations` (
  `id` int(11) NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `otp_configurations`
--

INSERT INTO `otp_configurations` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'nexmo', '1', '2020-03-22 09:19:07', '2020-03-22 09:19:07'),
(5, 'twillo', '0', '2020-03-22 09:54:03', '2020-03-22 03:54:20'),
(6, 'ssl_wireless', '0', '2020-03-22 09:54:03', '2020-03-22 03:54:20'),
(7, 'fast2sms', '0', '2020-03-22 09:54:03', '2020-03-22 03:54:20'),
(8, 'mimsms', '0', '2020-03-22 09:54:03', '2020-03-22 03:54:20'),
(9, 'mimo', '0', '2020-12-27 09:54:03', '2020-12-28 03:54:20'),
(10, 'msegat', '0', '2020-12-27 09:54:03', '2020-12-28 03:54:20'),
(11, 'sparrow', '0', '2020-12-27 09:54:03', '2020-12-28 03:54:20'),
(12, 'zender', '0', '2020-12-27 09:54:03', '2020-12-28 03:54:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp_configurations`
--
ALTER TABLE `otp_configurations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otp_configurations`
--
ALTER TABLE `otp_configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

CREATE TABLE `sms_templates` (
    `id` int(11) NOT NULL,
    `identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `sms_body` longtext COLLATE utf8_unicode_ci NOT NULL,
    `template_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
    `status` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `sms_templates` (`id`, `identifier`, `sms_body`, `template_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'phone_number_verification', '[[code]] is your verification code for [[site_name]].', NULL, 0, '2021-06-07 13:29:22', '2021-06-08 02:38:18'),
(2, 'password_reset', 'Your password reset code is [[code]].', NULL, 1, '2021-06-07 13:29:34', '2021-06-07 13:29:34'),
(3, 'order_placement', 'Your order has been placed and Order Code is [[order_code]]', NULL, 1, '2021-06-07 13:32:22', '2021-06-08 02:39:25'),
(4, 'delivery_status_change', 'Your delivery status has been updated to [[delivery_status]]  for Order code : [[order_code]]', NULL, 1, '2021-06-07 13:33:14', '2021-06-08 02:39:28'),
(5, 'payment_status_change', 'Your payment status has been updated to [[payment_status]] for Order code : [[order_code]]', NULL, 1, '2021-06-07 13:35:23', '2021-06-08 02:39:31'),
(6, 'assign_delivery_boy', 'You are assigned to deliver an order. Order code : [[order_code]]', NULL, 1, '2021-06-07 13:38:10', '2021-06-08 02:39:34');

ALTER TABLE `sms_templates`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `sms_templates`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
