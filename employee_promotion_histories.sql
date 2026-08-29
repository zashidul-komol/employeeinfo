-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2026 at 05:36 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_promotion_histories`
--

DROP TABLE IF EXISTS `employee_promotion_histories`;
CREATE TABLE IF NOT EXISTS `employee_promotion_histories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `promotion_type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `effective_date` date NOT NULL,
  `year` smallint UNSIGNED DEFAULT NULL,
  `previous_designation_id` int NOT NULL,
  `new_designation_id` int NOT NULL,
  `previous_department_id` int NOT NULL,
  `new_department_id` int NOT NULL,
  `previous_grade` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `new_grade` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `previous_reporting_to` int DEFAULT NULL,
  `new_reporting_to` int DEFAULT NULL,
  `previous_office_location_id` mediumint NOT NULL,
  `new_office_location_id` mediumint NOT NULL,
  `promotion_reason` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_promotion_histories`
--

INSERT INTO `employee_promotion_histories` (`id`, `employee_id`, `promotion_type`, `effective_date`, `year`, `previous_designation_id`, `new_designation_id`, `previous_department_id`, `new_department_id`, `previous_grade`, `new_grade`, `previous_reporting_to`, `new_reporting_to`, `previous_office_location_id`, `new_office_location_id`, `promotion_reason`, `remarks`, `created_at`, `updated_at`) VALUES
(13, 2909, 'Grade Change', '2026-09-01', 2026, 322, 322, 2, 2, 'O-3', 'O-4', NULL, NULL, 1, 1, 'Test', 'test', '2026-08-14 22:50:36', '2026-08-14 22:50:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
