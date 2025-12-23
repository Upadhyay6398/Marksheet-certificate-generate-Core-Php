-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2025 at 11:28 AM
-- Server version: 11.4.9-MariaDB
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearningastron_marksheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_duration` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_date` varchar(50) NOT NULL,
  `updated_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `course_duration`, `short_name`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Infection Control Nurse – 3.0', '3 Months', 'ICN 3.0', 1, '07-10-2025 12:35 PM', '22-12-2025 02:48 PM'),
(2, 'Infection Control Nurse', '3 Months', 'ICN', 1, '07-10-2025 01:04 PM', '22-12-2025 02:49 PM'),
(4, 'Quality Nurase', '3 Months', 'qan', 1, '20-12-2025 12:34 PM', '20-12-2025 12:50 PM'),
(6, 'Infection Control Nurse 3.O', '3 Months', 'icn3m-v3', 1, '22-12-2025 11:55 AM', NULL),
(7, 'Infection Control Nurse 3.0', '3 Months', 'icn3m-v3', 1, '22-12-2025 12:43 PM', NULL),
(8, 'Nursing Administration Management', '3 Months', 'NAM', 1, '22-12-2025 12:53 PM', NULL),
(9, 'Medical Records Department', '3 Months', 'MRD', 1, '22-12-2025 02:50 PM', NULL),
(10, 'Cardiac Care Nurse', '3 Months', 'CCN', 1, '22-12-2025 02:51 PM', NULL),
(11, 'Critical Care Nurse', '3 Months', 'ccn3m', 1, '22-12-2025 02:51 PM', NULL),
(12, 'Medical Records and Health Information Technician', '1 Year', 'MRHIT', 1, '22-12-2025 02:52 PM', NULL),
(13, 'Medical Law & Bio Ethics', '3 Months', 'MLB', 1, '22-12-2025 02:53 PM', NULL),
(14, 'Central Sterile Supply Department - Diploma', '1 Year', 'cssd', 1, '22-12-2025 06:08 PM', '22-12-2025 06:11 PM');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `role` text DEFAULT NULL,
  `password` char(128) DEFAULT NULL,
  `salt` char(128) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `country_codes` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT current_timestamp(),
  `ip` varchar(255) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT current_timestamp(),
  `google_secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `mobile`, `role`, `password`, `salt`, `type`, `country_codes`, `status`, `create_date`, `update_date`, `ip`, `last_login`, `google_secret`) VALUES
(1, 'Super Admin', 'webmaster@gmail.com', '6398362968', 'Super Admin', '053c6bbf871b708aa53ea5a529a7fee4dbd4f357a68b2cbbda2d8820a868e8b47f2443663419abb4f1469a85a6de2d58369c94e4ee1ddfefe48fe502c795ccfa', '2ed0d1c2a5400bad506210f250a45fd58ff92a00caac15ad644622edeeeae8efaf9e8026e19f20d15f7ac1182c7ec46e00e4a79702fde99af460512b7b48b012', 'admin', '+91', 1, '2025-04-16 09:18:23', '2025-04-16 09:18:23', '223.177.184.85', '2025-12-23 05:55:34', 'D7G6FJMP3IJH6K5O');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marksheet`
--

CREATE TABLE `marksheet` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `enrolment_number` varchar(100) NOT NULL,
  `course_duration` varchar(50) DEFAULT NULL,
  `term_duration` varchar(255) DEFAULT NULL,
  `term_one_obtained_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `term_one_max_marks` decimal(10,2) NOT NULL DEFAULT 5.00,
  `term_one_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `term_two_obtained_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `term_two_max_marks` decimal(10,2) NOT NULL DEFAULT 5.00,
  `term_two_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `term_three_obtained_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `term_three_max_marks` decimal(10,2) NOT NULL DEFAULT 5.00,
  `term_three_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `project_work_obtained_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `project_work_max_marks` decimal(10,2) NOT NULL DEFAULT 15.00,
  `project_work_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `assignment_obtained_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `assignment_max_marks` decimal(10,2) NOT NULL DEFAULT 10.00,
  `assignment_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `case_study_obtained_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `case_study_max_marks` decimal(10,2) NOT NULL DEFAULT 10.00,
  `case_study_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `total_obtained_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_max_marks` decimal(10,2) NOT NULL DEFAULT 50.00,
  `overall_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `grade` varchar(2) NOT NULL DEFAULT 'F',
  `grade_description` varchar(50) NOT NULL DEFAULT 'Needs Improvement',
  `created_date` varchar(50) NOT NULL,
  `updated_date` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marksheet`
--

INSERT INTO `marksheet` (`id`, `student_name`, `course_id`, `enrolment_number`, `course_duration`, `term_duration`, `term_one_obtained_marks`, `term_one_max_marks`, `term_one_percentage`, `term_two_obtained_marks`, `term_two_max_marks`, `term_two_percentage`, `term_three_obtained_marks`, `term_three_max_marks`, `term_three_percentage`, `project_work_obtained_marks`, `project_work_max_marks`, `project_work_percentage`, `assignment_obtained_marks`, `assignment_max_marks`, `assignment_percentage`, `case_study_obtained_marks`, `case_study_max_marks`, `case_study_percentage`, `total_obtained_marks`, `total_max_marks`, `overall_percentage`, `grade`, `grade_description`, `created_date`, `updated_date`, `status`) VALUES
(4, 'Ankita', '2', 'AIIS/2025/EOA-1.0/9826', 'Certificate 3 Months Online', 'June 2025 -August 2025', 3.00, 5.00, 60.00, 2.25, 5.00, 45.00, 2.10, 5.00, 42.00, 8.00, 15.00, 53.33, 8.00, 10.00, 80.00, 8.00, 10.00, 80.00, 31.35, 50.00, 62.70, 'C', 'Good', '20-12-2025 11:31 AM', '20-12-2025 12:48 PM', 1),
(5, 'Sudhir Kumar', '1', 'AIIS/2025/EOA-1.0/91212', 'Certificate 3 Months Online', 'June 2025 -August 2025', 5.00, 5.00, 100.00, 5.00, 5.00, 100.00, 5.00, 5.00, 100.00, 14.00, 15.00, 93.33, 9.00, 10.00, 90.00, 8.00, 10.00, 80.00, 46.00, 50.00, 92.00, 'A', 'Excellent', '20-12-2025 12:39 PM', '20-12-2025 12:51 PM', 1),
(6, 'Vasu dev Verma', '6', 'AIIS/2025/ICN-3.0/10292', '3 Months', 'July 2025 - September 2025', 4.50, 5.00, 90.00, 5.00, 5.00, 100.00, 5.00, 5.00, 100.00, 12.00, 15.00, 80.00, 9.00, 10.00, 90.00, 9.00, 10.00, 90.00, 44.50, 50.00, 89.00, 'A', 'Excellent', '22-12-2025 12:03 PM', '22-12-2025 12:12 PM', 1),
(11, 'Shivam Rajput', '7', 'AIIS/2025/ICN-3.0/11256', NULL, 'February 2025 - April 2025', 4.00, 5.00, 80.00, 3.40, 5.00, 68.00, 4.00, 5.00, 80.00, 12.00, 15.00, 80.00, 9.00, 10.00, 90.00, 9.00, 10.00, 90.00, 41.40, 50.00, 82.80, 'A', 'Excellent', '22-12-2025 12:45 PM', NULL, 1),
(12, 'Preeti Tiwari', '8', 'AIIS/2025/NAM/9007', NULL, 'January 2025 - March 2025', 4.30, 5.00, 86.00, 3.33, 5.00, 66.60, 4.00, 5.00, 80.00, 12.00, 15.00, 80.00, 9.00, 10.00, 90.00, 9.00, 10.00, 90.00, 41.63, 50.00, 83.26, 'A', 'Excellent', '22-12-2025 12:58 PM', NULL, 1),
(13, 'Abdul Wali', '7', 'AIIS/2025/ICN-3.0/10256', NULL, 'July 2025 - September 2025', 3.60, 5.00, 72.00, 4.00, 5.00, 80.00, 4.00, 5.00, 80.00, 12.00, 15.00, 80.00, 7.00, 10.00, 70.00, 9.00, 10.00, 90.00, 39.60, 50.00, 79.20, 'B', 'Very Good', '22-12-2025 01:13 PM', '22-12-2025 02:55 PM', 1),
(15, 'Bhawna Kasana', '2', 'AIIS/2025/ICN-3.0/00002332', NULL, 'December 2021 -February 2022', 5.00, 5.00, 100.00, 4.00, 5.00, 80.00, 3.60, 5.00, 72.00, 12.00, 15.00, 80.00, 9.00, 10.00, 90.00, 9.00, 10.00, 90.00, 42.60, 50.00, 85.20, 'A', 'Excellent', '22-12-2025 05:58 PM', NULL, 1),
(16, 'Mukesh Pundir', '14', 'AIIS/2025/cssd/8781', NULL, 'December 2024 - November 2025', 4.00, 5.00, 80.00, 4.50, 5.00, 90.00, 3.00, 5.00, 60.00, 12.00, 15.00, 80.00, 9.00, 10.00, 90.00, 9.00, 10.00, 90.00, 41.50, 50.00, 83.00, 'A', 'Excellent', '22-12-2025 06:14 PM', '22-12-2025 06:16 PM', 1),
(17, 'Jayendra Singh', '14', 'AIIS/2025/cssd/8783', NULL, 'December 2024 - November 2025', 4.00, 5.00, 80.00, 4.00, 5.00, 80.00, 3.60, 5.00, 72.00, 12.00, 15.00, 80.00, 9.00, 10.00, 90.00, 9.00, 10.00, 90.00, 41.60, 50.00, 83.20, 'A', 'Excellent', '22-12-2025 06:22 PM', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marksheet`
--
ALTER TABLE `marksheet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrolment_number` (`enrolment_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marksheet`
--
ALTER TABLE `marksheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
