-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2025 at 01:18 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `entity_type` varchar(255) DEFAULT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `entity_type`, `entity_id`, `description`, `metadata`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 19:55:37', '2025-12-11 19:55:37'),
(2, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 19:57:14', '2025-12-11 19:57:14'),
(3, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-11 19:57:23', '2025-12-11 19:57:23'),
(4, 1, 'user_created', 'User', 7, 'Created user: john lloyd (teacher)', '[]', '127.0.0.1', '2025-12-11 19:58:32', '2025-12-11 19:58:32'),
(5, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-11 19:58:39', '2025-12-11 19:58:39'),
(6, NULL, 'user_login', 'User', 7, 'User logged in', '[]', '127.0.0.1', '2025-12-11 19:58:42', '2025-12-11 19:58:42'),
(7, NULL, 'user_logout', 'User', 7, 'User logged out', '[]', '127.0.0.1', '2025-12-11 19:59:04', '2025-12-11 19:59:04'),
(8, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-11 19:59:13', '2025-12-11 19:59:13'),
(9, 1, 'course_created', 'Course', 3, 'Created course: Santol', '[]', '127.0.0.1', '2025-12-11 19:59:36', '2025-12-11 19:59:36'),
(10, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-11 19:59:39', '2025-12-11 19:59:39'),
(11, NULL, 'user_login', 'User', 7, 'User logged in', '[]', '127.0.0.1', '2025-12-11 19:59:47', '2025-12-11 19:59:47'),
(12, NULL, 'profile_updated', 'User', 7, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:01:37', '2025-12-11 20:01:37'),
(13, NULL, 'user_logout', 'User', 7, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:03:13', '2025-12-11 20:03:13'),
(14, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:03:24', '2025-12-11 20:03:24'),
(15, 4, 'profile_updated', 'User', 4, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:03:47', '2025-12-11 20:03:47'),
(16, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:04:42', '2025-12-11 20:04:42'),
(17, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:07:12', '2025-12-11 20:07:12'),
(18, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:13:52', '2025-12-11 20:13:52'),
(19, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:14:13', '2025-12-11 20:14:13'),
(20, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:16:12', '2025-12-11 20:16:12'),
(21, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:16:24', '2025-12-11 20:16:24'),
(22, 2, 'quiz_unpublished', 'Quiz', 1, 'Unpublished quiz: Introduction to Programming - Midterm', '[]', '127.0.0.1', '2025-12-11 20:16:40', '2025-12-11 20:16:40'),
(23, 2, 'quiz_published', 'Quiz', 1, 'Published quiz: Introduction to Programming - Midterm', '[]', '127.0.0.1', '2025-12-11 20:16:45', '2025-12-11 20:16:45'),
(24, 2, 'profile_updated', 'User', 2, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:17:43', '2025-12-11 20:17:43'),
(25, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:19:17', '2025-12-11 20:19:17'),
(26, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:19:39', '2025-12-11 20:19:39'),
(27, 4, 'quiz_submitted', 'QuizSubmission', 1, 'Submitted quiz: Introduction to Programming - Midterm', '{\"grade\":20}', '127.0.0.1', '2025-12-11 20:20:17', '2025-12-11 20:20:17'),
(28, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:20:43', '2025-12-11 20:20:43'),
(29, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:20:54', '2025-12-11 20:20:54'),
(30, 2, 'submission_graded', 'QuizSubmission', 1, 'Graded submission for quiz: Introduction to Programming - Midterm', '{\"grade\":30}', '127.0.0.1', '2025-12-11 20:21:38', '2025-12-11 20:21:38'),
(31, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:22:06', '2025-12-11 20:22:06'),
(32, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:22:17', '2025-12-11 20:22:17'),
(33, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:26:28', '2025-12-11 20:26:28'),
(34, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:27:03', '2025-12-11 20:27:03'),
(35, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:30:28', '2025-12-11 20:30:28'),
(36, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:30:40', '2025-12-11 20:30:40'),
(37, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:31:39', '2025-12-11 20:31:39'),
(38, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:31:48', '2025-12-11 20:31:48'),
(39, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:34:43', '2025-12-11 20:34:43'),
(40, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:36:34', '2025-12-11 20:36:34'),
(41, 2, 'profile_updated', 'User', 2, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:37:28', '2025-12-11 20:37:28'),
(42, 2, 'profile_picture_removed', 'User', 2, 'Removed profile picture', '[]', '127.0.0.1', '2025-12-11 20:47:41', '2025-12-11 20:47:41'),
(43, 2, 'profile_updated', 'User', 2, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:48:55', '2025-12-11 20:48:55'),
(44, 2, 'profile_picture_removed', 'User', 2, 'Removed profile picture', '[]', '127.0.0.1', '2025-12-11 20:49:00', '2025-12-11 20:49:00'),
(45, 2, 'profile_updated', 'User', 2, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:49:16', '2025-12-11 20:49:16'),
(46, 2, 'profile_updated', 'User', 2, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:51:42', '2025-12-11 20:51:42'),
(47, 2, 'profile_picture_removed', 'User', 2, 'Removed profile picture', '[]', '127.0.0.1', '2025-12-11 20:51:49', '2025-12-11 20:51:49'),
(48, 2, 'profile_updated', 'User', 2, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 20:52:05', '2025-12-11 20:52:05'),
(49, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:54:15', '2025-12-11 20:54:15'),
(50, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 20:54:48', '2025-12-11 20:54:48'),
(51, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 20:57:13', '2025-12-11 20:57:13'),
(52, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:03:54', '2025-12-11 21:03:54'),
(53, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:07:45', '2025-12-11 21:07:45'),
(54, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:07:49', '2025-12-11 21:07:49'),
(55, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:07:54', '2025-12-11 21:07:54'),
(56, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:07:57', '2025-12-11 21:07:57'),
(57, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:08:56', '2025-12-11 21:08:56'),
(58, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:08:59', '2025-12-11 21:08:59'),
(59, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:12:07', '2025-12-11 21:12:07'),
(60, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:12:11', '2025-12-11 21:12:11'),
(61, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:12:48', '2025-12-11 21:12:48'),
(62, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:12:52', '2025-12-11 21:12:52'),
(63, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:14:07', '2025-12-11 21:14:07'),
(64, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:14:19', '2025-12-11 21:14:19'),
(65, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:14:32', '2025-12-11 21:14:32'),
(66, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:14:35', '2025-12-11 21:14:35'),
(67, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:15:28', '2025-12-11 21:15:28'),
(68, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:15:33', '2025-12-11 21:15:33'),
(69, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:16:03', '2025-12-11 21:16:03'),
(70, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:16:07', '2025-12-11 21:16:07'),
(71, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:16:12', '2025-12-11 21:16:12'),
(72, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:16:16', '2025-12-11 21:16:16'),
(73, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:16:26', '2025-12-11 21:16:26'),
(74, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:16:32', '2025-12-11 21:16:32'),
(75, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:16:36', '2025-12-11 21:16:36'),
(76, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:16:39', '2025-12-11 21:16:39'),
(77, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:18:22', '2025-12-11 21:18:22'),
(78, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:18:25', '2025-12-11 21:18:25'),
(79, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:18:28', '2025-12-11 21:18:28'),
(80, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:19:41', '2025-12-11 21:19:41'),
(81, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:19:45', '2025-12-11 21:19:45'),
(82, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:19:49', '2025-12-11 21:19:49'),
(83, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:19:52', '2025-12-11 21:19:52'),
(84, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:19:57', '2025-12-11 21:19:57'),
(85, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:20:04', '2025-12-11 21:20:04'),
(86, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:20:12', '2025-12-11 21:20:12'),
(87, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:20:16', '2025-12-11 21:20:16'),
(88, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:20:20', '2025-12-11 21:20:20'),
(89, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:20:32', '2025-12-11 21:20:32'),
(90, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:20:42', '2025-12-11 21:20:42'),
(91, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:20:53', '2025-12-11 21:20:53'),
(92, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:21:05', '2025-12-11 21:21:05'),
(93, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:24:29', '2025-12-11 21:24:29'),
(94, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:24:33', '2025-12-11 21:24:33'),
(95, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:27:06', '2025-12-11 21:27:06'),
(96, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:27:12', '2025-12-11 21:27:12'),
(97, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:28:02', '2025-12-11 21:28:02'),
(98, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:28:29', '2025-12-11 21:28:29'),
(99, 1, 'user_created', 'User', 8, 'Created user: janaya (student)', '[]', '127.0.0.1', '2025-12-11 21:29:11', '2025-12-11 21:29:11'),
(100, 1, 'user_deleted', 'User', 7, 'Deleted user: john lloyd', '[]', '127.0.0.1', '2025-12-11 21:29:31', '2025-12-11 21:29:31'),
(101, 1, 'year_level_created', 'YearLevel', 3, 'Created year level: Grade8', '[]', '127.0.0.1', '2025-12-11 21:31:02', '2025-12-11 21:31:02'),
(102, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:31:43', '2025-12-11 21:31:43'),
(103, 8, 'user_login', 'User', 8, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:33:47', '2025-12-11 21:33:47'),
(104, 8, 'profile_updated', 'User', 8, 'Updated profile information', '[]', '127.0.0.1', '2025-12-11 21:34:19', '2025-12-11 21:34:19'),
(105, 8, 'user_logout', 'User', 8, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:51:45', '2025-12-11 21:51:45'),
(106, 8, 'user_login', 'User', 8, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:54:01', '2025-12-11 21:54:01'),
(107, 8, 'user_logout', 'User', 8, 'User logged out', '[]', '127.0.0.1', '2025-12-11 21:58:44', '2025-12-11 21:58:44'),
(108, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 21:58:58', '2025-12-11 21:58:58'),
(109, 2, 'submission_graded', 'QuizSubmission', 1, 'Graded submission for quiz: Introduction to Programming - Midterm', '{\"grade\":40}', '127.0.0.1', '2025-12-11 21:59:43', '2025-12-11 21:59:43'),
(110, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 22:29:12', '2025-12-11 22:29:12'),
(111, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 22:29:18', '2025-12-11 22:29:18'),
(112, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 22:58:16', '2025-12-11 22:58:16'),
(113, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 22:58:33', '2025-12-11 22:58:33'),
(114, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-11 23:00:41', '2025-12-11 23:00:41'),
(115, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-11 23:01:38', '2025-12-11 23:01:38'),
(116, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:35:22', '2025-12-12 02:35:22'),
(117, 2, 'quiz_created', 'Quiz', 3, 'Created quiz: afdgsg', '[]', '127.0.0.1', '2025-12-12 02:36:28', '2025-12-12 02:36:28'),
(118, 2, 'quiz_published', 'Quiz', 3, 'Published quiz: afdgsg', '[]', '127.0.0.1', '2025-12-12 02:36:50', '2025-12-12 02:36:50'),
(119, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:36:55', '2025-12-12 02:36:55'),
(120, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:37:10', '2025-12-12 02:37:10'),
(121, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:37:26', '2025-12-12 02:37:26'),
(122, 5, 'user_login', 'User', 5, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:38:32', '2025-12-12 02:38:32'),
(123, 5, 'user_logout', 'User', 5, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:38:58', '2025-12-12 02:38:58'),
(124, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:39:13', '2025-12-12 02:39:13'),
(125, 1, 'user_created', 'User', 9, 'Created user: jonas (student)', '[]', '127.0.0.1', '2025-12-12 02:40:03', '2025-12-12 02:40:03'),
(126, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:40:14', '2025-12-12 02:40:14'),
(127, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:40:20', '2025-12-12 02:40:20'),
(128, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:40:33', '2025-12-12 02:40:33'),
(129, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:41:19', '2025-12-12 02:41:19'),
(130, 2, 'quiz_unpublished', 'Quiz', 3, 'Unpublished quiz: afdgsg', '[]', '127.0.0.1', '2025-12-12 02:42:09', '2025-12-12 02:42:09'),
(131, 2, 'question_created', 'Question', 6, 'Added question to quiz: afdgsg', '[]', '127.0.0.1', '2025-12-12 02:43:26', '2025-12-12 02:43:26'),
(132, 2, 'quiz_published', 'Quiz', 3, 'Published quiz: afdgsg', '[]', '127.0.0.1', '2025-12-12 02:43:38', '2025-12-12 02:43:38'),
(133, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:43:42', '2025-12-12 02:43:42'),
(134, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:43:53', '2025-12-12 02:43:53'),
(135, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:44:03', '2025-12-12 02:44:03'),
(136, 5, 'user_login', 'User', 5, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:44:25', '2025-12-12 02:44:25'),
(137, 5, 'user_logout', 'User', 5, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:44:32', '2025-12-12 02:44:32'),
(138, 8, 'user_login', 'User', 8, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:45:01', '2025-12-12 02:45:01'),
(139, 8, 'user_logout', 'User', 8, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:45:12', '2025-12-12 02:45:12'),
(140, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:45:37', '2025-12-12 02:45:37'),
(141, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:47:48', '2025-12-12 02:47:48'),
(142, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:48:12', '2025-12-12 02:48:12'),
(143, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:48:41', '2025-12-12 02:48:41'),
(144, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:48:51', '2025-12-12 02:48:51'),
(145, 1, 'course_created', 'Course', 4, 'Created course: ml', '[]', '127.0.0.1', '2025-12-12 02:49:27', '2025-12-12 02:49:27'),
(146, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:49:35', '2025-12-12 02:49:35'),
(147, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:49:50', '2025-12-12 02:49:50'),
(148, 2, 'quiz_unpublished', 'Quiz', 3, 'Unpublished quiz: afdgsg', '[]', '127.0.0.1', '2025-12-12 02:50:01', '2025-12-12 02:50:01'),
(149, 2, 'quiz_created', 'Quiz', 4, 'Created quiz: ml', '[]', '127.0.0.1', '2025-12-12 02:50:50', '2025-12-12 02:50:50'),
(150, 2, 'question_created', 'Question', 7, 'Added question to quiz: ml', '[]', '127.0.0.1', '2025-12-12 02:51:28', '2025-12-12 02:51:28'),
(151, 2, 'quiz_published', 'Quiz', 4, 'Published quiz: ml', '[]', '127.0.0.1', '2025-12-12 02:51:36', '2025-12-12 02:51:36'),
(152, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:51:40', '2025-12-12 02:51:40'),
(153, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:52:08', '2025-12-12 02:52:08'),
(154, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:52:26', '2025-12-12 02:52:26'),
(155, 8, 'user_login', 'User', 8, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:52:37', '2025-12-12 02:52:37'),
(156, 8, 'user_logout', 'User', 8, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:53:37', '2025-12-12 02:53:37'),
(157, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:53:49', '2025-12-12 02:53:49'),
(158, 2, 'quiz_unpublished', 'Quiz', 4, 'Unpublished quiz: ml', '[]', '127.0.0.1', '2025-12-12 02:54:00', '2025-12-12 02:54:00'),
(159, 2, 'quiz_updated', 'Quiz', 4, 'Updated quiz: ml', '[]', '127.0.0.1', '2025-12-12 02:54:21', '2025-12-12 02:54:21'),
(160, 2, 'quiz_published', 'Quiz', 4, 'Published quiz: ml', '[]', '127.0.0.1', '2025-12-12 02:54:24', '2025-12-12 02:54:24'),
(161, 2, 'quiz_deleted', 'Quiz', 3, 'Deleted quiz: afdgsg', '[]', '127.0.0.1', '2025-12-12 02:54:34', '2025-12-12 02:54:34'),
(162, 2, 'quiz_deleted', 'Quiz', 1, 'Deleted quiz: Introduction to Programming - Midterm', '[]', '127.0.0.1', '2025-12-12 02:54:38', '2025-12-12 02:54:38'),
(163, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:54:41', '2025-12-12 02:54:41'),
(164, 1, 'user_login', 'User', 1, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:56:29', '2025-12-12 02:56:29'),
(165, 1, 'user_updated', 'User', 9, 'Updated user: jonas', '[]', '127.0.0.1', '2025-12-12 02:57:04', '2025-12-12 02:57:04'),
(166, 1, 'user_logout', 'User', 1, 'User logged out', '[]', '127.0.0.1', '2025-12-12 02:57:08', '2025-12-12 02:57:08'),
(167, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 02:57:18', '2025-12-12 02:57:18'),
(168, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:17:23', '2025-12-12 03:17:23'),
(169, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:18:03', '2025-12-12 03:18:03'),
(170, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:18:10', '2025-12-12 03:18:10'),
(171, 5, 'user_login', 'User', 5, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:18:19', '2025-12-12 03:18:19'),
(172, 5, 'user_logout', 'User', 5, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:18:47', '2025-12-12 03:18:47'),
(173, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:19:01', '2025-12-12 03:19:01'),
(174, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:20:32', '2025-12-12 03:20:32'),
(175, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:21:07', '2025-12-12 03:21:07'),
(176, 2, 'quiz_unpublished', 'Quiz', 4, 'Unpublished quiz: ml', '[]', '127.0.0.1', '2025-12-12 03:21:14', '2025-12-12 03:21:14'),
(177, 2, 'quiz_published', 'Quiz', 4, 'Published quiz: ml', '[]', '127.0.0.1', '2025-12-12 03:22:08', '2025-12-12 03:22:08'),
(178, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:22:12', '2025-12-12 03:22:12'),
(179, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:22:22', '2025-12-12 03:22:22'),
(180, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:24:11', '2025-12-12 03:24:11'),
(181, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:24:24', '2025-12-12 03:24:24'),
(182, 2, 'quiz_unpublished', 'Quiz', 4, 'Unpublished quiz: ml', '[]', '127.0.0.1', '2025-12-12 03:24:31', '2025-12-12 03:24:31'),
(183, 2, 'quiz_updated', 'Quiz', 4, 'Updated quiz: ml', '[]', '127.0.0.1', '2025-12-12 03:26:19', '2025-12-12 03:26:19'),
(184, 2, 'quiz_published', 'Quiz', 4, 'Published quiz: ml', '[]', '127.0.0.1', '2025-12-12 03:26:26', '2025-12-12 03:26:26'),
(185, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:26:47', '2025-12-12 03:26:47'),
(186, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:26:59', '2025-12-12 03:26:59'),
(187, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:32:08', '2025-12-12 03:32:08'),
(188, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:32:21', '2025-12-12 03:32:21'),
(189, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 03:36:48', '2025-12-12 03:36:48'),
(190, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 03:36:59', '2025-12-12 03:36:59'),
(191, 9, 'quiz_submitted', 'QuizSubmission', 2, 'Submitted quiz: ml', '{\"grade\":40}', '127.0.0.1', '2025-12-12 11:40:04', '2025-12-12 11:40:04'),
(192, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 11:40:13', '2025-12-12 11:40:13'),
(193, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-12 11:40:27', '2025-12-12 11:40:27'),
(194, 2, 'submission_graded', 'QuizSubmission', 2, 'Graded submission for quiz: ml', '{\"grade\":40}', '127.0.0.1', '2025-12-12 11:40:48', '2025-12-12 11:40:48'),
(195, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-12 11:41:04', '2025-12-12 11:41:04'),
(196, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-12 11:41:16', '2025-12-12 11:41:16'),
(197, 9, 'profile_updated', 'User', 9, 'Updated profile information', '[]', '127.0.0.1', '2025-12-12 11:42:02', '2025-12-12 11:42:02'),
(198, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-12 11:43:06', '2025-12-12 11:43:06'),
(199, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-13 06:28:02', '2025-12-13 06:28:02'),
(200, 2, 'quiz_created', 'Quiz', 5, 'Created quiz: mobile legends', '[]', '127.0.0.1', '2025-12-13 06:30:30', '2025-12-13 06:30:30'),
(201, 2, 'question_created', 'Question', 8, 'Added question to quiz: mobile legends', '[]', '127.0.0.1', '2025-12-13 06:31:22', '2025-12-13 06:31:22'),
(202, 2, 'quiz_published', 'Quiz', 5, 'Published quiz: mobile legends', '[]', '127.0.0.1', '2025-12-13 06:31:31', '2025-12-13 06:31:31'),
(203, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-13 06:31:37', '2025-12-13 06:31:37'),
(204, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-13 06:31:58', '2025-12-13 06:31:58'),
(205, 9, 'quiz_submitted', 'QuizSubmission', 3, 'Submitted quiz: mobile legends', '{\"grade\":0}', '127.0.0.1', '2025-12-13 06:32:25', '2025-12-13 06:32:25'),
(206, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-13 06:32:39', '2025-12-13 06:32:39'),
(207, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-13 06:32:52', '2025-12-13 06:32:52'),
(208, 2, 'submission_graded', 'QuizSubmission', 3, 'Graded submission for quiz: mobile legends', '{\"grade\":1}', '127.0.0.1', '2025-12-13 06:33:31', '2025-12-13 06:33:31'),
(209, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-13 06:33:36', '2025-12-13 06:33:36'),
(210, 9, 'user_login', 'User', 9, 'User logged in', '[]', '127.0.0.1', '2025-12-13 06:33:47', '2025-12-13 06:33:47'),
(211, 9, 'user_logout', 'User', 9, 'User logged out', '[]', '127.0.0.1', '2025-12-13 06:38:11', '2025-12-13 06:38:11'),
(212, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-13 06:38:22', '2025-12-13 06:38:22'),
(213, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-13 11:38:26', '2025-12-13 11:38:26'),
(214, 4, 'user_logout', 'User', 4, 'User logged out', '[]', '127.0.0.1', '2025-12-13 11:50:31', '2025-12-13 11:50:31'),
(215, 2, 'user_login', 'User', 2, 'User logged in', '[]', '127.0.0.1', '2025-12-13 11:50:58', '2025-12-13 11:50:58'),
(216, 2, 'profile_picture_removed', 'User', 2, 'Removed profile picture', '[]', '127.0.0.1', '2025-12-13 11:51:07', '2025-12-13 11:51:07'),
(217, 2, 'user_logout', 'User', 2, 'User logged out', '[]', '127.0.0.1', '2025-12-13 11:53:04', '2025-12-13 11:53:04'),
(218, 4, 'user_login', 'User', 4, 'User logged in', '[]', '127.0.0.1', '2025-12-13 11:53:36', '2025-12-13 11:53:36'),
(219, 4, 'profile_picture_removed', 'User', 4, 'Removed profile picture', '[]', '127.0.0.1', '2025-12-13 11:54:08', '2025-12-13 11:54:08'),
(220, 4, 'profile_updated', 'User', 4, 'Updated profile information', '[]', '127.0.0.1', '2025-12-13 11:54:37', '2025-12-13 11:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `description`, `instructor_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'CS101', 'Introduction to Computer Science', 'Basic concepts of computer science and programming', 2, 1, '2025-12-11 19:54:14', '2025-12-11 19:54:14'),
(2, 'MATH201', 'Calculus I', 'Differential and integral calculus', 3, 1, '2025-12-11 19:54:14', '2025-12-11 19:54:14'),
(4, 'ml10', 'ml', 'afsgdrht', 2, 1, '2025-12-12 02:49:27', '2025-12-12 02:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(38, '0001_01_01_000000_create_users_table', 1),
(39, '0001_01_01_000001_create_cache_table', 1),
(40, '0001_01_01_000002_create_jobs_table', 1),
(41, '2024_12_12_000001_create_courses_table', 1),
(42, '2024_12_12_000002_create_quizzes_table', 1),
(43, '2024_12_12_000003_create_questions_table', 1),
(44, '2024_12_12_000004_create_question_options_table', 1),
(45, '2024_12_12_000005_create_quiz_submissions_table', 1),
(46, '2024_12_12_000006_create_submission_answers_table', 1),
(47, '2024_12_12_000007_create_activity_logs_table', 1),
(48, '2024_12_12_000009_create_year_levels_table', 1),
(49, '2024_12_12_000010_create_sections_table', 1),
(50, '2024_12_12_000011_add_section_year_to_users_table', 1),
(51, '2024_12_12_000012_add_section_year_to_quizzes_table', 1),
(52, '2024_12_12_000013_add_profile_picture_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `type` enum('multiple_choice','true_false','short_answer','essay') NOT NULL,
  `points` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `correct_answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `type`, `points`, `order`, `correct_answer`, `created_at`, `updated_at`) VALUES
(7, 4, 'sino pumatay kay lapu', 'multiple_choice', 40, 1, NULL, '2025-12-12 02:51:28', '2025-12-12 02:51:28'),
(8, 5, 'sino pumatay kay lapu lapu?', 'multiple_choice', 1, 1, NULL, '2025-12-13 06:31:22', '2025-12-13 06:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `option_text`, `is_correct`, `order`, `created_at`, `updated_at`) VALUES
(9, 7, 'aldous', 1, 1, '2025-12-12 02:51:28', '2025-12-12 02:51:28'),
(10, 7, 'nana', 0, 2, '2025-12-12 02:51:28', '2025-12-12 02:51:28'),
(11, 8, 'aldous', 1, 1, '2025-12-13 06:31:22', '2025-12-13 06:31:22'),
(12, 8, 'nana', 0, 2, '2025-12-13 06:31:22', '2025-12-13 06:31:22'),
(13, 8, 'chou', 0, 3, '2025-12-13 06:31:22', '2025-12-13 06:31:22');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `total_points` int(11) NOT NULL,
  `time_limit` int(11) DEFAULT NULL COMMENT 'Time limit in minutes',
  `available_from` datetime DEFAULT NULL,
  `available_until` datetime DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year_level_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `course_id`, `instructor_id`, `total_points`, `time_limit`, `available_from`, `available_until`, `is_published`, `category`, `created_at`, `updated_at`, `section_id`, `year_level_id`) VALUES
(4, 'ml', 'ajbsabcfsac', 4, 2, 40, 60, '2025-12-12 19:27:00', '2025-12-13 18:50:00', 1, 'quiz', '2025-12-12 02:50:50', '2025-12-12 03:26:26', 3, 2),
(5, 'mobile legends', 'bahala na', 4, 2, 100, 60, '2025-12-13 14:29:00', '2025-12-14 14:30:00', 1, 'quiz', '2025-12-13 06:30:30', '2025-12-13 06:31:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submissions`
--

CREATE TABLE `quiz_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_at` datetime NOT NULL,
  `grade` decimal(5,2) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `is_graded` tinyint(1) NOT NULL DEFAULT 0,
  `graded_at` datetime DEFAULT NULL,
  `graded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_submissions`
--

INSERT INTO `quiz_submissions` (`id`, `quiz_id`, `student_id`, `submitted_at`, `grade`, `feedback`, `is_graded`, `graded_at`, `graded_by`, `created_at`, `updated_at`) VALUES
(2, 4, 9, '2025-12-12 19:40:04', 40.00, 'bobomo', 1, '2025-12-12 19:40:48', 2, '2025-12-12 11:40:04', '2025-12-12 11:40:48'),
(3, 5, 9, '2025-12-13 14:32:25', 1.00, 'bobomo', 1, '2025-12-13 14:33:31', 2, '2025-12-13 06:32:25', '2025-12-13 06:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `year_level_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `code`, `year_level_id`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Section A', 'SEC-A', 1, 'First year, Section A', 1, '2025-12-11 19:54:12', '2025-12-11 19:54:12'),
(2, 'Section B', 'SEC-B', 1, 'First year, Section B', 1, '2025-12-11 19:54:12', '2025-12-11 19:54:12'),
(3, 'Section A', 'SEC-C', 2, 'Second year, Section A', 1, '2025-12-11 19:54:12', '2025-12-11 19:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PoyLrHq32AbfMJxaTRxffv2KnEAp1AGHhf1d15HB', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYTB2eTZRRmU2aDBJSENvNU1ZQXJMZjFVRWtYWXhTempFeUhYWDVEZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50L3Byb2ZpbGUiO3M6NToicm91dGUiO3M6MjA6InN0dWRlbnQucHJvZmlsZS5lZGl0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1765626877);

-- --------------------------------------------------------

--
-- Table structure for table `submission_answers`
--

CREATE TABLE `submission_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submission_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` text DEFAULT NULL,
  `selected_option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `points_earned` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submission_answers`
--

INSERT INTO `submission_answers` (`id`, `submission_id`, `question_id`, `answer_text`, `selected_option_id`, `is_correct`, `points_earned`, `created_at`, `updated_at`) VALUES
(5, 2, 7, '9', 9, 1, 40.00, '2025-12-12 11:40:04', '2025-12-12 11:40:04'),
(6, 3, 8, '12', 12, 0, 1.00, '2025-12-13 06:32:25', '2025-12-13 06:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `role` enum('admin','teacher','student') NOT NULL DEFAULT 'student',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year_level_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_picture`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `section_id`, `year_level_id`) VALUES
(1, 'Admin User', 'admin@lms.com', NULL, 'admin', NULL, '$2y$12$sqtnrCXpmV.8K2KFuVmTDebAkXr0knBFN5opgfXpJRvIcnP1k3Fom', 'ERTzTgf4kXQgRnS4fPLPADDBPPelcsRvmHec3TRUn730InIRi9HUr7luWEnS', '2025-12-11 19:54:13', '2025-12-11 19:54:13', NULL, NULL),
(2, 'John Teacher', 'teacher@lms.com', NULL, 'teacher', NULL, '$2y$12$FS1f.IapJz7bwrXWXRfFJ.ERGjHk9gvglZMtTG0LmxceFoCWxzfaG', 'yburrrLllgi8JaBcwPKyfS94Xl8uHHJb1PJsWKv1jfdwmrJK2DEubO6SYIPA', '2025-12-11 19:54:13', '2025-12-13 11:51:07', NULL, NULL),
(3, 'Jane Instructor', 'instructor@lms.com', NULL, 'teacher', NULL, '$2y$12$K7ugaOaA3BPrucSf9.rm5.7F/8IE7MterkzxnIk9jz67nwZ6v/eMW', NULL, '2025-12-11 19:54:13', '2025-12-11 19:54:13', NULL, NULL),
(4, 'Alice Student', 'student1@lms.com', 'profile_pictures/Br7C4GtYf0gZUdjfZaOMzqHtyUYpf9fqn1bwOepD.jpg', 'student', NULL, '$2y$12$nUbDvaFfZhiy4v/lX7mEjeLnVuR07cUfwfr8La0JhkRLLUQ249yXm', 'RwNWRwU8WEiseDehZtJ9rYaSRSKzFTbUwSWwBmxzr3HwabpgjUWSVdrT1ihU', '2025-12-11 19:54:13', '2025-12-13 11:54:37', 1, 1),
(5, 'Bob Student', 'student2@lms.com', NULL, 'student', NULL, '$2y$12$rlxo6EotiN6QkbtKenF2vOgck1PSNhWyG5z7dtmNAXlrQhHyUjAie', 'fMVg9dIqkqZrvbRB3BTD1nP8ylodmAs3V0M43AD8CegV0tXK7k6bgoaEeMG5', '2025-12-11 19:54:14', '2025-12-11 19:54:14', 2, 1),
(6, 'Charlie Student', 'student3@lms.com', NULL, 'student', NULL, '$2y$12$NtNQpwBg3slwfoU2mJ4nGe9EeZsH34XVzjUuTguDRWWDiC9ipZecC', NULL, '2025-12-11 19:54:14', '2025-12-11 19:54:14', 3, 2),
(8, 'janaya', 'janaya@lms.com', 'profile_pictures/0qjcIsNYuLjSvdy38l4uHokFFZ9vrT7SwtblfjWO.png', 'student', NULL, '$2y$12$eQm47OiOrACM1McDy5q4iuZed4fLgOBgIt4yeMCiwgnEgxyr7E0fW', '4ZdQKBrA9k8m53dj5E9rC8gZeMYvp9etCyQVUykTD34UQEZpSrkLe8DFXx6c', '2025-12-11 21:29:11', '2025-12-11 21:34:19', 3, 1),
(9, 'jonas', 'jonas@lms.com', 'profile_pictures/gxkZCX38OCBUnvsltXewF6tgDbp8WlGZNkFmwRj5.png', 'student', NULL, '$2y$12$AOVUf91eeG0JnY6X2hpdmubc5hx7ho54C2bpmBUqvemPZrumN6.mm', 'tSd255SWk50e2koAZlPdf2awYqcRpJoeG0UVUeMzbkHaJd9ZRFZbzTtCzKGM', '2025-12-12 02:40:03', '2025-12-12 11:42:02', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `year_levels`
--

CREATE TABLE `year_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `year_levels`
--

INSERT INTO `year_levels` (`id`, `name`, `code`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1st Year', 'YEAR1', 'First year students', 1, '2025-12-11 19:54:12', '2025-12-11 19:54:12'),
(2, '2nd Year', 'YEAR2', 'Second year students', 1, '2025-12-11 19:54:12', '2025-12-11 19:54:12'),
(3, 'Grade8', 'GRADE8-A', 'jajajajajaajja', 1, '2025-12-11 21:31:02', '2025-12-11 21:31:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `activity_logs_entity_type_entity_id_index` (`entity_type`,`entity_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_code_unique` (`code`),
  ADD KEY `courses_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_options_question_id_foreign` (`question_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_course_id_foreign` (`course_id`),
  ADD KEY `quizzes_instructor_id_foreign` (`instructor_id`),
  ADD KEY `quizzes_section_id_foreign` (`section_id`),
  ADD KEY `quizzes_year_level_id_foreign` (`year_level_id`);

--
-- Indexes for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quiz_submissions_quiz_id_student_id_unique` (`quiz_id`,`student_id`),
  ADD KEY `quiz_submissions_student_id_foreign` (`student_id`),
  ADD KEY `quiz_submissions_graded_by_foreign` (`graded_by`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_code_unique` (`code`),
  ADD KEY `sections_year_level_id_foreign` (`year_level_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `submission_answers`
--
ALTER TABLE `submission_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submission_answers_submission_id_foreign` (`submission_id`),
  ADD KEY `submission_answers_question_id_foreign` (`question_id`),
  ADD KEY `submission_answers_selected_option_id_foreign` (`selected_option_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_section_id_foreign` (`section_id`),
  ADD KEY `users_year_level_id_foreign` (`year_level_id`);

--
-- Indexes for table `year_levels`
--
ALTER TABLE `year_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year_levels_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submission_answers`
--
ALTER TABLE `submission_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `year_levels`
--
ALTER TABLE `year_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `quizzes_year_level_id_foreign` FOREIGN KEY (`year_level_id`) REFERENCES `year_levels` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  ADD CONSTRAINT `quiz_submissions_graded_by_foreign` FOREIGN KEY (`graded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `quiz_submissions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_submissions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_year_level_id_foreign` FOREIGN KEY (`year_level_id`) REFERENCES `year_levels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submission_answers`
--
ALTER TABLE `submission_answers`
  ADD CONSTRAINT `submission_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submission_answers_selected_option_id_foreign` FOREIGN KEY (`selected_option_id`) REFERENCES `question_options` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `submission_answers_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `quiz_submissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_year_level_id_foreign` FOREIGN KEY (`year_level_id`) REFERENCES `year_levels` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
