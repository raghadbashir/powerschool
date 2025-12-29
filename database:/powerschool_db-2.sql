-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 29, 2025 at 04:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powerschool_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `name`, `start_date`, `end_date`, `is_active`, `created_at`) VALUES
(1, '2025-2026', '2025-09-01', '2026-06-30', 1, '2025-12-27 01:19:17'),
(2, '2024-2025', '0024-12-27', '0000-00-00', 0, '2025-12-27 02:25:53'),
(3, '2026-2027', '2026-09-07', '2027-05-19', 0, '2025-12-27 18:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `academic_year_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','late') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `class_id`, `teacher_id`, `academic_year_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 7, 4, 1, '2025-12-10', 'present', '2025-12-10 00:00:32', NULL),
(2, 16, 5, 3, 1, '2025-12-11', 'present', '2025-12-11 23:37:59', NULL),
(3, 18, 7, 0, 1, '2025-12-12', 'present', '2025-12-12 17:44:11', NULL),
(4, 16, 5, 0, 1, '2025-12-12', 'present', '2025-12-12 17:52:44', NULL),
(10, 16, 5, 0, 1, '2025-12-12', 'present', '2025-12-12 18:33:18', NULL),
(11, 16, 5, 0, 1, '2025-12-12', 'present', '2025-12-12 18:33:24', NULL),
(15, 18, 7, 3, 1, '2025-12-13', 'absent', '2025-12-13 15:36:54', NULL),
(16, 19, 7, 3, 1, '2025-12-13', 'present', '2025-12-13 15:36:54', NULL),
(17, 18, 7, 3, 1, '2025-12-13', 'present', '2025-12-13 15:37:53', NULL),
(18, 19, 7, 3, 1, '2025-12-13', 'absent', '2025-12-13 15:37:53', NULL),
(19, 18, 7, 3, 1, '2025-12-13', 'late', '2025-12-13 15:39:00', NULL),
(20, 19, 7, 3, 1, '2025-12-13', 'present', '2025-12-13 15:39:00', NULL),
(21, 18, 7, 3, 1, '2025-12-13', 'present', '2025-12-13 15:43:01', NULL),
(22, 19, 7, 3, 1, '2025-12-13', 'absent', '2025-12-13 15:43:01', NULL),
(24, 19, 7, 3, 1, '2025-12-13', 'present', '2025-12-13 15:43:10', NULL),
(25, 18, 7, 3, 1, '2025-12-13', 'present', '2025-12-13 23:55:16', NULL),
(26, 19, 7, 3, 1, '2025-12-13', 'present', '2025-12-13 23:55:16', NULL),
(27, 16, 7, 3, 1, '2025-12-13', 'absent', '2025-12-13 23:55:16', NULL),
(28, 18, 7, 3, 1, '2025-12-14', 'present', '2025-12-13 23:55:24', NULL),
(35, 19, 7, 3, 1, '2025-12-12', 'present', '2025-12-13 23:55:31', NULL),
(36, 16, 7, 3, 1, '2025-12-12', 'present', '2025-12-13 23:55:31', NULL),
(37, 18, 7, 3, 1, '2025-12-14', 'late', '2025-12-14 00:44:23', NULL),
(38, 19, 7, 3, 1, '2025-12-14', 'present', '2025-12-14 00:44:23', NULL),
(39, 16, 7, 3, 1, '2025-12-14', 'present', '2025-12-14 00:44:23', NULL),
(40, 18, 25, 3, 1, '2025-12-26', 'present', '2025-12-26 23:46:01', NULL),
(41, 16, 25, 3, 1, '2025-12-26', 'present', '2025-12-26 23:46:01', NULL),
(42, 18, 27, 3, 1, '2025-12-27', 'present', '2025-12-27 19:07:24', NULL),
(43, 16, 27, 3, 1, '2025-12-27', 'present', '2025-12-27 19:07:24', NULL),
(44, 21, 27, 3, 1, '2025-12-27', 'present', '2025-12-27 19:07:24', NULL),
(45, 18, 27, 3, 1, '2025-12-27', 'absent', '2025-12-27 19:07:36', NULL),
(46, 16, 27, 3, 1, '2025-12-27', 'present', '2025-12-27 19:07:36', NULL),
(47, 21, 27, 3, 1, '2025-12-27', 'present', '2025-12-27 19:07:36', NULL),
(48, 23, 28, 3, 1, '2025-12-28', 'present', '2025-12-28 00:23:52', NULL),
(49, 19, 28, 3, 1, '2025-12-28', 'late', '2025-12-28 00:23:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `grade`, `section`, `created_at`, `updated_at`) VALUES
(9, '1', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(10, '1', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(11, '2', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(12, '2', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(13, '3', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(14, '3', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(15, '4', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(16, '4', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(17, '5', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(18, '5', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(19, '6', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(20, '6', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(21, '7', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(22, '7', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(23, '8', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(24, '8', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(25, '9', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(26, '9', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(27, '10', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(28, '10', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(29, '11', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(30, '11', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(31, '12', 'a', '2025-12-14 03:30:50', '2025-12-14 03:30:50'),
(32, '12', 'b', '2025-12-14 03:30:50', '2025-12-14 03:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `class_materials`
--

CREATE TABLE `class_materials` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_materials`
--

INSERT INTO `class_materials` (`id`, `teacher_id`, `class_id`, `title`, `description`, `file_path`, `created_at`) VALUES
(1, 4, 7, 'cnna lectures', '', 'uploads/materials/1765352213_14478ae431618c27598f.pdf', '2025-12-10 09:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `class_messages`
--

CREATE TABLE `class_messages` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_messages`
--

INSERT INTO `class_messages` (`id`, `teacher_id`, `class_id`, `academic_year_id`, `message`, `created_at`) VALUES
(1, 4, 7, 0, 'homework on tuesday', '2025-12-10 09:30:06'),
(2, 3, 5, 0, 'write the paper', '2025-12-12 01:38:21'),
(3, 3, 7, 0, 'redo test', '2025-12-12 01:45:26'),
(4, 3, 7, 0, 'sports day ', '2025-12-13 20:00:00'),
(5, 3, 7, 0, 'homework', '2025-12-13 18:03:16'),
(6, 3, 25, 0, 'redo exam', '2025-12-14 08:35:26'),
(7, 3, 28, 1, 'Exam on tuesday', '2025-12-27 22:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `academic_year_id` int(11) DEFAULT NULL,
  `grade` varchar(20) NOT NULL,
  `comment` text DEFAULT NULL,
  `term` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `midterm` int(11) DEFAULT 0,
  `final` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `is_issued` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `class_id`, `subject`, `teacher_id`, `academic_year_id`, `grade`, `comment`, `term`, `created_at`, `midterm`, `final`, `total`, `is_issued`) VALUES
(1, 18, 7, 'art', 4, 1, '', '', 'Term 1', '2025-12-10 18:33:51', 40, 60, 100, 0),
(2, 18, 7, 'geography', 3, 1, '', 'keep up good work', 'Term 1', '2025-12-12 02:03:26', 30, 40, 70, 0),
(3, 16, 5, 'pe', 0, 1, '', '', 'Term 1', '2025-12-12 19:52:35', 20, 30, 50, 0),
(4, 16, 5, 'pe', 0, 1, '', 'redo', 'Term 1', '2025-12-12 20:36:47', 10, 20, 30, 0),
(5, 18, 7, 'geography', 0, 1, '', 'redo', 'Term 1', '2025-12-13 14:17:11', 20, 30, 50, 0),
(6, 19, 7, 'art', 4, 1, '', 'great job', 'Term 1', '2025-12-13 14:22:23', 20, 50, 70, 0),
(7, 18, 7, 'biology', 3, 1, '', '', 'Term 1', '2025-12-13 17:57:06', 0, 0, 0, 0),
(8, 16, 7, 'biology', 0, 1, '', '', 'Term 1', '2025-12-13 20:05:49', 39, 0, 39, 0),
(9, 19, 7, 'biology', 0, 1, '', '', 'Term 1', '2025-12-13 20:05:49', 0, 0, 0, 0),
(10, 16, 27, 'Biology', 0, 1, '', '', 'Term 1', '2025-12-27 23:04:27', 40, 30, 70, 1),
(11, 18, 27, 'Biology', 0, 1, '', '', 'Term 1', '2025-12-27 23:04:27', 0, 0, 0, 1),
(12, 21, 27, 'Biology', 0, 1, '', '', 'Term 1', '2025-12-27 23:04:27', 0, 0, 0, 1),
(13, 19, 28, 'Biology', 0, 1, '', '', 'Term 1', '2025-12-28 00:36:24', 20, 40, 60, 0),
(14, 23, 28, 'Biology', 0, 1, '', '', 'Term 1', '2025-12-28 00:36:24', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `graduates`
--

CREATE TABLE `graduates` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `graduation_year_id` int(11) NOT NULL,
  `final_class_id` int(11) DEFAULT NULL,
  `graduated_at` datetime NOT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graduates`
--

INSERT INTO `graduates` (`id`, `student_id`, `graduation_year_id`, `final_class_id`, `graduated_at`, `notes`) VALUES
(1, 35, 1, 31, '2025-12-27 17:36:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `academic_year_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `due_datetime` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `max_grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `class_id`, `teacher_id`, `academic_year_id`, `subject`, `title`, `description`, `attachment`, `due_datetime`, `created_at`, `max_grade`) VALUES
(1, 5, 3, 1, 'pe', 'benefits of running ', '', NULL, '2025-12-26 21:37:00', '2025-12-11 21:37:05', NULL),
(2, 7, 3, 1, 'geography', 'countries of the world', 'write an essay on the countries and their traditions ', NULL, '2025-12-09 21:38:00', '2025-12-11 21:38:12', NULL),
(3, 7, 3, 1, 'geography', 'water distillation in different countries ', 'write an essay on water distillation in different countries ', '1765482277_0f6b2ae77151edcbb40c.pdf', '2025-12-25 21:44:00', '2025-12-11 21:44:37', NULL),
(4, 7, 3, 1, 'geography', 'world traditions', 'write an essay about all the traditions around the world', NULL, '2025-12-29 23:00:00', '2025-12-11 23:00:16', 20),
(5, 5, 3, 1, 'pe', 'pe', 'pe', '1765491629_8e4eecbe4ca87c695e0e.pdf', '2025-12-23 00:20:00', '2025-12-12 00:20:29', 20),
(6, 5, 3, 1, 'pe', 'drinking water', 'the benefits', '1765497200_f0672821f095f048a37f.pdf', '2025-12-23 01:53:00', '2025-12-12 01:53:20', 30),
(7, 5, 3, 1, 'pe', 'pe', 'pe', NULL, '2025-12-30 02:12:00', '2025-12-13 02:12:29', 30),
(8, 7, 3, 1, 'microscopes', 'write an essay about microscopes', '2000 words ', NULL, '2025-12-23 19:35:00', '2025-12-13 19:35:52', 20),
(9, 7, 3, 1, 'biochemistry', 'biochemistry', 'biochemistry', NULL, '2025-12-16 19:44:00', '2025-12-13 19:44:22', 12),
(10, 7, 3, 1, 'biochemistry', 'biochemistry', 'biochemistry', NULL, '2025-12-16 19:44:00', '2025-12-13 19:49:44', 12),
(11, 15, 5, 1, 'Mathematics', 'Mathematics – Homework 1', 'Complete the first assignment for Mathematics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(12, 16, 5, 1, 'Mathematics', 'Mathematics – Homework 1', 'Complete the first assignment for Mathematics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(13, 17, 5, 1, 'Mathematics', 'Mathematics – Homework 1', 'Complete the first assignment for Mathematics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(14, 18, 5, 1, 'Mathematics', 'Mathematics – Homework 1', 'Complete the first assignment for Mathematics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(15, 19, 5, 1, 'Mathematics', 'Mathematics – Homework 1', 'Complete the first assignment for Mathematics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(16, 20, 5, 1, 'Mathematics', 'Mathematics – Homework 1', 'Complete the first assignment for Mathematics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(17, 9, 6, 1, 'English', 'English – Homework 1', 'Complete the first assignment for English.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(18, 10, 6, 1, 'English', 'English – Homework 1', 'Complete the first assignment for English.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(19, 11, 6, 1, 'English', 'English – Homework 1', 'Complete the first assignment for English.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(20, 12, 6, 1, 'English', 'English – Homework 1', 'Complete the first assignment for English.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(21, 13, 6, 1, 'English', 'English – Homework 1', 'Complete the first assignment for English.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(22, 14, 6, 1, 'English', 'English – Homework 1', 'Complete the first assignment for English.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(23, 25, 3, 1, 'Biology', 'Biology – Homework 1', 'Complete the first assignment for Biology.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(24, 26, 3, 1, 'Biology', 'Biology – Homework 1', 'Complete the first assignment for Biology.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(25, 27, 3, 1, 'Biology', 'Biology – Homework 1', 'Complete the first assignment for Biology.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(26, 28, 3, 1, 'Biology', 'Biology – Homework 1', 'Complete the first assignment for Biology.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(27, 29, 7, 1, 'Physics', 'Physics – Homework 1', 'Complete the first assignment for Physics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(28, 30, 7, 1, 'Physics', 'Physics – Homework 1', 'Complete the first assignment for Physics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(29, 31, 7, 1, 'Physics', 'Physics – Homework 1', 'Complete the first assignment for Physics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(30, 32, 7, 1, 'Physics', 'Physics – Homework 1', 'Complete the first assignment for Physics.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(31, 27, 8, 1, 'Chemistry', 'Chemistry – Homework 1', 'Complete the first assignment for Chemistry.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(32, 28, 8, 1, 'Chemistry', 'Chemistry – Homework 1', 'Complete the first assignment for Chemistry.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(33, 29, 8, 1, 'Chemistry', 'Chemistry – Homework 1', 'Complete the first assignment for Chemistry.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(34, 30, 8, 1, 'Chemistry', 'Chemistry – Homework 1', 'Complete the first assignment for Chemistry.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(35, 31, 8, 1, 'Chemistry', 'Chemistry – Homework 1', 'Complete the first assignment for Chemistry.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(36, 32, 8, 1, 'Chemistry', 'Chemistry – Homework 1', 'Complete the first assignment for Chemistry.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(37, 9, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(38, 10, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(39, 11, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(40, 12, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(41, 13, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(42, 14, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(43, 15, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(44, 16, 10, 1, 'Arabic', 'Arabic – Homework 1', 'Complete the first assignment for Arabic.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(45, 21, 11, 1, 'History', 'History – Homework 1', 'Complete the first assignment for History.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(46, 22, 11, 1, 'History', 'History – Homework 1', 'Complete the first assignment for History.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(47, 23, 11, 1, 'History', 'History – Homework 1', 'Complete the first assignment for History.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(48, 24, 11, 1, 'History', 'History – Homework 1', 'Complete the first assignment for History.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(49, 25, 11, 1, 'History', 'History – Homework 1', 'Complete the first assignment for History.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(50, 26, 11, 1, 'History', 'History – Homework 1', 'Complete the first assignment for History.', NULL, '2025-12-21 11:03:13', '2025-12-14 11:03:13', NULL),
(74, 15, 5, 1, 'Mathematics', 'Mathematics – Homework 2', 'Practice questions and revision for Mathematics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(75, 16, 5, 1, 'Mathematics', 'Mathematics – Homework 2', 'Practice questions and revision for Mathematics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(76, 17, 5, 1, 'Mathematics', 'Mathematics – Homework 2', 'Practice questions and revision for Mathematics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(77, 18, 5, 1, 'Mathematics', 'Mathematics – Homework 2', 'Practice questions and revision for Mathematics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(78, 19, 5, 1, 'Mathematics', 'Mathematics – Homework 2', 'Practice questions and revision for Mathematics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(79, 20, 5, 1, 'Mathematics', 'Mathematics – Homework 2', 'Practice questions and revision for Mathematics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(80, 9, 6, 1, 'English', 'English – Homework 2', 'Practice questions and revision for English.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(81, 10, 6, 1, 'English', 'English – Homework 2', 'Practice questions and revision for English.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(82, 11, 6, 1, 'English', 'English – Homework 2', 'Practice questions and revision for English.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(83, 12, 6, 1, 'English', 'English – Homework 2', 'Practice questions and revision for English.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(84, 13, 6, 1, 'English', 'English – Homework 2', 'Practice questions and revision for English.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(85, 14, 6, 1, 'English', 'English – Homework 2', 'Practice questions and revision for English.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(86, 25, 3, 1, 'Biology', 'Biology – Homework 2', 'Practice questions and revision for Biology.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(87, 26, 3, 1, 'Biology', 'Biology – Homework 2', 'Practice questions and revision for Biology.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(88, 27, 3, 1, 'Biology', 'Biology – Homework 2', 'Practice questions and revision for Biology.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(89, 28, 3, 1, 'Biology', 'Biology – Homework 2', 'Practice questions and revision for Biology.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(90, 29, 7, 1, 'Physics', 'Physics – Homework 2', 'Practice questions and revision for Physics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(91, 30, 7, 1, 'Physics', 'Physics – Homework 2', 'Practice questions and revision for Physics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(92, 31, 7, 1, 'Physics', 'Physics – Homework 2', 'Practice questions and revision for Physics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(93, 32, 7, 1, 'Physics', 'Physics – Homework 2', 'Practice questions and revision for Physics.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(94, 27, 8, 1, 'Chemistry', 'Chemistry – Homework 2', 'Practice questions and revision for Chemistry.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(95, 28, 8, 1, 'Chemistry', 'Chemistry – Homework 2', 'Practice questions and revision for Chemistry.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(96, 29, 8, 1, 'Chemistry', 'Chemistry – Homework 2', 'Practice questions and revision for Chemistry.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(97, 30, 8, 1, 'Chemistry', 'Chemistry – Homework 2', 'Practice questions and revision for Chemistry.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(98, 31, 8, 1, 'Chemistry', 'Chemistry – Homework 2', 'Practice questions and revision for Chemistry.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(99, 32, 8, 1, 'Chemistry', 'Chemistry – Homework 2', 'Practice questions and revision for Chemistry.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(100, 9, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(101, 10, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(102, 11, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(103, 12, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(104, 13, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(105, 14, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(106, 15, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(107, 16, 10, 1, 'Arabic', 'Arabic – Homework 2', 'Practice questions and revision for Arabic.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(108, 21, 11, 1, 'History', 'History – Homework 2', 'Practice questions and revision for History.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(109, 22, 11, 1, 'History', 'History – Homework 2', 'Practice questions and revision for History.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(110, 23, 11, 1, 'History', 'History – Homework 2', 'Practice questions and revision for History.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(111, 24, 11, 1, 'History', 'History – Homework 2', 'Practice questions and revision for History.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(112, 25, 11, 1, 'History', 'History – Homework 2', 'Practice questions and revision for History.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(113, 26, 11, 1, 'History', 'History – Homework 2', 'Practice questions and revision for History.', NULL, '2025-12-28 11:03:22', '2025-12-14 11:03:22', NULL),
(114, 25, 3, 1, 'biology', 'photosynthesis', 'write an essay about photosynthesis ', NULL, '2025-12-09 00:58:00', '2025-12-28 00:58:40', 20);

-- --------------------------------------------------------

--
-- Table structure for table `homework_submissions`
--

CREATE TABLE `homework_submissions` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `submitted_file` varchar(255) DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homework_submissions`
--

INSERT INTO `homework_submissions` (`id`, `homework_id`, `student_id`, `submitted_file`, `submitted_at`, `created_at`) VALUES
(1, 3, 18, '1765485339_8beb09c0d1ec99f46507.pdf', '2025-12-11 20:35:39', '2025-12-11 20:35:39'),
(2, 4, 18, '1765488481_a52501230192e7234df7.pdf', '2025-12-11 21:28:01', '2025-12-11 21:28:01'),
(3, 1, 16, '1765489144_eefa13e5a74e7d13a3f6.pdf', '2025-12-11 21:39:04', '2025-12-11 21:39:04'),
(4, 5, 16, '1765491689_82f402f97522db3f73bd.pdf', '2025-12-11 22:21:29', '2025-12-11 22:21:29'),
(5, 6, 16, '1765497264_9c83c89eedf30f5d30c8.pdf', '2025-12-11 23:54:24', '2025-12-11 23:54:24'),
(6, 3, 16, 'uploads/homework_submissions/1765644391_855ba995d4144b1af290.pdf', '2025-12-13 16:46:31', '2025-12-13 18:46:31'),
(7, 4, 16, 'uploads/homework_submissions/1765645692_5f769300e59af4031ada.pdf', '2025-12-13 17:08:12', '2025-12-13 19:08:12'),
(8, 23, 16, 'uploads/homework_submissions/1765707713_308bfa2d798eba9ada3f.pdf', '2025-12-14 10:21:53', '2025-12-14 12:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `academic_year_id`, `type`, `message`, `is_read`, `created_at`) VALUES
(1, 18, 1, 'homework_graded', 'Your homework has been graded.', 0, '2025-12-11 22:12:57'),
(9, 18, 1, 'homework_graded', 'Your homework has been graded.', 0, '2025-12-11 22:45:55'),
(10, 16, 1, 'homework_assigned', 'New homework assigned: biochemistry', 0, '2025-12-13 15:49:44'),
(11, 18, 1, 'homework_assigned', 'New homework assigned: biochemistry', 0, '2025-12-13 15:49:44'),
(12, 19, 1, 'homework_assigned', 'New homework assigned: biochemistry', 0, '2025-12-13 15:49:44'),
(13, 16, 1, 'class_message', 'New class message from ahmedbashir', 0, '2025-12-13 16:03:16'),
(14, 18, 1, 'class_message', 'New class message from ahmedbashir', 0, '2025-12-13 16:03:16'),
(15, 19, 1, 'class_message', 'New class message from ahmedbashir', 0, '2025-12-13 16:03:16'),
(16, 16, 1, 'midterm_grade', 'Midterm grade posted for biology', 0, '2025-12-13 16:05:49'),
(17, 16, 1, 'class_message', 'New class message from ahmedbashir', 0, '2025-12-14 06:35:26'),
(18, 18, 1, 'class_message', 'New class message from ahmedbashir', 0, '2025-12-14 06:35:26'),
(19, 16, 1, 'midterm_grade', 'Midterm grade posted for Biology', 0, '2025-12-27 19:04:27'),
(20, 19, 1, 'midterm_grade', 'Midterm grade posted for Biology', 0, '2025-12-27 20:36:24'),
(21, 19, 1, 'class_message', 'New class message from ahmedbashir', 0, '2025-12-27 20:36:47'),
(22, 23, 1, 'class_message', 'New class message from ahmedbashir', 0, '2025-12-27 20:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `parent_name`, `email`, `phone`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'aihsha', 'aisha@gmail.com', '09141414', '2025-12-08 16:40:19', '2025-12-14 00:27:28', 17),
(2, 'mohammed', 'mohammed@gmail.com', '0918881811', '2025-12-14 01:15:34', '2025-12-14 01:15:34', NULL),
(3, 'Ahmed Al-Masri', 'ahmed.masri@gmail.com', '0912345671', '2025-12-14 03:09:43', '2025-12-14 03:12:51', 18),
(4, 'Mohamed Al-Fitouri', 'm.fitouri@gmail.com', '0912345672', '2025-12-14 03:09:43', '2025-12-14 03:12:51', 19),
(5, 'Aisha Al-Zwai', 'aisha.zwai@gmail.com', '0912345673', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(6, 'Fatima Al-Turki', 'fatima.turki@gmail.com', '0912345674', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(7, 'Salem Al-Barasi', 'salem.barasi@gmail.com', '0912345675', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(8, 'Khadija Al-Mabrouk', 'khadija.mabrouk@gmail.com', '0912345676', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(9, 'Yousef Al-Harbi', 'yousef.harbi@gmail.com', '0912345677', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(10, 'Hanan Al-Gharyani', 'hanan.gharyani@gmail.com', '0912345678', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(11, 'Ali Al-Sharif', 'ali.sharif@gmail.com', '0912345679', '2025-12-14 03:09:43', '2025-12-14 03:12:51', 20),
(12, 'Samira Al-Qadi', 'samira.qadi@gmail.com', '0912345680', '2025-12-14 03:09:43', '2025-12-14 03:12:51', 21),
(13, 'Hassan Al-Mansouri', 'hassan.mansouri@gmail.com', '0923456781', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(14, 'Najla Al-Sadi', 'najla.sadi@gmail.com', '0923456782', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(15, 'Abdulrahman Al-Zubair', 'abdulrahman.z@gmail.com', '0923456783', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(16, 'Rania Al-Kilani', 'rania.kilani@gmail.com', '0923456784', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(17, 'Mahmoud Al-Falah', 'mahmoud.falah@gmail.com', '0923456785', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(18, 'Noura Al-Sousi', 'noura.sousi@gmail.com', '0923456786', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(19, 'Fathi Al-Maghrabi', 'fathi.maghrabi@gmail.com', '0923456787', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(20, 'Iman Al-Rifi', 'iman.rifi@gmail.com', '0923456788', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(21, 'Omar Al-Hassi', 'omar.hassi@gmail.com', '0923456789', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL),
(22, 'Mariam Al-Jarbou', 'mariam.jarbou@gmail.com', '0923456790', '2025-12-14 03:09:43', '2025-12-14 03:09:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent_teacher_messages`
--

CREATE TABLE `parent_teacher_messages` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_teacher_messages`
--

INSERT INTO `parent_teacher_messages` (`id`, `teacher_id`, `parent_id`, `student_id`, `academic_year_id`, `subject`, `message`, `reply`, `created_at`, `is_read`, `read_at`) VALUES
(1, 4, 1, 18, 1, 'attendance notice ', 'attendance', NULL, '2025-12-10 22:22:09', 1, '2025-12-27 19:00:18'),
(5, 3, 1, 18, 1, 'redo test', 'Ali needs to redo the test', NULL, '2025-12-14 01:59:38', 1, '2025-12-27 19:00:18'),
(6, 3, 1, 16, 1, 'field trip notIce', 'sign the parent slip', NULL, '2025-12-14 10:39:06', 1, '2025-12-27 19:00:18'),
(7, 3, 1, 16, 1, 'exam retake', 'raghad should retake the biology exam', NULL, '2025-12-27 20:49:46', 1, '2025-12-27 19:00:18'),
(8, 3, 1, 16, 1, 'exam retake', 'retake', NULL, '2025-12-27 20:53:55', 1, '2025-12-27 19:00:18'),
(9, 3, 1, 16, 1, 'sports day prep', 'raghad needs to prepare for the sports day activities', NULL, '2025-12-27 21:28:41', 1, '2025-12-27 19:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_number` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `section` varchar(10) DEFAULT NULL,
  `status` enum('active','graduated') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_number`, `name`, `date_of_birth`, `gender`, `parent_id`, `class_id`, `created_at`, `updated_at`, `section`, `status`) VALUES
(16, '211160', 'raghad', '2025-12-18', 'female', 1, 27, '2025-12-09 10:49:58', '2025-12-27 22:49:04', 'a', 'active'),
(18, '277484', 'ali', '2025-12-14', 'male', 1, 27, '2025-12-09 23:53:19', '2025-12-27 22:49:04', 'a', 'active'),
(19, '299999', 'omar', '2025-12-15', 'male', 1, 28, '2025-12-13 12:22:00', '2025-12-27 22:49:04', 'b', 'active'),
(21, '211088', 'weam', '2022-04-06', 'female', 2, 27, '2025-12-14 01:05:32', '2025-12-27 22:49:04', 'a', 'active'),
(23, '211190', 'anas', '2003-12-07', 'female', 2, 28, '2025-12-14 01:06:21', '2025-12-27 22:49:04', 'b', 'active'),
(24, '311001', 'Ahmed Al-Masri', '2012-03-14', 'male', 2, 9, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'A', 'active'),
(25, '311002', 'Omar Al-Sharif', '2012-06-22', 'male', 3, 11, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'A', 'active'),
(26, '311003', 'Yousef Al-Qadi', '2011-11-03', 'male', 4, 9, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'A', 'active'),
(27, '311004', 'Ali Al-Faitouri', '2012-01-19', 'male', 5, 10, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'B', 'active'),
(28, '311005', 'Mahmoud Ben Ali', '2011-09-08', 'male', 8, 10, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'B', 'active'),
(29, '311006', 'Khaled Al-Zwai', '2012-05-30', 'male', 9, 13, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'A', 'active'),
(30, '311007', 'Anas Al-Hadad', '2011-12-12', NULL, 2, 29, '2025-12-14 01:24:57', '2025-12-14 01:39:47', 'a', 'active'),
(31, '311008', 'Sami Al-Barasi', '2012-04-25', 'male', 1, 9, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'A', 'active'),
(32, '311009', 'Tariq Al-Obeidi', '2011-08-17', 'male', 1, 12, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'B', 'active'),
(33, '311010', 'Faisal Al-Senussi', '2012-02-09', 'male', 1, 12, '2025-12-14 01:24:57', '2025-12-27 22:49:04', 'B', 'active'),
(35, '28888', 'ahmed', '0000-00-00', 'male', 15, NULL, '2025-12-27 17:17:10', '2025-12-27 22:49:04', NULL, 'graduated'),
(36, '21118', 'hashem', '2025-12-23', NULL, 2, 12, '2025-12-28 08:44:28', '2025-12-28 08:44:28', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollments`
--

CREATE TABLE `student_enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` enum('active','promoted','repeated','withdrawn') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_enrollments`
--

INSERT INTO `student_enrollments` (`id`, `student_id`, `class_id`, `academic_year_id`, `status`, `created_at`) VALUES
(1, 24, 9, 1, 'active', '2025-12-27 01:19:54'),
(2, 26, 9, 1, 'active', '2025-12-27 01:19:54'),
(3, 31, 9, 1, 'active', '2025-12-27 01:19:54'),
(4, 27, 10, 1, 'active', '2025-12-27 01:19:54'),
(5, 28, 10, 1, 'active', '2025-12-27 01:19:54'),
(6, 25, 11, 1, 'active', '2025-12-27 01:19:54'),
(7, 32, 12, 1, 'active', '2025-12-27 01:19:54'),
(8, 33, 12, 1, 'active', '2025-12-27 01:19:54'),
(9, 29, 13, 1, 'active', '2025-12-27 01:19:54'),
(10, 16, 25, 1, 'promoted', '2025-12-27 01:19:54'),
(11, 18, 25, 1, 'promoted', '2025-12-27 01:19:54'),
(12, 19, 26, 1, 'promoted', '2025-12-27 01:19:54'),
(13, 21, 27, 1, 'active', '2025-12-27 01:19:54'),
(14, 23, 28, 1, 'active', '2025-12-27 01:19:54'),
(15, 30, 29, 1, 'active', '2025-12-27 01:19:54'),
(31, 35, 31, 1, '', '2025-12-27 17:17:10'),
(32, 18, 27, 2, 'active', '2025-12-27 17:58:13'),
(33, 19, 28, 2, 'active', '2025-12-27 17:58:13'),
(34, 16, 27, 2, 'active', '2025-12-27 17:58:13'),
(35, 36, 12, 1, 'active', '2025-12-28 08:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `created_at`) VALUES
(1, 'biology ', 'b10293', '2025-12-09 16:18:48'),
(2, 'English', '129893', '2025-12-09 18:40:34'),
(3, 'geography', 'geo001', '2025-12-09 23:15:41'),
(4, 'business', 'bs7827', '2025-12-13 16:58:25'),
(5, 'Mathematics', 'MATH101', '2025-12-14 03:21:28'),
(6, 'English Language', 'ENG102', '2025-12-14 03:21:28'),
(7, 'Arabic Language', 'ARB103', '2025-12-14 03:21:28'),
(8, 'Biology', 'BIO104', '2025-12-14 03:21:28'),
(9, 'Chemistry', 'CHE105', '2025-12-14 03:21:28'),
(10, 'Physics', 'PHY106', '2025-12-14 03:21:28'),
(11, 'Geography', 'GEO107', '2025-12-14 03:21:28'),
(12, 'History', 'HIS108', '2025-12-14 03:21:28'),
(13, 'Computer Science', 'CS109', '2025-12-14 03:21:28'),
(14, 'Information Technology', 'IT110', '2025-12-14 03:21:28'),
(15, 'Business Studies', 'BUS111', '2025-12-14 03:21:28'),
(16, 'Economics', 'ECO112', '2025-12-14 03:21:28'),
(17, 'Accounting', 'ACC113', '2025-12-14 03:21:28'),
(18, 'Civics', 'CIV114', '2025-12-14 03:21:28'),
(19, 'Islamic Studies', 'ISL115', '2025-12-14 03:21:28'),
(20, 'Social Studies', 'SOC116', '2025-12-14 03:21:28'),
(21, 'Art', 'ART117', '2025-12-14 03:21:28'),
(22, 'Music', 'MUS118', '2025-12-14 03:21:28'),
(23, 'Physical Education', 'PE119', '2025-12-14 03:21:28'),
(24, 'Environmental Science', 'ENV120', '2025-12-14 03:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `email`, `phone`, `specialization`, `gender`, `hire_date`, `created_at`, `updated_at`) VALUES
(3, 'ahmedbashir', 'ahmed@gmail.com', '091414141', 'biology', 'Male', '2025-12-15', '2025-12-09 14:06:12', '2025-12-09 14:06:12'),
(4, 'raghadbashir', 'Raghadbashir@gmail.com', '09141414', 'art', 'Female', '2025-12-15', '2025-12-10 01:11:33', '2025-12-10 01:11:33'),
(5, 'Omar Al-Hariri', 'omar.hariri@gmail.com', '0912233445', 'Mathematics', 'Male', '2023-09-01', '2025-12-14 03:32:04', '2025-12-14 03:32:04'),
(6, 'Sara Al-Nouri', 'sara.nouri@gmail.com', '0923344556', 'English', 'Female', '2022-09-01', '2025-12-14 03:32:04', '2025-12-14 03:32:04'),
(7, 'Yousef Al-Mansouri', 'yousef.mansouri@gmail.com', '0914455667', 'Physics', 'Male', '2021-09-01', '2025-12-14 03:32:04', '2025-12-14 03:32:04'),
(8, 'Huda Al-Zahra', 'huda.zahra@gmail.com', '0925566778', 'Chemistry', 'Female', '2020-09-01', '2025-12-14 03:32:04', '2025-12-14 03:32:04'),
(9, 'Khaled Al-Fitouri', 'khaled.fitouri@gmail.com', '0916677889', 'Geography', 'Male', '2019-09-01', '2025-12-14 03:32:04', '2025-12-14 03:32:04'),
(10, 'Mariam Al-Qadi', 'mariam.qadi@gmail.com', '0927788990', 'Arabic', 'Female', '2023-01-15', '2025-12-14 03:32:04', '2025-12-14 03:32:04'),
(11, 'Abdulrahman Al-Saadi', 'abdulrahman.saadi@gmail.com', '0918899001', 'History', 'Male', '2022-02-01', '2025-12-14 03:32:04', '2025-12-14 03:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class_subject`
--

CREATE TABLE `teacher_class_subject` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `academic_year_id` int(11) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_class_subject`
--

INSERT INTO `teacher_class_subject` (`id`, `teacher_id`, `class_id`, `academic_year_id`, `subject`, `created_at`, `updated_at`) VALUES
(11, 5, 15, 1, 'Mathematics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(12, 5, 16, 1, 'Mathematics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(13, 5, 17, 1, 'Mathematics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(14, 5, 18, 1, 'Mathematics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(15, 5, 19, 1, 'Mathematics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(16, 5, 20, 1, 'Mathematics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(17, 6, 9, 1, 'English', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(18, 6, 10, 1, 'English', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(19, 6, 11, 1, 'English', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(20, 6, 12, 1, 'English', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(21, 6, 13, 1, 'English', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(22, 6, 14, 1, 'English', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(23, 3, 25, 1, 'Biology', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(24, 3, 26, 1, 'Biology', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(25, 3, 27, 1, 'Biology', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(26, 3, 28, 1, 'Biology', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(27, 7, 29, 1, 'Physics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(28, 7, 30, 1, 'Physics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(29, 7, 31, 1, 'Physics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(30, 7, 32, 1, 'Physics', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(31, 8, 27, 1, 'Chemistry', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(32, 8, 28, 1, 'Chemistry', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(33, 8, 29, 1, 'Chemistry', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(34, 8, 30, 1, 'Chemistry', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(35, 8, 31, 1, 'Chemistry', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(36, 8, 32, 1, 'Chemistry', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(37, 10, 9, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(38, 10, 10, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(39, 10, 11, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(40, 10, 12, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(41, 10, 13, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(42, 10, 14, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(43, 10, 15, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(44, 10, 16, 1, 'Arabic', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(45, 11, 21, 1, 'History', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(46, 11, 22, 1, 'History', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(47, 11, 23, 1, 'History', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(48, 11, 24, 1, 'History', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(49, 11, 25, 1, 'History', '2025-12-14 03:34:20', '2025-12-27 01:21:53'),
(50, 11, 26, 1, 'History', '2025-12-14 03:34:20', '2025-12-27 01:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `timetable_entries`
--

CREATE TABLE `timetable_entries` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `tcs_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `academic_year_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable_entries`
--

INSERT INTO `timetable_entries` (`id`, `class_id`, `period_id`, `subject`, `tcs_id`, `teacher_id`, `day`, `academic_year_id`) VALUES
(36, 9, 11, 'English', 17, 6, 'Monday', 1),
(37, 9, 13, 'Arabic', 37, 10, 'Wednesday', 1),
(38, 9, 15, 'English', 17, 6, 'Thursday', 1),
(39, 9, 11, 'Arabic', 37, 10, 'Thursday', 1),
(40, 9, 18, 'Arabic', 37, 10, 'Monday', 1),
(41, 9, 13, 'English', 17, 6, 'Tuesday', 1),
(42, 9, 18, 'Arabic', 37, 10, 'Tuesday', 1),
(43, 26, 11, 'History', 50, 11, 'Tuesday', 1),
(44, 26, 11, 'Biology', 24, 3, 'Thursday', 1),
(45, 26, 15, 'Biology', 24, 3, 'Tuesday', 1),
(46, 26, 13, 'History', 50, 11, 'Wednesday', 1),
(47, 26, 14, 'Biology', 24, 3, 'Wednesday', 1),
(48, 26, 15, 'Biology', 24, 3, 'Thursday', 1),
(49, 26, 17, 'History', 50, 11, 'Monday', 1),
(50, 32, 11, 'Chemistry', 36, 8, 'Tuesday', 1),
(51, 32, 13, 'Physics', 30, 7, 'Wednesday', 1),
(52, 9, 15, 'Arabic', 37, 10, 'Monday', 1),
(53, 10, 11, 'Arabic', 38, 10, 'Tuesday', 1),
(54, 9, 11, 'Arabic', 37, 10, 'Wednesday', 1),
(55, 9, 10, 'English', 17, 6, 'Tuesday', 1),
(56, 9, 11, 'Arabic', 37, 10, 'Tuesday', 1),
(57, 12, 10, 'Arabic', 40, 10, 'Monday', NULL),
(58, 31, 11, 'Chemistry', 35, 8, 'Monday', NULL),
(59, 31, 13, 'Physics', 29, 7, 'Tuesday', NULL),
(60, 31, 13, 'Physics', 29, 7, 'Wednesday', NULL),
(61, 31, 15, 'Chemistry', 35, 8, 'Thursday', NULL),
(62, 31, 10, 'Physics', 29, 7, 'Friday', NULL),
(63, 28, 10, 'Chemistry', 32, 8, 'Monday', NULL),
(64, 28, 11, 'Biology', 26, 3, 'Tuesday', NULL),
(65, 28, 10, 'Chemistry', 32, 8, 'Monday', NULL),
(66, 28, 11, 'Chemistry', 32, 8, 'Tuesday', NULL),
(67, 28, 13, 'Biology', 26, 3, 'Monday', NULL),
(68, 27, 10, 'Chemistry', 31, 8, 'Monday', NULL),
(69, 27, 11, 'Chemistry', 31, 8, 'Monday', NULL),
(70, 27, 10, 'Chemistry', 31, 8, 'Monday', 1),
(71, 27, 11, 'Biology', 25, 3, 'Tuesday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetable_periods`
--

CREATE TABLE `timetable_periods` (
  `id` int(11) NOT NULL,
  `period_number` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable_periods`
--

INSERT INTO `timetable_periods` (`id`, `period_number`, `start_time`, `end_time`, `type`) VALUES
(10, 1, '08:00:00', '08:45:00', 'class'),
(11, 2, '08:50:00', '09:35:00', 'class'),
(12, 0, '09:35:00', '09:45:00', 'break'),
(13, 3, '09:45:00', '10:30:00', 'class'),
(14, 4, '10:35:00', '11:20:00', 'class'),
(15, 5, '11:25:00', '12:10:00', 'class'),
(16, 0, '12:10:00', '12:40:00', 'lunch'),
(17, 6, '12:40:00', '13:25:00', 'class'),
(18, 7, '13:30:00', '14:15:00', 'class');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','teacher','student','parent','accountant','librarian','receptionist') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 'admin', '2025-12-08 12:39:20', '2025-12-08 15:08:59'),
(11, 'ahmedbashir', 'ahmed@gmail.com', '1234', 'teacher', '2025-12-09 21:32:05', '2025-12-09 22:30:51'),
(12, 'raghadbashir', 'Raghadbashir@gmail.com', 'r1234', 'teacher', '2025-12-10 01:11:33', '2025-12-10 01:25:58'),
(14, '211160', 'rbg@gmail.com', '211160', 'student', '2025-12-11 00:13:38', '2025-12-12 14:33:17'),
(15, '277484', 'abg@gmail.com', '123456', 'student', '2025-12-11 00:20:56', '2025-12-12 14:33:29'),
(16, '299999', NULL, '291', 'student', '2025-12-13 15:05:42', '2025-12-13 15:05:42'),
(17, 'aisha', 'aisha@gmail.com', '1234', 'parent', '2025-12-13 21:12:50', '2025-12-13 21:12:50'),
(18, 'Ahmed Al-Masri', 'ahmed.masri@gmail.com', 'Parent123', 'parent', '2025-12-14 03:12:44', '2025-12-14 03:12:44'),
(19, 'Mohamed Al-Fitouri', 'm.fitouri@gmail.com', 'Parent123', 'parent', '2025-12-14 03:12:44', '2025-12-14 03:12:44'),
(20, 'Ali Al-Sharif', 'ali.sharif@gmail.com', 'Parent123', 'parent', '2025-12-14 03:12:44', '2025-12-14 03:12:44'),
(21, 'Samira Al-Qadi', 'samira.qadi@gmail.com', 'Parent123', 'parent', '2025-12-14 03:12:44', '2025-12-14 03:12:44'),
(22, '311001', '311001@student.school', '311001', 'student', '2025-12-14 03:26:25', '2025-12-14 03:26:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_attendance_year` (`academic_year_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_materials`
--
ALTER TABLE `class_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_messages`
--
ALTER TABLE `class_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grades_year` (`academic_year_id`);

--
-- Indexes for table `graduates`
--
ALTER TABLE `graduates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_homeworks_year` (`academic_year_id`);

--
-- Indexes for table `homework_submissions`
--
ALTER TABLE `homework_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `parent_teacher_messages`
--
ALTER TABLE `parent_teacher_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_number` (`student_number`),
  ADD KEY `fk_student_parent` (`parent_id`),
  ADD KEY `fk_student_class` (`class_id`);

--
-- Indexes for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_student_year` (`student_id`,`academic_year_id`),
  ADD KEY `fk_enroll_class` (`class_id`),
  ADD KEY `fk_enroll_year` (`academic_year_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `teacher_class_subject`
--
ALTER TABLE `teacher_class_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `idx_tcs_year_teacher` (`academic_year_id`,`teacher_id`);

--
-- Indexes for table `timetable_entries`
--
ALTER TABLE `timetable_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `fk_timetable_subject` (`tcs_id`),
  ADD KEY `idx_timetable_year_teacher` (`academic_year_id`,`teacher_id`),
  ADD KEY `idx_timetable_year_class` (`academic_year_id`,`class_id`);

--
-- Indexes for table `timetable_periods`
--
ALTER TABLE `timetable_periods`
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
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `class_materials`
--
ALTER TABLE `class_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_messages`
--
ALTER TABLE `class_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_teacher`
--
ALTER TABLE `class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `graduates`
--
ALTER TABLE `graduates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `homework_submissions`
--
ALTER TABLE `homework_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parent_teacher_messages`
--
ALTER TABLE `parent_teacher_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacher_class_subject`
--
ALTER TABLE `teacher_class_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `timetable_entries`
--
ALTER TABLE `timetable_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `timetable_periods`
--
ALTER TABLE `timetable_periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD CONSTRAINT `class_teacher_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_teacher_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_grades_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `graduates`
--
ALTER TABLE `graduates`
  ADD CONSTRAINT `graduates_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD CONSTRAINT `fk_homeworks_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_student_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_student_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  ADD CONSTRAINT `fk_enroll_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_enroll_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_enroll_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `teacher_class_subject`
--
ALTER TABLE `teacher_class_subject`
  ADD CONSTRAINT `fk_tcs_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_class_subject_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_class_subject_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timetable_entries`
--
ALTER TABLE `timetable_entries`
  ADD CONSTRAINT `fk_timetable_subject` FOREIGN KEY (`tcs_id`) REFERENCES `teacher_class_subject` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timetable_entries_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `timetable_entries_ibfk_2` FOREIGN KEY (`period_id`) REFERENCES `timetable_periods` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
