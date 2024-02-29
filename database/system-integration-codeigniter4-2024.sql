-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 11:04 AM
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
-- Database: `system-integration-codeigniter4-2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `permission_name` varchar(100) DEFAULT NULL,
  `role_id` varchar(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `role_id`, `status`) VALUES
(2, 'can update', '[0]', 1),
(3, 'can delete', '[0]', 0),
(4, 'can view', '[0]', 0),
(5, 'can create', '[0]', 0),
(6, 'can upload', '[0]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `permission_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `permission_id`, `user_id`, `status`) VALUES
(1, 'user', '[1,2,3,4]', '[1,2]', 0),
(2, 'system administrator', '[1]', '[1]', 1),
(4, 'employee', '[0]', '[1]', 1),
(7, 'project manager', '[0]', '[1]', 1),
(8, 'project manager l2', '[0]', '[1]', 1),
(9, 'project manager l3', '[0]', '[1]', 1),
(10, 'project manager l4', '[0]', '[1]', 1),
(11, 'project manager l5', '[0]', '[1]', 1),
(12, 'project manager l6', '[0]', '[1]', 1),
(13, 'data entry operator', '[0]', '[1]', 1),
(14, 'receptionist', '[0]', '[1]', 0),
(21, 'red', '[0]', '[1]', 0),
(22, 'rewdsa', '[0]', '[1]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `file_path`, `file_type`, `file_size`, `user_id`) VALUES
(4, 'Assignment_Manatad,A.pdf', 'uploads/Assignment_Manatad,A.pdf', 'application/pdf', '96.06 KB', 0),
(5, 'Assignment_Manatad,A.docx', 'uploads/Assignment_Manatad,A.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '15.5 KB', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(255) NOT NULL,
  `permission_id` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `is_admin` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `updated_by` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `mobile`, `email`, `password`, `role_id`, `permission_id`, `role_name`, `is_admin`, `created_by`, `updated_by`) VALUES
(14, 'yellow', 'asdsared', 'asdasdred', 0, 'asdsa@gmail.com', '$2y$10$XKx9N4aVweTdiulYNq9/UeiYYAe0Ops.zr47tm6ZRq5Limv6bu88e', 2, '[2,4,3]', 'employee', 1, 0, 0),
(17, 'adrian', 'qwewqe', 'qwewqeq', 0, 'qwewq@gmail.com', '$2y$10$t/HXksIDFJH/16glQG7efulJUmh3mDiqlPb7f0utFq6hk2i38zGiu', 1, '[10,6]', 'user', 0, 0, 0),
(19, 'qwewq', 'qweqwe', 'qwewq', 0, 'qwewqe@gmail.com', '$2y$10$P.30olg9wSc/kHK6zGFKp.6M9JjdCf6uHIAaFKrgumAgLgD2mgpa2', 12, '[0]', 'data entry operator', 0, 0, 0),
(20, 'asdsa', 'asdasda', 'asdasdas12321', 0, 'asdsad@gmail.com', '$2y$10$m4kc4w9e4/XfYpDY5loipOhoTNmiqOtiNePQ8gkp10yBAzyKD.Tgq', 14, '[0]', 'employee', 0, 0, 0),
(21, 'yellowgreen', 'yellowgreen', 'yellowgreen', 0, 'yellowgreen@gmail.com', '$2y$10$cgFGZFVwl09KvlcOe62D7ODf48Rk.AEoKlfQul0r9WiDpqpg1qkQa', 13, '[0]', 'manager', 0, 0, 0),
(22, 'adasasad', 'adasasad', 'adasasad', 0, 'adasasad@gmail.com', '$2y$10$fOg/eRb/vYRCFvDJr/bZVuZfzyHj0GDErbjgvFcvjY/LgBugReJuO', 2, '[2,3,4,5,6,7,11]', 'system administration', 1, 0, 0),
(23, 'asdaasdasd', 'asdasasda', 'asdad', 0, 'asasdsa@gmail.com', '$2y$10$/1rBv/0Bo7Mga.srtYuWHeIQ1RtQJuBtVW2J8sY3xrCHGSLxDFkp.', 1, '[0]', 'user', 0, 0, 0),
(24, 'asd1231', 'asdas1231', 'asdasda', 0, 'asdsa2@gmail.com', '$2y$10$qMcqd8FpLpoilmoGf52pHeVmZBS/TZN2mLmdlMHAU5p/8cHtwuBsG', 2, '', 'system administration', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
